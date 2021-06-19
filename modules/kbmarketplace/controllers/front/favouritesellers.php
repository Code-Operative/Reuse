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

class KbmarketplaceFavouriteSellersModuleFrontController extends KbmarketplaceFrontCoreModuleFrontController
{
    public $controller_name = 'favouritesellers';
    private $page_limit = 12;

    public function __construct()
    {
        parent::__construct();
        $this->context->smarty->assign('kb_is_customer_logged', $this->context->customer->logged);
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS(_THEME_CSS_DIR_ . 'product.css');
        if (Tools::getIsset('render_type')
            && (Tools::getValue('render_type') == 'sellerview'
            || Tools::getValue('render_type') == 'sellerproducts')) {
            $this->addCSS(_THEME_CSS_DIR_ . 'product_list.css');
        }
        $this->addJS(_THEME_JS_DIR_ . 'category.js');
    }

    public function postProcess()
    {
        /*Start- MK made changes on 31-05-18 to validate the customer by email*/
        if (Tools::isSubmit('validateCustomerEmail')) {
            $email = trim(Tools::getValue('email'));
            $existing_customer = Customer::customerExists($email, true);
            if (!empty($existing_customer)) {
                echo 1;
            } else {
                echo 0;
            }
            die;
        }
        /*End- MK made changes on 31-05-18 to validate the customer by email*/
        
        /*Start- MK made changes on 31-05-18 to confirm the request of data access by the customer for the seller*/
        if (Tools::getIsset('confirm') && Tools::getValue('confirm') == 'gdprreport') {
            return $this->processKbReport();
        }
        /*End- MK made changes on 31-05-18 to confirm the request of data access by the customer for the seller*/
        
        /*Start- MK made changes on 31-05-18 to submit the request of data access by the customer*/
        if (Tools::isSubmit('submitMPPersonalAccess')) {
            $this->processSubmitPersonalDataRequest();
        }
        /*End- MK made changes on 31-05-18 to submit the request of data access by the customer*/
        
        if (Tools::isSubmit('ajax')) {
            $this->json = array();
            $renderhtml = false;
            if (Tools::isSubmit('method')) {
                switch (Tools::getValue('method')) {
                    case 'getSellerList':
                        $this->json['content'] = $this->getAjaxSellerListHtml();
                        break;
                }
            }
            if (!$renderhtml) {
                echo Tools::jsonEncode($this->json);
            }
            die;
        }
    }
    
    /*
     * Function to send report of personal data to customer
     * MK made changes on 30-05-18
     */
    protected function processKbReport()
    {
        $authanticate = trim(Tools::getValue('authenticate'));
        $id_seller = trim(Tools::getValue('seller_id'));
        $id_lang = Context::getContext()->language->id;
        $seller = new KbSeller($id_seller);
        
        if (empty($authanticate) || empty($id_seller) || !$seller->isSeller()) {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Your request cannot be processed.', 'sellerfront')
            );
            Tools::redirect($this->context->link->getModuleLink($this->module->name, 'sellerfront'));
        }
        
        $record = DB::getInstance()->getRow('Select * FROM ' . _DB_PREFIX_ . 'kb_mp_gdpr_request Where authenticate="' . pSQL($authanticate) . '" and approved="0"');
        if (!empty($record)) {
            $email = $record['email'];
            $id_customer = Customer::customerExists($email, true, false);
            if (!empty($id_customer)) {
                $customer = new Customer($id_customer);
                $orders = Order::getCustomerOrders($customer->id);
                $currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
                $currency_symbol = $currency->getSign();

                $customer_order = array();
                if (!empty($orders)) {
                    foreach ($orders as $order) {
                        if (KbSellerEarning::isSellerOrder($id_seller, $order['id_order'])) {
                            $customer_order[] = $order;
                        }
                    }
                }

                //seller review
                $seller_reviews = KbSellerReview::getReviewsBySellerId($id_seller, $id_lang);
                $customer_review = array();
                if (!empty($seller_reviews)) {
                    foreach ($seller_reviews as $sell_review) {
                        if ($sell_review['id_customer'] == $customer->id) {
                            $customer_review[] = $sell_review;
                        }
                    }
                }
                
                //seller product review
                $this->context->smarty->assign('orders', $customer_order);
                $this->context->smarty->assign('customer_review', $customer_review);
//                $this->context->smarty->assign('customer_product_review', $customer_product_review);
                $this->context->smarty->assign('currency_symbol', $currency_symbol);
                $this->context->smarty->assign('shop_feature_active', Shop::isFeatureActive());
                
                $content = $this->context->smarty->fetch(_PS_MODULE_DIR_ . $this->module->name.'/views/templates/admin/report_data_list.tpl');

                $template_vars = array(
                    '{customer_email}' => $email,
                    '{report_data_list}' => $content,
                    '{requested_email}' => $email,
                    '{user_agent}' => $record['user_agent'],
                    '{requested_date}' => $record['date_add'],
                    '{remote_addr}' => $record['remote_address'],
                    '{accept_lang}' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                );
                
                $kbemail = new KbEmail(
                    KbEmail::getTemplateIdByName('mp_gdpr_report'),
                    Context::getContext()->language->id
                );
                if ($kbemail->send(
                    $email,
                    null,
                    $kbemail->subject,
                    $template_vars
                )) {
                    Db::getInstance()->execute('Update '._DB_PREFIX_.'kb_mp_gdpr_request set approved="1" where email="'.pSQL($email).'" And authenticate="'.pSQL(md5($email)).'"');
                    $this->context->cookie->__set(
                        'redirect_success',
                        $this->module->l('Your request has been processed.', 'gdpr')
                    );
                    Tools::redirect($this->context->link->getModuleLink($this->module->name, 'sellerfront'));
                }
            } else {
                $this->context->cookie->__set(
                    'redirect_error',
                    $this->module->l('Your request cannot be processed.', 'gdpr')
                );
                Tools::redirect(Context::getContext()->link->getModuleLink($this->module->name, 'gdpr'));
            }
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Your request cannot be processed.', 'gdpr')
            );
            Tools::redirect(Context::getContext()->link->getModuleLink($this->module->name, 'gdpr'));
        }
    }
    
    
    /*
     * Function to submit the request of personal data request
     * MK made changes on 30-05-18
     */
    protected function processSubmitPersonalDataRequest()
    {
        $email = trim(Tools::getValue('kb_access_email'));
        $id_seller = trim(Tools::getValue('id_seller'));
        
        if (empty($email) || empty($id_seller)) {
            return;
        }
        
        $kb_seller = new KbSeller($id_seller);
        if (!$kb_seller->isSeller()) {
            return;
        }
        
        $existing_request = Db::getInstance()->getRow('SELECT * FROM ' . _DB_PREFIX_ . 'kb_mp_gdpr_request where email="' . pSQL($email) . '" AND is_seller="0" AND approved="0"');
        if (empty($existing_request)) {
            //send mail
            $template_vars = array(
                '{{confirm_link}}' => $this->context->link->getModuleLink($this->module->name, 'sellerfront', array('confirm' => 'gdprreport', 'seller_id' => $id_seller,'authenticate' => md5($email))),
            );
            $kbemail = new KbEmail(
                KbEmail::getTemplateIdByName('mp_request_portibility_gdpr'),
                Context::getContext()->language->id
            );
            if ($kbemail->send(
                $email,
                null,
                $kbemail->subject,
                $template_vars
            )) {
                $user_data = KbConfiguration::kbUserInfo();
                Db::getInstance()->execute('INSERT INTO ' . _DB_PREFIX_ . 'kb_mp_gdpr_request set email="' . pSQL($email) . '",is_seller=0,id_shop=' . (int) Context::getContext()->shop->id . ',type="personalinfo",remote_address="' . pSQL($user_data['remote_address']) . '", user_agent="' . pSQL($user_data['user_agent']) . '",authenticate="' . pSQL(md5($email)) . '",approved="0",date_add=now()');
                $this->context->cookie->__set(
                    'redirect_success',
                    $this->module->l('We have sent you a confirmation email. Please click on the link provided in the email to confirm your request. Once this is confirmed we will proceed with your request.', 'gdpr')
                );
                Tools::redirect(KbGlobal::getSellerLink($id_seller));
            }
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('You have already request for personal data. Please click on the link provided in the email to confirm your request.', 'gdpr')
            );
            Tools::redirect(KbGlobal::getSellerLink($id_seller));
        }
    }

    public function initContent()
    {

        $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        
        if ($config['kbmp_show_seller_on_front']) {
            $this->renderSellerList();
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Currently, You are not authorized to view sellers.', 'sellerfront')
            );
        }
        

        parent::initContent();
    }

    public function renderSellerList()
    {
        //coupon- mayank kumar
        if (Tools::getValue('searchcoupon') && Tools::getIsset('searchcoupon')) {
            $getCoupon = Tools::getValue('coupon');
            if (!empty($getCoupon) && Tools::getIsset('coupon')) {
                $coupon = Tools::getValue('coupon');
                $free_shipping = Db::getInstance()->getRow(
                    'SELECT * FROM '._DB_PREFIX_.'cart_rule where code="'.pSQL($coupon).'"'
                );
                if ($free_shipping['free_shipping'] == '1') {
                    echo 'free';
                    die;
                } elseif ($free_shipping['free_shipping'] == '0') {
                    echo 'paid';
                    die;
                } else {
                    echo 'no';
                    die;
                }
            }
        }
        
        
        $start = 1;
        if (Tools::getIsset('kb_page_start') && (int)Tools::getValue('kb_page_start') > 0) {
            $start = Tools::getValue('kb_page_start');
        }
        
        /*
        * Start- MK made changes on 29-06-18 to get the seller based on the context language.
        */
        $total = KbSeller::getFavouriteSellers(true, true, null, null, null, null, true, true, Context::getContext()->language->id);
        /*
        * End- MK made changes on 29-06-18 to get the seller based on the context language.
        */

        if ($total > 0) {
            $paging = KbGlobal::getPaging($total, $start, $this->page_limit, false, 'getSellerList');

            $orderby = null;
            if (Tools::getIsset('orderby') && Tools::getValue('orderby') != '') {
                $orderby = Tools::getValue('orderby');
            }

            $orderway = null;
            if (Tools::getIsset('orderway') && Tools::getValue('orderway') != '') {
                $orderway = Tools::getValue('orderway');
            }

            $sellers = KbSeller::getFavouriteSellers(
                false,
                true,
                $paging['page_position'],
                $this->page_limit,
                $orderby,
                $orderway,
                true,
                true,
                Context::getContext()->language->id // MK made changes on 29-08-18 to get seller based on context language
            );

            $base_link = KbGlobal::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'));
            $profile_default_image_path = $base_link . 'modules/' . $this->module->name . '/' . 'views/img/';
            foreach ($sellers as $key => $val) {
                $seller_image_path = _PS_IMG_DIR_ . KbSeller::SELLER_PROFILE_IMG_PATH . $val['id_seller'] . '/';
                if (empty($val['logo'])
                    || !Tools::file_exists_no_cache($seller_image_path . $val['logo'])) {
                    $sellers[$key]['logo'] = $profile_default_image_path . KbGlobal::SELLER_DEFAULT_LOGO;
                } else {
                    $sellers[$key]['logo'] = $this->seller_image_path . $val['id_seller'] . '/' . $val['logo'];
                }

                if ($val['title'] == '' || empty($val['title'])) {
                    $sellers[$key]['title'] = $this->module->l('Not Mentioned', 'sellerfront');
                }

                $sellers[$key]['href'] = KbGlobal::getSellerLink($val['id_seller']);

                $review_setting = KbSellerSetting::getSellerSettingByKey(
                    $val['id_seller'],
                    'kbmp_enable_seller_review'
                );

                if ($review_setting == 1) {
                    $sellers[$key]['display_write_review'] = true;
                } else {
                    $sellers[$key]['display_write_review'] = false;
                }

                $sellers[$key]['view_review_href'] = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array('render_type' => 'sellerreviews', 'id_seller' => $val['id_seller'])
                );

                if ((int)$val['total_review'] > 0) {
                    $tmp = (int)$val['total_review'];
                    $sellers[$key]['rating_percent'] = (float)((($val['rating'] / $tmp) / 5) * 100);
                } else {
                    $sellers[$key]['rating_percent'] = 0;
                }
            }

            $this->context->smarty->assign('sellers', $sellers);

            $pagination_string = sprintf(
                $this->module->l('Showing %d - %d of %d items', 'sellerfront'),
                $paging['paging_summary']['record_start'],
                $paging['paging_summary']['record_end'],
                $total
            );
            $this->context->smarty->assign('pagination_string', $pagination_string);
            $this->context->smarty->assign('kb_pagination', $paging);
            $this->context->smarty->assign(
                'seller_reviews',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array('render_type' => 'sellerreviews'),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                )
            );

            $sorting_types = array(
                array('value' => 'sl.title:asc', 'label' => $this->module->l('Name: A to Z', 'sellerfront')),
                array('value' => 'sl.title:desc', 'label' => $this->module->l('Name: Z to A', 'sellerfront')),
                array(
                    'value' => 'rating:asc',
                    'label' => $this->module->l('Rating: Low to High', 'sellerfront')
                ),
                array(
                    'value' => 'rating:desc',
                    'label' => $this->module->l('Rating: High to Low', 'sellerfront')
                ),
                array(
                    'value' => 'total_review:asc',
                    'label' => $this->module->l('Review: Lowest', 'sellerfront')
                ),
                array(
                    'value' => 'total_review:desc',
                    'label' => $this->module->l('Review: Highest', 'sellerfront')
                )
            );

            $this->context->smarty->assign('sorting_types', $sorting_types);
            $this->context->smarty->assign('selected_sort', $orderby . ':' . $orderway);
        } else {
            $this->context->smarty->assign(
                'empty_list',
                $this->module->l('You Have Not Marked any Seller as Favourite Yet. ', 'sellerfront')
            );
        }
        $this->context->smarty->assign('ajaxurl', $this->context->link->getModuleLink('kbmarketplace', 'ajaxhandler', array(), (bool) Configuration::get('PS_SSL_ENABLED')));
        $is_enabled_seller_shortlisting = 0;
        $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (isset($config['enable_seller_shortlisting']) && $config['enable_seller_shortlisting'] == 1) {
            $is_enabled_seller_shortlisting = 1;
        }
        $this->context->smarty->assign('is_enabled_seller_shortlisting', $is_enabled_seller_shortlisting);
        $this->context->smarty->assign('is_favourite_seller_page', 1);
        $this->setKbTemplate('seller/list_to_customers.tpl');
    }

    public function getAjaxSellerListHtml()
    {
        $start = 1;
        if (Tools::getIsset('start') && (int)Tools::getValue('start') > 0) {
            $start = Tools::getValue('start');
        }
        
        /*
        * Start- MK made changes on 29-06-18 to get the seller based on the context language.
        */
        $total = KbSeller::getFavoriteSellers(true, true, null, null, null, null, true, true, Context::getContext()->language->id);
        /*
        * End- MK made changes on 29-06-18 to get the seller based on the context language.
        */

        if ($total > 0) {
            $paging = KbGlobal::getPaging($total, $start, $this->page_limit, false, 'getSellerList');

            $orderby = null;
            if (Tools::getIsset('orderby') && Tools::getValue('orderby') != '') {
                $orderby = Tools::getValue('orderby');
            }

            $orderway = null;
            if (Tools::getIsset('orderway') && Tools::getValue('orderway') != '') {
                $orderway = Tools::getValue('orderway');
            }

            $sellers = KbSeller::getFavouriteSellers(
                false,
                true,
                $paging['page_position'],
                $this->page_limit,
                $orderby,
                $orderway,
                true,
                true,
                Context::getContext()->language->id // MK made changes on 29-08-18 to get seller based on context language
            );

            foreach ($sellers as $key => $val) {
                $base_link = KbGlobal::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'));
                $profile_default_image_path = $base_link . 'modules/' . $this->module->name . '/' . 'views/img/';
                $seller_image_path = _PS_IMG_DIR_ . KbSeller::SELLER_PROFILE_IMG_PATH . $val['id_seller'] . '/';
                if (empty($val['logo'])
                    || !Tools::file_exists_no_cache($seller_image_path . $val['logo'])) {
                    $sellers[$key]['logo'] = $profile_default_image_path . KbGlobal::SELLER_DEFAULT_LOGO;
                } else {
                    $sellers[$key]['logo'] = $this->seller_image_path . $val['id_seller'] . '/' . $val['logo'];
                }

                if ($val['title'] == '' || empty($val['title'])) {
                    $sellers[$key]['title'] = $this->module->l('Not Mentioned', 'sellerfront');
                }

                $sellers[$key]['href'] = KbGlobal::getSellerLink($val['id_seller']);

                $review_setting = KbSellerSetting::getSellerSettingByKey(
                    $val['id_seller'],
                    'kbmp_enable_seller_review'
                );

                if ($review_setting == 1) {
                    $sellers[$key]['display_write_review'] = true;
                } else {
                    $sellers[$key]['display_write_review'] = false;
                }

                $sellers[$key]['view_review_href'] = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array('render_type' => 'sellerreviews', 'id_seller' => $val['id_seller'])
                );

                if ((int)$val['total_review'] > 0) {
                    $tmp = (int)$val['total_review'];
                    $sellers[$key]['rating_percent'] = (float)((($val['rating'] / $tmp) / 5) * 100);
                } else {
                    $sellers[$key]['rating_percent'] = 0;
                }
            }

            $this->context->smarty->assign('sellers', $sellers);
            $pagination_string = sprintf(
                $this->module->l('Showing %d - %d of %d items', 'sellerfront'),
                $paging['paging_summary']['record_start'],
                $paging['paging_summary']['record_end'],
                $total
            );
            $this->json['pagination_string'] = $pagination_string;
            $this->json['kb_pagination'] = $paging;
            $this->context->smarty->assign('ajaxurl', $this->context->link->getModuleLink('kbmarketplace', 'ajaxhandler', array(), (bool) Configuration::get('PS_SSL_ENABLED')));
            $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            $is_enabled_seller_shortlisting = 0;
            if (isset($config['enable_seller_shortlisting']) && $config['enable_seller_shortlisting'] == 1) {
                $is_enabled_seller_shortlisting = 1;
            }
            $this->context->smarty->assign('is_favourite_seller_page', 1);
            $this->context->smarty->assign('is_enabled_seller_shortlisting', $is_enabled_seller_shortlisting);
            $this->setKbTemplate('seller/seller_list.tpl');
            
            return $this->fetchTemplate();
        }
    }
    
    private function prepareProductForTemplate(array $rawProduct)
    {
        $pro_assembler = new ProductAssembler($this->context);
        $product = $pro_assembler->assembleProduct($rawProduct);

        $factory = new ProductPresenterFactory($this->context, new TaxConfiguration());
        $presenter = $factory->getPresenter();
        $settings = $factory->getPresentationSettings();

        return $presenter->present(
            $settings,
            $product,
            $this->context->language
        );
    }
    
    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();

        $id_seller = Tools::getValue('id_seller', 0);
        if ($id_seller > 0) {
            $seller = new KbSeller($id_seller);
            if (isset($seller->meta_keyword[$this->context->language->id])
            && !empty($seller->meta_keyword[$this->context->language->id])) {
                $page['meta']['keywords'] = Tools::safeOutput($seller->meta_keyword[$this->context->language->id], false);
            }
            
            if (isset($seller->meta_description[$this->context->language->id])
            && !empty($seller->meta_description[$this->context->language->id])) {
                $page['meta']['description'] = Tools::safeOutput($seller->meta_description[$this->context->language->id], false);
            }
            unset($seller);
        } else {
            $global_settings = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (isset($global_settings['kbmp_seller_listing_meta_keywords'])
            && !empty($global_settings['kbmp_seller_listing_meta_keywords'])) {
                $page['meta']['keywords'] = Tools::safeOutput($global_settings['kbmp_seller_listing_meta_keywords'], false);
            }
            
            if (isset($global_settings['kbmp_seller_listing_meta_description'])
            && !empty($global_settings['kbmp_seller_listing_meta_description'])) {
                $page['meta']['description'] = Tools::safeOutput($global_settings['kbmp_seller_listing_meta_description'], false);
            }
            unset($global_settings);
        }
        return $page;
    }
}
