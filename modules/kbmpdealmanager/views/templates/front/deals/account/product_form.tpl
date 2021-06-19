<script>
    var kb_current_request_per_product = "{$kb_current_request_per_product|escape:'quotes':'UTF-8'}";
    var kb_invalid_deal_date_msg = "{l s='End date should be greater the start date'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}";
    var kb_invalid_discount_range = "{l s='Discount should be between 1-100'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}";
    var kb_dealrule_label_delete = "{l s='Delete'|escape:'htmlall':'UTF-8' mod='kbmpdealmanager'}";
    var kb_dealrule_required_rule = "{l s='Atleast one product is required.' mod='kbmpdealmanager'}";
    var kb_dealrule_select_product = "{l s='Enter atlease one product' mod='kbmpdealmanager'}";
    var kb_ajax_request_fail_err = "{l s='Technical error please contact support' mod='kbmpdealmanager'}";
    var path_fold = "{$path_fold|escape:'quotes':'UTF-8'}";
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
{if $Enable == 1}
<div class="kb-content">
    {if !isset($permission_error)}
        <div class="kb-content-header">
            <h1>{$form_heading|escape:'htmlall':'UTF-8'}</h1>
            {if $deal->id > 0}
            <div class="kb-content-header-btn">
                <a href="javascript:void(0)" onclick="actionDeleteConfirmation(this)" data-href="{$link->getModuleLink('kbmpdealmanager', 'productdeals', ['render' => 'delete', 'id_seller_deal' => $deal->id], (bool)Configuration::get('PS_SSL_ENABLED'))|escape:'htmlall':'UTF-8'}" class="kbbtn btn-danger" title="{l s='click to delete deal' mod='kbmpdealmanager'}"><i class="icon-trash"><span>{l s='Delete' mod='kbmpdealmanager'}</span></i></a>
            </div>
            {/if}
            <div class="clearfix"></div>
        </div>
        <form id="kb-seller-per-product-deal-form" action="{$deal_submit_url|escape:'htmlall':'UTF-8'}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="submitSellerDealPerProduct" value="1" />
            <input type="hidden" id="id_seller_deal" name="id_seller_deal" value="{$deal->id|intval}" />
            <div class="kbalert kbalert-danger" style="display:none;"></div>
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
                                    <input type="text" class="kb-inpfield required" validate="isGenericName" name="title" value="{if !empty($deal->title)}{if isset($deal->title[$lang_id])} {$deal->title[$lang_id]|escape:'htmlall':'UTF-8'}{else}''{/if}{/if}" />
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
                                        <input  type="hidden" id="seller_deal_banner_update" name="seller_deal_banner_update" value="0" />
                                    </div>
                                    <p class="form-inp-help">{l s='Provide your banner in landscape size to visible properly on website.' mod='kbmpdealmanager'}</p>
                                    <div  class="kb-validation-error"></div>
                                </div>
                            </li>
                            <li class="kb-form">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Limit To Customer' mod='kbmpdealmanager'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="kb-labeled-inpfield">
                                        <span class="inplbl"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        <input id='kb_mp_limit_customer'  type="text" class="kb-inpfield" name="limit_customer" {if $customer_name != ''}readonly="readonly"{/if} value="{$customer_name|escape:'htmlall':'UTF-8'}" />
                                    </div>
                                    <a href="javascript:void(0)" style="margin-top:1%" onclick="freeField(1)" class="kbbtn btn-danger" title="{l s='click to clear the limit customer field' mod='kbmpdealmanager'}" ><i class="icon-trash"><span>{l s='Clear' mod='kbmpdealmanager'}</span></i></a>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Start Date' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="kb-labeled-inpfield">
                                        <span class="inplbl"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        <input id='seller_per_product_deal_from_date'  type="text" class="kb-inpfield datetimepicker required" name="from_date" validate="isDateTime" value="{if !empty($deal->from_date)}{date('Y-m-d H:i:s', strtotime($deal->from_date))|escape:'htmlall':'UTF-8'}{/if}" />
                                    </div>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='End Date' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="kb-labeled-inpfield">
                                        <span class="inplbl"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        <input id='seller_per_product_deal_end_date'  type="text" class="kb-inpfield datetimepicker required" name="end_date" validate="isDateTime" value="{if !empty($deal->end_date)}{date('Y-m-d H:i:s', strtotime($deal->end_date))|escape:'htmlall':'UTF-8'}{/if}" />
                                    </div>
                                </div>
                            </li>
                            <li class="kb-form-l">
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
                            <li class="kb-form-r deal_cart_rule">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">
                                        <i class="icon-question" data-toggle="tooltip" data-placement="top" data-original-title="{l s='Allowed characters [0-9a-zA-Z], Coupon code length should be 5 to 8 characters.' mod='kbmpdealmanager'}"></i>
                                        {l s='Coupon Code' mod='kbmpdealmanager'}
                                    </span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="kb-labeled-inpfield">
                                        <span class="inplbl" style="cursor:pointer;" onclick="generateCouponCode(8, 'productdeals')"><i class="icon-random">{l s='Generate' mod='kbmpdealmanager'}</i></span>
                                        <input id='coupon_code_per_product' type="text" readonly="readonly" class="kb-inpfield required"  name="code" value="{$deal->code|escape:'htmlall':'UTF-8'}" />
                                    </div>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Discount Type' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select id="reduction_type"  name="reduction_type" class="kb-inpselect required">
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
                                    <input type="text" id="reduction_value" class="kb-inpfield required" validate="isPrice" name="reduction" value="{$deal->reduction|escape:'htmlall':'UTF-8'}" maxlength="14" />
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Quantity' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                        <input type="text" id="coupon_quantity" class="kb-inpfield required" validate="isPrice" name="quantity" value="{$coupon_quantity|escape:'htmlall':'UTF-8'}" maxlength="14" />
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Quantity Per User' mod='kbmpdealmanager'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                        <input type="text" id="coupon_quantity_per_user" class="kb-inpfield required" validate="isPrice" name="quantity_per_user" value="{$coupon_quantity_per_user|escape:'htmlall':'UTF-8'}" maxlength="14" />
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kb-panel outer-border">
                    <div class="kb-panel-header">
                        <h1>{l s='Products Listing To Which This Rule Will Apply' mod='kbmpdealmanager'} </h1>
                        <div class="clearfix"></div>
                    </div>
                    <div class="kb-panel-body" style="overflow-x:auto;">
                        <table class="kb-table-list">
                            <thead>
                                <tr class="heading-row">
                                    <th>{l s='Product ID' mod='kbmpdealmanager'}</th>
                                    <th>{l s='Product Name' mod='kbmpdealmanager'}</th>
                                    <th width="80">{l s='Action' mod='kbmpdealmanager'}</th>
                                </tr>
                            </thead>
                            <tbody id="seller_per_product_deal_rules">
                              {if count($product_rules) > 0}
                                    {foreach $product_rules as $rule}
                                            <tr>
                                                <td class="kb_mp_seller_product_id">{$rule['id_product']|escape:'htmlall':'UTF-8'}</td>
                                                <td><input type="hidden" name="product_rule[]" value="{$rule['id_product']|escape:'htmlall':'UTF-8'}" />{$rule['product_name']|escape:'htmlall':'UTF-8'}</td>
                                                <td><a href="javascript:void(0)" onclick="deleteSellerDealRulePerProduct(this)" title="{l s='Click to delete rule' mod='kbmpdealmanager'}">{l s='Delete' mod='kbmpdealmanager'}</a></td>
                                            </tr>
                                    {/foreach}
                                {/if}
                            </tbody>
                        </table>
                        <div class="kb-panel-body">
                            <ul class="kb-form-list">
                                <li class="kb-form">
                                    <div class="kb-form-label-block">
                                        <span class="kblabel ">{l s='Select Product' mod='kbmpdealmanager'}</span>
                                    </div>
                                    <div class="kb-form-field-block">
                                        <input id='kb_mp_product_name' type="text" class="kb-inpfield ac_input" validate="isGenericName" name="kb_mp_product_name" value="" />
                                        <input id='kb_mp_product_id' type="hidden" name="kb_mp_product_id" value="" />
                                    </div>
                                    <div class="kb-form-field-block" style="margin-top:5px;">
                                        <a href="javascript:void(0)" onclick='addProduct()'  class="kbbtn btn-info" title="{l s='click to add new rule' mod='kbmpdealmanager'}"><i class="icon-plus"><span>{l s='Add Product' mod='kbmpdealmanager'}</span></i></a>
                                        <a href="javascript:void(0)" onclick="freeField(2)" class="kbbtn btn-danger" title="{l s='click to clear the select product field' mod='kbmpdealmanager'}" ><i class="icon-trash"><span>{l s='Clear' mod='kbmpdealmanager'}</span></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class='kb-vspacer5'></div>
            <input id="kbmp_submission_type_per_product" type="hidden" name="submitType" value="save" />
            <button type="button" class='kbbtn-big kbbtn-default' onclick="validateDealFormPerProduct('savenstay')">{l s='Save and Stay' mod='kbmpdealmanager'}</button>
            <button type="button" class='kbbtn-big kbbtn-success' onclick="validateDealFormPerProduct('save')">{l s='Save' mod='kbmpdealmanager'}</button>
        </form>
        <script>
        var kbmp_reductiontype_percent = "{DealTool::REDUCTION_TYPE_PERCENTAGE|intval}";
        var kbmp_dealtype_cart = "{DealTool::DEAL_TYPE_CART|intval}";
            var kb_img_format = [];

            {foreach $kb_img_frmats as $for}
                kb_img_format.push('{$for|escape:'htmlall':'UTF-8'}');
            {/foreach}
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
