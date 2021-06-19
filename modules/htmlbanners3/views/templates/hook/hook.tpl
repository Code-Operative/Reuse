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

{if $htmlbanners3.slides}
  <div id="htmlbanners3" class="home-video">
    <div class="htmlbanners3-inner {if $htmlbanners3.carousel_active == 'true'}htmlbanners3-carousel {/if}" {if $htmlbanners3.carousel_active == 'true'} data-carousel={$htmlbanners3.carousel_active} data-autoplay={$htmlbanners3.autoplay} data-timeout="{$htmlbanners3.speed}" data-pause="{$htmlbanners3.pause}" data-pagination="{$htmlbanners3.pagination}" data-navigation="{$htmlbanners3.navigation}" data-loop="{$htmlbanners3.wrap}" data-items="{$htmlbanners3.items}" data-items_1199="{$htmlbanners3.items_1199}" data-items_991="{$htmlbanners3.items_991}" data-items_768="{$htmlbanners3.items_768}" data-items_480="{$htmlbanners3.items_480}"{/if}>
      {foreach from=$htmlbanners3.slides item=slide name='htmlbanners3'}
        <div class="promo-home {$slide.customclass}" {if $slide.image_url}style="background-image: url({$slide.image_url});"{/if}>
          {if $slide.description}
              {$slide.description}
          {/if}
        </div>
      {/foreach}
    </div>
  </div>
{/if}

