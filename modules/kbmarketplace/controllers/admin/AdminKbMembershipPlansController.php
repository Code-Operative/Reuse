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

class AdminKbMembershipPlansController extends AdminKbMarketplaceCoreController
{
    public $all_languages = array();
    public $error_flag = false;
    private $max_image_size = null;
    private $module_name = 'kbmarketplace';
    public $duration_type = array();
    public $img_size_limit = 5000;
    public $imageType = 'jpg';
    public $img_formats = array('jpeg', 'png', 'jpg', 'gif');
    protected $position_identifier = 'id_kbmp_membership_plan';
    
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'kbmp_membership_plan';
        $this->className = 'KbMpMemberShipPlan';
        $this->identifier = 'id_kbmp_membership_plan';
        $this->deleted = false;
        $this->lang = false;
        $this->display = 'list';
        $this->all_languages = $this->getAllLanguages();
        parent::__construct();
        
        $this->duration_intervals = array(
            '1' => $this->module->l('Days', 'AdminKbMembershipPlansController'),
            '2' => $this->module->l('Months', 'AdminKbMembershipPlansController'),
            '3' => $this->module->l('Years', 'AdminKbMembershipPlansController')
        );

        $this->fields_list = array(
            'id_kbmp_membership_plan' => array(
                'title' => $this->module->l('ID', 'AdminKbMembershipPlansController'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs',
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'a!id_kbmp_membership_plan',
            ),
            'id_image' => array(
                'title' => $this->module->l('Image', 'AdminKbMembershipPlansController'),
                'orderby' => false,
                'filter' => false,
                'search' => false,
                'callback' => 'showCoverImage'
            ),
            'id_product' => array(
                'title' => $this->module->l('Prestashop product Id', 'AdminKbMembershipPlansController'),
                'havingFilter' => true,
                'align' => 'center',
                'search' => true,
                'filter_key' => 'a!id_product',
                'callback' => 'showProductAdminUrl'
            ),
            'title' => array(
                'title' => $this->module->l('Plan Name', 'AdminKbMembershipPlansController'),
                'havingFilter' => true,
                'search' => true,
                'align' => 'center',
                'filter_key' => 'pl!name',
            ),
            'price' => array(
                'title' => $this->module->l('Plan Price', 'AdminKbMembershipPlansController'),
                'havingFilter' => false,
                'search' => false,
                'align' => 'center',
                'callback' => 'showPlanPrice',
                
            ),
            'plan_duration' => array(
                'title' => $this->module->l('Plan Duration', 'AdminKbMembershipPlansController'),
                'havingFilter' => false,
                'search' => false,
                'align' => 'center',
                'callback' => 'showPlanDuration',
            ),
            'product_limit' => array(
                'title' => $this->module->l('Product Limit', 'AdminKbMembershipPlansController'),
                'havingFilter' => true,
                'search' => true,
                'align' => 'center',
                'callback' => 'showProductLimit',
                'filter_key' => 'a!product_limit',
            ),
            'active' => array(
                'title' => $this->module->l('Active', 'AdminKbMembershipPlansController'),
                'active' => 'status',
                'filter_key' => 'a!active',
                'order_key' => 'a.active',
                'align' => 'text-center',
                'type' => 'bool',
                'class' => 'fixed-width-sm',
                'orderby' => false
            ),
            'position' => array(
                'title' => $this->module->l('Sort Order', 'AdminKbMembershipPlansController'),
                'filter_key' => 'position',
                'search' => false,
                'align' => 'center',
                'class' => 'fixed-width-sm',
                'position' => 'position',
            ),
        );

        $alias_image = 'image_shop';

        $this->_select .= 'pl.name as title,p.price as price,a.id_product as id_image';

        
        $id_shop = Shop::isFeatureActive() && Shop::getContext() == Shop::CONTEXT_SHOP
            ? (int)$this->context->shop->id : 'p.id_shop_default';

        $this->_join .= '
		INNER JOIN ' . _DB_PREFIX_ . 'product as p on (a.id_product = p.id_product) 
		INNER JOIN `' . _DB_PREFIX_ . 'product_shop` sa ON (p.`id_product` = sa.`id_product` 
			AND sa.id_shop = ' . $id_shop . ') 
		INNER JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (p.`id_product` = pl.`id_product` 
			AND sa.id_shop = ' . $id_shop . ' AND pl.id_lang = ' . (int)$this->context->language->id . ')';
        $this->_orderBy = 'position';
        $this->_orderWay = 'ASC';
        $this->toolbar_title = $this->module->l('MemberShip Plans', 'AdminKbMembershipPlansController');
        $this->addRowAction('edit');
        $this->addRowAction('deletewreason');
        $this->bulk_actions = array();
    }
    
    
    public function displayDeleteWReasonLink($token = null, $id = 0, $name = null)
    {
        $free_membership_plan_id = KbMpMemberShipPlan::getFreeMembershipPlanID();
        if ($id == $free_membership_plan_id) {
            return ;
        } else {
            return parent::displayDeleteWReasonLink($token, $id, $name);
        }
    }
    
    public function displayEditLink($token = null, $id = 0, $name = null)
    {
        unset($name);
        $free_membership_plan_id = KbMpMemberShipPlan::getFreeMembershipPlanID();
        if ($id == $free_membership_plan_id) {
            return ;
        } else {
            $tpl = $this->custom_smarty->createTemplate('list_action_edit.tpl');
            $href = AdminController::$currentIndex . '&' . $this->identifier . '=' . $id . '&update' . $this->table. '&token=' . ($token != null ? $token : $this->token);
            $tpl->assign(array(
                'href' => $href,
                'action' => $this->module->l('Edit', 'AdminKbMembershipPlansController'),
                'id' => $id,
            ));
            return $tpl->fetch();
        }
    }
    
    public function showCoverImage($id_row, $row_data)
    {
        $path_to_image = false;
        $id_product = 0;
        if (!empty($row_data['id_product'])) {
            $id_product = $row_data['id_product'];
            $product_obj = new Product($row_data['id_product']);
            $image = Image::getCover($row_data['id_product']);
            $link = new Link;
            if ($this->checkSecureUrl()) {
                $image_link = $image ? 'https://'.$link->getImageLink($product_obj->link_rewrite[$this->context->language->id], $image['id_image'], ImageType::getFormattedName('home')) : false;
            } else {
                $image_link = $image ? 'http://'.$link->getImageLink($product_obj->link_rewrite[$this->context->language->id], $image['id_image'], ImageType::getFormattedName('home')) : false;
            }
            if ($image_link == '') {
                $image_link = $this->getDefaultMembershipPlanImageURL();
            }

            $admin_product_url = $this->context->link->getAdminLink(
                'AdminProducts',
                true,
                array('id_product' => $id_product)
            );
            return '<a href="'.$admin_product_url.'" target="_blank"><img src="'.$image_link.'" height="75px" width="75px"></a>';
        }
    }
    
    // Function to update Rule positions
    public function ajaxProcessUpdateRulesPositions()
    {
        $response_array = array();
        $id_rule = (int)Tools::getValue('id');
        $way = (int) Tools::getValue('way');
        $positions = Tools::getValue('kbmp_membership_plan');

        foreach ($positions as $position => $value) {
            $pos = explode('_', $value);
            if (isset($pos[2]) && (int) $pos[2] === $id_rule) {
                if ($membership_plan_obj = new KbMpMemberShipPlan((int) $pos[2])) {
                    if (isset($position) && $membership_plan_obj->updateRulePosition($way, $position)) {
                        $response_array['success'] = true;
                    } else {
                        $response_array['hasError'] = true;
                        $response_array['errors'] = $this->module->l('Plan Position Could not be updated.', 'AdminKbMembershipPlansController');
                    }
                } else {
                    $response_array['hasError'] = true;
                    $response_array['errors'] = $this->module->l('Pan Object Could not be loaded.', 'AdminKbMembershipPlansController');
                }
            }
        }
        return $response_array;
    }
    
    /** Callback function to admin product edit in the helper list */
    public function showProductAdminUrl($data, $row_data)
    {
        return "<a target='_blank' href='" . $this->context->link->getAdminlink('AdminProducts', true, array("id_product" => $row_data['id_product'])) . "'>" . $data . "</a>";
    }
    
    public function showPlanPrice($id_row, $tr)
    {
        return Tools::displayPrice($id_row);
    }
    
    public function showProductLimit($id_row, $tr)
    {
        if ($id_row == 0 && $tr['is_enabled_product_limit'] == 0) {
            return 'NA';
        } else {
            return $id_row;
        }
    }
    
    public function postProcess()
    {
        if (Tools::isSubmit('action') && Tools::getValue('action') == 'updatePositions') {
            $json = $this->ajaxProcessUpdateRulesPositions();
            if (isset($json['success'])) {
                die(true);
            }
        }
        parent::postProcess();
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addCss($this->getKbModuleDir() . 'views/css/admin/kb_admin.css');
        $this->addJS($this->getKbModuleDir() . 'views/js/admin/marketplace-membership-plan-form.js');
        $this->addJS($this->getKbModuleDir() . 'views/js/front/velovalidation.js');
    }

    public function initContent()
    {
        parent::initContent();
    }

    public function renderForm()
    {
        $id_lang = $this->context->language->id;
        $default_currency = (int) Configuration::get('PS_CURRENCY_DEFAULT');
        $currency_obj = new Currency($default_currency);
        $duration_intervals = array(
            1 => array(
                'id' => 1,
                'name' =>$this->module->l('Days', 'AdminKbMembershipPlansController'),
            ),
            2 => array(
                'id' => 2,
                'name' => $this->module->l('Months', 'AdminKbMembershipPlansController'),
            ),
            3 => array(
                'id' => 3,
                'name' => $this->module->l('Years', 'AdminKbMembershipPlansController'),
            )
        );
        
        $plan_image = $this->getDefaultMembershipPlanImageURL();
        
        if (Tools::getValue('id_kbmp_membership_plan', 0) == 0) {
            $this->fields_value = array();
        } else {
            $obj = $this->loadObject(true);
            $prod_obj = new Product((int)$obj->id_product);
            $this->fields_value = array(
                'id_product' => $obj->id_product,
                'title' => $prod_obj->name,
                'active' => $obj->active,
                'plan_duration' => $obj->plan_duration,
                'plan_duration_type' => $obj->plan_duration_type,
                'product_limit' => $obj->product_limit,
                'is_enabled_product_limit' => $obj->is_enabled_product_limit,
                'plan_price' => Tools::ps_round($prod_obj->price, 4),
            );
            
            $image = Image::getCover($obj->id_product);
            $link = new Link;
            if ($this->checkSecureUrl()) {
                $plan_image = $image ? 'https://'.$link->getImageLink($prod_obj->link_rewrite[$this->context->language->id], $image['id_image'], ImageType::getFormattedName('home')) : false;
            } else {
                $plan_image = $image ? 'http://'.$link->getImageLink($prod_obj->link_rewrite[$this->context->language->id], $image['id_image'], ImageType::getFormattedName('home')) : false;
            }
        }
        
        
        
        $this->context->smarty->assign('plan_image', $plan_image);
        
        $this->fields_form = array(
                'legend' => array(
                    'title' => $this->module->l('Membership Plan Form', 'AdminKbMembershipPlansController'),
                    'icon' => 'icon-envelope'
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Plan Name', 'AdminKbMembershipPlansController'),
                        'name' => 'title',
                        'required' => true,
                        'lang' => true,
                        'hint' => $this->module->l('Enter the membership plan name', 'AdminKbMembershipPlansController'),
                    ),
                    array(
                        'type' => 'hidden',
                        'name' => 'id_product'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Plan Price', 'AdminKbMembershipPlansController'),
                        'name' => 'plan_price',
                        'required' => true,
                        'col' => 2,
                        'suffix' => $currency_obj->sign,
                        'hint' => $this->module->l('Enter the Price for this membership plan', 'AdminKbMembershipPlansController'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Enable/disable Product Active limit', 'AdminKbMembershipPlansController'),
                        'name' => 'is_enabled_product_limit',
                        'required' => false,
                        'class' => 't',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'is_enabled_product_limit_on',
                                'value' => 1,
                                'label' => $this->module->l('Enabled', 'AdminKbMembershipPlansController')
                            ),
                            array(
                                'id' => 'is_enabled_product_limit_off',
                                'value' => 0,
                                'label' => $this->module->l('Disabled', 'AdminKbMembershipPlansController')
                            )
                        ),
                        'hint' => $this->module->l('If enabled then the set number of products will be active under this membership plan.', 'AdminKbMembershipPlansController')
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Product Limit', 'AdminKbMembershipPlansController'),
                        'name' => 'product_limit',
                        'required' => true,
                        'validation' => 'isInt',
                        'col' => 2,
                        'hint' => $this->module->l('Set maximum number of products that can remain active under this plan', 'AdminKbMembershipPlansController'),
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
                        'label' => $this->module->l('Duration', 'AdminKbMembershipPlansController'),
                        'name' => 'plan_duration',
                        'required' => true,
                        'validation' => 'isInt',
                        'col' => 2,
                        'hint' => $this->module->l('Only Numeric values are allowed', 'AdminKbMembershipPlansController'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Enable', 'AdminKbMembershipPlansController'),
                        'name' => 'active',
                        'required' => false,
                        'values' => array(
                            array(
                                'value' => 1
                            ),
                            array(
                                'value' => 0
                            )
                        ),
                        'hint' => $this->module->l('Enable or disable this membership plan', 'AdminKbMembershipPlansController')
                    ),
                    array(
                        'type' => 'file',
                        'label' => $this->l('Plan Image:'),
                        'class' => '',
                        'name' => 'uploadedfile',
                        'id' => 'uploadedfile',
                        'display_image' => true,
                        'image' => $this->context->smarty->fetch(
                            _PS_MODULE_DIR_ . $this->module->name . '/views/templates/admin/plan_image_preview.tpl'
                        ),
                        'required' => false,
                    ),
                ),
                'buttons' => array(
                    array(
                        'title' => $this->module->l('Save', 'AdminKbMembershipPlansController'),
                        'type' => 'submit',
                        'icon' => 'process-icon-save',
                        'class' => 'pull-right',
                        'name' => 'submitAdd' . $this->table,
                    ),
                )
            );
        
        $this->show_form_cancel_button = true;

        $tpl = $this->custom_smarty->createTemplate('membership_plan_form.tpl');
        
        return $tpl->fetch().parent::renderForm();
    }

    private function getBaseDirUrl()
    {
        $module_dir = '';
        if ($this->checkSecureUrl()) {
            $module_dir = _PS_BASE_URL_SSL_.__PS_BASE_URI__;
        } else {
            $module_dir = _PS_BASE_URL_.__PS_BASE_URI__;
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

    public function processUpdate()
    {
        $posted_data = Tools::getAllValues();
        foreach ($this->all_languages as $lang) {
            $posted_data['product_name'][$lang['id_lang']] = Tools::getValue('title_'.$lang['id_lang']);
        }
        if (!$this->addUpdateProduct($posted_data, 'update')) {
            $this->context->cookie->__set(
                'kb_redirect_error',
                $this->module->l('Something went wrong while updating the Gift Card product. Please try again.', 'AdminKbMembershipPlansController')
            );
            $this->redirect_after = self::$currentIndex . '&' . $this->identifier . '=' . (int)$this->object->id
                . '&update' . $this->table . '&token=' . $this->token;
        } else {
            $this->object = new KbMpMemberShipPlan((int)Tools::getValue('id_kbmp_membership_plan', 0));
            $this->object->id_shop = $this->context->shop->id;
            $this->object->plan_duration = $posted_data['plan_duration'];
            $this->object->plan_duration_type = $posted_data['plan_duration_type'];
            $this->object->plan_duration_type = $posted_data['plan_duration_type'];
            $this->object->is_enabled_product_limit = $posted_data['is_enabled_product_limit'];
            if ((int)$posted_data['is_enabled_product_limit'] == 1) {
                $this->object->product_limit = $posted_data['product_limit'];
            } else {
                $this->object->product_limit = 0;
            }
            $this->object->active = $posted_data['active'];
            if ($this->object->save()) {
                $this->context->cookie->__set(
                    'kb_redirect_success',
                    $this->module->l('Membership plan updated successfully.', 'AdminKbMembershipPlansController')
                );

                $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
            } else {
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('Something went wrong while adding the Gift Card product. Please try again.', 'AdminKbMembershipPlansController')
                );
            }
        }
    }
    
    public function processDelete()
    {
        if (Tools::isSubmit('delete'.$this->table)) {
            $kbmp_pro_obj = new KbMpMemberShipPlan((int) Tools::getValue('id_kbmp_membership_plan'));
            $pro_obj = new Product($kbmp_pro_obj->id_product);
            if ($pro_obj->delete()) {
                $kbmp_pro_obj->is_deleted = 1;
                $kbmp_pro_obj->save();
                $this->context->cookie->__set(
                    'kb_redirect_success',
                    $this->module->l('Successful deletion', 'AdminKbMembershipPlansController')
                );
                $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
            } else {
                $this->errors[] = Tools::displayError($this->module->l('Error occurred while deleting the Membership plan.', 'AdminKbMembershipPlansController'));
            }
        }
    }
    
    public function processAdd()
    {
        if (Tools::isSubmit('submitAdd'.$this->table)) {
            $posted_data = Tools::getAllValues();
            foreach ($this->all_languages as $lang) {
                $posted_data['product_name'][$lang['id_lang']] = Tools::getValue('title_'.$lang['id_lang']);
            }
            if (!$this->addUpdateProduct($posted_data)) {
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('Something went wrong while adding the Gift Card product. Please try again.', 'AdminKbMembershipPlansController')
                );
                $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
            } else {
                $this->object = new KbMpMemberShipPlan();
                $this->object->id_shop = $this->context->shop->id;
                $this->object->id_product = $posted_data['generated_product_id'];
                $this->object->plan_duration = $posted_data['plan_duration'];
                $this->object->plan_duration_type = $posted_data['plan_duration_type'];
                $this->object->plan_duration_type = $posted_data['plan_duration_type'];
                $this->object->is_enabled_product_limit = $posted_data['is_enabled_product_limit'];
                if ((int)$posted_data['is_enabled_product_limit'] == 1) {
                    $this->object->product_limit = $posted_data['product_limit'];
                } else {
                    $this->object->product_limit = 0;
                }
                $this->object->position = $this->getNextAvailablePosition();
                $this->object->active = $posted_data['active'];
                if ($this->object->save()) {
                    $this->context->cookie->__set(
                        'kb_redirect_success',
                        $this->module->l('Membership plan added successfully.', 'AdminKbMembershipPlansController')
                    );
                    
                    $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
                } else {
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $this->module->l('Something went wrong while adding the Gift Card product. Please try again.', 'AdminKbMembershipPlansController')
                    );
                }
            }
        }
    }
    
    public function showPlanDuration($id_row, $tr)
    {
        return $id_row. ' ' .$this->duration_intervals[$tr['plan_duration_type']];
    }
    
    public function initPageHeaderToolbar()
    {
        if (Tools::getValue('id_kbmp_membership_plan')) {
        } else {
            $all_values = Tools::getAllValues();
            if (!isset($all_values['addkbmp_membership_plan'])) {
                $this->page_header_toolbar_btn['new_template'] = array(
                    'href' => self::$currentIndex . '&add' . $this->table . '&token=' . $this->token,
                    'desc' => $this->module->l('Add new', 'AdminKbMembershipPlansController'),
                    'icon' => 'process-icon-new'
                );
            }
        }

        parent::initPageHeaderToolbar();
    }
    
    /*
     * Function for returning all the languages in the system
     */
    public function getAllLanguages()
    {
        return Language::getLanguages(false);
    }
    
    /*
     * Function for creating/updating a customizable product in the store when a Gift Card product is being added/updated
     */
    private function addUpdateProduct(&$product_data, $action = 'add')
    {
        if ($action == 'add') {
            $pro_object = new Product();
            $pro_object->id_manufacturer = 0;
            foreach ($this->getAllLanguages() as $lang) {
                $pro_object->name[$lang['id_lang']] = $product_data['product_name'][$lang['id_lang']];
                $pro_object->link_rewrite[$lang['id_lang']] = $this->convertProductNametoLinkRewrite($product_data['product_name'][$lang['id_lang']]);
            }
            $pro_object->quantity = 999;
            $pro_object->price = $product_data['plan_price'];
            $pro_object->specificPrice = 0;
            $pro_object->wholesale_price = 0;
            $pro_object->on_sale = 0;
            $pro_object->online_only = 0;
            $pro_object->unity = '1';
            $pro_object->unit_price = 0.00;
            $pro_object->unit_price_ratio = 0;
            $pro_object->ecotax = 0;
            $pro_object->visibility = 'none';
//            $pro_object->active = $product_data['active'];
            $pro_object->active = 1;
            $pro_object->quantity_discount = 0;
            $pro_object->out_of_stock = 1;
            $pro_object->redirect_type = '404';
            $pro_object->id_tax_rules_group = 0;
            $pro_object->depends_on_stock = false;
            $pro_object->is_virtual = 1;
            if ($pro_object->add()) {
                $pro_object->updateCategories(array((int)Configuration::get('PS_HOME_CATEGORY')));
                $pro_object->id_category_default = (int) Configuration::get('PS_HOME_CATEGORY');
                StockAvailable::setQuantity(
                    $pro_object->id,
                    0,
                    999,
                    (int) $this->context->shop->id
                );
                StockAvailable::setProductOutOfStock(
                    (int) $pro_object->id,
                    $pro_object->out_of_stock,
                    $this->context->shop->id
                );
                if (!$this->addUpdateMembershipImagetoProduct((int) $pro_object->id)) {
                    $this->error_flag = true;
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $this->module->l('An error occurred while adding the default product image.', 'AdminKbMembershipPlansController')
                    );
                }
                if (!$this->error_flag) {
                    $pro_object->save();
                    $product_data['generated_product_id'] = $pro_object->id;
                    return true;
                } else {
                    return false;
                }
            } else {
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('An error occurred while adding the Gift Card product.', 'AdminKbMembershipPlansController')
                );
                return false;
            }
        } elseif ($action == 'update') {
            $pro_object = new Product($product_data['id_product']);
            foreach ($this->getAllLanguages() as $lang) {
                $pro_object->name[$lang['id_lang']] = $product_data['product_name'][$lang['id_lang']];
                $pro_object->link_rewrite[$lang['id_lang']] = $this->convertProductNametoLinkRewrite($product_data['product_name'][$lang['id_lang']]);
            }
            $pro_object->quantity = 999;
            $pro_object->price = $product_data['plan_price'];
//            $pro_object->active = $product_data['active'];
            $pro_object->active = 1;
            StockAvailable::setQuantity(
                $pro_object->id,
                0,
                999,
                (int) $this->context->shop->id
            );
            if (!$this->addUpdateMembershipImagetoProduct((int) $pro_object->id, $action)) {
                $this->error_flag = true;
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('An error occurred while adding the default product image.', 'AdminKbMembershipPlansController')
                );
            }
            if (!$this->error_flag) {
                $pro_object->save();
                return true;
            } else {
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('An error occurred while updating the Gift Card product.', 'AdminKbMembershipPlansController')
                );
                $this->redirect_after = self::$currentIndex . '&' . $this->identifier . '=' . (int)$this->object->id
                    . '&update' . $this->table . '&token=' . $this->token;
                return false;
            }
        }
    }
    
    /**
     * Duplicate of AdminImportController::get_best_path()
     * Duplicated since the main function is protected and it cannot be called directly in this class
     */
    private function getBestPath($tgt_width, $tgt_height, $path_infos)
    {
        $path_infos = array_reverse($path_infos);
        $path = '';
        foreach ($path_infos as $path_info) {
            list($width, $height, $path) = $path_info;
            if ($width >= $tgt_width && $height >= $tgt_height) {
                return $path;
            }
        }
        return $path;
    }
    
    public function getDefaultMembershipPlanImageURL()
    {
        return $plan_image = _PS_MODULE_DIR_ . $this->module->name . '/views/img/plan_sample.jpg';
    }
    
    private function addUpdateMembershipImagetoProduct($id_product, $action = 'add')
    {
        $image_url = $this->getDefaultMembershipPlanImageURL();
        if (!empty($_FILES)) {
            if ($_FILES['uploadedfile']['error'] == 0 && $_FILES['uploadedfile']['name'] != '' && $_FILES['uploadedfile']['size'] > 0) {
                $file_extension = pathinfo($_FILES['uploadedfile']['name'], PATHINFO_EXTENSION);
                $path = _PS_MODULE_DIR_ . $this->module_name . '/views/img/membership_plan/'.$id_product.'.' . $file_extension;
                $exist_image = _PS_MODULE_DIR_ . $this->module_name . '/views/img/membership_plan/'.$id_product.'.*';
                if (file_exists($exist_image)) {
                    unlink($exist_image);
                }
                move_uploaded_file(
                    $_FILES['uploadedfile']['tmp_name'],
                    $path
                );
                $image_url = _PS_MODULE_DIR_ . $this->module->name . '/views/img/membership_plan/'.$id_product.'.' . $file_extension;
                chmod(_PS_MODULE_DIR_ . $this->module_name . '/views/img/membership_plan/'.$id_product.'.' . $file_extension, 0777);
            } elseif ($action == 'update') {
                return true;
            }
        }
        $images = Image::getImages($this->context->language->id, (int)$id_product);
        if (count($images) > 0) {
            foreach ($images as $image_key => $image) {
                $image = new Image((int)$image['id_image']);
                $image->delete();
            }
        }
        
        $image_url = trim($image_url);
        $product_has_images = (bool)Image::getImages($this->context->language->id, $id_product);

        $image = new Image();
        $image->id_product = (int)$id_product;
        $image->position = Image::getHighestPosition($id_product) + 1;
        $image->cover = (!$product_has_images) ? true : false;

        $field_error = $image->validateFields(false, true);
        $lang_field_error = $image->validateFieldsLang(false, true);

        if ($field_error === true && $lang_field_error === true && $image->add()) {
            $image->associateTo((int) $this->context->shop->id);
            if (!$this->copyImg($id_product, $image->id, $image_url, 'products')) {
                $this->context->cookie->__set(
                    'kb_redirect_error',
                    $this->module->l('An error occurred while adding Gift Card product image.', 'AdminKbMembershipPlansController')
                );
                $image->delete();
                return false;
            } else {
                return true;
            }
        } else {
            $this->context->cookie->__set(
                'kb_redirect_error',
                $this->module->l('An error occurred while adding Gift Card product image.', 'AdminKbMembershipPlansController')
            );
            return false;
        }
    }
    
    /**
     * Duplicate of AdminImportController::copyImg()
     * Duplicated since the main function is protected and it cannot be called directly in this class
     */
    private function copyImg($id_entity, $id_image, $url, $entity = 'products', $regenerate = true)
    {
        $tmpfile = tempnam(_PS_TMP_IMG_DIR_, 'ps_import');
        $watermark_types = explode(',', Configuration::get('WATERMARK_TYPES'));

        switch ($entity) {
            default:
            case 'products':
                $image_obj = new Image($id_image);
                $path = $image_obj->getPathForCreation();
                break;
            case 'categories':
                $path = _PS_CAT_IMG_DIR_.(int)$id_entity;
                break;
            case 'manufacturers':
                $path = _PS_MANU_IMG_DIR_.(int)$id_entity;
                break;
            case 'suppliers':
                $path = _PS_SUPP_IMG_DIR_.(int)$id_entity;
                break;
        }

        $url = urldecode(trim($url));
        $parced_url = parse_url($url);

        if (isset($parced_url['path'])) {
            $uri = ltrim($parced_url['path'], '/');
            $parts = explode('/', $uri);
            foreach ($parts as &$part) {
                $part = rawurlencode($part);
            }
            unset($part);
            $parced_url['path'] = '/'.implode('/', $parts);
        }

        if (isset($parced_url['query'])) {
            $query_parts = array();
            parse_str($parced_url['query'], $query_parts);
            $parced_url['query'] = http_build_query($query_parts);
        }

        if (!function_exists('http_build_url')) {
            require_once($this->getKbModuleDir().'libraries/http_build_url/http_build_url.php');
        }

        $url = http_build_url('', $parced_url);

        $orig_tmpfile = $tmpfile;

        if (Tools::copy($url, $tmpfile)) {
            // Evaluate the memory required to resize the image: if it's too much, you can't resize it.
            if (!ImageManager::checkImageMemoryLimit($tmpfile)) {
                @unlink($tmpfile);
                return false;
            }

            $tgt_width = $tgt_height = 0;
            $src_width = $src_height = 0;
            $error = 0;
            ImageManager::resize(
                $tmpfile,
                $path.'.jpg',
                null,
                null,
                'jpg',
                false,
                $error,
                $tgt_width,
                $tgt_height,
                5,
                $src_width,
                $src_height
            );
            $images_types = ImageType::getImagesTypes($entity, true);

            if ($regenerate) {
                $path_infos = array();
                $path_infos[] = array($tgt_width, $tgt_height, $path.'.jpg');
                foreach ($images_types as $image_type) {
                    $tmpfile = self::getBestPath($image_type['width'], $image_type['height'], $path_infos);

                    if (ImageManager::resize($tmpfile, $path.'-'.Tools::stripslashes($image_type['name']).'.jpg', $image_type['width'], $image_type['height'], 'jpg', false, $error, $tgt_width, $tgt_height, 5, $src_width, $src_height)) {
                        // the last image should not be added in the candidate list if it's bigger than the original image
                        if ($tgt_width <= $src_width && $tgt_height <= $src_height) {
                            $path_infos[] = array($tgt_width, $tgt_height, $path.'-'.Tools::stripslashes($image_type['name']).'.jpg');
                        }
                        if ($entity == 'products') {
                            if (is_file(_PS_TMP_IMG_DIR_.'product_mini_'.(int)$id_entity.'.jpg')) {
                                unlink(_PS_TMP_IMG_DIR_.'product_mini_'.(int)$id_entity.'.jpg');
                            }
                            if (is_file(_PS_TMP_IMG_DIR_.'product_mini_'.(int)$id_entity.'_'.(int)Context::getContext()->shop->id.'.jpg')) {
                                unlink(_PS_TMP_IMG_DIR_.'product_mini_'.(int)$id_entity.'_'.(int)Context::getContext()->shop->id.'.jpg');
                            }
                        }
                    }
                    if (in_array($image_type['id_image_type'], $watermark_types)) {
                        Hook::exec('actionWatermark', array('id_image' => $id_image, 'id_product' => $id_entity));
                    }
                }
            }
        } else {
            @unlink($orig_tmpfile);
            return false;
        }
        unlink($orig_tmpfile);
        return true;
    }
    
    // Function to find the next available position for a particualr image
    public static function getNextAvailablePosition()
    {
        $sql = 'SELECT MAX(position) as max_pos from ' . _DB_PREFIX_ . 'kbmp_membership_plan';
        $max_pos = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        if ((!isset($max_pos) && $max_pos != 0 && empty($max_pos)) || $max_pos == null) {
            $max_pos = 0;
            return ($max_pos);
        }
        return ($max_pos + 1);
    }
    
    /*
     * Function for unaccenting the product name so that it can be converted to a URL for link_rewrite field
     */
    private function unaccentProductName($string)
    {
        if (strpos($string = htmlentities($string, ENT_QUOTES, 'UTF-8'), '&') !== false) {
            $preg_replaced = preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i', '$1', $string);
            $string = html_entity_decode($preg_replaced, ENT_QUOTES, 'UTF-8');
        }
        return $string;
    }
    
    /*
     * Function for converting the product name to URL for link_rewrite field
     */
    private function convertProductNametoLinkRewrite($string, $slug = '-', $extra = null)
    {
        $unaccented_name = $this->unaccentProductName($string);
        $preg_quote = preg_quote($extra, '~');
        $preg_replaced = preg_replace('~[^0-9a-z' . $preg_quote . ']+~i', $slug, $unaccented_name);
        $trimmed_name = trim($preg_replaced, $slug);
        return Tools::strtolower($trimmed_name);
    }
}
