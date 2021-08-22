{**
 * 2007-2017 PrestaShop
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
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{block name='product_miniature_item'}
  <article class="product-miniature js-product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
    <div class="thumbnail-container">
      <div class="thumbnail-wrapper">
      {block name='product_thumbnail'}
        <a href="{$product.url}" class="thumbnail product-thumbnail">
          {foreach name="thumbnails" from=$product.images item=image}
            {if $smarty.foreach.thumbnails.iteration == 2}
              <img
                class="thumbnail-alternate"
                src="{$image.bySize.home_default.url}"
                alt="{$image.legend}"
              >
            {/if}
          {/foreach}
          {if $product.cover}
          <img
            class="thumbnail-img"
            src="{$product.cover.bySize.home_default.url}"
            alt="{$product.cover.legend}"
            data-full-size-image-url = "{$product.cover.large.url}"
            itemprop="image"
          >
          {else}
          <img
              class="thumbnail-img"
              src="{$urls.no_picture_image.bySize.home_default.url}"
            >
          {/if}
        </a>
      {/block}
        {block name='product_flags'}
        <ul class="product-flags">
          {foreach from=$product.flags item=flag}
            <li class="{$flag.type}"><span>{$flag.label}</span></li>
          {/foreach}
        </ul>
        {/block}
      </div>
      <div class="product-description">
        {block name='product_variants'}
        {if $product.main_variants}
          {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
        {/if}
        {/block}
        {block name='product_name'}
          <h3 class="h3 product-title" itemprop="name"><a href="{$product.url}">{$product.name|truncate:40:'...'}</a></h3>
        {/block}
        {block name='product_reviews'}
          {hook h='displayProductListReviews' product=$product}
        {/block}
        {block name='product_description'}
          <p class="product_desc" itemprop="description">{$product.description|strip_tags:'UTF-8'|truncate:250:'...'}</p>
        {/block}
        {if Manufacturer::getnamebyid($product.id_manufacturer)}
        <meta itemprop="brand" content="{Manufacturer::getnamebyid($product.id_manufacturer)}"/>
        {/if}
        {if $product.reference}
        <meta itemprop="sku" content="{$product.reference}" />
        {/if}
        {if $product.ean13}
          <meta itemprop="gtin13" content="{$product.ean13}" />
        {/if}
        {block name='product_price_and_shipping'}
          {if $product.show_price}
            <div class="product-price-and-shipping" itemprop="offers" itemtype="http://schema.org/Offer" itemscope>
                <link itemprop="url" href="{$product.url}" />
                <meta itemprop="availability" content="{if $product.available_for_order == 1}https://schema.org/InStock{else}https://schema.org/OutOfStock{/if}" />
                <meta itemprop="priceCurrency" content="{$currency.iso_code}" />
               {*From label*}
                 {hook h='displayProductPriceBlock' product=$product type="before_price"}
               {*End label*}
              <span itemprop="price" content="{$product.price_amount}" class="price">{$product.price}</span>
              {hook h='displayProductAdditionalInfo' product=$product}
              {if $product.has_discount}
                {hook h='displayProductPriceBlock' product=$product type="old_price"}

                <span class="regular-price">{$product.regular_price}</span>
                {if $product.discount_type === 'percentage'}
                  <span class="discount-percentage">{$product.discount_percentage}</span>
                {elseif $product.discount_type === 'amount'}
                  <span class="discount-percentage">{$product.discount_amount_to_display}</span>
                {/if}
              {/if}


              {hook h='displayProductPriceBlock' product=$product type='unit_price'}

            {hook h='displayProductPriceBlock' product=$product type='weight'}
            {*Start adding tax and delivery labels*}
            {if $configuration.taxes_enabled && $configuration.display_taxes_label}
              {$product.labels.tax_long}
            {/if}
            {hook h='displayProductPriceBlock' product=$product type="price"}
            {if $product.delivery_information}
                {$product.delivery_information}
            {/if}
            {*End adding tax and delivery labels*}
          </div>
        {/if}
        {/block}
    </div>
    <div class="highlighted-informations{if !$product.main_variants} no-variants{/if}">
      {if !$configuration.is_catalog}
          {include file='catalog/_partials/custom/add-to-cart-product-list.tpl' product=$product name_module='product-list'}
      {/if}
      {hook h='displayProductListFunctionalButtons' product=$product}
      {block name='quick_view'}
        <a class="quick-view" href="#" title="{l s='Quick view' d='Shop.Theme.Actions'}" data-link-action="quickview">
          <i class="font-eye"></i><span>{l s='Quick view' d='Shop.Theme.Actions'}</span>
        </a>
      {/block}
      {block name='more_info'}
          <a href="{$product.url}" title="{l s='More info' d='Shop.Theme.Actions'}" class="link-view">
              <i class="font-info-circled"></i><span>{l s='More info' d='Shop.Theme.Actions'}</span>
          </a>
      {/block}
    </div>
    </div>
  </article>
{/block}