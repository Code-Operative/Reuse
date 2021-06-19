/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store.
 *
 * @author    knowband.com <support@knowband.com>
 * @copyright 2017 Knowband
 * @license   see file: LICENSE.txt
 * @category  PrestaShop Module
 */

$(document).ready(function() {

    $('button[name="submitAddKbCustomCustomer"]').click(function() {
        var error = false;
        $('.error_message1').remove();
        $('input[type=text]').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).attr('required')== 'required') {
                    var min = $(this).attr('minlength');
                    var max = $(this).attr('maxlength');
                    var input_mand = velovalidation.checkMandatory($(this), max, min);
                    if (input_mand != true) {
                        error = true;
                        $(this).addClass('error_field');
                        $(this).after('<p class="error_message1">' + input_mand + '</p>');
                    } else {
                        if (!$(this).hasClass('kbfielddatetime') && $(this).hasClass('hasDatepicker')) {
                            var date_valid = velovalidation.checkDateddmmyy($(this));
                            if (date_valid != true) {
                                $(this).addClass('error_field');
                                $(this).after('<p class="error_message1">' + date_valid + '</p>');
                            }
                        }
                    }
                } else {
                    var input_html = velovalidation.checkHtmlTags($(this));
                    if (input_html != true) {
                        error = true;
                        $(this).addClass('error_field');
                        $(this).after('<p class="error_message1">' + input_html + '</p>');
                    }
                }
            }
        });

        $('textarea').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).attr('required')== 'required') {
                    var min = $(this).attr('minlength');
                    var max = $(this).attr('maxlength');
                    var input_mand = velovalidation.checkMandatory($(this), max, min);
                    if (input_mand != true) {
                        error = true;
                        $(this).addClass('error_field');
                        $(this).after('<p class="error_message1">' + input_mand + '</p>');
                    }
                } else {
                    var input_html = velovalidation.checkHtmlTags($(this));
                    if (input_html != true) {
                        error = true;
                        $(this).addClass('error_field');
                        $(this).after('<p class="error_message1">' + input_html + '</p>');
                    }
                }
            }
        });

        $('input[type="radio"]').closest('.col-lg-9').each(function () {
            $(this).removeClass('error_field');
            if ($(this).find('input:radio').hasClass('kbfield')) {
                if ($(this).find('input:radio').attr('required')== 'required') {
                    if ($(this).find('input:radio:checked').length == 0) {
                        error = true;
                        $(this).addClass('error_field');
                        $(this).after('<p class="error_message1">' + field_not_empty + '</p>');
                    }
                }
            }
        });

        $('input[type="checkbox"]').closest('.col-lg-9').each(function () {
            $(this).removeClass('error_field');
            if ($(this).find('input:checkbox').hasClass('kbfield')) {
                if ($(this).find('input:checkbox').attr('required')== 'required') {
                    if ($(this).find('input:checkbox:checked').length == 0) {
                        error = true;
                        $(this).addClass('error_field');
                        $(this).after('<p class="error_message1">' + field_not_empty + '</p>');
                    }
                }
            }
        });

        $('input[type="file"]').each(function () {
            $(this).closest('.col-lg-4').find('.dummyfile').removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).attr('required') == 'required') {
                    if ($(this).prop('files').length == 0) {
                        error = true;
                        $(this).closest('.col-lg-4').find('.dummyfile').addClass('error_field');
                        $(this).closest('.col-lg-4').append('<p class="error_message1">' + file_not_empty + '</p>');
                    } else {
                        var extension_string = $(this).closest('.form-group').find('.file_extension').html();
                        var extension_arr = extension_string.replace(/[ ]/g, '').split(',');
                        var file_ext = $(this).val().trim().substring($(this).val().trim().lastIndexOf('.') + 1).toLowerCase();
                        if ($.inArray(file_ext, extension_arr) == -1) {
                            error = true;
                           $(this).closest('.col-lg-4').find('.dummyfile').addClass('error_field');
                            $(this).closest('.col-lg-4').append('<p class="error_message1">' + file_format_error + '</p>');
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    }
                } else {
                    if ($(this).prop('files').length != 0) {
                        var extension_string = $(this).closest('.form-group').find('.file_extension').html();
                        var extension_arr = extension_string.replace(/[ ]/g, '').split(',');
                        var file_ext = $(this).val().trim().substring($(this).val().trim().lastIndexOf('.') + 1).toLowerCase();
                        if ($.inArray(file_ext, extension_arr) == -1) {
                            error = true;
                            $(this).closest('.col-lg-4').find('.dummyfile').addClass('error_field');
                            $(this).closest('.col-lg-4').append('<p class="error_message1">' + file_format_error + '</p>');
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    }
                }
            }
        });


         if (error) {
            return false;
        } else {

            $('button[name="submitAddKbCustomCustomer"]').attr('disabled', 'disabled');
            $('#kb_custom_customer_form').append('<input type="hidden" name="submitAddKbCustomCustomer" value="1">');
            $('#kb_custom_customer_form').submit();
        }

    });


     $('button[name="configsubmitkbcustomfield"]').click(function () {
        var error = false;
        var css_error = velovalidation.checkHtmlTags($('textarea[name="kb_custom_field_css"]'));
        $('.error_message').remove();
        $('textarea[name="kb_custom_field_css"]').removeClass('error_field');
        if (css_error != true) {
            error = true;
            $('textarea[name="kb_custom_field_css"]').addClass('error_field');
            $('textarea[name="kb_custom_field_css"]').after('<span class="error_message">' + css_error + '</span>');
        }
        if (error) {
            return false;
        } else {
            /*Knowband button validation start*/
            $('button[name="configsubmitkbcustomfield"]').attr('disabled', 'disabled');
            $('#general_configuration_form').submit();
        }
//        /*Knowband button validation end*/
    });

    $('button[name="submitAddkb_custom_field_section"]').click(function () {
        var error = false;
        var is_error = 0;
        $('.error_message').remove();
        $('input[name^="label_"]').removeClass('error_field');
         $('select[name="placement"]').removeClass('error_field');
        $('input[name^="label_"]').each(function () {
            var label_error = velovalidation.checkMandatory($(this));
            if (label_error != true) {
                error = true;
                if (is_error < 1){
                    $(this).parents('.col-lg-4').append('<span class="error_message">' + label_error + ' ' + check_for_all + '</span>');
                    is_error++;
                }
                $(this).addClass('error_field');
            }
        });

        if ($('select[name="placement"]').val() == "") {
            error = true;
             $('select[name="placement"]').addClass('error_field');
              $('select[name="placement"]').after('<span class="error_message">' + no_select + '</span>');
        }

        if (error) {
            return false;
        } else {
            /*Knowband button validation start*/
            $('button[name="submitAddkb_custom_field_section"]').attr('disabled', 'disabled');
            $('#kb_custom_field_section_form').submit();
            /*Knowband button validation end*/
        }
    });


    $('button[name="submitAddkb_mp_custom_fields"]').click(function () {
        var is_error = 0;
        var is_error1 = 0;
        var is_error2 = 0;
        var is_error3 = 0;
        var is_error4 = 0;
        var is_error5 = 0;
        var is_error6 = 0;
        var is_error7 = 0;
        var error = false;
        $('.error_message').remove();
        $('input[name^="label_"]').removeClass('error_field');
        $('input[name^="description_"]').removeClass('error_field');
        $('input[name^="placeholder_"]').removeClass('error_field');
        $('input[name^="error_msg_"]').removeClass('error_field');
        $('input[name="field_name"]').removeClass('error_field');
        $('input[name="html_class"]').removeClass('error_field');
        $('input[name="html_id"]').removeClass('error_field');
        $('input[name="min_length"]').removeClass('error_field');
        $('input[name="max_length"]').removeClass('error_field');
        $('textarea[name^="value_"]').removeClass('error_field');
        $('input[name^="default_value_"]').removeClass('error_field');
        $('input[name="file_extension"]').removeClass('error_field');

        $('input[name^="label_"]').each(function () {
            var label_error = velovalidation.checkMandatory($(this));
            if (label_error != true) {
                error = true;
                if (is_error < 1) {
                    $(this).parents('.col-lg-4').append('<span class="error_message">' + label_error + ' ' + check_for_all + '</span>');
                    is_error++;
                }
                $(this).addClass('error_field');
            }
        });

        var desc_value = '';
        $('input[name^="description_"]').each(function () {
            if ($(this).val().trim() != '') {
                desc_value = 'hasValue';
            }
        });

        $('input[name^="description_"]').each(function () {
            var desc_error = velovalidation.checkHtmlTags($(this));
            if (desc_value == 'hasValue') {
                var desc_mand = velovalidation.checkMandatory($(this));
                if (desc_mand != true) {
                    error = true;
                     if (is_error1 < 1) {
                        $(this).parents('.col-lg-4').append('<span class="error_message">' + desc_mand + ' ' + check_for_all + '</span>');
                        is_error1++;
                    }
                    $(this).addClass('error_field');
                } else if (desc_error != true) {
                    error = true;
                     if (is_error2 < 1) {
                        $(this).parents('.col-lg-4').append('<span class="error_message">' + desc_error + ' ' + check_for_all + '</span>');
                        is_error2++;
                    }
                    $(this).addClass('error_field');
                }
            }
        });

        var place_value = '';
        $('input[name^="placeholder_"]').each(function () {
            if ($(this).val().trim() != '') {
                place_value = 'hasValue';
            }
        });
        $('input[name^="placeholder_"]').each(function () {
            var place_error = velovalidation.checkHtmlTags($(this));
            if (place_value == 'hasValue') {
                var place_mand = velovalidation.checkMandatory($(this));
                if (place_mand != true) {
                    error = true;
                     if (is_error3 < 1) {
                        $(this).parents('.col-lg-4').append('<span class="error_message">' + place_mand + ' ' + check_for_all + '</span>');
                        is_error3++;
                    }
                    $(this).addClass('error_field');
                } else if (place_error != true) {
                    error = true;
                    if (is_error < 7) {
                        $(this).parents('.col-lg-4').append('<span class="error_message">' + place_error + ' ' + check_for_all + '</span>');
                        is_error7++;
                    }
                    $(this).addClass('error_field');
                }
            }
        });

        var field_name_err = velovalidation.checkMandatory($('input[name="field_name"]'));
        if (field_name_err != true) {
            error = true;
            $('input[name="field_name"]').after('<span class="error_message">' + field_name_err + '</span>');
            $('input[name="field_name"]').addClass('error_field');
        }

        if ($('input[name^="error_msg_"]').parents('.form-group').is(":visible")) {
            var error_val = '';
            $('input[name^="error_msg_"]').each(function () {
                if ($(this).val().trim() != '') {
                    error_val = 'hasValue';
                }
            });
            $('input[name^="error_msg_"]').each(function () {
                  if (error_val == 'hasValue') {
                    var error_msg = velovalidation.checkMandatory($(this));
                    if (error_msg != true) {
                        error = true;
                        if (is_error4 < 1) {
                            $(this).parents('.col-lg-4').append('<span class="error_message">' + error_msg + ' ' + check_for_all + '</span>');
                            is_error4++;
                        }
                        $(this).addClass('error_field');
                    }
                }
            });
        }
        var html_id_err = velovalidation.checkMandatory($('input[name="html_id"]'));
        if (html_id_err != true) {
            error = true;
            $('input[name="html_id"]').after('<span class="error_message">' + html_id_err + '</span>');
            $('input[name="html_id"]').addClass('error_field');
        }
        var html_class_err = velovalidation.checkMandatory($('input[name="html_class"]'));
        if (html_class_err != true) {
            error = true;
            $('input[name="html_class"]').after('<span class="error_message">' + html_class_err + '</span>');
            $('input[name="html_class"]').addClass('error_field');
        }
        if ($('input[name="min_length"]').is(":visible")) {
            if ($('input[name="min_length"]').val() != "") {
                var max = parseInt($('input[name="max_length"]').val().trim());
                var min = parseInt($('input[name="min_length"]').val().trim());
                 var is_numberic_min = velovalidation.isNumeric($('input[name="min_length"]'));
                if (is_numberic_min != true) {
                    error = true;
                    $('input[name="min_length"]').addClass('error_field');
                    $('input[name="min_length"]').after('<span class="error_message">' + is_numberic_min + '</span>');
                }
            }
        }
        if ($('input[name="max_length"]').is(":visible")) {
            if ($('input[name="max_length"]').val() != '') {
                var max = parseInt($('input[name="max_length"]').val().trim());
                var min = parseInt($('input[name="min_length"]').val().trim());
                 var is_numberic_max = velovalidation.isNumeric($('input[name="max_length"]'));
                if (is_numberic_max != true) {
                    error = true;
                    $('input[name="max_length"]').addClass('error_field');
                    $('input[name="max_length"]').after('<span class="error_message">' + is_numberic_max + '</span>');
                }  else {
                    if (max >= 0) {
                        if (max <= min) {
                            error = true;
                            $('input[name="max_length"]').addClass('error_field');
                            $('input[name="max_length"]').after('<span class="error_message">' + maximum_length_excced + '</span>');
                        }
                    }
                }
            }
        }

        value_valu = '';
        if (($('.kb_custom_field_form input[name="type"]').val() == 'select') ||
            ($('.kb_custom_field_form input[name="type"]').val() == 'checkbox') ||
            ($('.kb_custom_field_form input[name="type"]').val() == 'radio')) {
            if ($('textarea[name^="value_"]').parents('.form-group').is(":visible")) {
                $('textarea[name^="value_"]').each(function () {
                    if ($(this).val().trim() != '') {
                        value_valu = 'hasValue';
                    }
                });
                $('textarea[name^="value_"]').each(function () {
//                if (value_valu == 'hasValue') {
                    var value_err = velovalidation.checkMandatory($(this));
                    if (value_err != true) {
                        error = true;
                        if (is_error5 < 1) {
                            $(this).parents('.col-lg-5').append('<span class="error_message">' + value_err + ' ' + check_for_all + '</span>');
                            is_error5++;
                        }
                        $(this).addClass('error_field');
                    }
//                }
                });
            }
        }


        var default_value = '';
        if (($('.kb_custom_field_form input[name="type"]').val() == 'select') ||
            ($('.kb_custom_field_form input[name="type"]').val() == 'checkbox') ||
            ($('.kb_custom_field_form input[name="type"]').val() == 'radio')) {
        if ($('input[name^="default_value_"]').parents('.form-group').is(":visible")) {
            $('input[name^="default_value_"]').each(function () {
                if ($(this).val().trim() != '') {
                    default_value = 'hasValue';
                }
            });
            $('input[name^="default_value_"]').each(function () {
                if (default_value == 'hasValue') {
                    var default_err = velovalidation.checkMandatory($(this));
                    if (default_err != true) {
                        error = true;
                         if (is_error6 < 1) {
                            $(this).parents('.col-lg-5').append('<span class="error_message">' + default_err + ' ' + check_for_all + '</span>');
                            is_error6++;
                        }
                        $(this).addClass('error_field');
                    }
                }
            });
        }
    }


        if ($('input[name="file_extension"]').parents('.form-group').is(":visible")) {
            var ext_mand = velovalidation.checkMandatory($('input[name="file_extension"]'));
            var ext_comma = velovalidation.checkCommaSeparateValue($('input[name="file_extension"]'));
            if (ext_mand != true) {
                error = true;
                $('input[name="file_extension"]').after('<span class="error_message">' + ext_mand + '</span>');
                $('input[name="file_extension"]').addClass('error_field');
            } else {
                if (ext_comma != true) {
                    error = true;
                    $('input[name="file_extension"]').after('<span class="error_message">' + ext_comma + '</span>');
                    $('input[name="file_extension"]').addClass('error_field');
                }
            }
        }




         if (error) {
            return false;
        } else {
            /*Knowband button validation start*/
            $('button[name="submitAddkb_mp_custom_fields"]').attr('disabled', 'disabled');
            $('#kb_mp_add_custom_field').submit();
            /*Knowband button validation end*/
        }
    });

});