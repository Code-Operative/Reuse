<div class="kb_custom_field_block">
    <div >  
          {assign var='field_counter' value=0}
          
          {if isset($registration_form_extra_fields)}
              {if isset($registration_form_extra_fields['shop_title']) && $registration_form_extra_fields['shop_title'] == 1}
                  <div class="form-group row">
                        <label class="col-md-3 form-control-label required" for="shop_title">{l s='Shop Title' mod='kbmarketplace'}</label>
                        <div class="col-md-6">
                        <input type="text" placeholder="{l s='Enter Shop Title' mod='kbmarketplace'}"
                               name='shop_title' id="shop_title" class="kbfield is_required validate form-control"
                               data-validate="isGenericName" 
                               value=""
                               />
                        <span class="error_message" style="display:none;">{l s='Please enter valid Shop Title' mod='kbmarketplace'}</span>
                        </div>
                         <div class="col-md-3 form-control-comment">
                        </div>
                    </div>
                {/if}
              {if isset($registration_form_extra_fields['seller_contact_number']) && $registration_form_extra_fields['seller_contact_number'] == 1}
                  <div class="form-group row">
                        <label class="col-md-3 form-control-label required" for="seller_contact_number">{l s='Enter Contact No' mod='kbmarketplace'}</label>
                        <div class="col-md-6">
                        <input type="text" placeholder="{l s='Enter contact no' mod='kbmarketplace'}"
                               name='seller_contact_number' id="shop_title" class="kbfield is_required validate form-control"
                               data-validate="isPhoneNumber"
                               value=""
                               />
                        <span class="error_message" style="display:none;">{l s='Please enter valid contact number' mod='kbmarketplace'}</span>
                        </div>
                         <div class="col-md-3 form-control-comment">
                        </div>
                    </div>
            {/if}
            {if isset($registration_form_extra_fields['seller_city']) && $registration_form_extra_fields['seller_city'] == 1}
                <div class="form-group row">
                      <label class="col-md-3 form-control-label required" for="seller_city">{l s='City' mod='kbmarketplace'}</label>
                      <div class="col-md-6">
                      <input type="text" placeholder="{l s='Enter city' mod='kbmarketplace'}"
                             name='seller_city' id="shop_title" class="kbfield is_required validate form-control"
                             data-validate="isGenericName" 
                             value=""
                             />
                      <span class="error_message" style="display:none;">{l s='Please enter valid city name' mod='kbmarketplace'}</span>
                      </div>
                       <div class="col-md-3 form-control-comment">
                      </div>
                  </div>
              {/if}
            {if isset($registration_form_extra_fields['seller_country']) && $registration_form_extra_fields['seller_country'] == 1}
                      <div class="form-group row">
                         <label class="col-md-3 form-control-label required" for="seller_country">{l s='Country' mod='kbmarketplace'}</label>
                         <div class="col-md-6">
                         <select name='seller_country' id='seller_country' class="kbfield seller_country is_required form-control">
                            {if !empty($total_active_country)}
                                {foreach $total_active_country as $id_country => $country_details}
                                    <option value="{$id_country}" {if $default_country_id == $id_country}selected {/if}>{$country_details['name']}</option>
                                {/foreach}
                            {/if}                       
                        </select>
                         </div>
                         <div class="col-md-3 form-control-comment">
                            </div>
                            <span class="error_message" style="display:none;">{l s='Please choose a valid country.' mod='kbmarketplace'}</span>
                    </div>
              {/if}
              {if isset($registration_form_extra_fields['membership_plan']) && $registration_form_extra_fields['membership_plan'] == 1}
                      <div class="form-group row">
                         <label class="col-md-3 form-control-label required" for="seller_membership_plan">{l s='Select Membership Plan' mod='kbmarketplace'}</label>
                         <div class="col-md-6">
                         <select name='seller_membership_plan' id='seller_membership_plan' class="kbfield seller_membership_plan is_required form-control">
                            {if !empty($total_active_plan)}
                                {foreach $total_active_plan as $key => $plan_details}
                                    <option value="{$plan_details['id_kbmp_membership_plan']}">{$plan_details['name']}</option>
                                {/foreach}
                            {/if}                       
                        </select>
                         </div>
                         <div class="col-md-3 form-control-comment">
                            </div>
                            <span class="error_message" style="display:none;">{l s='Please choose a membership plan.' mod='kbmarketplace'}</span>
                    </div>
              {/if}
        {/if}
        {foreach $kb_available_field as $kbfield}
            {if ($kbfield['type'] == 'text') && ($kbfield['show_registration_form'] == 1)}
                <div class="form-group row">
                        <label class="col-md-3 form-control-label {if $kbfield['required']}required{/if}" for="{$kbfield['field_name']}">{$kbfield['label']}</label>
                        <div class="col-md-6">
                        <input type="{if $kbfield['validation'] == 'isEmail'}email{else}text{/if}" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                               name='{$kbfield['field_name']}' id="{$kbfield['html_id']}" class="kbfield {$kbfield['html_class']} {if $kbfield['required']}is_required{/if} {if $kbfield['validation'] != ''}validate{/if}  form-control"
                               {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if} {if ($kbfield['max_length'] != '') && ($kbfield['max_length'] > 0)} maxlength="{$kbfield['max_length']}"{/if} {if $kbfield['min_length'] != ''}minlength="{$kbfield['min_length']}"{/if}
                               value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}"
                               />
                        {if $kbfield['error_msg'] != ''}<span class="error_message" style="display:none;">{$kbfield['error_msg']}</span>{/if}
                        </div>
                         <div class="col-md-3 form-control-comment">
                         {if $kbfield['description'] != ''}<span class="form-info">({$kbfield['description']})</span>{/if}
                     </div>
                    </div>
            {/if}
            {if ($kbfield['type'] == 'select') && ($kbfield['show_registration_form'] == 1)}
                 <div class="form-group row">
                         <label class="col-md-3 form-control-label {if $kbfield['required']}required{/if}" for="{$kbfield['html_id']}">{$kbfield['label']}</label>
                         <div class="col-md-6">
                         <select name='{$kbfield['field_name']}{if $kbfield['multiselect']}[]{/if}' id='{$kbfield['html_id']}' class="kbfield {$kbfield['html_class']} {if $kbfield['required']}is_required{/if} form-control"
                                {if $kbfield['multiselect']} multiple{/if} >
                            {if $kbfield['value'] != ''}
                                {foreach $kbfield['value']|json_decode:1 as $field_value}
                                    <option value="{$field_value['option_value']}"
                                        {if isset($kbfield['default_value'])}
                                            {if $kbfield['default_value'] != ""}
                                                {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                    {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                        selected
                                                    {/if}
                                                {/if}
                                            {/if}
                                        {/if}
                                        >{$field_value['option_label']}</option>
                                {/foreach}
                            {/if}                       
                        </select>
                         </div>
                         <div class="col-md-3 form-control-comment">
                                {if $kbfield['description'] != ''}<span class="form-info">({$kbfield['description']})</span>{/if}
                            </div>
                         {if $kbfield['error_msg'] != ''}<span class="error_message" style="display:none;">{$kbfield['error_msg']}</span>{/if}
                    </div>
            {/if}
            {if ($kbfield['type'] == 'radio') && ($kbfield['show_registration_form'] == 1)}
                <div class="clearfix row">
                         <label class="col-md-3 form-control-label {if $kbfield['required']}required{/if}">{$kbfield['label']}</label></br>
                         <div class="col-md-6">    
                             <div class="radio_kb_validate">
                        {if $kbfield['value'] != ''}
                            {foreach $kbfield['value']|json_decode:1 as $field_value}
                                    <label for="{$kbfield['field_name']}" class="radio-inline">
                                        <span class="custom-radio">
                                        <input type="radio" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" class="kbfield {$kbfield['html_class']} {if $kbfield['required']}is_required{/if}" value="{$field_value['option_value']}" 
                                             {if isset($kbfield['default_value'])}
                                                   {if $kbfield['default_value'] != ""}
                                                       {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                           {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                               checked
                                                           {/if}
                                                       {/if}
                                                   {/if}
                                               {/if}  /><span></span>
                                    </span>
                                        {$field_value['option_label']}
                                    </label>
                            {/foreach}
                        {/if}
                                     {if $kbfield['error_msg'] != ''}<span class="error_message" style="display:none;">{$kbfield['error_msg']}</span>{/if}
                         </div>
                         </div>
                       <div class="col-md-3 form-control-comment">
                         {if $kbfield['description'] != ''}<span class="form-info">({$kbfield['description']})</span>{/if}
                     </div>
                    </div>
            {/if}
            {if ($kbfield['type'] == 'checkbox') && ($kbfield['show_registration_form'] == 1)}
                 <div class="form-group row">
                        <label class="col-md-3 form-control-label {if $kbfield['required']}required{/if}">{$kbfield['label']}</label></br>
                        <div class="col-md-6">
                            <div class="checkbox_kb_validate">
                        {if $kbfield['value'] != ''}
                            {foreach $kbfield['value']|json_decode:1 as $field_value}
                                <span class="custom-checkbox">
                                        <input type="checkbox" name="{$kbfield['field_name']}[]"id="{$kbfield['html_id']}" class="kbfield {$kbfield['html_class']} {if $kbfield['required']}is_required{/if}" value="{$field_value['option_value']}"
                                            {if isset($kbfield['default_value'])}
                                                {if $kbfield['default_value'] != ""}
                                                    {if isset($kbfield['default_value'][0]) && isset($kbfield['default_value'][0]['option_value'])}
                                                        {if $kbfield['default_value'][0]['option_value'] == $field_value['option_value']}
                                                            checked
                                                        {/if}
                                                    {/if}
                                                {/if}
                                            {/if}  
                                               />
                                         <span><i class="material-icons checkbox-checked"></i></span>
                                    <label for="{$kbfield['field_name']}">{$field_value['option_label']}</label>
                                </span>
                            {/foreach}
                        {/if}
                        
                        {if $kbfield['error_msg'] != ''}<span class="error_message" style="display:none;">{$kbfield['error_msg']}</span>{/if}
                        </div>
                 </div>
                        <div class="col-md-3 form-control-comment">
                            {if $kbfield['description'] != ''}<span class="form-info">({$kbfield['description']})</span>{/if}
                        </div>
                    </div>

            {/if}
            {if ($kbfield['type'] == 'textarea') && ($kbfield['show_registration_form'] == 1)}
                <div class="form-group row">
                    <label class="col-md-3 form-control-label {if $kbfield['required']}required{/if}" for="{$kbfield['html_id']}">{$kbfield['label']}</label>
                    <div class="col-md-6">
                    <textarea {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                                                                name='{$kbfield['field_name']}' id='{$kbfield['html_id']}' class="kbfield {$kbfield['html_class']} 
                                                                {if $kbfield['required']}is_required{/if} {if $kbfield['validation'] != ''}validate{/if}  form-control"
                                                                {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if}
                                                                {if ($kbfield['max_length'] != '') && ($kbfield['max_length'] > 0)} maxlength="{$kbfield['max_length']}"{/if} {if $kbfield['min_length'] != ''}minlength="{$kbfield['min_length']}"{/if}
                                                                >{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}</textarea>
                   {if $kbfield['error_msg'] != ''}<span class="error_message" style="display:none;">{$kbfield['error_msg']}</span>{/if}
                </div>
                    <div class="col-md-3 form-control-comment">
                    {if $kbfield['description'] != ''}<span class="form-info">({$kbfield['description']})</span>{/if}
                </div>

                </div>
            {/if}
            {if ($kbfield['type'] == 'date') && ($kbfield['show_registration_form'] == 1)}
                <div class="form-group row">
                     <label class="col-md-3 form-control-label {if $kbfield['required']}required{/if}" for="{$kbfield['field_name']}">{$kbfield['label']}</label>
                     <div class="col-md-6">
                    <input type="text" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                           name='{$kbfield['field_name']}' id='{$kbfield['html_id']}' class="kbfield kbfielddate {$kbfield['html_class']} {if $kbfield['required']}is_required{/if} {if $kbfield['validation'] != ''}validate{/if} form-control"
                           {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if} value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}"/>
                </div>
                    <div class="col-md-3 form-control-comment">
                    {if $kbfield['description'] != ''}<span class="form-info">({$kbfield['description']})</span>{/if}
                </div>
                    {if $kbfield['error_msg'] != ''}<span class="error_message" style="display:none;">{$kbfield['error_msg']}</span>{/if}
                </div>
            {/if}
            {if ($kbfield['type'] == 'datetime') && ($kbfield['show_registration_form'] == 1)}
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label {if $kbfield['required']}required{/if}" for="{$kbfield['field_name']}">{$kbfield['label']}</label>
                    <div class="col-md-6">
                    <input type="text" {if $kbfield['placeholder'] != ''}placeholder="{$kbfield['placeholder']}"{/if} 
                           name='{$kbfield['field_name']}' id='{$kbfield['html_id']}' class="kbfielddatetime kbfield {$kbfield['html_class']} 
                           {if $kbfield['required']}is_required{/if} {if $kbfield['validation'] != ''}validate{/if}  form-control hasDatetimepicker"
                           {if $kbfield['validation'] != ''} data-validate="{$kbfield['validation']}"{/if} value="{if isset($kbfield['customer_value'])}{$kbfield['customer_value']}{/if}"/>
                </div>
                    <div class="col-md-3 form-control-comment">
                    {if $kbfield['description'] != ''}<span class="form-info">({$kbfield['description']})</span>{/if}
                </div>
                    {if $kbfield['error_msg'] != ''}<span class="error_message" style="display:none;">{$kbfield['error_msg']}</span>{/if}
                </div>
            {/if}
            {if ($kbfield['type'] == 'file') && ($kbfield['show_registration_form'] == 1)}
                <div class="form-group row">
                    <label class="col-md-3 form-control-label {if $kbfield['required']}required{/if}" for="{$kbfield['field_name']}">{$kbfield['label']}</label>
                    <div class="col-md-6">
                        <input type="file" name="{$kbfield['field_name']}" id="{$kbfield['html_id']}" data-buttonText="{l s='Choose file' mod='kbmarketplace'}" id="{$kbfield['html_id']}" class="kbfield kbfiletype form-control  {if $kbfield['required']}is_required{/if}" />
                    </div>
                    <div class="col-md-3 form-control-comment">
                        {if $kbfield['description'] != ''}<span class="form-info">({$kbfield['description']})</span>{/if}{if $kbfield['file_extension'] != ''} <span class="form-info ">{l s='File must be ' mod='kbmarketplace'}<span class="file_extension">{$kbfield['file_extension']}</span></span></br>{/if}
                    </div>
                    {if $kbfield['error_msg'] != ''}<span class="error_message" style="display:none;">{$kbfield['error_msg']}</span>{/if}

                </div>
            {/if}
        {/foreach}
    </div>
</div>
    <script>
        var submit_account_btn = 1;
        var kb_not_valid = "{l s='Field is not valid' mod='kbmarketplace'}";
        var file_not_empty = "{l s='File cannot be empty' mod='kbmarketplace'}";
        var field_not_empty = "{l s='Field cannot be empty' mod='kbmarketplace'}";
        var kb_empty_field = "{l s='Field cannot be empty.' mod='kbmarketplace'}";
        var kb_number_field = "{l s='You can enter only numbers.' mod='kbmarketplace'}";
        var kb_positive_number = "{l s='Number should be greater than 0.' mod='kbmarketplace'}";
        var kb_maxchar_field = "{l s='Field cannot be greater than # characters.' mod='kbmarketplace'}";
        var kb_minchar_field =  "{l s='Field cannot be less than # character(s).' mod='kbmarketplace'}";
        var kb_empty_email =  "{l s='Please enter Email.' mod='kbmarketplace'}";
        var kb_validate_email =  "{l s='Please enter a valid Email.' mod='kbmarketplace'}";
        var kb_max_email =  "{l s='Email cannot be greater than # characters.' mod='kbmarketplace'}";
        var kb_script = "{l s='Script tags are not allowed.' mod='kbmarketplace'}";
        var kb_style="{l s='Style tags are not allowed.' mod='kbmarketplace'}";
        var kb_iframe =  "{l s='Iframe tags are not allowed.' mod='kbmarketplace'}";
        var kb_html_tags =  "{l s='Field should not contain HTML tags.' mod='kbmarketplace'}";
        var kb_invalid_date = "{l s='Invalid date format.' mod='kbmarketplace'}";
        var file_format_error = "{l s='File is not in supported format' mod='kbmarketplace'}";
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
* @copyright 2017 Knowband
* @license   see file: LICENSE.txt
*
*}