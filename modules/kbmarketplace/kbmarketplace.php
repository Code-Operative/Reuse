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

require_once dirname(__FILE__) . '/classes/kbconfiguration.php';
include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/KbMpCustomFields.php');
include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/KbMpCustomFieldSellerMapping.php');

/**
 * The parent class KbConfiguration is extending the "Module" core class.
 * So no need to extend "Module" core class here in this class.
 */
class KbMarketPlace extends KbConfiguration
{
    private $settings = array();
    private $overrided_file = array(
        'classes/Carrier.php',
        'classes/CartRule.php',
        'controllers/front/AuthController.php',
    );

    public function __construct()
    {
        $this->name = 'kbmarketplace';
        $this->tab = 'front_office_features';
        $this->version = '4.0.5';
        $this->author = 'Knowband';
        $this->module_key = '966ef7aa9b434e67d6a01385e1767fdb';
        $this->author_address = '0x2C366b113bd378672D4Ee91B75dC727E857A54A6';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.7.0.0', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Knowband MarketPlace');
        $this->description = $this->l('Make store as marketplace where customer can also become a seller and sell their products.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
        parent::__construct();
    }

    public function getErrors()
    {
        return $this->custom_errors;
    }
    
    /*
     * This function is used just to include all the menu texts to translations files.
     */
    private function menuTranslationsIncludeFunction()
    {
        /* Module Seller Front Menu */
        $this->l('Dashboard');
        $this->l('Seller Profile');
        $this->l('Products');
        $this->l('Orders');
        $this->l('Product Reviews');
        $this->l('My Reviews');
        $this->l('Earning');
        $this->l('Transactions');
        $this->l('Payout Request');
        $this->l('Category Request');
        $this->l('Shipping');
        
        /* Module Admin MarketPlace Menu */
        $this->l('Settings');
        $this->l('Sellers List');
        $this->l('Seller Account Approval List');
        $this->l('Product Approval List');
        $this->l('Seller Products');
        $this->l('Seller Orders');
        $this->l('Admin Orders');
        $this->l('Product Reviews');
        $this->l('Seller Reviews Approval List');
        $this->l('Seller Reviews');
        $this->l('Seller Category Request List');
        $this->l('Seller Shippings');
        $this->l('Admin Commissions');
        $this->l('Seller Transactions');
        $this->l('Email Templates');
        /*Start - MK made changes on 08-03-2018 for Marketplace changes*/
        $this->l('Seller Shipping Method');
        $this->l('Transactions Payout Request');
        $this->l('GDPR Settings');
        $this->l('Seller Shop Close Request');
        $this->l('GDPR Requests');
        /*End -MK made changes on 08-03-2018 for Marketplace changes*/
    }
    
    public function install()
    {
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbEmail.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbGlobal.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbReasonLog.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerCategory.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerCRequest.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerEarning.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerMenu.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerOrderDetail.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSeller.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerProduct.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerProductReview.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerReview.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerSetting.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerShipping.php';
        require_once dirname(__FILE__) . '/libraries/kbmarketplace/KbSellerTransaction.php';

        if (!function_exists('curl_version') || !in_array('curl', get_loaded_extensions())) {
            $this->custom_errors[] = $this->l('CURL is not enabled. Please enable it to use this module.');
            return false;
        }

        $overriding_error = false;
        foreach ($this->overrided_file as $file) {
            if (Tools::file_exists_no_cache(_PS_OVERRIDE_DIR_ .$file)) {
                $this->custom_errors[] = sprintf($this->l('%s already overridden.'), $file);
                $overriding_error = true;
            }
        }

        if ($overriding_error) {
            $this->custom_errors[] = $this->l('Override issue, please try again after clearing cache or contact to support.');
            return false;
        }

        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        
        $temp = false;
        $overrided_files = array();
        $source_dir = _PS_MODULE_DIR_ . 'kbmarketplace/libraries/kbmarketplace';
        foreach (Tools::scandir($source_dir) as $file) {
            if ($file != '.' && $file != '..') {
                $overrided_files[] = $file;
            }
        }
        if (empty($overrided_files)) {
            $this->custom_errors[] = $this->l('Marketplace library files are missing.');
            return false;
        } else {
            $dest_dir = _PS_OVERRIDE_DIR_ . 'classes/kbmarketplace';
            if (method_exists(get_class(new Tools()), "recurseCopy")) {
                if (Tools::recurseCopy($source_dir, $dest_dir) === false) {
                    $this->custom_errors[] = $this->l('Error occurred while copy library files in override folder.');
                    return false;
                } else {
                    Tools::chmodr($dest_dir, 0777);
                    $temp = true;
                }
            } else {
                if (self::recurseCopy($source_dir, $dest_dir) === false) {
                    $this->custom_errors[] = $this->l('Error occurred while copy library files in override folder.');
                    return false;
                } else {
                    Tools::chmodr($dest_dir, 0777);
                    $temp = true;
                }
            }
        }

        if (!Tools::file_exists_no_cache(_PS_IMG_DIR_ . $this->name . '/')) {
            if (!mkdir(_PS_IMG_DIR_ . $this->name . '/', 0777)) {
                $this->custom_errors[] = sprintf($this->l('Not able to create %s folder in image directory. Check Permission.'), 'Marketplace');
                return false;
            }
        }

        if (!Tools::file_exists_no_cache(_PS_IMG_DIR_ . KbSeller::SELLER_PROFILE_IMG_PATH)) {
            if (!mkdir(_PS_IMG_DIR_ . KbSeller::SELLER_PROFILE_IMG_PATH, 0777)) {
                $this->custom_errors[] = sprintf($this->l('Not able to create %s folder in image directory. Check Permission.'), KbSeller::SELLER_PROFILE_IMG_PATH);
                return false;
            }
        }
        if ($temp) {
            if (!$this->installModel()) {
                $this->custom_errors[] = $this->l('Error occurred while installing/upgrading modal.');
                return false;
            }

            if (!parent::install()) {
                $this->custom_errors[] = $this->l('Error in installing overrides same methods may be already overridden. Please try again after clearing cache or contact to support.');
                return false;
            }

            $this->installMarketPlaceTabs();

            if (Configuration::get('KB_MARKETPLACE')) {
                Configuration::deleteByName('KB_MARKETPLACE');
            }

            if (Configuration::get('KB_MP_SELLER_ORDER_HANDLING')) {
                Configuration::deleteByName('KB_MP_SELLER_ORDER_HANDLING');
            }

            $this->settings = $this->getDefaultSettings();
            Configuration::updateValue('KB_MARKETPLACE', $this->settings);

            if (!Configuration::get('KB_MP_SELLER_SHIPPING_METHOD')) {
                if (!empty($this->kbShippingMethodName())) {
                    foreach ($this->kbShippingMethodName() as $methods) {
                        Db::getInstance()->execute(
                            'INSERT INTO '._DB_PREFIX_.'kb_mp_seller_shipping_method'
                            . ' set method="'.pSQL($methods['name'])
                            .'", active='.(int)$methods['active']
                            .',date_add=now(),date_upd=now()'
                        );
                    }
                }
                Configuration::updateValue('KB_MP_SELLER_SHIPPING_METHOD', 1);
            }
            

            if (!Configuration::get('KB_MARKETPLACE_CONFIG')
                || Configuration::get('KB_MARKETPLACE_CONFIG') == '') {
                $settings = KbGlobal::getDefaultSettings();
                Configuration::updateValue('KB_MARKETPLACE_CONFIG', serialize($settings));
            }
            if (!Configuration::get('KB_MP_ENABLE_SELLER_REVIEW')
                || Configuration::get('KB_MP_ENABLE_SELLER_REVIEW') == '') {
                Configuration::updateValue('KB_MP_ENABLE_SELLER_REVIEW', 1);
            }
            
            /*Start- MK made changes on 31-05-18 to to add column for privacy policy in seller_lang table*/
            $select_datatype = 'SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA="'._DB_NAME_.'" AND TABLE_NAME="'._DB_PREFIX_.'kb_mp_seller_lang" AND column_name="privacy_policy"';
            $data_type = Db::getInstance()->getValue($select_datatype);
            if (empty($data_type)) {
                Db::getInstance()->execute('ALTER TABLE '._DB_PREFIX_.'kb_mp_seller_lang ADD COLUMN `privacy_policy` text');
            }
            
            $select_datatype = 'SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA="'._DB_NAME_.'" AND TABLE_NAME="'._DB_PREFIX_.'kb_mp_seller_lang" AND column_name="return_address"';
            $data_type = Db::getInstance()->getValue($select_datatype);
            if (empty($data_type)) {
                Db::getInstance()->execute('ALTER TABLE '._DB_PREFIX_.'kb_mp_seller_lang ADD COLUMN `return_address` text');
            }
            /*End- MK made changes on 31-05-18 to to add column for privacy policy in seller_lang table*/
            
            /*Start- MK made changes on 27-08-18 to to add column for payout id in seller_transaction_request table*/
            $select_datatype = 'SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA="'._DB_NAME_.'" AND TABLE_NAME="'._DB_PREFIX_.'kb_mp_seller_transaction_request" AND column_name="payout_item_id"';
            $data_type = Db::getInstance()->getValue($select_datatype);
            if (empty($data_type)) {
                Db::getInstance()->execute('ALTER TABLE '._DB_PREFIX_.'kb_mp_seller_transaction_request ADD COLUMN `payout_item_id` text,ADD COLUMN `payout_status` varchar(100) DEFAULT NULL');
            }
            /*End- MK made changes on 27-08-18 to to add column for payout id in seller_transaction_request table*/
            
            /*Start- MK made changes on 27-08-18 to add key for cron*/
            if (!Configuration::get('KB_MP_CRON')) {
                Configuration::updateValue('KB_MP_CRON', $this->kbKeyGenerator());
            }
            
            /* Start changes by Priyanshu on 25-January-2019 to implement the Custom Change for Payout Automation Request */
            if (!Configuration::get('KB_MP_AUTO_PAYPAL_CRON')) {
                Configuration::updateValue('KB_MP_AUTO_PAYPAL_CRON', $this->kbKeyGenerator());
            }
            /* End changes by Priyanshu on 25-January-2019 to implement the Custom Change for Payout Automation Request */
            /*END- MK made changes on 27-08-18 to add key for cron*/
            /* chages started by rihabh jain on 19th June 2019
             * to add seller shortlist functionality and category level commission
             */
            $sql = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'kb_mp_category_level_commission` (
                `id_commission` int(11) NOT NULL AUTO_INCREMENT,
                `id_seller` int(11) NOT NULL,
                `id_category` int(11) NOT NULL,
                `commission_percentage` float NOT NULL,
                PRIMARY KEY (`id_commission`)
              ) ENGINE=`' . _MYSQL_ENGINE_ . '` DEFAULT CHARSET=utf8';
            if (!Db::getInstance()->execute($sql)) {
                return false;
            }
            $sql = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'kb_mp_seller_shortlist` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `id_seller` int(10) unsigned NOT NULL,
                `id_customer` int(11) NOT NULL,
                `email` varchar(50) NOT NULL,
                `id_shop` int(11) NULL DEFAULT NULL,
                `id_lang` int(11) NULL DEFAULT NULL,
                `date_add` datetime NOT NULL,
                PRIMARY KEY(`id`)
                ) ENGINE=`' . _MYSQL_ENGINE_ . '` DEFAULT CHARSET=utf8';

            if (!Db::getInstance()->execute($sql)) {
                return false;
            }
            $sql = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."kb_mp_custom_field_seller_mapping` (
                `id_mapping` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
                `id_customer` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `id_seller` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `id_employee` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `id_field` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `value` TEXT NULL,
                `date_add` DATETIME NOT NULL ,
                `date_upd` DATETIME NULL ,
                PRIMARY KEY (`id_mapping`)
            ) ENGINE=`" . _MYSQL_ENGINE_ . "` DEFAULT CHARSET=utf8";
            if (!Db::getInstance()->execute($sql)) {
                return false;
            }
            $sql = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."kb_mp_custom_fields` (
                    `id_field` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
                    `id_section` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                    `field_name` VARCHAR(255) NULL,
                    `type` VARCHAR(255) NOT NULL,
                    `validation` VARCHAR(255) NULL,
                    `html_id` VARCHAR(255) NULL,
                    `html_class` VARCHAR(255) NULL,
                    `file_extension` TEXT NULL ,
                    `allow_multifile` INT(2) UNSIGNED NOT NULL DEFAULT '0',
                    `max_length` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                    `min_length` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                    `required` INT(2) UNSIGNED NOT NULL DEFAULT '0',    
                    `editable` INT(2) UNSIGNED NOT NULL DEFAULT '1',
                    `multiselect` INT(2) UNSIGNED NOT NULL DEFAULT '0',
                    `show_registration_form` INT(2) UNSIGNED NOT NULL DEFAULT '0',
                    `show_text_editor` INT(2) UNSIGNED NOT NULL DEFAULT '0',
                    `show_seller_profile` INT(2) UNSIGNED NOT NULL DEFAULT '0',
                    `active`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' ,
                    `position` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                    `date_add` DATETIME NOT NULL ,
                    `date_upd` DATETIME NULL ,
                    PRIMARY KEY (`id_field`)
                ) ENGINE=`" . _MYSQL_ENGINE_ . "` DEFAULT CHARSET=utf8";
            if (!Db::getInstance()->execute($sql)) {
                return false;
            }
            $sql = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."kb_mp_custom_fields_lang` (
                `id_field` INT(11) UNSIGNED NOT NULL ,
                `id_lang` INT(11) UNSIGNED NOT NULL,
                `id_shop` INT (11) UNSIGNED NOT NULL,
                `label` VARCHAR(255) NULL ,
                `description` text NULL,
                `value` TEXT NULL,
                `default_value` TEXT NULL,
                `placeholder` VARCHAR(255) NULL,
                `error_msg` VARCHAR(255) NULL ,    

                PRIMARY KEY (`id_field`, `id_lang`, `id_shop`)
            ) ENGINE=`" . _MYSQL_ENGINE_ . "` DEFAULT CHARSET=utf8";
            if (!Db::getInstance()->execute($sql)) {
                return false;
            }
            $this->installMembershipPlanDatabase();
            /* changes over */
            Hook::exec('actionKbMarketPlaceInstall', array());
            return true;
        } else {
            return false;
        }
    }
    
    /*
     * function to generate unique key
     */
    protected function kbKeyGenerator($length = 32)
    {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= chr(mt_rand(33, 126));
        }
        return md5($random);
    }
    
    protected function kbShippingMethodName()
    {
        return array(
            array(
                'name' => 'USPS',
                'active' => 1,
            ),
            array(
                'name' => 'FedEx',
                'active' => 1,
            ),
            array(
                'name' => 'DHL',
                'active' => 1,
            ),
            array(
                'name' => 'UPS',
                'active' => 1,
            ),
        );
    }

    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }

        $this->unInstallMarketPlaceTabs();

        Hook::exec('actionKbMarketPlaceUninstall', array());

        return true;
    }

    /**
     * Copy the folder $src into $dst, $dst is created if it do not exist
     * @param      $src
     * @param      $dst
     * @param bool $del if true, delete the file after copy
     */
    public static function recurseCopy($src, $dst, $del = false)
    {
        if (!Tools::file_exists_cache($src)) {
            return false;
        }
        $dir = opendir($src);

        if (!Tools::file_exists_cache($dst)) {
            mkdir($dst);
        }
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src.DIRECTORY_SEPARATOR.$file)) {
                    self::recurseCopy($src.DIRECTORY_SEPARATOR.$file, $dst.DIRECTORY_SEPARATOR.$file, $del);
                } else {
                    copy($src.DIRECTORY_SEPARATOR.$file, $dst.DIRECTORY_SEPARATOR.$file);
                    if ($del && is_writable($src.DIRECTORY_SEPARATOR.$file)) {
                        unlink($src.DIRECTORY_SEPARATOR.$file);
                    }
                }
            }
        }
        closedir($dir);
        if ($del && is_writable($src)) {
            rmdir($src);
        }
    }

    public function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object) && !is_link($dir."/".$object)) {
                        $this->rrmdir($dir."/".$object);
                    } else {
                        unlink($dir."/".$object);
                    }
                }
            }
            rmdir($dir);
        }
    }
    
    private function installMembershipPlanDatabase()
    {
        if (!Configuration::get('KB_MP_MEMBERSHIP_PLAN')) {
            Configuration::updateValue('KB_MP_MEMBERSHIP_PLAN', $this->kbKeyGenerator());
        }
        
        $sql = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."kbmp_membership_plan` (
                `id_kbmp_membership_plan` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
                `plan_duration` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `plan_duration_type` INT(11) UNSIGNED NOT NULL DEFAULT '1',
                `is_enabled_product_limit` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `product_limit` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `position` INT(11) UNSIGNED,
                `active`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' ,
                `is_deleted`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' ,
                `is_free`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' ,
                `id_product` INT(11) UNSIGNED,
                `id_shop` INT(11) UNSIGNED,
                `date_add` DATETIME NOT NULL ,
                `date_upd` DATETIME NULL ,
                PRIMARY KEY (`id_kbmp_membership_plan`)
            ) ENGINE=`" . _MYSQL_ENGINE_ . "` DEFAULT CHARSET=utf8";
        if (!Db::getInstance()->execute($sql)) {
            return false;
        }
        
        $sql = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."kbmp_membership_plan_order` (
                `id_kbmp_membership_plan_order` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
                `id_kbmp_membership_plan` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `id_cart` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `id_order` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `plan_name` varchar(200) DEFAULT NULL,
                `id_seller` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `id_order_detail` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `is_paid`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' ,
                `status` enum('0','1','2','3') NOT NULL DEFAULT '0' ,
                `plan_duration` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `plan_duration_type` INT(11) UNSIGNED NOT NULL DEFAULT '1',
                `is_enabled_product_limit` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `product_limit` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `quantity` INT(11) UNSIGNED,
                `id_shop` INT(11) UNSIGNED,
                `date_add` DATETIME NOT NULL ,
                `active_date` VARCHAR(255) NULL ,
                `expire_date` VARCHAR(255) NULL ,
                PRIMARY KEY (`id_kbmp_membership_plan_order`)
            ) ENGINE=`" . _MYSQL_ENGINE_ . "` DEFAULT CHARSET=utf8";
        if (!Db::getInstance()->execute($sql)) {
            return false;
        }
        
        
        $create_table = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'kbmp_membership_seller_product_tracking` (
            `id_kbmp_membership_seller_product_tracking` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_seller` int(10) UNSIGNED NOT NULL,
            `id_product` int(10) UNSIGNED NOT NULL,
            `product_status` tinyint(1) NOT NULL,
             PRIMARY KEY (`id_kbmp_membership_seller_product_tracking`))';
        if (!Db::getInstance()->execute($create_table)) {
            return false;
        }
        
        $create_table = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'kbmp_membership_seller_tracking` (
            `id_kbmp_membership_seller_tracking` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `id_seller` int(10) UNSIGNED NOT NULL,
             PRIMARY KEY (`id_kbmp_membership_seller_tracking`))';
        if (!Db::getInstance()->execute($create_table)) {
            return false;
        }
        
        //Creating table for storing reminder profile
        $query = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "kb_membership_reminder_profile` (
                    `id_kb_membership_reminder_profile` int(10) NOT NULL auto_increment,
                    `no_of_days` int(10) NOT NULL,
                    `reminder_type` enum('warning','expiry') NOT NULL,
                    `active` enum('1','0') NOT NULL,
                    `date_add` datetime NOT NULL,
                    `date_updated` datetime NOT NULL,
                    PRIMARY KEY (`id_kb_membership_reminder_profile`)
                  ) ENGINE=" . _MYSQL_ENGINE_ . " DEFAULT CHARSET=UTF8;";
        Db::getInstance()->execute($query);

        //Create email templates table for reminder profile
        $query = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'kb_membership_reminder_profile_templates` (
			`id_kb_membership_reminder_profile_templates` int(10) NOT NULL auto_increment,
                        `id_kb_membership_reminder_profile` int(10) NOT NULL,
			`id_lang` int(10) NOT NULL,
			`id_shop` INT(11) NOT NULL DEFAULT  "0",
			`iso_code` char(4) NOT NULL,
			`template_name` varchar(255) NOT NULL,
			`text_content` text NOT NULL,
			`subject` varchar(255) NOT NULL,
			`body` longtext NOT NULL,
			`date_added` DATETIME NULL,
			`date_updated` DATETIME NULL,
			PRIMARY KEY (`id_kb_membership_reminder_profile_templates`),
			INDEX (`id_lang`),
                        INDEX (`template_name`),
                        INDEX (`id_kb_membership_reminder_profile`)
			) CHARACTER SET utf8 COLLATE utf8_general_ci';
        Db::getInstance()->execute($query);
        return;
    }
    
    public function getContent()
    {
        $this->unInstallMarketPlaceTabs();
        $this->installMarketPlaceTabs();
        
        $html = null;
        if (Tools::getIsset('KB_MARKETPLACE_CSS')
            && Tools::getIsset('submitMarketplaceConfiguration')) {
            $custom_css = urlencode(Tools::getValue('KB_MARKETPLACE_CSS'));
            $custom_css = serialize($custom_css);
            Configuration::updateValue('KB_MARKETPLACE_CSS', $custom_css);
        }
        if (Tools::getIsset('KB_MARKETPLACE_JS')
            && Tools::getIsset('submitMarketplaceConfiguration')) {
            $custom_js = urlencode(Tools::getValue('KB_MARKETPLACE_JS'));
            $custom_js = serialize($custom_js);
            Configuration::updateValue('KB_MARKETPLACE_JS', $custom_js);
        }
        if (Tools::getIsset('KB_MARKETPLACE') && Tools::getIsset('submitMarketplaceConfiguration')) {
            Configuration::updateValue('KB_MARKETPLACE', Tools::getValue('KB_MARKETPLACE'));

            $html .= $this->displayConfirmation($this->l('Configuration has been saved successfully.'));
        }
        return $html . $this->renderConfigurationHtml();
    }

    private function renderConfigurationHtml()
    {
        $fields_form_1 = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Configuration'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'is_bool' => true, //retro compat 1.5
                        'label' => '<strong>' . $this->l('Enable') . ':</strong>',
                        'name' => 'KB_MARKETPLACE',
                        'desc' => $this->l('This setting will enable/disable entire marketplace working except earning of you and sellers on order placing.'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'label' => $this->l('Custom CSS'),
                        'type' => 'textarea',
                        'hint' => $this->l('Enter custom CSS code for marketplace'),
                        'class' => '',
                        'name' => 'KB_MARKETPLACE_CSS',
                    ),
                    array(
                        'label' => $this->l('Custom JS'),
                        'type' => 'hidden',
                        'hint' => $this->l('Enter custom JS code for marketplace'),
                        'class' => '',
                        'name' => 'KB_MARKETPLACE_JS',
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'class' => 'btn btn-default pull-right',
                    'name' => 'submitMarketPlaceConfiguration',
                )
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->submit_action = 'submitMarketplaceConfiguration';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigurationFieldValues()
        );

        return $helper->generateForm(array($fields_form_1));
    }

    public function hookDisplayBackOfficeHeader()
    {
        $controller = $this->context->controller->controller_name;
        if (($controller == 'AdminCarriers'
            || $controller == 'AdminCarrierWizard')
            && isset($this->context->cookie->kbcarrierredirect)
            && $this->context->cookie->kbcarrierredirect) {
            $msg = $this->l('You do not have permission to update seller carriers.');
            $this->context->controller->errors[] = $msg;
            unset($this->context->cookie->kbcarrierredirect);
        }
        $this->context->controller->addCSS($this->_path . parent::CSS_ADMIN_PATH . 'kb-marketplace.css');
        
        $this->context->controller->addJs($this->_path . 'views/js/admin/kb-marketplace-customer.js');
    }

    public function hookDisplayAdminCustomersForm($param)
    {
        unset($param);
        return $this->renderSellerSettingForm();
    }
    
    public function setKbMedia()
    {
        $this->context->controller->addCSS($this->_path . 'views/css/front/kb_front.css');
        $this->context->controller->addJS($this->_path . 'views/js/velovalidation.js');
        $this->context->controller->addJS($this->_path . 'views/js/admin/validation_admin.js');
    }
    
    public function hookDisplayCustomerAccountForm()
    {
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (isset($mp_config['kbmp_seller_separate_registration_form']) && $mp_config['kbmp_seller_separate_registration_form'] == 1) {
                if ($this->context->controller->php_self != 'identity' && Tools::getIsset('seller_registration_form') && (int) Tools::getValue('seller_registration_form') == 1) {
                    $kb_available_field = KbMpCustomFields::getAvailableCustomFields();
                    $kb_final_field = array();
                    $current_lang_id = $this->context->language->id;
                    $total_active_country = Country::getCountries($current_lang_id, true);
                    foreach ($kb_available_field as $key => $avialable_field) {
                        if (!empty($avialable_field) && is_array($avialable_field)) {
                            $avialable_field['default_value'] = Tools::jsonDecode($avialable_field['default_value'], true);
                        }
                        $kb_final_field[] = $avialable_field;
                    }
                    $registration_form_fields = array(
                        'shop_title',
                        'seller_contact_number',
                        'seller_country',
                        'seller_city'
                    );

                    $registration_form_extra_fields = array();
                    foreach ($registration_form_fields as $key => $field_name) {
                        $is_enabled = 0;
                        if (isset($mp_config['kbmp_'.$field_name]) && $mp_config['kbmp_'.$field_name] == 1) {
                            $is_enabled = 1;
                        }
                        $registration_form_extra_fields[$field_name] = $is_enabled;
                    }
                    
                    /*
                     * changes by rishabh jain for membership plan
                     */
                    $membership_settings = array();
                    if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
                        $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
                    }
                    $show_plan_list = 0;
                    if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1 && isset($membership_settings['kbmp_enable_membership_plan_seller_registration']) && $membership_settings['kbmp_enable_membership_plan_seller_registration'] == 1) {
                        $membership_plans = KbMpMemberShipPlan::getMemberShipPlans(false, null, null, null, null, true, Context::getContext()->language->id);
                        if (count($membership_plans) > 0) {
                            $show_plan_list = 1;
                        }
                    }
                    if ($show_plan_list) {
                        $registration_form_extra_fields['membership_plan'] = 1;
                        $this->context->smarty->assign('total_active_plan', $membership_plans);
                    }
                    /*
                     * changes over
                     */
                    $this->context->controller->addJQueryUi('ui.datepicker');
                    $this->context->controller->addJQueryUi('ui.slider');
                    $this->context->controller->addJS($this->_path . 'views/js/front/validation_front.js');
                    $this->context->smarty->assign('registration_form_extra_fields', $registration_form_extra_fields);
                    $this->context->smarty->assign('kb_available_field', $kb_final_field);
                    $this->context->smarty->assign('default_country_id', Configuration::get('PS_COUNTRY_DEFAULT'));
                    $this->context->smarty->assign('total_active_country', $total_active_country);
                    return $this->display(__FILE__, 'views/templates/hook/field_display_front.tpl');
                }
            }
        }
    }
    
    public function getCountries($idLang)
    {
        $countries = array();
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
		SELECT cl.`name` country, c.`call_prefix` prefix, c.id_country 
		FROM `' . _DB_PREFIX_ . 'country` c ' . Shop::addSqlAssociation('country', 'c') . '
		LEFT JOIN `' . _DB_PREFIX_ . 'country_lang` cl ON (c.`id_country` = cl.`id_country` AND cl.`id_lang` = ' . (int) $idLang . ')
		WHERE 1 AND c.active = 1 and c.call_prefix is not null and c.call_prefix != "" ORDER BY cl.name ASC');

        foreach ($result as $row) {
            $countries[] = $row;
        }

        return $countries;
    }
    
    public function hookDisplayCustomerAccountFormTop($params = array())
    {
        if (isset($this->context->customer->id) && $this->context->customer->id > 0) {
            if (KbSeller::getSellerByCustomerId($this->context->customer->id)) {
                return '';
            }
        }
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (isset($mp_config['kbmp_seller_registration']) && $mp_config['kbmp_seller_registration'] == 1) {
                $context = $this->context;
                $agreement_txt = '';
                if (!empty($mp_config['kbmp_seller_agreement'])
                    && isset($mp_config['kbmp_seller_agreement'][$context->language->id])
                    && !empty($mp_config['kbmp_seller_agreement'][$context->language->id])) {
                    $agreement_txt = $mp_config['kbmp_seller_agreement'][$context->language->id];
                    $agreement_txt = Tools::htmlentitiesDecodeUTF8($agreement_txt);
                }
                $context->smarty->assign(
                    array('kb_seller_agreement' => $agreement_txt)
                );
                return $this->display(__FILE__, 'views/templates/hook/account_form_registration.tpl');
            }
        }
    }

    public function hookAdditionalCustomerFormFields($params = array())
    {
        if (isset($this->context->customer->id) && $this->context->customer->id > 0) {
            if (KbSeller::getSellerByCustomerId($this->context->customer->id)) {
                return array();
            }
        }
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (isset($mp_config['kbmp_seller_registration']) && $mp_config['kbmp_seller_registration'] == 1) {
                if (isset($mp_config['kbmp_seller_separate_registration_form']) && $mp_config['kbmp_seller_separate_registration_form'] == 1) {
                    if ($this->context->controller->php_self != 'identity' && Tools::getIsset('seller_registration_form') && (int) Tools::getValue('seller_registration_form') == 1) {
                        $context = $this->context;
                        if (isset($mp_config['kbmp_seller_agreement'][$context->language->id])
                            && !empty($mp_config['kbmp_seller_agreement'][$context->language->id])) {
                            $label = $this->l('I have read the agreement and want to register as seller.');
                            $label .= '(<a id="open_kb_seller_agreement_modal" 
                                href="javascript:void(0)" data-modal="kb_seller_agreement_modal" style="color: #dd0000;">'
                                .$this->l('Click to Read').'</a>)';
                        } else {
                            $label = $this->l('I want to register as a seller');
                        }
                        $fields = array();
                        $form_field = new FormField;
                        $form_field->setName('kbmp_registered_as_seller');
                        $form_field->setType('checkbox');
                        $form_field->setLabel($label);
                        $fields[] = $form_field;
                        return $fields;
                    }
                } else {
                    $context = $this->context;
                    if (isset($mp_config['kbmp_seller_agreement'][$context->language->id])
                        && !empty($mp_config['kbmp_seller_agreement'][$context->language->id])) {
                        $label = $this->l('I have read the agreement and want to register as seller.');
                        $label .= '(<a id="open_kb_seller_agreement_modal" 
                            href="javascript:void(0)" data-modal="kb_seller_agreement_modal" style="color: #dd0000;">'
                            .$this->l('Click to Read').'</a>)';
                    } else {
                        $label = $this->l('Also register me as seller');
                    }
                    $fields = array();
                    $form_field = new FormField;
                    $form_field->setName('kbmp_registered_as_seller');
                    $form_field->setType('checkbox');
                    $form_field->setLabel($label);
                    $fields[] = $form_field;
                    return $fields;
                }
            }
        }
        return array();
    }

    public function hookActionCustomerAccountAdd($param)
    {
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            $do_register = Tools::getValue('kbmp_registered_as_seller', false);
            if (isset($mp_config['kbmp_seller_registration'])
                && $mp_config['kbmp_seller_registration'] == 1
                && $do_register
            ) {
                $new_customer = $param['newCustomer'];
                $seller = new KbSeller();
                $seller->id_customer = $new_customer->id;
                $seller->id_shop = $new_customer->id_shop;
                $seller->id_default_lang = $new_customer->id_lang;
                $seller->approved = KbGlobal::APPROVAL_WAITING;
                $seller->active = KbGlobal::DISABLE;
                $seller->deleted = 0;
                $seller->notification_type = (string)KbSeller::NOTIFICATION_PRIMARY;
                $seller->product_limit_wout_approval = 0;
                $seller->approval_request_limit = (int) KbGlobal::getGlobalSettingByKey('kbmp_approval_request_limit');
                
                $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                if (isset($mp_config['kbmp_seller_separate_registration_form']) && $mp_config['kbmp_seller_separate_registration_form'] == 1) {
                    $seller->business_email = $new_customer->email;
                    if (isset($mp_config['kbmp_seller_contact_number']) && $mp_config['kbmp_seller_contact_number'] == 1) {
                        if (Tools::getIsset('seller_contact_number') && Tools::getValue('seller_contact_number') != '') {
                            $seller->phone_number = trim(Tools::getValue('seller_contact_number'));
                        }
                    }
                    if (isset($mp_config['kbmp_seller_country']) && $mp_config['kbmp_seller_country'] == 1) {
                        if (Tools::getIsset('seller_country') && Tools::getValue('seller_country') != '') {
                            $seller->id_country = Tools::getValue('seller_country', 0);
                        }
                    }
                    if (isset($mp_config['kbmp_seller_city']) && $mp_config['kbmp_seller_city'] == 1) {
                        if (Tools::getIsset('seller_city') && Tools::getValue('seller_city') != '') {
                            $seller->state = trim(Tools::getValue('seller_city'));
                        }
                    }
                }

                if ($seller->save(true)) {
                    $data = array(
                        'email' => $new_customer->email,
                        'name' => $new_customer->firstname . ' ' . $new_customer->lastname
                    );
                    $email = new KbEmail(KbEmail::getTemplateIdByName('mp_welcome_seller'), $new_customer->id_lang);
                    $email->sendWelcomeEmailToCustomer($data);

                    $email = new KbEmail(
                        KbEmail::getTemplateIdByName('mp_seller_registration_notification_admin'),
                        Configuration::get('PS_LANG_DEFAULT')
                    );
                    $email->sendNotificationOnNewRegistration($data);

                    KbSellerSetting::saveSettingForNewSeller($seller);
                    KbSellerSetting::assignCategoryGlobalToSeller($seller);
                    
                    $seller_shipping = new KbSellerShipping();
                    $seller_shipping->createAndAssignFreeShipping($seller);
                    // changes by rishabh jain for saving shop title and phone number
                    if (isset($mp_config['kbmp_seller_separate_registration_form']) && $mp_config['kbmp_seller_separate_registration_form'] == 1) {
                        if (isset($mp_config['kbmp_shop_title']) && $mp_config['kbmp_shop_title'] == 1) {
                            if (Tools::getIsset('shop_title') && Tools::getValue('shop_title') != '') {
                                $seller_title_lang = Tools::getValue('shop_title');
                                $seller_contact_number = Tools::getValue('seller_contact_number');
                                $seller_country = Tools::getValue('seller_country');
                                $seller_city = Tools::getValue('seller_city');
                                $languages = Language::getLanguages(false);
                                foreach ($languages as $lang) {
                                    $result = Db::getInstance()->getRow('SELECT * FROM ' . _DB_PREFIX_ . 'kb_mp_seller_lang where id_seller=' . (int) $seller->id . ' AND id_lang=' . (int) $lang['id_lang']);
                                    if (!empty($result) && count($result) >= 1) {
                                        DB::getInstance()->execute(
                                            'UPDATE ' . _DB_PREFIX_ . 'kb_mp_seller_lang'
                                            . ' set title="' . pSQL($seller_title_lang)
                                            . '" WHERE id_seller_lang=' . (int) $result['id_seller_lang']. ' and id_seller = '.(int) $seller->id
                                        );
                                    }
                                }
                            }
                        }
                        $this->addUpdateCustomFieldData($new_customer->id, $seller->id);
                    }
                    // changes over
                    $membership_settings = array();
                    if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
                        $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
                    }
                    $show_plan_list = 0;
                    if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1 && isset($membership_settings['kbmp_enable_membership_plan_seller_registration']) && $membership_settings['kbmp_enable_membership_plan_seller_registration'] == 1) {
                        $membership_plans = KbMpMemberShipPlan::getMemberShipPlans();
                        if (count($membership_plans) > 0) {
                            $show_plan_list = 1;
                        }
                    }
                    if ($show_plan_list) {
                        if (Tools::getIsset('seller_membership_plan') && Tools::getValue('seller_membership_plan') != '') {
                            if (Context::getContext()->customer->id && (bool) KbSeller::getSellerByCustomerId((int) Context::getContext()->customer->id)) {
                                $is_membership_product_in_cart = 0;
                                $cart_products = Context::getContext()->cart->getProducts();
                                if (!empty($cart_products)) {
                                    foreach ($cart_products as $key => $products) {
                                        if (KbMpMemberShipPlan::isMemberShipPlanTypeProduct($products['id_product'])) {
                                            $is_membership_product_in_cart = 1;
                                            break;
                                        }
                                    }
                                }
                                if (!$is_membership_product_in_cart) {
                                    $this->addMemberShipPlanToCart((int)Tools::getValue('seller_membership_plan'));
                                }
                            }
                        }
                    }
                    Hook::exec('actionKbMarketPlaceCustomerRegistration', array('seller' => $seller));
                }
            }
        }
    }
    
    private function addMembershipPlanToCart($id_plan)
    {
        if ($id_plan > 0) {
            $id_product_attribute = 0;
            if (!$this->context->cart->id) {
                $this->context->cart->add();
                if ($this->context->cart->id) {
                    $this->context->cookie->id_cart = (int) $this->context->cart->id;
                }
            }
            $plan_obj = new KbMpMemberShipPlan($id_plan);
            $id_product = $plan_obj->id_product;
            $this->context->cart->updateQty(1, $id_product, 0);
//            $cart_page_link = $this->context->link->getPageLink(
//                'cart',
//                null,
//                $this->context->language->id,
//                array(
//                    'action' => 'show'
//                ),
//                false,
//                null,
//                true
//            );
//            Tools::redirect($cart_page_link);
        }
    }
    
    public function addUpdateCustomFieldData($id_customer, $id_seller)
    {
        $availableFields = KbMpCustomFields::getAvailableCustomFields();
        foreach ($availableFields as $available) {
            $id_field = KbMpCustomFields::getCustomFieldIDbyName($available['field_name']);
            $kbcustomfield = new KbMpCustomFields($id_field);
            $file = '';
            $field_value = '';
            if (($kbcustomfield->type == 'select') || ($kbcustomfield->type == 'checkbox') || ($kbcustomfield->type == 'radio')) {
                if (Tools::getIsset($kbcustomfield->field_name)) {
                    $field_value = Tools::jsonEncode(Tools::getValue($kbcustomfield->field_name));
                }
            } elseif ($kbcustomfield->type == 'file') {
                if (isset($_FILES[$kbcustomfield->field_name])) {
                    $file = $_FILES[$kbcustomfield->field_name];
                    if (($file['error'] == 0) && !empty($file['name'])) {
                        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                        $allowed_extension = preg_split('/[\s*,\s*]*,+[\s*,\s*]*/', $kbcustomfield->file_extension);
                        if (in_array(Tools::strtolower($file_extension), $allowed_extension)) {
//                        if (in_array($file_extension, $allowed_extension)) {
//                            $path = _PS_MODULE_DIR_ .  'kbmarketplace/views/upload/' . time() . '.' . $file_extension;
                            $path = _PS_MODULE_DIR_ .  'kbmarketplace/views/upload/'.$kbcustomfield->id_field.'_' . time() . '.' . $file_extension;
                            move_uploaded_file(
                                $_FILES[$kbcustomfield->field_name]['tmp_name'],
                                $path
                            );
//                            chmod(_PS_MODULE_DIR_ .  'kbmarketplace/views/upload/' . time() . '.' . $file_extension, 0777);
                            chmod(_PS_MODULE_DIR_ .  'kbmarketplace/views/upload/'.$kbcustomfield->id_field.'_' . time() . '.' . $file_extension, 0777);
                            $field_value = Tools::jsonEncode(
                                array(
                                    'path' => $path,
                                    'type' => $file['type'],
                                    'extension' => $file_extension
                                )
                            );
                        } else {
                            $field_value = '';
                        }
                    } else {
                        $field_value = '';
                    }
                }
            } elseif ($kbcustomfield->type == 'text' || $kbcustomfield->type == 'textarea' || $kbcustomfield->type == 'date' || $kbcustomfield->type == 'datetime') {
                if (Tools::getIsset($kbcustomfield->field_name)) {
                    $field_value = Tools::getValue($kbcustomfield->field_name);
                }
            }
            $id_employee = 0;
            if ($field_value != '') {
                if (!empty($id_customer) && $id_customer != '') {
                    $id_mapping = KbMpCustomFieldSellerMapping::getIDBySellerAndField($id_seller, $id_field);
                    $kbmapping = new KbMpCustomFieldSellerMapping($id_mapping);
                } else {
                    $kbmapping = new KbMpCustomFieldSellerMapping();
                }
                $kbmapping->id_field = $id_field;
                
                $kbmapping->value = $field_value;
                
                $kbmapping->id_employee = $id_employee;
                $kbmapping->id_customer = $id_customer;
                $kbmapping->id_seller = $id_seller;
                if ($kbmapping->save()) {
                } else {
                }
            }
        }
    }
    
    public function hookDisplayNav1()
    {
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            $kb_displaynav1_links = array();
            if (isset($mp_config['kbmp_show_seller_on_front']) && $mp_config['kbmp_show_seller_on_front'] == 1) {
                $seller_list_link = $this->context->link->getModuleLink(
                    $this->name,
                    'sellerfront',
                    array(),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                );
                $kb_displaynav1_links[] = array(
                    'href' => $seller_list_link,
                    'label' => $this->l('Sellers'),
                    'title' => $this->l('Click to view all sellers')
                );
                $this->context->smarty->assign('kb_displaynav1_links', $kb_displaynav1_links);
                return $this->display(__FILE__, 'views/templates/hook/display_nav1.tpl');
            }
        }
    }

    public function hookDisplayNav2()
    {
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            if ($this->showTopMenuLink()) {
                $menus = array();
                $seller_menus = $this->getSellerMenus();
                foreach (KbSellerMenu::getAllMenus($this->context->language->id) as $menu) {
                    if (isset($seller_menus[$menu['controller_name']]['label'])) {
                        $label = $this->l($seller_menus[$menu['controller_name']]['label'], 'kbconfiguration');
                        $title = $this->l($seller_menus[$menu['controller_name']]['title'], 'kbconfiguration');
//                        $label = $seller_menus[$menu['controller_name']]['label'];
//                        $title = $seller_menus[$menu['controller_name']]['title'];
                    } else {
                        $label = $this->l($menu['label']);
                        $title = $this->l($menu['title']);
                    }
                    $menus[] = array(
                        'label' => $label,
                        'title' => $title,
                        'href' => $this->context->link->getModuleLink(
                            $menu['module_name'],
                            $menu['controller_name'],
                            array(),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        )
                    );
                }
                if (Module::isInstalled('kbbookingcalendar') && Module::isEnabled('kbbookingcalendar')) {
                    $kb_setting = Tools::jsonDecode(Configuration::get('KB_BOOKING_CALENDAR_GENERAL_SETTING'), true);
                    $is_available_booking_calender_tab = 0;
                    $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                    
                    if (!empty($kb_setting) && $kb_setting['enable']) {
                        if (isset($mp_config['enable_booking_calender_compatibility']) && $mp_config['enable_booking_calender_compatibility'] == 1) {
                            $is_available_booking_calender_tab = 1;
                        }
                    }
                    if ($is_available_booking_calender_tab) {
                        $menus[] = array(
                            'label' => $this->l('Booking Products'),
                            'icon_class' => '&#xe8ef;',
                            'title' => $this->l('Booking Products'),
                            'href' => $this->context->link->getModuleLink(
                                $this->name,
                                'kbbookingproduct',
                                array(),
                                (bool)Configuration::get('PS_SSL_ENABLED')
                            )
                        );
                        $menus[] = array(
                            'label' => $this->l('Booking Price Rules'),
                            'icon_class' => '&#xe53e;',
                            'title' => $this->l('Booking Price Rules'),
                            'href' => $this->context->link->getModuleLink(
                                $this->name,
                                'kbbookingproductpricerules',
                                array(),
                                (bool)Configuration::get('PS_SSL_ENABLED')
                            )
                        );
                    }
                }
                /*
                 * changes by rishabh jain for membership plan functionality
                 */
                $is_available_membership_plan = 0;
                $membership_settings = array();
                if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
                    $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
                }
                $is_available_membership_plan = 0;
                if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1) {
                    $is_available_membership_plan = 1;
                }

                if ($is_available_membership_plan) {
                    $menus[] = array(
                        'label' => $this->l('Membership Plan History'),
                        'icon_class' => '&#xe8ef;',
                        'title' => $this->l('Membership Plan History'),
                        'href' => $this->context->link->getModuleLink(
                            $this->name,
                            'membershipplandetail',
                            array(),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        )
                    );
                    $menus[] = array(
                        'label' => $this->l('Available Membership Plans'),
                        'icon_class' => '&#xe53e;',
                        'title' => $this->l('Available Membership Plans'),
                        'href' => $this->context->link->getModuleLink(
                            $this->name,
                            'membershipplans',
                            array(),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        )
                    );
                }
                /*
                 * changes over
                 */
                
                if (Module::isInstalled('returnmanager') && Module::isEnabled('returnmanager')) {
                    $is_available_return_manager_tab = 0;
                    $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                    $return_manager_config = Tools::unserialize(Configuration::get('VELSOF_RETURNMANAGER'));
                    if (isset($return_manager_config['enable']) && $return_manager_config['enable'] == 1) {
                        if (isset($mp_config['enable_return_manager_compatibility']) && $mp_config['enable_return_manager_compatibility'] == 1) {
                            $is_available_return_manager_tab = 1;
                        }
                    }
                    if ($is_available_return_manager_tab) {
                        $menus[] = array(
                            'label' => $this->l('Return Requests'),
                            'icon_class' => '',
                            'title' => $this->l('Return Requests'),
                            'href' => $this->context->link->getModuleLink(
                                $this->name,
                                'returnrequest',
                                array(),
                                (bool)Configuration::get('PS_SSL_ENABLED')
                            )
                        );
                    }
                }
                
                $this->context->smarty->assign('seller_account_menus', $menus);
                $menu = KbSellerMenu::getMenusByModuleAndController(
                    'kbmarketplace',
                    'dashboard',
                    $this->context->language->id
                );
                $seller_account_link = $this->context->link->getModuleLink(
                    $menu['module_name'],
                    $menu['controller_name'],
                    array(),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                );
                $this->context->smarty->assign('seller_account_link', $seller_account_link);
            }

            $custom_css = '';
            $custom_js = '';
            if (Configuration::get('KB_MARKETPLACE_CSS') && Configuration::get('KB_MARKETPLACE_CSS') != '') {
                $custom_css = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CSS'));
                $custom_css = urldecode($custom_css);
            }
            if (Configuration::get('KB_MARKETPLACE_JS') && Configuration::get('KB_MARKETPLACE_JS') != '') {
                $custom_js = Tools::unserialize(Configuration::get('KB_MARKETPLACE_JS'));
                $custom_js = urldecode($custom_js);
            }
            $this->context->smarty->assign('kb_mp_custom_css', $custom_css);
            $this->context->smarty->assign('kb_mp_custom_js', $custom_js);
            $this->context->smarty->assign('PS_ALLOW_ACCENTED_CHARS_URL', (int)Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL'));

            return $this->display(__FILE__, 'views/templates/hook/top_menu_link.tpl');
        }
    }

    public function hookDisplayCustomerAccount($params)
    {
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            if (!$this->showTopMenuLink()
                && Tools::getIsset('register_as_seller')
                && (int)Tools::getValue('register_as_seller') == 1) {
                $customer = new Customer((int)$this->context->customer->id);
                $seller = new KbSeller();
                $seller->id_customer = $customer->id;
                $seller->id_shop = $customer->id_shop;
                $seller->id_default_lang = $customer->id_lang;
                $seller->approved = KbGlobal::APPROVAL_WAITING;
                $seller->active = KbGlobal::DISABLE;
                $seller->deleted = 0;
                $seller->notification_type = (string)KbSeller::NOTIFICATION_PRIMARY;
                $seller->product_limit_wout_approval = 0;
                $seller->approval_request_limit = (int) KbGlobal::getGlobalSettingByKey('kbmp_approval_request_limit');

                if ($seller->save(true)) {
                    $this->context->smarty->assign('account_created', true);
                    $data = array(
                        'email' => $customer->email,
                        'name' => $customer->firstname . ' ' . $customer->lastname
                    );

                    $email = new KbEmail(KbEmail::getTemplateIdByName('mp_welcome_seller'), $customer->id_lang);
                    $email->sendWelcomeEmailToCustomer($data);

                    $email = new KbEmail(
                        KbEmail::getTemplateIdByName('mp_seller_registration_notification_admin'),
                        Configuration::get('PS_LANG_DEFAULT')
                    );
                    $email->sendNotificationOnNewRegistration($data);

                    KbSellerSetting::saveSettingForNewSeller($seller);
                    KbSellerSetting::assignCategoryGlobalToSeller($seller);
                    
                    $seller_shipping = new KbSellerShipping();
                    $seller_shipping->createAndAssignFreeShipping($seller);
                    
                    Hook::exec('actionKbMarketPlaceCustomerRegistration', array('seller' => $seller));

                    Tools::redirect('my-account');
                }
            }

            if ($this->showTopMenuLink()) {
                $menus = array();
                $seller_menus = $this->getSellerMenus();
                foreach (KbSellerMenu::getAllMenus($this->context->language->id) as $menu) {
                    if (isset($seller_menus[$menu['controller_name']]['label'])) {
//                        $label = $seller_menus[$menu['controller_name']]['label'];
//                        $title = $seller_menus[$menu['controller_name']]['title'];
                        $label = $this->l($seller_menus[$menu['controller_name']]['label'], 'kbconfiguration');
                        $title = $this->l($seller_menus[$menu['controller_name']]['title'], 'kbconfiguration');
                    } else {
                        $label = $this->l($menu['label']);
                        $title = $this->l($menu['title']);
                    }
                    $menus[] = array(
                        'label' => $label,
                        'icon_class' => $menu['icon'],
                        'title' => $title,
                        'href' => $this->context->link->getModuleLink(
                            $menu['module_name'],
                            $menu['controller_name'],
                            array(),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        )
                    );
                }
                if (Module::isInstalled('kbbookingcalendar') && Module::isEnabled('kbbookingcalendar')) {
                    $kb_setting = Tools::jsonDecode(Configuration::get('KB_BOOKING_CALENDAR_GENERAL_SETTING'), true);
                    $is_available_booking_calender_tab = 0;
                    $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                    
                    if (!empty($kb_setting) && $kb_setting['enable']) {
                        if (isset($mp_config['enable_booking_calender_compatibility']) && $mp_config['enable_booking_calender_compatibility'] == 1) {
                            $is_available_booking_calender_tab = 1;
                        }
                    }
                    if ($is_available_booking_calender_tab) {
                        $menus[] = array(
                            'label' => $this->l('Booking Products'),
                            'icon_class' => '&#xe8ef;',
                            'title' => $this->l('Booking Products'),
                            'href' => $this->context->link->getModuleLink(
                                $this->name,
                                'kbbookingproduct',
                                array(),
                                (bool)Configuration::get('PS_SSL_ENABLED')
                            )
                        );
                        $menus[] = array(
                            'label' => $this->l('Booking Price Rules'),
                            'icon_class' => '&#xe53e;',
                            'title' => $this->l('Booking Price Rules'),
                            'href' => $this->context->link->getModuleLink(
                                $this->name,
                                'kbbookingproductpricerules',
                                array(),
                                (bool)Configuration::get('PS_SSL_ENABLED')
                            )
                        );
                    }
                }
                /*
                 * changes by rishabh jain for membership plan functionality
                 */
                $is_available_membership_plan = 0;
                $membership_settings = array();
                if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
                    $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
                }
                $is_available_membership_plan = 0;
                if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1) {
                    $is_available_membership_plan = 1;
                }

                if ($is_available_membership_plan) {
                    $menus[] = array(
                        'label' => $this->l('Membership Plan History'),
                        'icon_class' => '&#xe8ef;',
                        'title' => $this->l('Membership Plan History'),
                        'href' => $this->context->link->getModuleLink(
                            $this->name,
                            'membershipplandetail',
                            array(),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        )
                    );
                    $menus[] = array(
                        'label' => $this->l('Available Membership Plans'),
                        'icon_class' => '&#xe53e;',
                        'title' => $this->l('Available Membership Plans'),
                        'href' => $this->context->link->getModuleLink(
                            $this->name,
                            'membershipplans',
                            array(),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        )
                    );
                }
                /*
                 * changes over
                 */
                if (Module::isInstalled('returnmanager') && Module::isEnabled('returnmanager')) {
                    $is_available_return_manager_tab = 0;
                    $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                    $return_manager_config = Tools::unserialize(Configuration::get('VELSOF_RETURNMANAGER'));
                    if (isset($return_manager_config['enable']) && $return_manager_config['enable'] == 1) {
                        if (isset($mp_config['enable_return_manager_compatibility']) && $mp_config['enable_return_manager_compatibility'] == 1) {
                            $is_available_return_manager_tab = 1;
                        }
                    }
                    if ($is_available_return_manager_tab) {
                        $menus[] = array(
                            'label' => $this->l('Return Requests'),
                            'icon_class' => 'assignment_returned',
                            'title' => $this->l('Return Requests'),
                            'href' => $this->context->link->getModuleLink(
                                $this->name,
                                'returnrequest',
                                array(),
                                (bool)Configuration::get('PS_SSL_ENABLED')
                            )
                        );
                    }
                }
                $this->context->smarty->assign('menus', $menus);
            } else {
                $show_registration_link = KbGlobal::getGlobalSettingByKey('kbmp_seller_registration');
                if ($show_registration_link) {
                    $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                    $context = $this->context;
                    if (!empty($mp_config['kbmp_seller_agreement'])
                        && isset($mp_config['kbmp_seller_agreement'][$context->language->id])
                        && !empty($mp_config['kbmp_seller_agreement'][$context->language->id])) {
                        $context->smarty->assign(
                            array('kb_seller_agreement' =>
                                Tools::htmlentitiesDecodeUTF8(
                                    $mp_config['kbmp_seller_agreement'][$context->language->id]
                                )
                            )
                        );
                    } else {
                        $context->smarty->assign(
                            array('kb_seller_agreement' => '')
                        );
                    }
                    
                    $link_to_register = $this->context->link->getPageLink(
                        'my-account',
                        (bool)Configuration::get('PS_SSL_ENABLED'),
                        null,
                        array('register_as_seller' => 1)
                    );
                    $this->context->smarty->assign('link_to_register', $link_to_register);
                }
            }
            $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            $favourite_seller_link = $this->context->link->getModuleLink(
                'kbmarketplace',
                'favouritesellers',
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            $is_favourite_seller_page = 0;
            if (isset($config['enable_seller_shortlisting']) && $config['enable_seller_shortlisting'] == 1) {
                $is_favourite_seller_page = 1;
            }
            $this->context->smarty->assign('favourite_seller_page_link', $favourite_seller_link);
            $this->context->smarty->assign('is_favourite_seller_page', $is_favourite_seller_page);
            return $this->display(__FILE__, 'views/templates/hook/seller_menus.tpl');
        }
    }

    public function hookDisplayReassurance()
    {
        $page_name = $this->context->smarty->tpl_vars['page']->value['page_name'];
        //code added for displaying seller aggreement on checkout page
        if ($page_name == 'checkout') {
            if (Configuration::get('KB_MARKETPLACE') !== false && Configuration::get('KB_MARKETPLACE') == 1) {
                $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                if (isset($mp_config['kbmp_seller_registration']) && $mp_config['kbmp_seller_registration'] == 1) {
                    $context = $this->context;
                    $agreement_txt = '';
                    if (!empty($mp_config['kbmp_seller_agreement']) && isset($mp_config['kbmp_seller_agreement'][$context->language->id]) && !empty($mp_config['kbmp_seller_agreement'][$context->language->id])) {
                        $agreement_txt = $mp_config['kbmp_seller_agreement'][$context->language->id];
                        $agreement_txt = Tools::htmlentitiesDecodeUTF8($agreement_txt);
                    }
                    $context->smarty->assign(
                        array('kb_seller_agreement' => $agreement_txt)
                    );
                    return $this->display(__FILE__, 'views/templates/hook/account_form_registration.tpl');
                }
            }
        }

        if ($page_name != 'product' || !$id_product = (int)Tools::getValue('id_product', 0)) {
            return '';
        }
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            if (!Configuration::get('KB_MARKETPLACE_CONFIG') || Configuration::get('KB_MARKETPLACE_CONFIG') == '') {
                $settings = KbGlobal::getDefaultSettings();
            } else {
                $settings = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            }
            if (isset($settings['kbmp_enable_seller_details']) && $settings['kbmp_enable_seller_details'] == 1) {
                $id_product = (int)Tools::getValue('id_product');

                if ($id_product > 0) {
                    $seller = KbSellerProduct::getSellerByProductId($id_product);
                    if (is_array($seller) && count($seller) > 0) {
                        $review_count = KbSellerReview::getReviewsBySellerId(
                            $seller['id_seller'],
                            $this->context->language->id,
                            KbGlobal::APPROVED,
                            true
                        );

                        $rating = KbGlobal::convertRatingIntoPercent(
                            KbSellerReview::getSellerRating($seller['id_seller'])
                        );
                        
                        $review_setting = KbSellerSetting::getSellerSettingByKey($seller['id_seller'], 'kbmp_enable_seller_review');
                        if ($review_setting == 1) {
                            $this->context->smarty->assign('display_new_review', true);
                        } else {
                            $this->context->smarty->assign('display_new_review', false);
                        }
                        // changes by rishabh jain
                        $is_enabled_seller_shortlisting = 0;
                        if (isset($settings['enable_seller_shortlisting']) && $settings['enable_seller_shortlisting'] == 1) {
                            $is_enabled_seller_shortlisting = 1;
                        }
                        if ($this->context->cookie->velsof_shortlist_seller != '') {
                            $already_added = explode(',', $this->context->cookie->velsof_shortlist_seller);
                        } else {
                            $already_added = array();
                        }

                        if (in_array($seller['id_seller'], $already_added)) {
                            $this->smarty->assign('is_already_added', 1);
                        } else {
                            $this->smarty->assign('is_already_added', 0);
                        }
                        
                        // changes over
                        $this->context->smarty->assign(array(
                            'id_seller' => $seller['id_seller'],
                            // chanegs by rishabh jain for seller shortlisting
                            'is_enabled_seller_shortlisting' => $is_enabled_seller_shortlisting,
                            'ajaxurl' => $this->context->link->getModuleLink('kbmarketplace', 'ajaxhandler', array(), (bool) Configuration::get('PS_SSL_ENABLED')),
                            // changes over
                            'seller_title' => $seller['title'],
                            'seller_review_count' => $review_count,
                            'seller_rating' => $rating
                        ));
                        return ($this->display(__FILE__, 'views/templates/hook/seller_link_on_product.tpl'));
                    }
                }
            }
        }
        return '';
    }
    
    public function hookActionAuthentication($params)
    {
        $shortlisted = array();
        $shortlisted = $this->getCookieSellers();
        foreach ($shortlisted as $id_seller) {
            if ($this->context->cookie->logged) {
                $search_query = 'select id_customer,id_seller from ' . _DB_PREFIX_ . 'kb_mp_seller_shortlist 
                                                    where id_customer=' . (int) $this->context->cookie->id_customer . '
                                                    and id_seller=' . (int) $id_seller
                        . ' and id_shop=' . (int) $this->context->shop->id;

                $saved_sellers = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($search_query);
                if (empty($saved_sellers) || count($saved_sellers) == 0) {
                    $insert_pro = 'INSERT INTO `' . _DB_PREFIX_ . 'kb_mp_seller_shortlist` (`id_seller`, `id_customer`, `email`,
                                                            `id_shop`, `id_lang`, `date_add`) 
                                                            VALUES ('
                            . (int) $id_seller
                            . ', ' . (int) $this->context->cookie->id_customer
                            . ', "' . pSQL($this->context->cookie->email) . '", ' . (int) $this->context->shop->id
                            . ',' . (int) $this->context->language->id . ', now())';
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($insert_pro);
                }
            }
        }
    }
    
    public function hookDisplayCustomerLoginFormAfter()
    {
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (isset($mp_config['kbmp_seller_registration']) && $mp_config['kbmp_seller_registration'] == 1) {
                if (isset($mp_config['kbmp_seller_separate_registration_form']) && $mp_config['kbmp_seller_separate_registration_form'] == 1) {
                    $link_to_register = $this->context->link->getPageLink(
                        'authentication',
                        (bool)Configuration::get('PS_SSL_ENABLED'),
                        null,
                        array(
                            'create_account' => 1,
                            'seller_registration_form' => 1,
                        )
                    );
                    $this->context->smarty->assign('link_to_register', $link_to_register);
                    return $this->display(__FILE__, 'views/templates/hook/loginform-after.tpl');
                }
            }
        }
    }
    
    public function hookDisplayBackOfficeFooter()
    {
        if (Tools::getIsset('controller') && Tools::getIsset('id_product')) {
            $controller_name = Tools::getValue('controller');
            if ($controller_name == 'AdminProducts') {
                $id_product = (int)Tools::getValue('id_product');
                if ($id_product > 0) {
                    $carrier_list = array();
                    if ($id_seller = KbSellerProduct::getSellerIdByProductId($id_product)) {
                        $carrier_list = KbSellerShipping::getShippingForProducts(
                            $this->context->language->id,
                            $id_seller,
                            false,
                            false,
                            false,
                            false,
                            Carrier::ALL_CARRIERS,
                            true
                        );
                    } else {
                        $carrier_list = KbSellerShipping::getShippingForProducts(
                            $this->context->language->id,
                            0,
                            true,
                            false,
                            false,
                            false,
                            Carrier::ALL_CARRIERS,
                            true
                        );
                    }
                    if (!empty($carrier_list)) {
                        $product = new Product($id_product);
                        $carrier_selected_list = $product->getCarriers();
                        foreach ($carrier_list as &$carrier) {
                            foreach ($carrier_selected_list as $carrier_selected) {
                                if ($carrier_selected['id_reference'] == $carrier['id_reference']) {
                                    $carrier['selected'] = true;
                                    continue;
                                }
                            }
                        }
                        $this->context->smarty->assign('kb_avail_carrier_list', $carrier_list);
                        return $this->display(__FILE__, 'views/templates/hook/carrier_list_to_admin.tpl');
                    }
                }
            }
        }
        return '';
    }
    
    public function hookDisplayTop()
    {
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            if (!Configuration::get('KB_MARKETPLACE_CONFIG') || Configuration::get('KB_MARKETPLACE_CONFIG') == '') {
                $settings = KbGlobal::getDefaultSettings();
            } else {
                $settings = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            }
            if (isset($settings['kbmp_enable_seller_details']) && $settings['kbmp_enable_seller_details'] == 1) {
                $shortlisted_products = array();
                $shortlisted = $this->getCookieSellers();
                if ($this->context->cookie->logged) {
                    $select_sellers = 'select id_seller from ' . _DB_PREFIX_ . 'kb_mp_seller_shortlist where id_customer=' . (int) $this->context->cookie->id_customer
                            . ' and id_shop=' . (int) $this->context->shop->id;

                    $sellers = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($select_sellers);
                    if ($sellers && count($sellers) > 0) {
                        foreach ($sellers as $seller) {
                            $shortlisted[] = $seller['id_seller'];
                        }
                        $shortlisted = array_unique($shortlisted);
                        $this->context->cookie->velsof_shortlist_seller = implode(',', $shortlisted);
                    }
                }
            }
        }
    }
    private function getCookieSellers()
    {
        $shortlisted = array();
        $this->context->cookie->velsof_shortlist_seller = trim($this->context->cookie->velsof_shortlist_seller);
        $this->context->cookie->velsof_shortlist_seller = trim($this->context->cookie->velsof_shortlist_seller, ',');
        if ($this->context->cookie->velsof_shortlist_seller != '') {
            $shortlisted = explode(',', $this->context->cookie->velsof_shortlist_seller);
        } else {
            $shortlisted = array();
        }
        return $shortlisted;
    }
    public function hookActionCustomerLogoutBefore()
    {
        Context::getContext()->cookie->velsof_shortlist_seller = '';
    }
    private function addSellerToShortlist($id_seller)
    {
        $is_added = true;
        if ($this->context->cookie->logged) {
            $search_query = 'select id_customer,id_seller from ' . _DB_PREFIX_ . 'kb_mp_seller_shortlist
				where id_customer=' . (int) $this->context->cookie->id_customer . ' and id_seller=' . (int) $id_seller . '
				 and id_shop=' . (int) $this->context->shop->id;
            $saved_seller = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($search_query);
            if (empty($saved_seller) || count($saved_seller) == 0) {
                $insert_pro = 'INSERT INTO `' . _DB_PREFIX_ . 'kb_mp_seller_shortlist` (`id_seller`, `id_customer`, `email`,
					`id_shop`, `id_lang`, `date_add`) 
					VALUES ('
                        . (int) $id_seller
                        . ', ' . (int) $this->context->cookie->id_customer
                        . ', "' . pSQL($this->context->cookie->email) . '", ' . (int) $this->context->shop->id
                        . ',' . (int) $this->context->language->id . ', now())';
                if (!Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($insert_pro)) {
                    $is_added = false;
                }
            }
        }
        if ($is_added) {
            if ($this->context->cookie->velsof_shortlist_seller != '') {
                $this->context->cookie->velsof_shortlist_seller = $this->context->cookie->velsof_shortlist_seller
                        . ',' . $id_seller;
            } else {
                $this->context->cookie->velsof_shortlist_seller = $id_seller;
            }
        }
        return $is_added;
    }
    public function removeSellerFromShortlist($id_seller)
    {
        $is_removed = true;
        if ($this->context->cookie->logged) {
            $remove_fromdb = 'DELETE FROM `' . _DB_PREFIX_ . 'kb_mp_seller_shortlist` 
				WHERE `id_seller`=' . (int) $id_seller . ' and `id_customer`=' . (int) $this->context->cookie->id_customer . ' 
				 and id_shop=' . (int) $this->context->shop->id;
            if (!Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($remove_fromdb)) {
                $is_removed = false;
            }
        }
        if ($is_removed) {
            $saved_arr = array();
            if ($this->context->cookie->velsof_shortlist_seller != '') {
                $saved_arr = explode(',', $this->context->cookie->velsof_shortlist_seller);
            }
            $this->context->cookie->velsof_shortlist_seller = implode(',', array_diff($saved_arr, array($id_seller)));
        }
        return $is_removed;
    }
    public function refreshShortlistData()
    {
        $shortlisted_sellers = array();
        if ($this->context->cookie->velsof_shortlist_seller != '') {
            $shortlisted = explode(',', $this->context->cookie->velsof_shortlist_seller);
        } else {
            $shortlisted = array();
        }
        if (count($shortlisted) > 0) {
        }
        $this->smarty->assign('shortlisted_sellers', $shortlisted);
        $this->smarty->assign('total_shortlisted', count($shortlisted));
        return $this->display(__FILE__, 'views/templates/front/refresh.tpl');
    }
    public function processSeller($id_seller = 0)
    {
        $already_added = $this->getCookieSellers();
        $status = true;
        $action = 1;
        if (!in_array($id_seller, $already_added)) {
            $status = $this->addSellerToShortlist($id_seller);
        } else {
            $action = 0;
            $status = $this->removeSellerFromShortlist($id_seller);
        }
        $json = array('status' => $status, 'action' => $action);
        if ($status) {
            // changes by rishabh jain
            $shortlisted_sellers = array();
            if ($this->context->cookie->velsof_shortlist_seller != '') {
                $shortlisted_sellers = explode(',', $this->context->cookie->velsof_shortlist_seller);
            } else {
                $shortlisted_sellers = array();
            }
            // changes over
            $json['content'] = count($shortlisted_sellers);
        }
        $favourite_seller_link = $this->context->link->getModuleLink(
            'kbmarketplace',
            'favouritesellers',
            array(),
            (bool)Configuration::get('PS_SSL_ENABLED')
        );
        $json['redirect_link'] = $favourite_seller_link;
        echo Tools::jsonEncode($json);
        die;
    }
}
