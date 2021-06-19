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
<div class="images-container">
  {block name='product_cover'}
    <div class="product-cover">
      {if $product.cover}
      <img class="js-qv-product-cover" src="{$product.cover.bySize.large_default.url}" alt="{if $product.cover.legend}{$product.cover.legend}{else}{$product.name}{/if}" title="{if $product.cover.legend}{$product.cover.legend}{else}{$product.name}{/if}" style="width:100%;" itemprop="image">
      <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
        <i class="material-icons zoom-in">&#xE8B6;</i>
      </div>
      {else}
        <img src="{$urls.no_picture_image.bySize.large_default.url}" style="width:100%;">
      {/if}
    </div>
  {/block}

  {block name='product_images'}
    <div class="wrapper-thumbnails">
        <div class="scroll-box-arrows">
            <i class="material-icons left">&#xE314;</i>
            <i class="material-icons right">&#xE315;</i>
        </div>
          <div class="arrows js-arrows">
            <i class="material-icons arrow-up js-arrow-up">&#xE316;</i>
            <i class="material-icons arrow-down js-arrow-down">&#xE313;</i>
          </div>
      <div class="js-qv-mask mask">
        <ul class="product-images js-qv-product-images">
          {foreach from=$product.images item=image}
            <li class="thumb-container">
              <img
                class="thumb js-thumb {if $image.id_image == $product.cover.id_image} selected {/if}"
                data-image-medium-src="{$image.bySize.medium_default.url}"
                data-image-large-src="{$image.bySize.large_default.url}"
                src="{$image.bySize.home_default.url}"
                alt="{if $image.legend}{$image.legend}{else}{$product.name}{/if}"
                title="{if $image.legend}{$image.legend}{else}{$product.name}{/if}"
                width="100"
                itemprop="image"
              >
            </li>
          {/foreach}
        </ul>
      </div>
    </div>
  {/block}
</div>
{hook h='displayAfterProductThumbs'}
