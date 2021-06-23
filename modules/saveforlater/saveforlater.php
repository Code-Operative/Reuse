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

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once dirname(__FILE__).'/classes/SFLCore.php';
/**
 * The parent class SFLCore is extending the "Module" core class.
 * So no need to extend "Module" core class here in this class.
 */
class SaveForLater extends SFLCore
{
    private $save_settings = array();
    protected $product_data;
    private $custom_errors = array();

    public function __construct()
    {
        $this->name = 'saveforlater';
        $this->tab = 'front_office_features';
        $this->version = '1.0.7';
        $this->author = 'Knowband';
        $this->module_key = 'ec8484d0b72ac97359d68e2b7ec4fc55';
        $this->author_address = '0x2C366b113bd378672D4Ee91B75dC727E857A54A6';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.7.0.0', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        $this->displayName = $this->l('Save for Later');
        $this->description = $this->l('Enables the customers to save any product to a shortlist.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
        parent::__construct();
    }

    public function getErrors()
    {
        return $this->custom_errors;
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        $this->installModel();

        if (!parent::install()||
            !$this->registerHook('displayCustomerAccount') ||
            !$this->registerHook('actionCustomerAccountAdd') ||
            !$this->registerHook('displayBeforeShoppingCartBlock')||
            !$this->registerHook('displayCartExtraProductActions') ||
            !$this->registerHook('displayFooterBefore')||
            !$this->registerHook('displayTop')||
            !$this->registerHook('actionAuthentication')) {
            return false;
        }

        if (Configuration::get('KB_SAVE_LATER')) {
            Configuration::deleteByName('KB_SAVE_LATER');
        }

        $this->save_settings = $this->getDefaultSettings();
        Configuration::updateGlobalValue('KB_SAVE_LATER', serialize($this->save_settings));

        $recommendations = $this->getDefaultRecommendOption();
        Configuration::updateGlobalValue('KB_SAVE_LATER_RECOMM', serialize($recommendations));

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() ||
            !$this->unregisterHook('displayCustomerAccount') ||
            !$this->unregisterHook('displayBeforeShoppingCartBlock') ||
            !$this->unregisterHook('displayCartExtraProductActions')||
            !$this->unregisterHook('displayFooterBefore') ||
            !$this->unregisterHook('displayTop') ||
            !$this->unregisterHook('actionAuthentication')) {
            return false;
        }

        return true;
    }

    public function getContent()
    {
//      $this->registerHook('displayFooterBefore');
        $this->context->controller->addJs($this->_path . 'views/js/admin/validate_saveforlater.js');
        $this->context->controller->addJs($this->_path . 'views/js/admin/validate_saveforlater.js');
        $this->context->controller->addJs($this->_path . 'views/js/velovalidation.js');
        $this->context->controller->addJs($this->_path . 'views/js/tooltip.js');
        $this->context->controller->addJs($this->_path . 'views/js/bootstrap.js');
        $this->context->controller->addCSS($this->_path . 'views/css/popup.css');

        if (Tools::getValue('ajax')) {
            $this->doAjaxProcess();
        }
        $this->removeExportedReport();

        $this->loadMedia();

        $output = null;

        if (Tools::isSubmit('configuration_form_key') || Tools::getValue('configuration_form_key') == Tools::encrypt(parent::MODULE_KEY)) {
            $post_data = Tools::getValue('kb_sfl_config');
          
            $this->processSettingBeforeSave($post_data);
            Configuration::updateValue('KB_SAVE_LATER', serialize($post_data));
            $output .= $this->displayConfirmation($this->l('Configuration has been saved successfully.'));
        }

        if (Tools::isSubmit('submit_recommend_option')) {
            $output .= $this->saveRecommendOptions();
        }
        if (!Configuration::get('KB_SAVE_LATER') || Configuration::get('KB_SAVE_LATER') == '') {
            $settings = $this->getDefaultSettings();
        } else {
            $settings = unserialize(Configuration::get('KB_SAVE_LATER'));
        }

        if (Configuration::get('KB_SAVE_LATER_RECOMM') && Configuration::get('KB_SAVE_LATER_RECOMM') != '') {
            $recommendations = unserialize(Configuration::get('KB_SAVE_LATER_RECOMM'));
        } else {
            $recommendations = $this->getDefaultRecommendOption();
        }
        $this->save_settings = $settings;
        $custom_ssl_var = 0;
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $custom_ssl_var = 1;
        }
        if ((bool) Configuration::get('PS_SSL_ENABLED') && $custom_ssl_var == 1) {
            $ps_base_url = _PS_BASE_URL_SSL_;
        } else {
            $ps_base_url = _PS_BASE_URL_;
        }
        $this->smarty->assign('languages', Language::getLanguages(true));
        $this->smarty->assign('img_lang_dir', $ps_base_url . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_LANG_IMG_DIR_));

        $categories = $this->createCategoryTree();
        $products = $this->getProducts(array());
        $this->smarty->assign(array(
            'kb_sfl_config' => $this->save_settings,
            'action' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminModules') . '&configure=' . $this->name,
            'module_images_loc' => $ps_base_url . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_MODULE_DIR_) . 'saveforlater/views/img/',
            'download_url' => $ps_base_url . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_MODULE_DIR_) . 'saveforlater/' . parent::REPORT_LOCATION,
            'configuration_key' => Tools::encrypt(parent::MODULE_KEY),
            'recommendations' => $recommendations,
            'from_date' => date("m/d/Y", strtotime($this->getFromDate())),
            'to_date' => date("m/d/Y", time()),
            'category' => $categories,
            'products' => $products,
            'product_analysis_report' => array('flag' => false, 'pagination' => ''),
            'customer_analysis_report' => array('flag' => false, 'pagination' => ''),
            'order_analysis_report' => array('flag' => false, 'graph' => array(), 'pagination' => '')
        ));

        $output .= $this->display(__FILE__, 'views/templates/admin/saveforlater.tpl');
        return $output;
    }
    
    private function getProductLinkKb($pid)
    {
        $pro_obj = new Product((int) $pid);
        $def_attr = 0;
        if (isset($pro_obj->cache_default_attribute)) {
            $def_attr = $pro_obj->cache_default_attribute;
        } else {
            $def_attr = Product::getDefaultAttribute($pid);
        }
        $link_rewrite = null;
        if (isset($pro_obj->link_rewrite[$this->context->language->id])) {
            $link_rewrite = $pro_obj->link_rewrite[$this->context->language->id];
        }
        $product_url = $this->context->link->getProductLink(
            $pro_obj->id,
            $link_rewrite,
            $pro_obj->category,
            null,
            null,
            $pro_obj->id_shop_default,
            $def_attr,
            false,
            false,
            true
        );
        unset($pro_obj);
        unset($link_rewrite);
        unset($def_attr);
        return $product_url;
    }

    private function doAjaxProcess()
    {
        $json = array();
        $render_html = false;
        switch (Tools::getValue('method')) {
            case 'getrecommendbanner':
                echo $this->renderBannerHtml();
                $render_html = true;
                break;
            case 'getrecommendproducts':
                echo $this->renderRecommendProductsHtml();
                $render_html = true;
                break;
            case 'getcategoryproducts':
                if (Tools::getValue('categories') && Tools::getValue('categories') != '') {
                    $categories = explode(',', Tools::getValue('categories'));
                } else {
                    $categories = array();
                }
                $json = $this->getProducts($categories);
                break;
            case 'product_analysis':
                $param = $this->prepareFilterVariable();
                $json = $this->getProductAnalysisData($param);
                break;
            case 'customer_analysis':
                $param = $this->prepareFilterVariable();
                $json = $this->getCustomerAnalysisData($param);
                break;
            case 'csv':
                $report_type = Tools::getValue('report_type');
                $json = $this->prepareCSV($report_type);
                break;
            case 'order_analysis':
                $param = $this->prepareFilterVariable();
                $json = $this->getOrderAnalysisData($param);
                break;
            case 'customerproducts':
                $param = $this->prepareFilterVariable();
                $param['id_customer'] = Tools::getValue('id_customer');
                $json = $this->getCustomerProducts($param);
                break;
            case 'getsavedproduct':
                $param = $this->prepareFilterVariable();
                $param['id_category'] = Tools::getValue('id_category');
                $json = $this->getSavedProducts($param);
                break;
            case 'getselectedrecomproducts':
                $id_product = Tools::getValue('id_product');
                $json = $this->getProduct($id_product);
                break;
        }
        if (!$render_html) {
            header('Content-Type: application/json', true);
            echo Tools::jsonEncode($json);
        }
        die;
    }

    private function prepareCSV($report_type = 0)
    {
        $directory = _PS_MODULE_DIR_ . 'saveforlater/' . parent::REPORT_LOCATION;
        $file_name = '';
        $json = array();
        $json['error'] = false;
        if (!is_writable($directory)) {
            $json['error'] = true;
            $json['msg'] = $this->l('Permission Error: Please give read/write permission to folder ').'`'.$directory.'`';
        }

        if (!$json['error']) {
            $param = $this->prepareFilterVariable();
            //Product analysis report
            if ($report_type == 1) {
                $file_name = 'sfl_product_analysis_' . time() . '.csv';
                $f = fopen($directory . $file_name, 'w+');
                if ($param['type'] == 0) {
                    $header = array($this->l('Sr. No.'), $this->l('Category Name'), $this->l('No. of Products'));
                } else {
                    $header = array($this->l('Sr. No.'), $this->l('Product Name'), $this->l('No. of Customers'));
                }

                fputcsv($f, $header);
                $param['csv'] = true;
                $data = $this->getProductAnalysisData($param);
                if ($data['flag']) {
                    $count = 1;
                    foreach ($data['data'] as $write_data) {
                        $data_to_write = array(
                            $count,
                            $write_data['name'],
                            $write_data['count']
                        );
                        fputcsv($f, $data_to_write);

                        $count++;
                    }
                }
                fclose($f);
            } elseif ($report_type == 2) {
                $file_name = 'sfl_customer_analysis_' . time() . '.csv';
                $f = fopen($directory . $file_name, 'w+');
                $header = array($this->l('Sr. No.'), $this->l('Customer Name'), $this->l('Customer Email'), $this->l('No. of Products'));
                fputcsv($f, $header);
                $param['csv'] = true;
                $data = $this->getCustomerAnalysisData($param);
                if ($data['flag']) {
                    $count = 1;
                    foreach ($data['data'] as $write_data) {
                        $data_to_write = array(
                            $count,
                            $write_data['firstname'] . ' ' . $write_data['lastname'],
                            $write_data['email'],
                            $write_data['count']
                        );
                        fputcsv($f, $data_to_write);
                        $count++;
                    }
                }
                fclose($f);
            } elseif ($report_type == 3) {
                $file_name = 'sfl_order_analysis_' . time() . '.csv';
                $f = fopen($directory . $file_name, 'w+');
                $header = array(
                    $this->l('Sr. No.'),
                    $this->l('Customer Name'),
                    $this->l('Customer Email'),
                    $this->l('Product Name'),
                    $this->l('Reference'),
                    $this->l('Date Added'),
                    $this->l('Purchased'),
                    $this->l('Order Date')
                );
                fputcsv($f, $header);
                $param['csv'] = true;
                $data = $this->getOrderAnalysisData($param);
                if ($data['flag']) {
                    $count = 1;
                    foreach ($data['data'] as $write_data) {
                        $data_to_write = array(
                            $count,
                            $write_data['firstname'] . ' ' . $write_data['lastname'],
                            $write_data['email'],
                            $write_data['name'],
                            $write_data['reference'],
                            $write_data['date_add'],
                            $write_data['status'],
                            $write_data['order_date']
                        );
                        fputcsv($f, $data_to_write);
                        $count++;
                    }
                }
                fclose($f);
            }
        }

        if (!$json['error']) {
            $json['url'] = $file_name;
        }

        return $json;
    }

    private function getProductAnalysisData($param)
    {
        $data = array();
        $graph_data = array();
        $fetch_graph = true;
        $data_condition = '';
        if ($param['from_date'] != '' && $param['to_date'] != '') {
            $data_condition .= ' AND (DATE(sfl.date_add) between "' . pSQL(date('Y-m-d', strtotime($param['from_date']))) . '"
                            AND "' . pSQL(date('Y-m-d', strtotime($param['to_date']))) . '")';
        } elseif ($param['from_date'] != '') {
            $data_condition .= ' AND DATE(sfl.date_add) >= "' . pSQL(date('Y-m-d', strtotime($param['from_date']))) . '"';
        } elseif ($param['to_date'] != '') {
            $data_condition .= ' AND DATE(sfl.date_add) <= "' . pSQL(date('Y-m-d', strtotime($param['to_date']))) . '"';
        }

        if ($param['products'] != '') {
            $product_condition = ' AND sfl.id_product IN (' . pSQL($param['products']) . ')';
        } else {
            $product_condition = ' AND sfl.id_product NOT IN (0)';
        }
        $page_number = 1;
        $item_per_page = self::SFL_TBL_LIMIT;
        if (Tools::getIsset('page_number') && Tools::getValue('page_number') > 1) {
            $page_number = (int) Tools::getValue('page_number');
        }
        if (Tools::getIsset('fetch_graph') && Tools::getValue('fetch_graph')) {
            $fetch_graph = false;
        }
        //for category wise
        if ($param['type'] == 0) {
            $categories_id = array();
            if ($param['categories'] != '') {
                $categories_id = explode(',', $param['categories']);
            } else {
                $temp_cat = Category::getSimpleCategories($this->context->language->id);
                if ($temp_cat && count($temp_cat) > 0) {
                    foreach ($temp_cat as $val) {
                        if ($val['id_category'] > 2) {
                            $categories_id[] = $val['id_category'];
                        }
                    }
                }
            }
            if (count($categories_id) > 0) {
                $root_category = Category::getRootCategories();
                $cat_qry = 'Select {COLUMN} from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . ' as sfl 
                                            RIGHT JOIN ' . _DB_PREFIX_ . 'category_product as cp on (sfl.id_product = cp.id_product) 
                                            WHERE cp.id_category > ' . (int) $root_category[0]['id_catogory']
                        . ' AND sfl.id_shop = ' . (int) $this->context->shop->id
                        . ' AND cp.id_category IN (' . pSQL(implode(',', $categories_id)) . ')'
                        . $product_condition . $data_condition;

                $cols = 'cp.id_category, COUNT(sfl.id_product) as total';

                if (!$param['csv']) {
                    $records = $this->getTotalPages($cat_qry, 'COUNT(distinct cp.id_category) as total');
                    $cat_qry .= ' GROUP BY cp.id_category';

                    if ($fetch_graph) {
                        $graph_results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(str_replace('{COLUMN}', $cols, $cat_qry . ' ORDER BY total DESC LIMIT 10'));
                        foreach ($graph_results as $g) {
                            $tmp = new Category($g['id_category'], $this->context->language->id, $this->context->shop->id);
                            $graph_data[] = array(
                                'id' => $g['id_category'],
                                'count' => (int) $g['total'],
                                'label' => $tmp->name);
                        }
                    }
                    $page_position = (($page_number - 1) * $item_per_page);
                    $cat_qry .= ' LIMIT ' . (int) $page_position . ', ' . (int) $item_per_page;
                } else {
                    $cat_qry .= ' GROUP BY cp.id_category';
                }
                $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(str_replace('{COLUMN}', $cols, $cat_qry));
                foreach ($results as $rs) {
                    $tmp = new Category($rs['id_category'], $this->context->language->id, $this->context->shop->id);
                    $parents = $tmp->getParentsCategories();

                    $parents = array_reverse($parents);
                    $str = '';
                    foreach ($parents as $p) {
                        $str .= '>>' . $p['name'];
                    }
                    $data[] = array(
                        'id' => $rs['id_category'],
                        'count' => (int) $rs['total'],
                        'name' => ltrim($str, '>>'),
                        'label' => $tmp->name
                    );
                }
            }
        }
        //for Product wise
        if ($param['type'] == 1) {
            $cat_qry = 'Select {COLUMN} from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . ' as sfl 
                                    WHERE sfl.id_shop = ' . (int) $this->context->shop->id
                    . $product_condition;
            $cols = 'sfl.id_product, COUNT(sfl.id_customer) as total';
            if (!$param['csv']) {
                $records = $this->getTotalPages($cat_qry, 'COUNT(distinct sfl.id_product) as total');
                $cat_qry .= ' GROUP BY sfl.id_product';
                if ($fetch_graph) {
                    $graph_results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(str_replace('{COLUMN}', $cols, $cat_qry . ' ORDER BY total DESC LIMIT 10'));
                    foreach ($graph_results as $g) {
                        $tmp = new Product($g['id_product'], false, $this->context->language->id, $this->context->shop->id);
                        $graph_data[] = array(
                            'id' => $g['id_product'],
                            'count' => (int) $g['total'],
                            'label' => $tmp->name
                        );
                    }
                }
                $page_position = (($page_number - 1) * $item_per_page);
                $cat_qry .= ' LIMIT ' . (int) $page_position . ', ' . (int) $item_per_page;
            } else {
                $cat_qry .= ' GROUP BY sfl.id_product';
            }
            $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(str_replace('{COLUMN}', $cols, $cat_qry));
            foreach ($results as $rs) {
                $tmp = new Product($rs['id_product'], false, $this->context->language->id, $this->context->shop->id);
                $data[] = array(
                    'id' => $rs['id_product'],
                    'count' => (int) $rs['total'],
                    'name' => $tmp->name,
                    'label' => $tmp->name
                );
            }
        }
        usort($data, function ($a, $b) {
            return $b['count'] - $a['count']; // to sort ascending use $a['count'] - $b['count']
        });
        if (count($data) > 0) {
            if (!$param['csv']) {
                $paging = $this->customPaginator($records['total_records'], $records['total_pages'], 'getProductAnalysisTableReport', $page_number);
            } else {
                $paging = '';
            }
            return array(
                'flag' => true,
                'graph' => $graph_data,
                'data' => $data,
                'pagination' => $paging
            );
        } else {
            return array('flag' => false, 'graph' => $graph_data, 'pagination' => '');
        }
    }

    private function getCustomerAnalysisData($param)
    {
        $data = array();
        $date_condition = '';
        if ($param['from_date'] != '' && $param['to_date'] != '') {
            $date_condition .= ' AND (DATE(sfl.date_add) between "' . pSQL(date('Y-m-d', strtotime($param['from_date']))) . '"
                             AND "' . pSQL(date('Y-m-d', strtotime($param['to_date']))) . '")';
        } elseif ($param['from_date'] != '') {
            $date_condition .= ' AND DATE(sfl.date_add) >= "' . pSQL(date('Y-m-d', strtotime($param['from_date']))) . '"';
        } elseif ($param['to_date'] != '') {
            $date_condition .= ' AND DATE(sfl.date_add) <= "' . pSQL(date('Y-m-d', strtotime($param['to_date']))) . '"';
        }
        if ($param['products'] != '') {
            $product_condition = ' AND sfl.id_product IN (' . pSQL($param['products']) . ')';
        } else {
            $product_condition = ' AND sfl.id_product NOT IN (0)';
        }
        $page_number = 1;
        $item_per_page = self::SFL_TBL_LIMIT;
        if (Tools::getIsset('page_number') && Tools::getValue('page_number') > 1) {
            $page_number = (int) Tools::getValue('page_number');
        }
        $cols = 'count(sfl.id_customer) as total, sfl.id_customer, c.firstname, c.lastname, c.email, sfl.date_add';
        $qry = 'select {COLUMN} from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . ' as sfl 
                            INNER JOIN ' . _DB_PREFIX_ . 'customer as c on (sfl.id_customer = c.id_customer AND c.id_shop = ' . (int) $this->context->shop->id . ') 
                            where sfl.id_shop=' . (int) $this->context->shop->id . $product_condition . $date_condition
                . ' group by sfl.id_customer';
        $records = $this->getTotalPages($qry, 'COUNT(distinct sfl.id_customer) as total');
        $page_position = (($page_number - 1) * $item_per_page);
        $qry .= ' LIMIT ' . (int) $page_position . ', ' . (int) $item_per_page;
        $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(str_replace('{COLUMN}', $cols, $qry));
        foreach ($results as $rs) {
            $data[] = array(
                'id' => $rs['id_customer'],
                'count' => (int) $rs['total'],
                'firstname' => $rs['firstname'],
                'lastname' => $rs['lastname'],
                'email' => $rs['email']
            );
        }
        usort($data, function ($a, $b) {
            return $b['count'] - $a['count']; // to sort ascending use $a['count'] - $b['count']
        });
        if (count($data) > 0) {
            if (!$param['csv']) {
                $paging = $this->customPaginator($records['total_records'], $records['total_pages'], 'getCustomerAnalysisTableReport', $page_number);
            } else {
                $paging = '';
            }
            return array(
                'flag' => true,
                'data' => $data,
                'pagination' => $paging
            );
        } else {
            return array('flag' => false, 'pagination' => '');
        }
    }

    private function getOrderAnalysisData($param)
    {
        $data = array();
        $graph = array();
        $date_condition = '';
        $fetch_graph = true;
        if ($param['from_date'] != '' && $param['to_date'] != '') {
            $date_condition .= ' AND (DATE(sfl.date_add) between "' . pSQL(date('Y-m-d', strtotime($param['from_date']))) . '"
                             AND "' . pSQL(date('Y-m-d', strtotime($param['to_date']))) . '")';
        } elseif ($param['from_date'] != '') {
            $date_condition .= ' AND DATE(sfl.date_add) >= "' . pSQL(date('Y-m-d', strtotime($param['from_date']))) . '"';
        } elseif ($param['to_date'] != '') {
            $date_condition .= ' AND DATE(sfl.date_add) <= "' . pSQL(date('Y-m-d', strtotime($param['to_date']))) . '"';
        }
        if ($param['products'] != '') {
            $product_condition = ' AND sfl.id_product IN (' . pSQL($param['products']) . ')';
        } else {
            $product_condition = ' AND sfl.id_product NOT IN (0)';
        }

        if (Tools::getIsset('fetch_graph') && Tools::getValue('fetch_graph')) {
            $fetch_graph = false;
        }

        $page_number = 1;
        $item_per_page = self::SFL_TBL_LIMIT;
        if (Tools::getIsset('page_number') && Tools::getValue('page_number') > 1) {
            $page_number = (int) Tools::getValue('page_number');
        }

        $cols = 'sfl.id_product, p.reference, DATE(sfl.date_add) as date_add, sfl.id_order, c.id_customer,
                            c.firstname, c.lastname, c.email, pl.name';

        $qry = 'select {COLUMN} from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . ' as sfl 
                            INNER JOIN ' . _DB_PREFIX_ . 'customer as c on (c.id_customer=sfl.id_customer AND c.id_shop = ' . (int) $this->context->shop->id . ') 
                            INNER JOIN ' . _DB_PREFIX_ . 'product as p on (sfl.id_product = p.id_product) 
                            INNER JOIN ' . _DB_PREFIX_ . 'product_lang as pl on (p.id_product = pl.id_product AND pl.id_lang = ' . (int) $this->context->language->id
                . ' AND pl.id_shop = ' . (int) $this->context->shop->id . ') where sfl.id_shop=' . (int) $this->context->shop->id
                . $product_condition . $date_condition;

        if (!$param['csv']) {
            $records = $this->getTotalPages($qry, 'COUNT(*) as total');

            $page_position = (($page_number - 1) * $item_per_page);
            $qry .= ' LIMIT ' . (int) $page_position . ', ' . (int) $item_per_page;
        }

        $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(str_replace('{COLUMN}', $cols, $qry));
        foreach ($results as $rs) {
            $tmp = array(
                'firstname' => $rs['firstname'],
                'lastname' => $rs['lastname'],
                'email' => $rs['email'],
                'name' => $rs['name'],
                'reference' => $rs['reference'],
                'date_add' => $rs['date_add']
            );
            $tmp['date_add'] = Tools::displayDate($rs['date_add']);
            $tmp['status'] = $this->l('No');
            $tmp['order_date'] = $this->l('NA');
            if (!empty($rs['id_order']) && $rs['id_order'] > 0) {
                $check_query = 'select * from ' . _DB_PREFIX_ . 'orders where id_order = ' . (int) $rs['id_order'];
                $order_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($check_query);
                if ($order_data && is_array($order_data)) {
                    $tmp['status'] = $this->l('Yes');
                    $tmp['order_date'] = Tools::displayDate($order_data['date_add']);
                }
            }
            $data[] = $tmp;
        }

        if (!$param['csv']) {
            if ($fetch_graph) {
                $graph = $this->getOrderGraph($param);
            }
        }

        if (count($data) > 0) {
            if (!$param['csv']) {
                $paging = $this->customPaginator($records['total_records'], $records['total_pages'], 'getOrderAnalysisTableReport', $page_number);
            } else {
                $paging = '';
            }
            return array(
                'flag' => true,
                'data' => $data,
                'graph' => $graph,
                'pagination' => $paging
            );
        } else {
            return array('flag' => false, 'graph' => $graph, 'pagination' => '');
        }
    }

    private function getOrderGraph($param)
    {
        $data = array();
        $start_date = date('Y-01-01', time());
        $end_date = date('Y-m-d', time());
        if ($param['from_date'] != '') {
            $start_date = date('Y-m-d', strtotime($param['from_date']));
        }
        if ($param['to_date'] != '') {
            $end_date = date('Y-m-d', strtotime($param['to_date']));
        }
        $start = $start_date;
        while ($start <= $end_date) {
            $saved = 0;
            $purchased = 0;
            $current_date = $start;
            if (date('Y', strtotime($start_date)) != date('Y', strtotime($end_date))) {
                $label = date('Y', strtotime($current_date));
                $condition = "YEAR(date_add) = '" . pSQL(date('Y', strtotime($current_date))) . "'";
                if (date('Y', strtotime($current_date)) == date('Y', strtotime($start_date))) {
                    $condition .= " AND DATE(date_add) >= '" . pSQL(date('Y-m-d', strtotime($start_date))) . "'";
                } elseif (date('Y', strtotime($current_date)) == date('Y', strtotime($end_date))) {
                    $condition .= " AND DATE(date_add) <= '" . pSQL(date('Y-m-d', strtotime($end_date))) . "'";
                }
            } else {
                $label = date('M, Y', strtotime($current_date));
                $condition = "(MONTH(date_add) = '" . pSQL(date('m', strtotime($current_date))) . "'
                                            AND YEAR(date_add) = '" . pSQL(date('Y', strtotime($current_date))) . "')";
                if (date('Y-m', strtotime($current_date)) == date('Y-m', strtotime($start_date))) {
                    $condition .= " AND DATE(date_add) >= '" . pSQL(date('Y-m-d', strtotime($start_date))) . "'";
                } elseif (date('Y-m', strtotime($current_date)) == date('Y-m', strtotime($end_date))) {
                    $condition .= " AND DATE(date_add) <= '" . pSQL(date('Y-m-d', strtotime($end_date))) . "'";
                }
            }
            
            if ($param['products'] != '') {
                $product_condition = ' AND id_product IN (' . pSQL($param['products']) . ')';
            } else {
                $product_condition = ' AND id_product NOT IN (0)';
            }
            $qry = 'Select COUNT(*) as total from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME
                    . ' where ' . $condition . $product_condition;

            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($qry);
            if ($result) {
                $saved = $result['total'];
            }

            $qry = 'Select COUNT(*) as total from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . ' where id_order > 0 AND ' . $condition . $product_condition;

            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($qry);
            if ($result) {
                $purchased = $result['total'];
            }

            $data[] = array(
                'tick' => $label,
                'saved' => $saved,
                'purchased' => $purchased
            );
            if (strtotime($start) == strtotime($end_date)) {
                break;
            }
            if (date('Y', strtotime($start_date)) != date('Y', strtotime($end_date))) {
                $start = date('Y-m-d', strtotime('1 year', strtotime($start)));
                if (strtotime($start) > strtotime($end_date)) {
                    $start = date('Y-m-d', strtotime($end_date));
                }
            } else {
                $start = date('Y-m-d', strtotime('1 month', strtotime($start)));
            }
        }
        return $data;
    }

    private function getCustomerProducts($param)
    {
        $date_condition = '';
        if ($param['from_date'] != '' && $param['to_date'] != '') {
            $date_condition .= ' AND (DATE(sfl.date_add) between "' . pSQL(date('Y-m-d', strtotime($param['from_date']))) . '"
                             AND "' . pSQL(date('Y-m-d', strtotime($param['to_date']))) . '")';
        } elseif ($param['from_date'] != '') {
            $date_condition .= ' AND DATE(sfl.date_add) >= "' . pSQL(date('Y-m-d', strtotime($param['from_date']))) . '"';
        } elseif ($param['to_date'] != '') {
            $date_condition .= ' AND DATE(sfl.date_add) <= "' . pSQL(date('Y-m-d', strtotime($param['to_date']))) . '"';
        }

        $pro_condition = '';
        if ($param['products'] != '') {
            $pro_condition = ' AND sfl.id_product IN (' . pSQL($param['products']) . ')';
        } else {
            $pro_condition = ' AND sfl.id_product NOT IN (0)';
        }

        $qry = 'select date(sfl.date_add) as date, sfl.id_order, pl.name, p.reference from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . ' sfl 
                            INNER JOIN ' . _DB_PREFIX_ . 'product as p on (sfl.id_product = p.id_product) 
                            INNER JOIN ' . _DB_PREFIX_ . 'product_lang as pl on (p.id_product = pl.id_product AND pl.id_lang = '
                . (int) $this->context->language->id . ' AND pl.id_shop = ' . (int) $this->context->shop->id . ') 
                            where sfl.id_customer = ' . (int) $param['id_customer'] . ' AND sfl.id_shop = ' . (int) $this->context->shop->id
                . $date_condition . $pro_condition;

        $product_list = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($qry);

        $saved_products = array();

        foreach ($product_list as $pro) {
            $tmp = array(
                'date' => Tools::displayDate($pro['date']),
                'name' => $pro['name'],
                'reference' => $pro['reference'],
                'purchased' => $this->l('No'),
                'order_date' => $this->l('NA')
            );

            if (!empty($pro['id_order']) && $pro['id_order'] > 0) {
                $check_query = 'select * from ' . _DB_PREFIX_ . 'orders where id_order = ' . (int) $pro['id_order'];
                $order_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($check_query);
                if ($order_data && is_array($order_data)) {
                    $tmp['purchased'] = $this->l('Yes');
                    $tmp['order_date'] = Tools::displayDate($order_data['date_add']);
                }
            }
            $saved_products[] = $tmp;
        }
        return $saved_products;
    }

    private function getSavedProducts($param)
    {
        $date_condition = '';
        if ($param['from_date'] != '' && $param['to_date'] != '') {
            $date_condition .= ' AND (DATE(sfl.date_add) between "' . pSQL(date('Y-m-d', strtotime($param['from_date']))) . '"
                             AND "' . pSQL(date('Y-m-d', strtotime($param['to_date']))) . '")';
        } elseif ($param['from_date'] != '') {
            $date_condition .= ' AND DATE(sfl.date_add) >= "' . pSQL(date('Y-m-d', strtotime($param['from_date']))) . '"';
        } elseif ($param['to_date'] != '') {
            $date_condition .= ' AND DATE(sfl.date_add) <= "' . pSQL(date('Y-m-d', strtotime($param['to_date']))) . '"';
        }

        $pro_condition = '';
        if ($param['products'] != '') {
            $pro_condition = ' AND sfl.id_product IN (' . pSQL($param['products']) . ')';
        } else {
            $pro_condition = ' AND sfl.id_product NOT IN (0)';
        }

        $qry = 'select sfl.id_product, COUNT(sfl.id_customer) as total from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . ' sfl 
                            INNER JOIN ' . _DB_PREFIX_ . 'category_product as cp on (sfl.id_product = cp.id_product)  
                            where sfl.id_shop = ' . (int) $this->context->shop->id
                . $date_condition . $pro_condition;
        if ($param['id_category'] > 0) {
            $qry .= ' AND cp.id_category = ' . (int) $param['id_category'];
        }

        $qry .= ' GROUP BY sfl.id_product';

        $product_list = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($qry);

        $saved_products = array();

        foreach ($product_list as $pro) {
            $product = new Product($pro['id_product'], false, $this->context->language->id, $this->context->shop->id);
            $saved_products[] = array(
                'id_product' => $pro['id_product'],
                'name' => $product->name,
                'reference' => $product->reference,
                'count' => $pro['total']
            );
            unset($product);
        }
        return $saved_products;
    }

    public function processProduct($id_product = 0)
    {
       
        $already_added = $this->getCookieProducts();
        $status = true;
        $action = 1;
        if (!in_array($id_product, $already_added)) {
            $status = $this->addProductToShortlist($id_product);
        } else {
            $action = 0;
            $status = $this->removeProductFromShortlist($id_product);
        }
        $json = array('status' => $status, 'action' => $action);
        if ($status) {
            $json['content'] = $this->refreshShortlistData();
        }
        echo Tools::jsonEncode($json);
        die;
    }

    private function addProductToShortlist($id_product)
    {
       
        $is_added = true;
        if ($this->context->cookie->logged) {
            $search_query = 'select id_customer,id_product from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . '
				where id_customer=' . (int) $this->context->cookie->id_customer . ' and id_product=' . (int) $id_product . '
				and (id_order IS NULL OR id_order = 0) and id_shop=' . (int) $this->context->shop->id;
            $saved_product = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($search_query);
            if (empty($saved_product) || count($saved_product) == 0) {
                $insert_pro = 'INSERT INTO `' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . '` (`id_product`, `id_customer`, `email`,
					`id_currency`, `currency_code`, `id_shop`, `id_lang`, `date_add`, `date_upd`) 
					VALUES ('
                        . (int) $id_product
                        . ', ' . (int) $this->context->cookie->id_customer
                        . ', "' . pSQL($this->context->cookie->email) . '", ' . (int) $this->context->currency->id . ', 
					"' . pSQL($this->context->currency->iso_code) . '", ' . (int) $this->context->shop->id
                        . ',' . (int) $this->context->language->id . ', now(), now())';
                if (!Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($insert_pro)) {
                    $is_added = false;
                }
            }
        }
        if ($is_added) {
            if ($this->context->cookie->velsof_shortlist != '') {
                $this->context->cookie->velsof_shortlist = $this->context->cookie->velsof_shortlist
                        . ',' . $id_product;
            } else {
                $this->context->cookie->velsof_shortlist = $id_product;
            }
        }
//                print_r($this->context->cookie->velsof_shortlist);die;
        return $is_added;
    }
            
    public function removeProductFromShortlist($id_product)
    {
      
        $is_removed = true;
        if ($this->context->cookie->logged) {
            $remove_fromdb = 'DELETE FROM `' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . '` 
				WHERE `id_product`=' . (int) $id_product . ' and `id_customer`=' . (int) $this->context->cookie->id_customer . ' 
				 and id_shop=' . (int) $this->context->shop->id;
            if (!Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($remove_fromdb)) {
                $is_removed = false;
            }
        }
        if ($is_removed) {
            $saved_arr = array();
            if ($this->context->cookie->velsof_shortlist != '') {
                $saved_arr = explode(',', $this->context->cookie->velsof_shortlist);
            }
            $this->context->cookie->velsof_shortlist = implode(',', array_diff($saved_arr, array($id_product)));
        }
        return $is_removed;
    }

    public function removeRecentViewedProduct($id_product)
    {
        $saved_arr = $this->getRecentlyViewedCookieProducts();
        $new = array_diff($saved_arr, array($id_product));
        if (count($new) > 0) {
            $this->context->cookie->viewed = implode(',', $new);
        } else {
            $this->context->cookie->viewed = '';
        }
        return true;
    }

    public function refreshShortlistData()
    {
        $shortlisted_products = array();
        if ($this->context->cookie->velsof_shortlist != '') {
            $shortlisted = explode(',', $this->context->cookie->velsof_shortlist);
        } else {
            $shortlisted = array();
        }

        if (count($shortlisted) > 0) {
            foreach ($shortlisted as $id_product) {
                $product = new Product($id_product, false, $this->context->language->id, $this->context->shop->id);
                $price_before = $product->getPrice(true, null, 2, null, false, false);

                $price = $product->getPrice(true, null, 2);
                $show_slashed_price = false;
                if ($price_before > $price) {
                    $show_slashed_price = true;
                }
                
                 $id_product_attribute = (int) Product::getDefaultAttribute($id_product);

                if (!empty($id_product_attribute)) {
                    $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute);
                } else {
                    $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product);
                }
                $disable = 1;
                if ($product_available_stock <= 1) {
                    $query = 'Select out_of_stock from ' . _DB_PREFIX_ . 'stock_available where id_product = ' . (int) $id_product;
                    $out_of_stock = Db::getInstance()->getValue($query);

                    if ((int) $out_of_stock == 0) {
                        $disable = 0;
                    } else if ((int) $out_of_stock == 2) {
                        $is_out_of_stock_orders_allowed = Configuration::get('PS_ORDER_OUT_OF_STOCK');
                        if ($is_out_of_stock_orders_allowed == 0) {
                            $disable = 0;
                        }
                    }
                }


                $shortlisted_products[] = array(
                    'product_id' => $id_product,
                    'name' => $product->name,
                    'url' => $this->context->link->getProductLink($product),
                    'link_rewrite' => $product->link_rewrite,
                    'price_before' => $price_before,
                    'price_before_formatted' => Tools::displayPrice($price_before),
                    'price' => $price,
                    'price_formatted' => Tools::displayPrice($price),
                    'show_slashed_price' => $show_slashed_price,
                    'id_image' => $product->getCoverWs(),
                    'image_path' => $this->context->link->getImageLink($product->link_rewrite, $product->getCoverWs(), ImageType::getFormattedName('small')),
                    'quantity' => $product_available_stock,
                    'buy_out_of_stock' => $disable
                );
            }
        }
        $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
        $this->smarty->assign('shortlisted_products', $shortlisted_products);
        $this->smarty->assign('total_shortlisted', count($shortlisted_products));
        $this->smarty->assign('kb_sfl_config', $plugin_data);

        return $this->display(__FILE__, 'views/templates/front/refresh.tpl');
    }
    //changes by tarun
    public function hookActionCustomerAccountAdd($params)
    {
        $shortlisted = array();
        $shortlisted = $this->getCookieProducts();

        foreach ($shortlisted as $id_product) {
            if ($this->context->cookie->logged) {
                $search_query = 'select id_customer,id_product from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . ' 
                                where id_customer=' . (int) $this->context->cookie->id_customer . '
                                and id_product=' . (int) $id_product
                        . ' and (id_order IS NULL OR id_order = 0) and id_shop=' . (int) $this->context->shop->id;

                $saved_product = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($search_query);
                if (empty($saved_product) || count($saved_product) == 0) {
                    $insert_pro = 'INSERT INTO `' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . '` (`id_product`, `id_customer`, `email`,
                                `id_currency`, `currency_code`, `id_shop`, `id_lang`, `date_add`, `date_upd`) 
                                    VALUES ('
                            . (int) $id_product
                            . ', ' . (int) $this->context->cookie->id_customer
                            . ', "' . pSQL($this->context->cookie->email) . '", ' . (int) $this->context->currency->id . ', 
                            "' . pSQL($this->context->currency->iso_code) . '", ' . (int) $this->context->shop->id
                            . ',' . (int) $this->context->language->id . ', now(), now())';
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($insert_pro);
                }
            }
        }
    }
//changes over
    /*
     * Function to delete the customer data from this module for the GDPR compliant plugin.
     */
    public function hookActionDeleteGDPRCustomer($customer)
    {
        if (!empty($customer['email']) && Validate::isEmail($customer['email'])) {
            if (Module::isInstalled($this->name)) {
                $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
                if (isset($plugin_data['general']) && $plugin_data['general']['enable']) {
                    $id_customer = Customer::customerExists($customer['email'], true, false);
                    if (!empty($id_customer)) {
                        $sql = 'Delete FROM ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME .' WHERE id_customer ='.(int)$id_customer;
                        if (Db::getInstance()->execute($sql)) {
                            return json_encode(true);
                        }
                    }
                    return json_encode($this->l('Advance Wishlist/Save for later: No user found with this email.'));
                }
            }
        }
    }
    
    /*
     * Function to export the customer data from this module for the GDPR compliant plugin.
     */
    public function hookActionExportGDPRData($customer)
    {
        if (!empty($customer['email']) && Validate::isEmail($customer['email'])) {
            if (Module::isInstalled($this->name)) {
                $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
                if (isset($plugin_data['general']) && $plugin_data['general']['enable']) {
                    $existing_customer = Db::getInstance()->executeS('SELECT id_customer from ' . _DB_PREFIX_ . 'customer where email="' . pSQL($customer['email']) . '"');
                    $gdpr_data = array();
                    if (!empty($existing_customer)) {
                        foreach ($existing_customer as $key => $existing_cust) {
                            $order_content = array();
                            $id_customer = $existing_cust['id_customer'];
                            if (!empty($id_customer)) {
                                $customer_product = array(
                                    'id_customer' => $id_customer,
                                    'from_date' => '',
                                    'to_date' => '',
                                    'products' => '',
                                    
                                );
                                $sflData = $this->getCustomerProducts($customer_product);
                                if (!empty($sflData)) {
                                    foreach ($sflData as $sfl_data) {
                                        $gdpr_data[] = array(
                                            $this->l('Product Name') => $sfl_data['name'],
                                            $this->l('Product Reference') => $sfl_data['reference'],
                                            $this->l('Date Added') => $sfl_data['date'],
                                            $this->l('Purchased') => $sfl_data['purchased'],
                                            $this->l('Order Placed On') => $sfl_data['order_date'],
                                        );
                                    }
                                }
                            }
                        }
                    }
                    if (!empty($gdpr_data) && count($gdpr_data) > 0) {
                          return json_encode($gdpr_data);
                    }
                    
                    return json_encode($this->l('Advance Wishlist/Save for later: No user found with this email.'));
                }
            }
        }
    }

    public function hookDisplayProductPriceBlock($params)
    {
        if ($params['type'] == 'weight') {
            $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
            if (isset($plugin_data['general']) && $plugin_data['general']['enable'] == 1 && isset($plugin_data['saveforlater']) && $plugin_data['saveforlater']['enable'] == 1) {
                $allowed_controllers = array('product');
                $controller = $this->context->controller;
                if (isset($controller->php_self) && !in_array($controller->php_self, $allowed_controllers)) {
                    if ($this->context->cookie->velsof_shortlist != '') {
                        $already_added = explode(',', $this->context->cookie->velsof_shortlist);
                    } else {
                        $already_added = array();
                    }
                    /* Start changes done by Shubham */
                    if (in_array($params['product']['id_product'], $already_added)) {
                        $this->smarty->assign('sfl_label', $this->l('Added'));
                        $this->smarty->assign('icon_color', "#ff2121");
                    } else {
                        $this->smarty->assign('sfl_label', $this->l('Shortlist'));
                        $this->smarty->assign('icon_color', "#000000");
                    }
                    /* End changes done by Shubham */
                    $this->smarty->assign('sfl_id_product', $params['product']['id_product']);
                    return $this->display(__FILE__, 'display_shortlist_link.tpl');
                }
            }
        }
        return '';
    }

    public function hookDisplayOrderConfirmation($params = null)
    {
        $id_customer = $params['order']->id_customer;
        $id_order = Tools::getValue('id_order');
        $id_cart = Tools::getValue('id_cart');
        $cart = new Cart($id_cart);
        $order_product = array();
        foreach ($cart->getProducts() as $pro) {
            $qry = 'update ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME
                    . ' set id_order=' . (int) $id_order
                    . ' where id_shop=' . (int) $params['order']->id_shop
                    . ' and id_product=' . (int) $pro['id_product']
                    . ' and id_customer=' . (int) $id_customer;
            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($qry);
            $order_product[] = $pro['id_product'];
        }
        $prev_shortlisted = $this->getCookieProducts();
        $new_shortlisted = array(); //updated by Anshul to fix the 500 internal issue on order confirmation page
        foreach ($prev_shortlisted as $pre) {
            if ($pre > 0 && !in_array($pre, $order_product)) {
                $new_shortlisted[] = $pre;
            }
        }
        if (is_array($new_shortlisted)) {
            $this->context->cookie->velsof_shortlist = implode(',', $new_shortlisted);
        } else {
            $this->context->cookie->velsof_shortlist = '';
        }

        unset($params);
        unset($cart);
    }

    private function getCookieProducts()
    {
        $shortlisted = array();
        $this->context->cookie->velsof_shortlist = trim($this->context->cookie->velsof_shortlist);
        $this->context->cookie->velsof_shortlist = trim($this->context->cookie->velsof_shortlist, ',');
        if ($this->context->cookie->velsof_shortlist != '') {
            $shortlisted = explode(',', $this->context->cookie->velsof_shortlist);
        } else {
            $shortlisted = array();
        }
        return $shortlisted;
    }

    private function getRecentlyViewedCookieProducts()
    {
        $recently_viewed = array();
        if ($this->context->cookie->viewed != '') {
            $recently_viewed = explode(',', $this->context->cookie->viewed);
        }
        $recently_viewed = array_unique($recently_viewed);
        if (count($recently_viewed) > 0) {
            $this->context->cookie->viewed = implode(',', $recently_viewed);
        } else {
            $this->context->cookie->viewed = '';
        }
        return $recently_viewed;
    }

    public function hookDisplayHeader()
    {
        $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
        $controller = $this->context->controller;
        $page = $controller->php_self;
       
        if ($plugin_data && ($plugin_data['general']['enable'] == 1)) {
            if (($plugin_data['recently_view']['enable'] == 1) ||
                    ($plugin_data['saveforlater']['enable'] == 1) ||
                    ($plugin_data['recommendation']['enable'] == 1)) {
                $id_product = Tools::getValue('id_product');
                if ($id_product != '') {
                    if ($this->context->cookie->viewed != '') {
                        $this->context->cookie->viewed = $this->context->cookie->viewed
                                . ',' . $id_product;
                    } else {
                        $this->context->cookie->viewed = $id_product;
                    }
                }

                $this->context->controller->addCSS($this->_path . 'views/css/front_bar.css');
                 $this->context->controller->addCSS($this->_path . 'views/css/wish.css');
                $this->context->controller->addCSS($this->_path . 'views/css/display_shorlist_link.css');
                $this->context->controller->addJS($this->_path . 'views/js/display_shortlist_link.js');
            }
        }
    }

    public function hookDisplayTop()
    {
        $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
        $controller = $this->context->controller;
        $page = $controller->php_self;
        if ($plugin_data && $plugin_data['general']['enable'] == 1 && $page != '') {
            if ($plugin_data['recently_view']['enable']) {
                $recently_viewed = $this->getRecentlyViewedCookieProducts();
                $recently_viewed = array_slice($recently_viewed, -((int) $plugin_data['recently_view']['limit']));
                $recent_products = array();
                foreach ($recently_viewed as $id_product) {
                    $product = new Product($id_product, false, $this->context->language->id, $this->context->shop->id);
                    $price_before = Product::getPriceStatic($product->id, true, null, 2, null, false, false);
                    $price = $product->getPrice(true, null, 2);

                    $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                    if (!empty($id_product_attribute)) {
                        $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute);
                    } else {
                        $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product);
                    }
                    $disable = 1;
                    if ($product_available_stock <= 1) {
                        $query = 'Select out_of_stock from ' . _DB_PREFIX_ . 'stock_available where id_product = ' . (int) $id_product;
                        $out_of_stock = Db::getInstance()->getValue($query);

                        if ((int) $out_of_stock == 0) {
                            $disable = 0;
                        } else if ((int) $out_of_stock == 2) {
                            $is_out_of_stock_orders_allowed = Configuration::get('PS_ORDER_OUT_OF_STOCK');
                            if ($is_out_of_stock_orders_allowed == 0) {
                                $disable = 0;
                            }
                        }
                    }

                    $show_slashed_price = false;
                    if ($price_before > $price) {
                        $show_slashed_price = true;
                    }
                    $recent_products[] = array(
                        'product_id' => $id_product,
                        'name' => $product->name,
                        'url' => $this->getProductLinkKb($id_product),
                        'link_rewrite' => $product->link_rewrite,
                        'price_before' => $price_before,
                        'price_before_formatted' => Tools::displayPrice($price_before),
                        'price' => $price,
                        'price_formatted' => Tools::displayPrice($price),
                        'show_slashed_price' => $show_slashed_price,
                        'id_image' => $product->getCoverWs(),
                        'quantity' => $product_available_stock,
                        'buy_out_of_stock' => $disable
                     
                    );
                }

                $this->smarty->assign('recent_viewed', $recent_products);
            }
            if ($plugin_data['saveforlater']['enable']) {
                $shortlisted_products = array();
                $shortlisted = $this->getCookieProducts();

                if ($this->context->cookie->logged) {
                    $select_products = 'select id_product from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME
                            . ' where id_customer=' . (int) $this->context->cookie->id_customer
                            . ' and (id_order IS NULL OR id_order = 0) and id_shop=' . (int) $this->context->shop->id;

                    $products = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($select_products);
                    if ($products && count($products) > 0) {
                        foreach ($products as $product) {
                            $shortlisted[] = $product['id_product'];
                        }
                        $shortlisted = array_unique($shortlisted);
                        $this->context->cookie->velsof_shortlist = implode(',', $shortlisted);
                    }
                }
                foreach ($shortlisted as $id_product) {
                    $product = new Product($id_product, false, $this->context->language->id, $this->context->shop->id);
                    $price_before = Product::getPriceStatic($product->id, true, null, 2, null, false, false);
                    $price = $product->getPrice(true, null, 2);
                    
                    $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                    if (!empty($id_product_attribute)) {
                        $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute);
                    } else {
                        $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product);
                    }
                     $disable = 1;
                    if ($product_available_stock <= 1) {
                        $query = 'Select out_of_stock from ' . _DB_PREFIX_ . 'stock_available where id_product = ' . (int) $id_product;
                        $out_of_stock = Db::getInstance()->getValue($query);

                        if ((int) $out_of_stock == 0) {
                            $disable = 0;
                        } else if ((int) $out_of_stock == 2) {
                            $is_out_of_stock_orders_allowed = Configuration::get('PS_ORDER_OUT_OF_STOCK');
                            if ($is_out_of_stock_orders_allowed == 0) {
                                $disable = 0;
                            }
                        }
                    }

                    $show_slashed_price = false;
                    if ($price_before > $price) {
                        $show_slashed_price = true;
                    }
                    $shortlisted_products[] = array(
                        'product_id' => $id_product,
                        'name' => $product->name,
                        'url' => $this->getProductLinkKb($id_product),
                        'link_rewrite' => $product->link_rewrite,
                        'price_before' => $price_before,
                        'price_before_formatted' => Tools::displayPrice($price_before),
                        'price' => $price,
                        'price_formatted' => Tools::displayPrice($price),
                        'show_slashed_price' => $show_slashed_price,
                        'id_image' => $product->getCoverWs(),
                        'quantity' => $product_available_stock,
                        'buy_out_of_stock' => $disable
                        );
                }
                $this->smarty->assign('shortlisted_products', $shortlisted_products);
            }

            if ($plugin_data['recommendation']['enable']) {
                $recommendations = unserialize(Configuration::get('KB_SAVE_LATER_RECOMM'));
                $content = array();
                if ($recommendations['setting'] == parent::SFL_BANNER) {
                    $file_path = _PS_MODULE_DIR_ . 'saveforlater/' . parent::BANNER_PATH . '/' . $this->context->shop->id . '/';
                    $file_url = $this->getBaseLink(null, (bool) Configuration::get('PS_SSL_ENABLED'))
                            . 'modules/saveforlater/' . self::BANNER_PATH . $this->context->shop->id . '/';
                    foreach ($recommendations['content'] as $cont) {
                        if (Tools::file_exists_no_cache($file_path . $cont['name'])) {
                            if (!Tools::file_exists_no_cache($file_path . 'temp_' . $cont['name'])) {
                                $img = new ImageManager();
                                $is_resized = $img->resize($file_path . $cont['name'], $file_path . 'temp_' . $cont['name'], parent::BANNER_WIDTH, parent::BANNER_HEIGHT);
                                if ($is_resized) {
                                    $content[] = array(
                                        'src' => $file_url . 'temp_' . $cont['name'] . '?t=' . time(),
                                        'title' => $cont['title'],
                                        'link' => $cont['link']
                                    );
                                }
                            } else {
                                $content[] = array(
                                    'src' => $file_url . 'temp_' . $cont['name'] . '?t=' . time(),
                                    'title' => $cont['title'],
                                    'link' => $cont['link']
                                );
                            }
                        }
                    }
                } elseif ($recommendations['setting'] == parent::SFL_SEL_PRODUCTS) {
                    foreach ($recommendations['content'] as $id_product) {
                        $product = new Product($id_product, false, $this->context->language->id, $this->context->shop->id);
                        $price_before = Product::getPriceStatic($product->id, true, null, 2, null, false, false);
                        $price = $product->getPrice(true, null, 2);
                        
                         $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                        if (!empty($id_product_attribute)) {
                            $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute);
                        } else {
                            $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product);
                        }
                         $disable = 1;
                        if ($product_available_stock <= 1) {
                            $query = 'Select out_of_stock from ' . _DB_PREFIX_ . 'stock_available where id_product = ' . (int) $id_product;
                            $out_of_stock = Db::getInstance()->getValue($query);

                            if ((int) $out_of_stock == 0) {
                                $disable = 0;
                            } else if ((int) $out_of_stock == 2) {
                                $is_out_of_stock_orders_allowed = Configuration::get('PS_ORDER_OUT_OF_STOCK');
                                if ($is_out_of_stock_orders_allowed == 0) {
                                    $disable = 0;
                                }
                            }
                        }
                        $show_slashed_price = false;
                        if ($price_before > $price) {
                            $show_slashed_price = true;
                        }
                        $content[] = array(
                            'product_id' => $id_product,
                            'name' => $product->name,
                            'url' => $this->getProductLinkKb($id_product),
                            'link_rewrite' => $product->link_rewrite,
                            'price_before' => $price_before,
                            'price_before_formatted' => Tools::displayPrice($price_before),
                            'price' => $price,
                            'price_formatted' => Tools::displayPrice($price),
                            'show_slashed_price' => $show_slashed_price,
                            'id_image' => $product->getCoverWs(),
                            'quantity' => $product_available_stock,
                            'buy_out_of_stock' => $disable
                        );
                    }
                } elseif ($recommendations['setting'] == parent::SFL_RELATED) {
                    $recently_viewed = $this->getRecentlyViewedCookieProducts();
                    $already_shortlisted = $this->getCookieProducts();
                    $products = array();
                    $recommended = array();
                    if ($recently_viewed) {
                        foreach ($recently_viewed as $pid) {
                            $get_category = 'select max(id_category) from ' . _DB_PREFIX_ . 'category_product 
                                                                    where id_product=' . (int) $pid;
                            $category = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_category);

                            $cat_list = $category['max(id_category)'];

                            $get_products = 'select k.id_product from ' . _DB_PREFIX_ . 'category_product k INNER JOIN ' . _DB_PREFIX_ . 'product p ON (k.id_product = p.id_product) where k.id_category =' . $cat_list .' AND p.active=1';
                            $selected_product = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($get_products);
                            foreach ($selected_product as $product) {
                                if ($product['id_product'] != $pid) {
                                    $products[] = $product['id_product'];
                                }
                            }
                        }
                        foreach ($products as $product) {
                            if (is_array($product)) {
                                if (!in_array($product['product_id'], $recommended)) {
                                    $recommended[] = $product['product_id'];
                                }
                            } else {
                                if (!in_array($product, $recommended)) {
                                    $recommended[] = $product;
                                }
                            }
                        }
                        foreach ($recommended as $id_product) {
                            $product = new Product($id_product, false, $this->context->language->id, $this->context->shop->id);
                            $price_before = Product::getPriceStatic($product->id, true, null, 2, null, false, false);
                            $price = $product->getPrice(true, null, 2);
                            $show_slashed_price = false;
                            if ($price_before > $price) {
                                $show_slashed_price = true;
                            }
                            
                             $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                            if (!empty($id_product_attribute)) {
                                $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute);
                            } else {
                                $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product);
                            }
                            $disable = 1;
                            if ($product_available_stock <= 1) {
                                $query = 'Select out_of_stock from ' . _DB_PREFIX_ . 'stock_available where id_product = ' . (int) $id_product;
                                $out_of_stock = Db::getInstance()->getValue($query);

                                if ((int) $out_of_stock == 0) {
                                    $disable = 0;
                                } else if ((int) $out_of_stock == 2) {
                                    $is_out_of_stock_orders_allowed = Configuration::get('PS_ORDER_OUT_OF_STOCK');
                                    if ($is_out_of_stock_orders_allowed == 0) {
                                        $disable = 0;
                                    }
                                }
                            }
                            $content[] = array(
                                'product_id' => $id_product,
                                'name' => $product->name,
                                'url' => $this->getProductLinkKb($id_product),
                                'link_rewrite' => $product->link_rewrite,
                                'price_before' => $price_before,
                                'price_before_formatted' => Tools::displayPrice($price_before),
                                'price' => $price,
                                'price_formatted' => Tools::displayPrice($price),
                                'show_slashed_price' => $show_slashed_price,
                                'id_image' => $product->getCoverWs(),
                                'quantity' => $product_available_stock,
                                'buy_out_of_stock' => $disable
                            );
                        }
                    }
                }
                $this->smarty->assign('recommend', $recommendations['setting']);
                $this->smarty->assign('content', $content);
            }
            $img_location = $this->getBaseLink(null, (bool) Configuration::get('PS_SSL_ENABLED'));
            $custom_ssl_var = 0;
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                $custom_ssl_var = 1;
            }
            $image_link_has_https = false;
            if (strpos($img_location, 'https') !== false) {
                $image_link_has_https = true;
            }
            if ((bool) Configuration::get('PS_SSL_ENABLED') && $custom_ssl_var == 1 && $image_link_has_https != true) {
                $img_location = str_replace('http', 'https', $img_location);
            }

            $this->smarty->assign('kb_sfl_config', $plugin_data);
            $this->smarty->assign('img_location', $img_location . 'modules/saveforlater/views/img/');
            $this->smarty->assign('id_lang', $this->context->cookie->id_lang);

            if ($this->context->cookie->velsof_shortlist != '') {
                $already_added = explode(',', $this->context->cookie->velsof_shortlist);
            } else {
                $already_added[0] = 0;
            }

            $this->smarty->assign(array(
                'sfl_aleady_added_products' => $already_added,
                'sfl_shorlist_text' => $this->l('Shortlist'),
                'sfl_already_added_text' => $this->l('Added'),
                'ajaxurl' => $this->context->link->getModuleLink('saveforlater', 'ajaxhandler', array(), (bool) Configuration::get('PS_SSL_ENABLED'))
            ));

            
            if ($plugin_data['saveforlater']['enable']) {
                $this->smarty->assign('saveforlater_enable', 1);
            } else {
                $this->smarty->assign('saveforlater_enable', 0);
            }
            return $this->display(__FILE__, 'add_list.tpl');
        }
    }
    
     /* Start changes done by Shubham */

    public function hookDisplayCustomerAccount()
    {
        $data = unserialize(Configuration::get('KB_SAVE_LATER'));
        if ($data['general']['enable'] == 1) {
            if ($this->context->controller->php_self == 'my-account') {
                return $this->display(__FILE__, 'my_wishlist.tpl');
            }
        }
    }
    
    public function hookActionAuthentication($params)
    {
        $shortlisted = array();
        $shortlisted = $this->getCookieProducts();

        foreach ($shortlisted as $id_product) {
            if ($this->context->cookie->logged) {
                $search_query = 'select id_customer,id_product from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . ' 
where id_customer=' . (int) $this->context->cookie->id_customer . '
and id_product=' . (int) $id_product
                    . ' and (id_order IS NULL OR id_order = 0) and id_shop=' . (int) $this->context->shop->id;

                $saved_product = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($search_query);
                if (empty($saved_product) || count($saved_product) == 0) {
                    $insert_pro = 'INSERT INTO `' . _DB_PREFIX_ . parent::SFL_MODEL_NAME . '` (`id_product`, `id_customer`, `email`,
`id_currency`, `currency_code`, `id_shop`, `id_lang`, `date_add`, `date_upd`) 
VALUES ('
                        . (int) $id_product
                        . ', ' . (int) $this->context->cookie->id_customer
                        . ', "' . pSQL($this->context->cookie->email) . '", ' . (int) $this->context->currency->id . ', 
"' . pSQL($this->context->currency->iso_code) . '", ' . (int) $this->context->shop->id
                        . ',' . (int) $this->context->language->id . ', now(), now())';
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($insert_pro);
                }
            }
        }
    }
    
    /* Start changes done by Shubham */

    public function hookdisplayCartExtraProductActions($param)
    {

        $data = unserialize(Configuration::get('KB_SAVE_LATER'));
        if ($data['general']['enable'] == 1) {
            $product_id = $param['product']['id_product'];
            $product_id_attribute = $param['product']['id_product_attribute'];
            $product_id_customization = $param['product']['id_customization'];

            $plugin_data = Tools::jsonDecode(Configuration::get('KB_SAVE_LATER'), true);
            $this->context->smarty->assign('kb_sfl_config', $plugin_data);
            $this->context->smarty->assign('product_id', $product_id);
            $this->context->smarty->assign('product_id_attribute', $product_id_attribute);
            $this->context->smarty->assign('product_id_customization', $product_id_customization);

            if ($this->context->cookie->velsof_shortlist != '') {
                $already_added = explode(',', $this->context->cookie->velsof_shortlist);
            } else {
                $already_added[0] = 0;
            }

            $this->context->smarty->assign('already_added', $already_added);
            $this->smarty->assign(array(
                'ajaxurl' => $this->context->link->getModuleLink('saveforlater', 'ajaxhandler', array(), (bool) Configuration::get('PS_SSL_ENABLED'))
            ));
            return $this->display(__FILE__, 'cart_to_wishlist_button.tpl');
        }
    }
    
    public function hookDisplayProductButtons($param)
    {
        $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
        if (isset($plugin_data['general']) && $plugin_data['general']['enable'] == 1 && isset($plugin_data['saveforlater']) && $plugin_data['saveforlater']['enable'] == 1) {
            if ($this->context->cookie->velsof_shortlist != '') {
                $already_added = explode(',', $this->context->cookie->velsof_shortlist);
            } else {
                $already_added = array();
            }
            /* Start changes done by Shubham */
            if (in_array(Tools::getValue('id_product'), $already_added)) {
                $this->smarty->assign('sfl_label', $this->l('Added'));
                $this->smarty->assign('icon_color', "#ff2121");
            } else {
                $this->smarty->assign('sfl_label', $this->l('Shortlist'));
                $this->smarty->assign('icon_color', "#000000");
            }
            /* End changes done by Shubham */
            $this->smarty->assign('sfl_id_product', Tools::getValue('id_product'));
            return $this->display(__FILE__, 'display_shortlist_link_product.tpl');
        }
        return '';
    }
    
    public function hookActionCustomerLogoutBefore()
    {
        Context::getContext()->cookie->velsof_shortlist = '';
    }
    
    
    public function hookdisplayFooterBefore()
    {

        $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
        if ($plugin_data['saveforlater']['enable']) {
            $shortlisted_products = array();
            $shortlisted = $this->getCookieProducts();

            if ($this->context->cookie->logged) {
                $select_products = 'select id_product from ' . _DB_PREFIX_ . parent::SFL_MODEL_NAME
                        . ' where id_customer=' . (int) $this->context->cookie->id_customer
                        . ' and (id_order IS NULL OR id_order = 0) and id_shop=' . (int) $this->context->shop->id;

                $products = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($select_products);
                if ($products && count($products) > 0) {
                    foreach ($products as $product) {
                        $shortlisted[] = $product['id_product'];
                    }

                    $shortlisted = array_unique($shortlisted);
                    $this->context->cookie->velsof_shortlist = implode(',', $shortlisted);
                }
            }

            foreach ($shortlisted as $id_product) {
                $product = new Product($id_product, false, $this->context->language->id, $this->context->shop->id);
                $id_product_attribute = (int) Product::getDefaultAttribute($id_product);

                $id_product_attribute_comb = $product->getAttributeCombinationsById($id_product_attribute, $this->context->language->id);

                $attributes = array();
                foreach ($id_product_attribute_comb as $pro) {
                    $attributes[] = array('group' => $pro['group_name'], 'attribute' => $pro['attribute_name']);
                }

                if (!empty($id_product_attribute)) {
                    $minimal_quantity = (int) Attribute::getAttributeMinimalQty($id_product_attribute);
                    $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute);
                } else {
                    $minimal_quantity = (int) $product->minimal_quantity;
                     $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product);
                }


                $price_before = Product::getPriceStatic($product->id, true, null, 2, null, false, false);
                $price = $product->getPrice(true, null, 2);
                $show_slashed_price = false;
                if ($price_before > $price) {
                    $show_slashed_price = true;
                }

                $disable = 1;
                //$product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product_attribute);

                if ($product_available_stock <= 1) {
                    $query = 'Select out_of_stock from ' . _DB_PREFIX_ . 'stock_available where id_product = ' . (int) $id_product;
                    $out_of_stock = Db::getInstance()->getValue($query);

                    if ((int) $out_of_stock == 0) {
                        $disable = 0;
                    } else if ((int) $out_of_stock == 2) {
                        $is_out_of_stock_orders_allowed = Configuration::get('PS_ORDER_OUT_OF_STOCK');
                        if ($is_out_of_stock_orders_allowed == 0) {
                            $disable = 0;
                        }
                    }
                }

                $shortlisted_products[] = array(
                    'product_id' => $id_product,
                    'name' => $product->name,
                    'url' => $this->context->link->getProductLink($product),
                    'link_rewrite' => $product->link_rewrite,
                    'price_before' => $price_before,
                    'price_before_formatted' => Tools::displayPrice($price_before),
                    'price' => $price,
                    'price_formatted' => Tools::displayPrice($price),
                    'show_slashed_price' => $show_slashed_price,
                    'description' => $product->description_short,
                    'attributes' => $attributes,
                    'id_image' => $product->getCoverWs(),
                    'quantity' => $product_available_stock,
                    'buy_out_of_stock' => $disable,
                    'minimal_quantity' => $minimal_quantity
                );
            }

            if ($this->context->cookie->velsof_shortlist != '') {
                $already_added = explode(',', $this->context->cookie->velsof_shortlist);
            } else {
                $already_added[0] = 0;
            }

//            $pro = array();
//            $cart_data = $this->context->cart->getProducts();
//            foreach ($cart_data as $data) {
//                $pro[] = $data['id_product'];
//            }
//
//
//            $this->context->smarty->assign('cart_products', $pro);
            $this->context->smarty->assign('already_added', $already_added);
            $this->smarty->assign('shortlisted_products', $shortlisted_products);
            $this->context->smarty->assign('kb_sfl_config', $plugin_data);
            $this->smarty->assign('total_shortlisted', count($shortlisted_products));

            return $this->display(__FILE__, 'order_page_wishlist.tpl');
        }
    }

    /* End changes done by Shubham */
}
