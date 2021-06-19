/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store.
 *
 * @author    knowband.com <support@knowband.com>
 * @copyright 2018 Knowband
 * @license   see file: LICENSE.txt
 * @category  PrestaShop Module
 *
 *
 */

$(document).ready(function () {
    if ($("#date_selection").length) {
        if ($("#date_selection").val() == 'date_range') {
            $('#particular_date').removeClass('required');
            $('#end_date').parent().parent().show();
            $('#start_date').parent().parent().show();
            $('#particular_date').parent().parent().hide();
            $('#reduction').parent().parent().removeClass('kb-form-l');
            $('#reduction').parent().parent().addClass('kb-form-r');
            $('#reduction_type').parent().parent().removeClass('kb-form-r');
            $('#reduction_type').parent().parent().addClass('kb-form-l');

        } else {
            $('#start_date').removeClass('required');
            $('#end_date').removeClass('required');
            $('#end_date').parent().parent().hide();
            $('#start_date').parent().parent().hide();
            $('#particular_date').parent().parent().show();
        }
        if ($("#reduction_type").val() == 'percentage') {
            $('#reduction').attr('validate', 'isPercenatge');
        } else {
            $('#reduction').attr('validate', 'isPrice');
        }
        $("#reduction_type").change(function () {
            if ($("#reduction_type").val() == 'percentage') {
                $('#reduction').attr('validate', 'isPercenatge');
            } else {
                $('#reduction').attr('validate', 'isPrice');
            }
        });
        $("#date_selection").change(function () {
        if ($("#date_selection").val() == "date_range") {
            $('#particular_date').removeClass('required');
            $('#start_date').addClass('required');
            $('#end_date').addClass('required');
            $('#end_date').parent().parent().show();
            $('#start_date').parent().parent().show();
            $('#particular_date').parent().parent().hide();
            $('#reduction').parent().parent().removeClass('kb-form-l');
            $('#reduction').parent().parent().addClass('kb-form-r');

            $('#reduction_type').parent().parent().removeClass('kb-form-r');
            $('#reduction_type').parent().parent().addClass('kb-form-l');
        } else {
            $('#particular_date').addClass('required');
            $('#start_date').removeClass('required');
            $('#end_date').removeClass('required');
            $('#end_date').parent().parent().hide();
            $('#start_date').parent().parent().hide();
            $('#particular_date').parent().parent().show();
            $('#reduction').parent().parent().removeClass('kb-form-r');
            $('#reduction').parent().parent().addClass('kb-form-l');
            $('#reduction_type').parent().parent().removeClass('kb-form-l');
            $('#reduction_type').parent().parent().addClass('kb-form-r');
        }
    });
    }
});
function validatePriceRuleForm() {
    var error = false;
    $('.kb-validation-error').remove();
    $('#kb-price-rule-view-form input[type="text"]').each(function () {
        value = $(this).val();
        value = value.trim();
        if ($(this).hasClass('required'))
        {
            if (value == '')
            {
                error = true;
                $(this).parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
            } else {
                if ($(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate')))
                {
                    error = true;
                    $(this).parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
                }
            }
        }
    });
    if ($("#date_selection").val() == "date_range") {
        var start_time = Date.parse($('#start_date').val());
        var end_time = Date.parse($('#end_date').val());
        if (parseInt(end_time) <= parseInt(start_time)) {
            error = true;
            if ($('#end_date').parent().parent().find('.kb-validation-error').length == 0) {
                $('#end_date').parent().parent().append('<div class="kb-validation-error">' + min_max_hrs_valid + '</div>');
            }
        }
    }
    if ($('#id_product').val() == "0") {
        error = true;
        $('#id_product').parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
    }
    // changes
//    if ($('select[name="date_selection"]').val() == "date_range") {
//        var start_date_empty = velovalidation.checkMandatory($('input[name="start_date"]'));
//        if (start_date_empty != true) {
//            error = true;
//            $('input[name="start_date"]').closest('.input-group').addClass('error_field');
//            $('input[name="start_date"]').closest('.input-group').after('<p class="error_message">' + start_date_empty + '</p>');
//        }
//        var end_date_empty = velovalidation.checkMandatory($('input[name="end_date"]'));
//        if (end_date_empty != true) {
//            error = true;
//            $('input[name="end_date"]').closest('.input-group').addClass('error_field');
//            $('input[name="end_date"]').closest('.input-group').after('<p class="error_message">' + end_date_empty + '</p>');
//        } else {
//            var start_date = Date.parse($('input[name="start_date"]').val());
//            var end_date = Date.parse($('input[name="end_date"]').val());
//            if (parseInt(end_date) <= parseInt(start_date)) {
//                error = true;
//                $('input[name="end_date"]').closest('.input-group').addClass('error_field');
//                $('input[name="end_date"]').closest('.input-group').after('<span class="error_message">' + end_date_error + '</span>');
//            }
//        }
//    } else {
//        var particular_date_empty = velovalidation.checkMandatory($('input[name="particular_date"]'));
//        if (particular_date_empty != true) {
//            error = true;
//            $('input[name="particular_date"]').closest('.input-group').addClass('error_field');
//            $('input[name="particular_date"]').closest('.input-group').after('<p class="error_message">' + particular_date_empty + '</p>');
//        }
//    }
    // over

    if (error) {
        return false;
    } else {
        $('#kb-price-rule-view-form').submit();
    }
}

function getFilteredRules(kb_table_id, page_number) {
    var request_params = serializeObjectToSerialize(filter_paramters);
    request_params += '&start=' + page_number;
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true&method=getFilteredRules' + request_params,
        beforeSend: function () {
            $('#' + kb_table_id + '_filter').attr('disable', true);
            $('#kb-list-loader').show();
        },
        success: function (json)
        {
            $('#' + kb_table_id + '_filter').attr('disable', false);
            $('#kb-list-loader').hide();
            if (json['status'] == true) {
                $('#' + kb_table_id + '_body').html(json['html']);
                $('#' + kb_table_id + '-panel-body .kb-paginator-block').html(json['pagination']);
            } else {
                var html = '<tr><td colspan="' + $('#' + kb_table_id + '-panel-body thead tr th').length + '" class="kb-tcenter kb-empty-table">' + json['msg'] + '</td></tr>';
                $('#' + kb_table_id + '_body').html(html);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            jAlert(kb_ajax_request_fail_err ,alert_heading);
            $('#' + kb_table_id + '_filter').attr('disable', false);
            $('#kb-list-loader').hide();
        }
    });
}