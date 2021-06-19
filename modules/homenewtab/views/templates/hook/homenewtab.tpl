{*
* 2007-2020 PrestaShop
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
*  @copyright  2007-2020 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div class="{if $carousel_tabs|escape:'html':'UTF-8' == 'true'}tab-pane fade{else}none-in-tabs{/if}"{if $carousel_tabs|escape:'html':'UTF-8' == 'true'} id="homenewtab"{/if}>
    <div class="container">
        {if $carousel_tabs != 'true'}
            <p class="headline-section">{$homenewtab_category_name|escape:'html':'UTF-8'}</p>
        {/if}
        {if $products}
            <div class="products grid row{if $carousel_active|escape:'html':'UTF-8'  == 'true'} view-carousel js-carousel-new{else} view-grid xlarge-{$carousel_col|escape:'html':'UTF-8'} large-{$carousel_col_1200|escape:'html':'UTF-8'} medium-{$carousel_col_992|escape:'html':'UTF-8'} small-{$carousel_col_769|escape:'html':'UTF-8'} xsmall-{$carousel_col_576}{/if}"{if $carousel_active  == 'true'} data-carousel="{$carousel_active}" data-autoplay="{$carousel_autoplay|escape:'html':'UTF-8'}" data-speed="{$carousel_speed}" data-pag="{$carousel_pag}" data-arrows="{$carousel_arrows}" data-loop="{$carousel_loop}" data-rows="{$carousel_rows|escape:'html':'UTF-8'}" data-col="{$carousel_col|escape:'html':'UTF-8'}" data-col_1200="{$carousel_col_1200|escape:'html':'UTF-8'}" data-col_992="{$carousel_col_992|escape:'html':'UTF-8'}" data-col_769="{$carousel_col_769|escape:'html':'UTF-8'}" data-col_576="{$carousel_col_576|escape:'html':'UTF-8'}"{/if}>
            {foreach from=$products item="product" name="products"}
                 {if $smarty.foreach.products.first && ($carousel_rows > 1)} {*Add a open div to a start of first item*}
                    <div class="wrapper-item fist">
                 {/if}
                {include file="catalog/_partials/miniatures/product.tpl" product=$product}
                 {if $smarty.foreach.products.iteration is div by $carousel_rows && ($carousel_rows > 1)}{*Add a closed div and open div to a end of every 2/3/4 item*}
                    {if !$smarty.foreach.products.last && ($carousel_rows > 1)} {*An item is not last*}
                        </div><div class="wrapper-item">
                    {/if}
                {/if}
                 {if $smarty.foreach.products.last && ($carousel_rows > 1)}{*Add a closed div to a end of last item*}
                    </div>
                 {/if}
            {/foreach}
            </div>
        {else}
            <div class="col-md-12">
                <div class="alert alert-warning">
                    {l s='No new products found' d='Modules.Homenewtab.Shop'}
                </div>
            </div>
        {/if}
        <div class="text-center">
            <a class="more-btn" href="{$allnewProductsLink|escape:'html':'UTF-8'}">{l s='All new products' d='Modules.Homenewtab.Shop'}</a>
        </div>
    </div>
</div>
