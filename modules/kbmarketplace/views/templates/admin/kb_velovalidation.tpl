<script>
    var all_lang_req = "{l s='Field can not be empty for any language.' mod='kbmarketplace'}";
    var empty_field = "{l s='Field cannot be empty.' mod='kbmarketplace'}";
     var can_not_zero = "{l s='Incentive amount can not be zero.' mod='kbmarketplace'}";
    var audit_log = "{l s='Audit Log' mod='kbmarketplace'}";
    var sync_reviews = "{l s='Sync Reviews' mod='kbmarketplace'}";
    var error_msg_multiselect = "{l s='Field cannot be empty. Please select at least one order state.' mod='kbmarketplace'}";
    var controller_path = "{$controller_path nofilter}"; {* Variable contains URL, can not escape this *}
    var lang_id = "{$lang_id}";
    var method = "{$method}";
    velovalidation.setErrorLanguage({
        empty_fname: "{l s='Please enter First name.' mod='kbmarketplace'}",
        maxchar_fname: "{l s='First name cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_fname: "{l s='First name cannot be less than # characters.' mod='kbmarketplace'}",
        empty_mname: "{l s='Please enter middle name.' mod='kbmarketplace'}",
        maxchar_mname: "{l s='Middle name cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_mname: "{l s='Middle name cannot be less than # characters.' mod='kbmarketplace'}",
        only_alphabet: "{l s='Only alphabets are allowed.' mod='kbmarketplace'}",
        empty_lname: "{l s='Please enter Last name.' mod='kbmarketplace'}",
        maxchar_lname: "{l s='Last name cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_lname: "{l s='Last name cannot be less than # characters.' mod='kbmarketplace'}",
        alphanumeric: "{l s='Field should be alphanumeric.' mod='kbmarketplace'}",
        empty_pass: "{l s='Please enter Password.' mod='kbmarketplace'}",
        maxchar_pass: "{l s='Password cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_pass: "{l s='Password cannot be less than # characters.' mod='kbmarketplace'}",
        specialchar_pass: "{l s='Password should contain atleast 1 special character.' mod='kbmarketplace'}",
        alphabets_pass: "{l s='Password should contain alphabets.' mod='kbmarketplace'}",
        capital_alphabets_pass: "{l s='Password should contain atleast 1 capital letter.' mod='kbmarketplace'}",
        small_alphabets_pass: "{l s='Password should contain atleast 1 small letter.' mod='kbmarketplace'}",
        digit_pass: "{l s='Password should contain atleast 1 digit.' mod='kbmarketplace'}",
        empty_field: "{l s='Field cannot be empty.' mod='kbmarketplace'}",
        number_field: "{l s='You can enter only numbers.' mod='kbmarketplace'}",            
        positive_number: "{l s='Number should be greater than 0.' mod='kbmarketplace'}",
        maxchar_field: "{l s='Field cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_field: "{l s='Field cannot be less than # character(s).' mod='kbmarketplace'}",
        empty_email: "{l s='Please enter Email.' mod='kbmarketplace'}",
        validate_email: "{l s='Please enter a valid Email.' mod='kbmarketplace'}",
        empty_country: "{l s='Please enter country name.' mod='kbmarketplace'}",
        maxchar_country: "{l s='Country cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_country: "{l s='Country cannot be less than # characters.' mod='kbmarketplace'}",
        empty_city: "{l s='Please enter city name.' mod='kbmarketplace'}",
        maxchar_city: "{l s='City cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_city: "{l s='City cannot be less than # characters.' mod='kbmarketplace'}",
        empty_state: "{l s='Please enter state name.' mod='kbmarketplace'}",
        maxchar_state: "{l s='State cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_state: "{l s='State cannot be less than # characters.' mod='kbmarketplace'}",
        empty_proname: "{l s='Please enter product name.' mod='kbmarketplace'}",
        maxchar_proname: "{l s='Product cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_proname: "{l s='Product cannot be less than # characters.' mod='kbmarketplace'}",
        empty_catname: "{l s='Please enter category name.' mod='kbmarketplace'}",
        maxchar_catname: "{l s='Category cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_catname: "{l s='Category cannot be less than # characters.' mod='kbmarketplace'}",
        empty_zip: "{l s='Please enter zip code.' mod='kbmarketplace'}",
        maxchar_zip: "{l s='Zip cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_zip: "{l s='Zip cannot be less than # characters.' mod='kbmarketplace'}",
        empty_username: "{l s='Please enter Username.' mod='kbmarketplace'}",
        maxchar_username: "{l s='Username cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_username: "{l s='Username cannot be less than # characters.' mod='kbmarketplace'}",
        invalid_date: "{l s='Invalid date format.' mod='kbmarketplace'}",
        maxchar_sku: "{l s='SKU cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_sku: "{l s='SKU cannot be less than # characters.' mod='kbmarketplace'}",
        invalid_sku: "{l s='Invalid SKU format.' mod='kbmarketplace'}",
        empty_sku: "{l s='Please enter SKU.' mod='kbmarketplace'}",
        validate_range: "{l s='Number is not in the valid range. It should be betwen # and ##' mod='kbmarketplace'}",
        empty_address: "{l s='Please enter address.' mod='kbmarketplace'}",
        minchar_address: "{l s='Address cannot be less than # characters.' mod='kbmarketplace'}",
        maxchar_address: "{l s='Address cannot be greater than # characters.' mod='kbmarketplace'}",
        empty_company: "{l s='Please enter company name.' mod='kbmarketplace'}",
        minchar_company: "{l s='Company name cannot be less than # characters.' mod='kbmarketplace'}",
        maxchar_company: "{l s='Company name cannot be greater than # characters.' mod='kbmarketplace'}",
        invalid_phone: "{l s='Phone number is invalid.' mod='kbmarketplace'}",
        empty_phone: "{l s='Please enter phone number.' mod='kbmarketplace'}",
        minchar_phone: "{l s='Phone number cannot be less than # characters.' mod='kbmarketplace'}",
        maxchar_phone: "{l s='Phone number cannot be greater than # characters.' mod='kbmarketplace'}",
        empty_brand: "{l s='Please enter brand name.' mod='kbmarketplace'}",
        maxchar_brand: "{l s='Brand name cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_brand: "{l s='Brand name cannot be less than # characters.' mod='kbmarketplace'}",
        empty_shipment: "{l s='Please enter Shimpment.' mod='kbmarketplace'}",
        maxchar_shipment: "{l s='Shipment cannot be greater than # characters.' mod='kbmarketplace'}",
        minchar_shipment: "{l s='Shipment cannot be less than # characters.' mod='kbmarketplace'}",
        invalid_ip: "{l s='Invalid IP format.' mod='kbmarketplace'}",
        invalid_url: "{l s='Invalid URL format.' mod='kbmarketplace'}",
        empty_url: "{l s='Please enter URL.' mod='kbmarketplace'}",
        valid_amount: "{l s='Field should be numeric.' mod='kbmarketplace'}",
        valid_decimal: "{l s='Field can have only upto two decimal values.' mod='kbmarketplace'}",
        max_email: "{l s='Email cannot be greater than # characters.' mod='kbmarketplace'}",
        specialchar_zip: "{l s='Zip should not have special characters.' mod='kbmarketplace'}",
        specialchar_sku: "{l s='SKU should not have special characters.' mod='kbmarketplace'}",
        max_url: "{l s='URL cannot be greater than # characters.' mod='kbmarketplace'}",
        valid_percentage: "{l s='Percentage should be in number.' mod='kbmarketplace'}",
        between_percentage: "{l s='Percentage should be between 0 and 100.' mod='kbmarketplace'}",
        maxchar_size: "{l s='Size cannot be greater than # characters.' mod='kbmarketplace'}",
        specialchar_size: "{l s='Size should not have special characters.' mod='kbmarketplace'}",
        specialchar_upc: "{l s='UPC should not have special characters.' mod='kbmarketplace'}",
        maxchar_upc: "{l s='UPC cannot be greater than # characters.' mod='kbmarketplace'}",
        specialchar_ean: "{l s='EAN should not have special characters.' mod='kbmarketplace'}",
        maxchar_ean: "{l s='EAN cannot be greater than # characters.' mod='kbmarketplace'}",
        specialchar_bar: "{l s='Barcode should not have special characters.' mod='kbmarketplace'}",
        maxchar_bar: "{l s='Barcode cannot be greater than # characters.' mod='kbmarketplace'}",
        positive_amount: "{l s='Field should be positive.' mod='kbmarketplace'}",
        maxchar_color: "{l s='Color could not be greater than # characters.' mod='kbmarketplace'}",
        invalid_color: "{l s='Color is not valid.' mod='kbmarketplace'}",
        specialchar: "{l s='Special characters are not allowed.' mod='kbmarketplace'}",
        script: "{l s='Script tags are not allowed.' mod='kbmarketplace'}",
        style: "{l s='Style tags are not allowed.' mod='kbmarketplace'}",
        iframe: "{l s='Iframe tags are not allowed.' mod='kbmarketplace'}",
        not_image: "{l s='Uploaded file is not an image.' mod='kbmarketplace'}",
        image_size: "{l s='Uploaded file size must be less than #.' mod='kbmarketplace'}",
        html_tags: "{l s='Field should not contain HTML tags.' mod='kbmarketplace'}",
        number_pos: "{l s='You can enter only positive numbers.' mod='kbmarketplace'}",
        invalid_separator:"{l s='Invalid comma (#) separated values.' mod='kbmarketplace'}",
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
* @copyright 2017 Knowband
* @license   see file: LICENSE.txt
*
* Description
*
* Admin tpl file
*}