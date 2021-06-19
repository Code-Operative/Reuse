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

require_once 'KbCore.php';

include_once(_PS_MODULE_DIR_ . 'kbdynamicpricing/classes/KbDynamicPricingRules.php');
include_once(_PS_MODULE_DIR_ . 'kbdynamicpricing/classes/KbDynamicPricingFields.php');
include_once(_PS_MODULE_DIR_ . 'kbdynamicpricing/classes/KbDynamicPricingFieldsValues.php');

class KbmarketplaceDynamicPriceRulesModuleFrontController extends KbmarketplaceCoreModuleFrontController
{

    public $controller_name = 'dynamicpricerules';
    public $errors = array();
    protected $default_form_language;

    public function __construct()
    {
        parent::__construct();
        $this->default_form_language = $this->context->language->id;
    }

    public function setMedia()
    {
        $this->addCSS($this->getKbModuleDir().'views/css/front/multiple-select.css');
        $this->addJS($this->getKbModuleDir().'views/js/front/jquery.multiple.select.js');
        $this->addJS($this->getKbModuleDir().'views/js/front/dynamicprice/common.js');
        
        $this->context->controller->addJqueryPlugin('select2');
        $this->addJqueryPlugin('fancybox');
        $this->addCSS(_MODULE_DIR_ . 'kbdynamicpricing/views/css/admin/kbfields.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/notifications/jquery.notyfy.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/notifications/default.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/notifications/jquery.gritter.css');
        $this->addJS(_PS_MODULE_DIR_  . 'kbmarketplace/views/js/front/notifications/jquery.gritter.min.js');
        $this->addJS(_PS_MODULE_DIR_  . 'kbmarketplace/views/js/front/notifications/jquery.notyfy.js');
        $this->addJS(_PS_MODULE_DIR_  . 'kbmarketplace/views/js/front/supercheckout_notifications.js');
        
        parent::setMedia();
    }

    public function postProcess()
    {
        parent::postProcess();
        if (Tools::isSubmit('ajax')) {
            $this->json = array();
            $renderhtml = false;
            if (Tools::isSubmit('method')) {
                switch (Tools::getValue('method')) {
                    case 'getFilteredRules':
                        $this->json = $this->getAjaxRuleListHtml();
                        echo Tools::jsonEncode($this->json);
                        die;
                        break;
                    case 'saveFormula':
                        if (Tools::getValue('saveFormula') == 1) {
                            $rule_obj = new KbDynamicPricingRules((int) Tools::getValue('id_dynamic_rule'));
                            if (Tools::getValue('formula_for') == 'price') {
                                $rule_obj->price_formula = Tools::getValue('formula');
                            } else if (Tools::getValue('formula_for') == 'weight') {
                                $rule_obj->weight_formula = Tools::getValue('formula');
                            } else {
                                $rule_obj->quantity_formula = Tools::getValue('formula');
                            }
                            $rule_obj->save();
                            die;
                        }
                        break;
                    case 'checkPriority':
                        if (Tools::getValue('checkPriority') == 1) {
                            $sql_rules = 'SELECT * FROM '._DB_PREFIX_.'kb_dp_rules where id_dynamic_rule !='.(int) Tools::getValue('id_dynamic_rule').' and is_seller_zone = '.(int)$this->seller_obj->id;
                            $result_rules = Db::getInstance()->executeS($sql_rules);
                            $flag = 0;
                            if (count($result_rules) != 0) {
                                foreach ($result_rules as $result_rule) {
                                    if ($result_rule['priority'] == (int) Tools::getValue('priority_value')) {
                                        $flag = 1;
                                    }
                                }
                            }
                            echo $flag;
                            die;
                        }
                        break;
                    case 'kb_add_field':
                        if ($id_dynamic_field = $this->addNewField((int) Tools::getValue('id_dynamic_rule'))) {
                            echo $id_dynamic_field;
                        } else {
                            echo 0;
                        }
                        die;
                        break;
                    case 'savename':
                        if (Tools::getValue('savename') == 1) {
                            $field_obj = new KbDynamicPricingFields((int) Tools::getValue('id_dynamic_field'));
                            $field_obj->name = Tools::getValue('name');
                            if ($field_obj->save()) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                            die;
                        }
                        break;
                    case 'savelabel':
                        if (Tools::getValue('savelabel') == 1) {
                            $field_obj = new KbDynamicPricingFields((int) Tools::getValue('id_dynamic_field'));
                            if (empty($field_obj->labels)) {
                                $arr = array();
                                $arr[Tools::getValue('id_lang')] = Tools::getValue('label');
                                $data = Tools::jsonEncode($arr);
                                $field_obj->labels = $data;
                                if ($field_obj->save()) {
                                    echo 1;
                                } else {
                                    echo 0;
                                }
                                die;
                            } else {
                                $label_obj = Tools::jsonDecode($field_obj->labels);
                                $lang_id = Tools::getValue('id_lang');
                                $label_obj->$lang_id = Tools::getValue('label');
                                $field_obj->labels = Tools::jsonEncode($label_obj);
                                if ($field_obj->save()) {
                                    echo 1;
                                } else {
                                    echo 0;
                                }
                                die;
                            }
                        }
                        break;
                    case 'changeStatus':
                        if (Tools::getValue('changeStatus') == 1) {
                            $field_obj = new KbDynamicPricingFields((int) Tools::getValue('id_dynamic_field'));
                            $field_obj->status = Tools::getValue('status');
                            if ($field_obj->save()) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                            die;
                        }
                        break;
                    case 'deleteField':
                        if (Tools::getValue('deleteField') == 1) {
                            $sql_delete_fields_values = 'DELETE FROM '._DB_PREFIX_.'kb_dp_rule_fields_values where id_dynamic_field='.(int) Tools::getValue('id_dynamic_field');
                            if ($result = Db::getInstance()->execute($sql_delete_fields_values)) {
                                $field_obj = new KbDynamicPricingFields((int) Tools::getValue('id_dynamic_field'));
                                if ($field_obj->delete()) {
                                    echo 1;
                                } else {
                                    echo 0;
                                }
                            } else {
                                echo 0;
                            }
                            die;
                        }
                        break;
                    case 'changeType':
                        if (Tools::getValue('changeType') == 1) {
                            $field_obj = new KbDynamicPricingFields((int) Tools::getValue('id_dynamic_field'));
                            $field_obj->type = Tools::getValue('type');
                            $values_obj = new KbDynamicPricingFieldsValues();
                            $data = $values_obj->getValuesUsingFieldId((int) Tools::getValue('id_dynamic_field'));
                            if (!empty($data)) {
                                $values_obj = new KbDynamicPricingFieldsValues((int) $data[0]['id_dynamic_field_value']);
                                $values_obj->delete();
                            }
                            if ($field_obj->save()) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                            die;
                        }
                        break;
                    case 'changeUnit':
                        if (Tools::getValue('changeUnit') == 1) {
                            $field_obj = new KbDynamicPricingFields((int) Tools::getValue('id_dynamic_field'));
                            $field_obj->unit = Tools::getValue('unit');
                            if ($field_obj->save()) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                            die;
                        }
                        break;
                    case 'saveValue':
                        if (Tools::getValue('saveValue') == 1) {
                            $field_obj = new KbDynamicPricingFields((int) Tools::getValue('id_dynamic_field'));
                            $field_obj->values = Tools::getValue('value');
                            if ($field_obj->save()) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                            die;
                        }
                        break;
                    case 'getFieldTypeHTML':
                        if (Tools::getValue('getFieldTypeHTML') == 1) {
                            $field_obj = new KbDynamicPricingFields((int) Tools::getValue('id_dynamic_field'));
                            $json = array();
                            $json['status'] = true;
                            $json['html'] = $this->getFieldHTML((int) $field_obj->type, (int) Tools::getValue('id_dynamic_field'));
                            echo Tools::jsonEncode($json);
//                            echo $this->getFieldHTML((int) $field_obj->type, (int) Tools::getValue('id_dynamic_field'));
                            die;
                        }
                        break;
                    case 'saveFieldsValues':
                        if (Tools::getValue('saveFieldsValues') == 1) {
                            if (Tools::getValue('id_dynamic_field_value') == 0) {
                                $value_obj = new KbDynamicPricingFieldsValues();
                            } else {
                                $value_obj = new KbDynamicPricingFieldsValues((int) Tools::getValue('id_dynamic_field_value'));
                            }
                            if (Tools::getValue('fieldtype') == 1 || Tools::getValue('fieldtype') == 2) {
                                $field_obj = new KbDynamicPricingFields((int) Tools::getValue('id_dynamic_field'));
                                if ($field_obj->type == 1 || $field_obj->type == 2) {
                                    $field_obj->values = Tools::getValue('initialValue');
                                    $field_obj->save();
                                }
                                $value_obj->id_dynamic_field = Tools::getValue('id_dynamic_field');
                                $value_obj->default = Tools::getValue('initialValue');
                                $value_obj->min = Tools::getValue('minValue');
                                $value_obj->max = Tools::getValue('maxValue');
                                $value_obj->step = Tools::getValue('stepValue');
                                $descData = Tools::getValue('descData');
                                $descobj = new stdClass();
                                foreach ($descData as $desc) {
                                    $lang_id = $desc['lang_id'];
                                    $descobj->$lang_id = $desc['val'];
                                }
                                $value_obj->desc = Tools::jsonEncode($descobj);
                                // {* chnages by rishabh jain 31st JUly 2019 for multiple select option *}
                            } else if (Tools::getValue('fieldtype') == 3 || Tools::getValue('fieldtype') == 4 || Tools::getValue('fieldtype') == 18) {
                                $post_values = Tools::getAllValues();
                                $field_values = $post_values['inputValues'];
                                $arr_default = '';
                                $arr_val = array();
                                $arr_desc = array();
                                $val_data = new stdClass();
                                $desc_data = new stdClass();
                                foreach ($field_values as $key => $val) {
                                    $key_details = explode('_', $key);
                                    if ($key_details[0] == 'text') {
                                        $arr_val[$key_details[1]][$key_details[2]] = $val;
                                    } else if ($key_details[0] == 'value') {
                                        $arr_val[$key_details[1]]['val'] = $val;
                                    } else if ($key_details[0] == 'default') {
                                        $arr_default = $key_details[1];
                                    } else if ($key_details[0] == 'desc') {
                                        $arr_desc[$key_details[1]] = $val;
                                    }
                                }
                                $val_data->val = $arr_val;
                                $desc_data = $arr_desc;
                                $value_obj->values = Tools::jsonEncode($val_data);
                                $value_obj->desc = Tools::jsonEncode($desc_data);
                                $value_obj->default = $arr_default;
                                $value_obj->id_dynamic_field = Tools::getValue('id_dynamic_field');
                            } else if (Tools::getValue('fieldtype') == 5) {
                                $post_values = Tools::getAllValues();
                                $field_values = $post_values['inputValues'];
                                $arr_default = '';
                                $arr_val = array();
                                $arr_desc = array();
                                $arr_thumbnail = array();
                                $val_data = new stdClass();
                                $thumbnail_data = new stdClass();
                                $desc_data = new stdClass();
                                foreach ($field_values as $key => $val) {
                                    $key_details = explode('_', $key);
                                    if ($key_details[0] == 'text') {
                                        $arr_val[$key_details[1]][$key_details[2]] = $val;
                                    } else if ($key_details[0] == 'value') {
                                        $arr_val[$key_details[1]]['val'] = $val;
                                    } else if ($key_details[0] == 'default') {
                                            $arr_default = $key_details[1];
                                    } else if ($key_details[0] == 'desc') {
                                        $arr_desc[$key_details[1]] = $val;
                                    } else if ($key_details[0] == 'thumbnail') {
                                        $arr_thumbnail[$key_details[1]]['val'] = $val;
                                    }
                                }
                                $val_data->val = $arr_val;
                                $thumbnail_data->val = $arr_thumbnail;
                                $desc_data = $arr_desc;
                                $value_obj->values = Tools::jsonEncode($val_data);
                                $value_obj->desc = Tools::jsonEncode($desc_data);
                                $value_obj->default = Tools::jsonEncode($thumbnail_data);
                                $value_obj->step = $arr_default;
                                $value_obj->id_dynamic_field = Tools::getValue('id_dynamic_field');
                            } else if (Tools::getValue('fieldtype') == 6) {
                                $post_values = Tools::getAllValues();
                                $field_values = $post_values['inputValues'];
                                $desc_data = new stdClass();
                                foreach ($field_values as $key => $val) {
                                    $key_details = explode('_', $key);
                                    if ($key_details[0] == 'desc') {
                                        $arr_desc[$key_details[1]] = $val;
                                    }
                                }
                                $desc_data = $arr_desc;
                                $value_obj->desc = Tools::jsonEncode($desc_data);
                                $value_obj->id_dynamic_field = Tools::getValue('id_dynamic_field');
                            } else if (Tools::getValue('fieldtype') == 7 || Tools::getValue('fieldtype') == 8) {
                                $value_obj->default = Tools::getValue('initialValue');
                                $value_obj->min = Tools::getValue('minValue');
                                $value_obj->max = Tools::getValue('maxValue');
                                $value_obj->step = Tools::getValue('reqValue');
                                $descData = Tools::getValue('descData');
                                $descobj = new stdClass();
                                foreach ($descData as $desc) {
                                    $lang_id = $desc['lang_id'];
                                    $descobj->$lang_id = $desc['val'];
                                }
                                $value_obj->desc = Tools::jsonEncode($descobj);
                                $value_obj->id_dynamic_field = Tools::getValue('id_dynamic_field');
                            } else if (Tools::getValue('fieldtype') == 9) {
                                $value_obj->default = Tools::getValue('reqValue');
                                $descData = Tools::getValue('descData');
                                $descobj = new stdClass();
                                foreach ($descData as $desc) {
                                    $lang_id = $desc['lang_id'];
                                    $descobj->$lang_id = $desc['val'];
                                }
                                $value_obj->desc = Tools::jsonEncode($descobj);
                                $value_obj->id_dynamic_field = Tools::getValue('id_dynamic_field');
                            } else if (Tools::getValue('fieldtype') == 10) {
                                $value_obj->default = Tools::getValue('reqValue');
                                $value_obj->min = Tools::getValue('minValue');
                                $value_obj->max = Tools::getValue('maxValue');
                                $value_obj->step = Tools::getValue('maxSize');
                                $value_obj->id_dynamic_field = Tools::getValue('id_dynamic_field');
                            } else if (Tools::getValue('fieldtype') == 11) {
                                $value_obj->default = Tools::getValue('reqValue');
                                $value_obj->values = Tools::getValue('allowedValues');
                                $value_obj->step = Tools::getValue('maxSize');
                                $descData = Tools::getValue('descData');
                                $descobj = new stdClass();
                                foreach ($descData as $desc) {
                                    $lang_id = $desc['lang_id'];
                                    $descobj->$lang_id = $desc['val'];
                                }
                                $value_obj->desc = Tools::jsonEncode($descobj);
                                $value_obj->id_dynamic_field = Tools::getValue('id_dynamic_field');
                            } else if (Tools::getValue('fieldtype') == 17) {
                                $value_obj->default = Tools::getValue('initialValue');
                                $descData = Tools::getValue('descData');
                                $descobj = new stdClass();
                                foreach ($descData as $desc) {
                                    $lang_id = $desc['lang_id'];
                                    $descobj->$lang_id = $desc['val'];
                                }
                                $value_obj->desc = Tools::jsonEncode($descobj);
                                $value_obj->id_dynamic_field = Tools::getValue('id_dynamic_field');
                            }

                            if ($value_obj->save()) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                            die;
                        }
                        break;
                    case 'changeOptionDefault':
                        if (Tools::getValue('changeOptionDefault') == 1) {
                            $sql = 'SELECT id_dynamic_field_value FROM '._DB_PREFIX_.'kb_dp_rule_fields_values where id_dynamic_field='.(int) Tools::getValue('id_dynamic_field');
                            $row = Db::getInstance()->getRow($sql);
                            if (empty($row['id_dynamic_field_value'])) {
                                $value_obj = new KbDynamicPricingFieldsValues();
                            } else {
                                $value_obj = new KbDynamicPricingFieldsValues((int) $row['id_dynamic_field_value']);
                            }
                            if (Tools::getValue('remove') == 1) {
                                $value_obj->default = '';
                            } else {
                                $value_obj->default = Tools::getValue('key');
                            }
                            if ($value_obj->save()) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                            die;
                        }
                        break;
                    case 'changeOptionDefaultForColorlist':
                        if (Tools::getValue('changeOptionDefaultForColorlist') == 1) {
                            $sql = 'SELECT id_dynamic_field_value FROM '._DB_PREFIX_.'kb_dp_rule_fields_values where id_dynamic_field='.(int) Tools::getValue('id_dynamic_field');
                            $row = Db::getInstance()->getRow($sql);
                            if (empty($row['id_dynamic_field_value'])) {
                                $value_obj = new KbDynamicPricingFieldsValues();
                            } else {
                                $value_obj = new KbDynamicPricingFieldsValues((int) $row['id_dynamic_field_value']);
                            }
                            if (Tools::getValue('remove') == 1) {
                                $value_obj->step = '';
                            } else {
                                $value_obj->step = Tools::getValue('key');
                            }
                            if ($value_obj->save()) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                            die;
                        }
                        break;
                }
            }
        
            if (Tools::isSubmit('kb_dynamic_price_basic_settings') && Tools::getValue('kb_dynamic_price_basic_settings') == 1) {
                if (Tools::getValue('id_dynamic_rule') != 0) {
                    $rule_obj = new KbDynamicPricingRules((int) Tools::getValue('id_dynamic_rule'));
                } else {
                    $rule_obj = new KbDynamicPricingRules();
                    $rule_obj->price_formula = '';
                    $rule_obj->weight_formula = '';
                    $rule_obj->quantity_formula = '';
                }

                if (empty(Tools::getValue('rule_name'))) {
                    $this->context->cookie->kb_redirect_error = $this->module->l('Error occurred while saving the data', 'AdminKbDynamicPricingRulesController');
                    $link = new Link();
                    Tools::redirectAdmin($link->getAdminLink('AdminKbDynamicPricingRules'));
                    return;
                }

                $rule_obj->rule_name = Tools::getValue('rule_name');
                $rule_obj->status = Tools::getValue('enable');
                $rule_obj->enable_global_rules = Tools::getValue('enable_global');
                if (Tools::getValue('enable_global') == 1) {
                    $rule_obj->min_product_price_val = 0;
                    $rule_obj->max_product_price_val = 0;
                    $rule_obj->display_weight = 0;
                    $rule_obj->hide_qty_input = 0;
                    $rule_obj->multiply_qty = 0;
                } else {
                    $rule_obj->min_product_price_val = Tools::getValue('min_prod_price');
                    $rule_obj->max_product_price_val = Tools::getValue('max_prod_price');
                    $rule_obj->display_weight = Tools::getValue('enable_weight_display');
                    $rule_obj->hide_qty_input = Tools::getValue('hide_quantiy_display');
                    $rule_obj->multiply_qty = Tools::getValue('multiply_price_weight');
                }
                $rule_obj->priority = Tools::getValue('rule_priority');
                $rule_obj->date_added = date('Y-m-d');
                $rule_obj->date_updated = date('Y-m-d');
                if ($rule_obj->save()) {
                    $this->context->cookie->kb_redirect_success = $this->module->l('General settings of the rules saved succesfully', 'AdminKbDynamicPricingRulesController');
                } else {
                    $this->context->cookie->kb_redirect_error = $this->module->l('Something went wrong, please try again', 'AdminKbDynamicPricingRulesController');
                }
                $link = new Link();
                Tools::redirectAdmin($link->getAdminLink('AdminKbDynamicPricingRules'));
            }
            if (!$renderhtml) {
                echo Tools::jsonEncode($this->json);
            }
            die;
        }
    }

    
    public function initContent()
    {
        if (Tools::getIsset('render_type') && Tools::getValue('render_type') == 'view') {
            $this->addCSS($this->getKbModuleDir() . 'views/css/front/kb-forms.css');
            $this->addCSS($this->getKbModuleDir() . 'views/css/front/kb-product-form.css');
//            $this->addJs(_MODULE_DIR_ . 'kbdynamicpricing/views/js/admin/fields.js');
            $this->addJs(_MODULE_DIR_ . 'kbdynamicpricing/views/js/velovalidation.js');
            $this->addJs(_MODULE_DIR_ . 'kbdynamicpricing/views/js/jscolor.js');
            $this->addJS($this->getKbModuleDir().'views/js/front/dynamic_price_form.js');
            $this->addJqueryPlugin('fancybox');
            $this->renderRuleView();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'saveRuleData') {
            if (Tools::getValue('id_dynamic_rule') != 0) {
                $this->updateDynamicRuleData();
            } else {
                $this->addDynamicRuleData();
            }
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'delete') {
            $this->deleteDynamicRule();
        } else {
            $this->renderList();
        }
        parent::initContent();
    }

    public function deleteDynamicRule()
    {
        $id_rule = Tools::getValue('id_dynamic_rule', 0);
        $is_seller_rule = 0;
        if ($id_rule != 0) {
            $rule_obj = new KbDynamicPricingRules($id_rule);
            if ((int)$rule_obj->is_seller_zone == (int)$this->seller_obj->id) {
                $is_seller_rule = 1;
            }
        }
        if ((int) $is_seller_rule == 1) {
            $id_dynamic_rule = $id_rule;
            $sql_delete_mapping = 'DELETE FROM '._DB_PREFIX_.'kb_dp_rule_mapping where id_dynamic_rule='.(int) $id_dynamic_rule;
            if ($result = Db::getInstance()->execute($sql_delete_mapping)) {
                $sql_select_fields = 'SELECT * FROM '._DB_PREFIX_.'kb_dp_rule_fields where id_dynamic_rule='.(int) $id_dynamic_rule;
                $fields = Db::getInstance()->executeS($sql_select_fields);
                if (!empty($fields)) {
                    foreach ($fields as $field) {
                        if (isset($field['id_dynamic_field'])) {
                            $sql_delete_fields_values = 'DELETE FROM '._DB_PREFIX_.'kb_dp_rule_fields_values where id_dynamic_field='.(int) $field['id_dynamic_field'];
                            $values = Db::getInstance()->execute($sql_delete_fields_values);
                        }
                    }
                }
                $sql_delete_fields = 'DELETE FROM '._DB_PREFIX_.'kb_dp_rule_fields where id_dynamic_rule='.(int) $id_dynamic_rule;
                if ($result = Db::getInstance()->execute($sql_delete_fields)) {
                    $sql_delete_rules = 'DELETE FROM '._DB_PREFIX_.'kb_dp_rules where id_dynamic_rule='.(int) $id_dynamic_rule;
                    if ($result = Db::getInstance()->execute($sql_delete_rules)) {
                        $this->context->cookie->__set(
                            'redirect_success',
                            $this->module->l('Rule deleted successfully.', $this->controller_name)
                        );
                        $redirect_link = $this->context->link->getModuleLink(
                            $this->kb_module_name,
                            $this->controller_name,
                            array(),
                            (bool) Configuration::get('PS_SSL_ENABLED')
                        );
                        Tools::redirect($redirect_link);
                    }
                }
            }
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('You do not have permission to delete this rule.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        }
    }
    public function addDynamicRuleData()
    {
        $obj = new KbDynamicPricingRules(0);
        $obj->status = (int) Tools::getValue('enable', 0);
        $obj->rule_name = Tools::getValue('rule_name', 0);
        $obj->enable_global_rules = 0;
        $obj->min_product_price_val = Tools::getValue('min_prod_price', 0);
        $obj->max_product_price_val = Tools::getValue('max_prod_price', 0);
        $obj->display_weight = Tools::getValue('enable_weight_display', 0);
        $obj->hide_qty_input = Tools::getValue('hide_quantiy_display', 0);
        $obj->priority = Tools::getValue('rule_priority', 0);
        $obj->multiply_qty = Tools::getValue('multiply_price_weight', 0);
        $obj->date_added = date('Y-m-d', time());
        $obj->date_updated = date('Y-m-d', time());
        $obj->is_seller_zone = (int)$this->seller_obj->id;
        if ($obj->save(true)) {
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Rule data Added successfully.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('The Rule data can not be saved.Kindly try again.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        }
    }
    public function updateDynamicRuleData()
    {
        $obj = new KbDynamicPricingRules((int) Tools::getValue('id_dynamic_rule', 0));
        $obj->status = (int) Tools::getValue('enable', 0);
        $obj->rule_name = Tools::getValue('rule_name', '');
        $obj->enable_global_rules = 0;
        $obj->min_product_price_val = (int) Tools::getValue('min_prod_price', 0);
        $obj->max_product_price_val = (int) Tools::getValue('max_prod_price', 0);
        $obj->display_weight = (int) Tools::getValue('enable_weight_display', 0);
        $obj->hide_qty_input = (int) Tools::getValue('hide_quantiy_display', 0);
        $obj->priority = (int) Tools::getValue('rule_priority', 0);
        $obj->multiply_qty = (int) Tools::getValue('multiply_price_weight', 0);
//        $obj->date_added = date('Y-m-d',time());
        $obj->date_updated = date('Y-m-d', time());
        if ($obj->save(true)) {
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Rule data updated successfully.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('The Rule data can not be saved.Kindly try again.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        }
    }
    
    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();
        if (isset($page['meta']) && $this->seller_info) {
            $page_title = $this->module->l('Dynamic Rules', $this->controller_name);
            $page['meta']['title'] = $page_title;
            $page['meta']['keywords'] = $this->seller_info['meta_keyword'];
            $page['meta']['description'] = $this->seller_info['meta_description'];
        }
        return $page;
    }
    
    public function addNewField($id_rule)
    {
        $field_obj = new KbDynamicPricingFields();
        if ($id_rule != 0) {
            $field_obj->id_dynamic_rule = (int) $id_rule;
            $field_obj->name = '';
            $field_obj->label = '';
            $field_obj->type = 1;
            $field_obj->values = 0;
            $field_obj->unit = 0;
            $field_obj->status = 0;

            if ($field_obj->save()) {
                return Db::getInstance()->Insert_ID();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function getAjaxRuleListHtml()
    {
        $json = array();
        $this->total_records = 0;
        $row_html = '';
        $dynamic_rules = $this->getDynamicRulesbyIdSeller($this->seller_obj->id);
        
        if (is_array($dynamic_rules) && count($dynamic_rules) > 0) {
                $this->total_records = count($dynamic_rules);
        }
        if (Tools::getIsset('start') && (int)Tools::getValue('start') > 0) {
            $this->page_start = (int)Tools::getValue('start');
        }
        if ($this->total_records > 0) {
            $dynamic_rules = array_slice($dynamic_rules, (int)$this->getPageStart(), $this->tbl_row_limit);
            $status = array();
            $status[1] = $this->module->l('Yes', $this->controller_name);
            $status[0] = $this->module->l('No', $this->controller_name);
            foreach ($dynamic_rules as $rule_key => $rule) {
                $view_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'render_type' => 'view',
                        'id_dynamic_rule' => $rule['id_dynamic_rule']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $delete_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'delete',
                        'id_dynamic_rule' => $rule['id_dynamic_rule']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $action_block = array(
                    array(
                        'type' => 'edit',
                        'href' => $view_link,
                        'title' => $this->module->l('Click to edit', $this->controller_name),
                        'label' => $this->module->l('Edit', $this->controller_name),
                    ),
                    array(
                        'type' => 'delete',
                        'href' => $delete_link
                    )
                );
                $row_html .= '<tr>';
                $row_html .= '<td>' . $rule['id_dynamic_rule'] . '</td>';
                $row_html .='<td>' . $rule['rule_name'] . '</td>';
                $row_html .='<td>' . $status[$rule['status']] . '</td>';
                $row_html .='<td>' . $rule['date_added'] . '</td>';
                $row_html .='<td>' . $rule['date_updated'] . '</td>';
                $action_block = '<a class="kb_list_action " href="' . $view_link . '" title="' . $this->module->l('Click to view', $this->controller_name) . '">View</a>
                <a class="kb_list_action " href="javascript:void(0)" data-href="' . $delete_link . '" title="" onclick="actionDeleteConfirmation(this);">' . $this->module->l('Delete', $this->controller_name) . '</a>';
                $row_html .='<td>' . $action_block . '</td>';
                $row_html .='</tr>';
            }
            $this->table_id = 'seller_dynamicrules_filter';
            $this->list_row_callback = 'getFilteredRules';
            $json['status'] = true;
            $json['html'] = $row_html;
            $json['pagination'] = $this->generatePaginator(
                $this->page_start,
                $this->total_records,
                $this->getTotalPages(),
                $this->list_row_callback
            );
        } else {
            $json['status'] = false;
            $json['msg'] = $this->module->l('No Data Found', $this->controller_name);
        }
        return $json;
    }
    
    public function getFieldHTML($fieldtype, $idfield)
    {
        if ($fieldtype != 0) {
            $languages = Language::getLanguages();
            $values_obj = new KbDynamicPricingFieldsValues();
            $data = $values_obj->getValuesUsingFieldId($idfield);
            if (!empty($data)) {
                $this->context->smarty->assign('fielddatavalue', $data);
            } else {
                $this->context->smarty->assign('fielddatavalue', array());
            }
            $this->context->smarty->assign('fieldtype', $fieldtype);
            $this->context->smarty->assign('languages', $languages);
            $this->context->smarty->assign('idfield', $idfield);
            return $this->context->smarty->fetch(_PS_MODULE_DIR_.'kbdynamicpricing/views/templates/front/field_type_form.tpl');
        } else {
            return false;
        }
    }
    private function renderList()
    {
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Module::isInstalled('kbdynamicpricing') && Module::isEnabled('kbdynamicpricing')) {
            $this->filter_header = $this->module->l('Filter Your Search', $this->controller_name);
            $this->filter_id = 'seller_dynamicrules_filter';
            $status_type = array(
                array(
                    'value' => 1,
                    'label' => $this->module->l('Enabled', $this->controller_name)),
                array(
                    'value' => 0,
                    'label' => $this->module->l('Disabled', $this->controller_name))
            );
            $this->filters = array(
                array(
                    'type' => 'text',
                    'name' => 'id_rule',
                    'label' => $this->module->l('Rule Id ', $this->controller_name),
                ),
                array(
                    'type' => 'text',
                    'name' => 'rule_name',
                    'label' => $this->module->l('Rule Name', $this->controller_name),
                ),
                array(
                    'type' => 'select',
                    'placeholder' => $this->module->l('Select', $this->controller_name),
                    'name' => 'status',
                    'label' => $this->module->l('Status', $this->controller_name),
                    'values' => $status_type,
                ),
                array(
                    'type' => 'text',
                    'name' => 'date_add',
                    'class' => 'datepicker',
                    'label' => $this->module->l('Date Added', $this->controller_name)
                ),
                array(
                    'type' => 'text',
                    'name' => 'date_upd',
                    'class' => 'datepicker',
                    'label' => $this->module->l('Last Updated', $this->controller_name)
                ),
            );
            $this->filter_action_name = 'getFilteredRules';
            $this->context->smarty->assign('kbfilter', $this->renderKbListFilter());

            $this->table_id = 'seller_dynamicrules_filter';
            $this->table_header = array(
                array(
                    'label' => $this->module->l('Price Rule ID', $this->controller_name),
                    'align' => 'right',
                    'width' => '60'
                ),
                array(
                    'label' => $this->module->l('Name', $this->controller_name),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Active', $this->controller_name),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Date Added', $this->controller_name),
                    'width' => '100'),
                array(
                    'label' => $this->module->l('Date Updated', $this->controller_name),
                    'width' => '100'),
                array(
                    'label' => $this->module->l('Action', $this->controller_name),
                    'width' => '100')
            );
            $this->total_records = 0;
            $dynamic_rules = $this->getDynamicRulesbyIdSeller($this->seller_obj->id);
            if (is_array($dynamic_rules) && count($dynamic_rules) > 0) {
                $this->total_records = count($dynamic_rules);
            }
            if ($this->total_records > 0) {
                $dynamic_rules = array_slice($dynamic_rules, 0, $this->tbl_row_limit);
                $status = array();
                $status[1] = $this->module->l('Yes', $this->controller_name);
                $status[0] = $this->module->l('No', $this->controller_name);
                foreach ($dynamic_rules as $rule_key => $rule) {
                    $view_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'render_type' => 'view',
                            'id_dynamic_rule' => $rule['id_dynamic_rule']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $delete_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'action_type' => 'delete',
                            'id_dynamic_rule' => $rule['id_dynamic_rule']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $action_block = array(
                        array(
                            'type' => 'edit',
                            'href' => $view_link,
                            'title' => $this->module->l('Click to edit', $this->controller_name),
                            'label' => $this->module->l('Edit', $this->controller_name),
                        ),
                        array(
                            'type' => 'delete',
                            'href' => $delete_link
                        )
                    );
                    
                    $this->table_content[] = array(
                        array(
                            'value' => $rule['id_dynamic_rule']),
                        array(
                            'value' => $rule['rule_name']),
                        array(
                            'value' => $status[$rule['status']]),
                        array(
                            'value' => $rule['date_added']),
                        array(
                            'value' => $rule['date_updated']),
                        array(
                            'input' => array(
                            'type' => 'action'),
                            'actions' => $action_block
                        ),
                    );
                }

                $this->list_row_callback = $this->filter_action_name;

                $this->table_enable_multiaction = false;
            }
            $this->context->smarty->assign('kblist', $this->renderKbList());
        }
        $new_rule_link = $this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            array(
                'render_type' => 'view',
                'id_dynamic_rule' => 0
            ),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        $this->context->smarty->assign('new_dynamic_rule_link', $new_rule_link);
        $this->setKbTemplate('seller/dynamic_price_rules/rules_list.tpl');
    }

    private function renderRuleView()
    {
        $id_rule = Tools::getValue('id_dynamic_rule', 0);
        $is_seller_rule = 0;
        if ($id_rule != 0) {
            $rule_obj = new KbDynamicPricingRules($id_rule);
            if ((int)$rule_obj->is_seller_zone == (int)$this->seller_obj->id) {
                $is_seller_rule = 1;
            }
        } else {
            $is_seller_rule = 1;
        }
        if ($is_seller_rule == 1) {
            $this->context->smarty->assign(
                'cancel_button',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->context->smarty->assign(
                'dynamic_price_rule_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'saveRuleData',
                        'id_dynamic_rule' => $id_rule
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->context->smarty->assign(
                'dynamic_price_mapping_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    'dynamicpriceproductmapping',
                    array(
                        'id_dynamic_rule' => $id_rule
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (Module::isInstalled('kbdynamicpricing') && Module::isEnabled('kbdynamicpricing')) {
                $languages = Language::getLanguages();
                foreach ($languages as $k => $language) {
                    $languages[$k]['is_default'] = ((int) ($language['id_lang'] == $this->context->language->id));
                }
                if ($id_rule != 0) {
                    $rule_obj = new KbDynamicPricingRules((int) $id_rule);
                    $price_formula = $rule_obj->price_formula;
                    $weight_formula = $rule_obj->weight_formula;
                    $qty_formula = $rule_obj->quantity_formula;
                    $this->context->smarty->assign('id_dynamic_rule', $id_rule);
                    $this->context->smarty->assign('dynamic_rule_obj', $rule_obj);
                } else {
                    $price_formula = '';
                    $weight_formula = '';
                    $qty_formula = '';
                    $this->context->smarty->assign('id_dynamic_rule', 0);
                }
                $this->context->smarty->assign('fields_data', $this->getFieldsData(Tools::getValue('id_dynamic_rule', '')));
                $this->context->smarty->assign('languages', $languages);

                $sql = 'SELECT * FROM '._DB_PREFIX_.'kb_dp_rule_fields where id_dynamic_rule = '.(int) $id_rule;
                $fieldsCreated = Db::getInstance()->executeS($sql);

                if (!empty($fieldsCreated)) {
                    $this->context->smarty->assign('fieldsCreated', $fieldsCreated);
                } else {
                    $this->context->smarty->assign('fieldsCreated', array());
                }
                $this->context->smarty->assign('qty_formula', $qty_formula);
                $this->context->smarty->assign('weight_formula', $weight_formula);
                $this->context->smarty->assign('price_formula', $price_formula);
                $this->context->smarty->assign('mapping_link', $this->context->link->getAdminLink('AdminKbDynamicPricingMapping', true, array(), array('id_dynamic_rule' => Tools::getValue('id_dynamic_rule'))));
            }
            $this->setKbTemplate('seller/dynamic_price_rules/rule_form.tpl');
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('You do not have permission to edit this rule.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        }
    }
    public function getFieldsData($id_rule = 0)
    {
        if ($id_rule != 0) {
            $field_obj = new KbDynamicPricingFields();
            return $field_obj->getDataUsingRuleID((int) $id_rule);
        } else {
            return array();
        }
    }
    public function getDynamicRulesbyIdSeller($id_seller = 0)
    {
        $filter_condition = '';
        if (Tools::getIsset('id_rule') && Tools::getValue('id_rule') != '') {
            $id_rule = (int) trim(Tools::getValue('id_rule'));
            $filter_condition .= ' and a.id_dynamic_rule LIKE "%' . pSQL($id_rule) . '%"';
        }
        if (Tools::getIsset('rule_name') && Tools::getValue('rule_name') != '') {
            $rule_name = trim(Tools::getValue('rule_name'));
            $filter_condition .= ' and a.rule_name LIKE "%' . pSQL($rule_name) . '%"';
        }
        if (Tools::getIsset('status') && Tools::getValue('status') != '') {
            $status = (int)trim(Tools::getValue('status'));
            $filter_condition .= ' and a.status LIKE "%' . pSQL($status) . '%"';
        }
        if (Tools::getIsset('date_add') && Tools::getValue('date_add') != '') {
            $date_add = Tools::getValue('date_add');
            $filter_condition .= ' and a.date_added LIKE "%' . pSQL($date_add) . '%"';
        }
        if (Tools::getIsset('date_upd') && Tools::getValue('date_upd') != '') {
            $date_upd = Tools::getValue('status');
            $filter_condition .= ' and a.date_updated LIKE "%' . pSQL($date_upd) . '%"';
        }
        $result = array();
        
        $sql = 'Select a.* from `' . _DB_PREFIX_ . 'kb_dp_rules` as a
            where is_seller_zone = ' . (int) $id_seller . $filter_condition. ' GROUP BY a.id_dynamic_rule';
        $result = DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (is_array($result) && count($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }
}
