<div class="kb-vspacer5"></div>
<div class="kb-panel outer-border kb_product_section">
    <div data-toggle="kb-product-form-binformation" class='kb-panel-header kb-panel-header-tab'>
        <h1>{$form_title|escape:'htmlall':'UTF-8'}</h1>
        <div class='kb-accordian-symbol kbexpand'><i class="kb-material-icons">&#xe145;</i></div>
        <div class='clearfix'></div>
    </div>
    <div id="kb-product-form-binformation" class='kb-panel-body'>
        <div class="kb-block kb-form">
            <ul class="kb-form-list">
                {if isset($service_type)}
                    <li class="kb-form-fwidth">
                        <div class="kb-form-label-block">
                            <span class="kblabel ">{l s='Service Type' mod='kbmarketplace'}</span>
                        </div>
                        <div class="kb-form-field-block">
                            <select name="service_type" class="kb-inpselect">
                                <option value="home_service" {if $service_type == 'home_service'}selected="selected"{/if}>{l s='Home Service' mod='kbmarketplace'}</option>
                                <option value="branch" {if $service_type == 'branch'}selected="selected"{/if}> {l s='Branch' mod='kbmarketplace'}</option>
                                
                            </select>
                        </div>
                    </li>
                {/if}
                {if isset($period_type)}
                <li class="kb-form-fwidth">
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Period Type' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <select name="period_type" id="period_type" class="kb-inpselect">
                            {if isset($period_type_array['date'])}
                            <option value="date" {if $period_type == 'date'}selected="selected"{/if}>{l s='Date' mod='kbmarketplace'}</option>
                            {/if}
                            {if isset($period_type_array['date_time'])}
                            <option value="date_time" {if $period_type == 'date_time'}selected="selected"{/if}> {l s='Date & Time' mod='kbmarketplace'}</option>
                            {/if}
                        </select>
                    </div>
                </li>
                {/if}
                {if isset($quantity)}
                <li class="kb-form-fwidth">
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Quantity' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-labeled-inpfield">
                        <input type="text" class="kb-inpfield required" validate="isInt" name="quantity" value="{$quantity}" />
                        {*<span class="inplbl">{l s='per day' mod='kbmarketplace'}</span>*}
                        {if $quantity_type == 'date_time'}
                        <span class="inplbl character-count">{l s='/slot/day' mod='kbmarketplace'}</span>
                        {else}
                            <span class="inplbl character-count">{l s='/day' mod='kbmarketplace'}</span>
                        {/if}
                    </div>
                </li>
                {/if}
                {if isset($price)}
                <li class="kb-form-fwidth">
                    <div class="kb-form-label-block">
                        <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='This price is only for the initial mapping. This price is not the final price of the product' mod='kbmarketplace'}">info_outline</i>{l s='Price' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <input type="text" class="kb-inpfield required" validate="isPrice" name="price" value="{$price}" />
                    </div>
                </li>
                {/if}
                <li class="kb-form-fwidth" {*style="padding-left: 35px;width: 410px;"*}>
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Tax' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <div class="kb-labeled-inpfield">
                            <select class="kb-inpselect" id="id_tax_rules_group" name="id_tax_rules_group">
                                {if !empty($tax_rules)} 
                                    {foreach $tax_rules as $tax}
                                        <option value="{$tax['id_tax_rules_group']}" {if $tax_id eq $tax['id_tax_rules_group']} selected {/if} >{$tax['name']|escape:'htmlall':'UTF-8'}</option>
                                    {/foreach}
                                {/if}
                            </select>
                        </div>
                    </div>
                </li>
                {if isset($min_hours)}
                <li class="kb-form-fwidth">
                    <div class="kb-form-label-block">
                        <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='Enter the minimum hours for booking' mod='kbmarketplace'}">info_outline</i>{l s='Min Hours' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <input type="text" class="kb-inpfield required" validate="isInt" name="min_hours" value="{$min_hours}" />
                    </div>
                </li>
                {/if}
                {if isset($max_hours)}
                <li class="kb-form-fwidth">
                    <div class="kb-form-label-block">
                        <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='Enter the minimum hours for booking' mod='kbmarketplace'}">info_outline</i>{l s='Max Hours' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <input type="text" class="kb-inpfield" validate="isInt" id="max_hours" name="max_hours" value="{$max_hours}" />
                    </div>
                </li>
                {/if}
                {if isset($min_days)}
                <li class="kb-form-fwidth">
                    <div class="kb-form-label-block">
                        <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='Enter the minimum days for booking' mod='kbmarketplace'}">info_outline</i>{l s='Min Days' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <input type="text" class="kb-inpfield" validate="isInt" id="min_days" name="min_days" value="{$min_days}" />
                    </div>
                </li>
                {/if}
                {if isset($max_days)}
                <li class="kb-form-fwidth">
                    <div class="kb-form-label-block">
                        <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='Enter the maximum days for booking' mod='kbmarketplace'}">info_outline</i>{l s='Max Days' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <input type="text" class="kb-inpfield required" validate="isInt" name="max_days" value="{$max_days}"/>
                    </div>
                </li>
                {/if}
                {if isset($star_rating)}
                <li class="kb-form-fwidth">
                    <div class="kb-form-label-block">
                        <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='Select the star rating of product' mod='kbmarketplace'}">info_outline</i>{l s='Star Rating' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <select name="star_rating" id="star_rating" class="kb-inpselect">
                                <option value="0" {if $star_rating eq 0}selected="selected"{/if}>{l s='Select Rating' mod='kbmarketplace'}</option>
                                <option value="1" {if $star_rating eq 1}selected="selected"{/if}>{l s='1 Star' mod='kbmarketplace'}</option>
                                <option value="2" {if $star_rating eq 2}selected="selected"{/if}> {l s='2 Star' mod='kbmarketplace'}</option>
                                <option value="3" {if $star_rating eq 3}selected="selected"{/if}> {l s='3 Star' mod='kbmarketplace'}</option>
                                <option value="4" {if $star_rating eq 4}selected="selected"{/if}> {l s='4 Star' mod='kbmarketplace'}</option>
                                <option value="5" {if $star_rating eq 5}selected="selected"{/if}> {l s='5 Star' mod='kbmarketplace'}</option>
                        </select>
                    </div>
                </li>
                {/if}
                
                
                {hook h="displayKbMarketPlaceBPBIForm" product_id=$id_product type=$product_type form="information"}
            </ul>
        </div>
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