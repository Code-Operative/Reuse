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

class KbMpMemberShipPlan extends ObjectModel
{
    public $id_kbmp_membership_plan;
    public $plan_duration;
    public $plan_duration_type;
    public $is_enabled_product_limit;
    public $product_limit;
    public $position;
    public $active;
    public $id_product;
    public $is_free;
    public $id_shop;
    public $is_deleted;
    public $date_add;
    public $date_upd;
    
    const TABLE_NAME = 'kbmp_membership_plan';
    
    public static $definition = array(
        'table' => 'kbmp_membership_plan',
        'primary' => 'id_kbmp_membership_plan',
        'fields' => array(
            'id_kbmp_membership_plan' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'plan_duration' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'plan_duration_type' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'is_enabled_product_limit' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'product_limit' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'position' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'active' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'is_deleted' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'is_free' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_product' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_shop' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'date_add' => array(
                'type' => self::TYPE_DATE,
                'validate' => 'isDate',
                'copy_post' => false
            ),
            'date_upd' => array(
                'type' => self::TYPE_DATE,
                'validate' => 'isDate',
                'copy_post' => false
            ),
        ),
    );
    
    public function __construct($id_field = null, $full = false, $id_lang = null, $id_shop = null, Context $context = null)
    {
        parent::__construct($id_field, $id_lang, $id_shop);
    }
    
    /*
     * Function to fetch available custom fields
     */
    public static function isMemberShipPlanTypeProduct($id_product)
    {
        $str = 'and id_product = '.(int) $id_product;
        return Db::getInstance()->getValue(
            'SELECT id_kbmp_membership_plan FROM ' . _DB_PREFIX_ . 'kbmp_membership_plan
            WHERE 1 '.pSQL($str)
        );
    }
    
    public static function getFreeMembershipPlanID()
    {
        $str = 'and is_free = 1';
        return (int) Db::getInstance()->getValue(
            'SELECT id_kbmp_membership_plan FROM ' . _DB_PREFIX_ . 'kbmp_membership_plan
            WHERE 1 '.pSQL($str)
        );
    }
    
    // Function to update Rule position
    public function updateRulePosition($way, $position)
    {
        if (!$res = Db::getInstance()->executeS('SELECT `id_kbmp_membership_plan`, `position` FROM `'._DB_PREFIX_.'kbmp_membership_plan` ORDER BY `position` ASC')) {
            return false;
        }

        foreach ($res as $plans) {
            if ((int)$plans['id_kbmp_membership_plan'] == (int)$this->id) {
                $moved_plans = $plans;
            }
        }

        if (!isset($moved_plans) || !isset($position)) {
            return false;
        }
        return (Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.'kbmp_membership_plan` SET `position` = `position` '.($way ? '- 1' : '+ 1').' WHERE `position` '.($way ? '> '.(int)$moved_plans['position'].' AND `position` <= '.(int)$position : '< '.(int)$moved_plans['position'].' AND `position` >= '.(int)$position)) && Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.'kbmp_membership_plan` SET `position` = '.(int)$position.' WHERE `id_kbmp_membership_plan` = '.(int)$moved_plans['id_kbmp_membership_plan']));
    }
    
    public static function getMemberShipPlans(
        $only_count = false,
        $start = null,
        $limit = null,
        $orderby = null,
        $orderway = null,
        $active = false,
        $id_lang = null,
        $id_shop = null
    ) {
        
        if ((int) $id_lang == 0) {
            $id_lang = Context::getContext()->language->id;
        }
        
        $context = new Context();
        $columns = 'pl.`name`, a.*';
        $sql = 'Select {{COLUMN}} FROM ' . _DB_PREFIX_ . 'kbmp_membership_plan as a 
			INNER JOIN '._DB_PREFIX_.'product as p on (a.id_product = p.id_product)
                        INNER JOIN '._DB_PREFIX_.'product_lang as pl on (p.id_product = pl.id_product AND pl.id_lang = '.(int) $id_lang.
                        ' AND pl.id_shop='.(int) $context->getContext()->shop->id.')';

        $sql .= ' WHERE 1';
        
        /*
         * Added condition to find all the plan except free plan if already purchased
         */
        $id_free_membership_plan = self::getFreeMembershipPlanID();
        
        $has_already_purchased_free_plan = 0;
        $has_already_purchased_free_plan = KbMemberShipPlanOrder::getMembershipOrdersByIdSellerAndPlan(KbSeller::getSellerByCustomerId(Context::getContext()->customer->id),$id_free_membership_plan);
        
        if ($has_already_purchased_free_plan) {
            $sql .= ' AND a.is_free = 0';
        }
        /*
         * changes over
         */
        
        if ($active === true) {
            $sql .= ' AND a.active = ' . (int)KbGlobal::ENABLE;
        }

        if ($id_shop) {
            $sql .= ' AND a.id_shop = ' . (int)$id_shop;
        } else {
            $sql .= ' AND a.id_shop = ' . (int)Context::getContext()->shop->id;
        }

        if ($only_count) {
            $sql = str_replace('{{COLUMN}}', 'COUNT(*) as total', $sql);
            return DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        } else {
            $sql .= ' GROUP BY a.id_kbmp_membership_plan';

            if ($orderby != null && $orderway != null) {
                $sql .= ' ORDER BY ' . pSQL($orderby) . ' ' . pSQL($orderway);
            } else {
                $sql .= ' ORDER BY a.position ASC';
            }

            if ((int)$start > 0 && (int)$limit > 0) {
                $sql .= ' LIMIT ' . (int)$start . ', ' . (int)$limit;
            } elseif ((int)$limit > 0) {
                $sql .= ' LIMIT ' . (int)$limit;
            }

            $sql = str_replace('{{COLUMN}}', $columns, $sql);

            return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        }
    }
    
    public static function getMemberShipPlansAdmin(
        $only_count = false,
        $start = null,
        $limit = null,
        $orderby = null,
        $orderway = null,
        $active = false,
        $id_lang = null,
        $id_shop = null
    ) {
        
        if ((int) $id_lang == 0) {
            $id_lang = Context::getContext()->language->id;
        }
        
        $context = new Context();
        $columns = 'pl.`name`, a.*';
        $sql = 'Select {{COLUMN}} FROM ' . _DB_PREFIX_ . 'kbmp_membership_plan as a 
			INNER JOIN '._DB_PREFIX_.'product as p on (a.id_product = p.id_product)
                        INNER JOIN '._DB_PREFIX_.'product_lang as pl on (p.id_product = pl.id_product AND pl.id_lang = '.(int) $id_lang.
                        ' AND pl.id_shop='.(int) $context->getContext()->shop->id.')';

        $sql .= ' WHERE 1';
        
        if ($active === true) {
            $sql .= ' AND a.active = ' . (int)KbGlobal::ENABLE;
        }

        if ($id_shop) {
            $sql .= ' AND a.id_shop = ' . (int)$id_shop;
        } else {
            $sql .= ' AND a.id_shop = ' . (int)Context::getContext()->shop->id;
        }

        if ($only_count) {
            $sql = str_replace('{{COLUMN}}', 'COUNT(*) as total', $sql);
            return DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        } else {
            $sql .= ' GROUP BY a.id_kbmp_membership_plan';

            if ($orderby != null && $orderway != null) {
                $sql .= ' ORDER BY ' . pSQL($orderby) . ' ' . pSQL($orderway);
            } else {
                $sql .= ' ORDER BY a.position ASC';
            }

            if ((int)$start > 0 && (int)$limit > 0) {
                $sql .= ' LIMIT ' . (int)$start . ', ' . (int)$limit;
            } elseif ((int)$limit > 0) {
                $sql .= ' LIMIT ' . (int)$limit;
            }

            $sql = str_replace('{{COLUMN}}', $columns, $sql);

            return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        }
    }
}
