<?php
/**
* 2007-2020 PrestaShop
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
* @author    PrestaShop SA    <contact@prestashop.com>
* @copyright 2007-2020 PrestaShop SA
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
* International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use PrestaShop\PrestaShop\Adapter\Translator;
use PrestaShop\PrestaShop\Adapter\LegacyContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class HomeNewTab extends Module
{
    public function __construct()
    {
        $this->name = 'homenewtab';
        $this->tab = 'front_office_features';
        $this->version = '1.0.1';
        $this->author = 'Prestahero';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array(
            'min' => '1.7.0.0',
            'max' => _PS_VERSION_,
        );
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('New products in tab');
        $this->description = $this->l('Displays tab in the central column of your homepage with recently added products.');
    }

    public static function psversion()
    {
        $version = _PS_VERSION_;
        $exp = $explode = explode(".", $version);
        $explode;
        return $exp[1];
    }


    public function install()
    {
        $this->_clearCache('*');
        Configuration::updateValue('NEW_NBR', 8);
        Configuration::updateValue('NEW_CAROUSEL', true);
        Configuration::updateValue('NEW_AUTOPLAY_SLI', true);
        Configuration::updateValue('NEW_SPEED_SLI', 5000);
        Configuration::updateValue('NEW_PAG_SLI', false);
        Configuration::updateValue('NEW_ARROWS_SLI', true);
        Configuration::updateValue('NEW_LOOP_SLI', true);
        Configuration::updateValue('NEW_COL', 4);
        Configuration::updateValue('NEW_COL_1200', 4);
        Configuration::updateValue('NEW_COL_992', 3);
        Configuration::updateValue('NEW_COL_769', 3);
        Configuration::updateValue('NEW_COL_576', 2);
        Configuration::updateValue('NEW_ROWS_SLI', 1);
        Configuration::updateValue('NEW_TABS', true);
        $this->fillMultilangValues();
        return parent::install() && $this->registerHook('displayBackofficeHeader') && $this->registerHook('actionAdminControllerSetMedia') && $this->registerHook('displayHeader') && $this->registerHook('addproduct') && $this->registerHook('addproduct') && $this->registerHook('updateproduct') && $this->registerHook('deleteproduct') && $this->registerHook('categoryUpdate') && $this->registerHook('displayHomeTab') && $this->registerHook('displayHomeTabContent');
    }

    public function fillMultilangValues()
    {
        $languages = Language::getLanguages(false);
        foreach ($this->getMultilangFields(false) as $name => $data) {
            foreach ($languages as $lang) {
                $key = Tools::strtoupper('HOMENEWTAB_'.$name).'_'.$lang['id_lang'];
                $value = html_entity_decode($data[1]);
                Configuration::updateGlobalValue($key, $value);
            }
        }
        return true;
    }

    public function uninstall()
    {
        $this->_clearCache('*');

        return parent::uninstall();
    }

    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('configure') != $this->name) {
            return;
        }
        $this->context->controller->addCSS($this->_path.'views/css/admin.css');
    }

    public function hookActionAdminControllerSetMedia()
    {
        if (Tools::getValue('configure') != $this->name) {
            return;
        }
        $this->context->controller->addJquery();
        $this->context->controller->addJS($this->_path.'views/js/admin.js');
    }

    private function updateLanguageField($field_name)
    {
        $lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
        $field = array($lang_default => Tools::getValue('homenewtab_'.$field_name.'_'.$lang_default));
        $this->context->controller->getLanguages();
        foreach ($this->context->controller->_languages as $lang) {
            if ($lang['id_lang'] == $lang_default) {
                continue;
            }

            $field_value = Tools::getValue('homenewtab_'.$field_name.'_'.(int)$lang['id_lang']);
            if (!empty($field_value)) {
                $field[(int)$lang['id_lang']] = $field_value;
            } else {
                $field[(int)$lang['id_lang']] = $field[$lang_default];
            }
        }
        foreach ($this->context->controller->_languages as $lang) {
            Configuration::updateValue('HOMENEWTAB_'.Tools::strtoupper($field_name).'_'.(int)$lang['id_lang'], $field[(int)$lang['id_lang']]);
        }
    }

    public function getContent()
    {
        $output = '';
        $errors = array();
        if (Tools::isSubmit('submithomenewtab')) {
            $nbr = Tools::getValue('NEW_NBR');
            if (!Validate::isInt($nbr) || $nbr <= 0) {
                $errors[] = $this->l('The number of products is invalid. Please enter a positive number.');
            }
            $car = Tools::getValue('NEW_CAROUSEL');
            if (!Validate::isBool($car)) {
                $errors[] = $this->l('Invalid value for the "carousel" flag.');
            }
            $autoplay = Tools::getValue('NEW_AUTOPLAY_SLI');
            if (!Validate::isBool($autoplay)) {
                $errors[] = $this->l('Invalid value for the "autoplay" flag.');
            }
            $speed = Tools::getValue('NEW_SPEED_SLI');
            if (!Validate::isInt($speed) || $speed <= 0) {
                $errors[] = $this->l('The value of speed is invalid. Please enter a positive number.');
            }
            $pag = Tools::getValue('NEW_PAG_SLI');
            if (!Validate::isBool($pag)) {
                $errors[] = $this->l('Invalid value for the "pagination" flag.');
            }
            $arrows = Tools::getValue('NEW_ARROWS_SLI');
            if (!Validate::isBool($arrows)) {
                $errors[] = $this->l('Invalid value for the "arrows" flag.');
            }
            $loop = Tools::getValue('NEW_LOOP_SLI');
            if (!Validate::isBool($loop)) {
                $errors[] = $this->l('Invalid value for the "loop" flag.');
            }
            $col = Tools::getValue('NEW_COL');
            if (!Validate::isInt($col) || $col <= 0) {
                $errors[] = $this->l('The number of visible columns is invalid. Please enter a positive number.');
            }
            $col_1200 = Tools::getValue('NEW_COL_1200');
            if (!Validate::isInt($col_1200) || $col_1200 <= 0) {
                $errors[] = $this->l('The number of visible columns on screens < 1200px columns is invalid. Please enter a positive number.');
            }
            $col_992 = Tools::getValue('NEW_COL_992');
            if (!Validate::isInt($col_992) || $col_992 <= 0) {
                $errors[] = $this->l('The number of visible columns on screens < 992px columns is invalid. Please enter a positive number.');
            }
            $col_769 = Tools::getValue('NEW_COL_769');
            if (!Validate::isInt($col_769) || $col_769 <= 0) {
                $errors[] = $this->l('The number of visible columns on screens < 769px columns is invalid. Please enter a positive number.');
            }
            $col_576 = Tools::getValue('NEW_COL_576');
            if (!Validate::isInt($col_576) || $col_576 <= 0) {
                $errors[] = $this->l('The number of visible columns on screens < 576px columns is invalid. Please enter a positive number.');
            }
            $rows = Tools::getValue('NEW_ROWS_SLI');
            if (!Validate::isInt($rows) || $rows <= 0) {
                $errors[] = $this->l('The number of visible rows is invalid. Please enter a positive number.');
            }
            $tabs = Tools::getValue('NEW_TABS');
            if (!Validate::isBool($tabs)) {
                $errors[] = $this->l('Invalid value for the "tabs" flag.');
            }
            if (isset($errors) && count($errors)) {
                $output = $this->displayError(implode('<br />', $errors));
            } else {
                Configuration::updateValue('NEW_NBR', (int)$nbr);
                Configuration::updateValue('NEW_CAROUSEL', (bool)$car);
                Configuration::updateValue('NEW_AUTOPLAY_SLI', (bool)$autoplay);
                Configuration::updateValue('NEW_SPEED_SLI', (int)$speed);
                Configuration::updateValue('NEW_PAG_SLI', (bool)$pag);
                Configuration::updateValue('NEW_ARROWS_SLI', (bool)$arrows);
                Configuration::updateValue('NEW_LOOP_SLI', (bool)$loop);
                Configuration::updateValue('NEW_COL', (int)$col);
                Configuration::updateValue('NEW_COL_1200', (int)$col_1200);
                Configuration::updateValue('NEW_COL_992', (int)$col_992);
                Configuration::updateValue('NEW_COL_769', (int)$col_769);
                Configuration::updateValue('NEW_COL_576', (int)$col_576);
                Configuration::updateValue('NEW_ROWS_SLI', (int)$rows);
                Configuration::updateValue('NEW_TABS', (bool)$tabs);
                Tools::clearCache(Context::getContext()->smarty, $this->getTemplatePath('homenewtab.tpl'));
                $output = $this->displayConfirmation($this->l('Your settings have been updated.'));
            }
            foreach ($this->getMultilangFields() as $field_name) {
                $this->updateLanguageField($field_name);
            }
        }
        return $output . $this->renderForm();
    }

    public function getProducts()
    {
        $nProducts = Configuration::get('NEW_NBR');
        $products_for_template =  Product::getNewProducts((int)$this->context->language->id, 0, (int)$nProducts);
        return $products_for_template;
    }

    public function getMultilangFields($only_keys = true)
    {
        $fields = array(
            'category_name' => array(
                $this->l('Title of product block'),
                'New',
            ),
        );
        return $only_keys ? array_keys($fields) : $fields;
    }

    public function hookAddProduct($params)
    {
        $this->_clearCache('*');
        $params;
    }

    public function hookUpdateProduct($params)
    {
        $this->_clearCache('*');
        $params;
    }

    public function hookDeleteProduct($params)
    {
        $this->_clearCache('*');
        $params;
    }

    public function hookCategoryUpdate($params)
    {
        $this->_clearCache('*');
        $params;
    }

    public function _clearCache($template, $cache_id = null, $compile_id = null)
    {
        parent::_clearCache('homenewtab.tpl', 'homenewtab');
        $template;
        $cache_id;
        $compile_id;
    }

    public function hookdisplayHeader($params)
    {
        if ($this->context->controller instanceof IndexControllerCore && Configuration::get('NEW_CAROUSEL') == 1) {
            $this->context->controller->addJS($this->_path.'views/js/front.js');
        }
        $params;
    }

    public function hookdisplayHomeTab($params)
    {
        $this->smarty->assign($this->getAssignmentVariables());
        $multilang_array = array();
        foreach ($this->getMultilangFields() as $field_name) {
            $key = 'homenewtab_'.$field_name;
            $multilang_array[$key] = Configuration::get(Tools::strtoupper($key.'_'.$this->context->language->id));
        }
        $this->smarty->assign($multilang_array);
        return $this->display(__file__, 'tab.tpl');
    }

    public function prepareBlocksProducts($block)
    {
        $blocks_for_template = array();
        $products_for_template = array();

        $assembler = new ProductAssembler($this->context);
        $presenterFactory = new ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new ProductListingPresenter(new ImageRetriever($this->context->link), $this->context->link, new PriceFormatter(), new ProductColorsRetriever(), $this->context->getTranslator());
        $products_for_template = array();

        $blocks_for_template;
        if ($block) {
            foreach ($block as $rawProduct) {
                $products_for_template[] = $presenter->present($presentationSettings, $assembler->assembleProduct($rawProduct), $this->context->language);
            }
        }
        return $products_for_template;
    }


    public function hookdisplayHomeTabContent($params)
    {
        $this->smarty->assign($this->getAssignmentVariables());
        $multilang_array = array();
        foreach ($this->getMultilangFields() as $field_name) {
            $key = 'homenewtab_'.$field_name;
            $multilang_array[$key] = Configuration::get(Tools::strtoupper($key.'_'.$this->context->language->id));
        }
        $this->smarty->assign($multilang_array);
        return $this->display(__FILE__, 'homenewtab.tpl');
    }

    public function hookdisplayHome($params)
    {
        return $this->hookdisplayHomeTabContent($params);
    }

    public function hookdisplayTopColumn($params)
    {
        return $this->hookdisplayHomeTabContent($params);
    }

    public function getAssignmentVariables()
    {
        return array(
            'products' => $this->prepareBlocksProducts($this->getProducts()),
            'homeSize' => Image::getSize(ImageType::getFormattedName('home')),
            'allnewProductsLink' => Context::getContext()->link->getPageLink('new-products'),
            'carousel_active' => Configuration::get('NEW_CAROUSEL') ? 'true' : 'false',
            'carousel_autoplay' => Configuration::get('NEW_AUTOPLAY_SLI') ? 'true' : 'false',
            'carousel_speed' => Configuration::get('NEW_SPEED_SLI'),
            'carousel_pag' => Configuration::get('NEW_PAG_SLI') ? 'true' : 'false',
            'carousel_arrows' => Configuration::get('NEW_ARROWS_SLI') ? 'true' : 'false',
            'carousel_loop' => Configuration::get('NEW_LOOP_SLI') ? 'true' : 'false',
            'carousel_col' => Configuration::get('NEW_COL'),
            'carousel_col_1200' => Configuration::get('NEW_COL_1200'),
            'carousel_col_992' => Configuration::get('NEW_COL_992'),
            'carousel_col_769' => Configuration::get('NEW_COL_769'),
            'carousel_col_576' => Configuration::get('NEW_COL_576'),
            'carousel_rows' => Configuration::get('NEW_ROWS_SLI'),
            'carousel_tabs' => Configuration::get('NEW_TABS') ? 'true' : 'false'
        );
    }


    public function renderForm()
    {
        $multilang_fields = array();
        foreach ($this->getMultilangFields(false) as $name => $data) {
            $multilang_fields[$name] = array(
                'type' => 'text',
                'label' => $data[0],
                'name' => 'homenewtab_'.$name,
                'lang' => true,
            );
        }

        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs',
                ),
                'description' => $this->l('Module will display products only if you will have some recently added ones'),
                'input' => array(
                    $multilang_fields['category_name'],
                    array(
                        'type' => 'text',
                        'label' => $this->l('Number of products to be displayed'),
                        'name' => 'NEW_NBR',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of products that you would like to display on homepage (default: 8).'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Display in carousel'),
                        'name' => 'NEW_CAROUSEL',
                        'desc' => $this->l('Enable if you wish the products to be displayed in carousel'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes'),
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No'),
                            ),
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Autoplay'),
                        'name' => 'NEW_AUTOPLAY_SLI',
                        'desc' => $this->l('Enable if you wish to activate an autoplay'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes'),
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No'),
                            ),
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Autoplay Timeout'),
                        'name' => 'NEW_SPEED_SLI',
                        'suffix' => 'milliseconds',
                        'class' => 'fixed-width-sm',
                        'desc' => $this->l('Set the autoplay interval timeout.(default: 5000 milliseconds).'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Pagination'),
                        'name' => 'NEW_PAG_SLI',
                        'desc' => $this->l('Enable if you wish to activate a pagination'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes'),
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No'),
                            ),
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Navigation arrows'),
                        'name' => 'NEW_ARROWS_SLI',
                        'desc' => $this->l('Enable if you wish to activate a navigation arrows'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes'),
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No'),
                            ),
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Loop forever'),
                        'name' => 'NEW_LOOP_SLI',
                        'desc' => $this->l('Enable if you wish repeat loop after the last item.'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes'),
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No'),
                            ),
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible columns'),
                        'name' => 'NEW_COL',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of visible columns that you would like to display (default: 4, recommended from 3 to 6).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible columns on screens < 1200px'),
                        'name' => 'NEW_COL_1200',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of visible columns on screens < 1200px that you would like to display (default: 4, recommended from 3 to 5).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible columns on screens < 992px'),
                        'name' => 'NEW_COL_992',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of visible columns on screens < 992px that you would like to display (default: 3, recommended from 3 to 4).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible columns on screens < 769px'),
                        'name' => 'NEW_COL_769',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of visible columns on screens < 769px that you would like to display (default: 3, recommended from 2 to 3).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible columns on screens < 576px'),
                        'name' => 'NEW_COL_576',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of visible columns on screens < 576px that you would like to display (default: 2, recommended from 1 to 2).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible rows'),
                        'name' => 'NEW_ROWS_SLI',
                        'class' => 'fixed-width-xs carousels_options',
                        'desc' => $this->l('Set the number of visible row that you would like to display (default: 1).'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Grouped in tabs'),
                        'name' => 'NEW_TABS',
                        'desc' => $this->l('Enable if you wish to display the prodcuts in tabs (default: Yes)'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes'),
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No'),
                            ),
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();
        $helper->id = (int)Tools::getValue('id_carrier');
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submithomenewtab';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $language = $this->context->controller->getLanguages();
        $field_values = $this->getConfigFieldsValues();
        foreach ($this->context->controller->_languages as $lang) {
            foreach ($this->getMultilangFields() as $field_name) {
                $field_name = 'homenewtab_'.$field_name;
                $configuration_key = Tools::strtoupper($field_name.'_'.$lang['id_lang']);
                $field_values[$field_name][$lang['id_lang']] = Configuration::get($configuration_key);
            }
        }
        $helper->tpl_vars = array(
            'fields_value' => $field_values,
            'languages' => $language,
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($fields_form));
    }

    public function getConfigFieldsValues()
    {
        return array(
            'NEW_NBR' => Tools::getValue('NEW_NBR', (int)Configuration::get('NEW_NBR')),
            'NEW_CAROUSEL' => Tools::getValue('NEW_CAROUSEL', (bool)Configuration::get('NEW_CAROUSEL')),
            'NEW_AUTOPLAY_SLI' => Tools::getValue('NEW_AUTOPLAY_SLI', (bool)Configuration::get('NEW_AUTOPLAY_SLI')),
            'NEW_SPEED_SLI' => Tools::getValue('NEW_SPEED_SLI', (int)Configuration::get('NEW_SPEED_SLI')),
            'NEW_PAG_SLI' => Tools::getValue('NEW_PAG_SLI', (bool)Configuration::get('NEW_PAG_SLI')),
            'NEW_ARROWS_SLI' => Tools::getValue('NEW_ARROWS_SLI', (bool)Configuration::get('NEW_ARROWS_SLI')),
            'NEW_LOOP_SLI' => Tools::getValue('NEW_LOOP_SLI', (bool)Configuration::get('NEW_LOOP_SLI')),
            'NEW_COL' => Tools::getValue('NEW_COL', (int)Configuration::get('NEW_COL')),
            'NEW_COL_1200' => Tools::getValue('NEW_COL_1200', (int)Configuration::get('NEW_COL_1200')),
            'NEW_COL_992' => Tools::getValue('NEW_COL_992', (int)Configuration::get('NEW_COL_992')),
            'NEW_COL_769' => Tools::getValue('NEW_COL_769', (int)Configuration::get('NEW_COL_769')),
            'NEW_COL_576' => Tools::getValue('NEW_COL_576', (int)Configuration::get('NEW_COL_576')),
            'NEW_ROWS_SLI' => Tools::getValue('NEW_ROWS_SLI', (int)Configuration::get('NEW_ROWS_SLI')),
            'NEW_TABS' => Tools::getValue('NEW_TABS', (bool)Configuration::get('NEW_TABS')),
        );
    }
}
