<script type="text/javascript" src='{$tiny_mce_js_file}' ></script>{*Variable contains css and html content, escape not required*}
<script type="text/javascript" src='{$js_velovalidation}' ></script>{*Variable contains css and html content, escape not required*}
<script type="text/javascript">
        var validate_css_length = "{l s='Length of CSS should be less than 10000' mod='kbmarketplace'}";
        var kb_numeric = "{l s='Field should be numeric.' mod='kbmarketplace'}";
        var kb_positive = "{l s='Field should be positive.' mod='kbmarketplace'}";
        var check_for_all = "{l s='Kindly check for all available languages' mod='kbmarketplace'}";
    var empty_field = "{l s='Field cannot be empty' mod='kbmarketplace'}";
    var please_check_kb_fields = "{l s='Fields cannot be blank.Please check for all the languages in the field.' mod='kbmarketplace'}";
    var select_placeholder = "{l s='Select' mod='kbmarketplace'}";
    var no_match_err = "{l s='No Matches Found' mod='kbmarketplace'}";
    var kb_category_empty = "{l s='Select Category' mod='kbmarketplace'}";
    var select_empty = "{l s='Please select' mod='kbmarketplace'}";
    var empty_field = "{l s='Field cannot be empty' mod='kbmarketplace'}";
    var currentText = '{l s='Now'  mod='kbmarketplace' js=1}';
    var closeText = '{l s='Done'  mod='kbmarketplace' js=1}';
    var timeonlytext = '{l s='Choose Time'  mod='kbmarketplace' js=1}';
    var upload_image_empty = "{l s='Please upload image' mod='kbmarketplace'}";
    var end_date_error = "{l s='To date cannot be previous/same to From date.' mod='kbmarketplace'}";
    var end_time_error = "{l s='To Time cannot be previous/same to From Time.' mod='kbmarketplace'}";
    var invalid_time = "{l s='Add time in 24 hour format i.e from 00:00- 23:59.' mod='kbmarketplace'}";
    var end_start_error = "{l s='Check-out Time cannot be previous to Check-In Time.' mod='kbmarketplace'}";
    var store_category_mand = "{l s='Please select category' mod='kbmarketplace'}";
    var star_rating_empty = "{l s='Please select star rating' mod='kbmarketplace'}";
    var min_max_days_valid = "{l s='Maximum days cannot be previous/same to Minimum days.' mod='kbmarketplace'}";
    var min_max_hrs_valid = "{l s='Maximum Hours cannot be previous/same to Minimum Hours.' mod='kbmarketplace'}";
    var kb_image_valid = "{l s='Uploaded file is not an image' mod='kbmarketplace'}";
    var kb_image_size_valid = "{l s='Uploaded file size must be less than 2Mb' mod='kbmarketplace'}";
    var select_product_type = "{l s='Please select any product type' mod='kbmarketplace'}";
    var kb_date_override_string = "{l s='The dates are override with ' mod='kbmarketplace'}";
    var kb_to_string = "{l s='to' mod='kbmarketplace'}";
    var kb_and_string = "{l s='&' mod='kbmarketplace'}";
            velovalidation.setErrorLanguage({
            alphanumeric: "{l s='Field should be alphanumeric.' mod='kbmarketplace'}",
            digit_pass: "{l s='Password should contain atleast 1 digit.' mod='kbmarketplace'}",
            empty_field: "{l s='Field cannot be empty.' mod='kbmarketplace'}",
            number_field: "{l s='You can enter only numbers.' mod='kbmarketplace'}",            
            positive_number: "{l s='Number should be greater than 0.' mod='kbmarketplace'}",
            maxchar_field: "{l s='Field cannot be greater than # characters.' mod='kbmarketplace'}",
            minchar_field: "{l s='Field cannot be less than # character(s).' mod='kbmarketplace'}",
            invalid_date: "{l s='Invalid date format.' mod='kbmarketplace'}",
            valid_amount: "{l s='Field should be numeric.' mod='kbmarketplace'}",
            valid_decimal: "{l s='Field can have only upto two decimal values.' mod='kbmarketplace'}",
            maxchar_size: "{l s='Size cannot be greater than # characters.' mod='kbmarketplace'}",
            specialchar_size: "{l s='Size should not have special characters.' mod='kbmarketplace'}",
            maxchar_bar: "{l s='Barcode cannot be greater than # characters.' mod='kbmarketplace'}",
            positive_amount: "{l s='Field should be positive.' mod='kbmarketplace'}",
            maxchar_color: "{l s='Color could not be greater than # characters.' mod='kbmarketplace'}",
            invalid_color: "{l s='Color is not valid.' mod='kbmarketplace'}",
            specialchar: "{l s='Special characters are not allowed.' mod='kbmarketplace'}",
            script: "{l s='Script tags are not allowed.' mod='kbmarketplace'}",
            style: "{l s='Style tags are not allowed.' mod='kbmarketplace'}",
            iframe: "{l s='Iframe tags are not allowed.' mod='kbmarketplace'}",
              not_image: "{l s='Uploaded file is not an image' mod='kbmarketplace'}",
            image_size: "{l s='Uploaded file size must be less than #.' mod='kbmarketplace'}",
            html_tags: "{l s='Field should not contain HTML tags.' mod='kbmarketplace'}",
            number_pos: "{l s='You can enter only positive numbers.' mod='kbmarketplace'}",
});
    </script>

<div class="kb-content">
    {if !isset($permission_error)}
    <div class="kb-content-header">
        <h1>{$product_form_heading}</h1>
        <div class="clearfix"></div>
    </div>
    {/if}
    {if $step eq 1}
        {include file=$product_template_dir|cat:"product_type.tpl"}
    {elseif $step eq 2}
        {if !isset($permission_error)}
        <form id="kb-product-form" action="{$form_submit_url nofilter}" method="post" enctype="multipart/form-data"> {* Variable contains HTML/CSS/JSON, escape not required *}

            <input type="hidden" name="productformkey" value="{$formkey}" />
            <input type="hidden" name="id_product" value="{$id_product|intval}" />
            <input type="hidden" name="id_booking_product" value="{$id_booking_product|intval}" />
            <div class="kbbtn-group kb-tright">
    <select id='kb_lang_slector_booking_product' class="btn-sm btn-info" style='margin-top: -5%;'>
                {foreach $languages as $language}                    
                    <option {if $default_lang == $language['id_lang']} selected {/if} value='{$language['id_lang']}'>{$language['name']}</option>
                {/foreach}
            </select>
            {*//changes end*}
    </div>
            <div id="kb-product-form-global-msg" class="kbalert kbalert-danger" style="display:none;"><i class="icon-exclamation-sign"></i></div>
            <div class="kbalert kbalert-info">
                <i class="kb-material-icons">info_outline</i>{l s='Fields marked with (*) are mandatory fields.' mod='kbmarketplace'}
            </div>
            {if count($tabs_display) > 0}
                {foreach $tabs_display as $tab_form}
                    {$tab_form nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

                {/foreach}
            {/if}
            {hook h="displayKbMarketPlacePForm" product_id=$id_product type=$product_type form="parentform"}
            <div class='kb-vspacer5'></div>
            <br>
            <input id="kb_submission_type" type="hidden" name="submitType" value="save" />
            <input type="hidden" id="kb_product_type" name="kb_product_type" value="{$product_type}" />
            <input type="hidden" id="type_product" name="type_product" value="2" />
            <a href="javascript:void(0)" class='btn-sm btn-info' id="submit_product_form_butn" onclick="submitProductForm('savenstay')">{l s='Save and Stay' mod='kbmarketplace'}</a>
            <a href="javascript:void(0)" class='btn-sm btn-success' id="submit_product_form_butn" onclick="submitProductForm('save')">{l s='Save' mod='kbmarketplace'}</a>
        </form>
        <script>
            var kb_id_product = {$id_product|intval};
            var kb_editor_lang = "{$editor_lang}";
            var kb_default_lang = {$default_lang|intval};
            var kb_form_validation_error = "{l s='Please fill the detail with valid values.' mod='kbmarketplace'}";
            var kb_img_format = [];

            {foreach $kb_img_frmats as $for}
                kb_img_format.push("{$for|escape:'htmlall':'UTF-8'}");
            {/foreach}
                
            var kb_product_types = [];
            var kb_product_type_hourly_rental = "{$type_hourly_rental}";
            var kb_product_type_daily_rental = "{$type_daily_rental}";
            var kb_product_type_appointment = "{$type_appointment}";
            var kb_product_type_hotel_booking = "{$type_hotel_booking}";
            kb_product_types.push(kb_product_type_daily_rental, kb_product_type_hourly_rental, kb_product_type_appointment, kb_product_type_hotel_booking);
        </script>
        {/if}
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