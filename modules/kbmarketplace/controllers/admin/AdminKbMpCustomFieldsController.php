<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store.
 *
 * @author    knowband.com <support@knowband.com>
 * @copyright 2017 knowband
 * @license   see file: LICENSE.txt
 * @category  PrestaShop Module
 */

include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/KbMpCustomFields.php');
include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/KbMpCustomFieldSellerMapping.php');

class AdminKbMpCustomFieldsController extends ModuleAdminController
{
    public $kb_smarty;
    public $all_languages = array();
    protected $kb_module_name = 'kbmarketplace';
    protected $sectionArray = array();
    
    public function __construct()
    {
        $this->bootstrap = true;
        $this->allow_export = true;
        $this->context = Context::getContext();
        $this->list_no_link = true;
        $this->kb_smarty = new Smarty();
        $this->kb_smarty->registerPlugin('function', 'l', 'smartyTranslate');
        $this->kb_smarty->setTemplateDir(_PS_MODULE_DIR_.$this->kb_module_name.'/views/templates/admin/');

        $this->all_languages = $this->getAllLanguages();
        $this->table = 'kb_mp_custom_fields';
        $this->className = 'KbMpCustomFields';
        $this->identifier = 'id_field';
        $this->lang = false;
        $this->display = 'list';
        parent::__construct();
        
        if (Tools::getValue('id_field')) {
            $this->toolbar_title = $this->module->l('Edit Seller Profile Form Custom Field', 'AdminKbMpCustomFieldsController');
        } elseif (Tools::isSubmit('addkb_mp_custom_fields')) {
            $this->toolbar_title = $this->module->l('Add Seller Profile Form Custom Field', 'AdminKbMpCustomFieldsController');
        } else {
            $this->toolbar_title = $this->module->l('Seller Profile Form Custom Fields', 'AdminKbMpCustomFieldsController');
        }
        
        $this->sectionArray[1] = $this->module->l('General Information Tab', 'AdminKbMpCustomFieldsController');
        $this->sectionArray[2] = $this->module->l('Meta Information Tab', 'AdminKbMpCustomFieldsController');
        $this->sectionArray[3] = $this->module->l('Policy Tab', 'AdminKbMpCustomFieldsController');
        $this->sectionArray[4] = $this->module->l('Payout Tab', 'AdminKbMpCustomFieldsController');
        $this->fields_list = array(
            'id_field' => array(
                'title' => $this->module->l('ID', 'AdminKbMpCustomFieldsController'),
                'search' => true,
                'align' => 'text-center',
//                'class' => 'fixed-width-xs'
            ),
            'label' => array(
                'title' => $this->module->l('Label', 'AdminKbMpCustomFieldsController'),
                'search' => true,
                'align' => 'text-center',
//                'class' => 'fixed-width-xs'
            ),
            'type' => array(
                'title' => $this->module->l('Input Type', 'AdminKbMpCustomFieldsController'),
                'search' => true,
                'align' => 'text-center',
//                'class' => 'fixed-width-xs'
            ),
            'id_section' => array(
                'title' => $this->module->l('Section', 'AdminKbMpCustomFieldsController'),
                'search' => true,
                'type' => 'select',
                'align' => 'text-center',
                'filter_key' => 'a!id_section',
                'callback' => 'getkbSectionname',
                'list' => $this->sectionArray
//                'class' => 'fixed-width-xs'
            ),
            'active' => array(
                'title' => $this->module->l('Status', 'AdminKbMpCustomFieldsController'),
                'align' => 'text-center',
                'active' => 'active',
                'type' => 'bool',
                'order_key' => 'status',
                'search' => true
            ),
            'date_upd' => array(
                'title' => $this->l('Last Update', 'AdminKbMpCustomFieldsController'),
                'type' => 'date',
//                'align' => 'text-right'
            )
        );
        $this->_select = 'c.*';
        $this->_join = 'INNER JOIN `' . _DB_PREFIX_ . 'kb_mp_custom_fields_lang` c ON (a.id_field = c.id_field AND c.id_lang='.$this->context->language->id.')';
        $this->_use_found_rows = false;
        $this->addRowAction('edit');
        $this->addRowAction('delete');
    }
    
    /**
    * Function used to display section name in the list
    */
    public function getkbSectionname($echo, $tr)
    {
         return $this->sectionArray[$echo];
    }
    
    /**
     * Function used to render the form for this controller
     *
     * @return string
     * @throws Exception
     * @throws SmartyException
     */
    public function renderForm()
    {
        $this->table = 'kb_mp_custom_fields';
        $this->className = 'KbMpCustomFields';
        
        if (Tools::getValue('id_template')) {
            $template_action = $this->module->l('Edit', 'AdminKbMpCustomFieldsController');
        } else {
            $template_action = $this->module->l('Add', 'AdminKbMpCustomFieldsController');
        }
        $customizable = false;
        $tpl = $this->kb_smarty->createTemplate('kb_field_form.tpl');
        
        $tpl->assign(array(
            'kb_form_contents' => $this->getAddFieldForm(),
            'edit_field_form' => (Tools::getValue('id_field') && Tools::getIsset('updatekb_mp_custom_fields')) ? 1 : 0,
            'template_action' => $template_action,
            'customizable' => $customizable,
            'moduledir_url' => $this->getModuleDirUrl(),
            'allowed_field_type' => $this->getAllowedFieldType(),
        ));

        return $tpl->fetch().parent::renderForm();
    }
    
    /**
    * Function used to display add field form
    */
    protected function getAddFieldForm()
    {
        $this->table = 'kb_mp_custom_fields';
        $this->className = 'KbMpCustomFields';
        $tpl_vars = array();
        $object = new KbMpCustomFields(Tools::getValue('id_field'));
        if ((Tools::getValue('id_field') != '') && Tools::getIsset('updatekb_mp_custom_fields')) {
            $submit_btn = 'update_submit_kb_custom';
        } else {
            $submit_btn = 'add_submit_kb_custom';
        }
        $availablesectionArray = array();
        foreach ($this->sectionArray as $key => $label) {
            $availablesectionArray[] = array(
                'id_section' => $key,
                'label' => $label
            );
        }
//        d($object);
        $this->fields_form = array(
            'form' => array(
                'id_form' => 'kb_mp_add_custom_field',
                'legend' => array(
                    'title' => $this->l('Add/Update Seller Profile Form Custom Field', 'AdminKbMpCustomFieldsController'),
                ),
                'input' => array(
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Select Field Type', 'AdminKbMpCustomFieldsController'),
                        'hint' => $this->module->l('Select Type of the Field', 'AdminKbMpCustomFieldsController'),
                        'name' => 'type',
                        'options' => array(
                            'query' => $this->getAllowedFieldType(),
                            'id' => 'id',
                            'name' => 'label',
                        ),
                        'default_value' => (Tools::getValue('id_field') && Tools::getIsset('updatekb_mp_custom_fields')) ? $object->type: '',
                    ),
                    array(
                        'type' => 'hidden',
                        'name' => 'type'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Label', 'AdminKbMpCustomFieldsController'),
                        'lang' => true,
                        'name' => 'label',
                        'required' => true,
                        'col' => 4,
                        'hint' => $this->module->l('Add the label of the input field', 'AdminKbMpCustomFieldsController'),
                    ),
                    
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Short Description', 'AdminKbMpCustomFieldsController'),
                        'lang' => true,
                        'hint' => $this->module->l('Add the help text for the input field', 'AdminKbMpCustomFieldsController'),
                        'name' => 'description',
                        'col' => 4,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Placeholder', 'AdminKbMpCustomFieldsController'),
                        'lang' => true,
                        'name' => 'placeholder',
                        'col' => 4,
                        'hint' => $this->module->l('Add the placeholder in the input field', 'AdminKbMpCustomFieldsController'),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Section', 'AdminKbMpCustomFieldsController'),
                        'name' => 'id_section',
                        'options' => array(
                            'query' => $availablesectionArray,
                            'id' => 'id_section',
                            'name' => 'label'
                        ),
                        'hint' => $this->module->l('Add the field in different block', 'AdminKbMpCustomFieldsController'),
                        'required' => true,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Multiple Select', 'AdminKbMpCustomFieldsController'),
                        'name' => 'multiselect',
                        'hint' => $this->module->l('Enable the functionality of multiple select', 'AdminKbMpCustomFieldsController'),
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'value' => 1
                            ),
                            array(
                                'value' => 0
                            )
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Field Name', 'AdminKbMpCustomFieldsController'),
                        'name' => 'field_name',
                        'col' => 4,
                        'required'=> true,
                    ),
                    array(
                        'type' => 'textarea',
                        'label' => $this->module->l('Options', 'AdminKbMpCustomFieldsController'),
                        'lang' => true,
                        'desc' => $this->module->l('Enter only one option in 1 line', 'AdminKbMpCustomFieldsController')
                        . '</br>' . $this->module->l('Avoid blank lines.', 'AdminKbMpCustomFieldsController') . '</br>'
                        . $this->module->l('Accepted format example:', 'AdminKbMpCustomFieldsController') . '</br>'
                        . 'm|Male' . '</br>'
                        . 'f|Female',
                        'name' => 'value',
                        'col' => 5,
                        'required' => true
                        
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Default value (optional)', 'AdminKbMpCustomFieldsController'),
                        'lang' => true,
                        'name' => 'default_value',
                        'col' => 5,
                        'desc' => $this->module->l('For select, radio or checkbox, set the default value like this', 'AdminKbMpCustomFieldsController')
                        . '</br>' . $this->module->l('Option:- n|No, Default Value:- n', 'AdminKbMpCustomFieldsController') . '</br>'
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Validation', 'AdminKbMpCustomFieldsController'),
                        'name' => 'validation',
                        'options' => array(
                            'query' => $this->getFieldValidation(),
                            'id' => 'id',
                            'name' => 'value'
                        ),
                        'hint' => $this->module->l('Select the type of validation to validate the field', 'AdminKbMpCustomFieldsController'),
                    
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Error Message', 'AdminKbMpCustomFieldsController'),
                        'name' => 'error_msg',
                        'lang' => true,
                        'col' => 4,
                        'hint' => $this->module->l('Display the error message if there is any error in the field', 'AdminKbMpCustomFieldsController'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('HTML ID', 'AdminKbMpCustomFieldsController'),
                        'name' => 'html_id',
                        'col' => 4,
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('HTML Class', 'AdminKbMpCustomFieldsController'),
                        'name' => 'html_class',
                        'col' => 4,
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Minimum Length', 'AdminKbMpCustomFieldsController'),
                        'name' => 'min_length',
                        'col' => 3,
                         'hint' => $this->module->l('Enter the minimum character for the field', 'AdminKbMpCustomFieldsController'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Maximum Length', 'AdminKbMpCustomFieldsController'),
                        'name' => 'max_length',
                        'col' => 3,
                         'hint' => $this->module->l('Enter the maximum character for the field', 'AdminKbMpCustomFieldsController'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('File Extension', 'AdminKbMpCustomFieldsController'),
                        'name' => 'file_extension',
                        'col' => 4,
                        'required' => true,
                        'desc' => $this->module->l('Extension must be comma separated value. Eg- ', 'AdminKbMpCustomFieldsController') .'png, jpg'
                        
                    ),
                    array(
                        'type' => 'hidden',
                        'label' => $this->module->l('Allow Multiple File', 'AdminKbMpCustomFieldsController'),
                        'name' => 'allow_multifile',
                    ),
                    
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Required', 'AdminKbMpCustomFieldsController'),
                        'name' => 'required',
                        'is_bool' => true,
                        'hint' => $this->module->l('Enable if to make field mandatory', 'AdminKbMpCustomFieldsController'),
                        'values' => array(
                            array(
                                'value' => 1
                            ),
                            array(
                                'value' => 0
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Editable', 'AdminKbMpCustomFieldsController'),
                        'name' => 'editable',
                        'is_bool' => true,
                        'hint' => $this->module->l('Enable if you want seller to replace the upload document.', 'AdminKbMpCustomFieldsController'),
                        'values' => array(
                            array(
                                'value' => 1
                            ),
                            array(
                                'value' => 0
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show text editor', 'AdminKbMpCustomFieldsController'),
                        'name' => 'show_text_editor',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'value' => 1
                            ),
                            array(
                                'value' => 0
                            )
                        ),
                        'hint' => $this->module->l('Enable to show text editor in seller profile form', 'AdminKbMpCustomFieldsController'),
                        'default_values' => 1,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show in seller registration Form', 'AdminKbMpCustomFieldsController'),
                        'name' => 'show_registration_form',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'value' => 1
                            ),
                            array(
                                'value' => 0
                            )
                        ),
                        'hint' => $this->module->l('Enable if to show field in Separate seller registration form.', 'AdminKbMpCustomFieldsController'),
                        'default_values' => 1,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Show in seller Profile Page in Front', 'AdminKbMpCustomFieldsController'),
                        'name' => 'show_seller_profile',
                        'is_bool' => true,
                        'hint' => $this->module->l('Enable if want to display the field in seller profile form', 'AdminKbMpCustomFieldsController'),
                        'values' => array(
                            array(
                                'value' => 1
                            ),
                            array(
                                'value' => 0
                            )
                        ),
                        'default_value' => 1,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Active', 'AdminKbMpCustomFieldsController'),
                        'name' => 'active',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'value' => 1
                            ),
                            array(
                                'value' => 0
                            )
                        ),
                        'default_value' => 0,
                    ),
                ),
                'submit' => array(
                    'title' => $this->module->l('Save', 'AdminKbMpCustomFieldsController'),
                    'class' => 'btn btn-default pull-right ' .$submit_btn
                ),
            ),
        );
        
         $object = '';
        if ((Tools::getValue('id_field') != '') && Tools::getIsset('updatekb_mp_custom_fields')) {
            $field_value = $this->getEditFieldValues();
        } elseif (Tools::getIsset('addkb_mp_custom_fields')) {
            $field_value = $this->getAddFieldValues();
        }
        
        return $this->renderGenericForm(
            array(
                'form' => $this->fields_form
            ),
            $field_value,
            Tools::getAdminTokenLite('AdminKbMpCustomFields'),
            $tpl_vars
        );
    }
    
    /**
    * Function used to display add field form
    */
    protected function getAddFieldValues()
    {
        $languages = $this->all_languages;
        $field_value = array(
            'type' => '',
            'multiselect' => 0,
            'validation' => '',
            'id_section' => '',
            'field_name' => 'field_' . time(),
            'html_id' => 'field_' . time(),
            'html_class' => 'field_' . time(),
            'min_length' => 0,
            'max_length' => 255,
            'file_extension' => '',
            'allow_multifile' => 0,
            'required' => 0,
            'editable' => 0,
            'show_registration_form' => 0,
            'show_text_editor' => 0,
            'show_seller_profile' => 0,
            'active' => 0,
        );
        foreach ($languages as $lang) {
            $field_value['label'][$lang['id_lang']] = '';
            $field_value['description'][$lang['id_lang']] = '';
            $field_value['placeholder'][$lang['id_lang']] = '';
            $field_value['value'][$lang['id_lang']] = '';
            $field_value['default_value'][$lang['id_lang']] = '';
            $field_value['error_msg'][$lang['id_lang']] = '';
        }
        return $field_value;
    }
    
    /**
     * Function used to display Edit field form
     */
    protected function getEditFieldValues()
    {
        $object = new KbMpCustomFields(Tools::getValue('id_field'));
        $languages = $this->all_languages;
        if (is_object($object) && (count(get_object_vars($object)) > 0)) {
            $field_value = array(
                'type' => $object->type,
                'multiselect' => $object->multiselect,
                'validation' => $object->validation,
                'id_section' => $object->id_section,
                'field_name' => $object->field_name,
                'html_id' => $object->html_id,
                'html_class' => $object->html_class,
                'min_length' => $object->min_length,
                'max_length' => $object->max_length,
                'file_extension' =>$object->file_extension,
                'allow_multifile' => $object->allow_multifile,
                'show_text_editor' => $object->show_text_editor,
                'show_seller_profile' => $object->show_seller_profile,
                'required' =>  $object->required,
                'show_registration_form' =>  $object->show_registration_form,
                'editable' =>  $object->editable,
                'active' =>  $object->active,
            );
            foreach ($languages as $lang) {
                $field_value['label'][$lang['id_lang']] = isset($object->label[$lang['id_lang']]) ?$object->label[$lang['id_lang']] : '';
                $field_value['description'][$lang['id_lang']] = isset($object->description[$lang['id_lang']]) ?$object->description[$lang['id_lang']] : '';
                $field_value['placeholder'][$lang['id_lang']] = isset($object->placeholder[$lang['id_lang']]) ?$object->placeholder[$lang['id_lang']] : '';
                $field_value['value'][$lang['id_lang']] = isset($object->value[$lang['id_lang']]) ?$object->value[$lang['id_lang']] : '';
                $field_value['default_value'][$lang['id_lang']] = isset($object->default_value[$lang['id_lang']]) ?$object->default_value[$lang['id_lang']] : '';
                $field_value['error_msg'][$lang['id_lang']] = isset($object->error_msg[$lang['id_lang']]) ?$object->error_msg[$lang['id_lang']] : '';
            }
            $array_option_data = array();
            if (is_array($field_value['value']) && !empty($field_value['value'])) {
                foreach ($field_value['value'] as $key => $value_field) {
                    $option_data = '';
                    $field_option = Tools::jsonDecode($value_field, true);
                    if (!empty($field_option) && is_array($field_option)) {
                        foreach ($field_option as $value) {
                            $option_data .= implode('|', $value) . "\n";
                        }
                    }
                    $array_option_data[$key] = $option_data;
                }
            }
            
            $array_default_option_data = array();
            if (is_array($field_value['default_value']) && !empty($field_value['value'])) {
                foreach ($field_value['default_value'] as $key => $value_field) {
                    $option_data = '';
                    $field_option = Tools::jsonDecode($value_field, true);
                    if (!empty($field_option) && is_array($field_option)) {
                        foreach ($field_option as $value) {
                            $option_data .= implode('|', $value) . "\n";
                        }
                    }
                    $array_default_option_data[$key] = $option_data;
                }
            }
            $field_value['value'] = $array_option_data;
            $field_value['default_value'] = $array_default_option_data;
        } else {
            $field_value = array(
                'type' => '',
                'multiselect' => 0,
                'validation' => '',
                'id_section' => '',
                'field_name' => 'field_' . time(),
                'html_id' => 'field_' . time(),
                'html_class' => 'field_' . time(),
                'min_length' => '',
                'max_length' => '',
                'file_extension' => '',
                'allow_multifile' => '',
                'multiselect' => 0,
                'show_text_editor' => 0,
                'show_seller_profile' => 0,
                'required' => 0,
                'multiselect' => 0,
                'show_registration_form' => 0,
                'editable' => 0,
                'show_seller_profile' => 0,
                'show_text_editor' => 0,
//                'show_on_invoice' => 0,
                'active' => 0,
            );
            foreach ($languages as $lang) {
                $field_value['label'][$lang['id_lang']] = '';
                $field_value['description'][$lang['id_lang']] = '';
                $field_value['placeholder'][$lang['id_lang']] = '';
                $field_value['value'][$lang['id_lang']] = '';
                $field_value['default_value'][$lang['id_lang']] = '';
                $field_value['error_msg'][$lang['id_lang']] = '';
            }
        }
        return $field_value;
    }
    
    /**
     * Function used for assign array for validation field
     */
    protected function getFieldValidation()
    {
        return array(
            array(
                'id' => null,
                'value' => $this->module->l('Select', 'AdminKbMpCustomFieldsController'),
            ),
            array(
                'id' => 'isName',
                'value' => 'isName',
                
            ),
            array(
                'id' => 'isGenericName',
                'value' => 'isGenericName'
            ),
            array(
                'id' => 'isAddress',
                'value' => 'isAddress',
            ),
//            array(
//                'id' => 'isPostCode',
//                'value' => 'isPostCode',
//            ),
            array(
                'id' => 'isCityName',
                'value' => 'isCityName'
            ),
            array(
                'id' => 'isMessage',
                'value' => 'isMessage',
            ),
            array(
                'id' => 'isPhoneNumber',
                'value' => 'isPhoneNumber',
            ),
            array(
                'id' => 'isDniLite',
                'value' => 'isDniLite'
            ),
            array(
                'id' => 'isEmail',
                'value' => 'isEmail'
            ),
            array(
                'id' => 'isPasswd',
                'value' => 'isPasswd'
            ),
        );
    }
    
    /**
     * Function used for assign array for allowed field type field
     */
    protected function getAllowedFieldType()
    {
        return array(
            array(
                'id' => null,
                'label' => $this->module->l('Select Type', 'AdminKbMpCustomFieldsController'),
            ),
            array(
                'id' => 'text',
                'label' => 'Text'
            ),
            array(
                'id' => 'select',
                'label' => 'Select'
            ),
            array(
                'id' => 'radio',
                'label' => 'Radio'
            ),
            array(
                'id' => 'checkbox',
                'label' => 'Checkbox'
            ),
            array(
                'id' => 'textarea',
                'label' => 'Text Area'
            ),
            array(
                'id' => 'file',
                'label' => 'File'
            ),
            array(
                'id' => 'date',
                'label' => 'Date'
            ),
//            array(
//                'id' => 'datetime',
//                'label' => 'Datetime'
//            ),
//            array(
//                'id' => 'html',
//                'label' => $this->module->l('HTML Block')
//            ),
//            array(
//                'id' => 'email',
//                'label' => $this->module->l('Email')
//            ),
        );
    }
    
    /*
     * Function for returning all the languages in the system
     */
    public function getAllLanguages()
    {
        return Language::getLanguages(false);
    }
    
    /**
    * Prestashop Default Function in AdminController.
    * Assign smarty variables for all default views, list and form, then call other init functions
    */
    public function initContent()
    {
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
    
    /**
     * Function used to render the list to display for this controller
     *
     * @return string|false
     * @throws PrestaShopException
     */
//    public function renderList()
//    {
//        $section = Db::getInstance()->getRow('SELECT count(*) as count FROM '._DB_PREFIX_.'kb_mp_custom_field_section WHERE active=1');
//            return parent::renderList();
//        } else {
//            $this->context->smarty->assign('kb_controller_link', $this->context->link->getAdminLink('AdminKbMpCustomFieldsection', true));
//            return $this->context->smarty->fetch(
//                _PS_MODULE_DIR_.'kbcustomfield/views/templates/admin/section_view.tpl'
//            );
//        }
//    }
    
    /** Prestashop Default Function in AdminController
     * @TODO uses redirectAdmin only if !$this->ajax
     * @return bool
     */
    public function postProcess()
    {
        if (Tools::isSubmit('active'.$this->table)) {
            $id_field= Tools::getValue('id_field');
            $kb_custom = new KbMpCustomFields($id_field);
            if ($kb_custom->active == 1) {
                $kb_custom->active = 0;
            } else {
                $kb_custom->active = 1;
            }
            $kb_custom->update();
            $this->context->cookie->__set('kb_redirect_success', $this->module->l('The status has been successfully updated.', 'AdminKbMpCustomFieldsController'));
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbMpCustomFields', true));
        }
        
        if (Tools::isSubmit('submitBulkenableSelection' . $this->table)) {
            $this->processBulkEnableSelection();
            $this->context->cookie->__set('kb_redirect_success', $this->module->l('The status has been successfully updated.', 'AdminKbMpCustomFieldsController'));
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbMpCustomFields', true));
        }
        
        if (Tools::isSubmit('submitBulkdisableSelection' . $this->table)) {
            $this->processBulkDisableSelection();
            $this->context->cookie->__set('kb_redirect_success', $this->module->l('The status has been successfully updated.', 'AdminKbMpCustomFieldsController'));
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbMpCustomFields', true));
        }
        parent::postProcess();
    }
    
    /**
     * Function to create custom field
     */
    public function processAdd()
    {
        if (Tools::isSubmit('submitAddkb_mp_custom_fields')) {
            $addKbField = new KbMpCustomFields();
            $label = array();
            $description = array();
            $placeholder = array();
            $field_value = array();
            $field_default_value = array();
            $field_error_msg = array();
            $languages = $this->all_languages;
            foreach ($languages as $lang) {
                $label[$lang['id_lang']] = trim(Tools::getValue('label_' . $lang['id_lang']));
                $description[$lang['id_lang']] = trim(Tools::getValue('description_' . $lang['id_lang']));
                $placeholder[$lang['id_lang']] = trim(Tools::getValue('placeholder_' . $lang['id_lang']));
                $field_value[$lang['id_lang']] = trim(Tools::getValue('value_' . $lang['id_lang']));
                $field_default_value[$lang['id_lang']] = trim(Tools::getValue('default_value_' . $lang['id_lang']));
                $field_error_msg[$lang['id_lang']] = trim(Tools::getValue('error_msg_' . $lang['id_lang']));
            }
            $array_option_data_lang = array();
            $array_default_option_data_lang = array();
            if (is_array($field_value) && !empty($field_value)) {
                foreach ($field_value as $key => $value) {
                    $array_option = explode("\n", $value);
                    foreach ($array_option as $op_key => $option) {
                        if (!empty(trim($option))) {
                            $array_option_data = explode('|', trim($option));
                            $array_option_data_lang[$key][$op_key]['option_value'] = $array_option_data[0];
                            $array_option_data_lang[$key][$op_key]['option_label'] = $array_option_data[1];
                        }
                    }
                }
            }
            if (is_array($array_option_data_lang) && !empty($array_option_data_lang)) {
                foreach ($array_option_data_lang as $key => $options) {
                    $array_option_data_lang[$key] = Tools::jsonEncode($options);
                }
            }
            
            if (is_array($field_default_value) && !empty($field_default_value)) {
                foreach ($field_default_value as $key => $value) {
                    $array_option = explode("\n", $value);
                    foreach ($array_option as $op_key => $option) {
                        if (!empty(trim($option))) {
                            $array_option_data = explode('|', trim($option));
                            $array_default_option_data_lang[$key][$op_key]['option_value'] = $array_option_data[0];
                            $array_default_option_data_lang[$key][$op_key]['option_label'] = $array_option_data[1];
                        }
                    }
                }
            }
            
            if (is_array($array_default_option_data_lang) && !empty($array_default_option_data_lang)) {
                foreach ($array_default_option_data_lang as $key => $options) {
                    $array_default_option_data_lang[$key] = Tools::jsonEncode($options);
                }
            }
            $type = Tools::getValue('type');
            $id_section = Tools::getValue('id_section');
            $multiselect = Tools::getValue('multiselect');
            $field_name = Tools::getValue('field_name');
            $validation = Tools::getValue('validation');
            $html_id = trim(Tools::getValue('html_id'));
            $html_class = trim(Tools::getValue('html_class'));
            $min_length = trim(Tools::getValue('min_length'));
            $max_length = trim(Tools::getValue('max_length'));
            $file_extension = trim(Tools::getValue('file_extension'));
            $allow_multifile = Tools::getValue('allow_multifile');
            $required = Tools::getValue('required');
            $show_registration_form = Tools::getValue('show_registration_form');
            $editable = Tools::getValue('editable');
            $show_seller_profile = Tools::getValue('show_seller_profile');
            $show_text_editor = Tools::getValue('show_text_editor');
            $active = Tools::getValue('active');
            if (($type == 'text') || ($type == 'textarea')) {
                $multiselect = 0;
                $array_option_data_lang = array();
                $array_default_option_data_lang = array();
                if (($type == 'text') && ($validation == 'isEmail')) {
                    $min_length = '';
                    $max_length = '';
                }
                if (($type == 'text') && ($validation != 'isEmail')) {
                    $newsletter = 0;
                } elseif ($type == 'textarea') {
                    $newsletter = 0;
                }
                $file_extension = '';
                $allow_multifile = 0;
            } elseif ($type == 'select') {
                $placeholder = '';
                $newsletter = 0;
                $min_length = '';
                $max_length = '';
                $file_extension = '';
                $allow_multifile = 0;
            } elseif ($type == 'radio') {
                $placeholder = '';
                $newsletter = 0;
                $min_length = '';
                $max_length = '';
                $file_extension = '';
                $allow_multifile = 0;
            } elseif ($type == 'checkbox') {
                $placeholder = '';
                $newsletter = 0;
                $min_length = '';
                $max_length = '';
                $file_extension = '';
                $allow_multifile = 0;
            } elseif ($type == 'file') {
                $placeholder = '';
                $validation = '';
//            $field_error_msg = '';
                $min_length = '';
                $max_length = '';
                $array_default_option_data_lang = array();
                $field_default_value = '';
                $multiselect = 0;
                $newsletter = 0;
            } elseif (($type == 'date') || ($type == 'datetime')) {
                $field_error_msg = '';
                $validation = '';
                $newsletter = 0;
                $min_length = '';
                $max_length = '';
                $file_extension = '';
                $allow_multifile = 0;
                $multiselect = 0;
                $array_default_option_data_lang = array();
                $field_default_value = '';
            }

            //save
            $addKbField->id_section = $id_section;
            $addKbField->field_name = $field_name;
            $addKbField->type = $type;
            $addKbField->label = $label;
            $addKbField->description = $description;
            $addKbField->value = $array_option_data_lang;
            $addKbField->validation = $validation;
            $addKbField->error_msg = $field_error_msg;
            $addKbField->default_value = $array_default_option_data_lang;
            $addKbField->placeholder = $placeholder;
            $addKbField->html_id = $html_id;
            $addKbField->html_class = $html_class;
            $addKbField->max_length = $max_length;
            $addKbField->id_shop = $this->context->shop->id;
            $addKbField->min_length = $min_length;
            $addKbField->file_extension = $file_extension;
            $addKbField->allow_multifile = $allow_multifile;
            $addKbField->required = $required;
            $addKbField->multiselect = $multiselect;
            $addKbField->show_registration_form = $show_registration_form;
            $addKbField->editable = $editable;
            $addKbField->show_seller_profile = $show_seller_profile;
            $addKbField->show_text_editor = $show_text_editor;
//            $addKbField->show_on_invoice = $show_on_invoice;
            $addKbField->active = $active;
            if ($addKbField->add()) {
                $this->context->cookie->__set(
                    'kb_redirect_success',
                    $this->module->l('Field added successfully', 'AdminKbMpCustomFieldsController')
                );
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbMpCustomFields', true));
            } else {
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('Something went wrong while adding the Field. Please try again.', 'AdminKbMpCustomFieldsController')
                );
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbMpCustomFields', true));
            }
        }
    }
    
    /**
    * Function to update custom field
    */
    public function processUpdate()
    {
        if (Tools::isSubmit('submitAddkb_mp_custom_fields')) {
            $updateKbField = new KbMpCustomFields(Tools::getValue('id_field'));
            $label = array();
            $description = array();
            $placeholder = array();
            $field_value = array();
            $field_default_value = array();
            $field_error_msg = array();
            $languages = $this->all_languages;
            foreach ($languages as $lang) {
                $label[$lang['id_lang']] = trim(Tools::getValue('label_' . $lang['id_lang']));
                $description[$lang['id_lang']] = trim(Tools::getValue('description_' . $lang['id_lang']));
                $placeholder[$lang['id_lang']] = trim(Tools::getValue('placeholder_' . $lang['id_lang']));
                $field_value[$lang['id_lang']] = trim(Tools::getValue('value_' . $lang['id_lang']));
                $field_default_value[$lang['id_lang']] = trim(Tools::getValue('default_value_' . $lang['id_lang']));
                $field_error_msg[$lang['id_lang']] = trim(Tools::getValue('error_msg_' . $lang['id_lang']));
            }
            $array_option_data_lang = array();
            $array_default_option_data_lang = array();
            if (is_array($field_value) && !empty($field_value)) {
                foreach ($field_value as $key => $value) {
                    $array_option = explode("\n", $value);
                    foreach ($array_option as $op_key => $option) {
                        if (!empty(trim($option))) {
                            $array_option_data = explode('|', trim($option));
                            $array_option_data_lang[$key][$op_key]['option_value'] = $array_option_data[0];
                            $array_option_data_lang[$key][$op_key]['option_label'] = $array_option_data[1];
                        }
                    }
                }
            }
            if (is_array($array_option_data_lang) && !empty($array_option_data_lang)) {
                foreach ($array_option_data_lang as $key => $options) {
                    $array_option_data_lang[$key] = Tools::jsonEncode($options);
                }
            }
            
            if (is_array($field_default_value) && !empty($field_default_value)) {
                foreach ($field_default_value as $key => $value) {
                    $array_option = explode("\n", $value);
                    foreach ($array_option as $op_key => $option) {
                        if (!empty(trim($option))) {
                            $array_option_data = explode('|', trim($option));
                            $array_default_option_data_lang[$key][$op_key]['option_value'] = $array_option_data[0];
                            $array_default_option_data_lang[$key][$op_key]['option_label'] = $array_option_data[1];
                        }
                    }
                }
            }
            
            if (is_array($array_default_option_data_lang) && !empty($array_default_option_data_lang)) {
                foreach ($array_default_option_data_lang as $key => $options) {
                    $array_default_option_data_lang[$key] = Tools::jsonEncode($options);
                }
            }
            
            $type = $updateKbField->type;
            $id_section = Tools::getValue('id_section');
            $multiselect = Tools::getValue('multiselect');
//            print_r($multiselect);
//            die;
            $field_name = Tools::getValue('field_name');
            $validation = Tools::getValue('validation');
            $html_id = trim(Tools::getValue('html_id'));
            $html_class = trim(Tools::getValue('html_class'));
            $min_length = trim(Tools::getValue('min_length'));
            $max_length = trim(Tools::getValue('max_length'));
            $file_extension = trim(Tools::getValue('file_extension'));
            $allow_multifile = Tools::getValue('allow_multifile');
            $required = Tools::getValue('required');
            $show_registration_form = Tools::getValue('show_registration_form');
            $editable = Tools::getValue('editable');
            $show_text_editor = Tools::getValue('show_text_editor');
            $show_seller_profile = Tools::getValue('show_seller_profile');
            $active = Tools::getValue('active');
            if (($type == 'text') || ($type == 'textarea')) {
                $multiselect = 0;
                $array_option_data_lang = array();
                $array_default_option_data_lang = array();
                if (($type == 'text') && ($validation == 'isEmail')) {
                    $min_length = '';
                    $max_length = '';
                }
                if (($type == 'text') && ($validation != 'isEmail')) {
                    $newsletter = 0;
                } elseif ($type == 'textarea') {
                    $newsletter = 0;
                }
                $file_extension = '';
                $allow_multifile = 0;
            } elseif ($type == 'select') {
                $placeholder = '';
                $min_length = '';
                $max_length = '';
                $file_extension = '';
                $allow_multifile = 0;
            } elseif ($type == 'radio') {
                $placeholder = '';
                $newsletter = 0;
                $min_length = '';
                $max_length = '';
                $file_extension = '';
                $allow_multifile = 0;
            } elseif ($type == 'checkbox') {
                $placeholder = '';
                $min_length = '';
                $max_length = '';
                $file_extension = '';
                $allow_multifile = 0;
            } elseif ($type == 'file') {
                $placeholder = '';
                $validation = '';
//            $field_error_msg = '';
                $min_length = '';
                $max_length = '';
                $array_default_option_data_lang = array();
                $field_default_value = '';
            } elseif (($type == 'date') || ($type == 'datetime')) {
                $field_error_msg = '';
                $validation = '';
                $min_length = '';
                $max_length = '';
                $file_extension = '';
                $allow_multifile = 0;
                $array_default_option_data_lang = array();
                $field_default_value = '';
            }

            //save
            $updateKbField->id_section = $id_section;
            $updateKbField->field_name = $field_name;
//            $updateKbField->type = $updateKbField->type;
            $updateKbField->label = $label;
            $updateKbField->description = $description;
            $updateKbField->value = $array_option_data_lang;
            $updateKbField->validation = $validation;
            $updateKbField->error_msg = $field_error_msg;
            $updateKbField->default_value = $array_default_option_data_lang;
            $updateKbField->placeholder = $placeholder;
            $updateKbField->html_id = $html_id;
            $updateKbField->html_class = $html_class;
            $updateKbField->max_length = $max_length;
            $updateKbField->min_length = $min_length;
            $updateKbField->file_extension = $file_extension;
            $updateKbField->allow_multifile = $allow_multifile;
            $updateKbField->required = $required;
            $updateKbField->multiselect = $multiselect;
            $updateKbField->show_registration_form = $show_registration_form;
            $updateKbField->editable = $editable;
            $updateKbField->show_seller_profile = $show_seller_profile;
            $updateKbField->show_text_editor = $show_text_editor;
            $updateKbField->active = $active;
            if ($updateKbField->update()) {
                $this->context->cookie->__set(
                    'kb_redirect_success',
                    $this->module->l('Field updated successfully', 'AdminKbMpCustomFieldsController')
                );
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbMpCustomFields', true));
            } else {
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('Something went wrong while updating the Field. Please try again.', 'AdminKbMpCustomFieldsController')
                );
                Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbMpCustomFields', true));
            }
        }
    }
    
    /**
     * Prestashop Default Function in AdminController.
     * Init context and dependencies, handles POST and GET
     */
    public function init()
    {
       
        parent::init();
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
        $this->context->controller->addCSS($this->getKbModuleDir() . 'views/css/admin/kb_admin.css');
        $this->context->controller->addJS($this->getKbModuleDir() . 'views/js/admin/kbmpcustomfield_admin.js');
        $this->context->controller->addJS($this->getKbModuleDir() . 'views/js/front/velovalidation.js');
        $this->context->controller->addJS($this->getKbModuleDir() . 'views/js/admin/validation_admin.js');
    }
    
    /**
    * Function used display toolbar in page header
    */
    public function initPageHeaderToolbar()
    {
        $this->page_header_toolbar_btn['back_url'] = array(
            'href' => 'javascript: window.history.back();',
            'desc' => $this->module->l('Back', 'AdminKbMpCustomFieldsController'),
            'icon' => 'process-icon-back'
        );
        if (!Tools::getValue('id_field') && !Tools::isSubmit('addkb_mp_custom_fields')) {
            $this->page_header_toolbar_btn['new_template'] = array(
                'href' => self::$currentIndex.'&add'.$this->table.'&token='.$this->token,
                'desc' => $this->module->l('Add new Field', 'AdminKbMpCustomFieldsController'),
                'icon' => 'process-icon-new'
            );
        }
        
        if (Tools::getValue('id_field') || Tools::isSubmit('id_field')) {
            $this->page_header_toolbar_btn['kb_cancel_action'] = array(
                'href' => self::$currentIndex.'&token='.$this->token,
                'desc' => $this->module->l('Cancel', 'AdminKbMpCustomFieldsController'),
                'icon' => 'process-icon-cancel'
            );
        }
        parent::initPageHeaderToolbar();
    }
    
    /*
     * Function for returning the URL of PrestaShop Root Modules Directory
     */
    protected function getModuleDirUrl()
    {
        $module_dir = '';
        if ($this->checkSecureUrl()) {
            $module_dir = _PS_BASE_URL_SSL_ . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_MODULE_DIR_);
        } else {
            $module_dir = _PS_BASE_URL_ . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_MODULE_DIR_);
        }
        return $module_dir;
    }
    
    /*
     * Function for checking SSL
     */
    private function checkSecureUrl()
    {
        $custom_ssl_var = 0;
        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS'] == 'on') {
                $custom_ssl_var = 1;
            }
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])
            && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $custom_ssl_var = 1;
        }
        if ((bool) Configuration::get('PS_SSL_ENABLED') && $custom_ssl_var == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    /*
     * Function for returning the HTML of Helper Form
     */
    public function renderGenericForm($fields_form, $fields_value, $admin_token, $tpl_vars = array())
    {
        $languages = $this->all_languages;
        foreach ($languages as $k => $language) {
            $languages[$k]['is_default'] = ((int) ($language['id_lang'] == $this->context->language->id));
        }
        $helper = new HelperForm($this);
        $this->setHelperDisplay($helper);
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->show_cancel_button = true;
        $helper->languages = $languages;
        $helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
        $this->fields_form = array();
        $helper->token = $admin_token;
        $helper->tpl_vars = array_merge(array(
                'fields_value' => $fields_value
            ), $tpl_vars);

        return $helper->generateForm($fields_form);
    }
    
    protected function processBulkEnableSelection()
    {
        return $this->processBulkStatusSelection(1);
    }

    protected function processBulkDisableSelection()
    {
        return $this->processBulkStatusSelection(0);
    }
    
    /**
    * Function used to update the bulk action selection
    */
    protected function processBulkStatusSelection($status)
    {
        $boxes = Tools::getValue($this->table.'Box');
        $result = true;
        if (is_array($boxes) && !empty($boxes)) {
            foreach ($boxes as $id) {
                $object = new $this->className((int) $id);
                $object->active = (int) $status;
                $result &= $object->update();
            }
        }
        return $result;
    }
}
