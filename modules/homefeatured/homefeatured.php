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

class HomeFeatured extends Module
{
    public function __construct()
    {
        $this->name = 'homefeatured';
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

        $this->displayName = $this->l('Featured products tab');
        $this->description = $this->l('Displays featured products tab in the central column of your homepage.');

        if (@file_exists('../modules/' . $this->name . '/key.php')) {
            @require_once('../modules/' . $this->name . '/key.php');
        } else {
            if (@file_exists(dirname(__FILE__) . $this->name . '/key.php')) {
                @require_once(dirname(__FILE__) . $this->name . '/key.php');
            } else {
                if (@file_exists('modules/' . $this->name . '/key.php')) {
                    @require_once('modules/' . $this->name . '/key.php');
                }
            }
        }
    }

    public function inconsistency($return)
    {
        $return;
        return true;
    }

    public function install()
    {
        $this->_clearCache('*');
        Configuration::updateValue('FEATURED_NBR', 8);
        Configuration::updateValue('FEATURED_CAT', (int)Context::getContext()->shop->getCategory());
        Configuration::updateValue('FEATURED_RANDOMIZE', false);
        Configuration::updateValue('FEATURED_CAROUSEL', true);
        Configuration::updateValue('FEATURED_AUTOPLAY_SLI', true);
        Configuration::updateValue('FEATURED_SPEED_SLI', 5000);
        Configuration::updateValue('FEATURED_PAG_SLI', false);
        Configuration::updateValue('FEATURED_ARROWS_SLI', true);
        Configuration::updateValue('FEATURED_LOOP_SLI', true);
        Configuration::updateValue('FEATURED_COL', 4);
        Configuration::updateValue('FEATURED_COL_1200', 4);
        Configuration::updateValue('FEATURED_COL_992', 3);
        Configuration::updateValue('FEATURED_COL_769', 3);
        Configuration::updateValue('FEATURED_COL_576', 2);
        Configuration::updateValue('FEATURED_ROWS_SLI', 1);
        Configuration::updateValue('FEATURED_TABS', true);
        $this->fillMultilangValues();
        return parent::install() && $this->registerHook('displayBackofficeHeader') && $this->registerHook('actionAdminControllerSetMedia') && $this->registerHook('displayHeader') && $this->registerHook('addproduct') && $this->registerHook('updateproduct') && $this->registerHook('deleteproduct') && $this->registerHook('categoryUpdate') && $this->registerHook('displayHomeTab') && $this->registerHook('displayHomeTabContent');
    }

    public function fillMultilangValues()
    {
        $languages = Language::getLanguages(false);
        foreach ($this->getMultilangFields(false) as $name => $data) {
            foreach ($languages as $lang) {
                $key = Tools::strtoupper('HOMEFEATURED_'.$name).'_'.$lang['id_lang'];
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
        $field = array($lang_default => Tools::getValue('homefeatured_'.$field_name.'_'.$lang_default));
        $this->context->controller->getLanguages();
        foreach ($this->context->controller->_languages as $lang) {
            if ($lang['id_lang'] == $lang_default) {
                continue;
            }

            $field_value = Tools::getValue('homefeatured_'.$field_name.'_'.(int)$lang['id_lang']);
            if (!empty($field_value)) {
                $field[(int)$lang['id_lang']] = $field_value;
            } else {
                $field[(int)$lang['id_lang']] = $field[$lang_default];
            }
        }
        foreach ($this->context->controller->_languages as $lang) {
            Configuration::updateValue('HOMEFEATURED_'.Tools::strtoupper($field_name).'_'.(int)$lang['id_lang'], $field[(int)$lang['id_lang']]);
        }
    }

    public static function psversion()
    {
        $version = _PS_VERSION_;
        $exp = $explode = explode(".", $version);
        $explode;
        return $exp[1];
    }

    public function getContent()
    {
        $output = '';
        $errors = array();
        if (Tools::isSubmit('submitHomeFeatured')) {
            $nbr = Tools::getValue('FEATURED_NBR');
            if (!Validate::isInt($nbr) || $nbr <= 0) {
                $errors[] = $this->l('The number of products is invalid. Please enter a positive number.');
            }

            $cat = Tools::getValue('FEATURED_CAT');
            if (!Validate::isInt($cat) || $cat <= 0) {
                $errors[] = $this->l('The category ID is invalid. Please choose an existing category ID.');
            }

            $rand = Tools::getValue('FEATURED_RANDOMIZE');
            if (!Validate::isBool($rand)) {
                $errors[] = $this->l('Invalid value for the "randomize" flag.');
            }
            $car = Tools::getValue('FEATURED_CAROUSEL');
            if (!Validate::isBool($car)) {
                $errors[] = $this->l('Invalid value for the "carousel" flag.');
            }
            $autoplay = Tools::getValue('FEATURED_AUTOPLAY_SLI');
            if (!Validate::isBool($autoplay)) {
                $errors[] = $this->l('Invalid value for the "autoplay" flag.');
            }
            $speed = Tools::getValue('FEATURED_SPEED_SLI');
            if (!Validate::isInt($speed) || $speed <= 0) {
                $errors[] = $this->l('The value of speed is invalid. Please enter a positive number.');
            }
            $pag = Tools::getValue('FEATURED_PAG_SLI');
            if (!Validate::isBool($pag)) {
                $errors[] = $this->l('Invalid value for the "pagination" flag.');
            }
            $arrows = Tools::getValue('FEATURED_ARROWS_SLI');
            if (!Validate::isBool($arrows)) {
                $errors[] = $this->l('Invalid value for the "arrows" flag.');
            }
            $loop = Tools::getValue('FEATURED_LOOP_SLI');
            if (!Validate::isBool($loop)) {
                $errors[] = $this->l('Invalid value for the "loop" flag.');
            }
            $col = Tools::getValue('FEATURED_COL');
            if (!Validate::isInt($col) || $col <= 0) {
                $errors[] = $this->l('The number of visible columns is invalid. Please enter a positive number.');
            }
            $col_1200 = Tools::getValue('FEATURED_COL_1200');
            if (!Validate::isInt($col_1200) || $col_1200 <= 0) {
                $errors[] = $this->l('The number of visible columns on screens < 1200px columns is invalid. Please enter a positive number.');
            }
            $col_992 = Tools::getValue('FEATURED_COL_992');
            if (!Validate::isInt($col_992) || $col_992 <= 0) {
                $errors[] = $this->l('The number of visible columns on screens < 992px columns is invalid. Please enter a positive number.');
            }
            $col_769 = Tools::getValue('FEATURED_COL_769');
            if (!Validate::isInt($col_769) || $col_769 <= 0) {
                $errors[] = $this->l('The number of visible columns on screens < 769px columns is invalid. Please enter a positive number.');
            }
            $col_576 = Tools::getValue('FEATURED_COL_576');
            if (!Validate::isInt($col_576) || $col_576 <= 0) {
                $errors[] = $this->l('The number of visible columns on screens < 576px columns is invalid. Please enter a positive number.');
            }
            $rows = Tools::getValue('FEATURED_ROWS_SLI');
            if (!Validate::isInt($rows) || $rows <= 0) {
                $errors[] = $this->l('The number of visible rows is invalid. Please enter a positive number.');
            }
            $tabs = Tools::getValue('FEATURED_TABS');
            if (!Validate::isBool($tabs)) {
                $errors[] = $this->l('Invalid value for the "tabs" flag.');
            }
            if (isset($errors) && count($errors)) {
                $output = $this->displayError(implode('<br />', $errors));
            } else {
                Configuration::updateValue('FEATURED_NBR', (int)$nbr);
                Configuration::updateValue('FEATURED_CAT', (int)$cat);
                Configuration::updateValue('FEATURED_RANDOMIZE', (bool)$rand);
                Configuration::updateValue('FEATURED_CAROUSEL', (bool)$car);
                Configuration::updateValue('FEATURED_AUTOPLAY_SLI', (bool)$autoplay);
                Configuration::updateValue('FEATURED_SPEED_SLI', (int)$speed);
                Configuration::updateValue('FEATURED_PAG_SLI', (bool)$pag);
                Configuration::updateValue('FEATURED_ARROWS_SLI', (bool)$arrows);
                Configuration::updateValue('FEATURED_LOOP_SLI', (bool)$loop);
                Configuration::updateValue('FEATURED_COL', (int)$col);
                Configuration::updateValue('FEATURED_COL_1200', (int)$col_1200);
                Configuration::updateValue('FEATURED_COL_992', (int)$col_992);
                Configuration::updateValue('FEATURED_COL_769', (int)$col_769);
                Configuration::updateValue('FEATURED_COL_576', (int)$col_576);
                Configuration::updateValue('FEATURED_ROWS_SLI', (int)$rows);
                Configuration::updateValue('FEATURED_TABS', (bool)$tabs);
                Tools::clearCache(Context::getContext()->smarty, $this->getTemplatePath('homefeatured.tpl'));
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
        $category = new Category((int)Configuration::get('FEATURED_CAT'));
        $nProducts = Configuration::get('FEATURED_NBR');

        if (Configuration::get('FEATURED_RANDOMIZE') == 1) {
            $products_for_template = $category->getProducts($this->context->cookie->id_lang, 0, $nProducts, null, null, null, true, true, $nProducts);
        } else {
            $products_for_template = $category->getProducts($this->context->cookie->id_lang, 0, $nProducts);
        }

        return $products_for_template;
    }

    public function getMultilangFields($only_keys = true)
    {
        $fields = array(
            'category_name' => array(
                $this->l('Title of product block'),
                'Featured',
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
        $template;
        $cache_id;
        $compile_id;
        parent::_clearCache('homefeatured.tpl', 'homefeatured');
    }

    public function hookdisplayHeader($params)
    {
        if ($this->context->controller instanceof IndexControllerCore && Configuration::get('FEATURED_CAROUSEL') == 1) {
            $this->context->controller->addJS($this->_path.'views/js/front.js');
        }
        $params;
    }

    public function hookdisplayHomeTab($params)
    {
        $params;
        $this->smarty->assign($this->getAssignmentVariables());
        $multilang_array = array();
        foreach ($this->getMultilangFields() as $field_name) {
            $key = 'homefeatured_'.$field_name;
            $multilang_array[$key] = Configuration::get(Tools::strtoupper($key.'_'.$this->context->language->id));
        }
        $this->smarty->assign($multilang_array);
        return $this->display(__file__, 'tab.tpl');
    }

    public function prepareBlocksProducts($block)
    {
        $blocks_for_template =  array();
        $products_for_template =  array();

        $assembler = new ProductAssembler($this->context);
        $presenterFactory = new ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new ProductListingPresenter(new ImageRetriever($this->context->link), $this->context->link, new PriceFormatter(), new ProductColorsRetriever(), $this->context->getTranslator());
        $products_for_template =  array();
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
        $params;
        $this->smarty->assign($this->getAssignmentVariables());
        $multilang_array = array();
        foreach ($this->getMultilangFields() as $field_name) {
            $key = 'homefeatured_'.$field_name;
            $multilang_array[$key] = Configuration::get(Tools::strtoupper($key.'_'.$this->context->language->id));
        }
        $this->smarty->assign($multilang_array);
        return $this->display(__FILE__, 'homefeatured.tpl');
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
            'allProductsLink' => Context::getContext()->link->getCategoryLink($this->getConfigFieldsValues()['FEATURED_CAT']),
            'carousel_active' => Configuration::get('FEATURED_CAROUSEL') ? 'true' : 'false',
            'carousel_autoplay' => Configuration::get('FEATURED_AUTOPLAY_SLI') ? 'true' : 'false',
            'carousel_speed' => Configuration::get('FEATURED_SPEED_SLI'),
            'carousel_pag' => Configuration::get('FEATURED_PAG_SLI') ? 'true' : 'false',
            'carousel_arrows' => Configuration::get('FEATURED_ARROWS_SLI') ? 'true' : 'false',
            'carousel_loop' => Configuration::get('FEATURED_LOOP_SLI') ? 'true' : 'false',
            'carousel_col' => Configuration::get('FEATURED_COL'),
            'carousel_col_1200' => Configuration::get('FEATURED_COL_1200'),
            'carousel_col_992' => Configuration::get('FEATURED_COL_992'),
            'carousel_col_769' => Configuration::get('FEATURED_COL_769'),
            'carousel_col_576' => Configuration::get('FEATURED_COL_576'),
            'carousel_rows' => Configuration::get('FEATURED_ROWS_SLI'),
            'carousel_tabs' => Configuration::get('FEATURED_TABS') ? 'true' : 'false'
        );
    }


    public function renderForm()
    {
        $multilang_fields = array();
        foreach ($this->getMultilangFields(false) as $name => $data) {
            $multilang_fields[$name] = array(
                'type' => 'text',
                'label' => $data[0],
                'name' => 'homefeatured_'.$name,
                'lang' => true,
            );
        }

        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs',
                ),
                'description' => $this->l('To add products to your homepage, simply add them to the corresponding product category (default: "Home").'),
                'input' => array(
                    $multilang_fields['category_name'],
                    array(
                        'type' => 'text',
                        'label' => $this->l('Number of products to be displayed'),
                        'name' => 'FEATURED_NBR',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of products that you would like to display on homepage (default: 8).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Category from which to pick products to be displayed'),
                        'name' => 'FEATURED_CAT',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Choose the category ID of the products that you would like to display on homepage (default: 2 for "Home").'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Randomly display featured products'),
                        'name' => 'FEATURED_RANDOMIZE',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Enable if you wish the products to be displayed randomly (default: no).'),
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
                        'label' => $this->l('Display in carousel'),
                        'name' => 'FEATURED_CAROUSEL',
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
                        'name' => 'FEATURED_AUTOPLAY_SLI',
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
                        'name' => 'FEATURED_SPEED_SLI',
                        'suffix' => 'milliseconds',
                        'class' => 'fixed-width-sm',
                        'desc' => $this->l('Set the autoplay interval timeout.(default: 5000 milliseconds).'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Pagination'),
                        'name' => 'FEATURED_PAG_SLI',
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
                        'name' => 'FEATURED_ARROWS_SLI',
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
                        'name' => 'FEATURED_LOOP_SLI',
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
                        'name' => 'FEATURED_COL',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of visible columns that you would like to display (default: 4, recommended from 3 to 6).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible columns on screens < 1200px'),
                        'name' => 'FEATURED_COL_1200',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of visible columns on screens < 1200px that you would like to display (default: 4, recommended from 3 to 5).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible columns on screens < 992px'),
                        'name' => 'FEATURED_COL_992',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of visible columns on screens < 992px that you would like to display (default: 3, recommended from 3 to 4).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible columns on screens < 769px'),
                        'name' => 'FEATURED_COL_769',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of visible columns on screens < 769px that you would like to display (default: 3, recommended from 2 to 3).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible columns on screens < 576px'),
                        'name' => 'FEATURED_COL_576',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of visible columns on screens < 576px that you would like to display (default: 2, recommended from 1 to 2).'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Visible rows'),
                        'name' => 'FEATURED_ROWS_SLI',
                        'class' => 'fixed-width-xs carousels_options',
                        'desc' => $this->l('Set the number of visible row that you would like to display (default: 1).'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Grouped in tabs'),
                        'name' => 'FEATURED_TABS',
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
        $helper->submit_action = 'submitHomeFeatured';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $language = $this->context->controller->getLanguages();
        $field_values = $this->getConfigFieldsValues();
        foreach ($this->context->controller->_languages as $lang) {
            foreach ($this->getMultilangFields() as $field_name) {
                $field_name = 'homefeatured_'.$field_name;
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
            'FEATURED_NBR' => Tools::getValue('FEATURED_NBR', (int)Configuration::get('FEATURED_NBR')),
            'FEATURED_CAT' => Tools::getValue('FEATURED_CAT', (int)Configuration::get('FEATURED_CAT')),
            'FEATURED_RANDOMIZE' => Tools::getValue('FEATURED_RANDOMIZE', (bool)Configuration::get('FEATURED_RANDOMIZE')),
            'FEATURED_CAROUSEL' => Tools::getValue('FEATURED_CAROUSEL', (bool)Configuration::get('FEATURED_CAROUSEL')),
            'FEATURED_AUTOPLAY_SLI' => Tools::getValue('FEATURED_AUTOPLAY_SLI', (bool)Configuration::get('FEATURED_AUTOPLAY_SLI')),
            'FEATURED_SPEED_SLI' => Tools::getValue('FEATURED_SPEED_SLI', (int)Configuration::get('FEATURED_SPEED_SLI')),
            'FEATURED_PAG_SLI' => Tools::getValue('FEATURED_PAG_SLI', (bool)Configuration::get('FEATURED_PAG_SLI')),
            'FEATURED_ARROWS_SLI' => Tools::getValue('FEATURED_ARROWS_SLI', (bool)Configuration::get('FEATURED_ARROWS_SLI')),
            'FEATURED_LOOP_SLI' => Tools::getValue('FEATURED_LOOP_SLI', (bool)Configuration::get('FEATURED_LOOP_SLI')),
            'FEATURED_COL' => Tools::getValue('FEATURED_COL', (int)Configuration::get('FEATURED_COL')),
            'FEATURED_COL_1200' => Tools::getValue('FEATURED_COL_1200', (int)Configuration::get('FEATURED_COL_1200')),
            'FEATURED_COL_992' => Tools::getValue('FEATURED_COL_992', (int)Configuration::get('FEATURED_COL_992')),
            'FEATURED_COL_769' => Tools::getValue('FEATURED_COL_769', (int)Configuration::get('FEATURED_COL_769')),
            'FEATURED_COL_576' => Tools::getValue('FEATURED_COL_576', (int)Configuration::get('FEATURED_COL_576')),
            'FEATURED_ROWS_SLI' => Tools::getValue('FEATURED_ROWS_SLI', (int)Configuration::get('FEATURED_ROWS_SLI')),
            'FEATURED_TABS' => Tools::getValue('FEATURED_TABS', (bool)Configuration::get('FEATURED_TABS')),
        );
    }
}
