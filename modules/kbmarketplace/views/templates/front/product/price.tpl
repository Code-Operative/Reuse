<script>
var tax_rules = {$tax_rates nofilter};{*Variables contain JSON, can not escape this.*}
</script>
<div class="kb-vspacer5"></div>
<div class="kb-panel outer-border kb_product_section">
    <div data-toggle="kb-product-form-price" class='kb-panel-header kb-panel-header-tab'>
        <h1>{$form_title|escape:'htmlall':'UTF-8'}</h1>
        <div class='kb-accordian-symbol kbexpand'><i class="kb-material-icons">&#xe145;</i></div>
        <div class='clearfix'></div>
    </div>
    <div id="kb-product-form-price" class='kb-panel-body'>
        <div class="kb-block kb-form">
            <ul class="kb-form-list">
                <li class="kb-form-l">
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Wholesale Price' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <div class="kb-labeled-inpfield">
                            {if isset($currency_prefix)}
                                <span class="inplbl">{$currency_prefix|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                        <input type="text" class="kb-inpfield" validate="isPrice" name="wholesale_price" value="{$wholesale_price}" />
                            {if isset($currency_suffix)}
                                <span class="inplbl">{$currency_suffix|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                        </div>
                    </div>
                </li>
                <li class="kb-form-r">
                    <div class="kb-form-label-block">
                        {* changes done by rishabh jain on 11th oct 2018 to add price with tax inclusive and exclusive field *}
                        <span class="kblabel ">{l s='Retail Price(Tax Excl.)' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <div class="kb-labeled-inpfield">
                            {if isset($currency_prefix)}
                                <span class="inplbl">{$currency_prefix|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                        <input id="price" type="text" class="kb-inpfield required" validate="isPrice" name="price" value="{$price}" />
                        {if isset($currency_suffix)}
                                <span class="inplbl">{$currency_suffix|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                        </div>
                    </div>
                </li>
                {* Chnages started 
                @author : Rishabh Jain 
                DOM : 11th OC 2018
                to add tax price field in price form *}
                <li class="kb-form-l">
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Retail Price(Tax incl.)' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <div class="kb-labeled-inpfield">
                            {if isset($currency_prefix)}
                                <span class="inplbl">{$currency_prefix|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                        <input id="price_tax_incl" type="text" class="kb-inpfield required" validate="isPrice" name="price_tax_incl" value="{$price}"/>
                        {if isset($currency_suffix)}
                                <span class="inplbl">{$currency_suffix|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                        </div>
                    </div>
                </li>
                <!-- to add tax field done by rishabh jain on 19th july 2018-->
                <li class="kb-form-r" {*style="padding-left: 35px;width: 410px;"*}>
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Tax' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <div class="kb-labeled-inpfield">
                            <select class="kb-inpselect" id="tax_rule" name="tax_rule" onchange="displayTaxInclusivePrice()">
                                {if !empty($tax_rules)} 
                                    {foreach $tax_rules as $tax}
                                        <option value="{$tax['id']}" {if $tax_id eq $tax['id']} selected {/if} >{$tax['name']|escape:'htmlall':'UTF-8'}</option>
                                    {/foreach}
                                {/if}
                            </select>
                            {*<input type="hidden" id="tax_rate_0" name="tax_rate_0" value="0">
                            {if !empty($tax_rules)} 
                                    {foreach $tax_rules as $tax}
                                        <input type="hidden" id="tax_rate_{$tax['id']}" name="tax_rate_{$tax['id']}" value="{$tax['rate']}">
                                    {/foreach}
                                {/if}*}
                        </div>
                    </div>
                </li>
                
                <!-- chnages over -->
                {* changes over *}
                <li class="kb-form-l">
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Unit Price Per Quantity' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <div class="kb-labeled-inpfield">
                            {if isset($currency_prefix)}
                                <span class="inplbl">{$currency_prefix|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                        <input type="text" class="kb-inpfield" style="width:48%;" name="unit_price" validate="isPrice" value="{$unit_price}"  maxlength="14"/>
                            {if isset($currency_suffix)}
                                <span class="inplbl">{$currency_suffix|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                        <input type="text" class="kb-inpfield" style="width:48%;margin-left:3%;" name="unity" value="{$unity}" placeholder="{l s='per kilo, per lt' mod='kbmarketplace'}"/>
                        </div>
                            
                    </div>
                </li>
                <li class="kb-form-r">
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Apply a discount of' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <div class="kb-labeled-inpfield">
                            {if isset($currency_prefix)}
                                <span class="inplbl">{$currency_prefix|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                        <input id="sp_reduction" type="text" class="kb-inpfield" style="width:48%;" name="sp_reduction" validate="isPrice" value="{$specific_price}" />
                        {if isset($currency_suffix)}
                                <span class="inplbl">{$currency_suffix|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                            <select class="kb-inpselect" id="discount_type" name="discount_type" style="width:48%;margin-left:3%;" onchange="setrequiredvalidation()">
                                    {foreach $discount_types as $discount}
                                        <option value="{$discount['id']}" {if $discount_type eq $discount['id']} selected {/if} >{$discount['name']|escape:'htmlall':'UTF-8'}</option>
                                    {/foreach}
                                
                            </select>
                    </div>
                </li>
                <li class="kb-form-l">
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Special Price Start Date' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <div class="kb-labeled-inpfield">
                            <span class="inplbl"><i class="kb-material-icons">date_range</i></span>
                            <input id="sp_from_date" type="text" class="kb-inpfield datepicker" name="sp_from_date" validate="isDate" value="{$specific_price_from|escape:'htmlall':'UTF-8'}" />
                        </div>
                    </div>
                </li>
                <li class="kb-form-r">
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Special Price End Date' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <div class="kb-labeled-inpfield">
                            <span class="inplbl"><i class="kb-material-icons">date_range</i></span>
                            <input id="sp_to" type="text" class="kb-inpfield datepicker" name="sp_to" validate="isDate" value="{$specific_price_to|escape:'htmlall':'UTF-8'}" />
                        </div>
                    </div>
                </li>
                <li class="kb-form-fwidth last-row">
                    <div class="kb-form-field-block">
                        <div class="kboption-inline kb-inpoption">
                            <input class="" type="checkbox" id="label_for_on_sale" name="on_sale" value="1" {if $on_sale}checked="checked"{/if}/> <label for="label_for_on_sale">{l s='Display the "on sale" icon on the product page, and in the text found within the product listing.' mod='kbmarketplace'}</label>    
                        </div>
                    </div>
                </li>
            </ul>
            {hook h="displayKbMarketPlacePForm" product_id=$id_product type=$product_type form="price"}
        </div>
    </div>
</div>
<script type="text/javascript">
    var kb_special_price_invalid = "{l s='Special price should not be greater than retail price' mod='kbmarketplace'}";
    var kb_invalid_sp_date_msg = "{l s='End date should not be greater than start date' mod='kbmarketplace'}";
</script>
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