<div class="kb-content">
    {if !isset($permission_error)}
        <div class="kb-content-header">
            <h1>{l s='Add/Edit Price Rule' mod='kbmarketplace'}</h1>
            <div class="kbbtn-group kb-tright">
                <a href="{$cancel_button nofilter}" class="btn-sm btn-danger" title="{l s='click to go back to zone list' mod='kbmarketplace'}"><i class="kb-material-icons">cancel</i>{l s='Cancel' mod='kbmarketplace'}</a> {* Variable contains HTML/CSS/JSON, escape not required *}
            </div>
            <div class="clearfix"></div>
        </div>
        <form id="kb-price-rule-view-form" action="{$price_rule_submit_url nofilter}" method="post" enctype="multipart/form-data"> {* Variable contains HTML/CSS/JSON, escape not required *}
            <input type="hidden" name="price_rule_form" value="1" />
            <div id="kb-zipcode-view-form-global-msg" class="kbalert kbalert-danger" style="display:none;"></div>
            <div class="kbalert kbalert-info">
                <i class="kb-material-icons">help_outline</i>{l s='Fields marked with (*) are mandatory fields.' mod='kbmarketplace'}
            </div>
            
            <div class="kb-panel outer-border">
                <div class='kb-panel-body'>
                    <div class="kb-block kb-form">
                        <input type="hidden" class="kb-inpfield required" id="id_price_rule" validate="" name="id_price_rule" value="{if isset($id_price_rule) && $id_price_rule != 0}{$id_price_rule}{/if}"/>
                        <ul class="kb-form-list">
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Title' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" id="name" validate="isGenericName" name="name" value="{if isset($rule_name) && $rule_name != ''} {$rule_name}{/if}" />
                                </div>
                            </li>
                            
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Select Product' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="id_product" id="id_product" class="kb-inpselect">
                                        <option value="0" selected="selected">{l s='Select Product' mod='kbmarketplace'}</option>
                                        {foreach $sellers_products as $products}
                                            <option value="{$products['id_product']}" {if isset($price_rule_obj->id_product) && $price_rule_obj->id_product == $products['id_product']}selected="selected"{/if}>{$products['product_name']}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Active' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="active" class="kb-inpselect">
                                        <option value="0" {if isset($price_rule_obj->active) && $price_rule_obj->active == 0}selected="selected"{/if}>{l s='No' mod='kbmarketplace'}</option>
                                        <option value="1" {if isset($price_rule_obj->active) && $price_rule_obj->active == 1}selected="selected"{/if}>{l s='Yes' mod='kbmarketplace'}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Date Type' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="date_selection" id="date_selection" class="kb-inpselect">
                                        <option value="date_range" {if isset($price_rule_obj->date_selection) && $price_rule_obj->date_selection == 'date_range'}selected="selected"{/if}>{l s='Date Range' mod='kbmarketplace'}</option>
                                        <option value="particular_date" {if isset($price_rule_obj->date_selection) && $price_rule_obj->date_selection == 'particular_date'}selected="selected"{/if}>{l s='Specific Date' mod='kbmarketplace'}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='' mod='kbmarketplace'}">info_outline</i>{l s='Start Date' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield datepicker required" validate="isDate" id="start_date" name="start_date" value="{if isset($price_rule_obj->start_date)}{$price_rule_obj->start_date}{/if}" size="11" maxlength="10" autocomplete="off" />
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='' mod='kbmarketplace'}">info_outline</i>{l s='End Date' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield datepicker required" validate="isDate" id="end_date" name="end_date" value="{if isset($price_rule_obj->end_date)}{$price_rule_obj->end_date}{/if}" size="11" maxlength="10" autocomplete="off" />
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='' mod='kbmarketplace'}">info_outline</i>{l s='Specific Date' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield datepicker required" validate="isDate" id="particular_date" name="particular_date" value="{if isset($price_rule_obj->particular_date)}{$price_rule_obj->particular_date}{/if}" size="11" maxlength="10" autocomplete="off" />
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Reduction Type' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="reduction_type" id="reduction_type" class="kb-inpselect">
                                        <option value="percentage" {if isset($price_rule_obj->reduction_type) && $price_rule_obj->reduction_type == 'percentage'}selected="selected"{/if}>{l s='Percentage' mod='kbmarketplace'}</option>
                                        <option value="fixed" {if isset($price_rule_obj->reduction_type) && $price_rule_obj->reduction_type == 'fixed'}selected="selected"{/if}>{l s='Fixed' mod='kbmarketplace'}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Reduction' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" id="reduction" validate="isPrice" name="reduction" value="{if isset($price_rule_obj->reduction)} {$price_rule_obj->reduction}{/if}" />
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class='kb-vspacer5'></div>
            <button id='save-price-rule-viewBtn' type="button" class='btn-sm btn-success' onclick="validatePriceRuleForm()">{l s='Save' mod='kbmarketplace'}</button>
        </form>
        <script>
            var min_max_hrs_valid = "{l s='End date cannot be previous/same to start date.' mod='kbmarketplace'}";
        </script>
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
