
{extends file="helpers/form/form.tpl"}

{block name="other_fieldsets"}
    <div id="conditions">
        <div id="condition_group_list">
            <div id="condition_group_1" class="panel condition_group alert-info">
                <h3><i class="icon-tasks"></i> {l s='Deal Rules Set' mod='kbmpdealmanager'}</h3>
                <table class="table alert-info">
                    <thead>
                        <tr>
                            <th class="fixed-width-md"><span class="title_box">{l s='Type' mod='kbmpdealmanager'}</span></th>
                            <th><span class="title_box">{l s='Value' mod='kbmpdealmanager'}</span></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="seller_deal_rules">
                        {if count($deal_rule_categories) > 0}
                            {foreach $categories as $cat}
                                {if in_array($cat['id_category'], $deal_rule_categories)}
                                    <tr>
                                        <td>{l s='Category' mod='kbmpdealmanager'}</td>
                                        <td><input type="hidden" name="deal_rule_categories[]" value="{$cat['id_category']|intval}" />{$cat['name']|escape:'htmlall':'UTF-8'}</td>
                                        <td><a href="javascript:void(0)" onclick="deleteSellerDealRule(this)" class="btn btn-default" title="{l s='Click to delete rule' mod='kbmpdealmanager'}">{l s='Delete' mod='kbmpdealmanager'}</a></td>
                                    </tr>
                                {/if}
                            {/foreach}
                        {/if}
                        {if count($deal_rule_manufacturers) > 0}
                            {foreach $manufacturers as $manu}
                                {if in_array($manu['id_manufacturer'], $deal_rule_manufacturers)}
                                    <tr>
                                        <td>{l s='Manufacturer' mod='kbmpdealmanager'}</td>
                                        <td><input type="hidden" name="deal_rule_manufacturers[]" value="{$manu['id_manufacturer']|intval}" />{$manu['name']|escape:'htmlall':'UTF-8'}</td>
                                        <td><a href="javascript:void(0)" onclick="deleteSellerDealRule(this)" class="btn btn-default" title="{l s='Click to delete rule' mod='kbmpdealmanager'}">{l s='Delete' mod='kbmpdealmanager'}</a></td>
                                    </tr>
                                {/if}
                            {/foreach}
                        {/if}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="clearfix">&nbsp;</div>
    <div class="panel" id="conditions-panel">
        <h3><i class="icon-tasks"></i> {l s='Rule Options' mod='kbmpdealmanager'}</h3>
        <div class="form-group">
            <label for="id_category" class="control-label col-lg-3">{l s='Category' mod='kbmpdealmanager'}</label>
            <div class="col-lg-9">
                <div class="col-lg-8">
                    <select id="deal_rule_category" name="deal_rule_category">
                        {foreach $categories as $cat}
                            <option value="{$cat['id_category']|intval}" {if ($assigned_cat_exist && !in_array($cat['id_category'], $assigned_categories))}disabled="disabled"{/if}>{$cat['name']|escape:'htmlall':'UTF-8'}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-lg-1">
                    <a class="btn btn-default" href="javascript:void(0)" onclick="addCategoryRule()">
                        <i class="icon-plus-sign"></i> {l s='Add Rule' mod='kbmpdealmanager'}
                    </a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="id_manufacturer" class="control-label col-lg-3">{l s='Manufacturer' mod='kbmpdealmanager'}</label>
            <div class="col-lg-9">
                <div class="col-lg-8">
                    <select id="deal_rule_manufacturer" name="deal_rule_manufacturer">
                        {foreach $manufacturers as $manu}
                            <option value="{$manu['id_manufacturer']|intval}" >{$manu['name']|escape:'htmlall':'UTF-8'}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-lg-1">
                    <a class="btn btn-default" href="javascript:void(0)" onclick="addManufacturerRule()">
                        <i class="icon-plus-sign"></i> {l s='Add Rule' mod='kbmpdealmanager'}
                    </a>
                </div>
            </div>
        </div>
    </div>
{/block}

{block name="script"}

var kbmp_dealtype_cart= '{DealTool::DEAL_TYPE_CART|intval}';
var kbmp_reductiontype_percent = '{DealTool::REDUCTION_TYPE_PERCENTAGE|intval}';
var kb_dealrule_label_delete = '{l s='Delete'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}';
var kb_dealrule_label_category = '{l s='Category'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}';
var kb_dealrule_label_manufacturer = '{l s='Manufacturer'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}';
var kb_dealrule_delete_hint = '{l s='Click to delete rule'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}';
var kb_required_field = '{l s='Required field'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}';
var kb_invalid_field = '{l s='Invalid value'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}';
var kb_invalid_deal_date_msg = '{l s='End date should be greater the start date'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}';
var kb_invalid_discount_range = '{l s='Discount should be between 1-100'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}';
var kb_dealrule_required_rule  = '{l s='Atleast one rule is required.'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}';

{/block}

{block name="after"}

    <style>
        .has-error .error {
            color: #ff0000;
            font-size: 10px;
            display: block;
        }
    </style>
    
{/block}
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