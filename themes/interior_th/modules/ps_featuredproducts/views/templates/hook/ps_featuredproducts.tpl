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
<div class="featured-products none-in-tabs nav-active wow fadeInUp" data-wow-offset="150">
  {if $page.page_name == 'index'}
  <div class="container -responsive">
  {/if}
  <p class="headline-section products-title">
    <strong>{l s='Popular Products' d='Shop.Theme.Catalog'}</strong>
  </p>
  <div class="products grid row view-carousel js-carousel-products">
    {foreach from=$products item="product"}
      {include file="catalog/_partials/miniatures/product.tpl" product=$product}
    {/foreach}
  </div>
  {*<div class="text-center">
  <a class="more-btn btn" href="{$allProductsLink}">
    {l s='All products' d='Shop.Theme.Catalog'}
  </a>
  </div>*}
  {if $page.page_name == 'index'}
  </div>
  {/if}
</div>
