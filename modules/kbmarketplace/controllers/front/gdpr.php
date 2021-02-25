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
 */

require_once 'KbCore.php';

class KbmarketplaceGdprModuleFrontController extends KbmarketplaceCoreModuleFrontController
{
    public $controller_name = 'gdpr';
    const MIN_REASON_LENGTH = 30;
    const MAX_REASON_LENGTH = 300;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function initContent()
    {
        $gdpr_setting = Tools::jsonDecode(Configuration::get('KB_MP_GDPR_SETTINGS'), true);
        if (!empty($gdpr_setting) && $gdpr_setting['enable_gdpr']) {
            $seller = $this->seller_info;
            $id_seller = $seller['id_seller'];
            $existing_request = Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'kb_mp_seller_shop_close_request where id_seller='.(int)$id_seller.' AND approved="0"');
            
            $this->context->smarty->assign(
                array(
                    'controller_link' => $this->context->link->getModuleLink($this->module->name, 'gdpr'),
                    'gdpr_setting' => $gdpr_setting,
                    'existing_request' => $existing_request,
                    'product_download_link' => $this->context->link->getModuleLink($this->module->name, 'gdpr', array('download_gdpr' => 1, 'gdpr_type' => 'products'), (bool) Configuration::get('PS_SSL_ENABLED')),
                    'seller_orders_download_link' => $this->context->link->getModuleLink($this->module->name, 'gdpr', array('download_gdpr' => 1, 'gdpr_type' => 'sellerorders'), (bool) Configuration::get('PS_SSL_ENABLED')),
                    'seller_info_download_link' => $this->context->link->getModuleLink($this->module->name, 'gdpr', array('download_gdpr' => 1, 'gdpr_type' => 'sellerinfo'), (bool) Configuration::get('PS_SSL_ENABLED')),
                    'personal_info_download_link' => $this->context->link->getModuleLink($this->module->name, 'gdpr', array('download_gdpr' => 1, 'gdpr_type' => 'personalinfo'), (bool) Configuration::get('PS_SSL_ENABLED')),
                    'address_download_link' => $this->context->link->getModuleLink($this->module->name, 'gdpr', array('download_gdpr' => 1, 'gdpr_type' => 'address'), (bool) Configuration::get('PS_SSL_ENABLED')),
                    'orders_download_link' => $this->context->link->getModuleLink($this->module->name, 'gdpr', array('download_gdpr' => 1, 'gdpr_type' => 'orders'), (bool) Configuration::get('PS_SSL_ENABLED')),
                )
            );
            $this->setKbTemplate('seller/gdpr.tpl');
        } else {
            Tools::redirect($this->context->link->getModuleLink($this->module->name, 'dashboard'));
        }
        parent::initContent();
    }

    public function setMedia()
    {
        $this->addCSS($this->getKbModuleDir().'views/css/front/kb-forms.css');
        parent::setMedia();
    }
    
    public function postProcess()
    {
        
        $redirect_link = $this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            array(),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        $seller = $this->seller_info;
        $id_seller = $seller['id_seller'];
        
        if (Tools::isSubmit('kb_mp_cancel_close_btn')) {
            $data = Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'kb_mp_seller_shop_close_request set approved="3" Where approved="0" AND id_seller='.(int)$id_seller);
            if ($data) {
                $this->context->cookie->__set(
                    'redirect_success',
                    $this->module->l('The request to close the shop has been cancelled.', 'gdpr')
                );
                Tools::redirect($redirect_link);
            }
        }
        
        if (Tools::isSubmit('kb_mp_close_btn')) {
            $delete_customer = 0;
            if (Tools::getIsset('kb_delete_customer') && Tools::getValue('kb_delete_customer')) {
                $delete_customer = Tools::getValue('kb_delete_customer');
            }
            
            $id_shop = Context::getContext()->shop->id;
            $data = Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'kb_mp_seller_shop_close_request set id_seller='.(int)$id_seller.',account_delete="'.(int)$delete_customer.'",seller_email="'.pSQL($seller['email']).'", id_shop='.(int)$id_shop.',approved="0",date_add=now()');
            if ($data) {
                //send email to Admin
                $template_vars = array(
                    '{{shop_title}}' => $this->seller_info['title'],
                    '{{seller_name}}' => $this->seller_info['seller_name'],
                    '{{seller_email}}' => $this->seller_info['email'],
                    '{{shop_name}}' => Configuration::get('PS_SHOP_NAME'),

                );
                $email = new KbEmail(
                    KbEmail::getTemplateIdByName('mp_seller_shop_close'),
                    $this->seller_info['id_default_lang']
                );
                $email->send(
                    Configuration::get('PS_SHOP_EMAIL'),
                    Configuration::get('PS_SHOP_NAME'),
                    $email->subject,
                    $template_vars
                );
                
                

                $this->context->cookie->__set(
                    'redirect_success',
                    $this->module->l('The requested has been submitted.', 'gdpr')
                );
                Tools::redirect($redirect_link);
            }
        }
        if (Tools::isSubmit('download_gdpr')) {
            $data = array();
            $id_customer = Context::getContext()->customer->id;
            $customer = new Customer($id_customer);
            if (!empty($id_customer)) {
                $seller = $this->seller_info;
                $type = Tools::getValue('gdpr_type');
                if ($type == 'products') {
                    $data = $this->kbSellerProductsArray($customer);
                } elseif ($type == 'sellerinfo') {
                    $data = $this->kbSellerInfoArray($customer);
                } elseif ($type == 'personalinfo') {
                    $data = $this->kbPersonalInfoArray($customer);
                } elseif ($type == 'address') {
                    $data = $this->kbAddressArray($customer);
                } elseif ($type == 'orders') {
                    $data = $this->kbOrdersArray($customer);
                } elseif ($type == 'sellerorders') {
                    $data = $this->kbSellerOrdersArray($customer);
                }

                if (!empty($data) && (count($data) > 0)) {
                    $filename = time() . '-' . $type . '.csv';
                    $file = fopen('php://output', 'w');
                    header("Content-Transfer-Encoding: Binary");
                    header('Content-Type: application/excel');
                    header('Content-Disposition: attachment; filename=' . basename($filename));
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    ob_clean();
                    $this->kbCsvExport($data, $file);
                    $id_seller = KbSeller::getSellerByCustomerId($customer->id);
                    $is_seller = 0;
                    if (!empty($id_seller)) {
                        $is_seller = 1;
                    }
                    $user_data = KbConfiguration::kbUserInfo();
                    Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'kb_mp_gdpr_request set email="'.pSQL($customer->email).'",is_seller='.(int)$is_seller.',id_shop='.(int)Context::getContext()->shop->id.',type="'.pSQL($type).'",remote_address="' . pSQL($user_data['remote_address']) . '", user_agent="' . pSQL($user_data['user_agent']) . '",authenticate="'.pSQL(md5($customer->email)).'",approved="1",date_add=now()');
                    fclose($file);
                    die;
                }
            } else {
                $this->context->cookie->__set(
                    'redirect_error',
                    $this->module->l('Your request cannot be completed.', 'gdpr')
                );
                Tools::redirect($this->context->link->getModuleLink($this->module->name, 'gdpr'));
            }
        }
        parent::postProcess();
    }
    
    protected function kbSellerOrdersArray($customer)
    {
        $data = array();
        $id_lang = Context::getContext()->language->id;
        $currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
        $id_seller = KbSeller::getSellerByCustomerId($customer->id);
        $data['type'] = array($this->module->l('SELLER ORDERS', 'gdpr'));

        $data['label'] = array(
            $this->module->l('Reference', 'gdpr'),
            $this->module->l('Date', 'gdpr'),
            $this->module->l('Payment', 'gdpr'),
            $this->module->l('Order State', 'gdpr'),
            $this->module->l('Total Price', 'gdpr'),
        );
        if (!empty($id_seller)) {
            $seller_orders = KbSellerEarning::getOrdersBySellerId($id_seller);
            if (!empty($seller_orders)) {
                foreach ($seller_orders as $sell_order) {
                    $order = new Order($sell_order['id_order']);
                    $order_state = $order->getCurrentStateFull($id_lang);
                    $data['rec'][] = array(
                        $order->reference,
                        Tools::displayDate($order->date_add, $id_lang),
                        $order->payment,
                        $order_state['name'],
                        Tools::displayPrice($order->total_paid, $currency),
                    );
                }
            }
        }
        return $data;
    }


    protected function kbOrdersArray($customer)
    {
        $data = array();
        $id_lang = Context::getContext()->language->id;
        $currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
        $orders = Order::getCustomerOrders($customer->id);
        $data['type'] = array($this->module->l('ORDERS', 'gdpr'));
        
        $data['label'] = array(
            $this->module->l('Reference', 'gdpr'),
            $this->module->l('Date', 'gdpr'),
            $this->module->l('Payment', 'gdpr'),
            $this->module->l('Order State', 'gdpr'),
            $this->module->l('Total Price', 'gdpr'),
        );

        if (!empty($orders)) {
            foreach ($orders as $order) {
                $data['rec'][] = array(
                    $order['reference'],
                    Tools::displayDate($order['date_add'], $id_lang),
                    $order['payment'],
                    (isset($order['order_state'])) ? $order['order_state'] : '',
                    Tools::displayPrice($order['total_paid'], $currency),
                );
            }
        }
        return $data;
    }
    
    protected function kbAddressArray($customer)
    {
        $data = array();
        $id_lang = Context::getContext()->language->id;
        $lang = Language::getLanguage($id_lang);
        $addresses = $customer->getAddresses($id_lang);
        
        $data['type'] = array($this->module->l('ADDRESSES', 'gdpr'));
        
        $data['label'] = array(
            $this->module->l('Alias', 'gdpr'),
            $this->module->l('Company', 'gdpr'),
            $this->module->l('First Name', 'gdpr'),
            $this->module->l('Last Name', 'gdpr'),
            $this->module->l('Address Line 1', 'gdpr'),
            $this->module->l('Address Line 2', 'gdpr'),
            $this->module->l('Postcode', 'gdpr'),
            $this->module->l('City', 'gdpr'),
            $this->module->l('State', 'gdpr'),
            $this->module->l('Country', 'gdpr'),
            $this->module->l('Notes', 'gdpr'),
            $this->module->l('Phone', 'gdpr'),
            $this->module->l('Mobile Phone', 'gdpr'),
            $this->module->l('VAT number', 'gdpr'),
            $this->module->l('DNI', 'gdpr'),
            $this->module->l('Date', 'gdpr'),
            
        );
        
        if (!empty($addresses)) {
            foreach ($addresses as $address) {
                $data['rec'][] = array(
                    $address['alias'],
                    $address['company'],
                    $address['firstname'],
                    $address['lastname'],
                    $address['address1'],
                    $address['address2'],
                    $address['postcode'],
                    $address['city'],
                    $address['state'],
                    $address['country'],
                    $address['other'],
                    $address['phone'],
                    $address['phone_mobile'],
                    $address['vat_number'],
                    $address['dni'],
                    Tools::displayDate($address['date_add'], $id_lang),
                );
            }
        }
        
        return $data;
    }
    
    protected function kbPersonalInfoArray($customer)
    {
        $data = array();
        $id_lang = Context::getContext()->language->id;
        $lang = Language::getLanguage($id_lang);
        $gender = new Gender($customer->id_gender, $lang, Context::getContext()->shop->id);
        $data['type'] = array($this->module->l('PERSONAL INFO', 'gdpr'));
        
        $data['label'] = array(
            $this->module->l('First Name', 'gdpr'),
                $this->module->l('Last Name', 'gdpr'),
                $this->module->l('Language', 'gdpr'),
                $this->module->l('Note', 'gdpr'),
                $this->module->l('Gender', 'gdpr'),
                $this->module->l('Birthday', 'gdpr'),
                $this->module->l('Age', 'gdpr'),
                $this->module->l('Email', 'gdpr'),
                $this->module->l('Newsletter', 'gdpr'),
                $this->module->l('Website', 'gdpr'),
                $this->module->l('Company', 'gdpr'),
                $this->module->l('Last Passwd Generated', 'gdpr'),
                $this->module->l('Account Creation Date', 'gdpr'),
            
        );
       
      
        $data['rec'][] = array(
            $customer->firstname,
            $customer->lastname,
            $lang['name'],
            $customer->note,
            $gender->name,
            $customer->birthday,
            ($customer->birthday != '0000-00-00') ? date_diff(date_create($customer->birthday), date_create('now'))->y : $this->module->l('Unknown', 'gdpr'),
            $customer->email,
            ($customer->newsletter) ? $this->module->l('Yes', 'gdpr') : $this->module->l('No', 'gdpr'),
            $customer->website,
            $customer->company,
            $customer->last_passwd_gen,
            Tools::displayDate($customer->date_add, $id_lang),
        );
        return $data;
    }


    protected function kbSellerInfoArray($customer)
    {
        $data = array();
        $data['type'] = array($this->module->l('SELLER INFORMATION', 'gdpr'));
        
        $data['label'] = array(
            $this->module->l('Shop Title', 'gdpr'),
            $this->module->l('Phone Number', 'gdpr'),
            $this->module->l('Business Email', 'gdpr'),
            $this->module->l('Address', 'gdpr'),
            $this->module->l('Country', 'gdpr'),
            $this->module->l('State/City', 'gdpr'),
            $this->module->l('Description', 'gdpr'),
            $this->module->l('Facebook Link', 'gdpr'),
            $this->module->l('Google Plus Link', 'gdpr'),
            $this->module->l('Twitter Link', 'gdpr'),
            $this->module->l('Meta Keyword', 'gdpr'),
            $this->module->l('Meta Description', 'gdpr'),
            $this->module->l('Privacy Policy', 'gdpr'),
            $this->module->l('Return Policy', 'gdpr'),
            $this->module->l('Shipping Policy', 'gdpr'),
            $this->module->l('Payout', 'gdpr'),
            
        );
        $id_seller = KbSeller::getSellerByCustomerId($customer->id);
        if (!empty($id_seller)) {
            $seller = new KbSeller($id_seller);
            $seller_info = $seller->getSellerInfo(Context::getContext()->language->id);
            
            $payment_info = Tools::unSerialize($seller_info['payment_info']);
            if (isset($payment_info['name'])) {
                $payment_info['name'] = $this->getPaymentMethodname($payment_info['name']);
            } elseif (isset($payment_info['paypal_id'])) {
                $payment_info['name'] = $this->module->l('Paypal', 'gdpr');
                $payment_info['data'] = array(
                    'paypal_id' => array(
                        'label' => $this->module->l('Paypal Id', 'gdpr'),
                        'value' => $payment_info['paypal_id']
                    )
                );
            }
            $payment_rec = '';
            if (!empty($payment_info) && count($payment_info) > 0) {
                $payment_rec  .= $this->module->l('Payment Method: ', 'gdpr'). $payment_info['name'];
                foreach ($payment_info['data'] as $payment_data) {
                    $payment_rec .= PHP_EOL;
                    $payment_rec .= sprintf($this->module->l('%s', 'gdpr'), $payment_data['label']).': '.$payment_data['value'];
                }
            }
            if (!empty($seller_info)) {
                $data['rec'][] = array(
                    $seller_info['title'],
                    $seller_info['phone_number'],
                    $seller_info['business_email'],
                    $seller_info['address'],
                    Country::getNameById(Context::getContext()->language->id, $seller_info['id_country']),
                    $seller_info['state'],
                    $seller_info['description'],
                    $seller_info['fb_link'],
                    $seller_info['gplus_link'],
                    $seller_info['twit_link'],
                    $seller_info['meta_keyword'],
                    $seller_info['meta_description'],
                    strip_tags($seller_info['privacy_policy']),
                    strip_tags($seller_info['return_policy']),
                    strip_tags($seller_info['shipping_policy']),
                    $payment_rec,
                );
            }
        }
        return $data;
    }
    
    protected function kbSellerProductsArray($customer)
    {
        $data = array();
        $data['type'] = array($this->module->l('Seller Products', 'gdpr'));
        $currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
        $id_lang = Context::getContext()->language->id;
        $data['label'] = array(
            $this->module->l('Name', 'gdpr'),
            $this->module->l('Default Category', 'gdpr'),
            $this->module->l('Price tax excluded or Price tax included', 'gdpr'),
            $this->module->l('Wholesale Price', 'gdpr'),
            $this->module->l('Discount amount', 'gdpr'),
            $this->module->l('Discount From', 'gdpr'),
            $this->module->l('Discount To', 'gdpr'),
            $this->module->l('Reference', 'gdpr'),
            $this->module->l('Supplier Reference', 'gdpr'),
            $this->module->l('Supplier', 'gdpr'),
            $this->module->l('Manufacture', 'gdpr'),
            $this->module->l('UPC', 'gdpr'),
            $this->module->l('EAN-13', 'gdpr'),
            $this->module->l('Condition', 'gdpr'),
            $this->module->l('Short Description', 'gdpr'),
            $this->module->l('Description', 'gdpr'),
            $this->module->l('Meta Title', 'gdpr'),
            $this->module->l('Meta Description', 'gdpr'),
            $this->module->l('Friendly URL', 'gdpr'),
            $this->module->l('Package width', 'gdpr'),
            $this->module->l('Package height', 'gdpr'),
            $this->module->l('Package depth', 'gdpr'),
            $this->module->l('Package weight', 'gdpr'),
            $this->module->l('Quantity', 'gdpr'),
            $this->module->l('Additional Shipping Fee', 'gdpr'),
            $this->module->l('Tags', 'gdpr'),
            $this->module->l('Active', 'gdpr'),
            $this->module->l('Date Updated', 'gdpr'),
        );
        $id_seller = KbSeller::getSellerByCustomerId($customer->id);
        if (!empty($id_seller)) {
            $seller_products = KbSellerProduct::getSellerProducts($id_seller);
            if (!empty($seller_products)) {
                foreach ($seller_products as $sell_product) {
                    $product = new Product($sell_product['id_product'], false, $id_lang);
                    $category = new Category($product->id_category_default, $id_lang);
                    $quantity = Db::getInstance()->getRow(
                        'SELECT quantity FROM ' . _DB_PREFIX_ . 'stock_available'
                        . ' WHERE id_product=' . (int) $product->id . ' '
                        . 'AND id_product_attribute=0 '
                        . 'AND id_shop=' . (int) Context::getContext()->shop->id
                    );
                    $specific_price = SpecificPrice::getSpecificPrice(
                        (int) $product->id,
                        $this->context->shop->id,
                        $currency->id,
                        Context::getContext()->country->id,
                        0,
                        1,
                        0,
                        0,
                        0,
                        $quantity['quantity']
                    );
//                    d($product);
                    $data['rec'][] = array(
                        $product->name,
                        $category->name,
                        Tools::displayPrice($product->price, $currency),
                        Tools::displayPrice($product->wholesale_price, $currency),
                        (!empty($specific_price))? Tools::displayPrice($specific_price['reduction'], $currency):'',
                        (!empty($specific_price))? $specific_price['from']:'',
                        (!empty($specific_price))? $specific_price['to']:'',
                        $product->reference,
                        $product->supplier_reference,
                        $product->supplier_name,
                        $product->manufacturer_name,
                        $product->upc,
                        $product->ean13,
                        $product->condition,
                        $product->description_short,
                        $product->description,
                        $product->meta_title,
                        $product->meta_description,
                        $product->link_rewrite,
                        $product->width,
                        $product->height,
                        $product->depth,
                        $product->weight,
                        $product->quantity,
                        Tools::displayPrice($product->additional_shipping_cost, $currency),
                        $product->tags,
                        ($product->active)?$this->module->l('Yes', 'gdpr'): $this->module->l('No', 'gdpr'),
                        Tools::displayDate($product->date_upd, $id_lang),
                    );
                }
            }
        }
        return $data;
    }
    
    protected function kbCsvExport($fields, $file)
    {
        $data = array();
        if (!empty($fields)) {
            if (isset($fields['type'])) {
                fputcsv($file, $fields['type']);
            }
            foreach ($fields['label'] as $field) {
                $data[] = $field;
            }
            if (!empty($data)) {
                fputcsv($file, $data, ',');
            }
            if (!empty($fields['rec']) && isset($fields['rec'])) {
                foreach ($fields['rec'] as $field) {
                    fputcsv($file, $field, ',');
                }
            }
        }
        $line = array();
        fputcsv($file, $line);
        return $data;
    }
    
    public function getPaymentMethodname($name)
    {
        $payment_methods = array(
            'bankwire' => $this->module->l('Bank Wire', 'gdpr'),
            'check' => $this->module->l('Payment by Cheque', 'gdpr'),
            'kbpaypal' => $this->module->l('Paypal', 'gdpr'),
            'creditcard' => $this->module->l('Credit Card', 'gdpr')
        );
        return $payment_methods[$name];
    }
}
