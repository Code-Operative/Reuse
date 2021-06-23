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

require_once _PS_MODULE_DIR_ . 'kbbookingcalendar/classes/KbBookingProduct.php';
require_once _PS_MODULE_DIR_ . 'kbbookingcalendar/classes/KbBookingFacilities.php';
require_once _PS_MODULE_DIR_ . 'kbbookingcalendar/classes/KbBookingRoomCategory.php';
require_once _PS_MODULE_DIR_ . 'kbbookingcalendar/classes/KbBookingRoomType.php';

require_once 'KbCore.php';

class KbmarketplaceKbBookingProductModuleFrontController extends KbmarketplaceCoreModuleFrontController
{
    public $controller_name = 'kbbookingproduct';
    public $kb_product;
    public $kb_booking_product;
    public $available_tabs_lang = array();
    protected $available_tabs = array();
    protected $default_form_language;
    protected $product_type_arr = array();
    public $custom_smarty;
    private $max_image_size = null;

    private $seller_product = null;

    public function __construct()
    {
        parent::__construct();

        $this->available_tabs_lang = array(
            'GeneralInformations' => $this->module->l('General Information', $this->controller_name),
            'Categories' => $this->module->l('Categories', $this->controller_name),
            'BookingInformations' => $this->module->l('Booking Information', $this->controller_name),
            'Location' => $this->module->l('Location', $this->controller_name),
            'Images' => $this->module->l('Images', $this->controller_name),
            'DateTime' => $this->module->l('Date/Time', $this->controller_name),
            'Rooms' => $this->module->l('Rooms', $this->controller_name),
            'Facilities' => $this->module->l('Facilities', $this->controller_name)
        );

        $this->available_tabs = array(
            'GeneralInformations' => 0,
            'BookingInformations' => 1,
            'Categories' => 2,
            'Location' => 3,
            'Images' => 4,
            'DateTime' => 5,
        );
        
        $this->product_type_arr['appointment'] = $this->module->l('Appointment', $this->controller_name);
        $this->product_type_arr['hotel_booking'] = $this->module->l('Hotel Booking', $this->controller_name);
        $this->product_type_arr['daily_rental'] = $this->module->l('Daily Rental', $this->controller_name);
        $this->product_type_arr['hourly_rental'] = $this->module->l('Hourly Rental', $this->controller_name);
        $this->default_form_language = $this->context->language->id;

        require_once $this->getKbModuleDir() . 'classes/CategoryTree.php';
    }

    public function setMedia()
    {
        parent::setMedia();
        if (Tools::getIsset('render_type') && Tools::getValue('render_type') == 'form') {
            $this->addCSS($this->getKbModuleDir() . 'views/css/front/kb-forms.css');
            $this->addCSS($this->getKbModuleDir() . 'views/css/front/kb-product-form.css');
            $this->addJS($this->getKbModuleDir() . 'views/js/front/kb-booking-product-form.js');
            $this->addJS($this->getKbModuleDir() . 'views/js/front/kb-common.js');
            $this->addJS($this->getKbModuleDir() . 'views/js/front/kb_category_tree.js');
            
            $this->addJS($this->getKbModuleDir() . 'views/js/front/velovalidation.js');
            
            $this->addJS($this->getKbModuleDir() . 'views/js/front/jquery-ui-timepicker-addon.js');
            // changes by rishabh jain for date time picker
//            $this->addJqueryUI(array('ui.datepicker'));
//            $this->addJS(_PS_JS_DIR_.'jquery/plugins/timepicker/jquery-ui-timepicker-addon.js');
            // changes over
            /* changes done by rishabh jain
            * DOM : 26/10/18
            * to fix the Smart cache for JavaScript issue for tiny mce
            */
            //$this->addJS($this->getKbModuleDir().'libraries/tinymce/tinymce.min.js');
            /* changes over */
            $this->addCSS($this->getKbModuleDir().'views/css/front/multiple-select.css');
            $this->addJS($this->getKbModuleDir().'views/js/front/jquery.multiple.select.js');
            $this->context->controller->addJqueryPlugin('select2');
        }
    }

    public function postProcess()
    {
        parent::postProcess();
        if (Tools::isSubmit('ajax')) {
            $this->json = array();
            $renderhtml = false;
            if (Tools::isSubmit('method')) {
                switch (Tools::getValue('method')) {
                    case 'addProductFacilities':
                        $this->json = $this->processMapFacilties();
                        break;
                    case 'removeProductFacilities':
                        $this->json = $this->removeProductFacilities();
                        break;
                    case 'searchedproduct':
                        $this->getAjaxProductList();
                        die;
                    case 'addProductImage':
                        $this->json = $this->processAddProductImage();
                        break;
                    case 'deleteImage':
                        $this->json = $this->processDeleteImage();
                        break;
                    case 'getSellerProducts':
                        $this->json = $this->getAjaxProductListHtml();
                        break;
                    case 'getAjaxCategoryTree':
                        echo $this->ajaxGetCategoryTree();
                        die;
                    case 'getAjaxSubCategoryTree':
                        echo $this->ajaxGetSubCategoryTree();
                        die;
                    
                    case 'saveReturnPolicy':
                        $this->json = $this->processSaveReturnPolicy();
                        break;
                    case 'addDateTimeRow':
                        $counter = Tools::getValue('counter');
                        $obj = new KbBookingProduct((int)  Tools::getValue('id_booking_product'));
                        $this->context->smarty->assign(
                            array(
                                'product_type' => (isset($obj->product_type))?$obj->product_type:'',
                                'kbajaxcounter' => $counter,
                                'currency' => $this->context->currency,
                                'id_booking_product' => Tools::getValue('id_booking_product')
                            )
                        );
                        $this->json = $this->context->smarty->fetch($this->getKbTemplateDir() . 'bookingProduct/date_time_block_product.tpl');
                        break;
                    case 'addTimeRow':
                        $counter = Tools::getValue('counter');
                        $datetime_block = Tools::getValue('datetime_block');
                        $obj = new KbBookingProduct((int)  Tools::getValue('id_booking_product'));
                        $this->context->smarty->assign(
                            array(
                                'kbajaxcounter' => $counter,
                                'product_type' => (isset($obj->product_type))?$obj->product_type:'',
                                'currency' => $this->context->currency,
                                'is_time_ajax' => true,
                                'datetime_block' => $datetime_block,
                                'id_booking_product' => Tools::getValue('id_booking_product')
                            )
                        );
                        
                        $this->json = $this->context->smarty->fetch($this->getKbTemplateDir() . 'bookingProduct/date_time_block_product.tpl');
                        break;
                }
            }
            if (!$renderhtml) {
                echo Tools::jsonEncode($this->json);
            }
            die;
        } elseif (Tools::isSubmit('multiaction') && Tools::getValue('multiaction')) {
            $this->processMultiAction();
        } else {
            $id_product = Tools::getValue('id_product', 0);
            $form_key = Tools::encrypt($this->seller_info['id_seller'] . $this->controller_name . 'productform');

            if ($id_product == 0 && Tools::isSubmit('productformkey')
                && Tools::getValue('productformkey') == $form_key) {
//                print_r(Tools::getAllValues());
//                die;
                $this->processAdd();
            } elseif ($id_product > 0) {
                if (KbSellerProduct::isSellerProduct($this->seller_info['id_seller'], $id_product)) {
                    if (Tools::getIsset('deleteProduct') && Tools::getValue('deleteProduct') == 1) {
                        $this->processDelete();
                    } elseif (Tools::isSubmit('productformkey') && Tools::getValue('productformkey') == $form_key) {
                        $this->processUpdate();
                    }
                } else {
                    $this->context->smarty->assign('permission_error', true);
                    $this->Kberrors[] = $this->module->l('You do not have permission on this product.', $this->controller_name);
                }
            }
        }
    }

    public function initContent()
    {
        if (Tools::getIsset('render_type') && Tools::getValue('render_type') == 'form' && Tools::getIsset('addProductRoom') && Tools::getValue('addProductRoom', '') == 1) {
            $this->renderProductRoomForm();
        } elseif (Tools::getIsset('render_type') && Tools::getValue('render_type') == 'form' && Tools::getIsset('updateProductRoom') && (int) Tools::getValue('updateProductRoom') == 1) {
            $id_booking_product = (int) Tools::getValue('id_booking_product');
            if ((int) Tools::getValue('id_booking_room_facilities_map') != 0) {
                $id_room = (int) Tools::getValue('id_booking_room_facilities_map');
                $this->renderProductRoomForm('update', $id_room, $id_booking_product);
            } else {
                $this->renderProductRoomForm('add', 0, $id_booking_product);
            }
        } elseif (Tools::getIsset('action_type') && Tools::getValue('action_type') == 'saveRoomData') {
            $this->processSubmitProductRoom();
        } elseif (Tools::getIsset('render_type') && Tools::getValue('render_type') == 'form') {
            $this->renderProductForm();
        } elseif (Tools::getIsset('render_type') && Tools::getValue('render_type') == 'form' && Tools::getIsset('deleteProductRoom') && (int) Tools::getValue('deleteProductRoom') == 1) {
            if ((int) Tools::getValue('id_booking_room_facilities_map') != 0) {
                $id_booking_room_facilities_map = Tools::getValue('id_booking_room_facilities_map');
                $id_booking_product = Tools::getValue('id_booking_product');
                if (!empty($id_booking_room_facilities_map) && !empty($id_booking_product)) {
                    $rec = Db::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'kb_booking_product_room_facilities_mapping WHERE id_booking_room_facilities_map='.(int)$id_booking_room_facilities_map);
                    if ($rec) {
                        $booking_prod_obj = new KbBookingProduct((int) $id_booking_product);
                        $this->context->cookie->__set(
                            'redirect_success',
                            $this->module->l('The Selected room has been deleted successfully.', $this->controller_name)
                        );
                        $redirect_link = $this->context->link->getModuleLink(
                            $this->kb_module_name,
                            $this->controller_name,
                            array('render_type' => 'form', 'step' => 2, 'id_product' => $booking_prod_obj->id_product, 'id_booking_product' => $id_booking_product),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        );
                        Tools::redirect($redirect_link);
                    }
                }
            } else {
                $this->context->cookie->__set(
                    'redirect_error',
                    $this->module->l('You do not have permission to delete this room.', $this->controller_name)
                );
                $redirect_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                Tools::redirect($redirect_link);
            }
        } else {
            $this->renderList();
        }

        parent::initContent();
    }
    
    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();
        if (isset($page['meta']) && $this->seller_info) {
            $page_title = $this->module->l('Booking Products', $this->controller_name);
            $page['meta']['title'] =  $page_title;
            $page['meta']['keywords'] = $this->seller_info['meta_keyword'];
            $page['meta']['description'] = $this->seller_info['meta_description'];
        }
        return $page;
    }
    
    public function renderList()
    {
        $this->total_records = KbSellerProduct::getSellerBookingProducts($this->seller_info['id_seller'], true);
        if ($this->total_records > 0) {
            $categories = $this->getCategoryList();
            $filter_category_list = array();
            foreach ($categories as $cat) {
                $filter_category_list[] = array('value' => $cat['id_category'], 'label' => $cat['name']);
            }
            
            $tmp = KbGlobal::getApporvalStatus();
            
            $approve_statuses = array();
            foreach ($tmp as $key => $val) {
                $approve_statuses[] = array(
                    'value' => $key,
                    'label' => $val
                );
            }
            
            $booking_product_types = array();
            $booking_product_types = array(
                0 => array(
                    'label' => $this->product_type_arr['appointment'],
                    'value' => 'appointment'
                ),
                1 => array(
                    'label' => $this->product_type_arr['hotel_booking'],
                    'value' => 'hotel_booking'
                ),
                2 => array(
                    'label' => $this->product_type_arr['daily_rental'],
                    'value' => 'daily_rental'
                ),
                3 => array(
                    'label' => $this->product_type_arr['hourly_rental'],
                    'value' => 'hourly_rental'
                )
            );
             
            
            $this->filter_header = $this->module->l('Filter Your Search', $this->controller_name);
            
            $this->filter_id = 'seller_product';
            $this->filters = array(
                array(
                    'type' => 'text',
                    'name' => 'reference',
                    'label' => $this->module->l('Reference', $this->controller_name),
                ),
                array(
                    'type' => 'text',
                    'name' => 'name',
                    'label' => $this->module->l('Product Name', $this->controller_name),
                ),
                array(
                    'type' => 'select',
                    'placeholder' => $this->module->l('Select', $this->controller_name),
                    'name' => 'id_category_default',
                    'label' => $this->module->l('Booking Type', $this->controller_name),
                    'values' => $booking_product_types,
//                    'validate' => 'isInt'
                ),
                array(
                    'type' => 'select',
                    'placeholder' => $this->module->l('Select', $this->controller_name),
                    'name' => 'approved',
                    'label' => $this->module->l('Status', $this->controller_name),
                    'values' => $approve_statuses,
                    'validate' => 'isInt'
                ),
                array(
                    'type' => 'select',
                    'placeholder' => $this->module->l('Select', $this->controller_name),
                    'name' => 'active',
                    'label' => $this->module->l('Active', $this->controller_name),
                    'values' => array(
                        array('value' => 0, 'label' => $this->module->l('No', $this->controller_name)),
                        array('value' => 1, 'label' => $this->module->l('Yes', $this->controller_name))),
                    'validate' => 'isInt'
                )
            );
            $this->filter_action_name = 'getSellerProducts';
            $this->context->smarty->assign('kbfilter', $this->renderKbListFilter());

            $this->table_id = $this->filter_id;
            $this->table_header = array(
                array(
                    'label' => $this->module->l('ID', $this->controller_name),
                    'align' => 'right',
                    'class' => '',
                    'width' => '60'
                ),
                array(
                    'label' => $this->module->l('Product Image', $this->controller_name),
                    'align' => 'right',
                    'class' => '',
                    'width' => '60'
                ),
                // changes over
                array(
                    'label' => $this->module->l('Product Name', $this->controller_name),
                    'align' => 'left',
                    'class' => '',
                ),
                array(
                    'label' => $this->module->l('Reference', $this->controller_name),
                    'align' => 'left',
                    'class' => '',
                    'width' => '120',
                ),
                array(
                    'label' => $this->module->l('Booking Type', $this->controller_name),
                    'align' => 'left',
                    'class' => '',
                ),
                array(
                    'label' => $this->module->l('Status', $this->controller_name),
                    'align' => 'left',
                    'width' => '80',
                ),
                array(
                    'label' => $this->module->l('Active', $this->controller_name),
                    'align' => 'left',
                    'class' => '',
                    'width' => '40',
                ),
                array(
                    'label' => $this->module->l('Action', $this->controller_name),
                    'align' => 'left',
                    'class' => '',
                    'width' => '90',
                )
            );

            $orderby = null;
            if (Tools::getIsset('orderby') && Tools::getValue('orderby') != '') {
                $orderby = Tools::getValue('orderby');
            }

            $orderway = null;
            if (Tools::getIsset('orderway') && Tools::getValue('orderway') != '') {
                $orderway = Tools::getValue('orderway');
            }

            $sellers_products = KbSellerProduct::getSellerBookingProducts(
                $this->seller_info['id_seller'],
                false,
                $this->getPageStart(),
                $this->tbl_row_limit,
                $orderby,
                $orderway
            );
//            print_r($sellers_products);
//            die;
            foreach ($sellers_products as $val) {
                $product = new Product($val['id_product'], false, $this->seller_info['id_default_lang']);
                $seller_product = Db::getInstance()->getRow(
                    'SELECT * FROM '._DB_PREFIX_.'kb_mp_seller_product_tracking'
                    . ' WHERE id_product='. (int) $val['id_product']
                );
                $cat = new Category($product->id_category_default, $this->seller_info['id_default_lang']);
                // changes by rishabh jain
                $sql = 'SELECT SQL_CALC_FOUND_ROWS 
                        sav.`quantity`  AS `sav_quantity`
                        FROM  ' . _DB_PREFIX_ . 'product p 
                        LEFT JOIN ' . _DB_PREFIX_ . 'product_lang pl ON (pl.`id_product` = p.`id_product` AND pl.`id_lang` = 1 AND pl.`id_shop` = 1) 
                        LEFT JOIN ' . _DB_PREFIX_ . 'stock_available sav ON (sav.`id_product` = p.`id_product` AND sav.`id_product_attribute` = 0 AND sav.id_shop = 1  AND sav.id_shop_group = 0 ) 
                        JOIN ' . _DB_PREFIX_ . 'product_shop sa ON (p.`id_product` = sa.`id_product` AND sa.id_shop = 1) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'category_lang` cl ON (sa.`id_category_default` = cl.`id_category` AND cl.`id_lang` = 1 AND cl.id_shop = 1) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'category` c ON (c.`id_category` = cl.`id_category`) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'shop` shop ON (shop.id_shop = 1) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'image_shop` image_shop ON (image_shop.`id_product` = p.`id_product` AND image_shop.`cover` = 1 AND image_shop.id_shop = 1) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'image` i ON (i.`id_image` = image_shop.`id_image`) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'product_download` pd ON (pd.`id_product` = p.`id_product`) 
                       WHERE p.id_product = '.  $val['id_product']
                ;
                $link = new Link;
                $results = DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
                $quantity = $results;
                $image = Image::getCover($product->id);
                $link = new Link;
                $image_link = $image ? 'http://'.$link->getImageLink($product->link_rewrite, $image['id_image'], ImageType::getFormattedName('home')) : false;
                if ($image_link == '') {
                    $image_link = $this->getImgDirUrl() . _THEME_PROD_DIR_ . Language::getIsoById((int) $this->context->language->id) . '.jpg';
                }
                // changes over
                $edit_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array('render_type' => 'form', 'step' => 2, 'id_product' => $product->id, 'id_booking_product' => $val['id_booking_product']),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                );

                $view_link = $this->context->link->getProductLink(
                    $product,
                    null,
                    null,
                    null,
                    $this->seller_info['id_default_lang']
                );

                $yes_txt = $this->module->l('Yes', $this->controller_name);
                $this->table_content[$product->id] = array(
                    array('value' => '#' . $product->id),
                    
                    // changes by rishabh jain
                    array(
                        'image' => array(
                        ),
                        'value' => $image_link,
                        'class' => '',
                    ),
                    // changes over
                    array(
                        'link' => array(
                            'href' => $view_link,
                            'function' => '',
                            'title' => $this->module->l('Click to view product', $this->controller_name),
                            'target' => '_blank'
                        ),
                        'value' => $product->name,
                        'class' => '',
                    ),
                    
                    array('value' => $product->reference),
                    array('value' => $this->product_type_arr[$val['product_type']]),
                    array('value' => KbGlobal::getApporvalStatus($val['approved'])),
                    array('value' => (!empty($seller_product) || $product->active) ? $yes_txt : $this->module->l('No', $this->controller_name)),
                    array(
                        'actions' => array(
                            array(
                                'href' => $edit_link,
                                'title' => $this->module->l('Click to edit product', $this->controller_name),
                                'icon-class' => '&#xe22b'
                            ),
                            array(
                                'title' => $this->module->l('Click to delete product', $this->controller_name),
                                'function' => 'KbDeleteAction('.$product->id.')',
                                'icon-class' => '&#xe872'
                            )
                        )
                    ),
                );
            }

            $this->table_enable_multiaction = true;
            $this->list_row_callback = $this->filter_action_name;

            //Show Multi actions
            $this->kb_multiaction_params['multiaction_values'] = array(
                array(
                    'label' => $this->module->l('Status Update', $this->controller_name),
                    'value' => KbGlobal::MULTI_ACTION_TYPE_STATUS
                ),
                array(
                    'label' => $this->module->l('Delete', $this->controller_name),
                    'value' => KbGlobal::MULTI_ACTION_TYPE_DELETE
                )
            );

            $this->kb_multiaction_params['show_status_on_multiaction_value'] = 1;
            $this->kb_multiaction_params['has_status_dropdown'] = true;

            $this->kb_multiaction_params['status_dropdown_values'] = array(
                array('label' => $this->module->l('Enable', $this->controller_name), 'value' => 1),
                array('label' => $this->module->l('Disable', $this->controller_name), 'value' => 0)
            );

            $this->kb_multiaction_params['multiaction_related_to_table'] = $this->table_id;
            $this->kb_multiaction_params['has_reason_popup'] = true;
            $this->kb_multiaction_params['submit_action'] = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array('multiaction' => true),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );

            $this->context->smarty->assign('kbmutiaction', $this->renderKbMultiAction());
        }

        $this->context->smarty->assign('kblist', $this->renderKbList());
        $this->context->smarty->assign(array(
            'new_product_link' => $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array('render_type' => 'form'),
                (bool)Configuration::get('PS_SSL_ENABLED')
            )
        ));

        $this->setKbTemplate('bookingProduct/list.tpl');
    }

    
    public function renderProductRoomForm($action = 'add', $id_booking_room_facilities_map = 0, $id_booking_product = 0)
    {
        /*
         * We have added the compatibility with our Booking Calender plugin and we are using the function of that module class
         * that's why we have used its function.
         */
        $available_room_category = KbBookingRoomCategory::getAvailableRoomCategory();
        /*
         * We have added the compatibility with our Booking Calender plugin and we are using the function of that module class
         * that's why we have used its function.
         */
        $available_room_type = KbBookingRoomType::getAvailableRoomType();
        /*
         * We have added the compatibility with our Booking Calender plugin and we are using the function of that module class
         * that's why we have used its function.
         */
        $available_facilities = KbBookingFacilities::getAvailableFacilitiesByType('room');

        array_unshift($available_room_category, array('id_booking_category' => null, 'name' => $this->module->l('Select Category', $this->controller_name)));
        array_unshift($available_room_type, array('id_room_type' => null, 'room_name' => $this->module->l('Select Room Type', $this->controller_name)));
        
        $db_value = array();
        if ($action == 'update' && !empty($id_booking_room_facilities_map)) {
            $db_value = Db::getInstance()->getRow('SELECT a.* FROM '._DB_PREFIX_.'kb_booking_product_room_facilities_mapping a WHERE id_booking_room_facilities_map='.(int)$id_booking_room_facilities_map);
        }
//        print_r($available_facilities);
//        print_r($available_room_type);
//        print_r($db_value);
//        die;
        $image_en_start_url = false;
        if (!empty($db_value)) {
            $image_upload = Tools::jsonDecode($db_value['upload_images'], true);
            if (!empty($image_upload)) {
                foreach ($image_upload as $key => $img) {
                    $image_en_start = $img['path'];
                    $image_en_start_url .= ImageManager::thumbnail($image_en_start, 'productroom_' . (int) $key . '.jpg', 50, $this->imageType, true, true);
                }
            }
        }
        $this->context->smarty->assign('available_room_category', $available_room_category);
        $this->context->smarty->assign('available_facilities', $available_facilities);
        $this->context->smarty->assign('available_room_type', $available_room_type);
        $this->context->smarty->assign('product_room_data', $db_value);
        $this->context->smarty->assign('id_booking_product', $id_booking_product);
        $this->context->smarty->assign('image_en_start_url', $image_en_start_url);
        $this->context->smarty->assign(
            'room_submit_url',
            $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(
                    'action_type' => 'saveRoomData',
                    'id_room_mapping' => (int) $id_booking_room_facilities_map
                ),
                (bool) Configuration::get('PS_SSL_ENABLED')
            )
        );
//        print_r($image_en_start_url);die;
        $this->setKbTemplate('bookingProduct/room_form.tpl');
    }
    public function renderProductForm()
    {
        $step = 1;
        $url_param = array(
            'render_type' => 'form',
            'step' => 1
        );

        $id_product = 0;
        $id_booking_product = 0;
        $product_form_heading = $this->module->l('New Product', $this->controller_name);
        if (Tools::getIsset('id_product') && Tools::getValue('id_product') > 0) {
            $step = 2;
            $id_product = (int)Tools::getValue('id_product');
            $id_booking_product = (int)Tools::getValue('id_booking_product');
        }
        //check for product limit
        // Removed this condition from check by Ashish on 2 Feb 2018. I think count should be checked in every condition.
        // && (!$this->seller_obj->isApprovedSeller() || $this->seller_obj->active == 0)
        if ($id_product == 0) {
            /* Product Add Count Condition Changed By Ashish on 2nd Fed 2018. */
            $added_product_count = KbSellerProduct::getSellerProducts($this->seller_info['id_seller'], true);
            //$added_product_count = $this->seller_obj->product_limit_wout_approval;
            $product_limit = KbSellerSetting::getSellerSettingByKey($this->seller_obj->id, 'kbmp_product_limit');
            $error_txt = $this->module->l('Your limit of adding new products has been over as your account is not approved.', $this->controller_name);
            $error_txt .= $this->module->l('To add more products, please contact to admin.', $this->controller_name);
            /* Changes(next line) done by rishabh on 19th july to fix issue.
            If sellers account is approved by admin even they are not able to add new products. Product limit setting in admin panel is only for the non-approved sellers
                and if sellers account is approved then there was no limit on the product but still approved sellers are not able to add new products
            */
            //print_r($this->seller_info);
            if ((int) $this->seller_info['approved'] != 1) {
                if ($added_product_count >= $product_limit) {
                    $this->context->cookie->__set(
                        'redirect_error',
                        $error_txt
                    );

                    Tools::redirect($this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    ));
                }
            }
        }

        if (Tools::getIsset('step') && Tools::getValue('step') == 2) {
            $step = (int)Tools::getValue('step');
            $url_param['step'] = $step;
        }
//        print_r(Tools::getAllValues());
//        die;
        if ($step == 1 && Tools::isSubmit('submitproducttype')) {
            $step = 2;
            $url_param['step'] = 2;
        }

        $default_lang_js_path = $this->getKbModuleDir() . 'libraries/tinymce/langs/'
            .Language::getIsoById($this->default_form_language).'.js';
        if (file_exists($default_lang_js_path)) {
            $editor_lang = Language::getIsoById($this->default_form_language);
        } else {
            $editor_lang = 'en';
        }
        if ($step == 2) {
            //$id_product = 5;
            if ($id_product > 0 && !KbSellerProduct::isSellerProduct($this->seller_info['id_seller'], $id_product)) {
                $this->context->smarty->assign('permission_error', true);
                $this->Kberrors[] = $this->module->l('You do not have permission to edit this product.', $this->controller_name);
            } else {
                if (!empty($id_product)) {
                    $this->kb_product = new Product($id_product, false, $this->default_form_language);
                    $this->kb_booking_product = new KbBookingProduct($id_booking_product);
                    $product_form_heading = $this->module->l('Edit', $this->controller_name)
                        . ': ' . $this->kb_product->name;

                    $this->seller_product = KbSellerProduct::getLoadedObject(
                        $this->seller_info['id_seller'],
                        $id_product
                    );
                } else {
                    $this->kb_product = new Product();
                    $this->kb_booking_product = new KbBookingProduct();
                }

                if ($id_product > 0) {
                    $product_type = $this->kb_booking_product->product_type;
                } else {
                    $product_type = Tools::getValue('kb_product_type');
                }
                if ($product_type == 'hotel_booking') {
                    $this->available_tabs = array_merge(
                        $this->available_tabs,
                        array(
                            'Rooms' => 6,
                            'Facilities' => 7,
                        )
                    );
                } elseif ($product_type == 'hourly_rental' || $product_type == 'daily_rental') {
                    $this->available_tabs = array_merge(
                        $this->available_tabs,
                        array(
                            'Facilities' => 6,
                        )
                    );
                }

                asort($this->available_tabs, SORT_NUMERIC);
                $this->context->smarty->assign('type_hourly_rental', 'hourly_rental');
                $this->context->smarty->assign('type_daily_rental', 'daily_rental');
                $this->context->smarty->assign('type_appointment', 'appointment');
                $this->context->smarty->assign('type_hotel_booking', 'hotel_booking');
                
                $this->context->smarty->assign('available_tabs', $this->available_tabs);
                $this->context->smarty->assign('available_tabs_lang', $this->available_tabs_lang);
                $this->context->smarty->assign('product_type', $product_type);
                $this->context->smarty->assign('id_product', $id_product);
                $this->context->smarty->assign('id_booking_product', $id_booking_product);
                $this->context->smarty->assign('editor_lang', $editor_lang);
                $this->context->smarty->assign('default_lang', $this->default_form_language);

                if ($id_product > 0) {
                    $del_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(
                            'render_type' => 'form',
                            'step' => 2,
                            'id_product' => $id_product,
                            'deleteProduct' => 1
                        ),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    );
                    $delete_link_js = 'if (confirm("' . $this->module->l('Are You Sure?', $this->controller_name)
                        . '")){document.location.href = "' . Tools::safeOutput($del_link) . '"; return false;}';

                    $this->context->smarty->assign(
                        'delete_link_js',
                        $delete_link_js
                    );
                }

                $this->initForm();
            }
        }

        
        $this->context->smarty->assign('product_form_heading', $product_form_heading);
        $formkey = Tools::encrypt($this->seller_info['id_seller'] . $this->controller_name . 'productform');
        $this->context->smarty->assign('formkey', $formkey);
        $this->context->smarty->assign('id_product', $id_product);
        $this->context->smarty->assign('editor_lang', $editor_lang);
        $this->context->smarty->assign('default_lang', $this->default_form_language);

        $this->context->smarty->assign(
            'form_submit_url',
            $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                $url_param,
                (bool)Configuration::get('PS_SSL_ENABLED')
            )
        );

        $this->context->smarty->assign('product_template_dir', $this->getKbTemplateDir() . 'bookingProduct/');
        $this->context->smarty->assign('step', $step);
        $languages = Language::getLanguages(true);
        $this->context->smarty->assign('languages', $languages);
        $this->context->smarty->assign('kb_img_frmats', $this->img_formats);
        /* changes done by rishabh jain
         * DOM : 26/10/18
         * to fix the Smart cache for JavaScript issue for tiny mce
         */
        $is_sll_enabled = $this->checkSecureUrl();
        if ($is_sll_enabled) {
            $js_file = _PS_BASE_URL_SSL_ . __PS_BASE_URI__ . 'modules/kbmarketplace/libraries/tinymce/tinymce.min.js';
            $js_velovalidation = _PS_BASE_URL_SSL_ . __PS_BASE_URI__ . 'modules/kbmarketplace/views/js/front/velovalidation.js';
        } else {
            $js_file = _PS_BASE_URL_ . __PS_BASE_URI__ . 'modules/kbmarketplace/libraries/tinymce/tinymce.min.js';
            $js_velovalidation = _PS_BASE_URL_ . __PS_BASE_URI__ . 'modules/kbmarketplace/views/js/front/velovalidation.js';
        }
//      $js_file = _PS_BASE_URL_SSL_ . __PS_BASE_URI__ .'modules/kbmarketplace/libraries/tinymce/tinymce.min.js';
        $this->context->smarty->assign('tiny_mce_js_file', $js_file);
        $this->context->smarty->assign('js_velovalidation', $js_velovalidation);
        /* changes over */
        $this->setKbTemplate('bookingProduct/form.tpl');
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
    
    public function getAjaxProductList()
    {
        $query = Tools::getValue('q', false);
        if (!$query || $query == '' || Tools::strlen($query) < 1) {
            die;
        }

        $excludeIds = Tools::getValue('excludeIds', false);
        if ($excludeIds && $excludeIds != 'NaN') {
            $excludeIds = implode(',', array_map('intval', explode(',', $excludeIds)));
        } else {
            $excludeIds = '';
        }

        $excludeVirtuals = (bool)Tools::getValue('excludeVirtuals', false);
        $exclude_packs = (bool)Tools::getValue('exclude_packs', false);

        $sql = 'SELECT p.`id_product`, pl.`link_rewrite`, p.`reference`, pl.`name`, 
			MAX(image_shop.`id_image`) id_image, il.`legend` FROM `' . _DB_PREFIX_ . 'product` p 
			INNER JOIN ' . _DB_PREFIX_ . 'kb_mp_seller_product as sl on (p.id_product = sl.id_product 
			AND sl.id_seller = ' . (int)$this->seller_obj->id . ') 
			LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (pl.id_product = p.id_product 
			AND pl.id_lang = ' . (int)$this->default_form_language . Shop::addSqlRestrictionOnLang('pl') . ') 
			LEFT JOIN `' . _DB_PREFIX_ . 'image` i ON (i.`id_product` = p.`id_product`) '
            . Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1')
            . ' LEFT JOIN `' . _DB_PREFIX_ . 'image_lang` il ON (i.`id_image` = il.`id_image` 
			AND il.`id_lang` = ' . (int)$this->default_form_language . ') 
			WHERE (pl.name LIKE \'%' . pSQL($query) . '%\' OR p.reference LIKE \'%' . pSQL($query) . '%\') '
            . (!empty($excludeIds) ? ' AND p.id_product NOT IN (' . pSQL($excludeIds) . ') ' : ' ') .
            ($excludeVirtuals ? 'AND p.id_product NOT IN (SELECT pd.id_product 
				FROM `' . _DB_PREFIX_ . 'product_download` pd WHERE (pd.id_product = p.id_product))' : '') .
            ($exclude_packs ? 'AND (p.cache_is_pack IS NULL OR p.cache_is_pack = 0)' : '') .
            ' GROUP BY p.id_product';

        $items = Db::getInstance()->executeS($sql);

        if ($items) {
            $img_tmp1 = 'home';
            $img_tmp2 = '_default';
            $img_thumb_type = $img_tmp1 . $img_tmp2;

            // packs
            $results = array();
            foreach ($items as $item) {
                if (Combination::isFeatureActive()) {
                    $sql = 'SELECT pa.`id_product_attribute`, pa.`reference`, ag.`id_attribute_group`, 
								pai.`id_image`, agl.`name` AS group_name, al.`name` AS attribute_name, 
								a.`id_attribute` FROM `' . _DB_PREFIX_ . 'product_attribute` pa '
                        . Shop::addSqlAssociation('product_attribute', 'pa') . ' 
								LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute_combination` pac 
								ON pac.`id_product_attribute` = pa.`id_product_attribute` 
								LEFT JOIN `' . _DB_PREFIX_ . 'attribute` a ON a.`id_attribute` = pac.`id_attribute` 
								LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group` ag 
								ON ag.`id_attribute_group` = a.`id_attribute_group` 
								LEFT JOIN `' . _DB_PREFIX_ . 'attribute_lang` al 
								ON (a.`id_attribute` = al.`id_attribute` 
								AND al.`id_lang` = ' . (int)$this->default_form_language . ') 
								LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group_lang` agl 
								ON (ag.`id_attribute_group` = agl.`id_attribute_group` 
								AND agl.`id_lang` = ' . (int)$this->default_form_language . ') 
								LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute_image` pai 
								ON pai.`id_product_attribute` = pa.`id_product_attribute` 
								WHERE pa.`id_product` = ' . (int)$item['id_product'] . ' 
								GROUP BY pa.`id_product_attribute`, ag.`id_attribute_group` 
								ORDER BY pa.`id_product_attribute`';

                    $combinations = Db::getInstance()->executeS($sql);
                    if (!empty($combinations)) {
                        foreach ($combinations as $combination) {
                            $tmp1 = $combination['id_product_attribute'];
                            $results[$tmp1]['id'] = $item['id_product'];
                            $results[$tmp1]['id_product_attribute'] = $combination['id_product_attribute'];
                            if (!empty($results[$tmp1]['name'])) {
                                $results[$tmp1]['name'] .= ' ' . $combination['group_name']
                                    . '-' . $combination['attribute_name'];
                            } else {
                                $results[$combination['id_product_attribute']]['name'] = $item['name']
                                    . ' ' . $combination['group_name'] . '-' . $combination['attribute_name'];
                            }

                            if (!empty($combination['reference'])) {
                                $results[$tmp1]['ref'] = $combination['reference'];
                            } else {
                                $results[$tmp1]['ref'] = !empty($item['reference']) ? $item['reference'] : '';
                            }
                            if (empty($results[$tmp1]['image'])) {
                                $results[$tmp1]['image'] = str_replace(
                                    'http://',
                                    Tools::getShopProtocol(),
                                    $this->context->link->getImageLink(
                                        $item['link_rewrite'],
                                        $combination['id_image'],
                                        $img_thumb_type
                                    )
                                );
                            }
                        }
                    } else {
                        $product = array(
                            'id' => (int)($item['id_product']),
                            'name' => $item['name'],
                            'ref' => (!empty($item['reference']) ? $item['reference'] : ''),
                            'image' => str_replace(
                                'http://',
                                Tools::getShopProtocol(),
                                $this->context->link->getImageLink(
                                    $item['link_rewrite'],
                                    $item['id_image'],
                                    $img_thumb_type
                                )
                            ),
                        );
                        array_push($results, $product);
                    }
                } else {
                    $product = array(
                        'id' => (int)($item['id_product']),
                        'name' => $item['name'],
                        'ref' => (!empty($item['reference']) ? $item['reference'] : ''),
                        'image' => str_replace(
                            'http://',
                            Tools::getShopProtocol(),
                            $this->context->link->getImageLink(
                                $item['link_rewrite'],
                                $item['id_image'],
                                $img_thumb_type
                            )
                        ),
                    );
                    array_push($results, $product);
                }
            }
            $results = array_values($results);
            echo Tools::jsonEncode($results);
        } else {
            Tools::jsonEncode(new stdClass);
        }
    }

    private function initForm()
    {
        $tabs = array();
        if (count($this->available_tabs) > 0) {
            foreach ($this->available_tabs as $tab => $sort_order) {
                $tmp = $sort_order;
                unset($tmp);
                if (method_exists($this, 'initForm' . $tab)) {
                    $tabs[] = $this->{'initForm' . $tab}();
                }
            }
        }

        $this->context->smarty->assign('tabs_display', $tabs);
    }

    public function initFormGeneralInformations()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['GeneralInformations']);
        
        $languages = Language::getLanguages(true);
        $id_product = (int) Tools::getValue('id_product');

        $name = array();
        $description_short = array();
        $description = array();
        foreach ($languages as $language) {
            $product_lang = new Product($id_product, false, $language['id_lang']);
            $name[$language['id_lang']] = $product_lang->name;
            $description_short[$language['id_lang']] = $product_lang->description_short;
            $description[$language['id_lang']] = $product_lang->description;
        }

        $this->context->smarty->assign('name', $name);
        $this->context->smarty->assign('description_short', $description_short);
        $this->context->smarty->assign('description', $description);
        
//        $properties = array('name', 'description_short', 'description');
//        foreach ($properties as $prop) {
//            $this->context->smarty->assign(
//                $prop,
//                $this->getFieldValue($this->kb_product, $prop, $this->default_form_language)
//            );
//        }

        $properties = array('reference', 'ean13', 'upc', 'active', 'visibility', 'condition', 'show_condition',
            'available_for_order');
        $seller_product = Db::getInstance()->getRow(
            'SELECT * FROM '._DB_PREFIX_.'kb_mp_seller_product_tracking'
            . ' WHERE id_product='. (int) Tools::getValue('id_product')
        );
        foreach ($properties as $prop) {
            $this->context->smarty->assign($prop, $this->getFieldValue($this->kb_product, $prop));
        }

        $short_description_limit = Configuration::get('PS_PRODUCT_SHORT_DESC_LIMIT')
            ? Configuration::get('PS_PRODUCT_SHORT_DESC_LIMIT') : 400;

        // changes by rishabh jain
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        
        $this->context->smarty->assign('seller_product', $seller_product);
        $this->context->smarty->assign('languages', $languages);
        $this->context->smarty->assign('short_description_limit', $short_description_limit);
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'bookingProduct/GeneralInformations.tpl');
    }
    
    public function initFormBookingInformations()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['BookingInformations']);
        $properties = array('star_rating', 'min_days', 'max_days','max_hours','min_hours','period_type','service_type','quantity','price');
//        print_r($this->kb_booking_product);
        $quantity_type = 'date';
        if ($this->kb_booking_product->id_booking_product > 0) {
            if ($this->kb_booking_product->period_type == 'date_time') {
                $quantity_type = 'date_time';
            }
            $product_type = $this->kb_booking_product->product_type;
        } else {
            $product_type = Tools::getValue('kb_product_type');
        }
        $period_type_array  = array('date' => 1, 'date_time' => 1);
        foreach ($properties as $key => $prop) {
            if ($product_type == 'appointment') {
                if ($prop == 'min_hours' ||
                        $prop == 'max_hours' ||
                        $prop == 'min_days' ||
                        $prop == 'star_rating' ||
                        $prop == 'max_days') {
                    unset($properties[$key]);
                }
            } elseif ($product_type == 'daily_rental') {
                if ($prop == 'service_type' ||
                        $prop == 'max_hours' ||
                        $prop == 'min_hours' ||
                        $prop == 'star_rating') {
                    unset($properties[$key]);
                }
            } elseif ($product_type == 'hourly_rental') {
                if ($prop == 'service_type' ||
                        $prop == 'min_days' ||
                        $prop == 'max_days' ||
                        $prop == 'star_rating') {
                    unset($properties[$key]);
                }
                if ($prop == 'period_type') {
                    unset($period_type_array['date_time']);
                }
            } elseif ($product_type == 'hotel_booking') {
                if ($prop == 'service_type' ||
                        $prop == 'min_hours' ||
                        $prop == 'quantity' ||
                        $prop == 'max_hours') {
                    unset($properties[$key]);
                }
                if ($prop == 'period_type') {
                    unset($period_type_array['date_time']);
                }
            }
        }
        foreach ($properties as $prop) {
            $this->context->smarty->assign(
                $prop,
                $this->getFieldValue($this->kb_booking_product, $prop, $this->default_form_language)
            );
        }
        $tax_rules_groups = array();
        $tax_grp = array();
        $tax_rules_groups = TaxRulesGroup::getTaxRulesGroups(true);
        $tax_grp[0]['id_tax_rules_group'] = 0;
        $tax_grp[0]['name'] = $this->module->l('No Tax', 'AdminKbBookingProductsController');
        $i = 1;
        foreach ($tax_rules_groups as $key => $tax_data) {
            $tax_grp[$i]['id_tax_rules_group'] = $tax_data['id_tax_rules_group'];
            $tax_grp[$i]['name'] = $tax_data['name'];
            $i++;
        }
        /* changes over */
        if ($this->kb_product->id_tax_rules_group == 0) {
            $this->context->smarty->assign('tax_id', 0);
        } else {
            $this->context->smarty->assign('tax_id', $this->kb_product->id_tax_rules_group);
        }
        /* changes over */
        $this->context->smarty->assign('tax_rules', $tax_grp);
        $this->context->smarty->assign('period_type_array', $period_type_array);
        $this->context->smarty->assign('quantity_type', $quantity_type);
        
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'bookingProduct/BookingInformations.tpl');
    }
    
    public function initFormLocation()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Location']);
        $properties = array('address', 'enable_product_map', 'longitude','latitude');
        foreach ($properties as $prop) {
            $this->context->smarty->assign(
                $prop,
                $this->getFieldValue($this->kb_booking_product, $prop, $this->default_form_language)
            );
        }
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'bookingProduct/location.tpl');
    }
    public function initFormDateTime()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['DateTime']);
        
        $booking_product = array();
        $available_days =   array(
                                array(
                                    'id' => '1',
                                    'name' => $this->module->l('Monday', $this->controller_name),
                                ),
                                array(
                                    'id' => '2',
                                    'name' => $this->module->l('Tuesday', $this->controller_name),
                                ),
                                array(
                                    'id' => '3',
                                    'name' => $this->module->l('Wednesday', $this->controller_name),
                                ),
                                array(
                                    'id' => '4',
                                    'name' => $this->module->l('Thursday', $this->controller_name),
                                ),
                                array(
                                    'id' => '5',
                                    'name' => $this->module->l('Friday', $this->controller_name),
                                ),
                                array(
                                    'id' => '6',
                                    'name' => $this->module->l('Saturday', $this->controller_name),
                                ),
                                array(
                                    'id' => '0',
                                    'name' => $this->module->l('Sunday', $this->controller_name),
                                ),
                            );
        $disable_days = Tools::jsonDecode($this->kb_booking_product->disable_days, true);
        foreach ($available_days as &$available_day) {
            if (isset($disable_days['disable_days_'.$available_day['id']])) {
                $available_day['is_selected'] = true;
            } else {
                $available_day['is_selected'] = false;
            }
        }
        
        $this->context->smarty->assign('booking_product', $booking_product);
        $this->context->smarty->assign('available_days', $available_days);
        $this->context->smarty->assign('currency', $this->context->currency);
//        print_r($this->kb_booking_product->date_details);
//        die;
        $this->context->smarty->assign('kb_date_data', Tools::jsonDecode($this->kb_booking_product->date_details, true));
        
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'bookingProduct/DateTime.tpl');
    }
    public function initFormRooms()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Rooms']);
        $product_rooms = array();
        if ($this->kb_booking_product->id_booking_product > 0) {
            $product_mapped_rooms_sql = 'SELECT a.*,rl.room_name,cl.name as category_name FROM '._DB_PREFIX_.'kb_booking_product_room_facilities_mapping a INNER JOIN '._DB_PREFIX_.'kb_booking_room_type_lang rl on (rl.id_room_type=a.id_room_type AND rl.id_lang=1 AND rl.id_shop=1) INNER JOIN '._DB_PREFIX_.'kb_booking_category_lang cl on (cl.id_booking_category=a.id_room_category AND cl.id_lang=1 AND cl.id_shop=1) where a.id_booking_product = '.(int) $this->kb_booking_product->id_booking_product;
            $product_rooms = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($product_mapped_rooms_sql);
        }
        $room_edit_link = '';
        $room_delete_link = '';
        if (count($product_rooms) > 0) {
            foreach ($product_rooms as &$room) {
                $room_edit_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'render_type' => 'form',
                        'id_booking_room_facilities_map' => $room['id_booking_room_facilities_map'],
                        'id_booking_product' => (int) $this->kb_booking_product->id_booking_product,
                        'updateProductRoom' => true
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $room_delete_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array(
                        'render_type' => 'form',
                        'id_booking_room_facilities_map' => $room['id_booking_room_facilities_map'],
                        'id_booking_product' => (int) $this->kb_booking_product->id_booking_product,
                        'deleteProductRoom' => true
                    ),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                );
                $room['edit_link'] = $room_edit_link;
                $room['delete_link'] = $room_delete_link;
            }
        }
        $edit_link = $this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            array(
                'render_type' => 'form',
                'id_booking_room_facilities_map' => 0,
                'id_booking_product' => (int) $this->kb_booking_product->id_booking_product,
                'updateProductRoom' => true
            ),
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        $this->context->smarty->assign('room_new_link', $edit_link);
        $this->context->smarty->assign('product_rooms', $product_rooms);
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'bookingProduct/Rooms.tpl');
    }
    public function initFormFacilities()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Facilities']);
        $mappedFacilities = array();
        $availibleFacilities = array();
        if ($this->kb_booking_product->id_booking_product > 0) {
            $product_type = $this->kb_booking_product->product_type;
        } else {
            $product_type = Tools::getValue('kb_product_type');
        }
        $feature_type = 'hotel';
        if ($product_type == 'hourly_rental' || $product_type == 'daily_rental') {
            $feature_type = 'rent';
        }
        if ($this->kb_booking_product->id) {
            /*
             * We have added the compatibility with our Booking Calender plugin and we are using the function of that module class
             * that's why we have used its function.
             */
            $availibleFacilities = KbBookingFacilities::getAvailableFacilitiesByType($feature_type);
            foreach ($availibleFacilities as $key => &$facility) {
                $facility['upload_image'] = '';
                $facility['upload_image_path'] = '';
            }
            /*
             * We have added the compatibility with our Booking Calender plugin and we are using the function of that module class
             * that's why we have used its function.
             */
            $mappedFacilities = KbBookingFacilities::getFacilitiesMappedwithProduct($this->kb_booking_product->id);
        }
        foreach ($availibleFacilities as $key => $availibleFacility) {
            foreach ($mappedFacilities as $key1 => $mappedFacility) {
                if ($availibleFacility['id_facilities'] == $mappedFacility['id_facilities']) {
                    unset($availibleFacilities[$key]);
                }
            }
        }
//        print_r($availibleFacilities);
//        print_r($mappedFacilities);
//        die;
        $this->context->smarty->assign('id_booking_product', (int) $this->kb_booking_product->id);
        $this->context->smarty->assign('mapped_facilities_product', $mappedFacilities);
        $this->context->smarty->assign('availibleFacilities', $availibleFacilities);
        
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'bookingProduct/Facilities.tpl');
    }
    /* Boc function added by
    * @author- Rishabh Jain
    * to add customization tab if enabled
    */
    
    /* changes over */
    
    /* Boc function added by
    * @author- Rishabh Jain
    * to add customization tab if enabled
    */
    public function initFormReturnpolicy()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Returnpolicy']);
        $velsof_returnmanager_data = Tools::unSerialize(Configuration::get('VELSOF_RETURNMANAGER'));
        if (isset($velsof_returnmanager_data['enable']) && $velsof_returnmanager_data['enable'] == 1) {
            if ($this->kb_product->id != '' && $this->kb_product->id > 0) {
                $id_product = Tools::getValue('id_product');
                $get_policy_qry = 'select distinct(return_data_id) from ' . _DB_PREFIX_ . 'velsof_return_policy_product
					where id_product="' . (int) $this->kb_product->id . '"';
                $policy_data = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($get_policy_qry);
                if ($policy_data) {
                    $policy = $policy_data[0]['return_data_id'];
                    $this->context->smarty->assign('velsof_return_policy', $policy);
                }
            }
            $velsof_returnmanager_data = Tools::unSerialize(Configuration::get('VELSOF_RETURNMANAGER'));
            if (isset($velsof_returnmanager_data['policy']['default']) && ($velsof_returnmanager_data['policy']['default'] != 0)) {
                $this->context->smarty->assign('velsof_default_return_policy', $velsof_returnmanager_data['policy']['default']);
            }
            $return_manager_module_obj = Module::getInstanceByName('returnmanager');
            $policy_detail = $return_manager_module_obj->select('policy');
            $this->context->smarty->assign('policy', $policy_detail);
            $languages = Language::getLanguages(true);
            $this->context->smarty->assign('languages', $languages);
            $is_enable_custom_policy = 0;
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (isset($mp_config['enable_return_manager_policy_addition']) && $mp_config['enable_return_manager_policy_addition'] == 1) {
                $is_enable_custom_policy = 1;
            }
            $custom_ssl_var = 0;
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                $custom_ssl_var = 1;
            }
            if ((bool) Configuration::get('PS_SSL_ENABLED') && $custom_ssl_var == 1) {
                $ps_base_url = _PS_BASE_URL_SSL_;
            } else {
                $ps_base_url = _PS_BASE_URL_;
            }
            $this->context->smarty->assign('img_lang_dir', $ps_base_url . __PS_BASE_URI__ .
            str_replace(_PS_ROOT_DIR_ . '/', '', _PS_LANG_IMG_DIR_));
            $this->context->smarty->assign('is_enable_custom_policy', $is_enable_custom_policy);
            return $this->context->smarty->fetch($this->getKbTemplateDir().'product/returnpolicy.tpl');
        }
    }
    /* changes over */
    public function initFormPrices()
    {
        $tax_rules_groups = TaxRulesGroup::getTaxRulesGroups(true);
        $address = new Address();
        $tax_rates = array();
        $address->id_country = (int)$this->context->country->id;
        foreach ($tax_rules_groups as $tax_rules_group) {
            $id_tax_rules_group = (int)$tax_rules_group['id_tax_rules_group'];
            $tax_calculator = TaxManagerFactory::getManager($address, $id_tax_rules_group)->getTaxCalculator();
            $tax_rates[$id_tax_rules_group] = array(
                'id_tax_rules_group' => $id_tax_rules_group,
                'rates' => array(),
                'computation_method' => (int)$tax_calculator->computation_method
            );

            if (isset($tax_calculator->taxes) && count($tax_calculator->taxes)) {
                foreach ($tax_calculator->taxes as $tax) {
                    $tax_rates[$id_tax_rules_group]['rates'][] = (float)$tax->rate;
                }
            } else {
                $tax_rates[$id_tax_rules_group]['rates'][] = 0;
            }
        }
        $tax_rates[0] = array(
                'id_tax_rules_group' => 0,
                'rates' => array(),
                'computation_method' => 0
            );
        $tax_rates[0]['rates'][] = 0;
        $this->context->smarty->assign('tax_rates', Tools::jsonEncode($tax_rates));
        $taxes = TaxRulesGroup::getTaxRulesGroups(true);
        $tax_group = array();
        $tax_group[] = array(
            'id' => 0,
            'name' => $this->module->l('No Tax', $this->controller_name)
        );
        foreach ($taxes as $taxes_grp) {
            $tax_group[] = array(
                'id' => $taxes_grp['id_tax_rules_group'],
                'name' => $taxes_grp['name']
            );
        }
        $this->context->smarty->assign('tax_rules', $tax_group);
        // code added by rishabh jain for adding tax rule field */
        $discount_types = array();
        $discount_types[] = array(
            'id' => 0,
            'name' => $this->module->l('fixed', $this->controller_name)
            
        );
        $discount_types[] = array(
            'id' => 1,
            'name' => $this->module->l('Percentage', $this->controller_name)
            
        );
        $this->context->smarty->assign('discount_types', $discount_types);
        /* changes over */
        if ($this->kb_product->id_tax_rules_group == 0) {
            $this->context->smarty->assign('tax_id', 0);
        } else {
            $this->context->smarty->assign('tax_id', $this->kb_product->id_tax_rules_group);
        }
        /* changes over */
        
        /* changes started by rishabh jain
         * to add the option of selecting specific prices type
         */
        
        $properties = array('wholesale_price', 'price', 'on_sale');

        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Prices']);
        foreach ($properties as $prop) {
            $this->context->smarty->assign($prop, $this->getFieldValue($this->kb_product, $prop));
        }

        if ($this->kb_product->unit_price_ratio != 0) {
            $this->context->smarty->assign(
                'unit_price',
                Tools::ps_round($this->kb_product->price / $this->kb_product->unit_price_ratio, 2)
            );
        } else {
            $this->context->smarty->assign('unit_price', 0);
        }

        $p_actual_price = $this->getFieldValue($this->kb_product, 'price');
        $specific_price = Tools::ps_round(0, 2);
        $specific_price_from = '';
        $specific_price_to = '';

        $specific_prices = SpecificPrice::getByProductId((int)$this->kb_product->id);
        // chnages by rishabh jain
        $this->context->smarty->assign('discount_type', '0');
        $reduction_type = '';
        
        foreach ($specific_prices as $specific) {
            // changes by rishabh jain
            $reduction_type = $specific['reduction_type'];
            // changes over
            $tmp = (float)($specific['reduction']);
            if ($reduction_type == 'percentage') {
                $tmp = $tmp*100;
            }
            $specific_price = Tools::ps_round($tmp, 2);

            if ($specific['from'] != '0000-00-00 00:00:00') {
                $temp = new DateTime($specific['from']);
                $specific_price_from = $temp->format('Y-m-d');
            } else {
                $specific_price_from = '';
            }

            if ($specific['to'] != '0000-00-00 00:00:00') {
                $temp1 = new DateTime($specific['to']);
                $specific_price_to = $temp1->format('Y-m-d');
            } else {
                $specific_price_to = '';
            }
        }
        // changes started by rishabh jain
        // changes by rishabh jain
        $this->context->smarty->assign('unity', $this->kb_product->unity);
        if ($reduction_type == 'percentage') {
            $this->context->smarty->assign('discount_type', '1');
        }
        // changes over
        $this->context->smarty->assign('specific_price', $specific_price);
        $this->context->smarty->assign('specific_price_from', $specific_price_from);
        $this->context->smarty->assign('specific_price_to', $specific_price_to);
        if ($this->seller_currency->prefix != '') {
            $this->context->smarty->assign('currency_prefix', $this->seller_currency->prefix);
        } elseif ($this->context->currency->suffix != '') {
            $this->context->smarty->assign('currency_suffix', $this->seller_currency->suffix);
        }
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'product/price.tpl');
    }
    
    #BOOKMARK SUPPLIERS
    public function initFormSuppliers()
    {
        $id_product = 0;
        if (Tools::getIsset('id_product')) {
            $id_product = Tools::getValue('id_product');
        }

        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Suppliers']);

        // Get all available suppliers
        $suppliers = Supplier::getSuppliers();

        // Get already associated suppliers
        $associated_suppliers = ProductSupplier::getSupplierCollection($id_product);

        // Get already associated suppliers and force to retreive product declinaisons

        $default_supplier = 0;
        foreach ($suppliers as &$supplier) {
            $supplier['is_selected'] = false;
            $supplier['is_default']  = false;

            foreach ($associated_suppliers as $associated_supplier) {
                /** @var ProductSupplier $associated_supplier */
                if ($associated_supplier->id_supplier == $supplier['id_supplier']) {
                    $associated_supplier->name = $supplier['name'];
                    $supplier['is_selected'] = true;

                    if ($id_product == $supplier['id_supplier']) {
                        $supplier['is_default'] = true;
                        $default_supplier = $supplier['id_supplier'];
                    }
                }
            }
        }
        $obj_product = new Product($id_product);
        $default_supplier = $obj_product->id_supplier;
        /* changes by rishabh jain
         * to add option to add supplier
         */
        $default_country = (int) Configuration::get('PS_COUNTRY_DEFAULT');
        $countries = Country::getCountries((int) $this->context->cookie->id_lang, true);
        $this->context->smarty->assign('default_country', $default_country);
        $this->context->smarty->assign('countries', Tools::jsonEncode($countries));
        $this->context->smarty->assign('countries_array', $countries);

        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        $is_enable_custom_supplier = 0;
        if (isset($mp_config['enable_custom_supplier_addition']) && $mp_config['enable_custom_supplier_addition'] == 1) {
            $is_enable_custom_supplier = 1;
        }
        $this->context->smarty->assign('is_enable_custom_supplier', $is_enable_custom_supplier);
        // changes over
        $this->context->smarty->assign('suppliers', $suppliers);
        $this->context->smarty->assign('default_supplier', $default_supplier);
        $this->context->smarty->assign('id_product', $id_product);
        return $this->context->smarty->fetch($this->getKbTemplateDir().'product/suppliers.tpl');
    }

    public function initFormSeo()
    {
        $properties = array('meta_title', 'meta_description', 'meta_keywords', 'link_rewrite');

        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Seo']);
        foreach ($properties as $prop) {
            $this->context->smarty->assign(
                $prop,
                $this->getFieldValue($this->kb_product, $prop, $this->default_form_language)
            );
        }

        $this->context->smarty->assign('curent_shop_url', $this->context->shop->getBaseURL());
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'product/seo.tpl');
    }

    public function initFormImages()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Images']);

        $images = Image::getImages($this->default_form_language, $this->kb_product->id);
        foreach ($images as $k => $image) {
            $img_obj = new Image($image['id_image']);
            $img_obj->cover = (int)$img_obj->cover;
            $legend = $img_obj->legend[$this->default_form_language];
            $legend = addcslashes($legend, '\"');
            $img_obj->legend[$this->default_form_language] = $legend;
            $images[$k] = $img_obj;
        }
        $this->context->smarty->assign('id_default_category', $this->kb_product->id_category_default);
        $this->context->smarty->assign('product_name', $this->kb_product->name);
        $this->max_image_size = ((int)Configuration::get('PS_PRODUCT_PICTURE_MAX_SIZE') / 1024 / 1024);
        $this->context->smarty->assign('max_image_size', $this->max_image_size);
        $this->context->smarty->assign('images', $images);
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'bookingProduct/image.tpl');
    }

    public function initFormFeatures()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Features']);

        $kb_features = array();
        $available_store_features = Feature::getFeatures((int) $this->context->language->id);
        if ($available_store_features) {
            foreach ($available_store_features as $features) {
                $features_value = FeatureValue::getFeatureValuesWithLang(
                    (int) $this->context->language->id,
                    $features['id_feature']
                );
                
                $kb_features[$features['id_feature']] = array(
                    'name' => $features['name'],
                    'id_feature' => $features['id_feature']
                );
                if (count($features_value)) {
                    foreach ($features_value as $feature_value) {
                        $kb_features[$features['id_feature']]['value'][] = array(
                            'id_feature_value' => $feature_value['id_feature_value'],
                            'value' => $feature_value['value'],
                        );
                    }
                } else {
                    $kb_features[$features['id_feature']]['value'] = array();
                }
            }
        }
        
        $product_features = array();
        $get_product_features = $this->kb_product->getFeatures();
        if (count($get_product_features)) {
            foreach ($get_product_features as $single_feature) {
                if (isset($single_feature['custom']) && $single_feature['custom'] == '1') {
                    $product_features[$single_feature['id_feature']] = $this->getCustomValueByLangAndFeatureId(
                        (int) $this->default_form_language,
                        (int) $single_feature['id_feature_value']
                    );
                } else {
                    $product_features[$single_feature['id_feature']] = $single_feature['id_feature_value'];
                }
            }
        }
        /* changes started by rishabh jain
         * on 15/10/2018 to add an option to add custom features
         */
        //if ()
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        $enable_custom_features = 0;
        if (isset($mp_config['kbmp_enable_custom_features_addition']) && $mp_config['kbmp_enable_custom_features_addition'] == 1) {
            $enable_custom_features = 1;
        }
        $this->context->smarty->assign('custom_features', $enable_custom_features);
        /* changes over */
        $this->context->smarty->assign('product_features', $product_features);
        $this->context->smarty->assign('features', $kb_features);
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'product/features.tpl');
    }
    
    public function getCustomValueByLangAndFeatureId($id_lang, $id_feature_value)
    {
        $sql = 'SELECT value FROM '._DB_PREFIX_.'feature_value_lang where id_feature_value = '.(int) $id_feature_value.' and id_lang = '.(int)$id_lang;
        return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
    }
    
    /* changes over */
    public function processAddProductImage()
    {
        $product = new Product((int)Tools::getValue('id_product'));
        $legend = Tools::getValue('legend', '');

        if (!Validate::isLoadedObject($product)) {
            $files = array();
            $files[0]['error'] = $this->module->l('Cannot add image because product creation failed.', $this->controller_name);
        }

        $this->max_image_size = ((int)Configuration::get('PS_PRODUCT_PICTURE_MAX_SIZE') / 1024 / 1024);
        $image_uploader = new HelperImageUploader('file');
        $image_uploader->setAcceptTypes($this->img_formats)->setMaxSize($this->max_image_size);
        $files = $image_uploader->process();

        foreach ($files as &$file) {
            $image = new Image();
            $image->id_product = (int)($product->id);
            $image->position = Image::getHighestPosition($product->id) + 1;
            if (!empty($legend)) {
                $image->legend[(int)$this->seller_info['id_default_lang']] = $legend;
            }

            if (!Image::getCover($image->id_product)) {
                $image->cover = 1;
            } else {
                $image->cover = 0;
            }

            if (($validate = $image->validateFieldsLang(false, true)) !== true) {
                $file['error'] = $validate;
            }

            if (isset($file['error']) && (!is_numeric($file['error']) || $file['error'] != 0)) {
                continue;
            }

            if (!$image->add()) {
                $file['error'] = $this->module->l('Error while creating additional image.', $this->controller_name);
            } else {
                if (!$new_path = $image->getPathForCreation()) {
                    $file['error'] = $this->module->l('An error occurred during new folder creation.', $this->controller_name);
                    continue;
                }

                $error = 0;

                if (!ImageManager::resize(
                    $file['save_path'],
                    $new_path . '.' . $image->image_format,
                    null,
                    null,
                    'jpg',
                    false,
                    $error
                )) {
                    switch ($error) {
                        case ImageManager::ERROR_FILE_NOT_EXIST:
                            $file['error'] = $this->module->l('An error occurred while copying image, file does not exist anymore.', $this->controller_name);
                            break;
                        case ImageManager::ERROR_FILE_WIDTH:
                            $file['error'] = $this->module->l('An error occurred while copying image, file width is 0px.', $this->controller_name);
                            break;
                        case ImageManager::ERROR_MEMORY_LIMIT:
                            $file['error'] = $this->module->l('An error occurred while copying image, check your memory limit.', $this->controller_name);
                            break;
                        default:
                            $file['error'] = $this->module->l('An error occurred while copying image.', $this->controller_name);
                            break;
                    }
                    continue;
                } else {
                    $imagesTypes = ImageType::getImagesTypes('products');
                    foreach ($imagesTypes as $imageType) {
                        if (!ImageManager::resize(
                            $file['save_path'],
                            $new_path . '-' . Tools::stripslashes($imageType['name']) . '.' . $image->image_format,
                            $imageType['width'],
                            $imageType['height'],
                            $image->image_format
                        )
                        ) {
                            $file['error'] = sprintf(
                                $this->module->l('An error occurred while copying image: %s', $this->controller_name),
                                Tools::stripslashes($imageType['name'])
                            );
                            continue;
                        }
                    }
                }

                unlink($file['save_path']);

                //Necesary to prevent hacking
                unset($file['save_path']);
                Hook::exec('actionWatermark', array('id_image' => $image->id, 'id_product' => $product->id));

                if (!$image->update()) {
                    $file['error'] = $this->module->l('Error while updating status.', $this->controller_name);
                    continue;
                }

                // Associate image to shop from context
                $shops = array($this->seller_info['id_shop']);
                $image->associateTo($shops);
                $json_shops = array();

                foreach ($shops as $id_shop) {
                    $json_shops[$id_shop] = true;
                }

                $file['status'] = $this->module->l('Image successfully uploaded.', $this->controller_name);
                $file['id'] = $image->id;
                $file['position'] = $image->position;
                $file['cover'] = (int)$image->cover;
                if (isset($image->legend[(int)$this->seller_info['id_default_lang']])) {
                    $file['legend'] = $image->legend[(int)$this->seller_info['id_default_lang']];
                } else {
                    $file['legend'] = '';
                }
                $file['path'] = $image->getExistingImgPath();
                $file['shops'] = $json_shops;

                @unlink(_PS_TMP_IMG_DIR_ . 'product_' . (int)$product->id . '.jpg');
                @unlink(
                    _PS_TMP_IMG_DIR_ . 'product_mini_' . (int)$product->id
                    . '_' . $this->seller_info['id_shop'] . '.jpg'
                );
            }
        }

        return array($image_uploader->getName() => $files);
    }

    public function processDeleteImage()
    {
        $res = true;
        

        /* Delete product image */
        $image = new Image((int)Tools::getValue('id_image'));
        $this->content['id'] = $image->id;
        $res &= $image->delete();

        // if deleted image was the cover, change it to the first one
        if (!Image::getCover($image->id_product)) {
            $res &= Db::getInstance()->execute(
                'UPDATE `' . _DB_PREFIX_ . 'image_shop` image_shop, ' . _DB_PREFIX_ . 'image i 
                SET image_shop.`cover` = 1, 
                i.cover = 1 
                WHERE image_shop.`id_image` = (SELECT id_image FROM 
                (SELECT image_shop.id_image 
                FROM ' . _DB_PREFIX_ . 'image i ' .
                Shop::addSqlAssociation('image', 'i') . ' 
                WHERE i.id_product =' . (int)$image->id_product . ' LIMIT 1
                ) tmpImage) 
                AND id_shop=' . (int)$this->seller_info['id_shop'] . ' 
                AND i.id_image = image_shop.id_image
                '
            );
        }

        if (file_exists(_PS_TMP_IMG_DIR_ . 'product_' . $image->id_product . '.jpg')) {
            $res &= @unlink(_PS_TMP_IMG_DIR_ . 'product_' . $image->id_product . '.jpg');
        }
        if (file_exists(
            _PS_TMP_IMG_DIR_ . 'product_mini_' . $image->id_product
            . '_' . $this->seller_info['id_shop'] . '.jpg'
        )
        ) {
            $res &= @unlink(
                _PS_TMP_IMG_DIR_ . 'product_mini_' . $image->id_product
                . '_' . $this->seller_info['id_shop'] . '.jpg'
            );
        }
        
        $images = Image::getImages($this->default_form_language, (int)Tools::getValue('id_product'));
        
        
        foreach ($images as $k => $image) {
            $img_obj = new Image($image['id_image']);
            $img_obj->cover = (int)$img_obj->cover;
            $legend = $img_obj->legend[$this->default_form_language];
            $legend = addcslashes($legend, '\"');
            $img_obj->legend[$this->default_form_language] = $legend;
            $images[$k] = $img_obj;
        }
        if ($res) {
            return array(
                'status' => true,
                'msg' => $this->module->l('Image successfully deleted.', $this->controller_name),
                'images' => $images
            );
        } else {
            return array(
                'status' => true,
                'msg' => $this->module->l('Error occurred while deleting image.', $this->controller_name)
            );
        }
    }

    public function initFormQuantities()
    {
        return '';
        $properties = array('minimal_quantity', 'available_now', 'available_later', 'available_date');

        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Quantities']);
        foreach ($properties as $prop) {
            if ($prop == 'minimal_quantity') {
                $this->context->smarty->assign(
                    $prop,
                    $this->getFieldValue($this->kb_product, $prop, $this->default_form_language, 1)
                );
            } else {
                $this->context->smarty->assign(
                    $prop,
                    $this->getFieldValue($this->kb_product, $prop, $this->default_form_language)
                );
            }
        }

        $this->context->smarty->assign('has_attributes', $this->kb_product->hasAttributes());
        $this->context->smarty->assign(
            'qty',
            StockAvailable::getQuantityAvailableByProduct((int)$this->kb_product->id, 0)
        );
        if ($this->kb_product->id == null) {
            $out_of_stock = 2;
        } else {
            $out_of_stock = StockAvailable::outOfStock((int) $this->kb_product->id);
        }

        $this->context->smarty->assign('out_of_stock', $out_of_stock);
        $this->context->smarty->assign('order_out_of_stock', Configuration::get('PS_ORDER_OUT_OF_STOCK'));
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'product/qty.tpl');
    }

    public function initFormCategories()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Categories']);
        
        $all_categories = $this->getCategoryList();
        if (!empty($all_categories)) {
            $this->context->smarty->assign('categories', $all_categories);
        }

        $selected_cat = Product::getProductCategories($this->kb_product->id);
        $this->context->smarty->assign('selected_categories', $selected_cat);
        $this->context->smarty->assign('default_category', $this->kb_product->id_category_default);

        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'product/category.tpl');
    }

    public function ajaxGetCategoryTree()
    {
        $temp = $this->getCategoryList($this->seller_obj->id, true);
        $unassigned_categories = array();
        foreach ($temp as $val) {
            $unassigned_categories[] = $val['id_category'];
        }

        $temp = $this->getCategoryList($this->seller_obj->id);
        $assigned_categories = array();
        foreach ($temp as $val) {
            $assigned_categories[] = $val['id_category'];
        }
        $selected_cat = Product::getProductCategories(Tools::getValue('id_product', 0));
        
        $root = Category::getRootCategory();

        $tree = new CategoryTree('seller-categories-tree');
        $tree->lang = $this->default_form_language;

        $tree->setRootCategory($root->id)
            ->setTitle(false)
            ->setTemplateDirectory($this->getKbTemplateDir() . 'product/category_tree/')
            ->setUseCheckBox(true)
            ->setUseSearch(false)
            ->setDisabledCategories($unassigned_categories)
            ->setEnabledCategories($assigned_categories)
            ->setSelectedCategories($selected_cat);
        
        return $tree->render();
    }

    public function ajaxGetSubCategoryTree()
    {
        $category = Tools::getValue('category', Category::getRootCategory()->id);
        $unassigned_categories = $this->getCategoryList($this->seller_obj->id);

        $full_tree = Tools::getValue('fullTree', 0);

        $use_check_box = Tools::getValue('useCheckBox', 1);
        $selected = Tools::getValue('selected', array());
        $id_tree = Tools::getValue('type');
        $input_name = str_replace(array('[', ']'), '', Tools::getValue('inputName', null));
        
        $tree = new CategoryTree('subtree_associated_categories');
        $tree->lang = $this->default_form_language;
        $tree->setTemplate('subtree_associated_categories.tpl');
        $tree->setRootCategory($category);
        $tree->setTitle(false);
        $tree->setTemplateDirectory($this->getKbTemplateDir() . 'product/category_tree/');
        $tree->setUseCheckBox($use_check_box);
        $tree->setUseSearch(false);
        $tree->setIdTree($id_tree);
        $tree->setFullTree($full_tree);
        $tree->setChildrenOnly(true);
        $tree->setNoJS(true);
        $tree->setDisabledCategories($unassigned_categories);
        $tree->setSelectedCategories($selected);

        if ($input_name) {
            $tree->setInputName($input_name);
        }

        return $tree->render();
    }

    public function initFormShipping()
    {
        $properties = array('width', 'height', 'depth', 'weight', 'additional_shipping_cost');

        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Shipping']);
        foreach ($properties as $prop) {
            $this->context->smarty->assign($prop, $this->getFieldValue($this->kb_product, $prop));
        }
        
        $carrier_list = KbSellerShipping::getShippingForProducts(
            $this->default_form_language,
            $this->seller_obj->id,
            false,
            false,
            false,
            false,
            Carrier::ALL_CARRIERS
        );
        $carrier_selected_list = $this->kb_product->getCarriers();
        foreach ($carrier_list as &$carrier) {
            foreach ($carrier_selected_list as $carrier_selected) {
                if ($carrier_selected['id_reference'] == $carrier['id_reference']) {
                    $carrier['selected'] = true;
                    continue;
                }
            }
        }
        
        $this->context->smarty->assign('carrier_list', $carrier_list);
        $this->context->smarty->assign('product_has_shipping', !empty($carrier_selected_list));
        $this->context->smarty->assign('ps_dimension_unit', Configuration::get('PS_DIMENSION_UNIT'));
        $this->context->smarty->assign('ps_weight_unit', Configuration::get('PS_WEIGHT_UNIT'));
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'product/shipping.tpl');
    }

    public function initFormCombinations()
    {
        if (!Combination::isFeatureActive()) {
            return;
        }

        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Combinations']);
        $attributes = $this->kb_product->getAttributesResume($this->default_form_language);
        if ($attributes && count($attributes) > 0 && $this->kb_product->id != '' && $this->kb_product->id > 0) {
            foreach ($attributes as &$attribute) {
                // changes by rishabh jain
                $combination_images = $this->kb_product->_getAttributeImageAssociations($attribute['id_product_attribute']);
                foreach ($combination_images as $image_id) {
                    $product_attr_data = array();
                    $image = new Image($image_id);
                    if (isset($image_id) && $image_id != '') {
                        $img_path = $this->getImgDirUrl() . _THEME_PROD_DIR_ . $image->getExistingImgPath() . '.jpg';
                    } else {
                        $img_path = $this->getImgDirUrl() . _THEME_PROD_DIR_ . Language::getIsoById((int) $this->context->language->id) . '.jpg';
                    }
                    $product_attr_data['image_ids'][] = $image_id;
                    $product_attr_data['comb_images'][$image_id]['caption'] = $image->legend[$this->context->language->id];
                    $product_attr_data['comb_images'][$image_id]['path'] = $img_path;
                }
                if (isset($combination_images) && !empty($combination_images)) {
                    $product_attr_data['default_comb_img'] = $product_attr_data['comb_images'][$combination_images[0]]['path'];
                } else {
                    $product_attr_data['default_comb_img'] = $this->getImgDirUrl() . _THEME_PROD_DIR_ . Language::getIsoById((int) $this->context->language->id) . '.jpg';
                }
                //$attribute['default_image'] = '<img src="'.$product_attr_data['default_comb_img'].'" />';
                $attribute['default_image'] = $product_attr_data['default_comb_img'];
                //changes over
                $attribute['attribute_designation'] = addcslashes($attribute['attribute_designation'], '\"');
                $attribute['stock_available'] = StockAvailable::getQuantityAvailableByProduct(
                    (int)$this->kb_product->id,
                    $attribute['id_product_attribute']
                );
            }
        } else {
            $attributes = array();
        }
        $this->context->smarty->assign('attributes', $attributes);

        $attribute_js = array();
        $system_attributes = Attribute::getAttributes($this->default_form_language, true);
        foreach ($system_attributes as $k => $attr) {
            $attribute_js[$attr['id_attribute_group']][$attr['id_attribute']] = $attr['name'];
        }

        $this->context->smarty->assign('attributeJs', $attribute_js);
        $this->context->smarty->assign(
            'attributes_groups',
            AttributeGroup::getAttributesGroups($this->default_form_language)
        );

        $images = Image::getImages($this->default_form_language, $this->kb_product->id);
        $i = 0;
        $img_tmp1 = 'small';
        $img_tmp2 = '_default';
        $type = ImageType::getByNameNType($img_tmp1 . $img_tmp2, 'products');
        $img_thumb_type = '';
        if (isset($type['name'])) {
            $img_thumb_type = $type['name'];
        }
        $this->context->smarty->assign('imageType', $img_thumb_type);
        $this->context->smarty->assign('imageWidth', 64 + 25);
        foreach ($images as $k => $image) {
            $images[$k]['obj'] = new Image($image['id_image']);
            ++$i;
        }
        $this->context->smarty->assign('images', $images);

        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'product/combination.tpl');
    }

    public function processGetCombination($id_product, $id_product_attribute)
    {
        $product = new Product($id_product);

        $attributes = $product->getAttributeCombinationsById($id_product_attribute, $this->default_form_language);
        foreach ($attributes as &$attr) {
            $attr['stock_available'] = StockAvailable::getQuantityAvailableByProduct(
                (int)$id_product,
                $id_product_attribute
            );
            $attr['id_img_attr'] = Product::_getAttributeImageAssociations($id_product_attribute);
        }
        return $attributes;
    }

    
    public function removeProductFacilities()
    {
        $json = array();
        $json['status'] = false;
        $json['msg'] = $this->module->l('Selected Facility Unmapped successfully', $this->controller_name);
        $id_booking_product = Tools::getValue('id_booking_product');
        $id_facilities = Tools::getValue('id_facilities');
        if (!empty($id_facilities) && !empty($id_booking_product)) {
            $rec = Db::getInstance()->execute('DELETE FROM ' . _DB_PREFIX_ . 'kb_booking_product_facilities_mapping WHERE id_booking_product=' . (int) $id_booking_product . ' AND id_facilities=' . (int) $id_facilities);
            if ($rec) {
                $json['status'] = true;
                return $json;
            }
        }
        return $json;
    }
    public function processMapFacilties()
    {
        $selected_facilities = Tools::getValue('selected_facilities');
        $id_booking_product = Tools::getValue('id_booking_product');
        if (!empty($selected_facilities) && !empty($id_booking_product)) {
            $selected_facilities = explode(',', $selected_facilities);
            foreach ($selected_facilities as $id_facilities) {
                Db::getInstance()->execute('DELETE FROM ' . _DB_PREFIX_ . 'kb_booking_product_facilities_mapping WHERE id_booking_product=' . (int) $id_booking_product . ' AND id_facilities=' . (int) $id_facilities);
                Db::getInstance()->execute('INSERT INTO ' . _DB_PREFIX_ . 'kb_booking_product_facilities_mapping set id_booking_product=' . (int) $id_booking_product . ',id_facilities=' . (int) $id_facilities);
            }
        }
        $json = array();
        $json['status'] = true;
        $json['msg'] = $this->module->l('Selected Facilities mapped successfully', $this->controller_name);
        $mappedFacilities = array();
        /*
         * We have added the compatibility with our Booking Calender plugin and we are using the function of that module class
         * that's why we have used its function.
         */
        $mappedFacilities = KbBookingFacilities::getFacilitiesMappedwithProduct($id_booking_product);
        $response_array = array();
        if (count($mappedFacilities) > 0) {
            foreach ($mappedFacilities as $key => $mappedFacilities) {
                $response_array['name']  = $mappedFacilities['name'];
                $response_array['id_facility']  = $mappedFacilities['id_facilities'];
            }
        }
        $json['data'] = $response_array;
        return $json;
    }
    
    public function processSubmitProductRoom()
    {
        $id_booking_product = Tools::getValue('id_booking_product');
        $enable = Tools::getValue('enable');
        $room_category = Tools::getValue('room_category');
        $room_type = Tools::getValue('room_type');
        $room_price = trim(Tools::getValue('room_price'));
        $start_time = trim(Tools::getValue('start_time'));
        $room_quantity = trim(Tools::getValue('room_quantity'));
        $end_time = trim(Tools::getValue('end_time'));
        
        $avail_facilities = '';
        if (!empty(Tools::getValue('avail_facilities'))) {
            $avail_facilities = implode(',', Tools::getValue('avail_facilities'));
        }
        $image_upload = array();
        if (!empty($id_booking_product)) {
            if (!empty($_FILES) && isset($_FILES['product_room_images'])) {
                foreach ($_FILES['product_room_images']["tmp_name"] as $key => $tmp_name) {
                    if ($_FILES["product_room_images"]['error'][$key] == 0 && $_FILES["product_room_images"]["name"][$key] != '' && $_FILES["product_room_images"]["size"][$key] > 0) {
                        $file_extension = pathinfo($_FILES["product_room_images"]["name"][$key], PATHINFO_EXTENSION);
                        $time = time();
                        $path = _PS_MODULE_DIR_ .  'kbbookingcalendar/views/img/' . 'room_img_'.$key.'_' . $time . '.' . $file_extension;
                        $upload = move_uploaded_file($_FILES["product_room_images"]["tmp_name"][$key], $path);
                        chmod($path, 0777);
                        if ($upload) {
                            $image_upload[]  = array(
                                'path' => $path,
                                'link' => $this->getModuleDirUrl() . 'kbbookingcalendar/views/img/' . 'room_img_' .$key.'_'. $time . '.' . $file_extension,
                            );
                        }
                    }
                }
            }
            if (Tools::getIsset('id_room_mapping') && Tools::getValue('id_room_mapping') != 0) {
                if (!empty($image_upload)) {
                    $image_upload = Tools::jsonEncode($image_upload);
                    Db::getInstance()->execute(
                        'UPDATE ' . _DB_PREFIX_ . 'kb_booking_product_room_facilities_mapping'
                        . ' set upload_images="' . pSQL($image_upload)
                        . '" WHERE id_booking_room_facilities_map=' . (int) Tools::getValue('id_room_mapping')
                    );
                }
                $rec = Db::getInstance()->execute(
                    'UPDATE ' . _DB_PREFIX_ . 'kb_booking_product_room_facilities_mapping '
                    . 'set id_booking_product=' . (int) $id_booking_product . ',id_room_type=' . (int) $room_type
                    . ',id_room_category=' . (int) $room_category . ',price="' . pSQL($room_price)
                    . '",start_time="' . pSQL($start_time) . '",end_time="' .pSQL($end_time) . '", room_quantity='.(int)$room_quantity
                    . ',id_facilities="' . pSQL($avail_facilities) . '",active=' . (int) $enable
                    . ',date_upd=now() WHERE id_booking_room_facilities_map=' . (int) Tools::getValue('id_room_mapping')
                );
                if ($rec) {
                    $booking_pro_obj = new KbBookingProduct((int) $id_booking_product);
                    $this->context->cookie->__set(
                        'redirect_success',
                        $this->module->l('Room successfully udpated.', $this->controller_name)
                    );
                    $redirect_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array('render_type' => 'form', 'step' => 2, 'id_product' => $booking_pro_obj->id_product, 'id_booking_product' => $id_booking_product),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    );
                    Tools::redirect($redirect_link);
                }
            } else {
                $image_upload = Tools::jsonEncode($image_upload);
                $rec = Db::getInstance()->execute(
                    'INSERT INTO ' . _DB_PREFIX_ . 'kb_booking_product_room_facilities_mapping '
                    . 'set id_booking_product=' . (int) $id_booking_product . ',id_room_type=' . (int) $room_type
                    . ',id_room_category=' . (int) $room_category . ',price="' . pSQL($room_price)
                    . '",start_time="' . pSQL($start_time) . '",end_time="' .pSQL($end_time) . '",room_quantity='.(int)$room_quantity.',upload_images="' . pSQL($image_upload) . '"'
                    . ',id_facilities="' . pSQL($avail_facilities) . '",active=' . (int) $enable
                    . ',date_add=now(),date_upd=now()'
                );
                if ($rec) {
                    $booking_pro_obj = new KbBookingProduct((int) $id_booking_product);
                    $this->context->cookie->__set(
                        'redirect_success',
                        $this->module->l('Room successfully added.', $this->controller_name)
                    );
                    $redirect_link = $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array('render_type' => 'form', 'step' => 2, 'id_product' => $booking_pro_obj->id_product, 'id_booking_product' => $id_booking_product),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    );
                    Tools::redirect($redirect_link);
                }
            }
        }
    }
    /* function added by rishabh jain
     * to add new supplier
     */
    public function processSaveSupplier()
    {
        $json = array();
        $errors = array();
        $address = new Address();
        $address->alias = Tools::getValue('supplier_name', null);
        $address->lastname = 'supplier'; // skip problem with numeric characters in supplier name
        $address->firstname = 'supplier'; // skip problem with numeric characters in supplier name
        $address->address1 = Tools::getValue('supplier_address_1', null);
        $address->address2 = Tools::getValue('supplier_address_2', null);
        $address->postcode = Tools::getValue('supplier_postcode', null);
        $address->phone = Tools::getValue('phone', null);
        $address->phone_mobile = Tools::getValue('phone_mobile', null);
        $address->id_country = Tools::getValue('supplier_id_country', null);
        $address->id_state = Tools::getValue('supplier_id_state', null);
        $address->city = Tools::getValue('supplier_city', null);

        $validation = $address->validateController();
        // checks address validity
        if (count($validation) > 0) {
            $errors[] = $this->module->l('The address is not correct. Please make sure all of the required fields are completed.', $this->controller_name);
        } else {
            $address->save();
            $supplier  = new Supplier();
            $supplier->name  = Tools::getValue('supplier_name', null);
            $supplier->link_rewrite  = Tools::getValue('supplier_name', null);
            $supplier->active  = 1;
            $supplier->save();
            $address->id_supplier = $supplier->id;
            $address->save();
        }
        if (count($errors) > 0) {
            $json['status'] = false;
            $json['errors'] = $errors;
        } else {
            $json['status'] = true;
            $msg = $this->module->l('Supplier successfully created.', $this->controller_name);
            $json['msg'] = $msg;
            $this->context->cookie->__set(
                'redirect_success',
                $msg
            );
            $request_param = array();
            $id_product = Tools::getValue('id_product', 0);
            if ($id_product > 0) {
                $request_param['id_product']  = (int) $id_product;
                $request_param['render_type'] = 'form';
            }
            $json['redirect_link'] = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                $request_param,
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
        }
        return $json;
    }
    public function processSaveManufacturer()
    {
        $json = array();
        $errors = array();
        $manufacturer = new Manufacturer();
        $manufacturer->name = Tools::getValue('manufacturer_name', null);
        $languages  = Language::getLanguages(false);
        $description_array = array();
        $short_description_array = array();
        $meta_title_array = array();
        $meta_description_array = array();
        $meta_keywords_array = array();
        foreach ($languages as $lang) {
            $description_array[$lang['id_lang']] = Tools::getValue('description', null);
            $short_description_array[$lang['id_lang']] = Tools::getValue('short_description', null);
            $meta_title_array[$lang['id_lang']] = Tools::getValue('manufacturer_meta_title', null);
            $meta_description_array[$lang['id_lang']] = Tools::getValue('manufacturer_meta_description', null);
            $meta_keywords_array[$lang['id_lang']] = Tools::getValue('manufacturer_meta_keyword', null);
        }
        $manufacturer->description = $description_array;
        $manufacturer->short_description = $short_description_array;
        $manufacturer->link_rewrite = Tools::getValue('manufacturer_name', null);
        $manufacturer->meta_title = $meta_title_array;
        $manufacturer->meta_keywords = $meta_keywords_array;
        $manufacturer->meta_description = $meta_description_array;
        $manufacturer->active = 1;
        if ($manufacturer->save()) {
            $json['status'] = true;
            $msg = $this->module->l('Manufacturer successfully created.', $this->controller_name);
            $json['msg'] = $msg;
            $this->context->cookie->__set(
                'redirect_success',
                $msg
            );
            $request_param = array();
            $id_product = Tools::getValue('id_product', 0);
            if ($id_product > 0) {
                $request_param['id_product']  = (int) $id_product;
                $request_param['render_type'] = 'form';
            }
            $json['redirect_link'] = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                $request_param,
                (bool) Configuration::get('PS_SSL_ENABLED')
            );
        } else {
            $errors[] = $this->module->l('The entered data is not correct', $this->controller_name);
            $json['status'] = false;
            $json['errors'] = $errors;
        }
        return $json;
    }
    public function processSaveReturnPolicy()
    {
        $json = array();
        $errors = array();
        if (Tools::isSubmit('credit_check')) {
            $credit_days = Tools::getValue('credit');
        } else {
            $credit_days = 0;
        }

        if (Tools::isSubmit('refund_check')) {
            $refund_days = Tools::getValue('refund');
        } else {
            $refund_days = 0;
        }

        if (Tools::isSubmit('replacement_check')) {
            $replacement_days = Tools::getValue('replacement');
        } else {
            $replacement_days = 0;
        }

        if (Tools::isSubmit('policy_action_type') && Tools::getValue('policy_action_type') == 0) {
            $qry = 'insert into ' . _DB_PREFIX_ . 'velsof_return_data
                values("","0","0","1","",' . (int) $refund_days . ',' . (int) $credit_days . ',' .
                (int) $replacement_days . ',"1","1",now(),now())';
            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($qry);
            $id = Db::getInstance()->Insert_ID();
            foreach (Language::getLanguages(true) as $lang) {
                $qry = 'insert into ' . _DB_PREFIX_ . 'velsof_return_data_lang values(' . (int) $id . ',' .
                    (int) $this->context->shop->id . ',' . (int) $lang['id_lang'] . ',"'
                    . pSQL(Tools::getValue('policy_new_' . $lang['id_lang'])) . '","' .
                    pSQL(Tools::getValue('policy_new_term_' . $lang['id_lang'])) . '",
                    "' . pSQL(Tools::getValue('rm_credit_text_' . $lang['id_lang'])) . '", "' .
                    pSQL(Tools::getValue('rm_refund_text_' . $lang['id_lang'])) . '",
                    "' . pSQL(Tools::getValue('rm_replacement_text_' . $lang['id_lang'])) . '")';
                Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($qry);
            }
        } else {
            $qry = 'update ' . _DB_PREFIX_ . 'velsof_return_data set date_updated = now(),
                refund_days=' . (int) $refund_days . ', credit_days=' . (int) $credit_days . ',
                replacement_days=' . (int) $replacement_days . ' where
                return_data_id=' . (int) Tools::getValue('policy_action_type');
            Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($qry);
            foreach (Language::getLanguages(true) as $lang) {
                $check_qry = 'select * from ' . _DB_PREFIX_ . 'velsof_return_data_lang
                    where return_data_id=' . (int) Tools::getValue('policy_action_type') . ' and
                    id_lang=' . (int) $lang['id_lang'] . ' and id_shop=' . (int) $this->context->shop->id;

                if (Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($check_qry)) {
                    $qry = 'update ' . _DB_PREFIX_ . 'velsof_return_data_lang set
                        value="' . pSQL(Tools::getValue('policy_new_' . $lang['id_lang'])) . '",
                        terms="' . pSQL(Tools::getValue('policy_new_term_' . $lang['id_lang'])) . '",
                        credit_message = "' . pSQL(Tools::getValue('rm_credit_text_' . $lang['id_lang'])) . '",
                        refund_message = "' . pSQL(Tools::getValue('rm_refund_text_' . $lang['id_lang'])) . '",
                        replacement_message = "' . pSQL(Tools::getValue('rm_replacement_text_' .
                                $lang['id_lang'])) . '"
                        where return_data_id=' . (int) Tools::getValue('policy_action_type') . ' and
                        id_lang=' . (int) $lang['id_lang'] . ' and id_shop=' . (int) $this->context->shop->id;
                } else {
                    $qry = 'insert into ' . _DB_PREFIX_ . 'velsof_return_data_lang values(' .
                        (int) Tools::getValue('policy_action_type') . ','
                        . (int) $this->context->shop->id . ',' . (int) $lang['id_lang'] . ',"'
                        . pSQL(Tools::getValue('policy_new_' . $lang['id_lang'])) . '","' .
                        pSQL(Tools::getValue('policy_new_term_' . $lang['id_lang'])) . '",
                            "' . pSQL(Tools::getValue('rm_credit_text_' . $lang['id_lang'])) . '", "' .
                        pSQL(Tools::getValue('rm_refund_text_' . $lang['id_lang'])) . '",
                            "' . pSQL(Tools::getValue('rm_replacement_text_' . $lang['id_lang'])) . '")';
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($qry);
                }
                Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($qry);
            }
        }
        $json['status'] = true;
        $msg = $this->module->l('Return Policy successfully added.', $this->controller_name);
        $json['msg'] = $msg;
        $this->context->cookie->__set(
            'redirect_success',
            $msg
        );
        $request_param = array();
        $id_product = Tools::getValue('id_product', 0);
        if ($id_product > 0) {
            $request_param['id_product']  = (int) $id_product;
            $request_param['render_type'] = 'form';
        }
        $json['redirect_link'] = $this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            $request_param,
            (bool) Configuration::get('PS_SSL_ENABLED')
        );
        
        return $json;
    }
    
    public function processDeleteCombination()
    {
        if (!Combination::isFeatureActive()) {
            return array(
                'status' => 'error',
                'message' => $this->module->l('This feature has been disabled.', $this->controller_name)
            );
        }

        $id_product = (int)Tools::getValue('id_product');
        $id_product_attribute = (int)Tools::getValue('id_product_attribute');
        if ($id_product && Validate::isUnsignedId($id_product)
            && Validate::isLoadedObject($product = new Product($id_product))) {
            $product->deleteAttributeCombination((int)$id_product_attribute);
            $product->checkDefaultAttributes();
            if (!$product->hasAttributes()) {
                $product->cache_default_attribute = 0;
                $product->update();
            } else {
                Product::updateDefaultAttribute($id_product);
            }

            $json = array(
                'status' => 'ok',
                'message' => $this->module->l('Combination successfully deleted.', $this->controller_name)
            );
        } else {
            $json = array(
                'status' => 'error',
                'message' => $this->module->l('You cannot delete this attribute.', $this->controller_name)
            );
        }

        return $json;
    }

    public function initFormVirtualProduct()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['VirtualProduct']);
        
        $sql = 'SELECT `id_product_download`
            FROM `'._DB_PREFIX_.'product_download`
            WHERE `id_product` = '.(int) $this->kb_product->id
            .' AND `active` = 1 ORDER BY `id_product_download` DESC';
        $id_product_download = (int)Db::getInstance()->getValue($sql);

        $product_download = new ProductDownload($id_product_download);

        $this->kb_product->{'productDownload'} = $product_download;

        if ($this->kb_product->productDownload->id && empty($this->kb_product->productDownload->display_filename)) {
            $this->errors[] = Tools::displayError('A file name is required in order to associate a file.', $this->controller_name);
            $this->tab_display = 'VirtualProduct';
        }

        // @todo handle is_virtual with the value of the product
        $exists_file = realpath(_PS_DOWNLOAD_DIR_) . '/' . $this->kb_product->productDownload->filename;

        $this->context->smarty->assign('product_downloaded', $this->kb_product->productDownload->id);

        if (!Tools::file_exists_no_cache($exists_file)
            && !empty($this->kb_product->productDownload->display_filename)
            && empty($this->kb_product->cache_default_attribute)) {
            $msg = sprintf(
                Tools::displayError('File "%s" is missing', $this->controller_name),
                $this->kb_product->productDownload->display_filename
            );
        } else {
            $msg = '';
        }

        $this->context->smarty->assign(array(
            'download_product_file_missing' => $msg,
            'download_dir_writable' => ProductDownload::checkWritableDir(),
            'up_filename' => (string)Tools::getValue('virtual_product_filename')
        ));

        $this->kb_product->productDownload->nb_downloadable = ($this->kb_product->productDownload->id > 0)
            ? $this->kb_product->productDownload->nb_downloadable
            : htmlentities(Tools::getValue('virtual_product_nb_downloable'), ENT_COMPAT, 'UTF-8');

        $this->kb_product->productDownload->date_expiration = ($this->kb_product->productDownload->id > 0)
            ? ((!empty($this->kb_product->productDownload->date_expiration)
            && $this->kb_product->productDownload->date_expiration != '0000-00-00 00:00:00')
                ? date('Y-m-d', strtotime($this->kb_product->productDownload->date_expiration)) : '' )
            : htmlentities(Tools::getValue('virtual_product_expiration_date'), ENT_COMPAT, 'UTF-8');

        $this->kb_product->productDownload->nb_days_accessible = ($this->kb_product->productDownload->id > 0)
            ? $this->kb_product->productDownload->nb_days_accessible
            : htmlentities(Tools::getValue('virtual_product_nb_days'), ENT_COMPAT, 'UTF-8');

        $this->kb_product->productDownload->is_shareable = $this->kb_product->productDownload->id > 0
            && $this->kb_product->productDownload->is_shareable;

        $this->context->smarty->assign(array(
            'uploadable_files' => $this->kb_product->uploadable_files,
            'text_fields' => $this->kb_product->text_fields,
            'virtual_product_filename' => $this->kb_product->productDownload->filename,
            'is_virtual' => $this->kb_product->is_virtual,
            'download_active' => $this->kb_product->productDownload->active,
            'download_id' => $this->kb_product->productDownload->id,
            'cache_default_attribute' => $this->kb_product->cache_default_attribute,
            'display_filename' => $this->kb_product->productDownload->display_filename,
            'is_file' => $this->kb_product->productDownload->checkFile(),
            'text_link' => $this->kb_product->productDownload->getTextLink(
                false,
                $this->kb_product->productDownload->getHash()
            ),
            'nb_downloadable' => $this->kb_product->productDownload->nb_downloadable,
            'date_expiration' => $this->kb_product->productDownload->date_expiration,
            'nb_days_accessible' => $this->kb_product->productDownload->nb_days_accessible
        ));

        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'product/virtual.tpl');
    }

    public function initFormPack()
    {
        $this->context->smarty->assign('form_title', $this->available_tabs_lang['Pack']);

        // If pack items have been submitted, we want to display them instead of the actuel content of the pack
        // in database. In case of a submit error, the posted data is not lost and can be sent again.
        if (Tools::getValue('namePackItems')) {
            $input_pack_items = Tools::getValue('inputPackItems');
            $input_namepack_items = Tools::getValue('namePackItems');
            $pack_items = $this->getPackItems();
        } else {
            $this->kb_product->packItems = Pack::getItems($this->kb_product->id, $this->default_form_language);
            $pack_items = $this->getPackItems($this->kb_product);
            $input_namepack_items = '';
            $input_pack_items = '';
            foreach ($pack_items as $pack_item) {
                $input_pack_items .= $pack_item['pack_quantity']
                    . 'x' . $pack_item['id'] . 'x' . $pack_item['id_product_attribute'] . '-';
                $input_namepack_items .= $pack_item['pack_quantity'] . ' x ' . $pack_item['name'] . '??';
            }
        }

        $this->context->smarty->assign(array(
            'input_pack_items' => $input_pack_items,
            'input_namepack_items' => $input_namepack_items,
            'pack_items' => $pack_items
        ));

        $this->context->smarty->assign(
            'search_product_url',
            $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array('method' => 'searchedproduct', 'ajax' => true),
                (bool)Configuration::get('PS_SSL_ENABLED')
            )
        );
        return $this->context->smarty->fetch($this->getKbTemplateDir() . 'product/pack.tpl');
    }

    /**
     * Get an array of pack items for display from the product object if specified, else from POST/GET values
     *
     * @param Product $product
     * @return array of pack items
     */
    public function getPackItems($product = null)
    {
        $pack_items = array();

        if (!$product) {
            $names_input = Tools::getValue('namePackItems');
            $ids_input = Tools::getValue('inputPackItems');
            if (!$names_input || !$ids_input) {
                return array();
            }

            // ids is an array of string with format : QTYxID
            $ids = array_unique(explode('-', $ids_input));
            $names = array_unique(explode('??', $names_input));

            if (!empty($ids)) {
                $length = count($ids);
                for ($i = 0; $i < $length; $i++) {
                    if (!empty($ids[$i]) && !empty($names[$i])) {
                        list($pack_items[$i]['pack_quantity'], $pack_items[$i]['id']) = explode('x', $ids[$i]);
                        $exploded_name = explode('x', $names[$i]);
                        $pack_items[$i]['name'] = $exploded_name[1];
                    }
                }
            }
        } else {
            $i = 0;
            foreach ($this->kb_product->packItems as $pack_item) {
                $pack_items[$i]['id'] = $pack_item->id;
                $pack_items[$i]['pack_quantity'] = $pack_item->pack_quantity;
                $pack_items[$i]['name'] = $pack_item->name;
                $pack_items[$i]['reference'] = $pack_item->reference;
                $pack_items[$i]['id_product_attribute'] = isset($pack_item->id_pack_product_attribute)
                    && $pack_item->id_pack_product_attribute ? $pack_item->id_pack_product_attribute : 0;
                $cover = $pack_item->id_pack_product_attribute
                    ? Product::getCombinationImageById(
                        $pack_item->id_pack_product_attribute,
                        $this->default_form_language
                    ) : Product::getCover($pack_item->id);
                if (empty($cover)) {
                    $cover = Product::getCover($pack_item->id);
                }
                $img_tmp1 = 'home';
                $img_tmp2 = '_default';
                $img_thumb_type = $img_tmp1 . $img_tmp2;
                $pack_items[$i]['image'] = Context::getContext()->link->getImageLink(
                    $pack_item->link_rewrite,
                    $cover['id_image'],
                    $img_thumb_type
                );
                $i++;
            }
        }
        return $pack_items;
    }

    public function processAdd()
    {
        $object = new Product();
        $this->copyFromPost($object);
        
        $before_status = $object->active;
        if (!$this->seller_obj->isApprovedSeller() || $this->seller_obj->active == 0) {
            $object->active = 0;
        }

        if ($this->seller_info['settings']['kbmp_new_product_approval_required'] != 0) {
            $object->active = 0;
        }
        $after_status = $object->active;

        if ($object->add()) {
            // changes by rishabh jain for booking calender changes
            $id_booking_product = 0;
            $id_booking_product = (int)$this->addUpdateBookingProduct($object);
            if ((int) $id_booking_product) {
                if (Tools::getValue('kb_product_type') == 'appointment') {
                    $object->text_fields = 2;
                } elseif (Tools::getValue('kb_product_type') == 'daily_rental') {
                    if (Tools::getValue('period_type') == 'date_time') {
                        $object->text_fields = 1;
                    } else {
                        $object->text_fields = 3;
                    }
                } elseif (Tools::getValue('kb_product_type') == 'hourly_rental') {
                    $object->text_fields = 3;
                } else {
                    $object->text_fields = 5;
                }
                $object->customizable = 1;
                if (!$object->createLabels(0, (int) $object->text_fields)) {
                    $this->Kberrors[] = $this->module->l('An error occurred while creating customization fields.', $this->controller_name);
                } else {
                    $this->addCustomizableTextFields($object);
                }
                $object->save();
                if ($before_status != $after_status) {
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->insert(
                        'kb_mp_seller_product_tracking',
                        array(
                            'id_seller' => (int) $this->seller_info['id_seller'],
                            'id_product' => (int) $object->id,
                            'date_add' => pSQL(date('Y-m-d H:i:s'))
                        )
                    );
                }
                $seller_product = new KbSellerProduct();
                $seller_product->id_seller = $this->seller_info['id_seller'];
                $seller_product->id_shop = $this->seller_info['id_shop'];
                $seller_product->id_product = $object->id;
                $seller_product->deleted = 0;
                if ($this->seller_info['settings']['kbmp_new_product_approval_required'] == 0) {
                    $seller_product->approved = (string)KbGlobal::APPROVED;
                } else {
                    $seller_product->approved = (string)KbGlobal::APPROVAL_WAITING;
                }

                $seller_product->save();

                $required_approval = $this->sendNotificationForProductApproval($object);

                StockAvailable::setQuantity(
                    $object->id,
                    0,
                    (int)Tools::getValue('qty_0'),
                    (int)$this->seller_info['id_shop']
                );
                StockAvailable::setProductOutOfStock(
                    (int)$object->id,
                    $object->out_of_stock,
                    $this->seller_info['id_shop']
                );
                if (!$this->seller_obj->isApprovedSeller() || $this->seller_obj->active == 0) {
                    $tmp = (int)$this->seller_obj->product_limit_wout_approval;
                    $this->seller_obj->product_limit_wout_approval = $tmp + 1;
                    $this->seller_obj->save(true);
                }
                if (Tools::getIsset('type_product') && Tools::getValue('type_product') == Product::PTYPE_VIRTUAL) {
                    $object->is_virtual = 1;
                    $object->save();
                }

                if (Configuration::get('PS_FORCE_ASM_NEW_PRODUCT') && Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
                    $object->advanced_stock_management = 1;
                    $object->save();
                    StockAvailable::setProductDependsOnStock(
                        $object->id,
                        true,
                        (int)$this->seller_info['id_shop'],
                        0
                    );
                }

                if (empty($this->Kberrors)) {
                    //Set Specific Prices
                    $this->setSpecificPrice($object->id);

                    $languages = Language::getLanguages(false);
                    $categories = Tools::getValue('categoryBox');
                    if (!empty($categories) && !$object->updateCategories($categories)) {
                        $this->Kberrors[] = $this->module->l('An error occurred while linking the product with categories.', $this->controller_name);
                    }

                    if (Tools::getIsset('shipping_tab')) {
                        $this->updateShipping($object);
                    }

                    Hook::exec(
                        'actionKbSellerProductAdd',
                        array('product' => $object, 'id_seller' => $this->seller_info['id_seller'])
                    );

                    if (!$this->updateTags($languages, $object)) {
                        $this->Kberrors[] = $this->module->l('An error occurred while adding tags.', $this->controller_name);
                    } else {
                        Hook::exec('actionProductAdd', array('product' => $object));
                        if (in_array($object->visibility, array('both', 'search'))
                            && Configuration::get('PS_SEARCH_INDEXATION')) {
                            Search::indexation(false, $object->id);
                        }
                    }

                    if (Configuration::get('PS_DEFAULT_WAREHOUSE_NEW_PRODUCT') != 0
                        && Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
                        $warehouse_location_entity = new WarehouseProductLocation();
                        $warehouse_location_entity->id_product = $object->id;
                        $warehouse_location_entity->id_product_attribute = 0;
                        $warehouse_location_entity->id_warehouse = Configuration::get('PS_DEFAULT_WAREHOUSE_NEW_PRODUCT');
                        $warehouse_location_entity->location = pSQL('');
                        $warehouse_location_entity->save();
                    }

                    if (empty($this->Kberrors)) {
                        if ($required_approval == KbGlobal::APPROVED) {
                            $this->Kbconfirmation[] = $this->module->l('New product has been created.', $this->controller_name);
                        } else {
                            $this->Kbconfirmation[] = $this->module->l('New product successfully created and gone for admin approval.', $this->controller_name);
                        }
                    } else {
                        if ($required_approval == KbGlobal::APPROVED) {
                            array_unshift(
                                $this->Kberrors,
                                $this->module->l('Product has been created but some of the parameters are not saved.', $this->controller_name)
                            );
                        } else {
                            array_unshift(
                                $this->Kberrors,
                                $this->module->l('Product has been created and gone for admin approval but some of the parameters are not saved.', $this->controller_name)
                            );
                        }
                    }
                } else {
                    $object->delete();
                    $this->Kberrors = array();
                    $this->Kberrors[] = $this->module->l('An error occured while creating new product.', $this->controller_name);
                }
            } else {
                $this->Kberrors[] = $this->module->l('An error occured while adding booking product data for new product.', $this->controller_name);
            }
        } else {
            $this->Kberrors[] = $this->module->l('An error occured while creating new product.', $this->controller_name);
        }

        if (count($this->Kberrors) > 0) {
            $this->context->cookie->__set('redirect_error', implode('####', $this->Kberrors));
        } else {
            $this->context->cookie->__set('redirect_success', implode('####', $this->Kbconfirmation));
        }

        $request_param = array();
        if (Tools::isSubmit('submitType') && Tools::getValue('submitType') == 'savenstay'
            && isset($object->id) && $object->id > 0) {
            $request_param['id_product'] = (int)$object->id;
            $request_param['id_booking_product'] = (int)$id_booking_product;
            $request_param['render_type'] = 'form';
        }
        Tools::redirect($this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            $request_param,
            (bool)Configuration::get('PS_SSL_ENABLED')
        ));
    }

    public function processUpdate()
    {
        $id = (int)Tools::getValue('id_product');
        /* Update an existing product */
        if (isset($id) && !empty($id)) {
            $object = new Product((int)$id);
            if (Validate::isLoadedObject($object)) {
                $this->copyFromPost($object);
                $object->indexed = 0;
                
                if (!$this->seller_obj->isApprovedSeller() || $this->seller_obj->active == 0) {
                    $object->active = 0;
                } else {
                    if (!KbSellerProduct::isApprovedProduct($this->seller_obj->id, $object->id)) {
                        $object->active = 0;
                    } else {
                        $object->active = 1;
                        if (Tools::getIsset('active')) {
                            if (Tools::getValue('active')) {
                                $object->active = 1;
                            } else {
                                $object->active = 0;
                            }
                        }
                    }
                }
                
                if ($object->update()) {
                    $id_booking_product = 0;
                    $id_booking_product = (int)$this->addUpdateBookingProduct($object);
                    if ((int) $id_booking_product) {
//                        if (Tools::getValue('kb_product_type') == 'daily_rental') {
//                            if (Tools::getValue('period_type') == 'date_time') {
//                                $object->text_fields = 1;
//                            } else {
//                                $object->text_fields = 3;
//                            }
//                            $object->customizable = 1;
//                            $object->deleteCustomization();
//
//                            if (!$object->createLabels(0, (int) $object->text_fields)) {
//                                $this->Kberrors[] = $this->module->l('An error occurred while creating customization fields.', $this->controller_name);
//                            } else {
//                                $this->addCustomizableTextFields($object);
//                            }
//                        }
                        $object->deleteCustomization();
                        if (Tools::getValue('kb_product_type') == 'appointment') {
                            $object->text_fields = 2;
                        } elseif (Tools::getValue('kb_product_type') == 'daily_rental') {
                            if (Tools::getValue('period_type') == 'date_time') {
                                $object->text_fields = 1;
                            } else {
                                $object->text_fields = 3;
                            }
                        } elseif (Tools::getValue('kb_product_type') == 'hourly_rental') {
                            $object->text_fields = 3;
                        } else {
                            $object->text_fields = 5;
                        }
                        $object->customizable = 1;
                        
                        if (!$object->createLabels(0, (int) $object->text_fields)) {
                            $this->Kberrors[] = $this->module->l('An error occurred while creating customization fields.', $this->controller_name);
                        } else {
                            $this->addCustomizableTextFields($object);
                        }
                        $object->save();
//                    if ($kbobject->add()) {
                        Db::getInstance(_PS_USE_SQL_SLAVE_)->delete(
                            'kb_mp_seller_product_tracking',
                            'id_seller = '. (int) $this->seller_info['id_seller']. ' AND '. 'id_product ='. (int) $object->id
                        );

                        if (!KbSellerProduct::isApprovedProduct($this->seller_obj->id, $object->id) && Tools::getValue('active') == 1) {
                            Db::getInstance(_PS_USE_SQL_SLAVE_)->insert(
                                'kb_mp_seller_product_tracking',
                                array(
                                    'id_seller' => (int) $this->seller_info['id_seller'],
                                    'id_product' => (int) $object->id,
                                    'date_add' => pSQL(date('Y-m-d H:i:s'))
                                )
                            );
                        }

                        $languages = Language::getLanguages(false);
                        StockAvailable::setQuantity($object->id, 0, (int)Tools::getValue('quantity'));

                        StockAvailable::setProductOutOfStock(
                            (int)$object->id,
                            $object->out_of_stock,
                            $this->seller_info['id_shop']
                        );
                        StockAvailable::setProductDependsOnStock(
                            (int)$object->id,
                            $object->depends_on_stock,
                            $this->seller_info['id_shop']
                        );


                        if ($object->getType() == Product::PTYPE_VIRTUAL) {
    //                        $this->updateDownloadProduct($object, 1);
                        }

                        $this->updateTags($languages, $object);

                        $this->updateImages($languages);

                        if (Tools::getIsset('shipping_tab')) {
                            $this->updateShipping($object);
                        }

                        $categories = Tools::getValue('categoryBox');
                        if (!empty($categories) && !$object->updateCategories($categories)) {
                            $this->Kberrors[] = $this->module->l('An error occurred while linking the product with categories.', $this->controller_name);
                        }

                        // START - Code for suppliers custom change
                        // Saving the supplier value
                        if (Tools::getIsset('id_suppliers')) {
                            $id_suppliers = Tools::getValue("id_suppliers");
                            $this->updateProductSuppliers($id, $id_suppliers);
                        }

                        // Update default supplier value
                        if (Tools::getIsset('default_supplier')) {
                            $default_supplier    = Tools::getValue('default_supplier');
                            $object->id_supplier = (int) $default_supplier;
                            $object->update();
                        }
                        // END - Code for suppliers custom change

    //                    $this->processProductFeatures($object->id);

                        if (empty($this->Kberrors)) {
                            //Set Specific Prices
                            $this->setSpecificPrice($object->id);

                            if (in_array($object->visibility, array('both', 'search'))
                                && Configuration::get('PS_SEARCH_INDEXATION')) {
                                Search::indexation(false, $object->id);
                            }
                            if (Tools::getIsset('duplicateProduct') && Tools::getValue('duplicateProduct')) {
                                $this->context->cookie->__set(
                                    'redirect_success',
                                    $this->module->l('Product is duplicated successfully. Please change the SKU of Product ID #', $this->controller_name). Tools::getValue('id_product')
                                );
                            } else {
                                $this->context->cookie->__set(
                                    'redirect_success',
                                    $this->module->l('Product has been updated successfully.', $this->controller_name)
                                );
                            }
                            if (Tools::isSubmit('submitType') && Tools::getValue('submitType') == 'savenstay') {
                                $_POST['id_product'] = (int)$id;
                            } else {
                                Tools::redirect($this->context->link->getModuleLink(
                                    $this->kb_module_name,
                                    $this->controller_name,
                                    array(),
                                    (bool)Configuration::get('PS_SSL_ENABLED')
                                ));
                            }
                        }

                        Hook::exec(
                            'actionKbSellerProductUpdate',
                            array('product' => $object, 'id_seller' => $this->seller_info['id_seller'])
                        );


                        if (empty($this->Kberrors)) {
                            $this->Kbconfirmation[] = $this->module->l('Product has been updated.', $this->controller_name);
                        } else {
                            array_unshift(
                                $this->Kberrors,
                                $this->module->l('Product has been updated, but some of the parameters are not saved.', $this->controller_name)
                            );
                        }
                    } else {
                        $this->Kberrors[] = $this->module->l('An error occurred while updating Booking data of product.', $this->controller_name);
                    }
                } else {
                    $this->Kberrors[] = $this->module->l('An error occurred while updating product.', $this->controller_name);
                }
            } else {
                $this->Kberrors[] = $this->module->l('An error occurred while updating product.', $this->controller_name);
            }
        } else {
            $this->Kberrors[] = $this->module->l('An error occurred while updating product.', $this->controller_name);
        }

        if (count($this->Kberrors) > 0) {
            $this->context->cookie->__set('redirect_error', implode('####', $this->Kberrors));
        } else {
            $this->context->cookie->__set('redirect_success', implode('####', $this->Kbconfirmation));
        }

        $request_param = array();
        if (Tools::isSubmit('submitType') && Tools::getValue('submitType') == 'savenstay') {
            $request_param['id_product'] = (int)$id;
            $request_param['render_type'] = 'form';
            $request_param['id_booking_product'] = (int)$id_booking_product;
        }
        Tools::redirect($this->context->link->getModuleLink(
            $this->kb_module_name,
            $this->controller_name,
            $request_param,
            (bool)Configuration::get('PS_SSL_ENABLED')
        ));
    }
    
    private function updateProductSuppliers($id_product, $id_suppliers = array(), $id_product_attribute = 0)
    {
        // Delete previously saved suppliers
        Db::getInstance()->delete('product_supplier', "id_product =". (int) $id_product."");

        foreach ($id_suppliers as $id_supplier) {
            $product_supplier                       = new ProductSupplier();
            $product_supplier->id_product           = $id_product;
            $product_supplier->id_product_attribute = $id_product_attribute;
            $product_supplier->id_supplier          = $id_supplier;
            $product_supplier->save();
        }
    }

    private function copyFromPost(&$object)
    {
        foreach ($_POST as $key => $value) {
            if (array_key_exists($key, $object) && $key != 'id_product') {
                $object->{$key} = trim($value);
            }
        }

        /* Multilingual fields */
        $languages = Language::getLanguages(false);
        $class_vars = get_class_vars(get_class($object));
        $fields = array();
        if (isset($class_vars['definition']['fields'])) {
            $fields = $class_vars['definition']['fields'];
        }
        /* We are setting the values in $_POST as the fuction that is called after ($pro_object->updateLabels()) uses the same and since it is a core function it cannot be modified. */
        $_POST['link_rewrite_'. (int)$this->default_form_language] = $this->convertProductNametoLinkRewrite(Tools::getValue('name_'.(int)$this->default_form_language));
        
        foreach ($fields as $field => $params) {
            if (array_key_exists('lang', $params) && $params['lang']) {
                foreach ($languages as $language) {
                    $value = '';
                    if (Tools::getIsset($field . '_' . (int)$language['id_lang'])) {
                        $value = trim(Tools::getValue($field . '_' . (int)$language['id_lang']));
                    } elseif (isset($object->{$field}[(int)$language['id_lang']])) {
                        $value = $object->{$field}[(int)$language['id_lang']];
                    }
//                    if (Tools::getIsset('id_product') && Tools::getValue('id_product') == 0) {
//                        foreach ($languages as $lang) {
//                            if (Tools::getIsset($field . '_' . (int) $lang['id_lang'])
//                                    && Tools::getValue($field . '_' . (int) $lang['id_lang']) != ''
//                            ) {
//                                $value = trim(Tools::getValue($field . '_' . (int) $lang['id_lang']));
//                            }
//                        }
//                    }
                    if ($field == 'description_short') {
                        $short_description_limit = Configuration::get('PS_PRODUCT_SHORT_DESC_LIMIT')
                            ? Configuration::get('PS_PRODUCT_SHORT_DESC_LIMIT') : 400;
                        $object->{$field}[(int)$language['id_lang']] = $this->clipLongText(
                            $value,
                            '',
                            $short_description_limit,
                            false
                        );
                    } else {
                        if (isset($params['required']) && $params['required']) {
                            if (empty($value) && $value !== 0) {
                                $value_temp = Tools::getValue($field . '_' . (int)$this->default_form_language, '');
                                $object->{$field}[(int)$language['id_lang']] = $value_temp;
                            } else {
                                $object->{$field}[(int)$language['id_lang']] = $value;
                            }
                        } else {
                            $object->{$field}[(int)$language['id_lang']] = $value;
                        }
                    }
                }
            }
        }
        
        /* Additional fields */
        $_POST['width'] = (!Tools::getIsset('width')) ? '0' : str_replace(',', '.', Tools::getValue('width'));
        $_POST['height'] = (!Tools::getIsset('height')) ? '0' : str_replace(',', '.', Tools::getValue('height'));
        $_POST['depth'] = (!Tools::getIsset('depth')) ? '0' : str_replace(',', '.', Tools::getValue('depth'));
        $_POST['weight'] = (!Tools::getIsset('weight')) ? '0' : str_replace(',', '.', Tools::getValue('weight'));

        $object->id_manufacturer = (int)Tools::getValue('id_manufacturer', 0);

        $ecotaxTaxRate = Tax::getProductEcotaxRate();
        
        if ($ecotax = Tools::getValue('ecotax')) {
            $_POST['ecotax'] = Tools::ps_round($ecotax / (1 + $ecotaxTaxRate / 100), 6);
        }
        if (Tools::getIsset('ecotax') != null) {
            $object->ecotax = str_replace(',', '.', Tools::getValue('ecotax'));
        }
        $this->processSubmittedData($object);
        $object->out_of_stock = 1;
        $object->id_tax_rules_group = (int) Tools::getValue('id_tax_rules_group', 0);
        $object->text_fields = 0;
        
        // changes by rishabh jainto add/update custom fields
//        $this->processSubmittedCustomFieldData($object);
    }

    private function addCustomizableTextFields($pro_object)
    {
        $labels = $pro_object->getCustomizationFields();
        if (Tools::getValue('kb_product_type') == 'appointment') {
            $cust_labels = array(
                $this->module->l('Appointment Date', $this->controller_name),
                $this->module->l('Service Type', $this->controller_name),
            );
        } elseif (Tools::getValue('kb_product_type') == 'daily_rental') {
            if (Tools::getValue('period_type') == 'date_time') {
                $cust_labels = array(
                    $this->module->l('Booked Slot', $this->controller_name)
                );
            } else {
                $cust_labels = array(
                    $this->module->l('Check In', $this->controller_name),
                    $this->module->l('Check Out', $this->controller_name),
                    $this->module->l('Total Days', $this->controller_name),
                );
            }
        } elseif (Tools::getValue('kb_product_type') == 'hourly_rental') {
            $cust_labels = array(
                $this->module->l('Check In', $this->controller_name),
                $this->module->l('Check Out', $this->controller_name),
                $this->module->l('Total Hours', $this->controller_name),
            );
        } elseif (Tools::getValue('kb_product_type') == 'hotel_booking') {
            $cust_labels = array(
                $this->module->l('Check In', $this->controller_name),
                $this->module->l('Check Out', $this->controller_name),
                $this->module->l('Room', $this->controller_name),
                $this->module->l('Category', $this->controller_name),
                $this->module->l('Total Days', $this->controller_name),
                
            );
        }
        $gc_label_count = 0;
        foreach (array_keys($labels[Product::CUSTOMIZE_TEXTFIELD]) as $id_customization_field) {
            $languages = Language::getLanguages();
            foreach ($languages as $lang) {
                /* We are setting the values in $_POST as the fuction that is called after ($pro_object->updateLabels()) uses the same and since it is a core function it cannot be modified. */
                $_POST['label_'.Product::CUSTOMIZE_TEXTFIELD.'_'.$id_customization_field.'_'.$lang['id_lang']] = $cust_labels[$gc_label_count];
            }
            $gc_label_count++;
        }
        if (!$pro_object->updateLabels()) {
            $this->Kberrors[] = $this->module->l('An error occurred while updating customization fields.', $this->controller_name);
        }
    }
    
    public function addUpdateBookingProduct($product_obj)
    {
        // changes by rishabh jain for booking calender changes
        $posted_data = array();
        $posted_data['kb_product_type'] = Tools::getValue('kb_product_type');
        $posted_data['enable'] = $product_obj->active;
        $posted_data['service_type'] = Tools::getValue('service_type');
        $posted_data['period_type'] = Tools::getValue('period_type');
        $posted_data['quantity'] = trim(Tools::getValue('quantity'));
        $posted_data['price'] = trim(Tools::getValue('price'));
        $posted_data['enable_product_map'] = Tools::getValue('enable_product_map');
        $posted_data['address'] = trim(Tools::getValue('address', ''));
        $posted_data['longitude'] = trim(Tools::getValue('longitude', ''));
        $posted_data['latitude'] = trim(Tools::getValue('latitude', ''));
        $posted_data['star_rating'] = Tools::getValue('star_rating');
        $posted_data['max_days'] = trim(Tools::getValue('max_days', 0));
        $posted_data['min_days'] = trim(Tools::getValue('min_days', 0));
        $posted_data['min_hours'] = trim(Tools::getValue('min_hours', 0));
        $posted_data['max_hours'] = trim(Tools::getValue('max_hours', 0));
        $disable_days = array();
        $date_data = array();
        if ((int) $product_obj->id != 0) {
            if (Tools::getIsset('disable_days')) {
                if (is_array(Tools::getValue('disable_days'))) {
                    foreach (Tools::getValue('disable_days') as $day) {
                        $disable_days['disable_days_' . $day] = 1;
                    }
                }
            }
            $kb_date_from = Tools::getValue('kb_date_from');
            $kb_date_to = Tools::getValue('kb_date_to');
            if (Tools::getValue('period_type') == 'date_time') {
                $kb_time_from = Tools::getValue('kb_time_from');
                $kb_time_to = Tools::getValue('kb_time_to');
                $kb_time_price = Tools::getValue('kb_time_price');
                if (!empty($kb_date_from)) {
                    foreach ($kb_date_from as $key => $from_date) {
                        $data = array();
                        $data['from_date'] = trim($from_date);
                        $data['to_date'] = (isset($kb_date_to) && !empty($kb_date_to[$key])) ? trim($kb_date_to[$key]) : '';
                        if (!empty($kb_time_from)) {
                            foreach ($kb_time_from[$key] as $key1 => $time_from) {
                                $data['time'][] = array(
                                    'from_time' => trim($time_from),
                                    'to_time' => trim($kb_time_to[$key][$key1]),
                                    'price' => trim($kb_time_price[$key][$key1]),
                                );
                            }
                        }
                        $date_data[] = $data;
                    }
                }
            } else {
                if (!empty($kb_date_from)) {
                    $kb_time_price = Tools::getValue('kb_time_price');
                    foreach ($kb_date_from as $key => $from_date) {
                        $date_data[] = array(
                            'from_date' => trim($from_date),
                            'to_date' => (isset($kb_date_to) && !empty($kb_date_to[$key])) ? trim($kb_date_to[$key]) : '',
                            'price' => (isset($kb_time_price[$key][1])) ? trim($kb_time_price[$key][1]) : '',
                        );
                    }
                }
            }
        }
        if (is_array($disable_days) && count($disable_days) > 0) {
            $posted_data['disable_days'] = Tools::jsonEncode($disable_days);
        }
        if (is_array($date_data) && count($date_data) > 0) {
            $json_date_data = Tools::jsonEncode($date_data);
        }
//        print_r($json_date_data);
//        die;
        // chanegs over
        $kbobject = new KbBookingProduct((int) Tools::getValue('id_booking_product', 0));
        $kbobject->id_product = $product_obj->id;
        $kbobject->product_type = $posted_data['kb_product_type'];
        $kbobject->active = $posted_data['enable'];
        $kbobject->period_type = $posted_data['period_type'];
        $kbobject->quantity = $posted_data['quantity'];
        $kbobject->price = $posted_data['price'];
        $kbobject->enable_product_map = $posted_data['enable_product_map'];
        $kbobject->address = $posted_data['address'];
//        if ((int) $product_obj->id != 0) {
        if (isset($posted_data['disable_days'])) {
            $kbobject->disable_days = $posted_data['disable_days'];
        }
        if (isset($json_date_data)) {
            $kbobject->date_details  = $json_date_data;
        }
//        }
        $kbobject->longitude = $posted_data['longitude'];
        $kbobject->latitude = $posted_data['latitude'];
        if ($posted_data['kb_product_type'] == 'hotel_booking' ||
            $posted_data['kb_product_type'] == 'daily_rental') {
            $kbobject->star_rating = $posted_data['star_rating'];
            $kbobject->min_days = $posted_data['min_days'];
            $kbobject->max_days = $posted_data['max_days'];
        } elseif ($posted_data['kb_product_type'] == 'hourly_rental') {
            $kbobject->min_hours = $posted_data['min_hours'];
            $kbobject->max_hours = $posted_data['max_hours'];
        } else {
            $kbobject->service_type = $posted_data['service_type'];
        }
        if ($kbobject->save()) {
            return (int) $kbobject->id;
        } else {
            return false;
        }
    }
    
    private function setSpecificPrice($id_product = 0)
    {
        $props = array(
            'id_product_attribute' => 0,
            'id_shop' => $this->seller_info['id_shop'],
            'id_currency' => 0, //for all currency
            'id_country' => 0, //for all countries
            'id_group' => 0, //for all groups
            'id_customer' => 0, // for all customers
            'price' => -1,
            'from_quantity' => 1, //Min quantity 1
            'reduction_type' => 'amount'
        );
//        // changes by rishabh jain
//        $reduced_price = (float)Tools::getValue('sp_reduction', 0);
//        $reduction_type = Tools::getValue('discount_type', '0');
//        if ($reduction_type == '1') {
//            $props['reduction_type'] = 'percentage';
//            $reduced_price = (float)(Tools::getValue('sp_reduction', 0)/100);
//        }
//
//        if ($reduced_price > 0) {
//            $props['id_product'] = $id_product;
//            $actual_retail_price = (float)Tools::getValue('price', 0);
//            $props['reduction'] = (float)($reduced_price);
//
//            $from = Tools::getValue('sp_from_date', '0000-00-00 00:00:00');
//            $to = Tools::getValue('sp_to', '0000-00-00 00:00:00');
//
//            $props['from'] = $from;
//            $props['to'] = $to;
//
//            if (SpecificPrice::deleteByProductId($id_product)) {
//                $specific_price = new SpecificPrice();
//                foreach ($props as $prop => $val) {
//                    $specific_price->{$prop} = $val;
//                }
//
//                $specific_price->add();
//            }
//        }
    }

    private function processSubmittedData(&$object)
    {
        $default_params = array(
            'redirect_type' => '404',
            'id_tax_rules_group' => 0,
            'depends_on_stock' => false,
        );

        foreach ($default_params as $key => $value) {
            $object->{$key} = $value;
        }
    }
    private function getImgDirUrl()
    {
        $module_dir = '';
        if ($this->checkSecureUrl()) {
            $module_dir = _PS_BASE_URL_SSL_;
        } else {
            $module_dir = _PS_BASE_URL_;
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
    /**
     * delete all items in pack, then check if type_product value is 2.
     * if yes, add the pack items from input "inputPackItems"
     *
     * @param Product $product
     * @return boolean
     */
    public function updatePackItems($product)
    {
        Pack::deleteItems($product->id);
        // lines format: QTY x ID-QTY x ID
        if (Tools::getValue('inputPackItems')) {
            $product->setDefaultAttribute(0); //reset cache_default_attribute
            $items = Tools::getValue('inputPackItems');
            $lines = array_unique(explode('-', $items));
            // lines is an array of string with format : QTYxID
            if (count($lines)) {
                foreach ($lines as $line) {
                    if (!empty($line)) {
                        list($qty, $item_id) = explode('x', $line);
                        if ($qty > 0 && isset($item_id)) {
                            if (Pack::isPack((int)$item_id)) {
                                $this->Kberrors[] = $this->module->l('You cannot add product packs into a pack', $this->controller_name);
                            } elseif (!Pack::addItem((int)$product->id, (int)$item_id, (int)$qty)) {
                                $this->Kberrors[] = $this->module->l('An error occurred while attempting to add products to the pack.', $this->controller_name);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Update product download
     *
     * @param object $product Product
     * @return bool
     */
    public function updateDownloadProduct($product, $edit = 0)
    {
        if ((int)Tools::getValue('is_virtual_file') == 1) {
            if (isset($_FILES['virtual_product_file_uploader'])
                && $_FILES['virtual_product_file_uploader']['size'] > 0) {
                $virtual_product_filename = ProductDownload::getNewFilename();
                $helper = new HelperUploader('virtual_product_file_uploader');
                $helper->setPostMaxSize(Tools::getOctets(ini_get('upload_max_filesize')))
                    ->setSavePath(_PS_DOWNLOAD_DIR_)
                    ->upload($_FILES['virtual_product_file_uploader'], $virtual_product_filename);
            } else {
                $virtual_product_filename = Tools::getValue(
                    'virtual_product_filename',
                    ProductDownload::getNewFilename()
                );
            }

            $product->setDefaultAttribute(0); //reset cache_default_attribute
            if (Tools::getValue('virtual_product_expiration_date')
                && !Validate::isDate(Tools::getValue('virtual_product_expiration_date'))) {
                if (!Tools::getValue('virtual_product_expiration_date')) {
                    $this->Kberrors[] = $this->module->l('The expiration-date attribute is required.', $this->controller_name);
                    return false;
                }
            }

            // Trick's
            if ($edit == 1) {
                $id_product_download = (int)ProductDownload::getIdFromIdProduct((int)$product->id);
                if (!$id_product_download) {
                    $id_product_download = (int)ProductDownload::getIdFromIdProduct((int)$product->id, false);
                    if (!$id_product_download) {
                        $id_product_download = (int)Tools::getValue('virtual_product_id');
                    }
                }
            } else {
                $id_product_download = Tools::getValue('virtual_product_id');
            }

            $is_shareable = Tools::getValue('virtual_product_is_shareable');
            $virtual_product_name = Tools::getValue('virtual_product_name');
            $virtual_product_nb_days = Tools::getValue('virtual_product_nb_days');
            $virtual_product_nb_downloable = Tools::getValue('virtual_product_nb_downloable');
            $virtual_product_expiration_date = Tools::getValue('virtual_product_expiration_date');

            $download = new ProductDownload((int)$id_product_download);
            $download->id_product = (int)$product->id;
            $download->display_filename = $virtual_product_name;
            $download->filename = $virtual_product_filename;
            $download->date_add = date('Y-m-d H:i:s');
            $download->date_expiration = $virtual_product_expiration_date
                ? $virtual_product_expiration_date . ' 23:59:59' : '';
            $download->nb_days_accessible = (int)$virtual_product_nb_days;
            $download->nb_downloadable = (int)$virtual_product_nb_downloable;
            $download->active = 1;
            $download->is_shareable = (int)$is_shareable;

            if ($download->save()) {
                return true;
            }
        } else {
            /* unactive download product if checkbox not checked */
            if ($edit == 1) {
                $id_product_download = (int)ProductDownload::getIdFromIdProduct((int)$product->id);
                if (!$id_product_download) {
                    $id_product_download = (int)Tools::getValue('virtual_product_id');
                }
            } else {
                $id_product_download = ProductDownload::getIdFromIdProduct($product->id);
            }

            if (!empty($id_product_download)) {
                $product_download = new ProductDownload((int)$id_product_download);
                $product_download->date_expiration = date('Y-m-d H:i:s', time() - 1);
                $product_download->active = 0;
                return $product_download->save();
            }
        }
        return false;
    }

    /**
     * Update product tags
     *
     * @param array Languages
     * @param object $product Product
     * @return boolean Update result
     */
    public function updateTags($languages, $product)
    {
        $tag_success = true;
        $saved_tags = Tag::getProductTags($product->id);
        if (Tag::deleteTagsForProduct((int)$product->id)) {
            /* Assign tags to this product */
            foreach ($languages as $language) {
                if (Tools::getIsset('tags_' . $language['id_lang'])) {
                    $value = Tools::getValue('tags_' . $language['id_lang']);
                } elseif (isset($saved_tags[$language['id_lang']])) {
                    $value = implode(',', $saved_tags[$language['id_lang']]);
                } else {
                    $value = '';
                }
                if (!empty($value)) {
                    $tag_success &= Tag::addTags($language['id_lang'], (int)$product->id, $value);
                }
            }
        } else {
            $tag_success = false;
        }

        if (!$tag_success) {
            $this->Kberrors[] = $this->module->l('An error occurred while adding tags.', $this->controller_name);
        }

        return $tag_success;
    }

    public function updateImages($languages)
    {
        if (Tools::getIsset('product_img')) {
            $product_imgs = Tools::getValue('product_img', array());
            if ($product_imgs && is_array($product_imgs)) {
                foreach ($product_imgs as $id_image => $img) {
                    if ($id_image == 'image_id') {
                        continue;
                    }
                    $img_obj = new Image($id_image);
                    if (Validate::isLoadedObject($img_obj)) {
                        foreach ($languages as $lang) {
                            $legend = 'legend_'.$lang['id_lang'];
                            if (isset($img[$legend]) && $img[$legend] != '') {
                                $value = $img[$legend];
                            } elseif (isset($img_obj->legend[$lang['id_lang']])
                                && $img_obj->legend[$lang['id_lang']] != '') {
                                $value = $img_obj->legend[$lang['id_lang']];
                            } else {
                                $value = '';
                            }
                            $img_obj->legend[$lang['id_lang']] = $value;
                        }
                        if (Tools::getIsset('product_img_default_cover')
                            && Tools::getValue('product_img_default_cover', null) == $id_image) {
                            $img_obj->cover = Tools::getValue('product_img_default_cover', null);
                        } else {
                            $img_obj->cover = 0;
                        }
                        
                        $img_obj->position = (int)$img['position'];
                        $img_obj->update();
                    }
                }
            }
        }
    }

    public function getModuleDirUrl()
    {
        $module_dir = '';
        if ($this->checkSecureUrl()) {
            $module_dir = _PS_BASE_URL_SSL_ . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_MODULE_DIR_);
        } else {
            $module_dir = _PS_BASE_URL_ . __PS_BASE_URI__ . str_replace(_PS_ROOT_DIR_ . '/', '', _PS_MODULE_DIR_);
        }
        return $module_dir;
    }
    
    public function updateShipping($product)
    {
        $shippings = array();
        if (Tools::getIsset('selectedShipping')) {
            $shippings = Tools::getValue('selectedShipping', array());
        }
        if (empty($shippings)) {
            $shippings = array(KbSellerShipping::getDefaultShippingId($this->seller_obj->id));
        }
        $product->setCarriers($shippings);
    }

    public function processDeleteVirtual($id_product)
    {
        $error = '';
        if (!($id_product_download = ProductDownload::getIdFromIdProduct($id_product))) {
            $error = $this->module->l('Error occurred while retrieving file to delete', $this->controller_name);
        } else {
            $product_download = new ProductDownload((int)$id_product_download);

            if (!$product_download->deleteFile((int)$id_product_download)) {
                $error = $this->module->l('Error occurred while deleting file', $this->controller_name);
            }
        }

        if ($error == '') {
            $request_param = array();
            $request_param['id_product'] = (int)$id_product;
            $request_param['render_type'] = 'form';
            $this->context->cookie->__set(
                'redirect_success',
                $this->module->l('File is successfully deleted.', $this->controller_name)
            );
            $link = $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                $request_param,
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            $json = array(
                'status' => true,
                'msg' => $this->module->l('Successfuly deleted', $this->controller_name),
                'redirect' => $link
            );
        } else {
            $json = array('status' => false, 'msg' => $error);
        }

        return $json;
    }

    public function processDuplicate()
    {
        //check for product limit
        /* Product Add Count Condition Changed By Ashish on 2nd Fed 2018 & Sellet Active Condition */
        //if (!$this->seller_obj->isApprovedSeller() || $this->seller_obj->active == 0) {
            $added_product_count = KbSellerProduct::getSellerProducts($this->seller_info['id_seller'], true);
            //$added_product_count = (int)$this->seller_obj->product_limit_wout_approval;
            $product_limit = (int)KbSellerSetting::getSellerSettingByKey($this->seller_obj->id, 'kbmp_product_limit');
            $error_txt = $this->module->l('Your limit of adding new products has been over as your account is not approved.', $this->controller_name);
            $error_txt .= $this->module->l('To add more products, please contact to admin.', $this->controller_name);
        if ($added_product_count >= $product_limit) {
            $this->context->cookie->__set(
                'redirect_error',
                $error_txt
            );

            Tools::redirect($this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            ));
        }
        //}
        if (Validate::isLoadedObject($product = new Product((int)Tools::getValue('id_product')))) {
            $id_product_old = $product->id;
            unset($product->id);
            unset($product->id_product);
            $product->indexed = 0;
            $product->active = 0;
            if ($product->save()) {
                $seller_product = new KbSellerProduct();
                $seller_product->id_seller = $this->seller_info['id_seller'];
                $seller_product->id_shop = $this->seller_info['id_shop'];
                $seller_product->id_product = $product->id;
                $seller_product->deleted = 0;
                if ($this->seller_info['settings']['kbmp_new_product_approval_required'] == 0) {
                    $seller_product->approved = (string)KbGlobal::APPROVED;
                } else {
                    $seller_product->approved = (string)KbGlobal::APPROVAL_WAITING;
                }

                $seller_product->save();

                $required_approval = $this->sendNotificationForProductApproval($product);

                if (Category::duplicateProductCategories($id_product_old, $product->id)
                    && ($combination_images = Product::duplicateAttributes($id_product_old, $product->id)) !== false
                    && GroupReduction::duplicateReduction($id_product_old, $product->id)
                    && Product::duplicateSpecificPrices($id_product_old, $product->id)
                    && Pack::duplicate($id_product_old, $product->id)
                    && Product::duplicateFeatures($id_product_old, $product->id)
                    && Product::duplicateTags($id_product_old, $product->id)
                    && Product::duplicateDownload($id_product_old, $product->id)) {
                    if ($product->hasAttributes()) {
                        Product::updateDefaultAttribute($product->id);
                    }

                    if (!Image::duplicateProductImages($id_product_old, $product->id, $combination_images)) {
                        $this->Kberrors[] = Tools::displayError($this->module->l('An error occurred while copying images.', $this->controller_name));
                    } else {
                        if (in_array($product->visibility, array('both', 'search'))
                            && Configuration::get('PS_SEARCH_INDEXATION')) {
                            Search::indexation(false, $product->id);
                        }

                        $_POST['id_product'] = (int)$product->id;

                        if ($required_approval == KbGlobal::APPROVED) {
                            $this->context->cookie->__set(
                                'redirect_success',
                                $this->module->l('Product is duplicated successfully. Please change the SKU of this product.', $this->controller_name)
                            );
                        } else {
                            $this->processUpdate();
                            $this->context->cookie->__set(
                                'redirect_success',
                                $this->module->l('Product is duplicated successfully and waiting for admin approval. Please change the SKU of this product.', $this->controller_name)
                            );
                        }
                    }
                }
            } else {
                $this->Kberrors[] = $this->module->l('Error occurred while creating object of duplicate product.', $this->controller_name);
            }
        } else {
            $this->Kberrors[] = $this->module->l('This product is not exist in your context.', $this->controller_name);
        }
    }
    

    private function sendNotificationForProductApproval($product)
    {
        $approved = KbGlobal::APPROVAL_WAITING;
        if ($this->seller_info['settings']['kbmp_new_product_approval_required'] == 0) {
            $approved = KbGlobal::APPROVED;
        }
        //Send Email to Admin to get notify about new product
        $data = array(
            'email' => $this->seller_info['email'],
            'title' => (!empty($this->seller_info['title'])) ? $this->seller_info['title'] : $this->module->l('Anonymous seller', $this->controller_name),
            'name' => $this->seller_info['seller_name'],
            'contact' => $this->seller_info['phone_number'],
            'product_name' => $product->name,
            'product_sku' => $product->reference,
            'product_price' => Tools::displayPrice(
                Tools::convertPrice($product->price),
                $this->seller_currency
            ),
        );
        /*Start - MK made change on 30-05-18 to send notification about new product only when product is waiting for approval*/
        if ($approved == KbGlobal::APPROVAL_WAITING) {
            $email = new KbEmail(
                KbEmail::getTemplateIdByName('mp_new_product_notification_admin'),
                $this->seller_info['id_default_lang']
            );
            $email->sendRequestForProductApproval($data);
        }
        /*End - MK made change on 30-05-18 to send notification about new product only when product is waiting for approval*/
        return $approved;
    }

    public function processDelete()
    {
        if (Validate::isLoadedObject($object = new Product((int)Tools::getValue('id_product')))) {
            /*
             * @since 1.5.0
             * It is NOT possible to delete a product if there are currently:
             * - physical stock for this product
             * - supply order(s) for this product
             */
            if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') && $object->advanced_stock_management) {
                $stock_manager = StockManagerFactory::getManager();
                $physical_quantity = $stock_manager->getProductPhysicalQuantities($object->id, 0);
                $real_quantity = $stock_manager->getProductRealQuantities($object->id, 0);
                if ($physical_quantity > 0 || $real_quantity > $physical_quantity) {
                    $this->Kberrors[] = $this->module->l('You cannot delete this product because there is physical stock left.', $this->controller_name);
                }
            }

            if (!count($this->Kberrors)) {
                if ($object->delete()) {
                    $id = Tools::getValue('id_booking_product');
                    $booking_object = new KbBookingProduct((int) $id);
                    $booking_object->delete();
                    if (!$this->seller_obj->isApprovedSeller() || $this->seller_obj->active == 0) {
                        $tmp = (int)$this->seller_obj->product_limit_wout_approval;
                        $this->seller_obj->product_limit_wout_approval -= $tmp;
                        $this->seller_obj->save();
                    }
                    $this->context->cookie->__set(
                        'redirect_success',
                        $this->module->l('Product has been deleted successfully.', $this->controller_name)
                    );
                    Tools::redirect(
                        $this->context->link->getModuleLink(
                            $this->kb_module_name,
                            $this->controller_name,
                            array(),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        )
                    );
                } else {
                    $this->Kberrors[] = $this->module->l('An error occurred while deleting product.', $this->controller_name);
                }
            }
        } else {
            $this->Kberrors[] = $this->module->l('An error occurred while deleting product.', $this->controller_name);
        }
    }

    public function getAjaxProductListHtml()
    {
        $json = array();
        $query = 'Select {{COLUMN}} from ' . _DB_PREFIX_ . 'product as p 
			LEFT JOIN ' . _DB_PREFIX_ . 'product_lang as pl on (p.id_product = pl.id_product AND pl.id_shop='.(int) Context::getContext()->getContext()->shop->id.') 
			INNER JOIN ' . _DB_PREFIX_ . 'kb_mp_seller_product as p2s on (p.id_product = p2s.id_product)
                        INNER JOIN '._DB_PREFIX_.'kb_booking_product as bp on (bp.id_product = p.id_product)
			WHERE p2s.id_seller = ' . (int)$this->seller_info['id_seller']
            . ' AND pl.id_lang = ' . (int)$this->seller_info['id_default_lang'] . ' ';

        $custom_filter = '';
        if (Tools::getIsset('reference') && Tools::getValue('reference') != '') {
            $custom_filter .= ' AND p.reference like "%' . pSQL(Tools::getValue('reference')) . '%"';
        }

        if (Tools::getIsset('id_category_default') && Tools::getValue('id_category_default') != '') {
            $custom_filter .= ' AND bp.product_type = "' . Tools::getValue('id_category_default').'"';
        }

        if (Tools::getIsset('active') && Tools::getValue('active') != '') {
            $custom_filter .= ' AND p.active = ' . (int)Tools::getValue('active');
        }

        if (Tools::getIsset('approved') && Tools::getValue('approved') != '') {
            $custom_filter .= ' AND p2s.approved = "' . (int)Tools::getValue('approved') . '"';
        }

        if (Tools::getIsset('name') && Tools::getValue('name') != '') {
            $custom_filter .= ' AND pl.name like "%' . pSQL(Tools::getValue('name')) . '%"';
        }

        $query .= $custom_filter;
        
        $this->total_records = DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue(
            str_replace(
                '{{COLUMN}}',
                'COUNT(p.id_product) as total',
                $query
            )
        );
        
        if ($this->total_records > 0) {
            if (Tools::getIsset('start') && (int)Tools::getValue('start') > 0) {
                $this->page_start = (int)Tools::getValue('start');
            }

            $query .= ' ORDER BY p.id_product DESC LIMIT '
                . (int)$this->getPageStart() . ', ' . (int)$this->tbl_row_limit;
            $results = DB::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
                str_replace(
                    '{{COLUMN}}',
                    'bp.*,p.id_product, p2s.approved',
                    $query
                )
            );
            $row_html = '';
            foreach ($results as $val) {
                $sql = 'SELECT SQL_CALC_FOUND_ROWS 
                        sav.`quantity`  AS `sav_quantity`
                        FROM  ' . _DB_PREFIX_ . 'product p 
                        LEFT JOIN ' . _DB_PREFIX_ . 'product_lang pl ON (pl.`id_product` = p.`id_product` AND pl.`id_lang` = 1 AND pl.`id_shop` = 1) 
                        LEFT JOIN ' . _DB_PREFIX_ . 'stock_available sav ON (sav.`id_product` = p.`id_product` AND sav.`id_product_attribute` = 0 AND sav.id_shop = 1  AND sav.id_shop_group = 0 ) 
                        JOIN ' . _DB_PREFIX_ . 'product_shop sa ON (p.`id_product` = sa.`id_product` AND sa.id_shop = 1) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'category_lang` cl ON (sa.`id_category_default` = cl.`id_category` AND cl.`id_lang` = 1 AND cl.id_shop = 1) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'category` c ON (c.`id_category` = cl.`id_category`) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'shop` shop ON (shop.id_shop = 1) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'image_shop` image_shop ON (image_shop.`id_product` = p.`id_product` AND image_shop.`cover` = 1 AND image_shop.id_shop = 1) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'image` i ON (i.`id_image` = image_shop.`id_image`) 
                        LEFT JOIN `' . _DB_PREFIX_ . 'product_download` pd ON (pd.`id_product` = p.`id_product`) 
                       WHERE p.id_product = '.  $val['id_product'];
                $results = DB::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
                $quantity = $results;
                
                // changes over
    
                $product = new Product($val['id_product'], false, $this->seller_info['id_default_lang']);
                $cat = new Category($product->id_category_default, $this->seller_info['id_default_lang']);
                $image = Image::getCover($val['id_product']);
                $link = new Link;
                $is_sll_enabled = $this->checkSecureUrl();
                if ($is_sll_enabled) {
                    $image_link = $image ? 'https://'.$link->getImageLink($product->link_rewrite, $image['id_image'], ImageType::getFormatedName('home')) : false;
                } else {
                    $image_link = $image ? 'http://'.$link->getImageLink($product->link_rewrite, $image['id_image'], ImageType::getFormatedName('home')) : false;
                }
                if ($image_link == '') {
                    $image_link = $this->getImgDirUrl() . _THEME_PROD_DIR_ . Language::getIsoById((int) $this->context->language->id) . '.jpg';
                }
                $edit_link = $this->context->link->getModuleLink(
                    $this->kb_module_name,
                    $this->controller_name,
                    array('render_type' => 'form', 'step' => 2, 'id_product' => $product->id, 'id_booking_product' => $val['id_booking_product']),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                );

                $view_link = $this->context->link->getProductLink(
                    $product,
                    null,
                    null,
                    null,
                    $this->seller_info['id_default_lang']
                );
// changes by rishabh jain
                                // changes over
                $yes_txt = $this->module->l('Yes', $this->controller_name);
                $row_html .= '<tr>
							<td class="kb-tcenter">
                            <div class="checker"><span>
								<input type="checkbox" class="kb_list_row_checkbox" name="row_item_id[]" 
								value="' . $product->id . '" title=""></span></div>
							</td>
							<td class="kb-tright">
								#' . $product->id . '
							</td>
                                                        <td class=" ">
                            <img src="'.$image_link.'" height="75px" width="75px">
                            </td>
							<td class=" ">
								<a href="' . $view_link . '" 
								title="' . $this->module->l('Click to view product', $this->controller_name)
                            . '" onclick="" target="_blank">'
                    . $product->name . '</a>
							</td>
							<td class=" ">' . $product->reference . '</td>
							<td class=" ">' . $this->product_type_arr[$val['product_type']] . '</td>
                                                            
                            
							
							
							<td class=" ">'
                            . KbGlobal::getApporvalStatus($val['approved'])
                            . '</td>
							<td class=" ">'
                    . (($product->active) ? $yes_txt : $this->module->l('No', $this->controller_name))
                    . '</td><td>
                        <a href="' . $edit_link . '" 
								title="' . $this->module->l('Click to edit product', $this->controller_name)
                            . '" class="btn btn-default kb-multiaction-link">
                            <i class="kb-material-icons kb-multiaction-icon">&#xe22b;</i>
							</a>
                        <a href="javascript:void(0)"
								title="' . $this->module->l('Click to delete product', $this->controller_name)
                            . '" class="btn btn-default kb-multiaction-link" onclick="KbDeleteAction('
                        .$product->id.')"><i class="kb-material-icons kb-multiaction-icon">&#xe872;</i>
							</a>
						</tr>';
            }
            $this->table_id = 'seller_product';
            $this->list_row_callback = 'getSellerProducts';
            $json['status'] = true;
            $json['html'] = $row_html;
            $json['pagination'] = $this->generatePaginator(
                $this->page_start,
                $this->total_records,
                $this->getTotalPages(),
                $this->list_row_callback
            );
        } else {
            $json['status'] = false;
            $json['msg'] = $this->module->l('No Data Found', $this->controller_name);
        }
        return $json;
    }

    public function processMultiAction()
    {
        $all_updated = true;
        $update_count = 0;
        
        if (Tools::getIsset('mutiaction_type')
            && Tools::getValue('mutiaction_type') == KbGlobal::MULTI_ACTION_TYPE_STATUS) {
            if (Tools::getIsset('mutiaction_status_list')) {
                $status = Tools::getValue('mutiaction_status_list');
                $product_ids = explode(',', trim(Tools::getValue('selected_table_item_ids')));
                foreach ($product_ids as $id) {
                    if ((int)$id > 0) {
                        $product = new Product($id);
                        if (!$this->seller_obj->isApprovedSeller() || $this->seller_obj->active == 0) {
                            $product->active = 0;
                        } else {
                            if (!KbSellerProduct::isApprovedProduct($this->seller_obj->id, $product->id)) {
                                $product->active = 0;
                            } else {
                                $product->active = (int)$status;
                            }
                        }

                        if (!$product->save()) {
                            $all_updated = false;
                        } else {
                            $update_count++;
                        }
                    }
                }

                if (!$all_updated) {
                    $this->context->cookie->__set(
                        'redirect_success',
                        sprintf(
                            $this->module->l('<b>%s</b> product(s) has been updated out of <b>%s</b> product(s).', $this->controller_name),
                            $update_count,
                            count($product_ids)
                        )
                    );
                } else {
                    $this->context->cookie->__set(
                        'redirect_success',
                        $this->module->l('Selected product(s) are updated successfully.', $this->controller_name)
                    );
                }
            } else {
                $this->context->cookie->__set(
                    'redirect_error',
                    $this->module->l('Atleast one product is required to take selected action.', $this->controller_name)
                );
            }
        } elseif (Tools::getIsset('mutiaction_type')
            && Tools::getValue('mutiaction_type') == KbGlobal::MULTI_ACTION_TYPE_DELETE) {
            $product_ids = explode(',', trim(Tools::getValue('selected_table_item_ids')));
//            print_r($product_ids);
//            die;
            $cannot_delete = 0;
            foreach ($product_ids as $id) {
                if ((int)$id > 0) {
                    $enable_to_delete = true;
                    $product = new Product($id);
                    if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT') && $product->advanced_stock_management) {
                        $stock_manager = StockManagerFactory::getManager();
                        $physical_quantity = $stock_manager->getProductPhysicalQuantities($product->id, 0);
                        $real_quantity = $stock_manager->getProductRealQuantities($product->id, 0);
                        if ($physical_quantity > 0 || $real_quantity > $physical_quantity) {
                            $enable_to_delete = false;
                            $cannot_delete++;
                        }
                    }

                    if ($enable_to_delete) {
                        // changes to be done
                        if (!$product->delete()) {
                            $all_updated = false;
                            if (!$this->seller_obj->isApprovedSeller() || $this->seller_obj->active == 0) {
                                $tmp = (int)$this->seller_obj->product_limit_wout_approval;
                                $this->seller_obj->product_limit_wout_approval -= $tmp;
                                $this->seller_obj->save();
                            }
                        } else {
                            $update_count++;
                        }
                    }
                }
            }
            if ($cannot_delete > 0) {
                if (!$all_updated) {
                    $this->context->cookie->__set(
                        'redirect_success',
                        sprintf(
                            $this->module->l('<b>%s</b> product(s) has been deleted out of <b>%s</b> product(s) and <b>%s</b> product(s) cannot be delete due to pysical stock.', $this->controller_name),
                            $update_count,
                            count($product_ids),
                            $cannot_delete
                        )
                    );
                } else {
                    $this->context->cookie->__set(
                        'redirect_success',
                        sprintf(
                            $this->module->l('<b>%s</b> product(s) has been deleted successfully and <b>%s</b> product(s) cannot be delete due to pysical stock.', $this->controller_name),
                            $update_count,
                            $cannot_delete
                        )
                    );
                }
            } else {
                if (!$all_updated) {
                    $this->context->cookie->__set(
                        'redirect_success',
                        sprintf(
                            $this->module->l('<b>%s</b> product(s) has been deleted successfully out of <b>%s</b> product(s).', $this->controller_name),
                            $update_count,
                            count($product_ids)
                        )
                    );
                } else {
                    if (count($product_ids) == 1) {
                        $this->context->cookie->__set(
                            'redirect_success',
                            $this->module->l('Product has been deleted successfully.', $this->controller_name)
                        );
                    } else {
                        $this->context->cookie->__set(
                            'redirect_success',
                            $this->module->l('Selected product(s) has been deleted successfully.', $this->controller_name)
                        );
                    }
                }
            }

            $reason_log = new KbReasonLog();
            $reason_log->reason_type = 2;
            $reason_log->id_seller = $this->seller_info['id_seller'];
            $reason_log->id_employee = null;
            $reason_log->comment = Tools::getValue('reason');
            $reason_log->save(true);
        } else {
            $this->context->cookie->__set(
                'redirect_error',
                $this->module->l('Please select valid action', $this->controller_name)
            );
        }

        Tools::redirect(
            $this->context->link->getModuleLink(
                $this->kb_module_name,
                $this->controller_name,
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            )
        );
    }

    public function processProductFeatures($product_id)
    {
        if (!Feature::isFeatureActive()) {
            return;
        }

        if (Validate::isLoadedObject($product = new Product((int)$product_id))) {
            // delete all objects
            $product->deleteFeatures();

            // add new objects
            /* changes done by rishabh jain to add functionality of custom fetaure addition */
            foreach ($_POST as $key => $val) {
                if (preg_match('/^feature_([0-9]+)_value/i', $key, $match)) {
                    if ($val) {
                        $product->addFeaturesToDB($match[1], $val);
                    }
                } else if (preg_match('/^feature_([0-9]+)_cvalue/i', $key, $match)) {
                    if ($val) {
                        $id_value = $product->addFeaturesToDB($match[1], 0, 1);
                        $product->addFeaturesCustomToDB($id_value, (int)$this->default_form_language, $val);
                    }
                }
            }
            /* changes over */
        }
    }
    
//    public function processProductFeatures($product_id)
//    {
//        if (!Feature::isFeatureActive()) {
//            return;
//        }
//
//        if (Validate::isLoadedObject($product = new Product((int)$product_id))) {
//            // delete all objects
//            $product->deleteFeatures();
//
//            // add new objects
//            foreach ($_POST as $key => $val) {
//                if (preg_match('/^feature_([0-9]+)_value/i', $key, $match)) {
//                    if ($val) {
//                        $product->addFeaturesToDB($match[1], $val);
//                    }
//                }
//            }
//        }
//    }
}
