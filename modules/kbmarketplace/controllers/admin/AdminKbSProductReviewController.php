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

class AdminKbSProductReviewController extends AdminKbMarketplaceCoreController
{

    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'kb_mp_seller_product_review';
        $this->className = 'KbSellerProductReview';
        $this->identifier = 'id_seller_product_review';
        $this->lang = false;
        $this->display = 'list';
        $this->allow_export = true;
        $this->context = Context::getContext();

        parent::__construct();
        $this->toolbar_title = $this->module->l('Product Reviews', 'adminkbsproductreviewcontroller');
        /* Changes started by rishabh jain o 6th sep 2018
         * to add compatibilitty with knowband review remainder plugin
         *
         */
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Module::isInstalled('productcomments')) {
            $this->_select = 'pc.`id_product_comment`, 
			IF(c.id_customer, CONCAT(c.`firstname`, \' \',  c.`lastname`), pc.customer_name) customer_name, 
			pc.`title`, pc.`content`, pc.`grade`, pc.`date_add`, pl.`name`, pc.`validate`';

            if (Tools::getIsset('id_seller') && Tools::getValue('id_seller') > 0) {
                $this->_join .= ' INNER JOIN ' . _DB_PREFIX_ . 'kb_mp_seller as sr ON (a.`id_seller` = sr.`id_seller` 
				AND sr.id_seller = ' . (int) Tools::getValue('id_seller') . ')';
            } else {
                $this->_select .=', CONCAT(LEFT(sn.`firstname`, 1), \'. \', sn.`lastname`) AS `seller_name`';
                $this->_join .= ' INNER JOIN ' . _DB_PREFIX_ . 'kb_mp_seller as sr on (a.id_seller = sr.id_seller)';
            }

            $this->_join .= '
			INNER JOIN ' . _DB_PREFIX_ . 'product_comment as pc on (a.id_product_comment = pc.id_product_comment) 
			INNER JOIN `' . _DB_PREFIX_ . 'customer` sn ON (sr.`id_customer` = sn.`id_customer`) 
			LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = pc.`id_customer`) 
			LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (pl.`id_product` = pc.`id_product` 
			AND pl.`id_lang` = ' . (int) $this->context->language->id . Shop::addSqlRestrictionOnLang('pl') . ')';

            $this->_orderBy = 'a.id_seller_product_review';
            $this->_orderWay = 'DESC';

            $ratings = array(
                '0' => '0',
                '0.5' => '0.5',
                '1' => '1',
                '1.5' => '1.5',
                '2' => '2',
                '2.5' => '2.5',
                '3' => '3',
                '3.5' => '3.5',
                '4' => '4',
                '4.5' => '4.5',
                '5' => '5');

            $this->fields_list = array(
                'id_seller_product_review' => array(
                    'width' => 'auto',
                    'title' => $this->module->l('ID', 'adminkbsproductreviewcontroller'),
                    'align' => 'text-center',
                    'class' => 'fixed-width-xs'
                ),
                'name' => array(
                    'title' => $this->module->l('Product', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'filter_key' => 'pl!name',
                    'order_key' => 'pl.name',
                ),
                'seller_name' => array(
                    'title' => $this->module->l('Seller', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'filter_key' => 'seller_name',
                    'order_key' => 'seller_name',
                ),
                'customer_name' => array(
                    'title' => $this->module->l('Customer', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'filter_key' => 'customer_name',
                    'order_key' => 'customer_name',
                ),
                'title' => array(
                    'title' => $this->module->l('Title', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'filter_key' => 'pc!title',
                    'order_key' => 'pc.title',
                ),
                'content' => array(
                    'title' => $this->module->l('Comment', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => false,
                    'class' => 'comment_col_w',
                    'maxlength' => 200
                ),
                'grade' => array(
                    'title' => $this->module->l('Rating', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'type' => 'select',
                    'list' => $ratings,
                    'callback' => 'showRating',
                    'filter_type' => 'float',
                    'filter_key' => 'pc!grade',
                    'order_key' => 'pc.grade'
                ),
                'validate' => array(
                    'title' => $this->module->l('Status', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'type' => 'select',
                    'list' => array(
                        KbGlobal::APPROVAL_WAITING => KbGlobal::getApporvalStatus(KbGlobal::APPROVAL_WAITING),
                        KbGlobal::APPROVED => KbGlobal::getApporvalStatus(KbGlobal::APPROVED)
                    ),
                    'callback' => 'getReviewStatus',
                    'filter_type' => 'int',
                    'filter_key' => 'pc!validate',
                    'order_key' => 'pc.validate'
                ),
                'date_add' => array(
                    'title' => $this->module->l('Added', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                )
            );

            $this->addRowAction('viewmodal');
            $this->addRowAction('approve');
            $this->addRowAction('deletewreason');
            if (!Module::isInstalled('productcomments')) {
                $this->_select = null;
                $this->_join = null;
                $this->_orderBy = null;
                $this->_orderWay = null;
                $this->fields_list = null;
            }
        } elseif (Module::isInstalled('kbreviewincentives') && isset($mp_config['kbmp_enable_product_review_compatibility']) && $mp_config['kbmp_enable_product_review_compatibility'] == 1) {
            $this->_select = 'pc.`review_id`, 
			pc.author customer_name, 
			pc.`review_title`, pc.`description`, pc.`ratings`, pc.`date_add`, pl.`name`, pc.`current_status`';

            if (Tools::getIsset('id_seller') && Tools::getValue('id_seller') > 0) {
                $this->_join .= ' INNER JOIN ' . _DB_PREFIX_ . 'kb_mp_seller as sr ON (a.`id_seller` = sr.`id_seller` 
				AND sr.id_seller = ' . (int) Tools::getValue('id_seller') . ')';
            } else {
                $this->_select .=', CONCAT(LEFT(sn.`firstname`, 1), \'. \', sn.`lastname`) AS `seller_name`';
                $this->_join .= ' INNER JOIN ' . _DB_PREFIX_ . 'kb_mp_seller as sr on (a.id_seller = sr.id_seller)';
            }

            $this->_join .= '
			INNER JOIN ' . _DB_PREFIX_ . 'velsof_product_reviews as pc on (a.id_product_comment = pc.review_id) 
			INNER JOIN `' . _DB_PREFIX_ . 'customer` sn ON (sr.`id_customer` = sn.`id_customer`) 
			LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (pl.`id_product` = pc.`product_id` 
			AND pl.`id_lang` = ' . (int) $this->context->language->id . Shop::addSqlRestrictionOnLang('pl') . ')';

            $this->_orderBy = 'a.id_seller_product_review';
            $this->_orderWay = 'DESC';
            $ratings = array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5');
            $approve_statuses = array(
                '0' => $this->module->l('Disapproved', 'adminkbsproductreviewcontroller'),
                '1' => $this->module->l('Approved', 'adminkbsproductreviewcontroller'),
                '3' => $this->module->l('Pending', 'adminkbsproductreviewcontroller'),
            );
            $this->fields_list = array(
                'id_seller_product_review' => array(
                    'width' => 'auto',
                    'title' => $this->module->l('ID', 'adminkbsproductreviewcontroller'),
                    'align' => 'text-center',
                    'class' => 'fixed-width-xs'
                ),
                'name' => array(
                    'title' => $this->module->l('Product', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'filter_key' => 'pl!name',
                    'order_key' => 'pl.name',
                ),
                'seller_name' => array(
                    'title' => $this->module->l('Seller', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'filter_key' => 'seller_name',
                    'order_key' => 'seller_name',
                ),
                'customer_name' => array(
                    'title' => $this->module->l('Customer', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'filter_key' => 'pc!author',
                    'order_key' => 'pc.author',
                ),
                'review_title' => array(
                    'title' => $this->module->l('Title', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'filter_key' => 'pc!review_title',
                    'order_key' => 'pc.review_title',
                ),
                'description' => array(
                    'title' => $this->module->l('Comment', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => false,
                    'class' => 'comment_col_w',
                    'maxlength' => 200
                ),
                'ratings' => array(
                    'title' => $this->module->l('Rating', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'type' => 'select',
                    'list' => $ratings,
                    'callback' => 'showRating',
                    'filter_type' => 'float',
                    'filter_key' => 'pc!ratings',
                    'order_key' => 'pc.ratings'
                ),
                'current_status' => array(
                    'title' => $this->module->l('Status', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'type' => 'select',
                    'list' => $approve_statuses,
                    'callback' => 'getReviewStatus',
                    'filter_key' => 'pc!current_status',
                    'order_key' => 'pc.current_status'
                ),
                'date_add' => array(
                    'title' => $this->module->l('Added', 'adminkbsproductreviewcontroller'),
                    'havingFilter' => true,
                    'type' => 'date',
                    'filter_key' => 'pc!date_add',
                    'order_key' => 'pc.date_add',
                
                )
            );

            $this->addRowAction('viewmodal');
            $this->addRowAction('approvereview');
            $this->addRowAction('disapprovereview');
            $this->addRowAction('deletewreason');
        }
    }

    public function initProcess()
    {
        parent::initProcess();
        if (Tools::getIsset('approve' . $this->table)) {
            // updated to approvereview
            /* Changes by rishabh jain on 9th sept 2018
             * to add compatibility with product comment module
             */
            $this->action = 'approvereview';
        } elseif (Tools::getIsset('dissapprove' . $this->table)) {
            $this->action = 'disapprovereview';
        }
    }

    public function postProcess()
    {
        parent::postProcess();
    }

    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);
        $this->addJqueryPlugin('fancybox');
    }

    public function initContent()
    {
        /* Changes started by rishabh jain o 6th sep 2018
         * to add compatibilitty with knowband review remainder plugin
         *
         */
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Module::isInstalled('productcomments')) {
            $tpl = $this->custom_smarty->createTemplate('ajax_view_popup.tpl');
            $this->content .= $tpl->fetch();
        } elseif (Module::isInstalled('kbreviewincentives') && isset($mp_config['kbmp_enable_product_review_compatibility']) && $mp_config['kbmp_enable_product_review_compatibility'] == 1) {
            $tpl = $this->custom_smarty->createTemplate('ajax_view_popup.tpl');

            $this->content .= $tpl->fetch();
        } else {
            $this->errors[] = $this->module->l('Neither Product Comment nor Knowband Product Review module is installed or disabled. Please install either of them first', 'adminkbsproductreviewcontroller');
        }

        parent::initContent();
    }

    public function initToolbar()
    {
        parent::initToolbar();
        unset($this->toolbar_btn['new']);
    }

    /*
     * render rating star
     */

    public function showRating($id_row, $tr)
    {
        unset($id_row);
        /* Changes started by rishabh jain on 6th septembet
         * to add comaptibility with kb product review module
         */
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Module::isInstalled('productcomments')) {
            $width = (float) ((float) $tr['grade'] / 5) * 100;
        } elseif (Module::isInstalled('kbreviewincentives') && isset($mp_config['kbmp_enable_product_review_compatibility']) && $mp_config['kbmp_enable_product_review_compatibility'] == 1) {
            $width = (float) ((float) $tr['ratings'] / 5) * 100;
        }
        return '<div class="vss_seller_ratings"><div class="vss_rating_unfilled">★★★★★</div>
			<div class="vss_rating_filled" style="width:' . $width . '%">★★★★★</div></div>';
    }

    /*
     * render rating star
     */

    public function getReviewStatus($id_row, $tr)
    {
        unset($id_row);
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        /* Changes started by rishabh jain on 6th septembet
         * to add comaptibility with kb product review module
         */
        if (Module::isInstalled('productcomments')) {
            if ($tr['validate'] == 0) {
                return $this->approval_statuses[0];
            } else {
                return $this->approval_statuses[1];
            }
        } elseif (Module::isInstalled('kbreviewincentives') && isset($mp_config['kbmp_enable_product_review_compatibility']) && $mp_config['kbmp_enable_product_review_compatibility'] == 1) {
            $approved_statuses = array(
                0 => $this->module->l('Disapproved', 'adminkbsproductreviewcontroller'),
                1 => $this->module->l('Approved', 'adminkbsproductreviewcontroller'),
                3 => $this->module->l('Pending', 'adminkbsproductreviewcontroller'),
            );
            if ($tr['current_status'] == 0) {
                return $approved_statuses[0];
            } elseif ($tr['current_status'] == 1) {
                return $approved_statuses[1];
            } else {
                return $approved_statuses[3];
            }
        }
    }

    public function processKbAjaxView()
    {
        $this->render_ajax_html = true;

        $id_review = (int) Tools::getValue($this->identifier);

        $review = new $this->className($id_review);
        $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
        if (Module::isInstalled('productcomments')) {
            $sql = 'Select pl.`name`, pc.id_product_comment, pc.`title`, pc.`content`, pc.`grade`, pc.`date_add`, 
                    IF(c.id_customer, CONCAT(c.`firstname`, \' \',  c.`lastname`), pc.customer_name) as customer_name 
                    from ' . _DB_PREFIX_ . 'product_comment as pc 
                    LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = pc.`id_customer`) 
                    LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl 
                    ON (
                            pl.`id_product` = pc.`id_product` 
                            AND pl.`id_lang` = ' . (int) $this->context->language->id . Shop::addSqlRestrictionOnLang('pl') . ') 
                    WHERE pc.id_product_comment = ' . (int) $review->id_product_comment;

            $data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql, true);

            if ($data && is_array($data)) {
                $data['overall_grade_percent'] = number_format(KbGlobal::convertRatingIntoPercent($data['grade']), 2);
                $data['date_add'] = Tools::displayDate($data['date_add'], null, true);
                $data['title'] = Tools::safeOutput($data['title'], true);
                $data['content'] = Tools::safeOutput($data['content'], true);
                $indivual_grades = array();
                //get Individual grade
                $sql = 'Select pcg.*, pcc.name from ' . _DB_PREFIX_ . 'product_comment_grade as pcg 
                                    INNER JOIN ' . _DB_PREFIX_ . 'product_comment_criterion_lang as pcc 
                                    ON (pcg.id_product_comment_criterion = pcc.id_product_comment_criterion) 
                                    WHERE pcg.id_product_comment = ' . (int) $data['id_product_comment']
                    . ' AND pcc.id_lang = ' . (int) $this->context->language->id;

                $results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
                if ($results && count($results) > 1) {
                    foreach ($results as &$result) {
                        $result['grade_percent'] = number_format(KbGlobal::convertRatingIntoPercent($result['grade']), 2);
                    }
                    $indivual_grades = $results;
                }

                $tpl = $this->custom_smarty->createTemplate('view_product_comment.tpl');

                $tpl->assign(array(
                    'data' => $data,
                    'individual_grades' => $indivual_grades,
                    'post_on_title' => $this->module->l('Posted on', 'adminkbsproductreviewcontroller'),
                    'by_title' => $this->module->l('by', 'adminkbsproductreviewcontroller'),
                    'overall_title' => $this->module->l('Overall Rating', 'adminkbsproductreviewcontroller'),
                    'summary_title' => $this->module->l('Summary', 'adminkbsproductreviewcontroller'),
                    'comment_title' => $this->module->l('Comment', 'adminkbsproductreviewcontroller')
                ));
                return $tpl->fetch();
            }
        } elseif (Module::isInstalled('kbreviewincentives') && isset($mp_config['kbmp_enable_product_review_compatibility']) && $mp_config['kbmp_enable_product_review_compatibility'] == 1) {
            $sql = 'Select pl.`name`, pc.review_id, pc.`review_title`, pc.`description`, pc.`ratings`, pc.`date_add`, 
			IF(c.id_customer, CONCAT(c.`firstname`, \' \',  c.`lastname`), pc.author) as customer_name 
			from ' . _DB_PREFIX_ . 'velsof_product_reviews as pc 
			LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = pc.`customer_id`) 
			LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl 
			ON (
				pl.`id_product` = pc.`product_id` 
				AND pl.`id_lang` = ' . (int) $this->context->language->id . Shop::addSqlRestrictionOnLang('pl') . ') 
			WHERE pc.review_id = ' . (int) $review->id_product_comment;

            $data = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql, true);

            if ($data && is_array($data)) {
                $data['overall_grade_percent'] = number_format(KbGlobal::convertRatingIntoPercent($data['ratings']), 2);
                $data['date_add'] = Tools::displayDate($data['date_add'], null, true);
                $data['title'] = Tools::safeOutput($data['review_title'], true);
                $data['content'] = Tools::safeOutput($data['description'], true);
                $indivual_grades = array();
                $tpl = $this->custom_smarty->createTemplate('view_product_comment.tpl');

                $tpl->assign(array(
                    'data' => $data,
                    'individual_grades' => $indivual_grades,
                    'post_on_title' => $this->module->l('Posted on', 'adminkbsproductreviewcontroller'),
                    'by_title' => $this->module->l('by', 'adminkbsproductreviewcontroller'),
                    'overall_title' => $this->module->l('Overall Rating', 'adminkbsproductreviewcontroller'),
                    'summary_title' => $this->module->l('Summary', 'adminkbsproductreviewcontroller'),
                    'comment_title' => $this->module->l('Comment', 'adminkbsproductreviewcontroller')
                ));
                return $tpl->fetch();
            }
        }
        return Tools::displayError($this->module->l('Data Not Found', 'adminkbsproductreviewcontroller'));
    }
    /* changes started vy rishabh jain on 6th sep 2018
     * to  approve a review added by kb product review module
     */
    public function processApproveReview()
    {
        if (Tools::getIsset($this->identifier)) {
            $object = new $this->className(Tools::getValue($this->identifier));

            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (Module::isInstalled('productcomments')) {
                try {
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->update(
                        'product_comment',
                        array(
                            'validate' => 1
                        ),
                        'id_product_comment = ' . (int) $object->id_product_comment
                    );
                    Hook::exec('actionKbMarketPlaceProductReviewApprove', array(
                        'object' => $object));
                    $this->context->cookie->__set(
                        'kb_redirect_success',
                        $this->module->l('Review has been approved and ready to display on front.', 'adminkbsproductreviewcontroller')
                    );
                } catch (Exception $e) {
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $e->getMessage()
                    );
                }
            } elseif (Module::isInstalled('kbreviewincentives') && isset($mp_config['kbmp_enable_product_review_compatibility']) && $mp_config['kbmp_enable_product_review_compatibility'] == 1) {
                try {
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->update(
                        'velsof_product_reviews',
                        array(
                            'current_status' => 1
                        ),
                        'review_id = ' . (int) $object->id_product_comment
                    );
                    // to update in table
                    require_once(_PS_MODULE_DIR_ . 'kbreviewincentives/kbreviewincentives.php');
                    $module = Module::getInstanceByName('kbreviewincentives');
                    $sql = "SELECT * FROM " . _DB_PREFIX_ . "velsof_product_reviews WHERE review_id = '" . (int) $object->id_product_comment . "' AND current_status='1'";
                    $review_data = Db::getInstance()->getRow($sql);
                    if (!empty($review_data)) {
                        $pro_obj = new Product($review_data['product_id']);
                        if ($review_data['incentive_amount'] == 0) {
                            if ($module->sendNotificationEmail('without_coupon_temp', $review_data, (int) $this->context->language->id, null, $pro_obj)) {
                                $module->addLogEntry('Success', 'An email has been sent for review approval information.', 'An email is sent for approving a review of customer having customer id ' . $review_data['customer_id'], 'AdminKbrcReviewsController::processUpdate()', '');
                                $this->context->cookie->__set(
                                    'kb_redirect_success',
                                    $module->l('Email has been sent to customer successfully.', 'AdminKbrcReviews')
                                );
                            } else {
                                $module->addLogEntry('Error', 'An email could not be send for review approval information.', 'An email send get failed for approving a review of customer having customer id ' . $review_data['customer_id'], 'AdminKbrcReviewsController::processUpdate()', '');
                                $this->context->cookie->__set(
                                    'kb_redirect_error',
                                    $module->l('Email could not sent to customer.', 'AdminKbrcReviews')
                                );
                            }
                        } elseif ($review_data['incentive_amount'] != 0) {
                            $cat_result = $module->checkCategory($review_data['category_id']);
                            if ($cat_result == false) {         //This product category not blacklisted
                                //Check if product is black listed or not
                                $pro_result = $module->checkProduct($review_data['product_id']);
                                if ($pro_result == false) {
                                    $sql = "SELECT * FROM " . _DB_PREFIX_ . "velsof_incentive_coupon vic INNER JOIN " . _DB_PREFIX_ . "velsof_product_reviews vpr ON vic.review_id = vpr.review_id  WHERE vpr.product_id = '" . (int) $review_data['product_id'] . "' AND vpr.customer_id = '" . (int) $review_data['customer_id'] . "'";
                                    $coupon_data = Db::getInstance()->getRow($sql);
                                    if (empty($coupon_data)) {
                                        $module_settings = Tools::Unserialize(Configuration::get('KBRC_PRODUCT_REVIEW_INCENTIVES'));
                                        if ($module->checkIncentiveCriteria($module_settings['incentive_criteria'], $review_data)) {
                                            $coupon_details = array();
                                            $coupon_details = $module->createCoupon($review_data);  //Function to get coupon
                                        }
                                        if ($module->sendNotificationEmail('with_coupon_temp', $review_data, (int) $this->context->language->id, null, $pro_obj, $coupon_details)) {
                                            $module->addLogEntry('Success', 'A coupon email has been sent.', 'Incentive has been sent to customer having customer id ' . $review_data['customer_id'], 'AdminKbrcReviewsController::processUpdate()', '');
                                            $this->context->cookie->__set(
                                                'kb_redirect_success',
                                                $module->l('Email has been sent to customer successfully.', 'AdminKbrcReviews')
                                            );
                                        } else {
                                            $module->addLogEntry('Error', 'A coupon email could not send.', 'Incentive could not be send to customer having customer id ' . $review_data['customer_id'], 'AdminKbrcReviewsController::processUpdate()', '');
                                            $this->context->cookie->__set(
                                                'kb_redirect_error',
                                                $module->l('Email could not sent to customer.', 'AdminKbrcReviews')
                                            );
                                        }
                                    } else {
                                        if ($module->sendNotificationEmail('without_coupon_temp', $review_data, (int) $this->context->language->id, null, $pro_obj)) {
                                            $module->addLogEntry('Success', 'An email has been sent for review approval information.', 'An email is sent for approving a review of customer having customer id' . $review_data['customer_id'], 'AdminKbrcReviewsController::processUpdate()', '');
                                            $this->context->cookie->__set(
                                                'kb_redirect_success',
                                                $this->module->l('Email has been sent to customer successfully.', 'AdminKbrcReviews')
                                            );
                                        } else {
                                            $module->addLogEntry('Error', 'An email could not be send for review approval information.', 'An email send get failed for approving a review of customer having customer id' . $review_data['customer_id'], 'AdminKbrcReviewsController::processUpdate()', '');
                                            $this->context->cookie->__set(
                                                'kb_redirect_error',
                                                $module->l('Email could not sent to customer.', 'AdminKbrcReviews')
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    }
                    Hook::exec('actionKbMarketPlaceProductReviewApprove', array(
                        'object' => $object));
                    $this->context->cookie->__set(
                        'kb_redirect_success',
                        $this->module->l('Review has been approved and ready to display on front.', 'adminkbsproductreviewcontroller')
                    );
                } catch (Exception $e) {
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $e->getMessage()
                    );
                }
            }
        } else {
            $this->context->cookie->__set(
                'kb_redirect_error',
                $this->module->l('Not able to create object.', 'adminkbsproductreviewcontroller')
            );
        }
        Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbSProductReview'));
    }

    /* changes by rishabh jain
     * added function to disapprove
     */
    public function processDisapproveReview()
    {
        if (Tools::getIsset($this->identifier)) {
            $object = new $this->className(Tools::getValue($this->identifier));
            
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            if (Module::isInstalled('kbreviewincentives') && isset($mp_config['kbmp_enable_product_review_compatibility']) && $mp_config['kbmp_enable_product_review_compatibility'] == 1) {
                try {
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->update(
                        'velsof_product_reviews',
                        array(
                            'current_status' => 0
                        ),
                        'review_id = ' . (int) $object->id_product_comment
                    );

                    // to update in table
                    require_once(_PS_MODULE_DIR_ . 'kbreviewincentives/kbreviewincentives.php');
                    $module = Module::getInstanceByName('kbreviewincentives');

                    $sql = "SELECT * FROM " . _DB_PREFIX_ . "velsof_product_reviews WHERE review_id = '" . (int) $object->id_product_comment . "' AND current_status='0'";
                    $review_data = Db::getInstance()->getRow($sql);
                    if (!empty($review_data)) {
                        if ($module->sendNotificationEmail('review_dis', $review_data, (int) $this->context->language->id)) {
                            $module->addLogEntry('Success', 'Email has been sent for rejecting a review.', 'A review is disapproved of a customer having customer id ' . $review_data['customer_id'], 'AdminKbrcReviewsController::processUpdate()', '');
                            $this->context->cookie->__set(
                                'kb_redirect_success',
                                $this->module->l('Email has been sent to customer successfully.', 'AdminKbrcReviews')
                            );
                        } else {
                            $module->addLogEntry('Error', 'Email could not be send for rejecting a review.', 'A review is disapproved of a customer having customer id ' . $review_data['customer_id'] . ' But email could not be sent.', 'AdminKbrcReviewsController::processUpdate()', '');
                            $this->context->cookie->__set(
                                'kb_redirect_error',
                                $this->module->l('Email could not sent to customer.', 'AdminKbrcReviews')
                            );
                        }
                    }


                    Hook::exec('actionKbMarketPlaceProductReviewApprove', array(
                        'object' => $object));
                    $this->context->cookie->__set(
                        'kb_redirect_success',
                        $module->l('Review has been disapproved successfully.', 'adminkbsproductreviewcontroller')
                    );
                } catch (Exception $e) {
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $e->getMessage()
                    );
                }
            }
        } else {
            $this->context->cookie->__set(
                'kb_redirect_error',
                $this->module->l('Not able to create object.', 'adminkbsproductreviewcontroller')
            );
        }
        Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbSProductReview'));
    }
    /* changes over */
    public function processDelete()
    {
        if (Tools::getIsset($this->identifier)) {
            $object = new $this->className(Tools::getValue($this->identifier));
            $mp_config = Tools::unserialize(Configuration::get('KB_MARKETPLACE_CONFIG'));
            /* changes started vy rishabh jain on 6th sep 2018
             * to  delete a review added by kb product review module
             */
            if (Module::isInstalled('productcomments')) {
                try {
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->delete(
                        'product_comment',
                        'id_product_comment = ' . (int) $object->id_product_comment
                    );
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->delete(
                        'product_comment_grade',
                        'id_product_comment = ' . (int) $object->id_product_comment
                    );
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->delete(
                        'product_comment_report',
                        'id_product_comment = ' . (int) $object->id_product_comment
                    );
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->delete(
                        'product_comment_usefulness',
                        'id_product_comment = ' . (int) $object->id_product_comment
                    );

                    $object->delete();

                    Hook::exec(
                        'actionKbMarketPlaceProductCommentDelete',
                        array(
                            'id_seller_product_review' => Tools::getValue($this->identifier),
                            'comment_id' => $object->id_product_comment
                        )
                    );
                    $this->context->cookie->__set(
                        'kb_redirect_success',
                        $this->module->l('Review has been deleted.', 'adminkbsproductreviewcontroller')
                    );
                } catch (Exception $e) {
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $e->getMessage()
                    );
                }
            } elseif (Module::isInstalled('kbreviewincentives') && isset($mp_config['kbmp_enable_product_review_compatibility']) && $mp_config['kbmp_enable_product_review_compatibility'] == 1) {
                try {
                    Db::getInstance(_PS_USE_SQL_SLAVE_)->delete(
                        'velsof_product_reviews',
                        'review_id = ' . (int) $object->id_product_comment
                    );
                    $object->delete();

                    Hook::exec(
                        'actionKbMarketPlaceProductCommentDelete',
                        array(
                            'id_seller_product_review' => Tools::getValue($this->identifier),
                            'comment_id' => $object->id_product_comment
                        )
                    );
                    $this->context->cookie->__set(
                        'kb_redirect_success',
                        $this->module->l('Review has been deleted.', 'adminkbsproductreviewcontroller')
                    );
                } catch (Exception $e) {
                    $this->context->cookie->__set(
                        'kb_redirect_error',
                        $e->getMessage()
                    );
                }
            }
        } else {
            $this->context->cookie->__set(
                'kb_redirect_error',
                $this->module->l('Not able to create object.', 'adminkbsproductreviewcontroller')
            );
        }
        Tools::redirectAdmin($this->context->link->getAdminLink('AdminKbSProductReview'));
    }
}
