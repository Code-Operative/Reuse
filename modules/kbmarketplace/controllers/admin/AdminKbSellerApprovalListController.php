<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store.
 *
 * @author    knowband.com <support@knowband.com>
 * @copyright 2017 Knowband
 * @license   see file: LICENSE.txt
 * @category  PrestaShop Module
 *
 */

require_once dirname(__FILE__) . '/AdminKbMarketplaceCoreController.php';
include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/KbMpCustomFields.php');
include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/KbMpCustomFieldSellerMapping.php');

class AdminKbSellerApprovalListController extends AdminKbMarketplaceCoreController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'kb_mp_seller';
        $this->className = 'KbSeller';
        $this->identifier = 'id_seller';
        $this->deleted = false;
        $this->lang = false;
        $this->display = 'list';
        $this->allow_export = true;
        $this->context = Context::getContext();
         parent::__construct();
        $this->toolbar_title = $this->module->l('Seller Account Approval Requests', 'adminkbsellerapprovallistcontroller');

       
        $tmp = Country::getCountries($this->context->language->id, false, false, false);
        $country_array = array();
        foreach ($tmp as $row) {
            $country_array[$row['id_country']] = $row['country'];
        }

        $this->fields_list = array(
            'id_seller' => array(
                'title' => $this->module->l('ID', 'adminkbsellerapprovallistcontroller'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'firstname' => array(
                'title' => $this->module->l('First Name', 'adminkbsellerapprovallistcontroller'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'c!firstname',
            ),
            'lastname' => array(
                'title' => $this->module->l('Last Name', 'adminkbsellerapprovallistcontroller'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'c!lastname',
            ),
            'email' => array(
                'title' => $this->module->l('Email', 'adminkbsellerapprovallistcontroller'),
                'havingFilter' => true,
                'filter_key' => 'c!email',
                'search' => true
            ),
            'cname' => array(
                'title' => $this->module->l('Country', 'adminkbsellerapprovallistcontroller'),
                'type' => 'select',
                'list' => $country_array,
                'havingFilter' => true,
                'filter_key' => 'a!id_country',
                'filter_type' => 'int',
                'order_key' => 'cname',
                'search' => true
            ),
            'active' => array(
                'title' => $this->module->l('Status', 'adminkbsellerapprovallistcontroller'),
                'type' => 'bool',
                'align' => 'text-center',
                'active' => 'status',
//                'callback' => 'translateStatus',
                'havingFilter' => true,
                'type' => 'bool',
                'order_key' => 'active',
                'search' => true
            ),
            'approved' => array(
                'title' => $this->module->l('Approval Status', 'adminkbsellerapprovallistcontroller'),
                'type' => 'select',
                'list' => KbGlobal::getApporvalStatus(),
                'callback' => 'showApprovedStatus',
                'filter_type' => 'text',
                'filter_key' => 'a!approved',
                'order_key' => 'approved'
            ),
            'date_add' => array(
                'title' => $this->module->l('Request Date', 'adminkbsellerapprovallistcontroller'),
                'align' => 'text-right',
                'type' => 'date',
                'filter_key' => 'a!date_upd'
            )
        );

        $this->_select = '
		a.approved, a.active,
		 c.`firstname`, c.`lastname`, c.`email`, country_lang.name as cname, a.date_upd';

        $this->_join = '
		INNER JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = a.`id_customer`) 
		LEFT JOIN `' . _DB_PREFIX_ . 'country` country ON a.id_country = country.id_country 
		LEFT JOIN `' . _DB_PREFIX_ . 'country_lang` country_lang ON (country.`id_country` = country_lang.`id_country` 
			AND country_lang.`id_lang` = ' . (int)$this->context->language->id . ')';

        $this->_where .= ' AND a.approved IN ('
                . (int) KbGlobal::APPROVAL_WAITING . ',' . (int) KbGlobal::DISSAPPROVED . ')';

        $this->_orderBy = 'a.id_seller';
        $this->_orderWay = 'DESC';

        $this->shopLinkType = 'shop'; //TODO - CHECK ASHISH
        $this->shopShareDatas = Shop::SHARE_CUSTOMER;

        $this->addRowAction('view');
        $this->addRowAction('approve');
        $this->addRowAction('disapproveselleraccount');
    }
    
    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addJqueryPlugin('fancybox');
    }

    public function initProcess()
    {
        parent::initProcess();
        if (Tools::getIsset('approve' . $this->table)) {
            $this->action = 'approveSeller';
        } elseif (Tools::getIsset('dissapprove' . $this->table)) {
            $this->action = 'dissapproveSeller';
        }
    }

    public function initContent()
    {
        $this->content .= $this->getReasonPopUpHtml();
        parent::initContent();
    }

    public function initToolbar()
    {
        parent::initToolbar();
        unset($this->toolbar_btn['new']);
    }

    public function initPageHeaderToolbar()
    {
        if (!empty($this->display) && $this->display == 'view') {
            $seller = $this->loadObject(true);
            if (Validate::isLoadedObject($seller)) {
                $seller_info = $seller->getSellerInfo();
                $this->toolbar_title = sprintf($this->module->l('Information about Seller: %s', 'adminkbsellerapprovallistcontroller'), $seller_info['seller_name']);
            }
            $this->page_header_toolbar_btn['cancel'] = array(
                'href' => self::$currentIndex . '&token=' . $this->token,
                'desc' => $this->module->l('Back to List', 'adminkbsellerapprovallistcontroller'),
                'icon' => 'process-icon-cancel'
            );
        }

        parent::initPageHeaderToolbar();
    }

    public function processStatus()
    {
        $seller = new KbSeller(Tools::getValue($this->identifier, 0));
        $before_update = (int)$seller->active;

        if (Validate::isLoadedObject($object = $this->loadObject())) {
            // Object must have a variable called 'active'
            if (!array_key_exists('active', $object)) {
                throw new PrestaShopException($this->module->l('property active is missing in object ', 'adminkbsellerapprovallistcontroller') . get_class($this));
            }

            // Update only active field
            $object->setFieldsToUpdate(array('active' => true));

            // Update active status on object
            $object->active = !(int)$object->active;

            // Change status to active/inactive
            $is_update = $object->update(true);

            if ($is_update) {
                if ($before_update !== !(int) $object->active) {
                    $email_template_code = 'mp_seller_account_disable';
                    if ($before_update === 1) {
                        KbSellerProduct::trackAndUpdateProduct($seller->id, 0);
                    } elseif ($before_update === 0) {
                        $email_template_code = 'mp_seller_account_enable';
                        KbSellerProduct::trackAndUpdateProduct($seller->id, 1);
                    }
                    $customer = $object->getSellerInfo();
                    $template_vars = array(
                        '{{email}}' => $customer['email'],
                        '{{full_name}}' => $customer['seller_name']
                    );

                    $email = new KbEmail(KbEmail::getTemplateIdByName($email_template_code), $object->id_default_lang);
                    $notification_emails = $object->getEmailIdForNotification();
                    foreach ($notification_emails as $em) {
                        $email->send($em['email'], $em['title'], null, $template_vars);
                    }
                }
                $matches = array();
                if (preg_match('/[\?|&]controller=([^&]*)/', (string)$_SERVER['HTTP_REFERER'], $matches) !== false
                    && Tools::strtolower($matches[1])
                    != Tools::strtolower(preg_replace('/controller/i', '', get_class($this)))) {
                    $this->redirect_after = preg_replace(
                        '/[\?|&]conf=([^&]*)/i',
                        '',
                        (string)$_SERVER['HTTP_REFERER']
                    );
                } else {
                    $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
                }

                $page = (int)Tools::getValue('page');
                $page = $page > 1 ? '&submitFilter' . $this->table . '=' . (int)$page : '';
                $this->redirect_after .= $page;
            } else {
                $this->errors[] = Tools::displayError($this->module->l('An error occurred while updating the status.', 'adminkbsellerapprovallistcontroller'));
            }
        } else {
            $this->errors[] = Tools::displayError($this->module->l('An error occurred while updating the status for an object.', 'adminkbsellerapprovallistcontroller'))
                . ' <b>' . $this->table . '</b> ' . Tools::displayError($this->module->l('(cannot load object)', 'adminkbsellerapprovallistcontroller'));
        }

        Hook::exec('actionKbMarketPlaceSellerStatusUpdate', array('seller' => $seller));
    }

    public function renderView()
    {

        $seller_obj = new $this->className(Tools::getValue($this->identifier, 0));
        if (!Validate::isLoadedObject($seller_obj)) {
            $this->context->cookie->__set(
                'kb_redirect_error',
                $this->module->l('You are trying to view information of missing seller.', 'adminkbsellerapprovallistcontroller')
            );
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbSellerApprovalList'));
        } else {
            $customer = new Customer($seller_obj->id_customer);
            $gender = new Gender($customer->id_gender, $this->context->language->id);
            $seller_lang = new Language($seller_obj->id_default_lang);
            $shop = new Shop($seller_obj->id_shop);

            $payment_info = Tools::unSerialize($seller_obj->payment_info);
            if (isset($payment_info['name'])) {
                $payment_info['name'] = $this->getPaymentMethodname($payment_info['name']);
            } elseif (isset($payment_info['paypal_id'])) {
                $payment_info['name'] = $this->module->l('Paypal', 'adminkbsellerapprovallistcontroller');
                $payment_info['data'] = array(
                    'paypal_id' => array(
                        'label' => $this->module->l('Paypal Id', 'adminkbsellerapprovallistcontroller'),
                        'value' => $payment_info['paypal_id']
                    )
                );
            } else {
                $payment_info = array();
            }
            // changes by rishabh jain for custom field data
            $id_seller = $seller_obj->id;
            $kb_available_field = KbMpCustomFields::getAvailableCustomFields();
            $customer_field_value = KbMpCustomFieldSellerMapping::getValueBySellerID($id_seller);
            $kb_final_field = array();
            $kb_field_value = array();
            if (is_array($customer_field_value) && !empty($customer_field_value)) {
                foreach ($customer_field_value as $cus_key => $customer_value) {
                    $kb_field_value[$customer_value['id_field']] = $customer_value;
                }
            }
            foreach ($kb_available_field as $key => $avialable_field) {
                if (is_array($kb_field_value) && !empty($kb_field_value)) {
                    if (isset($kb_field_value[$avialable_field['id_field']]['id_field'])) {
                        if ($kb_field_value[$avialable_field['id_field']]['id_field'] == $avialable_field['id_field']) {
                            $kb_final_field[$key] = $avialable_field;
                            $kb_final_field[$key]['customer_value'] = $kb_field_value[$avialable_field['id_field']]['value'];
                        } else {
                            $kb_final_field[$key] = $avialable_field;
                            $kb_final_field[$key]['customer_value'] = '';
                        }
                    } else {
                        $kb_final_field[$key] = $avialable_field;
                    }
                } else {
                    $kb_final_field = $kb_available_field;
                }
            }
            // changes over
            $tpl_vars = array(
                'id_seller' => $id_seller,
                'module_path' => $this->context->link->getAdminLink('AdminKbSellerList', true),
                'kb_available_field' => $kb_final_field,
                'seller_info' => $seller_obj->getSellerInfo(),
                'payment_info' => $payment_info,
                'display_summary' => false,
                'gender' => $gender,
                'registration_date' => Tools::displayDate($seller_obj->date_add, null, true),
                'shop_is_feature_active' => Shop::isFeatureActive(),
                'name_shop' => $shop->name,
                'customerLanguage' => $seller_lang,
            );

            $default_template_dir = $this->context->smarty->getTemplateDir(0);
            $this->context->smarty->setTemplateDir(
                _PS_MODULE_DIR_ . $this->kb_module_name . '/views/templates/admin/'
            );
            $this->override_folder = $this->tpl_folder = 'sellerview/';
            $helper = new HelperView($this);
            $this->setHelperDisplay($helper);
            $helper->tpl_vars = $tpl_vars;
            if (!is_null($this->base_tpl_view)) {
                $helper->base_tpl = $this->base_tpl_view;
            }
            $view = $helper->generateView();
            $this->context->smarty->setTemplateDir($default_template_dir);
            return $view;
        }
    }

    public function processApproveSeller()
    {
        if (Tools::getIsset($this->identifier)) {
            $seller = new KbSeller(Tools::getValue($this->identifier));
            $seller->approved = KbGlobal::APPROVED;
            $seller->active = 1;
            $seller->save(true);
            $product = KbSellerProduct::getSellerProducts(
                Tools::getValue($this->identifier),
                false,
                null,
                null,
                null,
                null,
                KbGlobal::APPROVED,
                0
            );
            if (!empty($product)) {
                foreach ($product as $pro) {
                    if ($pro['approved'] == KbGlobal::APPROVED) {
                        $enable_prod = new Product((int)$pro['id_product']);
                        if ($enable_prod->active == 0) {
                            Db::getInstance()->execute(
                                'UPDATE '._DB_PREFIX_.'product'
                                . ' SET active=1,redirect_type="" '
                                . 'WHERE id_product='. (int)$pro['id_product']
                            );
                            Db::getInstance()->execute(
                                'UPDATE '._DB_PREFIX_.'product_shop'
                                . ' SET active=1,redirect_type="" '
                                . 'WHERE id_shop='.(int) $pro['id_shop'] .' AND id_product='. (int)$pro['id_product']
                            );
                        }
                    }
                }
            }
            $customer = $seller->getSellerInfo();
            $template_vars = array(
                '{{email}}' => $customer['email'],
                '{{full_name}}' => $customer['seller_name']
            );

            $email = new KbEmail(KbEmail::getTemplateIdByName('mp_seller_account_approval'), $seller->id_default_lang);
            $notification_emails = $seller->getEmailIdForNotification();
            foreach ($notification_emails as $em) {
                $email->send($em['email'], $em['title'], null, $template_vars);
            }

            $this->context->cookie->__set(
                'kb_redirect_success',
                $this->module->l('Seller account has been approved successfully. Now, he/she can start selling on store.', 'adminkbsellerapprovallistcontroller')
            );
        }
        Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbSellerApprovalList'));
    }

    public function processDissapproveSeller()
    {
        if (Tools::getIsset($this->identifier)) {
            $seller           = new KbSeller(Tools::getValue($this->identifier));
            $seller->approved = KbGlobal::DISSAPPROVED;
            $seller->save(true);

            $customer      = $seller->getSellerInfo();
            if (Tools::getValue('marketplace_reason_comment')
                != strip_tags(Tools::getValue('marketplace_reason_comment'))) {
                $reason_comment = strip_tags(Tools::getValue('marketplace_reason_comment'));
            } else {
                $reason_comment = Tools::getValue('marketplace_reason_comment');
            }
            $template_vars = array(
                '{{disapproval_reason}}' => $reason_comment,
                '{{full_name}}' => $customer['seller_name']
            );

            $email               = new KbEmail(
                KbEmail::getTemplateIdByName('mp_seller_account_disapproval'),
                $seller->id_default_lang
            );
            $notification_emails = $seller->getEmailIdForNotification();
            foreach ($notification_emails as $em) {
                $email->send($em['email'], $em['title'], null, $template_vars);
            }

            $reason_log              = new KbReasonLog();
            $reason_log->reason_type = 1;
            $reason_log->id_seller   = $seller->id;
            $reason_log->id_employee = $this->context->employee->id;
            $reason_log->comment     = $reason_comment;
            $reason_log->save(true);

            $this->context->cookie->__set(
                'kb_redirect_success',
                $this->module->l('Seller account has been disapproved successfully.', 'adminkbsellerapprovallistcontroller')
            );
        }
        Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbSellerApprovalList'));
    }
    
    public function getPaymentMethodname($name)
    {
        $payment_methods =  array(
            'bankwire' => $this->module->l('Bank Wire', 'adminKbsellerapprovallistcontroller'),
            'check' => $this->module->l('Payment by Check', 'adminKbsellerapprovallistcontroller'),
            'kbpaypal' => $this->module->l('Paypal', 'adminKbsellerapprovallistcontroller'),
            'creditcard' => $this->module->l('Credit Card', 'adminKbsellerapprovallistcontroller')
        );
        return $payment_methods[$name];
    }
}
