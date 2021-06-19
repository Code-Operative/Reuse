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

require_once _PS_MODULE_DIR_ . 'kbmpdealmanager/libraries/KbSellerDeal.php';
require_once _PS_MODULE_DIR_ . 'kbmarketplace/controllers/front/KbFrontCore.php';

class KbmpdealmanagerDealproductsModuleFrontController extends KbmarketplaceFrontCoreModuleFrontController
{
    public $controller_name = 'dealproducts';
    private $page_limit = 12;

    public function __construct()
    {
        require_once _PS_MODULE_DIR_ . 'kbmpdealmanager/KbDealRule.php';
        parent::__construct();

        $this->module = Module::getInstanceByName('kbmarketplace');
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS(_THEME_CSS_DIR_ . 'product.css');
        $this->addCSS(_THEME_CSS_DIR_ . 'product_list.css');
    }

    public function initContent()
    {
        $this->renderDealProduct();

        parent::initContent();
    }

    protected function setKbTemplate($template)
    {
        if (!$path = $this->getKbTemplatePath($template)) {
            throw new PrestaShopException("Template '$template' not found");
        }

        $this->kbtemplate = $path;
    }

    public function fetchTemplate()
    {
        if (!Tools::file_exists_cache($this->kbtemplate)) {
            throw new PrestaShopException("Template ' . $this->kbtemplate . ' not found");
        }

        return $this->context->smarty->fetch($this->kbtemplate);
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
    public function renderDealProduct()
    {
        $product_list= array();
        $temp_module_name = $this->kb_module_name;
        $this->kb_module_name = 'kbmpdealmanager';
        $deal_obj = new KbSellerDeal((int) Tools::getValue('id_deal', 0));
        $id_seller = $deal_obj->id_seller;
        if ((int)$id_seller > 0) {
            $seller = new KbSeller($id_seller);
            if ($seller->isSeller()) {
                $seller_info = $seller->getSellerInfo();
                $title = sprintf($this->getTranslatedText('Seller Shop - %s', 'Sellerfront'), $seller_info['title']);
                $this->context->smarty->assign('kb_page_title', $title);
                $id_category = Tools::getValue('s_filter_category', '');
                $filters = array();

                if ((int)$id_category > 0) {
                    $filters['id_category'] = (int)$id_category;
                }

                $this->context->smarty->assign('selected_category', $id_category);

                $sort_by = array('by' => 'pl.name', 'way' => 'ASC');
                $seleted_sort = '';
                if (Tools::getIsset('s_filter_sortby') && Tools::getValue('s_filter_sortby')) {
                    $seleted_sort = Tools::getValue('s_filter_sortby');
                    $explode = explode(':', Tools::getValue('s_filter_sortby'));
                    $sort_by['by'] = $explode[0];
                    $sort_by['way'] = $explode[1];
                }

                $this->context->smarty->assign('selected_sort', $seleted_sort);
                $products = KbSellerProduct::getProductsWithDetails(
                    $id_seller,
                    $this->context->language->id,
                    $filters,
                    false,
                    false,
                    $this->page_limit,
                    $sort_by['by'],
                    $sort_by['way']
                );

                $cat_rules_tmp = KbDealRule::getDealCategoryRules((int) Tools::getValue('id_deal', 0));
                $cat_rules = array();
                if (!empty($cat_rules_tmp)) {
                    $this->deal = new KbSellerDeal((int) Tools::getValue('id_deal', 0));
                    if ($this->deal->deal_type == DealTool::DEAL_TYPE_CART) {
                        foreach ($cat_rules_tmp['value'] as $c) {
                            $cat_rules[] = $c['id_item'];
                        }
                    }
                    if ($this->deal->deal_type == DealTool::DEAL_TYPE_CATALOG) {
                        foreach ($cat_rules_tmp as $c) {
                            $cat_rules[] = $c['value'];
                        }
                    }
                }

                $manu_rules_tmp = KbDealRule::getDealManufacturerRules((int) Tools::getValue('id_deal', 0));
                $manu_rules = array();
                if (!empty($manu_rules_tmp)) {
                    foreach ($manu_rules_tmp as $m) {
                        $manu_rules[] = $m['value'];
                    }
                }
                if (!empty($cat_rules) && !empty($manu_rules)) {
                    $product_list_category = array();
                    $product_list_manu  = array();
                    if (!empty($cat_rules)) {
                        foreach ($cat_rules as $item) {
                            $sql = 'SELECT id_product FROM '._DB_PREFIX_.'category_product WHERE id_category='.(int) $item;
                            $row = Db::getInstance()->ExecuteS($sql);
                            foreach ($products as $seller_product) {
                                foreach ($row as $product_id) {
                                    if ($product_id['id_product'] == $seller_product['id_product']) {
                                        $product_list_category[] = $seller_product;
                                    }
                                }
                            }
                        }
                    }
                    if (!empty($manu_rules)) {
                        foreach ($manu_rules as $item) {
                            $sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE id_manufacturer='.(int) $item;
                            $row = Db::getInstance()->ExecuteS($sql);

                            foreach ($products as $seller_product) {
                                foreach ($row as $product_id) {
                                    if ($product_id['id_product'] == $seller_product['id_product']) {
                                        $product_list_manu[] = $seller_product;
                                    }
                                }
                            }
                        }
                    }
                    foreach($product_list_category as $cat_key => $cat_value) {
                        foreach ($product_list_manu as $manu_key => $manu_value) {
                            if ($cat_value['id_product'] == $manu_value['id_product']) {
                                $product_list[] = $cat_value;
                                break;
                            }
                        }
                    }
                } else {
                        if (!empty($cat_rules)) {
                        foreach ($cat_rules as $item) {
                            $sql = 'SELECT id_product FROM '._DB_PREFIX_.'category_product WHERE id_category='.(int) $item;
                            $row = Db::getInstance()->ExecuteS($sql);
                            foreach ($products as $seller_product) {
                                foreach ($row as $product_id) {
                                    if ($product_id['id_product'] == $seller_product['id_product']) {
                                        $product_list[] = $seller_product;
                                    }
                                }
                            }
                        }
                    }


                    if (!empty($manu_rules)) {
                        foreach ($manu_rules as $item) {
                            $sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE id_manufacturer='.(int) $item;
                            $row = Db::getInstance()->ExecuteS($sql);

                            foreach ($products as $seller_product) {
                                foreach ($row as $product_id) {
                                    if ($product_id['id_product'] == $seller_product['id_product']) {
                                        $product_list[] = $seller_product;
                                    }
                                }
                            }
                        }
                    }
                }
                
                $prod_rules_tmp = kbDealRule::getDealProductRules((int) Tools::getValue('id_deal', 0));
                $prod_rules = array();
                if (!empty($prod_rules_tmp)) {
                    foreach ($prod_rules_tmp as $prod) {
                        $prod_rules[] = $prod['value'];
                    }
                }

                if (!empty($prod_rules)) {
                    foreach ($prod_rules as $item) {
                        foreach ($products as $seller_product) {
                            if ($item['id_item'] == $seller_product['id_product']) {
                                $product_list[] = $seller_product;
                            }
                        }
                    }
                }

                if (!isset($product_list)) {
                    $product_list = array();
                }
    
                $product_list = array_map("unserialize", array_unique(array_map("serialize", $product_list)));

                $products = Product::getProductsProperties((int)$this->context->language->id, $product_list);

                $total_records = count($products);

                $start = 1;
                if ((int)Tools::getValue('page_number', 0) > 0) {
                    $start = (int)Tools::getValue('page_number', 0);
                }

                $this->context->smarty->assign('seller_product_current_page', $start);

                $paging = KbGlobal::getPaging($total_records, $start, $this->page_limit, false, 'getSProduct2User');

                $products = array_map(array($this, 'prepareProductForTemplate'), $products);
                $this->context->smarty->assign('products', $products);

                if ($products && count($products) > 0) {
                    $pagination_string = sprintf(
                        $this->getTranslatedText('Showing %d - %d of %d items', 'Sellerfront'),
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
                        array('id_deal' => (int) Tools::getValue('id_deal', 0)),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    )
                );

                $this->context->smarty->assign('category_list', $this->getCategoryList());

                $this->context->smarty->assign('kb_pagination', $paging);

                $this->setKbTemplate('deals/dealsproducts.tpl');
                $this->kb_module_name = $temp_module_name;
            }
        }
    }
}
