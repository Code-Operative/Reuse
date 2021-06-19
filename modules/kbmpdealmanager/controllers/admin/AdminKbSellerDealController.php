<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store. 
 *
 * @category  PrestaShop Module
 * @author    knowband.com <support@knowband.com>
 * @copyright 2016 knowband
 * @license   see file: LICENSE.txt
 */

class AdminKbSellerDealController extends ModuleAdminControllerCore
{
    protected $kb_module_name = 'kbmpdealmanager';
    protected $is_new = true;
    public $bootstrap = true;

    public function __construct()
    {
        require_once _PS_MODULE_DIR_ . 'kbmpdealmanager/KbDealRule.php';
        $this->module = Module::getInstanceByName('kbmpdealmanager');
        parent::__construct();
        $this->table = 'kbmp_seller_deal';
        $this->className = 'KbSellerDeal';
        $this->identifier = 'id_seller_deal';
        $this->deleted = false;
        $this->lang = true;
        $this->display = 'list';
        $this->bulk_actions = array();
        $this->allow_export = true;
        $this->toolbar_title = $this->module->l('Seller Deals','AdminKbSellerDealController');
        $this->list_no_link = true;
        $this->imageType = 'jpg';


        $this->_select = 'c.`firstname`, c.`lastname`, c.`email`';

        $this->_join .= ' INNER JOIN ' . _DB_PREFIX_ . 'kb_mp_seller as seller 
            ON (a.`id_seller` = seller.`id_seller`)';
        $this->_join .= ' INNER JOIN ' . _DB_PREFIX_ . 'customer as c 
            ON (seller.`id_customer` = c.`id_customer`) and a.deal_type != 3';

        $this->_orderBy = 'a.id_seller_deal';
        $this->_orderWay = 'DESC';

        $this->fields_list = array(
            'id_seller_deal' => array(
                'title' => $this->module->l('ID', 'AdminKbSellerDealController'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs'
            ),
            'firstname' => array(
                'title' => $this->module->l('First Name', 'AdminKbSellerDealController'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'c!firstname',
            ),
            'email' => array(
                'title' => $this->module->l('Email', 'AdminKbSellerDealController'),
                'havingFilter' => true,
                'filter_key' => 'c!email',
                'search' => true
            ),
            'title' => array(
                'title' => $this->module->l('Deal Title', 'AdminKbSellerDealController'),
                'filter_key' => 'a!title',
                'width' => 'auto'
            ),
            'deal_type' => array(
                'title' => $this->module->l('Deal type', 'AdminKbSellerDealController'),
                'align' => 'center',
                'type' => 'select',
                'callback' => 'renderDealType',
                'filter_key' => 'a!deal_type',
                'list' => DealTool::getDealTypes(),
            ),
            'reduction_type' => array(
                'title' => $this->module->l('Reduction type', 'AdminKbSellerDealController'),
                'align' => 'center',
                'type' => 'select',
                'callback' => 'renderReductionType',
                'filter_key' => 'a!reduction_type',
                'list' => DealTool::getReductionTypes(),
            ),
            'reduction' => array(
                'title' => $this->module->l('Reduction', 'AdminKbSellerDealController'),
                'align' => 'center',
                'havingFilter' => false,
                'search' => false,
                'orderBy' => false,
                'callback' => 'renderReduction',
                'type' => 'text'
            ),
            'active' => array(
                'title' => $this->module->l('Status', 'AdminKbSellerDealController'),
                'type' => 'bool',
                'align' => 'text-center',
                'callback' => 'renderStatus',
                'havingFilter' => true,
                'type' => 'bool',
                'order_key' => 'active',
                'search' => true
            ),
            'from_date' => array(
                'title' => $this->module->l('Beginning', 'AdminKbSellerDealController'),
                'align' => 'right',
                'type' => 'datetime',
            ),
            'end_date' => array(
                'title' => $this->module->l('End', 'AdminKbSellerDealController'),
                'align' => 'right',
                'type' => 'datetime'
            ),
        );

        $this->addRowAction('edit');
        $this->addRowAction('delete');
    }

    public function renderStatus($id_row, $tr)
    {
        unset($id_row);
        if ($tr['active']) {
            return $this->module->l('Yes', 'AdminKbSellerDealController');
        } else {
            return $this->module->l('No', 'AdminKbSellerDealController');
        }
    }

    public function renderDealType($id_row, $tr)
    {
        unset($id_row);
        $deal_type = DealTool::getDealType($tr['deal_type']);
        $this->module->l('Based on Catalog', 'AdminKbSellerDealController');
        $this->module->l('Based on Coupon Code', 'AdminKbSellerDealController');
        $this->module->l('Per Product', 'AdminKbSellerDealController');
//        return $deal_type[$tr['deal_type']];
        return $this->module->l($deal_type[$tr['deal_type']], 'AdminKbSellerDealController');
    }

    public function renderReductionType($id_row, $tr)
    {
        unset($id_row);
        $this->module->l('Percentage', 'AdminKbSellerDealController');
        $this->module->l('Fixed Amount', 'AdminKbSellerDealController');
        return $this->module->l(DealTool::renderReductionType($tr), 'AdminKbSellerDealController');
//        return DealTool::renderReductionType($tr);
    }

    public function renderReduction($id_row, $tr)
    {
        unset($id_row);
        return DealTool::renderDiscount($tr);
    }

    public function postProcess()
    {
        if (Tools::isSubmit('ajax') && Tools::isSubmit('method')) {
            switch (Tools::getValue('method')) {
                case 'getSellerCategory':
                    $id_seller = (int) Tools::getValue('id_seller', 0);
                    $assigned_categories = KbSellerCategory::getCategoriesBySeller($id_seller);
                    $assigned_cat_exist = false;
                    if ($assigned_categories && count($assigned_categories) > 0) {
                        $assigned_cat_exist = true;
                    }
                    echo Tools::jsonEncode(
                        array(
                            'assigned_cat_exist' => $assigned_cat_exist,
                            'assigned_categories' => $assigned_categories
                        )
                    );
                    break;
                case 'checkCoupon':
                    $json = $this->checkAjaxCouponCode();
                    echo Tools::jsonEncode($json);
                    break;
            }
            die;
        }
        parent::postProcess();
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addJS(_PS_MODULE_DIR_ . $this->kb_module_name . '/views/js/admin.js');
    }

    public function renderForm()
    {
        $temp_deals = DealTool::getDealTypes();
        $deal_types = array();
        foreach ($temp_deals as $key => $v) {
            $deal_types[] = array('id_type' => $key, 'label' => $this->module->l($v, 'AdminKbSellerDealController'));
        }

        $temp_reductions = DealTool::getReductionTypes();
        $reduction_types = array();
        foreach ($temp_reductions as $key => $v) {
            $reduction_types[] = array('id_type' => $key, 'label' => $this->module->l($v, 'AdminKbSellerDealController'));
        }
        // changes by rishabh jain
        $image_url = false;
        $image_size = false;
        if ($this->object->id && !empty($this->object->banner_path)) {
            $image = _PS_MODULE_DIR_ . 'kbmarketplace/views/img/seller_media/'
                . $this->object->id_seller . '/' . $this->object->banner_path;
            if (Tools::file_exists_no_cache($image)) {
                $image_url = ImageManager::thumbnail(
                    $image,
                    $this->table . '_' . (int) $this->object->id_seller . '_' . $this->object->banner_path,
                    350,
                    $this->imageType,
                    true,
                    true
                );
                $image_size = file_exists($image) ? filesize($image) / 1000 : false;
            }
        }

        $images_types = ImageType::getImagesTypes('categories');
        $format = array();
        $formated_category = ImageType::getFormatedName('category');
        foreach ($images_types as $image_type) {
            if ($formated_category == $image_type['name']) {
                $format = $image_type;
            }
        }
        $enable = 0;
        if (Configuration::get('KBMP_DEAL_MANAGER') && Configuration::get('KBMP_DEAL_MANAGER') == 1) {
            $enable = 1;
        }
        if ($enable == 1) {
            $this->fields_form = array(
                'legend' => array(
                    'title' => $this->module->l('Deal Configurations', 'AdminKbSellerDealController'),
                    'icon' => 'icon-dollar'
                ),
                'input' => array(
                    array(
                        'type' => 'hidden',
                        'name' => 'id_seller_deal'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Title', 'AdminKbSellerDealController'),
                        'name' => 'title',
                        'lang' => true,
                        'required' => true,
                        'hint' => $this->module->l('Forbidden characters','AdminKbSellerDealController') . ' <>;=#{}'
                    ),
                    array(
                        'type' => 'file',
                        'label' => $this->module->l('Deal Banner', 'AdminKbSellerDealController'),
                        'name' => 'banner_path',
                        'display_image' => true,
                        'image' => $image_url ? $image_url : false,
                        'size' => $image_size,
                        'delete_url' => self::$currentIndex . '&' . $this->identifier . '=' . $this->object->id
                            . '&token=' . $this->token . '&deleteImage=1',
                        'hint' => $this->module->l('This is the main image for your category, displayed in the category page. 
                            The category description will overlap this image and appear in its top-left corner.', 'AdminKbSellerDealController'),
                        'format' => $format
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->module->l('Enable', 'AdminKbSellerDealController'),
                        'name' => 'active',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->module->l('Enabled', 'AdminKbSellerDealController')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->module->l('Disabled', 'AdminKbSellerDealController')
                            )
                        )
                    ),
                    array(
                        'type' => 'datetime',
                        'id' => 'seller_deal_from_date',
                        'label' => $this->module->l('Start Date', 'AdminKbSellerDealController'),
                        'required' => true,
                        'name' => 'from_date',
                        'class' => 'datetimepicker required'
                    ),
                    array(
                        'type' => 'datetime',
                        'id' => 'seller_deal_end_date',
                        'label' => $this->module->l('End Date', 'AdminKbSellerDealController'),
                        'required' => true,
                        'name' => 'end_date',
                        'class' => 'datetimepicker required'
                    ),
                    array(
                        'type' => 'select',
                        'id' => 'kbmp_deal_type',
                        'label' => $this->module->l('Deal Type', 'AdminKbSellerDealController'),
                        'onchange' => 'switchDealType(this)',
                        'name' => 'deal_type',
                        'options' => array(
                            'query' => $deal_types,
                            'id' => 'id_type',
                            'name' => 'label'
                        ),
                        'required' => true,
                        'class' => 'required',
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->module->l('Discount type', 'AdminKbSellerDealController'),
                        'name' => 'reduction_type',
                        'class' => 'required',
                        'options' => array(
                            'query' => $reduction_types,
                            'id' => 'id_type',
                            'name' => 'label'
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->module->l('Discount', 'AdminKbSellerDealController'),
                        'name' => 'reduction',
                        'class' => 'required',
                    ),
                ),
                'buttons' => array(
                    array(
                        'title' => $this->module->l('Save', 'AdminKbSellerDealController'),
                        'type' => 'button',
                        'icon' => 'process-icon-save',
                        'js' => 'validateDealForm()',
                        'class' => 'pull-right',
                        'name' => 'submitAdd' . $this->table,
                    ),
                    array(
                        'title' => $this->module->l('Save And Stay', 'AdminKbSellerDealController'),
                        'type' => 'button',
                        'icon' => 'process-icon-save',
                        'js' => 'validateDealForm()',
                        'class' => 'pull-right',
                        'name' => 'submitAdd' . $this->table . 'AndStay',
                    )
                )
            );
            if ($this->display == 'add') {
                $sql = 'Select CONCAT(c.`firstname`, \' \', c.`lastname`) AS `seller_name`, c.`email`, s.id_seller 
                                    FROM ' . _DB_PREFIX_ . 'kb_mp_seller as s INNER JOIN ' . _DB_PREFIX_ . 'customer c 
                                    ON (s.`id_customer` = c.`id_customer`) 
                                    Where 1';
                $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

                $sellers = array(
                    array(
                        'id_seller' => '',
                        'name' => $this->module->l('Choose Seller', 'AdminKbSellerDealController'),
                    )
                );
                if (count($results) > 0) {
                    foreach ($results as $result) {
                        $sellers[] = array(
                            'id_seller' => $result['id_seller'],
                            'name' => $result['seller_name'] . '(' . $result['email'] . ')'
                        );
                    }
                }
                $this->fields_form['input'] = array_merge(
                    array(
                        array(
                            'type' => 'select',
                            'label' => $this->module->l('Seller', 'AdminKbSellerDealController'),
                            'onchange' => 'refreshCategories(this)',
                            'name' => 'id_seller',
                            'options' => array(
                                'query' => $sellers,
                                'id' => 'id_seller',
                                'name' => 'name'
                            ),
                        )
                    ),
                    $this->fields_form['input']
                );
            }

            $cat_rules_tmp = KbDealRule::getDealCategoryRules($this->object->id);
            $cat_rules = array();
            if (!empty($cat_rules_tmp)) {
                if ($this->object->deal_type == DealTool::DEAL_TYPE_CART) {
                    foreach ($cat_rules_tmp['value'] as $c) {
                        $cat_rules[] = $c['id_item'];
                    }
                }
                if ($this->object->deal_type == DealTool::DEAL_TYPE_CATALOG) {
                    foreach ($cat_rules_tmp as $c) {
                        $cat_rules[] = $c['value'];
                    }
                }
            }
            $this->tpl_form_vars['deal_rule_categories'] = $cat_rules;

            $manu_rules_tmp = KbDealRule::getDealManufacturerRules($this->object->id);
            $manu_rules = array();
            if (!empty($manu_rules_tmp)) {
                foreach ($manu_rules_tmp as $m) {
                    $manu_rules[] = $m['value'];
                }
            }
            $this->tpl_form_vars['deal_rule_manufacturers'] = $manu_rules;

            $categories = $this->getCategoryList();
            $this->tpl_form_vars['categories'] = $categories;

            $manufacturers = Manufacturer::getManufacturers(false, $this->context->language->id, true);
            $this->tpl_form_vars['manufacturers'] = $manufacturers;

            $assigned_categories = KbSellerCategory::getCategoriesBySeller((int) $this->object->id_seller);
            $assigned_cat_exist = false;
            if ($assigned_categories && count($assigned_categories) > 0 && (int) $this->object->id_seller > 0) {
                $assigned_cat_exist = true;
            }
            if ((int) $this->object->id_seller == 0) {
                $assigned_cat_exist = true;
            }
            $this->tpl_form_vars['assigned_cat_exist'] = $assigned_cat_exist;
            $this->tpl_form_vars['assigned_categories'] = $assigned_categories;
        } else {
            $this->errors = $this->module->l('New deals can not be added until the deal manager is enabled', 'AdminKbSellerDealController');
        }
        return parent::renderForm();
    }

    public function getFieldsValue($object)
    {
        $this->fields_value = parent::getFieldsValue($object);
        if ($object->id) {
            $this->fields_value['from_date'] = date('Y-m-d H:i:s', strtotime($object->from_date));
            $this->fields_value['end_date'] = date('Y-m-d H:i:s', strtotime($object->end_date));
        }

        return $this->fields_value;
    }

    public function setHelperDisplay(Helper $helper)
    {
        parent::setHelperDisplay($helper);
        $helper->bulk_actions = array();
        $this->helper->module = $this->module;
    }

    protected function getCategoryList($id_seller = 0, $return_unassigned = false)
    {
        $categories = array();
        $root_category = Category::getRootCategories();
        $all = Category::getSimpleCategories($this->context->language->id);
        $seller_categories = array();
        if ($id_seller > 0) {
            $seller_categories = KbSellerCategory::getCategoriesBySeller($id_seller);
        }
        foreach ($all as $c) {
            if ($root_category[0]['id_category'] != $c['id_category']) {
                $include_cat = false;
                if ($id_seller > 0) {
                    if ($return_unassigned && !in_array($c['id_category'], $seller_categories)) {
                        $include_cat = true;
                    } elseif (!$return_unassigned && in_array($c['id_category'], $seller_categories)) {
                        $include_cat = true;
                    }
                } else {
                    $include_cat = true;
                }

                if ($include_cat) {
                    $tmp = new Category($c['id_category'], $this->context->language->id, $this->context->shop->id);
                    $parents = $tmp->getParentsCategories();

                    $parents = array_reverse($parents);
                    $str = '';
                    foreach ($parents as $p) {
                        $str .= ' >> ' . $p['name'];
                    }

                    $categories[] = array(
                        'id_category' => $c['id_category'],
                        'name' => ltrim($str, ' >> ')
                    );
                }
            }
        }

        return $categories;
    }

    protected function copyFromPost(&$object, $table)
    {
        parent::copyFromPost($object, $table);

        $this->setDefaultValues($object);

        $banner_path = '';
        $seller_img_path = _PS_MODULE_DIR_ . 'kbmarketplace/views/img/seller_media/'
            . $this->object->id_seller . '/';
        if ((isset($_FILES['banner_path']) && $_FILES['banner_path']['size'] > 0)) {
            if ($object->id > 0) {
                $object->deleteImage();
            }
            $new_banner_name = time();
            if (isset($_FILES['banner_path'])
                && $_FILES['banner_path']['size'] > 0
                && $this->uploadImage(
                    'banner_path',
                    $seller_img_path,
                    $new_banner_name,
                    false
                )
            ) {
                $banner_path = $new_banner_name . '.' . $this->imageType;
            }
        } else {
            if ($object->id) {
                $banner_path = $object->banner_path;
            }
        }
        $object->banner_path = $banner_path;
        $object->active = Tools::getValue('active', 0);
        $object->deal_type = Tools::getValue('deal_type', DealTool::getDefaultDealType());
        $object->reduction_type = (int) Tools::getValue('reduction_type', DealTool::getDefaultReductionType());
        $object->reduction = (float) Tools::getValue('reduction', 0);

        $object->from_date = date('Y-m-d H:i:s', strtotime(Tools::getValue('from_date', '-1 days')));
        $object->end_date = date('Y-m-d H:i:s', strtotime(Tools::getValue('end_date', '-1 days')));

        if ($object->id) {
            $this->is_new = false;
        }
    }

    protected function setDefaultValues(&$object)
    {
        $default_values = DealTool::getCatalogRuleDefaultValues();
        foreach ($default_values as $field => $value) {
            $object->{$field} = $value;
        }
        if ($object->id > 0) {
            $object->id_seller = $object->id_seller;
        } else {
            $object->id_seller = (int) Tools::getValue('id_seller', 0);
        }
        if ($object->id > 0) {
            $object->id_shop = $object->id_shop;
        }
    }

    protected function afterAdd($object)
    {
        return $this->processRules($object);
    }

    protected function afterUpdate($object)
    {
        return $this->processRules($object);
    }

    private function processRules($object)
    {
        if (!$this->is_new) {
            $object->resetRules();
        }
        if ($object->active) {
            $object->applyNewRules(
                Tools::getValue('deal_rule_categories', array()),
                Tools::getValue('deal_rule_manufacturers', array())
            );
        } else {
            $object->cleanProductMappings();
        }
        return true;
    }

    protected function uploadImage($name, $dir, $img_name, $ext = false, $width = null, $height = null)
    {
        if (isset($_FILES[$name]['tmp_name']) && !empty($_FILES[$name]['tmp_name'])) {
            $errors = array();
            // Check image validity
            $max_size = 5000;
            $max_size = $max_size * 1024;
            if ($error = ImageManager::validateUpload($_FILES[$name], Tools::getMaxUploadSize($max_size))) {
                $errors[] = $error;
            }

            $tmp_name = tempnam(_PS_TMP_IMG_DIR_, 'PS');
            if (!$tmp_name) {
                return false;
            }

            if (!move_uploaded_file($_FILES[$name]['tmp_name'], $tmp_name)) {
                return false;
            }

            // Evaluate the memory required to resize the image: if it's too much, you can't resize it.
            if (!ImageManager::checkImageMemoryLimit($tmp_name)) {
                $errors[] = $this->module->l('Due to memory limit restrictions, this image cannot be loaded. 
					Please contact to support', 'AdminKbSellerDealController');
            }

            if (!Tools::file_exists_no_cache($dir)) {
                @mkdir($dir, 0777);
            }

            // Copy new image
            if (empty($errors)
                && !ImageManager::resize(
                    $tmp_name,
                    $dir . $img_name . '.' . $this->imageType,
                    (int) $width,
                    (int) $height,
                    ($ext ? $ext : $this->imageType)
                )
            ) {
                $errors[] = $this->module->l('An error occurred while uploading the image', 'AdminKbSellerDealController');
            }

            if (count($errors)) {
                $this->errors = array_merge($this->errors, $errors);
                return false;
            }

            unlink($tmp_name);
        }
        return true;
    }

    protected function checkAjaxCouponCode()
    {
        $error = true;
        $msg = $this->module->l('This Coupon is already is in use.', 'AdminKbSellerDealController');
        $code = Tools::getValue('code', '');
        if (!empty($code)) {
            $id_seller_deal = (int) Tools::getValue('id_seller_deal', 0);
            $deal = new KbSellerDeal($id_seller_deal);
            $id_cart_rule = CartRule::getIdByCode($code);
            if ($id_cart_rule) {
                if ($deal->id_cart_rule == $id_cart_rule) {
                    $error = false;
                }
            } else {
                $error = false;
            }
        }
        return array('error' => $error, 'msg' => $msg);
    }
}
