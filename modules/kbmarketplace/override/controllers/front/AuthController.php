<?php
/**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

class AuthController extends AuthControllerCore
{
    public function initContent()
    {
        $should_redirect = false;
        $has_registered = false;
        
        if (Tools::isSubmit('submitCreate') || Tools::isSubmit('create_account')) {
            $register_form = $this
                ->makeCustomerForm()
                ->setGuestAllowed(false)
                ->fillWith(Tools::getAllValues())
            ;
            if (Tools::isSubmit('submitCreate')) {
                $hookResult = array_reduce(
                    Hook::exec('actionSubmitAccountBefore', array(), null, true),
                    function ($carry, $item) {
                        return $carry && $item;
                    },
                    true
                );
                if ($hookResult && $register_form->submit()) {
                    $should_redirect = true;
                    $has_registered = true;
                }
            }
            $this->context->smarty->assign([
                'register_form'  => $register_form->getProxy(),
                'hook_create_account_top' => Hook::exec('displayCustomerAccountFormTop')
            ]);
            $this->setTemplate('customer/registration');
        } else {
            $login_form = $this->makeLoginForm()->fillWith(
                Tools::getAllValues()
            );
            if (Tools::isSubmit('submitLogin')) {
                if ($login_form->submit()) {
                    $should_redirect = true;
                }
            }
            $this->context->smarty->assign([
                'login_form' => $login_form->getProxy()
            ]);
            $this->setTemplate('customer/authentication');
        }
        parent::initContent();
        if ($should_redirect && !$this->ajax) {
            $back = urldecode(Tools::getValue('back'));
            
            if ($has_registered) {
                if (Context::getContext()->customer->id
                && (bool) KbSeller::getSellerByCustomerId((int) Context::getContext()->customer->id)) {
                    $is_membership_product_in_cart = 0;
                    $cart_products = Context::getContext()->cart->getProducts();
                    if (!empty($cart_products)) {
                        foreach ($cart_products as $key => $products) {
                            if (KbMpMemberShipPlan::isMemberShipPlanTypeProduct($products['id_product'])) {
                                $is_membership_product_in_cart = 1;
                                break;
                            }
                        }
                    }
                    if ($is_membership_product_in_cart) {
                        $cart_page_link = $this->context->link->getPageLink(
                            'cart',
                            null,
                            $this->context->language->id,
                            array(
                                'action' => 'show'
                            ),
                            false,
                            null,
                            true
                        );
                        $cart_page_link = 'cart&action=show';
                        $this->redirectWithNotifications($cart_page_link);
                    }
                }
            }
            if (Tools::secureReferrer($back)) {
                $this->redirectWithNotifications($back);
            } else {
                if ($this->authRedirection) {
                    $back = $this->authRedirection;
                } elseif (!preg_match('/^[\w\-]+$/', $back)) {
                    $back = 'my-account';
                }
                $this->redirectWithNotifications('index.php?controller='.urlencode($back));
            }
        }
    }
}
