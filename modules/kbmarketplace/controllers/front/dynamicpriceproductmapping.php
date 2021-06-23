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

require_once(_PS_MODULE_DIR_ . 'kbdynamicpricing/classes/KbDynamicPricingRules.php');
require_once(_PS_MODULE_DIR_ . 'kbdynamicpricing/classes/KbDynamicRuleMapping.php');
require_once(_PS_MODULE_DIR_ . 'kbdynamicpricing/classes/KbDynamicPricingFields.php');

class KbmarketplaceDynamicPriceProductMappingModuleFrontController extends KbmarketplaceCoreModuleFrontController
{

    public $controller_name = 'dynamicpriceproductmapping';
    public $errors = array();
    protected $default_form_language;

    public function __construct()
    {
        parent::__construct();
        $this->default_form_language = $this->context->language->id;
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addJs(_PS_MODULE_DIR_ . $this->module->name . '/views/js/front/dynamicprice/script_list.js');
        $this->addJs(_PS_MODULE_DIR_ . $this->module->name . '/views/js/front/dynamicprice/script.js');
        $this->addJs(_PS_MODULE_DIR_ . $this->module->name . 'kbdynamicpricing/views/js/admin/select2.min.js');
        $this->addJs(_PS_MODULE_DIR_ . $this->module->name . 'kbdynamicpricing/views/js/admin/select2.js');
        $this->addCSS(_PS_MODULE_DIR_ . $this->module->name . 'kbdynamicpricing/views/css/admin/select2.css');
    }

    public function postProcess()
    {
        
        parent::postProcess();
    }

    
    public function initContent()
    {
        if (Tools::getValue('id_dynamic_rule') != 0) {
            $id_rule = Tools::getValue('id_dynamic_rule', 0);
            $is_seller_rule = 0;
            if ($id_rule != 0) {
                $rule_obj = new KbDynamicPricingRules($id_rule);
                if ($rule_obj->is_seller_zone == $this->seller_obj->id) {
                    $is_seller_rule = 1;
                }
            }
            if ($is_seller_rule == 1) {
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
        if (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'saveRuleData') {
            $this->updateDynamicRuleData();
        } else {
            $this->renderForm();
        }
        parent::initContent();
    }
    
    
    public function updateDynamicRuleData()
    {
        $arr_product = array();
        $arr_supplier = array();
        $arr_manufacturer = array();
        $arr_category = array();
        $products = Tools::getValue('products_mapping');
//        print_r($products);
//        die;
        if (!empty($products)) {
            $data = explode(',', $products);
            foreach ($data as $val) {
                $product_data = explode(':', $val);
                $priority_rule = $this->checkRulePriority($product_data[0], Tools::getValue('id_dynamic_rule'));
                if ($priority_rule == Tools::getValue('id_dynamic_rule') || $priority_rule == 0) {
                    $arr_product[$product_data[0]] = $product_data[1];
                    $this->makeProductCustomizable($product_data[0], Tools::getValue('id_dynamic_rule'));
                }
            }
        }
        $mapping_obj = new KbDynamicRuleMapping();
        $data = $mapping_obj->getDataUsingRuleID(Tools::getValue('id_dynamic_rule'));
        if (!empty($data)) {
            $mapping_obj = new KbDynamicRuleMapping($data['id_mapping']);
        }
        $mapping_obj->id_dynamic_rule = Tools::getValue('id_dynamic_rule');
        $mapping_obj->products_selected = serialize($arr_product);
        $mapping_obj->categories_selected = serialize($arr_category);
        $mapping_obj->manufacturers_selected = serialize($arr_manufacturer);
        $mapping_obj->suppliers_selected = serialize($arr_supplier);
        if ($mapping_obj->save(true)) {
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Mapping added/updated successfully.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                'dynamicpricerules',
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('An error occurred while mapping.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                'dynamicpricerules',
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        }
    }
    
    public function renderForm()
    {
        $languages = Language::getLanguages();
        foreach ($languages as $k => $language) {
            $languages[$k]['is_default'] = ((int) ($language['id_lang'] == $this->context->language->id));
        }
        $products = KbSellerProduct::getProductsWithDetails(
            $this->seller_obj->id,
            $this->context->language->id
        );
        $mapping_obj = new KbDynamicRuleMapping();
        $mapping_data = $mapping_obj->getDataUsingRuleID(Tools::getValue('id_dynamic_rule'));
        
        $selected_products = Tools::unserialize($mapping_data['products_selected']);
//        print_r($selected_products);
//        die;
        $i = 0;
        $slctd_products = array();
        if (!empty($selected_products)) {
            foreach ($selected_products as $key => $val) {
                $slctd_products[$i]['id_product'] = $key;
                $slctd_products[$i]['name'] = $val;
                foreach ($products as $key1 => $product) {
                    if ($product['id_product'] == $key) {
                        unset($products[$key1]);
                    }
                }
                $i++;
            }
        }

        $this->context->smarty->assign('productshtml', $this->getSelectedHtml($products, 'products'));
        $this->context->smarty->assign('selectedhtml', $this->getSelectedHtml($slctd_products, 'products'));

        $products_form = $this->context->smarty->fetch(
            _PS_MODULE_DIR_ . 'kbdynamicpricing/views/templates/admin/mapping_form/products_form.tpl'
        );
        $this->context->smarty->assign('products_form', $products_form);
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
                    'id_dynamic_rule' => Tools::getValue('id_dynamic_rule')
                ),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );
        $this->setKbTemplate('seller/dynamic_price_rules/rule_mapping_form.tpl');
    }
   
    
    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();
        if (isset($page['meta']) && $this->seller_info) {
            $page_title = $this->module->l('Dynamic Rules Mapping', $this->controller_name);
            $page['meta']['title'] = $page_title;
            $page['meta']['keywords'] = $this->seller_info['meta_keyword'];
            $page['meta']['description'] = $this->seller_info['meta_description'];
        }
        return $page;
    }
    
    
    public function getSelectedHtml($data, $for)
    {
        $html = '';
        if ($for == 'products') {
            if (is_array($data)) {
                foreach ($data as $value) {
                    $html .= '<option value="' . $value['id_product'] . '">';
                    $html .= $value['name'];
                    $html .= '</option>';
                }
            }
        }
        return $html;
    }
    
    public function makeProductCustomizable($id_product, $id_rule)
    {
        $pro_obj = new Product((int) $id_product);
        if ($pro_obj->customizable == 1) {
            $this->deleteOldLabels((int) $id_product);
        }

        $pro_obj->customizable = 1;

        $field_obj = new KbDynamicPricingFields();
        $fields_data = $field_obj->getDataUsingRuleID($id_rule);

        $text_fields = 0;
        $file_fields = 0;

        $customizationFieldData = array();

        if (!empty($fields_data)) {
            foreach ($fields_data as $field_data) {
                // {* chnages by rishabh jain 31st JUly 2019 for multiple select option *}
                if ($field_data['type'] == 1 || $field_data['type'] == 2 || $field_data['type'] == 3 || $field_data['type'] == 4 || $field_data['type'] == 5 || $field_data['type'] == 6 || $field_data['type'] == 7 || $field_data['type'] == 8 || $field_data['type'] == 9 || $field_data['type'] == 12 || $field_data['type'] == 13 || $field_data['type'] == 17 || $field_data['type'] == 18) {
                    if (!empty($field_data['labels'])) {
                        $customizationFieldData[] = $field_data;
                        $text_fields++;
                    }
                }
                if ($field_data['type'] == 10) {
                    if (!empty($field_data['labels'])) {
                        $customizationFieldData[] = $field_data;
                        $file_fields++;
                    }
                }
            }
        }

        $pro_obj->text_fields = $text_fields;
        $pro_obj->uploadable_files = $file_fields;

        if (!$pro_obj->createLabels($pro_obj->uploadable_files, (int)$pro_obj->text_fields)) {
            //nothing needs to be done
        } else {
            if (isset($customizationFieldData) && !empty($customizationFieldData)) {
                $this->addCustomizableTextFields($pro_obj, $customizationFieldData);
            }
        }

        $pro_obj->save();
    }

    private function addCustomizableTextFields($pro_obj, $customizationFieldData)
    {
        $labels = $pro_obj->getCustomizationFields();
        $languages = Language::getLanguages();

        $gc_label_count = 0;

        $file_fields = array();
        $txt_fields = array();

        if (isset($labels[Product::CUSTOMIZE_TEXTFIELD])) {
            foreach (array_keys($labels[Product::CUSTOMIZE_TEXTFIELD]) as $id_customization_field) {
                $txt_fields[] = $id_customization_field;
            }
        }
        
        if (isset($labels[Product::CUSTOMIZE_FILE])) {
            foreach (array_keys($labels[Product::CUSTOMIZE_FILE]) as $id_customization_field) {
                $file_fields[] = $id_customization_field;
            }
        }

        $fcount = 0;
        $tcount = 0;

        foreach ($customizationFieldData as $customizationData) {
            if ($customizationData['type'] == 10) {
                if (isset($customizationData['labels'])) {
                    $labels_data = Tools::jsonDecode($customizationData['labels']);
                    foreach ($languages as $lang) {
                        $id_lang = $lang['id_lang'];
                        /* We are setting the values in $_POST as the fuction that is called after ($pro_object->updateLabels()) uses the same and since it is a core function it cannot be modified. */
                        if (isset($labels_data->$id_lang)) {
                            $_POST['label_'.Product::CUSTOMIZE_FILE.'_'.$file_fields[$fcount].'_'.$lang['id_lang']] = $labels_data->$id_lang;
                        }
                    }
                }
                $fcount++;
            } else {
                if (isset($customizationData['labels'])) {
                    $labels_data = Tools::jsonDecode($customizationData['labels']);
                    foreach ($languages as $lang) {
                        $id_lang = $lang['id_lang'];
                        /* We are setting the values in $_POST as the fuction that is called after ($pro_object->updateLabels()) uses the same and since it is a core function it cannot be modified. */
                        if (isset($labels_data->$id_lang)) {
                            $_POST['label_'.Product::CUSTOMIZE_TEXTFIELD.'_'.$txt_fields[$tcount].'_'.$lang['id_lang']] = $labels_data->$id_lang;
                        }
                    }
                }
                $tcount++;
            }
        }
        $pro_obj->updateLabels();
    }

    public function deleteOldLabels($id_product)
    {
        Db::getInstance()->execute(
            'DELETE `'._DB_PREFIX_.'customization_field`,`'._DB_PREFIX_.'customization_field_lang`
            FROM `'._DB_PREFIX_.'customization_field` JOIN `'._DB_PREFIX_.'customization_field_lang`
            WHERE `'._DB_PREFIX_.'customization_field`.`id_product` = '.(int)$id_product.'
            AND `'._DB_PREFIX_.'customization_field_lang`.`id_customization_field` = `'._DB_PREFIX_.'customization_field`.`id_customization_field`'
        );

        $prod_custom = Db::getInstance()->executeS('SELECT id_customization FROM '._DB_PREFIX_.'customization where id_product = '.(int)$id_product);

        foreach ($prod_custom as $custom) {
            Db::getInstance()->execute('DELETE FROM `'._DB_PREFIX_.'customized_data` WHERE  `id_customization` = '.(int)$custom['id_customization']);
            Db::getInstance()->execute('DELETE FROM `'._DB_PREFIX_.'kb_dp_customization_price_mapping` WHERE `id_customization` = '.(int)$custom['id_customization']);
            Db::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'cart_product where id_product = '.(int)$id_product.' and id_customization='.(int) $custom['id_customization']);
        }
    }
    
    public function checkRulePriority($id_product, $id_rule)
    {
        $product = new Product((int) $id_product);
        $sql_all_rules = 'SELECT * FROM '._DB_PREFIX_.'kb_dp_rule_mapping as krm Inner join '._DB_PREFIX_.'kb_dp_rules as kr on (krm.id_dynamic_rule = kr.id_dynamic_rule) where kr.is_seller_zone = '.(int) $this->seller_obj->id;
        $rules_results = Db::getInstance()->executeS($sql_all_rules);
        foreach ($rules_results as $rule) {
            $products_selected = Tools::unserialize($rule['products_selected']);
            foreach ($products_selected as $id => $name) {
                if ($id == $id_product) {
                    $mapped_rule_obj = new KbDynamicPricingRules($rule['id_dynamic_rule']);
                    $current_rule_obj = new KbDynamicPricingRules($id_rule);
                    if ($current_rule_obj->priority <= $mapped_rule_obj->priority) {
                        $this->unsetRule($rule['id_mapping'], $id, 'product');
                        return $id_rule;
                    } else {
                        return $rule['id_dynamic_rule'];
                    }
                }
            }
        }
        return 0;
    }
    
    public function unsetRule($rule_id, $id, $type)
    {
        $rule_obj = new KbDynamicRuleMapping($rule_id);
        if ($type == 'product') {
            $products_selected = Tools::unserialize($rule_obj->products_selected);
            unset($products_selected[$id]);
            $products_selected = serialize($products_selected);
            $rule_obj->products_selected = $products_selected;
            $rule_obj->save();
        }
    }
}
