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

class KbmarketplaceReturnRequestModuleFrontController extends KbmarketplaceCoreModuleFrontController
{

    public $controller_name = 'returnrequest';
    protected $default_form_language;

    public function __construct()
    {
        parent::__construct();
        $this->default_form_language = $this->context->language->id;
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS(_PS_MODULE_DIR_ . 'returnmanager/' . 'views/css/returnmanager.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'returnmanager/' . 'views/css/theme/fonts/glyphicons/css/glyphicons_regular.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'returnmanager/' . 'views/css/theme/fonts/font-awesome/css/font-awesome.min.css');
        $this->addJS($this->getKbModuleDir() . 'views/js/front/sellerreturnmanager.js');
        // for notifications
        $this->addJqueryPlugin('fancybox');
        $this->addCSS(_THEME_CSS_DIR_ . 'product.css');
        $this->addJS(_THEME_JS_DIR_ . 'category.js');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/notifications/jquery.notyfy.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/notifications/default.css');
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmarketplace/views/css/front/notifications/jquery.gritter.css');
        $this->addJS(_PS_MODULE_DIR_  . 'kbmarketplace/views/js/front/notifications/jquery.gritter.min.js');
        $this->addJS(_PS_MODULE_DIR_  . 'kbmarketplace/views/js/front/notifications/jquery.notyfy.js');
        $this->addJS(_PS_MODULE_DIR_  . 'kbmarketplace/views/js/front/supercheckout_notifications.js');
    }

    public function postProcess()
    {
        parent::postProcess();
        if (Tools::isSubmit('ajax')) {
            $return_manager_mod_obj = Module::getInstanceByName('returnmanager');
            $this->json = array();
            $renderhtml = false;
            if (Tools::isSubmit('method')) {
                switch (Tools::getValue('method')) {
                    case 'getSellerFilteredReturnRequest':
                        $this->json = $this->getAjaxReturnListHtml();
                        break;
                    case 'loadEmailTemplate':
                        $selected_lang = Tools::getValue('selected_lang');
                        $selected_temp = Tools::getValue('selected_temp');
                        $this->json = $return_manager_mod_obj->loadEmailTemplate($selected_lang, $selected_temp);
                        break;
                    case 'approveReturn':
                        $return_id = Tools::getValue('ret');
                        $update_return = 'update ' . _DB_PREFIX_ .
                            'velsof_rm_order set active=2, date_update=now() where id_rm_order=' . (int) $return_id . ' and
                        id_shop=' . (int) $this->context->shop->id;
                        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($update_return);
                        $get_return_data = 'select id_order, id_customer, id_rm_order as return_id from ' .
                            _DB_PREFIX_ . 'velsof_rm_order
                        where id_rm_order = ' . (int) $return_id;
                        $return_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_return_data);
                        $settings = Tools::unSerialize(Configuration::get('VELSOF_RETURNMANAGER'));
                        if (isset($settings['enable_return_slip']) && $settings['enable_return_slip'] == 1) {
                            $return_manager_mod_obj->generateReturnSlip((int) $return_id);
                        }
                        /* Edited by Anshul Mittal On 25-08-2017 to add a functionality of email editing before sending it to customer */
                        $this->json['mail_sent'] = $return_manager_mod_obj->sendNotificationEmail('ret_app', $return_data, array());
                        $this->json['status'] = true;
                        unset($settings);
                        break;
                    case 'denyReturn':
                        $return_id = Tools::getValue('ret');
                        $temp_deny = array();
                        $update_return = 'update ' . _DB_PREFIX_ .
                            'velsof_rm_order set active=3, date_update=now() where id_rm_order=' . (int) $return_id . ' and
                            id_shop=' . (int) $this->context->shop->id;
                        $get_return_data = 'select id_order, id_order_return, id_customer, id_rm_order as return_id from ' .
                            _DB_PREFIX_ . 'velsof_rm_order
                            where id_rm_order = ' . (int) $return_id;
                        $return_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_return_data);
                        /* Edited by Anshul Mittal On 25-08-2017 to add a functionality of email editing before sending it to customer */
                        $this->json['mail_sent'] = $return_manager_mod_obj->sendNotificationEmail('ret_den', $return_data, $temp_deny);
                        $this->json['status'] = true;
                        $return_manager_mod_obj->updateRMATables('return_denied', $return_data);
                        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($update_return);
                        break;
                    case 'completeReturn':
                        $return_id = Tools::getValue('ret');
                        $is_generate_coupon = (int)Tools::getValue('is_generate_coupon', 0);
                        $is_update_inventory = (int)Tools::getValue('is_update_inventory', 0);
                        $temp_comp = array();
                        $update_return = 'update ' . _DB_PREFIX_ .
                            'velsof_rm_order set active=4, date_update=now() where id_rm_order=' . (int) $return_id . ' and
                            id_shop=' . (int) $this->context->shop->id;
                        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($update_return);
                        $get_return_data = 'select id_order, return_type, id_order_detail, quantity, id_order_return, id_customer, id_rm_order as return_id from ' .
                            _DB_PREFIX_ . 'velsof_rm_order
                            where id_rm_order = ' . (int) $return_id;
                        $return_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_return_data);
                        // changes started by rishabh jain to update the inventory
                        if ($is_update_inventory == 1) {
                            if (isset($return_data['id_order_detail']) && $return_data['id_order_detail'] != '') {
                                $get_name = 'select product_name,product_attribute_id,product_id,unit_price_tax_incl
                                                from ' . _DB_PREFIX_ . 'order_detail where id_order_detail=' . (int) $return_data['id_order_detail'] .
                                    ' and id_shop=' . (int) $this->context->shop->id;
                                $pro_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_name);
                                $id_product_attribute = $pro_name['product_attribute_id'];
                                $tmp_stock_qty = StockAvailable::getQuantityAvailableByProduct(
                                    $pro_name['product_id'],
                                    $id_product_attribute,
                                    $this->context->shop->id
                                );

                                StockAvailable::setQuantity(
                                    $pro_name['product_id'],
                                    $id_product_attribute,
                                    (int) ($tmp_stock_qty + $return_data['quantity'])
                                );
                            }
                        }
                        $coupon_code = '';
                        $is_coupon_exists = 0;
                        if ($is_generate_coupon) {
                            $id_customer = $return_data['id_customer'];
                            $order_detail_obj = new OrderDetail($return_data['id_order_detail']);
                            $coupon_amount = (float) $order_detail_obj->unit_price_tax_incl * $return_data['quantity'];
                            $query_coupon_data = 'Select id_coupon_details from `' . _DB_PREFIX_ . 'velsof_return_coupon_data` where id_return = '. $return_data['id_order_return'];
                            $is_coupon_exists = Db::getInstance()->getValue($query_coupon_data);
                            if ($is_coupon_exists) {
                                $query_coupon_rule = 'Select id_cart_rule from `' . _DB_PREFIX_ . 'velsof_return_coupon_data` where id_return = '. $return_data['id_order_return'];
                                $id_cart_rule = (int) Db::getInstance()->getValue($query_coupon_rule);
                                $cart_rule_obj = new CartRule($id_cart_rule);
                                $coupon_code = $cart_rule_obj->code;
                            } else {
                                $coupon_code  = $return_manager_mod_obj->generatecoupon($return_data, $id_customer);
                            }
                            $order_obj = new Order($return_data['id_order']);
                            $reduction_currency = $order_obj->id_currency;
                            $curr_obj = new Currency($reduction_currency);
                            $return_data['coupon_code'] = $coupon_code;
                            $return_data['amount'] = Tools::displayPrice($coupon_amount, $curr_obj);
                        /* Edited by Anshul Mittal On 25-08-2017 to add a functionality of email editing before sending it to customer */
                            $this->json['mail_sent'] = $return_manager_mod_obj->sendNotificationEmail('ret_comp_discount', $return_data, $temp_comp);
                        } else {
                            /* Edited by Anshul Mittal On 25-08-2017 to add a functionality of email editing before sending it to customer */
                            $this->json['mail_sent'] = $return_manager_mod_obj->sendNotificationEmail('ret_comp', $return_data, $temp_comp);
                        }
                        // to update the inventory
                        $this->json['status'] = true;
                        $return_manager_mod_obj->updateRMATables('return_completed', $return_data);
                        break;
                    case 'changeReturnStatus':
                        $return_id = Tools::getValue('ret');
                        $status_id = Tools::getValue('stat');
                        /* Start Added by Anshul Mittal on 25-08-2017 to add a functionality of email editing before sending it to customer */
                        $temp_status = array();
                        $get_return_data = 'select id_order, id_customer, id_rm_order as return_id from ' .
                            _DB_PREFIX_ . 'velsof_rm_order
                            where id_rm_order = ' . (int) $return_id;
                        $return_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_return_data);
                        $check_query = 'select * from ' . _DB_PREFIX_ . 'velsof_rm_status where id_rm_order=' .
                            (int) $return_id . ' and id_rm_status=' . (int) $status_id;
                        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($check_query);
                        if ($result && is_array($result)) {
                            $update_status = 'update ' . _DB_PREFIX_ . 'velsof_rm_status set date_add=now() where
                                                    id_rm_order=' . (int) $return_id . ' and id_rm_status=' . (int) $status_id;
                            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($update_status);
                            $status = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('SELECT value from
                            ' . _DB_PREFIX_ . 'velsof_return_data_lang where return_data_id = ' . (int) $result['id_rm_status'] .
                                ' and
                            id_lang=' . (int) $this->context->language->id . ' and id_shop=' . (int) $this->context->shop->id);
                            $return_data['previous_status'] = $status['value'];
                        } else {
                            $get_previous_status = 'select id_rm_status from ' . _DB_PREFIX_ . 'velsof_rm_status where
                                id_rm_order = ' . (int) $return_id . ' order by date_add desc';
                            $previous_status_id = $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_previous_status);
                            $status = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('SELECT value from
                                ' . _DB_PREFIX_ . 'velsof_return_data_lang where return_data_id = ' .
                                (int) $previous_status_id['id_rm_status'] . ' and
                                id_lang=' . (int) $this->context->language->id . ' and id_shop=' .
                                (int) $this->context->shop->id);
                            $return_data['previous_status'] = $status['value'];
                            $add_status = 'insert into ' . _DB_PREFIX_ .
                                'velsof_rm_status (`id_rm_order`,`id_rm_status`,`date_add`)
                                values (' . (int) $return_id . ',' . (int) $status_id . ',now())';
                            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($add_status);
                        }
                        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('SELECT value from
                            ' . _DB_PREFIX_ . 'velsof_return_data_lang where return_data_id = ' . (int) $status_id . ' and
                            id_lang=' . (int) $this->context->language->id . ' and id_shop=' .
                            (int) $this->context->shop->id);
                        $return_data['current_status'] = $result['value'];
                        /* Edited by Anshul Mittal On 25-08-2017 to add a functionality of email editing before sending it to customer */
                        $this->json['mail_sent'] = $return_manager_mod_obj->sendNotificationEmail('ret_stat', $return_data, $temp_status);
                        $this->json['status'] = true;
                        break;
                    case 'getReturnData':
                        $return_id = Tools::getValue('ret');
                        $this->context->smarty->assign('return_detail', $return_manager_mod_obj->getReturnData($return_id));
                        $this->json['html'] =  $this->context->smarty->fetch(
                            _PS_MODULE_DIR_.$this->module->name.'/views/templates/front/seller/return/return_detail.tpl'
                        );
                        break;
                    case 'approveCancelRequest':
                        $cancel_id = Tools::getValue('ret');
                        $update_return = 'update ' . _DB_PREFIX_ .
                                'velsof_rm_cancel set active=2, date_update=now() where id_rm_cancel=' . (int) $cancel_id . ' and
                    id_shop=' . (int) $this->context->shop->id;
                        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($update_return);
                        $get_return_data = 'select rmc.id_order, rmc.id_customer, rmc.id_rm_cancel as cancel_id, psod.id_order_detail from ' .
                                _DB_PREFIX_ . 'velsof_rm_cancel as rmc inner join ' . _DB_PREFIX_ . 'order_detail as psod on' .
                                ' rmc.id_order = psod.id_order where id_rm_cancel = ' . (int) $cancel_id;
                        $return_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($get_return_data);

                        $kb_order_obj = new Order($return_data[0]['id_order']);

                        if (count($return_data) > 0) {
                            foreach ($return_data as $return) {
                                $order_detail = new OrderDetail($return['id_order_detail']);
                                $seller_order_detail = KbSellerOrderDetail::getDetailByOrderItemId($order_detail->id);
                                if (count($seller_order_detail) > 0) {
                                    $seller_order_detail_obj = new KbSellerOrderDetail($seller_order_detail['id_seller_order_detail']);
                                    $commission_percent = $seller_order_detail_obj->commission_percent;
                                    $returned_qty = $seller_order_detail_obj->qty;
                                    $amount_of_returned_qty = (float) ((int) $returned_qty * $seller_order_detail_obj->unit_price);

                                    $reduce_admin_earning = (float) ((float) ($commission_percent / 100) * $amount_of_returned_qty);
                                    $reduce_seller_earning = ($amount_of_returned_qty - $reduce_admin_earning);

                                    $seller_order_detail_obj->total_earning = ($seller_order_detail_obj->total_earning - $amount_of_returned_qty);
                                    $seller_order_detail_obj->seller_earning = ($seller_order_detail_obj->seller_earning - $reduce_seller_earning);
                                    $seller_order_detail_obj->admin_earning = ($seller_order_detail_obj->admin_earning - $reduce_admin_earning);
                                    $seller_order_detail_obj->qty = ($seller_order_detail_obj->qty - $returned_qty);

                                    $seller_order_detail_obj->save();

                                    Hook::exec('actionKbMarketPlaceSOrderDetailUpdate', array('object' => $seller_order_detail_obj));

                                    $prev_earning = KbSellerEarning::getEarningBySellerAndOrder($seller_order_detail_obj->id_seller, $seller_order_detail_obj->id_order);

                                    if (count($prev_earning) > 0) {
                                        $earnin_obj = new KbSellerEarning($prev_earning['id_seller_earning']);
                                        $earnin_obj->product_count = $earnin_obj->product_count - $returned_qty;
                                        $earnin_obj->total_earning = $earnin_obj->total_earning - $amount_of_returned_qty;
                                        $earnin_obj->seller_earning = $earnin_obj->seller_earning - $reduce_seller_earning;
                                        $earnin_obj->admin_earning = $earnin_obj->admin_earning - $reduce_admin_earning;

                                        $earnin_obj->save();
                                        Hook::exec('actionKbMarketPlaceSEarningUpdate', array('object' => $earnin_obj));
                                    }
                                }
                            }
                        }
                        //order state change code

                        $history = new OrderHistory();

                        $history->id_order = $kb_order_obj->id;
                        $history->id_employee = (int) $this->context->customer->id;
                        $use_existings_payment = false;
                        if (!$kb_order_obj->hasInvoice()) {
                            $use_existings_payment = true;
                        }
                        $history->changeIdOrderState((int) Configuration::get('PS_OS_CANCELED'), $kb_order_obj, $use_existings_payment);
                        //change by vishal for resolving order status update issue.
                        $carrier = new Carrier($kb_order_obj->id_carrier, $kb_order_obj->id_lang);
                        $templateVars = array();
                        if ($history->id_order_state == Configuration::get('PS_OS_SHIPPING') && $kb_order_obj->shipping_number
                        ) {
                            $templateVars = array(
                                '{followup}' => str_replace('@', $kb_order_obj->shipping_number, $carrier->url)
                            );
                        }

                        // Save all changes
                        if ($history->addWithemail(true, $templateVars)) {
                            // synchronizes quantities if needed..
                            if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
                                foreach ($kb_order_obj->getProducts() as $product) {
                                    if (StockAvailable::dependsOnStock($product['product_id'])) {
                                        StockAvailable::synchronize($product['product_id'], (int) $product['id_shop']);
                                    }
                                }
                            }
                        }
                        //changes end
                        $this->json['mail_sent'] = $return_manager_mod_obj->sendNotificationEmail('cancel_app', $return_data[0], null, 1);
                        $this->json['status'] = true;
                        break;
                        
                    case 'denyCancelOrder':
                             $cancel_id = Tools::getValue('ret');
                        $update_return = 'update ' . _DB_PREFIX_ .
                                'velsof_rm_cancel set active=3, date_update=now() where id_rm_cancel=' . (int) $cancel_id . ' and
                    id_shop=' . (int) $this->context->shop->id;
                        $get_return_data = 'select id_order,id_customer, id_rm_cancel as cancel_id from ' .
                                _DB_PREFIX_ . 'velsof_rm_cancel where id_rm_cancel = ' . (int) $cancel_id;
                        $return_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_return_data);
                        /* Edited by Anshul Mittal On 25-08-2017 to add a functionality of email editing before sending it to customer */
                        $this->json['mail_sent'] = $return_manager_mod_obj->sendNotificationEmail('cancel_den', $return_data, null, 1);
                        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($update_return);
                        $this->json['status'] = true;
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
        $this->renderList();
        parent::initContent();
    }

    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();
        if (isset($page['meta']) && $this->seller_info) {
            $page_title = $this->module->l('Return List', 'returnrequest');
            $page['meta']['title'] = $page_title;
            $page['meta']['keywords'] = $this->seller_info['meta_keyword'];
            $page['meta']['description'] = $this->seller_info['meta_description'];
        }
        return $page;
    }

    public function getMarketplaceReturns($active = 0, $from_date = null, $to_date = null)
    {
        $seller_products_array = array();
        $seller_products = KbSellerProduct::getSellerProducts($this->seller_obj->id);
        if (is_array($seller_products) && count($seller_products) > 0) {
            foreach ($seller_products as $key => $product_data) {
                $seller_products_array[] = $product_data['id_product'];
            }
        }
        $seller_product_string = '';
        $seller_product_string = implode(',', $seller_products_array);
        if ($seller_product_string == '') {
            return array(
                'flag' => false,
                'pagination' => '');
        }
        $inner_join_condn = ' inner join `' . _DB_PREFIX_ . 'order_detail` as psod on' .
                        ' od.id_order_detail = psod.id_order_detail where psod.product_id IN ('. $seller_product_string .')';
        $page_number = 1;
        if ($active == 2) {
            $get_returns = 'select {COLUMNS} from ' . _DB_PREFIX_ . 'velsof_rm_order od '.$inner_join_condn .' AND od.active=2 and
                od.id_shop=' . (int) $this->context->shop->id .
                ' order by date_update desc';
        } elseif ($active == 4) {
            if ($from_date == null) {
                $today = date('Y-m-d', time());
                $last_month = date('Y-m-d', strtotime('last month'));
            } else {
                $today = date('Y-m-d', strtotime($to_date));
                $last_month = date('Y-m-d', strtotime($from_date));
            }
            $get_returns = 'select {COLUMNS} from ' . _DB_PREFIX_ . 'velsof_rm_order od '.$inner_join_condn .' AND od.active=4 and
                od.id_shop=' . (int) $this->context->shop->id . ' and
                (date(od.date_update) between "' . pSQL($last_month) . '" and "' . pSQL($today) . '")
				 order by date_update desc';
        } elseif ($active == 6) {
            $inner_join_condn = ' inner join ' . _DB_PREFIX_ . 'orders as pso on od.id_order = pso.id_order inner join ' . _DB_PREFIX_ . 'order_detail as psod on' .
                        ' pso.id_order = psod.id_order where psod.product_id IN ('. $seller_product_string .')';
            $get_returns = 'select {COLUMNS} from ' . _DB_PREFIX_ . 'velsof_rm_cancel od '.$inner_join_condn .' AND od.active=1 and
                od.id_shop=' . (int) $this->context->shop->id .
                ' order by date_update desc';
        } else {
            $get_returns = 'select {COLUMNS} from ' . _DB_PREFIX_ . 'velsof_rm_order od '.$inner_join_condn .' AND od.active=1 and
                od.id_shop=' . (int) $this->context->shop->id .
                ' order by date_update desc';
        }
        $total_records = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            str_replace('{COLUMNS}', 'count(*) as total', $get_returns)
        );
        
        if ($total_records['total'] <= 0) {
            return array(
                'flag' => false,
                'pagination' => '');
        }

        if ($page_number < 1) {
            $page_number = 1;
        }
      
        $return_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(str_replace('{COLUMNS}', '*', $get_returns));
        $return_history = array();
        $flag = 0;
        if ($return_data && count($return_data) > 0) {
            foreach ($return_data as $return) {
                if ($active == 6) {
                    $get_stat_name = 'select l.value from ' . _DB_PREFIX_ . 'velsof_return_data_lang l,' .
                            _DB_PREFIX_ . 'velsof_return_data d
					where l.id_shop=' . (int) $this->context->shop->id . ' and d.return_data_id=' .
                            (int) $return['id_cancel_reason'] . ' and
					l.return_data_id=d.return_data_id';
                    $status_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_stat_name);
                    $return_history[$flag]['reason'] = $status_name['value'];
                    $return_history[$flag]['return_id'] = $return['id_rm_cancel'];
                    $get_name = 'select product_name,product_attribute_id,product_id,unit_price_tax_incl
				from ' . _DB_PREFIX_ . 'order_detail where id_order_detail=' . (int) $return['id_order_detail'] .
                            ' and id_shop=' . (int) $this->context->shop->id;
                    $pro_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_name);

                    if ($pro_name['product_attribute_id'] != 0) {
                        $name_attr = explode(' - ', $pro_name['product_name']);
                        $return_history[$flag]['product_name'] = $name_attr[0];
                        $return_history[$flag]['product_attr'] = $name_attr[1];
                    } else {
                        $return_history[$flag]['product_name'] = $pro_name['product_name'];
                        $return_history[$flag]['product_attr'] = '';
                    }
                    $cust_obj = new Customer($return['id_customer']);
                    $odr_obj = new Order($return['id_order']);

                    $return_history[$flag]['cust_name'] = $cust_obj->firstname . ' ' . $cust_obj->lastname;
                    $return_history[$flag]['cust_email'] = $cust_obj->email;
                    if (isset($pro_name['product_id'])) {
                        $return_history[$flag]['product_link'] = $this->context->link->getProductLink(
                            $pro_name['product_id']
                        );
                    } else {
                        $return_history[$flag]['product_link'] = 'javascript:void(0)';
                    }
                    $return_history[$flag]['return_id'] = $return['id_rm_cancel'];
                    $return_history[$flag]['return_type'] = $this->module->l('Cancel Request', 'returnrequest');
                    $return_history[$flag]['comment'] = $return['comment'];
                    $imageurl = '';
//                if (!Tools::isEmpty($return['image_path'])) {
////                    $imageurl = $return['image_path'];
//                    $imageurl = $this->getImgDirUrl(). 'velsof_return/'.$return['image_path'];
//                }
                    $return_history[$flag]['image_path'] = $imageurl;
                    $return_history[$flag]['quantity'] = $return['product_quantity'];
                    $return_history[$flag]['whopayshipping'] = '';
                    $return_history[$flag]['request_date'] = Tools::displayDate($return['date_add'], $this->context->language->id);
                    if (!Validate::isLoadedObject($odr_obj)) {
                        $return_history[$flag]['order_reference'] = 'XXXXXXXXX';
                    } else {
                        $return_history[$flag]['order_reference'] = $odr_obj->reference;
                    }
                    $return_history[$flag]['order_id'] = $return['id_order'];
                    $return_history[$flag]['customer_id'] = $return['id_customer'];
                    $return_history[$flag]['unit_price_tax_incl'] = Tools::displayPrice($pro_name['unit_price_tax_incl']);
                    $get_status = 'select name from ' . _DB_PREFIX_ . 'order_state_lang where id_order_state = ' . (int) $odr_obj->current_state . ' AND id_lang =' . (int) $this->context->language->id;

                    $current_status = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_status);
                    $get_stat_name = 'select value, id_lang from ' . _DB_PREFIX_ . 'velsof_return_data_lang where id_shop=' . (int) $this->context->shop->id . ' and return_data_id=' .
                            (int) $return['id_cancel_reason'];

                    $get_email_lang = 'select id_lang from ' . _DB_PREFIX_ . 'velsof_rm_cancel where id_shop=' . (int) $this->context->shop->id . ' and id_rm_cancel=' .
                            (int) $return['id_rm_cancel'];
                    $get_email_lang = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_email_lang);

                    $status_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_stat_name);
                    $return_history[$flag]['status'] = $current_status['name'];
                    $return_history[$flag]['status_id'] = $odr_obj->current_state;
                    $return_history[$flag]['id_lang'] = $get_email_lang['id_lang'];
                } else {
                    $get_stat_name = 'select l.value from ' . _DB_PREFIX_ . 'velsof_return_data_lang l,' .
                            _DB_PREFIX_ . 'velsof_return_data d
					where l.id_shop=' . (int) $this->context->shop->id . ' and d.return_data_id=' .
                            (int) $return['id_rm_reason'] . ' and
					l.return_data_id=d.return_data_id';
                    $status_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_stat_name);
                    $return_history[$flag]['reason'] = $status_name['value'];
                    $return_history[$flag]['return_id'] = $return['id_rm_order'];
                    $get_name = 'select product_name,product_attribute_id,product_id,unit_price_tax_incl
				from ' . _DB_PREFIX_ . 'order_detail where id_order_detail=' . (int) $return['id_order_detail'] .
                            ' and id_shop=' . (int) $this->context->shop->id;
                    $pro_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_name);

                    if ($pro_name['product_attribute_id'] != 0) {
                        $name_attr = explode(' - ', $pro_name['product_name']);
                        $return_history[$flag]['product_name'] = $name_attr[0];
                        $return_history[$flag]['product_attr'] = $name_attr[1];
                    } else {
                        $return_history[$flag]['product_name'] = $pro_name['product_name'];
                        $return_history[$flag]['product_attr'] = '';
                    }
                    $cust_obj = new Customer($return['id_customer']);
                    $odr_obj = new Order($return['id_order']);

                    $return_history[$flag]['cust_name'] = $cust_obj->firstname . ' ' . $cust_obj->lastname;
                    $return_history[$flag]['cust_email'] = $cust_obj->email;
                    if (isset($pro_name['product_id'])) {
                        $return_history[$flag]['product_link'] = $this->context->link->getProductLink(
                            $pro_name['product_id']
                        );
                    } else {
                        $return_history[$flag]['product_link'] = 'javascript:void(0)';
                    }
                    $return_history[$flag]['return_id'] = $return['id_rm_order'];
                    $return_history[$flag]['return_type'] = $this->l(Tools::ucfirst($return['return_type']));
                    $return_history[$flag]['comment'] = $return['comment'];
                    $imageurl = '';
                    if (!Tools::isEmpty($return['image_path'])) {
//                    $imageurl = $return['image_path'];
                        $imageurl = $this->getImgDirUrl() . 'velsof_return/' . $return['image_path'];
                    }
                    $return_history[$flag]['image_path'] = $imageurl;
                    $return_history[$flag]['quantity'] = $return['quantity'];
                    $return_history[$flag]['whopayshipping'] = $return['whopayshipping'];
                    $return_history[$flag]['request_date'] = Tools::displayDate($return['date_add'], $this->context->language->id);
                    if (!Validate::isLoadedObject($odr_obj)) {
                        $return_history[$flag]['order_reference'] = 'XXXXXXXXX';
                    } else {
                        $return_history[$flag]['order_reference'] = $odr_obj->reference;
                    }
                    $return_history[$flag]['order_id'] = $return['id_order'];
                    $return_history[$flag]['customer_id'] = $return['id_customer'];
                    $return_history[$flag]['unit_price_tax_incl'] = Tools::displayPrice($pro_name['unit_price_tax_incl']);
                    $get_status = 'select * from ' . _DB_PREFIX_ . 'velsof_rm_status where id_rm_order=' .
                            (int) $return['id_rm_order'] . ' order by date_add desc';
                    $return_status = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_status);
                    $get_stat_name = 'select value, id_lang from ' . _DB_PREFIX_ . 'velsof_return_data_lang where id_shop=' . (int) $this->context->shop->id . ' and return_data_id=' .
                            (int) $return_status['id_rm_status'];

                    $get_email_lang = 'select id_lang from ' . _DB_PREFIX_ . 'velsof_rm_order where id_shop=' . (int) $this->context->shop->id . ' and id_rm_order=' .
                            (int) $return['id_rm_order'];
                    $get_email_lang = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_email_lang);

                    $status_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_stat_name);
                    $return_history[$flag]['status'] = $status_name['value'];
                    $return_history[$flag]['status_id'] = $return_status['id_rm_status'];
                    $return_history[$flag]['id_lang'] = $get_email_lang['id_lang'];
                    if ($return['return_type'] == 'refund') {
                        $return_history[$flag]['is_refund_type'] = 1;
                    } else {
                        $return_history[$flag]['is_refund_type'] = 0;
                    }
                }
                $flag++;
            }
            unset($cust_obj);
            unset($odr_obj);
            if ($return_history && count($return_history) > 0) {
                return array(
                    'flag' => true,
                    'data' => $return_history,
                );
            } else {
                return array(
                    'flag' => false
                );
            }
        } else {
            return array(
                'flag' => false,
            );
        }
    }

    public function getFilteredReturns()
    {
        $page_number = 1;
        $filter_condition = '';
        $seller_products_array = array();
        $seller_products = KbSellerProduct::getSellerProducts($this->seller_obj->id);
        if (is_array($seller_products) && count($seller_products) > 0) {
            foreach ($seller_products as $key => $product_data) {
                $seller_products_array[] = $product_data['id_product'];
            }
        }
        $seller_product_string = '';
        $seller_product_string = implode(',', $seller_products_array);
        if ($seller_product_string == '') {
            return array(
                'flag' => false,
                'pagination' => '');
        }
        $inner_join_condn = '  where pl.product_id IN ('. $seller_product_string .')';
        // changes by rishabh jain

        $active = Tools::getValue('return_type', 0);
        if (Tools::getValue('start_date', '') == '') {
            $from_date = null;
        } else {
            $from_date = Tools::getValue('start_date');
            $from_date = date('Y-m-d', strtotime($from_date));
        }
        if (Tools::getValue('to_date', '') == '') {
            $to_date = null;
        } else {
            $to_date = Tools::getValue('to_date');
            $to_date = date('Y-m-d', strtotime($to_date));
        }
        if (Tools::getValue('return_id', '') != '') {
            $return_id = (int) trim(Tools::getValue('return_id'));
            $filter_condition .= ' and od.id_rm_order LIKE "%' . pSQL($return_id) . '%"';
        }
        if ($active != 4) {
            if ($from_date != null && $to_date != null) {
                $filter_condition .= ' and (date(od.date_update) between "' . pSQL($from_date) . '" and "' . pSQL($to_date) . '")';
            } else if ($from_date != null) {
                $filter_condition .= ' and date(od.date_update) >= "' . pSQL($from_date) . '"';
            } else if ($to_date != null) {
                $filter_condition .= ' and date(od.date_update) <= "' . pSQL($to_date) . '"';
            }
        }

        if ($active == 2) {
            $get_returns = 'select {COLUMNS} from ' . _DB_PREFIX_ . 'velsof_rm_order od join ' . _DB_PREFIX_ . 'orders ods on (od.id_order = ods.id_order AND od.id_shop = ods.id_shop AND ods.id_lang = ods.id_lang AND od.id_customer = ods.id_customer) join ' . _DB_PREFIX_ . 'customer cus on (od.id_customer = cus.id_customer AND od.id_shop = cus.id_shop) join ' . _DB_PREFIX_ . 'order_detail pl on (od.id_order = pl.id_order AND od.id_shop = pl.id_shop AND od.id_order_detail = pl.id_order_detail) '.$inner_join_condn .' AND od.active=2 and
                od.id_shop=' . (int) $this->context->shop->id . $filter_condition .
            ' order by date_update desc';
            // $get_returns = 'select {COLUMNS} from ' . _DB_PREFIX_ . 'velsof_rm_order od join ' . _DB_PREFIX_ . 'orders ods on (od.id_order = ods.id_order AND od.id_shop = ods.id_shop AND ods.id_lang = ods.id_lang AND od.id_customer = ods.id_customer) join ' . _DB_PREFIX_ . 'order_detail psod on (od.id_order_detail = psod.id_order_detail and psod.product_id IN ())  join ' . _DB_PREFIX_ . 'order_detail pl on (od.id_order = pl.id_order AND od.id_shop = pl.id_shop AND od.id_order_detail = pl.id_order_detail) where od.active=2 and
        } elseif ($active == 4) {
            if ($from_date == null) {
                $today = date('Y-m-d', time());
                $last_month = date('Y-m-d', strtotime('last month'));
            } else {
                $today = date('Y-m-d', strtotime($to_date));
                $last_month = date('Y-m-d', strtotime($from_date));
            }
            $get_returns = 'select {COLUMNS} from ' . _DB_PREFIX_ . 'velsof_rm_order od  join ' . _DB_PREFIX_ . 'orders ods on (od.id_order = ods.id_order AND od.id_shop = ods.id_shop AND ods.id_lang = ods.id_lang AND od.id_customer = ods.id_customer) join ' . _DB_PREFIX_ . 'customer cus on (od.id_customer = cus.id_customer AND od.id_shop = cus.id_shop)  join ' . _DB_PREFIX_ . 'order_detail pl on (od.id_order = pl.id_order AND od.id_shop = pl.id_shop AND od.id_order_detail = pl.id_order_detail)  '.$inner_join_condn .' AND od.active=4 and
                od.id_shop=' . (int) $this->context->shop->id . ' and
                (date(od.date_update) between "' . pSQL($last_month) . '" and "' . pSQL($today) . '")' . $filter_condition.
            ' order by date_update desc';
        } elseif ($active == 5) {
            $get_returns = 'select {COLUMNS} from ' . _DB_PREFIX_ . 'velsof_rm_order od   join ' . _DB_PREFIX_ . 'orders ods on (od.id_order = ods.id_order AND od.id_shop = ods.id_shop AND ods.id_lang = ods.id_lang AND od.id_customer = ods.id_customer)  join ' . _DB_PREFIX_ . 'customer cus on (od.id_customer = cus.id_customer AND od.id_shop = cus.id_shop)  join ' . _DB_PREFIX_ . 'order_detail pl on (od.id_order = pl.id_order AND od.id_shop = pl.id_shop AND od.id_order_detail = pl.id_order_detail)  '.$inner_join_condn .' AND od.active=5 and
                od.id_shop=' . (int) $this->context->shop->id . $filter_condition
                . ' order by date_update desc';
        } elseif ($active == 6) {
            $inner_join_condn = ' inner join ' . _DB_PREFIX_ . 'orders as pso on od.id_order = pso.id_order inner join ' . _DB_PREFIX_ . 'order_detail as psod on' .
                        ' pso.id_order = psod.id_order where psod.product_id IN ('. $seller_product_string .')';
            $get_returns = 'select {COLUMNS} from ' . _DB_PREFIX_ . 'velsof_rm_cancel od '.$inner_join_condn .' AND od.active=1 and
                od.id_shop=' . (int) $this->context->shop->id .
                ' order by date_update desc';
        } else {
            $get_returns = 'select {COLUMNS} from ' . _DB_PREFIX_ . 'velsof_rm_order od   join ' . _DB_PREFIX_ . 'orders ods on (od.id_order = ods.id_order AND od.id_shop = ods.id_shop AND ods.id_lang = ods.id_lang AND od.id_customer = ods.id_customer)  join ' . _DB_PREFIX_ . 'customer cus on (od.id_customer = cus.id_customer AND od.id_shop = cus.id_shop)  join ' . _DB_PREFIX_ . 'order_detail pl on (od.id_order = pl.id_order AND od.id_shop = pl.id_shop AND od.id_order_detail = pl.id_order_detail)  '.$inner_join_condn .' AND od.active=1 and
                od.id_shop=' . (int) $this->context->shop->id . $filter_condition
                . ' order by date_update desc';
        }
        $total_records = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow(
            str_replace('{COLUMNS}', 'count(*) as total', $get_returns)
        );

        if ($total_records['total'] <= 0) {
            return array(
                'flag' => false,
            );
        }

        if ($page_number < 1) {
            $page_number = 1;
        }
        // changes by rishabh jain
        $settings = Configuration::get('VELSOF_RETURNMANAGER');
        $settings = Tools::unSerialize($settings);
//        print_r(str_replace('{COLUMNS}', 'od.*', $get_returns));
//        die;
//        $item_per_page = $settings['rm_return_list_size'];
//        $total_pages = ceil((int) $total_records['total'] / $item_per_page);
//
//        $page_position = (($page_number - 1) * $item_per_page);
//
//        $get_returns .= ' LIMIT ' . $page_position . ', ' . $item_per_page;
        // changes over
        
        $return_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(str_replace('{COLUMNS}', '*', $get_returns));
        $return_history = array();
        $flag = 0;
        if ($return_data && count($return_data) > 0) {
            foreach ($return_data as $return) {
                if ($active == 6) {
                    $get_stat_name = 'select l.value from ' . _DB_PREFIX_ . 'velsof_return_data_lang l,' .
                            _DB_PREFIX_ . 'velsof_return_data d
					where l.id_shop=' . (int) $this->context->shop->id . ' and d.return_data_id=' .
                            (int) $return['id_cancel_reason'] . ' and
					l.return_data_id=d.return_data_id';
                    $status_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_stat_name);
                    $return_history[$flag]['reason'] = $status_name['value'];
                    $return_history[$flag]['return_id'] = $return['id_rm_cancel'];
                    $get_name = 'select product_name,product_attribute_id,product_id,unit_price_tax_incl from ' . _DB_PREFIX_ . 'order_detail where id_order_detail=' . (int) $return['id_order_detail'] .
                            ' and id_shop=' . (int) $this->context->shop->id;
                    $pro_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_name);

                    if ($pro_name['product_attribute_id'] != 0) {
                        $name_attr = explode(' - ', $pro_name['product_name']);
                        $return_history[$flag]['product_name'] = $name_attr[0];
                        $return_history[$flag]['product_attr'] = $name_attr[1];
                    } else {
                        $return_history[$flag]['product_name'] = $pro_name['product_name'];
                        $return_history[$flag]['product_attr'] = '';
                    }
                    $cust_obj = new Customer($return['id_customer']);
                    $odr_obj = new Order($return['id_order']);

                    $return_history[$flag]['cust_name'] = $cust_obj->firstname . ' ' . $cust_obj->lastname;
                    $return_history[$flag]['cust_email'] = $cust_obj->email;
                    if (isset($pro_name['product_id'])) {
                        $return_history[$flag]['product_link'] = $this->context->link->getProductLink(
                            $pro_name['product_id']
                        );
                    } else {
                        $return_history[$flag]['product_link'] = 'javascript:void(0)';
                    }
                    $return_history[$flag]['return_id'] = $return['id_rm_cancel'];
                    $return_history[$flag]['return_type'] = $this->module->l('Cancel Request', 'returnrequest');
                    $return_history[$flag]['comment'] = $return['comment'];
                    $imageurl = '';
//                if (!Tools::isEmpty($return['image_path'])) {
////                    $imageurl = $return['image_path'];
//                    $imageurl = $this->getImgDirUrl(). 'velsof_return/'.$return['image_path'];
//                }
                    $return_history[$flag]['image_path'] = $imageurl;
                    $return_history[$flag]['quantity'] = $return['product_quantity'];
                    $return_history[$flag]['whopayshipping'] = '';
                    $return_history[$flag]['request_date'] = Tools::displayDate($return['date_add'], $this->context->language->id);
                    if (!Validate::isLoadedObject($odr_obj)) {
                        $return_history[$flag]['order_reference'] = 'XXXXXXXXX';
                    } else {
                        $return_history[$flag]['order_reference'] = $odr_obj->reference;
                    }
                    $return_history[$flag]['order_id'] = $return['id_order'];
                    $return_history[$flag]['customer_id'] = $return['id_customer'];
                    $return_history[$flag]['unit_price_tax_incl'] = Tools::displayPrice($pro_name['unit_price_tax_incl']);
                    $get_status = 'select name from ' . _DB_PREFIX_ . 'order_state_lang where id_order_state = ' . (int) $odr_obj->current_state . ' AND id_lang =' . (int) $this->context->language->id;

                    $current_status = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_status);
                    $get_stat_name = 'select value, id_lang from ' . _DB_PREFIX_ . 'velsof_return_data_lang where id_shop=' . (int) $this->context->shop->id . ' and return_data_id=' .
                            (int) $return['id_cancel_reason'];

                    $get_email_lang = 'select id_lang from ' . _DB_PREFIX_ . 'velsof_rm_cancel where id_shop=' . (int) $this->context->shop->id . ' and id_rm_cancel=' .
                            (int) $return['id_rm_cancel'];
                    $get_email_lang = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_email_lang);

                    $status_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_stat_name);
                    $return_history[$flag]['status'] = $current_status['name'];
                    $return_history[$flag]['status_id'] = $odr_obj->current_state;
                    $return_history[$flag]['id_lang'] = $get_email_lang['id_lang'];
                } else {
                    $get_stat_name = 'select l.value from ' . _DB_PREFIX_ . 'velsof_return_data_lang l,' .
                            _DB_PREFIX_ . 'velsof_return_data d
					where l.id_shop=' . (int) $this->context->shop->id . ' and d.return_data_id=' .
                            (int) $return['id_rm_reason'] . ' and
					l.return_data_id=d.return_data_id';
                    $status_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_stat_name);
                    $return_history[$flag]['reason'] = $status_name['value'];
                    $return_history[$flag]['return_id'] = $return['id_rm_order'];
                    $get_name = 'select product_name,product_attribute_id,product_id,unit_price_tax_incl
				from ' . _DB_PREFIX_ . 'order_detail where id_order_detail=' . (int) $return['id_order_detail'] .
                            ' and id_shop=' . (int) $this->context->shop->id;
                    $pro_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_name);

                    if ($pro_name['product_attribute_id'] != 0) {
                        $name_attr = explode(' - ', $pro_name['product_name']);
                        $return_history[$flag]['product_name'] = $name_attr[0];
                        $return_history[$flag]['product_attr'] = $name_attr[1];
                    } else {
                        $return_history[$flag]['product_name'] = $pro_name['product_name'];
                        $return_history[$flag]['product_attr'] = '';
                    }
                    $cust_obj = new Customer($return['id_customer']);
                    $odr_obj = new Order($return['id_order']);

                    $return_history[$flag]['cust_name'] = $cust_obj->firstname . ' ' . $cust_obj->lastname;
                    $return_history[$flag]['cust_email'] = $cust_obj->email;
                    if (isset($pro_name['product_id'])) {
                        $return_history[$flag]['product_link'] = $this->context->link->getProductLink(
                            $pro_name['product_id']
                        );
                    } else {
                        $return_history[$flag]['product_link'] = 'javascript:void(0)';
                    }
                    $return_history[$flag]['return_id'] = $return['id_rm_order'];
                    $return_history[$flag]['return_type'] = $this->l(Tools::ucfirst($return['return_type']));
                    $return_history[$flag]['comment'] = $return['comment'];
                    $imageurl = '';
                    if (!Tools::isEmpty($return['image_path'])) {
//                    $imageurl = _PS_BASE_URL_ . _PS_IMG_ . 'velsof_return/' . $return['image_path'];
                        $imageurl = $this->getImgDirUrl() . 'velsof_return/' . $return['image_path'];
                    }
                    $return_history[$flag]['image_path'] = $imageurl;
                    $return_history[$flag]['quantity'] = $return['quantity'];
                    $return_history[$flag]['whopayshipping'] = $return['whopayshipping'];
//                $return_history[$flag]['request_date'] = date('d-M-Y', strtotime($return['date_add']));
                    $return_history[$flag]['request_date'] = Tools::displayDate($return['date_add'], $this->context->language->id);
                    if (!Validate::isLoadedObject($odr_obj)) {
                        $return_history[$flag]['order_reference'] = 'XXXXXXXXX';
                    } else {
                        $return_history[$flag]['order_reference'] = $odr_obj->reference;
                    }
                    $return_history[$flag]['order_id'] = $return['id_order'];
                    $return_history[$flag]['customer_id'] = $return['id_customer'];
                    // cahnges by rishabh jain
                    $today = date('Y-m-d H:i:s');
                    $date1 = date_create($today);
                    $date2 = date_create($return['date_add']);
                    $interval = date_diff($date1, $date2);
                    $return_history[$flag]['time_duration'] = $interval->format('%a');
                    // changes over
                    $return_history[$flag]['unit_price_tax_incl'] = Tools::displayPrice($pro_name['unit_price_tax_incl']);
                    $get_status = 'select * from ' . _DB_PREFIX_ . 'velsof_rm_status where id_rm_order=' .
                            (int) $return['id_rm_order'] . ' order by date_add desc';
                    $return_status = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_status);
                    /* Edited by Anshul Mittal on 26-08-2017 to fix the issue of sent email language according to customer */
                    $get_stat_name = 'select value, id_lang from ' . _DB_PREFIX_ . 'velsof_return_data_lang where id_shop=' . (int) $this->context->shop->id . ' and return_data_id=' .
                            (int) $return_status['id_rm_status'];

                    $get_email_lang = 'select id_lang from ' . _DB_PREFIX_ . 'velsof_rm_order where id_shop=' . (int) $this->context->shop->id . ' and id_rm_order=' .
                            (int) $return['id_rm_order'];
                    $get_email_lang = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_email_lang);

                    $status_name = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($get_stat_name);
                    $return_history[$flag]['status'] = $status_name['value'];
                    $return_history[$flag]['status_id'] = $return_status['id_rm_status'];
                    /* Added by Anshul Mittal on 26-08-2017 to fix the issue of sent email language according to customer */
                    $return_history[$flag]['id_lang'] = $get_email_lang['id_lang'];
                    if ($return['return_type'] == 'refund') {
                        $return_history[$flag]['is_refund_type'] = 1;
                    } else {
                        $return_history[$flag]['is_refund_type'] = 0;
                    }
                }
                $flag++;
            }
            unset($cust_obj);
            unset($odr_obj);
            if ($return_history && count($return_history) > 0) {
                return array(
                    'flag' => true,
                    'data' => $return_history,
                );
            } else {
                return array(
                    'flag' => false,
                );
            }
        } else {
            return array(
                'flag' => false,
            );
        }
    }

    public function getAjaxReturnListHtml()
    {
        $json = array();
        $filtered_return_data = $this->getFilteredReturns();
        $this->total_records = 0;
        $row_html = '';
        if (isset($filtered_return_data['data']) && count($filtered_return_data['data']) > 0) {
            if (Tools::getIsset('start') && (int)Tools::getValue('start') > 0) {
                $this->page_start = (int)Tools::getValue('start');
            }
            $this->total_records = count($filtered_return_data['data']);
            $filtered_return_data['data'] = array_slice($filtered_return_data['data'], (int)$this->getPageStart(), $this->tbl_row_limit);
            foreach ($filtered_return_data['data'] as $request_key => $request) {
                $action_block = '';
                $return_request_type = Tools::getValue('return_type', 0);
                if ($return_request_type == 0) {
                    $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="allowRequest(this);" class="velsof-glyphicons glyphicons ok" title="' . $this->module->l('Approve Return', 'returnrequest') . '"><i></i></a>';
                    $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="denyRequest(this);" class="velsof-glyphicons glyphicons remove" title="' . $this->module->l('Deny Return', 'returnrequest') . '"><i></i></a>';
                    $action_block .= '<a type="' . $request['return_id'] . '" onclick="showreason(this);" style="cursor: pointer;" data-container="body" data-toggle="popover" data-placement="left" data-content="' . $request['reason'] . '" class="velsof-glyphicons glyphicons circle_question_mark rm_customer_notes" title="' . $this->module->l('Return Reason', 'returnrequest') . '"><i></i></a>';
                    $action_block .= '<a type="' . $request['return_id'] . '" onclick="showcomment(this);" style="cursor: pointer;" data-container="body" data-toggle="popover" data-placement="left" data-content="' . $request['comment'] . '" class="velsof-glyphicons glyphicons notes_2 rm_customer_notes" title="' . $this->module->l('Customer Notes', 'returnrequest') . '"><i></i></a>';
                    if ($request['image_path'] != '') {
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" style="cursor: pointer;" href="' . $request['image_path'] . '" target="_blank" onclick="" class="velsof-glyphicons glyphicons file" title="' . $this->module->l('View Uploaded file', 'returnrequest') . '"><i></i></a>';
                    }
                } else if ($return_request_type == 2) {
                    // for active return list
                    // changes by rishabh jain to add return id column
                    $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="denyRequest(this);" class="velsof-glyphicons glyphicons remove" title="' . $this->module->l('Deny Return', 'returnrequest') . '"><i></i></a>';
                    $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="changeReturnStatus(this);" class="velsof-glyphicons glyphicons edit" title="' . $this->module->l('Change Status', 'returnrequest') . '"><i></i></a>';
                    $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" onclick="viewReturnDetail(this)" class="velsof-glyphicons glyphicons history" title="' . $this->module->l('View History', 'returnrequest') . '"><i></i></a>';
                    $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" onclick="showcomment(this);" data-container="body" data-toggle="popover" data-placement="left" data-content="' . $request['comment'] . '" class="velsof-glyphicons glyphicons notes_2 rm_customer_notes" title="' . $this->module->l('Customer Notes', 'returnrequest') . '"><i></i></a>';
                    if ($request['is_refund_type'] == 1) {
                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" style="cursor: pointer;" onclick="completeReturn(this)" class="velsof-glyphicons glyphicons ok_2" refund="1" title="' . $this->module->l('Mark as Complete', 'returnrequest') . '"><i></i></a>';
                    } else {
                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" style="cursor: pointer;" onclick="completeReturn(this)" class="velsof-glyphicons glyphicons ok_2" refund="0" title="' . $this->module->l('Mark as Complete', 'returnrequest') . '"><i></i></a>';
                    }
                    if ($request['image_path'] != '') {
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" style="cursor: pointer;" href="' . $request['image_path'] . '" target="_blank" onclick="" class="velsof-glyphicons glyphicons file" title="' . $this->module->l('View Uploaded file', 'returnrequest') . '"><i></i></a>';
                    }
                    $action_block .= '<input type="hidden" id="rm_active_curr_status_' . $request['return_id'] . '" value="' . $request['status_id'] . '" /></td></tr>';
                } else if ($return_request_type == 4 || $return_request_type == 5) {
                    // for archive list
                    $action_block .= '<a type="' . $request['return_id'] . '" onclick="showreason(this);" style="cursor: pointer;" data-container="body" data-toggle="popover" data-placement="left" data-content="' . $request['reason'] . '" class="velsof-glyphicons glyphicons circle_question_mark rm_customer_notes" title="' . $this->module->l('Return Reason', 'returnrequest') . '"><i></i></a>';
                    $action_block .= '<a type="' . $request['return_id'] . '" onclick="showcomment(this);" style="cursor: pointer;" data-container="body" data-toggle="popover" data-placement="left" data-content="' . $request['comment'] . '" class="velsof-glyphicons glyphicons notes_2 rm_customer_notes" title="' . $this->module->l('Customer Notes', 'returnrequest') . '"><i></i></a>';
                    if ($request['image_path'] != '') {
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" style="cursor: pointer;" href="' . $request['image_path'] . '" target="_blank" onclick="" class="velsof-glyphicons glyphicons file" title="' . $this->module->l('View Uploaded file', 'returnrequest') . '"><i></i></a>';
                    }
                } else if ($return_request_type == 6) {
                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="approveCancelRequest(this);" class="velsof-glyphicons glyphicons ok" title="' . $this->module->l('Approve Cancel Request', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="denyCancelRequest(this);" class="velsof-glyphicons glyphicons remove" title="' . $this->module->l('Deny Cancel Request', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" data-container="body" onclick="showreason(this);" data-toggle="popover" data-placement="left" data-content="' . $request['reason'] . '" class="velsof-glyphicons glyphicons circle_question_mark rm_customer_notes" title="' . $this->module->l('Return Reason', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" data-container="body" onclick="showcomment(this);" data-toggle="popover" data-placement="left" data-content="' . $request['comment'] . '" class="velsof-glyphicons glyphicons notes_2 rm_customer_notes" title="' . $this->module->l('Customer Notes', 'returnrequest') . '"><i></i></a>';
                }
                $view_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    'order',
                    array(
                        'render_type' => 'view',
                        'id_order' => $request['order_id']
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $row_html .= '<tr>';
                $row_html .= '<td>' . $request['return_id'] . '</td>';
                $row_html .= '<td><a href="' . $view_link . '" title="' . $this->module->l('Click to view order detail', 'returnrequest') . '" onclick="" target="_blank">' . $request['order_reference'] . '</a></td>';
                $row_html .='<td>' . $request['product_name'] . '</td>';
                $row_html .='<td>' . $request['cust_email'] . '</td>';
                $row_html .='<td>' . $request['quantity'] . '</td>';
                $row_html .='<td>' . $request['request_date'] . '</td>';
                $row_html .='<td>' . $request['return_type'] . '</td>';
                $row_html .='<td>' . $request['status'] . '</td>';
                $row_html .='<td>' . $action_block . '</td>';
                $row_html .='</tr>';
            }
            $this->table_id = 'seller_returnrequest_filter';
            $this->list_row_callback = 'getSellerFilteredReturnRequest';
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
            $json['msg'] = $this->module->l('No Data Found', 'returnrequest');
        }
        return $json;
    }

    private function getImgDirUrl()
    {
        $module_dir = '';
        if ($this->checkSecureUrl()) {
            $module_dir = _PS_BASE_URL_SSL_ . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_IMG_DIR_);
        } else {
            $module_dir = _PS_BASE_URL_ . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_IMG_DIR_);
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
    private function renderList()
    {
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Module::isInstalled('returnmanager') && Module::isEnabled('returnmanager')) {
            $return_mod_obj = Module::getInstanceByName('returnmanager');
            $return_pending = $this->getMarketplaceReturns(0);
            $return_active = $this->getMarketplaceReturns(2);
            $return_archive = $this->getMarketplaceReturns(4);
            $return_cancelled = $this->getMarketplaceReturns(5);
            $cancel_request = $this->getMarketplaceReturns(6);
            if (isset($return_pending['data']) && $return_pending['data'] != null && count($return_pending['data']) > 0) {
                $return_request_type = 0;
            } elseif (isset($return_active['data']) && $return_active['data'] != null && count($return_active['data']) > 0) {
                $return_request_type = 2;
            } elseif (isset($return_archive['data']) && $return_archive['data'] != null && count($return_archive['data']) > 0) {
                $return_request_type = 4;
            } elseif (isset($return_cancelled['data']) && $return_cancelled['data'] != null && count($return_cancelled['data']) > 0) {
                $return_request_type = 5;
            } elseif (isset($cancel_request['data']) && $cancel_request['data'] != null && count($cancel_request['data']) > 0) {
                $return_request_type = 6;
            } else {
                $return_request_type = 0;
            }
            $return_type = array(
                array(
                    'value' => 0,
                    'label' => $this->module->l('Pending List', 'returnrequest')),
                array(
                    'value' => 2,
                    'label' => $this->module->l('Active List', 'returnrequest')),
                array(
                    'value' => 4,
                    'label' => $this->module->l('Archive List', 'returnrequest')),
                array(
                    'value' => 5,
                    'label' => $this->module->l('Cancelled List', 'returnrequest')),
                 array(
                    'value' => 6,
                    'label' => $this->module->l('Cancel Order Request List', 'returnrequest'))
            );

            $this->filter_header = $this->module->l('Filter Your Search', 'returnrequest');
            $this->filter_id = 'seller_returnrequest_filter';
            $this->filters = array(
                array(
                    'type' => 'text',
                    'name' => 'return_id',
                    'label' => $this->module->l('Return Id ', 'returnrequest'),
                ),
                array(
                    'type' => 'select',
//                    'placeholder' => $this->module->l('Select', 'returnrequest'),
                    'name' => 'return_type',
                    'label' => $this->module->l('Return List type', 'returnrequest'),
                    'values' => $return_type,
                    'default' => $return_request_type,
                ),
                array(
                    'type' => 'text',
                    'name' => 'start_date',
                    'class' => 'datepicker',
                    'label' => $this->module->l('From Date', 'returnrequest')
                ),
                array(
                    'type' => 'text',
                    'name' => 'to_date',
                    'class' => 'datepicker',
                    'label' => $this->module->l('To Date', 'returnrequest')
                ),
            );
            $this->filter_action_name = 'getSellerFilteredReturnRequest';
            $this->context->smarty->assign('kbfilter', $this->renderKbListFilter());

            $this->table_id = $this->filter_id;
            $this->table_header = array(
                array(
                    'label' => $this->module->l('Return ID', 'returnrequest'),
                    'align' => 'right',
                    'width' => '60'
                ),
                array(
                    'label' => $this->module->l('Order', 'returnrequest'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Product', 'returnrequest'),
                    'width' => '100'),
                array(
                    'label' => $this->module->l('Email', 'returnrequest'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Quantity', 'returnrequest'),
                    'width' => '40'),
                array(
                        'label' => $this->module->l('Date', 'returnrequest')),
                array(
                    'label' => $this->module->l('Type', 'returnrequest'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Status', 'returnrequest'),
                    'width' => '80'),
                array(
                    'label' => $this->module->l('Action', 'returnrequest'),
                    'width' => '400')
            );
            $this->total_records = 0;
            $return_pending = $this->getMarketplaceReturns($return_request_type);
            if (isset($return_pending['data']) && $return_pending['data'] != null) {
                $i = 0;
                foreach ($return_pending['data'] as $return_pen) {
                    $return_pending['data'][$i]['comment'] = nl2br($return_pen['comment']);
                    $i++;
                }
                $this->total_records = count($return_pending['data']);
            }
            if ($this->total_records > 0) {
                $return_request = $return_pending['data'];
                $return_request = array_slice($return_request, 0, $this->tbl_row_limit);
                foreach ($return_request as $request_key => $request) {
                    $action_block = '';
                    
                    // for pending return list
//                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='To add multiple zip-codes use comma "," to separate. Ex- "201222,201233,786999"' mod='kbmarketplace'}">info_outline</i>
                    if ($return_request_type == 0) {
                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="allowRequest(this);" class="velsof-glyphicons glyphicons ok" title="' . $this->module->l('Approve Return', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="denyRequest(this);" class="velsof-glyphicons glyphicons remove" title="' . $this->module->l('Deny Return', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" data-container="body" onclick="showreason(this);" data-toggle="popover" data-placement="left" data-content="' . $request['reason'] . '" class="velsof-glyphicons glyphicons circle_question_mark rm_customer_notes" title="' . $this->module->l('Return Reason', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" data-container="body" onclick="showcomment(this);" data-toggle="popover" data-placement="left" data-content="' . $request['comment'] . '" class="velsof-glyphicons glyphicons notes_2 rm_customer_notes" title="' . $this->module->l('Customer Notes', 'returnrequest') . '"><i></i></a>';
                        if ($request['image_path'] != '') {
                            $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" style="cursor: pointer;" href="' . $request['image_path'] . '" target="_blank" onclick="" class="velsof-glyphicons glyphicons file" title="' . $this->module->l('View Uploaded file', 'returnrequest') . '"><i></i></a>';
                        }
                    } else if ($return_request_type == 2) {
                        // for active return list
                        // changes by rishabh jain to add return id column
                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="denyRequest(this);" class="velsof-glyphicons glyphicons remove" title="' . $this->module->l('Deny Return', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="changeReturnStatus(this);" class="velsof-glyphicons glyphicons edit" title="' . $this->module->l('Change Status', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" onclick="viewReturnDetail(this)" class="velsof-glyphicons glyphicons history" title="' . $this->module->l('View History', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" onclick="showcomment(this);" data-container="body" data-toggle="popover" data-placement="left" data-content="' . $request['comment'] . '" class="velsof-glyphicons glyphicons notes_2 rm_customer_notes" title="' . $this->module->l('Customer Notes', 'returnrequest') . '"><i></i></a>';
                        if ($request['is_refund_type'] == 1) {
                            $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" style="cursor: pointer;" onclick="completeReturn(this)" class="velsof-glyphicons glyphicons ok_2" refund="1" title="' . $this->module->l('Mark as Complete', 'returnrequest') . '"><i></i></a>';
                        } else {
                            $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" style="cursor: pointer;" onclick="completeReturn(this)" class="velsof-glyphicons glyphicons ok_2" refund="0" title="' . $this->module->l('Mark as Complete', 'returnrequest') . '"><i></i></a>';
                        }
//                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '"  style="cursor: pointer;" style="cursor: pointer;" onclick="completeReturn(this)" class="velsof-glyphicons glyphicons ok_2" title="' . $this->module->l('Mark as Complete', 'returnrequest') . '"><i></i></a>';
                        if ($request['image_path'] != '') {
                            $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" style="cursor: pointer;" href="' . $request['image_path'] . '" target="_blank" onclick="" class="velsof-glyphicons glyphicons file" title="' . $this->module->l('View Uploaded file', 'returnrequest') . '"><i></i></a>';
                        }
                        $action_block .= '<input type="hidden" id="rm_active_curr_status_' . $request['return_id'] . '" value="' . $request['status_id'] . '" /></td></tr>';
                    } else if ($return_request_type == 4 || $return_request_type == 5) {
                        // for archive list
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" data-container="body" onclick="showreason(this);" data-toggle="popover" data-placement="left" data-content="' . $request['reason'] . '" class="velsof-glyphicons glyphicons circle_question_mark rm_customer_notes" title="' . $this->module->l('Return Reason', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" data-container="body" onclick="showcomment(this);" data-toggle="popover" data-placement="left" data-content="' . $request['comment'] . '" class="velsof-glyphicons glyphicons notes_2 rm_customer_notes" title="' . $this->module->l('Customer Notes', 'returnrequest') . '"><i></i></a>';
                        if ($request['image_path'] != '') {
                            $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" style="cursor: pointer;" href="' . $request['image_path'] . '" target="_blank" onclick="" class="velsof-glyphicons glyphicons file" title="' . $this->module->l('View Uploaded file', 'returnrequest') . '"><i></i></a>';
                        }
                    } else if ($return_request_type == 6) {
                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="approveCancelRequest(this);" class="velsof-glyphicons glyphicons ok" title="' . $this->module->l('Approve Cancel Request', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '_' . $request['id_lang'] . '" style="cursor: pointer;" onclick="denyCancelRequest(this);" class="velsof-glyphicons glyphicons remove" title="' . $this->module->l('Deny Cancel Request', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" data-container="body" onclick="showreason(this);" data-toggle="popover" data-placement="left" data-content="' . $request['reason'] . '" class="velsof-glyphicons glyphicons circle_question_mark rm_customer_notes" title="' . $this->module->l('Return Reason', 'returnrequest') . '"><i></i></a>';
                        $action_block .= '<a type="' . $request['return_id'] . '" style="cursor: pointer;" data-container="body" onclick="showcomment(this);" data-toggle="popover" data-placement="left" data-content="' . $request['comment'] . '" class="velsof-glyphicons glyphicons notes_2 rm_customer_notes" title="' . $this->module->l('Customer Notes', 'returnrequest') . '"><i></i></a>';
                    }
                    // changes over
                    $view_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        'order',
                        array(
                            'render_type' => 'view',
                            'id_order' => $request['order_id']
                        ),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $this->table_content[$request['return_id']] = array(
                        array(
                            'value' => $request['return_id']),
                        array(
                            'link' => array(
                                'href' => $view_link,
                                'function' => '',
                                'title' => $this->module->l('Click to view order detail', 'returnrequest'),
                                'target' => '_blank'
                            ),
                            'value' => $request['order_reference']
                        ),
                        array(
                            'value' => $request['product_name']),
                        array(
                            'value' => $request['cust_email']),
                        array(
                            'value' => $request['quantity']),
                        array(
                            'value' => $request['request_date']),
                        array(
                            'value' => $request['return_type']),
                        array(
                            'value' => $request['status']),
                        array(
                            'value' => $action_block),
                    );
                }

                $this->list_row_callback = $this->filter_action_name;

                $this->table_enable_multiaction = false;
                //Show Multi actions
            }

            $this->context->smarty->assign('kblist', $this->renderKbList());
            $this->context->smarty->assign('display_feature', true);
            $js_file = _PS_BASE_URL_SSL_ . __PS_BASE_URI__ . 'modules/kbmarketplace/libraries/tinymce/tinymce.min.js';
            $this->context->smarty->assign('tiny_mce_js_file', $js_file);
            $default_lang_js_path = $this->getKbModuleDir() . 'libraries/tinymce/langs/'
                . Language::getIsoById($this->default_form_language) . '.js';
            if (file_exists($default_lang_js_path)) {
                $editor_lang = Language::getIsoById($this->default_form_language);
            } else {
                $editor_lang = 'en';
            }
            $this->context->smarty->assign('editor_lang', $editor_lang);
            $status_detail = $return_mod_obj->select('status');
            $this->context->smarty->assign('status_return', $status_detail);
        }
        $this->setKbTemplate('seller/return/list.tpl');
    }
}
