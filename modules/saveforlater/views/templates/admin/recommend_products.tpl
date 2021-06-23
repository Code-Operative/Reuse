<table class="recommend-ajaxform-table1" cellspaing="0" cellpadding="0">
    <tr>
        <td class="settings span3">
            <label>{l s='Choose Category(s)' mod='saveforlater'}</label>
            <select name="recommendations[categorycontent][]" multiple="multiple" id="recommendoption_c_list" class="sfl-lf-width">
                {foreach $categories as $categ}
                    <option value="{$categ['id_category']}" {if in_array($categ['id_category'], $selected_categories)}selected="selected"{/if}>{$categ['name']}</option>{*Variable contains a URL, escape not required*}
                {/foreach}
            </select>
        </td>
        <td class="settings span3">
            <label>{l s='Choose Products(s)' mod='saveforlater'}</label>
            <select name="recommendations[content][]" multiple="multiple" id="recommendoption_p_list" class="sfl-lf-width">
                {foreach $products as $pro}
                    <option data-image="{$pro['image']|escape:'htmlall':'UTF-8'}" value="{$pro['id_product']}" {if in_array($pro['id_product'], $selected_products)}selected="selected"{/if}>{$pro['name']} ({$pro['reference']})</option>{*Variable contains a URL, escape not required*}
                {/foreach}
            </select>
        </td>
    </tr>
</table>
<br>
<table id="recommended_selected_products" class="recommend-ajax-table1" cellspaing="0" cellpadding="0" style="display:{if count($selected_products) > 0}block{else}none{/if};">
    <tr>
        <td colspan="3" class="sel-l-head">
            {l s='Selected Product(s)' mod='saveforlater'}            
        </td>
    </tr>
    {if count($selected_products) > 0}
    {foreach $selected_products as $id_product}
    <tr id="recommended-sel-pro-{$id_product}">
        <td class="selected-item-cell cell-pro-image">
            {$products[$id_product]['image'] nofilter} {*Variable contains a URL, escape not required*}
        </td>
        <td class="selected-item-cell span5">
            {$products[$id_product]['name']}{*Variable contains this, escape not required*}
            <small>{l s= 'Reference' mod='saveforlater'}: {$products[$id_product]['reference']}</small>{*Variable contains this, escape not required*}
        </td>
        <td class="selected-item-cell cls-row-cell">
            <span class="sfl-close-icn" onclick="removeRecommendedSelProduct({$id_product})"></span>{*Variable contains this, escape not required*}
        </td>
    </tr>
    {/foreach}
    {/if}
</table>
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
* @copyright 2015 knowband
* @license   see file: LICENSE.txt
*}