<script>
    var path_fold = null;
</script>
{if $Enable == 1}
<div class="kb-content">
    {if !isset($permission_error)}
        <div class="kb-content-header">
            <h1>{$form_heading|escape:'htmlall':'UTF-8'}</h1>
            {if $deal->id > 0}
            <div class="kb-content-header-btn">
                <a href="javascript:void(0)" onclick="actionDeleteConfirmation(this)" data-href="{$link->getModuleLink('kbmpdealmanager', 'mydeals', ['render' => 'delete', 'id_seller_deal' => $deal->id], (bool)Configuration::get('PS_SSL_ENABLED'))|escape:'htmlall':'UTF-8'}" class="kbbtn btn-danger" title="{l s='click to delete deal' mod='kbmpdealmanager'}"><i class="icon-trash"><span>{l s='Delete' mod='kbmpdealmanager'}</span></i></a>
            </div>
            {/if}
            <div class="clearfix"></div>
        </div>
        <form id="kb-seller-deal-form" action="{$deal_submit_url|escape:'htmlall':'UTF-8'}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="submitSellerDeal" value="1" />
            <input type="hidden" id="id_seller_deal" name="id_seller_deal" value="{$deal->id|intval}" />
            <div id="kb-shipping-form-global-msg" class="kbalert kbalert-danger" style="display:none;"></div>
            <div class="kbalert kbalert-info">
                <i class="icon-question-sign"></i>{l s='Fields marked with (*) are mandatory fields.' mod='kbmpdealmanager'}
            </div>
            <div class="kb-panel outer-border">
                <div class='kb-panel-body'>
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Deal Title' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" validate="isGenericName" name="title" value="{if !empty($deal->title)}{if isset($deal->title[$lang_id])}{$deal->title[$lang_id]|escape:'htmlall':'UTF-8'}{/if}{/if}"/>
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Deal Banner' mod='kbmpdealmanager'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="form-img-display">
                                        <img id="seller_deal_banner_placeholder" style="max-height:300px;" class="form-banner-display" src="{$banner_path|escape:'htmlall':'UTF-8'}" title="{l s='Banner of your deal/offer' mod='kbmpdealmanager'}">
                                    </div>
                                    <input id="seller_deal_banner" class="kb_upload_field" type="file" name="banner_path" style="display:none;" />
                                    <div class="kb-block file-uploader">
                                        <a href="javascript:void(0)" onclick="uploadImage('seller_deal_banner')" >{l s='Browse' mod='kbmpdealmanager'}</a>
                                        <a href="javascript:void(0)" onclick="removeSellerImage('seller_deal_banner', '{$seller_default_dealbanner|escape:'htmlall':'UTF-8'}')" >{l s='Remove' mod='kbmpdealmanager'}</a>
                                        <input id="seller_deal_banner_update" type="hidden" name="seller_deal_banner_update" value="0" />
                                    </div>
                                    <p class="form-inp-help">{l s='Provide your banner in landscape size to visible properly on website.' mod='kbmpdealmanager'}</p>
                                    <div id="seller_deal_banner_error" class="kb-validation-error"></div>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Start Date' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="kb-labeled-inpfield">
                                        <span class="inplbl"><i class="icon-calendar-empty"></i></span>
                                        <input id="seller_deal_from_date" type="text" class="kb-inpfield datetimepicker required" name="from_date" validate="isDateTime" value="{if !empty($deal->from_date)}{date('Y-m-d H:i:s', strtotime($deal->from_date))|escape:'htmlall':'UTF-8'}{/if}" />
                                    </div>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='End Date' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="kb-labeled-inpfield">
                                        <span class="inplbl"><i class="icon-calendar-empty"></i></span>
                                        <input id="seller_deal_end_date" type="text" class="kb-inpfield datetimepicker required" name="end_date" validate="isDateTime" value="{if !empty($deal->end_date)}{date('Y-m-d H:i:s', strtotime($deal->end_date))|escape:'htmlall':'UTF-8'}{/if}" />
                                    </div>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Deal Type' mod='kbmpdealmanager'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select id="kbmp_deal_type" name="deal_type" class="kb-inpselect required" onchange="switchDealType(this)">
                                        {foreach DealTool::getDealTypes() as $key => $val}
                                            {if $key!=3}
                                                <option value="{$key|intval}" {if $key eq $deal->deal_type}selected="selected"{/if}>{$deal_types[$key]}{*{$val|escape:'htmlall':'UTF-8'}*}</option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Active' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="active" class="kb-inpselect required">
                                        <option value="0" {if $deal->active eq 0}selected="selected"{/if}>{l s='No' mod='kbmpdealmanager'}</option>
                                        <option value="1" {if $deal->active eq 1}selected="selected"{/if}>{l s='Yes' mod='kbmpdealmanager'}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-l deal_cart_rule">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">
                                        <i class="icon-question" data-toggle="tooltip" data-placement="top" data-original-title="{l s='Allowed characters [0-9a-zA-Z], Coupon code length should be 5 to 8 characters.' mod='kbmpdealmanager'}"></i>
                                        {l s='Coupon Code' mod='kbmpdealmanager'}
                                    </span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="kb-labeled-inpfield">
                                        <span class="inplbl" style="cursor:pointer;" onclick="generateCouponCode(8, 'mydeals')"><i class="icon-random">{l s='Generate' mod='kbmpdealmanager'}</i></span>
                                        <input id="coupon_code" type="text" class="kb-inpfield required" name="code" value="{$deal->code|escape:'htmlall':'UTF-8'}" />
                                    </div>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Discount Type' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select id="reduction_type" name="reduction_type" class="kb-inpselect required">
                                        {foreach DealTool::getReductionTypes() as $key => $val}
                                            <option value="{$key|intval}" {if $key eq $deal->reduction_type}selected="selected"{/if}>{$reduction_types[$key]}{*{$val|escape:'htmlall':'UTF-8'}*}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Discount' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" validate="isPrice" name="reduction" value="{$deal->reduction|escape:'htmlall':'UTF-8'}" maxlength="14" />
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kb-panel outer-border">
                    <div class="kb-panel-header">
                        <h1>Rules</h1>
                        <div class="clearfix"></div>
                    </div>
                    <div class="kb-panel-body" style="overflow-x:auto;">
                        <table class="kb-table-list">
                            <thead>
                                <tr class="heading-row">
                                    <th>{l s='Type' mod='kbmpdealmanager'}</th>
                                    <th>{l s='Value' mod='kbmpdealmanager'}</th>
                                    <th width="80">{l s='Action' mod='kbmpdealmanager'}</th>
                                </tr>
                            </thead>
                            <tbody id="seller_deal_rules">
                                {if count($deal_rule_categories) > 0}
                                    {foreach $categories as $cat}
                                        {if in_array($cat['id_category'], $deal_rule_categories)}
                                            <tr>
                                                <td>{l s='Category' mod='kbmpdealmanager'}</td>
                                                <td><input type="hidden" name="deal_rule_categories[]" value="{$cat['id_category']|intval}" />{$cat['name']|escape:'htmlall':'UTF-8'}</td>
                                                <td><a href="javascript:void(0)" onclick="deleteSellerDealRule(this)" title="{l s='Click to delete rule' mod='kbmpdealmanager'}">{l s='Delete' mod='kbmpdealmanager'}</a></td>
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
                                                <td><a href="javascript:void(0)" onclick="deleteSellerDealRule(this)" title="{l s='Click to delete rule' mod='kbmpdealmanager'}">{l s='Delete' mod='kbmpdealmanager'}</a></td>
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {/if}
                            </tbody>
                        </table>
                        <div class="kb-panel-body">
                            <ul class="kb-form-list">
                                <li class="kb-form-l">
                                    <div class="kb-form-label-block">
                                        <span class="kblabel ">{l s='Select Category' mod='kbmpdealmanager'}</span>
                                    </div>
                                    <div class="kb-form-field-block">
                                        <select id="deal_rule_category" name="deal_rule_category" class="kb-inpselect">
                                            {foreach $categories as $cat}
                                                <option value="{$cat['id_category']|intval}" {if ($assigned_cat_exist && !in_array($cat['id_category'], $assigned_categories))}disabled="disabled"{/if}>{$cat['name']|escape:'htmlall':'UTF-8'}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                    <div class="kb-form-field-block" style="margin-top:5px;">
                                        <a href="javascript:void(0)" onclick="addCategoryRule()" class="kbbtn btn-info" title="{l s='click to add new rule' mod='kbmpdealmanager'}"><i class="icon-plus"><span>{l s='Add Rule' mod='kbmpdealmanager'}</span></i></a>
                                    </div>
                                {*</li>
                                *    <li class="kb-form-r">
                                *        <div class="kb-form-label-block">
                                *            <span class="kblabel ">{l s='Select Manufacturer' mod='kbmpdealmanager'}</span>
                                *        </div>
                                *        <div class="kb-form-field-block">
                                *            <select id="deal_rule_manufacturer" name="deal_rule_manufacturer" class="kb-inpselect">
                                *                {foreach $manufacturers as $manu}
                                *                    <option value="{$manu['id_manufacturer']|intval}" >{$manu['name']|escape:'htmlall':'UTF-8'}</option>
                                *                {/foreach}
                                *            </select>
                                *        </div>
                                *        <div class="kb-form-field-block" style="margin-top:5px;">
                                *            <a href="javascript:void(0)" onclick="addManufacturerRule()" class="kbbtn btn-info" title="{l s='click to add new rule' mod='kbmpdealmanager'}"><i class="icon-plus"><span>{l s='Add Rule' mod='kbmpdealmanager'}</span></i></a>
                                *        </div>
                                *}    </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class='kb-vspacer5'></div>
            <input id="kbmp_submission_type" type="hidden" name="submitType" value="save" />
            <button type="button" class='kbbtn-big kbbtn-default' onclick="validateDealForm('savenstay')">{l s='Save and Stay' mod='kbmpdealmanager'}</button>
            <button type="button" class='kbbtn-big kbbtn-success' onclick="validateDealForm('save')">{l s='Save' mod='kbmpdealmanager'}</button>
        </form>
        <script>
        var kbmp_reductiontype_percent = "{DealTool::REDUCTION_TYPE_PERCENTAGE|intval}";
        var kbmp_dealtype_cart = "{DealTool::DEAL_TYPE_CART|intval}";
        var kb_dealrule_label_delete = "{l s='Delete'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}";
        var kb_dealrule_label_category = "{l s='Category'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}";
        var kb_dealrule_label_manufacturer = "{l s='Manufacturer'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}";
        var kb_invalid_deal_date_msg = "{l s='End date should be greater the start date'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}";
        var kb_invalid_discount_range = "{l s='Discount should be between 1-100'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}";
        var kb_dealrule_required_rule = "{l s='Atleast one rule is required.'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}";
        var kb_dealrule_unassign_cat_rule_err = "{l s='This category is not assigned to you.'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}";
            var kb_img_format = [];

            {foreach $kb_img_frmats as $for}
                kb_img_format.push('{$for|escape:'htmlall':'UTF-8'}');
            {/foreach}
            
            $(document).ready(function(){
            
                {*if ($(".datetimepicker").length > 0) {
                    $('.datetimepicker').datetimepicker({
                        prevText: '',
                        nextText: '',
                        dateFormat: 'yy-mm-dd',
                        // Define a custom regional settings in order to use PrestaShop translation tools
                        currentText: '{l s='Now' mod='kbmpdealmanager'}',
                        closeText: '{l s='Done' mod='kbmpdealmanager'}',
                        ampm: false,
                        amNames: ['AM', 'A'],
                        pmNames: ['PM', 'P'],
                        timeFormat: 'hh:mm:ss tt',
                        timeSuffix: '',
                        timeOnlyTitle: '{l s='Choose Time' mod='kbmpdealmanager'}',
                        timeText: '{l s='Time' mod='kbmpdealmanager'}',
                        hourText: '{l s='Hour' mod='kbmpdealmanager'}',
                        minuteText: '{l s='Minute' mod='kbmpdealmanager'}',
                    });    
                }*}
            
            });
                
        </script>
    {/if}
</div>
{else}
    <div class="alert alert-warning">{l s='You can not add new deals as your store owner has disabled this option from the backend.' mod='kbmpdealmanager'}</div>
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
