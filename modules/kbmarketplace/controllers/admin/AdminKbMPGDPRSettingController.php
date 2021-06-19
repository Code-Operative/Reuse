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
 */

require_once dirname(__FILE__).'/AdminKbMarketplaceCoreController.php';

class AdminKbMPGDPRSettingController extends AdminKbMarketplaceCoreController
{

    public function __construct()
    {
        $this->table   = 'Configuration';
        $this->display = 'edit';
        parent::__construct();

        $this->fields_form = array(
            'tinymce' => false,
            'input' => array(
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable GDPR', 'AdminKbMPGDPRSettingController'),
                    'name' => 'enable_gdpr',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'value' => 1,
                        ),
                        array(
                            'value' => 0,
                        )
                    ),
                    'hint' => $this->module->l('Enable/Disable this setting to display GDPR in frontend', 'AdminKbMPGDPRSettingController')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable Display Customer ID to seller', 'AdminKbMPGDPRSettingController'),
                    'name' => 'enable_customer_id',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'value' => 1,
                        ),
                        array(
                            'value' => 0,
                        )
                    ),
                    'hint' => $this->module->l('Enable/Disable this setting to display customer email to the Seller', 'AdminKbMPGDPRSettingController')
                ),
               array(
                    'type' => 'switch',
                    'label' => $this->module->l('Option to Close Shop', 'AdminKbMPGDPRSettingController'),
                    'name' => 'enable_close_shop',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'value' => 1,
                        ),
                        array(
                            'value' => 0,
                        )
                    ),
                    'hint' => $this->module->l('Enable/Disable this setting to display the option to close shop to the seller', 'AdminKbMPGDPRSettingController')
                ),
            ),
            'submit' => array('title' => $this->module->l('Save', 'AdminKbMPGDPRSettingController')),
        );

        $this->show_form_cancel_button = false;
        $this->submit_action           = 'submitMPGDPRConfiguration';
    }

    public function initContent()
    {
        parent::initContent();
        $this->context->smarty->assign(array(
            'title' => $this->module->l('GDPR Settings', 'AdminKbMPGDPRSettingController'),
        ));
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->context->controller->addJqueryUI('ui.widget');
        $this->context->controller->addJqueryPlugin('tagify');
    }

    public function renderForm()
    {
        $form = parent::renderForm();
        $tpl  = $this->context->smarty->createTemplate(
            _PS_MODULE_DIR_.$this->kb_module_name.'/views/templates/admin/setting.tpl'
        );
        $this->context->smarty->assign(array(
            'selected_nav' => 'gdpr_config',
            'gdpr_setting'=>  $this->context->link->getAdminLink('AdminKbMPGDPRSetting', true),
            'mp_setting'=>  $this->context->link->getAdminLink('AdminKbMarketPlaceSetting', true),
        ));
        $tpl->assign(
            'kb_tabs',
            $this->context->smarty->fetch(
                _PS_MODULE_DIR_ . $this->module->name . '/views/templates/admin/kb_tabs.tpl'
            )
        );
        $tpl->assign('form_fields', $form);
        return $tpl->fetch();
    }

    public function initProcess()
    {
        if (Tools::isSubmit('submitMPGDPRConfiguration')) {
            $this->action = 'MPGDPRSetting';
        }
    }

    public function processMPGDPRSetting()
    {
        $form = array();
        $form['enable_gdpr'] = Tools::getValue('enable_gdpr');
        $form['enable_customer_id'] = Tools::getValue('enable_customer_id');
        $form['enable_close_shop'] = Tools::getValue('enable_close_shop');
        if (!empty($form)) {
            if ($form['enable_gdpr']) {
                $this->addTabIntoSellerMenu();
            } else {
                $this->removeTabFromSellerMenu();
            }
            Configuration::updateValue('KB_MP_GDPR_SETTINGS', Tools::jsonEncode($form));
            $this->confirmations[] = $this->_conf[6];
        }
    }

    public function getFieldsValue($obj)
    {
        unset($obj);

        $settings = Tools::jsonDecode(Configuration::get('KB_MP_GDPR_SETTINGS'), true);
        
        
        $this->fields_value['enable_gdpr'] = (!empty($settings))?$settings['enable_gdpr']:0;
        $this->fields_value['enable_customer_id'] = (!empty($settings))?$settings['enable_customer_id']:1;
        $this->fields_value['enable_close_shop'] = (!empty($settings))?$settings['enable_close_shop']:0;
        return $this->fields_value;
    }
    
    protected function addTabIntoSellerMenu()
    {
        DB::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'kb_mp_seller_menu where controller_name="gdpr"');
        
        $languages = Language::getLanguages(false);

        $menu_obj = new KbSellerMenu();
        $menu_obj->module_name = 'kbmarketplace';
        $menu_obj->controller_name = 'gdpr';
        $menu_obj->position = 11;
        $menu_obj->icon = 'lock';
        $menu_obj->show_badge = 1;
        
        foreach ($languages as $lng) {
            $menu_obj->label[$lng['id_lang']] = $this->module->l('GDPR', 'AdminKbMPGDPRSettingController');
            $menu_obj->title[$lng['id_lang']] = $this->module->l('GDPR', 'AdminKbMPGDPRSettingController');
        }
        
        if ($menu_obj->save()) {
            return true;
        } else {
            return false;
        }
    }
    
    protected function removeTabFromSellerMenu()
    {
        $menuid = KbSellerMenu::getMenuIdByModuleAndController('kbmarketplace', 'gdpr');
        if ($menuid) {
            $menuobj = new KbSellerMenu((int) $menuid);
            if ($menuobj->delete()) {
                return true;
            }
        }

        return false;
    }
}
