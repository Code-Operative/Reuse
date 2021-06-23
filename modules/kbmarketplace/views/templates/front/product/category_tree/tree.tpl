<div class="panel">
	{if isset($header)}
        {$header nofilter}  {* Variable contains HTML/CSS/JSON, escape not required *}

    {/if}
	{if isset($nodes)}
	<ul id="{$id}" class="tree">
		{$nodes nofilter}  {* Variable contains HTML/CSS/JSON, escape not required *}

	</ul>
	{/if}
</div>
{*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer tohttp://www.prestashop.com for more information.
* We offer the best and most useful modules PrestaShop and modifications for your online store.
*
* @category  PrestaShop Module
* @author    knowband.com <support@knowband.com>
* @copyright 2016 knowband
* @license   see file: LICENSE.txt
*}