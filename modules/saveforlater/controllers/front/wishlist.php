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

class SaveForLaterWishlistModuleFrontController extends ModuleFrontController
{

    public function setMedia()
    {
        parent::setMedia();

        $this->context->controller->addCSS('module:saveforlater/views/css/front_bar.css');
        $this->context->controller->addCSS('module:saveforlater/views/css/wish.css');
    }

    public function postProcess()
    {

        parent::init();

        $module = Module::getInstanceByName('saveforlater');
        $this->module_dir = _PS_MODULE_DIR_ . 'saveforlater/';
        $json = array();

        $data = unserialize(Configuration::get('KB_SAVE_LATER'));
        $limit = $data['general']['limit'];


        if (Tools::isSubmit('pagination')) {
            $page_no = Tools::getValue('page_no');
            $token = Tools::getValue('token');
            $products = array();
            $shortlisted_products = array();
            $total_shortlisted = 0;
            $start = ($page_no - 1) * $limit;
            if (!empty($token)) {
                $query = "Select * from " . _DB_PREFIX_ . "kb_sfl_share WHERE token='" . $token . "'";
                $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
                $customer_id = $result[0]['id_customer'];
                $query = 'Select * from ' . _DB_PREFIX_ . 'kb_sfl WHERE id_customer =' . $customer_id . ' AND id_shop=' . $this->context->shop->id .
                        ' AND id_lang=' . $this->context->language->id;
                $customer = 0;
            } else {
                $query = 'Select * from ' . _DB_PREFIX_ . 'kb_sfl WHERE id_customer =' . $this->context->customer->id . ' AND id_shop=' . $this->context->shop->id .
                        ' AND id_lang=' . $this->context->language->id;
                $customer = 1;
            }

            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
            foreach ($result as $key => $value) {
                $products[] = $value['id_product'];
            }

            $total_shortlisted = count($products);
            $shortlisted = array_slice($products, $start, $limit);
            $total_pages = ceil($total_shortlisted / $limit);

            if (count($shortlisted) > 0) {
                foreach ($shortlisted as $id_product) {
                    $product = new Product($id_product, false, $this->context->language->id, $this->context->shop->id);
                    $price_before = $product->getPrice(true, null, 2, null, false, false);

                    $price = $product->getPrice(true, null, 2);
                    $show_slashed_price = false;
                    if ($price_before > $price) {
                        $show_slashed_price = true;
                    }
                    $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                    if (!empty($id_product_attribute)) {
                        $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute);
                    } else {
                        $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product);
                    }

                    $disable = 1;
                    if ($product_available_stock <= 1) {
                        $query = 'Select out_of_stock from ' . _DB_PREFIX_ . 'stock_available where id_product = ' . (int) $id_product;
                        $out_of_stock = Db::getInstance()->getValue($query);

                        if ((int) $out_of_stock == 0) {
                            $disable = 0;
                        } else if ((int) $out_of_stock == 2) {
                            $is_out_of_stock_orders_allowed = Configuration::get('PS_ORDER_OUT_OF_STOCK');
                            if ($is_out_of_stock_orders_allowed == 0) {
                                $disable = 0;
                            }
                        }
                    }
                    $shortlisted_products[] = array(
                        'product_id' => $id_product,
                        'name' => $product->name,
                        'url' => $this->context->link->getProductLink($product),
                        'link_rewrite' => $product->link_rewrite,
                        'price_before' => $price_before,
                        'price_before_formatted' => Tools::displayPrice($price_before),
                        'price' => $price,
                        'price_formatted' => Tools::displayPrice($price),
                        'show_slashed_price' => $show_slashed_price,
                        'id_image' => $product->getCoverWs(),
                        'image_path' => $this->context->link->getImageLink($product->link_rewrite, $product->getCoverWs(), ImageType::getFormattedName('small')),
                        'quantity' => $product_available_stock,
                        'buy_out_of_stock' => $disable
                    );
                }
            }

            $response = array();
            // d($json);
            $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
            $this->context->smarty->assign('customer', $customer);

            $this->context->smarty->assign('shortlisted_products', $shortlisted_products);
            $this->context->smarty->assign('total_shortlisted', $total_shortlisted);
            $this->context->smarty->assign('total_pages', $total_pages);
            $this->context->smarty->assign('kbpage', $page_no);
            $this->context->smarty->assign('start', $start);
            $this->context->smarty->assign('end', $start + $limit);
            $this->context->smarty->assign('kb_sfl_config', $plugin_data);
            $this->context->smarty->assign(array('ajaxwishlist' => $this->context->link->getModuleLink('saveforlater', 'wishlist', array(), (bool) Configuration::get('PS_SSL_ENABLED'))
            ));
            if (Tools::getShopProtocol() == 'https://') {
                $base_dir = _PS_BASE_URL_SSL_ . _MODULE_DIR_;
            } else {
                $base_dir = _PS_BASE_URL_ . _MODULE_DIR_;
            }
            $this->context->smarty->assign('base_dir', $base_dir);
            $url_parameter = array(
                'token' => md5($this->context->customer->id)
            );
            $this->context->smarty->assign(
                'generated_url',
                $this->context->link->getModuleLink(
                    'saveforlater',
                    'wishlist',
                    $url_parameter
                )
            );
         
            $response['html'] = $this->context->smarty->fetch(_PS_MODULE_DIR_ . $this->module->name . '/views/templates/front/wishlist_product.tpl');

            echo json_encode($response);
            die();
        }
    }

    public function initContent()
    {

        $this->display_column_left = false;
        $this->display_column_right = false;

        parent::initContent();

        if (@$_REQUEST['token'] != '') {
            $token = $_REQUEST['token'];
            $query = "Select * from " . _DB_PREFIX_ . "kb_sfl_share WHERE token='" . $token . "'";
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);

            if (!empty($result)) {
                $customer_id = $result[0]['id_customer'];
                $data = unserialize(Configuration::get('KB_SAVE_LATER'));
                $limit = $data['general']['limit'];
                if (Tools::getValue('p_no')) {
                    $page_no = Tools::getValue('p_no');
                    $start = ($page_no - 1) * $limit;
                } else {
                    $start = 0;
                }
                $products = array();
                $shortlisted_products = array();
                $total_shortlisted = 0;
                $query = 'Select * from ' . _DB_PREFIX_ . 'kb_sfl WHERE id_customer =' . $customer_id . ' AND id_shop=' . $this->context->shop->id .
                        ' AND id_lang=' . $this->context->language->id;
                $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);

                foreach ($result as $key => $value) {
                    $products[] = $value['id_product'];
                }



                $total_shortlisted = count($products);

                $products = array_slice($products, $start, $limit);
                $total_pages = ceil($total_shortlisted / $limit);

                if (count($products) > 0) {
                    foreach ($products as $id_product) {
                        $product = new Product($id_product, false, $this->context->language->id, $this->context->shop->id);
                        $price_before = $product->getPrice(true, null, 2, null, false, false);

                        $price = $product->getPrice(true, null, 2);
                        $show_slashed_price = false;
                        if ($price_before > $price) {
                            $show_slashed_price = true;
                        }
                        $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                        if (!empty($id_product_attribute)) {
                            $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute);
                        } else {
                            $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product);
                        }

                        $disable = 1;
                        if ($product_available_stock <= 1) {
                            $query = 'Select out_of_stock from ' . _DB_PREFIX_ . 'stock_available where id_product = ' . (int) $id_product;
                            $out_of_stock = Db::getInstance()->getValue($query);

                            if ((int) $out_of_stock == 0) {
                                $disable = 0;
                            } else if ((int) $out_of_stock == 2) {
                                $is_out_of_stock_orders_allowed = Configuration::get('PS_ORDER_OUT_OF_STOCK');
                                if ($is_out_of_stock_orders_allowed == 0) {
                                    $disable = 0;
                                }
                            }
                        }
                        $shortlisted_products[] = array(
                            'product_id' => $id_product,
                            'name' => $product->name,
                            'url' => $this->context->link->getProductLink($product),
                            'link_rewrite' => $product->link_rewrite,
                            'price_before' => $price_before,
                            'price_before_formatted' => Tools::displayPrice($price_before),
                            'price' => $price,
                            'price_formatted' => Tools::displayPrice($price),
                            'show_slashed_price' => $show_slashed_price,
                            'id_image' => $product->getCoverWs(),
                            'image_path' => $this->context->link->getImageLink($product->link_rewrite, $product->getCoverWs(), ImageType::getFormattedName('small')),
                            'quantity' => $product_available_stock,
                            'buy_out_of_stock' => $disable
                        );
                    }
                }

                $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
                $this->context->smarty->assign('customer', 0);

                $this->context->smarty->assign('shortlisted_products', $shortlisted_products);
                $this->context->smarty->assign('total_shortlisted', $total_shortlisted);
                $this->context->smarty->assign('total_pages', $total_pages);
                $this->context->smarty->assign('kbpage', 1);
                $this->context->smarty->assign('start', $start);
                $this->context->smarty->assign('end', $start + $limit);
                $this->context->smarty->assign('kb_sfl_config', $plugin_data);
                $this->context->smarty->assign(array('ajaxwishlist' => $this->context->link->getModuleLink('saveforlater', 'wishlist', array(), (bool) Configuration::get('PS_SSL_ENABLED'))
                ));
                $this->context->smarty->assign('generated_url', '');
                $this->context->smarty->assign('title', '');
                if (Tools::getShopProtocol() == 'https://') {
                    $base_dir = _PS_BASE_URL_SSL_ . _MODULE_DIR_;
                } else {
                    $base_dir = _PS_BASE_URL_ . _MODULE_DIR_;
                }
                $this->context->smarty->assign('base_dir', $base_dir);


                $this->setTemplate('module:saveforlater/views/templates/front/products.tpl');
            } else {
                $error = $this->context->smarty->fetch(_PS_MODULE_DIR_ . $this->module->name . '/views/templates/front/Error.tpl');
                echo $error;
                die();
            }
        } else if ($this->context->customer->id != '') {
            $is_mobile = 0;
            $mobileDetect = $this->context->getMobileDetect();
            if ($mobileDetect->isTablet() || $mobileDetect->isMobile()) {
                $is_mobile = 1;
            }

            $customer_id = $this->context->customer->id;
            $query = "Select * from " . _DB_PREFIX_ . "kb_sfl_share WHERE id_customer =" . $customer_id;
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
            @$token = $result[0]['token'];

            if (empty($result)) {
                $token = md5($customer_id);
                $query = "Insert into " . _DB_PREFIX_ . "kb_sfl_share(token,id_customer) values('" . $token . "','" . $customer_id . "')";
                $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->execute($query);
            }

            $url_parameter = array(
                'token' => $token
            );
            $this->context->smarty->assign(
                'generated_url',
                $this->context->link->getModuleLink(
                    'saveforlater',
                    'wishlist',
                    $url_parameter
                )
            );
            
            $data = unserialize(Configuration::get('KB_SAVE_LATER'));
            $limit = $data['general']['limit'];
            if (Tools::getValue('p_no')) {
                $page_no = Tools::getValue('p_no');
                $start = ($page_no - 1) * $limit;
            } else {
                $start = 0;
            }

            $shortlisted_products = array();

            if ($this->context->cookie->velsof_shortlist != '') {
                $shortlisted = explode(',', $this->context->cookie->velsof_shortlist);
                $total_shortlisted = count($shortlisted);
            } else {
                $shortlisted = array();
                $total_shortlisted = count($shortlisted);
            }
            $shortlisted = array_slice($shortlisted, $start, $limit);
            $total_pages = ceil($total_shortlisted / $limit);

            if (count($shortlisted) > 0) {
                foreach ($shortlisted as $id_product) {
                    $product = new Product($id_product, false, $this->context->language->id, $this->context->shop->id);
                    $price_before = $product->getPrice(true, null, 2, null, false, false);

                    $price = $product->getPrice(true, null, 2);
                    $show_slashed_price = false;
                    if ($price_before > $price) {
                        $show_slashed_price = true;
                    }
                    $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
                    if (!empty($id_product_attribute)) {
                        $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute);
                    } else {
                        $product_available_stock = StockAvailable::getQuantityAvailableByProduct($id_product);
                    }

                    $disable = 1;
                    if ($product_available_stock <= 1) {
                        $query = 'Select out_of_stock from ' . _DB_PREFIX_ . 'stock_available where id_product = ' . (int) $id_product;
                        $out_of_stock = Db::getInstance()->getValue($query);

                        if ((int) $out_of_stock == 0) {
                            $disable = 0;
                        } else if ((int) $out_of_stock == 2) {
                            $is_out_of_stock_orders_allowed = Configuration::get('PS_ORDER_OUT_OF_STOCK');
                            if ($is_out_of_stock_orders_allowed == 0) {
                                $disable = 0;
                            }
                        }
                    }

                    $shortlisted_products[] = array(
                        'product_id' => $id_product,
                        'name' => $product->name,
                        'url' => $this->context->link->getProductLink($product),
                        'link_rewrite' => $product->link_rewrite,
                        'price_before' => $price_before,
                        'price_before_formatted' => Tools::displayPrice($price_before),
                        'price' => $price,
                        'price_formatted' => Tools::displayPrice($price),
                        'show_slashed_price' => $show_slashed_price,
                        'id_image' => $product->getCoverWs(),
                        'image_path' => $this->context->link->getImageLink($product->link_rewrite, $product->getCoverWs(), ImageType::getFormattedName('small')),
                        'quantity' => $product_available_stock,
                        'buy_out_of_stock' => $disable
                    );
                }
            }

            $plugin_data = unserialize(Configuration::get('KB_SAVE_LATER'));
            $this->context->smarty->assign('customer', 1);
            $this->context->smarty->assign('shortlisted_products', $shortlisted_products);
            $this->context->smarty->assign('total_shortlisted', $total_shortlisted);
            $this->context->smarty->assign('total_pages', $total_pages);
            $this->context->smarty->assign('kbpage', 1);
            $this->context->smarty->assign('start', $start);
            $this->context->smarty->assign('end', $start + $limit);
            $this->context->smarty->assign('is_mobile', $is_mobile);
            $this->context->smarty->assign('kb_sfl_config', $plugin_data);
            $this->context->smarty->assign(array('ajaxwishlist' => $this->context->link->getModuleLink('saveforlater', 'wishlist', array(), (bool) Configuration::get('PS_SSL_ENABLED'))
            ));
        } else {
            $error = $this->context->smarty->fetch(_PS_MODULE_DIR_ . $this->module->name . '/views/templates/front/Error.tpl');
            echo $error;
            die();
        }
        if (Tools::getShopProtocol() == 'https://') {
            $base_dir = _PS_BASE_URL_SSL_ . _MODULE_DIR_;
        } else {
            $base_dir = _PS_BASE_URL_ . _MODULE_DIR_;
        }
        $this->context->smarty->assign('base_dir', $base_dir);
        $this->setTemplate('module:saveforlater/views/templates/front/products.tpl');
    }
}
