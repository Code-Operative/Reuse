/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store.
 *
 * @category  PrestaShop Module
 * @author    knowband.com <support@knowband.com>
 * @copyright 2016 knowband
 * @license   see file: LICENSE.txt
 */

var file_error = false;
var slider_banner_file_error = false;
var default_file_size = 2097152;
var google_file_error = false;

$(document).ready(function ()
{
    $('input:radio[name="is_customize"]').on('click change', function (e) {
        if ($(this).val() == 1) {
            $('#plan_id').parent().parent().hide();
            $('input[name="title"]').parent().parent().show();
            $('#plan_duration_type').parent().parent().show();
            $('input:radio[name="is_enabled_product_limit"]').closest('.form-group').show();
            if ($('input[name="is_enabled_product_limit"]:checked').val() == "1") {
                $('input[name="product_limit"]').closest('.form-group').show();
            } else {
                $('input[name="product_limit"]').closest('.form-group').hide();
            }
            $('input[name="plan_duration"]').parent().parent().show();
        } else {
            $('#plan_id').parent().parent().show();
            $('#plan_duration_type').parent().parent().hide();
            $('input[name="title"]').parent().parent().hide();
            $('input[name="plan_duration"]').parent().parent().hide();
            $('input[name="product_limit"]').closest('.form-group').hide();
            $('input:radio[name="is_enabled_product_limit"]').closest('.form-group').hide();
        }
    });
    if ($('input:radio[name="is_customize"]:checked').val() == "1") {
        $('#plan_id').parent().parent().hide();
        $('input[name="title"]').parent().parent().show();
        $('#plan_duration_type').parent().parent().show();
        $('input:radio[name="is_enabled_product_limit"]').closest('.form-group').show();
        if ($('input[name="is_enabled_product_limit"]:checked').val() == "1") {
            $('input[name="product_limit"]').closest('.form-group').show();
        } else {
            $('input[name="product_limit"]').closest('.form-group').hide();
        }
        $('input[name="plan_duration"]').parent().parent().show();
    } else {
        $('#plan_id').parent().parent().show();
        $('#plan_duration_type').parent().parent().hide();
        $('input[name="title"]').parent().parent().hide();
        $('input[name="plan_duration"]').parent().parent().hide();
        $('input[name="product_limit"]').closest('.form-group').hide();
        $('input:radio[name="is_enabled_product_limit"]').closest('.form-group').hide();
    }

    $('input:radio[name="is_enabled_product_limit"]').on('click change', function (e) {
        if ($(this).val() == 1) {
            $('input[name="product_limit"]').closest('.form-group').show();
        } else {
            $('input[name="product_limit"]').closest('.form-group').hide();
        }
    });


    $('button[name="submitAddSellerPlan"]').click(function () {
        var error = false;
        var is_error = 0;
        $('.error_message').remove();
        if ($('input:radio[name="is_customize"]:checked').val() == "1") {

            $('input[name^="title"]').each(function () {
                var label_error = velovalidation.checkMandatory($(this));
                if (label_error != true) {
                    error = true;
                    if (is_error < 1) {
                        $(this).after('<span class="error_message">' + label_error + '</span>');
                        is_error++;
                    }
                    $(this).addClass('error_field');
                }
            });

            if (is_error == 0) {
                $('input[name^="title"]').each(function () {
                    $(this).removeClass('error_field');
                });
            }
            if ($('[id^="is_enabled_product_limit_on"]').is(':checked') === true) {
                var product_limit = velovalidation.checkMandatory($('input[name="product_limit"]'));
                if (product_limit != true)
                {
                    error = true;
                    $('input[name="product_limit"]').addClass('error_field');
                    $('input[name="product_limit"]').after('<span class="error_message">' + empty_field + '</span>');
                } else {
                    var product_limit = velovalidation.isNumeric($('input[name="product_limit"]'), true);
                    if (product_limit != true)
                    {
                        error = true;
                        $('input[name="product_limit"]').addClass('error_field');
                        $('input[name="product_limit"]').after('<span class="error_message">' + kb_positive + '</span>');
                    } else if ($('input[name="product_limit"]').val() == 0) {
                        error = true;
                        $('input[name="product_limit"]').addClass('error_field');
                        $('input[name="product_limit"]').after('<span class="error_message">' + kb_numeric + '</span>');
                    } else {
                        $('input[name="product_limit"]').removeClass('error_field');
                    }
                }
            }

            var plan_duration = velovalidation.checkMandatory($('input[name="plan_duration"]'));
            if (plan_duration != true)
            {
                error = true;
                $('input[name="plan_duration"]').addClass('error_field');
                $('input[name="plan_duration"]').after('<span class="error_message">' + empty_field + '</span>');
            } else {
                var plan_duration = velovalidation.isNumeric($('input[name="plan_duration"]'), true);
                if (plan_duration != true)
                {
                    error = true;
                    $('input[name="plan_duration"]').addClass('error_field');
                    $('input[name="plan_duration"]').after('<span class="error_message">' + kb_positive + '</span>');
                } else if ($('input[name="plan_duration"]').val() == 0) {
                    error = true;
                    $('input[name="plan_duration"]').addClass('error_field');
                    $('input[name="plan_duration"]').after('<span class="error_message">' + kb_numeric + '</span>');
                } else {
                    $('input[name="plan_duration"]').removeClass('error_field');
                }
            }
        }
        if ($('select[name="kbmp_sellers[]"]').val() == null) {
            error = true;
            $('select[name="kbmp_sellers[]"]').parent().append('<span class="error_message">' + empty_field + '</span>');
        }
        if (error) {
            return false;
        } else {
            $('button[name="submitAddSellerPlan"]').attr('disabled', 'disabled');
            if ($('#kb_mp_seller_form').length) {
                $('#kb_mp_seller_form').submit();
            } else {
                $('#kbmp_membership_plan_order_form').submit();
            }
        }

    });
});