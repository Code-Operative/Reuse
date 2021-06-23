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
include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/KbMpCustomFields.php');
include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/KbMpCustomFieldSellerMapping.php');

class KbmarketplaceSellerfrontModuleFrontController extends KbmarketplaceFrontCoreModuleFrontController
{
    public $controller_name = 'sellerfront';
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
        $this->addCSS($this->getKbModuleDir() . 'views/css/front/kb-forms.css');
        if (Tools::getIsset('render_type')
            && (Tools::getValue('render_type') == 'sellerview'
            || Tools::getValue('render_type') == 'sellerproducts')) {
            $this->addCSS(_THEME_CSS_DIR_ . 'product_list.css');
        }
        $this->addJS(_THEME_JS_DIR_ . 'category.js');
    }

    public function downloadFile($field_id)
    {
        // clean buffer
        if (ob_get_level() && ob_get_length() > 0) {
            ob_clean();
        }
        $id_seller = Tools::getValue('id_seller');
        $id_field = $field_id;
        $id_mapping = KbMpCustomFieldSellerMapping::getIDBySellerAndField($id_seller, $id_field);
        $mapping = new KbMpCustomFieldSellerMapping($id_mapping);
        $file = Tools::jsonDecode($mapping->value, true);
        if (!empty($file) && is_array($file)) {
            if (isset($file['type'])) {
                $path = $file['path'];
                if (Tools::file_exists_no_cache($file['path'])) {
                    header('Content-type:' . $file['type']);
                    header('Content-Type: application/force-download; charset=UTF-8');
                    header('Cache-Control: no-store, no-cache');
                    header('Content-disposition: attachment; filename=' . time() . '.' . $file['extension']);
                    readfile($path);
                    exit;
                } else {
                    Tools::redirect(
                        $this->context->link->getModuleLink(
                            $this->kb_module_name,
                            $this->controller_name,
                            array(),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        )
                    );
                }
            } else {
                Tools::redirect(
                    $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    )
                );
            }
        }
    }
    
    public function postProcess()
    {
        if (Tools::getValue('downloadFile')) {
            if (Tools::getValue('id_field') != '') {
                $this->downloadFile(Tools::getValue('id_field'));
            }
        }
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
                        $this->module->l('Your request has been processed.', 'sellerfront')
                    );
                    Tools::redirect($this->context->link->getModuleLink($this->module->name, 'sellerfront'));
                }
            } else {
                $this->context->cookie->__set(
                    'redirect_error',
                    $this->module->l('Your request cannot be processed.', 'sellerfront')
                );
                Tools::redirect(Context::getContext()->link->getModuleLink($this->module->name, 'gdpr'));
            }
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Your request cannot be processed.', 'sellerfront')
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
                    $this->module->l('We have sent you a confirmation email. Please click on the link provided in the email to confirm your request. Once this is confirmed we will proceed with your request.', 'sellerfront')
                );
                Tools::redirect(KbGlobal::getSellerLink($id_seller));
            }
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('You have already request for personal data. Please click on the link provided in the email to confirm your request.', 'sellerfront')
            );
            Tools::redirect(KbGlobal::getSellerLink($id_seller));
        }
    }

    public function initContent()
    {

        $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Tools::getIsset('render_type')) {
            if (Tools::getValue('render_type') == 'sellerview' && $config['kbmp_show_seller_on_front']) {
                $this->renderViewToCustomer();
            } elseif (Tools::getValue('render_type') == 'sellerreviews' && $config['kbmp_show_seller_on_front']) {
                $this->renderReviewToCustomer();
            } elseif (Tools::getValue('render_type') == 'sellerproducts' && $config['kbmp_show_seller_on_front']) {
                $this->renderSellersProducts();
            } else {
                $this->context->cookie->__set(
                    'redirect_error',
                    $this->module->l('Currently, You are not authorized to view sellers.', 'sellerfront')
                );
            }
        } else {
            if ($config['kbmp_show_seller_on_front']) {
                $this->renderSellerList();
            } else {
                $this->context->cookie->__set(
                    'redirect_error',
                    $this->module->l('Currently, You are not authorized to view sellers.', 'sellerfront')
                );
            }
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
        
        if (Tools::isSubmit('new_review_submit') && Tools::getValue('new_review_submit') == 1) {
            $id_seller = Tools::getValue('id_seller', 0);
            $seller = new KbSeller($id_seller);
            if ($seller->isSeller()) {
                $this->saveNewReview($id_seller);

                $redirect_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                );
                Tools::redirect($redirect_link);
            }
        }
        $start = 1;
        if (Tools::getIsset('kb_page_start') && (int)Tools::getValue('kb_page_start') > 0) {
            $start = Tools::getValue('kb_page_start');
        }
        
        /*
        * Start- MK made changes on 29-06-18 to get the seller based on the context language.
        */
        $total = KbSeller::getSellers(true, true, null, null, null, null, true, true, Context::getContext()->language->id);
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

            $sellers = KbSeller::getSellers(
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
                $this->module->l('No Seller found', 'sellerfront')
            );
        }
        $this->context->smarty->assign('ajaxurl', $this->context->link->getModuleLink('kbmarketplace', 'ajaxhandler', array(), (bool) Configuration::get('PS_SSL_ENABLED')));
        $is_enabled_seller_shortlisting = 0;
        $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (isset($config['enable_seller_shortlisting']) && $config['enable_seller_shortlisting'] == 1) {
            $is_enabled_seller_shortlisting = 1;
        }
        $this->context->smarty->assign('is_enabled_seller_shortlisting', $is_enabled_seller_shortlisting);
        $this->setKbTemplate('seller/list_to_customers.tpl');
    }

    public function renderViewToCustomer()
    {
        $id_seller = Tools::getValue('id_seller', 0);
        if ((int)$id_seller > 0) {
            $seller = new KbSeller($id_seller);
            if ($seller->isSeller()) {
                if (Tools::isSubmit('new_review_submit') && Tools::getValue('new_review_submit') == 1) {
                    $this->saveNewReview($id_seller);

                    $redirect_link = KbGlobal::getSellerLink($id_seller);

                    Tools::redirect($redirect_link);
                }
                
                /*
                * Start- MK made changes on 29-06-18 to get the seller information based on the context language.
                */
                $seller_info = $seller->getSellerInfo(Context::getContext()->language->id);
                /*
                * End- MK made changes on 29-06-18 to get the seller information based on the context language.
                */
                $base_link = KbGlobal::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'));
                $profile_default_image_path = $base_link . 'modules/' . $this->module->name . '/' . 'views/img/';
                $seller_image_path = _PS_IMG_DIR_ . KbSeller::SELLER_PROFILE_IMG_PATH . $id_seller . '/';
                if (empty($seller_info['logo'])
                    || !Tools::file_exists_no_cache($seller_image_path . $seller_info['logo'])) {
                    $seller_info['logo'] = $profile_default_image_path . KbGlobal::SELLER_DEFAULT_LOGO;
                } else {
                    $seller_info['logo'] = $this->seller_image_path . $id_seller . '/' . $seller_info['logo'];
                }

                if (empty($seller_info['banner'])
                    || !Tools::file_exists_no_cache($seller_image_path . $seller_info['banner'])) {
                    $seller_info['banner'] = $profile_default_image_path . KbGlobal::SELLER_DEFAULT_BANNER;
                } else {
                    $seller_info['banner'] = $this->seller_image_path . $id_seller . '/' . $seller_info['banner'];
                }

                $review_count = KbSellerReview::getReviewsBySellerId(
                    $id_seller,
                    $this->context->language->id,
                    KbGlobal::APPROVED,
                    true
                );

                $seller_info['seller_review_count'] = sprintf(
                    $this->module->l('Total %s review(s)', 'sellerfront'),
                    $review_count
                );

                $rating = KbGlobal::convertRatingIntoPercent(KbSellerReview::getSellerRating($id_seller));
                $rating = number_format($rating, 2);
                $seller_info['seller_rating'] = $rating;

                $state_name = '';
                if (!empty($seller_info['state'])) {
                    $state_name = $seller_info['state'];
                }

                $country_name = '';
                if (!empty($seller_info['id_country'])) {
                    $country_name = Country::getNameById($this->context->language->id, $seller_info['id_country']);
                }

                $seller_info['state'] = $state_name;
                $seller_info['country'] = $country_name;
                $this->context->smarty->assign('seller', $seller_info);

                $id_category = Tools::getValue('s_filter_category', '');
                $filters = array();

                if ((int)$id_category > 0) {
                    $filters['id_category'] = (int)$id_category;
                }

                $this->context->smarty->assign('selected_category', $id_category);

                $total_records = KbSellerProduct::getProductsWithDetails(
                    $id_seller,
                    $this->context->language->id,
                    $filters,
                    true
                );

                $sort_by = array('by' => 'pl.name', 'way' => 'ASC');
                $seleted_sort = '';
                if (Tools::getIsset('s_filter_sortby') && Tools::getValue('s_filter_sortby')) {
                    $seleted_sort = Tools::getValue('s_filter_sortby');
                    $explode = explode(':', Tools::getValue('s_filter_sortby'));
                    $sort_by['by'] = $explode[0];
                    $sort_by['way'] = $explode[1];
                }

                $this->context->smarty->assign('selected_sort', $seleted_sort);

                $start = 1;
                if ((int)Tools::getValue('page_number', 0) > 0) {
                    $start = (int)Tools::getValue('page_number', 0);
                }

                $this->context->smarty->assign('seller_product_current_page', $start);

                $paging = KbGlobal::getPaging($total_records, $start, $this->page_limit, false, 'getSProduct2User');

                $products = KbSellerProduct::getProductsWithDetails(
                    $id_seller,
                    $this->context->language->id,
                    $filters,
                    false,
                    $paging['page_position'],
                    $this->page_limit,
                    $sort_by['by'],
                    $sort_by['way']
                );

                $products = Product::getProductsProperties((int)$this->context->language->id, $products);
                
                $products = array_map(array($this, 'prepareProductForTemplate'), $products);

                $this->context->smarty->assign('products', $products);

                if ($products && count($products) > 0) {
                    $pagination_string = sprintf(
                        $this->module->l('Showing %d - %d of %d items', 'sellerfront'),
                        $paging['paging_summary']['record_start'],
                        $paging['paging_summary']['record_end'],
                        $total_records
                    );

                    $this->context->smarty->assign('pagination_string', $pagination_string);
                }

                $this->context->smarty->assign('kb_pagination', $paging);

                $this->context->smarty->assign(
                    'filter_form_action',
                    KbGlobal::getSellerLink($id_seller)
                );

                $review_setting = KbSellerSetting::getSellerSettingByKey($id_seller, 'kbmp_enable_seller_review');
                if ($review_setting == 1) {
                    $this->context->smarty->assign('display_new_review', true);
                    $this->context->smarty->assign('display_review_popup', true);
                } else {
                    $this->context->smarty->assign('display_new_review', false);
                }

                $this->context->smarty->assign('category_list', $this->getCategoryList());
                $gdpr_enabled = $this->getGDPRSettings('enable_gdpr');
                $this->context->smarty->assign('gdpr_enabled', $gdpr_enabled);
                $this->context->smarty->assign('gdpr_controller_link', $this->context->link->getModuleLink($this->module->name, 'gdpr'));
                // changes by rishabh jain for seller shortlisting
                $is_enabled_seller_shortlisting = 0;
                $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                if (isset($config['enable_seller_shortlisting']) && $config['enable_seller_shortlisting'] == 1) {
                    $is_enabled_seller_shortlisting = 1;
                }
                if ($this->context->cookie->velsof_shortlist_seller != '') {
                    $already_added = explode(',', $this->context->cookie->velsof_shortlist_seller);
                } else {
                    $already_added = array();
                }
                if (in_array($id_seller, $already_added)) {
                    $this->context->smarty->assign('is_already_added', 1);
                } else {
                    $this->context->smarty->assign('is_already_added', 0);
                }
                // changes by rishabh jain for showing custom field data
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
                    if ((int) $avialable_field['show_seller_profile'] == 1) {
                        if (is_array($kb_field_value) && !empty($kb_field_value)) {
                            if (isset($kb_field_value[$avialable_field['id_field']]['id_field'])) {
                                if ($kb_field_value[$avialable_field['id_field']]['id_field'] == $avialable_field['id_field']) {
                                    $kb_final_field[$key] = $avialable_field;
                                    $kb_final_field[$key]['customer_value'] = $kb_field_value[$avialable_field['id_field']]['value'];
                                }
                            }
                        }
                    }
                }
                // changes over
                $this->context->smarty->assign(array(
                    'module_path' => $this->context->link->getModuleLink(
                        'kbmarketplace',
                        'sellerfront',
                        array(
                            'downloadFile' => true,
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    ),
                    'kb_available_field' => $kb_final_field,
                    'id_seller' => $id_seller,
                    // chanegs by rishabh jain for seller shortlisting
                    'is_enabled_seller_shortlisting' => $is_enabled_seller_shortlisting,
                    'ajaxurl' => $this->context->link->getModuleLink('kbmarketplace', 'ajaxhandler', array(), (bool) Configuration::get('PS_SSL_ENABLED')),
                    // changes over
                ));
                // changes over
                
                $this->setKbTemplate('seller/seller_view_to_customer.tpl');
            }
        }
    }

    public function renderReviewToCustomer()
    {
        $id_seller = Tools::getValue('id_seller', 0);
        if ((int)$id_seller > 0) {
            $seller = new KbSeller($id_seller);
            if ($seller->isSeller()) {
                if (Tools::isSubmit('new_review_submit') && Tools::getValue('new_review_submit') == 1) {
                    $this->saveNewReview($id_seller);

                    $redirect_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array('render_type' => 'sellerreviews', 'id_seller' => $id_seller),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    );

                    Tools::redirect($redirect_link);
                }

                $this->page_limit = 20;
                /*
                * Start- MK made changes on 29-06-18 to get the seller information based on the context language.
                */
                $seller_info = $seller->getSellerInfo(Context::getContext()->language->id);
                /*
                * End- MK made changes on 29-06-18 to get the seller information based on the context language.
                */
                $base_link = KbGlobal::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'));
                $profile_default_image_path = $base_link . 'modules/' . $this->module->name . '/' . 'views/img/';
                $seller_image_path = _PS_IMG_DIR_ . KbSeller::SELLER_PROFILE_IMG_PATH . $id_seller . '/';
                if (empty($seller_info['logo'])
                    || !Tools::file_exists_no_cache($seller_image_path . $seller_info['logo'])) {
                    $seller_info['logo'] = $profile_default_image_path . KbGlobal::SELLER_DEFAULT_LOGO;
                } else {
                    $seller_info['logo'] = $this->seller_image_path . $id_seller . '/' . $seller_info['logo'];
                }

                if (empty($seller_info['banner'])
                    || !Tools::file_exists_no_cache($seller_image_path . $seller_info['banner'])) {
                    $seller_info['banner'] = $profile_default_image_path . KbGlobal::SELLER_DEFAULT_BANNER;
                } else {
                    $seller_info['banner'] = $this->seller_image_path . $id_seller . '/' . $seller_info['banner'];
                }

                $review_count = KbSellerReview::getReviewsBySellerId(
                    $id_seller,
                    $this->context->language->id,
                    KbGlobal::APPROVED,
                    true
                );

                $seller_info['seller_review_count'] = sprintf(
                    $this->module->l('Total %s review(s)', 'sellerfront'),
                    $review_count
                );

                $rating = KbGlobal::convertRatingIntoPercent(KbSellerReview::getSellerRating($id_seller));
                $rating = number_format($rating, 2);
                $seller_info['seller_rating'] = $rating;

                $seller_info['is_review_page'] = true;
                $this->context->smarty->assign('seller', $seller_info);

                if ($review_count > 0) {
                    $start = 1;
                    if ((int)Tools::getValue('page_number', 0) > 0) {
                        $start = (int)Tools::getValue('page_number', 0);
                    }

                    $paging = KbGlobal::getPaging($review_count, $start, $this->page_limit, false, 'getSReview2User');

                    $reviews = KbSellerReview::getReviewsBySellerId(
                        $id_seller,
                        $this->context->language->id,
                        KbGlobal::APPROVED,
                        false,
                        false,
                        $paging['page_position'],
                        $this->page_limit
                    );

                    foreach ($reviews as $key => $rev) {
                        $reviews[$key]['title']   = Tools::htmlentitiesDecodeUTF8($rev['title']);
                        $reviews[$key]['comment'] = Tools::htmlentitiesDecodeUTF8($rev['comment']);
                    }
                    $this->context->smarty->assign('reviews', $reviews);
                    $this->context->smarty->assign('kb_pagination', $paging);
                }

                $review_setting = KbSellerSetting::getSellerSettingByKey($id_seller, 'kbmp_enable_seller_review');
                if ($review_setting == 1) {
                    $this->context->smarty->assign('display_new_review', true);
                    $this->context->smarty->assign('display_review_popup', false);
                } else {
                    $this->context->smarty->assign('display_new_review', false);
                }

                $state_name = '';
                if (!empty($seller_info['state'])) {
                    $state_name = $seller_info['state'];
                }

                $country_name = '';
                if (!empty($seller_info['id_country'])) {
                    $country_name = Country::getNameById($this->context->language->id, $seller_info['id_country']);
                }

                $seller_info['state'] = $state_name;
                $seller_info['country'] = $country_name;

                $this->context->smarty->assign('seller', $seller_info);
                $gdpr_enabled = $this->getGDPRSettings('enable_gdpr');
                $this->context->smarty->assign('gdpr_enabled', $gdpr_enabled);
                $this->context->smarty->assign('filter_form_action', KbGlobal::getSellerLink($id_seller));
                $this->context->smarty->assign('gdpr_controller_link', $this->context->link->getModuleLink($this->module->name, 'gdpr'));
                $this->context->smarty->assign('ajaxurl', $this->context->link->getModuleLink('kbmarketplace', 'ajaxhandler', array(), (bool) Configuration::get('PS_SSL_ENABLED')));
                $is_enabled_seller_shortlisting = 0;
                $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                if (isset($config['enable_seller_shortlisting']) && $config['enable_seller_shortlisting'] == 1) {
                    $is_enabled_seller_shortlisting = 1;
                }
                $this->context->smarty->assign('is_enabled_seller_shortlisting', $is_enabled_seller_shortlisting);
                $this->setKbTemplate('seller/seller_reviews_to_customer.tpl');
            }
        }
    }

    protected function saveNewReview($id_seller)
    {
        if (Configuration::get('KB_MP_ENABLE_SELLER_REVIEW') != 1) {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Review can not be submitted as this feature is disabled by Admin.', 'sellerfront')
            );
            return;
        }
        if (Tools::getValue('review_title') != strip_tags(Tools::getValue('review_title'))) {
            $title = strip_tags(Tools::getValue('review_title'));
        } else {
            $title = Tools::getValue('review_title');
        }
        if (Tools::getValue('review_content') != strip_tags(Tools::getValue('review_content'))) {
            $comment = strip_tags(Tools::getValue('review_content'));
        } else {
            $comment = Tools::getValue('review_content');
        }
        $rating = (int)Tools::getValue('review_rating');
        $new_review = new KbSellerReview();
        $new_review->title = $title;
        $new_review->comment = $comment;
        $new_review->rating = $rating;
        $new_review->id_seller = $id_seller;
        $new_review->id_customer = (int)$this->context->customer->id;
        $new_review->id_shop = $this->context->shop->id;
        $new_review->id_lang = $this->context->language->id;
        $approved = KbSellerSetting::getSellerSettingByKey($id_seller, 'kbmp_seller_review_approval_required');
        if ($approved == 1) {
            $new_review->approved = (string)KbGlobal::APPROVAL_WAITING;
        } else {
            $new_review->approved = (string)KbGlobal::APPROVED;
        }

        $this->sendNewReviewMail($id_seller, $new_review->approved);

        if ($new_review->save()) {
            if ($approved == 1) {
                $this->context->cookie->__set(
                    'redirect_success',
                    $this->module->l('Your review has been submitted successfully. It will be shown after approval.', 'sellerfront')
                );
            } else {
                $this->context->cookie->__set(
                    'redirect_success',
                    $this->module->l('Your review has been submitted successfully.', 'sellerfront')
                );
            }
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('At this time, system not able to save new review. Please try again later', 'sellerfront')
            );
        }
    }

    protected function sendNewReviewMail($id_seller, $approved)
    {
        $seller = new KbSeller($id_seller);
        $seller_info = $seller->getSellerInfo();
        if (Tools::getValue('review_title') != strip_tags(Tools::getValue('review_title'))) {
            $review_title = strip_tags(Tools::getValue('review_title'));
        } else {
            $review_title = Tools::getValue('review_title');
        }
        if (Tools::getValue('review_content') != strip_tags(Tools::getValue('review_content'))) {
            $review_content = strip_tags(Tools::getValue('review_content'));
        } else {
            $review_content = Tools::getValue('review_content');
        }
        $custom_ssl_var = 0;
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $custom_ssl_var = 1;
        }
        if ((bool) Configuration::get('PS_SSL_ENABLED') && $custom_ssl_var == 1) {
            $uri_path = _PS_BASE_URL_SSL_ . __PS_BASE_URI__;
        } else {
            $uri_path = _PS_BASE_URL_ . __PS_BASE_URI__;
        }

        $template_vars = array(
            '{{seller_name}}' => $seller_info['seller_name'],
            '{{seller_email}}' => $seller_info['email'],
            '{{shop_title}}' => $seller_info['title'],
            '{{seller_contact}}' => $seller_info['phone_number'],
            '{{review_title}}' => $review_title,
            '{{review_comment}}' => $review_content,
            '{shop_url}' => $uri_path
        );
        if ($approved == KbGlobal::APPROVAL_WAITING) {
            //send email to admin for approval
            $email = new KbEmail(
                KbEmail::getTemplateIdByName('mp_seller_review_approval_request_admin'),
                $seller_info['id_default_lang']
            );
            $email->send(
                Configuration::get('PS_SHOP_EMAIL'),
                Configuration::get('PS_SHOP_NAME'),
                null,
                $template_vars
            );
        }

        //send email to Seller
        $email = new KbEmail(
            KbEmail::getTemplateIdByName('mp_seller_review_notification'),
            $seller_info['id_default_lang']
        );
        $notification_emails = $seller->getEmailIdForNotification();
        foreach ($notification_emails as $em) {
            $email->send(($em['email']), ($em['title']), null, $template_vars);
        }
    }

    public function renderSellersProducts()
    {
        $id_seller = Tools::getValue('id_seller', 0);
        if ((int)$id_seller > 0) {
            $seller = new KbSeller($id_seller);
            if ($seller->isSeller()) {
                /*
                * Start- MK made changes on 29-06-18 to get the seller information based on the context language.
                */
                $seller_info = $seller->getSellerInfo(Context::getContext()->language->id);
                /*
                * End- MK made changes on 29-06-18 to get the seller information based on the context language.
                */
                $title = sprintf($this->module->l('Seller Shop - %s', 'sellerfront'), $seller_info['title']);
                $this->context->smarty->assign('kb_page_title', $title);
                $id_category = Tools::getValue('s_filter_category', '');
                $filters = array();

                if ((int)$id_category > 0) {
                    $filters['id_category'] = (int)$id_category;
                }

                $this->context->smarty->assign('selected_category', $id_category);

                $total_records = KbSellerProduct::getProductsWithDetails(
                    $id_seller,
                    $this->context->language->id,
                    $filters,
                    true
                );

                $sort_by = array('by' => 'pl.name', 'way' => 'ASC');
                $seleted_sort = '';
                if (Tools::getIsset('s_filter_sortby') && Tools::getValue('s_filter_sortby')) {
                    $seleted_sort = Tools::getValue('s_filter_sortby');
                    $explode = explode(':', Tools::getValue('s_filter_sortby'));
                    $sort_by['by'] = $explode[0];
                    $sort_by['way'] = $explode[1];
                }

                $this->context->smarty->assign('selected_sort', $seleted_sort);

                $start = 1;
                if ((int)Tools::getValue('page_number', 0) > 0) {
                    $start = (int)Tools::getValue('page_number', 0);
                }

                $this->context->smarty->assign('seller_product_current_page', $start);

                $paging = KbGlobal::getPaging($total_records, $start, $this->page_limit, false, 'getSProduct2User');

                $products = KbSellerProduct::getProductsWithDetails(
                    $id_seller,
                    $this->context->language->id,
                    $filters,
                    false,
                    $paging['page_position'],
                    $this->page_limit,
                    $sort_by['by'],
                    $sort_by['way']
                );

                $products = Product::getProductsProperties((int)$this->context->language->id, $products);
                $products = array_map(array($this, 'prepareProductForTemplate'), $products);

                $this->context->smarty->assign('products', $products);

                if ($products && count($products) > 0) {
                    $pagination_string = sprintf(
                        $this->module->l('Showing %d - %d of %d items', 'sellerfront'),
                        $paging['paging_summary']['record_start'],
                        $paging['paging_summary']['record_end'],
                        $total_records
                    );

                    $this->context->smarty->assign('pagination_string', $pagination_string);
                }

                $this->context->smarty->assign('kb_pagination', $paging);

                $this->context->smarty->assign(
                    'filter_form_action',
                    $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array('render_type' => 'sellerproducts', 'id_seller' => $id_seller),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    )
                );

                $this->context->smarty->assign('category_list', $this->getCategoryList());
                $this->context->smarty->assign('ajaxurl', $this->context->link->getModuleLink('kbmarketplace', 'ajaxhandler', array(), (bool) Configuration::get('PS_SSL_ENABLED')));
                $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                $is_enabled_seller_shortlisting = 0;
                if (isset($config['enable_seller_shortlisting']) && $config['enable_seller_shortlisting'] == 1) {
                    $is_enabled_seller_shortlisting = 1;
                }
                
                $this->context->smarty->assign('is_enabled_seller_shortlisting', $is_enabled_seller_shortlisting);
                $this->setKbTemplate('seller/products_to_customer.tpl');
            }
        }
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
        $total = KbSeller::getSellers(true, true, null, null, null, null, true, true, Context::getContext()->language->id);
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

            $sellers = KbSeller::getSellers(
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
            $this->context->smarty->assign('link', $this->context->link);
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
