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

class KbCategoryLevelCommission extends ObjectModel
{
    public $id;
    public $id_seller;
    public $id_category;
    public $commission_percentage;
    

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'kb_mp_category_level_commission',
        'primary' => 'id_commission',
        'fields' => array(
            'id_seller' => array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId'),
            'id_category' => array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId'),
            'commission_percentage' => array('type' => self::TYPE_FLOAT, 'validate' => 'isPrice')
            )
        );
    
    public function __construct($id = null)
    {
        parent::__construct($id);
    }
    
    public static function getIdCommissionBySellerIdAndCategoryId($id_seller, $id_category)
    {
        $id_commission = 0;
        $sql = 'Select id_commission from ' . _DB_PREFIX_ . 'kb_mp_category_level_commission 
			where id_seller = ' . (int)$id_seller . ' AND id_category = ' . (int)$id_category;
        $id_commission = DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        return $id_commission;
    }
    
    }
