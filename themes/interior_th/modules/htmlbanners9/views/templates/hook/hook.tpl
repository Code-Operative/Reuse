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

{if $htmlbanners9.slides}
  <div id="htmlbanners9" class="headerslider wow fadeInUp" data-fullscreen={$htmlbanners9.fullscreen} data-wow-delay="0.5s" data-autoplay={$htmlbanners9.autoplay} data-timeout="{$htmlbanners9.speed}" {*data-speed="{$htmlbanners9.slide_speed}"*} data-pause="{$htmlbanners9.pause}" data-pagination="{$htmlbanners9.pagination}" data-navigation="{$htmlbanners9.navigation}" data-loop="{$htmlbanners9.wrap}" data-anim_in="{$htmlbanners9.anim_in}" data-anim_out="{$htmlbanners9.anim_out}">
      {foreach from=$htmlbanners9.slides item=slide name='htmlbanners9'}
        <div class="header-slide {if $htmlbanners9.fullscreen == 'true'} fullscreen-mode{else} default-mode{/if} {$slide.customclass}">
          {if ($slide.image_url != $slide.image_base_url) && ($slide.url != $slide.url_base)}
          <a class="slide-link" href="{$slide.url}" {*title="{$slide.legend|escape}"*}>
          {else}
          <div class="slide-link">
          {/if}
          {if $slide.image_url != $slide.image_base_url}
          <figure class="headerslider-figure">
          {if $htmlbanners9.fullscreen != 'true'}
          <img class="headerslider-img" src="{$slide.image_url}" alt="{$slide.legend|escape}">
          {else}
          <div class="headerslider-img" style="background-image: url({$slide.image_url});"></div>
          {/if}
          {/if}
              {if $slide.description}
                <figcaption class="caption-description">
                    {$slide.description nofilter}
                </figcaption>
              {/if}
          {if $slide.image_url != $slide.image_base_url}
          </figure>
          {/if}
          {if ($slide.image_url != $slide.image_base_url) && ($slide.url != $slide.url_base)}
          </a>
          {else}
          </div>
          {/if}
        </div>
      {/foreach}
  </div>
{/if}

