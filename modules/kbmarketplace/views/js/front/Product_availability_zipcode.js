/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function validateZoneForm() {
    var error = false;
    $('#kb-zipcode-view-form').find('.kb-validation-error').remove();
    $('#kb-zipcode-view-form input[type="text"]').each(function () {
        value = $(this).val();
        value = value.trim();
        if ($(this).hasClass('required'))
        {
            if (value == '')
            {
                error = true;
                $(this).parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
            }
            else {
                if ($(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate')))
                {
                    error = true;
                    $(this).parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
                }
            }
        } else if (value != '' && $(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate'))) {
            error = true;
            $(this).parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
        }
    });
    if ($('#zip-codes').length) {
        if ($('#zip-codes').val().trim() == '') {
            error = true;
            $('#zip-codes').parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
        }
    }
    if (error) {
        return false;
    } else {
        $('#kb-zipcode-view-form').submit();
    }
}
function validateProductZoneMappingForm() {
    var error = false;
    $('#kb-zone-mapping-form').find('.kb-validation-error').remove();
    if ($('#selectbox_product_zones').val() === null) {
        error = true;
        $('#selectbox_product_zones').parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
    }
    if ($('#selectbox_product_products').val() === null) {
        error = true;
        $('#selectbox_product_products').parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
    }
    if (error) {
        return false;
    } else {
        $('#kb-zone-mapping-form').submit();
    }
}
function getSellerFilteredZipcodes() {

}