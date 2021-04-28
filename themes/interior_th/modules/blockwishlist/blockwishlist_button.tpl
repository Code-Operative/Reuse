{*
* 2007-2016 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2016 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if isset($wishlists) && (null != $wishlists && count($wishlists) > 1)}
    <div class="wishlist product-item-wishlist js-dropdown dropup">
        <a href="#" title="{l s='Add to wishlist' d='Shop.Theme.Actions'}" class="addToWishlist" data-toggle="dropdown" onclick="return false;">
            <i class="font-heart"></i>
            <span>{l s='Add to wishlist' d='Shop.Theme.Actions'}</span>
        </a>
        <ul class="dropdown-menu">
        {foreach name=wl from=$wishlists item=wishlist}
                <li class="dropdown-item" title="{$wishlist.name}" value="{$wishlist.id_wishlist}" onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|intval}', false, 1, '{$wishlist.id_wishlist}');">
                    {l s='Add to %s' sprintf=[$wishlist.name] d='Modules.Blockwishlist.Shop'}
                </li>
        {/foreach}
        </ul>
    </div>
{else}
<div class="wishlist product-item-wishlist">
	<a class="addToWishlist wishlistProd_{$product.id_product|intval}" href="#" rel="{$product.id_product|intval}" onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|intval}', false, 1); return false;" title="{l s='Add to wishlist' d='Shop.Theme.Actions'}">
        <i class="font-heart"></i>
        <span>{l s='Add to wishlist' d='Shop.Theme.Actions'}</span>
	</a>
</div>
{/if}