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

class KbSellerDeal extends ObjectModel
{
    public $id;
    public $id_seller;
    public $id_cart_rule;
    public $title;
    public $active;
    public $banner_path;
    public $deal_type;
    public $id_shop;
    public $id_currency;
    public $id_country;
    public $id_group;
    public $from_quantity;
    public $price;
    public $reduction;
    public $reduction_tax;
    public $reduction_type;
    public $code;
    public $from_date;
    public $end_date;
    public $date_add;
    public $date_upd;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'kbmp_seller_deal',
        'primary' => 'id_seller_deal',
        'multilang' => true,
        'fields' => array(
            'id_seller' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId', 'required' => true
            ),
            'id_cart_rule' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isNullorUnsignedId', 'default' => null
            ),
            'active' => array(
                'type' => self::TYPE_BOOL,
                'validate' => 'isBool', 'required' => true
            ),
            'deal_type' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId', 'required' => true
            ),
            'id_shop' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId'
            ),
            'id_currency' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId'
            ),
            'id_country' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId'
            ),
            'id_group' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId'
            ),
            'from_quantity' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedInt', 'required' => true
            ),
            'price' => array(
                'type' => self::TYPE_FLOAT,
                'validate' => 'isNegativePrice', 'required' => true
            ),
            'reduction' => array(
                'type' => self::TYPE_FLOAT,
                'validate' => 'isPrice', 'required' => true
            ),
            'reduction_tax' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'reduction_type' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt', 'required' => true
            ),
            'code' => array(
                'type' => self::TYPE_STRING,
                'validate' => 'isCleanHtml'
            ),
            'from_date' => array(
                'type' => self::TYPE_DATE,
                'validate' => 'isDateFormat', 'required' => true
            ),
            'end_date' => array(
                'type' => self::TYPE_DATE,
                'validate' => 'isDateFormat', 'required' => true
            ),
            'date_add' => array(
                'type' => self::TYPE_DATE,
                'validate' => 'isDate'
            ),
            'date_upd' => array(
                'type' => self::TYPE_DATE,
                'validate' => 'isDate'
            ),
            'title' => array(
                'type' => self::TYPE_STRING, 'required' => true,
                'lang' => true, 'validate' => 'isGenericName'
            ),
            'banner_path' => array(
                'type' => self::TYPE_STRING,
                'validate' => 'isGenericName'
            ),
        )
    );

    public function __construct($id = null, $id_lang = null, $id_shop = null)
    {
        parent::__construct($id, $id_lang, $id_shop);
        if (!$this->id) {
            $this->from_date = '';
            $this->end_date = '';
        }
    }

    public function validateBeforeSave()
    {
        $errors = array();
        $fields = self::$definition['fields'];
        $languages = Language::getLanguages(false);
        foreach ($fields as $field => $params) {
            if (array_key_exists('lang', $params) && $params['lang']) {
                foreach ($languages as $lang) {
                    $message = $this->validateField($field, $this->{$field}[$lang['id_lang']], $lang['id_lang']);
                }
            } else {
                $message = $this->validateField($field, $this->$field);
            }

            if ($message !== true) {
                $errors[] = $message;
            }
        }
        if (!empty($errors)) {
            return $errors;
        }
        return true;
    }

    public function delete()
    {
        if ($this->id_cart_rule) {
            self::deleteCartRules($this->id_cart_rule, false);
            $this->id_cart_rule = null;
            $this->save(true);
        } else {
            require_once _PS_MODULE_DIR_ . 'kbmpdealmanager/KbDealRule.php';
            KbDealRule::deleteAllCategoryRule($this->id);
            KbDealRule::deleteAllManufacturerRule($this->id);

            $this->cleanProductMappings();
        }
        if (parent::delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteImage($force_delete = false)
    {
        unset($force_delete);
        if (!$this->id) {
            return false;
        }
        if (empty($this->banner_path)) {
            return true;
        }
        $path = _PS_MODULE_DIR_ . 'kbmarketplace/views/img/seller_media/'
            . $this->id_seller . '/' . $this->banner_path;
        if (Tools::file_exists_no_cache($path) && unlink($path)) {
            $this->banner_path = null;
            if ($this->save()) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    public static function getSellerDeals(
        $id_seller = null,
        $id_lang = null,
        $only_count = false,
        $active = false,
        $start = null,
        $limit = null,
        $filter_string = null,
        $per_product_deal = null
    )
    {
        $sql = 'Select {{COLUMN}} from ' . _DB_PREFIX_ . 'kbmp_seller_deal as a 
			INNER JOIN ' . _DB_PREFIX_ . 'kbmp_seller_deal_lang as al on (a.id_seller_deal = al.id_seller_deal) 
			Where 1';

        if (!empty($id_seller) && $id_seller > 0) {
            $sql .= ' AND a.id_seller = ' . (int) $id_seller;
        }

        if (!empty($id_lang)) {
            $id_lang = (int) $id_lang;
        } else {
            $id_lang = Context::getContext()->language->id;
        }
        $sql .= ' AND al.id_lang  = "' . (int) $id_lang . '"';

        if ($active !== false) {
            $sql .= ' AND a.active  = "' . (int) $active . '"';
        }

        if(!empty($per_product_deal) && $per_product_deal != 1) {
            $sql .= ' AND a.deal_type  = ' . (int) $per_product_deal . '';
        } elseif(!empty($per_product_deal) && $per_product_deal == 1) {
            $sql .= ' AND a.deal_type != 3';
        }

        if (!empty($filter_string)) {
            $sql .= $filter_string;
        }

        if ($only_count) {
            $sql = str_replace('{{COLUMN}}', 'COUNT(a.id_seller_deal) as total', $sql);

            return DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        } else {
            $col_string = 'a.*, al.* ';
            $sql = str_replace('{{COLUMN}}', $col_string, $sql);

            $sql .= ' ORDER BY a.id_seller_deal DESC';

            if ((int) $start >= 0 && (int) $limit > 0) {
                $sql .= ' LIMIT ' . (int) $start . ', ' . (int) $limit;
            } elseif ((int) $limit > 0) {
                $sql .= ' LIMIT ' . (int) $limit;
            }

            return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        }
    }

    public static function getSellerExpiredDeals($id_seller)
    {
        $sql = 'Select * from ' . _DB_PREFIX_ . 'kbmp_seller_deal 
            WHERE id_seller = ' . (int) $id_seller . ' AND end_date <= "' . pSQL(date('Y-m-d H:i:s', time())) . '"';

        return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }

    public function getRules()
    {
        $sql = 'Select * from ' . _DB_PREFIX_ . 'kbmp_deal_rule WHERE id_seller_deal = ' . (int) $this->id;

        return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }

    public function resetRules()
    {
        if ($this->id_cart_rule) {
            self::deleteCartRules($this->id_cart_rule);
        } else {
            require_once _PS_MODULE_DIR_ . 'kbmpdealmanager/KbDealRule.php';
            KbDealRule::deleteAllCategoryRule($this->id);
            KbDealRule::deleteAllManufacturerRule($this->id);

            $this->cleanProductMappings();
        }
    }

    public function cleanProductMappings()
    {
        $sql = 'Select * FROM ' . _DB_PREFIX_ . 'kbmp_deal_products WHERE id_seller_deal=' . (int) $this->id;
        $existing = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if ($existing) {
            foreach ($existing as $old) {
                $specific_price = new SpecificPrice($old['id_specific_price']);
                @$specific_price->delete();
            }
        }
        $sql = 'DELETE FROM ' . _DB_PREFIX_ . 'kbmp_deal_products WHERE id_seller_deal=' . (int) $this->id;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
    }

    public static function deleteCartRules($id_cart_rule, $only_rules = true)
    {
        $rule = new CartRule($id_cart_rule);
        if (!$only_rules) {
            $rule->delete();
            return;
        }
        $rule->active = 0;
        $rule->save(true);
        $r = Db::getInstance()->delete('cart_rule_carrier', '`id_cart_rule` = ' . (int) $id_cart_rule);
        $r &= Db::getInstance()->delete('cart_rule_shop', '`id_cart_rule` = ' . (int) $id_cart_rule);
        $r &= Db::getInstance()->delete('cart_rule_group', '`id_cart_rule` = ' . (int) $id_cart_rule);
        $r &= Db::getInstance()->delete('cart_rule_country', '`id_cart_rule` = ' . (int) $id_cart_rule);
        $r &= Db::getInstance()->delete(
            'cart_rule_combination',
            '`id_cart_rule_1` = ' . (int) $id_cart_rule . ' OR `id_cart_rule_2` = ' . (int) $id_cart_rule
        );
        $r &= Db::getInstance()->delete('cart_rule_product_rule_group', '`id_cart_rule` = ' . (int) $id_cart_rule);
        $r &= Db::getInstance()->delete(
            'cart_rule_product_rule',
            'NOT EXISTS (SELECT 1 FROM `' . _DB_PREFIX_ . 'cart_rule_product_rule_group`
                WHERE `' . _DB_PREFIX_ . 'cart_rule_product_rule`.`id_product_rule_group` = `'
                . _DB_PREFIX_ . 'cart_rule_product_rule_group`.`id_product_rule_group`)'
        );
        $r &= Db::getInstance()->delete(
            'cart_rule_product_rule_value',
            'NOT EXISTS (SELECT 1 FROM `' . _DB_PREFIX_ . 'cart_rule_product_rule`
                WHERE `' . _DB_PREFIX_ . 'cart_rule_product_rule_value`.`id_product_rule` = `'
                . _DB_PREFIX_ . 'cart_rule_product_rule`.`id_product_rule`)'
        );
    }

    public function applyNewRules($categories = array(), $manufacturers = array(), $id_product = array())
    {
        if ($this->deal_type == DealTool::DEAL_TYPE_CATALOG) {
            $this->applyNewCatalogRules($categories, $manufacturers);
        } elseif ($this->deal_type == DealTool::DEAL_TYPE_CART) {
            $this->applyNewCartRules($categories, $manufacturers, array());
        } elseif ($this->deal_type == DealTool::DEAL_TYPE_PER_PRODUCT) {
            $this->applyNewCartRules(array(), array(), $id_product);
        }
    }

    public function applyNewCatalogRules($categories = array(), $manufacturers = array())
    {
        if ($categories) {
            $categories = array_unique($categories);
            if (in_array(0, $categories)) {
                $rule = new KbDealRule();
                $rule->id_seller_deal = $this->id;
                $rule->rule_type = DealTool::DEAL_RULE_CATEGORY;
                $rule->value = 0;
                @$rule->save();
            } else {
                foreach ($categories as $cat) {
                    $rule = new KbDealRule();
                    $rule->id_seller_deal = $this->id;
                    $rule->rule_type = DealTool::DEAL_RULE_CATEGORY;
                    $rule->value = (int) $cat;
                    @$rule->save();
                }
            }
        }
        if ($manufacturers) {
            $manufacturers = array_unique($manufacturers);
            if (in_array(0, $categories)) {
                $rule = new KbDealRule();
                $rule->id_seller_deal = $this->id;
                $rule->rule_type = DealTool::DEAL_RULE_MANUFACTURER;
                $rule->value = 0;
                @$rule->save();
            } else {
                foreach ($manufacturers as $m) {
                    $rule = new KbDealRule();
                    $rule->id_seller_deal = $this->id;
                    $rule->rule_type = DealTool::DEAL_RULE_MANUFACTURER;
                    $rule->value = (int) $m;
                    @$rule->save();
                }
            }
        }
        $this->applyRulesToProducts();
    }

    public function applyRulesToProducts()
    {
        $rules = $this->getRules();
        $categories = array();
        foreach ($rules as $rule) {
            if ($rule['rule_type'] == DealTool::DEAL_RULE_CATEGORY) {
                if ($rule['value'] == 0) {
                    $categories = 0;
                    break;
                } else {
                    $categories[] = $rule['value'];
                }
            }
        }

        $manufacturers = array();
        foreach ($rules as $rule) {
            if ($rule['rule_type'] == DealTool::DEAL_RULE_MANUFACTURER) {
                if ($rule['value'] == 0) {
                    $manufacturers = 0;
                    break;
                } else {
                    $manufacturers[] = $rule['value'];
                }
            }
        }

        $sql = 'Select DISTINCT(p.id_product) as id_product from ' . _DB_PREFIX_ . 'product as p 
            INNER JOIN ' . _DB_PREFIX_ . 'kb_mp_seller_product as sp on (
                p.id_product = sp.id_product 
                AND sp.id_seller = ' . (int) $this->id_seller
                . ')';

        if (is_array($categories) && count($categories) > 0) {
            $sql .= ' INNER JOIN ' . _DB_PREFIX_ . 'category_product as cp on (p.id_product = cp.id_product)';
        }

        $sql .= ' WHERE 1';
        if (is_array($manufacturers) && count($manufacturers) > 0) {
            $sql .= ' AND p.id_manufacturer IN (' . pSQL(implode(',', $manufacturers)) . ')';
        }

        if (is_array($categories) && count($categories) > 0) {
            if (is_array($manufacturers) && count($manufacturers) > 0) {
                $sql .= ' AND cp.id_category IN (' . pSQL(implode(',', $categories)) . ')';
            } else {
                $sql .= ' or cp.id_category IN (' . pSQL(implode(',', $categories)) . ')';
            }
        }
        $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executes($sql);
        if ($results && count($results) > 0) {
            foreach ($results as $result) {
                $specific_price = new SpecificPrice();
                $specific_price->id_specific_price_rule = 0;
                $specific_price->id_product = (int) $result['id_product'];
                $specific_price->id_product_attribute = 0;
                $specific_price->id_customer = 0;
                $specific_price->id_shop = (int) $this->id_shop;
                $specific_price->id_country = (int) $this->id_country;
                $specific_price->id_currency = (int) $this->id_currency;
                $specific_price->id_group = (int) $this->id_group;
                $specific_price->from_quantity = (int) $this->from_quantity;
                $specific_price->price = (float) $this->price;
                $specific_price->reduction_type = ($this->reduction_type == DealTool::REDUCTION_TYPE_PERCENTAGE)
                    ? 'percentage'
                    : 'amount';
                $specific_price->reduction_tax = $this->reduction_tax;
                $specific_price->reduction = ($this->reduction_type == DealTool::REDUCTION_TYPE_PERCENTAGE)
                    ? $this->reduction / 100
                    : (float) $this->reduction;
                $specific_price->from = $this->from_date;
                $specific_price->to = $this->end_date;

                if ($specific_price->add()) {
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->insert(
                        'kbmp_deal_products',
                        array(
                            'id_seller_deal' => $this->id,
                            'id_specific_price' => $specific_price->id
                        )
                    );
                }
            }
        }
    }

    public function applyNewCartRules($categories = array(), $manufacturers = array(), $id_product = array())
    {
        $cart_rule = new CartRule($this->id_cart_rule);

        $languages = Language::getLanguages(false);

        $deafult_values = DealTool::getCartRuleDefaultValues();
        foreach ($deafult_values as $field => $value) {
            $cart_rule->{$field} = $value;
        }

        $seller = new KbSeller($this->id_seller);
        $seller_info = $seller->getSellerInfo();
        $seller_desc = 'Seller Deal
            Name: ' . $seller_info['seller_name']
            . ' Email: ' . $seller_info['email'];
        $cart_rule->description = $seller_desc;

        foreach ($languages as $lang) {
            $cart_rule->name[$lang['id_lang']] = $this->title[$lang['id_lang']];
        }

        if(Tools::isSubmit('limit_customer')) {
            $cust_id = explode('-', Tools::getValue('limit_customer'));
            $cart_rule->id_customer = $cust_id[0];
        } else {
            $cart_rule->id_customer = 0;
        }

        $cart_rule->active = $this->active;
        $cart_rule->date_from = $this->from_date;
        $cart_rule->date_to = $this->end_date;
        $cart_rule->code = $this->code;
        if($id_product) {
            $cart_rule->quantity = Tools::getValue('quantity', 0);
            $cart_rule->quantity_per_user = Tools::getValue('quantity_per_user', 0);
        }
        if ($this->reduction_type == DealTool::REDUCTION_TYPE_PERCENTAGE) {
            $cart_rule->reduction_percent = $this->reduction;
            $cart_rule->reduction_amount = 0;
        } elseif ($this->reduction_type == DealTool::REDUCTION_TYPE_AMOUNT) {
            $cart_rule->reduction_percent = 0;
            $cart_rule->reduction_amount = $this->reduction;
        } else {
            $cart_rule->reduction_percent = 0;
            $cart_rule->reduction_amount = 0;
        }

        if ($cart_rule->save()) {
            $this->id_cart_rule = $cart_rule->id;
            if (!$this->save(true)) {
                return false;
            }

            $r = Db::getInstance()->delete('cart_rule_carrier', '`id_cart_rule` = ' . (int) $cart_rule->id);
            $r &= Db::getInstance()->delete('cart_rule_shop', '`id_cart_rule` = ' . (int) $cart_rule->id);
            $r &= Db::getInstance()->delete('cart_rule_group', '`id_cart_rule` = ' . (int) $cart_rule->id);
            $r &= Db::getInstance()->delete('cart_rule_country', '`id_cart_rule` = ' . (int) $cart_rule->id);
            $r &= Db::getInstance()->delete(
                'cart_rule_combination',
                '`id_cart_rule_1` = ' . (int) $cart_rule->id . ' OR `id_cart_rule_2` = ' . (int) $cart_rule->id
            );
            $r &= Db::getInstance()->delete(
                'cart_rule_product_rule_group',
                '`id_cart_rule` = ' . (int) $cart_rule->id
            );
            $r &= Db::getInstance()->delete(
                'cart_rule_product_rule',
                'NOT EXISTS (SELECT 1 FROM `' . _DB_PREFIX_ . 'cart_rule_product_rule_group`
                WHERE `' . _DB_PREFIX_ . 'cart_rule_product_rule`.`id_product_rule_group` = `'
                . _DB_PREFIX_ . 'cart_rule_product_rule_group`.`id_product_rule_group`)'
            );
            $r &= Db::getInstance()->delete(
                'cart_rule_product_rule_value',
                'NOT EXISTS (SELECT 1 FROM `' . _DB_PREFIX_ . 'cart_rule_product_rule`
                WHERE `' . _DB_PREFIX_ . 'cart_rule_product_rule_value`.`id_product_rule` = `'
                . _DB_PREFIX_ . 'cart_rule_product_rule`.`id_product_rule`)'
            );

            if ($categories) {
                Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                    'INSERT INTO `' . _DB_PREFIX_
                    . 'cart_rule_product_rule_group` (`id_cart_rule`, `quantity`)
                    VALUES (' . (int) $cart_rule->id . ', 1)'
                );
                $id_product_rule_group = Db::getInstance(_PS_USE_SQL_SLAVE_)->Insert_ID();

                Db::getInstance()->execute(
                    'INSERT INTO `' . _DB_PREFIX_ . 'cart_rule_product_rule` (`id_product_rule_group`, `type`)
                    VALUES (' . (int) $id_product_rule_group . ', "categories")'
                );
                $id_product_rule = Db::getInstance(_PS_USE_SQL_SLAVE_)->Insert_ID();
                $categories = array_unique($categories);
                if (!in_array(0, $categories)) {
                    foreach ($categories as $cat) {
                        $value_sql = 'INSERT INTO `' . _DB_PREFIX_ . 'cart_rule_product_rule_value` 
                            (`id_product_rule`, `id_item`) 
                            VALUES (' . (int) $id_product_rule . ', ' . (int) $cat . ')';
                        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($value_sql);
                    }
                }
            }
            if ($manufacturers) {
                Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                    'INSERT INTO `' . _DB_PREFIX_ . 'cart_rule_product_rule_group` (`id_cart_rule`, `quantity`)
                    VALUES (' . (int) $cart_rule->id . ', 1)'
                );
                $id_product_rule_group = Db::getInstance(_PS_USE_SQL_SLAVE_)->Insert_ID();

                Db::getInstance()->execute(
                    'INSERT INTO `' . _DB_PREFIX_ . 'cart_rule_product_rule` (`id_product_rule_group`, `type`)
                    VALUES (' . (int) $id_product_rule_group . ', "manufacturers")'
                );
                $id_product_rule = Db::getInstance(_PS_USE_SQL_SLAVE_)->Insert_ID();
                $manufacturers = array_unique($manufacturers);
                if (!in_array(0, $categories)) {
                    foreach ($manufacturers as $m) {
                        $value_sql = 'INSERT INTO `' . _DB_PREFIX_ . 'cart_rule_product_rule_value` 
                            (`id_product_rule`, `id_item`) 
                            VALUES (' . (int) $id_product_rule . ', ' . (int) $m . ')';
                        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($value_sql);
                    }
                }
            }
            
            if ($id_product) {
                Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(
                    'INSERT INTO `' . _DB_PREFIX_
                    . 'cart_rule_product_rule_group` (`id_cart_rule`, `quantity`)
                    VALUES (' . (int) $cart_rule->id . ', 1)'
                );
                $id_product_rule_group = Db::getInstance(_PS_USE_SQL_SLAVE_)->Insert_ID();

                Db::getInstance()->execute(
                    'INSERT INTO `' . _DB_PREFIX_ . 'cart_rule_product_rule` (`id_product_rule_group`, `type`)
                    VALUES (' . (int) $id_product_rule_group . ', "products")'
                );
                $id_product_rule = Db::getInstance(_PS_USE_SQL_SLAVE_)->Insert_ID();

                $id_product = array_unique($id_product);
                if (!in_array(0, $id_product)) {
                    foreach ($id_product as $product_id) {
                        $value_sql = 'INSERT INTO `' . _DB_PREFIX_ . 'cart_rule_product_rule_value` 
                            (`id_product_rule`, `id_item`) 
                            VALUES (' . (int) $id_product_rule . ', ' . (int) $product_id . ')';
                        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($value_sql);
                    }
                }
            }
        }
    }
}
