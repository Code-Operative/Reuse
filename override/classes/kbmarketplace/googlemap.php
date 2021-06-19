<?php
/**
 * DISCLAIMER
 * @author    kenjoo <kenjoo.dev@gmail.com>
 * @category  Extend webservice
 *
 */

 class googlemap extends ObjectModel
 {
     public $id;
     public $google_url;
 
    //  const TABLE_NAME = 'kb_mp_seller';
    //  const NOTIFICATION_BOTH = 0;
    //  const NOTIFICATION_PRIMARY = 1;
    //  const NOTIFICATION_BUSINESS = 2;
 
    //  const SELLER_PROFILE_IMG_PATH = 'kbmarketplace/sellers/';
 
     /**
      * @see ObjectModel::$definition
      */
     public static $definition = array(
        'table' => 'kb_mp_custom_field_seller_mapping',
        'primary' => 'id_seller',
        'multilang' => true,
        'fields' => array(
            'google_url' => array(
                'type' => self::TYPE_STRING,
                'validate' => 'isString'
            )
     );
 
     protected $webserviceParameters = array(
      'objectNodeName' => 'googleURL',
      'objectsNodeName' => 'getGoogleURL',
      'fields' => array(
        'google_url' => array('getter' => 'getGoogleURL')
      )
     );
 
     public function __construct($id = null)
     {
         parent::__construct($id);
     }
 
     public function getGoogleURL()
     {
         $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
             'SELECT `value` as id
             FROM `'._DB_PREFIX_.'kb_mp_custom_field_seller_mapping` 
             WHERE `id_field` IN (24) AND `id_seller` = '.(int)$this->id
         );
         return $result[0];
     }
 }