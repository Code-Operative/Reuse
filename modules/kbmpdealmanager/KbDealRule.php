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

class KbDealRule extends ObjectModel
{
    public $id;
    public $id_seller_deal;
    public $rule_type;
    public $value;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'kbmp_deal_rule',
        'primary' => 'id_kbmp_deal_rule',
        'fields' => array(
            'id_seller_deal' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'rule_type' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'value' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true)
        )
    );

    public static function getDealRules($id_seller_deal)
    {
        $sql = 'Select * from ' . _DB_PREFIX_ . 'kbmp_deal_rule WHERE id_seller_deal = ' . (int) $id_seller_deal;

        return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }

    public static function getDealCategoryRules($id_seller_deal)
    {
        $deal = new KbSellerDeal($id_seller_deal);
        if (Validate::isLoadedObject($deal)) {
            if ($deal->deal_type == DealTool::DEAL_TYPE_CATALOG) {
                $sql = 'Select * from ' . _DB_PREFIX_ . 'kbmp_deal_rule 
                    WHERE id_seller_deal = ' . (int) $id_seller_deal
                    . ' AND rule_type = ' . (int) DealTool::DEAL_RULE_CATEGORY;

                return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            } elseif ($deal->deal_type == DealTool::DEAL_TYPE_CART) {
                $categories = array();
                $sql1 = 'Select * from ' . _DB_PREFIX_ . 'cart_rule_product_rule_group 
                    where id_cart_rule = ' . (int) $deal->id_cart_rule;
                $result1 = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql1);
                if (!empty($result1)) {
                    foreach ($result1 as $resu1) {
                        $sql2 = 'Select * from ' . _DB_PREFIX_ . 'cart_rule_product_rule 
                            where id_product_rule_group = ' . (int) $resu1['id_product_rule_group']
                            . ' AND type = "categories"';
                        $result2 = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql2);
                        if (!empty($result2)) {
                            foreach ($result2 as $resu2) {
                                $cat_sql = 'Select id_item from ' . _DB_PREFIX_ . 'cart_rule_product_rule_value 
                                    where id_product_rule = ' . (int) $resu2['id_product_rule'];
                                $id = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($cat_sql);
                                if ($id) {
                                    $categories = array('value' => $id);
                                }
                            }
                        }
                    }
                }
                return $categories;
            }
        }
        return array();
    }

    public static function getDealProductRules($id_seller_deal)
    {
        $deal = new KbSellerDeal($id_seller_deal);
        if (Validate::isLoadedObject($deal)) {
            if ($deal->deal_type == DealTool::DEAL_TYPE_PER_PRODUCT) {
                $id_products = array();
                $sql1 = 'Select * from ' . _DB_PREFIX_ . 'cart_rule_product_rule_group 
                    where id_cart_rule = ' . (int) $deal->id_cart_rule;
                $result1 = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql1);
                if (!empty($result1)) {
                    foreach ($result1 as $resu1) {
                        $sql2 = 'Select * from ' . _DB_PREFIX_ . 'cart_rule_product_rule 
                            where id_product_rule_group = ' . (int) $resu1['id_product_rule_group']
                            . ' AND type = "products"';
                        $result2 = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql2);
                        if (!empty($result2)) {
                            foreach ($result2 as $resu2) {
                                $cat_sql = 'Select id_item from ' . _DB_PREFIX_ . 'cart_rule_product_rule_value 
                                    where id_product_rule = ' . (int) $resu2['id_product_rule'];
                                $id = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($cat_sql);
                                foreach ($id as $prod_id) {
                                    $id_products[] = array('value' => $prod_id);
                                }
                            }
                        }
                    }
                }
                return $id_products;
            }
        }
        return array();
    }

    public static function deleteAllCategoryRule($id_seller_deal)
    {
        $sql = 'Delete from ' . _DB_PREFIX_ . 'kbmp_deal_rule 
            WHERE id_seller_deal = ' . (int) $id_seller_deal
            . ' AND rule_type = ' . (int) DealTool::DEAL_RULE_CATEGORY;

        return DB::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
    }

    public static function getDealManufacturerRules($id_seller_deal)
    {
        $deal = new KbSellerDeal($id_seller_deal);
        if (Validate::isLoadedObject($deal)) {
            if ($deal->deal_type == DealTool::DEAL_TYPE_CATALOG) {
                $sql = 'Select * from ' . _DB_PREFIX_ . 'kbmp_deal_rule 
                    WHERE id_seller_deal = ' . (int) $id_seller_deal
                    . ' AND rule_type = ' . (int) DealTool::DEAL_RULE_MANUFACTURER;

                return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
            } elseif ($deal->deal_type == DealTool::DEAL_TYPE_CART) {
                $manufacturers = array();
                $sql1 = 'Select * from ' . _DB_PREFIX_ . 'cart_rule_product_rule_group 
                    where id_cart_rule = ' . (int) $deal->id_cart_rule;
                $result1 = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql1);
                if (!empty($result1)) {
                    foreach ($result1 as $resu1) {
                        $sql2 = 'Select * from ' . _DB_PREFIX_ . 'cart_rule_product_rule 
                            where id_product_rule_group = ' . (int) $resu1['id_product_rule_group']
                            . ' AND type = "manufacturers"';
                        $result2 = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql2);
                        if (!empty($result2)) {
                            foreach ($result2 as $resu2) {
                                $m_sql = 'Select id_item from ' . _DB_PREFIX_ . 'cart_rule_product_rule_value 
                                    where id_product_rule = ' . (int) $resu2['id_product_rule'];
                                $id = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($m_sql);
                                if (!empty($id)) {
                                    foreach ($id as $key => $id_rule) {
                                        $manufacturers[] = array('value' => $id_rule['id_item']);
                                    }
                                }
                            }
                        }
                    }
                }
                return $manufacturers;
            }
        }
        return array();
    }

    public static function deleteAllManufacturerRule($id_seller_deal)
    {
        $sql = 'Delete from ' . _DB_PREFIX_ . 'kbmp_deal_rule 
            WHERE id_seller_deal = ' . (int) $id_seller_deal
            . ' AND rule_type = ' . (int) DealTool::DEAL_RULE_MANUFACTURER;

        return DB::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
    }
}
