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

class KbmarketplacePayoutRequestModuleFrontController extends KbmarketplaceCoreModuleFrontController
{
    public $controller_name = 'payoutrequest';
    const MIN_REASON_LENGTH = 30;
    const MAX_REASON_LENGTH = 300;
    
    public function __construct()
    {
        parent::__construct();
    }

    public function setMedia()
    {
        $this->addCSS($this->getKbModuleDir().'views/css/front/kb-forms.css');
        parent::setMedia();
    }
    
    public function postProcess()
    {
//        d(Tools::getAllValues());
        parent::postProcess();
        if (Tools::isSubmit('ajax')) {
            $this->json = array();
            $renderhtml = false;
            if (Tools::isSubmit('method')) {
                switch (Tools::getValue('method')) {
                    case 'getSellerPayout':
                        $this->json = $this->getAjaxSellerPayoutListHtml();
                        break;
                    case 'getRequestDetail':
                        $this->json = $this->getAjaxRequestDetail();
                        break;
                }
            }
            if (!$renderhtml) {
                echo Tools::jsonEncode($this->json);
            }
            die;
        } elseif (Tools::isSubmit('payout_request_amount')) {
            $this->saveNewPayoutRequest();
        }
    }
    
    protected function saveNewPayoutRequest()
    {
        $amount_request = Tools::getValue('payout_request_amount', 0);

        $request_obj = new KbSellerTransactionRequest();
        $request_obj->id_seller = $this->seller_obj->id;
        $request_obj->id_shop = $this->seller_obj->id_shop;
        $request_obj->id_lang = $this->seller_obj->id_default_lang;
        $request_obj->id_employee = 0;
        $request_obj->id_currency = Configuration::get('PS_CURRENCY_DEFAULT');
        $request_obj->transaction_type = '0';
        $request_obj->amount = $amount_request;
        $request_obj->comment = Tools::getValue('payout_request_reason', '');
        $request_obj->approved = "0";
        $request_obj->admin_comment = '';

        if ($request_obj->save()) {
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('Your request is successfully sent to admin. Wait for his approval.', 'payoutrequest')
            );
           
            //send email to Admin
            $template_vars = array(
                '{{shop_title}}' => $this->seller_info['title'],
                '{{seller_name}}' => $this->seller_info['seller_name'],
                '{{seller_email}}' => $this->seller_info['email'],
                '{{requested_amount}}' => Tools::displayPrice($amount_request, $this->seller_currency),
                '{{reason}}' => Tools::getValue('payout_request_reason', ''),
                '{{seller_contact}}' => $this->seller_info['phone_number']
            );
            $email = new KbEmail(
                KbEmail::getTemplateIdByName('mp_seller_payout_transaction_request_notification_admin'),
                $this->seller_obj->id_default_lang
            );
            $email->send(
                Configuration::get('PS_SHOP_EMAIL'),
                Configuration::get('PS_SHOP_NAME'),
                null,
                $template_vars
            );
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Error occurred while sending your request to admin.', 'payoutrequest')
            );
        }

        Tools::redirect($this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            array(),
            (bool) Configuration::get('PS_SSL_ENABLED')
        ));
    }
    
    public function initContent()
    {
        
        $request_category_id     = (int) Tools::getValue('category_request_id', 0);
        $request_payout_reason = Tools::getValue('category_request_reason', '');

//        $this->context->smarty->assign('available_categories', $categories);
        $this->context->smarty->assign('min_reason_length', self::MIN_REASON_LENGTH);
        $this->context->smarty->assign('max_reason_length', self::MAX_REASON_LENGTH);
        $this->context->smarty->assign('request_category_id', $request_category_id);
        $this->context->smarty->assign('request_payout_reason', $request_payout_reason);

        $this->total_records = KbSellerTransactionRequest::getRequestBySeller($this->seller_info['id_seller'], false, true);

        if ($this->total_records > 0) {
            $filter_cat_list = array();
            $tmp             = $this->getCategoryList();
            foreach ($tmp as $cat) {
                $filter_cat_list[] = array('value' => $cat['id_category'], 'label' => $cat['name']);
            }

            $tmp              = KbGlobal::getApporvalStatus();
            $approve_statuses = array();
            foreach ($tmp as $key => $val) {
                $approve_statuses[] = array('value' => $key, 'label' => $val);
            }

            $i            = 0;
            $rating_array = array();
            while ($i <= KbGlobal::MAX_RATING) {
                $rating_array[] = array('value' => $i, 'label' => $i);
                $i++;
            }

            $this->filter_header      = $this->module->l('Filter Your Search', 'payoutrequest');
            $this->filter_id          = 'seller_payout_request_list';
            $this->filters            = array(
                array(
                    'type' => 'text',
                    'placeholder' => $this->module->l('Amount', 'payoutrequest'),
                    'name' => 'amount',
                    'label' => $this->module->l('Amount', 'payoutrequest'),
                ),
                array(
                    'type' => 'select',
                    'placeholder' => $this->module->l('Select', 'payoutrequest'),
                    'name' => 'approved',
                    'label' => $this->module->l('Status', 'payoutrequest'),
                    'values' => $approve_statuses
                )
            );
            $this->filter_action_name = 'getSellerPayout';
            $this->context->smarty->assign('kbfilter', $this->renderKbListFilter());

            $this->table_id     = $this->filter_id;
            $this->table_header = array(
                array('label' => $this->module->l('Date', 'payoutrequest')),
                array('label' => $this->module->l('Amount', 'payoutrequest')),
                array('label' => $this->module->l('Status', 'payoutrequest'))
            );

            $req_trans = KbSellerTransactionRequest::getRequestBySeller(
                $this->seller_info['id_seller'],
                false,
                false,
                $this->getPageStart(),
                $this->tbl_row_limit
            );
            foreach ($req_trans as $ct) {
                $this->table_content[] = array(
                    array('value' => Tools::displayDate($ct['date_add'], null, false)),
                    array(
                        'link' => array(
                            'function' => 'getSellerRequestedPayoutDetail('
                            .$ct['id_seller_transaction'].')',
                            'title' => $this->module->l('Click to view detail', 'payoutrequest')),
                        'value' => Tools::displayPrice($ct['amount'], $this->seller_currency),
                        'class' => '',
                    ),
                    array('value' => KbGlobal::getApporvalStatus($ct['approved']))
                );
            }

            $this->list_row_callback = $this->filter_action_name;
        }

        $this->context->smarty->assign('kblist', $this->renderKbList());

        $this->setKbTemplate('seller/payout_request.tpl');
        parent::initContent();
    }
    
    protected function getAjaxSellerPayoutListHtml()
    {
        $json = array();

        $custom_filter = '';
//        d(Tools::getAllValues());
        if (Tools::getIsset('amount') && Tools::getValue('amount') != '') {
            $custom_filter .= ' AND amount = '.(float) Tools::getValue('amount');
        }

        $approved = false;
        if (Tools::getIsset('approved') && Tools::getValue('approved') != '') {
            $approved = pSQL(Tools::getValue('approved'));
        }

        $this->total_records = KbSellerTransactionRequest::getRequestBySeller(
            $this->seller_info['id_seller'],
            $approved,
            true,
            null,
            null,
            $custom_filter
        );
        if ($this->total_records > 0) {
            if (Tools::getIsset('start') && (int) Tools::getValue('start') > 0) {
                $this->page_start = (int) Tools::getValue('start');
            }

            $this->table_id = 'seller_payout_request_list';

            $req_payout = KbSellerTransactionRequest::getRequestBySeller(
                $this->seller_info['id_seller'],
                $approved,
                false,
                $this->getPageStart(),
                $this->tbl_row_limit,
                $custom_filter
            );

            $row_html = '';
            foreach ($req_payout as $ct) {
//                d($ct);
                $row_html .= '<tr>
                    <td>'.Tools::displayDate($ct['date_add'], null, false).'</td>
                        <td>
                        <a href="javascript:void(0)" title="'.$this->module->l('Click to view detail', 'payoutrequest')
                    .'" onclick="getSellerRequestedPayoutDetail('
                    .$ct['id_seller_transaction'].')">'.Tools::displayPrice($ct['amount'], $this->seller_currency).'</a>
                        </td>
                        <td>'.KbGlobal::getApporvalStatus($ct['approved']).'</td>
                            </tr>';
            }

            $this->list_row_callback = 'getSellerPayout';
            $json['status']          = true;
            $json['html']            = $row_html;
            $json['pagination']      = $this->generatePaginator(
                $this->page_start,
                $this->total_records,
                $this->getTotalPages(),
                $this->list_row_callback
            );
        } else {
            $json['status'] = false;
            $json['msg']    = $this->module->l('No Data Found', 'payoutrequest');
        }
        return $json;
    }
    
    protected function getAjaxRequestDetail()
    {
        $json                  = array();
        $id_requested_category = (int) Tools::getValue('id_request', 0);
        if ($id_requested_category > 0) {
            $req_trans = new KbSellerTransactionRequest($id_requested_category);

           

            $data = array(
                'amount_name' => $this->module->l('Amount- ', 'payoutrequest'). Tools::displayPrice($req_trans->amount, $this->seller_currency),
                'posted_on' => Tools::displayDate($req_trans->date_add, null, false),
                'status' => KbGlobal::getApporvalStatus($req_trans->approved),
                'seller_comment' => Tools::safeOutput($req_trans->comment)
            );

            if ($req_trans->approved == KbGlobal::DISSAPPROVED) {
                if (!empty($req_trans->admin_comment)) {
                    $data = array_merge($data, array('admin_comment' => Tools::safeOutput($req_trans->admin_comment)));
                }
            }

            $json['status'] = true;
            $json['data']   = $data;
        } else {
            $json['status'] = false;
            $json['msg']    = $this->module->l('No Data Found', 'category');
        }
        return $json;
    }
}
