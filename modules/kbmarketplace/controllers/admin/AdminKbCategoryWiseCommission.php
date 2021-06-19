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

class AdminKbCategoryWiseCommissionController extends AdminKbMarketplaceCoreController
{

    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
        $this->table = 'kb_mp_category_level_commission';
        $this->className = 'KbCategoryLevelCommission';
        $this->identifier = 'id_commission';
        $this->deleted = false;
        $this->lang = false;
        $this->display = 'list';
        $this->toolbar_title = $this->module->l('Category Commissions', 'adminkbcategorywiseCommissioncontroller');


        $this->fields_list = array(
            'id_commission' => array(
                'title' => $this->module->l('ID', 'adminkbcategorywiseCommissioncontroller'),
                'align' => 'text-center',
                'class' => 'fixed-width-xs',
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'a!id_commission',
            ),
            'firstname' => array(
                'title' => $this->module->l('Seller First Name', 'adminkbcategorywiseCommissioncontroller'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'c!firstname',
            ),
            'lastname' => array(
                'title' => $this->module->l('Seller Last Name', 'adminkbcategorywiseCommissioncontroller'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'c!lastname',
            ),
            'email' => array(
                'title' => $this->module->l('Seller Email', 'adminkbcategorywiseCommissioncontroller'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'c!email',
            ),
            'title' => array(
                'title' => $this->module->l('Shop', 'adminkbcategorywiseCommissioncontroller'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'sl!title',
            ),
            'categoryname' => array(
                'title' => $this->module->l('Category Name', 'adminkbcategorywiseCommissioncontroller'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'cl!name',
            ),
            'id_category' => array(
                'title' => $this->module->l('Category Id', 'adminkbcategorywiseCommissioncontroller'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'a!id_category',
            ),
            'commission_percentage' => array(
                'title' => $this->module->l('Commission (in %)', 'adminkbcategorywiseCommissioncontroller'),
                'havingFilter' => true,
                'search' => true,
                'filter_key' => 'a!commission_percentage',
            ),
        );

        $this->_select = 'a.`commission_percentage`,a.`id_category`,cl.`name` as categoryname,
			c.`firstname` as firstname, c.`lastname` as lastname, c.`email`, sl.`title` as title';

        $this->_join = '
			INNER JOIN `' . _DB_PREFIX_ . 'kb_mp_seller` s ON (a.`id_seller` = s.`id_seller` and s.id_shop = '. (int) $this->context->shop->id. ') 
			INNER JOIN `' . _DB_PREFIX_ . 'kb_mp_seller_lang` sl ON (a.`id_seller` = sl.`id_seller` 
			AND sl.id_lang = ' . (int) $this->context->language->id . ') 
                        INNER JOIN `' . _DB_PREFIX_ . 'category_lang` cl ON (a.`id_category` = cl.`id_category` 
			AND cl.id_lang = ' . (int) $this->context->language->id . ' AND cl.id_shop = ' . (int) $this->context->shop->id.' ) 
                        INNER JOIN `' . _DB_PREFIX_ . 'category_shop` cs ON (a.`id_category` = cs.`id_category` 
			AND cs.id_shop = ' . (int) $this->context->shop->id . ') 
			INNER JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = s.`id_customer`)';


        $this->_orderBy = 'a.id_commission';
        $this->_orderWay = 'ASC';

        $this->addRowAction('edit');
        $this->addRowAction('deletewreason');
        $this->bulk_actions = array();
    }

    public function postProcess()
    {
        
        parent::postProcess();
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
    }

    public function initContent()
    {
        parent::initContent();
    }

    public function renderForm()
    {
        $id_lang = $this->context->language->id;

        $sql = 'select c.id_category ,cl.name from ' . _DB_PREFIX_ . 'category c 
                            INNER JOIN ' . _DB_PREFIX_ . 'category_shop cs on (c.id_category = cs.id_category) 
                            INNER JOIN ' . _DB_PREFIX_ . 'category_lang cl on (c.id_category = cl.id_category) 
                            WHERE cs.id_shop = ' . (int) $this->context->shop->id . ' and cl.id_lang = ' . $id_lang;
        $cats = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

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
        if (Tools::getValue('id_commission', 0) == 0) {
            $this->fields_form = array(
                'legend' => array(
                    'title' => $this->module->l('Category Commission', 'adminkbcategorywiseCommissioncontroller'),
                    'icon' => 'icon-envelope'
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'suffix' => '%',
                        'label' => $this->module->l('Default Commission', 'adminkbcategorywiseCommissioncontroller'),
                        'name' => 'commission_percentage',
                        'required' => true,
                        'validation' => 'isPercentage',
                        'class' => 'fixed-width-xs',
                        'hint' => $this->module->l('Only numerical or decimal values are allowed', 'adminkbcategorywiseCommissioncontroller'),
                    ),
//                    array(
//                        'type' => 'hidden',
//                        'name' => 'id_seller',
//                        'value' => ,
//                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Choose Sellers'),
                        'name' => 'kbmp_sellers[]',
                        'multiple' => 'multiple',
                        'hint' => $this->module->l('Select the sellers for whose you want to add the commissiion rule.', 'adminkbcategorywiseCommissioncontroller'),
                        'desc' => $this->module->l('Select the sellers for whose you want to add the commissiion rule.', 'adminkbcategorywiseCommissioncontroller'),
                        'id' => version_compare(_PS_VERSION_, '1.6.0.7', '>') ? 'multiple-select-pages' : 'multiple-select-chosen-pages',
                        'class' => 'chosen',
                        'options' => array(
                            'query' => $seller_form_data,
                            'id' => 'id_Seller',
                            'name' => 'title'
                        ),
                    ),
                ),
                'buttons' => array(
                    array(
                        'title' => $this->module->l('Save', 'adminkbcategorywiseCommissioncontroller'),
                        'type' => 'submit',
                        'icon' => 'process-icon-save',
                        'class' => 'pull-right',
                        'name' => 'submitAdd' . $this->table,
                    ),
                )
            );
            $category_array = array();
            $root = Category::getRootCategory();
            $tree = new HelperTreeCategories('kbmp-categories-tree');
            $tree->setRootCategory($root->id)
                ->setInputName('kbmp_categories')
                ->setUseCheckBox(true)
                ->setUseSearch(false)
                ->setSelectedCategories((array) $category_array);

            $this->fields_form['input'][] = array(
                'type' => 'categories_select',
                'label' => $this->module->l('Select Categories', 'adminkbcategorywiseCommissioncontroller'),
                'category_tree' => $tree->render(),
                'name' => 'kbmp_categories',
                'desc' => $this->module->l('Select Categories for which you want to set the commission.', 'adminkbcategorywiseCommissioncontroller')
            );
            $this->fields_value = array();
        } else {
            if (!($obj = $this->loadObject(true))) {
                return;
            }
            $this->fields_form = array(
                'legend' => array(
                    'title' => $this->module->l('Category Commission', 'adminkbcategorywiseCommissioncontroller'),
                    'icon' => 'icon-envelope'
                ),
                'input' => array(
                    array(
                        'type' => 'hidden',
                        'name' => 'id',
                        'value' => $obj->id
                    ),
                    array(
                        'label' => $this->module->l('Seller', 'adminkbcategorywiseCommissioncontroller'),
                        'type' => 'select',
                        'disabled' => true,
                        'hint' => $this->module->l('Select Seller', 'adminkbcategorywiseCommissioncontroller'),
                        'name' => 'id_seller',
                        'options' => array(
                            'query' => $seller_form_data,
                            'id' => 'id_Seller',
                            'name' => 'title'
                        ),
                    ),
                    array(
                        'label' => $this->module->l('Category', 'adminkbcategorywiseCommissioncontroller'),
                        'type' => 'select',
                        'disabled' => true,
                        'hint' => $this->module->l('Select Category', 'adminkbcategorywiseCommissioncontroller'),
                        'name' => 'id_category',
                        'options' => array(
                            'query' => $cats,
                            'id' => 'id_category',
                            'name' => 'name',
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'suffix' => '%',
                        'label' => $this->module->l('Default Commission', 'adminkbcategorywiseCommissioncontroller'),
                        'name' => 'commission_percentage',
                        'required' => true,
                        'validation' => 'isPercentage',
                        'class' => 'fixed-width-xs',
                        'hint' => $this->module->l('Only numerical or decimal values are allowed', 'adminkbcategorywiseCommissioncontroller'),
                    ),
                ),
                'buttons' => array(
                    array(
                        'title' => $this->module->l('Save', 'adminkbcategorywiseCommissioncontroller'),
                        'type' => 'submit',
                        'icon' => 'process-icon-save',
                        'class' => 'pull-right',
                        'name' => 'submitUpdate' . $this->table,
                    ),
                )
            );
            $this->fields_value = array(
                'id_category' => $obj->id_category,
                'id_seller' => $obj->id_seller,
                'commission_percentage' => $obj->commission_percentage
            );
        }
        $this->show_form_cancel_button = true;

        // autoload rich text editor (tiny mce)
        return parent::renderForm();
    }

    public function initPageHeaderToolbar()
    {
        parent::initPageHeaderToolbar();
    }

    public function processUpdate()
    {
        $this->copyFromPost($this->object, $this->table);
        if ($this->object->save()) {
            $this->context->cookie->__set(
                'kb_redirect_success',
                $this->module->l('Commission Successfully updated.', 'adminkbcategorywisecommissioncontroller')
            );
            $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
        } else {
            $this->errors[] = Tools::displayError($this->module->l('Error occurred while updating the commission.', 'adminkbcategorywisecommissioncontroller'));
        }
    }
    public function processDelete()
    {
        $this->copyFromPost($this->object, $this->table);
        if ($this->object->delete()) {
            $this->context->cookie->__set(
                'kb_redirect_success',
                $this->module->l('Commission deleted successfully.', 'adminkbcategorywisecommissioncontroller')
            );
            $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
        } else {
            $this->errors[] = Tools::displayError($this->module->l('Error occurred while deleting the category commission.', 'adminkbcategorywisecommissioncontroller'));
        }
    }
    
    public function processAdd()
    {
        if (Tools::isSubmit('submitAdd'.$this->table)) {
            $sellers_array = Tools::getValue('kbmp_sellers');
            $categories_array = Tools::getValue('kbmp_categories');
            $commission_percentage = Tools::getValue('commission_percentage');
            if (is_array($sellers_array) && count($sellers_array) > 0 && is_array($categories_array) && count($categories_array) > 0) {
                foreach ($sellers_array as $key => $id_seller) {
                    $assigned_cates = KbSellerCategory::getCategoriesBySeller($id_seller);
                    foreach ($categories_array as $category_key => $id_category) {
                        $id_commission = 0;
                        if (in_array($id_category, $assigned_cates)) {
                            $id_commission = KbCategoryLevelCommission::getIdCommissionBySellerIdAndCategoryId($id_seller, $id_category);
                            $category_comm_obj = new KbCategoryLevelCommission();
                            if ($id_commission) {
                                $category_comm_obj = new KbCategoryLevelCommission($id_commission);
                            }
                            $category_comm_obj->commission_percentage = (float) $commission_percentage;
                            $category_comm_obj->id_category = (int) $id_category;
                            $category_comm_obj->id_seller = (int) $id_seller;
                            $category_comm_obj->save();
//                            unset($category_comm_obj);
                        }
                    }
                }
                $this->context->cookie->__set(
                    'kb_redirect_success',
                    $this->module->l('Commission Successfully updated.', 'adminkbcategorywisecommissioncontroller')
                );
            } else {
                $this->context->cookie->__set(
                    'kb_redirect_success',
                    $this->module->l('There are some errors in the form.', 'adminkbcategorywisecommissioncontroller')
                );
                $this->redirect_after = self::$currentIndex . '&token=' . $this->token;
            }
        }
    }
}
