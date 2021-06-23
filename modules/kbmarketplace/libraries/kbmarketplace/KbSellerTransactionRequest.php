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

class KbSellerTransactionRequest extends ObjectModel
{
    public $id_seller_transaction;
    public $id_seller;
    public $id_shop;
    public $id_lang;
    public $id_employee;
    public $id_currency;
    public $amount;
    public $transaction_type;
    public $comment;
    public $approved;
    public $payout_item_id;
    public $payout_status;
    public $admin_comment;
    public $date_add;
    public $date_upd;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'kb_mp_seller_transaction_request',
        'primary' => 'id_seller_transaction',
        'fields' => array(
            'id_seller_transaction' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'id_seller' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'id_lang' => array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId',
                'copy_post' => false),
            'id_employee' => array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId'),
            'id_currency' => array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId'),
            'amount' => array('type' => self::TYPE_FLOAT, 'validate' => 'isNegativePrice'),
            'transaction_type' => array('type' => self::TYPE_STRING, 'values' => array(
                    '0', '1'), 'default' => '0'),
            'comment' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml',
                'required' => false),
            'approved' => array('type' => self::TYPE_STRING, 'validate' => 'isString',
                'values' => array('0', '1', '2'), 'default' => '0'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate',
                'copy_post' => false),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate',
                'copy_post' => false),
             'admin_comment' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml',
                'required' => false),
             'payout_item_id' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml',
                'required' => false),
             'payout_status' => array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml',
                'required' => false),
            
        )
    );
    protected $webserviceParameters = array(
        'objectsNodeName' => 'kbsellertransactions',
        'objectNodeName' => 'kbsellertransaction',
        'fields' => array(
            'id_seller' => array('xlink_resource' => 'kbsellers'),
            'id_shop' => array('xlink_resource' => 'shops'),
            'approved_text' => array('getter' => 'getApprovedTextWs'),
        )
    );

    public function __construct($id = null)
    {
        parent::__construct($id);
    }
    
    public function getApprovedTextWs()
    {
        return KbGlobal::getApporvalStatus($this->approved);
    }
    
    public static function getRequestBySeller(
    $id_seller, $approve, $only_count = false, $start = null, $limit = null, $filter_string
    = ''
    )
    {
        $sql = 'Select {{COLUMN}} from '._DB_PREFIX_.'kb_mp_seller_transaction_request  
			Where id_seller = '.(int) $id_seller;

        if ($approve !== false) {
            $sql .= ' AND approved = "'.pSQL($approve).'"';
        }

        if (!empty($filter_string)) {
            $sql .= $filter_string;
        }

        if ($only_count) {
            $sql = str_replace('{{COLUMN}}', 'COUNT(id_seller_transaction) as total', $sql);
            return DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        } else {
            $sql = str_replace('{{COLUMN}}', '*', $sql);

            $sql .= ' ORDER BY date_add DESC';

            if ((int) $start >= 0 && (int) $limit > 0) {
                $sql .= ' LIMIT '.(int) $start.', '.(int) $limit;
            } elseif ((int) $limit > 0) {
                $sql .= ' LIMIT '.(int) $limit;
            }

            return DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        }
    }
}