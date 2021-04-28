<script>
    var disable_days = "{l s='Select Disable Days' mod='kbmarketplace'}";
    var all_selected = "{l s='All Selected' mod='kbmarketplace'}";
    var characters = "{l s='characters' mod='kbmarketplace'}";
</script>
<div class="kb-vspacer5"></div>
<div class="kb-panel outer-border kb_product_section">
    <div data-toggle="kb-product-form-DateTime" class='kb-panel-header kb-panel-header-tab'>
        <h1>{$form_title|escape:'htmlall':'UTF-8'}</h1>
        <div class='kb-accordian-symbol kbexpand'><i class="kb-material-icons">&#xe145;</i></div>
        <div class='clearfix'></div>
    </div>
    <div id="kb-product-form-DateTime" class='kb-panel-body'>
        {if $id_product eq 0}
            <div class="kbalert kbalert-warning pack-empty-warning">
                <i class="kb-material-icons" style="margin-right:0;">&#xE88F;</i> {l s='Please save this product, before adding date/time.' mod='kbmarketplace'}
            </div>
        {else}
        <div class="kb-block kb-form">
            <ul class="kb-form-list">
                {if $product_type != $type_hotel_booking}
                <li class="kb-form-fwidth last-row">
                    <div class="kb-form-label-block">
                    <span class="kblabel " title="{l s='Disable Days' mod='kbmarketplace'}">{l s='Disable Days' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <select id="selectbox_product_disable_days" name="disable_days[]" class="kb-inpselect selectbox_disable_days" multiple="multiple" data-id='kb_mp_product_default_disable_days'>
                            {if $available_days > 0}
                            {foreach $available_days as $available_day}
                            <option class="customize_options" value="{$available_day['id']|intval}" {if $available_day['is_selected'] == true}selected="selected"{/if}>{$available_day['name']|escape:'html':'UTF-8'}</option>
                            {/foreach}
                            {else}
                            <option class="customize_options" value='0'>{l s='Select' mod='kbmarketplace'}</option>
                            {/if}
                        </select>
                    </div>
                </li>
                {/if}
                <li class="kb-form-fwidth last-row">
                    <div class="kb-form-label-block">
                    <span class="kblabel " title="{l s='Enter Date/Time Slot' mod='kbmarketplace'}">{l s='Enter Date/Time Slot' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block kb-date-time-block">
                        {include file="./date_time_block_product.tpl"}
                    </div>
                </li>
                {hook h="displayKbMarketPlaceBPDTForm" product_id=$id_product type=$product_type form="information"}
            </ul>
            
        </div>
        {/if}
                {* changes by rishabh jain to show manufacturer form *}
    </div>
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