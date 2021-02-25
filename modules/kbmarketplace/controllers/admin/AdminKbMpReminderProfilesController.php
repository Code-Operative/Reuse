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
 *
*/

include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/ReminderProfile.php');

class AdminKbMpReminderProfilesController extends ModuleAdminController
{
    protected $kb_module_name = 'kbmarketplace';
    public function __construct()
    {
        $this->bootstrap = true;
        $this->allow_export = true;
        $this->context = Context::getContext();
        $this->list_no_link = true;
        $this->className = 'ReminderProfile';
        $this->kb_smarty = new Smarty();
        $this->kb_smarty->registerPlugin('function', 'l', 'smartyTranslate');
        $this->kb_smarty->setTemplateDir(_PS_MODULE_DIR_ . $this->kb_module_name . '/views/templates/admin/');
        $this->table = 'kb_membership_reminder_profile';
        $this->identifier = 'id_kb_membership_reminder_profile';
        $this->lang = false;
        $this->display = 'list';
        parent::__construct();

        $this->toolbar_title = $this->module->l('Membership Plan Warning Reminders.', 'AdminKbMpReminderProfilesController');

        if (Tools::getValue('id_kb_membership_reminder_profile')) {
            $this->toolbar_title = $this->module->l('Edit Warning Reminders.', 'AdminKbMpReminderProfilesController');
        } elseif (Tools::isSubmit('add' . $this->table)) {
            $this->toolbar_title = $this->module->l('Add Warning Reminders.', 'AdminKbMpReminderProfilesController');
        } else {
            $this->toolbar_title = $this->module->l('Membership Plan Warning Reminders', 'AdminKbMpReminderProfilesController');
        }

        $this->fields_list = array(
            'id_kb_membership_reminder_profile' => array(
                'title' => $this->module->l('ID', 'AdminKbMpReminderProfilesController'),
                'search' => false,
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'no_of_days' => array(
                'title' => $this->module->l('Days', 'AdminKbMpReminderProfilesController'),
                'align' => 'text-center',
                'search' => true,
            ),
            'active' => array(
                'title' => $this->module->l('Active', 'AdminKbMpReminderProfilesController'),
                'align' => 'text-center',
                'type' => 'select',
                'filter_key' => 'active',
                'list' => array('1' => $this->module->l('Enable', 'AdminKbMpReminderProfilesController'), '0' => $this->module->l('Disable', 'AdminKbMpReminderProfilesController')),
                'active' => 'status',
                'search' => true
            ),
            'date_add' => array(
                'title' => $this->module->l('Date Added', 'AdminKbMpReminderProfilesController'),
                'align' => 'text-center',
                'type' => 'datetime',
                'search' => true
            )
        );
        $this->bulk_actions = array(
            $this->module->l('delete', 'AdminKbMpReminderProfilesController') => array(
                'text' => $this->module->l('Delete selected', 'AdminKbMpReminderProfilesController'),
                'confirm' => $this->module->l('Delete selected testimonial(s)?', 'AdminKbMpReminderProfilesController'),
                'icon' => 'icon-trash'
            )
        );
        $this->_join = "INNER JOIN " . _DB_PREFIX_ . "kb_membership_reminder_profile_templates rpt ON "
                . " a.id_kb_membership_reminder_profile = rpt.id_kb_membership_reminder_profile AND rpt.id_shop = '" . (int) $this->context->shop->id . "' AND rpt.id_lang = ".(int) $this->context->language->id ;
        $this->_where = ' and a.reminder_type = "warning"';
        $this->addRowAction('edit');
        $this->addRowAction('delete');
    }
     /*
     * Default Function (Used here to handle adding a new REMINDER PROFILE)
     * Default admin controller function to add
     */
    public function processAdd()
    {
        if (Tools::isSubmit('submitAdd' . $this->table)) {
            $language = Language::getLanguages(false);
            $this->obj = new ReminderProfile();
            $this->obj->active = Tools::getValue('active');
            $this->obj->reminder_type = 'warning';
            $this->obj->no_of_days = Tools::getValue('no_of_days');
            $this->obj->date_updated = date('Y-m-d H:i:s');
            //Save added data
            $this->obj->save();
            $reminder_profile_id = $this->obj->id;
            foreach ($language as $lang) {
                $email_subject = Tools::getValue(
                    'REMINDER_EMAIL_SUBJECT_' . $lang['id_lang']
                );
                $email_template = Tools::getValue(
                    'REMINDER_EMAIL_TEMP_' . $lang['id_lang']
                );
                $body = $email_template;
                $text_content = strip_tags($email_template);
                $sql = "INSERT INTO " . _DB_PREFIX_ . "kb_membership_reminder_profile_templates VALUES('','" . (int) $reminder_profile_id . "','" . (int) $lang['id_lang'] . "',"
                        . " '" . (int) $this->context->shop->id . "','" . pSQL($lang['iso_code']) . "', 'reminder', '" . pSQL(Tools::htmlentitiesUTF8($text_content)) . "',"
                        . " '" . pSQL(Tools::htmlentitiesUTF8($email_subject)) . "', '" . pSQL(Tools::htmlentitiesUTF8($body)) . "', now(), now())";

                $res = Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
                if ($res) {
                    $this->context->cookie->__set(
                        'kb_redirect_success',
                        $this->module->l('Reminder Profile has been saved successfully.', 'AdminKbMpReminderProfilesController')
                    );
                } else {
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $this->module->l('Unable to save data. Technical Error', 'AdminKbMpReminderProfilesController')
                    );
                }
            }
        }
    }
    /*
     * Default Function (Used here to handle updating a REMINDER PROFILE)
     * Default function of admin controller for update
     */
    public function processUpdate()
    {
        if (Tools::isSubmit('submitAdd' . $this->table)) {
            $language = Language::getLanguages(false);
            $this->obj = $this->loadObject(Tools::getValue('id_kb_membership_reminder_profile'));
            $this->obj->active = Tools::getValue('active');
            $this->obj->no_of_days = Tools::getValue('no_of_days');
            $this->obj->date_updated = date('Y-m-d H:i:s');
            //Save added data
            $this->obj->save();
            $reminder_profile_id = $this->obj->id;
            foreach ($language as $lang) {
                $email_subject = Tools::getValue(
                    'REMINDER_EMAIL_SUBJECT_' . $lang['id_lang']
                );
                $email_template = Tools::getValue(
                    'REMINDER_EMAIL_TEMP_' . $lang['id_lang']
                );
                $body = $email_template;
                $text_content = strip_tags($email_template);
                $sql = "UPDATE " . _DB_PREFIX_ . "kb_membership_reminder_profile_templates SET  text_content = '" . pSQL(Tools::htmlentitiesUTF8($text_content)) . "',subject = "
                        . " '" . pSQL(Tools::htmlentitiesUTF8($email_subject)) . "',body = '" . pSQL(Tools::htmlentitiesUTF8($body)) . "', date_updated = now() WHERE id_kb_membership_reminder_profile = '" . (int) $reminder_profile_id . "' AND id_lang = '" . (int) $lang['id_lang'] . "'"
                        . " AND id_shop = '" . (int) $this->context->shop->id . "'";

                $res = Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
                if ($res) {
                    $this->context->cookie->__set(
                        'kb_redirect_success',
                        $this->module->l('Reminder Profile has been updated successfully.', 'AdminKbMpReminderProfilesController')
                    );
                } else {
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $this->module->l('Unable to update data. Technical Error.', 'AdminKbMpReminderProfilesController')
                    );
                }
            }
        }
    }
    /*
     * Delete process deleting email template of respective reminder profile
     * Default admin controller function for delete
     */
    public function processDelete()
    {
        if (Tools::isSubmit('delete' . $this->table)) {
            $reminder_profile_id = Tools::getValue('id_kb_membership_reminder_profile');
            $query = "DELETE FROM " . _DB_PREFIX_ . "kb_membership_reminder_profile WHERE id_kb_membership_reminder_profile = '" . (int) $reminder_profile_id . "'";
            Db::getInstance()->execute($query);
            $query = "DELETE FROM " . _DB_PREFIX_ . "kb_membership_reminder_profile_templates WHERE id_kb_membership_reminder_profile = '" . (int) $reminder_profile_id . "'";
            Db::getInstance()->execute($query);
            $this->context->cookie->__set(
                'kb_redirect_success',
                $this->module->l('Reminder Profile has been deleted successfully.', 'AdminKbMpReminderProfilesController')
            );
        }
    }
    /*
     * Default admin controller function for rendering form
     */
    public function renderForm()
    {
        if (!($obj = $this->loadObject(true))) {
            return;
        }
        $this->fields_form = array(
            'id_form' => 'kbrc_reminder_settings',
            'legend' => array(
                'title' => $this->module->l('Add Reminder Profiles', 'AdminKbMpReminderProfilesController'),
                'icon' => 'icon-envelope'
            ),
            'input' => array(
                array(
                    'label' => $this->module->l('Enable/Disable this Reminder', 'AdminKbMpReminderProfilesController'),
                    'type' => 'switch',
                    'name' => 'active',
                    'values' => array(
                        array(
                            'value' => 1,
                        ),
                        array(
                            'value' => 0,
                        ),
                    ),
                    'hint' => $this->module->l('Enable/Disable this Reminder', 'AdminKbMpReminderProfilesController'),
                ),
                array(
                    'label' => $this->module->l('Days (How many days before plan expiry warning mail should be sent to seller.)', 'AdminKbMpReminderProfilesController'),
                    'type' => 'text',
                    'required' => true,
                    'name' => 'no_of_days',
                    'hint' => $this->module->l('How many days before plan expiry warning mail should be sent to seller.', 'AdminKbMpReminderProfilesController'),
                    'suffix' => $this->module->l('Days', 'AdminKbMpReminderProfilesController'),
                    'col' => 2
                ),
                array(
                    'label' => $this->module->l('Email Subject', 'AdminKbMpReminderProfilesController'),
                    'type' => 'text',
                    'lang' => true,
                    'hint' => $this->module->l('Subject of email for reminder.', 'AdminKbMpReminderProfilesController'),
                    'name' => 'REMINDER_EMAIL_SUBJECT',
                    'required' => true,
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->module->l('Email Template', 'AdminKbMpReminderProfilesController'),
                    'hint' => $this->l('Content of email template which will be sent to customer as reminder', 'AdminKbMpReminderProfilesController'),
                    'name' => 'REMINDER_EMAIL_TEMP',
                    'required' => true,
                    'cols' => '2',
                    'rows' => '10',
                    'class' => 'col-lg-9',
                    'lang' => true,
                    'autoload_rte' => true,
                    'desc' => $this->module->l('Do not remove {shop_name}, {customer_name}, {product_content}, {shop_email} tags from this template.', 'AdminKbMpReminderProfilesController')
                ),
            ),
            'buttons' => array(
                array(
                    'title' => $this->module->l('Save', 'AdminKbMpReminderProfilesController'),
                    'type' => 'submit',
                    'icon' => 'process-icon-save',
                    'class' => 'pull-right kb_membership_reminder_profile_btn',
                    'id' => 'submit_add',
                    'name' => 'submitAdd' . $this->table,
                ),
            )
        );

        $this->fields_value = array(
            'active' => $obj->active,
            'no_of_days' => $obj->no_of_days,
        );
        
        if (Tools::getIsset('id_kb_membership_reminder_profile')) {
            $reminder_profile_id = Tools::getValue('id_kb_membership_reminder_profile');
            $language = Language::getLanguages(false);
            foreach ($language as $lang) {
                $sql = "SELECT * FROM " . _DB_PREFIX_ . "kb_membership_reminder_profile_templates WHERE id_kb_membership_reminder_profile = '" . (int) $reminder_profile_id . "'"
                        . " AND id_lang = '" . (int) $lang['id_lang'] . "'";
                $reminder_email_data = Db::getInstance()->getRow($sql);
                $this->fields_value['REMINDER_EMAIL_SUBJECT'][$lang['id_lang']] = Tools::htmlentitiesDecodeUTF8($reminder_email_data['subject']);
                $this->fields_value['REMINDER_EMAIL_TEMP'][$lang['id_lang']] = Tools::htmlentitiesDecodeUTF8($reminder_email_data['body']);
            }
        } else {
            $language = Language::getLanguages(false);
            foreach ($language as $lang) {
                $this->fields_value['REMINDER_EMAIL_SUBJECT'][$lang['id_lang']] = $this->module->l('Your Membership Plan is about to expire', 'AdminKbMpReminderProfiles');
                $this->fields_value['REMINDER_EMAIL_TEMP'][$lang['id_lang']] = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->kb_module_name . "/views/templates/admin/email/membership_plan_warning_email.html");
            }
        }
        return parent::renderForm();
    }
    /*
     * Default function, used here to set required smarty variables
     */
    public function initContent()
    {
        /*
         * changes by rishabh jain for multiple tabs
         */
        $link_reminder = $this->context->link->getAdminLink('AdminKbMpReminderProfiles', true);
        $general_setting = $this->context->link->getAdminLink('AdminKbMembershipPlanSetting', true);
        $default_link = $this->context->link->getAdminLink('AdminModules', true).'&configure='.urlencode($this->module->name).'&tab_module='.$this->module->tab.'&module_name='.urlencode($this->module->name);
        $link_expiry = $this->context->link->getAdminLink('AdminKbMpExpiryProfiles', true);
        
        $this->context->smarty->assign('admin_configure_controller', $default_link);
        $this->context->smarty->assign('reminder_profile_link', $link_reminder);
        
        $this->context->smarty->assign('expiry_profile_link', $link_expiry);
        
        $this->context->smarty->assign('general_setting', $general_setting);
        $this->context->smarty->assign('method', '');
        $this->context->smarty->assign('selected_nav', 'reminder');
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
        /*
         * changes over
         */
        
        if (isset($this->context->cookie->kb_redirect_error)) {
            $this->errors[] = $this->context->cookie->kb_redirect_error;
            unset($this->context->cookie->kb_redirect_error);
        }

        if (isset($this->context->cookie->kb_redirect_success)) {
            $this->confirmations[] = $this->context->cookie->kb_redirect_success;
            unset($this->context->cookie->kb_redirect_success);
        }
        parent::initContent();
    }
    /*
     * Function for returning the absolute path of the module directory
     */
    protected function getKbModuleDir()
    {
        return _PS_MODULE_DIR_.$this->kb_module_name.'/';
    }
    /*
     * Default function, used here to include JS/CSS files for the module.
     */
    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addCSS($this->getKbModuleDir() . 'views/css/admin/kbrc_admin.css');
        $this->addJS($this->getKbModuleDir() . 'views/js/admin/kbrc_admin.js');
        $this->addJS($this->getKbModuleDir() . 'views/js/front/velovalidation.js');
    }
     /*
     * Function to add back and audit log link on top toolbar
     */
    public function initPageHeaderToolbar()
    {
        $this->page_header_toolbar_btn['back_url'] = array(
            'href' => 'javascript: window.history.back();',
            'desc' => $this->module->l('Back', 'AdminKbMpReminderProfiles'),
            'icon' => 'process-icon-back'
        );
        $this->page_header_toolbar_btn['new_template'] = array(
            'href' => self::$currentIndex . '&add' . $this->table . '&token=' . $this->token,
            'desc' => $this->module->l('Add new', 'AdminKbMpReminderProfiles'),
            'icon' => 'process-icon-new'
        );
        parent::initPageHeaderToolbar();
    }
}
