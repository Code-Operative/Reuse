<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store.
 *
 * @author    knowband.com <support@knowband.com>
 * @copyright 2015 knowband
 * @license   see file: LICENSE.txt
 * @category  PrestaShop Module
 */

class KbmarketplaceAjaxHandlerModuleFrontController extends ModuleFrontController
{
    public function init()
    {
        parent::init();
        $temp_obj = Module::getInstanceByName('kbmarketplace');
        if (Tools::getValue('method') == 'remove') {
            $json = array();
            $json['status'] = false;
            $json['status'] = $temp_obj->removeSellerFromShortlist(Tools::getValue('sfl_shortproduct_id'));
            // changes by rishabh jain for updating shortlist count
            $shortlisted_sellers = array();
            if ($this->context->cookie->velsof_shortlist_seller != '') {
                $shortlisted = explode(',', $this->context->cookie->velsof_shortlist_seller);
            } else {
                $shortlisted = array();
            }
            // changes over
            $json['shortlist_count'] = count($shortlisted);
            $favourite_seller_link = $this->context->link->getModuleLink(
                'kbmarketplace',
                'favouritesellers',
                array(),
                (bool)Configuration::get('PS_SSL_ENABLED')
            );
            $json['redirect_link'] = $favourite_seller_link;
            echo Tools::jsonEncode($json);
            die;
        } else {
            echo $temp_obj->processSeller(Tools::getValue('id_seller'));
        }
    }
}
