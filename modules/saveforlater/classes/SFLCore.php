<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store.
 *
 * @author    knowband.com <support@knowband.com>
 * @copyright 2017 Knowband
 * @license   see file: LICENSE.txt
 * @category  PrestaShop Module
 */

class SFLCore extends Module
{

    const SFL_MODEL_NAME = 'kb_sfl';
    const MODULE_KEY = 'saveforlater1234';

    /* Recommendation Options */
    const SFL_BANNER = 1;
    const SFL_RELATED = 2;
    const SFL_SEL_PRODUCTS = 3;

    /* Banner Parameters */
    const BANNER_PATH = 'views/img/banner/';
    const DEFAULT_BANNER_FILE = 'sfl_default_banner.jpg';

    /*
     * Maximum size of banner upload
     * 500kb
     */
    const MAX_UPLOAD_SIZE = 512000;
    const BANNER_WIDTH = 400;
    const BANNER_HEIGHT = 160;
    const SFL_TBL_LIMIT = 10;
    /*
     * use "left" to display pagination on left side
     */
    const PAGINATION_ALIGN = 'right';
    const REPORT_LOCATION = 'reports/';

    public function __construct()
    {
        parent::__construct();

        if (!Configuration::get('KB_SAVE_LATER')) {
            $this->warning = $this->l('No name provided', 'sflcore');
        }
    }

    public function install()
    {
        if (!parent::install() ||
            !$this->registerHook('displayTop') ||
            !$this->registerHook('header') ||
            !$this->registerHook('displayOrderConfirmation') ||
            !$this->registerHook('actionCustomerLogoutBefore') ||
            !$this->registerHook('displayProductButtons') ||
            !$this->registerHook('actionExportGDPRData') ||
            !$this->registerHook('actionDeleteGDPRCustomer') ||
            !$this->registerHook('displayProductPriceBlock')) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() ||
            !Configuration::deleteByName('KB_SAVE_LATER') ||
            !$this->unregisterHook('displayTop') ||
            !$this->unregisterHook('header') ||
            !$this->unregisterHook('displayProductPriceBlock') ||
            !$this->unregisterHook('displayProductButtons') ||
            !$this->unregisterHook('actionCustomerLogoutBefore') ||
            !$this->unregisterHook('actionExportGDPRData') ||
            !$this->unregisterHook('actionDeleteGDPRCustomer') ||
            !$this->unregisterHook('displayOrderConfirmation')) {
            return false;
        }

        Configuration::deleteByName('KB_SAVE_LATER_RECOMM');

        return true;
    }

    protected function installModel()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . self::SFL_MODEL_NAME . '` (
                `short_id` int(11) NOT NULL AUTO_INCREMENT,
                `id_product` int(10) unsigned NOT NULL,
                `id_customer` int(11) NOT NULL,
                `email` varchar(50) NOT NULL,
                `id_order` int(10) unsigned NULL DEFAULT NULL,
                `id_currency` int(4) NOT NULL,
                `currency_code` varchar(10) NOT NULL,
                `id_shop` int(11) NULL DEFAULT NULL,
                `id_lang` int(11) NULL DEFAULT NULL,
                `date_add` datetime NOT NULL,
                `date_upd` datetime NOT NULL,
                PRIMARY KEY(`short_id`),
                INDEX(`id_product`),
                INDEX(`id_lang`),
                INDEX(`id_shop`),
                INDEX(`id_order`),
                FOREIGN KEY (`id_product`) REFERENCES `' . _DB_NAME_ . '`.`' . _DB_PREFIX_ . 'product`(`id_product`) ON DELETE CASCADE ON UPDATE RESTRICT,
                FOREIGN KEY (`id_order`) REFERENCES `' . _DB_NAME_ . '`.`' . _DB_PREFIX_ . 'orders`(`id_order`) ON DELETE SET NULL ON UPDATE RESTRICT,
                FOREIGN KEY (`id_lang`) REFERENCES `' . _DB_NAME_ . '`.`' . _DB_PREFIX_ . 'lang`(`id_lang`) ON DELETE SET NULL ON UPDATE RESTRICT,
                FOREIGN KEY (`id_shop`) REFERENCES `' . _DB_NAME_ . '`.`' . _DB_PREFIX_ . 'shop`(`id_shop`) ON DELETE SET NULL ON UPDATE RESTRICT
                ) ENGINE=`' . _MYSQL_ENGINE_ . '` DEFAULT CHARSET=utf8';
//                FOREIGN KEY (`id_product`) REFERENCES `'._DB_NAME_.'`.`'._DB_PREFIX_.'product`(`id_product`) ON DELETE CASCADE ON UPDATE RESTRICT,
//                                FOREIGN KEY (`id_order`) REFERENCES `'._DB_NAME_.'`.`'._DB_PREFIX_.'orders`(`id_order`) ON DELETE SET NULL ON UPDATE RESTRICT,
//                                FOREIGN KEY (`id_lang`) REFERENCES `'._DB_NAME_.'`.`'._DB_PREFIX_.'lang`(`id_lang`) ON DELETE SET NULL ON UPDATE RESTRICT,
//                                FOREIGN KEY (`id_shop`) REFERENCES `'._DB_NAME_.'`.`'._DB_PREFIX_.'shop`(`id_shop`) ON DELETE SET NULL ON UPDATE RESTRICT
//                $sql1 = 'ALTER TABLE `'._DB_PREFIX_.self::SFL_MODEL_NAME.'` 
//                        ADD CONSTRAINT `FK_id_product_map` FOREIGN KEY (`id_product`) REFERENCES `'._DB_NAME_.'`.`'._DB_PREFIX_.'product`(`id_product`)
//                        ON DELETE CASCADE, ADD CONSTRAINT `FK_id_lang_map` FOREIGN KEY (`id_lang`) REFERENCES `'._DB_NAME_.'`.`'._DB_PREFIX_.'lang`(`id_lang`) ON DELETE SET NULL, ADD CONSTRAINT `FK_id_shop_map` FOREIGN KEY (`id_shop`) REFERENCES `'._DB_NAME_.'`.`'._DB_PREFIX_.'shop`(`id_shop`) ON DELETE SET NULL, ADD CONSTRAINT `FK_id_order_map` FOREIGN KEY (`id_order`) REFERENCES `'._DB_NAME_.'`.`'._DB_PREFIX_.'orders`(`id_order`) ON DELETE SET NULL';
//                $sql1 = 
//                        'ALTER TABLE '._DB_PREFIX_.self::SFL_MODEL_NAME.'
//                        ADD CONSTRAINT FK_id_product_map
//                        FOREIGN KEY (id_product) REFERENCES '._DB_PREFIX_.'product(id_product)
//                        ON DELETE CASCADE,
//                        ADD CONSTRAINT FK_id_lang_map
//                        FOREIGN KEY (id_lang) REFERENCES '._DB_PREFIX_.'lang(id_lang)
//                        ON DELETE SET NULL,
//                        ADD CONSTRAINT FK_id_shop_map
//                        FOREIGN KEY (id_shop) REFERENCES '._DB_PREFIX_.'shop(id_shop)
//                        ON DELETE SET NULL,
//                        ADD CONSTRAINT FK_id_order_map
//                        FOREIGN KEY (id_order) REFERENCES '._DB_PREFIX_.'orders(id_order)
//                        ON DELETE SET NULL';
//                echo $sql1;
//                ALTER TABLE `ps_kb_sfl` ADD INDEX(`id_product`);
        if (!Db::getInstance()->execute($sql)) {
//			$this->custom_errors[] = 'Installation Failed: Error Occurred while installing models.';
            return false;
        }

        //change made by shubham start
        $sql1 = 'CREATE TABLE if not exists `' . _DB_PREFIX_ . 'kb_sfl_share` (
				`id_customer` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                `token` varchar(50) NOT NULL,
                                `date_add` datetime NOT NULL,
				`date_upd` datetime NOT NULL
				)';

        if (!Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql1)) {
            $this->custom_errors[] = 'Installation Failed: Error Occurred while installing models.';
            return false;
        }
        //change made by shubham end
    }

    protected function getDefaultSettings()
    {
        $settings = array(
            'general' => array(
                'enable' => 0,
                'border_color' => '#dedede',
                'buy_color' => '#134baa',
                'bar_color' => '#e4e4e4',
                'limit' => 3
            ),
            'saveforlater' => array(
                'enable' => 0,
                'enable_buy_btn' => 1,
                'bold' => 0,
                'italic' => 0,
                'color' => '#000000',
                'default_text' => $this->l('My Shortlist', 'sflcore')
            ),
            'recently_view' => array(
                'enable' => 0,
                'enable_buy_btn' => 1,
                'bold' => 0,
                'italic' => 0,
                'color' => '#000000',
                'limit' => $this->getDefaultRecentLimit(),
                'default_text' => $this->l('Recently Viewed', 'sflcore')
            ),
            'recommendation' => array(
                'enable' => 0,
                'enable_buy_btn' => 1,
                'bold' => 0,
                'italic' => 0,
                'color' => '#000000',
                'default_text' => $this->l('Recommendations', 'sflcore')
            ),
            'social_sharing' => array(
                'enable' => 0,
                'facebook' => 0,
                'twitter' => 0,
                'whatsapp' => 0
                
            )
        );
        return $settings;
    }

    public function getDefaultRecentLimit()
    {
        return 10;
    }

    protected function processSettingBeforeSave(&$setting)
    {
        if (!isset($setting['general']['enable'])) {
            $setting['general']['enable'] = 0;
        }
        if (!isset($setting['saveforlater']['enable'])) {
            $setting['saveforlater']['enable'] = 0;
        }
        if (!isset($setting['saveforlater']['enable_buy_btn'])) {
            $setting['saveforlater']['enable_buy_btn'] = 0;
        }
        if (!isset($setting['recently_view']['enable'])) {
            $setting['recently_view']['enable'] = 0;
        }
        if (!isset($setting['recently_view']['enable_buy_btn'])) {
            $setting['recently_view']['enable_buy_btn'] = 0;
        }
        if (!isset($setting['recommendation']['enable'])) {
            $setting['recommendation']['enable'] = 0;
        }
        if (!isset($setting['recommendation']['enable_buy_btn'])) {
            $setting['recommendation']['enable_buy_btn'] = 0;
        }
    }

    protected function getTotalPages($qry, $cols = 'count(*) as total', $use_count = true)
    {
        $total_records = 0;
        if ($use_count) {
            $temp = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(str_replace('{COLUMN}', $cols, $qry));
            if (!empty($temp) && count($temp) > 0) {
                $total_records = (int) $temp['total'];
            }
        } else {
            $temp = Db::getInstance(_PS_USE_SQL_SLAVE_)->getExecuteS(str_replace('{COLUMN}', $cols, $qry));
            if (!empty($temp) && count($temp) > 0) {
                $total_records = (int) count($temp);
            }
        }
        $records = array('total_records' => $total_records, 'total_pages' => ceil($total_records / self::SFL_TBL_LIMIT));
        return $records;
    }

    protected function customPaginator($total_records, $total_pages, $ajaxcallfn = '', $current_page = 1)
    {
        $summary_txt = '';
        $pagination = '';
        if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) {
            $summary_align = 'abd-pagination-left';
            $pagination_align = 'abd-pagination-left';
            if (self::PAGINATION_ALIGN == 'right') {
                $summary_align = 'abd-pagination-left';
                $pagination_align = 'abd-pagination-right';
            }
            $record_start = $current_page;
            $record_end = self::SFL_TBL_LIMIT;
            if ($current_page > 1) {
                $record_start = (($current_page - 1) * self::SFL_TBL_LIMIT) + 1;
                if ($current_page == $total_pages) {
                    $record_end = $total_records;
                } else {
                    $record_end = $current_page * self::SFL_TBL_LIMIT;
                }
            }

            $summary_txt = '<div class="' . $summary_align . ' abd-paginate-summary">
				Showing ' . $record_start . ' to ' . $record_end . ' of ' . $total_records . ' (' . $total_pages . ' pages)</div>';

            $pagination .= '<div class="' . $pagination_align . '"><ul class="abd-pagination">';

            $ajax_call_function = '';
            if ($ajaxcallfn != '') {
                $ajax_call_function .= $ajaxcallfn . '({page_number});';
            }

            $right_links = $current_page + 3;
            $previous = $current_page - 3; //previous link
            $first_link = true; //boolean var to decide our first link

            if ($current_page > 1) {
                $previous_link = ($previous == 0) ? 1 : $previous;
                $pagination .= '<li class="first"><a href="javascript:void(0)" data-page="1" 
					onclick="' . str_replace('{page_number}', 1, $ajax_call_function) . '" 
					title="First">&laquo;</a></li>'; //first link
                $pagination .= '<li><a href="javascript:void(0)" data-page="' . $previous_link . '" 
					onclick="' . str_replace('{page_number}', $previous_link, $ajax_call_function) . '" 
					title="Previous">&lt;</a></li>'; //previous link
                for ($i = ($current_page - 2); $i < $current_page; $i++) {
                    if ($i > 0) {
                        $pagination .= '<li><a href="javascript:void(0)" data-page="' . $i . '" 
						onclick="' . str_replace('{page_number}', $i, $ajax_call_function) . '" 
						title="Page' . $i . '">' . $i . '</a></li>';
                    }
                }
                $first_link = false; //set first link to false
            }

            if ($first_link) {
                $pagination .= '<li class="first active">' . $current_page . '</li>';
            } elseif ($current_page == $total_pages) {
                $pagination .= '<li class="last active">' . $current_page . '</li>';
            } else {
                $pagination .= '<li class="active">' . $current_page . '</li>';
            }

            for ($i = $current_page + 1; $i < $right_links; $i++) {
                if ($i <= $total_pages) {
                    $pagination .= '<li><a href="javascript:void(0)" data-page="' . $i . '" 
					onclick="' . str_replace('{page_number}', $i, $ajax_call_function) . '" 
					title="Page ' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($current_page < $total_pages) {
                $next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<li><a href="javascript:void(0)" data-page="' . $next_link . '" 
					onclick="' . str_replace('{page_number}', $next_link, $ajax_call_function) . '" 
					title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="javascript:void(0)" data-page="' . $total_pages . '" 
					onclick="' . str_replace('{page_number}', $total_pages, $ajax_call_function) . '" 
					title="Last">&raquo;</a></li>'; //last link
            }

            $pagination .= '</div></ul>';
            return $summary_txt . $pagination;
        }
        return '';
    }

    protected function getDefaultRecommendOption()
    {
        $option = array(
            'setting' => self::SFL_RELATED,
            'content' => array()
        );
        return $option;
    }

    protected function loadMedia()
    {
        $css_path = $this->_path . 'views/css/';
        $js_path = $this->_path . 'views/js/';

        //CSS files
        $this->context->controller->addCSS($css_path . 'saveforlater.css');
        $this->context->controller->addCSS($css_path . 'bootstrap.css');
        $this->context->controller->addCSS($css_path . 'responsive.css');
        $this->context->controller->addCSS($css_path . 'fonts/glyphicons_regular.css');
        $this->context->controller->addCSS($css_path . 'fonts/font-awesome.min.css');
        $this->context->controller->addCSS($css_path . 'bootstrap-switch.css');
        $this->context->controller->addCSS($css_path . 'style-light.css');
        $this->context->controller->addCSS($css_path . 'multiple-select.css');
        $this->context->controller->addJs($js_path.'common.js');
        $this->context->controller->addJs($js_path.'jquery.multiple.select.js');
        $this->context->controller->addJs($js_path.'uniform/jquery.uniform.min.js');
        $this->context->controller->addJs($js_path.'bootstrap-switch.js');
        $this->context->controller->addJs($js_path.'jscolor.js');
        $this->context->controller->addJs($js_path.'colpick.js');
        $this->context->controller->addJs($js_path.'saveforlater.js');

        //Font style options
        $this->context->controller->addCSS($css_path . 'font_style_option.css');
        $this->context->controller->addJs($js_path . 'font-style-option.js');
        $this->context->controller->addCSS($css_path . 'colpick.css');
        //Validation-JS by Mayank Kumar
        $this->context->controller->addJS($js_path . 'admin/velovalidation.js');
        //Charts
        if (_PS_VERSION_ < '1.6.0') {
            $this->context->controller->addJs($js_path . 'flot/jquery.flot.min.js');
        } else {
            $this->context->controller->addJqueryPlugin('flot');
        }

        $this->context->controller->addJs($js_path . 'flot/jquery.flot.tooltip.js');
        $this->context->controller->addJs($js_path . 'flot/jquery.flot.symbol.js');
        $this->context->controller->addJs($js_path . 'flot/jquery.flot.axislabels.js');
        $this->context->controller->addJs($js_path . 'flot/jquery.flot.orderBars.js');
    }

    protected function getBaseLink($id_shop = null, $ssl = null)
    {
        static $force_ssl = null;

        if ($ssl === null) {
            if ($force_ssl === null) {
                $force_ssl = (Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE'));
            }
            $ssl = $force_ssl;
        }

        if (Configuration::get('PS_MULTISHOP_FEATURE_ACTIVE') && $id_shop !== null) {
            $shop = new Shop($id_shop);
        } else {
            $shop = $this->context->shop;
        }

        $base = (($ssl && (bool) Configuration::get('PS_SSL_ENABLED')) ? 'https://' . $shop->domain_ssl : 'http://' . $shop->domain);

        return $base . $shop->getBaseURI();
    }

    protected function renderBannerHtml()
    {
        $file_path = _PS_MODULE_DIR_ . 'saveforlater/' . self::BANNER_PATH;
        $banner_writable = true;
        $is_banner_1_updated = 0;
        $is_banner_2_updated = 0;
        if (!is_writable($file_path)) {
            $banner_writable = false;
        }
        if ($banner_writable) {
            $banner_arr = array();
            $recommendations = unserialize(Configuration::get('KB_SAVE_LATER_RECOMM'));
            if ($recommendations['setting'] == self::SFL_BANNER && count($recommendations['content']) > 0) {
                $count = 1;
                if (isset($recommendations['content']['banner_1'])) {
                    $fname = $recommendations['content']['banner_1']['name'];
                    if (Tools::file_exists_no_cache($file_path . $this->context->shop->id . '/' . $fname)) {
                        $banner_arr['banner_1'] = array(
                            'name' => $recommendations['content']['banner_1']['name'],
                            'title' => $recommendations['content']['banner_1']['title'],
                            'src' => ImageManager::thumbnail($file_path . $this->context->shop->id . '/' . $fname, 'cached_' . $fname, 100, 'jpg', true, true),
                            'link' => $recommendations['content']['banner_1']['link'],
                            'valid_check' => 1,
                        );
                        $is_banner_1_updated = 1;
                    } else {
                        $banner_arr['banner_1'] = array(
                            'name' => self::DEFAULT_BANNER_FILE,
                            'title' => '',
                            'src' => ImageManager::thumbnail($file_path . self::DEFAULT_BANNER_FILE, 'cached_' . self::DEFAULT_BANNER_FILE, 100),
                            'link' => '',
                            'valid_check' => 0,
                        );
                        $count++;
                    }
                } else {
                    $banner_arr['banner_1'] = array(
                        'name' => self::DEFAULT_BANNER_FILE,
                        'title' => '',
                        'src' => ImageManager::thumbnail($file_path . self::DEFAULT_BANNER_FILE, 'cached_' . self::DEFAULT_BANNER_FILE, 100),
                        'link' => '',
                        'valid_check' => 0,
                    );
                    $count++;
                }
                if (isset($recommendations['content']['banner_2'])) {
                    $fname = $recommendations['content']['banner_2']['name'];
                    if (Tools::file_exists_no_cache($file_path . $this->context->shop->id . '/' . $fname)) {
                        $banner_arr['banner_2'] = array(
                            'name' => $recommendations['content']['banner_2']['name'],
                            'title' => $recommendations['content']['banner_2']['title'],
                            'src' => ImageManager::thumbnail($file_path . $this->context->shop->id . '/' . $fname, 'cached_' . $fname, 100, 'jpg', true, true),
                            'link' => $recommendations['content']['banner_2']['link'],
                            'valid_check' => 1,
                        );
                        $is_banner_2_updated = 1;
                    } else {
                        $banner_arr['banner_2'] = array(
                            'name' => self::DEFAULT_BANNER_FILE,
                            'title' => '',
                            'src' => ImageManager::thumbnail($file_path . self::DEFAULT_BANNER_FILE, 'cached_' . self::DEFAULT_BANNER_FILE, 100),
                            'link' => '',
                            'valid_check' => 0,
                        );
                        $count++;
                    }
                } else {
                    $banner_arr['banner_2'] = array(
                        'name' => self::DEFAULT_BANNER_FILE,
                        'title' => '',
                        'src' => ImageManager::thumbnail($file_path . self::DEFAULT_BANNER_FILE, 'cached_' . self::DEFAULT_BANNER_FILE, 100),
                        'link' => '',
                        'valid_check' => 0,
                    );
                    $count++;
                }

                if (count($banner_arr) == 0) {
                    $banner_arr = $this->getDefaultBanner();
                }
            } else {
                $banner_arr = $this->getDefaultBanner();
            }

            $this->smarty->assign(array(
                'banner_writable' => $banner_writable,
                'banners' => $banner_arr,
                'default_banner' => ImageManager::thumbnail($file_path . 'sfl_default_banner.jpg', 'cached_sfl_default_banner.jpg', 100)
            ));
        } else {
            $this->smarty->assign(array(
                'banner_writable' => $banner_writable,
                'permission_msg' => sprintf($this->l('Permission Error: Please give read/write permission to "%s" folder.', 'sflcore'), $file_path),
            ));
        }

        $this->smarty->assign(
            array(
                'is_banner_2_updated' => $is_banner_2_updated,
                'is_banner_1_updated' => $is_banner_1_updated
            )
        );

        return $this->display(_PS_MODULE_DIR_ . 'saveforlater/', 'views/templates/admin/banner_form.tpl');
    }

    private function getDefaultBanner()
    {
        $file_path = _PS_MODULE_DIR_ . 'saveforlater/' . self::BANNER_PATH;
        $banner_arr = array();
        $banner_arr['banner_1'] = array(
            'name' => self::DEFAULT_BANNER_FILE,
            'title' => '',
            'src' => ImageManager::thumbnail($file_path . self::DEFAULT_BANNER_FILE, 'cached_' . self::DEFAULT_BANNER_FILE, 100),
            'link' => '',
        );
        $banner_arr['banner_2'] = array(
            'name' => self::DEFAULT_BANNER_FILE,
            'title' => '',
            'src' => ImageManager::thumbnail($file_path . self::DEFAULT_BANNER_FILE, 'cached_' . self::DEFAULT_BANNER_FILE, 100),
            'link' => '',
        );
        return $banner_arr;
    }

    protected function renderRecommendProductsHtml()
    {
        $recommendations = unserialize(Configuration::get('KB_SAVE_LATER_RECOMM'));
        $products = $this->getProducts(array());
        $selected_products = array();
        $selected_categories = array();
        if ($recommendations['setting'] == self::SFL_SEL_PRODUCTS && count($recommendations['content']) > 0) {
            foreach ($recommendations['content'] as $id_product) {
                $selected_products[] = $id_product;
            }
        }
        
        if ($recommendations['setting'] == self::SFL_SEL_PRODUCTS && count($recommendations['categorycontent']) > 0) {
            foreach ($recommendations['categorycontent'] as $id_category) {
                $selected_categories[] = $id_category;
            }
        }

        $this->smarty->assign(array(
            'categories' => $this->createCategoryTree(),
            'products' => $products,
            'selected_products' => $selected_products,
            'selected_categories' => $selected_categories,
        ));

        return $this->display(_PS_MODULE_DIR_ . 'saveforlater/', 'views/templates/admin/recommend_products.tpl');
    }

    protected function createCategoryTree()
    {
        $data = array();
        $root_category = Category::getRootCategories();
        $all = Category::getSimpleCategories($this->context->language->id);
        foreach ($all as $c) {
            if ($root_category[0]['id_category'] != $c['id_category']) {
                $tmp = new Category($c['id_category'], $this->context->language->id, $this->context->shop->id);
                $parents = $tmp->getParentsCategories();
                $parents = array_reverse($parents);
                $str = '';
                foreach ($parents as $p) {
                    $str .= '>>' . $p['name'];
                }
                $data[] = array(
                    'id_category' => $c['id_category'],
                    'name' => ltrim($str, '>>')
                );
            }
        }
        return $data;
    }

    protected function getProducts($categories = array())
    {
        if (count($categories) > 0) {
            $cat_condition = ' WHERE id_category IN (' . pSQL(implode(',', $categories)) . ')';
            $sql = 'Select distinct(id_product) as id_product from ' . _DB_PREFIX_ . 'category_product' . $cat_condition;
            $cat_products = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        } else {
            $cat_products = Product::getSimpleProducts($this->context->language->id);
        }
        $products = array();
        foreach ($cat_products as $id_product) {
            $pro = new Product($id_product['id_product'], false, $this->context->language->id, $this->context->shop->id);
            $id_image = $pro->getCoverWs();
            $path_to_image = _PS_IMG_DIR_ . 'p/' . Image::getImgFolderStatic($id_image) . (int) $id_image . '.jpg';
            $image = ImageManager::thumbnail(
                $path_to_image,
                'product_mini_' . $id_product['id_product'] . '_' . $pro->id_shop_default . '.jpg',
                60,
                '.jpg'
            );
            $products[$id_product['id_product']] = array(
                'id_product' => $id_product['id_product'],
                'name' => $pro->name,
                'reference' => $pro->reference,
                'image' => $image
            );
            unset($pro);
        }

        return $products;
    }

    protected function getProduct($id_product = 0)
    {
        $json = array();
        if ($id_product > 0) {
            $pro = new Product($id_product, false, $this->context->language->id, $this->context->shop->id);
            $id_image = $pro->getCoverWs();
            $path_to_image = _PS_IMG_DIR_ . 'p/' . Image::getImgFolderStatic($id_image) . (int) $id_image . '.jpg';
            $image = ImageManager::thumbnail(
                $path_to_image,
                'product_mini_' . $id_product . '_' . $pro->id_shop_default . '.jpg',
                60,
                '.jpg'
            );
            $json = array(
                'id_product' => $id_product['id_product'],
                'name' => $pro->name,
                'reference' => $pro->reference,
                'image' => $image
            );
        }

        return $json;
    }

    protected function createCategoryLevel($cat_name, $id_parent, $categories)
    {
        foreach ($categories as $cat) {
            if ($cat['id_category'] == $id_parent) {
                $cat_name[] = $cat['name'];
                if ($cat['id_parent'] == 0) {
                    return $cat_name;
                } else {
                    $cat_name = $this->createCategoryLevel($cat_name, $cat['id_parent'], $categories);
                }
            }
        }
        return $cat_name;
    }

    protected function saveRecommendOptions()
    {
        $recommend_setting = Tools::getValue('recommendations');
        if (!isset($recommend_setting['content']) || empty($recommend_setting['content'])) {
            $recommend_setting['content'] = array();
        }
        $content_setting = array();
        $content_category_setting = array();
        $error = false;
        if ($recommend_setting['setting'] == self::SFL_BANNER) {
            $banner_path = _PS_MODULE_DIR_ . 'saveforlater/' . self::BANNER_PATH . $this->context->shop->id . '/';
            $banners = $recommend_setting['content'];
            $banner_media = $_FILES['banner'];
            $is_uploaded_all = true;
            $str = $this->l('Error occurred while uploading banner(s).', 'sflcore') . '<br>';
            if (isset($banners['banner_1'])) {
                $curent_banner = false;
                if ($banners['banner_1']['remove'] == 1 && $banners['banner_1']['old'] != self::DEFAULT_BANNER_FILE) {
                    if (file_exists($banner_path . $banners['banner_1']['old'])) {
                        unlink($banner_path . $banners['banner_1']['old']);
                    }
                    if (file_exists($banner_path . 'temp_' . $banners['banner_1']['old'])) {
                        unlink($banner_path . 'temp_' . $banners['banner_1']['old']);
                    }
                }
                if ($banners['banner_1']['remove'] == 0 && $banners['banner_1']['old'] != self::DEFAULT_BANNER_FILE) {
                    $content_setting['banner_1'] = array(
                        'name' => $banners['banner_1']['old'],
                        'title' => $banners['banner_1']['title'],
                        'link' => $banners['banner_1']['link']
                    );
                }
                if ($banner_media['size']['banner_1']['file'] && $banner_media['size']['banner_1']['file'] > 0) {
                    $curent_banner = true;
                    $tmp = array(
                        'tmp_name' => $banner_media['tmp_name']['banner_1']['file'],
                        'name' => $banner_media['name']['banner_1']['file'],
                        'size' => $banner_media['size']['banner_1']['file'],
                        'type' => $banner_media['type']['banner_1']['file'],
                        'error' => $banner_media['error']['banner_1']['file'],
                        'original_name' => $banner_media['name']['banner_1']['file']
                    );
                    $imgerror = $this->validateBanner($tmp);
                    if ($imgerror != '') {
                        $is_uploaded_all = false;
                        $str .= $tmp['name'] . ': ' . $imgerror . '<br>';
                        $curent_banner = false;
                    } else {
                        if (!is_dir($banner_path)) {
                            mkdir($banner_path, 0777);
                        }

                        if (file_exists($banner_path . $tmp['name'])) {
                            $mask = $banner_path . $tmp['name'] . '.*';
                            $matches = glob($mask);
                            if (count($matches) > 0) {
                                array_map('unlink', $matches);
                            }
                        }
                        if (file_exists($banner_path . 'temp_' . $tmp['name'])) {
                            $mask = $banner_path . 'temp_' . $tmp['name'] . '.*';
                            $matches = glob($mask);
                            if (count($matches) > 0) {
                                array_map('unlink', $matches);
                            }
                        }
                        if ($tmp['tmp_name'] && is_uploaded_file($tmp['tmp_name'])) {
                            move_uploaded_file($tmp['tmp_name'], $banner_path . $tmp['name']);
                        }
                    }
                }

                if ($curent_banner) {
                    $content_setting['banner_1'] = array(
                        'name' => $tmp['name'],
                        'title' => $banners['banner_1']['title'],
                        'link' => $banners['banner_1']['link']
                    );
                }
            }
            if (isset($banners['banner_2'])) {
                $curent_banner = false;
                if ($banners['banner_2']['remove'] == 1 && $banners['banner_2']['old'] != self::DEFAULT_BANNER_FILE) {
                    if (file_exists($banner_path . $banners['banner_2']['old'])) {
                        unlink($banner_path . $banners['banner_2']['old']);
                    }
                    if (file_exists($banner_path . 'temp_' . $banners['banner_2']['old'])) {
                        unlink($banner_path . 'temp_' . $banners['banner_2']['old']);
                    }
                }
                if ($banners['banner_2']['remove'] == 0 && $banners['banner_2']['old'] != self::DEFAULT_BANNER_FILE) {
                    $content_setting['banner_2'] = array(
                        'name' => $banners['banner_2']['old'],
                        'title' => $banners['banner_2']['title'],
                        'link' => $banners['banner_2']['link']
                    );
                }
                if ($banner_media['size']['banner_2']['file'] && $banner_media['size']['banner_2']['file'] > 0) {
                    $curent_banner = true;
                    $tmp = array(
                        'tmp_name' => $banner_media['tmp_name']['banner_2']['file'],
                        'name' => $banner_media['name']['banner_2']['file'],
                        'size' => $banner_media['size']['banner_2']['file'],
                        'type' => $banner_media['type']['banner_2']['file'],
                        'error' => $banner_media['error']['banner_2']['file'],
                        'original_name' => $banner_media['name']['banner_2']['file']
                    );
                    $imgerror = $this->validateBanner($tmp);
                    if ($imgerror != '') {
                        $is_uploaded_all = false;
                        $str .= $tmp['name'] . ': ' . $imgerror . '<br>';
                        $curent_banner = false;
                    } else {
                        if (!is_dir($banner_path)) {
                            mkdir($banner_path, 0777);
                        }

                        if (file_exists($banner_path . $tmp['name'])) {
                            $mask = $banner_path . $tmp['name'] . '.*';
                            $matches = glob($mask);
                            if (count($matches) > 0) {
                                array_map('unlink', $matches);
                            }
                        }
                        if (file_exists($banner_path . 'temp_' . $tmp['name'])) {
                            $mask = $banner_path . 'temp_' . $tmp['name'] . '.*';
                            $matches = glob($mask);
                            if (count($matches) > 0) {
                                array_map('unlink', $matches);
                            }
                        }
                        if ($tmp['tmp_name']) {
                            move_uploaded_file($tmp['tmp_name'], $banner_path . $tmp['name']);
                        }
                    }
                }

                if ($curent_banner) {
                    $content_setting['banner_2'] = array(
                        'name' => $tmp['name'],
                        'title' => $banners['banner_2']['title'],
                        'link' => $banners['banner_2']['link']
                    );
                }
            }
            if (!$is_uploaded_all) {
                $error = true;
            }
        } else if ($recommend_setting['setting'] == self::SFL_SEL_PRODUCTS) {
            $content_setting = $recommend_setting['content'];
        } else {
            $recommend_setting['setting'] = self::SFL_RELATED;
        }
        
        if ($recommend_setting['setting'] == self::SFL_SEL_PRODUCTS) {
            $content_category_setting = $recommend_setting['categorycontent'];
        }

        $setting_array = array(
            'setting' => $recommend_setting['setting'],
            'content' => $content_setting,
            'categorycontent' => $content_category_setting,
        );

        Configuration::updateValue('KB_SAVE_LATER_RECOMM', serialize($setting_array));

        if (!$error) {
            return $this->displayConfirmation($this->l('Recommended options has been saved successfully.', 'SFLCore'));
        } else {
            return $this->displayError($str);
        }
    }

    private function validateBanner($file)
    {
        $post_max_size = ini_get('post_max_size');
        $bytes = trim($post_max_size);
        $detectedType = exif_imagetype($file['tmp_name']);
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $extensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG", "gif", "GIF");
        $file_ext = pathinfo($file['original_name'], PATHINFO_EXTENSION);
        $last = Tools::strtolower($post_max_size[Tools::strlen($post_max_size) - 1]);

        switch ($last) {
            case 'g':
                $bytes *= 1024 * 1024 * 1024;
                break;
            case 'm':
                $bytes *= 1024 * 1024;
                break;
            case 'k':
                $bytes *= 1024;
                break;
        }

        $error = '';
        if ($bytes && ($_SERVER['CONTENT_LENGTH'] > $bytes)) {
            $error = $this->l('The uploaded file exceeds the post_max_size directive in php.ini.', 'sflcore');
        } elseif (preg_match('/\%00/', $file['name'])) {
            $error = $this->l('Invalid file name.');
        } elseif ($file['size'] > self::MAX_UPLOAD_SIZE) {
            $error = $this->l('File is too big.');
        } elseif (in_array($detectedType, $allowedTypes) === false) {
            $error = $this->l('File Type not allowed, please choose a JPEG or PNG or GIF file.', 'sflcore');
        } elseif (in_array($file_ext, $extensions) === false) {
            $error = $this->l('Extension not allowed, please choose a JPEG or PNG or GIF file.', 'sflcore');
        }

        return $error;
    }

    protected function getFromDate()
    {
        $total_days = date('t', strtotime(date('Y-m-d', strtotime(date('Y-m') . ' -1 month')))) + date('d', time());
        return date('Y-m-d 00:00:00', strtotime('-' . ($total_days - 1) . ' day', strtotime(date('Y-m-d', time()))));
    }

    protected function prepareFilterVariable($action = null)
    {
        $param = array();
        $param['type'] = 0;
        $param['products'] = '';
        $param['from_date'] = $this->getFromDate();
        $param['to_date'] = date('Y-m-d 00:00:00', time());
        $param['categories'] = '';
        if ($action == null) {
            $param['products'] = Tools::getValue('products');
            $param['from_date'] = (Tools::getValue('from_date') != '') ? Tools::getValue('from_date') : $this->getFromDate();
            $param['to_date'] = (Tools::getValue('to_date') != '') ? Tools::getValue('to_date') : date('Y-m-d h:i:s', time());
            if (Tools::getIsset('type')) {
                $param['type'] = Tools::getValue('type');
                if (Tools::getValue('type') == 0) {
                    $param['categories'] = Tools::getValue('categories');
                }
            }
        }
        return $param;
    }

    protected function removeExportedReport()
    {
        $files = glob(_PS_MODULE_DIR_ . 'saveforlater/' . self::REPORT_LOCATION . '*.csv');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}
