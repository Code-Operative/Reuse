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

class KbSellerCloseShop extends ObjectModel
{
    public $id_request;
    public $id_seller;
    public $id_shop;
    public $approved;
    public $seller_email;
    public $account_delete;
    public $date_add;


    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'kb_mp_seller_shop_close_request',
        'primary' => 'id_request',
        'fields' => array(
            'id_request' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'id_seller' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'account_delete' =>  array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'seller_email' =>  array('type' => self::TYPE_STRING, 'validate' => 'isEmail'),
            'approved' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate',
                'copy_post' => false),
        )
    );

    public function __construct($id = null)
    {
        parent::__construct($id);
    }
}