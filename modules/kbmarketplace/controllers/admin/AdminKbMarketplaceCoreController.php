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

require_once(_PS_MODULE_DIR_ . 'kbmarketplace/libraries/kbmarketplace/KbGlobal.php');

class AdminKbMarketplaceCoreController extends ModuleAdminControllerCore
{
    protected $kb_module_name = 'kbmarketplace';
    public $bootstrap = true;
    public $kbtemplate = 'not_found_page.tpl';
    public $custom_smarty;
    protected $approval_statuses = array();
    protected $statuses = array();
    protected $render_ajax_html = false;

    public function __construct()
    {
        $this->allow_export = true;
        $this->approval_statuses = KbGlobal::getApporvalStatus();
        $this->statuses = KbGlobal::getStatuses();
        $this->context = Context::getContext();
        $this->list_no_link = true;
        $this->custom_smarty = new Smarty();
        $this->custom_smarty->setCompileDir(_PS_CACHE_DIR_ . 'smarty/compile');
        $this->custom_smarty->setCacheDir(_PS_CACHE_DIR_ . 'smarty/cache');
        $this->custom_smarty->use_sub_dirs = true;
        $this->custom_smarty->setConfigDir(_PS_SMARTY_DIR_ . 'configs');
        $this->custom_smarty->caching = false;
        $this->custom_smarty->registerPlugin('function', 'l', 'smartyTranslate');
        $this->custom_smarty->setTemplateDir(_PS_MODULE_DIR_ . $this->kb_module_name . '/views/templates/admin/');

        parent::__construct();
    }

    public function initProcess()
    {
        parent::initProcess();
        $this->object = new $this->className(Tools::getValue($this->identifier));
    }

    public function processFilter()
    {
        parent::processFilter();
        $prefix = str_replace(array('admin', 'controller'), '', Tools::strtolower(get_class($this)));
        $filters = $this->context->cookie->getFamily($prefix . $this->list_id . 'Filter_');
        $has_active_filter = false;
        $value = 1;
        $active_filter_key = $this->list_id . 'Filter_active';
        if (isset($filters[$prefix . $this->list_id . 'Filter_active'])) {
            $value = $filters[$prefix . $this->list_id . 'Filter_active'];
            $has_active_filter = true;
        } elseif (Tools::getIsset($active_filter_key)) {
            $value = Tools::getValue($active_filter_key);
            $has_active_filter = true;
        }

        if ($has_active_filter) {
            if (isset($this->fields_list['active']['filter_key'])) {
                $key = $this->fields_list['active']['filter_key'];
                $this->_filter = str_replace(' AND a.`active` = ' . $value . ' ', '', $this->_filter);
                $this->_filter = str_replace(' AND a.`active` = ' . $value . ' ', '', $this->_filter);
                $this->_filter = str_replace(' AND a.active = ' . $value . ' ', '', $this->_filter);
                $this->_filter = str_replace(' AND `a.active` = ' . $value . ' ', '', $this->_filter);
                $tmp_tab = explode('!', $key);
                $key = isset($tmp_tab[1]) ? $tmp_tab[0] . '.`' . $tmp_tab[1] . '`' : '`' . $tmp_tab[0] . '`';
                $this->_filter .= ' AND ' . $key . ' = ' . $value . ' ';
            }
        }
    }

    public function postProcess()
    {
        parent::postProcess();

        if (Tools::isSubmit('ajax')) {
            $return = null;
            Hook::exec('actionAjaxKbAdmin' . Tools::ucfirst($this->action) . 'Before', array('controller' => $this));
            Hook::exec(
                'actionAjaxKb' . get_class($this) . Tools::ucfirst($this->action) . 'Before',
                array('controller' => $this)
            );
            if (Tools::getIsset('ajaxView' . $this->table)) {
                if (method_exists($this, 'processKbAjaxView')) {
                    $return = $this->processKbAjaxView();
                }
            } elseif (Tools::isSubmit('action')) {
                $this->action = Tools::getValue('action');
                if (!empty($this->action)
                    && method_exists($this, 'ajaxKbProcess' . Tools::toCamelCase($this->action))) {
                    $return = $this->{'ajaxKbProcess' . Tools::toCamelCase($this->action)}();
                }
            }
            Hook::exec(
                'actionAjaxKbAdmin' . Tools::ucfirst($this->action) . 'After',
                array('controller' => $this,'return' => $return)
            );
            Hook::exec(
                'actionAjaxKb' . get_class($this) . Tools::ucfirst($this->action) . 'After',
                array('controller' => $this, 'return' => $return)
            );
            if ($this->render_ajax_html) {
                echo $return;
            } else {
                echo Tools::jsonEncode($return);
            }
            die;
        }
    }

    public function initContent()
    {
        if (isset($this->context->cookie->kb_redirect_error)) {
            $this->errors[] = $this->context->cookie->kb_redirect_error;
            unset($this->context->cookie->kb_redirect_error);
        }

        if (isset($this->context->cookie->kb_redirect_success)) {
            $this->confirmations[] = $this->context->cookie->kb_redirect_success;
            unset($this->context->cookie->kb_redirect_success);
        }
        parent::initContent();
    }

    public function renderView()
    {
        return parent::renderView();
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addCSS($this->getKbModuleDir() . 'views/css/admin/kb-marketplace.css');
        $this->addJS($this->getKbModuleDir() . 'views/js/admin/kb-marketplace.js');
        $this->addJS($this->getKbModuleDir() . 'views/js/admin/kb_membership_general_setting.js');
    }

    public function init()
    {
        parent::init();
    }

    protected function getKbModuleDir()
    {
        return _PS_MODULE_DIR_ . $this->kb_module_name . '/';
    }

    /*
     * render seller account approval status
     */

    public function showApprovedStatus($id_row, $tr)
    {
        unset($id_row);
        return $this->approval_statuses[$tr['approved']];
    }

    /**
     * Display account approval link link
     */
    public function displayApproveLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

        $tpl->assign(array(
            'approve_conf' => $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'),
            'display_confirm_popup' => true,
            'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&approve'
            . $this->table . '&token=' . ($token != null ? $token : $this->token),
            'action' => $this->module->l('Approve', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-check'
        ));

        $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

        return $tpl->fetch();
    }
    
    /*
     * function to display the Approve link in the helper list of Close Shop request table
     * MK made changes on 30-05-18
     */
    public function displayApproverequestLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $tpl = $this->custom_smarty->createTemplate('list_action.tpl');
        $request_status = Db::getInstance()->getValue('SELECT approved from '._DB_PREFIX_.'kb_mp_seller_shop_close_request where id_request='.(int)$id);
        if ($request_status != '0') {
            return;
        }
        $tpl->assign(array(
            'display_confirm_popup' => true,
            'href' => AdminController::$currentIndex.'&'.$this->identifier.'='.$id.'&approve'
            .$this->table.'&token='.($token != null ? $token : $this->token),
            'action' => $this->module->l('Approve', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-check'
        ));
        
        $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve the request?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

        return $tpl->fetch();
    }

    /**
     * Display disapproval link
     */
    public function displayDisapproveLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

        $tpl->assign(array(
            'disapprove_conf' => $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'),
            'display_popup' => true,
            'popup_show' => true,
            'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&dissapprove'
            . $this->table . '&token=' . ($token != null ? $token : $this->token),
            'action' => $this->module->l('Disapprove', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-times'
        ));
        $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));
        
        return $tpl->fetch();
    }

    /*
     * changes by rishabh jain on 6th sep to displaydisappprove link
     * Display disapproval link, approval link only if status is pending otherwise return ''
     */
    public function displayApproveReviewLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $object = new KbSellerProductReview($id);
        $sql = "SELECT current_status FROM " . _DB_PREFIX_ . "velsof_product_reviews WHERE review_id = '" . (int) $object->id_product_comment ."'" ;
        $current_status = Db::getInstance()->getValue($sql);
        if ($current_status == 3) {
            $tpl = $this->custom_smarty->createTemplate('list_action.tpl');
            $tpl->assign(array(
                'approve_conf' => $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'),
                'display_confirm_popup' => true,
                'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&approve'
                . $this->table . '&token=' . ($token != null ? $token : $this->token),
                'action' => $this->module->l('Approve', 'adminkbmarketplacecorecontroller'),
                'icon' => 'icon-check'
            ));
            $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

            return $tpl->fetch();
        } else {
            return '';
        }
    }
    /*
     * changes by rishabh jain on 6th sep to displaydisappprove link
     * Display disapproval link only if status is pending otherwise return ''
     */
    
    public function displayDisapproveReviewLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $object = new KbSellerProductReview($id);
        $sql = "SELECT current_status FROM " . _DB_PREFIX_ . "velsof_product_reviews WHERE review_id = '" . (int) $object->id_product_comment ."'" ;
        $current_status = Db::getInstance()->getValue($sql);
        if ($current_status == 3) {
            $tpl = $this->custom_smarty->createTemplate('review_disapprove_action.tpl');
            $tpl->assign(array(
                'disapprove_conf' => $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'),
                'display_popup' => true,
                'popup_show' => true,
                'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&dissapprove'
                . $this->table . '&token=' . ($token != null ? $token : $this->token),
                'action' => $this->module->l('Disapprove', 'adminkbmarketplacecorecontroller'),
                'icon' => 'icon-times'
            ));
            $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));
            return $tpl->fetch();
        } else {
            return '';
        }
    }
    
    /*
     *  To dispaly seller category commission page link
     */
    public function displayEditCommissionLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $tpl = $this->custom_smarty->createTemplate('edit_seller_category_commission.tpl');
        $tpl->assign(array(
            'display_popup' => false,
            'popup_show' => false,
            'href' => $this->context->link->getAdminLink('AdminKbCategoryWiseCommission'). '&' . $this->identifier . '=' . $id,
            'action' => $this->module->l('Edit Category wise Commission', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-pencil'
        ));
        return $tpl->fetch();
    }
    /**
     * Display disapproval link
     */
    public function displayDisapproveApprovalProductLink($token = null, $id = 0, $name = null)
    {
        
        $id_seller_product = Db::getInstance()->getRow(
            'Select id_seller_product from ' . _DB_PREFIX_ . 'kb_mp_seller_product'
            . ' where id_product = ' . (int) $id
        );
        $seller_product = new KbSellerProduct($id_seller_product['id_seller_product']);
        if ($seller_product->approved != 2 && !empty($seller_product)) {
            unset($name);
            $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

            $tpl->assign(array(
                'disapprove_conf' => $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'),
                'display_popup' => true,
                'popup_show' => true,
                'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&dissapprove'
                . $this->table . '&token=' . ($token != null ? $token : $this->token),
                'action' => $this->module->l('Disapprove', 'adminkbmarketplacecorecontroller'),
                'icon' => 'icon-times'
            ));
            $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

            return $tpl->fetch();
        }
    }
    
    public function displayDisapproveSellerAccountLink($token = null, $id = 0, $name = null)
    {
        $seller = new KbSeller($id);
        if ($seller->approved != 2 && !empty($seller)) {
            unset($name);
            $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

            $tpl->assign(array(
                'disapprove_conf' => $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'),
                'display_popup' => true,
                'popup_show' => true,
                'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&dissapprove'
                . $this->table . '&token=' . ($token != null ? $token : $this->token),
                'action' => $this->module->l('Disapprove', 'adminkbmarketplacecorecontroller'),
                'icon' => 'icon-times'
            ));
            $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

            return $tpl->fetch();
        }
    }
    
    public function displayDisapproveSCategoryRequestLink($token = null, $id = 0, $name = null)
    {
        $seller = new KbSellerCRequest($id);
        if ($seller->approved != 2 && !empty($seller)) {
            unset($name);
            $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

            $tpl->assign(array(
                'disapprove_conf' => $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'),
                'display_popup' => true,
                'popup_show' => true,
                'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&dissapprove'
                . $this->table . '&token=' . ($token != null ? $token : $this->token),
                'action' => $this->module->l('Disapprove', 'adminkbmarketplacecorecontroller'),
                'icon' => 'icon-times'
            ));
            $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

            return $tpl->fetch();
        }
    }
    
    public function displayDisapproveSellerReviewLink($token = null, $id = 0, $name = null)
    {
        $seller = new KbSellerReview($id);
        if ($seller->approved != 2 && !empty($seller)) {
            unset($name);
            $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

            $tpl->assign(array(
                'disapprove_conf' => $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'),
                'display_popup' => true,
                'popup_show' => true,
                'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&dissapprove'
                . $this->table . '&token=' . ($token != null ? $token : $this->token),
                'action' => $this->module->l('Disapprove', 'adminkbmarketplacecorecontroller'),
                'icon' => 'icon-times'
            ));
            $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

            return $tpl->fetch();
        }
    }

    /**
     * Display Delete link with reason popup
     */
    public function displayDeleteLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

        $tpl->assign(array(
            'delete_conf' => $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'),
            'display_popup' => true,
            'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&delete'
            . $this->table . '&token=' . ($token != null ? $token : $this->token),
            'action' => $this->module->l('Delete', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-trash'
        ));
        $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

        return $tpl->fetch();
    }

    /**
     * Display Delete link with reason popup
     */
    public function displayDeleteWReasonLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

        $tpl->assign(array(
            'delete_conf' => $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'),
            'display_popup' => false,
            'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&delete'
            . $this->table . '&token=' . ($token != null ? $token : $this->token),
            'action' => $this->module->l('Delete', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-trash'
        ));
        $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

        return $tpl->fetch();
    }

    /**
     * Display view popup link
     */
    public function displayViewModalLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $tpl = $this->custom_smarty->createTemplate('list_action_view.tpl');
        $tpl->assign(array(
            'display_popup' => true,
            'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&ajaxView'
            . $this->table . '&token=' . ($token != null ? $token : $this->token),
            'action' => $this->module->l('View', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-search-plus'
        ));

        return $tpl->fetch();
    }
    
    public function displayDisapprovetransactionLink($token = null, $id = 0, $name = null)
    {
        /*Start -MK made changes on 27-08-18 to display button only if payout item id is empty*/
        $seller = new KbSellerTransactionRequest($id);
        if ($seller->payout_item_id != '') {
            return;
        }
        /*end -MK made changes on 27-08-18 to display button only if payout item id is empty*/
        if ($seller->approved != 2 && !empty($seller)) {
            unset($name);
            $tpl = $this->custom_smarty->createTemplate('list_action.tpl');

            $tpl->assign(array(
                'display_popup' => true,
                'popup_show' => true,
                'href' => AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&dissapprove'
                . $this->table . '&token=' . ($token != null ? $token : $this->token),
                'action' => $this->module->l('Disapprove', 'adminkbmarketplacecorecontroller'),
                'icon' => 'icon-times'
            ));
            $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
            $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));


            return $tpl->fetch();
        }
    }
    
    /*
     * Display Approve transaction popup link
     */
    public function displayApprovetransactionLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        /*Start -MK made changes on 27-08-18 to display button only if payout item id is empty*/
        $payout = new KbSellerTransactionRequest($id);
        if ($payout->payout_item_id != '') {
            return;
        }
        /*End-MK made changes on 27-08-18 to display button only if payout item id is empty*/
        $tpl = $this->custom_smarty->createTemplate('list_action_view.tpl');
        $tpl->assign(array(
            'display_popup' => true,
            'href' => AdminController::$currentIndex.'&'.$this->identifier.'='.$id.'&ajaxView'
            .$this->table.'&token='.($token != null ? $token : $this->token),
            'action' => $this->module->l('Approve', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-check'
        ));

        return $tpl->fetch();
    }
    
    /*
     * Display Approve transaction popup link
     * MK made changes on 27-08-18 to add link to process payout in the transaction payout table
     */
    public function displayUpdatePayouttransactionLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $payout = new KbSellerTransactionRequest($id);
        if ($payout->payout_item_id == '') {
            return;
        }
        if (!empty($payout->payout_status) &&
            ($payout->payout_status == 'DENIED' ||
            $payout->payout_status == 'SUCCESS' ||
            $payout->payout_status == 'CANCELED')) {
            return;
        }
        $tpl = $this->custom_smarty->createTemplate('list_action_view.tpl');
        $tpl->assign(array(
            'updatePayouttransaction' => true,
            'href' => $this->context->link->getModuleLink($this->module->name, 'cron', array('action' => 'processPayoutState', 'id_seller_transaction'=> $id,'secure_key' => Configuration::get('KB_MP_CRON'))),
            'action' => $this->module->l('Process Payout Status', 'adminkbmarketplacecorecontroller'),
            'target' => '_blank',
            'icon' => 'icon-refresh'
        ));

        return $tpl->fetch();
    }

    /**
     * Display link to view seller detail
     */
    public function displayViewSellerLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        unset($token);
        $tpl = $this->custom_smarty->createTemplate('list_action.tpl');
        $row = new KbSeller($id);
        $tpl->assign(array(
            'separate_tab' => true,
            'href' => $this->context->link->getAdminLink('AdminCustomers')
            . '&updatecustomer&id_customer=' . $row->id_customer,
            'action' => $this->module->l('View', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-search-plus'
        ));
        $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

        return $tpl->fetch();
    }

    /**
     * Display link to view seller's product detail
     */
    public function displayViewProductLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        unset($token);
        $tpl = $this->custom_smarty->createTemplate('list_action.tpl');
        $row = new KbSellerProduct($id);
        $admin_product_url = '';
        if ((version_compare(_PS_VERSION_, '1.7.1.0', '<')) || (version_compare(_PS_VERSION_, '1.7.5.999', '>'))) {
            $admin_product_url = $this->context->link->getAdminLink(
                'AdminProducts',
                true,
                array('id_product' => $row->id_product)
            );
        } else {
            $admin_product_url = $this->context->link->getAdminLink(
                'AdminProducts',
                true,
                array('id_product' => $row->id_product),
                array()
            );
        }
        $tpl->assign(array(
            'separate_tab' => true,
            'href' => $admin_product_url,
            'action' => $this->module->l('View', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-search-plus'
        ));
        $tpl->assign('kb_admin_dis_conf', $this->module->l('Do you want to disapprove?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_app_conf', $this->module->l('Do you want to approve?', 'adminkbmarketplacecorecontroller'));
        $tpl->assign('kb_admin_del_conf', $this->module->l('Do you want to delete?', 'adminkbmarketplacecorecontroller'));

        return $tpl->fetch();
    }

    /**
     * Display link to view seller's product approval detail
     */
    public function displayViewApprovalProductLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        unset($token);
        $tpl = $this->custom_smarty->createTemplate('list_action.tpl');
        $admin_product_url = '';
        if ((version_compare(_PS_VERSION_, '1.7.1.0', '<')) || (version_compare(_PS_VERSION_, '1.7.5.999', '>'))) {
            $admin_product_url = $this->context->link->getAdminLink(
                'AdminProducts',
                true,
                array('id_product' => $id)
            );
        } else {
            $admin_product_url = $this->context->link->getAdminLink(
                'AdminProducts',
                true,
                array(),
                array('id_product' => $id)
            );
        }
        $tpl->assign(array(
            'separate_tab' => true,
            'href' => $admin_product_url,
            'action' => $this->module->l('View', 'adminkbmarketplacecorecontroller'),
            'icon' => 'icon-search-plus'
        ));

        return $tpl->fetch();
    }

    /*
     * Render Reason popup modal box template
     */

    public function getReasonPopUpHtml()
    {
        $tpl = $this->custom_smarty->createTemplate('dissapprove_reason_popup.tpl');
        $tpl->assign(array(
            'min_length_msg' => sprintf(
                $this->module->l('Minimum %s characters required.', 'adminkbmarketplacecorecontroller'),
                KbGlobal::REASON_MIN_LENGTH
            ),
            'reson_min_length' => KbGlobal::REASON_MIN_LENGTH,
            'reason_min_length_error' =>
            $this->module->l('Minimum '. KbGlobal::REASON_MIN_LENGTH . ' characters required.', 'adminkbmarketplacecorecontroller'),
            'pop_heading' => $this->module->l('Please provide reason to doing this.', 'adminkbmarketplacecorecontroller'),
            'empty_field_error' => $this->module->l('Required Field', 'adminkbmarketplacecorecontroller'),
            'pop_action_label' => $this->module->l('Submit', 'adminkbmarketplacecorecontroller')
        ));
        return $tpl->fetch();
    }

    /*
     * Display product Final Price
     */

    public function showFinalPrice($id_row, $tr)
    {
        unset($id_row);
        return Product::getPriceStatic($tr['id_product'], true, null, 2, null, false, true, 1, true);
    }

    /*
     * Display active status without clickable
     */

    public function showNonClickableStatus($id_row, $tr)
    {
        unset($id_row);
        if ($tr['active'] == 1) {
            return '<a class="list-action-enable action-enabled" href="javascript:void(0)" 
				title="' . $this->module->l('Enable', 'adminkbmarketplacecorecontroller') . '"><i class="icon-check"></i></a>';
        } else {
            return '<a class="list-action-enable action-disabled" href="javascript:void(0)" 
				title="' . $this->module->l('Disable', 'adminkbmarketplacecorecontroller') . '"><i class="icon-remove"></i></a>';
        }
    }
    
    public function renderList()
    {
        $list = parent::renderList();
        $this->bulk_actions = null;

        return $list;
    }
}
