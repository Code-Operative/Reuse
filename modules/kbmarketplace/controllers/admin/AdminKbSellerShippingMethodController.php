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
 */

require_once dirname(__FILE__).'/AdminKbMarketplaceCoreController.php';

class AdminKbSellerShippingMethodController extends AdminKbMarketplaceCoreController
{
    protected $seller_info = array();

    public function __construct()
    {
        $this->bootstrap     = true;
        $this->table         = 'kb_mp_seller_shipping_method';
        $this->className     = 'KbSellerShippingMethod';
        $this->identifier    = 'id_shipping_method';
//        $this->bulk_actions = array();
        $this->display       = 'list';
        $this->delete = true;
        parent::__construct();
        $this->toolbar_title = $this->module->l('Sellers Shippings Method', 'AdminKbSellerShippingMethodController');
        $this->fields_list   = array(
            'id_shipping_method' => array(
                'title' => $this->module->l('ID', 'AdminKbSellerShippingMethodController'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'method' => array(
                'title' => $this->module->l('Shipping Method', 'AdminKbSellerShippingMethodController'),
                'search' => true
            ),
            'active' => array(
                'title' => $this->module->l('Status', 'AdminKbSellerShippingMethodController'),
                'align' => 'center',
                'type' => 'bool',
                'active' => 'active',
                'class' => 'fixed-width-sm',
                'orderby' => false,
            ),
        );

//        $this->_select = 'c.`email`,a.`active` as c_active';

//        $this->_join = '
//            INNER JOIN '._DB_PREFIX_.'kb_mp_seller_shipping as sc on (a.id_carrier = sc.id_carrier)

        $this->_orderBy  = 'a.id_shipping_method';
        $this->_orderWay = 'DESC';

        $this->addRowAction('edit');
        $this->addRowAction('delete');
    }
    
    public function renderForm()
    {
        if (!($obj = $this->loadObject(true))) {
            return;
        }

        $this->fields_form = array(
            'legend' => array(
                'title' => !Tools::isEmpty(trim(Tools::getValue('id_shipping_method'))) ? $this->module->l('Update Method', 'AdminKbSellerShippingMethodController') : $this->module->l('Add New Shipping Method', 'AdminKbSellerShippingMethodController'),
                'icon' => 'icon-truck'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->module->l('Shipping Method Name', 'AdminKbSellerShippingMethodController'),
                    'name' => 'method',
                    'col' => 4,
                    'required' => true
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Active', 'AdminKbSellerShippingMethodController'),
                    'name' => 'active',
                    'is_bool' => true,
                    'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled', 'AdminKbSellerShippingMethodController')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled', 'AdminKbSellerShippingMethodController')
                            )
                        ),
                ),
            ),
            'submit' => array(
                'class' => 'btn btn-default pull-right',
                'title' => $this->module->l('Save', 'AdminKbSellerShippingMethodController'),
            )
        );
        $tpl = $this->custom_smarty->createTemplate('kb_extra_content.tpl');
         $tpl->assign('error_validate', true);
        return parent::renderForm().$tpl->fetch();
    }
    
    public function processAdd()
    {
        if (Tools::isSubmit('submitAdd'.$this->table)) {
            $method = trim(Tools::getValue('method'));
            if (Tools::strtolower($method) == 'other') {
                $this->errors[] = $this->module->l('Other is an reserved keyword. It cannot be used.', 'AdminKbSellerShippingMethodController');
            } else {
                $exist  = Db::getInstance()->getValue('SELECT count(*) as count FROM '._DB_PREFIX_.pSQL($this->table).' WHERE method="'.pSQL($method).'"');
                if ($exist > 0) {
                    $this->errors[] = $this->module->l('Shipping Method already exist.', 'AdminKbSellerShippingMethodController');
                } else {
                    $shippingMethod = new KbSellerShippingMethod();
                    $shippingMethod->method = $method;
                    $shippingMethod->active = Tools::getValue('active');
                    if ($shippingMethod->add()) {
                        Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerShippingMethod') . '&conf=3');
                    }
                }
            }
        }
    }
    
    public function processUpdate()
    {
        if (Tools::isSubmit('submitAdd'.$this->table)) {
            $method = trim(Tools::getValue('method'));
            $id_shipping_method = Tools::getValue('id_shipping_method');
            if (Tools::strtolower($method) == 'other') {
                $this->errors[] = $this->module->l('Other is an reserved keyword. It cannot be used.', 'AdminKbSellerShippingMethodController');
            } else {
                $exist  = Db::getInstance()->getValue('SELECT count(*) as count FROM '._DB_PREFIX_.pSQL($this->table).' WHERE id_shipping_method !='.(int)$id_shipping_method.' AND method="'.pSQL($method).'"');
                if ($exist > 0) {
                    $this->errors[] = $this->module->l('Shipping Method already exist.', 'AdminKbSellerShippingMethodController');
                } else {
                    $shippingMethod = new KbSellerShippingMethod($id_shipping_method);
                    $shippingMethod->method = $method;
                    $shippingMethod->active = Tools::getValue('active');
                    if ($shippingMethod->update()) {
                        Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerShippingMethod') . '&conf=4');
                    }
                }
            }
        }
    }

    public function postProcess()
    {
        if (Tools::isSubmit('active'.$this->table)) {
            $id_shipping_method = Tools::getValue('id_shipping_method');
            $shippingMethod = new KbSellerShippingMethod($id_shipping_method);
            if ($shippingMethod->active) {
                $shippingMethod->active = 0;
            } else {
                $shippingMethod->active = 1;
            }
            $shippingMethod->update();
            Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerShippingMethod') . '&conf=5');
        }
        return parent::postProcess();
    }
    
    public function processDelete()
    {
//        d(Tools::getAllValues());
        if (Tools::isSubmit('delete'.$this->table)) {
            $record = Db::getInstance()->getValue('SELECT count(*) as count FROM '._DB_PREFIX_.'kb_mp_seller_shipping_method');
            if ($record <= 1) {
                $this->context->cookie->kb_redirect_error = $this->module->l('Atleast one Shipping Method should be available.', 'AdminKbSellerShippingMethodController');
                Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerShippingMethod'));
            }
        }
        return parent::processDelete();
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->context->controller->addJS(_MODULE_DIR_.'kbmarketplace/views/js/admin/fixes.js');
    }
    
    /**
     * Override Display Delete link
     */
    public function displayDeleteLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $tpl = $this->custom_smarty->createTemplate('list_action.tpl');
        $tpl->assign(array(
            'display_popup' => false,
            'href' => AdminController::$currentIndex.'&'.$this->identifier.'='.$id.'&delete'
            .$this->table.'&token='.($token != null ? $token : $this->token),
            'action' => $this->module->l('Delete', 'AdminKbSellerShippingMethodController'),
            'icon' => 'icon-trash'
        ));
        $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'AdminKbSellerShippingMethodController'));
        $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'AdminKbSellerShippingMethodController'));
        $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'AdminKbSellerShippingMethodController'));
        $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'AdminKbSellerShippingMethodController'));

        return $tpl->fetch();
    }
    
    public function renderList()
    {
        $tpl = $this->custom_smarty->createTemplate('kb_extra_content.tpl');
        $tpl->assign('shipping_method_info', true);
        return $tpl->fetch().parent::renderList();
    }

    public function initContent()
    {
        parent::initContent();
    }
    
    public function initProcess()
    {
        parent::initProcess();
    }
    
    public function initToolbar()
    {
        parent::initToolbar();
    }

    public function initPageHeaderToolbar()
    {
        if (!Tools::getIsset('id_shipping_method') && (!Tools::isSubmit('add'.$this->table))) {
            $this->page_header_toolbar_btn['new_template'] = array(
                'href' => self::$currentIndex.'&add'.$this->table.'&token='.$this->token,
                'desc' => $this->module->l('Add new Shipping Method', 'AdminKbSellerShippingMethodController'),
                'icon' => 'process-icon-new'
            );
        }
        parent::initPageHeaderToolbar();
    }
}
