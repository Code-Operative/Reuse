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

class KbmarketplaceZipcodeProductMappingModuleFrontController extends KbmarketplaceCoreModuleFrontController
{

    public $controller_name = 'zipcodeproductmapping';
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
        $this->addCSS($this->getKbModuleDir().'views/css/front/multiple-select.css');
        $this->addJS($this->getKbModuleDir().'views/js/front/jquery.multiple.select.js');
        $this->context->controller->addJqueryPlugin('select2');
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
                    case 'getSellerFilteredMappedProducts':
                        $this->json = $this->getAjaxProductsListHtml();
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
        } else if (Tools::getIsset('render_type') && Tools::getValue('render_type') == 'productMappingForm') {
            $this->getProductMappingForm();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'saveProductMapping') {
            $this->mapProductsWithZones();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'delete') {
            $this->deleteAllProductsByZoneId();
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'deleteProduct') {
            $this->deleteProductByIdAndZoneId();
        } else {
            $this->renderList();
        }
        parent::initContent();
    }

    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();
        if (isset($page['meta']) && $this->seller_info) {
            $page_title = $this->module->l('Product-Zone Mapping', 'zipcodeproductmapping');
            $page['meta']['title'] = $page_title;
            $page['meta']['keywords'] = $this->seller_info['meta_keyword'];
            $page['meta']['description'] = $this->seller_info['meta_description'];
        }
        return $page;
    }
    
    public function getAjaxZoneListHtml()
    {
        $json = array();
        $this->total_records = 0;
        $row_html = '';
        $global_zones = $this->getGlobalZonesbyIdSeller($this->seller_obj->id);
        if (is_array($global_zones) && count($global_zones) > 0) {
                $this->total_records = count($global_zones);
        }
        if ($this->total_records > 0) {
            $global_zones = array_slice($global_zones, 0, $this->tbl_row_limit);
            foreach ($global_zones as $zone_key => $zone) {
                $delete_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'delete',
                        'id_zone' => $zone['zid']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $view_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'render_type' => 'view',
                        'id_zone' => $zone['zid']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $row_html .= '<tr>';
                $row_html .= '<td>' . $zone['zid'] . '</td>';
                $row_html .='<td>' . $zone['zname'] . '</td>';
                $row_html .='<td>' . $zone['product_count'] . '</td>';
                $action_block = '<a class="kb_list_action " href="' . $view_link . '" title="' . $this->module->l('Click to view', 'zipcodeproductmapping') . '">View</a>
                <a class="kb_list_action " href="javascript:void(0)" data-href="' . $delete_link . '" title="" onclick="actionDeleteConfirmation(this);">' . $this->module->l('Delete', 'zipcodeproductmapping') . '</a>';
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
            $json['msg'] = $this->module->l('No Data Found', 'zipcodeproductmapping');
        }
        return $json;
    }
    public function getAjaxProductsListHtml()
    {
        $json = array();
        $id_zone = Tools::getValue('id_zone', 0);
        $this->total_records = 0;
        $row_html = '';
        $global_zones_zipcode = $this->getAllProductsByIdSellerAndZone($this->seller_obj->id, $id_zone);
        if (Tools::getIsset('start') && (int)Tools::getValue('start') > 0) {
            $this->page_start = (int)Tools::getValue('start');
        }
        if (is_array($global_zones_zipcode) && count($global_zones_zipcode) > 0) {
            $this->total_records = count($global_zones_zipcode);
        }
        if ($this->total_records > 0) {
            $global_zones_zipcode = array_slice($global_zones_zipcode, $this->page_start, $this->tbl_row_limit);
            foreach ($global_zones_zipcode as $zipcode_key => $zipcode) {
                $delete_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'deleteProduct',
                        'id_zone' => $id_zone,
                        'id_product' => $zipcode['pid'],
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $view_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'render_type' => 'view',
                        'id_zone' => $zipcode['zid']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $row_html .= '<tr>';
                $row_html .= '<td>' . $zipcode['zid'] . '</td>';
                $row_html .='<td>' . $zipcode['zname'] . '</td>';
                $row_html .='<td>' . $zipcode['pid'] . '</td>';
                $row_html .='<td>' . $zipcode['pname'] . '</td>';
                $action_block = '<a class="kb_list_action " href="javascript:void(0)" data-href="' . $delete_link . '" title="" onclick="actionDeleteConfirmation(this);">' . $this->module->l('Delete', 'zipcodeproductmapping') . '</a>';
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
            $json['msg'] = $this->module->l('No Data Found', 'zipcodeproductmapping');
        }
        return $json;
    }
    private function renderList()
    {
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Module::isInstalled('productavailabilitycheckbyzipcode') && Module::isEnabled('productavailabilitycheckbyzipcode')) {
            $this->filter_header = $this->module->l('Filter Your Search', 'zipcodeproductmapping');
            $this->filter_id = 'seller_globalzones_filter';
            $this->filters = array(
                array(
                    'type' => 'text',
                    'name' => 'id_zone',
                    'label' => $this->module->l('Zone Id ', 'zipcodeproductmapping'),
                ),
                array(
                    'type' => 'text',
                    'name' => 'zone_name',
                    'label' => $this->module->l('Zone Name ', 'zipcodeproductmapping'),
                ),
            );
            $this->filter_action_name = 'getFilteredZones';
            $this->context->smarty->assign('kbfilter', $this->renderKbListFilter());

            $this->table_id = 'seller_globalzones_filter';
            $this->table_header = array(
                array(
                    'label' => $this->module->l('Zone ID', 'zipcodeproductmapping'),
                    'align' => 'right',
                    'width' => '60'
                ),
                array(
                    'label' => $this->module->l('Zone Name', 'zipcodeproductmapping'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Total Products', 'zipcodeproductmapping'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Action', 'zipcodeproductmapping'),
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
                            'id_zone' => $zone['zid']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $delete_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'action_type' => 'delete',
                            'id_zone' => $zone['zid']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $action_block = array(
                        array(
                            'type' => 'view',
                            'href' => $view_link,
                            'title' => $this->module->l('Click to view', 'zipcodeproductmapping'),
                            'label' => $this->module->l('View', 'zipcodeproductmapping'),
                        ),
                        array(
                            'type' => 'delete',
                            'href' => $delete_link
                        )
                    );
                    $this->table_content[] = array(
                        array(
                            'value' => $zone['zid']),
                        array(
                            'value' => $zone['zname']),
                        array(
                            'value' => $zone['product_count']),
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
        $map_products_link = $this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            array(
                'render_type' => 'productMappingForm'
            ),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        $this->context->smarty->assign('map_products_link', $map_products_link);
        $this->setKbTemplate('seller/zipcode_product_mapping/globalzones.tpl');
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
            $this->filter_header = $this->module->l('Filter Your Search', 'zipcodeproductmapping');
            $this->filter_id = 'seller_globalzones_filter';
            $id_zone = Tools::getValue('id_zone', 0);
            $status_type = array(
                array(
                    'value' => 1,
                    'label' => $this->module->l('Yes', 'zipcodeproductmapping')),
                array(
                    'value' => 0,
                    'label' => $this->module->l('No', 'zipcodeproductmapping')),
            );
            $this->filters = array(
                array(
                    'type' => 'text',
                    'name' => 'id_product',
                    'label' => $this->module->l('Product Id', 'zipcodeproductmapping'),
                ),
                array(
                    'type' => 'text',
                    'name' => 'product_name',
                    'label' => $this->module->l('Product Name', 'zipcodeproductmapping'),
                ),
                array(
                    'type' => 'hidden',
                    'name' => 'id_zone',
                    'id' => 'id_zone',
                    'default' => $id_zone
                ),
            );
            $this->filter_action_name = 'getSellerFilteredMappedProducts';
            $this->context->smarty->assign('kbfilter', $this->renderKbListFilter(1));

            $this->table_id = 'seller_globalzones_filter';
            $this->table_header = array(
                array(
                    'label' => $this->module->l('ID Zone', 'zipcodeproductmapping'),
                    'align' => 'right',
                    'width' => '60'
                ),
                array(
                    'label' => $this->module->l('Zone Name', 'zipcodeproductmapping'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Product Id', 'zipcodeproductmapping'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Product', 'zipcodeproductmapping'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Action', 'zipcodeproductmapping'),
                    'width' => '100')
            );
            $this->total_records = 0;
            $global_zones_zipcode = $this->getAllProductsByIdSellerAndZone($this->seller_obj->id, $id_zone);
            if (is_array($global_zones_zipcode) && count($global_zones_zipcode) > 0) {
                $this->total_records = count($global_zones_zipcode);
            }
            if ($this->total_records > 0) {
                $global_zones_zipcode = array_slice($global_zones_zipcode, 0, $this->tbl_row_limit);
                foreach ($global_zones_zipcode as $zipcode_key => $zipcode) {
                    $delete_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'action_type' => 'deleteProduct',
                            'id_zone' => $id_zone,
                            'id_product' => $zipcode['pid'],
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $action_block = array(
                        array(
                            'type' => 'delete',
                            'href' => $delete_link
                        )
                    );
                    $this->table_content[] = array(
                        array(
                            'value' => $zipcode['zid']),
                        array(
                            'value' => $zipcode['zname']),
                        array(
                            'value' => $zipcode['pid']),
                        array(
                            'value' => $zipcode['pname']),
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
            $this->context->smarty->assign('kblist', $this->renderKbList());
        }
        $map_products_link = $this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            array(
                'render_type' => 'productMappingForm'
            ),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        $this->context->smarty->assign('map_products_link', $map_products_link);
        $this->context->smarty->assign('id_zone', $id_zone);
        $this->context->smarty->assign(
            'cancel_button',
            $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );
        $this->setKbTemplate('seller/zipcode_product_mapping/productinzones.tpl');
    }
    
    public function mapProductsWithZones()
    {
        $formvalue = array();
        if (Tools::getIsset('id_zones') && Tools::getIsset('id_products')) {
            $formvalue['select_zone'] = Tools::getValue("id_zones");
            $formvalue['search_product'] = Tools::getValue("id_products");
            foreach ($formvalue['search_product'] as $productid) {
                foreach ($formvalue['select_zone'] as $zoneid) {
                    $sql0 = 'SELECT * FROM `'._DB_PREFIX_.'kb_pacbz_product_zone_mapping`' .
                        ' where product_id ="' .pSQL($productid).'" and zone_id = "'.pSQL($zoneid).'"';
                    $results0 = Db::getInstance()->ExecuteS($sql0);
                    if ($results0 == null) {
                        $sql4 = 'INSERT INTO `'._DB_PREFIX_.'kb_pacbz_product_zone_mapping` ' .
                            '(`product_id`, `zone_id`) VALUES ("'.
                            pSQL($productid).'" , "'.pSQL($zoneid).'")';
                        Db::getInstance()->execute($sql4);

                        $sql8 = 'SELECT * FROM `'._DB_PREFIX_.'kb_pacbz_products`' .
                            ' where id_kb_pacbz_products ="' .pSQL($productid).'"';
                        $results1 = Db::getInstance()->ExecuteS($sql8);
                        if ($results1 == null) {
                            $sql8 = 'SELECT l.name,l.id_product,p.reference FROM `'
                                ._DB_PREFIX_.'product_lang` as l inner join `'._DB_PREFIX_.'product` as p' .
                                ' on l.id_product=p.id_product where l.id_product ="'
                                .pSQL($productid).'" group by l.id_product';
                            $results2 = Db::getInstance()->ExecuteS($sql8);

                            foreach ($results2 as $result) {
                                $sql9 = 'INSERT INTO `'._DB_PREFIX_.'kb_pacbz_products` ( ' .
                                '`id_kb_pacbz_products`,`product_name`) VALUES ("'
                                .pSQL($result['id_product']).'","'.pSQL($result['name']).' : '
                                .pSQL($result['reference']).'")';
                                Db::getInstance()->execute($sql9);
                                break;
                            }
                        }
                    }
                }
            }
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Data has been successfully added/updated.', 'zipcodeproductmapping')
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
                $this->module->l('There were some issue while saving the data.Kindly try again. ', 'zipcodeproductmapping')
            );
            $this->getProductMappingForm();
        }
    }
    public function getProductMappingForm()
    {
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
        if ($show_form) {
            $this->context->smarty->assign('form_heading', $this->module->l('Map Products', $this->controller_name));
            $seller_products = array();
            $product_detail_array = array();
            $seller_products = KbSellerProduct::getSellerProducts($this->seller_obj->id);
            if (count($seller_products) > 0) {
                foreach ($seller_products as $key => $product_data) {
                    $product_obj = new Product($product_data['id_product']);
                    $product_detail_array[$key]['name'] = $product_obj->name[$this->default_form_language];
                    $product_detail_array[$key]['reference'] = $product_obj->reference;
                    $product_detail_array[$key]['id_product'] = $product_data['id_product'];
                    unset($product_obj);
                }
            }
            $sql_zone = 'SELECT * FROM `'._DB_PREFIX_.'kb_pacbz_zones` where is_seller_zone = '. (int) $this->seller_obj->id;
            if ($results = Db::getInstance()->ExecuteS($sql_zone)) {
                $i = 0;
                $display_zone_options = array();
                foreach ($results as $row) {
                    $display_zone_options[$i] = array(
                        'id_option' => $row['id_kb_pacbz_zones'],
                        'name' => $row['zone_name']
                    );

                    $i++;
                }
            }
            $this->context->smarty->assign('product_array', $product_detail_array);
            $this->context->smarty->assign('zone_array', $display_zone_options);
            $this->context->smarty->assign(
                'product_mapping_submit_url',
                $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'action_type' => 'saveProductMapping'
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
            $this->setKbTemplate('seller/zipcode_product_mapping/productmappingform.tpl');
        }
    }
    public function deleteAllProductsByZoneId()
    {
        $zone_id = Tools::getValue('id_zone', 0);
        if ($zone_id != 0) {
            $sql1 = 'DELETE FROM `'._DB_PREFIX_.'kb_pacbz_product_zone_mapping` WHERE' .
                ' zone_id = "'.pSQL($zone_id).'" ';
            Db::getInstance()->execute($sql1);
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Products from Zone has been deleted successfully.', 'zipcodeproductmapping')
            );
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Products from Zone could not be deleted.', 'zipcodeproductmapping')
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

    public function deleteProductByIdAndZoneId()
    {
        $zone_id = Tools::getValue('id_zone', 0);
        $id_product = Tools::getValue('id_product', 0);
        if ($zone_id && $id_product) {
            $sql1 = 'DELETE FROM `'._DB_PREFIX_.'kb_pacbz_product_zone_mapping` WHERE' .
                ' product_id = "'.pSQL($id_product).'" and zone_id = "'.psql($zone_id). '"';
            Db::getInstance()->execute($sql1);
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Product from zone has been deleted successfully.', 'zipcodeproductmapping')
            );
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Product could not be Unmapped from zone.', 'zipcodeproductmapping')
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
        $sql = 'Select a.`id_kb_pacbz_zones` as zid,a.`zone_name` as zname,count(*) as product_count from `' . _DB_PREFIX_ . 'kb_pacbz_zones` as a
            INNER JOIN `' . _DB_PREFIX_ . 'kb_pacbz_product_zone_mapping` z ON ' .
            'a.id_kb_pacbz_zones = z.zone_id where is_seller_zone = ' . (int) $id_seller . $filter_condition. ' GROUP BY z.zone_id';
        $result = DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (is_array($result) && count($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }

    public function getAllProductsByIdSellerAndZone($id_seller = 0, $id_zone = 0)
    {
        $filter_condition = '';
        if (Tools::getIsset('id_product') && Tools::getValue('id_product') != '') {
            $id_product = (int) trim(Tools::getValue('id_product'));
            $filter_condition .= ' and a.product_id LIKE "%' . pSQL($id_product) . '%"';
        }
        if (Tools::getIsset('product_name') && Tools::getValue('product_name') != '') {
            $product_name = trim(Tools::getValue('product_name'));
            $filter_condition .= ' and p.product_name LIKE "%' . pSQL($product_name) . '%"';
        }
        $result = array();
        $sql = 'Select a.`product_id` as pid,a.`zone_id` as zid,p.`product_name` as pname,'.
            'z.`zone_name` as zname from ' . _DB_PREFIX_ . 'kb_pacbz_product_zone_mapping as a
            INNER JOIN `'. _DB_PREFIX_ .'kb_pacbz_products` p ON a.product_id = p.id_kb_pacbz_products ' .
            'INNER JOIN `' . _DB_PREFIX_ . 'kb_pacbz_zones` z ON a.zone_id = z.id_kb_pacbz_zones where a.zone_id ="' .pSQL($id_zone).'"'. $filter_condition;
        $result = DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
        if (is_array($result) && count($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }
}
