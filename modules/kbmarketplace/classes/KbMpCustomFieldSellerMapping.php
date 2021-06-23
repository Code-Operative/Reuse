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

class KbMpCustomFieldSellerMapping extends ObjectModel
{
    public $id_mapping;
    public $id_field;
    public $id_employee;
    public $id_customer;
    public $id_seller;
    public $value;
    public $date_add;
    public $date_upd;
    
    public static $definition = array(
        'table' => 'kb_mp_custom_field_seller_mapping',
        'primary' => 'id_mapping',
        'fields' => array(
            'id_mapping' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_customer' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_seller' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_employee' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'id_field' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isInt'
            ),
            'value' => array(
                'type' => self::TYPE_HTML,
                'validate' => 'isCleanHtml',
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
    
    public function __construct($id_mapping = null, $full = false, $id_lang = null, $id_shop = null, Context $context = null)
    {
         parent::__construct($id_mapping, $id_lang, $id_shop);
    }
    
    /*
     * Function to fetch customer inputs for custom fields
     */
    public static function getValueBySellerID($id_seller = null)
    {
        if ($id_seller == null) {
            return;
        }
        return Db::getInstance()->executeS(
            'SELECT * FROM '._DB_PREFIX_.'kb_mp_custom_field_seller_mapping'
            . ' WHERE id_seller='.(int) $id_seller
        );
    }
    
    /*
     * Function to get ID by customer ID and field ID
     */
    public static function getIDBySellerAndField($id_seller = null, $id_field = null)
    {
        if ($id_seller == null || $id_field == null) {
            return;
        }
        $data = Db::getInstance()->getRow(
            'SELECT id_mapping FROM '._DB_PREFIX_.'kb_mp_custom_field_seller_mapping'
            . ' WHERE id_seller='.(int)$id_seller
            .' AND id_field='.(int)$id_field
        );
        
        return $data['id_mapping'];
    }
}
