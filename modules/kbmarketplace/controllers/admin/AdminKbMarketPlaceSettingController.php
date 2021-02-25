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

require_once dirname(__FILE__).'/AdminKbMarketplaceCoreController.php';
require_once(_PS_MODULE_DIR_.'kbmarketplace/libraries/kbmarketplace/KbGlobal.php');

class AdminKbMarketPlaceSettingController extends AdminKbMarketplaceCoreController
{

    public function __construct()
    {
        $this->table   = 'kb_mp_seller_config';
        $this->display = 'edit';
        parent::__construct();
        /* changes started by rishabh jain */
        $payment_methods = array(
            0 => array(
                'id' => 'bankwire',
                'name' =>$this->module->l('Bank Wire', 'adminkbmarketplacesettingcontroller'),
            ),
            1 => array(
                'id' => 'check',
                'name' => $this->module->l('Payment by Cheque', 'adminkbmarketplacesettingcontroller'),
            ),
            2 => array(
                'id' => 'kbpaypal',
                'name' => $this->module->l('Payment by PayPal', 'adminkbmarketplacesettingcontroller'),
            )
        );
        $kb_payout_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
        if (empty($kb_payout_setting)) {
            unset($payment_methods['kbpaypal']);
        } elseif (!$kb_payout_setting['enable']) {
            unset($payment_methods['kbpaypal']);
        }
        
        $allowed_payment_methods = array(
            'type' => 'select',
            'label' => $this->l('Payment methods allowed'), // The <label> for this <select> tag.
            'multiple' => true,
            'class' => 'chosen',
            'required' => true,
            'hint' => $this->l('Select allowed payment methods for Seller'),
            'name' => 'allowed_payment_methods[]', // The content of the 'id' attribute of the <select> tag.
            'options' => array(
                'query'=> $payment_methods,
                'id' =>  'id',
                'name'=>  'name'
            )
        );
        /* changes over */
        /* changes by rishabh jain
         * to add option to select the orders stautuses for which the order would be marked as cancelled
         */
        $orderStatuses = array();
        $statuses = OrderState::getOrderStates((int)Context::getContext()->language->id);
        foreach ($statuses as $status) {
            $orderStatuses[] = array(
                'id_option' => $status['id_order_state'],
                'name' => $status['name']
            );
        }
        /* changes over */
        $this->fields_form = array(
            'tinymce' => true,
            'input' => array(
                array(
                    'type' => 'text',
                    'suffix' => '%',
                    'label' => $this->module->l('Default Commission', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_default_commission',
                    'required' => true,
                    'validation' => 'isPercentage',
                    'class' => 'fixed-width-xs',
                    'hint' => $this->module->l('Only numerical or decimal values are allowed', 'adminkbmarketplacesettingcontroller'),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->module->l('Approval Request Limit', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_approval_request_limit',
                    'required' => true,
                    'validation' => 'isInt',
                    'class' => 'fixed-width-xs',
                    'hint' => $this->module->l('Only Numeric values are allowed', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('Maximum number of request seller can make for approving account after disapproving. This limit will be set for seller after registration with his account and cannot be changed later.', 'adminkbmarketplacesettingcontroller')
                ),
                $allowed_payment_methods,
                array(
                    'type' => 'text',
                    'label' => $this->module->l('New Product Limit', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_product_limit',
                    'required' => true,
                    'validation' => 'isInt',
                    'class' => 'fixed-width-xs',
                    'hint' => $this->module->l('Only Numeric values are allowed', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('After this limit, seller cannot add new products until he/she will not be approved by you.', 'adminkbmarketplacesettingcontroller'),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable Seller Registration', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_seller_registration',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'seller_registration_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'seller_registration_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Allow new or existing (who is not seller), customer to register as seller on store', 'adminkbmarketplacesettingcontroller')
                ),
                // changes by rishabh jain for separte registration form
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable Separate Seller Registration Form', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_seller_separate_registration_form',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_seller_separate_registration_form_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_seller_separate_registration_form_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Will create a separate registartion form along with the enabled custom fields.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Show Shop Title Field in separate registration form', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_shop_title',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_shop_title_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_shop_title_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If enabled then shop title field will be displayed in the seller registration form.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Show Seller contact number Field in separate registration form', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_seller_contact_number',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_seller_contact_number_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_seller_contact_number_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If enabled then Seller contact number field will be displayed in the seller registration form.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Show Seller Country Field in separate registration form', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_seller_country',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_seller_country_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_seller_country_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If enabled then Seller Country field will be displayed in the seller registration form.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Show Seller City Field in separate registration form', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_seller_city',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_seller_city_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_seller_city_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If enabled then seller city field will be displayed in the seller registration form.', 'adminkbmarketplacesettingcontroller')
                ),
                // changes over
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('New Product Approval Required', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_new_product_approval_required',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'new_product_approval_required_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'new_product_approval_required_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('New product needs approval from your side before display on front.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Send email to seller on order place', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_email_on_new_order',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'email_on_new_order_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'email_on_new_order_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('With this setting, system will send email to seller on new order', 'adminkbmarketplacesettingcontroller')
                ),
                /* Boc by rishabh jain
                 * to add option for sending order cancellation email
                 */
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Send email to seller on order Cancellation', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_email_on_order_cancellation',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'kbmp_email_on_order_cancellation_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'kbmp_email_on_order_cancellation_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('With this setting, system will send email to seller on new order', 'adminkbmarketplacesettingcontroller')
                ),
                /* eoc*/
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable Seller Review', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_enable_seller_review',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_seller_review_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_seller_review_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Enable customers to give his reviews on seller.', 'adminkbmarketplacesettingcontroller')
                ),
                
                /* Changes started by rishabh on 15th Oct 2018
                 * to add an option to enable /disable  custom feature addition functionality of product
                 */
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable/Disable Custom Product features addition', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_enable_custom_features_addition',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_custom_product_features_addition_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_custom_product_features_addition_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Allow Sellers to add custom fetaures of Products.', 'adminkbmarketplacesettingcontroller')
                ),
                /* Changes over */
                /* Changes started by rishabh on 15th Oct 2018
                 * to add an option to enable /disable  custom feature addition functionality of product
                 */
                
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Allow Seller to add customized Products', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'enable_custom_product_addition',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_custom_product_addition_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_custom_product_addition_on',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Allow Seller to add customizable fields for Products.', 'adminkbmarketplacesettingcontroller')
                ),
                /* Changes over */
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable/Disable Maufacturer add option', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'enable_custom_manufacturer_addition',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_custom_manufacturer_addition_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_custom_manufacturer_addition_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Allow Sellers to add new maufacturers.', 'adminkbmarketplacesettingcontroller')
                ),
                //changes by vishal for custom change
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable paypal automatic transfer', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'paypal_automatic_transfer',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'paypal_automatic_transfer_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'paypal_automatic_transfer_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Allow automatic paypal amount transfer to seller on order confirmation', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'select',
                    'multiple' => true,
                    'class' => 'chosen',
                    'label' => $this->l('Select Status for Automatic paypal transfer'),
                    'hint' => $this->l('Select order status for which the amount is automatic tarnsferred'),
                    'desc' => $this->l('Select order status for which the amount is automatic tarnsferred'),
                    'name' => 'order_automatic_transfer_statuses[]',
                    'required' => true,
                    'options' => array(
                        'query' => $orderStatuses,
                        'id' => 'id_option',
                        'name' => 'name'
                    )
                ),
                //changes end
                /* Changes over */
                /* Changes started by rishabh on 15th Oct 2018
                 * to add an option to Enable/Disable supplier add option functionality of product
                 */
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable/Disable Supplier add option', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'enable_custom_supplier_addition',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_custom_supplier_addition_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_custom_supplier_addition_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Allow Sellers to add new suppliers.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'select',
                    'multiple' => true,
                    'class' => 'chosen',
                    'label' => $this->l('Select Status for order cancellation'),
                    'hint' => $this->l('Select order status for which the order would be marked as cancelled'),
                    'desc' => $this->l('Select order status for which the order would be marked as cancelled'),
                    'name' => 'order_return_statuses[]',
                    'required' => true,
                    'options' => array(
                        'query' => $orderStatuses,
                        'id' => 'id_option',
                        'name' => 'name'
                    )
                ),
                /* Changes over */
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable/Disable Seller shortlisting functionality', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'enable_seller_shortlisting',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_seller_shortlisting_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_seller_shortlisting_on',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('If enabled, Shortlisting seller link will be displayed on seller product page and seller details Page.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable/Disable Knowband Return Manager Module Compatibility', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'enable_return_manager_compatibility',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_return_manager_compatibility_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_return_manager_compatibility_on',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Allow Sellers to manage return request on their products.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Allow Seller To create new Return Policy', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'enable_return_manager_policy_addition',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_return_manager_policy_addition_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_return_manager_policy_addition_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Allow Sellers to add new Return Policy.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable/Disable Knowband Booking Calender Module Compatibility', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'enable_booking_calender_compatibility',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_booking_calender_compatibility_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_booking_calender_compatibility_on',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Allow Sellers to manage add booking products and create price rules on their product.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable/Disable Knowband Product Availability by zipcode Module Compatibility', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'enable_product_avaialability_compatibility',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_product_avaialability_compatibility_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_product_avaialability_compatibility_on',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Allow Sellers to manage product availability on their products..', 'adminkbmarketplacesettingcontroller')
                ),
                /* Changes started by rishabh on 5th sep 2018
                 * to add marketplace compatibility with product review remainder plugin
                 */
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Enable Compatibility with Knowband Product review Plugin', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_enable_product_review_compatibility',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'enable_product_review_compatibility_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'enable_product_review_compatibility_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('Enable Compatibility with Knowband product review remainder plugin.', 'adminkbmarketplacesettingcontroller')
                ),
                /* Changes over */
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Seller Review Approval Required', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_seller_review_approval_required',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'seller_review_approval_required_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'seller_review_approval_required_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('With this setting, review first needs approval by you before showing to customers.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Display sellers on front', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_show_seller_on_front',
                    'required' => false,
                    'class' => 't',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'show_seller_on front_on',
                            'value' => 1,
                            'label' => $this->module->l('Enabled', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'show_seller_on front_off',
                            'value' => 0,
                            'label' => $this->module->l('Disabled', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                    'hint' => $this->module->l('With this setting, customers can view the sellers list as well as their profile.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Allow Order Handling', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_enable_seller_order_handling',
                    'class' => 't',
                    'is_bool' => true,
                    'hint' => $this->module->l('Allow Sellers to handle orders.', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('This setting will enable/disable sellers to change status, ship, invoice printing of his own orders(order having own products).', 'adminkbmarketplacesettingcontroller'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enable', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disable', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                ),
                array(
                    'type' => 'select',
                    'multiple' => true,
                    'class' => 'chosen',
                    'label' => $this->l('Available Order Status to Seller'),
                    'hint' => $this->l('Select order status allowed to seller'),
                    'desc' => $this->l('The selller can change order status to the selected order status only if order handing is enabled'),
                    'name' => 'order_available_statuses[]',
                    'required' => true,
                    'options' => array(
                        'query' => $orderStatuses,
                        'id' => 'id_option',
                        'name' => 'name'
                    )
                ),
                /* BOC by rishabh jain
                 * to add option to deduct shipping and wrappinf cost from seller account
                 * if order handling is enabled
                 */
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Deduct Shipping Cost on Order Cancellation', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_enable_deduct_shipping_cost_order_handling',
                    'class' => 't',
                    'is_bool' => true,
                    'hint' => $this->module->l('This will deduct the shipping cost from seller earning on order cancellation if order handling is enabled.', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('If enabled, it will deduct the shipping cost from seller earning on order cancellation if order handling is enabled.', 'adminkbmarketplacesettingcontroller'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enable', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disable', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Deduct gift wrapping Cost on Order Cancellation', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_enable_deduct_gift_wrapping_cost_order_handling',
                    'class' => 't',
                    'is_bool' => true,
                    'hint' => $this->module->l('This will deduct the Gift Wrapping cost from seller earning on order cancellation if order handling is enabled.', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('If enabled, it will deduct the Gift Wrapping cost from seller earning on order cancellation if order handling is enabled.', 'adminkbmarketplacesettingcontroller'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enable', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disable', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                ),
                /* eoc*/
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Allow Free Shipping', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_enable_free_shipping',
                    'class' => 't',
                    'is_bool' => true,
                    'hint' => $this->module->l('Allow Customer to add free shipping voucher', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('This setting will allow/disallow to use free shipping voucher.', 'adminkbmarketplacesettingcontroller'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enable', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disable', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Display Product Wise Seller details on success', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_enable_seller_order_details',
                    'class' => 't',
                    'is_bool' => true,
                    'hint' => $this->module->l('Allow Customer to see product wise seller details on order confirmation page', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('This setting will hide/show Seller details on success.', 'adminkbmarketplacesettingcontroller'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enable', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disable', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Display Seller details on product page', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_enable_seller_details',
                    'class' => 't',
                    'is_bool' => true,
                    'hint' => $this->module->l('Allow Customer to see seller details on product page', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('This setting will hide/show seller detail on product page.', 'adminkbmarketplacesettingcontroller'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enable', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disable', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                ),
                /*Start - MK made changes on 08-03-2018 for Marketplace changes*/
                array(
                    'type' => 'switch',
                    'label' => $this->module->l('Allow Seller to define own Custom Shipping Method', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_enable_seller_custom_shipping',
                    'class' => 't',
                    'is_bool' => true,
                    'hint' => $this->module->l('Allow Seller to add custom shipping method on Shipping page', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('This setting will be used to enable/disable custom shipping method on Shipping page.', 'adminkbmarketplacesettingcontroller'),
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->module->l('Enable', 'adminkbmarketplacesettingcontroller')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->module->l('Disable', 'adminkbmarketplacesettingcontroller')
                        )
                    ),
                ),
                /*End -MK made changes on 08-03-2018 for Marketplace changes*/
                array(
                    'type' => 'tags',
                    'label' => $this->module->l('Listing Meta Keywords', 'adminkbmarketplacesettingcontroller'),
                    'name' => 'kbmp_seller_listing_meta_keywords',
                    'hint' => $this->module->l('Set the keywords/tags for seller listing page on front.', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('Set the comma seperated keywords by which customer can search your seller listing page via search engines. Comma is mandatory even if your are adding only one tag. Ex-: tag1,', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->module->l('Listing Meta Description', 'adminkbmarketplacesettingcontroller'),
                    'rows' => 5,
                    'name' => 'kbmp_seller_listing_meta_description',
                    'hint' => $this->module->l('Set the description for seller listing page on front.', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('Set the description for seller listing page on front.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'textarea',
                    'lang' => true,
                    'label' => $this->module->l('Seller Agreement', 'adminkbmarketplacesettingcontroller'),
                    'autoload_rte' => true,
                    'name' => 'kbmp_seller_agreement',
                    'hint' => $this->module->l('Leave blank, if you dont want.', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('Set the agreement which seller accept before registering on marketplace.', 'adminkbmarketplacesettingcontroller')
                ),
                array(
                    'type' => 'textarea',
                    'lang' => true,
                    'label' => $this->module->l('Order Email Template', 'adminkbmarketplacesettingcontroller'),
                    'autoload_rte' => true,
                    'name' => 'kbmp_seller_order_email_template',
                    'hint' => $this->module->l('This template will used to send order detail to seller, if his product is ordered.', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('Keywords like {{sample}} will be replace by dynamic content at the time of execution. Please do not remove these type of words from template, otherwise proper information will not be send in email to seller as well you. You can only change the position of these keywords in the template.', 'adminkbmarketplacesettingcontroller')
                ),
                // changes by rishabh jain to add email template for order cancellation to seller
                array(
                    'type' => 'textarea',
                    'lang' => true,
                    'label' => $this->module->l('Order Cancel Email Template', 'adminkbmarketplacesettingcontroller'),
                    'autoload_rte' => true,
                    'name' => 'kbmp_seller_order_cancel_email_template',
                    'hint' => $this->module->l('This template will used to send cancelled order detail to seller', 'adminkbmarketplacesettingcontroller'),
                    'desc' => $this->module->l('Keywords like {{sample}} will be replace by dynamic content at the time of execution. Please do not remove these type of words from template, otherwise proper information will not be send in email to seller as well you. You can only change the position of these keywords in the template.', 'adminkbmarketplacesettingcontroller')
                ),
                // changes over
            ),
            'submit' => array('title' => $this->module->l('Save', 'adminkbmarketplacesettingcontroller')),
            'reset' => array('title' => $this->module->l('Reset', 'adminkbmarketplacesettingcontroller'), 'icon' => 'process-icon-reset')
        );

        $this->show_form_cancel_button = false;
        $this->submit_action           = 'submitMarketPlaceConfiguration';
    }

    public function initContent()
    {
        if (!Configuration::get('KB_MARKETPLACE_CONFIG') || Configuration::get('KB_MARKETPLACE_CONFIG')
            == '') {
            $settings = KbGlobal::getDefaultSettings();
        } elseif (Tools::getValue('kbmp_reset_setting') == 1) {
            $settings = KbGlobal::getDefaultSettingsFirstTime();
        } else {
            $settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        }

//        if (Tools::getValue('kbmp_reset_setting') == 1) {
//            $category_array = array();
//        } else {
            $category_array = $settings['kbmp_allowed_categories'];
            
//        }

//        if (!isset($settings['kbmp_enable_seller_order_handling'])) {
//            $settings['kbmp_enable_seller_order_handling'] = 1;
//        }
//        if (!isset($settings['kbmp_enable_seller_details'])) {
//            $settings['kbmp_enable_seller_details'] = 0;
//        }
//        if (!isset($settings['kbmp_enable_seller_order_details'])) {
//            $settings['kbmp_enable_seller_order_details'] = 0;
//        }

        $root = Category::getRootCategory();
        $tree = new HelperTreeCategories('kbmp-categories-tree');
        $tree->setRootCategory($root->id)
            ->setInputName('kbmp_allowed_categories')
            ->setUseCheckBox(true)
            ->setUseSearch(false)
            ->setSelectedCategories((array) $category_array);

        $this->fields_form['input'][] = array(
            'type' => 'categories_select',
            'label' => $this->module->l('Categories Allowed', 'adminkbmarketplacesettingcontroller'),
            'category_tree' => $tree->render(),
            'name' => 'kbmp_allowed_categories',
            'hint' => array(
                $this->module->l('Categories to be allowed to seller in which he/she can map his/her products.', 'adminkbmarketplacesettingcontroller'),
                $this->module->l('If no category is selected that will mean that all the categories are allowed.', 'adminkbmarketplacesettingcontroller')
            ),
            'desc' => $this->module->l('If no category is selected that will mean that all the categories are allowed. In order to enable a category you will have to check all the parent categories otherwise the category will not be activated. Example- To enable `T-shirts` category, you will have to check all the parent categories i.e. Home, Women, Tops and ofcourse T-shirts.', 'adminkbmarketplacesettingcontroller')
        );


        parent::initContent();
        $this->context->smarty->assign(array(
            'title' => $this->module->l('MarketPlace General Settings', 'adminkbmarketplacesettingcontroller'),
        ));
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->context->controller->addJqueryUI('ui.widget');
        $this->context->controller->addJqueryPlugin('tagify');
    }

    public function renderForm()
    {
        $form = parent::renderForm();
        $tpl  = $this->context->smarty->createTemplate(
            _PS_MODULE_DIR_.$this->kb_module_name.'/views/templates/admin/setting.tpl'
        );
        /*Start- MK made changes on 30-05-18 to display the tabs*/
        $this->context->smarty->assign(
            array(
                'selected_nav' => 'config',
                'gdpr_setting'=>  $this->context->link->getAdminLink('AdminKbMPGDPRSetting', true),
                'mp_setting'=>  $this->context->link->getAdminLink('AdminKbMarketPlaceSetting', true),
            )
        );
        $tpl->assign(
            'kb_tabs',
            $this->context->smarty->fetch(
                _PS_MODULE_DIR_ . $this->module->name . '/views/templates/admin/kb_tabs.tpl'
            )
        );
        /*End- MK made changes on 30-05-18 to display the tabs*/
        $tpl->assign('form_fields', $form);
        return $tpl->fetch();
    }

    public function initProcess()
    {
        if (Tools::isSubmit('submitMarketPlaceConfiguration')) {
            $this->action = 'MarketPlaceSetting';
        }
    }

    public function processMarketPlaceSetting()
    {
        $mp_config = array();
        if (Tools::getIsset('kbmp_reset_setting') && Tools::getValue('kbmp_reset_setting')
            == 1) {
            $this->fields_value = KbGlobal::getDefaultSettingsFirstTime();
            $this->displayWarning(
                $this->module->l('Please click on Save button to keep default settings (settings shown below), otherwise previously saved values will be kept.', 'adminkbmarketplacesettingcontroller')
            );
            return $this->fields_value;
        } else {
            $default_settings = KbGlobal::getDefaultSettings();
            $payment_setting_field_name = 'allowed_payment_methods[]';
            $order_status_setting_field_name = 'order_return_statuses[]';
            //changes by vishal for custom change
            $order_automatic_transfer_setting_field_name = 'order_automatic_transfer_statuses[]';
            //changes end
            $order_available_status_setting_field_name = 'order_available_statuses[]';
            $this->getLanguages();
            foreach ($this->fields_form['input'] as $field) {
                $error = false;
                if (($field['name'] == 'kbmp_approval_request_limit') || ($field['name']
                    == 'kbmp_product_limit')) {
                    if (Tools::getValue($field['name']) < 0) {
                        $error          = true;
                        $label          = $field['label'];
                        $this->errors[] = Tools::displayError(sprintf($this->module->l('Value of %s can not be negative.', 'adminkbmarketplacesettingcontroller'), $label));
                    }
                }
                if (isset($field['lang']) && $field['lang']) {
                    $lang_data = $default_settings[$field['name']];
                    foreach ($this->_languages as $language) {
                        $lang_data[$language['id_lang']] = '';
                        if (Tools::getIsset($field['name'].'_'.$language['id_lang'])) {
                            $value                           = Tools::getValue($field['name'].'_'.$language['id_lang']);
                            $lang_data[$language['id_lang']] = Tools::htmlentitiesUTF8($value);
                        } else {
                            if ($field['name'] == 'kbmp_seller_order_email_template') {
                                $lang_data[$language['id_lang']] = KbEmail::getOrderEmailBaseTemplate();
                            } elseif ($field['name'] == 'kbmp_seller_order_cancel_email_template') {
                                $lang_data[$language['id_lang']] = KbEmail::getOrderCancelEmailBaseTemplate();
                            } else {
                                $lang_data[$language['id_lang']] = '';
                            }
                        }
                    }
                    $mp_config[$field['name']] = $lang_data;
                } elseif ($field['name'] == $payment_setting_field_name) {
                    /* changes by rishabh jain */
                    $payment_setting = 'allowed_payment_methods';
                    if (Tools::getIsset($payment_setting)) {
                        $mp_config[$payment_setting] = Tools::getValue($payment_setting);
                    } else {
                        $error          = true;
                        $this->errors[] = Tools::displayError($this->module->l('Select atleast one payment method.', 'adminkbmarketplacesettingcontroller'));
                        $mp_config[$payment_setting] = array();
                    }
                } elseif ($field['name'] == $order_status_setting_field_name) {
                    /* changes by rishabh jain */
                    $status_setting = 'order_return_statuses';
                    if (Tools::getIsset($status_setting)) {
                        $mp_config[$status_setting] = Tools::getValue($status_setting);
                    } else {
                        $error          = true;
                        $this->errors[] = Tools::displayError($this->module->l('Select atleast one order status which signifies the cancellation of order.', 'adminkbmarketplacesettingcontroller'));
                        $mp_config[$status_setting] = array();
                    }
                } elseif ($field['name'] == $order_automatic_transfer_setting_field_name) {
                    //changes by vishal for custom change
                    $status_setting = 'order_automatic_transfer_statuses';
                    if (Tools::getIsset($status_setting)) {
                        $mp_config[$status_setting] = Tools::getValue($status_setting);
                    } else {
                        $error          = true;
                        $this->errors[] = Tools::displayError($this->module->l('Select atleast one order status which signifies the automatic amount transfer.', 'adminkbmarketplacesettingcontroller'));
                        $mp_config[$status_setting] = array();
                    }
                //changes end    
                } elseif ($field['name'] == $order_available_status_setting_field_name) {
                    /* changes by rishabh jain */
                    $status_setting = 'order_available_statuses';
                    if (Tools::getIsset($status_setting)) {
                        $mp_config[$status_setting] = Tools::getValue($status_setting);
                    } else {
                        if (Tools::getIsset('kbmp_enable_seller_order_handling') && Tools::getValue('kbmp_enable_seller_order_handling') == 1) {
                            $error          = true;
                            $this->errors[] = Tools::displayError($this->module->l('Select atleast one order status to allow to seller if order handling is enabled.', 'adminkbmarketplacesettingcontroller'));
                        }
                        $mp_config[$status_setting] = array();
                    }
                } elseif (Tools::getIsset($field['name'])) {
                    if (isset($field['required']) && $field['required']) {
                        if (($value = Tools::getValue($field['name'])) == false && (string) $value
                            != '0') {
                            $error          = true;
                            $this->errors[] = Tools::displayError(sprintf($this->module->l('Field %s is required.', 'adminkbmarketplacesettingcontroller'), $field['label']));
                        } elseif (isset($field['validation']) && !call_user_func(array(
                                "Validate", $field['validation']), Tools::getValue($field['name']))) {
                            $error          = true;
                            $this->errors[] = Tools::displayError(sprintf($this->module->l('Field %s is invalid.', 'adminkbmarketplacesettingcontroller'), $field['label']));
                        }
                    } elseif (isset($field['validation']) && !call_user_func(array(
                            "Validate", $field['validation']), Tools::getValue($field['name']))) {
                        $error          = true;
                        $this->errors[] = Tools::displayError(sprintf($this->module->l('Field %s is invalid.', 'adminkbmarketplacesettingcontroller'), $field['label']));
                    }
                    if (!$error) {
                        if ($field['type'] && isset($field['multiple']) && $field['multiple']) {
                            $mp_config[$field['name']] = Tools::getValue('selectItem'.$field['name']);
                        } else {
                            $mp_config[$field['name']] = Tools::getValue($field['name']);
                        }
                    }
                } else {
                    $mp_config[$field['name']] = $default_settings[$field['name']];
                }
            }
            
            if (Tools::getIsset('kbmp_allowed_categories')) {
                $mp_config['kbmp_allowed_categories'] = Tools::getValue('kbmp_allowed_categories');
            } else {
                $mp_config['kbmp_allowed_categories'] = array();
            }
            if (Tools::getIsset('kbmp_enable_seller_order_handling')) {
                Configuration::updateValue(
                    'KB_MP_SELLER_ORDER_HANDLING',
                    Tools::getValue('kbmp_enable_seller_order_handling')
                );
            }
            if (Tools::getIsset('kbmp_enable_seller_review')) {
                Configuration::updateValue('KB_MP_ENABLE_SELLER_REVIEW', Tools::getValue('kbmp_enable_seller_review'));
            }
        }
        if (!$this->errors || count($this->errors) == 0) {
            $this->confirmations[] = $this->_conf[6];
            Configuration::updateValue('KB_MARKETPLACE_CONFIG', serialize($mp_config));
            Hook::exec('actionMarketplaceSetting', array('controller' => $this, 'settings' => $mp_config));
        }
    }

    public function getFieldsValue($obj)
    {
        unset($obj);
        if (Tools::getIsset('kbmp_reset_setting') &&
            Tools::getValue('kbmp_reset_setting') == 1) {
            $this->fields_value = KbGlobal::getDefaultSettingsFirstTime();
//            print_r($this->fields_value);
//            die();
            return $this->fields_value;
        } else {
            if (!Configuration::get('KB_MARKETPLACE_CONFIG') ||
                Configuration::get('KB_MARKETPLACE_CONFIG') == '') {
                $settings = KbGlobal::getDefaultSettings();
            } else {
                $settings = Tools::unSerialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
                if (isset($settings['kbmp_seller_order_email_template']) &&
                    $settings['kbmp_seller_order_email_template'] == '0'
                ) {
                    foreach ($settings['kbmp_seller_order_email_template'] as $key => $template_lang) {
                        unset($template_lang);
                        $settings['kbmp_seller_order_email_template'][$key] = "<table>
                        <tbody>
                        <tr>
                        <td align='center' class='titleblock' style='padding: 7px 0;'>
                        <span size='2' face='Open-sans, sans-serif' color='#555454'
                        style='color: #555454; font-family: Open-sans, sans-serif; font-size: small;'>
                        <span class='title' style='font-weight: 500; font-size: 28px;
                        text-transform: uppercase; line-height: 33px;'>Hi {seller_name},</span><br />
                        <span class='subtitle'
                        style='font-weight: 500; font-size: 16px;
                        text-transform: uppercase; line-height: 25px;'>
                        A Customer has just placed an order for your products on {shop_name}!
                        </span>
                        </span></td>
                        </tr>
                        <tr>
                        <td class='space_footer' style='padding: 0!important;'> </td>
                        </tr>
                        <tr>
                        <td class='box' style='border: 1px solid #D6D4D4;
                        background-color: #f8f8f8; padding: 7px 14px;'>
                        <p data-html-only='1' style='border-bottom: 1px solid #D6D4D4;
                        margin: 3px 0 7px; text-transform: uppercase; font-weight: 500;
                        font-size: 18px; padding-bottom: 10px;'>Customer Information</p>
                        <span size='2' face='Open-sans, sans-serif' color='#555454' style='color: #555454;
                        font-family: Open-sans, sans-serif; font-size: small;'>
                        <span style='color: #777;'> <span style='color: #333;'>
                        <strong>Name:</strong></span> {firstname} {lastname}<br /> </span>
                        <span style='color: #777;'> <span style='color: #333;'>
                        <strong>Email:</strong></span> {email}<br /> </span> </span></td>
                        </tr>
                        <tr>
                        <td class='space_footer' style='padding: 0!important;'> </td>
                        </tr>
                        <tr>
                        <td class='box' style='border: 1px solid #D6D4D4;
                        background-color: #f8f8f8; padding: 7px 14px;'>
                        <p data-html-only='1' style='border-bottom: 1px solid #D6D4D4;
                        margin: 3px 0 7px; text-transform: uppercase; font-weight: 500; font-size: 18px;
                        padding-bottom: 10px;'>Order details</p>
                        <span size='2' face='Open-sans, sans-serif'
                        color='#555454' style='color: #555454;
                        font-family: Open-sans, sans-serif;
                        font-size: small;'><span style='color: #777;'>
                        <span style='color: #333;'><strong>Order:</strong></span>
                        {order_name} Placed on {date}<br /> </span> </span></td>
                        </tr>
                        <tr>
                        <td class='space_footer' style='padding: 0!important;'> </td>
                        </tr>
                        <tr>
                        <td>{products}</td>
                        </tr>
                        <tr>
                        <td class='space_footer' style='padding: 0!important;'> </td>
                        </tr>
                        <tr>
                        <td>
                        <table class='table' style='width: 100%;'>
                        <tbody>
                        <tr>
                        <td style='border: 1px solid #D6D4D4;
                        background-color: #f8f8f8; padding: 7px 14px;'>
                        <p data-html-only='1'
                        style='border-bottom: 1px solid #D6D4D4;
                        margin: 3px 0 7px; text-transform: uppercase;
                        font-weight: 500; font-size: 18px;
                        padding-bottom: 10px;'>Delivery address</p>
                        <span size='2' face='Open-sans, sans-serif' color='#555454' style='color: #555454;
                        font-family: Open-sans, sans-serif; font-size: small;'>
                        <span style='color: #777;'>{delivery_block_html}</span> </span></td>
                        <td width='20' class='space_address' style='padding: 7px 0;'> </td>
                        <td style='border: 1px solid #D6D4D4; background-color: #f8f8f8; padding: 7px 14px;'>
                        <p data-html-only='1' style='border-bottom: 1px solid #D6D4D4;
                        margin: 3px 0 7px; text-transform: uppercase; font-weight: 500;
                        font-size: 18px; padding-bottom: 10px;'>Billing address</p>
                        <span size='2' face='Open-sans, sans-serif' color='#555454'
                        style='color: #555454; font-family: Open-sans, sans-serif;
                        font-size: small;'>
                        <span style='color: #777;'>{invoice_block_html}</span> </span></td>
                        </tr>
                        </tbody>
                        </table>
                        </td>
                        </tr>
                        </tbody>
                        </table>";
                    }
                    $this->displayWarning(
                        $this->module->l('Please save the setting once, before using the module.', 'adminkbmarketplacesettingcontroller')
                    );
                }
                /* BOC @author Rishabh Jain
                * To add order cancellation email template data if not set
                */
                if (isset($settings['kbmp_seller_order_cancel_email_template'])) {
                    foreach ($settings['kbmp_seller_order_cancel_email_template'] as $key => $template_lang) {
                        unset($template_lang);
                        $settings['kbmp_seller_order_cancel_email_template'][$key] = "<table>
                            <tbody>
                            <tr>
                            <td align='center' class='titleblock' style='padding: 7px 0;'>
                            <span size='2' face='Open-sans, sans-serif' color='#555454'
                            style='color: #555454; font-family: Open-sans, sans-serif; font-size: small;'>
                            <span class='title' style='font-weight: 500; font-size: 28px;
                            text-transform: uppercase; line-height: 33px;'>Hi {seller_name},</span><br />
                            <span class='subtitle'
                            style='font-weight: 500; font-size: 16px;
                            text-transform: uppercase; line-height: 25px;'>
                            A Customer has just cancelled an order for your products on {shop_name}!
                            </span>
                            </span></td>
                            </tr>
                            <tr>
                            <td class='space_footer' style='padding: 0!important;'> </td>
                            </tr>
                            <tr>
                            <td class='box' style='border: 1px solid #D6D4D4;
                            background-color: #f8f8f8; padding: 7px 14px;'>
                            <p data-html-only='1' style='border-bottom: 1px solid #D6D4D4;
                            margin: 3px 0 7px; text-transform: uppercase; font-weight: 500;
                            font-size: 18px; padding-bottom: 10px;'>Customer Information</p>
                            <span size='2' face='Open-sans, sans-serif' color='#555454' style='color: #555454;
                            font-family: Open-sans, sans-serif; font-size: small;'>
                            <span style='color: #777;'> <span style='color: #333;'>
                            <strong>Name:</strong></span> {firstname} {lastname}<br /> </span>
                            <span style='color: #777;'> <span style='color: #333;'>
                            <strong>Email:</strong></span> {email}<br /> </span> </span></td>
                            </tr>
                            <tr>
                            <td class='space_footer' style='padding: 0!important;'> </td>
                            </tr>
                            <tr>
                            <td class='box' style='border: 1px solid #D6D4D4;
                            background-color: #f8f8f8; padding: 7px 14px;'>
                            <p data-html-only='1' style='border-bottom: 1px solid #D6D4D4;
                            margin: 3px 0 7px; text-transform: uppercase; font-weight: 500; font-size: 18px;
                            padding-bottom: 10px;'>Order details</p>
                            <span size='2' face='Open-sans, sans-serif'
                            color='#555454' style='color: #555454;
                            font-family: Open-sans, sans-serif;
                            font-size: small;'><span style='color: #777;'>
                            <span style='color: #333;'><strong>Order:</strong></span>
                            {order_name} Placed on {date}<br /> </span> </span></td>
                            </tr>
                            <tr>
                            <td class='space_footer' style='padding: 0!important;'> </td>
                            </tr>
                            <tr>
                            <td>{products}</td>
                            </tr>
                            <tr>
                            <td class='space_footer' style='padding: 0!important;'> </td>
                            </tr>
                            <tr>
                            <td>
                            <table class='table' style='width: 100%;'>
                            <tbody>
                            <tr>
                            <td style='border: 1px solid #D6D4D4;
                            background-color: #f8f8f8; padding: 7px 14px;'>
                            <p data-html-only='1'
                            style='border-bottom: 1px solid #D6D4D4;
                            margin: 3px 0 7px; text-transform: uppercase;
                            font-weight: 500; font-size: 18px;
                            padding-bottom: 10px;'>Delivery address</p>
                            <span size='2' face='Open-sans, sans-serif' color='#555454' style='color: #555454;
                            font-family: Open-sans, sans-serif; font-size: small;'>
                            <span style='color: #777;'>{delivery_block_html}</span> </span></td>
                            <td width='20' class='space_address' style='padding: 7px 0;'> </td>
                            <td style='border: 1px solid #D6D4D4; background-color: #f8f8f8; padding: 7px 14px;'>
                            <p data-html-only='1' style='border-bottom: 1px solid #D6D4D4;
                            margin: 3px 0 7px; text-transform: uppercase; font-weight: 500;
                            font-size: 18px; padding-bottom: 10px;'>Billing address</p>
                            <span size='2' face='Open-sans, sans-serif' color='#555454'
                            style='color: #555454; font-family: Open-sans, sans-serif;
                            font-size: small;'>
                            <span style='color: #777;'>{invoice_block_html}</span> </span></td>
                            </tr>
                            </tbody>
                            </table>
                            </td>
                            </tr>
                            </tbody>
                            </table>";
                    }
                    $this->displayWarning($this->module->l('Please save the setting once, before using the module.', 'adminkbmarketplacesettingcontroller'));
                }
            }
            if (!isset($settings['kbmp_enable_seller_order_handling'])) {
                $settings['kbmp_enable_seller_order_handling'] = 1;
            }
            if (!isset($settings['kbmp_enable_free_shipping'])) {
                $settings['kbmp_enable_free_shipping'] = 0;
            }

            if (!isset($settings['kbmp_enable_seller_details'])) {
                $settings['kbmp_enable_seller_details'] = 0;
            }
            /*Start - MK made changes on 08-03-2018 for Marketplace changes*/
            if (!isset($settings['kbmp_enable_seller_custom_shipping'])) {
                $settings['kbmp_enable_seller_custom_shipping'] = 0;
            }
            /*End -MK made changes on 08-03-2018 for Marketplace changes*/
            if (!isset($settings['kbmp_enable_seller_order_details'])) {
                $settings['kbmp_enable_seller_order_details'] = 0;
            }

            if (!isset($settings['kbmp_seller_agreement'])) {
                $settings['kbmp_seller_agreement'] = array();
            }

            if (!isset($settings['kbmp_seller_order_email_template'])) {
                $settings['kbmp_seller_order_email_template'] = array();
            }
            /* changes started by rishabh */
            if (!isset($settings['kbmp_seller_order_cancel_email_template'])) {
                $settings['kbmp_seller_order_cancel_email_template'] = array();
            }
            /* changes started by rishabh */
            $payment_setting_field_name = 'allowed_payment_methods[]';
            $order_status_setting_field_name = 'order_return_statuses[]';
            //changes by vishal for custom change
            $order_automatic_transfer_setting_field_name = 'order_automatic_transfer_statuses[]';
            //changes end
            $order_available_status_setting_field_name = 'order_available_statuses[]';
            /* changes over */
            
            foreach ($this->fields_form[0]['form']['input'] as $fieldset) {
                if (isset($fieldset['lang']) && $fieldset['lang']) {
                    $lang_data = array();
                    $saved_data = array();
                    if (!empty($settings[$fieldset['name']])) {
                        $saved_data = $settings[$fieldset['name']];
                    }
                    foreach ($this->_languages as $language) {
                        $lang_data[$language['id_lang']] = '';
                        if (Tools::getIsset($fieldset['name']
                            . '_' . $language['id_lang'])) {
                            $lang_data[$language['id_lang']] =
                                Tools::getValue($fieldset['name'] . '_' . $language['id_lang']);
                        } elseif (isset($saved_data[$language['id_lang']])) {
                            $lang_data[$language['id_lang']] = Tools::htmlentitiesDecodeUTF8(
                                $saved_data[$language['id_lang']]
                            );
                        } else {
                            if ($fieldset['name'] == 'kbmp_seller_order_email_template') {
                                $lang_data[$language['id_lang']] =
                                    KbEmail::getOrderEmailBaseTemplate();
                            } elseif ($fieldset['name'] == 'kbmp_seller_order_cancel_email_template') {
                                $lang_data[$language['id_lang']] = KbEmail::getOrderCancelEmailBaseTemplate();
                            } else {
                                $lang_data[$language['id_lang']] = '';
                            }
                        }
                    }
                    $this->fields_value[$fieldset['name']] = $lang_data;
                } elseif ($fieldset['name'] == 'allowed_payment_methods[]') {
                    /* changes by rishabh jain */
                    $payment_setting = 'allowed_payment_methods[]';
                    if (Tools::getIsset('allowed_payment_methods')) {
                        $this->fields_value[$payment_setting] = Tools::getValue('allowed_payment_methods');
                    } elseif (isset($settings[$fieldset['name']])) {
                        $this->fields_value[$payment_setting] = $settings[$fieldset['name']];
                    } elseif (isset($settings['allowed_payment_methods'])) {
                        $this->fields_value[$payment_setting] = $settings['allowed_payment_methods'];
                    } else {
                        $this->fields_value[$payment_setting] = array( 0 => 'bankwire');
                    }
                } elseif ($fieldset['name'] == 'order_return_statuses[]') {
                    /* changes by rishabh jain */
                    $order_status_setting = 'order_return_statuses[]';
                    if (Tools::getIsset('order_return_statuses')) {
                        $this->fields_value[$order_status_setting] = Tools::getValue('order_return_statuses');
                    } elseif (isset($settings[$fieldset['name']])) {
                        $this->fields_value[$order_status_setting] = $settings[$fieldset['name']];
                    } elseif (isset($settings['order_return_statuses'])) {
                        $this->fields_value[$order_status_setting] = $settings['order_return_statuses'];
                    } else {
                        $this->fields_value[$order_status_setting] = array(Configuration::get('PS_OS_ERROR'), Configuration::get('PS_OS_CANCELED'));
                    }
                } elseif ($fieldset['name'] == 'order_automatic_transfer_statuses[]') {
                    //changes by vishal for custom change
                    $order_status_setting = 'order_automatic_transfer_statuses[]';
                    if (Tools::getIsset('order_automatic_transfer_statuses')) {
                        $this->fields_value[$order_status_setting] = Tools::getValue('order_automatic_transfer_statuses');
                    } elseif (isset($settings[$fieldset['name']])) {
                        $this->fields_value[$order_status_setting] = $settings[$fieldset['name']];
                    } elseif (isset($settings['order_automatic_transfer_statuses'])) {
                        $this->fields_value[$order_status_setting] = $settings['order_automatic_transfer_statuses'];
                    } else {
                        $this->fields_value[$order_status_setting] = array(Configuration::get('PS_OS_ERROR'), Configuration::get('PS_OS_CANCELED'));
                    }
                    //changes end
                } elseif ($fieldset['name'] == 'order_available_statuses[]') {
                    /* changes by rishabh jain */
                    $order_available_setting = 'order_available_statuses[]';
                    if (Tools::getIsset('order_available_statuses')) {
                        $this->fields_value[$order_available_setting] = Tools::getValue('order_available_statuses');
                    } elseif (isset($settings[$fieldset['name']])) {
                        $this->fields_value[$order_available_setting] = $settings[$fieldset['name']];
                    } elseif (isset($settings['order_available_statuses'])) {
                        $this->fields_value[$order_available_setting] = $settings['order_available_statuses'];
                    } else {
                        $this->fields_value[$order_available_setting] = array();
                    }
                } elseif (Tools::getIsset($fieldset['name'])) {
                    if ($fieldset['type'] && isset($fieldset['multiple']) && $fieldset['multiple']) {
                        $this->fields_value[$fieldset['name']] = Tools::getValue('selectItem' . $fieldset['name']);
                    } else {
                        $this->fields_value[$fieldset['name']] = Tools::getValue($fieldset['name']);
                    }
                } else {
                    if ($fieldset['type'] == 'select') {
                        if (isset($fieldset['multiple']) && $fieldset['multiple']) {
                            $this->fields_value[$fieldset['name']] =
                                (array) $settings[$fieldset['name']];
                        } else {
                            $this->fields_value[$fieldset['name']] = $settings[$fieldset['name']];
                        }
                    } else {
                        if (isset($settings[$fieldset['name']])) {
                            $this->fields_value[$fieldset['name']] = $settings[$fieldset['name']];
                        } else {
                            $this->fields_value[$fieldset['name']] = '';
                        }
                    }
                }
            }
            $this->fields_value['kbmp_allowed_categories'] = $settings['kbmp_allowed_categories'];
            return $this->fields_value;
        }
    }
}
