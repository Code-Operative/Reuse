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

class KbmarketplaceMembershipPlanDetailModuleFrontController extends KbmarketplaceCoreModuleFrontController
{

    public $controller_name = 'membershipplandetail';

    public function __construct()
    {
        parent::__construct();
    }

    public function setMedia()
    {
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
                    case 'getSellerMembershipPlan':
                        $this->json = $this->getAjaxMembershipPlanHtml();
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
        if (Tools::getIsset('method') && Tools::getValue('method') == 'addMembershipProductCart') {
            $this->addMembershipPlanToCart();
        } elseif (Tools::getIsset('method') && Tools::getValue('method') == 'activateMembershipPlan') {
            $id_kbmp_membership_plan_order = Tools::getValue('id_kbmp_membership_plan_order', 0);
            if ($this->checkValidPlan($this->seller_info['id_seller'], $id_kbmp_membership_plan_order)) {
                if (KbMemberShipPlanOrder::activateMemberShipPlan($this->seller_info['id_seller'], $id_kbmp_membership_plan_order)) {
                    $this->Kbconfirmation[] = $this->module->l('Selected Plan Activated successfully.', $this->controller_name);
                    if (count($this->Kberrors) > 0) {
                        $this->context->cookie->__set('redirect_error', implode('####', $this->Kberrors));
                    } else {
                        $this->context->cookie->__set('redirect_success', implode('####', $this->Kbconfirmation));
                    }
                    Tools::redirect($this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    ));
                } else {
                    $this->Kberrors[] = $this->module->l('Plan could not be activated.', $this->controller_name);
                    if (count($this->Kberrors) > 0) {
                        $this->context->cookie->__set('redirect_error', implode('####', $this->Kberrors));
                    } else {
                        $this->context->cookie->__set('redirect_success', implode('####', $this->Kbconfirmation));
                    }
                    Tools::redirect($this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    ));
                }
            } else {
                if (count($this->Kberrors) > 0) {
                    $this->context->cookie->__set('redirect_error', implode('####', $this->Kberrors));
                } else {
                    $this->context->cookie->__set('redirect_success', implode('####', $this->Kbconfirmation));
                }
                Tools::redirect($this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                ));
            }
        } else {
            $this->renderList();
        }
        parent::initContent();
    }
    
    private function checkValidPlan($id_seller, $id_kbmp_membership_plan_order)
    {
        $product_status = 1;
        $total_active_products = KbSellerProduct::getSellerProductsByStatus(
            $id_seller,
            true,
            null,
            null,
            null,
            null,
            $product_status
        );
        $plan_obj = new KbMemberShipPlanOrder($id_kbmp_membership_plan_order);
        if ($plan_obj->is_enabled_product_limit == 1 && $total_active_products > $plan_obj->product_limit) {
            $this->Kberrors[] = $this->module->l('The maximum number of allowed active product under this plan is lesser than the current number of activated products.Kindly deactivate some products first.', $this->controller_name);
            return false;
        }
        return true;
    }
    
    private function addMembershipPlanToCart()
    {
        $id_kbmp_membership_plan = Tools::getValue('id_kbmp_membership_plan', 0);
        
        if ($id_kbmp_membership_plan) {
            $kbMpMemberShipPlan_obj = new KbMpMemberShipPlan($id_kbmp_membership_plan);
            $id_product  = $kbMpMemberShipPlan_obj->id_product;
            if ($id_product) {
                $quantity = 1;
                $is_valid_plan = 1;
                $cart_products = array();
                if ($id_product > 0) {
                    $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                    if (!$this->context->cart->id) {
                        $this->context->cart->add();
                        if ($this->context->cart->id) {
                            $this->context->cookie->id_cart = (int) $this->context->cart->id;
                        }
                    }
                    $cart_products = $this->context->cart->getProducts();
                    if (!empty($cart_products)) {
                        foreach ($cart_products as $key => $products) {
                            if (KbMpMemberShipPlan::isMemberShipPlanTypeProduct($products['id_product'])) {
                                $is_valid_plan = 0;
                                $error_txt = $this->module->l('You can not add multiple membership plans in a cart.Kindly remove the same from cart first.', $this->controller_name);
                                $this->context->cookie->__set(
                                    'redirect_error',
                                    $error_txt
                                );

                                Tools::redirect($this->context->link->getModuleLink(
                                    $this->kb_module_name,
                                    $this->controller_name,
                                    array(),
                                    (bool) Configuration::get('PS_SSL_ENABLED')
                                ));
                            }
                        }
                    }
                    if ($is_valid_plan) {
                        $total_active_products = KbSellerProduct::getSellerProducts(KbSeller::getSellerByCustomerId($this->context->customer->id), true);
                        $plan_id = KbMpMemberShipPlan::isMemberShipPlanTypeProduct($id_product);
                        $plan_obj = new KbMpMemberShipPlan((int) $plan_id);
                        if ($plan_obj->is_enabled_product_limit == 1 && $total_active_products > $plan_obj->product_limit) {
                            $is_valid_plan = 0;
                        }
                    }
                    if ($is_valid_plan) {
                        $this->context->cart->updateQty($quantity, $id_product, $id_product_attribute);
                        $order_process = Configuration::get('PS_ORDER_PROCESS_TYPE') ? 'order-opc' : 'order';
                        $order_page_url = $this->context->link->getPageLink($order_process, true);
                        Tools::redirect($order_page_url);
                    }
                } else {
                    $error_txt = $this->module->l('Invalid Membership Product.Kindly try again later.', $this->controller_name);
                    $this->context->cookie->__set(
                        'redirect_error',
                        $error_txt
                    );

                    Tools::redirect($this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    ));
                }
            } else {
                $error_txt = $this->module->l('Invalid Membership Product.Kindly try again later.', $this->controller_name);
                $this->context->cookie->__set(
                    'redirect_error',
                    $error_txt
                );

                Tools::redirect($this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                ));
            }
        } else {
            $error_txt = $this->module->l('Invalid Membership Plan.Kindly try again later.', $this->controller_name);
            $this->context->cookie->__set(
                'redirect_error',
                $error_txt
            );
            
            Tools::redirect($this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool) Configuration::get('PS_SSL_ENABLED')
            ));
        }
    }

    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();
        if (isset($page['meta']) && $this->seller_info) {
            $page_title = $this->module->l('Membership Plan', 'membershipplandetail');
            $page['meta']['title'] = $page_title;
            $page['meta']['keywords'] = $this->seller_info['meta_keyword'];
            $page['meta']['description'] = $this->seller_info['meta_description'];
        }
        return $page;
    }

    private function renderList()
    {
        $data = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
        
        if (isset($data['kbmp_enable_membership_plan']) && $data['kbmp_enable_membership_plan'] == 1) {
            $plan_statuses = array(
                array(
                    'value' => 0,
                    'label' => $this->module->l('Approval Pending', 'membershipplandetail')),
                array(
                    'value' => 1,
                    'label' => $this->module->l('Approved', 'membershipplandetail')),
                array(
                    'value' => 2,
                    'label' => $this->module->l('Active', 'membershipplandetail')),
                array(
                    'value' => 3,
                    'label' => $this->module->l('Expired', 'membershipplandetail'))
            );
            
            $this->filter_header = $this->module->l('Filter Your Search', 'membershipplandetail');
            $this->filter_id = 'seller_membership_plan_filter';
            $this->filters = array(
                array(
                    'type' => 'text',
                    'name' => 'title',
                    'label' => $this->module->l('Plan Name', 'membershipplandetail'),
                ),
                array(
                    'type' => 'select',
                    'placeholder' => $this->module->l('Select', 'membershipplandetail'),
                    'name' => 'status',
                    'label' => $this->module->l('Status', 'membershipplandetail'),
                    'values' => $plan_statuses,
                    'validate' => 'isInt'
                ),
                
            );
            $this->filter_action_name = 'getSellerMembershipPlan';
            $this->context->smarty->assign('kbfilter', $this->renderKbListFilter());
            $this->table_id = 'seller_membership_plan_filter';
            $this->table_header = array(
                array(
                    'label' => $this->module->l('Plan Name', 'membershipplandetail'),
                    'align' => 'right',
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Plan Price', 'membershipplandetail'),
                    'width' => '150'),
                array(
                    'label' => $this->module->l('Product Limit', 'membershipplandetail'),
                    'width' => '150'),
                array(
                    'label' => $this->module->l('Requested Date', 'membershipplandetail')),
                array(
                    'label' => $this->module->l('Activation Date', 'membershipplandetail'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Expiry Date', 'membershipplandetail'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Status', 'membershipplandetail'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Action', 'membershipplandetail'),
                    'align' => 'left',
                    'class' => '',
                    'width' => '90',
                )
            );

            $this->total_records = KbMemberShipPlanOrder::getMembershipPlanOrderBySeller(
                $this->seller_info['id_seller'],
                null,
                null,
                true
            );

            if ($this->total_records > 0) {
                $membership_plans_orders = KbMemberShipPlanOrder::getMembershipPlanOrderBySeller(
                    $this->seller_info['id_seller'],
                    null,
                    false,
                    false,
                    $this->getPageStart(),
                    $this->tbl_row_limit
                );
                $id_free_membership_plan = KbMpMemberShipPlan::getFreeMembershipPlanID();
                foreach ($membership_plans_orders as $plan) {
                    $status = '';
                    $add_cart_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array('method' => 'addMembershipProductCart', 'id_kbmp_membership_plan' => $plan['id_kbmp_membership_plan']),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    );
                    
                    $activate_plan_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array('method' => 'activateMembershipPlan', 'id_kbmp_membership_plan_order' => $plan['id_kbmp_membership_plan_order']),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    );
                    if ($plan['status'] == 1) {
                        if ($plan['id_kbmp_membership_plan'] == $id_free_membership_plan || $plan['is_deleted'] == 1) {
                            $action_array = array(
                                'actions' => array(
                                    array(
                                        'href' => $activate_plan_link,
                                        'title' => $this->module->l('Activate Plan', 'membershipplandetail'),
                                        'icon-class' => 'check_circle'
                                    )
                                )
                            );
                        } else {
                            $action_array = array(
                                'actions' => array(
                                    array(
                                        'href' => $activate_plan_link,
                                        'title' => $this->module->l('Activate Plan', 'membershipplandetail'),
                                        'icon-class' => 'check_circle'
                                    )
                                )
                            );
                            if ($plan['id_order'] != 0) {
                                $action_array['actions'][] = array(
                                    'href' => $add_cart_link,
                                    'title' => $this->module->l('Extend', 'membershipplandetail'),
                                    'icon-class' => 'autorenew',
                                );
                            }
                        }
                        $status = $this->module->l('Approved', 'membershipplandetail');
                    } elseif ($plan['status'] == 2) {
                        if ($plan['id_order'] != 0) {
                            $action_array = array(
                                'actions' => array(
                                     array(
                                        'href' => $add_cart_link,
                                        'title' => $this->module->l('Extend', 'membershipplandetail'),
                                        'icon-class' => 'autorenew',
                                    )
                                )
                            );
                        } else {
                            $action_array = array(
                                'value' => '-'
                            );
                        }
                        $status = $this->module->l('Active', 'membershipplandetail');
                    } elseif ($plan['status'] == 3) {
                        $status = $this->module->l('Expired', 'membershipplandetail');
                        if ($plan['id_order'] != 0) {
                            $action_array = array(
                                'actions' => array(
                                     array(
                                        'href' => $add_cart_link,
                                        'title' => $this->module->l('Extend', 'membershipplandetail'),
                                        'icon-class' => 'autorenew',
                                    )
                                )
                            );
                        } else {
                            $action_array = array(
                                'value' => '-'
                            );
                        }
                    } else {
                        $status = $this->module->l('Pending', 'membershipplandetail');
                        $action_array = array(
                            'value' => '-'
                        );
                    }
                    /*
                     * for free membership plan
                     */
                    if ($plan['status'] != 1) {
                        if ($plan['id_kbmp_membership_plan'] == $id_free_membership_plan) {
                            $action_array = array(
                                'value' => '-'
                            );
                        }
                        if ($plan['is_deleted'] == 1) {
                            $action_array = array(
                                'value' => '-'
                            );
                        }
                    }
                    
                    
                    $product_limit = $plan['product_limit'];
                    if ($product_limit == 0) {
                        $product_limit = $this->module->l('NA', 'membershipplandetail');
                    }
                    $date_added = Tools::displayDate($plan['date_add'], null, true);
                    $date_active = Tools::displayDate($plan['active_date'], null, true);
                    $date_expire = Tools::displayDate($plan['expire_date'], null, true);
                    
                    if ($date_active == '') {
                        $date_active = '-';
                    }
                    if ($date_expire == '') {
                        $date_expire = '-';
                    }
                    if ($plan['name'] == '' && $plan['product_name'] != '') {
                        $plan['name'] = $plan['product_name'];
                    } else {
                        $plan['name'] = $plan['plan_name'];
                    }
                    
                    $this->table_content[$plan['id_kbmp_membership_plan_order']] = array(
                        array(
                            'value' => $plan['name']),
                        array(
                            'value' => Tools::displayPrice(Tools::convertPriceFull($plan['product_price'], null, $this->context->currency))),
                        array(
                            'value' => $product_limit),
                        array(
                            'value' => $date_added),
                        array(
                            'value' => $date_active),
                        array(
                            'value' => $date_expire),
                        array(
                            'value' => $status),
                        $action_array
                    );
                }

                $this->list_row_callback = 'getSellerMembershipPlan';

                $this->table_enable_multiaction = false;
            }

            $this->context->smarty->assign('kblist', $this->renderKbList());
            $this->context->smarty->assign('display_feature', true);
        } else {
            $this->context->smarty->assign('display_feature', false);
            $this->Kberrors[] = $this->module->l('This feature is not active. Please contact to support.', 'membershipplandetail');
        }
        $this->setKbTemplate('seller/membership_plan/list.tpl');
    }

    protected function getAjaxMembershipPlanHtml()
    {
        $json = array();

        $custom_filter = '';
        $data = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
        if (Tools::getIsset('title') && Tools::getValue('title') != '') {
            $custom_filter .= ' and pl.name like "%' . pSQL(Tools::getValue('title')) . '%"';
        }

        if (Tools::getIsset('status') && Tools::getValue('status') != '') {
            $custom_filter .= ' AND mpo.status = "' . pSQL(Tools::getValue('status')) .'"';
        }
        if (isset($data['kbmp_enable_membership_plan']) && $data['kbmp_enable_membership_plan'] == 1) {
            $this->total_records = KbMemberShipPlanOrder::getMembershipPlanOrderBySeller(
                $this->seller_info['id_seller'],
                null,
                $custom_filter,
                true
            );

            if ($this->total_records > 0) {
                if (Tools::getIsset('start') && (int) Tools::getValue('start') > 0) {
                    $this->page_start = (int) Tools::getValue('start');
                }
                $membership_plans_orders = KbMemberShipPlanOrder::getMembershipPlanOrderBySeller(
                    $this->seller_info['id_seller'],
                    null,
                    $custom_filter,
                    false,
                    $this->getPageStart(),
                    $this->tbl_row_limit
                );
                $id_free_membership_plan = 0;
                
                $id_free_membership_plan = KbMpMemberShipPlan::getFreeMembershipPlanID();

                $row_html = '';
                foreach ($membership_plans_orders as $plan) {
                    $status = '';
                    $action_block = '';
                    $add_cart_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array('method' => 'addMembershipProductCart', 'id_kbmp_membership_plan' => $plan['id_kbmp_membership_plan']),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    );
                    
                    $activate_plan_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array('method' => 'activateMembershipPlan', 'id_kbmp_membership_plan_order' => $plan['id_kbmp_membership_plan_order']),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    );
                    
                    if ($plan['status'] == 1) {
                        if ($plan['id_kbmp_membership_plan'] == $id_free_membership_plan || $plan['is_deleted'] == 1) {
                            $action_block = '<a href="' . $activate_plan_link . '" 
								title="' . $this->module->l('Activate Plan', 'membershipplandetail')
                            . '" class="btn btn-default kb-multiaction-link">
                            <i class="kb-material-icons kb-multiaction-icon">check_circle</i>
							</a>';
                        } else {
                            $action_block = '<a href="' . $activate_plan_link . '" 
								title="' . $this->module->l('Activate Plan', 'membershipplandetail')
                            . '" class="btn btn-default kb-multiaction-link">
                            <i class="kb-material-icons kb-multiaction-icon">check_circle</i>
							</a>';
                            if ($plan['id_order'] != 0) {
                                $action_block .= '<a href="' . $add_cart_link . '" 
                                                                    title="' . $this->module->l('Extend', 'membershipplandetail')
                                . '" class="btn btn-default kb-multiaction-link">
                                <i class="kb-material-icons kb-multiaction-icon">autorenew</i>
                                                            </a>';
                            }
                        }
                        $status = $this->module->l('Approved', 'membershipplandetail');
                    } elseif ($plan['status'] == 2) {
                        if ($plan['id_order'] != 0) {
                            $action_block = '<a href="' . $add_cart_link . '" 
                                                                    title="' . $this->module->l('Extend', 'membershipplandetail')
                                . '" class="btn btn-default kb-multiaction-link">
                                <i class="kb-material-icons kb-multiaction-icon">autorenew</i>
                                                            </a>';
                        }
                        $status = $this->module->l('Active', 'membershipplandetail');
                    } elseif ($plan['status'] == 3) {
                        $status = $this->module->l('Expired', 'membershipplandetail');
                        if ($plan['id_order'] != 0) {
                            $action_block = '<a href="' . $add_cart_link . '" 
                                                                    title="' . $this->module->l('Extend', 'membershipplandetail')
                                . '" class="btn btn-default kb-multiaction-link">
                                <i class="kb-material-icons kb-multiaction-icon">autorenew</i>
                                                            </a>';
                        }
                    } else {
                        $status = $this->module->l('Pending', 'membershipplandetail');
                        $action_block = '-';
                    }
                    if (empty($action_block)) {
                        $action_block = '-';
                    }
                    if ($plan['status'] != 1) {
                        if ($plan['id_kbmp_membership_plan'] == $id_free_membership_plan) {
                            $action_block = '-';
                        }

                        if ($plan['is_deleted'] == 1) {
                            $action_block = '-';
                        }
                    }
                    $product_limit = $plan['product_limit'];
                    if ($product_limit == 0) {
                        $product_limit = $this->module->l('NA', 'membershipplandetail');
                    }
                    $date_added = Tools::displayDate($plan['date_add'], null, true);
                    $date_active = Tools::displayDate($plan['active_date'], null, true);
                    $date_expire = Tools::displayDate($plan['expire_date'], null, true);
                    
                    if ($date_active == '') {
                        $date_active = '-';
                    }
                    if ($date_expire == '') {
                        $date_expire = '-';
                    }
                    if ($plan['name'] == '') {
                        $plan['name'] = $plan['product_name'];
                    }
                    if ($plan['name'] == '') {
                        $plan['name'] = $plan['plan_name'];
                    }
                    
                    $row_html .= '<tr>
						<td>' . $plan['name'] . '</td>
						<td>' . Tools::displayPrice(Tools::convertPriceFull($plan['product_price'], null, $this->context->currency)) . '</td>
						<td>' . $product_limit . '</td>
						<td>' . $date_added . '</td>
						<td>' . $date_active . '</td>
						<td>' . $date_expire . '</td>
						<td>' . $status . '</td>
						<td>' . $action_block . '</td>
                                    </tr>';
                }
                $this->table_id = 'seller_membership_plan_filter';
                $this->list_row_callback = 'getSellerMembershipPlan';
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
                $json['msg'] = $this->module->l('No Data Found', 'membershipplandetail');
            }
        } else {
            $json['status'] = false;
            $json['msg'] = $this->module->l('No Data Found', 'membershipplandetail');
        }
        return $json;
    }
}
