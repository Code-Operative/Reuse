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

    use Symfony\Component\Form\FormInterface;
    use Symfony\Component\Form\FormView;
    use PrestaShop\PrestaShop\Adapter\Category\CategoryDataProvider;
    use PrestaShop\PrestaShop\Core\Domain\Customer\ValueObject\FirstName;
    use PrestaShop\PrestaShop\Core\Domain\Customer\ValueObject\LastName;
    use PrestaShop\PrestaShop\Core\Domain\Customer\ValueObject\Password;
    use PrestaShopBundle\Form\Admin\Type\Material\MaterialChoiceTableType;
    use PrestaShopBundle\Form\Admin\Type\SwitchType;
    use PrestaShopBundle\Form\Admin\Type\CategoryChoiceTreeType;
    use PrestaShopBundle\Form\Admin\Type\ChoiceCategoriesTreeType;
    use PrestaShopBundle\Translation\TranslatorAwareTrait;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Email;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Constraints\Type;

use PrestaShop\PrestaShop\Adapter\Order\OrderPresenter;

//changes by vishal for custom change
require_once(_PS_MODULE_DIR_.'kbmarketplace/libraries/payout/vendor/autoload.php');
//changes end

class KbConfiguration extends Module
{

    const MODEL_FILE = 'model.sql';
    const MODEL_DATA_FILE = 'data.sql';
    const PARENT_TAB_CLASS = 'KBMPMainTab';
    const CSS_ADMIN_PATH = 'views/css/admin/';
    const CSS_FRONT_PATH = 'views/css/front/';
    const FRONT_PAGE_NAME = 'module-kbmarketplace-sellerfront';
    const SELL_CLASS_NAME = 'SELL';

    protected $custom_errors = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function install()
    {
        /* Changes done by rishabh jain on 5th sep 2018
         * to add compatibility with kb product review plugin
         * i.e registered this hook "actionKbProductReviewAddAfter","actionKbProductReviewDeleteAfter"
         */
        if (!parent::install()
        || !$this->registerHook('displayBackOfficeHeader')
        || !$this->registerHook('displayCustomerAccountForm')
        || !$this->registerHook('displayCustomerLoginFormAfter')
        || !$this->registerHook('actionUpdateEarningAfterPartiallyRefund')
        || !$this->registerHook('actionOrderSlipAdd')
        // hook registered by rishabh jain for seller shortlidt functioanlity
        || !$this->registerHook('displayTop')
        || !$this->registerHook('displayKbSellerAccountMenu')
        || !$this->registerHook('actionCustomerLogoutBefore')
        || !$this->registerHook('actionAuthentication')
        // changes over
        // hook registered by rishabh jain for seller shortlidt functioanlity
        || !$this->registerHook('actionKbSellerPlanActivateBefore')
        || !$this->registerHook('actionKbSellerPlanActivateAfter')
        || !$this->registerHook('actionKbSellerProductAdd')
        // changes over
        // hook registered by rishabh jain for membership plan functioanlity
        || !$this->registerHook('actionKbSellerPlanActivateAfter')
        || !$this->registerHook('actionKbSellerPlanActivateBefore')
        || !$this->registerHook('actionKbSellerProductAdd')
        || !$this->registerHook('actionKbSellerProductUpdateStatus')
        // changes over
        || !$this->registerHook('displayHeader')
        || !$this->registerHook('displayAdminCustomersForm')
        || !$this->registerHook('displayCustomerAccountFormTop')
        || !$this->registerHook('additionalCustomerFormFields')
        || !$this->registerHook('actionCustomerAccountAdd')
        || !$this->registerHook('actionObjectCustomerDeleteAfter')
        || !$this->registerHook('displayNav1')
        || !$this->registerHook('displayNav2')
        || !$this->registerHook('actionValidateOrder')
        || !$this->registerHook('displayCustomerAccount')
        || !$this->registerHook('displayReassurance')
        || !$this->registerHook('actionObjectProductUpdateBefore')
        || !$this->registerHook('actionObjectProductCommentAddAfter')
        || !$this->registerHook('actionObjectProductCommentDeleteAfter')
        || !$this->registerHook('displayOrderConfirmation')
        || !$this->registerHook('actionOrderStatusUpdate')
        || !$this->registerHook('actionProductCancel')
        || !$this->registerHook('actionObjectOrderDetailUpdateAfter')
        || !$this->registerHook('actionObjectOrderReturnUpdateAfter')
        || !$this->registerHook('actionCarrierUpdate')
        || !$this->registerHook('displayBackOfficeFooter')
        || !$this->registerHook('displayMyAccountBlock')
        || !$this->registerHook('displayKBLeftColumn')
        || !$this->registerHook('actionDispatcher')
        || !$this->registerHook('actionObjectLanguageAddAfter')
        || !$this->registerHook('actionObjectLanguageDeleteAfter')
        || !$this->registerHook('actionObjectCustomerMessageAddAfter')
        || !$this->registerHook('actionObjectCustomerDeleteAfter')
        || !$this->registerHook('actionExportGDPRData')
        || !$this->registerHook('actionDeleteGDPRCustomer')
        || !$this->registerHook('actionKbProductReviewAddAfter')
        || !$this->registerHook('actionKbProductReviewDeleteAfter')
        || !$this->registerHook('moduleRoutes')) {
            return false;
        }
        if (version_compare(_PS_VERSION_, '1.7.6.0', '>=')) {
            $this->registerHook('actionAfterCreateCustomerFormHandler');
            $this->registerHook('actionAfterUpdateCustomerFormHandler');
            $this->registerHook('actionCustomerFormBuilderModifier');
        }
        return true;
    }

    public function uninstall()
    {
        /* Changes done by rishabh jain on 5th september
         * to add compatibility with product review remainder plugin
         * i.e unregistered this hook "actionKbProductReviewAddAfter","actionKbProductReviewDeleteAfter"
         */
        if (!parent::uninstall()
            || !$this->unregisterHook('displayBackOfficeHeader')
            || !$this->unregisterHook('actionReturnManagerReturnComplete')
            || !$this->unregisterHook('displayHeader')
            || !$this->unregisterHook('displayKbSellerAccountMenu')
            || !$this->unregisterHook('actionObjectCustomerDeleteAfter')
            // hook registered by rishabh jain for seller shortlidt functioanlity
            || !$this->unregisterHook('displayTop')
            || !$this->unregisterHook('actionAuthentication')
            || !$this->unregisterHook('actionCustomerLogoutBefore')
            // changes over
            // hook registered by rishabh jain for membership plan functioanlity
            || !$this->unregisterHook('actionKbSellerPlanActivateAfter')
            || !$this->unregisterHook('actionKbSellerPlanActivateBefore')
            || !$this->unregisterHook('actionKbSellerProductAdd')
            || !$this->unregisterHook('actionKbSellerProductUpdateStatus')
            // changes over
            || !$this->unregisterHook('actionCartUpdateQuantityBefore') // changes by rishabh jain for pizzapro custom change to keep only one seller product in cart
            || !$this->unregisterHook('displayAdminCustomersForm')
            || !$this->unregisterHook('displayCustomerAccountFormTop')
            || !$this->unregisterHook('additionalCustomerFormFields')
            || !$this->unregisterHook('actionCustomerAccountAdd')
            || !$this->unregisterHook('displayNav1')
            || !$this->unregisterHook('displayNav2')
            || !$this->unregisterHook('actionValidateOrder')
            || !$this->unregisterHook('displayCustomerAccount')
            || !$this->unregisterHook('displayReassurance')
            || !$this->unregisterHook('actionObjectProductUpdateBefore')
            || !$this->unregisterHook('actionObjectProductCommentAddAfter')
            || !$this->unregisterHook('actionObjectProductCommentDeleteAfter')
            || !$this->unregisterHook('displayOrderConfirmation')
            || !$this->unregisterHook('actionDeleteGDPRCustomer')
            || !$this->unregisterHook('actionObjectCustomerMessageAddAfter')
            || !$this->unregisterHook('actionExportGDPRData')
            || !$this->unregisterHook('actionOrderStatusUpdate')
            || !$this->unregisterHook('actionObjectCustomerDeleteAfter')
            || !$this->unregisterHook('actionProductCancel')
            || !$this->unregisterHook('actionObjectOrderDetailUpdateAfter')
            || !$this->unregisterHook('actionObjectOrderReturnUpdateAfter')
            || !$this->unregisterHook('actionCarrierUpdate')
            || !$this->unregisterHook('displayBackOfficeFooter')
            || !$this->unregisterHook('displayMyAccountBlock')
            || !$this->unregisterHook('displayKBLeftColumn')
            || !$this->unregisterHook('actionDispatcher')
            || !$this->unregisterHook('actionObjectLanguageAddAfter')
            || !$this->unregisterHook('actionKbProductReviewAddAfter')
            || !$this->unregisterHook('actionKbProductReviewDeleteAfter')
            || !$this->unregisterHook('actionObjectLanguageDeleteAfter')
            || !$this->unregisterHook('moduleRoutes')) {
            return false;
        }
        if (version_compare(_PS_VERSION_, '1.7.6.0', '>=')) {
            $this->unregisterHook('actionAfterCreateCustomerFormHandler');
            $this->unregisterHook('actionAfterUpdateCustomerFormHandler');
            $this->unregisterHook('actionCustomerFormBuilderModifier');
        }
        Configuration::deleteByName('KB_MARKETPLACE');

        $sql = 'Select id_meta from ' . _DB_PREFIX_ . 'meta WHERE page = "' . pSQL(self::FRONT_PAGE_NAME) . '"';
        $page_id = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
        $meta_obj = new Meta($page_id);
        $meta_obj->delete();
        return true;
    }
    
    public function hookActionReturnManagerReturnComplete(array $params)
    {
        $return_data = $params['return_data'];
        if (!empty($return_data['id_order_return'])) {
            $order_return_details = OrderReturn::getOrdersReturnDetail($return_data['id_order_return']);
            if (count($order_return_details) > 0) {
                foreach ($order_return_details as $return) {
                    $order_detail = new OrderDetail($return['id_order_detail']);
                    $seller_order_detail = KbSellerOrderDetail::getDetailByOrderItemId($order_detail->id);
                    if (count($seller_order_detail) > 0) {
                        $seller_order_detail_obj = new KbSellerOrderDetail(
                            $seller_order_detail['id_seller_order_detail']
                        );
                        $commission_percent = $seller_order_detail_obj->commission_percent;
                        $returned_qty = (int) $return['product_quantity'];
                        // changes for updating order details data
//                        if ($return_data['return_type'] == 'refund') {
//                            $order_detail->product_quantity_refunded = $order_detail->product_quantity_refunded + (int) $returned_qty;
//                        } else {
//                            $order_detail->product_quantity_return = $order_detail->product_quantity_return + (int) $returned_qty;
//                        }
//                        $order_detail->save();
                        // changes over
                        $amount_of_returned_qty = (float) ((int) $return['product_quantity'] * $seller_order_detail_obj->unit_price);

                        $reduce_admin_earning = (float) ((float) ($commission_percent / 100) * $amount_of_returned_qty);
                        $reduce_seller_earning = ($amount_of_returned_qty - $reduce_admin_earning);

                        $seller_order_detail_obj->total_earning = ($seller_order_detail_obj->total_earning - $amount_of_returned_qty);
                        $seller_order_detail_obj->seller_earning = ($seller_order_detail_obj->seller_earning - $reduce_seller_earning);
                        $seller_order_detail_obj->admin_earning = ($seller_order_detail_obj->admin_earning - $reduce_admin_earning);
                        $seller_order_detail_obj->qty = ($seller_order_detail_obj->qty - $returned_qty);

                        $seller_order_detail_obj->save();

                        Hook::exec(
                            'actionKbMarketPlaceSOrderDetailUpdate',
                            array('object' => $seller_order_detail_obj)
                        );

                        $prev_earning = KbSellerEarning::getEarningBySellerAndOrder(
                            $seller_order_detail_obj->id_seller,
                            $seller_order_detail_obj->id_order
                        );

                        if (count($prev_earning) > 0) {
                            $earnin_obj = new KbSellerEarning($prev_earning['id_seller_earning']);
//                            $earnin_obj->product_count = $earnin_obj->product_count;
                            $earnin_obj->product_count = $earnin_obj->product_count - $returned_qty;
                            $earnin_obj->total_earning = $earnin_obj->total_earning - $amount_of_returned_qty;
                            $earnin_obj->seller_earning = $earnin_obj->seller_earning - $reduce_seller_earning;
                            $earnin_obj->admin_earning = $earnin_obj->admin_earning - $reduce_admin_earning;

                            $earnin_obj->save();
                            Hook::exec('actionKbMarketPlaceSEarningUpdate', array('object' => $earnin_obj));
                        }
                    }
                }
            }
        }
    }

    protected function installModel()
    {
        $this->l('This voucher cannot be used with this order as this order contains the seller products', 'kbconfiguration');
        $is_db_installed = Configuration::getGlobalValue('KB_MARKETPLACE_DB_INSTALLED');
        if (!$is_db_installed) {
            $installation_error = false;

            $rename_timestamp = time();
            foreach ($this->getMPTables() as $table_name) {
                $check_table = 'SELECT count(*) as value FROM information_schema.tables 
					WHERE table_schema = "' . _DB_NAME_ . '" AND table_name = "' . _DB_PREFIX_ . pSQL($table_name) . '"';
                $installed_table = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($check_table);
                if ((int) $installed_table > 0) {
                    $query = 'RENAME TABLE ' . _DB_PREFIX_ . pSQL($table_name) . ' TO '
                            . _DB_PREFIX_ . pSQL($table_name) . '_' . pSQL($rename_timestamp);
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($query);
                }
            }
            if (!file_exists(_PS_MODULE_DIR_ . $this->name . '/' . self::MODEL_FILE)) {
                $this->custom_errors[] = $this->l('Model installation file not found.', 'kbconfiguration');
                $installation_error = true;
            } elseif (!is_readable(_PS_MODULE_DIR_ . $this->name . '/' . self::MODEL_FILE)) {
                $this->custom_errors[] = $this->l('Model installation file is not readable.', 'kbconfiguration');
                $installation_error = true;
            } elseif (!$sql = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->name . '/' . self::MODEL_FILE)) {
                $this->custom_errors[] = $this->l('Model installation file is empty.', 'kbconfiguration');
                $installation_error = true;
            }

            if (!$installation_error) {
                $sql = str_replace(array('_PREFIX_', 'ENGINE_TYPE'), array(_DB_PREFIX_, _MYSQL_ENGINE_), $sql);
                $sql = preg_split("/;\s*[\r\n]+/", trim($sql));
                foreach ($sql as $query) {
                    if (!Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(trim($query))) {
                        $installation_error = true;
                    }
                }
            }

            $languages = Language::getLanguages();

            if (!$installation_error) {
                Configuration::updateValue('KB_MARKETPLACE_PRODUCT_REVIEW_COMPATIBILITY', true);
                Configuration::updateGlobalValue('KB_MARKETPLACE_DB_INSTALLED', true);
                if (!file_exists(_PS_MODULE_DIR_ . $this->name . '/' . self::MODEL_DATA_FILE)) {
                    $this->custom_errors[] = $this->l('Model data installation file not found.', 'kbconfiguration');
                    $installation_error = true;
                } elseif (!is_readable(_PS_MODULE_DIR_ . $this->name . '/' . self::MODEL_DATA_FILE)) {
                    $this->custom_errors[] = $this->l('Model data installation file is not readable.', 'kbconfiguration');
                    $installation_error = true;
                } elseif (!$sql = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->name . '/' . self::MODEL_DATA_FILE)) {
                    $this->custom_errors[] = $this->l('Model data installation file is empty.', 'kbconfiguration');
                    $installation_error = true;
                }

                if (!$installation_error) {
                    $sql = str_replace(array('_PREFIX_'), array(_DB_PREFIX_), $sql);
                    $sql = preg_split("/;\s*[\r\n]+/", trim($sql));

                    //Insert Email Data
                    if (Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(trim($sql[0]))) {
                        foreach ($this->getEmailTemplateData() as $key => $val) {
                            if ($id_email_template = KbEmail::getTemplateIdByName($key)) {
                                $email_obj = new KbEmail($id_email_template);
                                foreach ($languages as $lng) {
                                    $email_obj->subject[$lng['id_lang']] = $val['subject'];
                                    $email_obj->body[$lng['id_lang']] = $val['body'];
                                }
                                $email_obj->save();
                            }
                        }
                    } else {
                        $installation_error = true;
                        $this->custom_errors[] = $this->l('Email data is not installed.', 'kbconfiguration');
                    }

                    //Insert Seller Menus
                    if (Db::getInstance(_PS_USE_SQL_SLAVE_)->execute(trim($sql[1]))) {
                        foreach ($this->getSellerMenus() as $key => $val) {
                            if ($id_seller_menu = KbSellerMenu::getMenuIdByModuleAndController('kbmarketplace', $key)) {
                                $menu_obj = new KbSellerMenu($id_seller_menu);
                                foreach ($languages as $lng) {
                                    if ($this->getModuleTranslationByLanguage('kbmarketplace', $val['label'], 'kbconfiguration', $lng['iso_code']) != '') {
                                        $menu_obj->label[$lng['id_lang']] = $this->getModuleTranslationByLanguage('kbmarketplace', $val['label'], 'kbconfiguration', $lng['iso_code']);
                                    } else {
                                        $menu_obj->label[$lng['id_lang']] = $val['label'];
                                    }
                                    if ($this->getModuleTranslationByLanguage('kbmarketplace', $val['title'], 'kbconfiguration', $lng['iso_code']) != '') {
                                        $menu_obj->title[$lng['id_lang']] = $this->getModuleTranslationByLanguage('kbmarketplace', $val['title'], 'kbconfiguration', $lng['iso_code']);
                                    } else {
                                        $menu_obj->title[$lng['id_lang']] = $val['label'];
                                    }
//                                    $menu_obj->label[$lng['id_lang']] = $val['label'];
//                                    $menu_obj->title[$lng['id_lang']] = $val['title'];
                                }
                                $menu_obj->save();
                            }
                        }
                    } else {
                        $installation_error = true;
                        $this->custom_errors[] = $this->l('Seller Menu data is not installed.', 'kbconfiguration');
                    }
                }
            }

            if (!$installation_error) {
                $front_url_write_name = 'sellers';
                $meta_obj = new Meta();
                $meta_obj->configurable = 1;
                $meta_obj->page = self::FRONT_PAGE_NAME;
                foreach ($languages as $lng) {
                    $meta_obj->title[$lng['id_lang']] = 'Authorized Sellers';
                    $meta_obj->url_rewrite[$lng['id_lang']] = $front_url_write_name;
                }
                if (!$meta_obj->save()) {
                    $this->custom_errors[] = $this->l('Installation Failed: Error Occurred while inserting url rewrite for seller listing on front.', 'kbconfiguration');
                    $installation_error = true;
                }
            }
            if ($installation_error) {
                $this->custom_errors[] = $this->l('Installation Failed: Error Occurred while installing models.', 'kbconfiguration');
                return false;
            }
        } else {
            $installation_error = false;
            // changes by rishabh jain to update the product controller name
            $menuid = KbSellerMenu::getMenuIdByModuleAndController('kbmarketplace', 'product');
            if ($menuid != '') {
                $controller_name = 'kbproduct';
                $sql = 'update ' . _DB_PREFIX_ . 'kb_mp_seller_menu set 
                            controller_name = "'. psql($controller_name) .'" where id_seller_menu=' . (int) $menuid;
                Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql);
            }
            // changes over
            // to drop id_customer connstraint from product review table to add compatibility with knowband product review plugin
            if (!Configuration::getGlobalValue('KB_MARKETPLACE_PRODUCT_REVIEW_COMPATIBILITY')) {
                $sql_review = 'ALTER TABLE '._DB_PREFIX_.'kb_mp_seller_product_review DROP FOREIGN KEY '._DB_PREFIX_.'kb_mp_seller_product_review_ibfk_2';
                Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($sql_review);
                
                Configuration::updateValue('KB_MARKETPLACE_PRODUCT_REVIEW_COMPATIBILITY', true);
            }
            // CHANGES OVER
            $modified_tables = $this->getModifiedTables();
            foreach ($modified_tables as $table => $columns) {
                $check = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
                    'SHOW TABLES LIKE "' . _DB_PREFIX_ . pSQL($table) . '"'
                );
                if (count($check) > 0) {
                    foreach ($columns as $col => $script) {
                        $check_col_sql = 'SELECT count(*) FROM information_schema.COLUMNS 
                                WHERE COLUMN_NAME = "' . pSQL($col) . '" 
                                AND TABLE_NAME = "' . _DB_PREFIX_ . pSQL($table) . '" 
                                AND TABLE_SCHEMA = "' . _DB_NAME_ . '"';
                        $check_col = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($check_col_sql);
                        if ((int) $check_col == 0) {
                            if (!Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($script)) {
                                $this->custom_errors[] = $this->l('Database Update Error: Not able to modified column', 'kbconfiguration') . ' - '
                                        . $col . $this->l(' of table', 'kbconfiguration') . ' - ' . $table;
                                $installation_error = true;
                            }
                        }
                    }
                }
            }
            if ($installation_error) {
                return false;
            }
        }
        
        //create close shop table
        /*Start- MK made changes on 28-05-18 for gdpr changes*/
        $query = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "kb_mp_seller_shop_close_request` (
            `id_request` int(10) unsigned NOT NULL auto_increment,
            `id_seller` int(10) unsigned DEFAULT NULL,
            `id_shop` int(10) unsigned DEFAULT NULL,
            `seller_email` varchar(255) not null, 
            `account_delete` enum('0','1') NOT NULL DEFAULT '0',
            `approved` enum('0','1','3') NOT NULL DEFAULT '0',
            `date_add` datetime NOT NULL,
            PRIMARY KEY (`id_request`)
            
        ) ENGINE=" . _MYSQL_ENGINE_ . "  DEFAULT CHARSET=utf8;";
        Db::getInstance()->execute($query);
        
        $query = "CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "kb_mp_gdpr_request` (
            `id_gdpr_request` int(10) unsigned NOT NULL auto_increment,
            `email` varchar(255) NOT NULL,
            `is_seller` int(10) unsigned DEFAULT NULL, 
            `id_shop` int(10) unsigned DEFAULT '0', 
            `type` varchar(255) NOT NULL,
            `user_agent` varchar(255) NOT NULL,
            `remote_address` varchar(255) NOT NULL,
            `authenticate` varchar(255) NOT NULL,
            `approved` enum('0','1','3') NOT NULL DEFAULT '0',
            `customer_seller_request` INT(10) UNSIGNED NOT NULL DEFAULT '0',
            `date_add` datetime NOT NULL,
            PRIMARY KEY (`id_gdpr_request`)
           
        ) ENGINE=" . _MYSQL_ENGINE_ . "  DEFAULT CHARSET=utf8;";

        Db::getInstance()->execute($query);
        
        $languages = Language::getLanguages(false);

        //mp_seller_shop_close
        $report_data_template = $this->context->smarty->fetch(_PS_MODULE_DIR_ . $this->name . '/views/templates/admin/report_gdpr.tpl');
        $report_data_template = str_replace('[', '{', $report_data_template);
        $report_data_template = str_replace(']', '}', $report_data_template);
        
        $mail_content = array(
            'mp_seller_shop_close' => array(
                'subject' => 'Customer has requested to close the shop',
                 'description' => 'This template is used to send request to Admin to close the Seller Shop',
                'body' => '<div style="padding: 10px;">
                        <p style="font-size:14px;">Hi Admin,</p>
                        <p></p>
                        <div style="margin-bottom: 10px; width: 100%; border: 1px solid #403744; background: #403744; color: #fff;">
                        <p style="font-size: 16px; text-align: center; font-weight: bold;">REQUEST TO CLOSE THE SHOP ON {{shop_name}}</p>
                        </div>
                        <p></p>
                        <p style="font-size: 14px; text-align: left;">The customer ({{seller_email}}) has requested to close the shop \'{{shop_title}}\'.</p>
                        <p style="text-align: center; font-size: 14px;"></p>
                        <p style="text-align: center; font-size: 14px;">Kindly approve the request to close the customer\'s shop. Closing the shop is not an irreversible action.</p>
                        </div>',
            ),
            'mp_notify_seller_shop_close' => array(
                'subject' => 'You Shop has been closed',
                 'description' => 'This template is used to notify the seller about closing the shop',
                'body' => '<div style="padding: 10px;">
                        <p style="font-size: 14px;">Hi {{seller_name}},</p>
                        <p></p>
                        <div style="margin-bottom: 10px; width: 100%; border: 1px solid #414141; background: #414141; color: #fff;">
                        <p style="font-size: 15px; text-align: center; font-weight: bold;">YOUR SHOP HAS BEEN CLOSED on {{shop_name}}</p>
                        </div>
                        <p style="text-align: center; font-size: 14px;"></p>
                        <p style="font-size: 14px; text-align: center;">Your request to close the shop \'{{shop_title}}\'  has been approved.</p>
                        <p style="text-align: center; font-size: 14px;">Your products, review and personal information have been removed from the store.</p>
                        </div>'
            ),
            'mp_request_portibility_gdpr' => array(
                'subject' => 'Confirm Your Personal Data Request',
                'description' => 'This template is used to send confirm request for data access to the customer',
                'body' => '<div style="padding: 10px;">
                            <p style="font-size:14px;">Hi,</p>
                            <p></p>
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #20a9de; background: #3db0aa; color: #fff;">
                            <p style="font-size: 16px; text-align: center; font-weight: bold;">Confirm Your Personal Data Request</p>
                            </div>
                            <p></p>
                            <p style="text-align: center; font-size: 14px;"><span>Do you want to download your data?</p>
                            <p style="text-align: center; font-size: 14px;"><span>Click on the link below to confirm.  </span></p>
                            <p style="text-align: center; font-size: 14px;"></p>
                            <table width="180" cellspacing="0" cellpadding="5" border="0" align="center" style="width: 180px;">
                            <tbody>
                            <tr>
                            <td bgcolor="#f01328" style="color: #ffffff; background-color: #3b3634; padding: 5px;" align="center">
                            <a href="{{confirm_link}}" style="display: block; text-decoration: none; line-height: 26px; font-weight: bold; margin: 0px 0px 10px 0px; font-family: Helvetica; font-size: 16px; background-color: #3b3634; color: #ffffff; width: 100%; margin-bottom: 0;" target="_blank"> Confirm </a></td>
                            </tr>
                            </tbody>
                            </table>
                            </div>'
            ),
            'mp_gdpr_report' => array(
                'subject' => 'Your Personal Data Report',
                'description' => 'This template is used to send personal report to the customer',
                'body' => $report_data_template
            ),
        );
        
        foreach ($mail_content as $key => $content) {
            $id_email_template = Db::getInstance()->getValue('SELECT id_email_template FROM ' . _DB_PREFIX_ . 'kb_mp_email_template where name="'.pSQL($key).'"');
            if (empty($id_email_template)) {
                Db::getInstance()->execute('INSERT INTO ' . _DB_PREFIX_ . 'kb_mp_email_template set end="f",name="'.pSQL($key).'",description="'.pSQL($content['description']).'",date_add=now(),date_upd=now()');
                $id_email_template = DB::getInstance()->Insert_ID();
            }
            if (!empty($id_email_template)) {
                $email_obj = new KbEmail($id_email_template);
                foreach ($languages as $lng) {
                    $email_obj->subject[$lng['id_lang']] = $content['subject'];
                    $email_obj->body[$lng['id_lang']] = html_entity_decode($content['body']);
                }
                $email_obj->save();
            }
        }
        /*End- MK made changes on 28-05-18 for gdpr changes*/
        return true;
    }
    
    /*
     * hook function to delete the Customer Data when any other GDPR compliant plugin request to delete the customer
     * MK made changes on 30-05-18
     */
    public function hookActionDeleteGDPRCustomer($customer)
    {
        if (!empty($customer['email']) && Validate::isEmail($customer['email'])) {
            if (Module::isInstalled('kbmarketplace')) {
                $config = Configuration::get('KB_MARKETPLACE');
                if ($config) {
                    $email = $customer['email'];
                    $id_customer = Customer::customerExists($email, true, false);
                    if (!empty($id_customer)) {
                        $id_seller = KbSeller::getSellerByCustomerId($id_customer);
                        if ($id_seller) {
                            //delete seller products
                            $seller_products = KbSellerProduct::getSellerProducts($id_seller);
                            if (!empty($seller_products)) {
                                foreach ($seller_products as $sell_product) {
                                    if (KbSellerProduct::isSellerProduct($id_seller, $sell_product['id_product'])) {
                                        $product = new Product($sell_product['id_product']);
                                        $product->delete();
                                    }
                                }
                            }
                            
                            //delete review
                            $seller_reviews = KbSellerReview::getReviewsBySellerId($id_seller);
                            if (!empty($seller_reviews)) {
                                foreach ($seller_reviews as $sell_review) {
                                    $review = new KbSellerReview($sell_review['id_seller_review']);
                                    $review->delete();
                                }
                            }
                            
                            //delete carriers
                            $seller_shippings = KbSellerShipping::getSellerShippings($id_seller, Context::getContext()->language->id);
                            if (!empty($seller_shippings)) {
                                foreach ($seller_shippings as $sell_ship) {
                                    $carrier = new Carrier($sell_ship['id_carrier']);
                                    $carrier->delete();
                                }
                            }
                            //delete seller
                             $seller = new KbSeller($id_seller);
                             $seller->delete();
                        } else {
                            //delete customer review
                             Db::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'kb_mp_seller_review WHERE id_customer='.(int)$id_customer);
                             Db::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'kb_mp_seller_product_review WHERE id_customer='.(int)$id_customer);
                        }
                        return json_encode(true);
                    }
                    return json_encode($this->l('Marketplace: No user found with this email.'));
                }
            }
        }
    }
    /*
     * function added by rishabh jain to add the return manager tab in menu
     */
    public function hookDisplayKbSellerAccountMenu($params)
    {
        $menu_html = '';
        $is_available_product_availability_tab = 0;
        if (Module::isInstalled('productavailabilitycheckbyzipcode') && Module::isEnabled('productavailabilitycheckbyzipcode')) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            $product_avail_config = Configuration::get('PRODUCT_AVAILABILITY_CHECK_BY_ZIPCODE');
            $formvalue = Tools::unSerialize($product_avail_config);
            if (isset($formvalue['enable']) && $formvalue['enable'] == 1) {
                if (isset($mp_config['enable_product_avaialability_compatibility']) && $mp_config['enable_product_avaialability_compatibility'] == 1) {
                    $is_available_product_availability_tab = 1;
                }
            }
        }
        /* chnages by rishabh jain on 24th JUly 2019 for shipping cost by zipcode plugin compatibility */
        $is_available_dynamic_price_tab = 0;
        if (Module::isInstalled('kbdynamicpricing') && Module::isEnabled('kbdynamicpricing')) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            $values = Configuration::get('kb_dynamic_price_basic_settings', null, null, $this->context->shop->id);
            $values = Tools::jsonDecode($values);

            if (isset($values->kb_dynamic_price_basic_settings) && $values->enable == 1) {
//                if (isset($mp_config['enable_shipping_cost_zipcode_compatibility']) && $mp_config['enable_shipping_cost_zipcode_compatibility'] == 1) {
                    $is_available_dynamic_price_tab = 1;
//                }
            }
        }
        $is_available_dynamic_price_tab = 0;
        /* chnages by rishabh jain on 24th JUly 2019 for shipping cost by zipcode plugin compatibility */
        $is_available_booking_calender_tab = 0;
//        if (Module::isInstalled('kbbookingcalendar') && Module::isEnabled('kbbookingcalendar')) {
//            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
//            $config = Tools::jsonDecode(Configuration::get('kb_dynamic_price_basic_settings'));
//            if (isset($config->enable) && $config->enable == 1) {
////                if (isset($mp_config['enable_shipping_cost_zipcode_compatibility']) && $mp_config['enable_shipping_cost_zipcode_compatibility'] == 1) {
//                    $is_available_booking_calender_tab = 1;
////                }
//            }
//        }
        
        $is_available_booking_calender_tab = 0;
        if ($is_available_product_availability_tab == 1 || $is_available_dynamic_price_tab == 1 || $is_available_booking_calender_tab == 1) {
            $active_class = '';
            $active_zipcode_class = '';
            $active_zipcode_mapping_class = '';
//            if ((isset($params['m']) && $params['m'] == $this->name)
//                && (isset($params['c']) && ($params['c'] == 'returnrequest' || $params['c'] == 'returnrequest'))) {
//                $active_class = 'kb-active-menuitem';
//            }
//            if ((isset($params['m']) && $params['m'] == $this->name)
//                && (isset($params['c']) && ($params['c'] == 'globalzones' || $params['c'] == 'globalzones'))) {
//                $active_zipcode_class = 'kb-active-menuitem';
//            }
//            if ((isset($params['m']) && $params['m'] == $this->name)
//                && (isset($params['c']) && ($params['c'] == 'zipcodeproductmapping' || $params['c'] == 'zipcodeproductmapping'))) {
//                $active_zipcode_mapping_class = 'kb-active-menuitem';
//            }
            $list_link = $this->context->link->getModuleLink(
                'kbmarketplace',
                'returnrequest',
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            $global_list_link = $this->context->link->getModuleLink(
                'kbmarketplace',
                'globalzones',
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            $global_list_mapping_link = $this->context->link->getModuleLink(
                'kbmarketplace',
                'zipcodeproductmapping',
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            if ($is_available_dynamic_price_tab == 1) {
                $dynamic_rules_page_link = $this->context->link->getModuleLink(
                    'kbmarketplace',
                    'dynamicpricerules',
                    array(),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                );
            }
            if ($is_available_booking_calender_tab == 1) {
                $booking_product_page_link = $this->context->link->getModuleLink(
                    'kbmarketplace',
                    'KbBookingProduct',
                    array(),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                );
                $booking_product_price_rule_link = $this->context->link->getModuleLink(
                    'kbmarketplace',
                    'KbBookingProductPriceRules',
                    array(),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                );
            }
            // code modified by rishabh jain on 27th JUly 2018 to show + sign along the customer tickets tab
            if ($is_available_product_availability_tab == 1) {
                $menu_html = ' <style>
                    .kb-accordian-symbol, #kb-seller-account-menus .kb-smenu-accordian-symbol{
                       font-family: FontAwesome;
                       font-weight: normal;
                       font-style: normal;
                       text-decoration: inherit;
                       -webkit-font-smoothing: antialiased;
                       float:right;
                       cursor:pointer;
                    }

                    .kb-accordian-symbol{
                       display:none;
                    }

                    #kb-seller-account-menus .kb-smenu-accordian-symbol{
                       font-size: 22px;
                    }

                    #kb-seller-account-menus .kb-active-menuitem .kb-smenu-accordian-symbol{
                       color:#fff;
                    }

                    .kb-menu-list-item .kb-accordian-symbol.kbexpand:after, #kb-seller-account-menus .kb-smenu-accordian-symbol.kbexpand:after{
                       content:"+";
                    }

                    .kb-menu-list-item .kb-accordian-symbol.kbcollapse:after, #kb-seller-account-menus .kb-smenu-accordian-symbol.kbcollapse:after{
                       content:"-";
                    }
                    </style><li class="kb-menu-list-item  collapsible-otherfeature-menu">
                        <a title="'.$this->l('Manage Product avaialbility by zipcode', 'kbconfiguration').'" href="javascript:void(0)">
                            <i class="icon-tags"></i>'.$this->l('Manage Products avaialbility by zipcode', 'kbconfiguration').'
                        </a>
                        <div class="kb-smenu-accordian-symbol kbexpand"></div>
                        <ul style="display:none;">
                            <li><a class="' . (($params['c'] == $active_zipcode_class) ? 'smenu-other-feature-menu-active' : '')
                            . '" href="' . $global_list_link . '">'. $this->l('Global Zones', 'kbconfiguration') . '</a></li>
                            <li><a class="' . (($params['c'] == $active_zipcode_mapping_class) ? 'smenu-other-feature-menu-active' : '')
                            . '" href="' . $global_list_mapping_link . '">'. $this->l('Product Zone Mapping', 'kbconfiguration') . '</a></li>
                        </ul>   
                    </li>';
            }
            if ($is_available_dynamic_price_tab == 1) {
                $menu_html .= ' <style>
                    .kb-accordian-symbol, #kb-seller-account-menus .kb-smenu-accordian-symbol{
                       font-family: FontAwesome;
                       font-weight: normal;
                       font-style: normal;
                       text-decoration: inherit;
                       -webkit-font-smoothing: antialiased;
                       float:right;
                       cursor:pointer;
                    }

                    .kb-accordian-symbol{
                       display:none;
                    }

                    #kb-seller-account-menus .kb-smenu-accordian-symbol{
                       font-size: 22px;
                    }

                    #kb-seller-account-menus .kb-active-menuitem .kb-smenu-accordian-symbol{
                       color:#fff;
                    }

                    .kb-menu-list-item .kb-accordian-symbol.kbexpand:after, #kb-seller-account-menus .kb-smenu-accordian-symbol.kbexpand:after{
                       content:"+";
                    }

                    .kb-menu-list-item .kb-accordian-symbol.kbcollapse:after, #kb-seller-account-menus .kb-smenu-accordian-symbol.kbcollapse:after{
                       content:"-";
                    }
                    </style><li class="kb-menu-list-item  collapsible-otherfeature-menu">
                        <a title="'.$this->l('Dynamic Price Rules', 'kbconfiguration').'" href="'.$dynamic_rules_page_link.'">
                            <i class="icon-tags"></i>'.$this->l('Dynamic Price Rules', 'kbconfiguration').'
                        </a>
                    </li>';
            }
            if ($is_available_booking_calender_tab == 1) {
                $menu_html .= ' <style>
                    .kb-accordian-symbol, #kb-seller-account-menus .kb-smenu-accordian-symbol{
                       font-family: FontAwesome;
                       font-weight: normal;
                       font-style: normal;
                       text-decoration: inherit;
                       -webkit-font-smoothing: antialiased;
                       float:right;
                       cursor:pointer;
                    }

                    .kb-accordian-symbol{
                       display:none;
                    }

                    #kb-seller-account-menus .kb-smenu-accordian-symbol{
                       font-size: 22px;
                    }

                    #kb-seller-account-menus .kb-active-menuitem .kb-smenu-accordian-symbol{
                       color:#fff;
                    }

                    .kb-menu-list-item .kb-accordian-symbol.kbexpand:after, #kb-seller-account-menus .kb-smenu-accordian-symbol.kbexpand:after{
                       content:"+";
                    }

                    .kb-menu-list-item .kb-accordian-symbol.kbcollapse:after, #kb-seller-account-menus .kb-smenu-accordian-symbol.kbcollapse:after{
                       content:"-";
                    }
                    </style><li class="kb-menu-list-item  collapsible-otherfeature-menu">
                        <a title="'.$this->l('Booking Products', 'kbconfiguration').'" href="'.$booking_product_page_link.'">
                            <i class="icon-tags"></i>'.$this->l('Booking Products', 'kbconfiguration').'
                        </a>
                    </li>';
                $menu_html .= '<li class="kb-menu-list-item  collapsible-otherfeature-menu">
                        <a title="'.$this->l('Booking Products Price Rules', 'kbconfiguration').'" href="'.$booking_product_price_rule_link.'">
                            <i class="icon-tags"></i>'.$this->l('Booking Products Price Rules', 'kbconfiguration').'
                        </a>
                    </li>';
            }
        }
        return $menu_html;
    }
    
    /*
     * Chnages started by rishabh jain on 14th may 2019
     * to remove the product from the cart of other sellers
     */
    public function hookActionCartUpdateQuantityBefore($param)
    {
//        print_r($param);
//        die('testing');
    }
    
    /*
     * function to send the message notification to the seller when customer submit the new message in Order history page
     * MK made changes on 30-05-18
     */
    public function hookActionObjectCustomerMessageAddAfter($param)
    {
        if (Module::isInstalled('kbmarketplace') && !Tools::getIsset('module') && Tools::getIsset('msgText')) {
            $config = Configuration::get('KB_MARKETPLACE');
            if ($config) {
                $check = false;
//                $id_employee = Context::getContext()->employee->id;
                if (isset(Context::getContext()->controller) && Context::getContext()->controller->controller_type == 'front') {
                    $check = true;
                } elseif (isset(Context::getContext()->employee->id) && empty(Context::getContext()->employee->id)) {
                    $check = true;
                }
                if (!$check) {
                    return;
                }
                if (Tools::getIsset('id_order')) {
                    $id_order = Tools::getValue('id_order');
                    if (!empty($id_order)) {
                        $id_seller = Db::getInstance()->getValue('SELECT id_seller FROM '._DB_PREFIX_.'kb_mp_seller_earning where id_order='.(int)$id_order);
                        if (!empty($id_seller)) {
                            $kbseller = new KbSeller($id_seller);
                            if ($kbseller->isSeller()) {
                                $order = new Order($id_order);
                                $customer = new Customer($order->id_customer);
                                $message = Tools::getValue('msgText');
                                if (Configuration::get('PS_MAIL_TYPE', null, null, $order->id_shop) != Mail::TYPE_TEXT) {
                                    $message = Tools::nl2br(Tools::getValue('msgText'));
                                }
                                $product = new Product(Tools::getValue('id_product'));
                                $product_name = '';
                                if (Validate::isLoadedObject($product) && isset($product->name[(int) $order->id_lang])) {
                                    $product_name = $product->name[(int) $order->id_lang];
                                }
                                $varsTpl = array(
                                    '{lastname}' => $customer->lastname,
                                    '{firstname}' => $customer->firstname,
                                    '{id_order}' => $id_order,
                                    '{email}' => $customer->email,
                                    '{order_name}' => $order->getUniqReference(),
                                    '{message}' => $message,
                                    '{product_name}' => $product_name
                                );
                                
                                $notification_emails = $kbseller->getEmailIdForNotification();
                                foreach ($notification_emails as $em) {
                                    Mail::Send(
                                        (int) $order->id_lang,
                                        'order_customer_comment',
                                        Mail::l('Message from a customer', (int) $order->id_lang),
                                        $varsTpl,
                                        $em['email'],
                                        $em['title'],
                                        $customer->email,
                                        $customer->firstname.' '.$customer->lastname,
                                        null,
                                        null,
                                        _PS_MAIL_DIR_,
                                        true,
                                        (int) $order->id_shop
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
    /*
     * hook function to export the Customer Data when any other GDPR compliant plugin request to export
     * MK made changes on 30-05-18
     */
    public function hookActionExportGDPRData($customer)
    {
        if (!empty($customer['email']) && Validate::isEmail($customer['email'])) {
            $id_lang = Context::getContext()->language->id;
            if (Module::isInstalled('kbmarketplace')) {
                $config = Configuration::get('KB_MARKETPLACE');
                if ($config) {
                    $email = $customer['email'];
                    $id_customer = Customer::customerExists($email, true, false);
                    if (!empty($id_customer)) {
//                        d($customer);
                        $id_seller = KbSeller::getSellerByCustomerId($id_customer);
//                        d($id_seller);
                        $is_seller = false;
                        if ($id_seller) {
                            $is_seller = true;
                        }
                        //seller review
                        $seller_review_condition = '';
                        if ($is_seller) {
                            $seller_review_condition .= ' AND sr.id_seller = ' . (int) $id_seller;
                        } else {
                            $seller_review_condition .= ' AND c.id_customer = ' . (int) $id_customer;
                        }

                        $seller_reviews = Db::getInstance()->executeS('Select sr.*,c.firstname, c.lastname,c.id_customer from ' . _DB_PREFIX_ . 'kb_mp_seller_review as sr 
                                    INNER JOIN ' . _DB_PREFIX_ . 'customer as c on (sr.id_customer = c.id_customer) 
                                    Where 1 AND sr.id_lang=' . (int) $id_lang . ' ' . $seller_review_condition);
                        $seller_order = array();
                        $seller_product = array();
                        if ($is_seller) {
                            $seller_order = KbSellerOrderDetail::getDetailBySellerId($id_seller);
                            $seller_product = KbSellerProduct::getSellerProducts($id_seller);
                        }
                        
                        $resArray = array();
                        $currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
                        
                        if (!empty($seller_product)) {
                            foreach ($seller_product as $sell_product) {
                                $product = new Product($sell_product['id_product'], false, $id_lang);
                                $category = new Category($product->id_category_default, $id_lang);
                                $quantity = Db::getInstance()->getRow(
                                    'SELECT quantity FROM ' . _DB_PREFIX_ . 'stock_available'
                                    . ' WHERE id_product=' . (int) $product->id . ' '
                                    . 'AND id_product_attribute=0 '
                                    . 'AND id_shop=' . (int) Context::getContext()->shop->id
                                );
                                $specific_price = SpecificPrice::getSpecificPrice(
                                    (int) $product->id,
                                    $this->context->shop->id,
                                    $currency->id,
                                    Context::getContext()->country->id,
                                    0,
                                    1,
                                    0,
                                    0,
                                    0,
                                    $quantity['quantity']
                                );
                                $resArray[] = array(
                                     $this->l('Seller Product- Title', 'kbconfiguration') => $product->name,
                                    $this->l('Seller Product- Default Category', 'kbconfiguration') => $category->name,
                                    $this->l('Seller Product- Price tax excluded or Price tax included', 'kbconfiguration') => Tools::displayPrice($product->price, $currency),
                                    $this->l('Seller Product- Wholesale Price', 'kbconfiguration') => Tools::displayPrice($product->wholesale_price, $currency),
                                    $this->l('Seller Product- Discount amount', 'kbconfiguration') => (!empty($specific_price)) ? Tools::displayPrice($specific_price['reduction'], $currency) : '',
                                    $this->l('Seller Product- Discount From', 'kbconfiguration') => (!empty($specific_price)) ? $specific_price['from'] : '',
                                    $this->l('Seller Product- Discount To', 'kbconfiguration') => (!empty($specific_price)) ? $specific_price['to'] : '',
                                    $this->l('Seller Product- Reference', 'kbconfiguration') => $product->reference,
                                    $this->l('Seller Product- Supplier Reference', 'kbconfiguration') => $product->supplier_reference,
                                    $this->l('Seller Product- Supplier', 'kbconfiguration') => $product->supplier_name,
                                    $this->l('Seller Product- Manufacture', 'kbconfiguration') => $product->manufacturer_name,
                                    $this->l('Seller Product- UPC', 'kbconfiguration') => $product->upc,
                                    $this->l('Seller Product- EAN-13', 'kbconfiguration') => $product->ean13,
                                    $this->l('Seller Product- Condition', 'kbconfiguration') => $product->condition,
                                    $this->l('Seller Product- Short Description', 'kbconfiguration') => $product->description_short,
                                    $this->l('Seller Product- Description', 'kbconfiguration') => $product->description,
                                    $this->l('Seller Product- Meta Title', 'kbconfiguration') => $product->meta_title,
                                    $this->l('Seller Product- Meta Description', 'kbconfiguration') => $product->meta_description,
                                    $this->l('Seller Product- Friendly URL', 'kbconfiguration') => $product->link_rewrite,
                                    $this->l('Seller Product- width', 'kbconfiguration') => $product->width,
                                    $this->l('Seller Product- height', 'kbconfiguration') => $product->height,
                                    $this->l('Seller Product- depth', 'kbconfiguration') => $product->depth,
                                    $this->l('Seller Product- weight', 'kbconfiguration') => $product->weight,
                                    $this->l('Seller Product- Quantity', 'kbconfiguration') => $product->quantity,
                                    $this->l('Seller Product- Additional Shipping Fee', 'kbconfiguration') => Tools::displayPrice($product->additional_shipping_cost, $currency),
                                    $this->l('Seller Product- Tags', 'kbconfiguration') => $product->tags,
                                    $this->l('Seller Product- Active', 'kbconfiguration') => ($product->active) ? $this->l('Yes') : $this->l('No'),
                                    $this->l('Seller Product- Date Updated', 'kbconfiguration') => Tools::displayDate($product->date_upd, $id_lang),
                                );
                            }
                        }
//                        d($seller_order);
                        if (!empty($seller_order)) {
                            foreach ($seller_order as $sell_order) {
                                $order = new Order($sell_order['id_order']);
                                $order_state = $order->getCurrentStateFull($id_lang);
                                $resArray[] = array(
                                    $this->l('Seller Order- Reference', 'kbconfiguration') => $order->reference,
                                    $this->l('Seller Order- Date', 'kbconfiguration') =>  Tools::displayDate($order->date_add, $id_lang),
                                    $this->l('Seller Order- Payment', 'kbconfiguration') =>   $order->payment,
                                    $this->l('Seller Order- Current Status', 'kbconfiguration') =>  $order_state['name'],
                                    $this->l('Seller Order- Total Price', 'kbconfiguration') =>  Tools::displayPrice($order->total_paid, $currency),
                                    $this->l('Seller Order- Earning', 'kbconfiguration') =>  Tools::displayPrice($sell_order['seller_earning'], $currency),
                                    $this->l('Seller Order- Admin Earning', 'kbconfiguration') =>  Tools::displayPrice($sell_order['admin_earning'], $currency),
                                );
                            }
                        }
                        
                        if (!empty($seller_reviews)) {
                            foreach ($seller_reviews as $sell_review) {
                                $resArray[] = array(
                                    $this->l('Seller Review- Title', 'kbconfiguration') => $sell_review['title'],
                                    $this->l('Seller Review- Comment', 'kbconfiguration') => $sell_review['comment'],
                                    $this->l('Seller Review- Rating', 'kbconfiguration') => $sell_review['rating'],
                                    $this->l('Seller Review- Seller Name', 'kbconfiguration') => $sell_review['firstname'].' '.$sell_review['lastname'],
                                    $this->l('Seller Review- Approved', 'kbconfiguration') => ($sell_review['approved'])?$this->l('Approved'):$this->l('Not approved'),
                                    $this->l('Seller Review- Date Added', 'kbconfiguration') => $sell_review['date_add'],
                                );
                            }
                        }
                        
//                        if (!empty($seller_product_review)) {
//                            foreach ($seller_product_review as $prod_review) {
//                                $resArray[] = array(
//                                    $this->l('Product Review- Title', 'kbconfiguration') => $prod_review['title'],
//                                    $this->l('Product Review- Comment', 'kbconfiguration') => $prod_review['content'],
//                                    $this->l('Product Review- Rating', 'kbconfiguration') => $prod_review['grade'],
//                                    $this->l('Product Review- Product Name', 'kbconfiguration') => $prod_review['name'],
//                                    $this->l('Product Review- Date Added', 'kbconfiguration') => $prod_review['date_add'],
//                                );
//                            }
//                        }
                        
                        return json_encode($resArray);
                    }
                    return json_encode($this->l('Marketplace : No User found with this email.', 'kbconfiguration'));
                }
            }
        }
    }

    private function getMPTables()
    {
        return array(
            'kb_mp_seller', 'kb_mp_seller_lang', 'kb_mp_seller_product', 'kb_mp_seller_product_tracking',
            'kb_mp_seller_review', 'kb_mp_seller_product_review', 'kb_mp_seller_category_request',
            'kb_mp_seller_config', 'kb_mp_seller_category', 'kb_mp_seller_category_tracking', 'kb_mp_reasons',
            'kb_mp_seller_earning', 'kb_mp_seller_order_detail', 'kb_mp_seller_transaction', 'kb_mp_seller_shipping',
            'kb_mp_email_template', 'kb_mp_email_template_lang', 'kb_mp_seller_menu', 'kb_mp_seller_menu_lang'
        );
    }

    /*
     * array(
     *      'table_name' => array(
     *          'new_column_name' => 'script'
     *      )
     * )
     */

    private function getModifiedTables()
    {
        /* changes done by rishabh jain on 6th sep
         * to add comaptibility with kb product review plugin
         * dropped id_customer constraint from kb_mp_product_review_table
         */
        return array(
            'kb_mp_seller' => array(
                'payment_info' => 'ALTER TABLE `' . _DB_PREFIX_ . 'kb_mp_seller` 
                    DROP FOREIGN KEY `' . _DB_PREFIX_ . 'kb_mp_seller_ibfk_1`;
                    ALTER TABLE `' . _DB_PREFIX_ . 'kb_mp_seller` DROP INDEX `id_customer`;
                    ALTER TABLE `' . _DB_PREFIX_ . 'kb_mp_seller` 
                    CHANGE COLUMN `id_paypal` `payment_info` TEXT NULL DEFAULT NULL'
            ),
            'kb_mp_seller_earning' => array(
                'can_handle_order' => 'ALTER TABLE `' . _DB_PREFIX_ . 'kb_mp_seller_earning` 
                    ADD `can_handle_order` TINYINT(1) NOT NULL DEFAULT "0"'
            ),
            'kb_mp_seller_lang' => array(
                'profile_url' => 'ALTER TABLE `' . _DB_PREFIX_ . 'kb_mp_seller_lang` 
                    ADD `profile_url` text DEFAULT NULL'
            )
        );
    }

    private function getEmailTemplateData()
    {
        $data = array(
            'mp_welcome_seller' => array(
                'subject' => 'Market Place Seller Welcome',
                'body' => '<div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #000000;">
                            <p style="color: #000; text-align: center; font-size: 15px;">
                            <strong>Market Place Seller Welcome</strong></p>
                            </div>
                            <p>Thank You For Registering as Seller.</p>
                            <p>Your Email: {{email}}</p>
                            <p>Your Name: {{full_name}}</p>
                            <p>Once the Admin approves your seller account, you can start selling on our website.</p>
                            </div>'
            ),
            'mp_seller_account_approval' => array(
                'subject' => 'Market Place Seller Account Approved',
                'body' => '<div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #000000;">
                            <p style="color: #000; text-align: center; font-size: 15px;">
                            <strong>Market Place Seller Approved</strong></p>
                            </div>
                            <p>Hi {{full_name}},</p>
                            <p>Congrats, Your seller account is approved and activated.
                            Now you can start selling on our website.</p>
                            <p>Your Email: {{email}}</p>
                            <p>Your Name: {{full_name}}</p>
                            </div>'
            ),
            'mp_seller_account_disapproval' => array(
                'subject' => 'Market Place Seller Account Disapproved',
                'body' => '<div style="padding: 10px;">
                        <div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
                        <p style="font-size: 15px; text-align: center; font-weight: bold;">
                        Market Place Seller Disapproved</p>
                        </div>
                        <p>Hi {{full_name}},</p>
                        <p>Sorry to inform you, Your seller account request is rejected on our website.</p>
                        <p>But do not worry you can request again for your account.</p>
                        <p><b>Reason for Disapproval:</b></p>
                        <pre>{{disapproval_reason}}</pre>
                        </div>'
            ),
            'mp_seller_registration_notification_admin' => array(
                'subject' => 'Market Place Seller Registration Notification',
                'body' => '<div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #000000;">
                            <p style="color: #000000; font-size: 15px; text-align: center;">
                            Market Place Seller Registration Notification</p>
                            </div>
                            <p>A customer just registered as seller on your website.</p>
                            <p><b>Details of the Customer are as follows: </b></p>
                            <p><b>Email: </b>{{email}}</p>
                            <p><b>Name:</b> {{full_name}}</p>
                            </div>'
            ),
            'mp_seller_account_approval_after_disapprove' => array(
                'subject' => 'Seller again Requested for Approving his Account',
                'body' => '<p>Hi Admin,</p>
                            <div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #000000;">
                            <p style="font-size: 15px; text-align: center; font-weight: bold;">
                            Customer has just requested for approving his seller account, after disapproved by you</p>
                            </div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Seller Details on Store:</p>
                            <div style="margin-bottom: 10px; width: 100%;"><span><b>Store:</b>
                            {{shop_title}} </span><br /><span><b>Name:</b> {{seller_name}}</span>
                            <br /><span><b>Email:</b> {{seller_email}}</span> <br />
                            <span><b>Contact:</b> {{seller_contact}}</span></div>
                            </div>
                            
                            </div>'
            ),
            'mp_new_product_notification_admin' => array(
                'subject' => 'New Product Approval Request',
                'body' => '<div style="padding: 10px;">
                        <div style="margin-bottom: 10px; width: 100%; border: 1px solid #000;">
                        <p style="color: #000000; font-size: 15px; text-align: center;">
                        New product is just added to our store by <b>{{seller_title}}</b>.
                        </p>
                        </div>
                        <br />
                        <p><b>Product Details:</b></p>
                        <p><span><b>Product Name:</b> {{product_name}}</span> <br />
                        <span><b>SKU:</b> {{product_sku}}</span><br />
                        <span><b>Price:</b> {{product_price}}</span></p>
                        <br />
                        <p><b>Seller Details:</b></p>
                        <p><span><b>Name:</b> {{seller_name}}</span><br /><span> <b>Email:</b>
                        {{seller_email}}</span><br /><span> <b>Contact:</b> {{seller_contact}}</span>
                        </p>
                        <br />
                        <p>Please go to <a href="{shop_url}">store</a> and approve this product.</p>
                        </div>'
            ),
            'mp_category_request_notification_admin' => array(
                'subject' => 'New Category Request Notitfication',
                'body' => '<p>Hi Admin,</p>
                            <div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #000;">
                            <p style="color: #000000; font-size: 15px; text-align: center;">
                            One of your seller has requested for new category approval.</p>
                            </div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Requested Category Details:</p>
                            <p><b>Requested Category</b>:<br />{{requested_category}}</p>
                            <p><b>Reason</b>:</p>
                            <pre><span>{{reason}}</span></pre>
                            </div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Seller Details on Store:</p>
                            <div style="margin-bottom: 10px; width: 100%;"><span><b>Store:</b>
                            {{shop_title}} </span><br /><span><b>Name:</b> {{seller_name}}</span>
                            <br /><span><b>Email:</b> {{seller_email}}</span> <br />
                            <span><b>Contact:</b> {{seller_contact}}</span></div>
                            </div>
                            <p>Please go to <a href="{shop_url}">store</a> and approve the requested category.</p>
                            </div>'
            ),
            'mp_category_request_approved' => array(
                'subject' => 'Category Approval Notification',
                'body' => '<div style="padding: 10px;">
                            <p>Hi {{seller_name}},</p>
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #3fad1c;">
                            <p style="color: #000000; font-size: 15px; text-align: center;">
                            <b>Congratulations!</b> Your request for new category has been approved.
                            Now you can add your products into this new category.</p>
                            </div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Requested Category:</p>
                            <p>{{requested_category}}</p>
                            </div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Your Details on Store:</p>
                            <div style="margin-bottom: 10px; width: 100%;"><span><b>Store:</b>
                            {{shop_title}}</span><br /><span><b>Name:</b> {{seller_name}}</span><br />
                            <span><b>Email:</b> {{seller_email}}</span><br /><span><b>Contact:</b>
                            {{seller_contact}}</span></div>
                            </div>
                            </div>'
            ),
            'mp_category_request_disapproved' => array(
                'subject' => 'Category Disapproval Notification',
                'body' => '<div style="padding: 10px;">
                            <p>Hi {{seller_name}},</p>
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
                            <p style="color: #000000; font-size: 15px;
                            text-align: center;"><b>Sorry!</b>
                            Your request for new category has been disapproved by Admin.</p>
                            </div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Requested Category Details:</p>
                            <p><b>Name:</b><br />{{requested_category}}</p>
                            <p><b>Reason:</b></p>
                            <pre><span>{{comment}}</span></pre>
                            </div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Your Details on Store:</p>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <span><b>Store:</b> {{shop_title}}</span><br /><span><b>Name:</b>
                            {{seller_name}}</span><br /><span><b>Email:</b> {{seller_email}}</span>
                            <br /><span><b>Contact:</b> {{seller_contact}}</span></div>
                            <p>To again request, please go to <a href="{shop_url}">store</a> and make new request.</p>
                            </div>
                            </div>'
            ),
            'mp_product_disapproval_notification' => array(
                'subject' => 'Your Product has been Disapproved',
                'body' => '<div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
                            <p style="color: #000; text-align: center; font-size: 15px;">
                            <strong>Your product has been disapproved on {shop_name}.</strong></p>
                            </div>
                            <br />
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p><b>Reason For Disapproving Product:</b></p>
                            <p></p>
                            <pre><span>{{reason}}</span></pre>
                            </div>
                            <br />
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Product Details:</p>
                            <div style="margin-bottom: 10px; width: 100%;"><span>
                            <b>Product Name:</b> {{product_name}}</span><br /><span><b>SKU:</b>
                            {{product_sku}}</span><br /><span><b>Price:</b> {{product_price}}</span></div>
                            <br />
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Your Details on Store:</p>
                            <div style="margin-bottom: 10px; width: 100%;"><span><b>Store:</b>
                            {{shop_title}}</span> <br /><span><b>Name:</b> {{seller_name}}
                            </span><br /><span> <b>Email:</b> {{seller_email}}</span>
                            <br /><span><b>Contact:</b> {{seller_contact}}</span></div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p>To request for approving your product. Please contact to support.</p>
                            </div>
                            </div>'
            ),
            'mp_product_approval_notification' => array(
                'subject' => 'Your Product has been Approved',
                'body' => '<div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #3fad1c;">
                            <p style="font-size: 15px; text-align: center;
                            font-weight: bold;">
                            Your product has been approved and is available for sale.
                            Please go to <a href="{shop_url}">store</a> and review your product.
                            </p>
                            </div>
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Product Details:</p>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <span> <b>Product Name:</b> {{product_name}}</span><br />
                            <span><b>SKU:</b> {{product_sku}}</span><br />
                            <span> <b>Price:</b> {{product_price}}</span></div>
                            <br />
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Your Details on Store:</p>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <span><b>Store:</b> {{shop_title}} </span><br /><span><b>Name:</b>
                            {{seller_name}}</span><br /><span><b>Email:</b>
                            {{seller_email}}</span> <br />
                            <span><b>Contact:</b> {{seller_contact}}</span></div>
                            </div>'
            ),
            'mp_product_delete_notification' => array(
                'subject' => 'Your Product has been Deleted',
                'body' => '<div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
                            <p style="color: #000; text-align: center; font-size: 15px;">
                            <strong>Your product has been deleted from {shop_name}.</strong></p>
                            </div>
                            <br />
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p><b> Reason For Deleting Product:</b></p>
                            <p></p>
                            <pre><span>{{reason}}</span></pre>
                            </div>
                            <br />
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Product Details:</p>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <span> <b>Product Name:</b> {{product_name}}</span> <br />
                            <span><b>SKU:</b> {{product_sku}}</span><br />
                            <span> <b>Price:</b> {{product_price}}</span></div>
                            <br />
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Your Details on Store:</p>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <span><b>Store:</b> {{shop_title}}</span> <br />
                            <span><b>Name:</b> {{seller_name}}</span><br />
                            <span><b>Email:</b> {{seller_email}}</span><br />
                            <span><b>Contact:</b> {{seller_contact}}</span></div>
                            <div style="margin-bottom: 10px; width: 100%;"></div>
                            </div>'
            ),
            'mp_seller_review_approval_request_admin' => array(
                'subject' => 'New review is posted on seller',
                'body' => '<p>Hi Admin,</p>
                            <div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #000000;">
                            <p style="color: #000; text-align: center; font-size: 15px;">
                            <strong>One of the our customer has posted a review for {{shop_title}}.
                            </strong></p>
                            </div>
                            <br />
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Review given by customer:</p>
                            <p><b>Title</b>:<br /> {{review_title}}</p>
                            <p><b>Comment</b>:</p>
                            <pre><span>{{review_comment}}</span></pre>
                            </div>
                            <br />
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Seller Details:</p>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <span><b>Store:</b> {{shop_title}}</span><br />
                            <span> <b>Name:</b> {{seller_name}}</span><br />
                            <span><b>Email:</b> {{seller_email}}</span><br />
                            <span> <b>Contact:</b> {{seller_contact}}</span></div>
                            </div>
                            <p>Please go to <a href="{shop_url}">store</a> and approve new review.</p>
                            </div>'
            ),
            'mp_seller_review_notification' => array(
                'subject' => 'New review is just posted for you',
                'body' => '<p>Hi {{seller_name}},</p>
                        <div style="padding: 10px;">
                        <div style="margin-bottom: 10px; width: 100%; border: 1px solid #000000;">
                        <p style="color: #000000; text-align: center;
                        font-size: 15px;">
                        <strong>One of the your customer has posted a review for you.
                        </strong></p>
                        </div>
                        <br />
                        <div style="margin-bottom: 10px; width: 100%;">
                        <p style="text-decoration: underline; font-style: italic;
                        font-size: 15px; font-weight: bold;">Review given by customer:</p>
                        <p><b>Title</b>:<br /> {{review_title}}</p>
                        <p><b>Comment</b>:</p>
                        <pre><span>{{review_comment}}</span></pre>
                        </div>
                        <br />
                        <div style="margin-bottom: 10px; width: 100%;">
                        <p style="text-decoration: underline; font-style: italic;
                        font-size: 15px; font-weight: bold;">Your Details on Store:</p>
                        <div style="margin-bottom: 10px; width: 100%;"><span><b>Store:</b>
                        {{shop_title}}</span><br /><span><b>Name:</b> {{seller_name}}</span><br />
                        <span><b>Email:</b> {{seller_email}}</span><br /><span><b>Contact:</b>
                        {{seller_contact}}</span></div>
                        </div>
                        <p>Please go to <a href="{shop_url}">store</a> to view review status.</p>
                        </div>'
            ),
            'mp_seller_amount_credit_transfer_notification' => array(
                'subject' => 'Admin has just credited your paypal account',
                'body' => '<p>Hi {{seller_name}},</p>
                            <div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #3fad1c;">
                            <p style="color: #000; text-align: center;
                            font-size: 15px;">
                            <strong>Your Paypal Account is just Credited by Admin with amount of {{amount}}
                            </strong></p>
                            </div>
                            <br />
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Comment on Transaction:</p>
                            <p></p>
                            <pre><span>{{comment}}</span></pre>
                            </div>
                            <br />
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Your Details on Store:</p>
                            <div style="margin-bottom: 10px; width: 100%;"><span><b>Store:</b>
                            {{shop_title}}</span><br /><span><b>Name:</b> {{seller_name}}</span><br />
                            <span><b>Email:</b> {{seller_email}}</span><br /><span><b>Contact:</b>
                            {{seller_contact}}</span></div>
                            </div>
                            <p>Please go to <a href="{shop_url}">
                            store</a> to check your total paid and balance amount by admin.
                            </p>
                            </div>'
            ),
            'mp_seller_review_approved_to_customer' => array(
                'subject' => 'Your review has been approved by admin',
                'body' => '<p>Hi {{customer_name}},</p>
                            <div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #3fad1c;">
                            <p style="color: #000000; font-size: 15px;
                            text-align: center;">
                            Thanks for giving your time on our store and giving us your feedback for sellers.
                            Your review has been approved by admin on {{store_name}}
                            for seller {shop_name} and listed on store
                            </p>
                            </div>
                            <br />
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Review given by you:</p>
                            <p></p>
                            <pre><span>{{comment}}</span></pre>
                            </div>
                            </div>'
            ),
            'mp_seller_review_approved_to_seller' => array(
                'subject' => 'Review given by customer has been approved by admin',
                'body' => '<p>Hi {{seller_name}},</p>
                            <div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #3fad1c;">
                            <p style="color: #000; text-align: center; font-size: 15px;">
                            <strong>Review given by customer upon you has been approved by
                            admin on {{store_name}} and listed on store</strong></p>
                            </div>
                            <br />
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Review Detail:</p>
                            <p></p>
                            <pre><span>{{comment}}</span></pre>
                            </div>
                            </div>'
            ),
            'mp_seller_review_disspproved_to_seller' => array(
                'subject' => 'Review given by customer has been disapproved by admin',
                'body' => '<p>Hi {{seller_name}},</p>
                        <div style="padding: 10px;">
                        <div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
                        <p style="text-align: center; color: #000000; font-size: 15px;">
                        <strong>
                        Review given by customer on your shop "{{store_name}}"
                        has been disapproved by admin</strong></p>
                        </div>
                        <br />
                        <div style="margin-bottom: 10px; width: 100%;">
                        <p style="text-decoration: underline; font-style: italic;
                        font-size: 15px; font-weight: bold;">Review Detail:</p>
                        <p></p>
                        <pre><span>{{comment}}</span></pre>
                        </div>
                        <div style="margin-bottom: 10px; width: 100%;">
                        <p style="text-decoration: underline; font-style: italic;
                        font-size: 15px; font-weight: bold;">
                        Reason for disapproving:</p>
                        <p></p>
                        <pre><span>{{reason}}</span></pre>
                        </div>
                        </div>'
            ),
            'mp_seller_review_disspproved_to_customer' => array(
                'subject' => 'Review given by you has been disapproved by admin',
                'body' => '<p>Hi {{customer_name}},</p>
<div style="padding: 10px;">
<div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
<p style="color: #000; text-align: center; font-size: 15px;">
Thanks for giving your time on our store and giving us your feedback for sellers.
Unfortunately, your review has been dissapproved by admin on {{store_name}} for seller {shop_name}.
</p>
</div>
<br />
<div style="margin-bottom: 10px; width: 100%;">
<p style="text-decoration: underline; font-style: italic; font-size: 15px; font-weight: bold;">Review Detail:</p>
<p></p>
<pre><span>{{comment}}<span></span></span></pre>
</div>
<div style="margin-bottom: 10px; width: 100%;">
<p style="text-decoration: underline; font-style: italic;
font-size: 15px; font-weight: bold;">Reason for disapproving:</p>
<p></p>
<pre><span>{{reason}}</span></pre>
</div>
</div>'
            ),
            'mp_seller_amount_debit_transfer_notification' => array(
                'subject' => 'Admin has just debited some amount from balance amount',
                'body' => '<p>Hi {{seller_name}},</p>
<div style="padding: 10px;">
<div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
<p style="color: #000; text-align: center; font-size: 15px;">
<strong>Admin has just deducted {{amount}} from your current balance
</strong></p>
</div>
<br />
<div style="margin-bottom: 10px; width: 100%;">
<p style="text-decoration: underline; font-style: italic; font-size: 15px; font-weight: bold;">Reason for Deduction:</p>
<p></p>
<pre><span>{{comment}}</span></pre>
</div>
<br />
<div style="margin-bottom: 10px; width: 100%;">
<p style="text-decoration: underline; font-style: italic;
font-size: 15px; font-weight: bold;">Your Details on Store:</p>
<div style="margin-bottom: 10px; width: 100%;"><span>
<b>Store:</b> {{shop_title}}</span><br /><span><b>Name:</b>
{{seller_name}}</span> <br /><span><b>Email:</b> {{seller_email}}</span>
<br /><span> <b>Contact:</b> {{seller_contact}}</span></div>
</div>
<p>Please go to <a href="{shop_url}">store</a> to check your updated total paid and balance amount by admin.</p>
</div>'
            ),
            'mp_seller_review_delete_to_seller' => array(
                'subject' => 'Review given by customer has been deleted by admin',
                'body' => '<p>Hi {{seller_name}},</p>
<div style="padding: 10px;">
<div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
<p style="color: #000; text-align: center; font-size: 15px;">
<strong>Review given by customer upon you has been deleted by admin on {{store_name}}
</strong></p>
</div>
<br />
<div style="margin-bottom: 10px; width: 100%;">
<p style="text-decoration: underline; font-style: italic; font-size: 15px; font-weight: bold;">Review Detail:</p>
<p></p>
<pre><span>{{comment}}</span></pre>
</div>
<div style="margin-bottom: 10px; width: 100%;">
<p style="text-decoration: underline; font-style: italic; font-size: 15px; font-weight: bold;">Reason for delete:</p>
<p></p>
<pre><span>{{reason}}</span></pre>
</div>
</div>'
            ),
            'mp_seller_review_delete_to_customer' => array(
                'subject' => 'Review given by you has been deleted',
                'body' => '<p>Hi {{customer_name}},</p>
<div style="padding: 10px;">
<div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
<p style="color: #000; text-align: center; font-size: 15px;">
Thanks for giving your time on our store and giving us your feedback for sellers.
Your review has been deleted by admin on {{store_name}} for seller {shop_name}.</p>
</div>
<br />
<div style="margin-bottom: 10px; width: 100%;">
<p style="text-decoration: underline; font-style: italic; font-size: 15px; font-weight: bold;">Review Detail:</p>
<p></p>
<pre><span>{{comment}}</span></pre>
</div>
<div style="margin-bottom: 10px; width: 100%;">
<p style="text-decoration: underline; font-style: italic; font-size: 15px; font-weight: bold;">Reason for deleting:</p>
<p></p>
<pre><span>{{reason}}</span></pre>
</div>
</div>'
            ),
            'mp_seller_account_enable' => array(
                'subject' => 'Your Seller Account Has Been Enabled',
                'body' => '<div style="padding: 10px;">
<div style="margin-bottom: 10px; width: 100%; border: 1px solid #3fad1c;">
<p style="color: #000; text-align: center; font-size: 15px;"><strong>Your Seller Account Has Been Enabled</strong></p>
</div>
<p>Hey There,</p>
<p>Congrats, Your seller account has been enabled. Now you can start selling on our website.</p>
<p>Your Email: {{email}}</p>
<p>Your Name: {{full_name}}</p>
</div>'
            ),
            'mp_seller_account_disable' => array(
                'subject' => 'Your Seller Account Has Been Disabled',
                'body' => '<div style="padding: 10px;">
<div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
<p style="color: #000; text-align: center; font-size: 15px;"><strong>Your Seller Account Has Been Disabled</strong></p>
</div>
<p>Hey There,</p>
<p>Sorry to inform you, because of some inappropriate activities, your seller account has been disabled.</p>
<p>But do not worry you can request again for your account.</p>
</div>'
            ),
            'mp_seller_payout_transaction_request_notification_admin' => array(
                'subject' => 'New Payout Request Notification',
                'body' => '<p>Hi Admin,</p>
                            <div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #000;">
                            <p style="color: #000000; font-size: 15px; text-align: center;">
                            One of your seller has requested for new payout approval.</p>
                            </div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Requested Payout Details:</p>
                            <p><b>Requested Amount</b>:<br />{{requested_amount}}</p>
                            <p><b>Reason</b>:</p>
                            <pre><span>{{reason}}</span></pre>
                            </div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic;
                            font-size: 15px; font-weight: bold;">Seller Details on Store:</p>
                            <div style="margin-bottom: 10px; width: 100%;"><span><b>Store:</b>
                            {{shop_title}} </span><br /><span><b>Name:</b> {{seller_name}}</span> 
                            <br /><span><b>Email:</b> {{seller_email}}</span> <br />
                            <span><b>Contact:</b> {{seller_contact}}</span></div>
                            </div>
                            </div>'
            ),
            'mp_seller_payout_transaction_decline_admin' => array(
                'subject' => 'Payout Transaction Request has been declined by admin',
                'body' => '<p>Hi {{seller_name}},</p>
                            <div style="padding: 10px;">
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #ff0000;">
                            <p style="text-align: center; color: #000000; font-size: 15px;"><strong>Transaction Request by you on shop "{{shop_title}}" has been declined by admin</strong></p>
                            </div>
                            <br />
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic; font-size: 15px; font-weight: bold;">Transaction Details:</p>
                            <pre><span><br />Amount : {{amount}}<br />Requested On : {{requested_on}}<br /></span></pre>
                            </div>
                            <div style="margin-bottom: 10px; width: 100%;">
                            <p style="text-decoration: underline; font-style: italic; font-size: 15px; font-weight: bold;">Reason for declining:</p>
                            <p></p>
                            <pre><span>{{reason}}</span></pre>
                            </div>
                            </div>'
            ),
            'mp_seller_payout_transaction_approve_admin' => array(
                'subject' => 'Your Payout Transaction has been Approved',
                'body' => '<div style="padding: 10px;">
                            <p>Hi {{seller_name}},</p>
                            <p></p>
                            <div style="margin-bottom: 10px; width: 100%; border: 1px solid #3fad1c;">
                            <p style="font-size: 15px; text-align: center; font-weight: bold;">Your Payout Transaction has been approved for {{shop_title}} by the admin.</p>
                            </div>
                            <p style="text-decoration: underline; font-style: italic; font-size: 15px; font-weight: bold;">Transaction Details:</p>
                            <div style="margin-bottom: 10px; width: 100%;"><span> <b>Transaction ID: </b> {{transaction_id}}</span><br /><span><b>Amount:</b> {{amount}}</span> <br /><b>Comment:</b> {{comment}}</div>
                            </div>'
            ),
        );
        return $data;
    }

    public function getSellerMenus()
    {
        $this->l('Dashboard', 'kbconfiguration');
        $this->l('Seller Profile', 'kbconfiguration');
        $this->l('Products', 'kbconfiguration');
        $this->l('Product Reviews', 'kbconfiguration');
        $this->l('Orders', 'kbconfiguration');
        $this->l('Payout Request', 'kbconfiguration');
        $this->l('Transactions', 'kbconfiguration');
        $this->l('Earning', 'kbconfiguration');
        $this->l('My Reviews', 'kbconfiguration');
        $this->l('Category Request', 'kbconfiguration');
        $this->l('Shipping', 'kbconfiguration');
        
        $data = array(
            'dashboard' => array(
                'label' => 'Dashboard',
                'title' => 'Dashboard',
            ),
            'seller' => array(
                'label' => 'Seller Profile',
                'title' => 'Seller Profile',
            ),
            'kbproduct' => array(
                'label' => 'Products',
                'title' => 'Products',
            ),
            'order' => array(
                'label' => 'Orders',
                'title' => 'Orders',
            ),
            'productreview' => array(
                'label' => 'Product Reviews',
                'title' => 'Product Reviews',
            ),
            'sellerreview' => array(
                'label' => 'My Reviews',
                'title' => 'My Reviews',
            ),
            'earning' => array(
                'label' => 'Earning',
                'title' => 'Earning',
            ),
            'transaction' => array(
                'label' => 'Transactions',
                'title' => 'Transactions',
            ),
            'payoutrequest' => array(
                'label' => 'Payout Request',
                'title' => 'Payout Request'
            ),
            'category' => array(
                'label' => 'Category Request',
                'title' => 'Category Request'
            ),
            'shipping' => array(
                'label' => 'Shipping',
                'title' => 'Shipping'
            )
        );

        return $data;
    }

    protected function getDefaultSettings()
    {
        $settings = 0;
        return $settings;
    }

    public function installMarketPlaceTabs()
    {
        $parentTab = new Tab();
        $parentTab->name = array();
        
        $parent_tab = 'Knowband Marketplace';
            
        foreach (Language::getLanguages(true) as $lang) {
            if ($this->getModuleTranslationByLanguage('kbmarketplace', $parent_tab, 'kbconfiguration', $lang['iso_code']) != '') {
                $parentTab->name[$lang['id_lang']] = $this->getModuleTranslationByLanguage('kbmarketplace', $parent_tab, 'kbconfiguration', $lang['iso_code']);
            } else {
                $parentTab->name[$lang['id_lang']] = $parent_tab;
            }
        }

        $parentTab->class_name = self::PARENT_TAB_CLASS;
        $parentTab->module = $this->name;
        $parentTab->active = 1;
        $parentTab->icon = 'store';
        $parentTab->id_parent = Tab::getIdFromClassName(self::SELL_CLASS_NAME);
        $parentTab->add();

        $id_parent_tab = (int) Tab::getIdFromClassName(self::PARENT_TAB_CLASS);

        $admin_menus = $this->getAdminMenus();

        foreach ($admin_menus as $menu) {
            $tab = new Tab();
            foreach (Language::getLanguages(true) as $lang) {
                if ($this->getModuleTranslationByLanguage('kbmarketplace', $menu['name'], 'kbconfiguration', $lang['iso_code']) != '') {
                    $tab->name[$lang['id_lang']] = $this->getModuleTranslationByLanguage('kbmarketplace', $menu['name'], 'kbconfiguration', $lang['iso_code']);
                } else {
                    $tab->name[$lang['id_lang']] = $menu['name'];
                }
            }
            $tab->class_name = $menu['class_name'];
            $tab->module = $this->name;
            $tab->active = $menu['active'];
            $tab->id_parent = $id_parent_tab;
            $tab->add($this->id);
        }
        return true;
    }

    public function getModuleTranslationByLanguage($module, $string, $source, $language, $sprintf = null, $js = false)
    {
        $modules = array();
        $langadm = array();
        $translations_merged = array();
        $name = $module instanceof Module ? $module->name : $module;
        
        if (!isset($translations_merged[$name]) && isset(Context::getContext()->language)) {
            $files_by_priority = array(
                _PS_MODULE_DIR_ . $name . '/translations/' . $language . '.php'
            );
            foreach ($files_by_priority as $file) {
                if (file_exists($file)) {
                    include($file);
                    /* No need to define $_MODULE as it is defined in the above included file. */
                    $modules = $_MODULE;
                    $translations_merged[$name] = true;
                }
            }
        }

        $string = preg_replace("/\\\*'/", "\'", $string);
        $key = md5($string);
        if ($modules == null) {
            if ($sprintf !== null) {
                $string = Translate::checkAndReplaceArgs($string, $sprintf);
            }

            return str_replace('"', '&quot;', $string);
        }
        $current_key = Tools::strtolower('<{' . $name . '}' . _THEME_NAME_ . '>' . $source) . '_' . $key;
        $default_key = Tools::strtolower('<{' . $name . '}prestashop>' . $source) . '_' . $key;
        if ('controller' == Tools::substr($source, -10, 10)) {
            $file = Tools::substr($source, 0, -10);
            $current_key_file = Tools::strtolower('<{' . $name . '}' . _THEME_NAME_ . '>' . $file) . '_' . $key;
            $default_key_file = Tools::strtolower('<{' . $name . '}prestashop>' . $file) . '_' . $key;
        }

        if (isset($current_key_file) && !empty($modules[$current_key_file])) {
            $ret = Tools::stripslashes($modules[$current_key_file]);
        } elseif (isset($default_key_file) && !empty($modules[$default_key_file])) {
            $ret = Tools::stripslashes($modules[$default_key_file]);
        } elseif (!empty($modules[$current_key])) {
            $ret = Tools::stripslashes($modules[$current_key]);
        } elseif (!empty($modules[$default_key])) {
            $ret = Tools::stripslashes($modules[$default_key]);
            // if translation was not found in module, look for it in AdminController or Helpers
        } elseif (!empty($langadm)) {
            $ret = Tools::stripslashes(Translate::getGenericAdminTranslation($string, $key, $langadm));
        } else {
            $ret = Tools::stripslashes($string);
        }

        if ($sprintf !== null) {
            $ret = Translate::checkAndReplaceArgs($ret, $sprintf);
        }

        if ($js) {
            $ret = addslashes($ret);
        } else {
            $ret = htmlspecialchars($ret, ENT_COMPAT, 'UTF-8');
        }
        return $ret;
    }

    private function getAdminMenus()
    {
        $this->l('Knowband Marketplace', 'kbconfiguration');
        $this->l('Settings', 'kbconfiguration');
        $this->l('Seller Category Request List', 'kbconfiguration');
        $this->l('Seller Shippings', 'kbconfiguration');
        $this->l('Seller Shipping Method', 'kbconfiguration');
        $this->l('Admin Commissions', 'kbconfiguration');
        $this->l('Admin Orders', 'kbconfiguration');
        $this->l('Product Reviews', 'kbconfiguration');
        $this->l('Seller Reviews Approval List', 'kbconfiguration');
        $this->l('Seller Reviews', 'kbconfiguration');
        $this->l('Seller Orders', 'kbconfiguration');
        $this->l('Seller Acccount Configuration', 'kbconfiguration');
        $this->l('Category Wise Commission Rules', 'kbconfiguration');
        $this->l('Seller Products', 'kbconfiguration');
        $this->l('Product Approval List', 'kbconfiguration');
        $this->l('Seller Account Approval List', 'kbconfiguration');
        $this->l('Sellers List', 'kbconfiguration');
        $this->l('GDPR Settings', 'kbconfiguration');
        $this->l('Email Templates', 'kbconfiguration');
        $this->l('GDPR Requests', 'kbconfiguration');
        $this->l('Seller Shop Close Request', 'kbconfiguration');
        $this->l('Seller Transactions', 'kbconfiguration');
        $this->l('Transactions Payout Request', 'kbconfiguration');
        $this->l('Profile form Custom Fields', 'kbconfiguration');
        /*
         * @author - Rishabh Jain
         * DOC - 25/02/19
         * Functionality - To create the translated text for the new tabs
         * to be added for membership plan functionality
         */
        $this->l('MemberShip Plan General Setting', 'kbconfiguration');
        $this->l('MemberShip Plans', 'kbconfiguration');
        $this->l('MemberShip Plan Reminders', 'kbconfiguration');
        $this->l('MemberShip Plan Warning Reminders', 'kbconfiguration');
        $this->l('MemberShip Plan Expiry Reminders', 'kbconfiguration');
        $this->l('Seller Membership Plans', 'kbconfiguration');
        $this->l('Membership Plans', 'kbconfiguration');
        /*
         * Changes over
         */
        
        return array(
            array(
                'class_name' => 'AdminKbMarketPlaceSetting',
                'active' => 1,
                'name' => 'Settings'
            ),
            array(
                'class_name' => 'AdminKbMPGDPRSetting',
                'active' => 0,
                'name' => 'GDPR Settings'
            ),
            array(
                'class_name' => 'AdminKbMpCustomFields',
                'active' => 1,
                'name' => 'Profile form Custom Fields'
            ),
            array(
                'class_name' => 'AdminKbSellerList',
                'active' => 1,
                'name' => 'Sellers List'
            ),
            array(
                'class_name' => 'AdminKbSellerApprovalList',
                'active' => 1,
                'name' => 'Seller Account Approval List'
            ),
            array(
                'class_name' => 'AdminKbProductApprovalList',
                'active' => 1,
                'name' => 'Product Approval List'
            ),
            array(
                'class_name' => 'AdminKbProductList',
                'active' => 1,
                'name' => 'Seller Products'
            ),
            array(
                'class_name' => 'AdminKbCategoryWiseCommission',
                'active' => 1,
                'name' => 'Category Wise Commission Rules'
            ),
            array(
                'class_name' => 'AdminKbMarketPlaceSellerSetting',
                'active' => 0,
                'name' => 'Seller Acccount Configuration'
            ),
            array(
                'class_name' => 'AdminKbOrderList',
                'active' => 1,
                'name' => 'Seller Orders'
            ),
            array(
                'class_name' => 'AdminKbadminOrderList',
                'active' => 1,
                'name' => 'Admin Orders'
            ),
            array(
                'class_name' => 'AdminKbSProductReview',
                'active' => 1,
                'name' => 'Product Reviews'
            ),
            array(
                'class_name' => 'AdminKbSellerReviewApproval',
                'active' => 1,
                'name' => 'Seller Reviews Approval List'
            ),
            array(
                'class_name' => 'AdminKbSellerReviewList',
                'active' => 1,
                'name' => 'Seller Reviews'
            ),
            array(
                'class_name' => 'AdminKbSellerCRequest',
                'active' => 1,
                'name' => 'Seller Category Request List'
            ),
            array(
                'class_name' => 'AdminKbSellerShipping',
                'active' => 1,
                'name' => 'Seller Shippings'
            ),
            /*Start - MK made changes on 08-03-2018 for Marketplace changes*/
            array(
                'class_name' => 'AdminKbSellerShippingMethod',
                'active' => 1,
                'name' => 'Seller Shipping Method'
            ),
            /*End -MK made changes on 08-03-2018 for Marketplace changes*/
            array(
                'class_name' => 'AdminKbCommission',
                'active' => 1,
                'name' => 'Admin Commissions'
            ),
            array(
                'class_name' => 'AdminKbSellerTransPayoutRequest',
                'active' => 1,
                'name' => 'Transactions Payout Request'
            ),
            array(
                'class_name' => 'AdminKbSellerTrans',
                'active' => 1,
                'name' => 'Seller Transactions'
            ),
            array(
                'class_name' => 'AdminKbSellerCloseShopRequest',
                'active' => 1,
                'name' => 'Seller Shop Close Request'
            ),
            array(
                'class_name' => 'AdminKbGDPRRequest',
                'active' => 1,
                'name' => 'GDPR Requests'
            ),
            /*
            * @author - Rishabh Jain
            * DOC - 25/02/19
            * Functionality - To create the new tabs for membership plan functionality
             * i.e defined the controller name and status of the same
            */
            array(
                'class_name' => 'AdminKbMembershipPlanSetting',
                'active' => 1,
                'name' => 'MemberShip Plan General Setting'
            ),
            array(
                'class_name' => 'AdminKbMpReminderProfiles',
                'active' => 0,
                'name' => 'MemberShip Plan Reminders'
            ),
            array(
                'class_name' => 'AdminKbMpExpiryProfiles',
                'active' => 0,
                'name' => 'MemberShip Plan Reminders'
            ),
            array(
                'class_name' => 'AdminKbMembershipPlans',
                'active' => 1,
                'name' => 'MemberShip Plans'
            ),
            array(
                'class_name' => 'AdminKbMembershipSellerPlans',
                'active' => 1,
                'name' => 'Seller Membership Plans'
            ),
            array(
                'class_name' => 'AdminKbMembershipSellerPlanDetail',
                'active' => 0,
                'name' => 'Membership Plans'
            ),
            /*
             * changes over
             */
            array(
                'class_name' => 'AdminKbEmail',
                'active' => 1,
                'name' => 'Email Templates'
            )
            // changes over
        );
    }

    public function unInstallMarketPlaceTabs()
    {
        $parentTab = new Tab(Tab::getIdFromClassName(self::PARENT_TAB_CLASS));
        $parentTab->delete();

        $admin_menus = $this->getAdminMenus();

        foreach ($admin_menus as $menu) {
            $sql = 'SELECT id_tab FROM `' . _DB_PREFIX_ . 'tab` Where class_name = "' . pSQL($menu['class_name']) . '" 
				AND module = "' . pSQL($this->name) . '"';
            $id_tab = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
            $tab = new Tab($id_tab);
            $tab->delete();
        }

        return true;
    }

    public function hookModuleRoutes($params)
    {
        unset($params);
        if (Configuration::get('KB_MARKETPLACE') !== false && Configuration::get('KB_MARKETPLACE') == 1) {
            return array(
                'kb_seller_rule' => array(
                    'controller' => 'sellerfront',
                    'rule' => 'seller/{id}-{rewrite}',
                    'keywords' => array(
                        'id' => array('regexp' => '[0-9]+', 'param' => 'id_seller'),
                        'rewrite' => array('regexp' => '[_a-zA-Z0-9\pL\pS-]*'),
                        'meta_keywords' => array('regexp' => '[_a-zA-Z0-9-\pL]*'),
                        'meta_title' => array('regexp' => '[_a-zA-Z0-9-\pL]*'),
                    ),
                    'params' => array(
                        'render_type' => 'sellerview',
                        'fc' => 'module',
                        'module' => 'kbmarketplace'
                    ),
                )
            );
        }

        return array();
    }

    public function hookDisplayHeader()
    {
        $output = '';
        $custom_ssl_var = 0;

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $custom_ssl_var = 1;
        }
        if ((bool) Configuration::get('PS_SSL_ENABLED') && $custom_ssl_var == 1) {
            $this->context->controller->addCSS(_PS_BASE_URL_SSL_ . __PS_BASE_URI__ . 'js/jquery/plugins/fancybox/jquery.fancybox.css');
            $this->context->controller->addJS(_PS_BASE_URL_SSL_ . __PS_BASE_URI__ . 'js/jquery/plugins/fancybox/jquery.fancybox.js');
        } else {
            $this->context->controller->addCSS(_PS_BASE_URL_ . __PS_BASE_URI__ . 'js/jquery/plugins/fancybox/jquery.fancybox.css');
            $this->context->controller->addJS(_PS_BASE_URL_ . __PS_BASE_URI__ . 'js/jquery/plugins/fancybox/jquery.fancybox.js');
        }
        $this->context->controller->addCSS($this->_path . self::CSS_FRONT_PATH . 'kb-hooks.css');
        $this->context->controller->addJS($this->_path . 'views/js/front/hook.js');
        // changes by rishabh jain for custom seller registartion fields
        if (($this->context->controller->php_self == 'authentication') && Tools::getIsset('seller_registration_form') && (int) Tools::getValue('seller_registration_form') == 1) {
            $this->context->controller->addJquery();
            $this->context->controller->addCSS($this->_path . 'views/css/front/kb_front.css');
            $this->context->controller->addJQueryUi('ui.datepicker');
            $this->context->controller->addJS($this->_path . 'views/js/front/seller_registration_form.js');
            $this->context->controller->addJS($this->_path . 'views/js/front/velovalidation.js');
        }
        // changes over
        // added js for seller shortlisting
        $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (isset($config['enable_seller_shortlisting']) && $config['enable_seller_shortlisting'] == 1) {
            $this->context->controller->addJS($this->_path . 'views/js/front/seller_shortlist.js');
        }
        // changes over
        
        
        $page_name = $this->context->smarty->tpl_vars['page']->value['page_name'];
        if (strripos($page_name, 'cart') !== false || strripos($page_name, 'checkout') !== false) {
            $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            $this->context->smarty->assign(
                'cart_url',
                $this->context->link->getModuleLink('kbmarketplace', 'sellerfront')
            );
            $this->context->smarty->assign('allow_free_shipping', $config['kbmp_enable_free_shipping']);
        }
        /*
        * @author Rishabh Jain
        * DOC - 16th Mar 2020
        * To disable the quantity input for membership type products
        * on the cart page
        */
        $php_self = $this->context->controller->php_self;
        if ($php_self == 'cart') {
            $kb_membership_plan_products_list = array();
            $data = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
            if ($data['kbmp_enable_membership_plan'] == 1) {
                $membership_plans = KbMpMemberShipPlan::getMemberShipPlans();
                if (is_array($membership_plans) && !empty($membership_plans)) {
                    foreach ($membership_plans as $plan_key => $plan_data) {
                        $kb_membership_plan_products_list[] = $plan_data['id_product'];
                    }
                }
                $this->context->smarty->assign('kb_membership_plan_products_list', Tools::jsonEncode($kb_membership_plan_products_list));
                $this->context->controller->addJS($this->_path . 'views/js/front/membership_plan_cart.js');
                $output .= $this->context->smarty->fetch(_PS_MODULE_DIR_ . $this->name . '/views/templates/hook/membership_plan_product_list.tpl');
            }
        }
        /*
        * Chnages over
        */
        if (stripos($page_name, 'checkout') !== false) {
            if (Configuration::get('KB_MP_SELLER_ORDER_HANDLING') == 1 && Configuration::get('KB_MARKETPLACE') == 1) {
                $this->context->cookie->kbsellerhandleorder = 1;
            }
        }
        if (stripos($page_name, 'kbmarketplace') !== false) {
            $page_params = explode('-', $page_name);
            $id_seller = Tools::getValue('id_seller', 0);
            if ((isset($page_params[2]) && $page_params[2] == 'sellerfront')) {
                if ($id_seller > 0) {
                    $seller = new KbSeller($id_seller, $this->context->language->id);
                    if (Validate::isLoadedObject($seller) && $seller->isApprovedSeller() && $seller->active == 1) {
                        $this->context->smarty->assign(
                            'meta_keywords',
                            Tools::safeOutput($seller->meta_keyword, false)
                        );
                        $this->context->smarty->assign(
                            'meta_description',
                            Tools::safeOutput($seller->meta_description, false)
                        );
                    }
                } else {
                    $global_settings = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                    if (isset($global_settings['kbmp_seller_listing_meta_keywords']) && !empty($global_settings['kbmp_seller_listing_meta_keywords'])) {
                        $this->context->smarty->assign(
                            'meta_keywords',
                            Tools::safeOutput($global_settings['kbmp_seller_listing_meta_keywords'], false)
                        );
                    }

                    if (isset($global_settings['kbmp_seller_listing_meta_description']) && !empty($global_settings['kbmp_seller_listing_meta_description'])) {
                        $this->context->smarty->assign(
                            'meta_description',
                            Tools::safeOutput($global_settings['kbmp_seller_listing_meta_description'], false)
                        );
                    }
                }
            }
        }
        return $output;
    }

    protected function getConfigurationFieldValues()
    {
        if (Configuration::get('KB_MARKETPLACE') === false) {
            $settings = $this->getDefaultSettings();
        } else {
            $settings = Configuration::get('KB_MARKETPLACE');
        }
        $custom_css = '';
        $custom_js = '';
        if (Configuration::get('KB_MARKETPLACE_CSS') && Configuration::get('KB_MARKETPLACE_CSS') != '') {
            $custom_css = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CSS'));
            $custom_css = urldecode($custom_css);
        }
        if (Configuration::get('KB_MARKETPLACE_JS') && Configuration::get('KB_MARKETPLACE_JS') != '') {
            $custom_js = Tools::unserialize(Configuration::get('KB_MARKETPLACE_JS'));
            $custom_js = urldecode($custom_js);
        }
        return array(
            'KB_MARKETPLACE' => $settings,
            'KB_MARKETPLACE_CSS' => $custom_css,
            'KB_MARKETPLACE_JS' => $custom_js,
        );
    }
    
    protected function addBackOfficeMedia()
    {
        /* CSS files */
//        $this->context->controller->addJs($this->_path . 'views/js/admin/kb-marketplace-customer.js');
        /* JS files */
    }
    protected function renderSellerSettingForm()
    {
        $helper = new HelperForm();
        $id_customer = (int) Tools::getValue('id_customer');
        $msg = '';
        $msg_txt1 = '';
        $seller = new KbSeller(KbSeller::getSellerByCustomerId($id_customer));
        $s_settings = new KbSellerSetting($seller->id);
        $s_settings->setShop($seller->id_shop);
        if ((Tools::isSubmit('submitSellerSetting') || Tools::isSubmit('submitSellerRegistration')) && (int) Tools::getValue('id_customer') > 0) {
            if (Tools::isSubmit('register_as_seller') && Tools::getValue('register_as_seller') == 1) {
                $seller->product_limit_wout_approval = 0;
                $seller->approval_request_limit = (int) KbGlobal::getGlobalSettingByKey('kbmp_approval_request_limit');
                $seller->notification_type = (string) KbSeller::NOTIFICATION_PRIMARY;
                $seller->registerNewCustomer(
                    $id_customer,
                    Tools::getValue('approve'),
                    Tools::getValue('activate_seller')
                );

                $new_customer = new Customer($id_customer);
                $data = array(
                    'email' => $new_customer->email,
                    'name' => $new_customer->firstname . ' ' . $new_customer->lastname
                );
                $email = new KbEmail(
                    KbEmail::getTemplateIdByName('mp_welcome_seller'),
                    $new_customer->id_lang
                );
                $email->sendWelcomeEmailToCustomer($data);

                $email = new KbEmail(
                    KbEmail::getTemplateIdByName('mp_seller_registration_notification_admin'),
                    Configuration::get('PS_LANG_DEFAULT')
                );
                $email->sendNotificationOnNewRegistration($data);

                KbSellerSetting::saveSettingForNewSeller($seller);
                KbSellerSetting::assignCategoryGlobalToSeller($seller);

                $seller_shipping = new KbSellerShipping();
                $seller_shipping->createAndAssignFreeShipping($seller);

                Hook::exec(
                    'actionKbMarketPlaceCustomerRegistration',
                    array('seller' => $seller)
                );

                $this->confirmations[] = $this->l('Customer successfully registered as seller.', 'kbconfiguration');
            } elseif (Tools::isSubmit('kb_mp_seller_config')) {
                $seller_config = Tools::getValue('kb_mp_seller_config');
//                $added_product_count = (int)$seller->product_limit_wout_approval;
//                $product_updated_limit = (int)$seller_config['kbmp_product_limit']['main'];
                $error = 0;
                if (!Validate::isFloat($seller_config['kbmp_default_commission']['main'])) {
                    $msg_txt1 .= $this->l('Only numeric value is allowed in Default Commission.', 'kbconfiguration');
                    $this->errors[] = $msg_txt1;
                    $error = 1;
                } elseif ($seller_config['kbmp_default_commission']['main'] < 0 || $seller_config['kbmp_default_commission']['main'] > 100) {
                    $msg_txt1 .= $this->l('Default Comission can not be less than 0 or greater than 100.', 'kbconfiguration');
                    $this->errors[] = $msg_txt1;
                    $error = 1;
                }
                if ($error == 1) {
                    $msg = $this->displayError($msg_txt1);
                } else {
                    $s_settings->setSettings($seller_config);
                    $s_settings->saveSettings();
                    $new_cates = array();
                    if (Tools::isSubmit('categoryBox')) {
                        $new_cates = Tools::getValue('categoryBox', array());
                    }
                    $seller_product = KbSellerProduct::getSellerProducts($seller->id);
                    if (!empty($seller_product)) {
                        foreach ($seller_product as $sp) {
                            $pro = new Product($sp['id_product']);
                            if (!in_array($pro->id_category_default, $new_cates)) {
                                $pro->active = 0;
                                $pro->update();
                            } else {
                                $pro->active = 1;
                                $pro->update();
                            }
                        }
                    }
                    KbSellerCategory::trackAndUpdateCategories($seller->id, $new_cates);

                    KbSellerSetting::assignCategoryToSeller($seller, $new_cates);

                    $msg = $this->displayConfirmation($this->l('Seller settings successfully saved.', 'kbconfiguration'));

                    Hook::exec(
                        'actionKbMarketPlaceSellerSettingSave',
                        array('setting' => $seller_config,
                               'seller' => $seller)
                    );
                }
            }
        }
        $fields_options = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Seller Account Configuration', 'kbconfiguration'),
                    'icon' => 'icon-wrench'
                ),
                'submit' => array(
                    'title' => $this->l('Save', 'kbconfiguration'),
                    'class' => 'btn btn-default pull-right',
                    'name' => 'submitSellerSetting',
                )
            )
        );
        $field_values = array();

        if (!$seller->isSeller()) {
            $fields_options['form']['input'] = array(
                array(
                    'type' => 'switch',
                    'label' => $this->l('Register as seller', 'kbconfiguration'),
                    'name' => 'register_as_seller',
                    'hint' => $this->l('To register this customer as seller.', 'kbconfiguration'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled', 'kbconfiguration')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled', 'kbconfiguration')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Approve', 'kbconfiguration'),
                    'name' => 'approve',
                    'hint' => $this->l('Approve customer as seller after registering or later.', 'kbconfiguration'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled', 'kbconfiguration')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled', 'kbconfiguration')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Active', 'kbconfiguration'),
                    'name' => 'activate_seller',
                    'hint' => $this->l('Activate seller', 'kbconfiguration'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled', 'kbconfiguration')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled', 'kbconfiguration')
                        )
                    ),
                )
            );

            $field_values = array(
                'register_as_seller' => 0,
                'approve' => KbGlobal::APPROVAL_WAITING,
                'activate_seller' => 0
            );
            $helper->submit_action = 'submitSellerRegistration';
        } else {
            $settings = $s_settings->getSettings();
            if (empty($settings) || count($settings) == 0) {
                $settings = KbSellerSetting::getSellerDefaultSetting();
            }

            $fields = array(
                array(
                    'type' => 'text',
                    'required' => true,
                    'label' => $this->l('Default Commission', 'kbconfiguration'),
                    'name' => 'kbmp_default_commission',
                    'hint' => $this->l('This commission will be deducted per product ordered for this seller.', 'kbconfiguration'),
                    'values' => 15,
                    'class' => 'fixed-width-xs kbmp_default_commission_seller',
                    'suffix' => '%',
                ),
//                array(
//                    'type' => 'text',
//                    'required' => true,
//                    'label' => $this->l('New Product Limit'),
//                    'name' => 'kbmp_product_limit',
//                    'hint' => $this->l(
//                        'After this limit, seller cannot add new products until he/she will not be approved by you.'
//                    ),
//                    'class' => 'fixed-width-xs',
//                    'values' => 10
//                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('New Product Approval Required', 'kbconfiguration'),
                    'name' => 'kbmp_new_product_approval_required',
                    'hint' => $this->l('New product needs approval from your side before display on front.', 'kbconfiguration'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled', 'kbconfiguration')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled', 'kbconfiguration')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Enable Seller Review', 'kbconfiguration'),
                    'name' => 'kbmp_enable_seller_review',
                    'hint' => $this->l('Enable customers to give their reviews on seller.', 'kbconfiguration'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled', 'kbconfiguration')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled', 'kbconfiguration')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Seller Review Approval Required', 'kbconfiguration'),
                    'name' => 'kbmp_seller_review_approval_required',
                    'hint' => $this->l('With this setting, review first needs approval by you before showing to customers.', 'kbconfiguration'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled', 'kbconfiguration')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled', 'kbconfiguration')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Send Email on Order Place', 'kbconfiguration'),
                    'name' => 'kbmp_email_on_new_order',
                    'hint' => $this->l('With this setting, system will send email to seller for new order', 'kbconfiguration'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled', 'kbconfiguration')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled', 'kbconfiguration')
                        )
                    ),
                )
            );

            foreach ($fields as $input) {
                $tmp = $input;
                $use_global = ($settings[$input['name']]['global'] == 1) ? 'checked="checked"' : '';
                if ($input['name'] == 'kbmp_product_limit') {
                    $html = '';
                } else {
                    $html = '<input type="checkbox" onclick="changeSwitchColor(this)" '
                            . 'class="checkbox kb_checkbox_seller_settings" '
                            . 'name="kb_mp_seller_config[' . $input['name'] . '][global]" '
                            . 'value="1" ' . $use_global . ' />'
                            . '<span class="option-label">' . $this->l('Use Global', 'kbconfiguration') . '</span>';
                }

                $tmp['desc'] = $html;
                if ($input['type'] == 'select' && isset($input['multiple']) && $input['multiple']) {
                    $tmp['name'] = 'kb_mp_seller_config[' . $input['name'] . '][main][]';
                } else {
                    $tmp['name'] = 'kb_mp_seller_config[' . $input['name'] . '][main]';
                }
                if (isset($settings[$input['name']]['main'])) {
                    $field_values[$tmp['name']] = $settings[$input['name']]['main'];
                } else {
                    $field_values[$tmp['name']] = $settings[$input['name']]['global'];
                }
                $fields_options['form']['input'][] = $tmp;
            }

            $helper->submit_action = 'submitSellerSetting';

            $fields_options['form']['bottom'] = '';

            $assigned_cates = KbSellerCategory::getCategoriesBySeller($seller->id);

            $root = Category::getRootCategory();
            $tree = new HelperTreeCategories('seller-categories-tree');
            $tree->setRootCategory($root->id)
                    ->setUseCheckBox(true)
                    ->setUseSearch(false)
                    ->setSelectedCategories($assigned_cates);

            $fields_options['form']['input'][] = array(
                'type' => 'categories_select',
                'label' => $this->l('Categories Allowed', 'kbconfiguration'),
                'name' => 'kbmp_allowed_categories',
                'category_tree' => $tree->render(),
                'hint' => array(
                    $this->l('Categories to be allowed to seller in which he/she can map his/her products.', 'kbconfiguration')
                ),
                'desc' => $this->l('If you uncheck all categories, then previously save category will be saved by default.In order to enable a category you will have to check all the parent categories otherwise the category will not be activated. Example- To enable `T-shirts` category, you will have to check all the parent categories i.e. Home, Women, Tops and ofcourse T-shirts.', 'kbconfiguration')
            );
        }

        $helper->show_toolbar = false;

        Hook::exec(
            'displayKbMarketPlaceSellerSettingForm',
            array('fields_options' => $fields_options,
                    'fields_value' => $field_values,
                    'seller' => $seller)
        );

        $helper->tpl_vars = array(
            'fields_value' => $field_values
        );

        $lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->id = $id_customer;
        $helper->identifier = 'id_customer';

        $this->context->smarty->assign(
            array(
                'msg' => $msg,
                'action' => $this->context->link->getAdminLink('AdminCustomers')
                . '&updatecustomer&id_customer=' . $id_customer,
                'form_template' => $helper->generateForm(array($fields_options))
            )
        );
        $this->context->controller->addJS($this->_path . 'views/js/admin/kb-marketplace.js');
        return $this->display(
            _PS_MODULE_DIR_ . '/kbmarketplace.php',
            'views/templates/admin/configuration.tpl'
        );
    }


    public function hookActionCustomerFormBuilderModifier(array $params)
    {
        $formBuilder = $params['form_builder'];
        $id_customer = $params['id'];
        $msg = '';
        $msg_txt1 = '';
        $seller = new KbSeller(KbSeller::getSellerByCustomerId($id_customer));
        $s_settings = new KbSellerSetting($seller->id);
        $s_settings->setShop($seller->id_shop);
        if (!$seller->isSeller()) {
            $formBuilder->add('register_as_seller', SwitchType::class, [
                'label' => $this->l('Register as seller', 'kbconfiguration'),
                'required' => false,
            ]);
            $formBuilder->add('approve', SwitchType::class, [
                'label' => $this->l('Approve', 'kbconfiguration'),
                'help' => $this->l('Approve', 'kbconfiguration'),
                'required' => false,
            ]);
            $formBuilder->add('activate_seller', SwitchType::class, [
                'label' => $this->l('Active', 'kbconfiguration'),
                'required' => false,
            ]);
            $params['data']['register_as_seller'] = false;
            $params['data']['approve'] = KbGlobal::APPROVAL_WAITING;
            $params['data']['activate_seller'] = false;
            $formBuilder->setData($params['data']);
        }
    }
    
    public function hookActionAfterUpdateCustomerFormHandler(array $params)
    {
        $id_customer = $params['id'];
        $customerFormData = $params['form_data'];
        $this->saveSellerData($id_customer, $customerFormData);
    }
    public function hookActionOrderSlipAdd($params)
    {
        if (Tools::isSubmit('cancelProduct') || Tools::isSubmit('partialRefundProduct')) {
            $id_order = Tools::getValue('id_order', 0);
            $order_object = new Order($id_order);
            if ($id_order != 0) {
                $id_seller = 0;
                $seller_order_detail = KbSellerOrderDetail::getDetailByOrderId($id_order);
                if (is_array($seller_order_detail) && count($seller_order_detail) > 0) {
                    $total_admin_earning = 0;
                    $total_seller_earning = 0;
                    $net_quantity = 0;
                    $net_earning = 0;
                    foreach ($seller_order_detail as $order_detail_key => $seller_order_detail_data) {
                        $id_seller = $seller_order_detail_data['id_seller'];
                        $order_slip_detail = array();
                        $order_slip_detail = OrderSlip::getProductSlipDetail($seller_order_detail_data['id_order_detail']);
                        $order_detail_obj = new OrderDetail($seller_order_detail_data['id_order_detail']);
                        $total_refund_tax_incl = 0;
                        $total_refund_tax_excl = 0;
                        if (is_array($order_slip_detail) && !empty($order_slip_detail)) {
                            foreach ($order_slip_detail as $order_slip_detail_key => $order_slip_detail_data) {
                                $total_refund_tax_incl += $order_slip_detail_data['amount_tax_incl'];
                                $total_refund_tax_excl += $order_slip_detail_data['amount_tax_excl'];
                            }
                        }
                        $sl_od_obj = new KbSellerOrderDetail($seller_order_detail_data['id_seller_order_detail']);
                        $total_earning = $order_detail_obj->total_price_tax_incl - $total_refund_tax_incl;
                        $comson_from_percent = (float) ($sl_od_obj->commission_percent / 100);
                        $admin_earning = (float) ($comson_from_percent * $total_earning);
                        $seller_earning = (float) ($total_earning - $admin_earning);
                        if ($seller_earning < 0) {
                            $seller_earning = 0;
                        }
                        if ($admin_earning < 0) {
                            $admin_earning = 0;
                        }
                        if ($total_earning < 0) {
                            $total_earning = 0;
                        }
                        $sl_od_obj->seller_earning = $seller_earning;
                        $sl_od_obj->admin_earning = $admin_earning;
                        $sl_od_obj->total_earning = $total_earning;
                        $sl_od_obj->qty = $order_detail_obj->product_quantity - ($order_detail_obj->product_quantity_refunded + $order_detail_obj->product_quantity_return);

                        $total_admin_earning += $admin_earning;
                        $total_seller_earning += $seller_earning;
                        $net_earning += $total_earning;
                        $net_quantity += $sl_od_obj->qty;

                        $sl_od_obj->save();
                    }
                    $seller_earning = KbSellerEarning::getEarningBySellerAndOrder($id_seller, (int) $id_order);
                    // change by rishabh jain added is_array parameter as in Ps 1.7.4 it is throwing error
                    if (is_array($seller_earning) && count($seller_earning) > 0) {
                        $earning_obj = new KbSellerEarning($seller_earning['id_seller_earning']);
                        $earning_obj->product_count = $net_quantity;
                        $shipping_amount_refunded = 0;
                        $order_slip_data = array();
                        $order_slip_data = OrderSlip::getOrdersSlip($order_object->id_customer, $id_order);
                        if (is_array($order_slip_data) && count($order_slip_data) > 0) {
                            if (isset($order_slip_data[0]['total_shipping_tax_incl'])) {
                                $shipping_amount_refunded = $order_slip_data[0]['total_shipping_tax_incl'];
                            }
                        }
                        $net_earning += ($order_object->total_shipping_tax_incl - $shipping_amount_refunded);
                        if ((int) $earning_obj->can_handle_order == 1) {
                            $net_earning -= $order_object->total_discounts_tax_incl;
                            $total_admin_earning = (float) $total_admin_earning - $order_object->total_discounts_tax_incl;
                            $net_earning += $order_object->total_wrapping_tax_incl;
                        } else {
                            $total_admin_earning += ($order_object->total_shipping_tax_incl - $shipping_amount_refunded);
                        }
                        if ($net_earning < 0) {
                            $net_earning = 0;
                        }
                        if ($total_admin_earning < 0) {
                            $total_admin_earning = 0;
                        }
                        $net_seller_earning = $net_earning - $total_admin_earning;
                        if ($net_seller_earning < 0) {
                            $net_seller_earning = 0;
                        }
                        $earning_obj->total_earning = (float) ($net_earning);
                        $earning_obj->admin_earning = (float) ($total_admin_earning);
                        $earning_obj->seller_earning = (float) ($net_seller_earning);
                        $earning_obj->save();
                    }
                }
            }
        }
    }
    public function hookActionProductCancel($param)
    {
//        return ;
        if (Tools::isSubmit('cancelProduct')) {
            $id_order = Tools::getValue('id_order', 0);
            $order_object = new Order($id_order);
            if ($id_order != 0) {
                $id_seller = 0;
                $seller_order_detail = KbSellerOrderDetail::getDetailByOrderId($id_order);
                if (is_array($seller_order_detail) && count($seller_order_detail) > 0) {
                    $total_admin_earning = 0;
                    $total_seller_earning = 0;
                    $net_quantity = 0;
                    $net_earning = 0;
                    foreach ($seller_order_detail as $order_detail_key => $seller_order_detail_data) {
                        $id_seller = $seller_order_detail_data['id_seller'];
                        $order_slip_detail = array();
                        $order_slip_detail = OrderSlip::getProductSlipDetail($seller_order_detail_data['id_order_detail']);
                        $order_detail_obj = new OrderDetail($seller_order_detail_data['id_order_detail']);
                        $total_refund_tax_incl = 0;
                        $total_refund_tax_excl = 0;
                        if (is_array($order_slip_detail) && !empty($order_slip_detail)) {
                            foreach ($order_slip_detail as $order_slip_detail_key => $order_slip_detail_data) {
                                $total_refund_tax_incl += $order_slip_detail_data['amount_tax_incl'];
                                $total_refund_tax_excl += $order_slip_detail_data['amount_tax_excl'];
                            }
                        }
                        $sl_od_obj = new KbSellerOrderDetail($seller_order_detail_data['id_seller_order_detail']);
                        $total_earning = $order_detail_obj->total_price_tax_incl - $total_refund_tax_incl;
                        $comson_from_percent = (float) ($sl_od_obj->commission_percent / 100);
                        $admin_earning = (float) ($comson_from_percent * $total_earning);
                        $seller_earning = (float) ($total_earning - $admin_earning);
                        if ($seller_earning < 0) {
                            $seller_earning = 0;
                        }
                        if ($admin_earning < 0) {
                            $admin_earning = 0;
                        }
                        if ($total_earning < 0) {
                            $total_earning = 0;
                        }
                        $sl_od_obj->seller_earning = $seller_earning;
                        $sl_od_obj->admin_earning = $admin_earning;
                        $sl_od_obj->total_earning = $total_earning;
                        $sl_od_obj->qty = $order_detail_obj->product_quantity - ($order_detail_obj->product_quantity_refunded + $order_detail_obj->product_quantity_return);

                        $total_admin_earning += $admin_earning;
                        $total_seller_earning += $seller_earning;
                        $net_earning += $total_earning;
                        $net_quantity += $sl_od_obj->qty;

                        $sl_od_obj->save();
                    }
                    $seller_earning = KbSellerEarning::getEarningBySellerAndOrder($id_seller, (int) $id_order);
                    // change by rishabh jain added is_array parameter as in Ps 1.7.4 it is throwing error
                    if (is_array($seller_earning) && count($seller_earning) > 0) {
                        $earning_obj = new KbSellerEarning($seller_earning['id_seller_earning']);
                        $earning_obj->product_count = $net_quantity;
                        $shipping_amount_refunded = 0;
                        $order_slip_data = array();
                        $order_slip_data = OrderSlip::getOrdersSlip($order_object->id_customer, $id_order);
                        if (is_array($order_slip_data) && count($order_slip_data) > 0) {
                            if (isset($order_slip_data[0]['total_shipping_tax_incl'])) {
                                $shipping_amount_refunded = $order_slip_data[0]['total_shipping_tax_incl'];
                            }
                        }
                        $net_earning += ($order_object->total_shipping_tax_incl - $shipping_amount_refunded);
                        if ((int) $earning_obj->can_handle_order == 1) {
                            $net_earning -= $order_object->total_discounts_tax_incl;
                            $total_admin_earning = (float) $total_admin_earning - $order_object->total_discounts_tax_incl;
                            $net_earning += $order_object->total_wrapping_tax_incl;
                        } else {
                            $total_admin_earning += ($order_object->total_shipping_tax_incl - $shipping_amount_refunded);
                        }
                        if ($net_earning < 0) {
                            $net_earning = 0;
                        }
                        if ($total_admin_earning < 0) {
                            $total_admin_earning = 0;
                        }
                        $net_seller_earning = $net_earning - $total_admin_earning;
                        if ($net_seller_earning < 0) {
                            $net_seller_earning = 0;
                        }
                        $earning_obj->total_earning = (float) ($net_earning);
                        $earning_obj->admin_earning = (float) ($total_admin_earning);
                        $earning_obj->seller_earning = (float) ($net_seller_earning);
                        $earning_obj->save();
                    }
                }
            }
        }
    }
    public function hookActionAfterCreateCustomerFormHandler(array $params)
    {
        $id_customer = $params['id'];
        $customerFormData = $params['form_data'];
        $this->saveSellerData($id_customer, $customerFormData);
    }
    
    public function saveSellerData($id_customer, $customerFormData = array())
    {
        $seller = new KbSeller(KbSeller::getSellerByCustomerId($id_customer));
        if (isset($customerFormData['register_as_seller']) && (int) $customerFormData['register_as_seller'] == 1) {
            $seller->product_limit_wout_approval = 0;
            $seller->approval_request_limit = (int) KbGlobal::getGlobalSettingByKey('kbmp_approval_request_limit');
            $seller->notification_type = (string) KbSeller::NOTIFICATION_PRIMARY;
            $seller->registerNewCustomer(
                $id_customer,
                (int) $customerFormData['approve'],
                (int) $customerFormData['activate_seller']
            );
            $new_customer = new Customer($id_customer);
            $data = array(
                'email' => $new_customer->email,
                'name' => $new_customer->firstname . ' ' . $new_customer->lastname
            );
            $email = new KbEmail(
                KbEmail::getTemplateIdByName('mp_welcome_seller'),
                $new_customer->id_lang
            );
            $email->sendWelcomeEmailToCustomer($data);

            $email = new KbEmail(
                KbEmail::getTemplateIdByName('mp_seller_registration_notification_admin'),
                Configuration::get('PS_LANG_DEFAULT')
            );
            $email->sendNotificationOnNewRegistration($data);

            KbSellerSetting::saveSettingForNewSeller($seller);
            KbSellerSetting::assignCategoryGlobalToSeller($seller);

            $seller_shipping = new KbSellerShipping();
            $seller_shipping->createAndAssignFreeShipping($seller);

            Hook::exec(
                'actionKbMarketPlaceCustomerRegistration',
                array('seller' => $seller)
            );
//            $this->confirmations[] = $this->l('Customer successfully registered as seller.', 'kbconfiguration');
        }
        
//        Hook::exec(
//            'actionKbMarketPlaceSellerSettingSave',
//            array('setting' => $seller_config,
//                   'seller' => $seller)
//        );
    }
    protected function showTopMenuLink()
    {
        $show = false;
        if ($this->context->customer->logged) {
            $show = (bool) KbSeller::getSellerByCustomerId((int) $this->context->customer->id);
        }
        return $show;
    }
    
    /*
     * changes by rishabh jain for deactivating the existing plans
     */
    
    public function hookActionKbSellerPlanActivateBefore($param)
    {
        $id_membership_plan_order = $param['id_membership_plan_order'];
        $id_seller = $param['id_seller'];
        
        if (KbSeller::isTrackedSeller($id_seller)) {
            KbSeller::removeTrackedSeller($id_seller);
            KbMemberShipPlanOrder::addSellerProductInTrackingTable($id_seller);
        }

        $status = '2';
        
        $total = KbMemberShipPlanOrder::getMembershipPlan($id_seller, true, $status, null);
        
        if ($total == 0 || empty($total)) {
            return;
        }
        $expired_plans = array();
        
        $expired_plans = KbMemberShipPlanOrder::getMembershipPlan($id_seller, false, $status, null);
        if (is_array($expired_plans) && count($expired_plans) > 0) {
            foreach ($expired_plans as $plan_key => $plan_data) {
                $plan_obj = new KbMemberShipPlanOrder($plan_data['id_kbmp_membership_plan_order']);
                $plan_obj->status = 3;
                $plan_obj->expire_date = date('Y-m-d');
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
                        $email_template_subject = $this->l('Your Active Membership Plan is expired');
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
        KbMemberShipPlanOrder::addSellerProductInTrackingTable($id_seller);
        return;
    }
    
    public function hookActionKbSellerPlanActivateAfter($param)
    {
        $id_membership_plan_order = $param['id_membership_plan_order'];
        $id_seller = $param['id_seller'];

        $plan_obj = new KbMemberShipPlanOrder($id_membership_plan_order);
        
        $is_available_membership_plan = 0;
        $membership_settings = array();
        if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
            $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
        }
        $is_available_membership_plan = 0;
        if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1 && isset($membership_settings['kbmp_inform_seller_membership_plan_active']) && $membership_settings['kbmp_inform_seller_membership_plan_active'] == 1) {
            $sellerObj = new KbSeller($id_seller);
            $seller_info = $sellerObj->getSellerInfo();

            if (Configuration::get('kbmp_membership_start_email')) {
                $email_data = Tools::unSerialize(Configuration::get('kbmp_membership_start_email'));
            }
            $email_template_subject = $this->l('Your Membership Plan is active now');
            if (isset($email_data[$sellerObj->id_default_lang])) {
                $email_template_content = $email_data[$sellerObj->id_default_lang];
            } else {
                $email_template_content = Tools::file_get_contents(_PS_MODULE_DIR_ . $this->name . "/views/templates/admin/email/membership_plan_activation_email.html");
            }
            $plan_page_link = $this->context->link->getModuleLink(
                'kbmarketplace',
                'membershipplans',
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            if ((int) $plan_obj->is_enabled_product_limit) {
                $product_limit = (int) $plan_obj->product_limit;
            } else {
                $product_limit = 'NA';
            }
            
            if (is_numeric($seller_info['id_shop']) && $seller_info['id_shop']) {
                $shop = new Shop((int) $seller_info['id_shop']);
            }
            
            $data = array(
                '{shop_name}' => Tools::safeOutput($shop->name),
                '{SHOP_NAME}' => Tools::safeOutput($shop->name),
                '{seller_name}' => $seller_info['seller_name'],
                '{last_date}' => Tools::displayDate(date('Y-m-d'), $sellerObj->id_default_lang, false),
                '{plan_link}' => $plan_page_link,
                '{product_limit}' => $product_limit,
                '{plan_name}' => $plan_obj->plan_name,
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
    
        if ((int) $plan_obj->is_enabled_product_limit) {
            $product_limit = (int) $plan_obj->product_limit;
            /*
             * fetch active products
             */
            $total_seller_products = KbSellerProduct::getSellerProducts($id_seller, true);
            if ($product_limit > $total_seller_products) {
                KbMemberShipPlanOrder::removeAllSellerProductFromTrackingTable($id_seller);
            } else {
                $active_products = KbMemberShipPlanOrder::getTrackedProducts($id_seller, 1);
                if (count($active_products) > 0) {
                    foreach ($active_products as $p) {
                        if ($product_limit) {
                            KbMemberShipPlanOrder::deleteTrackedProduct($p['id_product']);
                            $product = new Product($p['id_product']);
                            if (!Validate::isLoadedObject($product)) {
                                continue;
                            }

                            $product->active = $p['product_status'];
                            $product->update(true);
                        } else {
                            break;
                        }
                        $product_limit--;
                    }
                }

                /*
                 * Remove remaining inactive product from tracking table
                 */
                if ($product_limit) {
                    $inactive_products = KbMemberShipPlanOrder::getTrackedProducts($id_seller, 0);
                    if (count($inactive_products) > 0) {
                        foreach ($inactive_products as $p) {
                            if ($product_limit) {
                                KbMemberShipPlanOrder::deleteTrackedProduct($p['id_product']);
                                $product = new Product($p['id_product']);
                                if (!Validate::isLoadedObject($product)) {
                                    continue;
                                }

                                $product->active = $p['product_status'];
                                $product->update(true);
                            } else {
                                break;
                            }
                            $product_limit--;
                        }
                    }
                }
            }
        } else {
            KbMemberShipPlanOrder::removeAllSellerProductFromTrackingTable($id_seller);
        }
        return;
    }

    public function hookActionKbSellerProductAdd($param)
    {
        $id_product = $param['product']->id;
        $id_seller = $param['id_seller'];
        
        $is_add_tracking = 0;
        
        if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
            $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
        }
        $is_available_membership_plan = 0;
        if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1) {
            $is_available_membership_plan = 1;
        }
        if ($is_available_membership_plan) {
            $product_status = 1;
            $total_active_products = KbSellerProduct::getSellerProductsByStatus(
                $id_seller,
                true,
                null,
                null,
                null,
                null,
                $product_status
            );

            $status = '2';

            $active_plan_count = KbMemberShipPlanOrder::getMembershipPlan($id_seller, false, $status, null);

            if ($active_plan_count) {
                $active_plan_data = KbMemberShipPlanOrder::getMembershipPlan($id_seller, false, $status, null);

                if (is_array($active_plan_data) && count($active_plan_data) > 0) {
                    foreach ($active_plan_data as $plan_key => $plan_data) {
                        $plan_obj = new KbMemberShipPlanOrder($plan_data['id_kbmp_membership_plan_order']);
                        if ($plan_obj->is_enabled_product_limit == 1 && $total_active_products >= $plan_obj->product_limit) {
                            $is_add_tracking = 1;
                        }
                        break;
                    }
                }
            } else {
                $is_add_tracking = 1;
            }
        }
        if ((int) $is_add_tracking == 1) {
            if (KbMemberShipPlanOrder::insertProductTracking($id_seller, $param['product'])) {
                if ($param['product']->active) {
                    $param['product']->active = 0;
                    $param['product']->update(true);
                }
            }
        }
        return;
    }
    
    public function hookActionKbSellerProductUpdateStatus($param)
    {
        $id_product = $param['product']->id;
        $id_seller = $param['id_seller'];
        
        if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
            $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
        }
        $is_available_membership_plan = 0;
        if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1) {
            $is_available_membership_plan = 1;
        }
        if ($is_available_membership_plan) {
            $product_status = 1;
            $total_active_products = (int) KbSellerProduct::getSellerProductsByStatus(
                $id_seller,
                true,
                null,
                null,
                null,
                null,
                $product_status
            );
            $status = '2';

            $active_plan_count = KbMemberShipPlanOrder::getMembershipPlan($id_seller, false, $status, null);

            if ($active_plan_count) {
                $active_plan_data = KbMemberShipPlanOrder::getMembershipPlan($id_seller, false, $status, null);
                if (is_array($active_plan_data) && count($active_plan_data) > 0) {
                    foreach ($active_plan_data as $plan_key => $plan_data) {
                        $plan_obj = new KbMemberShipPlanOrder($plan_data['id_kbmp_membership_plan_order']);
                        if ($plan_obj->is_enabled_product_limit == 1 && $total_active_products >= $plan_obj->product_limit) {
                            return false;
                        }
                        break;
                    }
                }
            } else {
                return false;
            }
        }
        KbMemberShipPlanOrder::deleteTrackedProduct($id_product);
        return true;
    }
    
    public function hookActionObjectProductUpdateBefore(&$param)
    {
        $product = $param['object'];

        if ($id_seller = KbSellerProduct::getSellerIdByProductId($product->id)) {
            $seller = new KbSeller($id_seller);

            if (!$seller->isApprovedSeller() || $seller->active == 0) {
                $product->active = 0;
            }
        }
    }

    public function hookActionObjectProductCommentAddAfter($param)
    {
        $object = $param['object'];
        if ((int) $object->id > 0) {
            $seller = KbSellerProduct::getSellerByProductId($object->id_product);
            if (!empty($seller) && (int) $seller['id_seller'] > 0) {
                $pro_rev = new KbSellerProductReview();
                $pro_rev->id_seller = $seller['id_seller'];
                $pro_rev->id_shop = $this->context->shop->id;
                $pro_rev->id_customer = $object->id_customer;
                $pro_rev->id_lang = $this->context->language->id;
                $pro_rev->id_product = $object->id_product;
                $pro_rev->id_product_comment = $object->id;

                $pro_rev->save();

                Hook::exec('actionKbMarketPlaceProductCommentSave', array('object' => $pro_rev, 'seller' => $seller));
            }
        }
    }

    public function hookActionObjectProductCommentDeleteAfter($param)
    {
        $object = $param['object'];
        if ((int) $object->id > 0) {
            $row = KbSellerProductReview::getRowByComment($object->id);
            if ($row && is_array($row) && !empty($row)) {
                $row_id = $row['id_seller_product_review'];
                $pro_rev = new KbSellerProductReview($row_id);
                $pro_rev->delete();
                Hook::exec(
                    'actionKbMarketPlaceProductCommentDelete',
                    array('id_seller_product_review' => $row_id, 'comment_id' => $object->id)
                );
            }
        }
    }

    //changes by vishal for custom change
    public function processOnNewOrder($id_order, $render_detail, $kb_order_status)
    {
        //changes end
        if (Configuration::get('KB_MP_SELLER_ORDER_HANDLING') == 1 && Configuration::get('KB_MARKETPLACE') == 1) {
            $this->context->cookie->kbsellerhandleorder = 1;
        }
        $id_customization_array = array();
        $product_details = array();
        $order = new Order($id_order);
        $seller_products = array();
        $admin_products = array();
        $order_product_detail = $order->getProducts();
        $invoice = new Address($order->id_address_invoice);
        $delivery = new Address($order->id_address_delivery);
        if ($order_product_detail && is_array($order_product_detail) && count($order_product_detail) > 0) {
            foreach ($order_product_detail as $detail) {
                $id_seller = (int) KbSellerProduct::getSellerIdByProductId((int) $detail['product_id']);
                if ($id_seller > 0) {
                    $seller_products[$id_seller][] = $detail;
                } else {
                    $admin_products[] = $detail;
                }
            }
        }
        
        foreach ($seller_products as $id_seller => $products) {
            $products_in_this_order = array();
            $total_earning = 0;
            $total_admin_earning = 0;
            $qty_ordered = 0;
            foreach ($products as $product) {
                $cat_comm_id = 0;
                // changes by rishabh jain for category wise commission
                $cat_comm_id = KbCategoryLevelCommission::getIdCommissionBySellerIdAndCategoryId($id_seller, $product['id_category_default']);
                if ($cat_comm_id != 0) {
                    $cat_com_obj = new KbCategoryLevelCommission($cat_comm_id);
                    $comission_percent = $cat_com_obj->commission_percentage;
                } else {
                    $comission_percent = (float) KbSellerSetting::getSellerSettingByKey(
                        $id_seller,
                        'kbmp_default_commission'
                    );
                }
                
                $comson_from_percent = (float) ($comission_percent / 100);
                // changes over
//                $comson_from_percent = (float) ($comission_percent / 100);
                $admin_order_item_earning = (float) ($comson_from_percent * $product['total_price_tax_incl']);
                $sl_od_obj = new KbSellerOrderDetail();
                $sl_od_obj->id_seller = $id_seller;
                $sl_od_obj->id_order = $order->id;
                $sl_od_obj->id_shop = $order->id_shop;
                $sl_od_obj->id_category = $product['id_category_default'];
                $sl_od_obj->id_product = $product['product_id'];
                $sl_od_obj->id_order_detail = $product['id_order_detail'];
                $sl_od_obj->commission_percent = $comission_percent;
                $sl_od_obj->qty = ($product['product_quantity'] - (
                        $product['product_quantity_return'] + $product['product_quantity_refunded']
                        ));
                $sl_od_obj->total_earning = $product['total_price_tax_incl'];
                $sl_od_obj->seller_earning = ($product['total_price_tax_incl'] - $admin_order_item_earning);
                $sl_od_obj->admin_earning = $admin_order_item_earning;
                $sl_od_obj->unit_price = $product['unit_price_tax_incl'];
                $sl_od_obj->is_consider = '1';
                $sl_od_obj->is_canceled = '0';
                $sl_od_obj->save();

                Hook::exec('actionKbMarketPlaceSOrderDetailSave', array('object' => $sl_od_obj));

                $products_in_this_order[] = $product['product_id'];
//                $total_earning += $product['total_price_tax_incl'];
//                $total_earning += (float) ((float) ($comission_percent / 100) * $product['total_price_tax_incl']);
                $total_earning += (float) ($product['total_price_tax_incl']);
                $total_admin_earning += (float) ((float) ($comission_percent / 100) * $product['total_price_tax_incl']);
                $qty_ordered = ($qty_ordered + ($product['product_quantity'] - ($product['product_quantity_return'] + $product['product_quantity_refunded'])));
            }

            if (Configuration::get('KB_MP_SELLER_ORDER_HANDLING') == 1 && Configuration::get('KB_MARKETPLACE') == 1) {
                $total_earning -= $order->total_discounts_tax_incl;
                $admin_earning = (float) $total_admin_earning - $order->total_discounts_tax_incl;
                $total_earning += $order->total_shipping_tax_incl;
                $total_earning += $order->total_wrapping_tax_incl;
            } else {
                $admin_earning = (float) $total_admin_earning;
            }

            $seller_earning = KbSellerEarning::getEarningBySellerAndOrder($id_seller, (int) $order->id);
            // change by rishabh jain added is_array parameter as in Ps 1.7.4 it is throwing error
            if (is_array($seller_earning) && count($seller_earning) > 0) {
                $earning_obj = new KbSellerEarning($seller_earning['id_seller_earning']);
            } else {
                $earning_obj = new KbSellerEarning();
            }

            $earning_obj->id_seller = $id_seller;
            $earning_obj->id_shop = $order->id_shop;
            $earning_obj->id_order = $order->id;
            $earning_obj->product_count = (int) $qty_ordered;
            $earning_obj->total_earning = (float) $total_earning;
            $earning_obj->seller_earning = (float) ($total_earning - $admin_earning);
            $earning_obj->admin_earning = (float) $admin_earning;
            $earning_obj->is_canceled = '0';
            $earning_obj->can_handle_order = 0;
            if (Configuration::get('KB_MP_SELLER_ORDER_HANDLING') == 1 && Configuration::get('KB_MARKETPLACE') == 1) {
                $earning_obj->can_handle_order = 1;
            }

            $earning_obj->save();

            //changes by vishal for custom change
            $config = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if(isset($config['paypal_automatic_transfer']) && $config['paypal_automatic_transfer']==1 && in_array($kb_order_status, $config['order_automatic_transfer_statuses'])){
                $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                $handle = fopen($file, 'a+');
                fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                fwrite($handle,'Order Id #'.print_r($order->id,TRUE).' , Order status Matches fOr paYment : Yes ');
                fwrite($handle,"\r\n");
                fclose($handle);
                $this->saveNewPayoutRequest($id_seller,(float) ($total_earning - $admin_earning), $order->id);
            }else{
                $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                $handle = fopen($file, 'a+');
                fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                fwrite($handle,'Order Id #'.print_r($order->id,TRUE).' , Order status Matches fOr paYment : NO ');
                fwrite($handle,"\r\n");
                fclose($handle);       
            }
            

            //changes end

            Hook::exec('actionKbMarketPlaceSEarningSave', array('object' => $earning_obj));

            $send_email = KbSellerSetting::getSellerSettingByKey($id_seller, 'kbmp_email_on_new_order');
            if ($send_email == 1) {
                $cart_products = new Cart($order->id_cart);
                $product_list = $cart_products->getProducts();
                $product_var_tpl_list = array();
                foreach ($product_list as $product) {
                    if (in_array($product['id_product'], $products_in_this_order) && KbSellerProduct::isSellerProduct($id_seller, (int) $product['id_product'])) {
                        $price = Product::getPriceStatic(
                            (int) $product['id_product'],
                            false,
                            ($product['id_product_attribute'] ? (int) $product['id_product_attribute'] : null),
                            6,
                            null,
                            false,
                            true,
                            $product['cart_quantity'],
                            false,
                            (int) $order->id_customer,
                            (int) $order->id_cart,
                            (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}
                        );

                        $price_wt = Product::getPriceStatic(
                            (int) $product['id_product'],
                            true,
                            ($product['id_product_attribute'] ? (int) $product['id_product_attribute'] : null),
                            2,
                            null,
                            false,
                            true,
                            $product['cart_quantity'],
                            false,
                            (int) $order->id_customer,
                            (int) $order->id_cart,
                            (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}
                        );

                        $product_price = Product::getTaxCalculationMethod() == PS_TAX_EXC ? Tools::ps_round($price, 2) : $price_wt;
                        // changes by rihabh jain to update th price in case of booking product
                        if (Module::isInstalled('kbbookingcalendar') && Module::isEnabled('kbbookingcalendar')) {
                            $kb_setting = Tools::jsonDecode(Configuration::get('KB_BOOKING_CALENDAR_GENERAL_SETTING'), true);
                            $is_available_booking_calender_tab = 0;
                            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                            if (!empty($kb_setting) && $kb_setting['enable']) {
                                if (isset($mp_config['enable_booking_calender_compatibility']) && $mp_config['enable_booking_calender_compatibility'] == 1) {
                                    $is_available_booking_calender_tab = 1;
                                }
                            }
                            if ($is_available_booking_calender_tab == 1) {
                                $booking_product_details = DB::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'kb_booking_product_order where id_order='.(int)$id_order.' AND id_product='.(int)$product['id_product'].' AND id_customization='.(int)$product['id_customization']);
                                if (!empty($booking_product_details)) {
                                    $product_price = $booking_product_details['price'];
                                }
                            }
                        }
                        // changes over
                        $product_var_tpl = array(
                            'reference' => $product['reference'],
                            'name' => $product['name'] . (isset($product['attributes']) ? ' - '. $product['attributes'] : ''),
                            'unit_price' => Tools::displayPrice($product_price, $this->context->currency, false),
                            'price' => Tools::displayPrice($product_price * $product['quantity'], $this->context->currency, false),
                            'quantity' => $product['quantity'],
                            'customization' => array()
                        );

                        $customized_datas = Product::getAllCustomizedDatas((int) $order->id_cart);
                        $id_protmp = $product['id_product'];
                        $id_proattrtmp = $product['id_product_attribute'];
                        if (isset($customized_datas[$id_protmp][$id_proattrtmp])) {
                            $product_var_tpl['customization'] = array();
                            $id_dl_add = $order->id_address_delivery;
                            $customized_datas_temp = $customized_datas[$id_protmp][$id_proattrtmp][$id_dl_add];
                            $is_custom_field_added = 0;
                            foreach ($customized_datas_temp as $id_customization => $customization) {
                                if (!in_array($id_customization, $id_customization_array) && $is_custom_field_added == 0) {
                                    $id_customization_array[] = $id_customization;
                                    $customization_text = '';
                                    if (isset($customization['datas'][Product::CUSTOMIZE_TEXTFIELD])) {
                                        foreach ($customization['datas'][Product::CUSTOMIZE_TEXTFIELD] as $text) {
                                            $customization_text .= $text['name'] . ': '
                                                    . $text['value'] . '<br />';
                                        }
                                    }

                                    if (isset($customization['datas'][Product::CUSTOMIZE_FILE])) {
                                        $customization_text .= sprintf('%d image(s)', count($customization['datas'][Product::CUSTOMIZE_FILE])) . '<br />';
                                    }

                                    $customization_quantity = (int) $product['customization_quantity'];

                                    $product_var_tpl['customization'][] = array(
                                        'customization_text' => $customization_text,
                                        'customization_quantity' => $customization_quantity,
                                        'quantity' => Tools::displayPrice($customization_quantity * $product_price, $this->context->currency, false)
                                    );
                                    $is_custom_field_added = 1;
                                }
                            }
                        }

                        $product_var_tpl_list[] = $product_var_tpl;
                    }
                } // end foreach ($products)

                $sellerObj = new KbSeller($id_seller);
                $seller_info = $sellerObj->getSellerInfo();
                $product_list_html = '';
                if (count($product_var_tpl_list) > 0) {
                    $product_html_vars = array(
                        'products' => $product_var_tpl_list,
                        'total_paid' => Tools::displayPrice($total_earning, $this->context->currency, false)
                    );
                    $product_list_html = $this->getEmailTemplateContent(
                        'order_conf_product_list.tpl',
                        Mail::TYPE_HTML,
                        $product_html_vars
                    );
                }

                $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                if (isset($mp_config['kbmp_seller_order_email_template'][$this->context->language->id])) {
                    $temp_templ = $mp_config['kbmp_seller_order_email_template'];
                    $email_order_template = $temp_templ[$this->context->language->id];
                } else {
                    $email_order_template = KbEmail::getOrderEmailBaseTemplate();
                }

                /* Start-MK made changes on 28-05-18 for GDPR changes */
                $gdpr_setting = Tools::jsonDecode(Configuration::get('KB_MP_GDPR_SETTINGS'), true);
                $customer_email = $this->context->customer->email;
                if (!empty($gdpr_setting) && $gdpr_setting['enable_gdpr'] && !$gdpr_setting['enable_customer_id']) {
                    $customer_email = 'xxxx@xxx.com';
                }
                /* End-MK made changes on 28-05-18 for GDPR changes */
                $data = array(
                    '{seller_name}' => $seller_info['seller_name'],
                    '{firstname}' => $this->context->customer->firstname,
                    '{lastname}' => $this->context->customer->lastname,
                    '{email}' => $customer_email,
                    '{delivery_block_txt}' => $this->getFormatedAddress($delivery, "\n"),
                    '{invoice_block_txt}' => $this->getFormatedAddress($invoice, "\n"),
                    '{delivery_block_html}' => $this->getFormatedAddress($delivery, '<br />', array(
                        'firstname' => '<span style="font-weight:bold;">%s</span>',
                        'lastname' => '<span style="font-weight:bold;">%s</span>'
                    )),
                    '{invoice_block_html}' => $this->getFormatedAddress($invoice, '<br />', array(
                        'firstname' => '<span style="font-weight:bold;">%s</span>',
                        'lastname' => '<span style="font-weight:bold;">%s</span>'
                    )),
                    '{order_name}' => $order->getUniqReference(),
                    '{date}' => Tools::displayDate(date('Y-m-d H:i:s'), null, 1),
                    '{products}' => $product_list_html,
                    '{products_txt}' => $product_list_html,
                        //'{total_paid}' => Tools::displayPrice($total_earning, $this->context->currency, false)
                );

                foreach ($data as $variable => $variable_val) {
                    $email_order_template = str_replace($variable, $variable_val, $email_order_template);
                }
                /* Start - MK made change on 30-05-18 to send notification based on the type */
                $notification_emails = $sellerObj->getEmailIdForNotification();
                foreach ($notification_emails as $em) {
                    Mail::Send(
                        (int) $order->id_lang,
                        'kb_order_conf',
                        $this->l('An Order is just Placed', 'kbconfiguration'),
                        array('{order_data}' => html_entity_decode($email_order_template)),
                        $em['email'],
                        $em['title'],
                        null,
                        null,
                        null,
                        null,
                        _PS_MODULE_DIR_ . 'kbmarketplace/mails/',
                        false,
                        (int) $order->id_shop
                    );
                }
                /* End - MK made change on 30-05-18 to send notification based on the type */
            }
        }
//            }
//        }
        $this->context->cookie->kbsellerhandleorder = 0;
        unset($this->context->cookie->kbsellerhandleorder);
    }

    public function renderSellerProductDetails($order_reference, $render_detail)
    {
        $orders_by_reference = Order::getByReference($order_reference);
        $orders = $orders_by_reference->getResults();
        $product_details = array();
        $order_array = array();
        if ($orders && is_array($orders) && count($orders) > 0) {
            foreach ($orders as $order) {
                $presenter = new OrderPresenter();
                $presentedOrder = $presenter->present($order);
                $order_array[] = $presentedOrder;
                $seller_products = array();
                $admin_products = array();
                $order_product_detail = $order->getProducts();
                $invoice = new Address($order->id_address_invoice);
                $delivery = new Address($order->id_address_delivery);
                if ($order_product_detail && is_array($order_product_detail) && count($order_product_detail) > 0) {
                    foreach ($order_product_detail as $detail) {
                        $id_seller = (int) KbSellerProduct::getSellerIdByProductId((int) $detail['product_id']);
                        if ($id_seller > 0) {
                            $seller_products[$id_seller][] = $detail;
                        } else {
                            $admin_products[] = $detail;
                        }
                    }
                }

                if ($render_detail) {
                    if (count($admin_products)) {
                        foreach ($admin_products as $product) {
                            $product_obj = new Product((int) $product['id_product']);
                            $product_details[] = array(
                                'id_product' => $product_obj->id,
                                'link_rewrite' => $product_obj->link_rewrite[$this->context->language->id],
                                'category' => $product_obj->category,
                                'id_shop' => $product['id_shop'],
                                'id_product_attribute' => $product['product_attribute_id'],
                                'id_image' => isset($product['image']->id_image) ?
                                        $product['image']->id_image : $this->context->language->iso_code . '-default',
                                'name' => $product_obj->name[$this->context->language->id],
                                'reference' => $product_obj->reference,
                                'seller_info' => "Admin"
                            );
                        }
                    }
                    if (count($seller_products)) {
                        foreach ($seller_products as $id_seller => $products) {
                            foreach ($products as $product) {
                                $product_obj = new Product((int) $product['id_product']);
                                $sellerObj = new KbSeller($id_seller);
                                $seller_info = $sellerObj->getSellerInfo();
                                if ($seller_info['id_country'] != '') {
                                    $seller_info['id_country'] = Country::getNameById(
                                        $this->context->language->id,
                                        $seller_info['id_country']
                                    );
                                }
                                $l_iso = $this->context->language->iso_code;
                                $product_details[] = array(
                                    'id_product' => $product_obj->id,
                                    'link_rewrite' => $product_obj->link_rewrite[$this->context->language->id],
                                    'category' => $product_obj->category,
                                    'id_shop' => $product['id_shop'],
                                    'id_product_attribute' => $product['product_attribute_id'],
                                    'id_image' => isset($product['image']->id_image) ?
                                            $product['image']->id_image : $l_iso . '-default',
                                    'name' => $product_obj->name[$this->context->language->id],
                                    'reference' => $product_obj->reference,
                                    'seller_info' => $seller_info
                                );
                                unset($l_iso);
                            }
                        }
                    }
                }
            }
            
            
            $this->context->smarty->assign(array('order_details_marketplace' => $order_array));
            $this->context->smarty->assign('render_detail', $render_detail);
            /* next line added by rishabh jain on 20th july to fix this issue
             * Disable Seller Info from Admin: Still, Info is being displayed on the Success Page.
             */
            if ($render_detail) {
                $this->context->smarty->assign('product_details', $product_details);
                return $this->display(
                    _PS_MODULE_DIR_ . '/kbmarketplace.php',
                    'views/templates/hook/seller_detail_on_success.tpl'
                );
            }
        }
    }
    // Function added by rishabh jain
    
    public function hookActionObjectCustomerDeleteAfter($customer)
    {
        if (!empty($customer->email) && Validate::isEmail($customer->email)) {
            if (Module::isInstalled('kbmarketplace')) {
                $config = Configuration::get('KB_MARKETPLACE');
                if ($config) {
                    $email = $customer->email;
                    $id_customer = Customer::customerExists($email, true, false);
                    if (!empty($id_customer)) {
                        $id_seller = KbSeller::getSellerByCustomerId($id_customer);
                        if ($id_seller) {
                            //delete seller products
                            $seller_products = KbSellerProduct::getSellerProducts($id_seller);
                            if (!empty($seller_products)) {
                                foreach ($seller_products as $sell_product) {
                                    if (KbSellerProduct::isSellerProduct($id_seller, $sell_product['id_product'])) {
                                        $product = new Product($sell_product['id_product']);
                                        $product->active = 0;
                                        $product->save();
                                    }
                                }
                            }
                            
                            //delete review
                            $seller_reviews = KbSellerReview::getReviewsBySellerId($id_seller);
                            if (!empty($seller_reviews)) {
                                foreach ($seller_reviews as $sell_review) {
                                    $review = new KbSellerReview($sell_review['id_seller_review']);
                                    $review->delete();
                                }
                            }
                            
                            //delete carriers
                            $seller_shippings = KbSellerShipping::getSellerShippings($id_seller, Context::getContext()->language->id);
                            if (!empty($seller_shippings)) {
                                foreach ($seller_shippings as $sell_ship) {
                                    $carrier = new Carrier($sell_ship['id_carrier']);
                                    $carrier->delete();
                                }
                            }
                            //delete seller
                             $seller = new KbSeller($id_seller);
                             $seller->delete();
                        } else {
                            //delete customer review
                             Db::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'kb_mp_seller_review WHERE id_customer='.(int)$id_customer);
                             Db::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'kb_mp_seller_product_review WHERE id_customer='.(int)$id_customer);
                        }
                        return json_encode(true);
                    }
                    return json_encode($this->l('Marketplace: No user found with this email.'));
                }
            }
        }
    }
    // to delte customer seller account
    public function hookActionValidateOrder($params)
    {
        $tmp = $params['order'];
        $order_state = $params['orderStatus']->id;
        
        unset($this->context->cookie->kb_selected_carrier);
        if (!Configuration::get('KB_MARKETPLACE_CONFIG') || Configuration::get('KB_MARKETPLACE_CONFIG') == '') {
            $settings = KbGlobal::getDefaultSettings();
        } else {
            $settings = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        }
        $render_detail = false;
        if (isset($settings['kbmp_enable_seller_order_details']) && $settings['kbmp_enable_seller_order_details'] == 1) {
            $render_detail = true;
        }
        /*
         * @author  - Rishabh Jain
         * DOC - 6th Mar 2020
         * Changes - To add the entry in membership order table if membership plan type products is ordered
         */
        $this->addInfoIfMembershipTypeProduct($tmp, $order_state);
        /*
         * changes over
         */
        //changes by vishal for custom change
        $this->processOnNewOrder($tmp->id, $render_detail,$order_state);
        //changes end
    }
    
    private function addInfoIfMembershipTypeProduct($order_obj, $order_state)
    {
        $orders_by_reference = Order::getByReference($order_obj->reference);
        $orders = $orders_by_reference->getResults();
        $settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
        if ($orders && is_array($orders) && count($orders) > 0) {
            foreach ($orders as $order) {
                $order_product_detail = $order->getProducts();
                if ($order_product_detail && is_array($order_product_detail) && count($order_product_detail) > 0) {
                    foreach ($order_product_detail as $detail) {
                        $id_membership_plan = KbMpMemberShipPlan::isMemberShipPlanTypeProduct((int) $detail['product_id']);
                        if ($id_membership_plan > 0) {
                            $membership_plan_obj = new KbMpMemberShipPlan($id_membership_plan);
                            $kbmp_order_obj = new KbMemberShipPlanOrder();
                            $kbmp_order_obj->id_cart = $order_obj->id_cart;
                            $kbmp_order_obj->id_order = $order_obj->id;
                            $kbmp_order_obj->id_order_detail = $detail['id_order_detail'];
                            $kbmp_order_obj->plan_duration = $membership_plan_obj->plan_duration;
                            
                            $kbmp_order_obj->plan_name = $detail['product_name'];
                            
                            $kbmp_order_obj->plan_duration_type = $membership_plan_obj->plan_duration_type;
                            $kbmp_order_obj->is_enabled_product_limit = $membership_plan_obj->is_enabled_product_limit;
                            
                            $kbmp_order_obj->product_limit = $membership_plan_obj->product_limit;
                            
                            $kbmp_order_obj->id_seller = KbSeller::getSellerByCustomerId($this->context->customer->id);
                            
                            $kbmp_order_obj->id_kbmp_membership_plan = $id_membership_plan;
                            
//                            $order_state = $order_obj->getCurrentStateFull($this->context->language->id);
                            
                            if (isset($settings['kbmp_membership_plan_order_statuses']) && in_array($order_state, $settings['kbmp_membership_plan_order_statuses'])) {
                                $kbmp_order_obj->is_paid = 1;
                                $kbmp_order_obj->status = 0;
                            } else {
                                $kbmp_order_obj->is_paid = 0;
                            }
                            $id_free_membership_plan = KbMpMemberShipPlan::getFreeMembershipPlanID();
                            if ($id_free_membership_plan == $id_membership_plan) {
                                $kbmp_order_obj->is_paid = 1;
                            }
                            
                            
                            $kbmp_order_obj->id_shop = $order_obj->id_shop;
                            $kbmp_order_obj->quantity = ($detail['product_quantity'] - (
                                $detail['product_quantity_return'] + $detail['product_quantity_refunded']
                            ));
                            $kbmp_order_obj->save();
                        }
                    }
                }
            }
        }
    }
    
    /*
     * Changes over
     */
    public function hookDisplayOrderConfirmation($params)
    {
        $tmp = $params['order'];
        unset($this->context->cookie->kb_selected_carrier);
        if (!Configuration::get('KB_MARKETPLACE_CONFIG') || Configuration::get('KB_MARKETPLACE_CONFIG') == '') {
            $settings = KbGlobal::getDefaultSettings();
        } else {
            $settings = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        }
        $render_detail = false;
        if (isset($settings['kbmp_enable_seller_order_details']) && $settings['kbmp_enable_seller_order_details'] == 1) {
            $render_detail = true;
        }
        return $this->renderSellerProductDetails($tmp->reference, $render_detail);
    }

    
   
//    changes by tarun to fix the issue when refund/partiallyrefund/cancel
    public function hookActionUpdateEarningAfterPartiallyRefund($param)
    {
        return '';
        $order = $param['object'];
        $order_detail = $param['object'];
        $seller_order_detail = KbSellerOrderDetail::getDetailByOrderItemId($order_detail->id);
        if (!empty($seller_order_detail) && count($seller_order_detail) > 0) {
            $id_seller = $seller_order_detail['id_seller'];
            $comission_percent = (float) $seller_order_detail['commission_percent'];
            $qty_ordered = (int) ($param['quantity']);
                    
            if ($order_detail->product_quantity_refunded != 0) {
                if (Tools::isSubmit('shippingBack') && Tools::getValue('shippingBack') == 'on') {
                    $total_earning = $order_detail->unit_price_tax_incl * ($param['quantity']);
                } else {
                    $total_earning = $order_detail->unit_price_tax_excl * ($param['quantity']);
                }
            } else {
                $total_earning = $order_detail->unit_price_tax_incl * $param['quantity'];
            }
            $admin_earning = (float) ((float) ($comission_percent / 100) * $total_earning);

            $cancel_statuses = array(
                Configuration::get('PS_OS_ERROR'),
                Configuration::get('PS_OS_CANCELED')
            );

            $sl_od_obj = new KbSellerOrderDetail($seller_order_detail['id_seller_order_detail']);
            $sl_od_obj->total_earning = $sl_od_obj->total_earning- $total_earning;
            $sl_od_obj->seller_earning = $sl_od_obj->seller_earning - ($total_earning - $admin_earning);
            $sl_od_obj->admin_earning = $sl_od_obj->admin_earning - $admin_earning;
            $sl_od_obj->qty = $qty_ordered;
            $sl_od_obj->is_consider = '1';
            $checkstatus = new order($order->id_order);
            if (in_array($checkstatus->getCurrentState(), $cancel_statuses)) {
                $sl_od_obj->is_canceled = '1';
            } else {
                $sl_od_obj->is_canceled = '0';
            }

            $sl_od_obj->save();

            Hook::exec('actionKbMarketPlaceSOrderDetailUpdate', array('object' => $sl_od_obj));

            $seller_earning = KbSellerEarning::getEarningBySellerAndOrder($id_seller, $order_detail->id_order);
            if (count($seller_earning) > 0) {
                $earning_obj = new KbSellerEarning($seller_earning['id_seller_earning']);
                if ($earning_obj->product_count != 0) {
                    $earning_obj->product_count -= $qty_ordered;
                }
                $earning_obj->total_earning = (float) ($earning_obj->total_earning - $total_earning);
                if ($earning_obj->total_earning < 0) {
                    return '';
                }
                $earning_obj->seller_earning = (float) ($earning_obj->seller_earning - ($total_earning - $admin_earning));
                $earning_obj->admin_earning = (float) ($earning_obj->admin_earning - $admin_earning);
            }
            $checkstatus = new order($order->id_order);
            if (in_array($checkstatus->getCurrentState(), $cancel_statuses)) {
                $earning_obj->is_canceled = '1';
            } else {
                $earning_obj->is_canceled = '0';
            }
            $earning_obj->save();
            Hook::exec('actionKbMarketPlaceSEarningUpdate', array('object' => $earning_obj));
        }
    }
    
    
    //Changes over
    public function hookActionObjectOrderDetailUpdateAfter($param)
    {
        if (!Tools::isSubmit('cancelProduct') && !Tools::isSubmit('partialRefund')) {
            $order_detail = $param['object'];
            if ($id_seller = KbSellerProduct::getSellerIdByProductId($order_detail->product_id)) {
                $temp = KbSellerOrderDetail::getDetailByOrderItemId($order_detail->id);
                if (count($temp) > 0) {
                    $seller_earning = KbSellerEarning::getEarningBySellerAndOrder($id_seller, $order_detail->id_order);
                    if (count($seller_earning) > 0) {
                        $comission_percent = (float) KbSellerSetting::getSellerSettingByKey(
                            $id_seller,
                            'kbmp_default_commission'
                        );
                        $qty_ordered = (int) ($order_detail->product_quantity - (
                                $order_detail->product_quantity_return + $order_detail->product_quantity_refunded)
                                );
                        $total_earning = $order_detail->total_price_tax_incl;
                        $admin_earning = (float) ((float) ($comission_percent / 100) * $total_earning);

                        $order = new Order($order_detail->id_order);

                        $cancel_statuses = array(
                            Configuration::get('PS_OS_ERROR'),
                            Configuration::get('PS_OS_CANCELED')
                        );

                        $sl_od_obj = new KbSellerOrderDetail($temp['id_seller_order_detail']);
                        $sl_od_obj->id_seller = $id_seller;
                        $sl_od_obj->id_order = $order_detail->id_order;
                        $sl_od_obj->id_shop = $order->id_shop;
                        $sl_od_obj->id_category = $order_detail->id_category_default;
                        $sl_od_obj->id_product = $order_detail->product_id;
                        $sl_od_obj->id_order_detail = $order_detail->id;
                        $sl_od_obj->commission_percent = $comission_percent;
                        $sl_od_obj->total_earning = $total_earning;
                        $sl_od_obj->seller_earning = ($total_earning - $admin_earning);
                        $sl_od_obj->admin_earning = $admin_earning;
                        $sl_od_obj->unit_price = $order_detail->unit_price_tax_incl;
                        $sl_od_obj->qty = $qty_ordered;
                        $sl_od_obj->is_consider = '1';

                        if (in_array($order->getCurrentState(), $cancel_statuses)) {
                            $sl_od_obj->is_canceled = '1';
                        } else {
                            $sl_od_obj->is_canceled = '0';
                        }

                        $sl_od_obj->save();

                        Hook::exec('actionKbMarketPlaceSOrderDetailUpdate', array('object' => $sl_od_obj));

                        $earning_obj = new KbSellerEarning($seller_earning['id_seller_earning']);
                        $earning_obj->product_count += $qty_ordered;
                        $earning_obj->total_earning = (float) ($earning_obj->total_earning + $total_earning);
                        $earning_obj->seller_earning = (float) ($earning_obj->seller_earning + ($total_earning - $admin_earning));
                        $earning_obj->admin_earning = (float) ($earning_obj->admin_earning + $admin_earning);
                        if (in_array($order->getCurrentState(), $cancel_statuses)) {
                            $earning_obj->is_canceled = '1';
                        } else {
                            $earning_obj->is_canceled = '0';
                        }

                        $earning_obj->save();

                        Hook::exec(
                            'actionKbMarketPlaceSEarningUpdate',
                            array('object' => $earning_obj)
                        );
                    }
                }
            }
        }
    }

    protected function getFormatedAddress(Address $the_address, $line_sep, $fields_style = array())
    {
        return AddressFormat::generateAddress($the_address, array('avoid' => array()), $line_sep, ' ', $fields_style);
    }

    protected function getEmailTemplateContent($template_name, $mail_type, $var)
    {
        $theme_template_path = _PS_MODULE_DIR_ . $this->name . '/views/templates/front/emails/'
                . $template_name;

//        $theme_template_path = _PS_MODULE_DIR_ . $this->name . DIRECTORY_SEPARATOR
//            . 'views' . DIRECTORY_SEPARATOR .$this->context->language->iso_code
//            . DIRECTORY_SEPARATOR . $template_name;

        //if (Tools::file_exists_cache($theme_template_path)) {
            $this->context->smarty->assign('product_html_vars', $var);
            return $this->context->smarty->fetch($theme_template_path);
//        }
//        return '';
    }
    /* Changes strted by rishabh jain on 5th sep 2018
     * to add compatibility with kb review remainder plugin
     * Added hook to add review data in kb_mp_seller_product_review.
     * parameters: email,author;customer_id;product_id';review_id
     */
    public function hookActionKbProductReviewAddAfter($params = null)
    {
        $context = Context::getContext();
        $review_data = $params['object'];
        if (Configuration::get('KB_MARKETPLACE') !== false
            && Configuration::get('KB_MARKETPLACE') == 1) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (Module::isInstalled('kbreviewincentives') && isset($mp_config['kbmp_enable_product_review_compatibility']) && $mp_config['kbmp_enable_product_review_compatibility'] == 1) {
                if ((int) $review_data['review_id'] > 0) {
                    $seller = KbSellerProduct::getSellerByProductId($review_data['product_id']);
                    if (!empty($seller) && (int) $seller['id_seller'] > 0) {
                        $pro_rev = new KbSellerProductReview();
                        $pro_rev->id_seller = $seller['id_seller'];
                        $pro_rev->id_shop = $this->context->shop->id;
                        $pro_rev->id_customer = $review_data['customer_id'];
                        $pro_rev->id_lang = $this->context->language->id;
                        $pro_rev->id_product = $review_data['product_id'];
                        $pro_rev->id_product_comment = $review_data['review_id'];
                        $pro_rev->save();
                    }
                }
            }
        }
    }
    /* Changes strted by rishabh jain on 5th sep 2018
     * to add compatibility with kb review remainder plugin
     * Added hook to add review data in kb_mp_seller_product_review.
     * parameters recieved review_id from velsof_product_review table
     */
    public function hookActionKbProductReviewDeleteAfter($params = null)
    {
        $review_id = $params['review_id'];
        if (Configuration::get('KB_MARKETPLACE') !== false && Configuration::get('KB_MARKETPLACE') == 1) {
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (Module::isInstalled('kbreviewincentives') && isset($mp_config['kbmp_enable_product_review_compatibility']) && $mp_config['kbmp_enable_product_review_compatibility'] == 1) {
                if ((int) $review_id > 0) {
                    require_once(_PS_MODULE_DIR_ . 'kbreviewincentives/classes/admin/reviews.php');
                    if (class_exists('reviews', false)) {
                        $comment = new reviews($review_id);
                        $seller = KbSellerProduct::getSellerByProductId($comment->product_id);
                        if (!empty($seller) && (int) $seller['id_seller'] > 0) {
                            $sql = 'Select id_seller_product_review From ' . _DB_PREFIX_ . 'kb_mp_seller_product_review where id_product_comment = ' . (int) $review_id;
                            $kb_seller_product_review_id = Db::getInstance()->getValue($sql);
                            if ($kb_seller_product_review_id > 0) {
                                $pro_rev = new KbSellerProductReview($kb_seller_product_review_id);
                                $pro_rev->delete();
                            }
                        }
                    }
                }
            }
        }
    }

    /*Changes over */
    public function hookActionOrderStatusUpdate($params = null)
    {
        $id_order = $params['id_order'];

        $order_state = $params['newOrderStatus'];

        $errorOrCanceledStatuses = array(Configuration::get('PS_OS_ERROR'), Configuration::get('PS_OS_CANCELED'));

        $is_canceled = '0';
//        if (in_array($order_state->id, $errorOrCanceledStatuses)) {
//            $is_canceled = '1';
//        }
        /* Boc by Rishabh Jain
         * to mark cancel order according to the status selected by admin for order cancellation
         */
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        
        $is_canceled = '0';
        if (in_array($order_state->id, $mp_config['order_return_statuses'])) {
            $is_canceled = '1';
        }

        $seller_orders = KbSellerEarning::getEarningByOrder($id_order);

        if ($seller_orders && count($seller_orders) > 0) {
            foreach ($seller_orders as $odr) {
                $obj = new KbSellerEarning($odr['id_seller_earning']);
                $obj->is_canceled = $is_canceled;
                /* changes started by rishabh jain to edit the earning on order if cancelled */
                if ($is_canceled == '1') {
                    $seller_earning = 0;
                    if ($obj->can_handle_order == 1) {
                        $order_obj  = new Order($id_order);
                        if (isset($mp_config['kbmp_enable_deduct_shipping_cost_order_handling']) && $mp_config['kbmp_enable_deduct_shipping_cost_order_handling'] == 0) {
                            $seller_earning = (int) $order_obj->total_shipping_tax_incl;
                        }
                        if (isset($mp_config['kbmp_enable_deduct_gift_wrapping_cost_order_handling']) && $mp_config['kbmp_enable_deduct_gift_wrapping_cost_order_handling'] == 0) {
                            $seller_earning += (int) $order_obj->total_wrapping_tax_incl;
                        }
                    }
                    $obj->admin_earning = 0;
                    $obj->seller_earning = $seller_earning;
                    $obj->total_earning = $seller_earning;
                }
                /* changes over*//* changes started by rishabh jain to edit the earning on order if cancelled */
                if ($is_canceled == '1') {
                    $seller_earning = 0;
                    if ($obj->can_handle_order == 1) {
                        $order_obj  = new Order($id_order);
                        if (isset($mp_config['kbmp_enable_deduct_shipping_cost_order_handling']) && $mp_config['kbmp_enable_deduct_shipping_cost_order_handling'] == 0) {
                            $seller_earning = (int) $order_obj->total_shipping_tax_incl;
                        }
                        if (isset($mp_config['kbmp_enable_deduct_gift_wrapping_cost_order_handling']) && $mp_config['kbmp_enable_deduct_gift_wrapping_cost_order_handling'] == 0) {
                            $seller_earning = (int) $order_obj->total_wrapping_tax_incl;
                        }
                    }
                    $obj->admin_earning = 0;
                    $obj->seller_earning = $seller_earning;
                    $obj->total_earning = $seller_earning;
                }
                /* changes over*/
                $obj->save();
                if ($is_canceled == '1') {
                    $this->actionSellerOrderCancellation($id_order, $seller_earning);
                }
                Hook::exec('actionKbMarketPlaceSEarningUpdate', array('object' => $obj));
            }
        }

        $seller_order_details = KbSellerOrderDetail::getDetailByOrderId($id_order);
        if ($seller_order_details && count($seller_order_details) > 0) {
            $earning = 0;
            foreach ($seller_order_details as $odr) {
                $obj = new KbSellerOrderDetail($odr['id_seller_order_detail']);
                $obj->is_canceled = $is_canceled;
                // change by rishabh jain
                if ($is_canceled == '1') {
                    $obj->admin_earning = $earning;
                    $obj->seller_earning = $earning;
                    $obj->total_earning = $earning;
                    $obj->commission_percent = $earning;
                }
                // changes over
                $obj->save();

                Hook::exec('actionKbMarketPlaceSOrderDetailUpdate', array('object' => $obj));
            }
        }
        
        /*
         * @author  - Rishabh Jain
         * DOC - 6th Mar 2020
         * Changes - To update the entry in membership order table if membership plan type products is ordered
         */
        $this->updateInfoIfMembershipTypeProduct($id_order);
        /*
         * changes over
         */
    }
    
    private function updateInfoIfMembershipTypeProduct($id_order)
    {
        $order_obj = new Order($id_order);
        $orders_by_reference = Order::getByReference($order_obj->reference);
        $orders = $orders_by_reference->getResults();
        $settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
        if ($orders && is_array($orders) && count($orders) > 0) {
            foreach ($orders as $order) {
                $id_membership_order = KbMemberShipPlanOrder::getMembershipOrdersIdByIdOrder($order_obj->id);
                $order_product_detail = $order->getProducts();
                if ($id_membership_order > 0) {
                    if ($order_product_detail && is_array($order_product_detail) && count($order_product_detail) > 0) {
                        foreach ($order_product_detail as $detail) {
                            $id_membership_plan = KbMpMemberShipPlan::isMemberShipPlanTypeProduct((int) $detail['product_id']);
                            if ($id_membership_plan > 0) {
                                $membership_plan_obj = new KbMpMemberShipPlan($id_membership_plan);
                                $kbmp_order_obj = new KbMemberShipPlanOrder($id_membership_order);
                                if ($kbmp_order_obj->is_paid == 0) {
                                    $order_state = $order_obj->getCurrentStateFull($this->context->language->id);
                                    if (isset($settings['kbmp_membership_plan_order_statuses']) && in_array($order_state['id_order_state'], $settings['kbmp_membership_plan_order_statuses'])) {
                                        $kbmp_order_obj->is_paid = 1;
                                        $kbmp_order_obj->status = 0;
                                    }
                                    $kbmp_order_obj->save();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
    public function actionSellerOrderCancellation($id_order, $seller_earning)
    {
        $order = new Order($id_order);
        $id_customization_array = array();
        $currency = new Currency((int) $order->id_currency);
        $seller_products      = array();
        $admin_products       = array();
        $order_product_detail = $order->getProducts();
        $invoice              = new Address($order->id_address_invoice);
        $delivery             = new Address($order->id_address_delivery);
        if ($order_product_detail && is_array($order_product_detail) && count($order_product_detail)
            > 0) {
            foreach ($order_product_detail as $detail) {
                $id_seller = (int) KbSellerProduct::getSellerIdByProductId((int) $detail['product_id']);
                if ($id_seller > 0) {
                    $seller_products[$id_seller][] = $detail;
                } else {
                    $admin_products[] = $detail;
                }
            }
        }

        foreach ($seller_products as $id_seller => $products) {
            $products_in_this_order = array();
            foreach ($products as $product) {
                $products_in_this_order[] = $product['product_id'];
            }
            $send_email = KbSellerSetting::getSellerSettingByKey(
                $id_seller,
                'kbmp_email_on_order_cancellation'
            );
            if ($send_email == 1) {
                $cart_products        = new Cart($order->id_cart);
                $product_list         = $cart_products->getProducts();
                $product_var_tpl_list = array();
                foreach ($product_list as $product) {
                    if (in_array(
                        $product['id_product'],
                        $products_in_this_order
                    ) && KbSellerProduct::isSellerProduct(
                        $id_seller,
                        (int) $product['id_product']
                    )) {
                        $price = Product::getPriceStatic(
                            (int) $product['id_product'],
                            false,
                            ($product['id_product_attribute'] ? (int) $product['id_product_attribute']
                                    : null),
                            6,
                            null,
                            false,
                            true,
                            $product['cart_quantity'],
                            false,
                            (int) $order->id_customer,
                            (int) $order->id_cart,
                            (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}
                        );

                        $price_wt = Product::getPriceStatic(
                            (int) $product['id_product'],
                            true,
                            ($product['id_product_attribute'] ? (int) $product['id_product_attribute']
                                    : null),
                            2,
                            null,
                            false,
                            true,
                            $product['cart_quantity'],
                            false,
                            (int) $order->id_customer,
                            (int) $order->id_cart,
                            (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')}
                        );

                        $product_price = Product::getTaxCalculationMethod()
                            == PS_TAX_EXC ? Tools::ps_round(
                                $price,
                                2
                            ) : $price_wt;

                        $product_var_tpl = array(
                            'reference' => $product['reference'],
                            'name' => $product['name'].(isset($product['attributes'])
                                    ? ' - '
                                .$product['attributes'] : ''),
                            'unit_price' => Tools::displayPrice(
                                $product_price,
                                $currency,
                                false
                            ),
                            'price' => Tools::displayPrice(
                                $product_price * $product['quantity'],
                                $currency,
                                false
                            ),
                            'quantity' => $product['quantity'],
                            'customization' => array()
                        );

                        $customized_datas = Product::getAllCustomizedDatas((int) $order->id_cart);
                        $id_protmp        = $product['id_product'];
                        $id_proattrtmp    = $product['id_product_attribute'];
                        if (isset($customized_datas[$id_protmp][$id_proattrtmp])) {
                            $product_var_tpl['customization'] = array();
                            $id_dl_add                        = $order->id_address_delivery;
                            $customized_datas_temp = $customized_datas[$id_protmp][$id_proattrtmp][$id_dl_add];
                            $is_custom_field_added = 0;
                            foreach ($customized_datas_temp as $id_customization => $customization) {
                                if (!in_array($id_customization, $id_customization_array) && $is_custom_field_added == 0) {
                                    $id_customization_array[] = $id_customization;
                                    $customization_text = '';
                                    if (isset($customization['datas'][Product::CUSTOMIZE_TEXTFIELD])) {
                                        foreach ($customization['datas'][Product::CUSTOMIZE_TEXTFIELD] as $text) {
                                            $customization_text .= $text['name'].': '
                                                .$text['value'].'<br />';
                                        }
                                    }

                                    if (isset($customization['datas'][Product::CUSTOMIZE_FILE])) {
                                        $customization_text .= sprintf(
                                            '%d image(s)',
                                            count($customization['datas'][Product::CUSTOMIZE_FILE])
                                        ).'<br />';
                                    }

                                    $customization_quantity = (int) $product['customization_quantity'];

                                    $product_var_tpl['customization'][] = array(
                                        'customization_text' => $customization_text,
                                        'customization_quantity' => $customization_quantity,
                                        'quantity' => Tools::displayPrice(
                                            $customization_quantity * $product_price,
                                            $currency,
                                            false
                                        )
                                    );
                                    $is_custom_field_added = 1;
                                }
                            }
                        }

                        $product_var_tpl_list[] = $product_var_tpl;
                    }
                } // end foreach ($products)

                $sellerObj         = new KbSeller($id_seller);
                $seller_info       = $sellerObj->getSellerInfo();
                $product_list_txt  = '';
                $product_list_html = '';
                if (count($product_var_tpl_list) > 0) {
                    $product_html_vars = array(
                        'products' => $product_var_tpl_list,
                        'total_paid' => Tools::displayPrice(
                            $order->total_paid_tax_incl,
                            $currency,
                            false
                        )
                    );
//                    $product_list_txt  = $this->getEmailTemplateContent(
//                        'order_conf_product_list.txt',
//                        Mail::TYPE_TEXT,
//                        $product_html_vars
//                    );
                    $product_list_html = $this->getEmailTemplateContent(
                        'order_conf_product_list.tpl',
                        Mail::TYPE_HTML,
                        $product_html_vars
                    );
                }
                // change
                $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                if (isset($mp_config['kbmp_seller_order_cancel_email_template'][$order->id_lang])) {
                    $l_id                 = $order->id_lang;
                    $email_order_template = $mp_config['kbmp_seller_order_cancel_email_template'][$l_id];
                    unset($l_id);
                } else {
                    $email_order_template = KbEmail::getOrderCancelEmailBaseTemplate();
                }

                /* Start-MK made changes on 28-05-18 for GDPR changes */
                $gdpr_setting = Tools::jsonDecode(Configuration::get('KB_MP_GDPR_SETTINGS'), true);
                /* changes by rishabh jain */
                $customer_obj = new Customer($order->id_customer);
                $customer_email = $customer_obj->email;
                if (!empty($gdpr_setting) && $gdpr_setting['enable_gdpr'] && !$gdpr_setting['enable_customer_id']) {
                    $customer_email = 'xxxx@xxx.com';
                }
                /* End-MK made changes on 28-05-18 for GDPR changes */
                
                $data = array(
                    '{seller_name}' => $seller_info['seller_name'],
                    '{firstname}' => $customer_obj->firstname,
                    '{lastname}' => $customer_obj->lastname,
                    '{email}' => $customer_email,
                    '{delivery_block_txt}' => $this->getFormatedAddress(
                        $delivery,
                        "\n"
                    ),
                    '{invoice_block_txt}' => $this->getFormatedAddress(
                        $invoice,
                        "\n"
                    ),
                    '{delivery_block_html}' => $this->getFormatedAddress(
                        $delivery,
                        '<br />',
                        array(
                            'firstname' => '<span style="font-weight:bold;">%s</span>',
                            'lastname' => '<span style="font-weight:bold;">%s</span>'
                        )
                    ),
                    '{invoice_block_html}' => $this->getFormatedAddress(
                        $invoice,
                        '<br />',
                        array(
                        'firstname' => '<span style="font-weight:bold;">%s</span>',
                        'lastname' => '<span style="font-weight:bold;">%s</span>'
                        )
                    ),
                    '{order_name}' => $order->getUniqReference(),
                    '{date}' => Tools::displayDate(date('Y-m-d H:i:s'), null, 1),
                    '{products}' => $product_list_html,
                    '{products_txt}' => $product_list_txt,
                );

                foreach ($data as $variable => $variable_val) {
                    $email_order_template = str_replace($variable, $variable_val, $email_order_template);
                }
                /*Start - MK made change on 30-05-18 to send notification based on the type*/
                $notification_emails = $sellerObj->getEmailIdForNotification();
                foreach ($notification_emails as $em) {
                    Mail::Send(
                        (int) $order->id_lang,
                        'kb_order_conf',
                        $this->l('An Order is just Cancelled'),
                        array('{order_data}' => $email_order_template),
                        $em['email'],
                        $em['title'],
                        null,
                        null,
                        null,
                        null,
                        _PS_MODULE_DIR_.'kbmarketplace/mails/',
                        false,
                        (int) $order->id_shop
                    );
                }
                /*End - MK made change on 30-05-18 to send notification based on the type*/
            }
        }
    }
    public function hookActionObjectOrderReturnUpdateAfter($param)
    {
        $order_return = $param['object'];

        if ($order_return->state == 5) {
            $order_return_details = OrderReturn::getOrdersReturnDetail($order_return->id);
            if (count($order_return_details) > 0) {
                foreach ($order_return_details as $return) {
                    $order_detail = new OrderDetail($return['id_order_detail']);
                    $seller_order_detail = KbSellerOrderDetail::getDetailByOrderItemId($order_detail->id);
                    if (count($seller_order_detail) > 0) {
                        $seller_order_detail_obj = new KbSellerOrderDetail(
                            $seller_order_detail['id_seller_order_detail']
                        );
                        $commission_percent = $seller_order_detail_obj->commission_percent;
                        $returned_qty = (int) $return['product_quantity'];
                        $amount_of_returned_qty = (float) ((int) $return['product_quantity'] * $seller_order_detail_obj->unit_price);

                        $reduce_admin_earning = (float) ((float) ($commission_percent / 100) * $amount_of_returned_qty);
                        $reduce_seller_earning = ($amount_of_returned_qty - $reduce_admin_earning);

                        $seller_order_detail_obj->total_earning = ($seller_order_detail_obj->total_earning - $amount_of_returned_qty);
                        $seller_order_detail_obj->seller_earning = ($seller_order_detail_obj->seller_earning - $reduce_seller_earning);
                        $seller_order_detail_obj->admin_earning = ($seller_order_detail_obj->admin_earning - $reduce_admin_earning);
                        $seller_order_detail_obj->qty = ($seller_order_detail_obj->qty - $returned_qty);

                        $seller_order_detail_obj->save();

                        Hook::exec(
                            'actionKbMarketPlaceSOrderDetailUpdate',
                            array('object' => $seller_order_detail_obj)
                        );

                        $prev_earning = KbSellerEarning::getEarningBySellerAndOrder(
                            $seller_order_detail_obj->id_seller,
                            $seller_order_detail_obj->id_order
                        );

                        if (count($prev_earning) > 0) {
                            $earnin_obj = new KbSellerEarning($prev_earning['id_seller_earning']);
                            $earnin_obj->product_count = $earnin_obj->product_count - $returned_qty;
                            $earnin_obj->total_earning = $earnin_obj->total_earning - $amount_of_returned_qty;
                            $earnin_obj->seller_earning = $earnin_obj->seller_earning - $reduce_seller_earning;
                            $earnin_obj->admin_earning = $earnin_obj->admin_earning - $reduce_admin_earning;

                            $earnin_obj->save();
                            Hook::exec('actionKbMarketPlaceSEarningUpdate', array('object' => $earnin_obj));
                        }
                    }
                }
            }
        }
    }

    public function hookActionCarrierUpdate($params = null)
    {
        $new_carrier = $params['carrier'];

        if ($id_seller_shipping = KbSellerShipping::getIdByReference($new_carrier->id_reference)) {
            $seller_shipping = new KbSellerShipping($id_seller_shipping);
            $seller_shipping->id_carrier = $new_carrier->id;
            if ($seller_shipping->is_default_shipping && !$new_carrier->is_free) {
                $new_carrier->is_free = 1;
                $new_carrier->update();
                $new_carrier->deleteDeliveryPrice('range_weight');
                $new_carrier->deleteDeliveryPrice('range_price');
            }
            $seller_shipping->save();
        }
    }

    public function hookActionDispatcher($params = null)
    {
        $controller = $params['controller_class'];
        if ($controller == 'AdminCarriersController' || $controller == 'AdminCarrierWizardController') {
            if (Tools::getIsset('id_carrier')) {
                $carrier = new Carrier(Tools::getValue('id_carrier'));
                if (KbSellerShipping::getIdByReference($carrier->id_reference)) {
                    $this->context->cookie->kbcarrierredirect = 1;
                    Tools::redirectAdmin($this->context->link->getAdminLink('AdminCarriers'));
                }
            }

            if (isset($_REQUEST['submitBulkenableSelectioncarrier']) || Tools::getValue('submitBulkdeletecarrier') == "") {
                $carrier_boxes = Tools::getValue('carrierBox');
                if (!empty($carrier_boxes)) {
                    foreach ($carrier_boxes as $carrier_box) {
                        $carrier = new Carrier($carrier_box);
                        if (KbSellerShipping::getIdByReference($carrier->id_reference)) {
                            $this->context->cookie->kbcarrierredirect = 1;
                            Tools::redirectAdmin($this->context->link->getAdminLink('AdminCarriers'));
                        }
                    }
                }
            } else {
                $id_carrier = (int) Tools::getValue('id_carrier', 0);
                $carrier = new Carrier($id_carrier);
                if (KbSellerShipping::getIdByReference($carrier->id_reference)) {
                    $this->context->cookie->kbcarrierredirect = 1;
                    Tools::redirectAdmin($this->context->link->getAdminLink('AdminCarriers'));
                }
            }
        }
    }

    public function hookDisplayMyAccountBlock()
    {
        $show_registration_link = KbGlobal::getGlobalSettingByKey('kbmp_seller_registration');
        if (Configuration::get('KB_MARKETPLACE') !== false &&
                Configuration::get('KB_MARKETPLACE') == 1 &&
                $show_registration_link) {
            $title = $this->l('Become a seller', 'kbconfiguration');
            $html = '<li>';
            if ($this->context->customer->logged) {
                $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                $context = $this->context;
                if (!empty($mp_config['kbmp_seller_agreement']) &&
                        isset($mp_config['kbmp_seller_agreement'][$context->language->id]) &&
                        !empty($mp_config['kbmp_seller_agreement'][$context->language->id])) {
                    $kb_seller_agree = $mp_config['kbmp_seller_agreement'][$context->language->id];
                    $context->smarty->assign(
                        array('kb_seller_agreement' =>
                            Tools::htmlentitiesDecodeUTF8(
                                $mp_config['kbmp_seller_agreement'][$context->language->id]
                            )
                        )
                    );
                } else {
                    $context->smarty->assign(
                        array('kb_seller_agreement' => '')
                    );
                }
                $link_to_register = $this->context->link->getPageLink(
                    'my-account',
                    (bool) Configuration::get('PS_SSL_ENABLED'),
                    null,
                    array('register_as_seller' => 1)
                );
                $this->context->smarty->assign('link_to_register', $link_to_register);
//                print_r(KbSeller::getSellerByCustomerId((int)$this->context->customer->id));die;
                if (KbSeller::getSellerByCustomerId((int) $this->context->customer->id)) {
                    $menu = KbSellerMenu::getMenusByModuleAndController(
                        'kbmarketplace',
                        'dashboard',
                        $this->context->language->id
                    );
                    $url = $this->context->link->getModuleLink(
                        $menu['module_name'],
                        $menu['controller_name'],
                        array(),
                        (bool) Configuration::get('PS_SSL_ENABLED')
                    );
                    $html .= '<a href="' . $url . '" >' .
                            $this->l('My seller account', 'kbconfiguration') .
                            '</a>';
                } else {
                    $url = $this->context->link->getPageLink(
                        'my-account',
                        (bool) Configuration::get('PS_SSL_ENABLED'),
                        null,
                        array('register_as_seller' => 1)
                    );
                    if (isset($kb_seller_agree) && !empty($kb_seller_agree)) {
                        $html .= $this->context->smarty->fetch(
                            _PS_MODULE_DIR_ . 'kbmarketplace/views/templates/hook/seller_footer_link.tpl'
                        );
                    } else {
                        $html .= '<a href="javascript:void(0)" onclick="if(confirm(\'' .
                                $this->l('Are you sure?', 'kbconfiguration') . '\')){ location.href ='
                                . ' $(this).attr(\'data-href\');}" data-href='
                                . '"' . $url . '">' . $title . '</a>';
                    }
                }
            } else {
                $url = $this->context->link->getPageLink(
                    'my-account',
                    (bool) Configuration::get('PS_SSL_ENABLED'),
                    null,
                    array()
                );
                $html .= '<a href="' . $url . '" >' . $title . '</a>';
            }
            $html .= '</li>';
            return $html;
        }
        return '';
    }

    public function hookDisplayKBLeftColumn()
    {
        $template_path = _PS_MODULE_DIR_ . 'kbmarketplace/views/templates/front/menus.tpl';
        $menus = array();

        $seller_obj = new KbSeller(KbSeller::getSellerByCustomerId((int) $this->context->customer->id));
        if (!$seller_obj->isSeller()) {
            Tools::redirect(
                $this->context->link->getPageLink(
                    'my-account',
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
        }
        $seller_menus = $this->getSellerMenus();
        foreach (KbSellerMenu::getAllMenus($this->context->language->id) as $menu) {
            $active = false;
            if ($menu['controller_name'] == $this->context->controller->controller_name) {
                $active = true;
            }
            $badge_html = false;

            if ($menu['controller_name'] == 'productreview') {
                if (!Module::isInstalled('productcomments')) {
                    $menu['badge_class'] = '';
                }
            }

            if ($menu['show_badge'] == 1 && !empty($menu['badge_class'])) {
                $class_name = ucwords($menu['badge_class']);
                if (!class_exists($class_name)) {
                    require_once _PS_MODULE_DIR_ . $menu['module_name'] . '/classes/' . $class_name . '.php';
                }
                $menu_obj = new $class_name();
                if (method_exists($menu_obj, 'getMenuBadgeHtml')) {
                    $badge_html = $menu_obj->getMenuBadgeHtml($seller_obj->id);
                }
            }
            if (isset($seller_menus[$menu['controller_name']]['label'])) {
                $label = $this->l($seller_menus[$menu['controller_name']]['label'], 'kbconfiguration');
                $title = $this->l($seller_menus[$menu['controller_name']]['title'], 'kbconfiguration');
            } else {
                $label = $this->l($menu['label']);
                $title = $this->l($menu['title']);
            }
            $menus[] = array(
                'label' => $label,
                'icon_class' => $menu['icon'],
                'css_class' => $menu['css_class'],
                'title' => $title,
                'active' => $active,
                'badge' => $badge_html,
                'href' => $this->context->link->getModuleLink(
                    $menu['module_name'],
                    $menu['controller_name'],
                    array(),
                    (bool) Configuration::get('PS_SSL_ENABLED')
                )
            );
        }
        if (Module::isInstalled('kbbookingcalendar') && Module::isEnabled('kbbookingcalendar')) {
            $kb_setting = Tools::jsonDecode(Configuration::get('KB_BOOKING_CALENDAR_GENERAL_SETTING'), true);
            $is_available_booking_calender_tab = 0;
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
//            print_r($mp_config);
//            die;
            if (!empty($kb_setting) && $kb_setting['enable']) {
                if (isset($mp_config['enable_booking_calender_compatibility']) && $mp_config['enable_booking_calender_compatibility'] == 1) {
                    $is_available_booking_calender_tab = 1;
                }
            }
            if ($is_available_booking_calender_tab) {
                $menu_obj = new KbSellerProduct();
                $badge_html = false;
                $active_product = false;
                if (method_exists($menu_obj, 'getMenuBadgeHtmlBookingProducts')) {
                    $badge_html = $menu_obj->getMenuBadgeHtmlBookingProducts($seller_obj->id);
                }
                if ($this->context->controller->controller_name == 'kbbookingproduct') {
                    $active_product = true;
                }
                $active_price_rule = false;
                if ($this->context->controller->controller_name == 'kbbookingproductpricerules') {
                    $active_price_rule = true;
                }
                $menus[] = array(
                    'label' => $this->l('Booking Products', 'kbconfiguration'),
                    'icon_class' => '&#xe8ef;',
                    'css_class' => 0,
                    'active' => $active_product,
                    'badge' => $badge_html,
                    'title' => $this->l('Booking Products', 'kbconfiguration'),
                    'href' => $this->context->link->getModuleLink(
                        $this->name,
                        'kbbookingproduct',
                        array(),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    )
                );
                $menus[] = array(
                    'label' => $this->l('Booking Price Rules', 'kbconfiguration'),
                    'icon_class' => '&#xe53e;',
                    'title' => $this->l('Booking Price Rules', 'kbconfiguration'),
                    'css_class' => 0,
                    'active' => $active_price_rule,
                    'badge' => false,
                    'href' => $this->context->link->getModuleLink(
                        $this->name,
                        'kbbookingproductpricerules',
                        array(),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    )
                );
            }
        }
        
        $active_membership = false;
        if ($this->context->controller->controller_name == 'membershipplans') {
            $active_membership = true;
        }
        
        $is_available_membership_plan = 0;
        $membership_settings = array();
        if (Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING')) {
            $membership_settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG_MEMBERSHIP_SETTING'));
        }
        $is_available_membership_plan = 0;
        if (isset($membership_settings['kbmp_enable_membership_plan']) && $membership_settings['kbmp_enable_membership_plan'] == 1) {
            $is_available_membership_plan = 1;
        }

        if ($is_available_membership_plan) {
            $menus[] = array(
                'label' => $this->l('Membership Plan History'),
                'icon_class' => '&#xe8ef;',
                'css_class' => 0,
                'active' => $active_membership,
                'badge' => false,
                'title' => $this->l('Membership Plan History'),
                'href' => $this->context->link->getModuleLink(
                    $this->name,
                    'membershipplandetail',
                    array(),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                )
            );
            $menus[] = array(
                'label' => $this->l('Available Membership Plans'),
                'icon_class' => '&#xe53e;',
                'css_class' => 0,
                'active' => false,
                'badge' => false,
                'title' => $this->l('Available Membership Plans'),
                'href' => $this->context->link->getModuleLink(
                    $this->name,
                    'membershipplans',
                    array(),
                    (bool)Configuration::get('PS_SSL_ENABLED')
                )
            );
        }
        if (Module::isInstalled('returnmanager') && Module::isEnabled('returnmanager')) {
            $is_available_return_manager_tab = 0;
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            $return_manager_config = Tools::unserialize(Configuration::get('VELSOF_RETURNMANAGER'));
            if (isset($return_manager_config['enable']) && $return_manager_config['enable'] == 1) {
                if (isset($mp_config['enable_return_manager_compatibility']) && $mp_config['enable_return_manager_compatibility'] == 1) {
                    $is_available_return_manager_tab = 1;
                }
            }
            $return_page = false;
            $class = '';
            if (isset($this->context->controller->module->name) && $this->context->controller->module->name == 'kbmarketplace') {
                if (isset($this->context->controller->controller_name) && ($this->context->controller->controller_name == 'returnrequest' || $this->context->controller->controller_name == 'seller')) {
                    $return_page = true;
                    $class = 'kb-active-menuitem';
                }
            }
            if ($is_available_return_manager_tab) {
                $menus[] = array(
                    'label' => $this->l('Return Requests'),
                    'icon_class' => 'assignment_returned',
                    'title' => $this->l('Return Requests'),
                    'css_class' => $class,
                    'title' => $title,
                    'active' => $return_page,
                    'badge' => '',
                    'href' => $this->context->link->getModuleLink(
                        $this->name,
                        'returnrequest',
                        array(),
                        (bool)Configuration::get('PS_SSL_ENABLED')
                    )
                );
            }
        }
        
        $this->context->smarty->assign('menus', $menus);
        return $this->context->smarty->fetch($template_path);
    }

    public function hookActionObjectLanguageAddAfter($params)
    {
        $language = $params['object'];
        if ($language->id > 0) {
//            $this->unInstallMarketPlaceTabs();
//            $this->installMarketPlaceTabs();
            $menus = $this->getSellerMenus();
            foreach ($menus as $key => $val) {
                if ($id_seller_menu = KbSellerMenu::getMenuIdByModuleAndController('kbmarketplace', $key)) {
                    $menu_obj = new KbSellerMenu($id_seller_menu);
                    if (Validate::isLoadedObject($menu_obj)) {
                        $where = 'id_seller_menu = ' . (int) $menu_obj->id
                                . ' AND id_lang = ' . (int) $language->id;
                        $exist = 'SELECT COUNT(*) FROM ' . _DB_PREFIX_ . 'kb_mp_seller_menu'
                                . '_lang WHERE ' . $where;
                        $label = '';
                        $title = '';
                        if ($this->getModuleTranslationByLanguage('kbmarketplace', $val['label'], 'kbconfiguration', $language->iso_code) != '') {
                            $label = $this->getModuleTranslationByLanguage('kbmarketplace', $val['label'], 'kbconfiguration', $language->iso_code);
                        } else {
                            $label = $val['label'];
                        }
                        if ($this->getModuleTranslationByLanguage('kbmarketplace', $val['title'], 'kbconfiguration', $language->iso_code) != '') {
                            $title = $this->getModuleTranslationByLanguage('kbmarketplace', $val['title'], 'kbconfiguration', $language->iso_code);
                        } else {
                            $title = $val['label'];
                        }
                        $field = array(
                            'id_seller_menu' => (int) $menu_obj->id,
                            'id_lang' => (int) $language->id,
                            'label' => pSQL($label),
                            'title' => pSQL($title)
                        );
                        if (Db::getInstance()->getValue($exist)) {
                            Db::getInstance()->update(
                                'kb_mp_seller_menu_lang',
                                $field,
                                $where
                            );
                        } else {
                            Db::getInstance()->insert(
                                'kb_mp_seller_menu_lang',
                                $field
                            );
                        }
                    }
                }
            }

            $templates = $this->getEmailTemplateData();
            foreach ($templates as $key => $val) {
                if ($id_email_template = KbEmail::getTemplateIdByName($key)) {
                    $email_obj = new KbEmail($id_email_template);
                    if (Validate::isLoadedObject($email_obj)) {
                        $where = 'id_email_template = ' . (int) $email_obj->id
                                . ' AND id_lang = ' . (int) $language->id;
                        $exist = 'SELECT COUNT(*) FROM ' . pSQL(_DB_PREFIX_ . 'kb_mp_email_template')
                                . '_lang WHERE ' . $where;
                        $field = array(
                            'id_email_template' => (int) $email_obj->id,
                            'id_lang' => (int) $language->id,
                            'subject' => pSQL($val['subject']),
                            'body' => pSQL($val['body'])
                        );
                        if (Db::getInstance()->getValue($exist)) {
                            Db::getInstance()->update(
                                'kb_mp_email_template_lang',
                                $field,
                                $where
                            );
                        } else {
                            Db::getInstance()->insert(
                                'kb_mp_email_template_lang',
                                $field
                            );
                        }
                    }
                }
            }

            $sellers = KbSeller::getAllSellers();
            foreach ($sellers as $row) {
                $obj = new KbSeller($row['id_seller']);
                if (Validate::isLoadedObject($obj)) {
                    $where = 'id_seller = ' . (int) $obj->id
                            . ' AND id_lang = ' . (int) $language->id;
                    $exist = 'SELECT COUNT(*) FROM ' . _DB_PREFIX_ . 'kb_mp_seller'
                            . '_lang WHERE ' . $where;
                    $field = array(
                        'id_seller' => (int) $obj->id,
                        'id_lang' => (int) $language->id,
                        'title' => pSQL(@$obj->title[$row['id_default_lang']]),
                        'description' => pSQL(@$obj->description[$row['id_default_lang']]),
                        'meta_keyword' => pSQL(@$obj->meta_keyword[$row['id_default_lang']]),
                        'meta_description' => pSQL((@$obj->meta_description[$row['id_default_lang']])),
                        'return_policy' => pSQL(@$obj->return_policy[$row['id_default_lang']]),
                        'shipping_policy' => pSQL(@$obj->shipping_policy[$row['id_default_lang']]),
                    );
                    if (Db::getInstance()->getValue($exist)) {
                        Db::getInstance()->update(
                            'kb_mp_seller_lang',
                            $field,
                            $where
                        );
                    } else {
                        Db::getInstance()->insert(
                            'kb_mp_seller_lang',
                            $field
                        );
                    }
                }
            }
        }
    }

    public function hookActionObjectLanguageDeleteAfter($params)
    {
        $language = $params['object'];
        if ($language->id > 0) {
            $this->unInstallMarketPlaceTabs();
            $this->installMarketPlaceTabs();
            //Delete Marketplace menus
            $id_parent_tab = (int) Tab::getIdFromClassName(self::PARENT_TAB_CLASS);
            if ($id_parent_tab > 0) {
                $child_tabs = Tab::getTabs($language->id, $id_parent_tab);
                if ($child_tabs && count($child_tabs) > 0) {
                    foreach ($child_tabs as $tab) {
                        $cond = 'id_tab = ' . (int) $tab['id_tab']
                                . ' AND id_lang = ' . (int) $language->id;
                        Db::getInstance()->delete(
                            'tab_lang',
                            $cond
                        );
                    }
                }
                $cond = 'id_tab = ' . (int) $id_parent_tab
                        . ' AND id_lang = ' . (int) $language->id;
                Db::getInstance()->delete(
                    'tab_lang',
                    $cond
                );
            }

            $menus = $this->getSellerMenus();
            foreach ($menus as $key => $val) {
                $tmp = $val;
                unset($tmp);
                if ($id_seller_menu = KbSellerMenu::getMenuIdByModuleAndController('kbmarketplace', $key)) {
                    $menu_obj = new KbSellerMenu($id_seller_menu);
                    if (Validate::isLoadedObject($menu_obj)) {
                        $cond = 'id_seller_menu = ' . (int) $menu_obj->id
                                . ' AND id_lang = ' . (int) $language->id;
                        Db::getInstance()->delete(
                            'kb_mp_seller_menu_lang',
                            $cond
                        );
                    }
                }
            }

            $templates = $this->getEmailTemplateData();
            foreach ($templates as $key => $val) {
                if ($id_email_template = KbEmail::getTemplateIdByName($key)) {
                    $email_obj = new KbEmail($id_email_template);
                    if (Validate::isLoadedObject($email_obj)) {
                        $cond = 'id_email_template = ' . (int) $email_obj->id
                                . ' AND id_lang = ' . (int) $language->id;
                        Db::getInstance()->delete(
                            'kb_mp_email_template_lang',
                            $cond
                        );
                    }
                }
            }

            $sellers = KbSeller::getAllSellers();
            foreach ($sellers as $row) {
                $obj = new KbSeller($row['id_seller']);
                if (Validate::isLoadedObject($obj)) {
                    $cond = 'id_seller = ' . (int) $obj->id
                            . ' AND id_lang = ' . (int) $language->id;
                    Db::getInstance()->delete(
                        'kb_mp_seller_lang',
                        $cond
                    );
                }
            }
        }
    }
    
    public static function kbUserInfo()
    {
        $user_ip = '';
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
                $addr = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
                $user_ip = trim($addr[0]);
            } else {
                $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        } else {
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }
        
        
        return array(
            'user_agent' =>  $_SERVER['HTTP_USER_AGENT'],
            'remote_address' => $user_ip,
        );
    }
    //changes by gopi 
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
    //change end
    //changes by vishal for custon change
    protected function saveNewPayoutRequest($seller_id, $payout_amount, $orderId)
    {
        
        
        $paypal_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
        if (isset($paypal_setting['enable_automatic_payout']) && $paypal_setting['enable_automatic_payout'] == 1) {
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
        $request_obj->comment = $this->l('Automatically generated by CRON', 'cron');
        $request_obj->approved = "0";
        $request_obj->admin_comment = '';


        
        
        if ($request_obj->save()) {
            
            $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
            $handle = fopen($file, 'a+');
            fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
            fwrite($handle,'Order Id #'.print_r($orderId,TRUE).' , Payout Request Amount generated : Yes ,  Amount Of Payout Request :'.print_r($amount_request,TRUE).', Payout ID :'.print_r($request_obj->id,TRUE));
            fwrite($handle,"\r\n");
            fclose($handle);
            
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
                                
                $trans_comment = $this->l('Auto Approval through cron', 'cron');
                $seller_email = $seller_data['email'];
                $seller_name = $seller_data['customer_name'];
                $payment_info = unserialize($seller_data['payment_info']);
                $paypal_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
                if (empty($paypal_setting)) {
                    
                    $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                    $handle = fopen($file, 'a+');
                    fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                    fwrite($handle,'Order Id #'.print_r($orderId,TRUE).' , Seller ID  : '.print_r($kbPayoutRequest->id_seller,TRUE).' ,  Paypal Configuration is empty ');
                    fwrite($handle,"\r\n");
                    fclose($handle);
                    //$this->context->cookie->kb_redirect_error = $this->l('Paypal Configuration is empty.', 'cron');
                } elseif (!$paypal_setting['enable']) {
                    
                    $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                    $handle = fopen($file, 'a+');
                    fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                    fwrite($handle,'Order Id #'.print_r($orderId,TRUE).' , Seller ID  : '.print_r($kbPayoutRequest->id_seller,TRUE).' ,  Paypal Configuration is disabled ');
                    fwrite($handle,"\r\n");
                    fclose($handle);
                   // $this->context->cookie->kb_redirect_success = $this->l('Paypal Configuration is disabled.', 'cron');
                }
                if (!empty($payment_info)) {
                    if ($payment_info['name'] == 'kbpaypal') {
                        
                        $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                        $handle = fopen($file, 'a+');
                        fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                        fwrite($handle,'Order Id #'.print_r($orderId,TRUE).' , Seller ID  : '.print_r($kbPayoutRequest->id_seller,TRUE).' ,  Seller PayPalAccount Exist : Yes ');
                        fwrite($handle,"\r\n");
                        fclose($handle);
                        
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
                       
                        
//                        $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
//                        $handle = fopen($file, 'a+');
//                        fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
//                        fwrite($handle,'Order Id #'.print_r($order->id,TRUE).' , Paypal response : ' . print_r($request,TRUE)  . "\r\n");
//                        fclose($handle);
                        
                        /* Start-MK made changes on 27-08-18 to update the process of payout transaction */
                        if (isset($request->_propMap)) {
                            $is_approved = '0';
                            $transaction_id = '';
                            if (isset($request->_propMap['transaction_id'])) {
                                $transaction_id = $request->_propMap['transaction_id'];
                                $is_approved = '1';
                                
                                $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                                $handle = fopen($file, 'a+');
                                fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                                fwrite($handle,'Order Id #'.print_r($orderId,TRUE).' , Transection : Suceess , Transection Id :' . print_r($transaction_id,TRUE)  . "\r\n");
                                fclose($handle);
                                
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
                                       // $this->context->cookie->kb_redirect_success = $this->l('Transaction successfully approved.', 'cron');
                                    }
                                } else {
                                    if ($request->_propMap['transaction_status'] == 'PENDING') {
                                        
                                        $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                                        $handle = fopen($file, 'a+');
                                        fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                                        fwrite($handle,'Order Id #'.print_r($orderId,TRUE).' , Transection : PENDING');
                                        fwrite($handle,"\r\n");
                                        fclose($handle);
                                        
                                       // $this->context->cookie->kb_redirect_success = $this->l('Transaction is pending.', 'cron');
                                    } elseif ($request->_propMap['transaction_status'] == 'SUCCESS') {
                                        $kbPayoutRequest->approved = '1';
                                        $kbPayoutRequest->update();
                                       // $this->context->cookie->kb_redirect_success = $this->l('Transaction is completed.', 'cron');
                                    } elseif ($request->_propMap['transaction_status'] == 'DENIED') {
                                        $kbPayoutRequest->approved = '2';
                                        
                                        $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                                        $handle = fopen($file, 'a+');
                                        fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                                        fwrite($handle,'Order Id #'.print_r($orderId,TRUE).' , Transection : DENIED');
                                        fwrite($handle,"\r\n");
                                        fclose($handle);
                                        
                                        $kbPayoutRequest->update();
                                       // $this->context->cookie->kb_redirect_error = $this->l('Transaction is denied.', 'cron');
                                    }
                                }
                            } else {
                                
                                $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                                $handle = fopen($file, 'a+');
                                fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                                fwrite($handle,'Order Id #'.print_r($orderId,TRUE).' , Transection : Failed');
                                fwrite($handle,"\r\n");
                                fclose($handle);
                                
                               // $this->context->cookie->kb_redirect_error = $this->l('Transaction failed.', 'cron');
                            }
                        } else {
                                $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                                $handle = fopen($file, 'a+');
                                fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                                fwrite($handle,'Order Id #'.print_r($orderId,TRUE).' , Transection : Failed');
                                fwrite($handle,"\r\n");
                                fclose($handle);
                            //$this->context->cookie->kb_redirect_error = $this->l('Transaction failed.', 'cron');
                        }
                        
                        /* End-MK made changes on 27-08-18 to update the process of payout transaction */
                    } else {
                        //$this->context->cookie->kb_redirect_error = $this->l('Transaction cannot be proceed', 'cron');
                    }
                } else {
                    $file = _PS_MODULE_DIR_.'kbmarketplace/order_auto_payment_log.txt';
                    $handle = fopen($file, 'a+');
                    fwrite($handle, date('Y-m-d G:i:s'). "\r\n");
                    fwrite($handle,'Order Id #'.print_r($orderId,TRUE).' , Seller ID  : '.print_r($kbPayoutRequest->id_seller,TRUE).' ,  Seller PayPalAccount Exist : No ');
                    fwrite($handle,"\r\n");
                    fclose($handle);
                    
                    //$this->context->cookie->kb_redirect_error = $this->l('No Payout Information found for the Seller.', 'cron');
                }
            }
            
        }
        return true;
    }
    }
    //changes end
}
