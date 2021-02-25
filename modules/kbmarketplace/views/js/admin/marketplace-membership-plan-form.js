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
    $('input:radio[name="is_enabled_product_limit"]').on('click change', function (e) {
        if ($(this).val() == 1) {
            $('input[name="product_limit"]').closest('.form-group').show();
        } else {
            $('input[name="product_limit"]').closest('.form-group').hide();
        }
    });

    if ($('input:radio[name="is_enabled_product_limit"]:checked').val() == "1") {
        $('input[name="product_limit"]').closest('.form-group').show();
    } else {
        $('input[name="product_limit"]').closest('.form-group').hide();
    }
    $('#uploadedfile').on('change', function (e) {
        $('.error_message').remove();
        if ($(this)[0].files !== undefined && $(this)[0].files.length > 0)
        {
            var files = $(this)[0].files[0];
            var file_data = e.target.files;
            var file_mimetypes = [
                'image/gif',
                'image/jpeg',
                'image/png',
                'application/x-shockwave-flash',
                'image/psd',
                'image/bmp',
                'image/tiff',
                'application/octet-stream',
                'image/jp2',
                'image/iff',
                'image/vnd.wap.wbmp',
                'image/xbm',
                'image/vnd.microsoft.icon',
                'image/webp'
            ];

            var file_format = false;
            for (i = 0; i < file_mimetypes.length; i++) {
                if (files.type == file_mimetypes[i]) {
                    file_format = true;
                }
            }

            if (!file_format)
            {
                $(this).parent().parent().after('<span class="error_message">' + invalid_file_format_txt + '</span>');
                file_error = true;

            } else if (files.size > 8097152) {
                $(this).parent().parent().after('<span class="error_message">' + file_size_error_txt + '</span>');
                file_error = true;
            } else {
                file_error = false;
                if (typeof (FileReader) != "undefined") {

                    var image_holder = $("#planimage");

                    image_holder.empty();

                    var reader = new FileReader();
                    reader.onload = function (e) {

                        $('#planimage').attr('src', e.target.result);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                }
            }
        }
        else // Internet Explorer 9 Compatibility
        {
            $(this).parent().parent().after('<span class="error_message">' + invalid_file_txt + '</span>');
            file_error = true;
        }
    });

    $('button[name="submitAddkbmp_membership_plan"]').click(function () {
        var error = false;
        var is_error = 0;
        $('.error_message').remove();
        $('input[name^="title_"]').each(function () {
            var label_error = velovalidation.checkMandatory($(this));
            if (label_error != true) {
                error = true;
                if (is_error < 1) {
                    $(this).closest('.form-group').after('<span class="error_message">' + label_error + ' ' + check_for_all + '</span>');
                    is_error++;
                }
                $(this).addClass('error_field');
            }
        });
        if (is_error == 0) {
            $('input[name^="title_"]').each(function () {
                $(this).removeClass('error_field');
            });
        }
        if ($('[id^="is_enabled_product_limit_on"]').is(':checked') === true) {
            var product_limit = velovalidation.checkMandatory($('input[name="product_limit"]'));
            if (product_limit != true)
            {
                error = true;
                $('input[name="product_limit"]').addClass('error_field');
                $('input[name="product_limit"]').parent().append('<span class="error_message">' + empty_field + '</span>');
            } else {
                var product_limit = velovalidation.isNumeric($('input[name="product_limit"]'), true);
                if (product_limit != true)
                {
                    error = true;
                    $('input[name="product_limit"]').addClass('error_field');
                    $('input[name="product_limit"]').parent().append('<span class="error_message">' + kb_positive + '</span>');
                } else if ($('input[name="product_limit"]').val() == 0) {
                    error = true;
                    $('input[name="product_limit"]').addClass('error_field');
                    $('input[name="product_limit"]').parent().append('<span class="error_message">' + kb_numeric + '</span>');
                } else {
                    $('input[name="product_limit"]').removeClass('error_field');
                }
            }
        }

        var plan_price = velovalidation.checkMandatory($('input[name="plan_price"]'));
        if (plan_price != true)
        {
            error = true;
            $('input[name="plan_price"]').addClass('error_field');
            $('input[name="plan_price"]').parent().after('<span class="error_message">' + empty_field + '</span>');
        } else {
            var plan_price = velovalidation.checkAmount($('input[name="plan_price"]'));
            if (plan_price != true)
            {
                error = true;
                $('input[name="plan_price"]').addClass('error_field');
                $('input[name="plan_price"]').parent().after('<span class="error_message">' + invalid_price + '</span>');
            } else {
                $('input[name="plan_price"]').removeClass('error_field');
            }
//            else if ($('input[name="plan_price"]').val() == 0) {
//                error = true;
//                $('input[name="plan_price"]').addClass('error_field');
//                $('input[name="plan_price"]').parent().after('<span class="error_message">' + kb_numeric + '</span>');
//            }
        }


        var plan_duration = velovalidation.checkMandatory($('input[name="plan_duration"]'));
        if (plan_duration != true)
        {
            error = true;
            $('input[name="plan_duration"]').addClass('error_field');
            $('input[name="plan_duration"]').parent().append('<span class="error_message">' + empty_field + '</span>');
        } else {
            var plan_duration = velovalidation.isNumeric($('input[name="plan_duration"]'), true);
            if (plan_duration != true)
            {
                error = true;
                $('input[name="plan_duration"]').addClass('error_field');
                $('input[name="plan_duration"]').parent().append('<span class="error_message">' + kb_positive + '</span>');
            } else if ($('input[name="plan_duration"]').val() == 0) {
                error = true;
                $('input[name="plan_duration"]').addClass('error_field');
                $('input[name="plan_duration"]').parent().append('<span class="error_message">' + kb_numeric + '</span>');
            } else {
                $('input[name="plan_duration"]').removeClass('error_field');
            }
        }

        //

        if ($('#uploadedfile')[0].files !== undefined && $('#uploadedfile')[0].files.length > 0)
        {
            var files = $('#uploadedfile')[0].files[0];
            var file_mimetypes = [
                'image/gif',
                'image/jpeg',
                'image/png',
                'application/x-shockwave-flash',
                'image/psd',
                'image/bmp',
                'image/tiff',
                'application/octet-stream',
                'image/jp2',
                'image/iff',
                'image/vnd.wap.wbmp',
                'image/xbm',
                'image/vnd.microsoft.icon',
                'image/webp'
            ];

            var file_format = false;
            for (i = 0; i < file_mimetypes.length; i++) {
                if (files.type == file_mimetypes[i]) {
                    file_format = true;
                }
            }

            if (!file_format)
            {
                $('#uploadedfile').parent().parent().after('<span class="error_message">' + invalid_file_format_txt + '</span>');
                error = true;

            } else if (files.size > 8097152) {
                $('#uploadedfile').parent().parent().after('<span class="error_message">' + file_size_error_txt + '</span>');
                error = true;
            }
        }

        if (error) {
            return false;
        } else {
            /*Knowband button validation start*/
            $('button[name="submitAddkbmp_membership_plan"]').attr('disabled', 'disabled');
            $('#kbmp_membership_plan_form').submit();
            /*Knowband button validation end*/
        }

    });
});

