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

        /**
      * @see ObjectModel::$definition
      */
      public static $definition = array(
        'google_url' => array(
          'type' => self::TYPE_STRING,
          'validate' => 'isString'
        )
      );

      protected $webserviceParameters = array(
        'google_url' => array('getter' => 'getGoogleURL')
      );

      public function __construct($id = null)
      {
          parent::__construct($id);
      }

      public function getGoogleURL()
      {
          $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
              'SELECT `value` as id
              FROM `psrn_kb_mp_custom_field_seller_mapping` 
              WHERE `id_field` IN (24) AND `id_seller` = '.(int)$this->id
          );
          // return $result[0];
          return "hi";
      }
  }