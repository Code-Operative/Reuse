{if isset($membership_plans) && count($membership_plans) > 0}
    <div class="kbloading" style="display:none"></div>
    <h1 class="page-heading">
        <span clas="cat-name">{l s='Membership Plans' mod='kbmarketplace'}</span>
        <div class="clearfix"></div>
    </h1>
    <div class="productsFilter">
            <div class="">
                    <span class="showingItems">{$pagination_string nofilter}</span>
                    <select id="selectProductSort" class="selectSellerSort form-control">
                        <option value="" selected="selected">--</option>
                        {foreach $sorting_types as $sort}
                            <option value="{$sort['value']|escape:'htmlall':'UTF-8'}" {if $sort['value'] == $selected_sort} selected="selected"{/if} >{$sort['label']|escape:'htmlall':'UTF-8'}</option>
                        {/foreach}
                    </select>
            </div>
    </div>
    <div class="clearfix"></div>
        <img id="kb-list-loader" src="{$kb_image_path|escape:'htmlall':'UTF-8'}loader128.gif" />

    <div class='kbmp-_block'>

    </div>
    <div id="plan_list_to_customers">
        {include file="./plan_list.tpl"}
    </div>
    <script type="text/javascript">
        var kb_page_start = {$kb_pagination.page_position|intval};
    </script>
{else}
    <h1 class="page-heading" style='border:0;'>
        <span clas="cat-name">{$empty_list|escape:'htmlall':'UTF-8'}</span>
        <div class="clearfix"></div>
    </h1>
{/if}
{if isset($kb_pagination.pagination) && $kb_pagination.pagination neq ''}
    <div class="sv-p-paging" style='padding-bottom:0;'>
        {$kb_pagination.pagination nofilter}  {* Variable contains HTML/CSS/JSON, escape not required *}

        <div class='clearfix'></div>
    </div>
{/if}
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