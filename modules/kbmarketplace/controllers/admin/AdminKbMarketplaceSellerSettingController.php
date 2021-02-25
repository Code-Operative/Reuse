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

require_once dirname(__FILE__).'/AdminKbMarketplaceCoreController.php';
require_once(_PS_MODULE_DIR_.'kbmarketplace/libraries/kbmarketplace/KbGlobal.php');

class AdminKbMarketPlaceSellerSettingController extends ModuleAdminControllerCore
{
    public $custom_smarty;
    public $module;
    public $name;
    protected $kb_module_name = 'kbmarketplace';
    
    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
        $this->allow_export = false;
        $this->module->lang = false;
        $this->context = Context::getContext();
        $this->table   = 'kb_mp_seller_config';
        $this->module = Module::getInstanceByName('kbmarketplace');
        $this->context = Context::getContext();
        $this->custom_smarty = new Smarty();
        $this->custom_smarty->setCompileDir(_PS_CACHE_DIR_ . 'smarty/compile');
        $this->custom_smarty->setCacheDir(_PS_CACHE_DIR_ . 'smarty/cache');
        $this->custom_smarty->use_sub_dirs = true;
        $this->custom_smarty->setConfigDir(_PS_SMARTY_DIR_ . 'configs');
        $this->custom_smarty->caching = false;
        $this->custom_smarty->registerPlugin('function', 'l', 'smartyTranslate');
        $this->custom_smarty->setTemplateDir(_PS_MODULE_DIR_ . $this->kb_module_name . '/views/templates/admin/');
    }
    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->context->controller->addJqueryUI('ui.widget');
        $this->context->controller->addJqueryPlugin('tagify');
    }
    public function initContent()
    {
        $this->content = $this->renderView();
        parent::initContent();
    }
    protected function getModulePath()
    {
        return _PS_MODULE_DIR_.$this->module->name.'/';
    }
    public function renderView()
    {
        $helper = new HelperForm();
        $id_customer = (int) Tools::getValue('id_customer');
        $msg = '';
        $msg_txt1 = '';
        $seller = new KbSeller(KbSeller::getSellerByCustomerId($id_customer));
        $s_settings = new KbSellerSetting($seller->id);
        $s_settings->setShop($seller->id_shop);
        if ((Tools::isSubmit('submitSellerSetting') || Tools::isSubmit('submitSellerRegistration')) && (int) Tools::getValue('id_customer') > 0) {
            if (Tools::isSubmit('register_as_seller') && Tools::getValue('register_as_seller') == 1) {
                $seller->product_limit_wout_approval = 0;
                $seller->approval_request_limit = (int) KbGlobal::getGlobalSettingByKey('kbmp_approval_request_limit');
                $seller->notification_type = (string) KbSeller::NOTIFICATION_PRIMARY;
                $seller->registerNewCustomer(
                    $id_customer,
                    Tools::getValue('approve'),
                    Tools::getValue('activate_seller')
                );

                $new_customer = new Customer($id_customer);
                $data = array(
                    'email' => $new_customer->email,
                    'name' => $new_customer->firstname . ' ' . $new_customer->lastname
                );
                $email = new KbEmail(
                    KbEmail::getTemplateIdByName('mp_welcome_seller'),
                    $new_customer->id_lang
                );
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

                Hook::exec(
                    'actionKbMarketPlaceCustomerRegistration',
                    array('seller' => $seller)
                );

                $this->confirmations[] = $this->module->l('Customer successfully registered as seller.', 'AdminKbMarketPlaceSellerSettingController');
            } elseif (Tools::isSubmit('kb_mp_seller_config')) {
                $seller_config = Tools::getValue('kb_mp_seller_config');
                $error = 0;
                if (!Validate::isFloat($seller_config['kbmp_default_commission']['main'])) {
                    $msg_txt1 .= $this->module->l('Only numeric value is allowed in Default Commission.', 'AdminKbMarketPlaceSellerSettingController');
                    $this->errors[] = $msg_txt1;
                    $error = 1;
                } elseif ($seller_config['kbmp_default_commission']['main'] < 0 || $seller_config['kbmp_default_commission']['main'] > 100) {
                    $msg_txt1 .= $this->module->l('Default Comission can not be less than 0 or greater than 100.', 'AdminKbMarketPlaceSellerSettingController');
                    $this->errors[] = $msg_txt1;
                    $error = 1;
                }
                if ($error == 1) {
                    $msg = $this->displayError($msg_txt1);
                } else {
                    $s_settings->setSettings($seller_config);
                    $s_settings->saveSettings();
                    $new_cates = array();
                    if (Tools::isSubmit('categoryBox')) {
                        $new_cates = Tools::getValue('categoryBox', array());
                    }
                    $seller_product = KbSellerProduct::getSellerProducts($seller->id);
                    if (!empty($seller_product)) {
                        foreach ($seller_product as $sp) {
                            $pro = new Product($sp['id_product']);
                            if (!in_array($pro->id_category_default, $new_cates)) {
                                $pro->active = 0;
                                $pro->update();
                            } else {
                                $pro->active = 1;
                                $pro->update();
                            }
                        }
                    }
                    KbSellerCategory::trackAndUpdateCategories($seller->id, $new_cates);

                    KbSellerSetting::assignCategoryToSeller($seller, $new_cates);

                    $msg = $this->module->l('Seller settings successfully saved.', 'AdminKbMarketPlaceSellerSettingController');
                    $this->confirmations[] = $msg;
                    Hook::exec(
                        'actionKbMarketPlaceSellerSettingSave',
                        array('setting' => $seller_config,
                               'seller' => $seller)
                    );
                }
            }
        }
        $fields_options = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->module->l('Seller Account Configuration', 'AdminKbMarketPlaceSellerSettingController'),
                    'icon' => 'icon-wrench'
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'AdminKbMarketPlaceSellerSettingController'),
                    'class' => 'btn btn-default pull-right',
                    'name' => 'submitSellerSetting',
                )
            )
        );
        $field_values = array();

        if (!$seller->isSeller()) {
            $fields_options['form']['input'] = array(
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Register as seller', 'AdminKbMarketPlaceSellerSettingController'),
                    'name' => 'register_as_seller',
                    'hint' => $this->module->l('To register this customer as seller.', 'AdminKbMarketPlaceSellerSettingController'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'AdminKbMarketPlaceSellerSettingController')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'AdminKbMarketPlaceSellerSettingController')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Approve', 'AdminKbMarketPlaceSellerSettingController'),
                    'name' => 'approve',
                    'hint' => $this->module->l('Approve customer as seller after registering or later.', 'AdminKbMarketPlaceSellerSettingController'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'AdminKbMarketPlaceSellerSettingController')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'AdminKbMarketPlaceSellerSettingController')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Active', 'AdminKbMarketPlaceSellerSettingController'),
                    'name' => 'activate_seller',
                    'hint' => $this->module->l('Activate seller', 'AdminKbMarketPlaceSellerSettingController'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'AdminKbMarketPlaceSellerSettingController')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'AdminKbMarketPlaceSellerSettingController')
                        )
                    ),
                )
            );

            $field_values = array(
                'register_as_seller' => 0,
                'approve' => KbGlobal::APPROVAL_WAITING,
                'activate_seller' => 0
            );
            $helper->submit_action = 'submitSellerRegistration';
        } else {
            $settings = $s_settings->getSettings();
            if (empty($settings) || count($settings) == 0) {
                $settings = KbSellerSetting::getSellerDefaultSetting();
            }

            $fields = array(
                array(
                    'type' => 'text',
                    'required' => true,
                    'label' => $this->module->l('Default Commission', 'AdminKbMarketPlaceSellerSettingController'),
                    'name' => 'kbmp_default_commission',
                    'hint' => $this->module->l('This commission will be deducted per product ordered for this seller.', 'AdminKbMarketPlaceSellerSettingController'),
                    'values' => 15,
                    'class' => 'fixed-width-xs kbmp_default_commission_seller',
                    'suffix' => '%',
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('New Product Approval Required', 'AdminKbMarketPlaceSellerSettingController'),
                    'name' => 'kbmp_new_product_approval_required',
                    'hint' => $this->module->l('New product needs approval from your side before display on front.', 'AdminKbMarketPlaceSellerSettingController'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'AdminKbMarketPlaceSellerSettingController')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'AdminKbMarketPlaceSellerSettingController')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable Seller Review', 'AdminKbMarketPlaceSellerSettingController'),
                    'name' => 'kbmp_enable_seller_review',
                    'hint' => $this->module->l('Enable customers to give their reviews on seller.', 'AdminKbMarketPlaceSellerSettingController'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'AdminKbMarketPlaceSellerSettingController')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'AdminKbMarketPlaceSellerSettingController')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Seller Review Approval Required', 'AdminKbMarketPlaceSellerSettingController'),
                    'name' => 'kbmp_seller_review_approval_required',
                    'hint' => $this->module->l('With this setting, review first needs approval by you before showing to customers.', 'AdminKbMarketPlaceSellerSettingController'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'AdminKbMarketPlaceSellerSettingController')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'AdminKbMarketPlaceSellerSettingController')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Send Email on Order Place', 'AdminKbMarketPlaceSellerSettingController'),
                    'name' => 'kbmp_email_on_new_order',
                    'hint' => $this->module->l('With this setting, system will send email to seller for new order', 'AdminKbMarketPlaceSellerSettingController'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'AdminKbMarketPlaceSellerSettingController')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'AdminKbMarketPlaceSellerSettingController')
                        )
                    ),
                )
            );

            foreach ($fields as $input) {
                $tmp = $input;
                $use_global = ($settings[$input['name']]['global'] == 1) ? 'checked="checked"' : '';
                if ($input['name'] == 'kbmp_product_limit') {
                    $html = '';
                } else {
                    $html = '<input type="checkbox" onclick="changeSwitchColor(this)" '
                            . 'class="checkbox kb_checkbox_seller_settings" '
                            . 'name="kb_mp_seller_config[' . $input['name'] . '][global]" '
                            . 'value="1" ' . $use_global . ' />'
                            . '<span class="option-label">' . $this->module->l('Use Global', 'AdminKbMarketPlaceSellerSettingController') . '</span>';
                }

                $tmp['desc'] = $html;
                if ($input['type'] == 'select' && isset($input['multiple']) && $input['multiple']) {
                    $tmp['name'] = 'kb_mp_seller_config[' . $input['name'] . '][main][]';
                } else {
                    $tmp['name'] = 'kb_mp_seller_config[' . $input['name'] . '][main]';
                }
                if (isset($settings[$input['name']]['main'])) {
                    $field_values[$tmp['name']] = $settings[$input['name']]['main'];
                } else {
                    $field_values[$tmp['name']] = $settings[$input['name']]['global'];
                }
                $fields_options['form']['input'][] = $tmp;
            }

            $helper->submit_action = 'submitSellerSetting';

            $fields_options['form']['bottom'] = '';

            $assigned_cates = KbSellerCategory::getCategoriesBySeller($seller->id);

            $root = Category::getRootCategory();
            $tree = new HelperTreeCategories('seller-categories-tree');
            $tree->setRootCategory($root->id)
                    ->setUseCheckBox(true)
                    ->setUseSearch(false)
                    ->setSelectedCategories($assigned_cates);

            $fields_options['form']['input'][] = array(
                'type' => 'categories_select',
                'label' => $this->module->l('Categories Allowed', 'AdminKbMarketPlaceSellerSettingController'),
                'name' => 'kbmp_allowed_categories',
                'category_tree' => $tree->render(),
                'hint' => array(
                    $this->module->l('Categories to be allowed to seller in which he/she can map his/her products.', 'AdminKbMarketPlaceSellerSettingController')
                ),
                'desc' => $this->module->l('If you uncheck all categories, then previously save category will be saved by default.In order to enable a category you will have to check all the parent categories otherwise the category will not be activated. Example- To enable `T-shirts` category, you will have to check all the parent categories i.e. Home, Women, Tops and ofcourse T-shirts.', 'AdminKbMarketPlaceSellerSettingController')
            );
        }

        $helper->show_toolbar = false;

        Hook::exec(
            'displayKbMarketPlaceSellerSettingForm',
            array('fields_options' => $fields_options,
                    'fields_value' => $field_values,
                    'seller' => $seller)
        );

        $helper->tpl_vars = array(
            'fields_value' => $field_values
        );

        $lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->id = $id_customer;
        $helper->identifier = 'id_customer';
        $this->context->controller->addJS($this->getModulePath() . 'views/js/admin/kb-marketplace.js');
        return $helper->generateForm(array($fields_options));
    }
    public function postProcess()
    {
        parent::postProcess();
    }
    public function initPageHeaderToolbar()
    {
        parent::initPageHeaderToolbar();
    }
    public function initToolbar()
    {
        parent::initToolbar();
        unset($this->toolbar_btn['new']);
    }
}
