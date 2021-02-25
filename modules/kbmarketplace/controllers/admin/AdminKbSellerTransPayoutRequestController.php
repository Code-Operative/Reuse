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

require_once dirname(__FILE__).'/AdminKbMarketplaceCoreController.php';
require_once(_PS_MODULE_DIR_.'kbmarketplace/libraries/payout/vendor/autoload.php');

class AdminKbSellerTransPayoutRequestController extends AdminKbMarketplaceCoreController
{
    protected $seller_info = array();

    public function __construct()
    {
        $this->bootstrap     = true;
        $this->table         = 'kb_mp_seller_transaction_request';
        $this->className     = 'KbSellerTransactionRequest';
        $this->identifier    = 'id_seller_transaction';
        $this->lang          = false;
        $this->display       = 'list';
        parent::__construct();
        $this->toolbar_title = $this->module->l('Transaction Payout Request', 'AdminKbSellerTransPayoutRequestController');
        $this->fields_list   = array(
            'id_seller_transaction' => array(
                'title' => $this->module->l('ID', 'AdminKbSellerTransPayoutRequestController'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'seller_name' => array(
                'title' => $this->module->l('Seller', 'AdminKbSellerTransPayoutRequestController'),
                'havingFilter' => true,
                'filter_key' => 'seller_name',
                'order_key' => 'seller_name',
            ),
            'email' => array(
                'title' => $this->module->l('Seller Email', 'AdminKbSellerTransPayoutRequestController'),
                'havingFilter' => true,
                'filter_key' => 'c!email',
                'search' => true
            ),
            'amount' => array(
                    'title' => $this->module->l('Amount', 'AdminKbSellerTransPayoutRequestController'),
                    'align' => 'text-right',
                    'type' => 'price',
                    'currency' => true,
                    'callback' => 'setCurrency'
                ),
                
            'comment' => array(
                'title' => $this->module->l('Comment', 'AdminKbSellerTransPayoutRequestController'),
                'havingFilter' => false,
                'class' => 'comment_col_w',
                'maxlength' => 200
            ),
            'approved' => array(
                'title' => $this->module->l('Status', 'AdminKbSellerTransPayoutRequestController'),
                'type' => 'select',
                'list' => $this->approval_statuses,
                'callback' => 'showApprovedStatus',
                'filter_key' => 'a!approved',
            ),
            'date_add' => array(
                    'title' => $this->module->l('Transaction Date', 'AdminKbSellerTransPayoutRequestController'),
                    'align' => 'text-right',
                    'type' => 'date',
                    'filter_key' => 'a!date_add'
                ),
            
        );

        $this->_select = 'c.`email`, CONCAT(LEFT(c.`firstname`, 1), \'. \', c.`lastname`) AS `seller_name`';

        $this->_join = 'INNER JOIN `'._DB_PREFIX_.'kb_mp_seller` s ON (a.`id_seller` = s.`id_seller`)
			LEFT JOIN `'._DB_PREFIX_.'customer` c ON (s.`id_customer` = c.`id_customer`)';
        
        $this->_where .= ' AND a.approved IN ( "'. (int) KbGlobal::APPROVAL_WAITING
                .'","'. (int) KbGlobal::DISSAPPROVED.'")';

        $this->_orderWay = 'DESC';

        $this->addRowAction('approvetransaction');
        $this->addRowAction('disapprovetransaction');
        $this->addRowAction('updatePayouttransaction');
    }
    
    protected function processPayout($paypal_setting, $paypal_subject, $paypal_id, $rand, $iso_code, $amount, $comment = null)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $paypal_setting['client_id'],
                $paypal_setting['client_secret']
            )
        );
        
        $mode = 'sandbox';
        if ($paypal_setting['mode']) {
            $mode = 'live';
        }
        $apiContext->setConfig(
            array(
                'mode' => $mode,
                'log.LogEnabled' => false,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => false,
            )
        );


        $payouts = new \PayPal\Api\Payout();
        $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())->setEmailSubject($paypal_subject); //add field in paypal setting
        $senderItem = new \PayPal\Api\PayoutItem();
        $senderItem->setRecipientType('Email')
            ->setReceiver($paypal_id)  //paypal id
            ->setSenderItemId($rand) //rendom no.
            ->setAmount(new \PayPal\Api\Currency('{
                    "value":"'.$amount.'",
                    "currency":"'.$iso_code.'"
                }'));
        if (!empty($comment)) {
            $senderItem->setNote($comment); //comment
        }
        $payouts->setSenderBatchHeader($senderBatchHeader)
                ->addItem($senderItem);
        
        $request = clone $payouts;
        try {
            /*Start -MK made changes on 27-08-18 to return the object of the payout item id*/
            $batch_data = $payouts->createSynchronous($apiContext);
            $payoutBatchId = $batch_data->getBatchHeader()->getPayoutBatchId();
            $payoutBatch = \PayPal\Api\Payout::get($payoutBatchId, $apiContext);
            $payoutItems = $payoutBatch->getItems();
            $payoutItem = $payoutItems[0];
            $payoutItemId = $payoutItem->getPayoutItemId();
            return $output = \PayPal\Api\PayoutItem::get($payoutItemId, $apiContext);
            /*End -MK made changes on 27-08-18 to return the object of the payout item id*/
        } catch (Exception $ex) {
            $this->context->cookie->kb_redirect_error = $ex->getMessage();
            Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
        }
    }
    
    public function postProcess()
    {
        if (Tools::isSubmit('submitPayoutTrans')) {
            $id_seller_transaction = Tools::getValue('id_seller_transaction');
            $transaction_id = trim(Tools::getValue('kb_payout_transaction_id'));
            $trans_comment = trim(Tools::getValue('kb_payout_transaction_comment'));
            
            $kbPayoutRequest = new KbSellerTransactionRequest($id_seller_transaction);
            if (Tools::getIsset('kb_paypal_trans')) {
                $query = 'Select pc.payment_info, CONCAT(c.`firstname`, \' \',  c.`lastname`) as customer_name, c.email
                            from ' . _DB_PREFIX_ . 'kb_mp_seller  pc
                            LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = pc.`id_customer`)
                            WHERE pc.id_seller = ' . (int) $kbPayoutRequest->id_seller;
                $seller_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($query, true);
                $seller_email = $seller_data['email'];
                $seller_name = $seller_data['customer_name'];
                $payment_info = unserialize($seller_data['payment_info']);
                $paypal_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
                if (empty($paypal_setting)) {
                    $this->context->cookie->kb_redirect_error = $this->module->l('Paypal Configuration is empty.', 'AdminKbSellerTransPayoutRequestController');
                    Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
                } elseif (!$paypal_setting['enable']) {
                    $this->context->cookie->kb_redirect_success = $this->module->l('Paypal Configuration is disabled.', 'AdminKbSellerTransPayoutRequestController');
                    Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
                }

                if (!empty($payment_info)) {
                    if ($payment_info['name'] == 'kbpaypal') {
                        $paypal_id = $payment_info['data']['paypal_id']['value'];
                        $random_number = uniqid(rand(0, 9999));
                        $paypal_subject = $paypal_setting['paypal_email_subject'];
                        $currency_iso = $paypal_setting['paypal_currency'];
                        $amount = $kbPayoutRequest->amount;
                        $seller_currency = Currency::getCurrency($kbPayoutRequest->id_currency);
                        $seller_currency_iso = $seller_currency['iso_code'];
                        if ($seller_currency_iso != $currency_iso) {
                            $amount = Tools::convertPriceFull(
                                $amount,
                                new Currency((int) $kbPayoutRequest->id_currency),
                                new Currency((int) Currency::getIdByIsoCode($currency_iso))
                            );
                        }
                        $request = $this->processPayout($paypal_setting, $paypal_subject, $paypal_id, $random_number, $currency_iso, $amount, $trans_comment);
                        /*Start-MK made changes on 27-08-18 to update the process of payout transaction*/
                        if (isset($request->_propMap)) {
                            $is_approved = 0;
                            $transaction_id = '';
                            if (isset($request->_propMap['transaction_id'])) {
                                $transaction_id = $request->_propMap['transaction_id'];
                                $is_approved = 1;
                            }
                            if (isset($request->_propMap['payout_item_id'])) {
                                $kbPayoutRequest = new KbSellerTransactionRequest($kbPayoutRequest->id_seller_transaction);
                                $kbPayoutRequest->approved = $is_approved;
                                $kbPayoutRequest->payout_status = $request->_propMap['transaction_status'];
                                $kbPayoutRequest->payout_item_id = $request->_propMap['payout_item_id'];
                                $kbPayoutRequest->id_employee = $this->context->employee->id;
                                $kbPayoutRequest->admin_comment = $trans_comment;
                                $kbPayoutRequest->update();
                                if (!empty($transaction_id)) {
                                    $kbTransaction = new KbSellerTransaction();
                                    $kbTransaction->id_seller = $kbPayoutRequest->id_seller;
                                    $kbTransaction->id_shop = $kbPayoutRequest->id_shop;
                                    $kbTransaction->id_employee = $this->context->employee->id;
                                    $kbTransaction->transaction_number = $transaction_id;
                                    $kbTransaction->amount = $kbPayoutRequest->amount;
                                    $kbTransaction->transaction_type = '0';
                                    $kbTransaction->comment = $trans_comment;
                                    if ($kbTransaction->add()) {
                                        $this->sendApproveTransactionMail($kbPayoutRequest, $transaction_id, $trans_comment);
                                        $this->context->cookie->kb_redirect_success = $this->module->l('Transaction successfully approved.', 'AdminKbSellerTransPayoutRequestController');
                                        Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
                                    }
                                } else {
                                    if ($request->_propMap['transaction_status'] == 'PENDING') {
                                        $this->context->cookie->kb_redirect_success = $this->module->l('Transaction is pending.', 'AdminKbSellerTransPayoutRequestController');
                                    } elseif ($request->_propMap['transaction_status'] == 'SUCCESS') {
                                        $kbPayoutRequest->approved = '1';
                                        $kbPayoutRequest->update();
                                        $this->context->cookie->kb_redirect_success = $this->module->l('Transaction is completed.', 'AdminKbSellerTransPayoutRequestController');
                                    } elseif ($request->_propMap['transaction_status'] == 'DENIED') {
                                        $kbPayoutRequest->approved = '2';
                                        $kbPayoutRequest->update();
                                        $this->context->cookie->kb_redirect_error = $this->module->l('Transaction is denied.', 'AdminKbSellerTransPayoutRequestController');
                                    }
                                    Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
                                }
                            } else {
                                $this->context->cookie->kb_redirect_error = $this->module->l('Transaction failed.', 'AdminKbSellerTransPayoutRequestController');
                                Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
                            }
                        } else {
                            $this->context->cookie->kb_redirect_error = $this->module->l('Transaction failed.', 'AdminKbSellerTransPayoutRequestController');
                            Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
                        }
                        /*End-MK made changes on 27-08-18 to update the process of payout transaction*/
                    } else {
                        $this->context->cookie->kb_redirect_error = $this->module->l('Transaction cannot be proceed', 'AdminKbSellerTransPayoutRequestController');
                        Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
                    }
                } else {
                    $this->context->cookie->kb_redirect_error = $this->module->l('No Payout Information found for the Seller.', 'AdminKbSellerTransPayoutRequestController');
                    Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
                }
            } else {
                $kbTransaction = new KbSellerTransaction();
                $kbTransaction->id_seller = $kbPayoutRequest->id_seller;
                $kbTransaction->id_shop = $kbPayoutRequest->id_shop;
                $kbTransaction->id_employee = $this->context->employee->id;
                $kbTransaction->transaction_number = $transaction_id;
                $kbTransaction->amount = $kbPayoutRequest->amount;
                $kbTransaction->transaction_type = '0';
                $kbTransaction->comment = $trans_comment;
                if ($kbTransaction->add()) {
                    $kbPayoutRequest->approved = '1';
                    $kbPayoutRequest->update();
                    $this->sendApproveTransactionMail($kbPayoutRequest, $transaction_id, $trans_comment);
                    $this->context->cookie->kb_redirect_success = $this->module->l('Transaction successfully approved.', 'AdminKbSellerTransPayoutRequestController');
                    Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
                }
            }
        }
        
        if (Tools::isSubmit('submitkbPayoutSetting')) {
            $kb_mp_payout_setting = Tools::getValue('kb_mp_payout_setting');
            $kb_mp_payout_setting['client_id'] = trim($kb_mp_payout_setting['client_id']);
            $kb_mp_payout_setting['client_secret'] = trim($kb_mp_payout_setting['client_secret']);
            $kb_mp_payout_setting['paypal_email_subject'] = trim($kb_mp_payout_setting['paypal_email_subject']);
            $kb_mp_payout_setting['paypal_currency'] = trim($kb_mp_payout_setting['paypal_currency']);
            Configuration::updateValue('KB_MP_PAYOUT_SETTING', Tools::jsonEncode($kb_mp_payout_setting));
            $this->context->cookie->kb_redirect_success = $this->module->l('Payout Settings successfully updated.', 'AdminKbSellerTransPayoutRequestController');
            Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
        }
        
        if (Tools::isSubmit('dissapprove'.$this->table)) {
            $id_seller_transaction = Tools::getValue('id_seller_transaction');
            $marketplace_reason_comment = trim(Tools::getValue('marketplace_reason_comment'));
            $sellerTransaction = new KbSellerTransactionRequest($id_seller_transaction);
            $sellerTransaction->admin_comment = $marketplace_reason_comment;
            $sellerTransaction->approved = '2';
            $sellerTransaction->update();
            $seller_obj = new KbSeller($sellerTransaction->id_seller);
            $this->seller_info = $seller_obj->getSellerInfo();
            //send email to Admin
            $template_vars = array(
                '{{shop_title}}' => $this->seller_info['title'],
                '{{seller_name}}' => $this->seller_info['seller_name'],
                '{{seller_email}}' => $this->seller_info['email'],
                '{{amount}}' => Tools::displayPrice($sellerTransaction->amount, new Currency($sellerTransaction->id_currency)),
                '{{requested_on}}' => $sellerTransaction->date_add,
                '{{reason}}' => $marketplace_reason_comment,
                '{{seller_contact}}' => $this->seller_info['phone_number']
            );
            $email = new KbEmail(
                KbEmail::getTemplateIdByName('mp_seller_payout_transaction_decline_admin'),
                $seller_obj->id_default_lang
            );
            /*Start - MK made change on 30-05-18 to send notification based on the type*/
            $notification_emails = $seller_obj->getEmailIdForNotification();
            foreach ($notification_emails as $em) {
                $email->send(
                    $em['email'],
                    $em['title'],
                    null,
                    $template_vars
                );
            }
             /*End - MK made change on 30-05-18 to send notification based on the type*/
            $this->context->cookie->kb_redirect_success = $this->module->l('Transaction Payout successfully updated.', 'AdminKbSellerTransPayoutRequestController');
            Tools::redirectAdmin($this->context->link->getAdminlink('AdminKbSellerTransPayoutRequest'));
        }
        
        parent::postProcess();
    }
    
    public function sendApproveTransactionMail($sellerTransaction, $transaction_id, $comment = null)
    {
        $seller_obj = new KbSeller($sellerTransaction->id_seller);
        $this->seller_info = $seller_obj->getSellerInfo();
        //send email to Admin
        $template_vars = array(
            '{{shop_title}}' => $this->seller_info['title'],
            '{{seller_name}}' => $this->seller_info['seller_name'],
            '{{amount}}' => Tools::displayPrice($sellerTransaction->amount, new Currency($sellerTransaction->id_currency)),
            '{{comment}}' => $comment,
            '{{transaction_id}}' => $transaction_id,
        );
        $email = new KbEmail(
            KbEmail::getTemplateIdByName('mp_seller_payout_transaction_approve_admin'),
            $seller_obj->id_default_lang
        );
        /*Start - MK made change on 30-05-18 to send notification based on the type*/
        $notification_emails = $seller_obj->getEmailIdForNotification();
        foreach ($notification_emails as $em) {
            $email->send(
                $em['email'],
                $em['title'],
                null,
                $template_vars
            );
        }
        /*End - MK made change on 30-05-18 to send notification based on the type*/
        return true;
    }
    
    private function unusefullFunction()
    {
        $this->module->l('Owner name', 'AdminKbSellerTransPayoutRequestController');
        $this->module->l('Details', 'AdminKbSellerTransPayoutRequestController');
        $this->module->l('Bank Address', 'AdminKbSellerTransPayoutRequestController');
        $this->module->l('Additional Information', 'AdminKbSellerTransPayoutRequestController');
        $this->module->l('Address', 'AdminKbSellerTransPayoutRequestController');
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->context->controller->addJS(_MODULE_DIR_.'kbmarketplace/views/js/admin/fixes.js');
    }
    
    public static function setCurrency($echo, $tr)
    {
        unset($tr);
        return Tools::displayPrice($echo);
    }
    
    public function initContent()
    {
        $tpl = $this->custom_smarty->createTemplate('ajax_view_popup.tpl');

        $this->content .= $tpl->fetch();
        $this->content .= $this->getReasonPopUpHtml();
        $tpl = $this->custom_smarty->createTemplate('kb_transaction_payout_setting.tpl');
        $helper                        = new HelperForm();
        $helper->show_toolbar          = false;
        $helper->default_form_language = $this->context->language->id;
        
        $default_currency = Configuration::get('PS_CURRENCY_DEFAULT');
        $currency_obj = new Currency($default_currency);
        $currencies = Currency::getCurrenciesByIdShop($this->context->shop->id);
        $fields_options = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->module->l('Paypal Payout Settings', 'AdminKbSellerTransPayoutRequestController'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Active', 'AdminKbSellerTransPayoutRequestController'),
                        'name' => 'kb_mp_payout_setting[enable]',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Enabled', 'AdminKbSellerTransPayoutRequestController')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('Disabled', 'AdminKbSellerTransPayoutRequestController')
                            )
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'required' => true,
                        'name' => 'kb_mp_payout_setting[client_id]',
                        'label' => $this->module->l('Client ID', 'AdminKbSellerTransPayoutRequestController'),
                    ),
                    array(
                        'type' => 'text',
                        'required' => true,
                        'name' => 'kb_mp_payout_setting[client_secret]',
                        'label' => $this->module->l('Client Secret', 'AdminKbSellerTransPayoutRequestController'),
                    ),
                    array(
                        'type' =>'select',
                        'required' => true,
                        'name' => 'kb_mp_payout_setting[mode]',
                        'label' => $this->module->l('Paypal Mode'),
                        'options' => array(
                            'query' => array(
                                array(
                                    'id' => 0,
                                    'name' => 'Sandbox'
                                ),
                                array(
                                    'id' => 1,
                                    'name' => 'Live',
                                ),
                            ),
                            'id' => 'id',
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'required' => true,
                        'name' => 'kb_mp_payout_setting[paypal_email_subject]',
                        'label' => $this->module->l('Paypal Email Subject', 'AdminKbSellerTransPayoutRequestController'),
                    ),
                    array(
                        'type' => 'select',
                        'required' => true,
                        'name' => 'kb_mp_payout_setting[paypal_currency]',
                        'label' => $this->module->l('Paypal Currency', 'AdminKbSellerTransPayoutRequestController'),
                        'desc' => $this->module->l('Select the default currency set in Paypal Account.', 'AdminKbSellerTransPayoutRequestController'),
                        'options' => array(
                            'query' => $currencies,
                            'id' => 'iso_code',
                            'name' => 'name'
                        )
                    ),
                    /*
                     * @author - Rishabh Jain
                     * DOC - 2nd June 2020
                     * Added option to set the amount to be hold and enable automatic payment
                     */
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Enable Automatic Seller Payout', 'AdminKbSellerTransPayoutRequestController'),
                        'name' => 'kb_mp_payout_setting[enable_automatic_payout]',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Enabled', 'AdminKbSellerTransPayoutRequestController')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('Disabled', 'AdminKbSellerTransPayoutRequestController')
                            )
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'suffix' => $currency_obj->iso_code,
                        'label' => $this->module->l('Amount to keep on hold', 'AdminKbOrderRangeCommissionController'),
                        'name' => 'kb_mp_payout_setting[amount_hold]',
                        'required' => true,
                        'validation' => 'isFloat',
                        'class' => 'fixed-width-xl',
                        'hint' => $this->module->l('Only numerical or decimal values are allowed', 'AdminKbOrderRangeCommissionController'),
                        'desc' => $this->module->l('Enter the amount which will always be kept on hold.', 'AdminKbSellerTransPayoutRequestController'),
                    ),
                    /*
                     * changes over
                     */
                ),
                'buttons' => array(
                    array(
                        'id' => 'kb-mp-payout-setting-submit',
                        'title' => $this->module->l('Save', 'AdminKbSellerTransPayoutRequestController'),
                        'class' => 'btn btn-default pull-right',
                        'icon' => 'process-icon-save',
                    )
                )
            )
        );
        
        $kbpayout_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
        
        $field_value = array(
            'kb_mp_payout_setting[enable]' => (!empty($kbpayout_setting) && isset($kbpayout_setting['enable'])) ? $kbpayout_setting['enable'] : 0,
            'kb_mp_payout_setting[client_id]' => (!empty($kbpayout_setting) && isset($kbpayout_setting['client_id'])) ? $kbpayout_setting['client_id'] : '',
            'kb_mp_payout_setting[client_secret]' => (!empty($kbpayout_setting) && isset($kbpayout_setting['client_secret'])) ? $kbpayout_setting['client_secret'] : '',
            'kb_mp_payout_setting[paypal_email_subject]' => (!empty($kbpayout_setting) && isset($kbpayout_setting['paypal_email_subject'])) ? $kbpayout_setting['paypal_email_subject'] : '',
            'kb_mp_payout_setting[paypal_currency]' => (!empty($kbpayout_setting) && isset($kbpayout_setting['paypal_currency'])) ? $kbpayout_setting['paypal_currency'] : '',
            'kb_mp_payout_setting[mode]' => (!empty($kbpayout_setting) && isset($kbpayout_setting['mode'])) ? $kbpayout_setting['mode'] : '',
            'kb_mp_payout_setting[enable_automatic_payout]' => (!empty($kbpayout_setting) && isset($kbpayout_setting['enable_automatic_payout'])) ? $kbpayout_setting['enable_automatic_payout'] : 0,
            'kb_mp_payout_setting[amount_hold]' => (!empty($kbpayout_setting) && isset($kbpayout_setting['enable_automatic_payout'])) ? $kbpayout_setting['amount_hold'] : 0,
        );

        $helper->tpl_vars = array('fields_value' => $field_value);
        $helper->currentIndex  = $this->context->link->getAdminLink('AdminKbSellerTransPayoutRequest');
        $helper->submit_action = 'submitkbPayoutSetting';
        $tpl->assign('kb_payout_setting_form', $helper->generateForm(array($fields_options)));
        $tpl->assign('kb_form_heading', $this->module->l('Configuration', 'AdminKbSellerTransPayoutRequestController'));
        $tpl->assign('kb_admin_trans_close_txt', $this->module->l('Close Payout Setting Form', 'AdminKbSellerTransPayoutRequestController'));
        $tpl->assign('kb_cron_url', $this->context->link->getModuleLink($this->module->name, 'cron', array('action' => 'processPayoutState', 'secure_key' => Configuration::get('KB_MP_CRON'))));
        $tpl->assign('kb_auto_cron_paypal_url', $this->context->link->getModuleLink($this->module->name, 'cron', array('action' => 'sendautopaypalrequest', 'secure_key' => Configuration::get('KB_MP_AUTO_PAYPAL_CRON'))));
        $this->content .= $tpl->fetch();
        parent::initContent();
    }
    
    public function processKbAjaxView()
    {
        $this->render_ajax_html = true;

        $id_trans_request = (int) Tools::getValue($this->identifier);

        $trans_request = new $this->className($id_trans_request);
        $sql = 'Select pc.payment_info, CONCAT(c.`firstname`, \' \',  c.`lastname`) as customer_name, c.email
                from '._DB_PREFIX_.'kb_mp_seller  pc
                LEFT JOIN `'._DB_PREFIX_.'customer` c ON (c.`id_customer` = pc.`id_customer`)
                WHERE pc.id_seller = '.(int)$trans_request->id_seller;
        $data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql, true);
        
        if ($data && is_array($data)) {
            $data['payment_info'] = unserialize($data['payment_info']);
            $data['seller']['id_seller'] = $trans_request->id_seller;
            $data['seller']['email'] = $data['email'];
            $data['transaction'] = $trans_request;
            $data['transaction']->amount = Tools::displayPrice($data['transaction']->amount, new Currency($trans_request->id_currency));
            $data['transaction_seller_url'] = $this->context->link->getAdminLink('AdminKbSellerTransPayoutRequest', true);
//            d($data);
            $tpl = $this->custom_smarty->createTemplate('view_payment_request.tpl');
            $tpl->assign(array(
                'data' => $data,
            ));
            return $tpl->fetch();
        }

        return Tools::displayError('Data Not Found');
    }

    public function initToolbar()
    {
        parent::initToolbar();
        unset($this->toolbar_btn['new']);
    }

    public function initPageHeaderToolbar()
    {
        /*Start-MK made changes on 27-08-18 to display the link of process payout transaction*/
        $this->page_header_toolbar_btn['cron_payout_url'] = array(
            'href' => $this->context->link->getModuleLink($this->module->name, 'cron', array('action' => 'processPayoutState', 'secure_key' => Configuration::get('KB_MP_CRON'))),
            'desc' => $this->module->l('Process Paypal Payout Status', 'AdminKbSellerTransPayoutRequest'),
            'target' => '_blank',
            'icon' => 'process-icon-update'
        );
        /*End-MK made changes on 27-08-18 to display the link of process payout transaction*/
        parent::initPageHeaderToolbar();
    }
    /*
     * Display free status without clickable
     */

    public function showNonClickableFreeStatus($id_row, $tr)
    {
        unset($id_row);
        if ($tr['is_free'] == 1) {
            return '<a class="list-action-enable action-enabled" href="javascript:void(0)"
				title="'.$this->module->l('Yes', 'AdminKbSellerTransPayoutRequestController').'"><i class="icon-check"></i></a>';
        } else {
            return '<a class="list-action-enable action-disabled" href="javascript:void(0)"
				title="'.$this->module->l('No', 'AdminKbSellerTransPayoutRequestController').'"><i class="icon-remove"></i></a>';
        }
    }

    public function getPaymentMethodname($name)
    {
        $payment_methods = array(
            'bankwire' => $this->module->l('Bank Wire', 'AdminKbSellerTransPayoutRequestController'),
            'check' => $this->module->l('Payment by Cheque', 'AdminKbSellerTransPayoutRequestController'),
            'kbpaypal' => $this->module->l('Paypal', 'AdminKbSellerTransPayoutRequestController'),
        );
        return $payment_methods[$name];
    }
}
