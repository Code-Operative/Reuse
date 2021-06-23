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

{if $htmlbanners5.slides}
  <div id="htmlbanners5" class="top-banners container">
    <div class="htmlbanners5-inner {if $htmlbanners5.carousel_active == 'true'}htmlbanners5-carousel {/if}row clearfix" {if $htmlbanners5.carousel_active == 'true'} data-carousel={$htmlbanners5.carousel_active} data-autoplay={$htmlbanners5.autoplay} data-timeout="{$htmlbanners5.speed}" data-pause="{$htmlbanners5.pause}" data-pagination="{$htmlbanners5.pagination}" data-navigation="{$htmlbanners5.navigation}" data-loop="{$htmlbanners5.wrap}" data-items="{$htmlbanners5.items}" data-items_1199="{$htmlbanners5.items_1199}" data-items_991="{$htmlbanners5.items_991}" data-items_768="{$htmlbanners5.items_768}" data-items_480="{$htmlbanners5.items_480}"{/if}>
      {foreach from=$htmlbanners5.slides item=slide name='htmlbanners5'}
        <div class="top-banner {$slide.customclass}">
          {if $slide.image_url && $slide.url}
          <a class="banner-link" href="{$slide.url}" {*title="{$slide.legend|escape}"*}>
          {else}
          <div class="banner-link">
          {/if}
          {if $slide.image_url}
          <figure>
          <img class="img-banner" src="{$slide.image_url}" alt="{$slide.legend}">
          {/if}
              {if $slide.description}
                <figcaption class="banner-description">
                    {$slide.description}
                </figcaption>
              {/if}
          {if $slide.image_url}
          </figure>
          {/if}
          {if $slide.image_url && $slide.url}
          </a>
          {else}
          </div>
          {/if}
        </div>
      {/foreach}
    </div>
  </div>
{/if}

