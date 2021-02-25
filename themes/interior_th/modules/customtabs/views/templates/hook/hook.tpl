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

{if $customtabs.slides}
    {foreach from=$customtabs.slides item=slide name='customtabs'}
      {assign var=productsId value=","|explode:$slide.category}
      {foreach $productsId as $selectedId}
        {if $selectedId == $customtabs.product_id || $slide.category == ''}
          <div class="tab-pane fade in {$slide.customclass}" id="custom_tab_{$smarty.foreach.customtabs.iteration}" data-current="{$customtabs.product_id}" data-selected="{$slide.category}">
            <div class="tab-pane-inner rte">
              {if ($slide.image_url != $slide.image_base_url) && $slide.url != $slide.url_base}
              <a class="banner-link" href="{$slide.url}" {*title="{$slide.legend|escape}"*}>
              {/if}
              {if $slide.image_url != $slide.image_base_url}
              <img class="img-banner" src="{$slide.image_url}" alt="{$slide.legend|escape:'htmlall':'UTF-8'}">
              {/if}
              {if ($slide.image_url != $slide.image_base_url) && $slide.url != $slide.url_base}
              </a>
              {/if}
              {if $slide.description}
                  {$slide.description nofilter}
              {/if}
            </div>
          </div>
        {/if}
      {/foreach}
    {/foreach}
{/if}