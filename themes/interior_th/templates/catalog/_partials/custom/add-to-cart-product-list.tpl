{**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}


	<form action="" method="post" class="add-to-cart-or-refresh">
		<div class="product-quantity" style="display:none;">
			<input type="hidden" name="token" class="token-product-list" value="">
	        <input type="hidden" name="id_product" value="{$product.id_product}" class="product_page_product_id">
	        <input type="hidden" name="id_customization" value="0" class="product_customization_id">
	        <input type="hidden" name="qty" value="1" class="input-group"  min="1"  />
		</div>
	     <a href="javascript:void(0);" name-module="{$name_module}" id="{$name_module}-cart-id-product-{$product.id_product}" id_product_atrr="{$product.id_product}" class="btn btn-primary add-cart{if !$product.add_to_cart_url} disabled{/if}" data-button-action="add-to-cart">
			<span>{l s='Add to cart' d='Shop.Theme.Actions'}</span>
		 </a>
	</form>

