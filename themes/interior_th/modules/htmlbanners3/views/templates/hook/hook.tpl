{*
* 2007-2018 PrestaShop
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
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if $htmlbanners3.slides}
  <div id="htmlbanners3" class="home-video wow fadeInUp" data-wow-offset="100">
    <div class="htmlbanners3-inner js-htmlbanners3-carousel row {if $htmlbanners3.carousel_active == 'true'} htmlbanners3-carousel {/if}" {if $htmlbanners3.carousel_active == 'true'} data-carousel={$htmlbanners3.carousel_active} data-autoplay={$htmlbanners3.autoplay} data-timeout="{$htmlbanners3.speed}" data-pause="{$htmlbanners3.pause}" data-pagination="{$htmlbanners3.pagination}" data-navigation="{$htmlbanners3.navigation}" data-loop="{$htmlbanners3.wrap}" data-items="{$htmlbanners3.items}" data-items_1199="{$htmlbanners3.items_1199}" data-items_991="{$htmlbanners3.items_991}" data-items_768="{$htmlbanners3.items_768}" data-items_480="{$htmlbanners3.items_480}"{/if}>
      {foreach from=$htmlbanners3.slides item=slide name='htmlbanners3'}
        <div class="promo-home {$slide.customclass}">
          <div class="banner-link">
          {if $slide.image_url != $slide.image_base_url}
          <img class="img-banner" src="{$slide.image_url}" alt="Video">
          {/if}
          {if $slide.description}
          <div class="banner-description">
                {$slide.description nofilter}
          </div>
          {/if}
          </div>
        </div>
      {/foreach}
    </div>
  </div>
{/if}

