<div itemscope itemtype="http://schema.org/Product">
    <section class="page-product-box slr-f-box">
        <h3 class="page-product-heading s-p-filter">
            <form action="{$filter_form_action|escape:'htmlall':'UTF-8'}" method="post" id="seller_products_form">
            <ul>
                <li class="heading">{l s='Filter your search' mod='kbmpdealmanager'}: </li>
                {if isset($category_list) && count($category_list) > 0}
                <li>
                    <select name="s_filter_category" onchange="$('#seller_product_pagination_var').val(0);$('#seller_products_form').submit();">
                        <option value="">{l s='Category' mod='kbmpdealmanager'}</option>
                        {foreach $category_list as $cat}
                            <option value="{$cat['id_category']|intval}" {if $selected_category == $cat['id_category']}selected="selected"{/if} >{$cat['name']|escape:'htmlall':'UTF-8'}</option>
                        {/foreach}
                    </select>
                </li>
                {/if}
                <li>
                    <select name="s_filter_sortby" onchange="$('#seller_product_pagination_var').val(0);$('#seller_products_form').submit();">
                        <option value="">{l s='Sort By' mod='kbmpdealmanager'}</option>
                        <option value="pl.name:ASC" {if $selected_sort == 'pl.name:ASC'}selected="selected"{/if} >{l s='Name (A - Z)' mod='kbmpdealmanager'}</option>
                        <option value="pl.name:DESC" {if $selected_sort == 'pl.name:DESC'}selected="selected"{/if} >{l s='Name (Z - A)' mod='kbmpdealmanager'}</option>
                        <option value="p.price:ASC" {if $selected_sort == 'p.price:ASC'}selected="selected"{/if} >{l s='Price(low to high)' mod='kbmpdealmanager'}</option>
                        <option value="p.price:DESC" {if $selected_sort == 'p.price:DESC'}selected="selected"{/if} >{l s='Price(high to low)' mod='kbmpdealmanager'}</option>
                    </select>
                </li>
            </ul>
            <input type="hidden" name="page_number" value="{$seller_product_current_page|intval}" id="seller_product_pagination_var"/>
            </form>
            {if isset($pagination_string)}<div id="svp-p-count" class="svp-p-count">{$pagination_string}</div>{*Variable contains css and html content, escape not required*}{/if}
            <div class="clearfix"></div>
        </h3>
        {if isset($pagination) && $pagination neq ''}
        <div class="sv-p-paging">
            {$pagination}{*Variable contains css and html content, escape not required*}
            <div class='clearfix'></div>
        </div>
        {/if}
        <div id="seller_products_to_customer" class="slr-content">
            {if count($products) > 0}
                <section id="main">
                    <section id="products">
                        <div class="products row">
                            {foreach from=$products item="product"}
                                {block name='product_miniature'}
                                  {include file='catalog/_partials/miniatures/product.tpl' product=$product}
                                {/block}
                            {/foreach}            
                        </div>
                    </section>
                </section>
            {else}
                <div class="alert alert-warning">
                    {l s='No product is available for sale from this seller' mod='kbmarketplace'}
                </div>
            {/if}
        </div>
        {if isset($kb_pagination.pagination) && $kb_pagination.pagination neq ''}
        <div class="sv-p-paging" style='padding-bottom:0;'>
            {$kb_pagination.pagination}{*Variable contains css and html content, escape not required*}
            <div class='clearfix'></div>
        </div>
        {/if}
    </section>
</div>
{*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer tohttp://www.prestashop.com for more information.
* We offer the best and most useful modules PrestaShop and modifications for your online store.
*
* @category  PrestaShop Module
* @author    knowband.com <support@knowband.com>
* @copyright 2016 knowband
* @license   see file: LICENSE.txt
*}