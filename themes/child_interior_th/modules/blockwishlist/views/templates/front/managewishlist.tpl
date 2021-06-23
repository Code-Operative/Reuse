{*
* 2007-2017 PrestaShop
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
*  @copyright  2007-2017 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if $products}
    {if !$refresh}
        <div class="wishlistLinkTop">
        <a id="hideWishlist" class="button_account icon pull-right" href="#" onclick="WishlistVisibility('wishlistLinkTop', 'Wishlist'); return false;" rel="nofollow" title="{l s='Close this wishlist' d='Modules.Blockwishlist.Shop'}">
            <i class="font-cross"></i>
        </a>
        <ul class="clearfix display_list">
            <li>
                <a  id="hideBoughtProducts" class="btn button_account" href="#" onclick="WishlistVisibility('wlp_bought', 'BoughtProducts'); return false;" title="{l s='Hide products' d='Modules.Blockwishlist.Shop'}">
                    {l s='Hide products' d='Modules.Blockwishlist.Shop'}
                </a>
                <a id="showBoughtProducts" class="btn button_account" href="#" onclick="WishlistVisibility('wlp_bought', 'BoughtProducts'); return false;" title="{l s='Show products' d='Modules.Blockwishlist.Shop'}">
                    {l s='Show products' d='Modules.Blockwishlist.Shop'}
                </a>
            </li>
            {if count($productsBoughts)}
                <li>
                    <a id="hideBoughtProductsInfos" class="btn button_account" href="#" onclick="WishlistVisibility('wlp_bought_infos', 'BoughtProductsInfos'); return false;" title="{l s='Hide products' d='Modules.Blockwishlist.Shop'}">
                        {l s="Hide bought products' info" d='Modules.Blockwishlist.Shop'}
                    </a>
                    <a id="showBoughtProductsInfos" class="btn button_account" href="#" onclick="WishlistVisibility('wlp_bought_infos', 'BoughtProductsInfos'); return false;" title="{l s='Show products' d='Modules.Blockwishlist.Shop'}">
                        {l s="Show bought products' info" d='Modules.Blockwishlist.Shop'}
                    </a>
                </li>
            {/if}
        </ul>
        <p class="wishlisturl form-group">
            <label>{l s='Permalink' d='Modules.Blockwishlist.Shop'}:</label>
            <input type="text" class="form-control" value="{$link->getModuleLink('blockwishlist', 'view', ['token' => $token_wish])|escape:'html':'UTF-8'}" readonly="readonly"/>
        </p>
        {*<p class="submit">
            <div id="showSendWishlist">
                <a class="btn btn-default button button-small" href="#" onclick="WishlistVisibility('wl_send', 'SendWishlist'); return false;" title="{l s='Send this wishlist' d='Modules.Blockwishlist.Shop'}">
                    <span>{l s='Send this wishlist' d='Modules.Blockwishlist.Shop'}</span>
                </a>
            </div>
        </p>*}
    {/if}
    <div class="wlp_bought">
        {assign var='nbItemsPerLine' value=4}
        {assign var='nbItemsPerLineTablet' value=3}
        {assign var='nbLi' value=$products|@count}
        {math equation="nbLi/nbItemsPerLine" nbLi=$nbLi nbItemsPerLine=$nbItemsPerLine assign=nbLines}
        {math equation="nbLi/nbItemsPerLineTablet" nbLi=$nbLi nbItemsPerLineTablet=$nbItemsPerLineTablet assign=nbLinesTablet}
        <ul class="row wlp_bought_list">
            {foreach from=$products item=product name=i}
                {math equation="(total%perLine)" total=$smarty.foreach.i.total perLine=$nbItemsPerLine assign=totModulo}
                {math equation="(total%perLineT)" total=$smarty.foreach.i.total perLineT=$nbItemsPerLineTablet assign=totModuloTablet}
                {if $totModulo == 0}{assign var='totModulo' value=$nbItemsPerLine}{/if}
                {if $totModuloTablet == 0}{assign var='totModuloTablet' value=$nbItemsPerLineTablet}{/if}
                <li class="js-product-miniature col-12 col-sm-4 col-lg-3" id="wlp_{$product.id_product}_{$product.id_product_attribute}"
                    class="col-xs-12 col-sm-4 col-md-3 {if $smarty.foreach.i.iteration%$nbItemsPerLine == 0} last-in-line{elseif $smarty.foreach.i.iteration%$nbItemsPerLine == 1} first-in-line{/if} {if $smarty.foreach.i.iteration > ($smarty.foreach.i.total - $totModulo)}last-line{/if} {if $smarty.foreach.i.iteration%$nbItemsPerLineTablet == 0}last-item-of-tablet-line{elseif $smarty.foreach.i.iteration%$nbItemsPerLineTablet == 1}first-item-of-tablet-line{/if} {if $smarty.foreach.i.iteration > ($smarty.foreach.i.total - $totModuloTablet)}last-tablet-line{/if}">
                    <div class="wlp_bought_item_container">
                        <div class="">
                            <div class="product-image">
                                <a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}" title="{l s='Product detail' d='Modules.Blockwishlist.Shop'}">
                                    <img class="replace-2x img-responsive w-100"  src="{$link->getImageLink($product.link_rewrite, $product.cover, 'home_default')|escape:'html':'UTF-8'}" alt="{$product.name|escape:'html':'UTF-8'}"/>
                                </a>
                            </div>
                        </div>
                        <div class="">
                            <div class="product_infos">
                                <a class="lnkdel" href="javascript:;" onclick="WishlistProductManage('wlp_bought', 'delete', '{$id_wishlist}', '{$product.id_product}', '{$product.id_product_attribute}', $('#quantity_{$product.id_product}_{$product.id_product_attribute}').val(), $('#priority_{$product.id_product}_{$product.id_product_attribute}').val());" title="{l s='Delete' d='Modules.Blockwishlist.Shop'}">
                                    <i class="font-cross"></i>
                                </a>

                                <p id="s_title" class="product-name">
                                    {$product.name|truncate:30:'...'|escape:'html':'UTF-8'}
                                    {if isset($product.attributes_small)}
                                        <small>
                                            <a href="{$link->getProductlink($product.id_product, $product.link_rewrite, $product.category_rewrite)|escape:'html':'UTF-8'}" title="{l s='Product detail' d='Modules.Blockwishlist.Shop'}">
                                                {$product.attributes_small|escape:'html':'UTF-8'}
                                            </a>
                                        </small>
                                    {/if}
                                </p>
                                <div class="wishlist_product_detail">
                                    <p class="form-group">
                                        <label for="quantity_{$product.id_product}_{$product.id_product_attribute}">
                                            {l s='Quantity' d='Modules.Blockwishlist.Shop'}:
                                        </label>
                                        <input type="text" class="form-control grey" id="quantity_{$product.id_product}_{$product.id_product_attribute}" value="{$product.quantity|intval}" size="3"/>
                                    </p>

                                    <p class="form-group">
                                        <label for="priority_{$product.id_product}_{$product.id_product_attribute}">
                                            {l s='Priority' d='Modules.Blockwishlist.Shop'}:
                                        </label>
                                        <select id="priority_{$product.id_product}_{$product.id_product_attribute}" class="form-control grey">
                                            <option value="0"{if $product.priority eq 0} selected="selected"{/if}>
                                                {l s='High' d='Modules.Blockwishlist.Shop'}
                                            </option>
                                            <option value="1"{if $product.priority eq 1} selected="selected"{/if}>
                                                {l s='Medium' d='Modules.Blockwishlist.Shop'}
                                            </option>
                                            <option value="2"{if $product.priority eq 2} selected="selected"{/if}>
                                                {l s='Low' d='Modules.Blockwishlist.Shop'}
                                            </option>
                                        </select>
                                    </p>
                                </div>
                                <div class="btn_action js-dropdown">
                                    {if (isset($product.attribute_quantity) && $product.attribute_quantity >= 1) || (!isset($product.attribute_quantity) && $product.product_quantity >= 1) || (isset($product.allow_oosp) && $product.allow_oosp)}
                                        <form action="none" method="post" class="add-to-cart-or-refresh">
                                            <div class="product-quantity d-none">
                                                 <input type="hidden" name="token" class="token-product-list" value="">
                                                 <input type="hidden" name="id_product" value="{$product.id_product}" class="product_page_product_id">
                                                 <input type="hidden" name="id_customization" value="0" class="product_customization_id">
                                                 <input type="hidden" name="qty" class="quantity_wanted" value="1" class="input-group"/>
                                            </div>
                                              <button  data-name-module="product-list" data-id_product_atrr="{$product.id_product}" class="add-cart btn btn-outline-primary w-100 mb-2 btn-sm" data-button-action="add-to-cart">
                                                <span>{l s='Add to cart' d='Shop.Theme.Actions'}</span>
                                             </button>
                                        </form>
                                        {else}
                                            <span class="btn w-100 mb-2 disabled">
                                                <span>{l s='Add to cart' d='Shop.Theme.Actions'}</span>
                                            </span>
                                        {/if}
                                    <a class="btn btn-default button button-small"  href="javascript:;" onclick="WishlistProductManage('wlp_bought_{$product.id_product_attribute}', 'update', '{$id_wishlist}', '{$product.id_product}', '{$product.id_product_attribute}', $('#quantity_{$product.id_product}_{$product.id_product_attribute}').val(), $('#priority_{$product.id_product}_{$product.id_product_attribute}').val());" title="{l s='Save' d='Modules.Blockwishlist.Shop'}">
                                        <span>{l s='Save' d='Modules.Blockwishlist.Shop'}</span>
                                    </a>
                                    {if $wishlists|count > 1}
                                        {foreach name=wl from=$wishlists item=wishlist}
                                            {if $smarty.foreach.wl.first}
                                                <a href="#" class="btn btn-default button button-small wishlist_change_button" title="{l s='Move to a wishlist' d='Modules.Blockwishlist.Shop'}" data-toggle="dropdown" onclick="return false;">
                                                    <span>{l s='Move' d='Modules.Blockwishlist.Shop'}</span>
                                                </a>
                                                <ul class="dropdown-menu">
                                            {/if}
                                            {if $id_wishlist != {$wishlist.id_wishlist}}
                                                 <li>
                                                     <a href="#" title="{$wishlist.name|escape:'html':'UTF-8'}" value="{$wishlist.id_wishlist}" onclick="wishlistProductChange({$product.id_product}, {$product.id_product_attribute}, '{$id_wishlist}', '{$wishlist.id_wishlist}'); return false;">
                                                         {l s='Move to %s'|sprintf:$wishlist.name d='Modules.Blockwishlist.Shop'}
                                                     </a>
                                                </li>
                                            {/if}
                                            {if $smarty.foreach.wl.last}
                                                </ul>
                                            {/if}
                                        {/foreach}
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            {/foreach}
        </ul>
    </div>
    {if !$refresh}
        <form method="post" class="wl_send box unvisible" onsubmit="return (false);">
        <div class="hideSendWishlist_wrapper">
            <a id="hideSendWishlist" class="button_account btn icon"  href="#" onclick="WishlistVisibility('wl_send', 'SendWishlist'); return false;" rel="nofollow" title="{l s='Close this wishlist' d='Modules.Blockwishlist.Shop'}">
                {l s='Close this wishlist' d='Modules.Blockwishlist.Shop'}
            </a>
        </div>
            <fieldset>
                <div class="required form-group">
                    <label for="email1"><sup>*</sup></label>
                    <input type="text" name="email1" id="email1" class="form-control" placeholder="{l s='Email' d='Modules.Blockwishlist.Shop'}1 "/>
                </div>
                {section name=i loop=11 start=2}
                    <div class="form-group">
                        {*<label for="email{$smarty.section.i.index}">{l s='Email' d='Modules.Blockwishlist.Shop'}{$smarty.section.i.index}</label>*}
                        <input type="text" name="email{$smarty.section.i.index}" id="email{$smarty.section.i.index}"
                               class="form-control" placeholder="{l s='Email' d='Modules.Blockwishlist.Shop'}{$smarty.section.i.index}"/>
                    </div>
                {/section}
                <div class="submit">
                    <button class="btn btn-default button button-small" type="submit" name="submitWishlist"
                            onclick="WishlistSend('wl_send', '{$id_wishlist}', 'email');">
                        <span>{l s='Send' d='Modules.Blockwishlist.Shop'}</span>
                    </button>
                </div>
                <p class="required">
                    <sup>*</sup> {l s='Required field' d='Modules.Blockwishlist.Shop'}
                </p>
            </fieldset>
        </form>
        {if count($productsBoughts)}
            <div class="table-responsive">
            <table class="wlp_bought_infos unvisible table table-bordered table-responsive">
                <thead>
                <tr>
                    <th class="first_item">{l s='Product' d='Modules.Blockwishlist.Shop'}</th>
                    <th class="item">{l s='Quantity' d='Modules.Blockwishlist.Shop'}</th>
                    <th class="item">{l s='Offered by' d='Modules.Blockwishlist.Shop'}</th>
                    <th class="last_item">{l s='Date' d='Modules.Blockwishlist.Shop'}</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$productsBoughts item=product name=i}
                    {foreach from=$product.bought item=bought name=j}
                        {if $bought.quantity > 0}
                            <tr>
                                <td class="first_item">
                                    <span style="float:left;">
                                        <img
                                                src="{$link->getImageLink($product.link_rewrite, $product.cover, 'small_default')|escape:'html':'UTF-8'}"
                                                alt="{$product.name|escape:'html':'UTF-8'}"/>
                                    </span>
                                    <span style="float:left;">
                                        {$product.name|truncate:40:'...'|escape:'html':'UTF-8'}
                                        {if isset($product.attributes_small)}
                                            <br/>
                                            <i>{$product.attributes_small|escape:'html':'UTF-8'}</i>
                                        {/if}
                                    </span>
                                </td>
                                <td class="item align_center">
                                    {$bought.quantity|intval}
                                </td>
                                <td class="item align_center">
                                    {$bought.firstname} {$bought.lastname}
                                </td>
                                <td class="last_item align_center">
                                    {$bought.date_add|date_format:"%Y-%m-%d"}
                                </td>
                            </tr>
                        {/if}
                    {/foreach}
                {/foreach}
                </tbody>
            </table>
        </div>
        {/if}
    {/if}
{else}
    <p class="alert alert-warning">
        {l s='No products' d='Modules.Blockwishlist.Shop'}
    </p>
{/if}
