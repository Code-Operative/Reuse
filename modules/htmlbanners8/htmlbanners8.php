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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2020 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

include_once(_PS_MODULE_DIR_.'htmlbanners8/HtmlBanner8.php');

class HtmlBanners8 extends Module implements WidgetInterface
{
    protected $_html = '';
    protected $default_carousel_active = 0;
    protected $default_autoplay = 1;
    protected $default_speed = 5000;
    protected $default_pause_on_hover = 1;
    protected $default_pagination = 1;
    protected $default_navigation = 1;
    protected $default_wrap = 1;
    protected $default_items = 3;
    protected $default_items_1199 = 3;
    protected $default_items_991 = 2;
    protected $default_items_768 = 2;
    protected $default_items_480 = 1;
    protected $templateFile;

    public function __construct()
    {
        $this->name = 'htmlbanners8';
        $this->tab = 'front_office_features';
        $this->version = '1.0.1';
        $this->author = 'Prestahero';
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Banner on category page');
        $this->description = $this->l('Adds a banner on category page.');
        $this->ps_versions_compliancy = array('min' => '1.7.1.0', 'max' => _PS_VERSION_);

        $this->templateFile = 'module:htmlbanners8/views/templates/hook/hook.tpl';
    }

    /**
     * @see Module::install()
     */
    public function install()
    {
        /* Adds Module */
        if (parent::install() &&
            $this->registerHook('displayBackofficeHeader') &&
            $this->registerHook('actionAdminControllerSetMedia') &&
            $this->registerHook('displayHeader') &&
            $this->registerHook('displayHtmlContent4') &&
            $this->registerHook('actionShopDataDuplication')
        ) {
            $shops = Shop::getContextListShopID();
            $shop_groups_list = array();

            /* Setup each shop */
            foreach ($shops as $shop_id) {
                $shop_group_id = (int)Shop::getGroupFromShop($shop_id, true);

                if (!in_array($shop_group_id, $shop_groups_list)) {
                    $shop_groups_list[] = $shop_group_id;
                }

                /* Sets up configuration */
                $res = Configuration::updateValue('HTMLBANNERS8_CAROUSEL_ACTIVE', $this->default_carousel_active, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_AUTOPLAY', $this->default_autoplay, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_SPEED', $this->default_speed, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_PAUSE_ON_HOVER', $this->default_pause_on_hover, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_PAGINATION', $this->default_pagination, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_NAVIGATION', $this->default_navigation, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_WRAP', $this->default_wrap, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS', $this->default_items, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_1199', $this->default_items_1199, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_991', $this->default_items_991, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_768', $this->default_items_768, false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_480', $this->default_items_480, false, $shop_group_id, $shop_id);
            }

            /* Sets up Shop Group configuration */
            if (count($shop_groups_list)) {
                foreach ($shop_groups_list as $shop_group_id) {
                    $res &= Configuration::updateValue('HTMLBANNERS8_CAROUSEL_ACTIVE', $this->default_carousel_active, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_AUTOPLAY', $this->default_autoplay, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_SPEED', $this->default_speed, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_PAUSE_ON_HOVER', $this->default_pause_on_hover, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_PAGINATION', $this->default_pagination, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_NAVIGATION', $this->default_navigation, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_WRAP', $this->default_wrap, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS', $this->default_items, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_1199', $this->default_items_1199, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_991', $this->default_items_991, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_768', $this->default_items_768, false, $shop_group_id);
                    $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_480', $this->default_items_480, false, $shop_group_id);
                }
            }

            /* Sets up Global configuration */
            $res &= Configuration::updateValue('HTMLBANNERS8_CAROUSEL_ACTIVE', $this->default_carousel_active);
            $res &= Configuration::updateValue('HTMLBANNERS8_AUTOPLAY', $this->default_autoplay);
            $res &= Configuration::updateValue('HTMLBANNERS8_SPEED', $this->default_speed);
            $res &= Configuration::updateValue('HTMLBANNERS8_PAUSE_ON_HOVER', $this->default_pause_on_hover);
            $res &= Configuration::updateValue('HTMLBANNERS8_PAGINATION', $this->default_pagination);
            $res &= Configuration::updateValue('HTMLBANNERS8_NAVIGATION', $this->default_navigation);
            $res &= Configuration::updateValue('HTMLBANNERS8_WRAP', $this->default_wrap);
            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS', $this->default_items);
            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_1199', $this->default_items_1199);
            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_991', $this->default_items_991);
            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_768', $this->default_items_768);
            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_480', $this->default_items_480);

            /* Creates tables */
            $res &= $this->createTables();

            /* Adds samples */
            if ($res) {
                $this->installSamples();
            }

            // Disable on mobiles and tablets
            // $this->disableDevice(Context::DEVICE_MOBILE);

            return (bool)$res;
        }

        return false;
    }

    /**
     * Adds samples
     */
    protected function installSamples()
    {
        $languages = Language::getLanguages(false);

        $slide = new HtmlBanner8();
        $slide->position = 1;
        $slide->active = 1;
        foreach ($languages as $language) {
            $slide->title[$language['id_lang']] = 'Spring-Summer 2018';
            $slide->description[$language['id_lang']] = '<p class="htmlcontent__title-one">Spring-Summer 2018</p>
            <p class="htmlcontent__title-two">New collection</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel <br>ipsum vel enim viverra lobortis at sit amet massa.</p>';
            $slide->legend[$language['id_lang']] = 'Spring-Summer 2018';
            $slide->customclass[$language['id_lang']] = 'col-12 anim-second';
            $slide->category[$language['id_lang']] = '';
            $slide->url[$language['id_lang']] = 'https://www.prestashop.com?utm_source=back-office&utm_medium=v17_htmlbanners8'
                .'&utm_campaign=back-office-'.Tools::strtoupper($this->context->language->iso_code)
                .'&utm_content='.(defined('_PS_HOST_MODE_') ? 'ondemand' : 'download');
            $slide->image[$language['id_lang']] = 'sample-1.png';
        }
        $slide->add();
    }

    /**
     * @see Module::uninstall()
     */
    public function uninstall()
    {
        /* Deletes Module */
        if (parent::uninstall()) {
            /* Deletes tables */
            $res = $this->deleteTables();

            /* Unsets configuration */
            $res &= Configuration::deleteByName('HTMLBANNERS8_CAROUSEL_ACTIVE');
            $res &= Configuration::deleteByName('HTMLBANNERS8_AUTOPLAY');
            $res &= Configuration::deleteByName('HTMLBANNERS8_SPEED');
            $res &= Configuration::deleteByName('HTMLBANNERS8_PAUSE_ON_HOVER');
            $res &= Configuration::deleteByName('HTMLBANNERS8_PAGINATION');
            $res &= Configuration::deleteByName('HTMLBANNERS8_NAVIGATION');
            $res &= Configuration::deleteByName('HTMLBANNERS8_WRAP');
            $res &= Configuration::deleteByName('HTMLBANNERS8_ITEMS');
            $res &= Configuration::deleteByName('HTMLBANNERS8_ITEMS_1199');
            $res &= Configuration::deleteByName('HTMLBANNERS8_ITEMS_991');
            $res &= Configuration::deleteByName('HTMLBANNERS8_ITEMS_768');
            $res &= Configuration::deleteByName('HTMLBANNERS8_ITEMS_480');

            return (bool)$res;
        }

        return false;
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

    /**
     * Creates tables
     */
    protected function createTables()
    {
        /* Slides */
        $res = (bool)Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'htmlbanners8` (
                `id_htmlbanners8_slides` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `id_shop` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id_htmlbanners8_slides`, `id_shop`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;
        ');

        /* Slides configuration */
        $res &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'htmlbanners8_slides` (
              `id_htmlbanners8_slides` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `position` int(10) unsigned NOT NULL DEFAULT \'0\',
              `active` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
              PRIMARY KEY (`id_htmlbanners8_slides`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;
        ');

        /* Slides lang configuration */
        $res &= Db::getInstance()->execute('
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'htmlbanners8_slides_lang` (
              `id_htmlbanners8_slides` int(10) unsigned NOT NULL,
              `id_lang` int(10) unsigned NOT NULL,
              `title` varchar(255) NOT NULL,
              `description` text NOT NULL,
              `legend` varchar(255) NOT NULL,
              `customclass` varchar(255) NOT NULL,
              `category` varchar(255) NOT NULL,
              `url` varchar(255) NOT NULL,
              `image` varchar(255) NOT NULL,
              PRIMARY KEY (`id_htmlbanners8_slides`,`id_lang`)
            ) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;
        ');

        return $res;
    }

    /**
     * deletes tables
     */
    protected function deleteTables()
    {
        $slides = $this->getSlides();
        foreach ($slides as $slide) {
            $to_del = new HtmlBanner8($slide['id_slide']);
            $to_del->delete();
        }

        return Db::getInstance()->execute('
            DROP TABLE IF EXISTS `'._DB_PREFIX_.'htmlbanners8`, `'._DB_PREFIX_.'htmlbanners8_slides`, `'._DB_PREFIX_.'htmlbanners8_slides_lang`;
        ');
    }

    public function getContent()
    {
        $this->_html .= $this->headerHTML();

        /* Validate & process */
        if (Tools::isSubmit('submitSlide') || Tools::isSubmit('delete_id_slide') ||
            Tools::isSubmit('submitSlider') ||
            Tools::isSubmit('changeStatus')
        ) {
            if ($this->_postValidation()) {
                $this->_postProcess();
                $this->_html .= $this->renderForm();
                $this->_html .= $this->renderList();
            } else {
                $this->_html .= $this->renderAddForm();
            }

            $this->clearCache();
        } elseif (Tools::isSubmit('addSlide') || (Tools::isSubmit('id_slide') && $this->slideExists((int)Tools::getValue('id_slide')))) {
            if (Tools::isSubmit('addSlide')) {
                $mode = 'add';
            } else {
                $mode = 'edit';
            }

            if ($mode == 'add') {
                if (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL) {
                    $this->_html .= $this->renderAddForm();
                } else {
                    $this->_html .= $this->getShopContextError(null, $mode);
                }
            } else {
                $associated_shop_ids = HtmlBanner8::getAssociatedIdsShop((int)Tools::getValue('id_slide'));
                $context_shop_id = (int)Shop::getContextShopID();

                if ($associated_shop_ids === false) {
                    $this->_html .= $this->getShopAssociationError((int)Tools::getValue('id_slide'));
                } elseif (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL && in_array($context_shop_id, $associated_shop_ids)) {
                    if (count($associated_shop_ids) > 1) {
                        $this->_html = $this->getSharedSlideWarning();
                    }
                    $this->_html .= $this->renderAddForm();
                } else {
                    $shops_name_list = array();
                    foreach ($associated_shop_ids as $shop_id) {
                        $associated_shop = new Shop((int)$shop_id);
                        $shops_name_list[] = $associated_shop->name;
                    }
                    $this->_html .= $this->getShopContextError($shops_name_list, $mode);
                }
            }
        } else {
            $this->_html .= $this->getWarningMultishopHtml().$this->getCurrentShopInfoMsg().$this->renderForm();

            if (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL) {
                $this->_html .= $this->renderList();
            }
        }

        return $this->_html;
    }

    protected function _postValidation()
    {
        $errors = array();

        /* Validation for Slider configuration */
        if (Tools::isSubmit('submitSlider')) {
            if (!Validate::isInt(Tools::getValue('HTMLBANNERS8_SPEED'))) {
                $errors[] = $this->l('Invalid values');
            }
        } elseif (Tools::isSubmit('changeStatus')) {
            if (!Validate::isInt(Tools::getValue('id_slide'))) {
                $errors[] = $this->l('Invalid slide');
            }
        } elseif (Tools::isSubmit('submitSlide')) {
            /* Checks state (active) */
            if (!Validate::isInt(Tools::getValue('active_slide')) || (Tools::getValue('active_slide') != 0 && Tools::getValue('active_slide') != 1)) {
                $errors[] = $this->l('Invalid slide state');
            }
            /* Checks position */
            if (!Validate::isInt(Tools::getValue('position')) || (Tools::getValue('position') < 0)) {
                $errors[] = $this->l('Invalid slide position.');
            }
            /* If edit : checks id_slide */
            if (Tools::isSubmit('id_slide')) {
                if (!Validate::isInt(Tools::getValue('id_slide')) && !$this->slideExists(Tools::getValue('id_slide'))) {
                    $errors[] = $this->l('Invalid slide ID');
                }
            }
            /* Checks title/url/legend/description/image */
            $languages = Language::getLanguages(false);
            $id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
            foreach ($languages as $language) {
                if (Tools::strlen(Tools::getValue('title_' . $language['id_lang'])) > 255) {
                    $errors[] = $this->l('The title is too long.');
                }
                if (Tools::strlen(Tools::getValue('legend_' . $language['id_lang'])) > 255) {
                    $errors[] = $this->l('The caption is too long.');
                }
                if (Tools::strlen(Tools::getValue('customclass_' . $id_lang_default)) > 255) {
                    $errors[] = $this->l('The class is too long.');
                }
                if (Tools::strlen(Tools::getValue('category_' . $id_lang_default)) > 255) {
                    $errors[] = $this->l('The category is too long.');
                }
                if (Tools::strlen(Tools::getValue('url_' . $language['id_lang'])) > 255) {
                    $errors[] = $this->l('The URL is too long.');
                }
                if (Tools::strlen(Tools::getValue('description_' . $language['id_lang'])) > 12000) {
                    $errors[] = $this->l('The description is too long.');
                }
                if (Tools::strlen(Tools::getValue('url_' . $language['id_lang'])) > 0 && !Validate::isUrl(Tools::getValue('url_' . $language['id_lang']))) {
                    $errors[] = $this->l('The URL format is not correct.');
                }
                if (Tools::getValue('image_' . $language['id_lang']) != null && !Validate::isFileName(Tools::getValue('image_' . $language['id_lang']))) {
                    $errors[] = $this->l('Invalid filename.');
                }
                if (Tools::getValue('image_old_' . $language['id_lang']) != null && !Validate::isFileName(Tools::getValue('image_old_' . $language['id_lang']))) {
                    $errors[] = $this->l('Invalid filename.');
                }
            }

            /* Checks title/url/legend/description for default lang */
            $id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
            /*if (Tools::strlen(Tools::getValue('url_' . $id_lang_default)) == 0) {
                $errors[] = $this->l('The URL is not set.');
            }*/
            /*if (!Tools::isSubmit('has_picture') && (!isset($_FILES['image_' . $id_lang_default]) || empty($_FILES['image_' . $id_lang_default]['tmp_name']))) {
                $errors[] = $this->l('The image is not set.');
            }*/
            if (Tools::getValue('image_old_'.$id_lang_default) && !Validate::isFileName(Tools::getValue('image_old_'.$id_lang_default))) {
                $errors[] = $this->l('The image is not set.');
            }
        } elseif (Tools::isSubmit('delete_id_slide') && (!Validate::isInt(Tools::getValue('delete_id_slide')) || !$this->slideExists((int)Tools::getValue('delete_id_slide')))) {
            $errors[] = $this->l('Invalid slide ID');
        }

        /* Display errors if needed */
        if (count($errors)) {
            $this->_html .= $this->displayError(implode('<br />', $errors));

            return false;
        }

        /* Returns if validation is ok */

        return true;
    }

    protected function _postProcess()
    {
        $errors = array();
        $shop_context = Shop::getContext();

        /* Processes Slider */
        if (Tools::isSubmit('submitSlider')) {
            $shop_groups_list = array();
            $shops = Shop::getContextListShopID();

            foreach ($shops as $shop_id) {
                $shop_group_id = (int)Shop::getGroupFromShop($shop_id, true);

                if (!in_array($shop_group_id, $shop_groups_list)) {
                    $shop_groups_list[] = $shop_group_id;
                }

                $res = Configuration::updateValue('HTMLBANNERS8_SPEED', (int)Tools::getValue('HTMLBANNERS8_SPEED'), false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_CAROUSEL_ACTIVE', (int)Tools::getValue('HTMLBANNERS8_CAROUSEL_ACTIVE'), false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_AUTOPLAY', (int)Tools::getValue('HTMLBANNERS8_AUTOPLAY'), false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_PAUSE_ON_HOVER', (int)Tools::getValue('HTMLBANNERS8_PAUSE_ON_HOVER'), false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_PAGINATION', (int)Tools::getValue('HTMLBANNERS8_PAGINATION'), false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_NAVIGATION', (int)Tools::getValue('HTMLBANNERS8_NAVIGATION'), false, $shop_group_id, $shop_id);
                $res &= Configuration::updateValue('HTMLBANNERS8_WRAP', (int)Tools::getValue('HTMLBANNERS8_WRAP'), false, $shop_group_id, $shop_id);
                $res = Configuration::updateValue('HTMLBANNERS8_ITEMS', (int)Tools::getValue('HTMLBANNERS8_ITEMS'), false, $shop_group_id, $shop_id);
                $res = Configuration::updateValue('HTMLBANNERS8_ITEMS_1199', (int)Tools::getValue('HTMLBANNERS8_ITEMS_1199'), false, $shop_group_id, $shop_id);
                $res = Configuration::updateValue('HTMLBANNERS8_ITEMS_991', (int)Tools::getValue('HTMLBANNERS8_ITEMS_991'), false, $shop_group_id, $shop_id);
                $res = Configuration::updateValue('HTMLBANNERS8_ITEMS_768', (int)Tools::getValue('HTMLBANNERS8_ITEMS_768'), false, $shop_group_id, $shop_id);
                $res = Configuration::updateValue('HTMLBANNERS8_ITEMS_480', (int)Tools::getValue('HTMLBANNERS8_ITEMS_480'), false, $shop_group_id, $shop_id);
            }

            /* Update global shop context if needed*/
            switch ($shop_context) {
                case Shop::CONTEXT_ALL:
                    $res &= Configuration::updateValue('HTMLBANNERS8_CAROUSEL_ACTIVE', (int)Tools::getValue('HTMLBANNERS8_CAROUSEL_ACTIVE'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_AUTOPLAY', (int)Tools::getValue('HTMLBANNERS8_AUTOPLAY'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_SPEED', (int)Tools::getValue('HTMLBANNERS8_SPEED'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_PAUSE_ON_HOVER', (int)Tools::getValue('HTMLBANNERS8_PAUSE_ON_HOVER'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_PAGINATION', (int)Tools::getValue('HTMLBANNERS8_PAGINATION'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_NAVIGATION', (int)Tools::getValue('HTMLBANNERS8_NAVIGATION'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_WRAP', (int)Tools::getValue('HTMLBANNERS8_WRAP'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS', (int)Tools::getValue('HTMLBANNERS8_ITEMS'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_1199', (int)Tools::getValue('HTMLBANNERS8_ITEMS_1199'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_991', (int)Tools::getValue('HTMLBANNERS8_ITEMS_991'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_768', (int)Tools::getValue('HTMLBANNERS8_ITEMS_768'));
                    $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_480', (int)Tools::getValue('HTMLBANNERS8_ITEMS_480'));
                    if (count($shop_groups_list)) {
                        foreach ($shop_groups_list as $shop_group_id) {
                            $res &= Configuration::updateValue('HTMLBANNERS8_CAROUSEL_ACTIVE', (int)Tools::getValue('HTMLBANNERS8_CAROUSEL_ACTIVE'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_AUTOPLAY', (int)Tools::getValue('HTMLBANNERS8_AUTOPLAY'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_SPEED', (int)Tools::getValue('HTMLBANNERS8_SPEED'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_PAUSE_ON_HOVER', (int)Tools::getValue('HTMLBANNERS8_PAUSE_ON_HOVER'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_PAGINATION', (int)Tools::getValue('HTMLBANNERS8_PAGINATION'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_NAVIGATION', (int)Tools::getValue('HTMLBANNERS8_NAVIGATION'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_WRAP', (int)Tools::getValue('HTMLBANNERS8_WRAP'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS', (int)Tools::getValue('HTMLBANNERS8_ITEMS'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_1199', (int)Tools::getValue('HTMLBANNERS8_ITEMS_1199'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_991', (int)Tools::getValue('HTMLBANNERS8_ITEMS_991'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_768', (int)Tools::getValue('HTMLBANNERS8_ITEMS_768'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_480', (int)Tools::getValue('HTMLBANNERS8_ITEMS_480'), false, $shop_group_id);
                        }
                    }
                    break;
                case Shop::CONTEXT_GROUP:
                    if (count($shop_groups_list)) {
                        foreach ($shop_groups_list as $shop_group_id) {
                            $res &= Configuration::updateValue('HTMLBANNERS8_CAROUSEL_ACTIVE', (int)Tools::getValue('HTMLBANNERS8_CAROUSEL_ACTIVE'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_AUTOPLAY', (int)Tools::getValue('HTMLBANNERS8_AUTOPLAY'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_SPEED', (int)Tools::getValue('HTMLBANNERS8_SPEED'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_PAUSE_ON_HOVER', (int)Tools::getValue('HTMLBANNERS8_PAUSE_ON_HOVER'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_PAGINATION', (int)Tools::getValue('HTMLBANNERS8_PAGINATION'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_NAVIGATION', (int)Tools::getValue('HTMLBANNERS8_NAVIGATION'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_WRAP', (int)Tools::getValue('HTMLBANNERS8_WRAP'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS', (int)Tools::getValue('HTMLBANNERS8_ITEMS'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_1199', (int)Tools::getValue('HTMLBANNERS8_ITEMS_1199'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_991', (int)Tools::getValue('HTMLBANNERS8_ITEMS_991'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_768', (int)Tools::getValue('HTMLBANNERS8_ITEMS_768'), false, $shop_group_id);
                            $res &= Configuration::updateValue('HTMLBANNERS8_ITEMS_480', (int)Tools::getValue('HTMLBANNERS8_ITEMS_480'), false, $shop_group_id);
                        }
                    }
                    break;
            }

            $this->clearCache();

            if (!$res) {
                $errors[] = $this->displayError($this->l('The configuration could not be updated.'));
            } else {
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true) . '&conf=6&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name);
            }
        } elseif (Tools::isSubmit('changeStatus') && Tools::isSubmit('id_slide')) {
            $slide = new HtmlBanner8((int)Tools::getValue('id_slide'));
            if ($slide->active == 0) {
                $slide->active = 1;
            } else {
                $slide->active = 0;
            }
            $res = $slide->update();
            $this->clearCache();
            $this->_html .= ($res ? $this->displayConfirmation($this->l('Configuration updated')) : $this->displayError($this->l('The configuration could not be updated.')));
        } elseif (Tools::isSubmit('submitSlide')) {
            /* Sets ID if needed */
            if (Tools::getValue('id_slide')) {
                $slide = new HtmlBanner8((int)Tools::getValue('id_slide'));
                if (!Validate::isLoadedObject($slide)) {
                    $this->_html .= $this->displayError($this->l('Invalid slide ID'));
                    return false;
                }
            } else {
                $slide = new HtmlBanner8();
            }
            /* Sets position */
            $slide->position = (int)Tools::getValue('position');
            /* Sets active */
            $slide->active = (int)Tools::getValue('active_slide');

            /* Sets each langue fields */
            $languages = Language::getLanguages(false);
            $id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
            foreach ($languages as $language) {
                $slide->title[$language['id_lang']] = Tools::getValue('title_'.$language['id_lang']);
                $slide->url[$language['id_lang']] = Tools::getValue('url_'.$language['id_lang']);
                $slide->legend[$language['id_lang']] = Tools::getValue('legend_'.$language['id_lang']);
                $slide->customclass[$language['id_lang']] = Tools::getValue('customclass_'.$id_lang_default);
                $slide->category[$language['id_lang']] = Tools::getValue('category_'.$id_lang_default);
                $slide->description[$language['id_lang']] = Tools::getValue('description_'.$language['id_lang']);

                /* Uploads image and sets slide */
                $type = Tools::strtolower(Tools::substr(strrchr($_FILES['image_'.$language['id_lang']]['name'], '.'), 1));
                $imagesize = @getimagesize($_FILES['image_'.$language['id_lang']]['tmp_name']);
                if (isset($_FILES['image_'.$language['id_lang']]) &&
                    isset($_FILES['image_'.$language['id_lang']]['tmp_name']) &&
                    !empty($_FILES['image_'.$language['id_lang']]['tmp_name']) &&
                    !empty($imagesize) &&
                    in_array(
                        Tools::strtolower(Tools::substr(strrchr($imagesize['mime'], '/'), 1)),
                        array(
                            'jpg',
                            'gif',
                            'jpeg',
                            'png'
                        )
                    ) &&
                    in_array($type, array('jpg', 'gif', 'jpeg', 'png'))
                ) {
                    $temp_name = tempnam(_PS_TMP_IMG_DIR_, 'PS');
                    $salt = sha1(microtime());
                    if ($error = ImageManager::validateUpload($_FILES['image_'.$language['id_lang']])) {
                        $errors[] = $error;
                    } elseif (!$temp_name || !move_uploaded_file($_FILES['image_'.$language['id_lang']]['tmp_name'], $temp_name)) {
                        return false;
                    } elseif (!ImageManager::resize($temp_name, dirname(__FILE__).'/views/img/upload/'.$salt.'_'.$_FILES['image_'.$language['id_lang']]['name'], null, null, $type)) {
                        $errors[] = $this->displayError($this->l('An error occurred during the image upload process.'));
                    }
                    if (isset($temp_name)) {
                        @unlink($temp_name);
                    }
                    $slide->image[$language['id_lang']] = $salt.'_'.$_FILES['image_'.$language['id_lang']]['name'];
                } elseif (Tools::getValue('image_old_'.$language['id_lang']) != '') {
                    $slide->image[$language['id_lang']] = Tools::getValue('image_old_' . $language['id_lang']);
                }
            }

            /* Processes if no errors  */
            if (!$errors) {
                /* Adds */
                if (!Tools::getValue('id_slide')) {
                    if (!$slide->add()) {
                        $errors[] = $this->displayError($this->l('The slide could not be added.'));
                    }
                } elseif (!$slide->update()) {
                    $errors[] = $this->displayError($this->l('The slide could not be updated.'));
                }
                $this->clearCache();
            }
        } elseif (Tools::isSubmit('delete_id_slide')) {
            $slide = new HtmlBanner8((int)Tools::getValue('delete_id_slide'));
            $res = $slide->delete();
            $this->clearCache();
            if (!$res) {
                $this->_html .= $this->displayError('Could not delete.');
            } else {
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true) . '&conf=1&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name);
            }
        }

        /* Display errors if needed */
        if (count($errors)) {
            $this->_html .= $this->displayError(implode('<br />', $errors));
        } elseif (Tools::isSubmit('submitSlide') && Tools::getValue('id_slide')) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true) . '&conf=4&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name);
        } elseif (Tools::isSubmit('submitSlide')) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true) . '&conf=3&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name);
        }
    }

    public function hookdisplayHeader($params)
    {
        if ($this->context->controller instanceof CategoryControllerCore && Configuration::get('HTMLBANNERS8_CAROUSEL_ACTIVE') == 1) {
            $this->context->controller->addJS($this->_path.'views/js/front.js');
        }
    }

    public function hookdisplayHtmlContent4($params)
    {
        $params;
        $this->smarty->assign($this->getWidgetVariables('displayHtmlContent4', $this->getConfigFieldsValues()));
        return $this->display(__FILE__, 'hook.tpl');
    }

    public function renderWidget($hookName = null, array $configuration = array())
    {
        if (!$this->isCached($this->templateFile, $this->getCacheId())) {
            $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));
        }

        return $this->fetch($this->templateFile, $this->getCacheId());
    }

    public function getWidgetVariables($hookName = null, array $configuration = array())
    {
        $hookName;
        $configuration;
        $slides = $this->getSlides(true);
        if (is_array($slides)) {
            foreach ($slides as &$slide) {
                $slide['sizes'] = @getimagesize((dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/img/upload' . DIRECTORY_SEPARATOR . $slide['image']));
                if (isset($slide['sizes'][3]) && $slide['sizes'][3]) {
                    $slide['size'] = $slide['sizes'][3];
                }
            }
        }

        $config = $this->getConfigFieldsValues();

        return array(
            'htmlbanners8' => array(
                'carousel_active' => $config['HTMLBANNERS8_CAROUSEL_ACTIVE'] ? 'true' : 'false',
                'autoplay' => $config['HTMLBANNERS8_AUTOPLAY'] ? 'true' : 'false',
                'speed' => $config['HTMLBANNERS8_SPEED'],
                'pause' => $config['HTMLBANNERS8_PAUSE_ON_HOVER'] ? 'true' : 'false',
                'pagination' => $config['HTMLBANNERS8_PAGINATION'] ? 'true' : 'false',
                'navigation' => $config['HTMLBANNERS8_NAVIGATION'] ? 'true' : 'false',
                'wrap' => $config['HTMLBANNERS8_WRAP'] ? 'true' : 'false',
                'items' => $config['HTMLBANNERS8_ITEMS'],
                'items_1199' => $config['HTMLBANNERS8_ITEMS_1199'],
                'items_991' => $config['HTMLBANNERS8_ITEMS_991'],
                'items_768' => $config['HTMLBANNERS8_ITEMS_768'],
                'items_480' => $config['HTMLBANNERS8_ITEMS_480'],
                'slides' => $slides,
                'category_id' => Tools::getValue('id_category'),
            ),
        );
    }

    private function updateUrl($link)
    {
        if (Tools::substr($link, 0, 7) !== "http://" && Tools::substr($link, 0, 8) !== "https://") {
            $link = Context::getContext()->shop->getBaseURL(true). trim($link, '/');
        }

        return $link;
    }

    private function updateBaseUrl($link)
    {
        if (Tools::substr($link, 0, 7) !== "http://" && Tools::substr($link, 0, 8) !== "https://") {
            $link = Context::getContext()->shop->getBaseURL(true);
        }

        return $link;
    }

    public function clearCache()
    {
        $this->_clearCache($this->templateFile);
    }

    public function hookActionShopDataDuplication($params)
    {
        Db::getInstance()->execute(
            '
            INSERT IGNORE INTO '._DB_PREFIX_.'htmlbanners8 (id_htmlbanners8_slides, id_shop)
            SELECT id_htmlbanners8_slides, '.(int)$params['new_id_shop'].'
            FROM '._DB_PREFIX_.'htmlbanners8
            WHERE id_shop = '.(int)$params['old_id_shop']
        );
        $this->clearCache();
    }

    public function headerHTML()
    {
        if (Tools::getValue('controller') != 'AdminModules' && Tools::getValue('configure') != $this->name) {
            return;
        }

        $this->context->controller->addJqueryUI('ui.sortable');
        /* Style & js for fieldset 'slides configuration' */
        $html = '<script type="text/javascript">
            $(function() {
                var $mySlides = $("#slides");
                $mySlides.sortable({
                    opacity: 0.6,
                    cursor: "move",
                    update: function() {
                        var order = $(this).sortable("serialize") + "&action=updateSlidesPosition";
                        $.post("'.$this->context->shop->physical_uri.$this->context->shop->virtual_uri.'modules/'.$this->name.'/ajax_'.$this->name.'.php?secure_key='.$this->secure_key.'", order);
                        }
                    });
                $mySlides.hover(function() {
                    $(this).css("cursor","move");
                    },
                    function() {
                    $(this).css("cursor","auto");
                });
            });
        </script>';

        return $html;
    }

    public function getNextPosition()
    {
        $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            '
            SELECT MAX(hss.`position`) AS `next_position`
            FROM `'._DB_PREFIX_.'htmlbanners8_slides` hss, `'._DB_PREFIX_.'htmlbanners8` hs
            WHERE hss.`id_htmlbanners8_slides` = hs.`id_htmlbanners8_slides` AND hs.`id_shop` = '.(int)$this->context->shop->id
        );

        return (++$row['next_position']);
    }

    public function getSlides($active = null)
    {
        $this->context = Context::getContext();
        $id_shop = $this->context->shop->id;
        $id_lang = $this->context->language->id;

        $slides = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            '
            SELECT hs.`id_htmlbanners8_slides` as id_slide, hss.`position`, hss.`active`, hssl.`title`,
            hssl.`url`, hssl.`legend`, hssl.`customclass`, hssl.`category`, hssl.`description`, hssl.`image`
            FROM '._DB_PREFIX_.'htmlbanners8 hs
            LEFT JOIN '._DB_PREFIX_.'htmlbanners8_slides hss ON (hs.id_htmlbanners8_slides = hss.id_htmlbanners8_slides)
            LEFT JOIN '._DB_PREFIX_.'htmlbanners8_slides_lang hssl ON (hss.id_htmlbanners8_slides = hssl.id_htmlbanners8_slides)
            WHERE id_shop = '.(int)$id_shop.'
            AND hssl.id_lang = '.(int)$id_lang.
            ($active ? ' AND hss.`active` = 1' : ' ').'
            ORDER BY hss.position'
        );

        foreach ($slides as &$slide) {
            $slide['image_url'] = $this->context->link->getMediaLink(_MODULE_DIR_.'htmlbanners8/views/img/upload/'.$slide['image']);
            $slide['image_base_url'] = $this->context->link->getMediaLink(_MODULE_DIR_.'htmlbanners8/views/img/upload/');
            $slide['url'] = $this->updateUrl($slide['url']);
            $slide['url_base'] = Context::getContext()->shop->getBaseURL(true);
        }

        return $slides;
    }

    public function getAllImagesBySlidesId($id_slides, $active = null, $id_shop = null)
    {
        $this->context = Context::getContext();
        $images = array();

        if (!isset($id_shop)) {
            $id_shop = $this->context->shop->id;
        }

        $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            '
            SELECT hssl.`image`, hssl.`id_lang`
            FROM '._DB_PREFIX_.'htmlbanners8 hs
            LEFT JOIN '._DB_PREFIX_.'htmlbanners8_slides hss ON (hs.id_htmlbanners8_slides = hss.id_htmlbanners8_slides)
            LEFT JOIN '._DB_PREFIX_.'htmlbanners8_slides_lang hssl ON (hss.id_htmlbanners8_slides = hssl.id_htmlbanners8_slides)
            WHERE hs.`id_htmlbanners8_slides` = '.(int)$id_slides.' AND hs.`id_shop` = '.(int)$id_shop.
            ($active ? ' AND hss.`active` = 1' : ' ')
        );

        foreach ($results as $result) {
            $images[$result['id_lang']] = $result['image'];
        }

        return $images;
    }

    public function displayStatus($id_slide, $active)
    {
        $title = ((int)$active == 0 ? $this->getTranslator()->trans('Disabled', array(), 'Admin.Global') : $this->getTranslator()->trans('Enabled', array(), 'Admin.Global'));
        $icon = ((int)$active == 0 ? 'icon-remove' : 'icon-check');
        $class = ((int)$active == 0 ? 'btn-danger' : 'btn-success');
        $html = '<a class="btn '.$class.'" href="'.AdminController::$currentIndex.
            '&configure='.$this->name.
                '&token='.Tools::getAdminTokenLite('AdminModules').
                '&changeStatus&id_slide='.(int)$id_slide.'" title="'.$title.'"><i class="'.$icon.'"></i> '.$title.'</a>';

        return $html;
    }

    public function slideExists($id_slide)
    {
        $req = 'SELECT hs.`id_htmlbanners8_slides` as id_slide
                FROM `'._DB_PREFIX_.'htmlbanners8` hs
                WHERE hs.`id_htmlbanners8_slides` = '.(int)$id_slide;
        $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);

        return ($row);
    }

    public function renderList()
    {
        $slides = $this->getSlides();
        foreach ($slides as $key => $slide) {
            $slides[$key]['status'] = $this->displayStatus($slide['id_slide'], $slide['active']);
            $associated_shop_ids = HtmlBanner8::getAssociatedIdsShop((int)$slide['id_slide']);
            if ($associated_shop_ids && count($associated_shop_ids) > 1) {
                $slides[$key]['is_shared'] = true;
            } else {
                $slides[$key]['is_shared'] = false;
            }
        }

        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'slides' => $slides,
                'image_baseurl' => $this->_path.'views/img/upload/'
            )
        );

        return $this->display(__FILE__, 'list.tpl');
    }

    public function renderAddForm()
    {
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Banner details'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => 'file_lang',
                        'label' => $this->getTranslator()->trans('Image', array(), 'Admin.Global'),
                        'name' => 'image',
                        'required' => false,
                        'lang' => true,
                        'desc' => $this->getTranslator()->trans('Maximum image size: %s.', array(ini_get('upload_max_filesize')), 'Admin.Global')
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->getTranslator()->trans('Title', array(), 'Admin.Global'),
                        'name' => 'title',
                        'lang' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Target URL'),
                        'name' => 'url',
                        'required' => false,
                        'lang' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Image Caption'),
                        'name' => 'legend',
                        'lang' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Custom class'),
                        'name' => 'customclass',
                        'lang' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Display on selected category pages'),
                        'name' => 'category',
                        'desc' => $this->l('Specify ID\'s of categories, where you want to display this banner. For example: "3,7,9,12". If you want to display this tab on all category\'s pages, leave this field blank.'),
                        'lang' => true,
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => $this->getTranslator()->trans('Description', array(), 'Admin.Global'),
                        'name' => 'description',
                        'autoload_rte' => true,
                        'lang' => true,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->getTranslator()->trans('Enabled', array(), 'Admin.Global'),
                        'name' => 'active_slide',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->getTranslator()->trans('Yes', array(), 'Admin.Global')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->getTranslator()->trans('No', array(), 'Admin.Global')
                            )
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
                )
            ),
        );

        if (Tools::isSubmit('id_slide') && $this->slideExists((int)Tools::getValue('id_slide'))) {
            $slide = new HtmlBanner8((int)Tools::getValue('id_slide'));
            $fields_form['form']['input'][] = array('type' => 'hidden', 'name' => 'id_slide');
            $fields_form['form']['images'] = $slide->image;

            $has_picture = true;

            foreach (Language::getLanguages(false) as $lang) {
                if (!isset($slide->image[$lang['id_lang']])) {
                    $has_picture &= false;
                }
            }

            if ($has_picture) {
                $fields_form['form']['input'][] = array('type' => 'hidden', 'name' => 'has_picture');
            }
        }

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();
        $helper->module = $this;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitSlide';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $language = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->tpl_vars = array(
            'base_url' => Context::getContext()->shop->getBaseURL(true),
            'language' => array(
                'id_lang' => $language->id,
                'iso_code' => $language->iso_code
            ),
            'fields_value' => $this->getAddFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
            'image_baseurl' => $this->_path.'views/img/upload/'
        );

        $helper->override_folder = '/';

        $languages = Language::getLanguages(false);

        if (count($languages) > 1) {
            return $this->getMultiLanguageInfoMsg() . $helper->generateForm(array($fields_form));
        } else {
            return $helper->generateForm(array($fields_form));
        }
    }

    public function renderForm()
    {
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->getTranslator()->trans('Carousel settings', array(), 'Admin.Global'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Carousel mode'),
                        'name' => 'HTMLBANNERS8_CAROUSEL_ACTIVE',
                        'desc' => $this->l('Display banners in carousel.'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->getTranslator()->trans('Enabled', array(), 'Admin.Global')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->getTranslator()->trans('Disabled', array(), 'Admin.Global')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Autoplay'),
                        'name' => 'HTMLBANNERS8_AUTOPLAY',
                        'desc' => $this->l('Autoplay carousel'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->getTranslator()->trans('Enabled', array(), 'Admin.Global')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->getTranslator()->trans('Disabled', array(), 'Admin.Global')
                            )
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Autoplay Timeout'),
                        'name' => 'HTMLBANNERS8_SPEED',
                        'suffix' => 'milliseconds',
                        'class' => 'fixed-width-sm',
                        'desc' => $this->l('Autoplay interval timeout.')
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Pause on hover'),
                        'name' => 'HTMLBANNERS8_PAUSE_ON_HOVER',
                        'desc' => $this->l('Stop sliding when the mouse cursor is over the slideshow.'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->getTranslator()->trans('Enabled', array(), 'Admin.Global')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->getTranslator()->trans('Disabled', array(), 'Admin.Global')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Pagination'),
                        'name' => 'HTMLBANNERS8_PAGINATION',
                        'desc' => $this->l('Display a pagination in slider'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->getTranslator()->trans('Enabled', array(), 'Admin.Global')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->getTranslator()->trans('Disabled', array(), 'Admin.Global')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Navigation arrows'),
                        'name' => 'HTMLBANNERS8_NAVIGATION',
                        'desc' => $this->l('Display a navigation arrows in slider'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->getTranslator()->trans('Enabled', array(), 'Admin.Global')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->getTranslator()->trans('Disabled', array(), 'Admin.Global')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Loop forever'),
                        'name' => 'HTMLBANNERS8_WRAP',
                        'desc' => $this->l('Loop or stop after the last slide.'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->getTranslator()->trans('Enabled', array(), 'Admin.Global')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->getTranslator()->trans('Disabled', array(), 'Admin.Global')
                            )
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Items in row'),
                        'name' => 'HTMLBANNERS8_ITEMS',
                        'suffix' => 'quantity',
                        'class' => 'fixed-width-sm',
                        'desc' => $this->l('Items in carousel')
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Items on 1199px in row'),
                        'name' => 'HTMLBANNERS8_ITEMS_1199',
                        'suffix' => 'quantity',
                        'class' => 'fixed-width-sm',
                        'desc' => $this->l('Items for displays 1199px and lower')
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Items on 991px in row'),
                        'name' => 'HTMLBANNERS8_ITEMS_991',
                        'suffix' => 'quantity',
                        'class' => 'fixed-width-sm',
                        'desc' => $this->l('Items for display 991px and lower')
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Items on 768px in row'),
                        'name' => 'HTMLBANNERS8_ITEMS_768',
                        'suffix' => 'quantity',
                        'class' => 'fixed-width-sm',
                        'desc' => $this->l('Items for display 768px and lower')
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Items on 480px in row'),
                        'name' => 'HTMLBANNERS8_ITEMS_480',
                        'suffix' => 'quantity',
                        'class' => 'fixed-width-sm',
                        'desc' => $this->l('Items for display 480px and lower')
                    ),
                ),
                'submit' => array(
                    'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
                )
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitSlider';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper->generateForm(array($fields_form));
    }

    public function getConfigFieldsValues()
    {
        $id_shop_group = Shop::getContextShopGroupID();
        $id_shop = Shop::getContextShopID();

        return array(
            'HTMLBANNERS8_CAROUSEL_ACTIVE' => Tools::getValue('HTMLBANNERS8_CAROUSEL_ACTIVE', Configuration::get('HTMLBANNERS8_CAROUSEL_ACTIVE', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_AUTOPLAY' => Tools::getValue('HTMLBANNERS8_AUTOPLAY', Configuration::get('HTMLBANNERS8_AUTOPLAY', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_SPEED' => Tools::getValue('HTMLBANNERS8_SPEED', Configuration::get('HTMLBANNERS8_SPEED', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_PAUSE_ON_HOVER' => Tools::getValue('HTMLBANNERS8_PAUSE_ON_HOVER', Configuration::get('HTMLBANNERS8_PAUSE_ON_HOVER', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_PAGINATION' => Tools::getValue('HTMLBANNERS8_PAGINATION', Configuration::get('HTMLBANNERS8_PAGINATION', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_NAVIGATION' => Tools::getValue('HTMLBANNERS8_NAVIGATION', Configuration::get('HTMLBANNERS8_NAVIGATION', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_WRAP' => Tools::getValue('HTMLBANNERS8_WRAP', Configuration::get('HTMLBANNERS8_WRAP', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_ITEMS' => Tools::getValue('HTMLBANNERS8_ITEMS', Configuration::get('HTMLBANNERS8_ITEMS', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_ITEMS_1199' => Tools::getValue('HTMLBANNERS8_ITEMS_1199', Configuration::get('HTMLBANNERS8_ITEMS_1199', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_ITEMS_991' => Tools::getValue('HTMLBANNERS8_ITEMS_991', Configuration::get('HTMLBANNERS8_ITEMS_991', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_ITEMS_768' => Tools::getValue('HTMLBANNERS8_ITEMS_768', Configuration::get('HTMLBANNERS8_ITEMS_768', null, $id_shop_group, $id_shop)),
            'HTMLBANNERS8_ITEMS_480' => Tools::getValue('HTMLBANNERS8_ITEMS_480', Configuration::get('HTMLBANNERS8_ITEMS_480', null, $id_shop_group, $id_shop)),
        );
    }

    public function getAddFieldsValues()
    {
        $fields = array();

        if (Tools::isSubmit('id_slide') && $this->slideExists((int)Tools::getValue('id_slide'))) {
            $slide = new HtmlBanner8((int)Tools::getValue('id_slide'));
            $fields['id_slide'] = (int)Tools::getValue('id_slide', $slide->id);
        } else {
            $slide = new HtmlBanner8();
        }

        $fields['active_slide'] = Tools::getValue('active_slide', $slide->active);
        $fields['has_picture'] = true;

        $languages = Language::getLanguages(false);
        $id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
        foreach ($languages as $lang) {
            $fields['image'][$lang['id_lang']] = Tools::getValue('image_'.(int)$lang['id_lang']);
            $fields['title'][$lang['id_lang']] = Tools::getValue('title_'.(int)$lang['id_lang'], $slide->title[$lang['id_lang']]);
            $fields['url'][$lang['id_lang']] = Tools::getValue('url_'.(int)$lang['id_lang'], $slide->url[$lang['id_lang']]);
            $fields['legend'][$lang['id_lang']] = Tools::getValue('legend_'.(int)$lang['id_lang'], $slide->legend[$lang['id_lang']]);
            $fields['customclass'][$lang['id_lang']] = Tools::getValue('customclass_'.(int)$id_lang_default, $slide->customclass[$id_lang_default]);
            $fields['category'][$lang['id_lang']] = Tools::getValue('category_'.(int)$id_lang_default, $slide->category[$id_lang_default]);
            $fields['description'][$lang['id_lang']] = Tools::getValue('description_'.(int)$lang['id_lang'], $slide->description[$lang['id_lang']]);
        }

        return $fields;
    }

    protected function getMultiLanguageInfoMsg()
    {
        return '<p class="alert alert-warning">'.
                    $this->l('Since multiple languages are activated on your shop, please mind to upload your image for each one of them').
                '</p>';
    }

    protected function getWarningMultishopHtml()
    {
        if (Shop::getContext() == Shop::CONTEXT_GROUP || Shop::getContext() == Shop::CONTEXT_ALL) {
            return '<p class="alert alert-warning">' .
            $this->l('You cannot manage slides items from a "All Shops" or a "Group Shop" context, select directly the shop you want to edit') .
            '</p>';
        } else {
            return '';
        }
    }

    protected function getShopContextError($shop_contextualized_name, $mode)
    {
        if (is_array($shop_contextualized_name)) {
            $shop_contextualized_name = implode('<br/>', $shop_contextualized_name);
        }

        if ($mode == 'edit') {
            return '<p class="alert alert-danger">' .
            $this->trans('You can only edit this slide from the shop(s) context: %s', array($shop_contextualized_name), 'Modules.Heroimageslider.Admin') .
            '</p>';
        } else {
            return '<p class="alert alert-danger">' .
            $this->trans('You cannot add slides from a "All Shops" or a "Group Shop" context', array(), 'Modules.Heroimageslider.Admin') .
            '</p>';
        }
    }

    protected function getShopAssociationError($id_slide)
    {
        return '<p class="alert alert-danger">'.
                        $this->trans('Unable to get slide shop association information (id_slide: %d)', array((int)$id_slide), 'Modules.Heroimageslider.Admin') .
                '</p>';
    }


    protected function getCurrentShopInfoMsg()
    {
        $shop_info = null;

        if (Shop::isFeatureActive()) {
            if (Shop::getContext() == Shop::CONTEXT_SHOP) {
                $shop_info = $this->trans('The modifications will be applied to shop: %s', array($this->context->shop->name), 'Modules.Heroimageslider.Admin');
            } elseif (Shop::getContext() == Shop::CONTEXT_GROUP) {
                $shop_info = $this->trans('The modifications will be applied to this group: %s', array(Shop::getContextShopGroup()->name), 'Modules.Heroimageslider.Admin');
            } else {
                $shop_info = $this->trans('The modifications will be applied to all shops and shop groups', array(), 'Modules.Heroimageslider.Admin');
            }

            return '<div class="alert alert-info">'.
                        $shop_info.
                    '</div>';
        } else {
            return '';
        }
    }

    protected function getSharedSlideWarning()
    {
        return '<p class="alert alert-warning">'.
                    $this->trans('This slide is shared with other shops! All shops associated to this slide will apply modifications made here', array(), 'Modules.Heroimageslider.Admin').
                '</p>';
    }
}
