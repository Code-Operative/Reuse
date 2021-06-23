<li class="tree-folder">
	<span class="tree-folder-name{if isset($node['disabled']) && $node['disabled'] == true} tree-folder-name-disable{/if}">
		{if isset($node['id_category']) && $node['id_category'] != $root_category}
		<input type="checkbox" name="{$input_name|escape:'htmlall':'UTF-8'}[]" value="{$node['id_category']|intval}"{if isset($node['disabled']) && $node['disabled'] == true} disabled="disabled"{/if} />
		{/if}
		<i class="folder-close-icon kb-material-icons">&#xE2C7;</i>
		<label class="tree-toggler">{if isset($node['name'])}{$node['name']}{/if}{if isset($node['selected_childs']) && (int)$node['selected_childs'] > 0} {l s='(%s selected)' sprintf=array($node['selected_childs']) mod='kbmarketplace'}{/if}</label>
	</span>
	<ul class="tree">
		{$children nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

	</ul>
</li>
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
