<style>
    .kb-modal {
    position: absolute;
    top: 0%;
    z-index: 99999;
    background-color: #fff;
    border: 1px solid #777;
    width: 60%;
}
.kb-modal-header .kb-modal-close {
     margin-top: -4%;
}
#kb-marketplace-layout img {
    height: auto;
}
#kb-marketplace-layout img {
    width: auto;
    height: auto;
}
.cobmination-field {
    width: 300px;
}
    </style>


<div class="kb-vspacer5"></div>
<div class="kb-panel outer-border kb_product_section">
    <div data-toggle="kb-product-form-returnpolicy" class='kb-panel-header kb-panel-header-tab'>
        <h1>{$form_title|escape:'htmlall':'UTF-8'}</h1>
        <div class='kb-accordian-symbol kbexpand'><i class="kb-material-icons">&#xe145;</i></div>
        <div class='clearfix'></div>
    </div>
    <div id="kb-product-form-returnpolicy" class='kb-panel-body'>
        {if $id_product eq 0}
            <div class="kbalert kbalert-warning pack-empty-warning">
                <i class="kb-material-icons" style="margin-right:0">&#xE88F;</i> {l s='Before mapping return policy, you must have to save this product.' mod='kbmarketplace'}
            </div>
        {else}
        <div class="kb-block kb-form">
            {* changes by rishabh jain to add option to add supplier*}
            {if $is_enable_custom_policy}
                <div class="kb-form-field-inblock" style="float:right;">
                        <a href="javascript:void(0)" class="kbbtn btn-info" onclick="addNewPolicy();"><i class="kb-material-icons">add</i><span>{l s='Add New Policy' mod='kbmarketplace'}</span></a>
                </div>
            {/if}
            {* changes over*}
         <ul class="kb-form-list">
             <li class="kb-form-fwidth">
                 <div class="kb-form-label-block">
                     <span class="kblabel ">{l s='Choose Return Policy' mod='kbmarketplace'}</span>
                 </div>
                 <div class="kb-form-field-block">
                     <select id="return_manager_policy_select" name="velsof_return_policy" class="form-control select2-hidden-accessible" data-toggle="select2" tabindex="-1" aria-hidden="true">
                        <option value="0">{l s='No Policy' mod='kbmarketplace'}</option>
                        {if isset($velsof_return_policy)}
                            {foreach from=$policy item="policy_lang"}
                                {if $policy_lang['return_data_id'] eq $velsof_return_policy}
                                    <option value="{$policy_lang['return_data_id']}" selected='selected'>{$policy_lang['value']}</option>
                                {else}
                                    <option value="{$policy_lang['return_data_id']}">{$policy_lang['value']}</option>
                                {/if}
                            {/foreach}
                        {else if isset($velsof_default_return_policy)}
                            {foreach from=$policy item="policy_lang"}
                                {if $policy_lang['return_data_id'] eq $velsof_default_return_policy}
                                    <option value="{$policy_lang['return_data_id']}" selected='selected'>{$policy_lang['value']}</option>
                                {else}
                                    <option value="{$policy_lang['return_data_id']}">{$policy_lang['value']}</option>
                                {/if}
                            {/foreach}
                        {else}
                            {foreach from=$policy item="policy_lang"}
                                <option value="{$policy_lang['return_data_id']}">{$policy_lang['value']}</option>
                            {/foreach}
                        {/if}
                    </select>

                 </div>
             </li>
             
             <li class="kb-form-fwidth last-row" style='overflow-y: auto'>
                <table class="kb-table-list">
                    <thead>
                        <tr class="heading-row">
                            {* changes by rishabh jain *}
                            <th>{l s='Id' mod='kbmarketplace'}</th>
                            {* changes over *}
                            <th>{l s='Policy' mod='kbmarketplace'}</th>
                            <th>{l s='MIn Credit Time(in days)' mod='kbmarketplace'}</th>
                            <th>{l s='Max Credit Time(in days)' mod='kbmarketplace'}</th>
                            <th>{l s='Min Refund Time(in days)' mod='kbmarketplace'}</th>
                            <th>{l s='Max Refund Time(in days)' mod='kbmarketplace'}</th>
                            <th>{l s='Min Replacement Time(in days)' mod='kbmarketplace'}</th>
                            <th>{l s='Max Replacement Time(in days)' mod='kbmarketplace'}</th>
                        </tr>
                    </thead>
                    <tbody id="kb_return_policy_list">
                        {if count($policy) == 0}
                            <tr><td colspan="7" class="kb-empty-table kb-tcenter">{l s='No Policy has been added till now.' mod='kbmarketplace'}</td></tr>
                        {/if}
                    </tbody>
                </table>
                <table class="kb-table-list" style="display:none;">
                    <tbody id="new_policy_template">
                        <tr id="id_return_policy">                        
                            {* changes by rishabh jain *}
                            <td>id_return_policy</td>
                             {* changes over *}
                            <td>policy</td>
                            <td>credit_min</td>
                            <td>credit_max</td>
                            <td>refund_min</td>
                            <td>refund_max</td>
                            <td>replacement_min</td>
                            <td>replacement_max</td>
                        </tr>    
                    </tbody>
                </table>
            </li>
         </ul>
         
        
        {hook h="displayKbMarketPlacePForm" product_id=$id_product type=$product_type form="returnpolicy"}
    </div>
    {/if}
</div>
    <div id="kb-policy-modal-form" style="display:none;">
    <div class="kb-overlay"></div>
    <div id="policy-loader" class="kb-modal loading-block"><div class="loader128"></div></div>
    <div id="policy-form-content" class="kb-modal" style="display:none">
        <div class="kb-modal-header">
            <h1 id='kb_policy_form_title'>{l s='Add New policy' mod='kbmarketplace'}</h1>
            <span class="kb-modal-close" data-modal="kb-policy-modal-form">X</span>
</div>
        <div class="kb-modal-content">
            <div id="new-policy-form-msg" class="kbalert"></div>
            <div id="new-policy-form" class="new_policy_form kb-form" style="padding:0;">
                <ul class="kb-form-list">
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='Policy Title' mod='kbmarketplace'}<em>*</em>:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                {$i = 0}
                                {foreach from=$languages item='lang'}
                                    <div class="input-row-margin-bottom" style="display: inline-flex;">
                                        <div class='span0'><img src="{$img_lang_dir|escape:'quotes':'UTF-8'}{$lang['id_lang']|escape:'htmlall':'UTF-8'}.jpg" height="11px" width="16px" alt="{$lang['name']|escape:'htmlall':'UTF-8'}" title="{$lang['name']|escape:'htmlall':'UTF-8'}"/></div>
                                        <div class="span4">
                                            <input type="text" id="policy_new{$lang['id_lang']|escape:'htmlall':'UTF-8'}" class="add_policy_new rm_modal_input" name="policy_new_{$lang['id_lang']|escape:'htmlall':'UTF-8'}" placeholder="{l s='Enter Policy' mod='kbmarketplace'}" style="width: 95%;"/>
                                        </div>
                                    </div>
                                    {$i = $i+1}
                                {/foreach}
                            </div>    
                        </div>
                    </li>
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='Write your terms and conditions for this policy' mod='kbmarketplace'}<em>*</em>:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                {$i = 0}
                                    {foreach from=$languages item='lang'}
                                        <div class="row input-row-margin-bottom">
                                            <div class='span0'><img src="{$img_lang_dir|escape:'quotes':'UTF-8'}{$lang['id_lang']|escape:'htmlall':'UTF-8'}.jpg" height="11px" width="16px" alt="{$lang['name']|escape:'htmlall':'UTF-8'}" title="{$lang['name']|escape:'htmlall':'UTF-8'}" style="width:auto;"/></div>
                                            <div class="span4">
                                                <textarea type="text" rows="7" id="policy_new_term{$lang['id_lang']|escape:'htmlall':'UTF-8'}" class="add_policy_new_term rm_modal_input" name="policy_new_term_{$lang['id_lang']|escape:'htmlall':'UTF-8'}" style="width: 95%;"></textarea>
                                            </div>
                                        </div>
                                        {$i = $i+1}
                                    {/foreach}
                            </div>    
                        </div>
                    </li>
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='Credit' mod='kbmarketplace'}:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                <div class='span4'>
                                    <input id="credit_check" name="credit_check" type="checkbox" onchange="toggleStatus(this);"/>
                                    <span>{l s='Min :' mod='kbmarketplace'}</span>
                                    <input class="rm_policy_options_day_input" id="credit_min" type="text" disabled="disabled" name="credit_min"/> &nbsp;({l s='in days' mod='kbmarketplace'})
                                    <span style="margin-left: 6%">{l s='Max :' mod='kbmarketplace'}</span>
                                    <input class="rm_policy_options_day_input" style="margin-top: 6%;" id="credit_max" type="text" disabled="disabled" name="credit_max"/> &nbsp;({l s='in days' mod='kbmarketplace'})
                                </div>
                                <div id="rm_credit_box" class="span4 rm_policy_options_text" style='display:none;margin-left: 6%'>
                                    {$i = 0}
                                    {foreach from=$languages item='lang'}
                                        <div class='span0'><img src="{$img_lang_dir|escape:'quotes':'UTF-8'}{$lang['id_lang']|escape:'htmlall':'UTF-8'}.jpg" height="11px" width="16px" alt="{$lang['name']|escape:'htmlall':'UTF-8'}" title="{$lang['name']|escape:'htmlall':'UTF-8'}"/></div>
                                        <textarea name="rm_credit_text_{$lang['id_lang']|escape:'htmlall':'UTF-8'}"></textarea>
                                        {$i = $i+1}
                                    {/foreach}                                                                                                                                                                                                                                        
                                </div>
                            </div>    
                        </div>
                    </li>
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='Refund' mod='kbmarketplace'}:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                <div class='span4'>
                                    <input id="refund_check" name="refund_check" type="checkbox" onchange="toggleStatus(this);" />
                                    <span>{l s='Min :' mod='kbmarketplace'}</span>
                                    <input class="rm_policy_options_day_input" id="refund_min" type="text" disabled="disabled" name="refund_min" /> &nbsp;({l s='in days' mod='kbmarketplace'})
                                    <span style="margin-left: 6%">{l s='Max :' mod='kbmarketplace'}</span>
                                    <input class="rm_policy_options_day_input" id="refund_max" style="margin-top: 6%;" type="text" disabled="disabled" name="refund_max" /> &nbsp;({l s='in days' mod='kbmarketplace'})
                                </div>
                                <div id="rm_refund_box" class="span4 rm_policy_options_text" style='display:none;margin-left: 6%'>
                                    {$i = 0}
                                    {foreach from=$languages item='lang'}
                                        <div class='span0'><img src="{$img_lang_dir|escape:'quotes':'UTF-8'}{$lang['id_lang']|escape:'htmlall':'UTF-8'}.jpg" height="11px" width="16px" alt="{$lang['name']|escape:'htmlall':'UTF-8'}" title="{$lang['name']|escape:'htmlall':'UTF-8'}"/></div>
                                        <textarea name="rm_refund_text_{$lang['id_lang']|escape:'htmlall':'UTF-8'}"></textarea>
                                        {$i = $i+1}
                                    {/foreach}                                                                                                                                                                                                                                       
                                </div>
                            </div>    
                        </div>
                    </li>
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='Replacement' mod='kbmarketplace'}<em>*</em>:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                <div class='span4'>
                                    <input name="replacement_check" id="replacement_check" type="checkbox"  onchange="toggleStatus(this);"/>
                                    <span>{l s='Min :' mod='kbmarketplace'}</span>
                                    <input class="rm_policy_options_day_input" id="replacement_min" type="text" disabled="disabled" name="replacement_min"/> &nbsp;({l s='in days' mod='kbmarketplace'})
                                    <span style="margin-left: 6%">{l s='Max :' mod='kbmarketplace'}</span>
                                    <input class="rm_policy_options_day_input" id="replacement_max" style="margin-top: 6%;" type="text" disabled="disabled" name="replacement_max"/> &nbsp;({l s='in days' mod='kbmarketplace'})
                                </div>
                                    <div id="rm_replacement_box" class="span4 rm_policy_options_text" style='display:none;margin-left: 6%'>
                                    {$i = 0}
                                    {foreach from=$languages item='lang'}
                                        <div class='span0'><img src="{$img_lang_dir|escape:'quotes':'UTF-8'}{$lang['id_lang']|escape:'htmlall':'UTF-8'}.jpg" height="11px" width="16px" alt="{$lang['name']|escape:'htmlall':'UTF-8'}" title="{$lang['name']|escape:'htmlall':'UTF-8'}"/></div>
                                        <textarea name="rm_replacement_text_{$lang['id_lang']|escape:'htmlall':'UTF-8'}"></textarea>
                                        {$i = $i+1}
                                    {/foreach}                                                                                                                                                                                                                                       
                                    </div>
                            </div>    
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kb-modal-footer">
            <button id="policy-submit" type="button" class="kbbtn-big kbbtn-success" data-id="0" onclick="savePolicy()">{l s='Submit' mod='kbmarketplace'}</button>
            <div id="policy-updating-progress" class="input-loader" style="display: none; vertical-align: middle;"></div>
        </div>
    </div>
</div>
<script>
    var number_days_error_min = "{l s='Please enter days between 0 to 1000.' mod='kbmarketplace'}";
    var number_days_error_max = "{l s='Please enter days between 1 to 1000.' mod='kbmarketplace'}";
    var policy_title_error = "{l s='Please enter Policy Title.' mod='kbmarketplace'}";
    var policy_terms_error = "{l s='Please enter Policy Terms & Conditions.' mod='kbmarketplace'}";
    var credit_error = "{l s='Please enter Credit days.' mod='kbmarketplace'}";
    var refund_error = "{l s='Please enter Refund days.' mod='kbmarketplace'}";
    var replacement_error = "{l s='Please enter Replacement days.' mod='kbmarketplace'}";
    var requiredNumber = "{l s='Positive number value required' mod='kbmarketplace'}";
    var Notrequirefloat = "{l s='Please Enter an Integer' mod='kbmarketplace'}";
    var refund_min_error = "{l s='Min refund days can not be greater than max refund days.' mod='kbmarketplace'}";
    var credit_min_error = "{l s='Min credit days can not be greater than max credit days.' mod='kbmarketplace'}";
    var replacement_min_error = "{l s='Min replacement days can not be greater than max replacement days.' mod='kbmarketplace'}";
    var day_equal_error = "{l s='Min and Max days should be dfferent.' mod='kbmarketplace'}";
    $(document).ready(function(){ 
        {if count($policy) > 0}
            {foreach $policy as $policy_detail}
                displayReturnPolicyRow({$policy_detail['return_data_id']|intval},
                    "{$policy_detail['value']|escape:'htmlall':'UTF-8'}",
                    {$policy_detail['credit_days']|intval},
                    {$policy_detail['credit_min_days']|intval},
                    {$policy_detail['refund_days']|intval},
                    {$policy_detail['refund_min_days']|intval},
                    {$policy_detail['replacement_days']|intval},
                    {$policy_detail['replacement_min_days']|intval}
                    );
            {/foreach}
        {/if}
    });
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