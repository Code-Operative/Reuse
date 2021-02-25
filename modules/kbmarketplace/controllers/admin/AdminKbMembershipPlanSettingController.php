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

class AdminKbMembershipPlanSettingController extends AdminKbMarketplaceCoreController
{
    public $all_languages = array();
    public $error_flag = false;

    public function __construct()
    {
        $this->table   = 'kb_mp_membership_setting_config';
        $this->display = 'edit';
        $this->all_languages = $this->getAllLanguages();
        parent::__construct();
        $orderStatuses = array();
        $statuses = OrderState::getOrderStates((int)Context::getContext()->language->id);
        foreach ($statuses as $status) {
            $orderStatuses[] = array(
                'id_option' => $status['id_order_state'],
                'name' => $status['name']
            );
        }
        
        $duration_intervals = array(
            1 => array(
                'id' => 1,
                'name' =>$this->module->l('Days', 'adminkbmembershipplansettingcontroller'),
            ),
            2 => array(
                'id' => 2,
                'name' => $this->module->l('Months', 'adminkbmembershipplansettingcontroller'),
            ),
            3 => array(
                'id' => 3,
                'name' => $this->module->l('Years', 'adminkbmembershipplansettingcontroller'),
            )
        );
        
        /* changes over */
        $this->fields_form = array(
            'tinymce' => true,
            'input' => array(
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable Membership Plan Functionality', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_enable_membership_plan',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_enable_membership_plan_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmembershipplansettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_enable_membership_plan_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmembershipplansettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If Enabled then products of seller will be active only if they have purchased any plan or falls under free plan if enabled', 'adminkbmembershipplansettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Send Membership Plan activation email', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_inform_seller_membership_plan_active',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_inform_seller_membership_plan_active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmembershipplansettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_inform_seller_membership_plan_active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmembershipplansettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If Enabled then email will be send to seller whenever a new plan is activated.', 'adminkbmembershipplansettingcontroller')
                ),
                array(
                    'type' => 'textarea',
                    'lang' => true,
                    'label' => $this->module->l('Membership Plan Activation Email Template', 'adminkbmembershipplansettingcontroller'),
                    'autoload_rte' => true,
                    'name' => 'kbmp_membership_start_email',
                    'hint' => $this->module->l('This template will used to inform seller when a new plan is started.', 'adminkbmembershipplansettingcontroller'),
                    'desc' => $this->module->l('Keywords like {{sample}} will be replace by dynamic content at the time of execution. Please do not remove these type of words from template, otherwise proper information will not be send in email to seller as well you. You can only change the position of these keywords in the template. Allowed Keywords {seller_name},{last_date},{plan_link},{product_limit},{plan_name}.', 'adminkbmembershipplansettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Send Membership Plan Expiry Email', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_inform_seller_membership_expiry',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_inform_seller_membership_expiry_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmembershipplansettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_inform_seller_membership_expiry_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmembershipplansettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If Enabled then email will be send to seller whenever a plan is expired.', 'adminkbmembershipplansettingcontroller')
                ),
                array(
                    'type' => 'textarea',
                    'lang' => true,
                    'label' => $this->module->l('Membership Plan Expiry Email Template', 'adminkbmembershipplansettingcontroller'),
                    'autoload_rte' => true,
                    'name' => 'kbmp_membership_expired_email',
                    'hint' => $this->module->l('This template will used to inform seller when a plan is expired.', 'adminkbmembershipplansettingcontroller'),
                    'desc' => $this->module->l('Keywords like {{sample}} will be replace by dynamic content at the time of execution. Please do not remove these type of words from template, otherwise proper information will not be send in email to seller as well you. You can only change the position of these keywords in the template. Allowed Keywords {seller_name},{last_date},{plan_link},{plan_name}.', 'adminkbmembershipplansettingcontroller')
                ),
//                array(
//                    'type' => 'switch',
//                    'label' => $this->module->l('Send Warning Email', 'adminkbmembershipplansettingcontroller'),
//                    'name' => 'kbmp_inform_seller_membership_warning',
//                    'required' => false,
//                    'class' => 't',
//                    'is_bool' => true,
//                    'values' => array(
//                        array(
//                            'id' => 'kbmp_inform_seller_membership_warning_on',
//                            'value' => 1,
//                            'label' => $this->module->l('Enabled', 'adminkbmembershipplansettingcontroller')
//                        ),
//                        array(
//                            'id' => 'kbmp_inform_seller_membership_warning_off',
//                            'value' => 0,
//                            'label' => $this->module->l('Disabled', 'adminkbmembershipplansettingcontroller')
//                        )
//                    ),
//                    'hint' => $this->module->l('If Enabled then email will be send to seller whenever a plan is about to expire.', 'adminkbmembershipplansettingcontroller')
//                ),
//                array(
//                    'type' => 'textarea',
//                    'lang' => true,
//                    'label' => $this->module->l('Membership Plan Warning Email Template', 'adminkbmembershipplansettingcontroller'),
//                    'autoload_rte' => true,
//                    'name' => 'kbmp_membership_warning_email',
//                    'hint' => $this->module->l('This template will used to inform seller when a plan is about to expire.', 'adminkbmembershipplansettingcontroller'),
//                    'desc' => $this->module->l('Keywords like {{sample}} will be replace by dynamic content at the time of execution. Please do not remove these type of words from template, otherwise proper information will not be send in email to seller as well you. You can only change the position of these keywords in the template.', 'adminkbmembershipplansettingcontroller')
//                ),
//                array(
//                    'type' => 'text',
//                    'label' => $this->module->l('Number of days left to upgrade plan, when warning mail will be send', 'adminkbmembershipplansettingcontroller'),
//                    'name' => 'kbmp_membership_warning_email_reminder_days',
//                    'required' => true,
//                    'validation' => 'isInt',
//                    'class' => 'fixed-width-xl',
//                    'hint' => $this->module->l('Only Numeric values are allowed', 'adminkbmembershipplansettingcontroller'),
//                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Show Warning Message', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_membership_warning_msg',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_inform_seller_membership_warning_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmembershipplansettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_inform_seller_membership_warning_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmembershipplansettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If Enabled then warning msg will be displayed to seller whenever a plan is about to expire.', 'adminkbmembershipplansettingcontroller')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->module->l('Number of days left to upgrade plan, when warning mesage will be displayed', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_membership_warning_msg_reminder_days',
                    'required' => true,
                    'validation' => 'isInt',
                    'class' => 'fixed-width-xl',
                    'hint' => $this->module->l('Only Numeric values are allowed', 'adminkbmembershipplansettingcontroller'),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable/Disable Free Membership Plan', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_free_membership_plan',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_free_membership_plan_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmembershipplansettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_free_membership_plan_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmembershipplansettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If enabled then free membership will be activated for new sellers.', 'adminkbmembershipplansettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable/disable Product Active limit under free Membership Plan', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_enable_product_limit_free_membership_plan',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_enable_product_limit_free_membership_plan_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmembershipplansettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_enable_product_limit_free_membership_plan_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmembershipplansettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If enabled then the set number of products will be active under free membership plan.', 'adminkbmembershipplansettingcontroller')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->module->l('Product Limit', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_free_membership_product_limit',
                    'required' => true,
                    'validation' => 'isInt',
                    'class' => 'fixed-width-xl',
                    'hint' => $this->module->l('Only Numeric values are allowed', 'adminkbmembershipplansettingcontroller'),
                ),
                array(
                    'type' => 'select',
                    'label' => $this->l('Duration Interval'), // The <label> for this <select> tag.
                    'class' => 'chosen',
                    'required' => true,
                    'hint' => $this->l('Select duration interval for free membership plan'),
                    'name' => 'kbmp_free_membership_plan_duration_interval', // The content of the 'id' attribute of the <select> tag.
                    'options' => array(
                        'query'=> $duration_intervals,
                        'id' =>  'id',
                        'name'=>  'name'
                    )
                ),
                array(
                    'type' => 'text',
                    'label' => $this->module->l('Duration', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_free_membership_plan_duration',
                    'required' => true,
                    'validation' => 'isInt',
                    'class' => 'fixed-width-xl',
                    'hint' => $this->module->l('Only Numeric values are allowed', 'adminkbmembershipplansettingcontroller'),
                ),
                array(
                    'type' => 'select',
                    'multiple' => true,
                    'class' => 'chosen',
                    'label' => $this->l('Select order state in which membership plan will be marked as paid.'),
                    'name' => 'kbmp_membership_plan_order_statuses[]',
                    'required' => true,
                    'options' => array(
                        'query' => $orderStatuses,
                        'id' => 'id_option',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Show membership Plan selectbox during seller registration', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_enable_membership_plan_seller_registration',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_enable_membership_plan_seller_registration_on',
                            'value' => 1,
                            'label' => $this->module->l('Yes', 'adminkbmembershipplansettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_enable_membership_plan_seller_registration_off',
                            'value' => 0,
                            'label' => $this->module->l('No', 'adminkbmembershipplansettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If enabled then option to select membership plan will be shown in seller registration form.', 'adminkbmembershipplansettingcontroller')
                ),
            ),
            'submit' => array('title' => $this->module->l('Save', 'adminkbmembershipplansettingcontroller'))
        );

        if (!Configuration::get('kbmp_marked_seller_status')) {
            $membership_field_array = array(
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Mark All Already Active seller product as inactive', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_mark_inactive_already_active',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_mark_inactive_already_active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmembershipplansettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_mark_inactive_already_active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmembershipplansettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('You can not changes its value after saving it once.', 'adminkbmembershipplansettingcontroller')
                ),
                array(
                    'type' => 'textarea',
                    'lang' => true,
                    'label' => $this->module->l('Product Deactivation Email Content', 'adminkbmembershipplansettingcontroller'),
                    'autoload_rte' => true,
                    'name' => 'kbmp_product_deactivation_email',
                    'hint' => $this->module->l('This template will used to inform seller when a new plan is started.', 'adminkbmembershipplansettingcontroller'),
                    'desc' => $this->module->l('Keywords like {{sample}} will be replace by dynamic content at the time of execution. Please do not remove these type of words from template, otherwise proper information will not be send in email to seller as well you. You can only change the position of these keywords in the template.', 'adminkbmembershipplansettingcontroller')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->module->l('Set Duration until which seller product will remain active without membership plan', 'adminkbmembershipplansettingcontroller'),
                    'name' => 'kbmp_product_activation_duration',
                    'required' => true,
                    'suffix' => $this->module->l('Days', 'adminkbmembershipplansettingcontroller'),
                    'validation' => 'isInt',
                    'class' => 'fixed-width-xl',
                    'hint' => $this->module->l('Set Duration until which seller product will remain active without membership plan.', 'adminkbmembershipplansettingcontroller'),
                ),
                array(
                    'type' => 'textarea',
                    'lang' => true,
                    'label' => $this->module->l('Rebate time Email Content', 'adminkbmembershipplansettingcontroller'),
                    'autoload_rte' => true,
                    'name' => 'kbmp_seller_rebate_email',
                    'hint' => $this->module->l('This template will used to inform seller the last date after which all their active product will be disabled', 'adminkbmembershipplansettingcontroller'),
                    'desc' => $this->module->l('Keywords like {{sample}} will be replace by dynamic content at the time of execution. Please do not remove these type of words from template, otherwise proper information will not be send in email to seller as well you. You can only change the position of these keywords in the template.', 'adminkbmembershipplansettingcontroller')
                ),
            );
            $this->fields_form['input'] = array_merge($this->fields_form['input'], $membership_field_array);
        }
        
        $this->show_form_cancel_button = false;
        $this->submit_action           = 'submitMarketPlaceMembershipPlanConfiguration';
    }

    public function initContent()
    {
        if (!Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')
            || Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')
            == '') {
            $settings = KbGlobal::getDefaultMemberShipPlanSettings();
        } elseif (Tools::getValue('kbmp_reset_setting') == 1) {
            $settings = KbGlobal::getDefaultSettingsFirstTime();
        } else {
            Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
            $settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
        }
        
        /*
         * changes by rishabh jain for multiple tabs
         */
        $link_reminder = $this->context->link->getAdminLink('AdminKbMpReminderProfiles', true);
        $general_setting = $this->context->link->getAdminLink('AdminKbMembershipPlanSetting', true);
        $link_expiry = $this->context->link->getAdminLink('AdminKbMpExpiryProfiles', true);
        $default_link = $this->context->link->getAdminLink('AdminModules', true).'&configure='.urlencode($this->module->name).'&tab_module='.$this->module->tab.'&module_name='.urlencode($this->module->name);
        $this->context->smarty->assign('admin_configure_controller', $default_link);
        $this->context->smarty->assign('reminder_profile_link', $link_reminder);
        
        $this->context->smarty->assign('expiry_profile_link', $link_expiry);
        
        $this->context->smarty->assign('general_setting', $general_setting);
        $this->context->smarty->assign('method', '');
        $this->context->smarty->assign('selected_nav', 'config');
        $tabs = $this->context->smarty->fetch(
            _PS_MODULE_DIR_.$this->module->name.'/views/templates/admin/top_tabs_kbmembership.tpl'
        );
        $this->context->smarty->assign('form', '');
        $this->context->smarty->assign('form1', '');
        $this->context->smarty->assign('controller_path', '');
        $this->context->smarty->assign('lang_id', $this->context->language->id);
        $this->context->smarty->assign('firstCall', false);
        
        $kb_velovalidation_variables = $this->context->smarty->fetch(
            _PS_MODULE_DIR_.$this->module->name.'/views/templates/admin/kb_velovalidation.tpl'
        );
        
        $this->content .= $tabs;
        $this->content .= $kb_velovalidation_variables;
        
        $link_plan_activate_deactivate = $this->context->link->getModuleLink(
            'kbmarketplace',
            'cron',
            array(
                'action' => 'activateDeactivateMembershipPlans',
                'secure_key' => Configuration::get('KB_MP_MEMBERSHIP_PLAN')
            )
        );
        $link_reminders = $this->context->link->getModuleLink(
            'kbmarketplace',
            'cron',
            array(
                'action' => 'sendMembeshipReminders',
                'secure_key' => Configuration::get('KB_MP_MEMBERSHIP_PLAN')
            )
        );
        
        $this->context->smarty->assign('link_plan_activate_deactivate', $link_plan_activate_deactivate);
        $this->context->smarty->assign('link_reminders', $link_reminders);

        parent::initContent();
        
        $this->content .= $this->context->smarty->fetch(
            _PS_MODULE_DIR_.$this->module->name.'/views/templates/admin/cron_instruction.tpl'
        );
        
        $this->context->smarty->assign(array(
            'title' => $this->module->l('MemberShip Plans General Settings', 'adminkbmembershipplansettingcontroller'),
        ));
        
        $this->context->smarty->assign(array(
            'content' => $this->content,
        ));
    }

    
    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addCSS($this->getKbModuleDir() . 'views/css/admin/kbrc_admin.css');
        $this->addJS($this->getKbModuleDir() . 'views/js/front/velovalidation.js');
    }
    
    protected function getKbModuleDir()
    {
        return _PS_MODULE_DIR_.'kbmarketplace/';
    }

    public function initProcess()
    {
        if (Tools::isSubmit('submitMarketPlaceMembershipPlanConfiguration')) {
            $this->action = 'MarketPlaceMemberShipPlanSetting';
        }
    }

    public function processMarketPlaceMemberShipPlanSetting()
    {
        $mp_config = array();
        if (Tools::getIsset('kbmp_reset_setting') && Tools::getValue('kbmp_reset_setting')
            == 1) {
            $this->fields_value = KbGlobal::getDefaultMemberShipPlanSettings();
            $this->displayWarning(
                $this->module->l('Please click on Save button to keep default settings (settings shown below), otherwise previously saved values will be kept.', 'adminkbmembershipplansettingcontroller')
            );
            return $this->fields_value;
        } else {
            $default_settings = KbGlobal::getDefaultMemberShipPlanSettings();
            $order_status_setting_field_name = 'kbmp_membership_plan_order_statuses[]';
            $this->getLanguages();
            foreach ($this->fields_form['input'] as $field) {
                $error = false;
                if (($field['name'] == 'kbmp_free_membership_product_limit')
                    || ($field['name'] == 'kbmp_free_membership_plan_duration_interval')
                    || ($field['name'] == 'kbmp_membership_warning_msg_reminder_days')
                    ) {
                    if (Tools::getValue($field['name']) < 0) {
                        $error          = true;
                        $label          = $field['label'];
                        $this->errors[] = Tools::displayError(sprintf($this->module->l('Value of %s can not be negative.', 'adminkbmembershipplansettingcontroller'), $label));
                    }
                }
                if (isset($field['lang']) && $field['lang']) {
                    $lang_data = $default_settings[$field['name']];
                    foreach ($this->_languages as $language) {
                        $lang_data[$language['id_lang']] = '';
                        if (Tools::getIsset($field['name'].'_'.$language['id_lang'])) {
                            $value                           = Tools::getValue($field['name'].'_'.$language['id_lang']);
                            $lang_data[$language['id_lang']] = Tools::htmlentitiesUTF8($value);
                        } else {
                            if ($field['name'] == 'kbmp_seller_order_email_template') {
                                $lang_data[$language['id_lang']] = KbEmail::getOrderEmailBaseTemplate();
                            } elseif ($field['name'] == 'kbmp_seller_order_cancel_email_template') {
                                $lang_data[$language['id_lang']] = KbEmail::getOrderCancelEmailBaseTemplate();
                            } else {
                                $lang_data[$language['id_lang']] = '';
                            }
                        }
                    }
                    $mp_config[$field['name']] = $lang_data;
                } elseif ($field['name'] == $order_status_setting_field_name) {
                    /* changes by rishabh jain */
                    $status_setting = 'kbmp_membership_plan_order_statuses';
                    if (Tools::getIsset($status_setting)) {
                        $mp_config[$status_setting] = Tools::getValue($status_setting);
                    } else {
                        $error          = true;
                        $this->errors[] = Tools::displayError($this->module->l('Select atleast one order status which signifies the membership order as paid.', 'adminkbmembershipplansettingcontroller'));
                        $mp_config[$status_setting] = array();
                    }
                } elseif (Tools::getIsset($field['name'])) {
                    if (isset($field['required']) && $field['required']) {
                        if (($value = Tools::getValue($field['name'])) == false && (string) $value
                            != '0') {
//                            $error          = true;
//                            $this->errors[] = Tools::displayError(sprintf($this->module->l('Field %s is required.', 'adminkbmembershipplansettingcontroller'), $field['label']));
                        } elseif (isset($field['validation']) && !call_user_func(array(
                                "Validate", $field['validation']), Tools::getValue($field['name']))) {
//                            $error          = true;
//                            $this->errors[] = Tools::displayError(sprintf($this->module->l('Field %s is invalid.', 'adminkbmembershipplansettingcontroller'), $field['label']));
                        }
                    } elseif (isset($field['validation']) && !call_user_func(array(
                            "Validate", $field['validation']), Tools::getValue($field['name']))) {
//                        $error          = true;
//                        $this->errors[] = Tools::displayError(sprintf($this->module->l('Field %s is invalid.', 'adminkbmembershipplansettingcontroller'), $field['label']));
                    }
                    if (!$error) {
                        if ($field['type'] && isset($field['multiple']) && $field['multiple']) {
                            $mp_config[$field['name']] = Tools::getValue('selectItem'.$field['name']);
                        } else {
                            $mp_config[$field['name']] = Tools::getValue($field['name']);
                        }
                    }
                } else {
                    $mp_config[$field['name']] = $default_settings[$field['name']];
                }
            }
        }
        if (!$this->errors || count($this->errors) == 0) {
            $this->confirmations[] = $this->_conf[6];
            $this->updateFreeMemberShipPlanSetting($mp_config);
            
            Configuration::updateValue('kbmp_membership_start_email', serialize($mp_config['kbmp_membership_start_email']));
            Configuration::updateValue('kbmp_membership_expired_email', serialize($mp_config['kbmp_membership_expired_email']));
//            Configuration::updateValue('kbmp_membership_warning_email', serialize($mp_config['kbmp_membership_warning_email']));
            
            if (isset($mp_config['kbmp_product_deactivation_email'])) {
                Configuration::updateValue('kbmp_product_deactivation_email', serialize($mp_config['kbmp_product_deactivation_email']));
                unset($mp_config['kbmp_product_deactivation_email']);
            }
            
            
            if (isset($mp_config['kbmp_seller_rebate_email'])) {
                Configuration::updateValue('kbmp_seller_rebate_email', serialize($mp_config['kbmp_seller_rebate_email']));
                unset($mp_config['kbmp_seller_rebate_email']);
            }
            
            if (isset($mp_config['kbmp_mark_inactive_already_active'])) {
                Configuration::updateValue('kbmp_mark_inactive_already_active', $mp_config['kbmp_mark_inactive_already_active']);
                unset($mp_config['kbmp_mark_inactive_already_active']);
            }
            if (isset($mp_config['kbmp_product_activation_duration'])) {
                Configuration::updateValue('kbmp_product_activation_duration', $mp_config['kbmp_product_activation_duration']);
                unset($mp_config['kbmp_product_activation_duration']);
            }
            $is_updated = 0;
            if (isset($mp_config['kbmp_enable_membership_plan']) && $mp_config['kbmp_enable_membership_plan'] == 1 && !Configuration::get('kbmp_marked_seller_status')) {
                Configuration::updateValue('kbmp_marked_seller_status', date('Y-m-d'));
                $is_updated = 1;
                $this->sendMembershipPlanActivationDeactivationEmail();
            }
            unset($mp_config['kbmp_membership_start_email']);
//            unset($mp_config['kbmp_membership_warning_email']);
            unset($mp_config['kbmp_membership_expired_email']);
            
            Configuration::updateValue('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING', serialize($mp_config));
            Hook::exec('actionMarketplaceMemberShipGeneralSetting', array('controller' => $this, 'settings' => $mp_config));
            if ($is_updated) {
                $this->confirmations[] = $this->_conf[6];
                $general_setting = $this->context->link->getAdminLink('AdminKbMembershipPlanSetting', true);
                Tools::redirect($general_setting.'&conf=6');
            }
        }
    }
    
    public function updateFreeMemberShipPlanSetting($mp_config)
    {
        $free_membership_plan_id = KbMpMemberShipPlan::getFreeMembershipPlanID();
        $this->createUpdateFreeMemberShipPlan($mp_config, $free_membership_plan_id);
    }
    
    public function createUpdateFreeMemberShipPlan($mp_config, $free_membership_plan_id)
    {
        $this->l('Free Plan', 'AdminKbMembershipPlanSettingController');
        foreach ($this->all_languages as $lang) {
            $mp_config['product_name'][$lang['id_lang']] = Module::getInstanceByName('kbmarketplace')->getModuleTranslationByLanguage('kbmarketplace', 'Free Plan', 'adminkbmembershipplansettingcontroller', $lang['iso_code']);
        }
        $action = 'add';
        
        $free_membership_plan_obj = new KbMpMemberShipPlan((int) $free_membership_plan_id);
        
        if ($free_membership_plan_id > 0) {
            $action = 'update';
            $mp_config['id_product'] = $free_membership_plan_obj->id_product;
        }
        
        if (!$this->addUpdateProduct($mp_config, $action)) {
            $this->errors[] = $this->module->l('Something went wrong while adding the Gift Card product. Please try again.', 'adminkbmembershipplansettingcontroller');
        } else {
            $free_membership_plan_obj->id_shop = $this->context->shop->id;
            if ($free_membership_plan_id == 0) {
                $free_membership_plan_obj->id_product = $mp_config['generated_product_id'];
            }
            $free_membership_plan_obj->plan_duration = $mp_config['kbmp_free_membership_plan_duration'];
            $free_membership_plan_obj->plan_duration_type = $mp_config['kbmp_free_membership_plan_duration_interval'];
            $free_membership_plan_obj->is_free = 1;
            $free_membership_plan_obj->is_enabled_product_limit = $mp_config['kbmp_enable_product_limit_free_membership_plan'];
            if ((int)$mp_config['kbmp_enable_product_limit_free_membership_plan'] == 1) {
                $free_membership_plan_obj->product_limit = $mp_config['kbmp_free_membership_product_limit'];
            } else {
                $free_membership_plan_obj->product_limit = 0;
            }
            if ($free_membership_plan_id == 0) {
                $free_membership_plan_obj->position = $this->getNextAvailablePosition();
            }
            $free_membership_plan_obj->active = $mp_config['kbmp_free_membership_plan'];
            if (!$free_membership_plan_obj->save()) {
                $this->errors[] = $this->module->l('Something went wrong while adding the Gift Card product. Please try again.', 'adminkbmembershipplansettingcontroller');
            }
        }
    }
    
    // Function to find the next available position for a particualr image
    public static function getNextAvailablePosition()
    {
        $sql = 'SELECT MAX(position) as max_pos from ' . _DB_PREFIX_ . 'kbmp_membership_plan';
        $max_pos = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        if ((!isset($max_pos) && $max_pos != 0 && empty($max_pos)) || $max_pos == null) {
            $max_pos = 0;
            return ($max_pos);
        }
        return ($max_pos + 1);
    }
    
    /*
     * Function for creating/updating a customizable product in the store when a Gift Card product is being added/updated
     */
    private function addUpdateProduct(&$product_data, $action = 'add')
    {
        if ($action == 'add') {
            $pro_object = new Product();
            $pro_object->id_manufacturer = 0;
            foreach ($this->getAllLanguages() as $lang) {
                $pro_object->name[$lang['id_lang']] = $product_data['product_name'][$lang['id_lang']];
                $pro_object->link_rewrite[$lang['id_lang']] = $this->convertProductNametoLinkRewrite($product_data['product_name'][$lang['id_lang']]);
            }
            $pro_object->quantity = 999;
            $pro_object->price = 0;
            $pro_object->specificPrice = 0;
            $pro_object->wholesale_price = 0;
            $pro_object->on_sale = 0;
            $pro_object->online_only = 0;
            $pro_object->unity = '1';
            $pro_object->unit_price = 0.00;
            $pro_object->unit_price_ratio = 0;
            $pro_object->ecotax = 0;
            $pro_object->visibility = 'none';
//            $pro_object->active = $product_data['kbmp_free_membership_plan'];
            $pro_object->active = 1;
            $pro_object->quantity_discount = 0;
            $pro_object->out_of_stock = 1;
            $pro_object->redirect_type = '404';
            $pro_object->id_tax_rules_group = 0;
            $pro_object->depends_on_stock = false;
            $pro_object->is_virtual = 1;
            if ($pro_object->add()) {
                $pro_object->updateCategories(array((int)Configuration::get('PS_HOME_CATEGORY')));
                $pro_object->id_category_default = (int) Configuration::get('PS_HOME_CATEGORY');
                StockAvailable::setQuantity(
                    $pro_object->id,
                    0,
                    999,
                    (int) $this->context->shop->id
                );
                StockAvailable::setProductOutOfStock(
                    (int) $pro_object->id,
                    $pro_object->out_of_stock,
                    $this->context->shop->id
                );
                if (!$this->addUpdateMembershipImagetoProduct((int) $pro_object->id)) {
                    $this->error_flag = true;
                    $this->errors[] = $this->module->l('An error occurred while adding the default product image.', 'adminkbmembershipplansettingcontroller');
                }
                if (!$this->error_flag) {
                    $pro_object->save();
                    $product_data['generated_product_id'] = $pro_object->id;
                    return true;
                } else {
                    return false;
                }
            } else {
                $this->errors[] = $this->module->l('An error occurred while adding the Free Membership plan.', 'adminkbmembershipplansettingcontroller');
                return false;
            }
        } elseif ($action == 'update') {
            $pro_object = new Product($product_data['id_product']);
            foreach ($this->getAllLanguages() as $lang) {
                $pro_object->name[$lang['id_lang']] = $product_data['product_name'][$lang['id_lang']];
                $pro_object->link_rewrite[$lang['id_lang']] = $this->convertProductNametoLinkRewrite($product_data['product_name'][$lang['id_lang']]);
            }
            $pro_object->quantity = 999;
            $pro_object->price = 0;
            $pro_object->active = $product_data['kbmp_free_membership_plan'];
            StockAvailable::setQuantity(
                $pro_object->id,
                0,
                999,
                (int) $this->context->shop->id
            );
            if (!$this->addUpdateMembershipImagetoProduct((int) $pro_object->id, $action)) {
                $this->error_flag = true;
                $this->errors[] = $this->module->l('An error occurred while adding the default product image.', 'adminkbmembershipplansettingcontroller');
            }
            if (!$this->error_flag) {
                $pro_object->save();
                return true;
            } else {
                $this->errors[] = $this->module->l('An error occurred while updating the Gift Card product.', 'adminkbmembershipplansettingcontroller');
                return false;
            }
        }
    }
    
    /*
     * Function for unaccenting the product name so that it can be converted to a URL for link_rewrite field
     */
    private function unaccentProductName($string)
    {
        if (strpos($string = htmlentities($string, ENT_QUOTES, 'UTF-8'), '&') !== false) {
            $preg_replaced = preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i', '$1', $string);
            $string = html_entity_decode($preg_replaced, ENT_QUOTES, 'UTF-8');
        }
        return $string;
    }
    
    /*
     * Function for converting the product name to URL for link_rewrite field
     */
    private function convertProductNametoLinkRewrite($string, $slug = '-', $extra = null)
    {
        $unaccented_name = $this->unaccentProductName($string);
        $preg_quote = preg_quote($extra, '~');
        $preg_replaced = preg_replace('~[^0-9a-z' . $preg_quote . ']+~i', $slug, $unaccented_name);
        $trimmed_name = trim($preg_replaced, $slug);
        return Tools::strtolower($trimmed_name);
    }
    
    /**
     * Duplicate of AdminImportController::get_best_path()
     * Duplicated since the main function is protected and it cannot be called directly in this class
     */
    private function getBestPath($tgt_width, $tgt_height, $path_infos)
    {
        $path_infos = array_reverse($path_infos);
        $path = '';
        foreach ($path_infos as $path_info) {
            list($width, $height, $path) = $path_info;
            if ($width >= $tgt_width && $height >= $tgt_height) {
                return $path;
            }
        }
        return $path;
    }

    public function getDefaultMembershipPlanImageURL()
    {
        return $plan_image = $this->getBaseDirUrl().'/modules/'. $this->module->name . '/views/img/plan_sample.jpg';
    }
    
    private function addUpdateMembershipImagetoProduct($id_product, $action = 'add')
    {
        $image_url = $this->getDefaultMembershipPlanImageURL();
        $images = Image::getImages($this->context->language->id, (int)$id_product);
        if (count($images) > 0) {
            foreach ($images as $image_key => $image) {
                $image = new Image((int)$image['id_image']);
                $image->delete();
            }
        }
        
        $image_url = trim($image_url);
        $product_has_images = (bool)Image::getImages($this->context->language->id, $id_product);

        $image = new Image();
        $image->id_product = (int)$id_product;
        $image->position = Image::getHighestPosition($id_product) + 1;
        $image->cover = (!$product_has_images) ? true : false;

        $field_error = $image->validateFields(false, true);
        $lang_field_error = $image->validateFieldsLang(false, true);

        if ($field_error === true && $lang_field_error === true && $image->add()) {
            $image->associateTo((int) $this->context->shop->id);
            if (!$this->copyImg($id_product, $image->id, $image_url, 'products')) {
                $this->errors[] = $this->module->l('An error occurred while adding Free Membership plan image.', 'adminkbmembershipplansettingcontroller');
                $image->delete();
                return false;
            } else {
                return true;
            }
        } else {
            $this->errors[] = $this->module->l('An error occurred while adding Free Membership plan product image.', 'adminkbmembershipplansettingcontroller');
            return false;
        }
    }
    
    /**
     * Duplicate of AdminImportController::copyImg()
     * Duplicated since the main function is protected and it cannot be called directly in this class
     */
    private function copyImg($id_entity, $id_image, $url, $entity = 'products', $regenerate = true)
    {
        $tmpfile = tempnam(_PS_TMP_IMG_DIR_, 'ps_import');
        $watermark_types = explode(',', Configuration::get('WATERMARK_TYPES'));

        switch ($entity) {
            default:
            case 'products':
                $image_obj = new Image($id_image);
                $path = $image_obj->getPathForCreation();
                break;
            case 'categories':
                $path = _PS_CAT_IMG_DIR_.(int)$id_entity;
                break;
            case 'manufacturers':
                $path = _PS_MANU_IMG_DIR_.(int)$id_entity;
                break;
            case 'suppliers':
                $path = _PS_SUPP_IMG_DIR_.(int)$id_entity;
                break;
        }

        $url = urldecode(trim($url));
        $parced_url = parse_url($url);

        if (isset($parced_url['path'])) {
            $uri = ltrim($parced_url['path'], '/');
            $parts = explode('/', $uri);
            foreach ($parts as &$part) {
                $part = rawurlencode($part);
            }
            unset($part);
            $parced_url['path'] = '/'.implode('/', $parts);
        }

        if (isset($parced_url['query'])) {
            $query_parts = array();
            parse_str($parced_url['query'], $query_parts);
            $parced_url['query'] = http_build_query($query_parts);
        }

        if (!function_exists('http_build_url')) {
            require_once($this->getKbModuleDir().'libraries/http_build_url/http_build_url.php');
        }
        
        /*
         * Already included the libary file
         */
        $url = http_build_url('', $parced_url);

        $orig_tmpfile = $tmpfile;

        if (Tools::copy($url, $tmpfile)) {
            // Evaluate the memory required to resize the image: if it's too much, you can't resize it.
            if (!ImageManager::checkImageMemoryLimit($tmpfile)) {
                @unlink($tmpfile);
                return false;
            }

            $tgt_width = $tgt_height = 0;
            $src_width = $src_height = 0;
            $error = 0;
            ImageManager::resize(
                $tmpfile,
                $path.'.jpg',
                null,
                null,
                'jpg',
                false,
                $error,
                $tgt_width,
                $tgt_height,
                5,
                $src_width,
                $src_height
            );
            $images_types = ImageType::getImagesTypes($entity, true);

            if ($regenerate) {
                $path_infos = array();
                $path_infos[] = array($tgt_width, $tgt_height, $path.'.jpg');
                foreach ($images_types as $image_type) {
                    $tmpfile = self::getBestPath($image_type['width'], $image_type['height'], $path_infos);

                    if (ImageManager::resize($tmpfile, $path.'-'.Tools::stripslashes($image_type['name']).'.jpg', $image_type['width'], $image_type['height'], 'jpg', false, $error, $tgt_width, $tgt_height, 5, $src_width, $src_height)) {
                        // the last image should not be added in the candidate list if it's bigger than the original image
                        if ($tgt_width <= $src_width && $tgt_height <= $src_height) {
                            $path_infos[] = array($tgt_width, $tgt_height, $path.'-'.Tools::stripslashes($image_type['name']).'.jpg');
                        }
                        if ($entity == 'products') {
                            if (is_file(_PS_TMP_IMG_DIR_.'product_mini_'.(int)$id_entity.'.jpg')) {
                                unlink(_PS_TMP_IMG_DIR_.'product_mini_'.(int)$id_entity.'.jpg');
                            }
                            if (is_file(_PS_TMP_IMG_DIR_.'product_mini_'.(int)$id_entity.'_'.(int)Context::getContext()->shop->id.'.jpg')) {
                                unlink(_PS_TMP_IMG_DIR_.'product_mini_'.(int)$id_entity.'_'.(int)Context::getContext()->shop->id.'.jpg');
                            }
                        }
                    }
                    if (in_array($image_type['id_image_type'], $watermark_types)) {
                        Hook::exec('actionWatermark', array('id_image' => $id_image, 'id_product' => $id_entity));
                    }
                }
            }
        } else {
            @unlink($orig_tmpfile);
            return false;
        }
        unlink($orig_tmpfile);
        return true;
    }
    
    /*
     * Function for returning all the languages in the system
     */
    public function getAllLanguages()
    {
        return Language::getLanguages(false);
    }
    
    public function getFieldsValue($obj)
    {
        unset($obj);

        if (!Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING') ||
            Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING') == '') {
            $settings = KbGlobal::getDefaultMemberShipPlanSettings();
        } else {
            $settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
            
            if (Configuration::get('kbmp_mark_inactive_already_active')) {
                $settings['kbmp_mark_inactive_already_active'] = Configuration::get('kbmp_mark_inactive_already_active');
            } else {
                $settings['kbmp_mark_inactive_already_active'] = 0;
            }
            
            if (Configuration::get('kbmp_product_activation_duration')) {
                $settings['kbmp_product_activation_duration'] = Configuration::get('kbmp_product_activation_duration');
            } else {
                $settings['kbmp_product_activation_duration'] = 7;
            }
            
            if (Configuration::get('kbmp_seller_rebate_email')) {
                $settings['kbmp_seller_rebate_email'] = Tools::unSerialize(Configuration::get('kbmp_seller_rebate_email'));
            } else {
                $settings['kbmp_seller_rebate_email'] = array();
            }
            
            if (Configuration::get('kbmp_membership_start_email')) {
                $settings['kbmp_membership_start_email'] = Tools::unSerialize(Configuration::get('kbmp_membership_start_email'));
            } else {
                $settings['kbmp_membership_start_email'] = array();
            }
//            if (Configuration::get('kbmp_membership_warning_email')) {
//                $settings['kbmp_membership_warning_email'] = Tools::unSerialize(Configuration::get('kbmp_membership_warning_email'));
//            } else {
//                $settings['kbmp_membership_warning_email'] = array();
//            }
            if (Configuration::get('kbmp_membership_expired_email')) {
                $settings['kbmp_membership_expired_email'] = Tools::unSerialize(Configuration::get('kbmp_membership_expired_email'));
            } else {
                $settings['kbmp_membership_expired_email'] = array();
            }
        }
        
        $free_membership_plan_id = KbMpMemberShipPlan::getFreeMembershipPlanID();
        if ($free_membership_plan_id) {
            $free_membership_plan_obj = new KbMpMemberShipPlan((int) $free_membership_plan_id);
            $settings['kbmp_free_membership_plan'] = $free_membership_plan_obj->active;
        }
        
        if (isset($settings['kbmp_product_deactivation_email'])) {
            foreach ($settings['kbmp_product_deactivation_email'] as $key => $template_lang) {
                if ($template_lang == '') {
                    unset($template_lang);
                    $settings['kbmp_product_deactivation_email'][$key] = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->kb_module_name . "/views/templates/admin/email/kbmp_product_deactivation_email.html");
                    $this->displayWarning(
                        $this->module->l('Please save the setting once, before using the module.', 'adminkbmembershipplansettingcontroller')
                    );
                }
            }
        }
        if (isset($settings['kbmp_seller_rebate_email'])) {
            foreach ($settings['kbmp_seller_rebate_email'] as $key => $template_lang) {
                if ($template_lang == '') {
                    unset($template_lang);
                    $settings['kbmp_seller_rebate_email'][$key] = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->kb_module_name . "/views/templates/admin/email/kbmp_seller_rebate_email.html");
                    $this->displayWarning(
                        $this->module->l('Please save the setting once, before using the module.', 'adminkbmembershipplansettingcontroller')
                    );
                }
            }
        }
        
        
        if (isset($settings['kbmp_membership_start_email'])) {
            foreach ($settings['kbmp_membership_start_email'] as $key => $template_lang) {
                if ($template_lang == '') {
                    unset($template_lang);
                    $settings['kbmp_membership_start_email'][$key] = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->kb_module_name . "/views/templates/admin/email/membership_plan_activation_email.html");
                    $this->displayWarning(
                        $this->module->l('Please save the setting once, before using the module.', 'adminkbmembershipplansettingcontroller')
                    );
                }
            }
        }
        
//        if (isset($settings['kbmp_membership_warning_email'])) {
//            foreach ($settings['kbmp_membership_warning_email'] as $key => $template_lang) {
//                if ($template_lang == '') {
//                    unset($template_lang);
//                    $settings['kbmp_membership_warning_email'][$key] = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->kb_module_name . "/views/templates/admin/email/membership_plan_warning_email.html");
//                    $this->displayWarning(
//                        $this->module->l('Please save the setting once, before using the module.', 'adminkbmembershipplansettingcontroller')
//                    );
//                }
//            }
//        }
        if (isset($settings['kbmp_membership_expired_email'])) {
            foreach ($settings['kbmp_membership_expired_email'] as $key => $template_lang) {
                if ($template_lang == '') {
                    unset($template_lang);
                    $settings['kbmp_membership_expired_email'][$key] = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->kb_module_name . "/views/templates/admin/email/membership_plan_expiry_email.html");
                    $this->displayWarning(
                        $this->module->l('Please save the setting once, before using the module.', 'adminkbmembershipplansettingcontroller')
                    );
                }
            }
        }

        $order_available_status_setting_field_name = 'order_available_statuses[]';
        /* changes over */

        foreach ($this->fields_form[0]['form']['input'] as $fieldset) {
            if (isset($fieldset['lang']) && $fieldset['lang']) {
                $lang_data = array();
                $saved_data = array();
                if (!empty($settings[$fieldset['name']])) {
                    $saved_data = $settings[$fieldset['name']];
                }
                foreach ($this->_languages as $language) {
                    $lang_data[$language['id_lang']] = '';
                    if (Tools::getIsset($fieldset['name']
                            . '_' . $language['id_lang'])) {
                        $lang_data[$language['id_lang']] = Tools::getValue($fieldset['name'] . '_' . $language['id_lang']);
                    } elseif (isset($saved_data[$language['id_lang']])) {
                        $lang_data[$language['id_lang']] = Tools::htmlentitiesDecodeUTF8(
                            $saved_data[$language['id_lang']]
                        );
                    } else {
                        if ($fieldset['name'] == 'kbmp_membership_start_email') {
                            $lang_data[$language['id_lang']] = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->kb_module_name . "/views/templates/admin/email/membership_plan_activation_email.html");
                        } elseif ($fieldset['name'] == 'kbmp_membership_expired_email') {
                            $lang_data[$language['id_lang']] = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->kb_module_name . "/views/templates/admin/email/membership_plan_expiry_email.html");
                        } elseif ($fieldset['name'] == 'kbmp_seller_rebate_email') {
                            $lang_data[$language['id_lang']] = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->kb_module_name . "/views/templates/admin/email/kbmp_seller_rebate_email.html");
                        } elseif ($fieldset['name'] == 'kbmp_product_deactivation_email') {
                            $lang_data[$language['id_lang']] = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->kb_module_name . "/views/templates/admin/email/kbmp_product_deactivation_email.html");
                        } else {
                            $lang_data[$language['id_lang']] = '';
                        }
                    }
                }
                $this->fields_value[$fieldset['name']] = $lang_data;
            } elseif (Tools::getIsset($fieldset['name'])) {
                if ($fieldset['type'] && isset($fieldset['multiple']) && $fieldset['multiple']) {
                    $this->fields_value[$fieldset['name']] = Tools::getValue('selectItem' . $fieldset['name']);
                } else {
                    $this->fields_value[$fieldset['name']] = Tools::getValue($fieldset['name']);
                }
            } else {
                if ($fieldset['type'] == 'select') {
                    if (isset($fieldset['multiple']) && $fieldset['multiple']) {
                        if ($fieldset['name']) {
                            $fieldset['name'] == 'kbmp_membership_plan_order_statuses';
                            $this->fields_value[$fieldset['name']] = (array) $settings['kbmp_membership_plan_order_statuses'];
                        } else {
                            $this->fields_value[$fieldset['name']] = array();
                        }
                    } else {
                        $this->fields_value[$fieldset['name']] = $settings[$fieldset['name']];
                    }
                } else {
                    if (isset($settings[$fieldset['name']])) {
                        $this->fields_value[$fieldset['name']] = $settings[$fieldset['name']];
                    } else {
                        $this->fields_value[$fieldset['name']] = '';
                    }
                }
            }
        }
        return $this->fields_value;
    }

    private function getBaseDirUrl()
    {
        $module_dir = '';
        if ($this->checkSecureUrl()) {
            $module_dir = _PS_BASE_URL_SSL_.__PS_BASE_URI__;
        } else {
            $module_dir = _PS_BASE_URL_.__PS_BASE_URI__;
        }
        return $module_dir;
    }
    
    private function checkSecureUrl()
    {
        $custom_ssl_var = 0;

        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS'] == 'on') {
                $custom_ssl_var = 1;
            }
        } else if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $custom_ssl_var = 1;
        }
        if ((bool) Configuration::get('PS_SSL_ENABLED') && $custom_ssl_var == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    public function sendMembershipPlanActivationDeactivationEmail()
    {
        $email_type = 1;
        if (Configuration::get('kbmp_mark_inactive_already_active')) {
            $email_order_template_array = Tools::unSerialize(Configuration::get('kbmp_product_deactivation_email'));
            $subject = $this->module->l('Important Info Regarding your Seller account', 'adminkbmembershipplansettingcontroller');
            $email_type = 1;
        } else {
            $duration_days = (int) Configuration::get('kbmp_product_activation_duration');
            $duration_days -= 1;
            $rebate_last_date = date('Y-m-d', strtotime('+' . $duration_days . 'days'));
            $email_order_template_array = Tools::unSerialize(Configuration::get('kbmp_seller_rebate_email'));
            $subject = $this->module->l('Important Info Regarding your Seller account', 'adminkbmembershipplansettingcontroller');
            $email_type = 2;
        }
        
        $sellers = KbSeller::getAllSellers();
        
        
        if (is_array($sellers) && count($sellers) > 0) {
            foreach ($sellers as $seller_key => $seller_data) {
                $sellerObj = new KbSeller($seller_data['id_seller']);
                $seller_info = $sellerObj->getSellerInfo();
                $plan_page_link = $this->context->link->getModuleLink(
                    $this->module->name,
                    'membershipplans',
                    array(),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                );
                
                if (is_numeric($seller_info['id_shop']) && $seller_info['id_shop']) {
                    $shop = new Shop((int) $seller_info['id_shop']);
                }
                
                $email_order_template = $email_order_template_array[$sellerObj->id_default_lang];
                if ($email_type == 1) {
                    $data = array(
                        '{shop_name}' => Tools::safeOutput($shop->name),
                        '{SHOP_NAME}' => Tools::safeOutput($shop->name),
                        '{seller_name}' => $seller_info['seller_name'],
                        '{plan_link}' => $plan_page_link
                    );
                    KbMemberShipPlanOrder::addSellerProductInTrackingTable($seller_data['id_seller']);
                } else {
                    $data = array(
                        '{shop_name}' => Tools::safeOutput($shop->name),
                        '{SHOP_NAME}' => Tools::safeOutput($shop->name),
                        '{seller_name}' => $seller_info['seller_name'],
                        '{last_date}' => Tools::displayDate($rebate_last_date, $sellerObj->id_default_lang, false),
                        '{plan_link}' => $plan_page_link
                    );
                    KbSeller::addExistingSellerInTrackingList($seller_data['id_seller']);
                }

                foreach ($data as $variable => $variable_val) {
                    $email_order_template = str_replace($variable, $variable_val, $email_order_template);
                }
                $notification_emails = $sellerObj->getEmailIdForNotification();
                foreach ($notification_emails as $em) {
                    Mail::Send(
                        (int) $sellerObj->id_default_lang,
                        'kb_membership_mail',
                        $subject,
                        array('{membership_data}' => $email_order_template),
                        $em['email'],
                        $em['title'],
                        null,
                        null,
                        null,
                        null,
                        _PS_MODULE_DIR_ . 'kbmarketplace/mails/',
                        false,
                        (int) $seller_info['id_shop']
                    );
                }
            }
        }
    }
}
