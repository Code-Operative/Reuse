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

class AdminKbSellerCloseShopRequestController extends AdminKbMarketplaceCoreController
{
    protected $seller_info = array();
    protected $account_deleted_statuses = array();
    public function __construct()
    {
        $this->bootstrap     = true;
        $this->table         = 'kb_mp_seller_shop_close_request';
        $this->className     = 'KbSellerCloseShop';
        $this->identifier    = 'id_request';
//        $this->bulk_actions = array();
        $this->lang          = false;
        $this->display       = 'list';
        parent::__construct();
        $this->account_deleted_statuses[0] = $this->module->l('No', 'AdminKbSellerCloseShopRequestController');
        $this->account_deleted_statuses[1] = $this->module->l('Yes', 'AdminKbSellerCloseShopRequestController');
        $this->toolbar_title = $this->module->l('Seller Shop Close Request', 'AdminKbSellerCloseShopRequestController');
        $this->fields_list   = array(
            'id_request' => array(
                'title' => $this->module->l('ID', 'AdminKbSellerCloseShopRequestController'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'seller_email' => array(
                'title' => $this->module->l('Email', 'AdminKbSellerCloseShopRequestController'),
                'havingFilter' => true,
                
                'filter_key' => 'seller_email',
                'order_key' => 'seller_email',
            ),
            'account_delete' => array(
                'title' => $this->module->l('Account deleted?', 'AdminKbSellerCloseShopRequestController'),
                'order_key' => 'account_delete',
                'type' => 'select',
                'filter_key' => 'a!account_delete',
                'list' => $this->account_deleted_statuses,
                 'callback' => 'showAccountDeleted',
            ),
            'approved' => array(
                'title' => $this->module->l('Status', 'AdminKbSellerCloseShopRequestController'),
//                'havingFilter' => true,
                'type' => 'select',
                'list' => $this->approval_statuses,
                'callback' => 'showApprovedStatus',
//                'filter_type' => 'text',
                'filter_key' => 'a!approved',
//                'order_key' => 'a.approved'
            ),
            'date_add' => array(
                    'title' => $this->module->l('Requested Date', 'AdminKbSellerCloseShopRequestController'),
                    'align' => 'text-right',
                    'type' => 'date',
                    'filter_key' => 'a!date_add'
                ),
            
        );

        $this->_select = 'c.`email`, CONCAT(LEFT(c.`firstname`, 1), \'. \', c.`lastname`) AS `seller_name`';

        $this->_join = 'Left JOIN `'._DB_PREFIX_.'kb_mp_seller` s ON (a.`id_seller` = s.`id_seller`)
			LEFT JOIN `'._DB_PREFIX_.'customer` c ON (s.`id_customer` = c.`id_customer`)';
        
        $this->_where .= ' AND a.id_shop IN ("'.(int)Context::getContext()->shop->id.'")';

//        $this->_orderBy  = 'a.id_carrier';
        $this->_orderWay = 'DESC';

        $this->addRowAction('approverequest');
    }
    
    public function showAccountDeleted($echo, $tr)
    {
        unset($tr);
        return $this->account_deleted_statuses[$echo];
    }
    
    public function postProcess()
    {
//        d(Tools::getAllValues());
        if (Tools::isSubmit('approve'.$this->table)) {
            $id_request = Tools::getValue('id_request');
//            print_r($id_request);
            $sellerClose = new KbSellerCloseShop($id_request);
            $seller = new KbSeller($sellerClose->id_seller);
            if (!$seller->isSeller()) {
                return;
            }
            $sellerClose->approved = '1';
            //delete seller products
            $seller_products = KbSellerProduct::getSellerProducts($sellerClose->id_seller);
            if (!empty($seller_products)) {
                foreach ($seller_products as $sell_product) {
                    if (KbSellerProduct::isSellerProduct($sellerClose->id_seller, $sell_product['id_product'])) {
                        $product = new Product($sell_product['id_product']);
                        $product->delete();
                    }
                }
            }
            
            //delete review
            $seller_reviews = KbSellerReview::getReviewsBySellerId($sellerClose->id_seller);
            if (!empty($seller_reviews)) {
                foreach ($seller_reviews as $sell_review) {
                    $review = new KbSellerReview($sell_review['id_seller_review']);
                    $review->delete();
                }
            }
            //delete carriers
            $seller_shippings = Db::getInstance()->executeS(
                'SELECT c.id_carrier from ' . _DB_PREFIX_ . 'carrier as c 
                INNER JOIN ' . _DB_PREFIX_ . 'kb_mp_seller_shipping as s on (c.id_carrier = s.id_carrier)
                where s.id_seller = ' . (int) $sellerClose->id_seller . ' AND c.deleted = 0'
            );
            if (!empty($seller_shippings)) {
                foreach ($seller_shippings as $sell_ship) {
                    $carrier = new Carrier($sell_ship['id_carrier']);
                    $carrier->delete();
                }
            }
            
            //delete seller
            $this->seller_info = $seller->getSellerInfo();
            $notification_emails = $seller->getEmailIdForNotification();
            if ($seller->delete()) {
                $sellerClose->update();
                //send email to Admin
                $template_vars = array(
                    '{{shop_title}}' => $this->seller_info['title'],
                    '{{seller_name}}' => $this->seller_info['seller_name'],
                    '{{seller_email}}' => $this->seller_info['email'],
                    '{{shop_name}}' => Configuration::get('PS_SHOP_NAME'),

                );
                $email = new KbEmail(
                    KbEmail::getTemplateIdByName('mp_notify_seller_shop_close'),
                    $this->seller_info['id_default_lang']
                );
                if ($sellerClose->account_delete) {
                    $customer = new Customer($this->seller_info['id_customer']);
                    $customer->delete();
                }
                /*Start - MK made change on 30-05-18 to send notification based on the type*/
                foreach ($notification_emails as $em) {
                    $email->send(
                        $em['email'],
                        $em['title'],
                        $email->subject,
                        $template_vars
                    );
                }
                /*End - MK made change on 30-05-18 to send notification based on the type*/
                $this->context->cookie->kb_redirect_success = $this->module->l('Request successfully updated.', 'AdminKbSellerCloseShopRequestController');
                Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerCloseShopRequest'));
            }
        }
        parent::postProcess();
    }
    
    private function unusefullFunction()
    {
        $this->module->l('Owner name', 'AdminKbSellerCloseShopRequestController');
        $this->module->l('Details', 'AdminKbSellerCloseShopRequestController');
        $this->module->l('Bank Address', 'AdminKbSellerCloseShopRequestController');
        $this->module->l('Additional Information', 'AdminKbSellerCloseShopRequestController');
        $this->module->l('Address', 'AdminKbSellerCloseShopRequestController');
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
