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

require_once 'KbFrontCore.php';

class KbmarketplaceMembershipPlansModuleFrontController extends KbmarketplaceFrontCoreModuleFrontController
{
    public $controller_name = 'membershipplans';
    private $page_limit = 12;

    public function __construct()
    {
        parent::__construct();
        $this->context = Context::getContext();
        $data = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
        if ($data['kbmp_enable_membership_plan'] == 0) {
            Tools::redirect(
                $this->context->link->getPageLink(
                    'index',
                    (bool)Configuration::get('PS_SSL_ENABLED')
                )
            );
        }

        if (!$this->context->customer->logged) {
            Tools::redirect(
                $this->context->link->getPageLink(
                    'my-account',
                    (bool)Configuration::get('PS_SSL_ENABLED')
                )
            );
        } else if (!$this->showTopMenuLink()) {
            Tools::redirect(
                $this->context->link->getPageLink(
                    'my-account',
                    (bool)Configuration::get('PS_SSL_ENABLED')
                )
            );
        } else {
            if (isset($data['kbmp_enable_membership_plan']) && $data['kbmp_enable_membership_plan'] == 0) {
                Tools::redirect(
                    $this->context->link->getPageLink(
                        'index',
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    )
                );
            }
        }
        parent::__construct();
        $this->context->smarty->assign('kb_is_customer_logged', $this->context->customer->logged);
    }

    protected function showTopMenuLink()
    {
        $show = false;
        if ($this->context->customer->logged) {
            $show = (bool) KbSeller::getSellerByCustomerId((int) $this->context->customer->id);
        }
        return $show;
    }
    
    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS(_THEME_CSS_DIR_ . 'product.css');
        $this->addJS(_THEME_JS_DIR_ . 'category.js');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/membershipplans.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/notifications/jquery.notyfy.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/membership_plan.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/notifications/default.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/notifications/jquery.gritter.css');
        $this->addJS(_PS_MODULE_DIR_  . 'kbmarketplace/views/js/front/notifications/jquery.gritter.min.js');
        $this->addJS(_PS_MODULE_DIR_  . 'kbmarketplace/views/js/front/notifications/jquery.notyfy.js');
        $this->addJS(_PS_MODULE_DIR_  . 'kbmarketplace/views/js/front/supercheckout_notifications.js');
        $this->addJS(_PS_MODULE_DIR_  . 'kbmarketplace/views/js/front/membership_plan.js');
    }

    
    public function postProcess()
    {
        if (Tools::isSubmit('ajax')) {
            $this->json = array();
            $renderhtml = false;
            if (Tools::isSubmit('method')) {
                switch (Tools::getValue('method')) {
                    case 'getPlanList':
                        $this->json['content'] = $this->getAjaxPlanListHtml();
                        break;
                    case 'addMembershipPlanToCart':
                        $this->json = $this->addMembershipPlanToCart();
                        break;
                }
            }
            if (!$renderhtml) {
                echo Tools::jsonEncode($this->json);
            }
            die;
        }
    }
    
    private function addMembershipPlanToCart()
    {
        $response  = array();
        $response['is_error'] = 0;
        $id_product  = Tools::getValue('id_product', 0);
        $quantity = 1;
        $is_valid_plan = 1;
        $cart_products = array();
        if ($id_product > 0) {
            $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
            if (!$this->context->cart->id) {
                $this->context->cart->add();
                if ($this->context->cart->id) {
                    $this->context->cookie->id_cart = (int) $this->context->cart->id;
                }
            }
            $cart_products = $this->context->cart->getProducts();
            if (!empty($cart_products)) {
                foreach ($cart_products as $key => $products) {
                    if (KbMpMemberShipPlan::isMemberShipPlanTypeProduct($products['id_product'])) {
                        $is_valid_plan = 0;
                        $response['is_error'] = 1;
                        $response['error_msg'] =  $this->module->l('You can not add multiple membership plans in a cart.Kindly remove the same from cart first.', 'membershipplans');
                        break;
                    }
                }
            }
            
            if ($is_valid_plan) {
                $plan_id = Tools::getValue('id_membership_plan');
                $is_free_plan = 0;
                $id_free_membership_plan = KbMpMemberShipPlan::getFreeMembershipPlanID();
                if ($plan_id == $id_free_membership_plan) {
                    $is_free_plan = 1;
                }
                // has seller purchase free plan earlier as well
                $has_already_purchased_free_plan = 0;
                if ($is_free_plan) {
                    $has_already_purchased_free_plan = KbMemberShipPlanOrder::getMembershipOrdersByIdSellerAndPlan(KbSeller::getSellerByCustomerId($this->context->customer->id), $id_free_membership_plan);
                }
                if ($has_already_purchased_free_plan) {
                    $response['is_error'] = 1;
                    $response['error_msg'] =  $this->module->l('You can purchase the free plan onnly once.Kindly try purchasing any other plan.', 'membershipplans');
                    $is_valid_plan = 0;
                } else {
                    $product_status = 1;
                    $total_active_products = KbSellerProduct::getSellerProductsByStatus(
                        KbSeller::getSellerByCustomerId($this->context->customer->id),
                        true,
                        null,
                        null,
                        null,
                        null,
                        $product_status
                    );
                    
                    $plan_id = KbMpMemberShipPlan::isMemberShipPlanTypeProduct($id_product);
                    $plan_obj = new KbMpMemberShipPlan((int) $plan_id);
                    if ($plan_obj->is_enabled_product_limit == 1 && $total_active_products > $plan_obj->product_limit) {
                        $response['is_error'] = 1;
                        $response['error_msg'] =  $this->module->l('The maximum number of allowed active product under this plan is lesser than the current number of activated products.Kindly deactivate some products first.', 'membershipplans');
                        $is_valid_plan = 0;
                    }
                }
            }
            if ($is_valid_plan) {
                $this->context->cart->updateQty($quantity, $id_product, $id_product_attribute);
                $response['success_msg'] =  $this->module->l('Plan Added To cart Successfully.', 'membershipplans');
            }
        } else {
            $response['is_error'] = 1;
            $response['error_msg'] =  $this->module->l('The Selected Plan can not be added to cart.Kindly try again.', 'membershipplans');
        }
        return $response;
    }
    
    public function initContent()
    {
        $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if ($config['kbmp_show_seller_on_front']) {
            $this->renderMembershipPlansist();
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Currently, You are not authorized to view sellers.', 'membershipplans')
            );
        }
        parent::initContent();
    }

    public function renderMembershipPlansist()
    {
        $start = 1;
        if (Tools::getIsset('kb_page_start') && (int)Tools::getValue('kb_page_start') > 0) {
            $start = Tools::getValue('kb_page_start');
        }
        
        /*
        * Start- MK made changes on 29-06-18 to get the seller based on the context language.
        */
        $total = KbMpMemberShipPlan::getMemberShipPlans(true, null, null, null, null, true, Context::getContext()->language->id);
        /*
        * End- MK made changes on 29-06-18 to get the seller based on the context language.
        */

        if ($total > 0) {
            $paging = KbGlobal::getPaging($total, $start, $this->page_limit, false, 'getPlanList');

            $orderby = null;
            if (Tools::getIsset('orderby') && Tools::getValue('orderby') != '') {
                $orderby = Tools::getValue('orderby');
            }

            $orderway = null;
            if (Tools::getIsset('orderway') && Tools::getValue('orderway') != '') {
                $orderway = Tools::getValue('orderway');
            }

            $membership_plans = KbMpMemberShipPlan::getMemberShipPlans(
                false,
                $paging['page_position'],
                $this->page_limit,
                $orderby,
                $orderway,
                true,
                Context::getContext()->language->id // MK made changes on 29-08-18 to get seller based on context language
            );
            $base_link = KbGlobal::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'));
            $plan_default_image_path = $base_link . 'modules/' . $this->module->name . '/' . 'views/img/';
            foreach ($membership_plans as $key => $val) {
                $image = Image::getCover($val['id_product']);
                $product_obj = new Product($val['id_product']);
                $link = new Link;
                $image_link = '';
                if ($this->checkSecureUrl()) {
                    $image_link = $image ? 'https://'.$link->getImageLink($product_obj->link_rewrite[$this->context->language->id], $image['id_image'], ImageType::getFormattedName('home')) : false;
                } else {
                    $image_link = $image ? 'http://'.$link->getImageLink($product_obj->link_rewrite[$this->context->language->id], $image['id_image'], ImageType::getFormattedName('home')) : false;
                }
                if ($image_link == '') {
                    $image_link = $plan_default_image_path . 'plan_sample.jpg';
                }
                
                $membership_plans[$key]['logo'] = $image_link;
                
                $membership_plans[$key]['price'] = $product_obj->getPrice(true, null, 2);
                $membership_plans[$key]['price_formatted'] = Tools::displayPrice($membership_plans[$key]['price']);
                
                $membership_plans[$key]['href'] = '';
            }
            $this->context->smarty->assign('membership_plans', $membership_plans);

            $pagination_string = sprintf(
                $this->module->l('Showing %d - %d of %d items', 'membershipplans'),
                $paging['paging_summary']['record_start'],
                $paging['paging_summary']['record_end'],
                $total
            );
            $this->context->smarty->assign('pagination_string', $pagination_string);
            $this->context->smarty->assign('kb_pagination', $paging);
            
            $sorting_types = array(
                array('value' => 'pl.name:asc', 'label' => $this->module->l('Name: A to Z', 'membershipplans')),
                array('value' => 'pl.name:desc', 'label' => $this->module->l('Name: Z to A', 'membershipplans')),
            );
            
            $this->context->smarty->assign('sorting_types', $sorting_types);
            $this->context->smarty->assign('selected_sort', $orderby . ':' . $orderway);
        } else {
            $this->context->smarty->assign(
                'empty_list',
                $this->module->l('No Plan Found', 'membershipplans')
            );
        }
        $this->setKbTemplate('seller/membership_plans_to_customers.tpl');
    }

    public function getAjaxPlanListHtml()
    {
        $start = 1;
        if (Tools::getIsset('start') && (int)Tools::getValue('start') > 0) {
            $start = Tools::getValue('start');
        }
        
        /*
        * Start- MK made changes on 29-06-18 to get the seller based on the context language.
        */
        $total = KbMpMemberShipPlan::getMemberShipPlans(true, null, null, null, null, true, Context::getContext()->language->id);
        /*
        * End- MK made changes on 29-06-18 to get the seller based on the context language.
        */

        if ($total > 0) {
            $paging = KbGlobal::getPaging($total, $start, $this->page_limit, false, 'getPlanList');

            $orderby = null;
            if (Tools::getIsset('orderby') && Tools::getValue('orderby') != '') {
                $orderby = Tools::getValue('orderby');
            }

            $orderway = null;
            if (Tools::getIsset('orderway') && Tools::getValue('orderway') != '') {
                $orderway = Tools::getValue('orderway');
            }

            $membership_plans = KbMpMemberShipPlan::getMemberShipPlans(
                false,
                $paging['page_position'],
                $this->page_limit,
                $orderby,
                $orderway,
                true,
                Context::getContext()->language->id // MK made changes on 29-08-18 to get seller based on context language
            );
            $base_link = KbGlobal::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'));
            $plan_default_image_path = $base_link . 'modules/' . $this->module->name . '/' . 'views/img/';
            foreach ($membership_plans as $key => $val) {
                $image = Image::getCover($val['id_product']);
                $product_obj = new Product($val['id_product']);
                $link = new Link;
                $image_link = '';
                if ($this->checkSecureUrl()) {
                    $image_link = $image ? 'https://'.$link->getImageLink($product_obj->link_rewrite[$this->context->language->id], $image['id_image'], ImageType::getFormattedName('home')) : false;
                } else {
                    $image_link = $image ? 'http://'.$link->getImageLink($product_obj->link_rewrite[$this->context->language->id], $image['id_image'], ImageType::getFormattedName('home')) : false;
                }
                if ($image_link == '') {
                    $image_link = $plan_default_image_path . 'plan_sample.jpg';
                }
                
                $membership_plans[$key]['logo'] = $image_link;
                
                $membership_plans[$key]['price'] = $product_obj->getPrice(true, null, 2);
                $membership_plans[$key]['price_formatted'] = Tools::displayPrice($membership_plans[$key]['price']);
                
                $membership_plans[$key]['href'] = '';
            }

            $this->context->smarty->assign('membership_plans', $membership_plans);
            $pagination_string = sprintf(
                $this->module->l('Showing %d - %d of %d items', 'membershipplans'),
                $paging['paging_summary']['record_start'],
                $paging['paging_summary']['record_end'],
                $total
            );
            $this->json['pagination_string'] = $pagination_string;
            $this->json['kb_pagination'] = $paging;
            $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            $is_enabled_seller_shortlisting = 0;
            $this->context->smarty->assign('link', $this->context->link);
            $this->setKbTemplate('seller/plan_list.tpl');
            
            return $this->fetchTemplate();
        }
    }
    
    private function checkSecureUrl()
    {
        $custom_ssl_var = 0;

        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS'] == 'on') {
                $custom_ssl_var = 1;
            }
        } else if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $custom_ssl_var = 1;
        }
        if ((bool) Configuration::get('PS_SSL_ENABLED') && $custom_ssl_var == 1) {
            return true;
        } else {
            return false;
        }
    }
}
