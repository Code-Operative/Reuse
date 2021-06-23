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

require_once dirname(__FILE__) . '/AdminKbMarketplaceCoreController.php';

class AdminKbMembershipSellerPlanDetailController extends AdminKbMarketplaceCoreController
{
    public $all_languages = array();
    public $error_flag = false;
    private $max_image_size = null;
    private $module_name = 'kbmarketplace';
    
    public $order_status = array();
    public $duration_type = array();
    public $payment_status = array();
        
    
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'kbmp_membership_plan_order';
        $this->className = 'KbMemberShipPlanOrder';
        $this->identifier = 'id_kbmp_membership_plan_order';
        $this->deleted = false;
        $this->lang = false;
        $this->display = 'list';
        
        
        if (Tools::getValue('id_seller')) {
            $id_Seller = Tools::getValue('id_seller');
            Context::getContext()->cookie->id_seller = $id_Seller;
        } else {
            if (isset(Context::getContext()->cookie->id_seller)) {
                $id_Seller = Context::getContext()->cookie->id_seller;
            } else {
                $id_Seller = 0;
            }
        }
        
        parent::__construct();
        
        $this->duration_intervals = array(
            '1' => $this->module->l('Days', 'AdminKbMembershipSellerPlanDetailController'),
            '2' => $this->module->l('Months', 'AdminKbMembershipSellerPlanDetailController'),
            '3' => $this->module->l('Years', 'AdminKbMembershipSellerPlanDetailController')
        );
        $this->order_status = array(
            '0' => $this->module->l('Pending', 'AdminKbMembershipSellerPlanDetailController'),
            '1' => $this->module->l('Approved', 'AdminKbMembershipSellerPlanDetailController'),
            '2' => $this->module->l('Active', 'AdminKbMembershipSellerPlanDetailController'),
            '3' => $this->module->l('Expired', 'AdminKbMembershipSellerPlanDetailController')
        );
        
        $this->payment_status = array(
            '0' => $this->module->l('Unpaid', 'AdminKbMembershipSellerPlanDetailController'),
            '1' => $this->module->l('paid', 'AdminKbMembershipSellerPlanDetailController'),
        );

        $this->fields_list = array(
            'id_kbmp_membership_plan_order' => array(
                'title' => $this->module->l('ID', 'AdminKbMembershipSellerPlanDetailController'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'id_order' => array(
                'title' => $this->module->l('Order ID', 'AdminKbMembershipSellerPlanDetailController'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs',
                'callback' => 'getIdOrder',
            ),
            'seller_name' => array(
                'title' => $this->module->l('First Name', 'AdminKbMembershipSellerPlanDetailController'),
                'havingFilter' => false,
                'search' => true,
            ),
//            'title' => array(
//                'title' => $this->module->l('shop Title', 'AdminKbMembershipSellerPlanDetailController'),
//                'havingFilter' => true,
//                'filter_key' => 'sl!title',
//                'order_key' => 'sl.title',
//            ),
            'plan_name' => array(
                'title' => $this->module->l('Plan Name', 'AdminKbMembershipSellerPlanDetailController'),
                'havingFilter' => true,
                'callback' => 'getPlanTitle',
                'filter_key' => 'pl!name',
                'order_key' => 'pl.name',
            ),
            'plan_duration' => array(
                'title' => $this->module->l('Plan Duration', 'AdminKbMembershipSellerPlanDetailController'),
                'havingFilter' => false,
                'search' => false,
                'align' => 'center',
                'callback' => 'showPlanDuration',
            ),
            'product_limit' => array(
                'title' => $this->module->l('Product Limit', 'AdminKbMembershipSellerPlanDetailController'),
                'havingFilter' => true,
                'search' => true,
                'align' => 'center',
                'callback' => 'showProductLimit',
                'filter_key' => 'a!product_limit',
            ),
            'status' => array(
                'title' => $this->module->l('Status', 'AdminKbMembershipSellerPlanDetailController'),
                'type' => 'select',
                'list' => array(
                    '0' => $this->module->l('Pending', 'AdminKbMembershipSellerPlanDetailController'),
                    '1' => $this->module->l('Approved', 'AdminKbMembershipSellerPlanDetailController'),
                    '2' => $this->module->l('Active', 'AdminKbMembershipSellerPlanDetailController'),
                    '3' => $this->module->l('Expired', 'AdminKbMembershipSellerPlanDetailController'),
                ),
                'callback' => 'getOrderStatus',
                'havingFilter' => true,
                'filter_key' => 'a!status',
                'order_key' => 'a.status',
            ),
            'is_paid' => array(
                'title' => $this->module->l('Payment Status', 'AdminKbMembershipSellerPlanDetailController'),
                'type' => 'select',
                'list' => array(
                    '0' => $this->module->l('Unpaid', 'AdminKbMembershipSellerPlanDetailController'),
                    '1' => $this->module->l('Paid', 'AdminKbMembershipSellerPlanDetailController'),
                ),
                'callback' => 'getPaymentStatus',
                'havingFilter' => true,
                'filter_key' => 'a!is_paid',
                'order_key' => 'a.is_paid',
            ),
            'date_add' => array(
                'title' => $this->module->l('Purchase Date', 'AdminKbMembershipSellerPlanDetailController'),
                'havingFilter' => true,
            ),
            'active_date' => array(
                'title' => $this->module->l('Active Date', 'AdminKbMembershipSellerPlanDetailController'),
                'havingFilter' => true,
            ),
            'expire_date' => array(
                'title' => $this->module->l('Expire Date', 'AdminKbMembershipSellerPlanDetailController'),
                'havingFilter' => true,
            )
        );

        
        $id_shop = Shop::isFeatureActive() && Shop::getContext() == Shop::CONTEXT_SHOP
            ? (int)$this->context->shop->id : 'p.id_shop_default';

        $this->_select = "sl.title,pl.name as plan_title,a.plan_name,
			c.`email`, CONCAT(LEFT(c.`firstname`, 1), '.', c.`lastname`) AS `seller_name`, 
			a.id_seller as pending_request";
        $this->_where = ' and a.id_seller = '. (int) $id_Seller;
        $this->_join = '
                        INNER JOIN `' . _DB_PREFIX_ . 'kb_mp_seller` s ON (a.`id_seller` = s.`id_seller`) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'kbmp_membership_plan` plan ON (plan.`id_kbmp_membership_plan` = a.`id_kbmp_membership_plan`) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'product` p ON (p.`id_product` = plan.`id_product`)
                        LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (pl.id_product = plan.`id_product`
                        AND  pl.id_lang = ' . (int)$this->context->language->id . ') 
                        LEFT JOIN `' . _DB_PREFIX_ . 'kb_mp_seller_lang` sl ON (a.`id_seller` = sl.`id_seller` 
			AND sl.id_lang = ' . (int)$this->context->language->id . ') 
			LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = s.`id_customer`)';
        
        $this->_orderBy = 'id_kbmp_membership_plan_order';
        $this->_orderWay = 'ASC';
        $this->toolbar_title = $this->module->l('Sellers Plan Detail', 'adminkbmembershipsellerplanscontroller');
        $this->addRowAction('approve');
        $this->addRowAction('activate');
        $this->addRowAction('delete');
        $this->bulk_actions = array();
    }
    
    public function displayActivateLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $membership_order_obj = new KbMemberShipPlanOrder((int) $id);
        if ($membership_order_obj->status == 1 || $membership_order_obj->status == 0) {
            $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

            $tpl->assign(array(
                'approve_conf' => $this->module->l('Do you want to activate the plan?', 'AdminKbMembershipSellerPlanDetailController'),
                'display_confirm_popup' => true,
                'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&activate'
                . $this->table . '&token=' . ($token != null ? $token : $this->token),
                'action' => $this->module->l('Activate', 'AdminKbMembershipSellerPlanDetailController'),
                'icon' => 'icon-check'
            ));

            $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'AdminKbMembershipSellerPlanDetailController'));
            $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'AdminKbMembershipSellerPlanDetailController'));
            $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'AdminKbMembershipSellerPlanDetailController'));

            return $tpl->fetch();
        } else {
            return '';
        }
        return '';
    }
    
    public function displayApproveLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $membership_order_obj = new KbMemberShipPlanOrder((int) $id);
        if ($membership_order_obj->status == 0) {
            $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

            $tpl->assign(array(
                'approve_conf' => $this->module->l('Do you want to approve?', 'AdminKbMembershipSellerPlanDetailController'),
                'display_confirm_popup' => true,
                'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&approve'
                . $this->table . '&token=' . ($token != null ? $token : $this->token),
                'action' => $this->module->l('Approve', 'AdminKbMembershipSellerPlanDetailController'),
                'icon' => 'icon-check'
            ));

            $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'AdminKbMembershipSellerPlanDetailController'));
            $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'AdminKbMembershipSellerPlanDetailController'));
            $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'AdminKbMembershipSellerPlanDetailController'));

            return $tpl->fetch();
        } else {
            return;
        }
        return;
    }
    
    public function displayDeleteLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $tpl = $this->custom_smarty->createTemplate('list_action_delete.tpl');

        $tpl->assign(array(
            'confirm' => $this->module->l('Do you want to delete?', 'AdminKbMembershipSellerPlanDetailController'),
            'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&delete'
            . $this->table . '&token=' . ($token != null ? $token : $this->token),
            'action' => $this->module->l('Delete', 'AdminKbMembershipSellerPlanDetailController'),
        ));

        return $tpl->fetch();
    }
    
    public function showProductLimit($id_row, $tr)
    {
        if ($id_row == 0 && $tr['is_enabled_product_limit'] == 0) {
            return 'NA';
        } else {
            return $id_row;
        }
    }
    
    public function showPlanDuration($id_row, $tr)
    {
        return $id_row. ' ' .$this->duration_intervals[$tr['plan_duration_type']];
    }
    
    public function getOrderStatus($id_row, $row_data)
    {
        return $this->order_status[$id_row];
    }
    
    public function getPaymentStatus($id_row, $row_data)
    {
        return $this->payment_status[$id_row];
    }
    
    public function getPlanTitle($id_row, $row_data)
    {
        if ($row_data['plan_title'] == '') {
            return $row_data['plan_name'];
        } else {
            return $row_data['plan_title'];
        }
    }
    
    public function getIdOrder($id_row, $row_data)
    {
        if ((int)$id_row > 0) {
            return $id_row;
        } else {
            return $this->module->l('Created By Admin', 'AdminKbMembershipSellerPlanDetailController');
        }
    }
    
    public function initProcess()
    {
        parent::initProcess();
        if (Tools::getIsset('approve' . $this->table)) {
            $this->action = 'approveMembershipPlanOrder';
        }
    }
    
    public function processActivateMembershipPlanOrder()
    {
        if (Tools::getIsset($this->identifier)) {
            $object = new $this->className(Tools::getValue($this->identifier));
            $seller_obj = new KbSeller($object->id_seller);
            $seller     = $seller_obj->getSellerInfo();
            if ($seller['active'] == 1 && $seller['approved'] == KbGlobal::APPROVED) {
                if (KbMemberShipPlanOrder::activateMemberShipPlan($object->id_seller, Tools::getValue($this->identifier))) {
                    $this->context->cookie->__set(
                        'kb_redirect_success',
                        $this->module->l('Selected Membership Plan Has been activated.', 'AdminKbMembershipSellerPlanDetailController')
                    );
                    $this->redirect_after = self::$currentIndex . '&id_seller='.(int) $object->id_seller.'&token=' . $this->token;
                } else {
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $this->module->l('The maximum number of allowed active product under this plan is lesser than the current number of activated products.Kindly deactivate some products first.', 'AdminKbMembershipSellerPlanDetailController')
                    );
                    $this->redirect_after = self::$currentIndex . '&id_seller='.(int) $object->id_seller.'&token=' . $this->token;
                }
            } else {
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('Before activating membership plan, first approve Seller Account.', 'adminkbproductapprovallistcontroller')
                );
            }
        }
    }
    
    public function processApproveMembershipPlanOrder()
    {
        if (Tools::getIsset($this->identifier)) {
            $object = new $this->className(Tools::getValue($this->identifier));
            $object->status = 1;
            $seller_obj = new KbSeller($object->id_seller);
            $seller     = $seller_obj->getSellerInfo();
            if ($seller['active'] == 1 && $seller['approved'] == KbGlobal::APPROVED) {
                if ($object->save()) {
                    $this->context->cookie->__set(
                        'kb_redirect_success',
                        $this->module->l('Selected Membership Plan Has been approved.', 'AdminKbMembershipSellerPlanDetailController')
                    );
                    $this->redirect_after = self::$currentIndex . '&id_seller='.(int) $object->id_seller.'&token=' . $this->token;
                } else {
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $this->module->l('Not able to update status of selected membership plan.', 'AdminKbMembershipSellerPlanDetailController')
                    );
                    $this->redirect_after = self::$currentIndex . '&id_seller='.(int) $object->id_seller.'&token=' . $this->token;
                }
            } else {
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('Before approving membership plan, first approve Seller Account.', 'adminkbproductapprovallistcontroller')
                );
            }
        }
    }
    
    
    public function processDelete()
    {
        if (Tools::isSubmit('delete'.$this->table)) {
            $object = new $this->className(Tools::getValue($this->identifier));
            if ($object->delete()) {
                /*
                 * Add all the products in tracking table if no plan is active
                 * tracking table product_status = 1;(if product is active earlier)
                 * product_status = 2;(if product is inactive earlier)
                 */
                $this->processSellerProduct($object->id_seller);
                /*
                 * If no plan is active and approved plans are available then activate the plan
                 * and remove the activated product from tracking table
                 */
                $this->kbactivateMembershipPlanIfAvailable($object->id_seller);
                
                $this->context->cookie->__set(
                    'kb_redirect_success',
                    $this->module->l('Selected Membership Plan has been deleted Successfully.', 'AdminKbMembershipSellerPlanDetailController')
                );
                $this->redirect_after = self::$currentIndex . '&id_seller='.(int) $object->id_seller.'&token=' . $this->token;
            } else {
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('Not able to delete the selected membership order.', 'AdminKbMembershipSellerPlanDetailController')
                );
                $this->redirect_after = self::$currentIndex . '&id_seller='.(int) $object->id_seller.'&token=' . $this->token;
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
            KbMemberShipPlanOrder::addSellerProductInTrackingTable($id_seller);
        }
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
    
    public function postProcess()
    {
        if (Tools::isSubmit('activatekbmp_membership_plan_order')) {
            $this->processActivateMembershipPlanOrder();
        }
        parent::postProcess();
    }
    
    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addCss($this->getKbModuleDir() . 'views/css/admin/kb_admin.css');
        $this->addJS($this->getKbModuleDir() . 'views/js/admin/kb-marketplace-membership-seller-plan-form.js');
        $this->addJS($this->getKbModuleDir() . 'views/js/front/velovalidation.js');
    }
}
