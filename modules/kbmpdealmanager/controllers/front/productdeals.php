<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store. 
 *
 * @category  PrestaShop Module
 * @author    knowband.com <support@knowband.com>
 * @copyright 2016 knowband
 * @license   see file: LICENSE.txt
 */

require_once _PS_MODULE_DIR_ . 'kbmarketplace/controllers/front/KbCore.php';

class KbmpdealmanagerProductDealsModuleFrontController extends KbmarketplaceCoreModuleFrontController
{
    public $controller_name = 'productdeals';
    const PER_PRODUCT = 3;
    protected $reduction_types = array();
    protected $running_types = array();

    public function __construct()
    {
        require_once _PS_MODULE_DIR_ . 'kbmpdealmanager/KbDealRule.php';
        parent::__construct();
        $this->kb_module = Module::getInstanceByName('kbmpdealmanager');
        $this->module = Module::getInstanceByName('kbmarketplace');

        $tmp = DealTool::getReductionTypes();
        $this->kb_module->l('Percentage', 'Productdeals');
        $this->kb_module->l('Fixed Amount', 'Productdeals');
        foreach ($tmp as $key => $val) {
            $this->reduction_types[] = array('value' => $key, 'label' => $this->kb_module->l($val, 'Productdeals'));
        }
        
        $tmp = DealTool::getRunningTypes();
        $this->kb_module->l('Coming Soon', 'Productdeals');  
        $this->kb_module->l('Running', 'Productdeals');
        $this->kb_module->l('Expired', 'Productdeals');
        foreach ($tmp as $key => $val) {
            $this->running_types[] = array('value' => $key, 'label' => $this->kb_module->l($val, 'Productdeals'));
        }

        $this->context->smarty->assign(
            'kb_current_request_per_product',
            $this->context->link->getModuleLink(
                'kbmpdealmanager',
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );

        $this->context->smarty->assign(
            'kb_current_request',
            $this->context->link->getModuleLink(
                'kbmpdealmanager',
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );
    }
    
    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS($this->getKbModuleDir() . 'views/css/front/kb-forms.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmpdealmanager/views/css/front.css');
        $this->addJS(_PS_MODULE_DIR_ . 'kbmpdealmanager/views/js/front.js');
        $this->addJS(_PS_MODULE_DIR_ . 'kbmpdealmanager/views/js/datetimepicker/bootstrap-datetimepicker.js');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmpdealmanager/views/css/datetimepicker/bootstrap-datetimepicker.css');
//        $this->addJS(_PS_MODULE_DIR_ . 'kbmpdealmanager/views/js/jquery-ui-timepicker-addon.js');
        $this->context->controller->addJqueryPlugin('autocomplete');
        
    }

    public function initContent()
    {
        if (Tools::getIsset('render') && Tools::getValue('render') == 'form') {
//            $this->addJqueryUI(array('ui.slider'));
//            $this->addJS(_PS_JS_DIR_ . 'jquery/plugins/timepicker/jquery-ui-timepicker-addon.js');
            $this->renderForm();
        } elseif (Tools::getIsset('render') && Tools::getValue('render') == 'delete') {
            $this->deleteMyDeal();
        } elseif (Tools::getIsset('render') && Tools::getValue('render') == 'cleanup') {
            $this->cleanup();
        } else {
            $this->renderList();
        }
        
        parent::initContent();
    }
    
    public function postProcess()
    {
        parent::postProcess();
        if (Tools::isSubmit('ajax')) {
            $this->json = array();
            $renderhtml = false;
            if (Tools::isSubmit('method')) {
                switch (Tools::getValue('method')) {
                    case 'getAjaxProductDeals':
                        $this->json = $this->getAjaxMyDealsHtml();
                        break;
                    case 'checkCoupon':
                        $this->json = $this->checkAjaxCouponCode();
                        break;
                }
            }
            if (!$renderhtml) {
                echo Tools::jsonEncode($this->json);
            }
            die;
        }
    }

    private function renderList()
    {
        $this->filter_header = $this->kb_module->l('Filter Your Search', 'Productdeals');
        $this->filter_id = 'product_deal';
        $this->filters = array(
            array(
                'type' => 'text',
                'name' => 'from_date',
                'class' => 'datepicker',
                'label' => $this->kb_module->l('Start Date', 'Productdeals')
            ),
            array(
                'type' => 'text',
                'name' => 'end_date',
                'class' => 'datepicker',
                'label' => $this->kb_module->l('End Date', 'Productdeals')
            ),
            array(
                'type' => 'select',
                'placeholder' => $this->kb_module->l('Select', 'Productdeals'),
                'name' => 'reduction_type',
                'label' => $this->kb_module->l('Discount Type', 'Productdeals'),
                'values' => $this->reduction_types
            ),
            array(
                'type' => 'select',
                'placeholder' => $this->kb_module->l('Select', 'Productdeals'),
                'name' => 'running_status',
                'label' => $this->kb_module->l('Running Status', 'Productdeals'),
                'values' => $this->running_types
            )
        );
        $this->filter_action_name = 'getAjaxProductDeals';
        $this->context->smarty->assign('kbfilter', $this->renderKbListFilter());

        $this->table_id = $this->filter_id;
        $this->table_header = array(
            array(
                'label' => $this->kb_module->l('ID', 'Productdeals'),
                'align' => 'right',
                'width' => '60'
            ),
            array('label' => $this->kb_module->l('Title', 'Productdeals'), 'width' => '120'),
            array('label' => $this->kb_module->l('Coupon Code', 'Productdeals'), 'width' => '80'),
            array('label' => $this->kb_module->l('Discount Value', 'Productdeals')),
            array('label' => $this->kb_module->l('Discount Type', 'Productdeals')),
            array('label' => $this->kb_module->l('Start', 'Productdeals'), 'width' => '80'),
            array('label' => $this->kb_module->l('End', 'Productdeals'), 'width' => '80'),
            array('label' => $this->kb_module->l('Running Status', 'Productdeals'), 'width' => '80'),
            array('label' => $this->kb_module->l('Status', 'Productdeals')),
            array('label' => $this->kb_module->l('Action', 'Productdeals'), 'align' => 'left')
        );

        $this->total_records = KbSellerDeal::getSellerDeals(
            $this->seller_info['id_seller'],
            null,
            true,
            false,
            null,
            null,
            null,
            self::PER_PRODUCT
        );

        if ($this->total_records > 0) {
            $deals = KbSellerDeal::getSellerDeals(
                $this->seller_info['id_seller'],
                null,
                false,
                false,
                $this->getPageStart(),
                $this->tbl_row_limit,
                null,
                self::PER_PRODUCT
            );

            if (is_array($deals) && count($deals) > 0) {
                $yes_txt = $this->kb_module->l('Yes', 'Productdeals');
                $no_txt = $this->kb_module->l('No', 'Productdeals');
                foreach ($deals as $row) {
                    $actions = array();
                    $actions = array(
                        array(
                            'type' => 'edit',
                            'href' => $this->context->link->getModuleLink(
                                'kbmpdealmanager',
                                $this->controller_name,
                                array('render' => 'form', 'id_seller_deal' => $row['id_seller_deal']),
                                (bool) Configuration::get('PS_SSL_ENABLED')
                            )
                        ),
                        array(
                            'type' => 'delete',
                            'href' => $this->context->link->getModuleLink(
                                'kbmpdealmanager',
                                $this->controller_name,
                                array('render' => 'delete', 'id_seller_deal' => $row['id_seller_deal']),
                                (bool) Configuration::get('PS_SSL_ENABLED')
                            )
                        )
                    );

                    $this->table_content[$row['id_seller_deal']] = array(
                        array('value' => $row['id_seller_deal']),
                        array('value' => $row['title']),
                        array('value' => $row['code']),
                        array('value' => DealTool::renderDiscount($row)),
                        array('value' => $this->kb_module->l(DealTool::renderReductionType($row), 'Productdeals')),
                        array('value' => Tools::displayDate($row['from_date'])),
                        array('value' => Tools::displayDate($row['end_date'])),
                        array('value' => $this->kb_module->l(DealTool::getRunningStatus($row['from_date'], $row['end_date']), 'Productdeals')),
                        array('value' => (($row['active']) ? $yes_txt : $no_txt)),
                        array(
                            'input' => array('type' => 'action'),
                            'class' => 'kb-tcenter',
                            'actions' => $actions
                        )
                    );
                }
            }

            $this->list_row_callback = $this->filter_action_name;
        }

        $this->context->smarty->assign('kblist', $this->renderKbList());

        $temp_module_name = $this->kb_module_name;
        $this->kb_module_name = 'kbmpdealmanager';
        $this->context->smarty->assign(
            array(
                'new_deal_link' => $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array('render' => 'form'),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            )
        );

        $this->context->smarty->assign(
            array(
                'cleanup_link' => $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array('render' => 'cleanup'),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            )
        );
        $this->setKbTemplate('deals/account/product_list.tpl');
        $this->kb_module_name = $temp_module_name;
    }
    
    public function getAjaxMyDealsHtml()
    {
        $json = array();

        $custom_filter = '';
        if (Tools::getIsset('from_date') && Tools::getValue('from_date') != '') {
            $custom_filter .= ' AND a.from_date >= "'
                . pSQL(date('Y-m-d H:i:s', strtotime(Tools::getValue('from_date')))) . '"';
        }

        if (Tools::getIsset('end_date') && Tools::getValue('end_date') != '') {
            $custom_filter .= ' AND DATE(a.end_date) <= "'
                . pSQL(date('Y-m-d H:i:s', strtotime(Tools::getValue('end_date')))) . '"';
        }

        $active = false;
        if (Tools::getIsset('active') && Tools::getValue('active') == 1) {
            $active = true;
        }

        if (Tools::getIsset('running_status') && Tools::getValue('running_status') != '') {
            $running_status = Tools::getValue('running_status');
            $runnning_statuses = DealTool::getRunningTypes();
            if (array_key_exists($running_status, $runnning_statuses)) {
                if ($running_status == DealTool::RUNNING_TYPE_UPCOMING) {
                    $custom_filter .= ' AND a.from_date > "' . pSQL(date('Y-m-d H:i:s', time())) . '"';
                } elseif ($running_status == DealTool::RUNNING_TYPE_RUNNING) {
                    $custom_filter .= ' AND a.from_date <= "' . pSQL(date('Y-m-d H:i:s', time()))
                        . '" AND a.end_date >= "' . pSQL(date('Y-m-d H:i:s', time())) . '"';
                } elseif ($running_status == DealTool::RUNNING_TYPE_EXPIRED) {
                    $custom_filter .= ' AND a.end_date < "' . pSQL(date('Y-m-d H:i:s', time())) . '"';
                }
            }
        }

        $custom_filter .= ' AND a.deal_type = 3';


        if (Tools::getIsset('reduction_type') && Tools::getValue('reduction_type') != '') {
            $reduction_type = Tools::getValue('reduction_type');
            $reduction_types = DealTool::getReductionTypes();
            if (array_key_exists($reduction_type, $reduction_types)) {
                $custom_filter .= ' AND a.reduction_type = "' . (int) $reduction_type . '"';
            }
        }

        $this->total_records = KbSellerDeal::getSellerDeals(
            $this->seller_info['id_seller'],
            null,
            true,
            $active,
            null,
            null,
            $custom_filter
        );

        if ($this->total_records > 0) {
            if (Tools::getIsset('start') && (int) Tools::getValue('start') > 0) {
                $this->page_start = (int) Tools::getValue('start');
            }

            $this->table_id = 'my_deal_filter';
            $results = KbSellerDeal::getSellerDeals(
                $this->seller_info['id_seller'],
                null,
                false,
                $active,
                $this->getPageStart(),
                $this->tbl_row_limit,
                $custom_filter
            );

            $row_html = '';
            $yes_txt = $this->kb_module->l('Yes', 'Productdeals');
            $no_txt = $this->kb_module->l('No', 'Productdeals');
            foreach ($results as $res) {
                $deal_type = DealTool::getDealType($res['deal_type']);
                $reduction_type = DealTool::getReductionType($res['reduction_type']);
                $edit_link = $this->context->link->getModuleLink(
                    'kbmpdealmanager',
                    $this->controller_name,
                    array('render' => 'form', 'id_seller_deal' => $res['id_seller_deal']),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );

                $del_link = $this->context->link->getModuleLink(
                    'kbmpdealmanager',
                    $this->controller_name,
                    array('render' => 'delete', 'id_seller_deal' => $res['id_seller_deal']),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );

                $row_html .= '<tr>
                    <td class=" ">' . $res['id_seller_deal'] . '</td>
                    <td class=" ">' . $res['title'] . '</td>
                    <td class=" ">' . $deal_type[$res['deal_type']] . '</td>
                    <td class=" ">' . DealTool::renderDiscount($res) . '</td>
                    <td class=" ">' . $this->kb_module->l(DealTool::renderReductionType($res), 'Productdeals') . '</td>
                    <td class=" ">' . Tools::displayDate($res['from_date']) . '</td>
                    <td class=" ">' . Tools::displayDate($res['end_date']) . '</td>
                    <td class=" ">' . $this->kb_module->l(DealTool::getRunningStatus($res['from_date'], $res['end_date']), 'Productdeals') . '</td>
                    <td class=" ">' . (($res['active']) ? $yes_txt : $no_txt) . '</td>
                    <td class="kb-tcenter ">
                        <a class="kb_list_action " href="' . $edit_link . '" >'
                        . $this->kb_module->l('Edit', 'Productdeals') . '</a>
                        <a class="kb_list_action " href="javascript:void(0)" data-href="'
                        . $del_link . '" onclick="actionDeleteConfirmation(this);">'
                        . $this->kb_module->l('Delete', 'Productdeals') . '</a>
                    </td>
                </tr>';
            }

            $this->list_row_callback = 'getAjaxProductdeals';
            $json['status'] = true;
            $json['html'] = $row_html;

            $json['pagination'] = $this->generatePaginator(
                $this->page_start,
                $this->total_records,
                $this->getTotalPages(),
                $this->list_row_callback
            );
        } else {
            $json['status'] = false;
            $json['msg'] = $this->kb_module->l('No Data Found', 'Productdeals');
        }

        return $json;
    }
    
    public function renderForm()
    {
        $id_seller_deal = (int) Tools::getValue('id_seller_deal', 0);
        if ($id_seller_deal > 0) {
            $this->deal = new KbSellerDeal($id_seller_deal);
            if (Validate::isLoadedObject($this->deal) && $this->deal->id_seller != $this->seller_obj->id) {
                $this->deal = new KbSellerDeal();
            }
        } else {
            $this->deal = new KbSellerDeal();
        }
        $module_name = 'kbmpdealmanager';
        if (Tools::isSubmit('submitSellerDealPerProduct') && Tools::getValue('submitSellerDealPerProduct', 0) == 1) {
            $return = $this->processSave();
            if ($return === true) {
                $this->Kbconfirmation[] = $this->kb_module->l('Deal successfully saved.', 'Productdeals');
                if (Tools::getValue('submitType', 'save') == 'savenstay') {
                    $redirect_link = $this->context->link->getModuleLink(
                        $module_name,
                        $this->controller_name,
                        array('render' => 'form', 'id_seller_deal' => $this->deal->id),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                } else {
                    $redirect_link = $this->context->link->getModuleLink(
                        $module_name,
                        $this->controller_name,
                        array(),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                }

                $this->context->cookie->__set(
                    'redirect_success',
                    $this->kb_module->l('Deal successfully saved.', 'Productdeals')
                );
                Tools::redirect($redirect_link);
            } else {
                foreach ($return as $err) {
                    $this->Kberrors[] = $err;
                }
            }
        }

        $this->context->smarty->assign(
            'deal_submit_url',
            $this->context->link->getModuleLink(
                $module_name,
                $this->controller_name,
                array('render' => 'form'),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );

        if (empty($this->deal->id)) {
            $this->context->smarty->assign(
                'form_heading',
                $this->kb_module->l('Add New Product Deal', 'Productdeals')
            );
        } else {
            $this->context->smarty->assign(
                'form_heading',
                $this->kb_module->l('Edit Product Deal', 'Productdeals') . ': '
                . $this->deal->title[$this->context->language->id]
            );
        }

        // changes by rishabh jain
        $image_url = '';
        $base_link = KbGlobal::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'));
        $default_image_path = $base_link . 'modules/' . $this->module->name . '/' . 'views/img/'.KbGlobal::SELLER_DEFAULT_BANNER;
        if ($this->deal->id && !empty($this->deal->banner_path)) {
            $image_url = $base_link . 'modules/kbmarketplace/' . 'views/img/seller_media/'. $this->deal->id_seller . '/' . $this->deal->banner_path;
        }
       if($image_url == '') {
            $image_url = $default_image_path;
        }
        $this->context->smarty->assign('banner_path', $image_url);
        // changes over
        
        $customer_name = '';
        $cart_rule_obj = new CartRule((int) $this->deal->id_cart_rule);
        $coupon_quantity = $cart_rule_obj->quantity;
        $coupon_quantity_per_user = $cart_rule_obj->quantity_per_user;
        if (Validate::isLoadedObject($cart_rule_obj)) {
            $customer = new Customer((int) $cart_rule_obj->id_customer);
            if ($cart_rule_obj->id_customer != 0) {
                $customer_name = $cart_rule_obj->id_customer.'-'.$customer->firstname
                        .' '.$customer->lastname.'('.$customer->email.')';
            }
        }
        $this->context->smarty->assign('coupon_quantity', $coupon_quantity);
        $this->context->smarty->assign('coupon_quantity_per_user', $coupon_quantity_per_user);
        $this->context->smarty->assign('customer_name', $customer_name);
        $this->context->smarty->assign('deal', $this->deal);
        $this->context->smarty->assign('seller_default_dealbanner', KbGlobal::SELLER_DEFAULT_BANNER);

        $product_rules_tmp = KbDealRule::getDealProductRules($this->deal->id);
        
        $product_rules = array();
        if (!empty($product_rules_tmp)) {
            $i = 0;
            foreach ($product_rules_tmp as $c) {
                $prod = new Product($c['value']['id_item']);
                $product_rules[$i]['id_product'] = $c['value']['id_item'];
                $product_rules[$i]['product_name'] = $prod->name[$this->context->language->id]
                        .' (ref: '.$prod->reference.')';
                $i++;
            }
        }
        $this->context->smarty->assign('product_rules', $product_rules);
        $this->context->smarty->assign('kb_img_frmats', $this->img_formats);

        $temp_module_name = $this->kb_module_name;
        $this->kb_module_name = 'kbmpdealmanager';
        $enable = 0;
        if (Configuration::get('KBMP_DEAL_MANAGER') && Configuration::get('KBMP_DEAL_MANAGER') == 1) {
            $enable = 1;
        }
        $this->context->smarty->assign('Enable', $enable);
        $this->context->smarty->assign('path_fold', $this->getPath() . "kbmpdealmanager");
        $this->context->smarty->assign('lang_id', $this->context->language->id);
        // changes by rishabh jain 
        $reduction_types = array();
        foreach ($this->reduction_types as $key => $value) {
            $reduction_types[$value['value']] = $value['label'];
        }
        $this->context->smarty->assign('reduction_types', $reduction_types);
        $this->setKbTemplate('deals/account/product_form.tpl');
        $this->kb_module_name = $temp_module_name;
    }
    
    public function processSave()
    {
        $this->setDealDefaultValues();
        $banner_path = '';
        $seller_img_path = $this->getKbModuleDir() . 'views/img/seller_media/' . $this->seller_obj->id . '/';
        if ((int) Tools::getValue('seller_deal_banner_update', 0)) {
            $banner_path = '';
            $seller_img_path = _PS_MODULE_DIR_ . 'kbmarketplace/views/img/seller_media/'
                . $this->seller_obj->id . '/';
            if ((isset($_FILES['banner_path']) && $_FILES['banner_path']['size'] > 0)) {
                if ($this->deal->id > 0) {
                    $this->deal->deleteImage();
                }
                $new_banner_name = time();
                if (isset($_FILES['banner_path'])
                    && $_FILES['banner_path']['size'] > 0
                    && $this->uploadImage(
                        'banner_path',
                        $seller_img_path,
                        $new_banner_name,
                        false
                    )
                ) {
                    chmod(_PS_MODULE_DIR_ . 'kbmarketplace/views/img/seller_media/'. $this->seller_obj->id, 0777);
                    $banner_path = $new_banner_name . '.' . $this->imageType;
                }
            }
        } else {
            if ($this->deal->id > 0) {
                $banner_path = $this->deal->banner_path;
            }
        }

        $languages = Language::getLanguages(false);
        $class_vars = get_class_vars(get_class($this->deal));
        $fields = array();
        if (isset($class_vars['definition']['fields'])) {
            $fields = $class_vars['definition']['fields'];
        }

        foreach ($fields as $field => $params) {
            if (array_key_exists('lang', $params) && $params['lang']) {
                foreach ($languages as $lang) {
                    if ($lang['id_lang'] == $this->context->language->id) {
                        $value = Tools::getValue($field, '--');
                    } elseif (isset($this->$field[$lang['id_lang']]) && !empty($this->$field[$lang['id_lang']])) {
                        $value = $this->$field[$lang['id_lang']];
                    } else {
                        $value = Tools::getValue($field, '--');
                    }

                    $this->deal->{$field}[$lang['id_lang']] = $value;
                }
            }
        }

        $this->deal->banner_path = $banner_path;
        $this->deal->active = Tools::getValue('active', 0);
        $this->deal->code = Tools::getValue('code', '');
        $this->deal->deal_type = 3;
        $this->deal->reduction_type = (int) Tools::getValue('reduction_type', DealTool::getDefaultReductionType());
        $this->deal->reduction = (float) Tools::getValue('reduction', 0);


        $this->deal->from_date = date('Y-m-d H:i:s', strtotime(Tools::getValue('from_date', '-1 days')));
        $this->deal->end_date = date('Y-m-d H:i:s', strtotime(Tools::getValue('end_date', '-1 days')));

        $validate = $this->deal->validateBeforeSave();
        if ($validate === true) {
            $is_new = true;
            if ($this->deal->id) {
                $is_new = false;
            }
            if ($this->deal->save()) {
                if (!$is_new) {
                    $this->deal->resetRules();
                }
                $this->deal->applyNewRules(
                    array(),
                    array(),
                    Tools::getValue('product_rule', array())
                );
                return true;
            } else {
                return array(
                    'save_error' => $this->kb_module->l('Error occured while saving deal.', 'Productdeals')
                );
            }
        } else {
            return $validate;
        }
    }
    
    protected function deleteMyDeal()
    {
        $id_seller_deal = (int) Tools::getValue('id_seller_deal', 0);
        $seller_img_path = $this->getKbModuleDir() . 'views/img/seller_media/' . $this->seller_obj->id . '/';
        chmod($seller_img_path, 0777);
        $redirect_link = $this->context->link->getModuleLink(
            'kbmpdealmanager',
            $this->controller_name,
            array(),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        $this->deal = new KbSellerDeal($id_seller_deal);
        if ($id_seller_deal > 0) {
            $old_banner = $this->deal->banner_path;
            $this->deleteImage($seller_img_path . $old_banner);
            if (Validate::isLoadedObject($this->deal) && $this->deal->id_seller == $this->seller_obj->id) {
                if ($this->deal->delete()) {
                    $this->context->cookie->__set(
                        'redirect_success',
                        $this->kb_module->l('Deal successfully deleted.', 'Productdeals')
                    );
                } else {
                    $this->context->cookie->__set(
                        'redirect_error',
                        $this->kb_module->l('Error occurred while deleting requested deal.', 'Productdeals')
                    );
                }
            } else {
                $this->context->cookie->__set(
                    'redirect_error',
                    $this->kb_module->l('You do not have permission to delete this deal.', 'Productdeals')
                );
            }
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->kb_module->l('Invalid request.', 'Productdeals')
            );
        }
        Tools::redirect($redirect_link);
    }

    protected function cleanup()
    {
        $redirect_link = $this->context->link->getModuleLink(
            'kbmpdealmanager',
            $this->controller_name,
            array(),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );

        $seller_img_path = $this->getKbModuleDir() . 'views/img/seller_media/' . $this->seller_obj->id . '/';
        $expired_deals = KbSellerDeal::getSellerExpiredDeals($this->seller_obj->id);
        if ($expired_deals && count($expired_deals) > 0) {
            $error = false;
            foreach ($expired_deals as $deal) {
                $obj = new KbSellerDeal((int) $deal['id_seller_deal']);
                $error = !$obj->delete();
                $old_banner = $obj->banner_path;
                $this->deleteImage($seller_img_path . $old_banner);
            }
            if (!$error) {
                $this->context->cookie->__set(
                    'redirect_success',
                    $this->kb_module->l('All the expired deals has been removed from system.', 'Productdeals')
                );
            } else {
                $this->context->cookie->__set(
                    'redirect_error',
                    $this->kb_module->l('Error while removing expired deals.', 'Productdeals')
                );
            }
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->kb_module->l('No expired deal found.', 'Productdeals')
            );
        }

        Tools::redirect($redirect_link);
    }
    
    private function setDealDefaultValues()
    {
        $this->deal->id_seller = $this->seller_obj->id;
        $default_values = DealTool::getCatalogRuleDefaultValues();
        foreach ($default_values as $field => $value) {
            $this->deal->{$field} = $value;
        }
    }

    public static function getPath()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $custom_ssl_var = 1;
        }
        if ((bool) Configuration::get('PS_SSL_ENABLED') && $custom_ssl_var == 1) {
            $module_dir = _PS_BASE_URL_SSL_ . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_MODULE_DIR_);
        } else {
            $module_dir = _PS_BASE_URL_ . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_MODULE_DIR_);
        }
        
        return $module_dir;
    }
    
    protected function checkAjaxCouponCode()
    {
        $error = true;
        $msg = $this->kb_module->l('This Coupon is already is in use.', 'Productdeals');
        $code = Tools::getValue('code', '');
        if (!empty($code)) {
            $id_seller_deal = (int) Tools::getValue('id_seller_deal', 0);
            $deal = new KbSellerDeal($id_seller_deal);
            $id_cart_rule = CartRule::getIdByCode($code);
            if ($id_cart_rule) {
                if ($deal->id_cart_rule == $id_cart_rule) {
                    $error = false;
                }
            } else {
                $error = false;
            }
        }
        return array('error' => $error, 'msg' => $msg);
    }
}
