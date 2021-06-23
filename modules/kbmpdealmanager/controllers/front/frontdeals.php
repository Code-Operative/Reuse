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

require_once _PS_MODULE_DIR_ . 'kbmarketplace/controllers/front/KbFrontCore.php';

class KbmpdealmanagerFrontdealsModuleFrontController extends KbmarketplaceFrontCoreModuleFrontController
{
    public $controller_name = 'frontdeals';

    public function __construct()
    {
        require_once _PS_MODULE_DIR_ . 'kbmpdealmanager/KbDealRule.php';
        parent::__construct();

        $this->module = Module::getInstanceByName('kbmarketplace');
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->addCSS(_PS_MODULE_DIR_ . 'kbmpdealmanager/views/css/front.css');
        $this->addJS(_PS_MODULE_DIR_ . 'kbmpdealmanager/views/js/kbmp_timer.js');
        $this->addJS(_PS_MODULE_DIR_ . 'kbmpdealmanager/views/js/front.js');
    }

    public function initContent()
    {
        $this->renderCustomerDeals();

        parent::initContent();
    }

    protected function setKbTemplate($template)
    {
        if (!$path = $this->getKbTemplatePath($template)) {
            throw new PrestaShopException("Template '$template' not found");
        }

        $this->kbtemplate = $path;
    }

    public function fetchTemplate()
    {
        if (!Tools::file_exists_cache($this->kbtemplate)) {
            throw new PrestaShopException("Template ' . $this->kbtemplate . ' not found");
        }

        return $this->context->smarty->fetch($this->kbtemplate);
    }

    protected function renderCustomerDeals()
    {
        $temp_module_name = $this->kb_module_name;
        $this->kb_module_name = 'kbmpdealmanager';

        $current_date = date('Y-m-d H:i:s', time());
        $filter = '';
        $filter = ' AND from_date <= "' . pSQL($current_date) . '" AND end_date >= "' . pSQL($current_date) . '"';
        $total = KbSellerDeal::getSellerDeals(
            null,
            $this->context->language->id,
            true,
            true,
            null,
            null,
            $filter
        );

        if ((int) $total > 0) {
            $results = KbSellerDeal::getSellerDeals(
                null,
                $this->context->language->id,
                false,
                true,
                null,
                null,
                $filter
            );

            foreach ($results as &$deal) {
                if ($deal['active'] == 1) {
                    if ($deal['id_cart_rule'] != 0) {
                        $cart_rule_obj = new CartRule((int) $deal['id_cart_rule']);
                        if ($cart_rule_obj->id_customer != 0) {
                            if ($cart_rule_obj->id_customer != (int) Context::getContext()->customer->id) {
                                foreach ($results as $key => $res) {
                                    if ($res['id_seller_deal'] == $deal['id_seller_deal']) {
                                        unset($results[$key]);
                                    }
                                }
                                continue;
                            }
                        }
                    }
                    $seller = new KbSeller($deal['id_seller'], $this->context->language->id);
                    if (Validate::isLoadedObject($seller)) {
                        $deal['shop_name'] = $seller->title;
                        // chnages by rishabh jain
                        $image_url = '';
                        $base_link = KbGlobal::getBaseLink((bool)Configuration::get('PS_SSL_ENABLED'));
                        if (!empty($deal['banner_path'])) {
                            $image_url = $base_link . 'modules/kbmarketplace/' . 'views/img/seller_media/'. $deal['id_seller'] . '/' . $deal['banner_path'];
                            $deal['banner_path'] = $image_url;
                        } else {
                            $deal['banner_path'] = $base_link . 'modules/' . $this->module->name . '/' . 'views/img/'.KbGlobal::SELLER_DEFAULT_BANNER;
                        }
                        // changes over

                        $start = strtotime(date('Y-m-d H:i:s', time()));
                        $end = strtotime(date('Y-m-d H:i:s', strtotime($deal['end_date'])));
                        $diff = $end - $start;
                        $days = floor($diff / 86400);
                        $hours = floor(($diff - ($days * 86400)) / 3600);
                        $mins = floor(($diff - (($days * 86400) + ($hours * 3600))) / 60);
                        $secs = floor(($diff - (($days * 86400) + ($hours * 3600) + ($mins * 60))) / 60);
                        $deal['days'] = $days;
                        $deal['hours'] = $hours;
                        $deal['mins'] = $mins;
                        $deal['secs'] = $secs;
                    }
                }
            }
            $this->context->smarty->assign('deals', $results);
        } else {
            $this->context->smarty->assign(
                'empty_list',
                $this->getTranslatedText('No Discount and Offers are available', 'Frontdeals')
            );
        }

        $this->setKbTemplate('deals/deals_to_customers.tpl');
        $this->kb_module_name = $temp_module_name;
    }
}
