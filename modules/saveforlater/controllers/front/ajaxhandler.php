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

class SaveForLaterAjaxHandlerModuleFrontController extends ModuleFrontController
{

    public function init()
    {
        parent::init();
        $temp_obj = new SaveForLater();
 
        if (Tools::getValue('method') == 'remove') {
            $json = array();
            $json['status'] = false;
            if (Tools::getValue('type') == 'sfl') {
                $json['status'] = $temp_obj->removeProductFromShortlist(Tools::getValue('sfl_shortproduct_id'));
            } else if (Tools::getValue('type') == 'rv') {
                //changes by tarun
                $json['status'] = $temp_obj->removeRecentViewedProduct(Tools::getValue('sfl_shortproduct_id'));
            }
            echo Tools::jsonEncode($json);
            die;
        } else if (Tools::getValue('method') == 'buy') {
            $id_product = (int) trim(Tools::getValue('product_id'));
            $quantity = (int) trim(Tools::getValue('quantity'));
            $this->buyProduct($id_product, $quantity);
        } else if (Tools::getValue('addintowishlist') == 'true') {
            $pro_id = Tools::getValue('wishlist_product_id');
            $pro_id_attribute = Tools::getValue('wishlist_id_attribute');
            $this->context->cart->deleteProduct($pro_id, $pro_id_attribute, null, 0);
            $added_products_id = explode(',', $this->context->cookie->velsof_shortlist);
            if (!in_array($pro_id, $added_products_id)) {
                $temp_obj->processProduct($pro_id);
            }

            echo "true";
            die;
        } else {
            echo $temp_obj->processProduct(Tools::getValue('product_id'));
        }
    }

    public function buyProduct($id_product, $quantity)
    {
        if (empty($quantity)) {
            $quantity = 1;
        }

        $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
        if ($this->context->cart->id) {
            $this->context->cart->updateQty($quantity, $id_product, $id_product_attribute);
        } else {
            $this->context->cart->add();
            if ($this->context->cart->id) {
                $this->context->cookie->id_cart = (int) $this->context->cart->id;
            }
            $this->context->cart->updateQty($quantity, $id_product, $id_product_attribute);
        }
        $link = $this->context->link->getPageLink('order');
        echo $link;
        die;
    }
}
