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
*  @version  Release: $Revision: 7077 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<!-- Block manufacturers module -->
<div id="manufacturers-home" class="manufacturers-home container">
	<h3 class="headline-section">{if $display_link_manufacturer}<a href="{$link->getPageLink('manufacturer')|escape:'html':'UTF-8'}" title="{l s='Manufacturers' mod='blockmanufactureri'}">{/if}{l s='Manufacturers' mod='blockmanufactureri'}{if $display_link_manufacturer}</a>{/if}</h3>
{if $manufacturers}
	<div class="manufacturers-list {if $text_list}js-man-carousel carousel-view{else}grid-view{/if}">
	{foreach from=$manufacturers item=manufacturer name=manufacturer_list}
		{if $smarty.foreach.manufacturer_list.iteration <= $text_list_nb}
		<div class="manufacturer-items">
	        <a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)|escape:'html':'UTF-8'}" title="{l s='More about' mod='blockmanufactureri'} {$manufacturer.name|escape:'html':'UTF-8'}">
	        	<img src="{if $psversion < '1.7.0.0'}{$img_manu_dir|escape:'html':'UTF-8'}{else}{$urls.img_manu_url|escape:'html':'UTF-8'}{/if}{$manufacturer.id_manufacturer|escape:'html':'UTF-8'}-manufacturer_default.jpg" alt=" {$manufacturer.name|escape:'html':'UTF-8'}" />
	        </a>
	        <h5><a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)|escape:'html':'UTF-8'}" title="{l s='More about' mod='blockmanufactureri'} {$manufacturer.name|escape:'html':'UTF-8'}"> {$manufacturer.name|escape:'htmlall':'UTF-8'}</a>
	        </h5>
        </div>
		{/if}
	{/foreach}
	</div>
{else}
	<p>{l s='No manufacturer' mod='blockmanufactureri'}</p>
{/if}
</div>