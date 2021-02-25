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
 * @copyright 2017 Knowband
 * @license   see file: LICENSE.txt
 * @category  PrestaShop Module
 */

require_once(_PS_ROOT_DIR_ . '/init.php');
require_once(_PS_MODULE_DIR_.'kbmarketplace/libraries/payout/vendor/autoload.php');

class KbmarketplaceCronModuleFrontController extends ModuleFrontController
{
    public $php_self = 'cron';
    
    //function defination to execute first
    public function init()
    {
        parent::init();
        if (!Tools::isEmpty(trim(Tools::getValue('action')))) {
            $action = Tools::getValue('action');
            switch ($action) {
                case 'processPayoutState':
                    $this->processPayoutState();
                    break;
                case 'sendautopaypalrequest':
                    $this->sendautopaypalrequest();
                    break;
                case 'activateDeactivateMembershipPlans':
                    $this->activateDeactivateMembershipPlans();
                    break;
                case 'sendMembeshipReminders':
                    $this->sendMembeshipReminders();
                    break;
            }
        }
        die;
    }
    
    /*
     * function to execute the process of payout item
     */
    public function processPayoutState()
    {
        if (Tools::getValue('secure_key') == Configuration::get('KB_MP_CRON')) {
            if ($this->processPaypalPayoutState()) {
                echo $this->module->l('Success', 'cron');
            }
        } else {
            echo $this->module->l('Security Token is invalid or expired', 'cron');
        }
    }
    
    /*
     * function to update the payout status
     */
    public function processPaypalPayoutState()
    {
        $str = '';
        if (Tools::getValue('id_seller_transaction')) {
            $str .= ' AND id_seller_transaction='.(int)Tools::getValue('id_seller_transaction');
        }
        $payout_data = Db::getInstance()->executeS('SELECT * FROM '._DB_PREFIX_.'kb_mp_seller_transaction_request WHERE payout_item_id!="" AND (payout_status="PENDING" OR payout_status="PROCESSING" OR payout_status="ACKNOWLEDGED") '.$str);
        if (!empty($payout_data)) {
            foreach ($payout_data as $pay_data) {
                $paypal_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
                if (empty($paypal_setting)) {
                    echo $this->module->l('Paypal Configuration is empty.', 'cron');
                } elseif (!$paypal_setting['enable']) {
                    echo $this->module->l('Paypal Configuration is disabled.', 'cron');
                } else {
                    require_once(_PS_MODULE_DIR_ . 'kbmarketplace/libraries/payout/vendor/autoload.php');
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
                            'log.LogEnabled' => true,
                            'log.FileName' => '../PayPal.log',
                            'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                            'cache.enabled' => false,
                        )
                    );
                    try {
                        $output = \PayPal\Api\PayoutItem::get($pay_data['payout_item_id'], $apiContext);
                        if ($output->_propMap) {
                            $is_approved = 0;
                            $transaction_id = '';
                            if (isset($output->_propMap['transaction_id'])) {
                                $transaction_id = $output->_propMap['transaction_id'];
                                $is_approved = 1;
                                $kbPayoutRequest = new KbSellerTransactionRequest($pay_data['id_seller_transaction']);
                                if ($output->_propMap['transaction_status'] == 'SUCCESS') {
                                    $kbPayoutRequest->approved = '1';
                                } elseif ($output->_propMap['transaction_status'] == 'DENIED') {
                                    $kbPayoutRequest->approved = '2';
                                }
                                $kbPayoutRequest->payout_status = $output->_propMap['transaction_status'];
                                if ($kbPayoutRequest->update()) {
                                    $kbTransaction = new KbSellerTransaction();
                                    $kbTransaction->id_seller = $kbPayoutRequest->id_seller;
                                    $kbTransaction->id_shop = $kbPayoutRequest->id_shop;
                                    $kbTransaction->id_employee = $kbPayoutRequest->id_employee;
                                    $kbTransaction->transaction_number = $transaction_id;
                                    $kbTransaction->amount = $kbPayoutRequest->amount;
                                    $kbTransaction->transaction_type = '0';
                                    $kbTransaction->comment = $kbPayoutRequest->admin_comment;
                                    if ($kbTransaction->add()) {
                                        $this->sendApproveTransactionMail($kbPayoutRequest, $transaction_id, $kbPayoutRequest->admin_comment);
                                    }
                                }
                            } else {
                                if ($output->_propMap['transaction_status'] == 'DENIED') {
                                    $kbPayoutRequest = new KbSellerTransactionRequest($pay_data['id_seller_transaction']);
                                    $kbPayoutRequest->approved = '2';
                                    $kbPayoutRequest->update();
                                }
                            }
                        }
                    } catch (Exception $ex) {
                        echo $ex->getMessage();
                    }
                }
            }
        }
        return true;
    }
    
    /*
     * function to send approve transaction mail to the seller
     */
    public function sendApproveTransactionMail($sellerTransaction, $transaction_id, $comment = null)
    {
        $seller_obj = new KbSeller($sellerTransaction->id_seller);
        $seller_info = $seller_obj->getSellerInfo();
        //send email to Admin
        $template_vars = array(
            '{{shop_title}}' => $seller_info['title'],
            '{{seller_name}}' => $seller_info['seller_name'],
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
    
    public function sendautopaypalrequest()
    {
        if (Tools::getValue('secure_key') == Configuration::get('KB_MP_AUTO_PAYPAL_CRON')) {
            if ($this->sendautopaypalrequeststate()) {
                echo $this->module->l('Success', 'cron');
            }
        } else {
            echo $this->module->l('Security Token is invalid or expired', 'cron');
        }
    }

    public function sendautopaypalrequeststate()
    {
        $sellers = KbSeller::getAllSellers();
        $paypal_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
        if (isset($paypal_setting['enable_automatic_payout']) && $paypal_setting['enable_automatic_payout'] == 1) {
            if (is_array($sellers) && count($sellers) > 0) {
                foreach ($sellers as $seller_key => $seller_data) {
                    $total_amount_already_requested = 0;
                    $total_earning = 0;
                    $seller_balance = 0;

                    $id_seller = $seller_data['id_seller'];
                    $total_amount_already_requested = KbSellerTransactionRequest::getTotalRequestedAmountBySeller($id_seller, 2, false);
                    $total_earning = KbSellerEarning::getTotalSellerEarning($id_seller);
                    $seller_balance = $total_earning - $total_amount_already_requested;
                    if ($seller_balance > (float)$paypal_setting['amount_hold']) {
                        $payout_amount = $seller_balance - $paypal_setting['amount_hold'];
                        if(round($payout_amount,2)>0){
                            $this->saveNewPayoutRequest($id_seller, $payout_amount);
                        }
                        
                    }
                }
            }
        } else {
            echo $this->module->l('Automatic Payout setting is not enabled.', 'cron');
            return false;
        }
        return true;
    }

    protected function saveNewPayoutRequest($seller_id, $payout_amount)
    {
        $seller_obj = new KbSeller($seller_id);
        $this->seller_obj = $seller_obj->getSellerInfo();
        $id_seller = $seller_id;
        $amount_request = $payout_amount;
        $request_obj = new KbSellerTransactionRequest();
        $request_obj->id_seller = $seller_id;
        $request_obj->id_shop = $this->seller_obj['id_shop'];
        $request_obj->id_lang = $this->seller_obj['id_default_lang'];
        $request_obj->id_employee = 0;
        $request_obj->id_currency = Configuration::get('PS_CURRENCY_DEFAULT');
        $request_obj->transaction_type = '0';
        $request_obj->amount = $amount_request;
        $request_obj->comment = $this->module->l('Automatically generated by CRON', 'cron');
        $request_obj->approved = "0";
        $request_obj->admin_comment = '';
           
        if ($request_obj->save()) {
            $id_seller_transaction = $request_obj->id;
            $kbPayoutRequest = new KbSellerTransactionRequest($id_seller_transaction);
            $query = 'Select pc.payment_info, CONCAT(c.`firstname`, \' \',  c.`lastname`) as customer_name, c.email
                from ' . _DB_PREFIX_ . 'kb_mp_seller  pc
                LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = pc.`id_customer`)
                WHERE pc.id_seller = ' . (int) $kbPayoutRequest->id_seller;
            $seller_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($query, true);
            $data = array();
            $data['payment_info'] = unserialize($seller_data['payment_info']);
            if ($data['payment_info']['name'] == 'kbpaypal') {
                $trans_comment = $this->module->l('Auto Approval through cron', 'cron');
                $seller_email = $seller_data['email'];
                $seller_name = $seller_data['customer_name'];
                $payment_info = unserialize($seller_data['payment_info']);
                $paypal_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
                if (empty($paypal_setting)) {
                    $this->context->cookie->kb_redirect_error = $this->module->l('Paypal Configuration is empty.', 'cron');
                } elseif (!$paypal_setting['enable']) {
                    $this->context->cookie->kb_redirect_success = $this->module->l('Paypal Configuration is disabled.', 'cron');
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
                        /* Start-MK made changes on 27-08-18 to update the process of payout transaction */
                        if (isset($request->_propMap)) {
                            $is_approved = '0';
                            $transaction_id = '';
                            if (isset($request->_propMap['transaction_id'])) {
                                $transaction_id = $request->_propMap['transaction_id'];
                                $is_approved = '1';
                            }
                            if (isset($request->_propMap['payout_item_id'])) {
                                $kbPayoutRequest = new KbSellerTransactionRequest($kbPayoutRequest->id_seller_transaction);
                                $kbPayoutRequest->approved = $is_approved;
                                $kbPayoutRequest->payout_status = $request->_propMap['transaction_status'];
                                $kbPayoutRequest->payout_item_id = $request->_propMap['payout_item_id'];
                                $kbPayoutRequest->id_employee = 1;
                                $kbPayoutRequest->admin_comment = $trans_comment;
                                $kbPayoutRequest->update();
                                if (!empty($transaction_id)) {
                                    $kbTransaction = new KbSellerTransaction();
                                    $kbTransaction->id_seller = $kbPayoutRequest->id_seller;
                                    $kbTransaction->id_shop = $kbPayoutRequest->id_shop;
                                    $kbTransaction->id_employee = 1;
                                    $kbTransaction->transaction_number = $transaction_id;
                                    $kbTransaction->amount = $kbPayoutRequest->amount;
                                    $kbTransaction->transaction_type = '0';
                                    $kbTransaction->comment = $trans_comment;
                                    if ($kbTransaction->add()) {
                                        $this->sendApproveTransactionMail($kbPayoutRequest, $transaction_id, $trans_comment);
                                        $this->context->cookie->kb_redirect_success = $this->module->l('Transaction successfully approved.', 'cron');
                                    }
                                } else {
                                    if ($request->_propMap['transaction_status'] == 'PENDING') {
                                        $this->context->cookie->kb_redirect_success = $this->module->l('Transaction is pending.', 'cron');
                                    } elseif ($request->_propMap['transaction_status'] == 'SUCCESS') {
                                        $kbPayoutRequest->approved = '1';
                                        $kbPayoutRequest->update();
                                        $this->context->cookie->kb_redirect_success = $this->module->l('Transaction is completed.', 'cron');
                                    } elseif ($request->_propMap['transaction_status'] == 'DENIED') {
                                        $kbPayoutRequest->approved = '2';
                                        $kbPayoutRequest->update();
                                        $this->context->cookie->kb_redirect_error = $this->module->l('Transaction is denied.', 'cron');
                                    }
                                }
                            } else {
                                $this->context->cookie->kb_redirect_error = $this->module->l('Transaction failed.', 'cron');
                            }
                        } else {
                            $this->context->cookie->kb_redirect_error = $this->module->l('Transaction failed.', 'cron');
                        }
                        /* End-MK made changes on 27-08-18 to update the process of payout transaction */
                    } else {
                        $this->context->cookie->kb_redirect_error = $this->module->l('Transaction cannot be proceed', 'cron');
                    }
                } else {
                    $this->context->cookie->kb_redirect_error = $this->module->l('No Payout Information found for the Seller.', 'cron');
                }
            }
        }
        return true;
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
        }
    }
    
    public function activateDeactivateMembershipPlans()
    {
        if (Tools::getValue('secure_key') == Configuration::get('KB_MP_MEMBERSHIP_PLAN')) {
            $is_available_membership_plan = 0;
            $membership_settings = array();
            if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
                $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
            }
            $is_available_membership_plan = 0;
            if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1) {
                if ($this->updateMembershipPlans()) {
                    echo $this->module->l('Success', 'cron');
                }
            } else {
                echo $this->module->l('Membership Feature is not enabled.Kindly enable the same.', 'cron');
            }
        } else {
            echo $this->module->l('Security Token is invalid or expired', 'cron');
        }
    }
    
    public function sendMembeshipReminders()
    {
        if (Tools::getValue('secure_key') == Configuration::get('KB_MP_MEMBERSHIP_PLAN')) {
            $is_available_membership_plan = 0;
            $membership_settings = array();
            if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
                $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
            }
            $is_available_membership_plan = 0;
            if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1) {
                $this->sendWarningEmailIfAny();
                $this->sendExpiredEmailIfAny();
                echo $this->module->l('Success', 'cron');
            } else {
                echo $this->module->l('Membership Feature is not enabled.Kindly enable the same.', 'cron');
            }
        } else {
            echo $this->module->l('Security Token is invalid or expired', 'cron');
        }
    }
    
    public function sendWarningEmailIfAny()
    {
        $plan_page_link = $this->context->link->getModuleLink(
            'kbmarketplace',
            'membershipplans',
            array(),
            (bool)Configuration::get('PS_SSL_ENABLED')
        );
        $reminders_sql = "SELECT * FROM " . _DB_PREFIX_ . "kb_membership_reminder_profile rp INNER JOIN " . _DB_PREFIX_ . "kb_membership_reminder_profile_templates rpt ON "
                . " rp.id_kb_membership_reminder_profile = rpt.id_kb_membership_reminder_profile AND active = 1 AND id_lang = '" . (int) $this->context->language->id . "'"
                . " AND id_shop = '" . (int) $this->context->shop->id . "' AND rp.reminder_type = 'warning'  ORDER BY rp.no_of_days";
        $reminders = Db::getInstance()->executeS($reminders_sql);
        if (is_array($reminders) && count($reminders) > 0) {
            foreach ($reminders as $reminders_key => $reminders_data) {
                $reminder_date = date('Y-m-d', strtotime('+ ' .$reminders_data['no_of_days']. ' days'));
                $status = '2';
                $filter = ' AND DATE(expire_date) = "'.pSQL($reminder_date).'"';
                $total = KbMemberShipPlanOrder::getMembershipPlan(null, true, $status, $filter);
                if ($total == 0 || empty($total)) {
                    continue;
                }
                $about_to_expire_plans = KbMemberShipPlanOrder::getMembershipPlan(null, false, $status, $filter);
                foreach ($about_to_expire_plans as $plan_key => $plan_data) {
                    $sellerObj = new KbSeller($plan_data['id_seller']);
                    $seller_info = $sellerObj->getSellerInfo();
                    
                    if ($sellerObj->id_default_lang == $reminders_data['id_lang']) {
                        $email_template_content = $reminders_data['body'];
                        $email_template_subject = $reminders_data['subject'];
                    } else {
                        $sql = "SELECT * FROM " . _DB_PREFIX_ . "kb_membership_reminder_profile_templates WHERE id_kb_membership_reminder_profile = '" . (int) $reminders_data['id_kb_membership_reminder_profile'] . "'"
                        . " AND id_lang = '" . (int) $sellerObj->id_default_lang . "'";
                        $reminder_email_data = Db::getInstance()->getRow($sql);
                        $email_template_content = $reminder_email_data['body'];
                        $email_template_subject = $reminder_email_data['subject'];
                    }
                    
                    if (is_numeric($seller_info['id_shop']) && $seller_info['id_shop']) {
                        $shop = new Shop((int) $seller_info['id_shop']);
                    }
                    $data = array(
                        '{shop_name}' => Tools::safeOutput($shop->name),
                        '{SHOP_NAME}' => Tools::safeOutput($shop->name),
                        '{seller_name}' => $seller_info['seller_name'],
                        '{last_date}' => Tools::displayDate($plan_data['expire_date'], $sellerObj->id_default_lang, false),
                        '{plan_link}' => $plan_page_link,
                        '{plan_name}' => $plan_data['plan_name'],
                    );
                    foreach ($data as $variable => $variable_val) {
                        $email_template_content = str_replace($variable, $variable_val, $email_template_content);
                    }
                    $notification_emails = $sellerObj->getEmailIdForNotification();
                    foreach ($notification_emails as $em) {
                        Mail::Send(
                            (int) $sellerObj->id_default_lang,
                            'kb_membership_mail',
                            $email_template_subject,
                            array('{membership_data}' => $email_template_content),
                            $em['email'],
                            $em['title'],
                            null,
                            null,
                            null,
                            null,
                            _PS_MODULE_DIR_ . 'kbmarketplace/mails/',
                            false,
                            (int) $seller_info['id_shop']
                        );
                    }
                }
            }
        }
    }
    
    public function sendExpiredEmailIfAny()
    {
        $plan_page_link = $this->context->link->getModuleLink(
            'kbmarketplace',
            'membershipplans',
            array(),
            (bool)Configuration::get('PS_SSL_ENABLED')
        );
        $reminders_sql = "SELECT * FROM " . _DB_PREFIX_ . "kb_membership_reminder_profile rp INNER JOIN " . _DB_PREFIX_ . "kb_membership_reminder_profile_templates rpt ON "
                . " rp.id_kb_membership_reminder_profile = rpt.id_kb_membership_reminder_profile AND active = 1 AND id_lang = '" . (int) $this->context->language->id . "'"
                . " AND id_shop = '" . (int) $this->context->shop->id . "' AND rp.reminder_type = 'expiry'  ORDER BY rp.no_of_days";
        $reminders = Db::getInstance()->executeS($reminders_sql);
        if (is_array($reminders) && count($reminders) > 0) {
            foreach ($reminders as $reminders_key => $reminders_data) {
                $reminder_date = date('Y-m-d', strtotime('- ' .$reminders_data['no_of_days']. ' days'));
                $status = '3';
                $filter = ' AND DATE(expire_date) = "'.pSQL($reminder_date).'"';
                $total = KbMemberShipPlanOrder::getMembershipPlan(null, true, $status, $filter);
                if ($total == 0 || empty($total)) {
                    continue;
                }
                $expired_plans = KbMemberShipPlanOrder::getMembershipPlan(null, false, $status, $filter);
                foreach ($expired_plans as $plan_key => $plan_data) {
                    $total_approved = KbMemberShipPlanOrder::getMembershipPlan($plan_data['id_seller'], true, '1', null);
                    $total_active = KbMemberShipPlanOrder::getMembershipPlan($plan_data['id_seller'], true, '2', null);
                    if ((int) $total_approved != 0 || $total_active != 0) {
                        continue;
                    }
                    $sellerObj = new KbSeller($plan_data['id_seller']);
                    $seller_info = $sellerObj->getSellerInfo();
                    
                    if ($sellerObj->id_default_lang == $reminders_data['id_lang']) {
                        $email_template_content = $reminders_data['body'];
                        $email_template_subject = $reminders_data['subject'];
                    } else {
                        $sql = "SELECT * FROM " . _DB_PREFIX_ . "kb_membership_reminder_profile_templates WHERE id_kb_membership_reminder_profile = '" . (int) $reminders_data['id_kb_membership_reminder_profile'] . "'"
                        . " AND id_lang = '" . (int) $sellerObj->id_default_lang . "'";
                        $reminder_email_data = Db::getInstance()->getRow($sql);
                        $email_template_content = $reminder_email_data['body'];
                        $email_template_subject = $reminder_email_data['subject'];
                    }
                    
                    if (is_numeric($seller_info['id_shop']) && $seller_info['id_shop']) {
                        $shop = new Shop((int) $seller_info['id_shop']);
                    }
                
                    $data = array(
                        '{shop_name}' => Tools::safeOutput($shop->name),
                        '{SHOP_NAME}' => Tools::safeOutput($shop->name),
                        '{seller_name}' => $seller_info['seller_name'],
                        '{last_date}' => Tools::displayDate($plan_data['expire_date'], $sellerObj->id_default_lang, false),
                        '{plan_link}' => $plan_page_link,
                        '{plan_name}' => $plan_data['plan_name'],
                    );
                    foreach ($data as $variable => $variable_val) {
                        $email_template_content = str_replace($variable, $variable_val, $email_template_content);
                    }
                    $notification_emails = $sellerObj->getEmailIdForNotification();
                    foreach ($notification_emails as $em) {
                        Mail::Send(
                            (int) $sellerObj->id_default_lang,
                            'kb_membership_mail',
                            $email_template_subject,
                            array('{membership_data}' => $email_template_content),
                            $em['email'],
                            $em['title'],
                            null,
                            null,
                            null,
                            null,
                            _PS_MODULE_DIR_ . 'kbmarketplace/mails/',
                            false,
                            (int) $seller_info['id_shop']
                        );
                    }
                }
            }
        }
    }
    

    public function updateMembershipPlans()
    {
        $sellers = KbSeller::getAllSellers();
        if (is_array($sellers) && count($sellers) > 0) {
            foreach ($sellers as $seller_key => $seller_data) {
                /*
                 * Mark mebership plan as inactive if plan is expired
                 */
                $this->kbDeactivateMembershipPlanIfExpired($seller_data['id_seller']);
                /*
                 * Add all the products in tracking table if no plan is active
                 * tracking table product_status = 1;(if product is active earlier)
                 * product_status = 2;(if product is inactive earlier)
                 */
                $this->processSellerProduct($seller_data['id_seller']);
                /*
                 * If no plan is active and approved plans are available then activate the plan
                 * and remove the activated product from tracking table
                 */
                $this->kbactivateMembershipPlanIfAvailable($seller_data['id_seller']);
            }
        }
        return true;
    }
    
    /*
     * Function to deactivate membership plan if expired
     */
    public function kbDeactivateMembershipPlanIfExpired($id_seller)
    {
        $last_day_date = date('Y-m-d');

        $status = '2';
        
        $filter = ' AND DATE(expire_date) < "'.pSQL($last_day_date).'"';
        
        $total = KbMemberShipPlanOrder::getMembershipPlan($id_seller, true, $status, $filter);
        
        if ($total == 0 || empty($total)) {
            return;
        }
        $expired_plans = array();
        
        $expired_plans = KbMemberShipPlanOrder::getMembershipPlan($id_seller, false, $status, $filter);
        if (is_array($expired_plans) && count($expired_plans) > 0) {
            foreach ($expired_plans as $plan_key => $plan_data) {
                $plan_obj = new KbMemberShipPlanOrder($plan_data['id_kbmp_membership_plan_order']);
                $plan_obj->status = 3;
                if ($plan_obj->save()) {
                    $is_available_membership_plan = 0;
                    $membership_settings = array();
                    if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
                        $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
                    }
                    $is_available_membership_plan = 0;
                    if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1 && isset($membership_settings['kbmp_inform_seller_membership_expiry']) && $membership_settings['kbmp_inform_seller_membership_expiry'] == 1) {
                        $sellerObj = new KbSeller($plan_data['id_seller']);
                        $seller_info = $sellerObj->getSellerInfo();
                        
                        if (Configuration::get('kbmp_membership_expired_email')) {
                            $email_data = Tools::unSerialize(Configuration::get('kbmp_membership_expired_email'));
                        }
                        $email_template_subject = $this->module->l('Your Active Membership Plan is expired');
                        if (isset($email_data[$sellerObj->id_default_lang])) {
                            $email_template_content = $email_data[$sellerObj->id_default_lang];
                        } else {
                            $email_template_content = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->name . "/views/templates/admin/email/membership_plan_expiry_email.html");
                        }
                        $plan_page_link = $this->context->link->getModuleLink(
                            'kbmarketplace',
                            'membershipplans',
                            array(),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        );

                        if (is_numeric($seller_info['id_shop']) && $seller_info['id_shop']) {
                            $shop = new Shop((int) $seller_info['id_shop']);
                        }
                        
                        $data = array(
                            '{shop_name}' => Tools::safeOutput($shop->name),
                            '{SHOP_NAME}' => Tools::safeOutput($shop->name),
                            '{seller_name}' => $seller_info['seller_name'],
                            '{last_date}' => Tools::displayDate(date('Y-m-d'), $sellerObj->id_default_lang, false),
                            '{plan_link}' => $plan_page_link,
                            '{plan_name}' => $plan_data['plan_name'],
                        );
                        foreach ($data as $variable => $variable_val) {
                            $email_template_content = str_replace($variable, $variable_val, $email_template_content);
                        }
                        $notification_emails = $sellerObj->getEmailIdForNotification();
                        foreach ($notification_emails as $em) {
                            Mail::Send(
                                (int) $sellerObj->id_default_lang,
                                'kb_membership_mail',
                                $email_template_subject,
                                array('{membership_data}' => $email_template_content),
                                $em['email'],
                                $em['title'],
                                null,
                                null,
                                null,
                                null,
                                _PS_MODULE_DIR_ . 'kbmarketplace/mails/',
                                false,
                                (int) $seller_info['id_shop']
                            );
                        }
                    }
                }
            }
        }
    }
    
    public function processSellerProduct($id_seller)
    {
        /*
         * check if any active plan
         * else add all product in tracking table
         */
        $status = '2';
        
        $active_membership_plan = array();
        
        $active_membership_plan = KbMemberShipPlanOrder::getMembershipPlan($id_seller, false, $status, null);
        
        if (is_array($active_membership_plan) && count($active_membership_plan) > 0) {
            return;
        } else {
            $this->addSellerProductInTrackingTable($id_seller);
        }
    }
    
    public function addSellerProductInTrackingTable($id_seller)
    {
        if (!KbSeller::isTrackedSeller($id_seller)) {
            $products = KbSellerProduct::getSellerProducts($id_seller);
            if (count($products) > 0) {
                foreach ($products as $p) {
                    $product = new Product($p['id_product']);
                    if (!Validate::isLoadedObject($product)) {
                        continue;
                    }

                    if (!$this->checkProductTracking($id_seller, $product)) {
                        if ($this->insertProductTracking($id_seller, $product)) {
                            if ($product->active) {
                                $product->active = 0;
                                $product->update(true);
                            }
                        }
                    }
                }
            }
        }
        return;
    }
    
    public function insertProductTracking($id_seller, $product)
    {
        $sql = 'INSERT INTO ' . _DB_PREFIX_ . 'kbmp_membership_seller_product_tracking 
            (id_seller, id_product, product_status) 
            VALUES (' . (int) $id_seller . ', '. (int) $product->id . ', ' . (int) $product->active. ')';
        
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
    }
    
    public function checkProductTracking($id_seller, $product)
    {
        $sql = 'select count(*) from ' . _DB_PREFIX_ . 'kbmp_membership_seller_product_tracking
            where id_seller = ' . (int) $id_seller . ' and id_product =  '. (int) $product->id;
        
        return (bool) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
    }
    
    public function kbactivateMembershipPlanIfAvailable($id_seller)
    {
        /*
         * check if any active plan
         * else add activate a plan and remove product from tracking table
         */
        $status = '2';
        
        $active_membership_plan = array();
        
        $active_membership_plan = KbMemberShipPlanOrder::getMembershipPlan($id_seller, false, $status, null);
        
        if (is_array($active_membership_plan) && count($active_membership_plan) > 0) {
            return;
        } else {
            $status = '1';
            $approved_membership_plan = array();
            
            $total = KbMemberShipPlanOrder::getMembershipPlan($id_seller, true, $status, null);
        
            if ($total == 0 || empty($total)) {
                return;
            } else {
                $approved_membership_plan = KbMemberShipPlanOrder::getMembershipPlan($id_seller, false, $status, null);
                if (is_array($approved_membership_plan) && count($approved_membership_plan) > 0) {
                    foreach ($approved_membership_plan as $plan_key => $plan_data) {
                        /*
                        * remove some product from tracking table
                        */
                        if (KbMemberShipPlanOrder::activateMemberShipPlan($id_seller, $plan_data['id_kbmp_membership_plan_order'])) {
                        }
                        break;
                    }
                }
            }
        }
    }
    
    public function removeAllSellerProductFromTrackingTable($id_seller)
    {
        $products = $this->getTrackedProducts($id_seller);
        if (count($products) > 0) {
            foreach ($products as $p) {
                $this->deleteTrackedProduct($p['id_product']);
                $product = new Product($p['id_product']);
                if (!Validate::isLoadedObject($product)) {
                    continue;
                }

                $product->active = $p['product_status'];
                $product->update(true);
            }
        }
    }
        
    public function getTrackedProducts($id_seller, $status = null)
    {
        if (!empty($status)) {
            $where = ' and product_status = '.(int) $status;
        } else {
            $where = ' 1';
        }
        $sql = 'select * from '._DB_PREFIX_.'kbmp_membership_seller_product_tracking where id_seller = '.(int) $id_seller . $where;
        
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }
    
    public function deleteTrackedProduct($id_product)
    {
        $sql = 'delete from '._DB_PREFIX_.'kbmp_membership_seller_product_tracking where '
                . '  id_product = '.(int) $id_product;
        Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
    }
}
