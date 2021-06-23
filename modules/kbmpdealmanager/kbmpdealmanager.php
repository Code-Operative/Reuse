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
 * @copyright 2015 knowband
 * @license   see file: LICENSE.txt
 */

class KbMpDealManager extends Module
{
    protected $custom_errors = array();

    const CONTROLLER_NAME = 'AdminKbSellerDeal';
    const FC_CONTROLLER_NAME = 'mydeals';

    public function __construct()
    {
        $this->name = 'kbmpdealmanager';
        $this->tab = 'pricing_promotion';
        $this->version = '1.0.2';
        $this->author = 'Knowband';
        //$this->module_key = '966ef7aa9b434e67d6a01385e1767fdba';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Knowband MarketPlace Deal Manager');
        $this->description = $this->l('Enable sellers to run offers and discounts on his products.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
        parent::__construct();
    }

    public function getErrors()
    {
        return $this->custom_errors;
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        if (!parent::install()
            || !$this->registerHook('displayNav2')
            || !$this->registerHook('actionKbMarketPlaceInstall')
            || !$this->registerHook('actionKbMarketPlaceUninstall')
            || !$this->registerHook('displayAdminKbMarketPlaceSettingForm')
            || !$this->registerHook('displayAdminKbSellerDealForm')
            || !$this->registerHook('displayKbMarketPlacePForm')
            || !$this->registerHook('actionMarketplaceSetting')
            || !$this->registerHook('displayKbSellerAccountMenu')) {
            return false;
        }

        $this->installAdminTab();

        $temp = false;
        $source_dir = _PS_MODULE_DIR_ . $this->name . '/libraries';
        $dest_dir = _PS_OVERRIDE_DIR_ . 'classes/kbmarketplace';
        if (method_exists(get_class(new Tools()), "recurseCopy")) {
            if (Tools::recurseCopy($source_dir, $dest_dir) === false) {
                $this->custom_errors[] = 'Error occurred while overriding file.';
            } else {
                Tools::chmodr($dest_dir, 0777);
                $temp = true;
            }
        } else {
            if (KbGlobal::recurseCopy($source_dir, $dest_dir) === false) {
                $this->custom_errors[] = 'Error occurred while overriding file.';
            } else {
                Tools::chmodr($dest_dir, 0777);
                $temp = true;
            }
        }
        if (!$temp) {
            return false;
        }

        if (!$this->installModel()) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        $this->unInstallAdminTab();

        if (!parent::uninstall()
            || !$this->unregisterHook('displayNav2')
            || !$this->unregisterHook('actionKbMarketPlaceInstall')
            || !$this->unregisterHook('actionKbMarketPlaceUninstall')
            || !$this->unregisterHook('displayAdminKbMarketPlaceSettingForm')
            || !$this->unregisterHook('displayKbMarketPlacePForm')
            || !$this->unregisterHook('actionMarketplaceSetting')
            || !$this->unregisterHook('displayKbSellerAccountMenu')) {
            return false;
        }

        return true;
    }

    protected function installModel()
    {
        if (!Module::isInstalled('kbmarketplace')) {
            $this->custom_errors[] = $this->l('Please install Knowband Marketplace.');
            return false;
        }

        $module = Module::getInstanceByName('kbmarketplace');
        if (!$module || $module->version < '1.0.4') {
            $this->custom_errors[] = $this->l('Please update your Knowband Marketplace.');
            return false;
        }
        $is_db_installed = Configuration::getGlobalValue('KBMP_DEALMANAGER_DB_INSTALLED');

        if (!$is_db_installed) {
            $installation_error = false;

            $rename_timestamp = time();
            foreach ($this->getDealManagerTables() as $table_name) {
                $check_table = 'SELECT count(*) as value FROM information_schema.tables WHERE table_schema = "'
                    . _DB_NAME_ . '" AND table_name = "' . _DB_PREFIX_ . pSQL($table_name) . '"';
                $installed_table = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($check_table);
                if ((int) $installed_table > 0) {
                    $query = 'RENAME TABLE '
                        . _DB_PREFIX_ . pSQL($table_name) . ' TO '
                        . _DB_PREFIX_ . pSQL($table_name) . '_'
                        . pSQL($rename_timestamp);
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($query);
                }
            }
            if (!file_exists(_PS_MODULE_DIR_ . $this->name . '/db.sql')) {
                $this->custom_errors[] = 'Model installation file not found.';
                $installation_error = true;
            } elseif (!$sql = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->name . '/db.sql')) {
                $this->custom_errors[] = 'Model installation file is empty.';
                $installation_error = true;
            }

            if (!$installation_error) {
                $sql = str_replace(array('_PREFIX_', 'ENGINE_TYPE'), array(_DB_PREFIX_, _MYSQL_ENGINE_), $sql);
                $sql = preg_split("/;\s*[\r\n]+/", trim($sql));
                foreach ($sql as $query) {
                    if (!Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(trim($query))) {
                        $installation_error = true;
                    }
                }
            }

            if (!$installation_error) {
                Configuration::updateGlobalValue('KBMP_DEALMANAGER_DB_INSTALLED', true);
            }

            if ($installation_error) {
                $this->custom_errors[] = 'Installation Failed: Error Occurred while installing models.';
                return false;
            }
        }
        return true;
    }
  
    private function getDealManagerTables()
    {
        return array(
            'kbmp_deal_products',
            'kbmp_deal_rule',
            'kbmp_seller_deal_lang',
            'kbmp_seller_deal'
        );
    }

    public function hookActionKbMarketPlaceInstall($params = array())
    {
        unset($params);
        $this->installAdminTab();

        return true;
    }

    public function hookdisplayKbMarketPlacePForm($params)
    {
        if (Configuration::get('KBMP_DEAL_MANAGER') && Configuration::get('KBMP_DEAL_MANAGER') == 1) {
            $this->context->controller->addjs($this->_path . 'views/js/extra.js');
        }
    }

    public function hookActionKbMarketPlaceUninstall($params = array())
    {
        unset($params);
        $this->unInstallAdminTab();

        return true;
    }
    private function installAdminTab()
    {
        $where = 'module = "' . $this->name . '" AND class_name = "' . self::CONTROLLER_NAME . '"';
        $is_delete = Db::getInstance(_PS_USE_SQL_SLAVE_)->delete(
            'tab',
            $where
        );

        if (!$is_delete) {
            return false;
        }

        if (!Configuration::get('KB_MARKETPLACE')) {
            return true;
        }

        $languages = Language::getLanguages();

        //Add Admin Menu under Marketplace tab
        $id_parent_tab = (int) Tab::getIdFromClassName('KBMPMainTab');
        if (!$id_parent_tab) {
            $sql = 'Select id_tab from ' . _DB_PREFIX_ . 'tab Where module = "kbmarketplace" AND id_parent = 0';
            $id_parent_tab = (int) DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        }
        if ($id_parent_tab) {
            $tab = new Tab();
            foreach ($languages as $lang) {
                $tab->name[$lang['id_lang']] = $this->l('Seller Deals');
            }

            $tab->class_name = self::CONTROLLER_NAME;
            $tab->module = $this->name;
            $tab->active = 1;
            $tab->id_parent = $id_parent_tab;
            if (!$tab->add()) {
                return false;
            }
        }
        return true;
    }

    private function unInstallAdminTab()
    {

        $sql = 'SELECT id_tab FROM `' . _DB_PREFIX_ . 'tab` Where class_name = "' . pSQL(self::CONTROLLER_NAME) . '" 
				AND module = "' . pSQL($this->name) . '"';
        $id_tab = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        $tab = new Tab($id_tab);
        if ($tab->delete()) {
            return true;
        } else {
            return false;
        }
//        $where = 'module = "' . $this->name . '" AND class_name = "' . self::CONTROLLER_NAME . '"';
//        $is_delete = Db::getInstance(_PS_USE_SQL_SLAVE_)->delete(
//            'tab',
//            $where
//        );
//        
//        
//        
//        if (!$is_delete) {
//            return false;
//        }
        return true;
    }
    
    public function hookDisplayAdminKbMarketPlaceSettingForm($params = array())
    {
        unset($params);
        $enable = 0;
        if (Configuration::get('KBMP_DEAL_MANAGER') && Configuration::get('KBMP_DEAL_MANAGER') == 1) {
            $enable = 1;
        }
        $settings = array(
            array(
                'value' => 1,
                'label' => $this->l('Enabled')
            ),
            array(
                'value' => 0,
                'label' => $this->l('Disabled')
            )
        );
        $this->context->smarty->assign('kbmpdealmanager', $settings);
        $this->context->smarty->assign('kbmpdealmanager_enable', $enable);

        return $this->display(__FILE__, 'views/templates/admin/deal_configuration.tpl');
    }

    public function hookDisplayAdminKbSellerDealForm($params = array())
    {
        $code_query = 'Select code from ' . _DB_PREFIX_ . 'kbmp_seller_deal '
                . 'WHERE id_seller_deal='.(int) Tools::getValue('id_seller_deal');
        $code = DB::getInstance()->getRow($code_query);
        $this->context->smarty->assign('code', $code['code']);
        return $this->display(__FILE__, 'views/templates/admin/generate_button.tpl');
    }

    public function hookActionMarketplaceSetting($params = array())
    {
        unset($params);
        $enable = 0;
        if (Tools::getIsset('kbmpdealmanager_enable')) {
            $enable = (int) Tools::getValue('kbmpdealmanager_enable', 0);
        }

        Configuration::updateValue('KBMP_DEAL_MANAGER', $enable);
    }

    public function getModuleTranslationByLanguage($module, $string, $source, $language, $sprintf = null, $js = false)
    {
        $modules = array();
        $langadm = array();
        $translations_merged = array();
        $name = $module instanceof Module ? $module->name : $module;
        
        if (!isset($translations_merged[$name]) && isset(Context::getContext()->language)) {
            $files_by_priority = array(
                _PS_MODULE_DIR_ . $name . '/translations/' . $language . '.php'
            );
            foreach ($files_by_priority as $file) {
                if (file_exists($file)) {
                    include($file);
                    /* No need to define $_MODULE as it is defined in the above included file. */
                    $modules = $_MODULE;
                    $translations_merged[$name] = true;
                }
            }
        }

        $string = preg_replace("/\\\*'/", "\'", $string);
        $key = md5($string);
        if ($modules == null) {
            if ($sprintf !== null) {
                $string = Translate::checkAndReplaceArgs($string, $sprintf);
            }

            return str_replace('"', '&quot;', $string);
        }
        $current_key = Tools::strtolower('<{' . $name . '}' . _THEME_NAME_ . '>' . $source) . '_' . $key;
        $default_key = Tools::strtolower('<{' . $name . '}prestashop>' . $source) . '_' . $key;
        if ('controller' == Tools::substr($source, -10, 10)) {
            $file = Tools::substr($source, 0, -10);
            $current_key_file = Tools::strtolower('<{' . $name . '}' . _THEME_NAME_ . '>' . $file) . '_' . $key;
            $default_key_file = Tools::strtolower('<{' . $name . '}prestashop>' . $file) . '_' . $key;
        }

        if (isset($current_key_file) && !empty($modules[$current_key_file])) {
            $ret = Tools::stripslashes($modules[$current_key_file]);
        } elseif (isset($default_key_file) && !empty($modules[$default_key_file])) {
            $ret = Tools::stripslashes($modules[$default_key_file]);
        } elseif (!empty($modules[$current_key])) {
            $ret = Tools::stripslashes($modules[$current_key]);
        } elseif (!empty($modules[$default_key])) {
            $ret = Tools::stripslashes($modules[$default_key]);
            // if translation was not found in module, look for it in AdminController or Helpers
        } elseif (!empty($langadm)) {
            $ret = Tools::stripslashes(Translate::getGenericAdminTranslation($string, $key, $langadm));
        } else {
            $ret = Tools::stripslashes($string);
        }

        if ($sprintf !== null) {
            $ret = Translate::checkAndReplaceArgs($ret, $sprintf);
        }

        if ($js) {
            $ret = addslashes($ret);
        } else {
            $ret = htmlspecialchars($ret, ENT_COMPAT, 'UTF-8');
        }
        return $ret;
    }
    public function hookDisplayNav2($params)
    {
        $this->l('This voucher cannot be used with this order as this order does not contain the Deal products');
        unset($params);
        if (Configuration::get('KBMP_DEAL_MANAGER') && Configuration::get('KBMP_DEAL_MANAGER') == 1) {
            $current_date = date('Y-m-d H:i:s', time());
            $sql = 'Select COUNT(*) as total from ' . _DB_PREFIX_ . 'kbmp_seller_deal WHERE active = 1';

            $sql .= ' AND from_date <= "' . pSQL($current_date) . '" AND end_date >= "' . pSQL($current_date) . '"';

            $running = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
            if ($running) {
                return $this->display(__FILE__, 'views/templates/front/deals/deal_link.tpl');
            }
        }
        return '';
    }
    
    public function hookDisplayKbSellerAccountMenu($params)
    {
        if (Configuration::get('KBMP_DEAL_MANAGER') && Configuration::get('KBMP_DEAL_MANAGER') == 1) {
            require_once 'KbDealRule.php';
            $active_class = '';
            if ((isset($params['m']) && $params['m'] == $this->name)
                && (isset($params['c']) && ($params['c'] == 'mytickets' || $params['c'] == 'supportconfig'))) {
                $active_class = 'kb-active-menuitem';
            }
            $list_link = $this->context->link->getModuleLink(
                $this->name,
                'mydeals',
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            $config_link = $this->context->link->getModuleLink(
                $this->name,
                'productdeals',
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            $menu_html = ' <style>
                .kb-accordian-symbol, #kb-seller-account-menus .kb-smenu-accordian-symbol{
                   font-family: FontAwesome;
                   font-weight: normal;
                   font-style: normal;
                   text-decoration: inherit;
                   -webkit-font-smoothing: antialiased;
                   float:right;
                   cursor:pointer;
                }

                .kb-accordian-symbol{
                   display:none;
                }

                #kb-seller-account-menus .kb-smenu-accordian-symbol{
                   font-size: 22px;
                }

                #kb-seller-account-menus .kb-active-menuitem .kb-smenu-accordian-symbol{
                   color:#fff;
                }

                .kb-menu-list-item.kb-accordian-symbol.kbexpand:after, #kb-seller-account-menus .kb-smenu-accordian-symbol.kbexpand:after{
                   content:"+";
                }

                .kb-menu-list-item.kb-accordian-symbol.kbcollapse:after, #kb-seller-account-menus .kb-smenu-accordian-symbol.kbcollapse:after{
                   content:"-";
                }
                </style>  
            <li class="kb-menu-list-item  collapsible-otherfeature-menu '.$active_class.'">
                <a title="'.$this->l('Customer Tickets').'" href="javascript:void(0)">
                    <i class="icon-tags"></i>'.$this->l('Discount and Offers').'
                </a>
                <div class="kb-smenu-accordian-symbol kbexpand"></div>
                <ul style="display:none;">
                    <li><a class="' . (($params['c'] == 'mydeals') ? 'smenu-other-feature-menu-active' : '')
                    . '" href="' . $list_link . '">'. $this->l('Catalog and Coupon Deals') . '</a></li>
                    <li><a class="' . (($params['c'] == 'productdeals') ? 'smenu-other-feature-menu-active' : '')
                    . '" href="' . $config_link . '">'. $this->l('Per Product Deals') . '</a></li>
                </ul>   
            </li>';
            return $menu_html;
        }
    }
}
