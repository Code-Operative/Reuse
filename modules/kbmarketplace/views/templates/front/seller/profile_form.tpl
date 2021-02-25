<script type="text/javascript" src='{$tiny_mce_js_file}' ></script>{*Variable contains css and html content, escape not required*}
<div id="sellerprofile-panel" class="kb-content">
    <div id="kb-seller-form-msg"></div>
    <div class="kbalert kbalert-info">
        <i class="kb-material-icons">info_outline</i>{l s='Fields marked with (*) are mandatory fields.' mod='kbmarketplace'}
    </div>
{*    {debug}*}
    {*//changes by vishal*}
    <div class="kbbtn-group kb-tright">
    <select id='kb_lang_slector_profile' class="btn-sm btn-info" style='margin-top: -5%;'>
                {foreach $languages as $language}  
                    <option {if $default_lang == $language['id_lang']} selected {/if} value='{$language['id_lang']}'>{$language['name']}</option>
                {/foreach}
            </select>
            {*//changes end*}
    </div>
        <ul class="kb-tabs">
                <li class="active" rel="general" id="kb-sprofile-general">{l s='General' mod='kbmarketplace'}</li>
                <li rel="metadata" id="kb-sprofile-metadata">{l s='Meta Information' mod='kbmarketplace'}</li>
                <li rel="policydata" id="kb-sprofile-policydata">{l s='Policy' mod='kbmarketplace'}</li>
                <li rel="paymentinfo" id="kb-sprofile-paymentinfo">{l s='Payout' mod='kbmarketplace'}</li>                
        </ul>
        <div class="clearfix"></div>
        <div class="kb_tab_container">
            <form action="{$kb_current_request|escape:'htmlall':'UTF-8'}" id="sellerProfileForm" method="post" class="" enctype="multipart/form-data">
                <input type="hidden" name="updateSellerProfile" value="{$seller_form_key|escape:'htmlall':'UTF-8'}" />
                <input type="hidden" name="kb_id_seller" value="{$kb_id_seller|intval}" />
                <div id="general" class="kb_tab_content">
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Shop Title' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    {*changes by vishal*}
                                    {foreach $languages as $language}
                                    <input data-tab="general" {if $default_lang == $language['id_lang']}style="display:block;"{else}style="display:none;"{/if}type="text" class="kb-inpfield {if $default_lang == $language['id_lang']}required{/if}" validate="isGenericName" name="seller_title_{$language['id_lang']|intval}" value="{$seller_title_{$language['id_lang']|intval}|escape:'htmlall':'UTF-8'}" onkeyup="updateSellerLinkRewrite(this, {$language['id_lang']|intval})"/>
                                    {/foreach}
                                    {*changes end*}
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Phone Number' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input data-tab="general" type="text" class="kb-inpfield required" validate="isPhoneNumber" name="seller_phone_number" value="{$seller.phone_number|escape:'htmlall':'UTF-8'}" maxlength="15" />
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Business Email' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input data-tab="general" type="text"  id="kb_business_email" class="kb-inpfield" validate="isEmail" name="seller_business_email" value="{$seller.business_email|escape:'htmlall':'UTF-8'}" />
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Get Notification' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select data-tab="general" name="seller_notification_type" id="kb_seller_notification_type" class="kb-inpselect">
                                        <option value="0" {if $seller.notification_type eq 0}selected="selected"{/if}>{l s='On Both' mod='kbmarketplace'}</option>
                                        <option value="1" {if $seller.notification_type eq 1}selected="selected"{/if}>{l s='Primary Email' mod='kbmarketplace'}</option>
                                        <option value="2" {if $seller.notification_type eq 2}selected="selected"{/if}>{l s='Business Email' mod='kbmarketplace'}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Address' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <textarea data-tab="general" name="seller_address" rows="5" class="kb-inptexarea required"  validate="isAddress" >{$seller.address}</textarea>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Country' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select data-tab="general" name="seller_country" class="kb-inpselect required" validate="isInt">
                                        <option value="">{l s='Select Country' mod='kbmarketplace'}</option>
                                        {foreach $countries as $key => $val}
                                            <option value="{$key|intval}" {if $key eq $seller_country} selected="selected"{/if} >{$val|escape:'htmlall':'UTF-8'}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='State/City' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input id="seller_state" data-tab="general" type="text" class="kb-inpfield required" validate="isGenericName" name="seller_state" value="{$seller.state|escape:'htmlall':'UTF-8'}" />
                                </div>
                            </li>
                            {assign var=indexRow value=0}
                            {foreach $kb_available_field as $kbfield}
                                {if ($kbfield['type'] == 'text') && ($kbfield['id_section'] == 1)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <input data-tab="general" type="{if $kbfield['validation'] == 'isEmail'}email{else}text{/if}" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if}
                                                   name='{$kbfield['field_name']}' id="{$kbfield['html_id']}" value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}"
                                                   class="kb-inpfield {$kbfield['html_class']} {if $kbfield['required']}required{/if}" {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if}/>
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>  
                                {/if}
                                {if ($kbfield['type'] == 'select') && ($kbfield['id_section'] == 1)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <select data-tab="general" name='{$kbfield['field_name']}{if $kbfield['multiselect']}[]{/if}' id='{$kbfield['html_id']}' 
                                                    class="kb-inpselect {$kbfield['html_class']} {if $kbfield['required']}required{/if} {if $kbfield['multiselect']} multiselect {/if}" {if $kbfield['multiselect']} multiple="multiple"{/if} >
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                        <option value="{$field_value['option_value']}"
                                                                {if isset($kbfield['customer_value'])}
                                                        {if is_array($kbfield['customer_value']|json_decode:1)}
                                                            {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                selected
                                                            {/if}
                                                        {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                            selected
                                                        {/if}
                                                    {elseif isset($kbfield['default_value'])}
                                                                    {if $kbfield['default_value'] != ""}
                                                                        {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                            {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                selected
                                                                            {/if}
                                                                        {/if}
                                                                    {/if}
                                                                {/if}
                                                                >{$field_value['option_label']}
                                                        </option>
                                                    {/foreach}
                                                {/if}
                                            </select>
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'radio') && ($kbfield['id_section'] == 1)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                            <input data-tab="general" type="radio" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="{$kbfield['html_class']} {if $kbfield['required']}required{/if}" value="{$field_value['option_value']}" 
                                                            {if isset($kbfield['customer_value'])}
                                                               {if is_array($kbfield['customer_value']|json_decode:1)}
                                                                   {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                       checked
                                                                   {/if}
                                                               {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                                   checked
                                                               {/if}
                                                           {elseif isset($kbfield['default_value'])}
                                                                       {if $kbfield['default_value'] != ""}
                                                                           {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                               {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                   checked
                                                                               {/if}
                                                                           {/if}
                                                                       {/if}
                                                                   {/if}  />
                                                            {$field_value['option_label']}
                                                        {/foreach}
                                                    {/if}
                                                    {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                            </div>
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'checkbox') && ($kbfield['id_section'] == 1)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                            <input data-tab="general" type="checkbox" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="{$kbfield['html_class']} {if $kbfield['required']}required{/if}" value="{$field_value['option_value']}" 
                                                                 {if isset($kbfield['customer_value'])}
                                                           {if is_array($kbfield['customer_value']|json_decode:1)}
                                                               {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                   checked
                                                               {/if}
                                                           {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                               checked
                                                           {/if}
                                                       {elseif isset($kbfield['default_value'])}
                                                                       {if $kbfield['default_value'] != ""}
                                                                           {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                               {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                   checked="checked"
                                                                               {/if}
                                                                           {/if}
                                                                       {/if}
                                                                   {/if}  />
                                                            <label for="{$kbfield['field_name']}">{$field_value['option_label']}</label>
                                                            
                                                        {/foreach}
                                                    {/if}
                                                    {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                            </div>
                                        </div>
                                    </li>
                                {/if}    
                                {if ($kbfield['type'] == 'textarea') && ($kbfield['id_section'] == 1)}
                                    {assign var=indexRow value=0}
                                    <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                        <textarea  data-tab="general" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                                            name='{$kbfield['field_name']}' id='{$kbfield['html_id']}' rows="5" class="kb-inptexarea {$kbfield['html_class']} 
                                            {if $kbfield['required']}required{/if}{if $kbfield['show_text_editor']} autoload_rte{/if}"
                                            {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if}
                                            {if ($kbfield['max_length'] != '') && ($kbfield['max_length'] > 0)} maxlength="{$kbfield['max_length']}"{/if} {if $kbfield['min_length'] != ''}minlength="{$kbfield['min_length']}"{/if}
                                            >{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}</textarea> {* Variable contains HTML/CSS/JSON, escape not required *}
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'date') && ($kbfield['id_section'] == 1)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kb-labeled-inpfield">
                                                <span class="inplbl"><i class="kb-material-icons">date_range</i></span>
                                                <input data-tab="general" type="text" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                                               name='{$kbfield['field_name']}' value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}" id='{$kbfield['html_id']}' class="kb-inpfield datepicker {$kbfield['html_class']} {if $kbfield['required']}required{/if}"
                                               {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if} value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}"/>
                                                
                                            </div>
                                               {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'file') && ($kbfield['id_section'] == 1)}
                                    {assign var=indexRow value=0}
                                    <li class="kb-form-fwidth">
                                        <div class="kb-form-label-block" style='margin-bottom:2%;'>
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                            {if isset($kbfield['customer_value'])}
                                                {if is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''} 
                                                    <a style="font-size: 13px;    padding: 4px;float:right;" class="btn btn-warning" href="{$kb_front_controller}?downloadFile=true&id_field={$kbfield['id_field']}&id_seller={$id_seller}" ><i class="material-icons">&#xe2c4;</i> {l s='Download File' mod='kbmarketplace'}</a>
                                                {/if}
                                            {/if}
                                        </div>
                                        {if isset($kbfield['customer_value']) && $kbfield['editable'] == 0 && is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''}
                                        {else}
                                        <div class="kb-form-field-block">
                                            
                                            {if isset($kbfield['customer_value'])}
                                                {if is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''}
                                                    <input data-tab="general" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control"/>
                                                {else}
                                                    <input data-tab="general" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control  {if $kbfield['required']}is_required{/if}"/>
                                                {/if}    
                                            {else}
                                                <input data-tab="general" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control  {if $kbfield['required']}is_required{/if}"/>
                                            {/if}
                                               {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                               
                                               {if $kbfield['file_extension'] != ''} 
                                                   <div class="kbalert kbalert-warning pack-empty-warning" style="display: block; margin-top:10px;">
                                                        <i class="kb-material-icons" style="font-size:12px;margin-right:5px;">&#xe250;</i> 
                                                        <strong>
                                                            <span class="form-info">{l s='File must be ' mod='kbmarketplace'}<span class="file_extension">{$kbfield['file_extension']}</span></span>
                                                        </strong> 

                                                    </div>
                                               {/if}
                                        </div>
                                        {/if}
                                    </li>
                                {/if}
                            {/foreach}
                            {* chnages by rishabh jain *}
                            {if isset($is_return_address_enable) && $is_return_address_enable == 1}
                                <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                        <span class="kblabel">{l s='Return Address' mod='kbmarketplace'}</span><em>*</em>
                                    </div>
                                    <div class="kb-form-field-block">
                                        <textarea data-tab="general" name="return_address" rows="5" class="kb-inptexarea autoload_rte required">{$seller.return_address nofilter}</textarea> {* Variable contains HTML/CSS/JSON, escape not required *}

                                    </div>
                                </li>
                            {/if}
                            {* changes over *}
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Description' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    {*changes by vishal*}
                                    {foreach $languages as $language}
                                    <textarea data-tab="general" {if $default_lang == $language['id_lang']}style="display:block;"{else}style="display:none;"{/if} name="seller_description_{$language['id_lang']|intval}" rows="5" class="kb-inptexarea autoload_rte">{$seller_description_{$language['id_lang']|intval}}</textarea>{*Variable contains css and html content, escape not required*}
                                    {/foreach}
                                    {*changes end*}
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Profile Url Alias' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                         {*changes by vishal*}
                                    {foreach $languages as $language}
                                    <input data-tab="general" {if $default_lang == $language['id_lang']}style="display:block;"{else}style="display:none;"{/if}  type="text" class="kb-inpfield" validate="isLinkRewrite" name="seller_profile_url_{$language['id_lang']|intval}" value="{$seller_friedly_url_{$language['id_lang']|intval}|escape:'htmlall':'UTF-8'}" autocomplete="off" onkeyup="$('#kb_url_{$language['id_lang']|intval}').find('#friendly-url-demo').html(str2url($(this).val()));"/>
                                     {/foreach}
                                    {*changes end*}
                                </div>
                                <div class="kbalert kbalert-warning pack-empty-warning" style="display: block; margin-top:10px;">
                                    <i class="kb-material-icons" style="font-size:12px;margin-right:5px;">&#xe250;</i> {l s='The profile link will look like this:' mod='kbmarketplace'}<br/>
                                    <strong>
                                        {*changes by vishal*}
                                    {foreach $languages as $language}
                                        <div id="kb_url_{$language['id_lang']|intval}" {if $default_lang == $language['id_lang']}style="display:block;"{else}style="display:none;"{/if}>    
                                            {$seller_profile_url_{$language['id_lang']|intval} nofilter}{* Variable contains HTML/CSS/JSON, escape not required *}
                                        </div>    
                                         {/foreach}
                                    {*changes end*}
                                    <strong> {* Variable contains HTML/CSS/JSON, escape not required *}

                                </div>
                                <script type="text/javascript">
                                    //changes by vishal
                                    
                                    function updateSellerLinkRewrite(e,id_lang) {
                                var value = $(e).val();
                                {foreach $languages as $language}
                                        if (id_lang == {$language['id_lang']|intval}) {
                                            $('input[name="seller_profile_url_{$language['id_lang']|intval}"]').val(str2url(value));
                                            $('input[name="seller_profile_url_{$language['id_lang']|intval}"]').trigger('keyup');
                                        }
                                {/foreach}
                                    }
                                    //changes end
                                </script>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Facebook Link' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input data-tab="general" type="text" class="kb-inpfield" validate="isUrl" name="seller_fb_link"  id='seller_fb_link' value="{$seller.fb_link|escape:'htmlall':'UTF-8'}" />
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Google Plus Link' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input data-tab="general" type="text" class="kb-inpfield" validate="isUrl" name="seller_gplus_link" id='seller_gplus_link' value="{$seller.gplus_link|escape:'htmlall':'UTF-8'}" />
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Twitter Link' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input data-tab="general" type="text" class="kb-inpfield" validate="isUrl" name="seller_twit_link" id='seller_twit_link' value="{$seller.twit_link|escape:'htmlall':'UTF-8'}" />
                                </div>
                            </li>
                            <li class="kb-form-fwidth" id="id_logo_wrapper">
                                <div class="form-lbl-indis">
                                    <span class="kblabel">{l s='Logo' mod='kbmarketplace'}</span>
                                    {$temp_str = {l s='Logo size should be (%s).' mod='kbmarketplace'}}
                                    <p class="form-inp-help">{$temp_str|sprintf:'150 X 150'}</p>
                                </div>
                                <div class="form-field-indis">
                                    <div class="form-img-display">
                                        <img id="seller_logo_placeholder" class="form-logo-display" src="{$seller.logo|escape:'htmlall':'UTF-8'}?{$time}" title="{l s='Logo of your shop' mod='kbmarketplace'}">
                                    </div>
                                    <input id="seller_logo" class="kb_upload_field kb_seller_logo_file" type="file" name="seller_logo" style="display:none;" />
                                    <div class="kb-block file-uploader">
                                        <a id="seller_upload_image" href="javascript:void(0)" onclick="uploadImage('seller_logo')" >{l s='Browse' mod='kbmarketplace'}</a>
                                        <a id="seller_remove_image" href="javascript:void(0)" onclick="removeSellerImage('seller_logo', '{$seller_default_logo|escape:'htmlall':'UTF-8'}')" >{l s='Remove' mod='kbmarketplace'}</a>
                                        <input id="seller_logo_update" type="hidden" name="seller_logo_update" value="0" />
                                    </div>
                                    <div id="seller_logo_error" class="kb-validation-error"></div>
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Shop Banner' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="form-img-display">
                                        <img id="seller_banner_placeholder" class="form-banner-display" src="{$seller.banner|escape:'htmlall':'UTF-8'}?{$time}" title="{l s='Banner of your shop' mod='kbmarketplace'}">
                                    </div>
                                    <input id="seller_banner" class="kb_upload_field kb_seller_banner_file" type="file" name="seller_banner" style="display:none;" />
                                    <div class="kb-block file-uploader">
                                        <a href="javascript:void(0)" onclick="uploadImage('seller_banner')" >{l s='Browse' mod='kbmarketplace'}</a>
                                        <a id="kb_banner_remove" href="javascript:void(0)" onclick="removeSellerImage('seller_banner', '{$seller_default_banner|escape:'htmlall':'UTF-8'}')" >{l s='Remove' mod='kbmarketplace'}</a>
                                        <input id="seller_banner_update" type="hidden" name="seller_banner_update" value="0" />
                                    </div>
                                    {$temp_str_banner = {l s='Banner size should be (%s).' mod='kbmarketplace'}}
                                    <p class="form-inp-help">{$temp_str_banner|sprintf:'900 X 250'}</p>
                                    <div id="seller_banner_error" class="kb-validation-error"></div>
                                </div>
                            </li>
                            {hook h="displayKbMarketPlaceSellerForm" block='general'}
                        </ul>
                    </div>
                </div>
                <div id="metadata" class="kb_tab_content">
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Meta Keywords' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                         {*changes by vishal*}
                                    {foreach $languages as $language}
                                    <input data-tab="metadata" {if $default_lang == $language['id_lang']}style="display:block;"{else}style="display:none;"{/if} type="text" class="kb-inpfield {if $default_lang == $language['id_lang']}required{/if}" validate="isGenericName" name="seller_meta_keywords_{$language['id_lang']|intval}" value="{$seller_meta_keywords_{$language['id_lang']|intval}|escape:'htmlall':'UTF-8'}" />
                                     {/foreach}
                                    {*changes end*}
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Meta Description' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                         {*changes by vishal*}
                                    {foreach $languages as $language}
                                    <textarea data-tab="metadata" {if $default_lang == $language['id_lang']}style="display:block;"{else}style="display:none;"{/if} name="seller_meta_description_{$language['id_lang']|intval}" rows="5" class="kb-inptexarea">{$seller_meta_description_{$language['id_lang']|intval}}</textarea>
                                     {/foreach}
                                    {*changes end*}
                                </div>
                            </li>
                            {assign var=indexRow value=0}
                            {foreach $kb_available_field as $kbfield}
                                {if ($kbfield['type'] == 'text') && ($kbfield['id_section'] == 2)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <input data-tab="metadata" type="{if $kbfield['validation'] == 'isEmail'}email{else}text{/if}" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if}
                                                   name='{$kbfield['field_name']}' id="{$kbfield['html_id']}" value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}"
                                                   class="kb-inpfield {$kbfield['html_class']} {if $kbfield['required']}required{/if}" {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if}/>
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>  
                                {/if}
                                {if ($kbfield['type'] == 'select') && ($kbfield['id_section'] == 2)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <select data-tab="metadata" name='{$kbfield['field_name']}{if $kbfield['multiselect']}[]{/if}' id='{$kbfield['html_id']}' 
                                                    class="kb-inpselect {$kbfield['html_class']} {if $kbfield['required']}required{/if} {if $kbfield['multiselect']} multiselect {/if}" {if $kbfield['multiselect']} multiple="multiple"{/if} >
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                        <option value="{$field_value['option_value']}"
                                                                {if isset($kbfield['customer_value'])}
                                                        {if is_array($kbfield['customer_value']|json_decode:1)}
                                                            {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                selected
                                                            {/if}
                                                        {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                            selected
                                                        {/if}
                                                    {elseif isset($kbfield['default_value'])}
                                                                    {if $kbfield['default_value'] != ""}
                                                                        {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                            {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                selected
                                                                            {/if}
                                                                        {/if}
                                                                    {/if}
                                                                {/if}
                                                                >{$field_value['option_label']}
                                                        </option>
                                                    {/foreach}
                                                {/if}
                                            </select>
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'radio') && ($kbfield['id_section'] == 2)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                            <input data-tab="metadata" type="radio" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="{$kbfield['html_class']} {if $kbfield['required']}required{/if}" value="{$field_value['option_value']}" 
                                                                 {if isset($kbfield['customer_value'])}
                                                               {if is_array($kbfield['customer_value']|json_decode:1)}
                                                                   {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                       checked
                                                                   {/if}
                                                               {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                                   checked
                                                               {/if}
                                                           {elseif isset($kbfield['default_value'])}
                                                                       {if $kbfield['default_value'] != ""}
                                                                           {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                               {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                   checked
                                                                               {/if}
                                                                           {/if}
                                                                       {/if}
                                                                   {/if}  />
                                                            {$field_value['option_label']}
                                                        {/foreach}
                                                    {/if}
                                                    {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                            </div>
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'checkbox') && ($kbfield['id_section'] == 2)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                            <input data-tab="metadata" type="checkbox" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="{$kbfield['html_class']} {if $kbfield['required']}required{/if}" value="{$field_value['option_value']}" 
                                                                 {if isset($kbfield['customer_value'])}
                                                           {if is_array($kbfield['customer_value']|json_decode:1)}
                                                               {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                   checked
                                                               {/if}
                                                           {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                               checked
                                                           {/if}
                                                       {elseif isset($kbfield['default_value'])}
                                                                       {if $kbfield['default_value'] != ""}
                                                                           {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                               {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                   checked="checked"
                                                                               {/if}
                                                                           {/if}
                                                                       {/if}
                                                                   {/if}  />
                                                            <label for="{$kbfield['field_name']}">{$field_value['option_label']}</label>
                                                            
                                                        {/foreach}
                                                    {/if}
                                                    {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                            </div>
                                        </div>
                                    </li>
                                {/if}    
                                {if ($kbfield['type'] == 'textarea') && ($kbfield['id_section'] == 2)}
                                    {assign var=indexRow value=0}
                                    <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                        <textarea  data-tab="metadata" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                                            name='{$kbfield['field_name']}' id='{$kbfield['html_id']}' rows="5" class="kb-inptexarea {$kbfield['html_class']} 
                                            {if $kbfield['required']}required{/if}{if $kbfield['show_text_editor']} autoload_rte{/if}"
                                            {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if}
                                            {if ($kbfield['max_length'] != '') && ($kbfield['max_length'] > 0)} maxlength="{$kbfield['max_length']}"{/if} {if $kbfield['min_length'] != ''}minlength="{$kbfield['min_length']}"{/if}
                                            >{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}</textarea> {* Variable contains HTML/CSS/JSON, escape not required *}
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                
                                {if ($kbfield['type'] == 'date') && ($kbfield['id_section'] == 2)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kb-labeled-inpfield">
                                                <span class="inplbl"><i class="kb-material-icons">date_range</i></span>
                                                <input data-tab="metadata" type="text" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                                               name='{$kbfield['field_name']}' id='{$kbfield['html_id']}' class="kb-inpfield datepicker {$kbfield['html_class']} {if $kbfield['required']}required{/if}"
                                               {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if} value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}"/>
                                                
                                            </div>
                                               {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'file') && ($kbfield['id_section'] == 2)}
                                    {assign var=indexRow value=0}
                                    <li class="kb-form-fwidth">
                                        <div class="kb-form-label-block" style='margin-bottom:2%;'>
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                            {if isset($kbfield['customer_value'])}
                                                {if is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''} 
                                                    <a style="font-size: 13px;    padding: 4px;float:right;" class="btn btn-warning" href="{$kb_front_controller}?downloadFile=true&id_field={$kbfield['id_field']}&id_seller={$id_seller}" ><i class="material-icons">&#xe2c4;</i> {l s='Download File' mod='kbmarketplace'}</a>
                                                {/if}
                                            {/if}
                                        </div>
                                        {if isset($kbfield['customer_value']) && $kbfield['editable'] == 0 && is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''}
                                        {else}
                                        <div class="kb-form-field-block">
                                            
                                            {if isset($kbfield['customer_value'])}
                                                {if is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''}
                                                    <input data-tab="metadata" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control"/>
                                                {else}
                                                    <input data-tab="metadata" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control  {if $kbfield['required']}is_required{/if}"/>
                                                {/if}    
                                            {else}
                                                <input data-tab="metadata" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control  {if $kbfield['required']}is_required{/if}"/>
                                            {/if}
                                               {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                               
                                               {if $kbfield['file_extension'] != ''} 
                                                   <div class="kbalert kbalert-warning pack-empty-warning" style="display: block; margin-top:10px;">
                                                        <i class="kb-material-icons" style="font-size:12px;margin-right:5px;">&#xe250;</i> 
                                                        <strong>
                                                            <span class="form-info">{l s='File must be ' mod='kbmarketplace'}<span class="file_extension">{$kbfield['file_extension']}</span></span>
                                                        </strong> 

                                                    </div>
                                               {/if}
                                        </div>
                                        {/if}
                                    </li>
                                {/if}
                            {/foreach}
                            {hook h="displayKbMarketPlaceSellerForm" block='meta'}
                        </ul>
                    </div>
                </div>
                <div id="policydata" class="kb_tab_content">
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Privacy Policy' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                         {*changes by vishal*}
                                    {foreach $languages as $language}
                                    <textarea data-tab="policydata" {if $default_lang == $language['id_lang']}style="display:block;"{else}style="display:none;"{/if} name="seller_privacy_policy_{$language['id_lang']|intval}" rows="5" class="kb-inptexarea autoload_rte {if $default_lang == $language['id_lang']}required{/if}">{$seller_privacy_policy_{$language['id_lang']|intval} nofilter}</textarea>{* Variable contains HTML/CSS/JSON, escape not required *}
                                     {/foreach}
                                    {*changes end*}
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Return Policy' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                         {*changes by vishal*}
                                    {foreach $languages as $language}
                                    <textarea data-tab="policydata" {if $default_lang == $language['id_lang']}style="display:block;"{else}style="display:none;"{/if} name="seller_return_policy_{$language['id_lang']|intval}" rows="5" class="kb-inptexarea autoload_rte {if $default_lang == $language['id_lang']}required{/if}">{$seller_return_policy_{$language['id_lang']|intval} nofilter}</textarea> {* Variable contains HTML/CSS/JSON, escape not required *}
                                     {/foreach}
                                    {*changes end*}

                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel">{l s='Shipping Policy' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                         {*changes by vishal*}
                                    {foreach $languages as $language}
                                    <textarea data-tab="policydata" {if $default_lang == $language['id_lang']}style="display:block;"{else}style="display:none;"{/if} name="seller_shipping_policy_{$language['id_lang']|intval}" rows="5" class="kb-inptexarea autoload_rte {if $default_lang == $language['id_lang']}required{/if}">{$seller_shipping_policy_{$language['id_lang']|intval} nofilter}</textarea> {* Variable contains HTML/CSS/JSON, escape not required *}
                                     {/foreach}
                                    {*changes end*}

                                </div>
                            </li>
                            {assign var=indexRow value=0}
                            {foreach $kb_available_field as $kbfield}
                                {if ($kbfield['type'] == 'text') && ($kbfield['id_section'] == 3)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <input data-tab="policydata" type="{if $kbfield['validation'] == 'isEmail'}email{else}text{/if}" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if}
                                                   name='{$kbfield['field_name']}' id="{$kbfield['html_id']}" value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}" 
                                                   class="kb-inpfield {$kbfield['html_class']} {if $kbfield['required']}required{/if}" {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if}/>
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>  
                                {/if}
                                {if ($kbfield['type'] == 'select') && ($kbfield['id_section'] == 3)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <select data-tab="policydata" name='{$kbfield['field_name']}{if $kbfield['multiselect']}[]{/if}' id='{$kbfield['html_id']}' 
                                                    class="kb-inpselect {$kbfield['html_class']} {if $kbfield['required']}required{/if} {if $kbfield['multiselect']} multiselect {/if}" {if $kbfield['multiselect']} multiple="multiple"{/if} >
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                        <option value="{$field_value['option_value']}"
                                                                {if isset($kbfield['customer_value'])}
                                                        {if is_array($kbfield['customer_value']|json_decode:1)}
                                                            {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                selected
                                                            {/if}
                                                        {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                            selected
                                                        {/if}
                                                    {elseif isset($kbfield['default_value'])}
                                                                    {if $kbfield['default_value'] != ""}
                                                                        {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                            {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                selected
                                                                            {/if}
                                                                        {/if}
                                                                    {/if}
                                                                {/if}
                                                                >{$field_value['option_label']}
                                                        </option>
                                                    {/foreach}
                                                {/if}
                                            </select>
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'radio') && ($kbfield['id_section'] == 3)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                            <input data-tab="policydata" type="radio" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="{$kbfield['html_class']} {if $kbfield['required']}required{/if}" value="{$field_value['option_value']}" 
                                                                 {if isset($kbfield['customer_value'])}
                                                               {if is_array($kbfield['customer_value']|json_decode:1)}
                                                                   {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                       checked
                                                                   {/if}
                                                               {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                                   checked
                                                               {/if}
                                                           {elseif isset($kbfield['default_value'])}
                                                                       {if $kbfield['default_value'] != ""}
                                                                           {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                               {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                   checked
                                                                               {/if}
                                                                           {/if}
                                                                       {/if}
                                                                   {/if}  />
                                                            {$field_value['option_label']}
                                                        {/foreach}
                                                    {/if}
                                                    {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                            </div>
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'checkbox') && ($kbfield['id_section'] == 3)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                            <input data-tab="policydata" type="checkbox" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="{$kbfield['html_class']} {if $kbfield['required']}required{/if}" value="{$field_value['option_value']}" 
                                                                 {if isset($kbfield['customer_value'])}
                                                           {if is_array($kbfield['customer_value']|json_decode:1)}
                                                               {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                   checked
                                                               {/if}
                                                           {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                               checked
                                                           {/if}
                                                       {elseif isset($kbfield['default_value'])}
                                                                       {if $kbfield['default_value'] != ""}
                                                                           {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                               {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                   checked="checked"
                                                                               {/if}
                                                                           {/if}
                                                                       {/if}
                                                                   {/if}  />
                                                            <label for="{$kbfield['field_name']}">{$field_value['option_label']}</label>
                                                            
                                                        {/foreach}
                                                    {/if}
                                                    {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                            </div>
                                        </div>
                                    </li>
                                {/if}    
                                {if ($kbfield['type'] == 'textarea') && ($kbfield['id_section'] == 3)}
                                    {assign var=indexRow value=0}
                                    <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                        <textarea  data-tab="policydata" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                                            name='{$kbfield['field_name']}' id='{$kbfield['html_id']}' rows="5" class="kb-inptexarea {$kbfield['html_class']} 
                                            {if $kbfield['required']}required{/if}{if $kbfield['show_text_editor']} autoload_rte{/if}"
                                            {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if}
                                            {if ($kbfield['max_length'] != '') && ($kbfield['max_length'] > 0)} maxlength="{$kbfield['max_length']}"{/if} {if $kbfield['min_length'] != ''}minlength="{$kbfield['min_length']}"{/if}
                                            >{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}</textarea> {* Variable contains HTML/CSS/JSON, escape not required *}
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'date') && ($kbfield['id_section'] == 3)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kb-labeled-inpfield">
                                                <span class="inplbl"><i class="kb-material-icons">date_range</i></span>
                                                <input data-tab="policydata" type="text" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                                               name='{$kbfield['field_name']}' id='{$kbfield['html_id']}' class="kb-inpfield datepicker {$kbfield['html_class']} {if $kbfield['required']}required{/if}"
                                               {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if} value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}"/>
                                                
                                            </div>
                                               {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'file') && ($kbfield['id_section'] == 3)}
                                    {assign var=indexRow value=0}
                                    <li class="kb-form-fwidth">
                                        <div class="kb-form-label-block" style='margin-bottom:2%;'>
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                            {if isset($kbfield['customer_value'])}
                                                {if is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''} 
                                                    <a style="font-size: 13px;    padding: 4px;float:right;" class="btn btn-warning" href="{$kb_front_controller}?downloadFile=true&id_field={$kbfield['id_field']}&id_seller={$id_seller}" ><i class="material-icons">&#xe2c4;</i> {l s='Download File' mod='kbmarketplace'}</a>
                                                {/if}
                                            {/if}
                                        </div>
                                        {if isset($kbfield['customer_value']) && $kbfield['editable'] == 0 && is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''}
                                        {else}
                                        <div class="kb-form-field-block">
                                            
                                            {if isset($kbfield['customer_value'])}
                                                {if is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''}
                                                    <input data-tab="policydata" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control"/>
                                                {else}
                                                    <input data-tab="policydata" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control  {if $kbfield['required']}is_required{/if}"/>
                                                {/if}    
                                            {else}
                                                <input data-tab="policydata" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control  {if $kbfield['required']}is_required{/if}"/>
                                            {/if}
                                               {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                               
                                               {if $kbfield['file_extension'] != ''} 
                                                   <div class="kbalert kbalert-warning pack-empty-warning" style="display: block; margin-top:10px;">
                                                        <i class="kb-material-icons" style="font-size:12px;margin-right:5px;">&#xe250;</i> 
                                                        <strong>
                                                            <span class="form-info">{l s='File must be ' mod='kbmarketplace'}<span class="file_extension">{$kbfield['file_extension']}</span></span>
                                                        </strong> 

                                                    </div>
                                               {/if}
                                        </div>
                                        {/if}
                                    </li>
                                {/if}
                            {/foreach}
                            {hook h="displayKbMarketPlaceSellerForm" block='policy'}
                        </ul>
                    </div>
                </div>
                <div id="paymentinfo" class="kb_tab_content">
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            {if count($available_payment_file) > 0}
                                <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                        <span class="kblabel">{l s='Select Payment Method' mod='kbmarketplace'}</span><em>*</em>
                                    </div>
                                    <div class="kb-form-field-block">
                                        <select name="seller_payment_option" class="kb-inpselect required" id="kb-payment-select">
                                            <option value="">{l s='Select Method' mod='kbmarketplace'}...</option>
                                            {foreach $available_payment_file as $payment_name => $display_name}
                                                <option value="{$payment_name|escape:'htmlall':'UTF-8'}" {if isset($payment_info['name']) && $payment_info['name'] == $payment_name}selected="selected"{/if}>{$display_name|escape:'htmlall':'UTF-8'}</option>
                                            {/foreach}
                                        </select>
                                        
                                            <p class="form-inp-help" id="paymentinfo-notice"><span id="paymentinfo-note">{l s='Note' mod='kbmarketplace'}:</span>
                                                {l s='Admin will use the Payout information to make the payment.' mod='kbmarketplace'}
                                                {l s='Only one payment information can be saved at a time.' mod='kbmarketplace'}</p>
                                    </div>
                                </li>
                            {/if}
                            {hook h="displayKbMarketPlaceSellerForm" block='payment'}
                        </ul>
                        <div id="payment-data">
                            
                        </div>
                        <ul class="kb-form-list">
                            {assign var=indexRow value=0}
                            {foreach $kb_available_field as $kbfield}
                                {if ($kbfield['type'] == 'text') && ($kbfield['id_section'] == 4)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <input data-tab="paymentinfo" type="{if $kbfield['validation'] == 'isEmail'}email{else}text{/if}" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if}
                                                   name='{$kbfield['field_name']}' id="{$kbfield['html_id']}" value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}"
                                                   class="kb-inpfield {$kbfield['html_class']} {if $kbfield['required']}required{/if}" {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if}/>
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>  
                                {/if}
                                {if ($kbfield['type'] == 'select') && ($kbfield['id_section'] == 4)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <select data-tab="paymentinfo" name='{$kbfield['field_name']}{if $kbfield['multiselect']}[]{/if}' id='{$kbfield['html_id']}' 
                                                    class="kb-inpselect {$kbfield['html_class']} {if $kbfield['required']}required{/if} {if $kbfield['multiselect']} multiselect {/if}" {if $kbfield['multiselect']} multiple="multiple"{/if} >
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                        <option value="{$field_value['option_value']}"
                                                                {if isset($kbfield['customer_value'])}
                                                        {if is_array($kbfield['customer_value']|json_decode:1)}
                                                            {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                selected
                                                            {/if}
                                                        {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                            selected
                                                        {/if}
                                                    {elseif isset($kbfield['default_value'])}
                                                                    {if $kbfield['default_value'] != ""}
                                                                        {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                            {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                selected
                                                                            {/if}
                                                                        {/if}
                                                                    {/if}
                                                                {/if}
                                                                >{$field_value['option_label']}
                                                        </option>
                                                    {/foreach}
                                                {/if}
                                            </select>
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'radio') && ($kbfield['id_section'] == 4)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                            <input data-tab="paymentinfo" type="radio" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="{$kbfield['html_class']} {if $kbfield['required']}required{/if}" value="{$field_value['option_value']}" 
                                                                 {if isset($kbfield['customer_value'])}
                                                                        {if is_array($kbfield['customer_value']|json_decode:1)}
                                                                            {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                                checked
                                                                            {/if}
                                                                        {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                                            checked
                                                                        {/if}
                                                                    {elseif isset($kbfield['default_value'])}
                                                                       {if $kbfield['default_value'] != ""}
                                                                           {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                               {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                   checked
                                                                               {/if}
                                                                           {/if}
                                                                       {/if}
                                                                   {/if}  />
                                                            {$field_value['option_label']}
                                                        {/foreach}
                                                    {/if}
                                                    {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                            </div>
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'checkbox') && ($kbfield['id_section'] == 4)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                {if $kbfield['value'] != ''}
                                                    {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                            <input data-tab="paymentinfo" type="checkbox" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="{$kbfield['html_class']} {if $kbfield['required']}required{/if}" value="{$field_value['option_value']}" 
                                                                 {if isset($kbfield['customer_value'])}
                                                           {if is_array($kbfield['customer_value']|json_decode:1)}
                                                               {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                                   checked
                                                               {/if}
                                                           {else if $kbfield['customer_value']|json_decode:1 == $field_value['option_value']}
                                                               checked
                                                           {/if}
                                                       {elseif isset($kbfield['default_value'])}
                                                                       {if $kbfield['default_value'] != ""}
                                                                           {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                                               {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                                                   checked="checked"
                                                                               {/if}
                                                                           {/if}
                                                                       {/if}
                                                                   {/if}  />
                                                            <label for="{$kbfield['field_name']}">{$field_value['option_label']}</label>
                                                            
                                                        {/foreach}
                                                    {/if}
                                                    {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                            </div>
                                        </div>
                                    </li>
                                {/if}    
                                {if ($kbfield['type'] == 'textarea') && ($kbfield['id_section'] == 4)}
                                    {assign var=indexRow value=0}
                                    <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                        <textarea  data-tab="paymentinfo" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                                            name='{$kbfield['field_name']}' id='{$kbfield['html_id']}' rows="5" class="kb-inptexarea {$kbfield['html_class']} 
                                            {if $kbfield['required']}required{/if}{if $kbfield['show_text_editor']} autoload_rte{/if}"
                                            {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if}
                                            {if ($kbfield['max_length'] != '') && ($kbfield['max_length'] > 0)} maxlength="{$kbfield['max_length']}"{/if} {if $kbfield['min_length'] != ''}minlength="{$kbfield['min_length']}"{/if}
                                            >{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}</textarea> {* Variable contains HTML/CSS/JSON, escape not required *}
                                            {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'date') && ($kbfield['id_section'] == 4)}
                                    {assign var=indexRow value=$indexRow+1}
                                    <li {if $indexRow %2 == 0}class="kb-form-l"{else}class="kb-form-r"{/if}>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kb-labeled-inpfield">
                                                <span class="inplbl"><i class="kb-material-icons">date_range</i></span>
                                                <input data-tab="paymentinfo" type="text" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                                               name='{$kbfield['field_name']}' id='{$kbfield['html_id']}' class="kb-inpfield datepicker {$kbfield['html_class']} {if $kbfield['required']}required{/if}"
                                               {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if} value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}"/>
                                                
                                            </div>
                                               {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                        </div>
                                    </li>
                                {/if}
                                {if ($kbfield['type'] == 'file') && ($kbfield['id_section'] == 4)}
                                    {assign var=indexRow value=0}
                                    <li class="kb-form-fwidth">
                                        <div class="kb-form-label-block" style='margin-bottom:2%;'>
                                            <span class="kblabel ">
                                                {if $kbfield['description'] != ''}
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{$kbfield['description']}">info_outline</i>
                                                {/if}
                                                {$kbfield['label']}
                                            </span>
                                            {if $kbfield['required']}
                                            <em>*</em>
                                            {/if}
                                            {if isset($kbfield['customer_value'])}
                                                {if is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''} 
                                                    <a style="font-size: 13px;    padding: 4px;float:right;" class="btn btn-warning" href="{$kb_front_controller}?downloadFile=true&id_field={$kbfield['id_field']}&id_seller={$id_seller}" ><i class="material-icons">&#xe2c4;</i> {l s='Download File' mod='kbmarketplace'}</a>
                                                {/if}
                                            {/if}
                                        </div>
                                        {if isset($kbfield['customer_value']) && $kbfield['editable'] == 0 && is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''}
                                        {else}
                                        <div class="kb-form-field-block">
                                            
                                            {if isset($kbfield['customer_value'])}
                                                {if is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''}
                                                    <input data-tab="paymentinfo" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control"/>
                                                {else}
                                                    <input data-tab="paymentinfo" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control  {if $kbfield['required']}is_required{/if}"/>
                                                {/if}    
                                            {else}
                                                <input data-tab="paymentinfo" type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control  {if $kbfield['required']}is_required{/if}"/>
                                            {/if}
                                               {if $kbfield['error_msg'] != ''}<div class="kbcustomfield error_message" style="display:none;">{$kbfield['error_msg']}</div>{/if}
                                               
                                               {if $kbfield['file_extension'] != ''} 
                                                   <div class="kbalert kbalert-warning pack-empty-warning" style="display: block; margin-top:10px;">
                                                        <i class="kb-material-icons" style="font-size:12px;margin-right:5px;">&#xe250;</i> 
                                                        <strong>
                                                            <span class="form-info">{l s='File must be ' mod='kbmarketplace'}<span class="file_extension">{$kbfield['file_extension']}</span></span>
                                                        </strong> 

                                                    </div>
                                               {/if}
                                        </div>
                                        {/if}
                                    </li>
                                {/if}
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </form>
            <div class="kb-block" style="padding:5px 15px 5px 5px; text-align: right;">
                <div id="sellerprofile-updating-progress" class="input-loader" style="display:none;vertical-align: middle;"></div>
                <button id="sellerprofile-update-btn" type="button" class="kbbtn-big kbbtn-success" onclick="validateSellerForm()">{l s='Save' mod='kbmarketplace'}</button>
            </div>
        </div>    
</div>
<script>
    var kb_img_format = [];

    {foreach $kb_img_frmats as $for}
        kb_img_format.push("{$for|escape:'htmlall':'UTF-8'}");
    {/foreach}

	var kb_editor_lang = "{$editor_lang}";
	var kb_default_lang = "{$default_lang}";
        
    var kb_seller_form_error = "{$kb_validation_error}";
    var kb_img_size_error = "{$kb_img_size_error}";
    var kb_img_type_error = "{$kb_img_type_error}";
     var maximum = "{l s='Maximum' mod='kbmarketplace'}";
     var maximum_textarea_limit = "{l s='Kindly update the field as maximum character limit is ' mod='kbmarketplace'}";
     var minimum_textarea_limit = "{l s='Kindly update the field as minimum character limit is ' mod='kbmarketplace'}";
     var file_format_error = "{l s='File is not in supported format' mod='kbmarketplace'}";
     var file_not_empty = "{l s='File cannot be empty' mod='kbmarketplace'}";
    var characters = "{l s='characters' mod='kbmarketplace'}";
    var business_email_error = "{l s='Please enter Business Email in valid format.' mod='kbmarketplace'}";
    var url_error = "{l s='Link must be start from  http:// or https://' mod='kbmarketplace'}";
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