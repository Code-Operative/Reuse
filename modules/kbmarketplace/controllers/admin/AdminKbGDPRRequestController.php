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

class AdminKbGDPRRequestController extends AdminKbMarketplaceCoreController
{
    protected $seller_info = array();
    protected $show_user_type_statuses = array();
    protected $show_request_type_statuses = array();
    public function __construct()
    {
        $this->bootstrap     = true;
        $this->table         = 'kb_mp_gdpr_request';
        $this->className     = 'Configuration';
        $this->identifier    = 'id_gdpr_request';
//        $this->bulk_actions = array();
        $this->lang          = false;
        $this->display       = 'list';
        parent::__construct();
        $this->show_user_type_statuses[0] = $this->module->l('Customer', 'AdminKbGDPRRequestController');
        $this->show_user_type_statuses[1] = $this->module->l('Seller', 'AdminKbGDPRRequestController');
        
        
        $this->show_request_type_statuses['products'] = $this->module->l('Seller Products', 'AdminKbGDPRRequestController');
        $this->show_request_type_statuses['sellerinfo'] = $this->module->l('Seller Information', 'AdminKbGDPRRequestController');
        $this->show_request_type_statuses['sellerorders'] = $this->module->l('Seller Orders', 'AdminKbGDPRRequestController');
        $this->show_request_type_statuses['personalinfo'] = $this->module->l('Personal Information', 'AdminKbGDPRRequestController');
        $this->show_request_type_statuses['address'] = $this->module->l('Address', 'AdminKbGDPRRequestController');
        $this->show_request_type_statuses['orders'] = $this->module->l('Orders', 'AdminKbGDPRRequestController');
        
        $this->toolbar_title = $this->module->l('GDPR Requests', 'AdminKbGDPRRequestController');
        $this->fields_list   = array(
            'id_gdpr_request' => array(
                'title' => $this->module->l('ID', 'AdminKbGDPRRequestController'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'email' => array(
                'title' => $this->module->l('Email', 'AdminKbGDPRRequestController'),
                'havingFilter' => true,
                'filter_key' => 'email',
                'order_key' => 'email',
            ),
            'is_seller' => array(
                'title' => $this->module->l('User Type', 'AdminKbGDPRRequestController'),
                'order_key' => 'is_seller',
                'type' => 'select',
                'filter_key' => 'a!is_seller',
                'list' => $this->show_user_type_statuses,
                 'callback' => 'showUsertype',
            ),
            'type' => array(
                'title' => $this->module->l('Request Type', 'AdminKbGDPRRequestController'),
                'order_key' => 'type',
                'type' => 'select',
                'filter_key' => 'a!type',
                'list' => $this->show_request_type_statuses,
                 'callback' => 'showRequesttype',
            ),
            'approved' => array(
                'title' => $this->module->l('Status', 'AdminKbGDPRRequestController'),
                'type' => 'select',
                'list' => $this->approval_statuses,
                'callback' => 'showApprovedStatus',
                'filter_key' => 'a!approved',
            ),
            'user_agent' => array(
                'title' => $this->module->l('User Agent', 'AdminKbGDPRRequestController'),
                'align' => 'center',
            ),
            'remote_address' => array(
                'title' => $this->module->l('Remote Address', 'AdminKbGDPRRequestController'),
                'align' => 'center',
            ),
            'date_add' => array(
                    'title' => $this->module->l('Requested Date', 'AdminKbGDPRRequestController'),
                    'align' => 'text-right',
                    'type' => 'date',
                    'filter_key' => 'a!date_add'
                ),
            
        );

//        $this->_select = 'c.`email`, CONCAT(LEFT(c.`firstname`, 1), \'. \', c.`lastname`) AS `seller_name`';
//
//        $this->_join = 'Left JOIN `'._DB_PREFIX_.'kb_mp_seller` s ON (a.`id_seller` = s.`id_seller`)
        
        $this->_where .= ' AND a.id_shop IN ("'.(int)Context::getContext()->shop->id.'")';

//        $this->_orderBy  = 'a.id_carrier';
        $this->_orderWay = 'DESC';

//        $this->addRowAction('approverequest');
    }
    
    public function showUsertype($echo, $tr)
    {
        unset($tr);
        return $this->show_user_type_statuses[$echo];
    }
    
    public function showRequesttype($echo, $tr)
    {
        unset($tr);
        return $this->show_request_type_statuses[$echo];
    }
    
    public function postProcess()
    {
        parent::postProcess();
    }
    
    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->context->controller->addJS(_MODULE_DIR_.'kbmarketplace/views/js/admin/fixes.js');
    }
    
    public function initContent()
    {
        parent::initContent();
    }

    public function initToolbar()
    {
        parent::initToolbar();
        unset($this->toolbar_btn['new']);
    }

    public function initPageHeaderToolbar()
    {
        parent::initPageHeaderToolbar();
    }
}
