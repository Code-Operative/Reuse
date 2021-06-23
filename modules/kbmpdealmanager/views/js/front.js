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

$(document).ready(function () {

    if ($('input[name="from_date"]').length > 0) {
    $('input[name="from_date"]').datetimepicker({
        format:  'yyyy-mm-dd hh:ii:00',
         autoclose: 1,
});
    }
    if ($('input[name="end_date"]').length > 0) {
        $('input[name="end_date"]').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:00',
            autoclose: 1,
        });
    }


//    validation_fields[0].isDateTime = /^(([0-9]{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01]) (20|21|22|23|[0-1]+\d{1}):([0-5]+\d{1}):([0-5]+\d{1}))$/;
    validation_fields[0].isDateTime = /[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (2[0-3]|[01][0-9]):[0-5][0-9]/;

    $('#kbmp_deal_type').trigger('change');
    if ($('#kb_mp_product_name').length) {
        $('#kb_mp_product_name').autocomplete(path_fold + "/kbmpproductlist.php", {
            delay: 100,
            minChars: 1,
            autoFill: true,
            max: 20,
            matchContains: true,
            mustMatch: true,
            scroll: false,
            cacheLength: 0,
            // param multipleSeparator:'||' ajouté à cause de bug dans lib autocomplete
            multipleSeparator: '||',
            formatItem: function (item) {
                return item[1] + ' - ' + item[0];
            },
            extraParams: {
                excludeIds: getSelectedIds(),
                excludeVirtuals: 1,
                exclude_packs: 1
            }
        }).result(function (event, item) {
            $('#kb_mp_product_id').val(item[1]);
            $('#kb_mp_product_name').val(item[0]);
            $('#kb_mp_product_name').attr('readonly', true);
        });
    }
    if ($('#kb_mp_limit_customer').length) {
        $('#kb_mp_limit_customer').autocomplete(path_fold + "/kbmplimitcustomer.php", {
            delay: 100,
            minChars: 1,
            autoFill: true,
            max: 20,
            matchContains: true,
            mustMatch: true,
            scroll: false,
            cacheLength: 0,
            // param multipleSeparator:'||' ajouté à cause de bug dans lib autocomplete
            multipleSeparator: '||',
            formatItem: function (item) {
                return item[0];
            },
            extraParams: {
                customerFilter: 1,
            }
        }).result(function (event, item) {
            $('#kb_mp_limit_customer').attr('readonly', true);
        });
    }
});

function getSelectedIds()
{
    if ($('#inputPackItems').val() === undefined)
        return '';
    var ids = '';
    if (typeof (id_product) != 'undefined')
        ids += id_product + ',';
    ids += $('#inputPackItems').val().replace(/\d*x/g, '').replace(/\-/g, ',');
    ids = ids.replace(/\,$/, '');
    return ids;
}

function switchDealType(event)
{
    if ($(event).val() == kbmp_dealtype_cart) {
        $('#kb-seller-deal-form .deal_cart_rule').show();
    } else {
        $('#kb-seller-deal-form .deal_cart_rule').hide();
    }
}

function addCategoryRule()
{
    if ($('#deal_rule_category option:selected').is(':disabled')) {
        alert(kb_dealrule_unassign_cat_rule_err);
    } else {
        var html = '<tr>'
                + '<td>' + kb_dealrule_label_category + '</td>'
                + '<td><input type="hidden" name="deal_rule_categories[]" value="' + $('#deal_rule_category option:selected').val() + '" />' + $('#deal_rule_category option:selected').html() + '</td>'
                + '<td><a href="javascript:void(0)" onclick="deleteSellerDealRule(this)" title="Click to delete rule">' + kb_dealrule_label_delete + '</a></td>'
                + '</tr>';
        $('#seller_deal_rules').append(html);
    }
}

function addProduct()
{
    if ($('#kb_mp_product_id').val() == '' || $('#kb_mp_product_name').val() == '') {
        jAlert(kb_dealrule_select_product);
    } else {
        var html = '<tr>'
                + '<td class="kb_mp_seller_product_id">' + $('#kb_mp_product_id').val() + '</td>'
                + '<td><input type="hidden" name="product_rule[]" value="' + $('#kb_mp_product_id').val() + '" />' + $('#kb_mp_product_name').val() + '</td>'
                + '<td><a href="javascript:void(0)" onclick="deleteSellerDealRulePerProduct(this)" title="Click to delete rule">' + kb_dealrule_label_delete + '</a></td>'
                + '</tr>';
        $('#seller_per_product_deal_rules').append(html);
        $('#kb_mp_product_id').val('');
        $('#kb_mp_product_name').val('');
        $('#kb_mp_product_name').attr('readonly', false);
    }
}

function freeField(a)
{
    if (a == 2) {
        $('#kb_mp_product_id').val('');
        $('#kb_mp_product_name').val('');
        $('#kb_mp_product_name').attr('readonly', false);
    } else {
        $('#kb_mp_limit_customer').val('');
        $('#kb_mp_limit_customer').attr('readonly', false);
    }
}
function addManufacturerRule()
{
    var html = '<tr>'
            + '<td>' + kb_dealrule_label_manufacturer + '</td>'
            + '<td><input type="hidden" name="deal_rule_manufacturers[]" value="' + $('#deal_rule_manufacturer option:selected').val() + '" />' + $('#deal_rule_manufacturer option:selected').html() + '</td>'
            + '<td><a href="javascript:void(0)" onclick="deleteSellerDealRule(this)" title="Click to delete rule">' + kb_dealrule_label_delete + '</a></td>'
            + '</tr>';
    $('#seller_deal_rules').append(html);
}

function deleteSellerDealRule(event)
{
    $(event).closest('tr').remove();
}

function deleteSellerDealRulePerProduct(event)
{
    $(event).closest('tr').remove();
}

function validateDealForm(submit_type)
{
    var error = false;
    $('#kbmp_submission_type').val(submit_type);
    $('#kb-seller-deal-form .kb-validation-error').remove();
    $('#kb-seller-deal-form input[type="text"], #kb-seller-deal-form select').each(function () {
        var value = $(this).val().trim();
        var check_validation = true;
        if ($(this).attr('name') == 'code') {
            if ($('#kbmp_deal_type').val() != kbmp_dealtype_cart) {
                check_validation = false;
            }
        }
        if (check_validation) {
            if ($(this).hasClass('required')) {
                if (value == '') {
                    error = true;
                    $(this).parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
                } else {
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
        }
    });

    if (!error) {
        var start_date = $('#seller_deal_from_date').val();
        var end_date = $('#seller_deal_end_date').val();
        if ((new Date(start_date).getTime()) > (new Date(end_date).getTime())) {
            $('#seller_deal_end_date').parent().parent().append('<span class="kb-validation-error">' + kb_invalid_deal_date_msg + '</span>');
            error = true;
        }

        if ($('#kbmp_deal_type').val() != kbmp_dealtype_cart && $('#reduction_type').val() == kbmp_reductiontype_percent) {
            value = $('#kb-seller-deal-form input[name="reduction"]').val().trim();
            if (value <= 0 || value > 100) {
                error = true;
                $('#kb-seller-deal-form input[name="reduction"]').parent().parent().append('<span class="kb-validation-error">' + kb_invalid_discount_range + '</span>');
            }
        }

        if ($('#kbmp_deal_type').val() == kbmp_dealtype_cart) {
            value = $('#coupon_code').val().trim();
            var reg = /^[0-9a-zA-Z]{5,8}$/;
            if (!reg.test(value)) {
                error = true;
                $('#coupon_code').parent().parent().append('<span class="kb-validation-error">' + kb_invalid_field + '</span>');
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
                headers: {"cache-control": "no-cache"},
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
                async: true,
                cache: false,
                dataType: "json",
                data: 'ajax=true&method=checkCoupon&code=' + $('#coupon_code').val().trim() + '&id_seller_deal=' + $('#id_seller_deal').val().trim(),
                success: function (json)
                {
                    if (json.error) {
                        alert(json.msg);
                    } else {
                        $('#kb-seller-deal-form').submit();
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    jAlert(kb_ajax_request_fail_err);
                }
            });
        } else {
            $('#kb-seller-deal-form').submit();
        }
    }
}

function validateDealFormPerProduct(submit_type)
{
    var error = false;
    $('#kbmp_submission_type_per_product').val(submit_type);
    $('#kb-seller-per-product-deal-form .kb-validation-error').remove();
    $('#kb-seller-per-product-deal-form input[type="text"], #kb-seller-deal-form select').each(function () {
        var value = $(this).val().trim();
        var check_validation = true;
        if (check_validation) {
            if ($(this).hasClass('required')) {
                if (value == '') {
                    error = true;
                    $(this).parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
                } else {
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
        }
    });

    if (!error) {
        var discount_type = $('#reduction_type').val();
        var discount_value = $('#reduction_value').val();
        if (!$.isNumeric(discount_value)) {
            error = true;
            $('#reduction_value').parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
        }
        if (discount_type == 1 && !error) {
            if (discount_value < 0 || discount_value > 100) {
                error = true;
                $('#reduction_value').parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
            }
        }
    }

    if (!error) {
        var coupon_quantity = $('#coupon_quantity').val();
        var coupon_quantity_per_user = $('#coupon_quantity_per_user').val();
        if (!$.isNumeric(coupon_quantity)) {
            error = true;
            $('#coupon_quantity').parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
        }
        if (!$.isNumeric(coupon_quantity)) {
            error = true;
            $('#coupon_quantity_per_user').parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
        }
    }

    if (!error) {
        var start_date = $('#seller_per_product_deal_from_date').val();
        var end_date = $('#seller_per_product_deal_end_date').val();
        if ((new Date(start_date).getTime()) > (new Date(end_date).getTime())) {
            $('#seller_per_product_deal_end_date').parent().parent().append('<span class="kb-validation-error">' + kb_invalid_deal_date_msg + '</span>');
            error = true;
        }
    }
    if ($('#seller_per_product_deal_rules .kb_mp_seller_product_id').length == 0 && !error) {
        error = true;
        jAlert(kb_dealrule_required_rule);
    }

    if (!error) {
        $.ajax({
            type: 'POST',
            headers: {"cache-control": "no-cache"},
            url: kb_current_request_per_product + ((kb_current_request_per_product.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
            async: true,
            cache: false,
            dataType: "text",
            data: 'ajax=true&method=checkCoupon&code=' + $('#coupon_code_per_product').val().trim() + '&id_seller_deal=' + $('#id_seller_deal').val(),
            success: function (json)
            {
                if (json.error) {
                    jAlert(json.msg);
                } else {
                    $('#kb-seller-per-product-deal-form').submit();
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                jAlert(kb_ajax_request_fail_err);
            }
        });
    }
}

function generateCouponCode(size, controller)
{

    /* There are no O/0 in the codes in order to avoid confusion */
    var chars = "123456789ABCDEFGHIJKLMNPQRSTUVWXYZ";
    var code = '';
    for (var i = 1; i <= size; ++i) {
        code += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    if (controller == 'mydeals') {
        $('#coupon_code').val(code);
    } else {
        $('#coupon_code_per_product').val(code);
    }
}

function getAjaxMyDeals(kb_table_id, page_number) {
    var request_params = serializeObjectToSerialize(filter_paramters);
    request_params += '&start=' + page_number;
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true&method=getAjaxMyDeals' + request_params,
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
            jAlert(kb_ajax_request_fail_err);
            $('#' + kb_table_id + '_filter').attr('disable', false);
            $('#kb-list-loader').hide();
        }
    });
}

