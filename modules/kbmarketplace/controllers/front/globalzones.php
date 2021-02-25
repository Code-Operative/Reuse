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

class KbmarketplaceGlobalZonesModuleFrontController extends KbmarketplaceCoreModuleFrontController
{

    public $controller_name = 'globalzones';
    public $errors = array();
    protected $default_form_language;

    public function __construct()
    {
        parent::__construct();
        $this->default_form_language = $this->context->language->id;
    }

    public function setMedia()
    {
        $this->addJS($this->getKbModuleDir() . 'views/js/front/Product_availability_zipcode.js');
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
                    case 'getFilteredZones':
                        $this->json = $this->getAjaxZoneListHtml();
                        break;
                    case 'getSellerFilteredZipcodes':
                        $this->json = $this->getAjaxZipcodeListHtml();
                        break;
                }
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
            $this->renderZoneView();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'edit') {
            $this->editGlobalZoneForm();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'saveZone') {
            $id_zone = Tools::getValue('id_zone', 0);
            if ($id_zone) {
                $this->updateZone();
            } else {
                $this->saveZone();
            }
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'delete') {
            $this->deleteGlobalZone();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'deletezipcode') {
            $this->deleteZipCode();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'editzipcode') {
            $this->renderZipcodeView();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'mapZipcodes') {
            $this->mapZipcodesToZone();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'saveZipcode') {
            $this->updateZipcodeMapping();
        } elseif (Tools::getIsset('render_type') && Tools::getValue('render_type') == 'addzipcodes') {
            $this->renderNewZipcodesForm();
        } else {
            $this->renderList();
        }
        parent::initContent();
    }

    public function getAjaxZoneListHtml()
    {
        $json = array();
        $this->total_records = 0;
        $global_zones = $this->getGlobalZonesbyIdSeller($this->seller_obj->id);
        if (is_array($global_zones) && count($global_zones) > 0) {
            $this->total_records = count($global_zones);
        }
        if (Tools::getIsset('start') && (int)Tools::getValue('start') > 0) {
            $this->page_start = (int)Tools::getValue('start');
        }
        if ($this->total_records > 0) {
            $global_zones = array_slice($global_zones, (int)$this->getPageStart(), $this->tbl_row_limit);
            $row_html = '';
            foreach ($global_zones as $zone_key => $zone) {
                $action_block = '';
                $view_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'render_type' => 'view',
                        'id_zone' => $zone['id_kb_pacbz_zones']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $edit_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'edit',
                        'id_zone' => $zone['id_kb_pacbz_zones']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $delete_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'delete',
                        'id_zone' => $zone['id_kb_pacbz_zones']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $row_html .= '<tr>';
                $row_html .= '<td>' . $zone['id_kb_pacbz_zones'] . '</td>';
                $row_html .='<td>' . $zone['zone_name'] . '</td>';
                $row_html .='<td>' . $zone['zip_count'] . '</td>';
                $action_block = '<a class="kb_list_action " href="' . $view_link . '" title="' . $this->module->l('Click to view', 'globalzones') . '">View</a>
                <a class="kb_list_action " href="' . $edit_link . '" title="">' . $this->module->l('Edit', 'globalzones') . '</a>
                <a class="kb_list_action " href="javascript:void(0)" data-href="' . $delete_link . '" title="" onclick="actionDeleteConfirmation(this);">' . $this->module->l('Delete', 'globalzones') . '</a>';
                $row_html .='<td>' . $action_block . '</td>';
                $row_html .='</tr>';
            }

            $this->table_id = 'seller_globalzones_filter';
            $this->list_row_callback = 'getFilteredZones';
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
            $json['msg'] = $this->module->l('No Data Found', 'globalzones');
        }
        return $json;
    }

    public function getAjaxZipcodeListHtml()
    {
        $json = array();
        $this->total_records = 0;
        $id_zone = Tools::getValue('id_zone', 0);
        if (Tools::getIsset('start') && (int)Tools::getValue('start') > 0) {
            $this->page_start = (int)Tools::getValue('start');
        }
        $global_zones_zipcode = $this->getAllZipcodesByIdSellerAndZone($this->seller_obj->id, $id_zone);
        if (is_array($global_zones_zipcode) && count($global_zones_zipcode) > 0) {
            $this->total_records = count($global_zones_zipcode);
        }
        if ($this->total_records > 0) {
            $global_zones_zipcode = array_slice($global_zones_zipcode, (int)$this->getPageStart(), $this->tbl_row_limit);
            $row_html = '';
            foreach ($global_zones_zipcode as $zipcode_key => $zipcode) {
// changes over
                $edit_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'editzipcode',
                        'id_zone' => $id_zone,
                        'id_zipcode' => $zipcode['id_kb_pacbz_zone_zipcode_mapping']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $delete_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'deletezipcode',
                        'id_zone' => $id_zone,
                        'id_zipcode' => $zipcode['id_kb_pacbz_zone_zipcode_mapping']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $row_html .= '<tr>';
                $row_html .= '<td>' . $zipcode['id_kb_pacbz_zone_zipcode_mapping'] . '</td>';
                $row_html .='<td>' . $zipcode['zipcode'] . '</td>';
                $row_html .='<td>' . $zipcode['deliver_by'] . '</td>';
                $row_html .='<td>' . $zipcode['availability'] . '</td>';
                $action_block = '<a class="kb_list_action " href="' . $edit_link . '" title="">' . $this->module->l('Edit', 'globalzones') . '</a>
                <a class="kb_list_action " href="javascript:void(0)" data-href="' . $delete_link . '" title="" onclick="actionDeleteConfirmation(this);">' . $this->module->l('Delete', 'globalzones') . '</a>';
                $row_html .='<td>' . $action_block . '</td>';
                $row_html .='</tr>';
            }
            $this->table_id = 'getSellerFilteredZipcodes';
            $this->list_row_callback = 'getSellerFilteredZipcodes';
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
            $json['msg'] = $this->module->l('No Data Found', 'globalzones');
        }
        return $json;
    }

    public function updateZone($id_zone = 0)
    {
        $error_count = 0;
        $zone_name = Tools::getValue('zone_name');
        if (!empty($zone_name)) {
            $sql = 'SELECT zone_name FROM `' . _DB_PREFIX_ . 'kb_pacbz_zones`' .
                ' where zone_name ="' . pSQL($zone_name) . '" AND id_kb_pacbz_zones != ' . (int) $id_zone;
            $results = Db::getInstance()->ExecuteS($sql);
            if ($results != null) {
                $error_msg = $this->module->l('This zone name already exist.', 'globalzones');
                $error_count++;
            }
        } else {
            $error_msg = $this->module->l('Zone Name can not be empty.', 'globalzones');
            $error_count++;
        }
        /* Knowband validation end */
        if ($error_count == 0) {
//Inserting values if no error occurs
            $sql = 'UPDATE `' . _DB_PREFIX_ . 'kb_pacbz_zones` SET zone_name = "' . pSQL($zone_name) .
                '" where id_kb_pacbz_zones ="' . pSQL($id_zone) . '"';
            Db::getInstance()->execute($sql);
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Zone Data has been successfully updated.', 'globalzones')
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
                'redirect_success',
                $this->module->l('The Zone data could not be updated because ', 'globalzones')
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(
                    'id_zone' => $id_zone,
                    'render_type' => 'edit',
                ),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        }
    }

    public function updateZipcodeMapping()
    {

        $error_count = 0;
        $formvalue = array();
        $formvalue['deliver_by'] = Tools::getValue('deliever_by', 0);
        $formvalue['availability'] = Tools::getValue('availability', 0);
        /* Knowband validation start */
        if ($formvalue['deliver_by'] != null) {
            $formvalue['deliver_by'] = trim($formvalue['deliver_by']);
            if (preg_match('/^\d+$/', $formvalue['deliver_by']) && $formvalue['deliver_by'] > 0) {
                if (Tools::strlen((string) $formvalue['deliver_by']) > 3) {
                    $this->errors[] = $this->module->l('Number of days must be less than 1000.', 'globalzones');
                    $error_count++;
                }
            } else {
                $this->errors[] = $this->module->l('Only positive integer value allowed.', 'globalzones');
                $error_count++;
            }
        } else {
            $this->errors[] = $this->module->l('Please enter number of days of delivery.', 'globalzones');
            $error_count++;
        }
        /* Knowband validation end */
        $id_zipcode = Tools::getValue('id_zipcode', 0);
        $zone_id = Tools::getValue('id_zone', 0);
        if ($error_count == 0) {
            //Inserting values if no error occurs
            $sql4 = 'UPDATE `' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping` SET ' .
                'availability = "' . pSQL($formvalue['availability']) .
                '" ,deliver_by="' . pSQL($formvalue['deliver_by']) . '" where id_kb_pacbz_zone_zipcode_mapping ="' .
                pSQL($id_zipcode) . '"';
            Db::getInstance()->execute($sql4);
            $error_msg = $this->module->l('Zipcode data is  successfully updated.', 'globalzones');
            $this->context->cookie->__set(
                'redirect_success',
                $error_msg,
                'globalzones'
            );
            $view_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(
                    'render_type' => 'view',
                    'id_zone' => $zone_id
                ),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($view_link);
        } else {
            $sql = 'SELECT zone_name FROM `' .
                _DB_PREFIX_ . 'kb_pacbz_zones` where id_kb_pacbz_zones ="' . pSQL($zone_id) . '"';
            $zone_name = Db::getInstance()->getValue($sql);

            $sql = 'Select `id_kb_pacbz_zone_zipcode_mapping`,`zipcode`,`deliver_by`,`availability` from ' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping 
            where zone_id = ' . (int) $zone_id . ' AND id_kb_pacbz_zone_zipcode_mapping = ' . (int) $id_zipcode;
            $zone_data = Db::getInstance()->getRow($sql);
            $zone_data['availability'] = $formvalue['availability'];
            $zone_data['deliver_by'] = $formvalue['deliver_by'];
            $this->context->smarty->assign('zone_data', $zone_data);
            $this->context->smarty->assign('zone_name', $zone_name);
            $this->context->smarty->assign('form_heading', $zone_name . ' : ' . $zone_data['zipcode']);
            $this->context->smarty->assign(
                'zipcode_view_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'saveZipcode',
                        'id_zone' => $zone_id,
                        'id_zipcode' => $id_zipcode
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->setKbTemplate('seller/zipcode/zipcodeviewform.tpl');
        }
    }

    public function saveZone($id_zone = 0)
    {
        $error_count = 0;
        $formvalue = array();
        $formvalue['zone_name'] = Tools::getValue('zone_name', '');
        $formvalue['zip-codes'] = Tools::getValue('zip-codes', '');
        $formvalue['deliver_by'] = Tools::getValue('deliever_by', 0);
        $formvalue['availability'] = Tools::getValue('availability', 0);
        /* Knowband validation start */
        if (!empty($formvalue['zone_name'])) {
            $sql0 = 'SELECT zone_name FROM `' . _DB_PREFIX_ . 'kb_pacbz_zones`' .
                ' where zone_name ="' . pSQL($formvalue['zone_name']) . '"';
            $results0 = Db::getInstance()->ExecuteS($sql0);
            if ($results0 != null) {
                $this->errors[] = $this->module->l('This zone name already exist.', 'globalzones');
                $error_count++;
            }
        } else {
            $this->errors[] = $this->module->l('Please enter zone name.', 'globalzones');
            $error_count++;
        }
        /* Knowband validation end */
        /* Knowband validation start */
        if (!empty($formvalue['zip-codes'])) {
            $pv_zip_codes = explode(",", $formvalue['zip-codes']);
            $pv_zip_codes = array_map('trim', $pv_zip_codes);
            $pv_zip_codes = array_unique($pv_zip_codes);
            $pv_zip_codes = array_filter($pv_zip_codes);

            $i = 0;
            foreach ($pv_zip_codes as $pv_zip_code) {
                if (Tools::strlen((string) $pv_zip_code) <= 10) {
                    if (Validate::isPostCode($pv_zip_code) == false) {
                        $this->errors[] = $this->module->l('Please enter valid zip-code.', 'globalzones');
                        $error_count++;
                        break;
                    }

                    $sql1 = 'SELECT m.zipcode,z.zone_name FROM `' . _DB_PREFIX_ .
                        'kb_pacbz_zone_zipcode_mapping`' .
                        ' as m inner join `' . _DB_PREFIX_ . 'kb_pacbz_zones` as z on' .
                        ' z.id_kb_pacbz_zones = m.zone_id where zipcode ="' . pSQL($pv_zip_code) . '" and z.is_seller_zone = "'. psql($this->seller_obj->id) .'"';
                    $results = Db::getInstance()->ExecuteS($sql1);
                    if ($results != null) {
                        foreach ($results as $result) {
                            $erro1 = $this->module->l('Zipcode ', 'globalzones');
                            $erro2 = $this->module->l(' already exist in zone', 'globalzones');
                            $this->errors[] = $erro1 . " " . $result['zipcode'] . " " . $erro2 . " " . $result['zone_name'];
                            $error_count++;
                            break;
                        }
                    }
                } else {
                    $this->errors[] = $this->module->l('Please enter valid zip-code.', 'globalzones');
                    $error_count++;
                    break;
                }
                $i++;
            }
        } else {
            $this->errors[] = $this->module->l('Please enter at least one zip-code.', 'globalzones');
            $error_count++;
        }
        /* Knowband validation end */
        /* Knowband validation start */
        $formvalue['deliver_by'] = trim($formvalue['deliver_by']);
        if ($formvalue['deliver_by'] != null) {
            if (preg_match('/^\d+$/', $formvalue['deliver_by']) && $formvalue['deliver_by'] > 0) {
                if (Tools::strlen((string) $formvalue['deliver_by']) > 3) {
                    $this->errors[] = $this->module->l('Number of days must be less than 1000.', 'globalzones');
                    $error_count++;
                }
            } else {
                $this->errors[] = $this->module->l('Only positive integer values allowed.', 'globalzones');
                $error_count++;
            }
        } else {
            $this->errors[] = $this->module->l('Please enter number of days of delivery.', 'globalzones');
            $error_count++;
        }
        /* Knowband validation end */
        if ($error_count == 0) {
//Inserting values if no error occurs
            $sql2 = 'INSERT INTO `' . _DB_PREFIX_ . 'kb_pacbz_zones`(`id_kb_pacbz_zones`, `zone_name`,`is_seller_zone`) ' .
                'VALUES ("" , "' . pSQL($formvalue['zone_name']) . '" , ' . (int) $this->seller_obj->id . ')';
            Db::getInstance()->execute($sql2);

            $zone_id = Db::getInstance()->Insert_ID();

            $pv_zip_codes = explode(",", $formvalue['zip-codes']);
            $pv_zip_codes = array_map('trim', $pv_zip_codes);
            $pv_zip_codes = array_unique($pv_zip_codes);
            $pv_zip_codes = array_filter($pv_zip_codes);
            $i = 0;
            foreach ($pv_zip_codes as $pv_zip_code) {
                $sql3 = 'INSERT INTO `' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping`' .
                    '(`id_kb_pacbz_zone_zipcode_mapping`, `zone_id`, `zipcode`,`deliver_by` ,' .
                    '`availability`) VALUES ("" ,"' . pSQL($zone_id) . '", "' . pSQL($pv_zip_code) . '" ,' .
                    ' "' . pSQL($formvalue['deliver_by']) . '" , "' . pSQL($formvalue['availability']) . '")';
                Db::getInstance()->execute($sql3);
                $i++;
            }
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('New Zone has been successfully added.', 'globalzones')
            );
            $redirect_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($redirect_link);
        } else {
            $error_msg = '';
            foreach ($this->errors as $key => $error) {
                if ($error_msg != '') {
                    $error_msg .= '####';
                }
                $error_msg .= $error;
            }
            $this->context->cookie->__set(
                'redirect_error',
                $error_msg,
                'globalzones'
            );
            $this->context->smarty->assign('form_heading', $this->module->l('Add New Zone', $this->controller_name));
            $this->context->smarty->assign('formvalue', $formvalue);
            $this->context->smarty->assign(
                'zone_view_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'saveZone'
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->context->smarty->assign(
                'cancel_button',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->setKbTemplate('seller/zipcode/newGlobalZoneform.tpl');
        }
    }

    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();
        if (isset($page['meta']) && $this->seller_info) {
            $page_title = $this->module->l('Global Zones', 'globalzones');
            $page['meta']['title'] = $page_title;
            $page['meta']['keywords'] = $this->seller_info['meta_keyword'];
            $page['meta']['description'] = $this->seller_info['meta_description'];
        }
        return $page;
    }

    private function renderList()
    {
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Module::isInstalled('productavailabilitycheckbyzipcode') && Module::isEnabled('productavailabilitycheckbyzipcode')) {
            $this->filter_header = $this->module->l('Filter Your Search', 'globalzones');
            $this->filter_id = 'seller_globalzones_filter';
            $this->filters = array(
                array(
                    'type' => 'text',
                    'name' => 'id_zone',
                    'label' => $this->module->l('Zone Id ', 'globalzones'),
                ),
                array(
                    'type' => 'text',
                    'name' => 'zone_name',
                    'label' => $this->module->l('Zone Name ', 'globalzones'),
                ),
            );
            $this->filter_action_name = 'getFilteredZones';
            $this->context->smarty->assign('kbfilter', $this->renderKbListFilter());

            $this->table_id = 'seller_globalzones_filter';
            $this->table_header = array(
                array(
                    'label' => $this->module->l('Zone ID', 'globalzones'),
                    'align' => 'right',
                    'width' => '60'
                ),
                array(
                    'label' => $this->module->l('Zone Name', 'globalzones'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Total Zipcodes', 'globalzones'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Action', 'globalzones'),
                    'width' => '100')
            );
            $this->total_records = 0;
            $zipcode_mod_obj = Module::getInstanceByName('productavailabilitycheckbyzipcode');
            $global_zones = $this->getGlobalZonesbyIdSeller($this->seller_obj->id);
            if (is_array($global_zones) && count($global_zones) > 0) {
                $this->total_records = count($global_zones);
            }
            if ($this->total_records > 0) {
                $global_zones = array_slice($global_zones, 0, $this->tbl_row_limit);
                foreach ($global_zones as $zone_key => $zone) {
// changes over
                    $view_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'render_type' => 'view',
                            'id_zone' => $zone['id_kb_pacbz_zones']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $edit_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'action_type' => 'edit',
                            'id_zone' => $zone['id_kb_pacbz_zones']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $delete_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'action_type' => 'delete',
                            'id_zone' => $zone['id_kb_pacbz_zones']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $action_block = array(
                        array(
                            'type' => 'view',
                            'href' => $view_link,
                            'title' => $this->module->l('Click to view', 'globalzones'),
                            'label' => $this->module->l('View', 'globalzones'),
                        ),
                        array(
                            'type' => 'edit',
                            'href' => $edit_link
                        ),
                        array(
                            'type' => 'delete',
                            'href' => $delete_link
                        )
                    );
                    $this->table_content[$zone['id_kb_pacbz_zones']] = array(
                        array(
                            'value' => $zone['id_kb_pacbz_zones']),
                        array(
                            'value' => $zone['zone_name']),
                        array(
                            'value' => $zone['zip_count']),
                        array(
                            'input' => array(
                                'type' => 'action'),
                            'class' => 'kb-tcenter',
                            'actions' => $action_block
                        ),
                    );
                }

                $this->list_row_callback = $this->filter_action_name;

                $this->table_enable_multiaction = false;
//Show Multi actions
            }

            $this->context->smarty->assign('kblist', $this->renderKbList());
        }
        $new_zone_link = $this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            array(
                'action_type' => 'edit'
            ),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        $this->context->smarty->assign('new_global_zone_link', $new_zone_link);
        $this->setKbTemplate('seller/zipcode/globalzones.tpl');
    }

    private function renderZoneView()
    {
        $this->context->smarty->assign(
            'cancel_button',
            $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Module::isInstalled('productavailabilitycheckbyzipcode') && Module::isEnabled('productavailabilitycheckbyzipcode')) {
            $this->filter_header = $this->module->l('Filter Your Search', 'globalzones');
            $this->filter_id = 'seller_globalzones_filter';
            $id_zone = Tools::getValue('id_zone', 0);
            $status_type = array(
                array(
                    'value' => 1,
                    'label' => $this->module->l('Yes', 'globalzones')),
                array(
                    'value' => 0,
                    'label' => $this->module->l('No', 'globalzones')),
            );
            $this->filters = array(
                array(
                    'type' => 'text',
                    'name' => 'id_zipcode',
                    'label' => $this->module->l('Id Zipcode', 'globalzones'),
                ),
                array(
                    'type' => 'text',
                    'name' => 'zipcode_number',
                    'label' => $this->module->l('Zipcode Number', 'globalzones'),
                ),
                array(
                    'type' => 'select',
                    'placeholder' => $this->module->l('Select', 'globalzones'),
                    'name' => 'staus',
                    'label' => $this->module->l('Availability', 'globalzones'),
                    'values' => $status_type
                ),
                array(
                    'type' => 'text',
                    'name' => 'delivery_by',
                    'label' => $this->module->l('Delievery By', 'globalzones'),
                ),
                array(
                    'type' => 'hidden',
                    'name' => 'id_zone',
                    'id' => 'id_zone',
                    'default' => $id_zone
                ),
            );
            $this->filter_action_name = 'getSellerFilteredZipcodes';
            $this->context->smarty->assign('kbfilter', $this->renderKbListFilter(1));

            $this->table_id = 'seller_globalzones_filter';
            $this->table_header = array(
                array(
                    'label' => $this->module->l('Zipcode ID', 'globalzones'),
                    'align' => 'right',
                    'width' => '60'
                ),
                array(
                    'label' => $this->module->l('Zipcode Number', 'globalzones'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Delievery By', 'globalzones'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Availability', 'globalzones'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Action', 'globalzones'),
                    'width' => '100')
            );
            $this->total_records = 0;
            $global_zones_zipcode = $this->getAllZipcodesByIdSellerAndZone($this->seller_obj->id, $id_zone);
            if (is_array($global_zones_zipcode) && count($global_zones_zipcode) > 0) {
                $this->total_records = count($global_zones_zipcode);
            }
            if ($this->total_records > 0) {
                $global_zones_zipcode = array_slice($global_zones_zipcode, 0, $this->tbl_row_limit);
                foreach ($global_zones_zipcode as $zipcode_key => $zipcode) {
// changes over
                    $edit_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'action_type' => 'editzipcode',
                            'id_zone' => $id_zone,
                            'id_zipcode' => $zipcode['id_kb_pacbz_zone_zipcode_mapping']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $delete_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'action_type' => 'deletezipcode',
                            'id_zone' => $id_zone,
                            'id_zipcode' => $zipcode['id_kb_pacbz_zone_zipcode_mapping']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $action_block = array(
                        array(
                            'type' => 'edit',
                            'href' => $edit_link
                        ),
                        array(
                            'type' => 'delete',
                            'href' => $delete_link
                        )
                    );
                    $this->table_content[$zipcode['id_kb_pacbz_zone_zipcode_mapping']] = array(
                        array(
                            'value' => $zipcode['id_kb_pacbz_zone_zipcode_mapping']),
                        array(
                            'value' => $zipcode['zipcode']),
                        array(
                            'value' => $zipcode['deliver_by']),
                        array(
                            'value' => $zipcode['availability']),
                        array(
                            'input' => array(
                                'type' => 'action'),
                            'class' => 'kb-tcenter',
                            'actions' => $action_block
                        ),
                    );
                }

                $this->list_row_callback = $this->filter_action_name;

                $this->table_enable_multiaction = false;
            }
            $this->context->smarty->assign('id_zone', $id_zone);
            $this->context->smarty->assign('kblist', $this->renderKbList());
        }
        $zone_id = Tools::getValue('id_zone', 0);
        $sql = 'SELECT zone_name FROM `'
            . _DB_PREFIX_ . 'kb_pacbz_zones` where id_kb_pacbz_zones ="' . pSQL($zone_id) . '"';
        $zone_name = Db::getInstance()->ExecuteS($sql);
        $this->context->smarty->assign('zone_name', $zone_name[0]['zone_name']);
        $add_zipcode_global_zone_link = $this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            array(
                'render_type' => 'addzipcodes',
                'id_zone' => $id_zone,
            ),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        $this->context->smarty->assign('add_zipcode_global_zone_link', $add_zipcode_global_zone_link);
        $this->context->smarty->assign(
            'cancel_button',
            $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );
        $this->setKbTemplate('seller/zipcode/avaiableZipcodesInZone.tpl');
    }

    public function mapZipcodesToZone()
    {
        $error_count = 0;
        $formvalue = array();
        $formvalue['zip-codes'] = Tools::getValue('zip-codes', '');
        $formvalue['deliver_by'] = Tools::getValue('deliever_by', 0);
        $formvalue['availability'] = Tools::getValue('availability', 0);
        $error_count = 0;
        /* Knowband validation start */
        if (!empty($formvalue['zip-codes'])) {
            $pv_zip_codes = explode(",", $formvalue['zip-codes']);
            $pv_zip_codes = array_map('trim', $pv_zip_codes);
            $pv_zip_codes = array_unique($pv_zip_codes);
            $pv_zip_codes = array_filter($pv_zip_codes);

            $i = 0;
            foreach ($pv_zip_codes as $pv_zip_code) {
                if (Tools::strlen((string) $pv_zip_code) <= 10) {
                    if (Validate::isPostCode($pv_zip_code) == false) {
                        $this->errors[] = $this->module->l('Please enter valid zip-code.', 'globalzones');
                        $error_count++;
                        break;
                    }

                    $sql1 = 'SELECT m.zipcode,z.zone_name FROM `' . _DB_PREFIX_ . 'kb_pacbz_zones`' .
                        ' as z inner join `' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping` as m on' .
                        ' z.id_kb_pacbz_zones = m.zone_id where zipcode ="' . pSQL($pv_zip_code)  . '" and z.is_seller_zone = "'. psql($this->seller_obj->id) .'"';
                    $results = Db::getInstance()->ExecuteS($sql1);
                    if ($results != null) {
                        foreach ($results as $result) {
                            $erro1 = $this->module->l('Zipcode ', 'globalzones');
                            $erro2 = $this->module->l(' already exist in zone', 'globalzones');
                            $this->errors[] = $erro1 . " " . $result['zipcode'] . " " . $erro2 . " " . $result['zone_name'];
                            $error_count++;
                            break;
                        }
                    }
                } else {
                    $this->errors[] = $this->module->l('Please enter valid zip-code.', 'globalzones');
                    $error_count++;
                    break;
                }
                $i++;
            }
        } else {
            $this->errors[] = $this->module->l('Please enter at least one zip-code.', 'globalzones');
            $error_count++;
        }
        /* Knowband validation end */
        /* Knowband validation start */
        if ($formvalue['deliver_by'] != null) {
            $formvalue['deliver_by'] = trim($formvalue['deliver_by']);
            if (preg_match('/^\d+$/', $formvalue['deliver_by']) && $formvalue['deliver_by'] > 0) {
                if (Tools::strlen((string) $formvalue['deliver_by']) > 3) {
                    $this->errors[] = $this->module->l('Number of days must be less than 1000.', 'globalzones');
                    $error_count++;
                }
            } else {
                $this->errors[] = $this->module->l('Only positive integer value allowed.', 'globalzones');
                $error_count++;
            }
        } else {
            $this->errors[] = $this->module->l('Please enter number of days of delivery.', 'globalzones');
            $error_count++;
        }
        /* Knowband validation end */
        /* Knowband validation start */
        $zone_id = Tools::getValue('id_zone', 0);
        /* Knowband validation end */
        if ($error_count == 0) {
            //Inserting values if no error occurs
            $pv_zip_codes = explode(",", $formvalue['zip-codes']);
            $pv_zip_codes = array_map('trim', $pv_zip_codes);
            $pv_zip_codes = array_unique($pv_zip_codes);
            $pv_zip_codes = array_filter($pv_zip_codes);
            $i = 0;
            foreach ($pv_zip_codes as $pv_zip_code) {
                $sql3 = 'INSERT INTO `' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping`' .
                    '(`id_kb_pacbz_zone_zipcode_mapping`, `zone_id`, `zipcode`,`deliver_by` ,' .
                    '`availability`) VALUES ("" ,"' . pSQL($zone_id) . '", "' . pSQL($pv_zip_code) . '" ,' .
                    ' "' . pSQL($formvalue['deliver_by']) . '" , "' . pSQL($formvalue['availability']) . '")';
                Db::getInstance()->execute($sql3);
                $i++;
            }
            $error_msg = $this->module->l('Zipcodes are successfully mapped to the zone');
            $this->context->cookie->__set(
                'redirect_success',
                $error_msg,
                'globalzones'
            );
            $view_link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(
                    'render_type' => 'view',
                    'id_zone' => $zone_id
                ),
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
            Tools::redirect($view_link);
        } else {
            $error_msg = '';
            foreach ($this->errors as $key => $error) {
                if ($error_msg != '') {
                    $error_msg .= '####';
                }
                $error_msg .= $error;
            }
            $this->context->cookie->__set(
                'redirect_error',
                $error_msg,
                'globalzones'
            );
            $this->context->smarty->assign('formvalue', $formvalue);
            $this->context->smarty->assign(
                'zone_view_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'saveZone'
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $sql = 'SELECT zone_name FROM `' .
                _DB_PREFIX_ . 'kb_pacbz_zones` where id_kb_pacbz_zones ="' . pSQL($zone_id) . '"';
            $zone_name = Db::getInstance()->getValue($sql);

            $this->context->smarty->assign('zone_name', $zone_name);
            $this->context->smarty->assign('id_zone', $zone_id);
            $this->context->smarty->assign('form_heading', $zone_name);
            $this->context->smarty->assign(
                'zone_view_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'mapZipcodes',
                        'id_zone' => $zone_id
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->context->smarty->assign(
                'cancel_button',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->setKbTemplate('seller/zipcode/newGlobalZoneform.tpl');
        }
    }

    public function deleteGlobalZone()
    {
        $zone_id = Tools::getValue('id_zone', 0);
        if ($zone_id != 0) {
            $sql = 'DELETE FROM `' . _DB_PREFIX_ . 'kb_pacbz_zones` WHERE' .
                ' id_kb_pacbz_zones = "' . pSQL($zone_id) . '" ';
            Db::getInstance()->execute($sql);

            $sql1 = 'DELETE FROM `' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping` WHERE' .
                ' zone_id = "' . pSQL($zone_id) . '" ';
            Db::getInstance()->execute($sql1);
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Zone has been deleted successfully.', 'globalzones')
            );
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Zone could not be deleted.', 'globalzones')
            );
        }
        $redirect_link = $this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            array(),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        Tools::redirect($redirect_link);
    }

    public function deleteZipCode()
    {
        $zone_id = Tools::getValue('id_zone', 0);
        $id_zipcode = Tools::getValue('id_zipcode', 0);
        $zipcode_mapping_id = Tools::getValue('id_kb_pacbz_zone_zipcode_mapping');
        if ($id_zipcode) {
            $sql = 'DELETE FROM `' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping` WHERE' .
                ' id_kb_pacbz_zone_zipcode_mapping = "' . pSQL($id_zipcode) . '" ';
            Db::getInstance()->execute($sql);

            //Delete zone if all the zipcodes are deleted in a zone
            $sql = 'SELECT * 
                FROM  `' . _DB_PREFIX_ . 'kb_pacbz_zones` pz
                LEFT JOIN  `' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping` pzz ON pz.id_kb_pacbz_zones = pzz.zone_id
                WHERE pzz.zone_id IS NULL ';
            $empty_zone_id = Db::getInstance()->ExecuteS($sql);
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Zipcode has been deleted successfully.', 'globalzones')
            );
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Zipcode could not be deleted.', 'globalzones')
            );
        }
        $redirect_link = $this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            array(
                'render_type' => 'view',
                'id_zone' => $zone_id
            ),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        Tools::redirect($redirect_link);
    }

    public function renderZipcodeView()
    {
        $id_zone = (int) Tools::getValue('id_zone', 0);
        $id_zipcode = (int) Tools::getValue('id_zipcode', 0);
        $this->context->smarty->assign(
            'cancel_button',
            $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(
                    'render_type' => 'view',
                    'id_zone' => $id_zone
                ),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );
        $show_form = true;
        if ($show_form) {
            $sql = 'SELECT zone_name FROM `' .
                _DB_PREFIX_ . 'kb_pacbz_zones` where id_kb_pacbz_zones ="' . pSQL($id_zone) . '"';
            $zone_name = Db::getInstance()->getValue($sql);

            $sql = 'Select `id_kb_pacbz_zone_zipcode_mapping`,`zipcode`,`deliver_by`,`availability` from ' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping 
            where zone_id = ' . (int) $id_zone . ' AND id_kb_pacbz_zone_zipcode_mapping = ' . (int) $id_zipcode;
            $zone_data = Db::getInstance()->getRow($sql);

            $this->context->smarty->assign('zone_data', $zone_data);
            $this->context->smarty->assign('zone_name', $zone_name);
            $this->context->smarty->assign('form_heading', $zone_name . ' : ' . $zone_data['zipcode']);
            $this->context->smarty->assign(
                'zipcode_view_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'saveZipcode',
                        'id_zone' => $id_zone,
                        'id_zipcode' => $id_zipcode
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );


            $this->setKbTemplate('seller/zipcode/zipcodeviewform.tpl');
        }
    }

    public function editGlobalZoneForm()
    {
        $id_zone = (int) Tools::getValue('id_zone', 0);
        $show_form = true;
        $this->context->smarty->assign(
            'cancel_button',
            $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );
        if ($id_zone) {
            $sql = 'SELECT zone_name FROM `' .
                _DB_PREFIX_ . 'kb_pacbz_zones` where id_kb_pacbz_zones ="' . pSQL($id_zone) . '"';
            $zone_name = Db::getInstance()->getValue($sql);

            $this->context->smarty->assign('zone_name', $zone_name);
            $this->context->smarty->assign('form_heading', $zone_name);
            $this->context->smarty->assign(
                'zone_view_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'saveZone',
                        'id_zone' => $id_zone
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->setKbTemplate('seller/zipcode/editGlobalZoneform.tpl');
        } else {
            $this->context->smarty->assign('form_heading', $this->module->l('Add New Zone', $this->controller_name));
            $this->context->smarty->assign(
                'zone_view_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'saveZone'
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->setKbTemplate('seller/zipcode/newGlobalZoneform.tpl');
        }
    }

    public function renderNewZipcodesForm()
    {
        $id_zone = (int) Tools::getValue('id_zone', 0);
        $show_form = true;
        $this->context->smarty->assign(
            'cancel_button',
            $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(
                    'render_type' => 'view',
                    'id_zone' => $id_zone
                ),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );
        if ($id_zone) {
            $sql = 'SELECT zone_name FROM `' .
                _DB_PREFIX_ . 'kb_pacbz_zones` where id_kb_pacbz_zones ="' . pSQL($id_zone) . '"';
            $zone_name = Db::getInstance()->getValue($sql);

            $this->context->smarty->assign('zone_name', $zone_name);
            $this->context->smarty->assign('id_zone', $id_zone);
            $this->context->smarty->assign('form_heading', $zone_name);
            $this->context->smarty->assign(
                'zone_view_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'mapZipcodes',
                        'id_zone' => $id_zone
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->setKbTemplate('seller/zipcode/newGlobalZoneform.tpl');
        }
    }

    public function getGlobalZonesbyIdSeller($id_seller = 0)
    {
        $filter_condition = '';
        if (Tools::getIsset('id_zone') && Tools::getValue('id_zone') != '') {
            $id_zone = (int) trim(Tools::getValue('id_zone'));
            $filter_condition .= ' and a.id_kb_pacbz_zones LIKE "%' . pSQL($id_zone) . '%"';
        }
        if (Tools::getIsset('zone_name') && Tools::getValue('zone_name') != '') {
            $zone_name = trim(Tools::getValue('zone_name'));
            $filter_condition .= ' and a.zone_name LIKE "%' . pSQL($zone_name) . '%"';
        }
        $result = array();
        $sql = 'Select `id_kb_pacbz_zones`,`zone_name`,count(*) as zip_count from ' . _DB_PREFIX_ . 'kb_pacbz_zones as a
                INNER JOIN `' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping` z ON ' .
            'a.id_kb_pacbz_zones = z.zone_id where is_seller_zone = ' . (int) $id_seller . $filter_condition . ' GROUP BY z.zone_id';
        $result = DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (is_array($result) && count($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }

    public function getAllZipcodesByIdSellerAndZone($id_seller = 0, $id_zone = 0)
    {
        $filter_condition = '';
        if (Tools::getIsset('id_zipcode') && Tools::getValue('id_zipcode') != '') {
            $id_zipcode = (int) trim(Tools::getValue('id_zipcode'));
            $filter_condition .= ' and id_kb_pacbz_zone_zipcode_mapping LIKE "%' . pSQL($id_zipcode) . '%"';
        }
        if (Tools::getIsset('zipcode_number') && Tools::getValue('zipcode_number') != '') {
            $zipcode_number = trim(Tools::getValue('zipcode_number'));
            $filter_condition .= ' and zipcode LIKE "%' . pSQL($zipcode_number) . '%"';
        }
        if (Tools::getIsset('staus') && Tools::getValue('staus') != '') {
            $staus = trim(Tools::getValue('staus'));
            $filter_condition .= ' and availability LIKE "%' . pSQL($staus) . '%"';
        }
        if (Tools::getIsset('delivery_by') && Tools::getValue('delivery_by') != '') {
            $delivery_by = trim(Tools::getValue('delivery_by'));
            $filter_condition .= ' and deliver_by LIKE "%' . pSQL($delivery_by) . '%"';
        }
        $result = array();
        $sql = 'Select `id_kb_pacbz_zone_zipcode_mapping`,`zipcode`,`deliver_by`,`availability` from ' . _DB_PREFIX_ . 'kb_pacbz_zone_zipcode_mapping 
            where zone_id = ' . (int) $id_zone. $filter_condition;
        $result = DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (is_array($result) && count($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }
}
