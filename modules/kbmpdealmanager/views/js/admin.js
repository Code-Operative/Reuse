/**
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
* We offer the best and most useful modules PrestaShop and modifications for your online store. 
*
* @category  PrestaShop Module
* @author    knowband.com <support@knowband.com>
* @copyright 2016 Knowband
* @license   see file: LICENSE.txt
*/

$(document).ready(function(){
   $('#kbmp_deal_type').trigger('change'); 
});

function switchDealType(event)
{
    if ($(event).val() == kbmp_dealtype_cart) {
        $('#kbmp_seller_deal_form .deal_cart_rule').closest('.form-group').show();
    } else {
        $('#kbmp_seller_deal_form .deal_cart_rule').closest('.form-group').hide();
    }
}

function addCategoryRule()
{
    if ($('#deal_rule_category option:selected').is(':disabled')) {
        alert('This category is not assigned to selecetd seller.');
    } else {
        var html = '<tr>'                       
                + '<td>'+kb_dealrule_label_category+'</td>'
                + '<td><input type="hidden" name="deal_rule_categories[]" value="'+$('#deal_rule_category option:selected').val()+'" />'+$('#deal_rule_category option:selected').html()+'</td>'
                + '<td><a href="javascript:void(0)" onclick="deleteSellerDealRule(this)" class="btn btn-default" title="'+kb_dealrule_delete_hint+'">'+kb_dealrule_label_delete+'</a></td>'
            + '</tr>';
        $('#seller_deal_rules').append(html);    
    }
}

function addManufacturerRule()
{
    var html = '<tr>'                       
            + '<td>'+kb_dealrule_label_manufacturer+'</td>'
            + '<td><input type="hidden" name="deal_rule_manufacturers[]" value="'+$('#deal_rule_manufacturer option:selected').val()+'" />'+$('#deal_rule_manufacturer option:selected').html()+'</td>'
            + '<td><a href="javascript:void(0)" onclick="deleteSellerDealRule(this)" class="btn btn-default" title="'+kb_dealrule_delete_hint+'">'+kb_dealrule_label_delete+'</a></td>'
        + '</tr>';
    $('#seller_deal_rules').append(html);
}

function deleteSellerDealRule(event)
{
    $(event).closest('tr').remove();
}

//date format //yyyy-mm-dd
var validation_fields = [{
    'isGenericName': /^[^<>={}]*$/,
    'isInt': /^[0-9]+$/,
    'isPrice': /^[0-9]*(?:\.\d{1,6})?$/,
    'isDate': /^(([0-9]{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])|(0000-00-00))$/,
    'isDateTime': /^(([0-9]{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01]) (20|21|22|23|[0-1]+\d{1}):([0-5]+\d{1}):([0-5]+\d{1}))$/,
}];

function kbValidateField(value, validation_type)
{
    if(validation_fields[0][validation_type] == undefined)
        return false;
    
    var reg = new RegExp(validation_fields[0][validation_type]);
    if(reg.test(value))
        return true;
    else
        return false;
    
}

function validateDealForm()
{
    var error = false;
    $('#kbmp_seller_deal_form .error').remove();
    $('#kbmp_seller_deal_form .has-error').removeClass('has-error');
    $('#kbmp_seller_deal_form input[type="text"].required, #kbmp_seller_deal_form select.required').each(function(){
        var value = $(this).val().trim();
        var check_validation = true;
        if ($(this).attr('name') == 'code') {
            if ($('#kbmp_deal_type').val() != kbmp_dealtype_cart) {
                check_validation = false;
            }
        }
        if (check_validation) {
            var check_value_format = false;
            if($(this).hasClass('required')) {
                if (value == '') {
                    error = true;
                    $(this).closest('.form-group').addClass('has-error');
                    if ($(this).hasClass('datetimepicker')) {
                        $(this).parent().parent().append('<span class="error">'+kb_required_field+'</span>');
                    } else {
                        $(this).parent().append('<span class="error">'+kb_required_field+'</span>');
                    }
                } else {
                    check_value_format = true;
                }  
            }else if(value != ''){
                check_value_format = true;
            }
            if (check_value_format) {
                var error_msg = '<span class="error">'+kb_invalid_field+'</span>';
                if ($(this).attr('name') == 'from_date' || $(this).attr('name') == 'end_date') {
                    if (!kbValidateField(value, 'isDateTime')) {
                        error = true;
                        $(this).closest('.form-group').addClass('has-error');
                        $(this).parent().parent().append('<span class="error">'+error_msg+'</span>');
                    }
                }
                if ($(this).attr('name') == 'buy_x_qty' || $(this).attr('name') == 'get_y_qty') {
                    if (!kbValidateField(value, 'isInt')) {
                        error = true;
                        $(this).closest('.form-group').addClass('has-error');
                        $(this).parent().append(error_msg);
                    }
                }
                if ($(this).attr('name') == 'reduction') {
                    if (!kbValidateField(value, 'isPrice')) {
                        error = true;
                        $(this).closest('.form-group').addClass('has-error');
                        $(this).parent().append(error_msg);
                    }
                }
            }
        }
    });
    
    if (!error) {
        var start_date = $('#seller_deal_from_date').val();
        var end_date = $('#seller_deal_end_date').val();
        if((new Date(start_date).getTime()) > (new Date(end_date).getTime())){
            $('#seller_deal_end_date').closest('.form-group').addClass('has-error');
            $('#seller_deal_end_date').parent().parent().append('<span class="error">'+kb_invalid_deal_date_msg+'</span>');
            error = true;
        }
        
        if ($('#kbmp_deal_type').val() != kbmp_dealtype_cart && $('#reduction_type').val() == kbmp_reductiontype_percent) {
            var temp_oj = '#kbmp_seller_deal_form input[name="reduction"]';
            value = $(temp_oj).val().trim();
            if (value <= 0 || value > 100) {
                error = true;
                $(temp_oj).closest('.form-group').addClass('has-error');
                $(temp_oj).parent().append('<span class="error">'+kb_invalid_discount_range+'</span>');
            }
        }
        if ($('#kbmp_deal_type').val() == kbmp_dealtype_cart) {
            value = $('#code').val().trim();
            var reg = /^[0-9a-zA-Z]{5,8}$/;
            if (!reg.test(value)) {
                error = true;
                $('#code').closest('.form-group').addClass('has-error');
                $('#code').parent().append('<span class="kb-validation-error">'+kb_invalid_field+'</span>');
            }
        }
    }
    if (!error) {
        if ($('#seller_deal_rules input').length == 0) {
            error = true;
            alert(kb_dealrule_required_rule);
        }
    }
    if (!error) {
        if ($('#kbmp_deal_type').val() == kbmp_dealtype_cart) {
            $.ajax({
                type: 'POST',
                headers: { "cache-control": "no-cache" },
                url: '',
                async: true,
                cache: false,
                dataType : "json",
                data: 'ajax=true&method=checkCoupon&code='+$('#code').val().trim()+'&id_seller_deal='+$('#id_seller_deal').val().trim(),
                success: function(json)
                {
                    if (json.error) {
                        alert(json.msg);
                    } else {
                        $('#kbmp_seller_deal_form').submit();
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    jAlert(textStatus);
                }
            });    
        } else {
            $('#kbmp_seller_deal_form').submit();
        }
    }
}

function refreshCategories(event)
{
    if ($(event).val() > 0) {
        $.ajax({
            type: 'POST',
            headers: { "cache-control": "no-cache" },
            url: '',
            async: true,
            cache: false,
            dataType : "json",
            data: 'ajax=true&method=getSellerCategory&id_seller='+$(event).val(),
            beforeSend: function() {

            },
            success: function(json)
            {
                var assigned_categories = json.assigned_categories;
                $('#deal_rule_category option').each(function(){
                    if (json.assigned_cat_exist && assigned_categories.indexOf($(this).val())) {
                        $(this).removeAttr('disabled');
                    } else {
                        $(this).attr('disabled', 'disabled');
                    }
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('Error occurred while getting assigned category for selected seller.');
            }
        });    
    } else {
        $('#deal_rule_category option').each(function(){
            $(this).attr('disabled', 'disabled');
        });
    }
}


