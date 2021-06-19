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
class CartRule extends CartRuleCore
{
    /*
    * module: kbmarketplace
    * date: 2021-02-17 18:55:22
    * version: 4.0.5
    */
    public function checkValidity(
        Context $context,
        $already_in_cart = false,
        $display_error = true,
        $check_carrier = true
    ) {
        
        $is_valid = parent::checkValidity($context, $already_in_cart, $display_error, $check_carrier);
        if (Module::isInstalled('kbmpdealmanager') && Module::isEnabled('kbmpdealmanager')) {
            require_once _PS_MODULE_DIR_ . 'kbmpdealmanager/KbDealRule.php';
            $id_cart_rule = $this->id;
            $sql = 'select id_seller_deal from ' . _DB_PREFIX_ . 'kbmp_seller_deal where id_cart_rule ='. $id_cart_rule . ' and deal_type = '.DealTool::DEAL_TYPE_CART;
            $id_seller_deal = (int) DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
            if ((bool) $id_seller_deal) {
                $deal_obj = new KbSellerDeal($id_seller_deal);
                /*
                 * We have added the compatibility with our deal manager plugin and we are using the function of that module class
                 * that's why we have used its function.
                 */
                $cat_rules_tmp = KbDealRule::getDealCategoryRules($deal_obj->id);
                $cat_rules = array();
                if (!empty($cat_rules_tmp)) {
                    if ($deal_obj->deal_type == DealTool::DEAL_TYPE_CART) {
                        foreach ($cat_rules_tmp['value'] as $c) {
                            $cat_rules[] = $c['id_item'];
                        }
                    }
                    if ($deal_obj->deal_type == DealTool::DEAL_TYPE_CATALOG) {
                        foreach ($cat_rules_tmp as $c) {
                            $cat_rules[] = $c['value'];
                        }
                    }
                }
                /*
                 * We have added the compatibility with our deal manager plugin and we are using the function of that module class
                 * that's why we have used its function.
                 */
                $manu_rules_tmp = KbDealRule::getDealManufacturerRules($deal_obj->id);
                $manu_rules = array();
                if (!empty($manu_rules_tmp)) {
                    foreach ($manu_rules_tmp as $m) {
                        $manu_rules[] = $m['value'];
                    }
                }
                $is_Seller_deal_product_in_cart =  false;
                if (count($manu_rules) > 0 && count($cat_rules)) {
                    $products = $context->cart->getProducts();
                    if ($products) {
                        foreach ($products as $product) {
                            $check_product_query = 'SELECT COUNT(*) as row from ' . _DB_PREFIX_ . 'kb_mp_seller_product 
                                where id_product = ' . (int) $product['id_product'] .' and id_seller = '.(int) $deal_obj->id_seller;
                            if ((bool) DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($check_product_query)) {
                                if (in_array($product['id_manufacturer'], $manu_rules)) {
                                    $selected_cat = Product::getProductCategories($product['id_product']);
                                    if (is_array($selected_cat) && count($selected_cat) > 0) {
                                        foreach ($selected_cat as $cat_key => $cat_value) {
                                            if (in_array($cat_value, $cat_rules)) {
                                                $is_Seller_deal_product_in_cart =  true;
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
                            if ($is_Seller_deal_product_in_cart) {
                                break;
                            }
                        }
                    }
                } else if (count($manu_rules) > 0) {
                    $products = $context->cart->getProducts();
                    if ($products) {
                        foreach ($products as $product) {
                            $check_product_query = 'SELECT COUNT(*) as row from ' . _DB_PREFIX_ . 'kb_mp_seller_product 
                                where id_product = ' . (int) $product['id_product'] .' and id_seller = '.(int) $deal_obj->id_seller;
                            if ((bool) DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($check_product_query)) {
                                if (in_array($product['id_manufacturer'], $manu_rules)) {
                                    $is_Seller_deal_product_in_cart =  true;
                                    break;
                                }
                            }
                        }
                    }
                } else if (count($cat_rules) > 0) {
                    $products = $context->cart->getProducts();
                    if ($products) {
                        foreach ($products as $product) {
                            $check_product_query = 'SELECT COUNT(*) as row from ' . _DB_PREFIX_ . 'kb_mp_seller_product 
                                where id_product = ' . (int) $product['id_product'] .' and id_seller = '.(int) $deal_obj->id_seller;
                            if ((bool) DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($check_product_query)) {
                                $selected_cat = Product::getProductCategories($product['id_product']);
                                if (is_array($selected_cat) && count($selected_cat) > 0) {
                                    foreach ($selected_cat as $cat_key => $cat_value) {
                                        if (in_array($cat_value, $cat_rules)) {
                                            $is_Seller_deal_product_in_cart =  true;
                                            break;
                                        }
                                    }
                                }
                            }
                            if ($is_Seller_deal_product_in_cart) {
                                break;
                            }
                        }
                    }
                }
                if (!$is_Seller_deal_product_in_cart) {
                    $deal_manager_obj = Module::getInstanceByName('kbmpdealmanager');
                    $language = Language::getIsoById(Context::getContext()->language->id);
                    $error_msg = 'This voucher cannot be used with this order as this order does not contain the Deal products';
                    $translated_error_msg = $deal_manager_obj->getModuleTranslationByLanguage('kbmpdealmanager', $error_msg, 'kbmpdealmanager', $language);
                    return (!$display_error) ? false : Tools::displayError($translated_error_msg);
                }
            }
        }
        $products = $context->cart->getProducts();
        $issellersProductsInCart = false;
        if ($products) {
            foreach ($products as $product) {
                $check_product_query = 'SELECT COUNT(*) as row from ' . _DB_PREFIX_ . 'kb_mp_seller_product 
                    where id_product = ' . (int) $product['id_product'];
                if ((bool) DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($check_product_query)) {
                    $issellersProductsInCart = true;
                }
            }
        }
        $kbmpsettings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if ($issellersProductsInCart
            && $this->free_shipping
            && !$kbmpsettings['kbmp_enable_free_shipping']
        ) {
            $marketplace_obj = Module::getInstanceByName('kbmarketplace');
            $error_msg = 'This voucher cannot be used with this order as this order contains the seller products';
            $language = Language::getIsoById(Context::getContext()->language->id);
            $translated_error_msg = $marketplace_obj->getModuleTranslationByLanguage('kbmarketplace', $error_msg, 'kbconfiguration', $language);
            return (!$display_error) ? false : Tools::displayError($translated_error_msg);
        }
        return $is_valid;
    }
}
