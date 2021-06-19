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

{if $htmlbanners5.slides}
  <div id="htmlbanners5" class="home-tabs wow fadeInUp" data-wow-offset="100">
        <h3 class="headline-section">
          <strong>
              {l s='Our benefits' d='Modules.Hometabs.Shop'}
          </strong>
        </h3>
        <div class="home-tabs-inner">
          <ul class="htmlcontent-tabs col-md-3 col-sm-12">
            {foreach from=$htmlbanners5.slides item=slide name='htmlbanners5'}
              <li class="nav-item row tab_{$smarty.foreach.htmlbanners5.iteration} {if $smarty.foreach.htmlbanners5.iteration == 1}active{/if}">
                <a class="nav-link" href="#tab_item_{$smarty.foreach.htmlbanners5.iteration}" data-toggle="tab">
                  {if $slide.image_url != $slide.image_base_url}
                      <span class="icon-wrap">
                          <img class="img-icon" src="{$slide.image_url}" alt="{$slide.legend|escape}">
                     </span>
                  {/if}
                  {if $slide.title}
                    <span>{$slide.title nofilter}</span>
                  {else}
                    <span>{$smarty.foreach.htmlbanners5.iteration nofilter} {l s ='Tab' d='Shop.Theme.Global'}</span>
                  {/if}
                </a>
              </li>
            {/foreach}
          </ul>
          <div class="tab-content clearfix col-md-9 col-sm-12">
            {foreach from=$htmlbanners5.slides item=slide name='htmlbanners5'}
              <div role="tabpanel" id="tab_item_{$smarty.foreach.htmlbanners5.iteration}" class="{$slide.customclass} tab-pane{if $smarty.foreach.htmlbanners5.iteration == 1} active{/if}">
                    {if $slide.description}
                        {$slide.description nofilter}
                    {/if}
              </div>
            {/foreach}
          </div>
    </div>
  </div>
{/if}

