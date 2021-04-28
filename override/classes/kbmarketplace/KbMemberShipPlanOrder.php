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

class KbMemberShipPlanOrder extends ObjectModel
{
    public $id_kbmp_membership_plan_order;
    public $id_kbmp_membership_plan;
    public $id_cart;
    public $id_order;
    public $id_order_detail;
    public $is_paid;
    public $status;
    public $id_seller;
    public $plan_duration;
    public $plan_name;
    public $plan_duration_type;
    public $is_enabled_product_limit;
    public $product_limit;
    public $quantity;
    public $id_shop;
    public $date_add;
    public $active_date;
    public $expire_date;
    
    
    const TABLE_NAME = 'kbmp_membership_plan_order';
    
    public static $definition = array(
        'table' => 'kbmp_membership_plan_order',
        'primary' => 'id_kbmp_membership_plan_order',
        'fields' => array(
            'id_kbmp_membership_plan_order' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_kbmp_membership_plan' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_cart' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_order' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_order_detail' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'is_paid' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'status' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'plan_duration' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_seller' => array(
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
            'plan_name' => array(
                'type' => self::TYPE_STRING,
                'validate' => 'isCleanHtml',
                'copy_post' => false
            ),
            'product_limit' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'quantity' => array(
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
            'active_date' => array(
                'type' => self::TYPE_STRING,
                'validate' => 'isCleanHtml',
                'copy_post' => false
            ),
            'expire_date' => array(
                'type' => self::TYPE_STRING,
                'validate' => 'isCleanHtml',
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
    
    
    public static function getPendingOrdersByIdSeller($id_seller)
    {
        return (int) Db::getInstance()->getValue(
            'SELECT count(*) FROM '._DB_PREFIX_.'kbmp_membership_plan_order'
            . ' WHERE id_seller='. (int) $id_seller .' and (status = "0")'
            . ' group by id_seller'
        );
    }
    
    public static function getMembershipOrdersByIdSeller($id_seller)
    {
        return (int) Db::getInstance()->getValue(
            'SELECT count(*) FROM '._DB_PREFIX_.'kbmp_membership_plan_order'
            . ' WHERE id_seller='. (int) $id_seller
            . ' group by id_seller'
        );
    }
    
    public static function getMembershipOrdersIdByIdOrder($id_order)
    {
        return (int) Db::getInstance()->getValue(
            'SELECT id_kbmp_membership_plan_order FROM '._DB_PREFIX_.'kbmp_membership_plan_order'
            . ' WHERE id_order='. (int) $id_order
        );
    }
    
    public static function getMembershipOrdersByIdSellerAndPlan($id_seller,$id_membership_plan)
    {
        return (int) Db::getInstance()->getValue(
            'SELECT count(*) FROM '._DB_PREFIX_.'kbmp_membership_plan_order'
            . ' WHERE id_seller='. (int) $id_seller . ' and  id_kbmp_membership_plan = '.(int) $id_membership_plan
        );
    }
    
    public static function getMembershipPlanOrderBySeller(
        $id_seller,
        $id_lang = null,
        $filter_string = null,
        $only_count = false,
        $start = null,
        $limit = null
    ) {
        if ($id_lang == null) {
            $id_lang = Context::getContext()->language->id;
        }
        
        $sql = 'Select {{COLUMN}} from ' . _DB_PREFIX_ . 'kbmp_membership_plan_order as mpo 
			LEFT JOIN ' . _DB_PREFIX_ . 'order_detail as od 
                        ON (mpo.`id_order` = od.`id_order` and mpo.`id_order_detail` = od.`id_order_detail`) 
			LEFT JOIN ' . _DB_PREFIX_ . 'kbmp_membership_plan as mp 
                        ON (mpo.`id_kbmp_membership_plan` = mp.`id_kbmp_membership_plan`) 
			INNER JOIN ' . _DB_PREFIX_ . 'kb_mp_seller as sr 
			ON (mpo.`id_seller` = sr.`id_seller` AND sr.id_seller = ' . (int)$id_seller . ') 
			LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl 
			ON (pl.`id_product` = od.`product_id` AND pl.id_lang = ' . (int)$id_lang.')
                        Where 1';

        if (!empty($filter_string)) {
            $sql .= $filter_string;
        }
        
        if ($only_count) {
            $sql = str_replace('{{COLUMN}}', 'COUNT(mpo.id_kbmp_membership_plan_order) as total', $sql);
            return DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        } else {
            $cols = 'mpo.*, pl.name,od.`product_id`,od.`product_price`,od.`product_name`,mp.`is_deleted`,mpo.plan_name';
            $sql = str_replace('{{COLUMN}}', $cols, $sql);

            $sql .= ' ORDER BY mpo.id_kbmp_membership_plan_order ASC';
            
            if ((int)$start >= 0 && (int)$limit > 0) {
                $sql .= ' LIMIT ' . (int)$start . ', ' . (int)$limit;
            } elseif ((int)$limit > 0) {
                $sql .= ' LIMIT ' . (int)$limit;
            }
            return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        }
    }
    
    public static function getActiveMembershipOrdersByIdSeller($id_seller)
    {
        return (int) Db::getInstance()->getValue(
            'SELECT id_kbmp_membership_plan_order FROM '._DB_PREFIX_.'kbmp_membership_plan_order'
            . ' WHERE id_seller = '. (int) $id_seller .' and status = "2"'
        );
    }
    
    public static function getMembershipPlan(
        $id_seller = null,
        $only_count = false,
        $status = null,
        $filter_string = null
    ) {
        $sql = 'Select {{COLUMN}} from ' . _DB_PREFIX_ . 'kbmp_membership_plan_order Where 1';
        
        if (!empty($id_seller)) {
            $sql .= ' AND id_seller = '.(int)$id_seller;
        }
        if (!is_null($status)) {
            $sql .= ' AND status = "'.psql($status).'"';
        }
        
        if (!empty($filter_string)) {
            $sql .= $filter_string;
        }
        if ($only_count) {
            $sql = str_replace('{{COLUMN}}', 'COUNT(id_kbmp_membership_plan_order) as total', $sql);
            return DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        } else {
            $col_string = '* ';
            $sql = str_replace('{{COLUMN}}', $col_string, $sql);

            $sql .= ' ORDER BY id_kbmp_membership_plan_order ASC';
            return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        }
    }
    
    public static function activateMemberShipPlan(
        $id_seller,
        $id_membership_plan_order
    ) {
        $product_status = 1;
        $total_active_products = KbSellerProduct::getSellerProductsByStatus(
            $id_seller,
            true,
            null,
            null,
            null,
            null,
            $product_status
        );
        $plan_obj = new KbMemberShipPlanOrder($id_membership_plan_order);
        if ($plan_obj->is_enabled_product_limit == 1 && $total_active_products > $plan_obj->product_limit) {
            return false;
        } else {
            $plan_obj->status = 2;
            $duration_type = 'days';
            if ($plan_obj->plan_duration_type == 2) {
                $duration_type = 'months';
            } else if ($plan_obj->plan_duration_type == 3) {
                $duration_type = 'years';
            }
            $plan_obj->active_date = date('Y-m-d');
            
            $expire_date = date('Y-m-d', strtotime('+' . $plan_obj->plan_duration . $duration_type));
            
            $plan_obj->expire_date = date('Y-m-d', strtotime($expire_date . ' -' . '1' . 'day'));
            
            Hook::exec(
                'actionKbSellerPlanActivateBefore',
                array('id_membership_plan_order' => $id_membership_plan_order, 'id_seller' => $id_seller)
            );
            $plan_obj->save();
            Hook::exec(
                'actionKbSellerPlanActivateAfter',
                array('id_membership_plan_order' => $id_membership_plan_order, 'id_seller' => $id_seller)
            );
            return true;
        }
    }
    
    public static function addSellerProductInTrackingTable($id_seller)
    {
        $products = KbSellerProduct::getSellerProducts($id_seller);
        if (count($products) > 0) {
            foreach ($products as $p) {
                $product = new Product($p['id_product']);
                if (!Validate::isLoadedObject($product)) {
                    continue;
                }
                
                if (!self::checkProductTracking($id_seller, $product)) {
                    if (self::insertProductTracking($id_seller, $product)) {
                        if ($product->active) {
                            $product->active = 0;
                            $product->update(true);
                        }
                    }
                }
            }
        }
        return;
    }
    
    public static function insertProductTracking($id_seller, $product)
    {
        $sql = 'INSERT INTO ' . _DB_PREFIX_ . 'kbmp_membership_seller_product_tracking 
            (id_seller, id_product, product_status) 
            VALUES (' . (int) $id_seller . ', '. (int) $product->id . ', ' . (int) $product->active. ')';
        
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
    }
    
    public static function checkProductTracking($id_seller, $product)
    {
        $sql = 'select count(*) from ' . _DB_PREFIX_ . 'kbmp_membership_seller_product_tracking
            where id_seller = ' . (int) $id_seller . ' and id_product =  '. (int) $product->id;
        
        return (bool) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
    }
    
    public static function getTrackedProducts($id_seller,$status = null)
    {
        if (!empty($status)) {
            $where = ' and product_status = '.(int) $status;
        } else {
            $where = ' and 1';
        }
        $sql = 'select * from '._DB_PREFIX_.'kbmp_membership_seller_product_tracking where id_seller = '.(int) $id_seller . $where;
        
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }
    
    public static function deleteTrackedProduct($id_product)
    {
        $sql = 'delete from '._DB_PREFIX_.'kbmp_membership_seller_product_tracking where '
                . '  id_product = '.(int) $id_product;
        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
    }
    
    public static function removeAllSellerProductFromTrackingTable($id_seller)
    {
        $products = self::getTrackedProducts($id_seller);
        if (count($products) > 0) {
            foreach ($products as $p) {
                self::deleteTrackedProduct($p['id_product']);
                $product = new Product($p['id_product']);
                if (!Validate::isLoadedObject($product)) {
                    continue;
                }

                $product->active = $p['product_status'];
                $product->update(true);
            }
        }
    }
}
