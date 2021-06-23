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

require_once _PS_MODULE_DIR_ . 'kbbookingcalendar/classes/KbBookingPriceRule.php';

class KbmarketplaceKbBookingProductPriceRulesModuleFrontController extends KbmarketplaceCoreModuleFrontController
{

    public $controller_name = 'kbbookingproductpricerules';
    public $errors = array();
    protected $default_form_language;

    public function __construct()
    {
        parent::__construct();
        $this->default_form_language = $this->context->language->id;
    }

    public function setMedia()
    {
        $this->addCSS($this->getKbModuleDir() . 'views/css/front/kb-forms.css');
//        $this->addJS($this->getKbModuleDir().'views/js/front/dynamicprice/common.js');
        
//        $this->context->controller->addJqueryPlugin('select2');
        
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
                        $this->json = $this->getAjaxRulesHtml();
                        break;
                }
            }
            if (!$renderhtml) {
                echo Tools::jsonEncode($this->json);
            }
            die;
        }
    }

    public function getAjaxRulesHtml()
    {
        $json = array();
        $this->total_records = 0;
        $row_html = '';
        $global_rules = $this->getPriceRulesbyIdSeller($this->seller_obj->id);
        if (is_array($global_rules) && count($global_rules) > 0) {
                $this->total_records = count($global_rules);
        }
        if (Tools::getIsset('start') && (int)Tools::getValue('start') > 0) {
            $this->page_start = (int)Tools::getValue('start');
        }
        
        $status = array();
        $status[1] = $this->module->l('Yes', $this->controller_name);
        $status[0] = $this->module->l('No', $this->controller_name);
        if ($this->total_records > 0) {
            $global_rules = array_slice($global_rules, (int)$this->getPageStart(), $this->tbl_row_limit);
            foreach ($global_rules as $key => $rule) {
                $view_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'render_type' => 'view',
                        'id_price_rule' => $rule['id_booking_price_rule']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $delete_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'delete',
                        'id_price_rule' => $rule['id_booking_price_rule']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                if ($rule['date_selection'] == 'date_range') {
                    $start_date = $rule['start_date'];
                    $end_date = $rule['end_date'];
                    $particular_date = '--';
                } else {
                    $start_date = '--';
                    $end_date = '--';
                    $particular_date = $rule['particular_date'];
                }
                $row_html .= '<tr>';
                $row_html .= '<td>' . $rule['id_booking_price_rule'] . '</td>';
                $row_html .= '<td>' . $rule['rule_name'] . '</td>';
                $row_html .= '<td>' . $rule['product_name'] . '</td>';
                $row_html .= '<td>' . $start_date . '</td>';
                $row_html .= '<td>' . $end_date . '</td>';
                $row_html .='<td>' . $particular_date . '</td>';
                $row_html .='<td>' . $status[$rule['active']] . '</td>';
                $row_html .='<td>' . $rule['date_upd'] . '</td>';
                
                $action_block = '<a class="kb_list_action " href="' . $view_link . '" title="' . $this->module->l('Click to view', $this->controller_name) . '"><i class="kb-material-icons kb-multiaction-icon">&#xe22b;</i></a>
                <a class="kb_list_action " href="javascript:void(0)" data-href="' . $delete_link . '" title="' . $this->module->l('Click to delete', $this->controller_name) . '" onclick="actionDeleteConfirmation(this);"><i class="kb-material-icons kb-multiaction-icon">&#xe872;</i></a>';
                $row_html .='<td>' . $action_block . '</td>';
                $row_html .='</tr>';
            }
            $this->table_id = 'seller_pricerules_filter';
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
    
    public function initContent()
    {
        if (Tools::getIsset('render_type') && Tools::getValue('render_type') == 'view') {
            $this->addJS($this->getKbModuleDir().'views/js/front/price_rule_form.js');
            $this->renderRuleView();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'saveRuleData') {
            if (Tools::getValue('id_price_rule') != 0) {
                $this->updateDynamicRuleData();
            } else {
                $this->addDynamicRuleData();
            }
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'delete') {
            $this->deletePriceRule();
        } else {
            $this->addJS($this->getKbModuleDir().'views/js/front/price_rule_form.js');
            $this->renderList();
        }
        parent::initContent();
    }
    
    public function addDynamicRuleData()
    {
        $name = array();
        foreach (Language::getLanguages(false) as $lang) {
//            $name[$lang['id_lang']] = trim(Tools::getValue('name_' . $lang['id_lang']));
            $name[$lang['id_lang']] = trim(Tools::getValue('name'));
        }
        $id_product= Tools::getValue('id_product');
        $date_selection = Tools::getValue('date_selection');
        $start_date = trim(Tools::getValue('start_date'));
        $end_date = trim(Tools::getValue('end_date'));
        $particular_date = trim(Tools::getValue('particular_date'));
        $reduction = trim(Tools::getValue('reduction'));
        $reduction_type = Tools::getValue('reduction_type');
        
        $active= Tools::getValue('active');
        if ($date_selection == 'date_range') {
            $compare_start = $start_date;
            $compare_end = $end_date;
            $particular_date = date('Y-m-d H:i:s', strtotime('1970-01-01 00:00:00'));
        } else {
            $compare_start = date('Y-m-d H:i:s', strtotime($particular_date.' 00:00:00'));
            $compare_end = date('Y-m-d H:i:s', strtotime($particular_date . ' 23:59:00'));
            $start_date = date('Y-m-d H:i:s', strtotime('1970-01-01 00:00:00'));
            $end_date = date('Y-m-d H:i:s', strtotime('1970-01-01 23:59:59'));
        }
        if ($this->checkRangeExist($id_product, $compare_start, $compare_end)) {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Rule cannot be created as range is already exist.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        }

        $kbBookingRule = new KbBookingPriceRule();
        $kbBookingRule->name = $name;
        $kbBookingRule->id_product = $id_product;
        $kbBookingRule->date_selection = $date_selection;
        $kbBookingRule->start_date = $start_date;
        $kbBookingRule->end_date = $end_date;
        $kbBookingRule->active = $active;
        $kbBookingRule->particular_date = $particular_date;
        
        $kbBookingRule->reduction_type = $reduction_type;
        $kbBookingRule->reduction = $reduction;
        if ($kbBookingRule->add()) {
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Rule successfully added.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        }
    }
    public function updateDynamicRuleData()
    {
        $name = array();
        $id_booking_price_rule = Tools::getValue('id_price_rule');
        foreach (Language::getLanguages(false) as $lang) {
//            $name[$lang['id_lang']] = trim(Tools::getValue('name_' . $lang['id_lang']));
            $name[$lang['id_lang']] = trim(Tools::getValue('name'));
        }
        $id_product= Tools::getValue('id_product');
        $date_selection = Tools::getValue('date_selection');
        $start_date = trim(Tools::getValue('start_date'));
        $end_date = trim(Tools::getValue('end_date'));
        $particular_date = trim(Tools::getValue('particular_date'));
        $reduction = trim(Tools::getValue('reduction'));
        $reduction_type = Tools::getValue('reduction_type');
        
        $active= Tools::getValue('active');
        if ($date_selection == 'date_range') {
            $compare_start = $start_date;
            $compare_end = $end_date;
            $particular_date = date('Y-m-d H:i:s', strtotime('1970-01-01 00:00:00'));
        } else {
            $compare_start = date('Y-m-d H:i:s', strtotime($particular_date . ' 00:00:00'));
            $compare_end = date('Y-m-d H:i:s', strtotime($particular_date . ' 23:59:00'));
            $start_date = date('Y-m-d H:i:s', strtotime('1970-01-01 00:00:00'));
            $end_date = date('Y-m-d H:i:s', strtotime('1970-01-01 23:59:59'));
        }
        if ($this->checkRangeExist($id_product, $compare_start, $compare_end, $id_booking_price_rule)) {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Rule cannot be created as range is already exist.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        }
        $kbBookingRule = new KbBookingPriceRule($id_booking_price_rule);
        $kbBookingRule->name = $name;
        $kbBookingRule->id_product = $id_product;
        $kbBookingRule->date_selection = $date_selection;
        $kbBookingRule->active = $active;
        if ($date_selection == 'date_range') {
            $kbBookingRule->start_date = $start_date;
            $kbBookingRule->end_date = $end_date;
            $kbBookingRule->particular_date = '1971-01-01';
        } else {
            $kbBookingRule->start_date = '1971-01-01';
            $kbBookingRule->end_date = '1971-01-01';
            $kbBookingRule->particular_date = $particular_date;
        }
        $kbBookingRule->reduction_type = $reduction_type;
        $kbBookingRule->reduction = $reduction;
        if ($kbBookingRule->update()) {
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Rule successfully udpated.', $this->controller_name)
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        }
    }

    public function checkRangeExist($id_product, $start, $end, $id = null)
    {
        /*
         * We have added the compatibility with our Booking Calender plugin and we are using the function of that module class
         * that's why we have used its function.
         */
        $existing_rec = KbBookingPriceRule::getRulebyProductID($id_product);
        if (!empty($existing_rec)) {
            foreach ($existing_rec as $rec) {
                if (!empty($id)) {
                    if ($id == $rec['id_booking_price_rule']) {
                        continue;
                    }
                }
                if ($rec['date_selection'] == 'date_range') {
                    if ($this->dateIsBetween($start, $end, $rec['start_date'], $rec['end_date'])) {
                        return true;
                    }
                } else {
                    if (strtotime($rec['particular_date']) >= strtotime($start) and (strtotime($rec['particular_date']) <=  strtotime($end))) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    private function dateIsBetween($dbfrom1, $dbto1, $user_st, $user_et)
    {
        if (((strtotime($dbfrom1) >= strtotime($user_st)) and ( strtotime($dbfrom1) <= strtotime($user_et)))
            or ( strtotime($dbto1) >= strtotime($user_st)) and ( strtotime($dbto1) <= strtotime($user_et))) {
            return true;
        } else {
            return false;
        }
    }
    
    public function deletePriceRule()
    {
        $id_rule = Tools::getValue('id_price_rule', 0);
        
//        $is_seller_rule = 0;
        if ($id_rule != 0) {
            $rule_obj = new KbBookingPriceRule($id_rule);
            if ($rule_obj->delete()) {
                $this->context->cookie->__set(
                    'redirect_success',
                    $this->module->l('Price rule has been successfully deleted.', $this->controller_name)
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
    public function addPriceRuleData()
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
    
    public function updatePriceRuleData()
    {
        $obj = new KbDynamicPricingRules((int) Tools::getValue('id_price_rule', 0));
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
            $page_title = $this->module->l('Price Rules', $this->controller_name);
            $page['meta']['title'] = $page_title;
            $page['meta']['keywords'] = $this->seller_info['meta_keyword'];
            $page['meta']['description'] = $this->seller_info['meta_description'];
        }
        return $page;
    }
    
    private function renderList()
    {
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Module::isInstalled('kbbookingcalendar') && Module::isEnabled('kbbookingcalendar')) {
            $this->total_records = 0;
            $price_rules = $this->getPriceRulesbyIdSeller($this->seller_obj->id);
            if (is_array($price_rules) && count($price_rules) > 0) {
                $this->total_records = count($price_rules);
            }
            if ($this->total_records > 0) {
                $this->filter_header = $this->module->l('Filter Your Search', $this->controller_name);
                $this->filter_id = 'seller_pricerules_filter';
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
                        'label' => $this->module->l('Id ', $this->controller_name),
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'rule_name',
                        'label' => $this->module->l('Rule Name', $this->controller_name),
                    ),
                    array(
                        'type' => 'text',
                        'name' => 'product_name',
                        'label' => $this->module->l('Product Name', $this->controller_name),
                    ),
                    array(
                        'type' => 'select',
                        'placeholder' => $this->module->l('Select', $this->controller_name),
                        'name' => 'status',
                        'label' => $this->module->l('Status', $this->controller_name),
                        'values' => $status_type,
                    ),
                );
                $this->filter_action_name = 'getFilteredRules';
                $this->context->smarty->assign('kbfilter', $this->renderKbListFilter());

                $this->table_id = 'seller_pricerules_filter';
                $this->table_header = array(
                    array(
                        'label' => $this->module->l('ID', $this->controller_name),
                        'align' => 'right',
                        'width' => '60'
                    ),
                    array(
                        'label' => $this->module->l('Price Rule', $this->controller_name),
                        'width' => '80'),
                    array(
                        'label' => $this->module->l('Product Name', $this->controller_name),
                        'width' => '80'),
                    array(
                        'label' => $this->module->l('Start Date', $this->controller_name),
                        'width' => '100'),
                    array(
                        'label' => $this->module->l('End Date', $this->controller_name),
                        'width' => '100'),
                    array(
                        'label' => $this->module->l('Specific Date', $this->controller_name),
                        'width' => '100'),
                    array(
                        'label' => $this->module->l('Status', $this->controller_name),
                        'width' => '80'),
                    array(
                        'label' => $this->module->l('Updated on', $this->controller_name),
                        'width' => '100'),
                    array(
                        'label' => $this->module->l('Action', $this->controller_name),
                        'width' => '100')
                );
            
                $price_rules = array_slice($price_rules, 0, $this->tbl_row_limit);
                $status = array();
                $status[1] = $this->module->l('Yes', $this->controller_name);
                $status[0] = $this->module->l('No', $this->controller_name);
                foreach ($price_rules as $rule_key => $rule) {
                    $view_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'render_type' => 'view',
                            'id_price_rule' => $rule['id_booking_price_rule']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $delete_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'action_type' => 'delete',
                            'id_price_rule' => $rule['id_booking_price_rule']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
//                    $action_block = array(
//                        array(
//                            'type' => 'edit',
//                            'href' => $view_link,
//                            'title' => $this->module->l('Click to edit', $this->controller_name),
//                            'label' => $this->module->l('Edit', $this->controller_name),
//                            'icon-class' => '&#xe22b'
//                        ),
//                        array(
//                            'type' => 'delete',
//                            'href' => $delete_link,
//                            'icon-class' => '&#xe872'
//                        )
//                    );
                    if ($rule['date_selection'] == 'date_range') {
                        $start_date = $rule['start_date'];
                        $end_date = $rule['end_date'];
                        $particular_date = '--';
                    } else {
                        $start_date = '--';
                        $end_date = '--';
                        $particular_date = $rule['particular_date'];
                    }
                        
                    $this->table_content[] = array(
                        array(
                            'value' => $rule['id_booking_price_rule']),
                        array(
                            'value' => $rule['rule_name']),
                        array(
                            'value' => $rule['product_name']),
                        array(
                            'value' => $start_date),
                        array(
                            'value' => $end_date),
                        array(
                            'value' => $particular_date),
                        array(
                            'value' => $status[$rule['active']]),
                        array(
                            'value' => $rule['date_upd']),
                        array(
                            'actions' => array(
                                array(
                                    'href' => $view_link,
                                    'title' => $this->module->l('Click to edit rule', $this->controller_name),
                                    'icon-class' => '&#xe22b'
                                ),
                                array(
                                    'function' => 'KbDeleteActionPriceRule("'.$delete_link.'")',
//                                    'href' => $delete_link,
                                    'title' => $this->module->l('Click to delte rule', $this->controller_name),
                                    'icon-class' => '&#xe872'
                                )
                            )
                        ),
//                        array(
//                            'input' => array(
//                            'type' => 'action'),
//                            'actions' => $action_block
//                        ),
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
                'id_price_rule' => 0
            ),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        $this->context->smarty->assign('new_price_rule_link', $new_rule_link);
        $this->setKbTemplate('bookingProduct/price_rules/rules_list.tpl');
    }

    private function renderRuleView()
    {
        $id_rule = Tools::getValue('id_price_rule', 0);
        $is_seller_rule = 0;
        if ($id_rule != 0) {
            $rule_obj = new KbBookingPriceRule($id_rule);
            if ((int)KbSellerProduct::getSellerIdByProductId($rule_obj->id_product) == (int)$this->seller_obj->id) {
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
                'price_rule_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'saveRuleData',
                        'id_price_rule' => $id_rule
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (Module::isInstalled('kbbookingcalendar') && Module::isEnabled('kbbookingcalendar')) {
                $sellers_products = KbSellerProduct::getSellerBookingProducts(
                    $this->seller_obj->id,
                    false
                );
                foreach ($sellers_products as &$seller_product) {
                    $properties = 'name';
                    $prod_obj = new Product($seller_product['id_product']);
                    $seller_product['product_name'] = $this->getFieldValue($prod_obj, $properties, $this->default_form_language);
                }
                $this->context->smarty->assign('sellers_products', $sellers_products);
                $languages = Language::getLanguages();
                
                foreach ($languages as $k => $language) {
                    $languages[$k]['is_default'] = ((int) ($language['id_lang'] == $this->context->language->id));
                }
                $rule_name = '';
                if ($id_rule != 0) {
                    $rule_obj = new KbBookingPriceRule((int) $id_rule);
                    if (isset($rule_obj->name[$this->context->language->id]) && $rule_obj->name[$this->context->language->id] != '') {
                        $rule_name = $rule_obj->name[$this->context->language->id];
                    }
                    
//                    $this->context->smarty->assign('rule_name', );
                    $this->context->smarty->assign('id_price_rule', $id_rule);
                    $this->context->smarty->assign('price_rule_obj', $rule_obj);
                } else {
                    $this->context->smarty->assign('id_price_rule', 0);
                }
                $this->context->smarty->assign('rule_name', $rule_name);
            }
            $this->setKbTemplate('bookingProduct/price_rules/rule_form.tpl');
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
    
    public function getPriceRulesbyIdSeller($id_seller = 0)
    {
        $filter_condition = '';
        if (Tools::getIsset('id_rule') && Tools::getValue('id_rule') != '') {
            $id_rule = (int) trim(Tools::getValue('id_rule'));
            $filter_condition .= ' and a.id_booking_price_rule LIKE "%' . pSQL($id_rule) . '%"';
        }
        if (Tools::getIsset('rule_name') && Tools::getValue('rule_name') != '') {
            $rule_name = trim(Tools::getValue('rule_name'));
            $filter_condition .= ' and l.name LIKE "%' . pSQL($rule_name) . '%"';
        }
        if (Tools::getIsset('status') && Tools::getValue('status') != '') {
            $status = (int)trim(Tools::getValue('status'));
            $filter_condition .= ' and a.active LIKE "%' . pSQL($status) . '%"';
        }
        if (Tools::getIsset('product_name') && Tools::getValue('product_name') != '') {
            $product_name = Tools::getValue('product_name');
            $filter_condition .= ' and pl.name LIKE "%' . pSQL($product_name) . '%"';
        }
        $result = array();
        $inner_join = '';
        $where_cond = '';
        $id_lang = $this->context->language->id;
        $sql = 'Select a.*,l.name as rule_name,s.id_shop,pl.name as product_name from `' . _DB_PREFIX_ . 'kb_booking_price_rule` as a';
        $inner_join = ' INNER JOIN `' . _DB_PREFIX_ . 'kb_booking_price_rule_lang` l on (a.id_booking_price_rule=l.id_booking_price_rule AND l.id_lang='
                .(int)Context::getContext()->language->id.' AND l.id_shop='.(int)Context::getContext()->shop->id.') ';
        $inner_join .= ' INNER JOIN `' . _DB_PREFIX_ . 'kb_booking_price_rule_shop` s on (a.id_booking_price_rule=s.id_booking_price_rule) ';
        $inner_join .= ' INNER JOIN `' . _DB_PREFIX_ . 'product_lang` pl on (a.id_product=pl.id_product AND pl.id_lang='.(int)$id_lang.') ';
        $inner_join .= ' INNER JOIN `' . _DB_PREFIX_ . 'kb_mp_seller_product` sp on (sp.id_product=a.id_product) ';
        $where_cond = ' AND s.id_shop IN ('.(int)Context::getContext()->shop->id.') and sp.id_seller = '.(int) $id_seller;
//            where is_seller_zone = ' . (int) $id_seller . $filter_condition. ' GROUP BY a.id_price_rule';
        $sql .= $inner_join.$where_cond.$filter_condition;
        $result = DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (is_array($result) && count($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }
}
