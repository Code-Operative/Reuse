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

class AdminKbMembershipSellerPlansController extends AdminKbMarketplaceCoreController
{
    public $all_languages = array();
    public $error_flag = false;
    private $max_image_size = null;
    private $module_name = 'kbmarketplace';
    public $img_size_limit = 5000;
    public $imageType = 'jpg';
    public $img_formats = array('jpeg', 'png', 'jpg', 'gif');
    protected $position_identifier = 'id_kbmp_membership_plan';
    
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'kb_mp_seller';
        $this->className = 'KbMemberShipPlanOrder';
        $this->identifier = 'id_seller';
        $this->deleted = false;
        $this->lang = false;
        $this->display = 'list';
        parent::__construct();

        $this->fields_list = array(
            'id_seller' => array(
                'title' => $this->module->l('ID', 'AdminKbMembershipSellerPlansController'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'firstname' => array(
                'title' => $this->module->l('First Name', 'AdminKbMembershipSellerPlansController'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'c!firstname',
            ),
            'lastname' => array(
                'title' => $this->module->l('Last Name', 'AdminKbMembershipSellerPlansController'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'c!lastname',
            ),
            'email' => array(
                'title' => $this->module->l('Email', 'AdminKbMembershipSellerPlansController'),
                'havingFilter' => true,
                'filter_key' => 'c!email',
                'search' => true
            ),
            'title' => array(
                'title' => $this->module->l('Shop', 'AdminKbMembershipSellerPlansController'),
                'havingFilter' => true,
                'filter_key' => 'sl!title',
                'order_key' => 'sl.title',
            ),
            'pending_request' => array(
                'title' => $this->module->l('Pending Request', 'AdminKbMembershipSellerPlansController'),
                'search' => false,
                'align' => 'center',
                'class' => 'fixed-width-sm',
                'callback' => 'getPendingRequest'
            ),
        );

        
        $id_shop = Shop::isFeatureActive() && Shop::getContext() == Shop::CONTEXT_SHOP
            ? (int)$this->context->shop->id : 'p.id_shop_default';
         $this->_select = '
			a.active, sl.title,
			c.`firstname`, c.`lastname`, c.`email`, 
			a.date_upd,a.id_seller as pending_request ';

        $this->_join = '
                        LEFT JOIN `' . _DB_PREFIX_ . 'kb_mp_seller_lang` sl ON (a.`id_seller` = sl.`id_seller` 
			AND sl.id_lang = ' . (int)$this->context->language->id . ') 
			LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = a.`id_customer`)';
        
        $this->_orderBy = 'id_seller';
        $this->_orderWay = 'ASC';
        $this->toolbar_title = $this->module->l('Sellers Plan Detail', 'adminkbmembershipsellerplanscontroller');
        $this->addRowAction('view');
        $this->bulk_actions = array();
    }
    
    public function getPendingRequest($id_row, $row_data)
    {
        $count_pending_order = 0;
        $count_pending_order = KbMemberShipPlanOrder::getPendingOrdersByIdSeller($id_row);
        return $count_pending_order;
    }
    
    public function displayViewLink($token = null, $id = null, $name = null)
    {
        unset($name);
        $count_membership_order = 0;
        $count_membership_order = KbMemberShipPlanOrder::getMembershipOrdersByIdSeller($id);
        
        if ($count_membership_order == 0) {
            return;
        } else {
            $tpl = $this->custom_smarty->createTemplate('list_action_view_plan.tpl');

            $tpl->assign(array(
                'href' => $this->context->link->getAdminlink('AdminKbMembershipSellerPlanDetail') . '&id_seller=' . $id,
                'action' => $this->module->l('View', 'AdminKbMembershipSellerPlansController')
            ));
            return $tpl->fetch();
        }
    }
    
    public function postProcess()
    {
        parent::postProcess();
    }
    
    public function processAdd()
    {
        if (Tools::isSubmit('submitAddkb_mp_seller')) {
            $approved = Tools::getValue('approved');
            $activate = Tools::getValue('activate');
            if ((int)Tools::getValue('is_customize', 0) == 1) {
                $id_membership_plan = 0;
                $plan_name = Tools::getValue('title');
                $plan_duration = Tools::getValue('plan_duration');
                $plan_duration_type = Tools::getValue('plan_duration_type');
                $is_enabled_product_limit = Tools::getValue('is_enabled_product_limit');
                $product_limit = 0;
                if ($is_enabled_product_limit) {
                    $product_limit = Tools::getValue('product_limit');
                }
            } else {
                $id_membership_plan = (int) Tools::getValue('plan_id');
                $kbmp_pro_obj = new KbMpMemberShipPlan((int) Tools::getValue('plan_id'));
                $prod_obj = new Product((int)$kbmp_pro_obj->id_product);
                $plan_name = $prod_obj->name[Context::getContext()->language->id];
                $plan_duration = $kbmp_pro_obj->plan_duration;
                $plan_duration_type = $kbmp_pro_obj->plan_duration_type;
                $is_enabled_product_limit = $kbmp_pro_obj->is_enabled_product_limit;
                $product_limit = 0;
                if ($is_enabled_product_limit) {
                    $product_limit = $kbmp_pro_obj->product_limit;
                }
            }
            $sellers_array = Tools::getValue('kbmp_sellers');
            if (is_array($sellers_array) && count($sellers_array) > 0) {
                foreach ($sellers_array as $key => $id_seller) {
                    $kbmp_order_obj = new KbMemberShipPlanOrder();
                    $kbmp_order_obj->id_cart = 0;
                    $kbmp_order_obj->id_order = 0;
                    $kbmp_order_obj->id_order_detail = 0;
                    $kbmp_order_obj->plan_duration = $plan_duration;

                    $kbmp_order_obj->plan_name = $plan_name;

                    $kbmp_order_obj->plan_duration_type = $plan_duration_type;
                    $kbmp_order_obj->is_enabled_product_limit = $is_enabled_product_limit;

                    $kbmp_order_obj->product_limit = $product_limit;

                    $kbmp_order_obj->id_seller = $id_seller;

                    $kbmp_order_obj->id_kbmp_membership_plan = $id_membership_plan;

                    $kbmp_order_obj->is_paid = 1;
                    if ($activate == 1) {
                        $kbmp_order_obj->status = 1;
                    } else {
                        if ($approved) {
                            $kbmp_order_obj->status = 1;
                        } else {
                            $kbmp_order_obj->status = 0;
                        }
                    }
                    $kbmp_order_obj->id_shop = Context::getContext()->shop->id;
                    $kbmp_order_obj->quantity = 1;
                    if ($kbmp_order_obj->save()) {
                        if ($activate == 1) {
                            KbMemberShipPlanOrder::activateMemberShipPlan($id_seller, $kbmp_order_obj->id);
                        }
                    }
                }
                $this->context->cookie->__set(
                    'kb_redirect_success',
                    $this->module->l('Membership Plan added succesfully.', 'AdminKbMembershipSellerPlansController')
                );
                $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
            } else {
                $this->context->cookie->__set(
                    'kb_redirect_success',
                    $this->module->l('There are some errors in the form.', 'AdminKbMembershipSellerPlansController')
                );
                $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
            }
        }
    }
    
    public function renderForm()
    {
        $id_lang = $this->context->language->id;
        $default_currency = (int) Configuration::get('PS_CURRENCY_DEFAULT');
        $currency_obj = new Currency($default_currency);
        $duration_intervals = array(
            1 => array(
                'id' => 1,
                'name' =>$this->module->l('Days', 'AdminKbMembershipSellerPlansController'),
            ),
            2 => array(
                'id' => 2,
                'name' => $this->module->l('Months', 'AdminKbMembershipSellerPlansController'),
            ),
            3 => array(
                'id' => 3,
                'name' => $this->module->l('Years', 'AdminKbMembershipSellerPlansController'),
            )
        );
        
        $sellers = array();
        $seller_form_data = array();
        $sellers = KbSeller::getAllSellers();
        if (is_array($sellers) && count($sellers) > 0) {
            foreach ($sellers as $key => $seller_data) {
                $seller_obj = new KbSeller($seller_data['id_seller']);
                $seller_info = $seller_obj->getSellerInfo(Context::getContext()->language->id);
                $seller_form_data[$key]['id_Seller'] = $seller_info['id_seller'];
                $seller_form_data[$key]['title'] = $seller_info['title'] . '  (' . $seller_info['email'] . ')';
            }
        }
        
        $membership_plans = KbMpMemberShipPlan::getMemberShipPlansAdmin();
        
        if (is_array($membership_plans) && count($membership_plans) > 0) {
            foreach ($membership_plans as $key => $membership_plan_data) {
                $membership_plans[$key]['id_plan'] = $membership_plan_data['id_kbmp_membership_plan'];
                $membership_plans[$key]['name'] = $membership_plan_data['name'];
            }
        }
        
        $this->fields_form = array(
                'legend' => array(
                    'title' => $this->module->l('Membership Plan Form', 'AdminKbMembershipSellerPlansController'),
                    'icon' => 'icon-envelope'
                ),
                'input' => array(
                    array(
                        'type' => 'select',
                        'label' => $this->l('Choose Sellers'),
                        'name' => 'kbmp_sellers[]',
                        'multiple' => 'multiple',
                        'hint' => $this->module->l('Select the sellers for whose you want to add the membership plan.', 'AdminKbMembershipSellerPlansController'),
                        'desc' => $this->module->l('Select the sellers for whose you want to add the membership plan.', 'AdminKbMembershipSellerPlansController'),
                        'id' => version_compare(_PS_VERSION_, '1.6.0.7', '>') ? 'multiple-select-pages' : 'multiple-select-chosen-pages',
                        'class' => 'chosen',
                        'options' => array(
                            'query' => $seller_form_data,
                            'id' => 'id_Seller',
                            'name' => 'title'
                        ),
                    ),
                    
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Add customize plan', 'AdminKbMembershipSellerPlansController'),
                        'name' => 'is_customize',
                        'required' => false,
                        'class' => 't',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'is_customize_on',
                                'value' => 1,
                                'label' => $this->module->l('Yes', 'AdminKbMembershipSellerPlansController')
                            ),
                            array(
                                'id' => 'is_customize_off',
                                'value' => 0,
                                'label' => $this->module->l('No', 'AdminKbMembershipSellerPlansController')
                            )
                        ),
                        'hint' => $this->module->l('If enabled then admin can customize the plan else admin can select among the added plans.', 'AdminKbMembershipSellerPlansController')
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Select membership plan'),
                        'name' => 'plan_id',
                        'hint' => $this->module->l('Select the membership plan.', 'AdminKbMembershipSellerPlansController'),
                        'desc' => $this->module->l('Select the membership plan', 'AdminKbMembershipSellerPlansController'),
                        'class' => 'chosen',
                        'options' => array(
                            'query' => $membership_plans,
                            'id' => 'id_kbmp_membership_plan',
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Plan Name', 'AdminKbMembershipSellerPlansController'),
                        'name' => 'title',
                        'required' => true,
                        'hint' => $this->module->l('Enter the membership plan name', 'AdminKbMembershipSellerPlansController'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Enable/disable Product Active limit', 'AdminKbMembershipSellerPlansController'),
                        'name' => 'is_enabled_product_limit',
                        'required' => false,
                        'class' => 't',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'is_enabled_product_limit_on',
                                'value' => 1,
                                'label' => $this->module->l('Enabled', 'AdminKbMembershipSellerPlansController')
                            ),
                            array(
                                'id' => 'is_enabled_product_limit_off',
                                'value' => 0,
                                'label' => $this->module->l('Disabled', 'AdminKbMembershipSellerPlansController')
                            )
                        ),
                        'hint' => $this->module->l('If enabled then the set number of products will be active under this membership plan.', 'AdminKbMembershipSellerPlansController')
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Product Limit', 'AdminKbMembershipSellerPlansController'),
                        'name' => 'product_limit',
                        'required' => true,
                        'validation' => 'isInt',
                        'col' => 2,
                        'hint' => $this->module->l('Set maximum number of products that can remain active under this plan', 'AdminKbMembershipSellerPlansController'),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Duration Interval'), // The <label> for this <select> tag.
                        'class' => 'chosen',
                        'required' => true,
                        'hint' => $this->l('Select duration interval for membership plan'),
                        'name' => 'plan_duration_type', // The content of the 'id' attribute of the <select> tag.
                        'options' => array(
                            'query'=> $duration_intervals,
                            'id' =>  'id',
                            'name'=>  'name'
                        )
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Duration', 'AdminKbMembershipSellerPlansController'),
                        'name' => 'plan_duration',
                        'required' => true,
                        'validation' => 'isInt',
                        'col' => 2,
                        'hint' => $this->module->l('Only Numeric values are allowed', 'AdminKbMembershipSellerPlansController'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Mark plan as approved', 'AdminKbMembershipSellerPlansController'),
                        'name' => 'approved',
                        'required' => false,
                        'values' => array(
                            array(
                                'value' => 1
                            ),
                            array(
                                'value' => 0
                            )
                        ),
                        'hint' => $this->module->l('Select yes if want to approve the plan', 'AdminKbMembershipSellerPlansController')
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Activate Plan', 'AdminKbMembershipSellerPlansController'),
                        'name' => 'activate',
                        'required' => false,
                        'values' => array(
                            array(
                                'value' => 1
                            ),
                            array(
                                'value' => 0
                            )
                        ),
                        'hint' => $this->module->l('Select yes if want to activate the plan right now', 'AdminKbMembershipSellerPlansController')
                    ),
                ),
                'buttons' => array(
                    array(
                        'title' => $this->module->l('Save', 'AdminKbMembershipSellerPlansController'),
                        'type' => 'submit',
                        'icon' => 'process-icon-save',
                        'class' => 'pull-right',
                        'name' => 'submitAddSellerPlan',
                    ),
                )
            );
        
        $this->show_form_cancel_button = true;

        $tpl = $this->custom_smarty->createTemplate('membership_plan_form.tpl');
        
        return $tpl->fetch().parent::renderForm();
    }
    
    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addCss($this->getKbModuleDir() . 'views/css/admin/kb_admin.css');
        $this->addJS($this->getKbModuleDir() . 'views/js/admin/kb-marketplace-membership-seller-plan-form.js');
        $this->addJS($this->getKbModuleDir() . 'views/js/front/velovalidation.js');
    }
    
    public function initPageHeaderToolbar()
    {
        $this->page_header_toolbar_btn['new_template'] = array(
            'href' => self::$currentIndex . '&add' . $this->table . '&token=' . $this->token,
            'desc' => $this->module->l('Add new', 'AdminKbMembershipSellerPlansController'),
            'icon' => 'process-icon-new'
        );


        parent::initPageHeaderToolbar();
    }
}
