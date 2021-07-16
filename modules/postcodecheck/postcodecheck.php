<?php
/**
* 2007-2021 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Postcodecheck extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'postcodecheck';
        $this->tab = 'shipping_logistics';
        $this->version = '1.0.0';
        $this->author = 'CodeOperative';
        $this->need_instance = 1;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Post Code Check');
        $this->description = $this->l('Check the buyer\'s a seller\'s postcode to determine if shipping is possible. ');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall? Uninstalling will disable the shipping varification feature. ');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('POSTCODECHECK_LIVE_MODE', false);

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('actionCartSave') &&
            $this->registerHook('displayProductExtraContent') &&
            $this->registerHook('displayProductPriceBlock')&&
            $this->registerHook('actionFrontControllerSetMedia');
    }

    public function uninstall()
    {
        Configuration::deleteByName('POSTCODECHECK_LIVE_MODE');

        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitPostcodecheckModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output;
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPostcodecheckModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Live mode'),
                        'name' => 'POSTCODECHECK_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Enter a valid email address'),
                        'name' => 'POSTCODECHECK_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                    ),
                    array(
                        'type' => 'password',
                        'name' => 'POSTCODECHECK_ACCOUNT_PASSWORD',
                        'label' => $this->l('Password'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return array(
            'POSTCODECHECK_LIVE_MODE' => Configuration::get('POSTCODECHECK_LIVE_MODE', true),
            'POSTCODECHECK_ACCOUNT_EMAIL' => Configuration::get('POSTCODECHECK_ACCOUNT_EMAIL', 'contact@prestashop.com'),
            'POSTCODECHECK_ACCOUNT_PASSWORD' => Configuration::get('POSTCODECHECK_ACCOUNT_PASSWORD', null),
        );
    }

    //register new assests 
    // public function setKbMedia()
    // {
    //     $this->context->controller->addCSS($this->_path . 'views/css/checkpostcode.css');
    //     $this->context->controller->addJS($this->_path . 'views/js/checkpostcode.js');
    // }

    public function hookActionFrontControllerSetMedia($params)
    {
        // Only on product page
        if ('product' === $this->context->controller->php_self) {
            $this->context->controller->registerStylesheet(
                'module-postcodecheck-style',
                'modules/'.$this->name.'/views/css/checkpostcode.css',
                [
                'media' => 'all',
                'priority' => 9000,
                ]
            );

            $this->context->controller->registerJavascript(
                'module-postcodecheck-simple-lib',
                'modules/'.$this->name.'/views/js/checkpostcode.js',
                [
                'position' => 'footer',
                'priority' => 90000,
                'attribute' => 'async',
                ]
            );
        }
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    // public function hookBackOfficeHeader()
    // {
    //     if (Tools::getValue('module_name') == $this->name) {
    //         $this->context->controller->addJS($this->_path.'views/js/back.js');
    //         $this->context->controller->addCSS($this->_path.'views/css/back.css');
    //     }

    //     return $this->display(__FILE__, 'postcodecheck.tpl');
    // }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    // public function hookHeader()
    // {
    //     /* Place your code here. */
    // }

    // public function hookActionCartSave()
    // {
    //     /* Place your code here. */
    // }

    // public function hookDisplayProductExtraContent()
    // {

    // }

    public function hookDisplayProductPriceBlock($params)
    {   

        $carrier_name = "";
        if(!empty($_GET['id_product'])){
            //get the carrier id of the product
            $product_id = $_GET['id_product'];
            $db = \Db::getInstance();
            $sql_carrier = " select `id_carrier_reference` from `psrn_product_carrier` where `id_product` = ".$product_id;
            $carrier_query_result = $db->executeS($sql_carrier);
            $carrier_id = $carrier_query_result[0]["id_carrier_reference"];

            //get carrier id name 
            $carrier_name_query = " select `name` from `psrn_carrier` where `id_carrier` = ".$carrier_id;
            $carrier_name_result = $db->executeS($carrier_name_query);
            $carrier_name = $carrier_name_result[0]["name"];
        }
        // $carrier_name_cut = substr($carrier_name_cut,0);
        // return strlen($carrier_name);
        // $isCollection = strlen($carrier_name) > 30;
        // if (strlen($carrier_name) > 30) {
        //     return "collection only";
        // }
        // else {
        //     return "delivery";
        // }
        
        if ($carrier_name == "Store collection only"  && 'after_price' == $params['type']) {
        // if (strlen($carrier_name) > 30  && 'after_price' == $params['type']) {

            //regEx for postcode
            $this->context->smarty->assign('regExPostCode', '[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}');

            $this->context->smarty->assign([
                'postcodecheck_controller_url' => $this->context->link->getModuleLink('postcodecheck','checkpostcode', ['ajax'=>true]),
                'postcode_string' => null,
                'myPage' => $params['type'],
            ]);

            return $this->display(__FILE__, '../front/collectiononly.tpl');
        }

        if('product' == $this->context->controller->php_self && 'after_price' == $params['type']) {
            // $this->context->controller->addJS($this->_path.'/views/js/front.js');
            // $this->context->controller->addCSS($this->_path.'/views/css/front.css');
            //create a global variable 

            $this->context->smarty->assign('regExPostCode', '[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}');

            $this->context->smarty->assign([
                'postcodecheck_controller_url' => $this->context->link->getModuleLink('postcodecheck','checkpostcode', ['ajax'=>true]),
                'postcode_string' => null,
                'myPage' => $params['type'],
            ]);

            return $this->display(__FILE__, '../front/postcodecheck.tpl');
        } else {
            return false;
        }
    }

    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:postcodecheck/views/templates/front/display.tpl');
    }
}
