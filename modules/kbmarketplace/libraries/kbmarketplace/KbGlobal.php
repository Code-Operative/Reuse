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

class KbGlobal extends ObjectModel
{
    const PAGING_RECORD_LIMIT = 10;
    const REASON_MIN_LENGTH = 30;
    const SELLER_DEFAULT_LOGO = 'default_seller_logo.jpg';
    const SELLER_DEFAULT_BANNER = 'default_seller_banner.jpg';

    /*
     * Approval Statuses
     */
    const APPROVAL_WAITING = 0;
    const APPROVED = 1;
    const DISSAPPROVED = 2;
    const CANCELLED     = 3;

    /*
     * Approval Statuses
     */
    const DURATION_DAYS = 1;
    const DURATION_MONTHS = 2;
    const DURATION_YEARS = 3;

    /*
     * Statuses
     */
    const DISABLE = 0;
    const ENABLE = 1;

    /*
     * Maximum Rating
     */
    const MAX_RATING = 5;

    /*
     * Multi action types
     */
    const MULTI_ACTION_TYPE_STATUS = 1;
    const MULTI_ACTION_TYPE_DELETE = 2;

    public static function getDefaultSettings($key = null)
    {
        /* changes by rishabh jain */
        $module = Module::getInstanceByName('kbmarketplace');
        $payment_methods = array(
            0 => array(
                'id' => 'bankwire',
                'name' => $module->l('Bank Wire', 'kbglobal'),
            ),
            1 => array(
                'id' => 'check',
                'name' => $module->l('Payment by Cheque', 'kbglobal'),
            ),
            2 => array(
                'id' => 'kbpaypal',
                'name' => $module->l('Payment by PayPal', 'kbglobal'),
            )
        );
        $kb_payout_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
        if (empty($kb_payout_setting)) {
            unset($payment_methods['kbpaypal']);
        } elseif (!$kb_payout_setting['enable']) {
            unset($payment_methods['kbpaypal']);
        }
        /* changes over */
        $settings = array(
            'kbmp_default_commission' => 15,
            'kbmp_allowed_categories' => array(),
            'kbmp_approval_request_limit' => 3,
            'kbmp_product_limit' => 20,
            'kbmp_seller_registration' => 1,
            'kbmp_new_product_approval_required' => 1,
            'kbmp_seller_separate_registration_form' => 0,
            'kbmp_shop_title' => 0,
            'kbmp_seller_contact_number' => 0,
            'kbmp_seller_country' => 0,
            'kbmp_seller_city' => 0,
            
            'kbmp_email_on_new_order' => 1,
            'kbmp_enable_seller_review' => 1,
            /* Changes started by rishabh jain on 5th sep 2018
             * to add marketplace compatibility with product review remainder plugin
             */
            'kbmp_enable_product_review_compatibility' => 0,
            'enable_return_manager_policy_addition' => 0,
            'enable_return_manager_compatibility' => 0,
            'enable_seller_shortlisting' => 0,
            'enable_product_avaialability_compatibility' => 0,
            'enable_booking_calender_compatibility' => 0,
            /* Changes over */
            /* Changes over */
            /* changes done by rishabh jain
             * to add option to select payment methods
             */ 
            'kbmp_enable_custom_features_addition' => 0,
            'kbmp_enable_seller_custom_shipping' => 0,
            // changes by rishabh jain to set default values
            'enable_custom_product_addition' => 0,
            'enable_custom_manufacturer_addition' => 0,
            'enable_custom_supplier_addition' => 0,
            'kbmp_enable_deduct_shipping_cost_order_handling' => 0,
            'kbmp_enable_deduct_gift_wrapping_cost_order_handling' => 0,
            'kbmp_email_on_order_cancellation' => 0,
            'order_return_statuses' => array(Configuration::get('PS_OS_ERROR'), Configuration::get('PS_OS_CANCELED')),
            'allowed_payment_methods' => array( 0 => 'bankwire'),
            'order_available_statuses' => array(),
            /* changes over */
            'kbmp_seller_review_approval_required' => 1,
            'kbmp_show_seller_on_front' => 1,
            'kbmp_seller_listing_meta_keywords' => '',
            'kbmp_seller_listing_meta_description' => '',
            'kbmp_seller_listing_meta_description' => '',
            'kbmp_enable_free_shipping' => 1,
            'kbmp_enable_seller_details' => 0,
            'kbmp_enable_seller_order_handling' => 1,
            'kbmp_enable_seller_order_details' => 0,
            'kbmp_seller_agreement' => array(),
            'kbmp_seller_order_email_template' => array(),
            // changes by rishabh jain to add order cancellation email template
            'kbmp_seller_order_cancel_email_template' => array()
        );
        if ($key != null && isset($settings[$key])) {
            return $settings[$key];
        }

        return $settings;
    }

    /*
     * @author - Rishabh jain
     * DOC - 25/02/20
     * Functionality - To set the deafult values for membership
     * Plan general setting form
     */
    public static function getDefaultMemberShipPlanSettings($key = null)
    {
        $settings = array(
            'kbmp_enable_membership_plan' => 0,
            'kbmp_inform_seller_membership_plan_active' => 0,
            'kbmp_membership_start_email' => array(),
            'kbmp_inform_seller_membership_expiry' => 0,
            'kbmp_membership_expired_email' => array(),
            'kbmp_membership_warning_email' => array(),
            
            'kbmp_product_deactivation_email' => array(),
            'kbmp_seller_rebate_email' => array(),
            
            'kbmp_product_activation_duration' => 7,
            'kbmp_mark_inactive_already_active' => 0,
            
            'kbmp_inform_seller_membership_warning' => 0,
            
            'kbmp_membership_warning_msg' => 0,
            'kbmp_membership_warning_email_reminder_days' => 3,
            'kbmp_membership_warning_msg_reminder_days' => 3,
            'kbmp_free_membership_plan' => 0,
            'kbmp_enable_product_limit_free_membership_plan' => 1,
            'kbmp_free_membership_product_limit' => 5,
            'kbmp_free_membership_plan_duration_interval' => 1,
            'kbmp_free_membership_plan_duration' => 10,
            'kbmp_membership_plan_order_statuses' => array(),
        );
        if ($key != null && isset($settings[$key])) {
            return $settings[$key];
        }

        return $settings;
    }

    /*
     * Changes over
     */
    public static function getGlobalSettingByKey($key)
    {
        if (!Configuration::get('KB_MARKETPLACE_CONFIG') || Configuration::get('KB_MARKETPLACE_CONFIG') == '') {
            $settings = self::getDefaultSettings();
        } else {
            $settings = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        }

        return (isset($settings[$key])) ? $settings[$key] : false;
    }

    public static function getSellerMenus()
    {
        $module = Module::getInstanceByName('kbmarketplace');
        return array(
            array('label' => $module->l('Dashboard', 'kbglobal'), 'title' => $module->l('Dashboard', 'kbglobal'), 'module' => 'kbmarketplace',
                'controller' => 'dashboard', 'icon_class' => 'dashboard'),
            array('label' => $module->l('Seller Profile', 'kbglobal'), 'title' => $module->l('Seller Profile', 'kbglobal'), 'module' => 'kbmarketplace',
                'controller' => 'seller', 'icon_class' => 'pencil'),
            array('label' => $module->l('Products', 'kbglobal'), 'title' => $module->l('Products', 'kbglobal'), 'module' => 'kbmarketplace',
                'controller' => 'product', 'icon_class' => 'list', 'count' => 155),
            array('label' => $module->l('Orders', 'kbglobal'), 'title' => $module->l('Orders', 'kbglobal'), 'module' => 'kbmarketplace',
                'controller' => 'order', 'icon_class' => 'shopping-cart', 'count' => 705),
            array('label' => $module->l('Product Reviews', 'kbglobal'), 'title' => $module->l('Product Reviews', 'kbglobal'), 'module' => 'kbmarketplace',
                'controller' => 'productreview', 'icon_class' => 'list', 'count' => 134),
            array('label' => $module->l('My Reviews', 'kbglobal'), 'title' => $module->l('My Reviews', 'kbglobal'), 'module' => 'kbmarketplace',
                'controller' => 'sellerreview', 'icon_class' => 'heart', 'count' => 50),
            array('label' => $module->l('Earning', 'kbglobal'), 'title' => $module->l('Earning', 'kbglobal'), 'module' => 'kbmarketplace',
                'controller' => 'earning', 'icon_class' => 'money'),
            array('label' => $module->l('Transactions', 'kbglobal'), 'title' => $module->l('Transactions', 'kbglobal'), 'module' => 'kbmarketplace',
                'controller' => 'transaction', 'icon_class' => 'file'),
            array('label' => $module->l('Category Request', 'kbglobal'), 'title' => $module->l('Category Request', 'kbglobal'), 'module' => 'kbmarketplace',
                'controller' => 'category', 'icon_class' => 'dashboard', 'count' => 12),
        );
    }
    
    public static function getDefaultSettingsFirstTime($key = null)
    {
        $languages_current_shop     = Language::getLanguages(false);
        $array_seller_agreement     = array();
        $array_order_email_template = array();
        $array_order_cancel_email_template = array();
        $seller_order_cancel_email_template_default = KbEmail::getOrderCancelEmailBaseTemplate();
        $seller_order_email_template_default = "<table>
											<tbody>
											<tr>
											<td align='center' class='titleblock' style='padding: 7px 0;'><span size='2' face='Open-sans, sans-serif' color='#555454' style='color: #555454; font-family: Open-sans, sans-serif; font-size: small;'> <span class='title' style='font-weight: 500; font-size: 28px; text-transform: uppercase; line-height: 33px;'>Hi {seller_name},</span><br /> <span class='subtitle' style='font-weight: 500; font-size: 16px; text-transform: uppercase; line-height: 25px;'> A Customer has just placed an order for your products on {shop_name}!</span> </span></td>
											</tr>
											<tr>
											<td class='space_footer' style='padding: 0!important;'> </td>
											</tr>
											<tr>
											<td class='box' style='border: 1px solid #D6D4D4; background-color: #f8f8f8; padding: 7px 14px;'>
											<p data-html-only='1' style='border-bottom: 1px solid #D6D4D4; margin: 3px 0 7px; text-transform: uppercase; font-weight: 500; font-size: 18px; padding-bottom: 10px;'>Customer Information</p>
											<span size='2' face='Open-sans, sans-serif' color='#555454' style='color: #555454; font-family: Open-sans, sans-serif; font-size: small;'><span style='color: #777;'> <span style='color: #333;'><strong>Name:</strong></span> {firstname} {lastname}<br /> </span> <span style='color: #777;'> <span style='color: #333;'><strong>Email:</strong></span> {email}<br /> </span> </span></td>
											</tr>
											<tr>
											<td class='space_footer' style='padding: 0!important;'> </td>
											</tr>
											<tr>
											<td class='box' style='border: 1px solid #D6D4D4; background-color: #f8f8f8; padding: 7px 14px;'>
											<p data-html-only='1' style='border-bottom: 1px solid #D6D4D4; margin: 3px 0 7px; text-transform: uppercase; font-weight: 500; font-size: 18px; padding-bottom: 10px;'>Order details</p>
											<span size='2' face='Open-sans, sans-serif' color='#555454' style='color: #555454; font-family: Open-sans, sans-serif; font-size: small;'><span style='color: #777;'> <span style='color: #333;'><strong>Order:</strong></span> {order_name} Placed on {date}<br /> </span> </span></td>
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
											<td style='border: 1px solid #D6D4D4; background-color: #f8f8f8; padding: 7px 14px;'>
											<p data-html-only='1' style='border-bottom: 1px solid #D6D4D4; margin: 3px 0 7px; text-transform: uppercase; font-weight: 500; font-size: 18px; padding-bottom: 10px;'>Delivery address</p>
											<span size='2' face='Open-sans, sans-serif' color='#555454' style='color: #555454; font-family: Open-sans, sans-serif; font-size: small;'><span style='color: #777;'>{delivery_block_html}</span> </span></td>
											<td width='20' class='space_address' style='padding: 7px 0;'> </td>
											<td style='border: 1px solid #D6D4D4; background-color: #f8f8f8; padding: 7px 14px;'>
											<p data-html-only='1' style='border-bottom: 1px solid #D6D4D4; margin: 3px 0 7px; text-transform: uppercase; font-weight: 500; font-size: 18px; padding-bottom: 10px;'>Billing address</p>
											<span size='2' face='Open-sans, sans-serif' color='#555454' style='color: #555454; font-family: Open-sans, sans-serif; font-size: small;'><span style='color: #777;'>{invoice_block_html}</span> </span></td>
											</tr>
											</tbody>
											</table>
											</td>
											</tr>
											</tbody>
										 </table>";

        foreach ($languages_current_shop as $language) {
            $array_seller_agreement[$language['id_lang']]     = '';
            $array_order_email_template[$language['id_lang']] = $seller_order_email_template_default;
            $array_order_cancel_email_template[$language['id_lang']] = $seller_order_cancel_email_template_default;
        }
        /* changes by rishabh jain */
        $module = Module::getInstanceByName('kbmarketplace');
        $payment_methods = array(
            0 => array(
                'id' => 'bankwire',
                'name' => $module->l('Bank Wire', 'kbglobal'),
            ),
            1 => array(
                'id' => 'check',
                'name' => $module->l('Payment by Cheque', 'kbglobal'),
            ),
            2 => array(
                'id' => 'kbpaypal',
                'name' => $module->l('Payment by PayPal', 'kbglobal'),
            )
        );
        $kb_payout_setting = Tools::jsonDecode(Configuration::get('KB_MP_PAYOUT_SETTING'), true);
        if (empty($kb_payout_setting)) {
            unset($payment_methods['kbpaypal']);
        } elseif (!$kb_payout_setting['enable']) {
            unset($payment_methods['kbpaypal']);
        }
        
        /* changes over */
        $settings = array(
            'kbmp_default_commission' => 15,
            'kbmp_approval_request_limit' => 3,
            'kbmp_product_limit' => 20,
            'kbmp_seller_registration' => 1,
            'kbmp_new_product_approval_required' => 1,
            'kbmp_seller_separate_registration_form' => 0,
            'kbmp_shop_title' => 0,
            'kbmp_seller_contact_number' => 0,
            'kbmp_seller_country' => 0,
            'kbmp_seller_city' => 0,
            'kbmp_email_on_new_order' => 1,
            'kbmp_enable_seller_review' => 1,
            /* Changes started by rishabh jain on 5th sep 2018
             * to add marketplace compatibility with product review remainder plugin
             */
            'kbmp_enable_product_review_compatibility' => 0,
            'enable_return_manager_policy_addition' => 0,
            'enable_seller_shortlisting' => 0,
            'enable_return_manager_compatibility' => 0,
            'enable_product_avaialability_compatibility' => 0,
            'enable_booking_calender_compatibility' => 0,
            /* Changes over */
            /* changes done by rishabh jain
             * to add option to select payment methods
             */ 
            'kbmp_enable_custom_features_addition' => 0,
            'kbmp_enable_seller_custom_shipping' => 0,
            // changes by rishabh jain to set default values
            'enable_custom_product_addition' => 0,
            'enable_custom_manufacturer_addition' => 0,
            'enable_custom_supplier_addition' => 0,
            'kbmp_enable_deduct_shipping_cost_order_handling' => 0,
            'kbmp_enable_deduct_gift_wrapping_cost_order_handling' => 0,
            'kbmp_email_on_order_cancellation' => 0,
            'order_return_statuses' => array(Configuration::get('PS_OS_ERROR'), Configuration::get('PS_OS_CANCELED')),
            'allowed_payment_methods' => array( 0 => 'bankwire'),
            'order_available_statuses' => array(),
            /* changes over */
            
            'kbmp_seller_review_approval_required' => 1,
            'kbmp_show_seller_on_front' => 1,
            'kbmp_enable_seller_order_handling' => 1,
            'kbmp_enable_free_shipping' => 1,
            'kbmp_enable_seller_order_details' => 0,
            'kbmp_enable_seller_details' => 0,
            'kbmp_seller_listing_meta_keywords' => '',
            'kbmp_seller_listing_meta_description' => '',
            'kbmp_allowed_categories' => array(),
            'kbmp_seller_agreement' => $array_seller_agreement,
            'kbmp_seller_order_email_template' => $array_order_email_template,
            'kbmp_seller_order_cancel_email_template' => $array_order_cancel_email_template
            
        );
        if ($key != null && isset($settings[$key])) {
            return $settings[$key];
        }

        return $settings;
    }

    public static function getPaging($total, $start, $limit, $include_pagin_summary = false, $callback = '')
    {
        $total_pages = ceil((int)$total / $limit);
        $page_position = (($start - 1) * $limit);

        return array(
            'page_position' => $page_position,
            'paging_summary' => self::getPagingSummary($start, $limit, $total, $total_pages),
            'pagination' => self::generatePaginator(
                $start,
                $limit,
                $total,
                $total_pages,
                $callback,
                $include_pagin_summary
            )
        );
    }

    public static function getPagingSummary($start, $page_limit, $total_records, $total_pages)
    {
        $record_start = $start;
        $record_end = (int)$page_limit;
        if ($start == $total_pages) {
            $record_end = $total_records;
        } else {
            $record_end = $start * (int)$page_limit;
        }
        if ($start > 1) {
            $record_start = (($start - 1) * (int)$page_limit) + 1;
        }

        return array(
            'record_start' => $record_start,
            'record_end' => $record_end,
            'record_total' => $total_records,
            'record_pages' => $total_pages
        );
    }

    public static function generatePaginator(
        $start,
        $limit,
        $total_records,
        $total_pages,
        $ajaxcallfn = '',
        $show_total = true
    ) {
        $summary_txt = '';
        $pagination = '';
        if ($total_pages > 0 && $total_pages != 1 && $start <= $total_pages) {
            $summary_align = 'kb-pagination-left';
            $pagination_align = 'kb-pagination-right';
            if (Configuration::get('KBMP_FRONT_PAGINATION_ALIGN') == 'left') {
                $summary_align = 'kb-pagination-right';
                $pagination_align = 'kb-pagination-left';
            }
            $record_start = $start;
            $record_end = (int)$limit;
            if ($start > 1) {
                $record_start = (($start - 1) * (int)$limit) + 1;
                if ($start == $total_pages) {
                    $record_end = $total_records;
                } else {
                    $record_end = $start * (int)$limit;
                }
            }
            $module = Module::getInstanceByName('kbmarketplace');
            $summary_txt = '<div class="' . $summary_align . ' kb-paginate-summary">
				Showing ' . $record_start . ' to ' . $record_end . ' of '
                . $total_records . ' (' . $total_pages . $module->l(' pages', 'kbglobal').')</div>';

            $pagination .= '<div class="' . $pagination_align . '"><ul class="kb-pagination">';

            $ajax_call_function = '';
            if ($ajaxcallfn != '') {
                $ajax_call_function .= $ajaxcallfn . '({page_number});';
            }

            $right_links = $start + 3;
            $previous = $start - 3; //previous link
            $first_link = true; //boolean var to decide our first link

            if ($start > 1) {
                $previous_link = ($previous == 0) ? 1 : $previous;
                $pagination .= '<li class="first"><a href="javascript:void(0)" data-page="1" 
					onclick="' . str_replace('{page_number}', 1, $ajax_call_function) . '" 
					title="'.$module->l('First', 'kbglobal').'">&laquo;</a></li>'; //first link
                $pagination .= '<li><a href="javascript:void(0)" data-page="' . $previous_link . '" 
					onclick="' . str_replace('{page_number}', $previous_link, $ajax_call_function) . '" 
					title="'.$module->l('Previous', 'kbglobal').'">&lt;</a></li>'; //previous link
                for ($i = ($start - 2); $i < $start; $i++) {
                    if ($i > 0) {
                        $pagination .= '<li><a href="javascript:void(0)" data-page="' . $i . '" 
						onclick="' . str_replace('{page_number}', $i, $ajax_call_function) . '" 
						title="'.$module->l('Page', 'kbglobal') . $i . '">' . $i . '</a></li>';
                    }
                }
                $first_link = false; //set first link to false
            }

            if ($first_link) {
                $pagination .= '<li class="first active">' . $start . '</li>';
            } elseif ($start == $total_pages) {
                $pagination .= '<li class="last active">' . $start . '</li>';
            } else {
                $pagination .= '<li class="active">' . $start . '</li>';
            }

            for ($i = $start + 1; $i < $right_links; $i++) {
                if ($i <= $total_pages) {
                    $pagination .= '<li><a href="javascript:void(0)" data-page="' . $i . '" 
					onclick="' . str_replace('{page_number}', $i, $ajax_call_function) . '" 
					title="'.$module->l('Page', 'kbglobal') . $i . '">' . $i . '</a></li>';
                }
            }
            if ($start < $total_pages) {
                $next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<li><a href="javascript:void(0)" data-page="' . $next_link . '" 
					onclick="' . str_replace('{page_number}', $next_link, $ajax_call_function) . '" 
					title="'.$module->l('Next', 'kbglobal').'">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="javascript:void(0)" data-page="' . $total_pages . '" 
					onclick="' . str_replace('{page_number}', $total_pages, $ajax_call_function) . '" 
					title="'.$module->l('Last').'">&raquo;</a></li>'; //last link
            }

            $pagination .= '</div></ul>';
            if ($show_total) {
                return $summary_txt . $pagination;
            } else {
                return $pagination;
            }
        }
        return '';
    }

    public static function getCategories()
    {
        $root_category = Category::getRootCategories();
        $categories = array();
        $tmp = Category::getNestedCategories($root_category[0]['id_category']);
        foreach ($tmp as $c) {
            $categories[] = array(
                'id_category' => $c['id_category'],
                'name' => KbGlobal::getHiphenString((int)$c['level_depth']) . $c['name'],
            );
            if (isset($c['children']) && is_array($c['children']) && count($c['children']) > 0) {
                KbGlobal::generateCategoryTree($c['children'], $categories);
            }
        }
        return $categories;
    }

    public static function generateCategoryTree($categories, &$generated_tree)
    {
        foreach ($categories as $cat) {
            $generated_tree[] = array(
                'id_category' => $cat['id_category'],
                'name' => self::getHiphenString((int)$cat['level_depth']) . $cat['name'],
            );
            if (isset($cat['children']) && is_array($cat['children']) && count($cat['children']) > 0) {
                self::generateCategoryTree($cat['children'], $generated_tree);
            }
        }
    }

    public static function getHiphenString($depth = 0)
    {
        $str = '';
        if ($depth == 1) {
            return $str;
        }

        for ($i = 0; $i < $depth; $i++) {
            $str .= '-';
        }
        return $str;
    }

    public static function getApporvalStatus($key = null)
    {
        $module = Module::getInstanceByName('kbmarketplace');
        $tmp = array(
            self::APPROVAL_WAITING => $module->l('Waiting for Approval', 'kbglobal'),
            self::APPROVED => $module->l('Approved', 'kbglobal'),
            self::DISSAPPROVED => $module->l('Disapproved', 'kbglobal'),
            self::CANCELLED => $module->l('Cancelled', 'kbglobal')
        );
        if ($key !== null && $key !== '') {
            if (isset($tmp[$key])) {
                return $tmp[$key];
            } else {
                return '';
            }
        } else {
            return $tmp;
        }
    }

    public static function getStatuses()
    {
        $module = Module::getInstanceByName('kbmarketplace');
        return array(
            self::DISABLE => $module->l('Disable', 'kbglobal'),
            self::ENABLE => $module->l('Enable', 'kbglobal')
        );
    }

    public static function convertRatingIntoPercent($overall_rating = 0)
    {
        return (float)((float)($overall_rating / (int)self::MAX_RATING) * 100);
    }

    public static function makeParentToChildCategoryStr(
        $category_w_parents_array = array(),
        $id_lang = null,
        $include_home = false
    ) {
        $root_category = Category::getRootCategory($id_lang);

        $str = '';

        if (count($category_w_parents_array) > 0) {
            foreach ($category_w_parents_array as $c) {
                if ($c['id_category'] == $root_category->id && !$include_home) {
                    continue;
                } else {
                    $str .= $c['name'] . ' >> ';
                }
            }
        }

        return rtrim($str, ' >> ');
    }

    public static function getBaseLink($ssl = null, $id_shop = null)
    {
        static $force_ssl = null;
        if ($ssl === null) {
            if ($force_ssl === null) {
                $force_ssl = (Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE'));
            }
            $ssl = $force_ssl;
        }

        if (Configuration::get('PS_MULTISHOP_FEATURE_ACTIVE') && $id_shop !== null) {
            $shop = new Shop($id_shop);
        } else {
            $shop = Context::getContext()->shop;
        }

        $base = (($ssl && Configuration::get('PS_SSL_ENABLED'))
            ? 'https://' . $shop->domain_ssl : 'http://' . $shop->domain);

        return $base . $shop->getBaseURI();
    }
    
    public static function getSellerLink($seller, $alias = null, $id_lang = null, $id_shop = null, $force_routes = false)
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

        $url = self::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'), $id_shop).$lang_link;

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
        $params['rewrite'] = (!$alias) ? $seller->profile_url : $alias;

        $params['meta_keywords'] =    Tools::str2url($seller->meta_keyword);
        $params['meta_title'] = Tools::str2url($seller->title);

        return $url.$dispatcher->createUrl('kb_seller_rule', $id_lang, $params, $force_routes, '', $id_shop);
    }
}
