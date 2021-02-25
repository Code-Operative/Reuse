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

require_once 'KbCore.php';
include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/KbMpCustomFields.php');
include_once(_PS_MODULE_DIR_.'kbmarketplace/classes/KbMpCustomFieldSellerMapping.php');

class KbmarketplaceSellerModuleFrontController extends KbmarketplaceCoreModuleFrontController
{
    public $controller_name = 'seller';
    private $seller;
    public $logo_size = array('width' => 150, 'height' => '150');
    public $banner_size = array('width' => 250, 'height' => 180);

    public function __construct()
    {
        parent::__construct();
        $this->seller = new KbSeller(
            KbSeller::getSellerByCustomerId($this->context->customer->id),
            $this->context->language->id
        );
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS($this->getKbModuleDir() . 'views/css/front/kb-forms.css');
        /* changes done by rishabh jain
         * DOM : 26/10/18
         * to fix the Smart cache for JavaScript issue for tiny mce
         */
        //$this->addJS($this->getKbModuleDir().'libraries/tinymce/tinymce.min.js');
        /* changes over */
    }

    public function postProcess()
    {
        parent::postProcess();
        $id_default_lang = (int) $this->context->language->id;
        if (Tools::getValue('downloadFile')) {
            if (Tools::getValue('id_field') != '') {
                $this->downloadFile(Tools::getValue('id_field'));
            }
        }
        if (Tools::isSubmit('ajax')) {
            $this->json = array();
            if (Tools::isSubmit('method')) {
                switch (Tools::getValue('method')) {
                    case 'checkBusniessEmail':
                        if (!KbSeller::isBusinessEmailExist(
                            Tools::getValue('bemail', ''),
                            Tools::getValue('id_seller', 0)
                        )
                        ) {
                            $this->json = array('msg' => '');
                        } else {
                            $this->json = array('msg' => $this->module->l('Already exist for another seller', 'seller'));
                        }
                        break;
                    case 'getSelectedPaymentContent':
                        if ($content = $this->getSelectedPaymentContent(Tools::getValue('payment_name'))) {
                            $this->json = array('content' => $content);
                        } else {
                            $this->json = array('content' => '');
                        }
                        break;
                }
            }

            echo Tools::jsonEncode($this->json);
            die;
        } else {
            if (Tools::isSubmit('updateSellerProfile')) {
                if (Tools::getValue('updateSellerProfile')
                    != Tools::encrypt($this->controller_name . $this->seller->id)) {
                    $this->Kberrors[] = $this->module->l('Token Mismatch', 'seller');
                } else {
                    $this->seller->title = trim(Tools::getValue('seller_title_'.$id_default_lang));
                    $this->seller->phone_number = trim(Tools::getValue('seller_phone_number'));
                    $this->seller->business_email = trim(Tools::getValue('seller_business_email'));
                    $this->seller->notification_type = (string)Tools::getValue('seller_notification_type');
                    $this->seller->address = trim(Tools::getValue('seller_address'));
                    $this->seller->state = Tools::getValue('seller_state', null);
                    $this->seller->id_country = Tools::getValue('seller_country', 0);
                    $this->seller->fb_link = trim(Tools::getValue('seller_fb_link'));
                    $this->seller->gplus_link = trim(Tools::getValue('seller_gplus_link'));
                    $this->seller->twit_link = trim(Tools::getValue('seller_twit_link'));
                    $this->seller->description = trim(Tools::getValue('seller_description_'.$id_default_lang));
                    $this->seller->meta_keyword = trim(Tools::getValue('seller_meta_keywords_'.$id_default_lang));
                    $this->seller->meta_description = trim(Tools::getValue('seller_meta_description'));
                    $this->seller->profile_url = trim(Tools::getValue('seller_profile_url_'.$id_default_lang));
                    $this->seller->return_policy = trim(Tools::getValue('seller_return_policy_'.$id_default_lang));
                    $this->seller->shipping_policy = trim(Tools::getValue('seller_shipping_policy_'.$id_default_lang));
                    /*Start- MK made changes on 30-05-18 to save privacy policy into DB*/
                    $this->seller->privacy_policy   = trim(Tools::getValue('seller_privacy_policy_'.$id_default_lang));
                    // chnages by rishabh jain for return address
                    $this->seller->return_address   = trim(Tools::getValue('return_address', ''));
                    // changes over
                    /*Start- MK made changes on 30-05-18 to save privacy policy into DB*/

                    $seller_img_path = _PS_IMG_DIR_ . KbSeller::SELLER_PROFILE_IMG_PATH . $this->seller->id . '/';
                    if (!Tools::file_exists_no_cache(_PS_IMG_DIR_ . $this->module->name . '/')) {
                        @mkdir(_PS_IMG_DIR_ . $this->module->name . '/', 0777);
                    }

                    if (!Tools::file_exists_no_cache(_PS_IMG_DIR_ . KbSeller::SELLER_PROFILE_IMG_PATH)) {
                        @mkdir(_PS_IMG_DIR_ . KbSeller::SELLER_PROFILE_IMG_PATH, 0777);
                    }

                    if ((isset($_FILES['seller_logo'])
                        && $_FILES['seller_logo']['size'] > 0) || Tools::getValue('seller_logo_update')) {
                        if ((int)Tools::getValue('seller_logo_update') > 0) {
                            $this->deleteImage($seller_img_path . $this->seller->id . '-logo' . $this->imageType);
                        }
                        if (isset($_FILES['seller_logo']) && $_FILES['seller_logo']['size'] > 0
                            && $this->uploadImage(
                                'seller_logo',
                                $seller_img_path,
                                $this->seller->id . '-logo',
                                false
                            )
                        ) {
                            $this->seller->logo = $this->seller->id . '-logo.' . $this->imageType;
                        } else {
                            $this->seller->logo = null;
                        }
                    }

                    if ((isset($_FILES['seller_banner']) && $_FILES['seller_banner']['size'] > 0)
                        || Tools::getValue('seller_banner_update')) {
                        if ((int)Tools::getValue('seller_banner_update') > 0) {
                            $this->deleteImage($seller_img_path . $this->seller->id . '-banner' . $this->imageType);
                        }
                        if (isset($_FILES['seller_banner']) && $_FILES['seller_banner']['size'] > 0
                            && $this->uploadImage(
                                'seller_banner',
                                $seller_img_path,
                                $this->seller->id . '-banner',
                                false
                            )
                        ) {
                            $this->seller->banner = $this->seller->id . '-banner.' . $this->imageType;
                        } else {
                            $this->seller->banner = null;
                        }
                    }

                    $payment_option_data = array();
                    if (Tools::isSubmit('seller_payment_option')) {
                        if (Tools::getValue('seller_payment_option') != '') {
                            $payment_option_name = Tools::getValue('seller_payment_option');
                            $payment_option_data['name'] = $payment_option_name;
                            if ($payment_info = Tools::getValue('payment_info', array())) {
                                if (isset($payment_info[$payment_option_name])) {
                                    $file = $this->getKbModuleDir() . 'classes/payment/'.$payment_option_name.'.php';
                                    if (Tools::file_exists_no_cache($file) && is_file($file)) {
                                        $name = basename($file, '.php');
                                        require_once $this->getKbModuleDir() . 'classes/payment/'.$name.'.php';
                                        if (method_exists(get_class(new $name()), "getPaymentContent")) {
                                            $payment_option_data['data'] = $payment_info[$payment_option_name];
                                            $this->seller->payment_info = serialize($payment_option_data);
                                        } else {
                                            $this->Kberrors[] = sprintf(
                                                $this->module->l('getPaymentContent() function not found in %s class', 'seller'),
                                                $payment_option_name
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $payment_info = $this->seller->payment_info;
                    $validate_fields = $this->seller->validateController();
                    if (!empty($validate_fields)) {
                        $this->Kberrors = array_merge($this->Kberrors, $validate_fields);
                    } else {
                        $this->seller->payment_info = $payment_info;
                        $languages = Language::getLanguages(false);
                        
                        if ($this->seller->save(true)) {
                            /*
                             * Start- MK made changes on 28-06-18 to update the seller data for the other language if in that language data is empty
                             */
                            foreach ($languages as $lang) {
                                if (Tools::getIsset('seller_title_'.$lang['id_lang']) && Tools::getValue('seller_title_'.$lang['id_lang']) != '') {
                                    $seller_title_lang = Tools::getValue('seller_title_'.$lang['id_lang']);
                                } else {
                                    $seller_title_lang = Tools::getValue('seller_title_'.$id_default_lang);
                                }
                                if (Tools::getIsset('seller_description_'.$lang['id_lang']) && Tools::getValue('seller_description_'.$lang['id_lang']) != '') {
                                    $seller_desc_lang = Tools::getValue('seller_description_'.$lang['id_lang']);
                                } else {
                                    $seller_desc_lang = Tools::getValue('seller_description_'.$id_default_lang);
                                }
                                if (Tools::getIsset('seller_profile_url_'.$lang['id_lang']) && Tools::getValue('seller_profile_url_'.$lang['id_lang']) != '') {
                                    $seller_url_lang = Tools::getValue('seller_profile_url_'.$lang['id_lang']);
                                } else {
                                    $seller_url_lang = Tools::getValue('seller_profile_url_'.$id_default_lang);
                                }
                                if (Tools::getIsset('seller_meta_keywords_'.$lang['id_lang']) && Tools::getValue('seller_meta_keywords_'.$lang['id_lang']) != '') {
                                    $seller_meta_keyword_lang = Tools::getValue('seller_meta_keywords_'.$lang['id_lang']);
                                } else {
                                    $seller_meta_keyword_lang = Tools::getValue('seller_meta_keywords_'.$id_default_lang);
                                }
                                if (Tools::getIsset('seller_meta_description_'.$lang['id_lang']) && Tools::getValue('seller_meta_description_'.$lang['id_lang']) != '') {
                                    $seller_meta_desc_lang = Tools::getValue('seller_meta_description_'.$lang['id_lang']);
                                } else {
                                    $seller_meta_desc_lang = Tools::getValue('seller_meta_description_'.$id_default_lang);
                                }
                                if (Tools::getIsset('seller_return_policy_'.$lang['id_lang']) && Tools::getValue('seller_return_policy_'.$lang['id_lang']) != '') {
                                    $seller_return_lang = Tools::getValue('seller_return_policy_'.$lang['id_lang']);
                                } else {
                                    $seller_return_lang = Tools::getValue('seller_return_policy_'.$id_default_lang);
                                }
                                if (Tools::getIsset('seller_shipping_policy_'.$lang['id_lang']) && Tools::getValue('seller_shipping_policy_'.$lang['id_lang']) != '') {
                                    $seller_shipping_lang = Tools::getValue('seller_shipping_policy_'.$lang['id_lang']);
                                } else {
                                    $seller_shipping_lang = Tools::getValue('seller_shipping_policy_'.$id_default_lang);
                                }
                                if (Tools::getIsset('seller_privacy_policy_'.$lang['id_lang']) && Tools::getValue('seller_privacy_policy_'.$lang['id_lang']) != '') {
                                    $seller_privacy_lang = Tools::getValue('seller_privacy_policy_'.$lang['id_lang']);
                                } else {
                                    $seller_privacy_lang = Tools::getValue('seller_privacy_policy_'.$id_default_lang);
                                }
                                
                                $seller_return_addr = Tools::getValue('return_address');
                                $result = Db::getInstance()->getRow('SELECT * FROM ' . _DB_PREFIX_ . 'kb_mp_seller_lang where id_seller=' . (int) $this->seller->id . ' AND id_lang=' . (int) $lang['id_lang']);
                                if (!empty($result) && count($result) >= 1) {
                                    DB::getInstance()->execute(
                                        'UPDATE ' . _DB_PREFIX_ . 'kb_mp_seller_lang'
                                        . ' set title="' . pSQL($seller_title_lang) . '",'
                                        . 'description="' . pSQL($seller_desc_lang, true) . '",'
                                        . 'meta_keyword="' . pSQL($seller_meta_keyword_lang, true) . '",'
                                        . 'meta_description="' . pSQL($seller_meta_desc_lang, true) . '",'
                                        . 'profile_url="' . pSQL($seller_url_lang, true) . '",'
                                        . 'return_policy="' . pSQL($seller_return_lang, true) . '",'
                                        . 'shipping_policy="' . pSQL($seller_shipping_lang, true) . '",'
                                        . 'return_address="' . pSQL($seller_return_addr, true) . '",'
                                        . 'privacy_policy="' . pSQL($seller_privacy_lang, true)
                                        . '" WHERE id_seller_lang=' . (int) $result['id_seller_lang']
                                    );
                                }
                            }
                                //changes end
                            /*
                             * changes by rishabh jain for saving custom field data
                             */
                            $this->addUpdateCustomFieldData();
                            // changes over
                            /*
                             * Start- MK made changes on 28-06-18 to update the seller data for the other language if in that language data is empty
                             */
                            Hook::exec('actionKbMarketPlaceUpdateSeller', array(
                                'object' => $this->seller));
                            if (!empty($this->Kberrors)) {
                                $msg = $this->module->l('Not all the fields saved due to following reason:', 'seller');
                            } else {
                                $msg = $this->module->l('Your profile has been updated successfully.', 'seller');
                            }
                            $this->Kbconfirmation = array_merge(
                                array($msg),
                                $this->Kberrors
                            );
                            $this->context->cookie->__set(
                                'redirect_success',
                                implode('####', $this->Kbconfirmation)
                            );
                            Tools::redirect(
                                $this->context->link->getModuleLink(
                                    $this->kb_module_name,
                                    $this->controller_name,
                                    array(),
                                    (bool)Configuration::get('PS_SSL_ENABLED')
                                )
                            );
                        }
                    }
                }
            }
        }
    }
    
    public function addUpdateCustomFieldData()
    {
        $id_customer = $this->context->customer->id;
        $id_seller = $this->seller->id;
        $availableFields = KbMpCustomFields::getAvailableCustomFields();
        foreach ($availableFields as $available) {
            $id_field = KbMpCustomFields::getCustomFieldIDbyName($available['field_name']);
            $field_value = '';
            $kbcustomfield = new KbMpCustomFields($id_field);
            $file = '';
            if (($kbcustomfield->type == 'select') || ($kbcustomfield->type == 'checkbox') || ($kbcustomfield->type == 'radio')) {
                $field_value = Tools::jsonEncode(Tools::getValue($kbcustomfield->field_name));
            } elseif ($kbcustomfield->type == 'file') {
                if (isset($_FILES[$kbcustomfield->field_name])) {
                    $file = $_FILES[$kbcustomfield->field_name];
                    if (($file['error'] == 0) && !empty($file['name'])) {
                        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                        $allowed_extension = preg_split('/[\s*,\s*]*,+[\s*,\s*]*/', $kbcustomfield->file_extension);
//                        if (in_array($file_extension, $allowed_extension)) {
                        if (in_array(Tools::strtolower($file_extension), $allowed_extension)) {
//                            $path = _PS_MODULE_DIR_ .  'kbmarketplace/views/upload/' . time() . '.' . $file_extension;
                            $path = _PS_MODULE_DIR_ .  'kbmarketplace/views/upload/'.$kbcustomfield->id_field.'_' . time() . '.' . $file_extension;
                            move_uploaded_file(
                                $_FILES[$kbcustomfield->field_name]['tmp_name'],
                                $path
                            );
//                            chmod(_PS_MODULE_DIR_ .  'kbmarketplace/views/upload/' . time() . '.' . $file_extension, 0777);
                            chmod(_PS_MODULE_DIR_ .  'kbmarketplace/views/upload/'.$kbcustomfield->id_field.'_' . time() . '.' . $file_extension, 0777);
                            $field_value = Tools::jsonEncode(
                                array(
                                    'path' => $path,
                                    'type' => $file['type'],
                                    'extension' => $file_extension
                                )
                            );
                        } else {
                            $field_value = '';
                        }
                    } else {
                        $field_value = '';
                    }
                }
            } elseif ($kbcustomfield->type == 'text' || $kbcustomfield->type == 'textarea' || $kbcustomfield->type == 'date' || $kbcustomfield->type == 'datetime') {
                $field_value = Tools::getValue($kbcustomfield->field_name);
            }
            $id_employee = 0;
            if ($field_value != '') {
                if (!empty($id_customer) && $id_customer != '') {
                    $id_mapping = KbMpCustomFieldSellerMapping::getIDBySellerAndField($id_seller, $id_field);
                    $kbmapping = new KbMpCustomFieldSellerMapping($id_mapping);
                } else {
                    $kbmapping = new KbMpCustomFieldSellerMapping();
                }
                $kbmapping->id_field = $id_field;
                
                $kbmapping->value = $field_value;
                
                $kbmapping->id_employee = $id_employee;
                $kbmapping->id_customer = $id_customer;
                $kbmapping->id_seller = $id_seller;
                if ($kbmapping->save()) {
                } else {
                }
            }
        }
    }

    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();
        if (isset($page['meta']) && $this->seller_info) {
            $page_title = $this->module->l('Seller Profile', 'seller');
            $page['meta']['title'] = $page_title;
            $page['meta']['keywords'] = $this->seller_info['meta_keyword'];
            $page['meta']['description'] = $this->seller_info['meta_description'];
        }
        return $page;
    }
    
    public function downloadFile($field_id)
    {
        // clean buffer
        if (ob_get_level() && ob_get_length() > 0) {
            ob_clean();
        }
        $id_seller = Tools::getValue('id_seller');
        $id_field = $field_id;
        $id_mapping = KbMpCustomFieldSellerMapping::getIDBySellerAndField($id_seller, $id_field);
        $mapping = new KbMpCustomFieldSellerMapping($id_mapping);
        $file = Tools::jsonDecode($mapping->value, true);
        if (!empty($file) && is_array($file)) {
            if (isset($file['type'])) {
                $path = $file['path'];
                if (Tools::file_exists_no_cache($file['path'])) {
                    header('Content-type:' . $file['type']);
                    header('Content-Type: application/force-download; charset=UTF-8');
                    header('Cache-Control: no-store, no-cache');
                    header('Content-disposition: attachment; filename=' . time() . '.' . $file['extension']);
                    readfile($path);
                    exit;
                } else {
                    Tools::redirect(
                        $this->context->link->getModuleLink(
                            $this->kb_module_name,
                            $this->controller_name,
                            array(),
                            (bool)Configuration::get('PS_SSL_ENABLED')
                        )
                    );
                }
            } else {
                Tools::redirect(
                    $this->context->link->getModuleLink(
                        $this->kb_module_name,
                        $this->controller_name,
                        array(),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    )
                );
            }
        }
    }
    public function initContent()
    {
        
        if (Validate::isEmail($this->seller->payment_info)) {
            $seller_payment_data = array();
            $seller_payment_data['name'] = 'kbpaypal';
            $seller_payment_data['data']['paypal_id']['label'] = $this->module->l('Payment Info', 'seller');
            $seller_payment_data['data']['paypal_id']['value'] = $this->seller->payment_info;
            $seller_payment_data['data']['add_info']['label'] = $this->module->l('Additional Information', 'seller');
            $seller_payment_data['data']['add_info']['value'] = '';
            $this->seller->payment_info = serialize($seller_payment_data);
            $this->seller->save(true);
        }

        $base_link = KbGlobal::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'));
        $profile_default_image_path = $base_link . 'modules/' . $this->module->name . '/' . 'views/img/';
        $seller_img_path = _PS_IMG_DIR_ . KbSeller::SELLER_PROFILE_IMG_PATH . $this->seller->id . '/';
        if (empty($this->seller->logo) || !Tools::file_exists_no_cache($seller_img_path . $this->seller->logo)) {
            $this->seller->logo = $profile_default_image_path . KbGlobal::SELLER_DEFAULT_LOGO;
        } else {
            $this->seller->logo = $this->seller_image_path . $this->seller->id . '/' . $this->seller->logo;
        }

        if (empty($this->seller->banner) || !Tools::file_exists_no_cache($seller_img_path . $this->seller->banner)) {
            $this->seller->banner = $profile_default_image_path . KbGlobal::SELLER_DEFAULT_BANNER;
        } else {
            $this->seller->banner = $this->seller_image_path . $this->seller->id . '/' . $this->seller->banner;
        }

        $editor_lang_path = $this->getKbModuleDir() . 'libraries/tinymce/langs/';
        $editor_lang_code = Language::getIsoById($this->context->language->id);
        if (file_exists($editor_lang_path.$editor_lang_code.'.js')) {
            $editor_lang = $editor_lang_code;
        } elseif (file_exists($editor_lang_path.Language::getIsoById($this->seller->id_default_lang).'.js')) {
            $editor_lang = Language::getIsoById($this->seller->id_default_lang);
        } else {
            $editor_lang = 'en';
        }

        $this->context->smarty->assign('editor_lang', $editor_lang);
        $this->context->smarty->assign('seller', (array)$this->seller);
        $this->context->smarty->assign('payment_info', Tools::unSerialize($this->seller->payment_info));

        $tmp = Country::getCountries($this->seller->id_default_lang, false, false, false);
        $country_array = array();
        foreach ($tmp as $row) {
            $country_array[$row['id_country']] = $row['country'];
        }

        $this->context->smarty->assign('countries', $country_array);

        if ((int)$this->seller->id_country > 0) {
            $seller_country = (int)$this->seller->id_country;
        } elseif (Tools::getIsset('seller_country') && (int)Tools::getValue('seller_country') > 0) {
            $seller_country = (int)Tools::getValue('seller_country');
        } else {
            $seller_country = Configuration::get('PS_COUNTRY_DEFAULT');
        }

        $this->context->smarty->assign('seller_country', $seller_country);
        $this->context->smarty->assign('kb_id_seller', $this->seller->id);
        $this->context->smarty->assign('seller_form_key', Tools::encrypt($this->controller_name . $this->seller->id));
        $this->context->smarty->assign('seller_default_logo', KbGlobal::SELLER_DEFAULT_LOGO);
        $this->context->smarty->assign('seller_default_banner', KbGlobal::SELLER_DEFAULT_BANNER);
        $this->context->smarty->assign('kb_img_frmats', $this->img_formats);
        $this->context->smarty->assign(
            'kb_validation_error',
            $this->module->l('Please provide mandatory information with valid values.', 'seller')
        );
        $this->context->smarty->assign(
            'kb_img_size_error',
            sprintf(
                $this->module->l('Size should not be greater than %d MB', 'seller'),
                (float)($this->img_size_limit / 1000)
            )
        );
        $this->context->smarty->assign(
            'kb_img_type_error',
            $this->module->l('Image format is not supproted', 'seller')
        );
        $this->context->smarty->assign('time', strtotime("now"));
        $avilable_payment_file = array();

        foreach (glob($this->getKbModuleDir() . 'classes/payment/*.php') as $file) {
            if (Tools::file_exists_no_cache($file) && is_file($file)) {
                $name = basename($file, '.php');
                if ($name != 'index' && $name != 'creditcard') {
                    require_once $this->getKbModuleDir().'classes/payment/'.$name.'.php';
                    if (method_exists(get_class(new $name()), "getPaymentContent")) {
                        $avilable_payment_file[$name] =  $this->getPaymentMethodname($name);
                    }
                }
            }
        }
        /* changes started by rishabh jain
         * on 16/102018
         * to add an option to allow payment methods
         */
        //$allowed_payment_method = array();
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (isset($mp_config['allowed_payment_methods'])) {
            foreach ($avilable_payment_file as $key => $payment_method) {
                if (!(in_array($key, $mp_config['allowed_payment_methods']))) {
                    //$allowed_payment_method[$key] = $payment_method;
                    unset($avilable_payment_file[$key]);
                }
            }
        }
        //$avilable_payment_file = array();
        //$avilable_payment_file = $allowed_payment_method;
        /*
         * changes over
         */
        /*Start- MK made changes on 20-03-2018 for Marketplace changes*/
//        $kb_payout_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
//        if (empty($kb_payout_setting)) {
//            unset($avilable_payment_file['kbpaypal']);
//        } elseif (!$kb_payout_setting['enable']) {
//            unset($avilable_payment_file['kbpaypal']);
//        }
        /*End- MK made changes on 20-03-2018 for Marketplace changes*/
        
        $rewriteSettings = !(bool)Configuration::get('PS_REWRITING_SETTINGS');
        $rewrite_shop_url = $this->getSellerLink($this->seller->id);
        $this->context->smarty->assign('rewrite_settings', $rewriteSettings);
        $this->context->smarty->assign('rewrite_shop_url', $rewrite_shop_url);
        $this->context->smarty->assign('curent_shop_url', $this->context->shop->getBaseURL());
        $this->context->smarty->assign('available_payment_file', $avilable_payment_file);
        /* changes done by rishabh jain
         * DOM : 26/10/18
         * to fix the Smart cache for JavaScript issue for tiny mce
         */
        $js_file = _PS_BASE_URL_SSL_ . __PS_BASE_URI__ .'modules/kbmarketplace/libraries/tinymce/tinymce.min.js';
        $this->context->smarty->assign('tiny_mce_js_file', $js_file);
        /* changes over */
        // changes by rishabh jain
        $is_return_address_enable = 0;
        if (Module::isInstalled('kbmarketplace') && Module::isInstalled('kbmarketplace')) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            $id_seller = 0;
            if (isset($mp_config['enable_return_manager_compatibility']) && $mp_config['enable_return_manager_compatibility'] == 1) {
                $is_return_address_enable = 1;
            }
        }
        $this->context->smarty->assign('is_return_address_enable', $is_return_address_enable);
        // changes over
        //changes by vishal
        $languages = Language::getLanguages(true);
        $this->context->smarty->assign('languages', $languages);
        $this->context->smarty->assign('default_lang', $this->context->language->id);
        foreach ($languages as $lang) {
            $result = Db::getInstance()->getRow('SELECT * FROM ' . _DB_PREFIX_ . 'kb_mp_seller_lang where id_seller=' . (int) $this->seller->id . ' AND id_lang=' . (int) $lang['id_lang']);
            if (!empty($result) && count($result) >= 1) {
                $this->context->smarty->assign('seller_title_'.$lang['id_lang'], $result['title']);
                $this->context->smarty->assign('seller_description_'.$lang['id_lang'], $result['description']);
                $kb_url = $this->getSellerLink($this->seller->id, '', $lang['id_lang']);
                $this->context->smarty->assign('seller_friedly_url_'.$lang['id_lang'], $result['profile_url']);
                $this->context->smarty->assign('seller_profile_url_'.$lang['id_lang'], $kb_url);
                $this->context->smarty->assign('seller_meta_keywords_'.$lang['id_lang'], $result['meta_keyword']);
                $this->context->smarty->assign('seller_meta_description_'.$lang['id_lang'], $result['meta_description']);
                $this->context->smarty->assign('seller_privacy_policy_'.$lang['id_lang'], $result['privacy_policy']);
                $this->context->smarty->assign('seller_return_policy_'.$lang['id_lang'], $result['return_policy']);
                $this->context->smarty->assign('seller_shipping_policy_'.$lang['id_lang'], $result['shipping_policy']);
            }
        }
        //changes end
        /*
         * changes by rishabh jain
         * to add the custom fields in seller profile form
         */
        $kb_available_field = KbMpCustomFields::getAvailableCustomFields();
//        foreach ($kb_available_field as $key => &$datafield) {
//            $datafield['id_section'] = 3;
//        }
        $id_seller = $this->seller->id;
        $customer_field_value = KbMpCustomFieldSellerMapping::getValueBySellerID($id_seller);
        $kb_final_field = array();
        $kb_field_value = array();
        if (is_array($customer_field_value) && !empty($customer_field_value)) {
            foreach ($customer_field_value as $cus_key => $customer_value) {
                $kb_field_value[$customer_value['id_field']] = $customer_value;
            }
        }
        $kb_final_field = array();
        foreach ($kb_available_field as $key => $avialable_field) {
            if (!empty($avialable_field) && is_array($avialable_field)) {
                $avialable_field['default_value'] = Tools::jsonDecode($avialable_field['default_value'], true);
            }
            if (is_array($kb_field_value) && !empty($kb_field_value)) {
                if (isset($kb_field_value[$avialable_field['id_field']]['id_field'])) {
                    if ($kb_field_value[$avialable_field['id_field']]['id_field'] == $avialable_field['id_field']) {
                        $kb_final_field[$key] = $avialable_field;
                        $kb_final_field[$key]['customer_value'] = $kb_field_value[$avialable_field['id_field']]['value'];
                    } else {
                        $kb_final_field[$key] = $avialable_field;
                        $kb_final_field[$key]['customer_value'] = '';
                    }
                } else {
                    $kb_final_field[$key] = $avialable_field;
                }
            } else {
                $kb_final_field = $kb_available_field;
            }
        }
            
        $this->context->smarty->assign('kb_available_field', $kb_final_field);
        $this->context->smarty->assign('id_seller', $this->seller->id);
        $this->context->smarty->assign('kb_front_controller', $this->context->link->getModuleLink('kbmarketplace', 'seller'));
        $this->setKbTemplate('seller/profile_form.tpl');

        parent::initContent();
    }

    public function getSelectedPaymentContent($payment_method)
    {
        $file = $this->getKbModuleDir() . 'classes/payment/'.$payment_method.'.php';
        if (Tools::file_exists_no_cache($file) && is_file($file)) {
            $name = basename($file, '.php');
            require_once $this->getKbModuleDir() . 'classes/payment/'.$name.'.php';
            if (method_exists(get_class(new $name()), "getPaymentContent")) {
                $avilable_payment_file = array();
                $avilable_payment_file[$name] =  $this->getPaymentMethodname($name);
                return($name::getPaymentContent());
            } else {
                $msg = $this->module->l('Not able to get content of this payment method', 'seller');
                return $msg;
            }
        } else {
            return false;
        }
    }

    public function getPaymentMethodname($name)
    {
        $payment_methods =  array(
            'bankwire' => $this->module->l('Bank Wire', 'seller'),
            'check' => $this->module->l('Payment by Cheque', 'seller'),
            'kbpaypal' => $this->module->l('Paypal', 'seller'),
        );
        return $payment_methods[$name];
    }
    
    private static function getSellerLink($seller, $alias = null, $id_lang = null, $id_shop = null, $force_routes = false)
    {
        $context = Context::getContext();
        if (!(bool)Configuration::get('PS_REWRITING_SETTINGS')) {
            $id = 0;
            if (!is_object($seller)) {
                if (is_array($seller) && isset($seller['id_seller'])) {
                    $id = $seller['id_seller'];
                } elseif ((int)$seller) {
                    $id = $seller;
                } else {
                    $module = Module::getInstanceByName('kbmarketplace');
                    throw new PrestaShopException($module->l('Invalid seller vars', 'kbglobal'));
                }
            }

            return $context->link->getModuleLink(
                'kbmarketplace',
                'sellerfront',
                array('render_type' => 'sellerview', 'id_seller' => $id)
            );
        }
        $dispatcher = Dispatcher::getInstance();

        if (!$id_lang) {
            $id_lang = $context->language->id;
        }
        
        $lang_link = '';
        
        if (Language::isMultiLanguageActivated($id_shop) && (int)Configuration::get('PS_REWRITING_SETTINGS', null, null, $id_shop)) {
            $lang_link = Language::getIsoById($id_lang).'/';
        }

        $url = KbGlobal::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'), $id_shop).$lang_link;

        if (!is_object($seller)) {
            if (is_array($seller) && isset($seller['id_seller'])) {
                $seller = new KbSeller($seller['id_seller'], $id_lang);
            } elseif ((int)$seller) {
                $seller = new KbSeller($seller, $id_lang);
            } else {
                $module = Module::getInstanceByName('kbmarketplace');
                throw new PrestaShopException($module->l('Invalid seller vars', 'kbglobal'));
            }
        }
        if (empty($seller->profile_url) && empty($alias)) {
            return $context->link->getModuleLink(
                'kbmarketplace',
                'sellerfront',
                array('render_type' => 'sellerview', 'id_seller' => $seller->id)
            );
        }

        // Set available keywords
        $params = array();
        $params['id'] = $seller->id;
        $params['rewrite'] = (!$alias) ? '<span id="friendly-url-demo">'.$seller->profile_url.'<span>' : '<span id="friendly-url-demo">'.$alias."</span>";

        $params['meta_keywords'] =    Tools::str2url($seller->meta_keyword);
        $params['meta_title'] = Tools::str2url($seller->title);

        return $url.$dispatcher->createUrl('kb_seller_rule', $id_lang, $params, $force_routes, '', $id_shop);
    }
}
