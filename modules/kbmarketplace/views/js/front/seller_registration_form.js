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
var validation_fields = {
    'isGenericName': /^[^<>={}]*$/,
    'isAddress': /^[^!<>?=+@{}_$%]*$/,
    'isPhoneNumber': /^[+0-9. ()-]*$/,
    'isInt': /^[0-9]*$/,
    'isIntExcludeZero': /^[1-9]*$/,
    'isPrice': /^[0-9]*(?:\.\d{1,6})?$/,
    'isPriceExcludeZero': /^[1-9]*(?:\.\d{1,6})?$/,
    'isDate': /^([0-9]{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/,
    'isUrl': /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi,
    'isEmail': /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
};

function validate_isName(s)
{
    var reg = /^[^0-9!<>,;?=+()@#"Â°{}_$%:]+$/;
    return reg.test(s);
}

function validate_isGenericName(s)
{
    var reg = /^[^<>={}]+$/;
    return reg.test(s);
}

function validate_isAddress(s)
{
    var reg = /^[^!<>?=+@{}_$%]+$/;
    return reg.test(s);
}

function validate_isPostCode(s, pattern, iso_code)
{
    if (typeof iso_code === 'undefined' || iso_code == '')
        iso_code = '[A-Z]{2}';
    if (typeof (pattern) == 'undefined' || pattern.length == 0)
        pattern = '[a-zA-Z 0-9-]+';
    else
    {
        var replacements = {
            ' ': '(?:\ |)',
            '-': '(?:-|)',
            'N': '[0-9]',
            'L': '[a-zA-Z]',
            'C': iso_code
        };

        for (var new_value in replacements)
            pattern = pattern.split(new_value).join(replacements[new_value]);
    }
    var reg = new RegExp('^' + pattern + '$');
    return reg.test(s);
}

function validate_isMessage(s)
{
    var reg = /^[^<>{}]+$/;
    return reg.test(s);
}

function validate_isPhoneNumber(s)
{
    var reg = /^[+0-9. ()-]+$/;
    return reg.test(s);
}

function validate_isDniLite(s)
{
    var reg = /^[0-9a-z-.]{1,16}$/i;
    return reg.test(s);
}

function validate_isCityName(s)
{
    var reg = /^[^!<>;?=+@#"Â°{}_$%]+$/;
    return reg.test(s);
}

function validate_isEmail(s)
{
    var reg = unicode_hack(/^[a-z\p{L}0-9!#$%&'*+\/=?^`{}|~_-]+[.a-z\p{L}0-9!#$%&'*+\/=?^`{}|~_-]*@[a-z\p{L}0-9]+[._a-z\p{L}0-9-]*\.[a-z\p{L}0-9]+$/i, false);
    return reg.test(s);
}

function validate_isPasswd(s)
{
    return (s.length >= 5 && s.length < 255);
}

function kbValidateField(element)
{
//    console.log(element.attr('data-validate'));
    if (element.attr('data-validate') == 'isName') {
        return validate_isName(element.val());
    } else if (element.attr('data-validate') == 'isGenericName') {
        return validate_isGenericName(element.val());
    } else if (element.attr('data-validate') == 'isAddress') {
        return validate_isAddress(element.val());
    } else if (element.attr('data-validate') == 'isPostCode') {
        return validate_isPostCode(element.val());
    } else if (element.attr('data-validate') == 'isCityName') {
        return validate_isCityName(element.val());
    } else if (element.attr('data-validate') == 'isMessage') {
        return validate_isMessage(element.val());
    } else if (element.attr('data-validate') == 'isPhoneNumber') {
        return validate_isPhoneNumber(element.val());
    } else if (element.attr('data-validate') == 'isDniLite') {
        return validate_isDniLite(element.val());
    } else if (element.attr('data-validate') == 'isEmail') {
        return validate_isEmail(element.val());
    } else if (element.attr('data-validate') == 'isPasswd') {
        return validate_isPasswd(element.val());
    }
}

var fd = new FormData();
$(document).ready(function () {
    if ($('input[name="password"]').length && $('.kb_custom_field_block').length) {
        $('input[name="password"]').closest('.form-group').after($('.kb_custom_field_block'));
        $('input[name="kbmp_registered_as_seller"]').attr('required', '');
    }
    if (typeof kb_empty_field != 'undefined') {
        velovalidation.setErrorLanguage({
            empty_field: kb_empty_field,
            number_field: kb_number_field,
            positive_number: kb_positive_number,
            maxchar_field: kb_maxchar_field,
            minchar_field: kb_minchar_field,
            empty_email: kb_empty_email,
            validate_email: kb_validate_email,
            max_email: kb_max_email,
            script: kb_script,
            style: kb_style,
            iframe: kb_iframe,
            html_tags: kb_html_tags,
            invalid_date: kb_invalid_date,
        });
    }

    $('.kbfielddate').datepicker(
        {dateFormat: 'dd/mm/yy'}
    );
    $('.kbfielddate').on('keypress keydown keyup', function (e) {
        e.preventDefault();
        return false;
    });
    $('.kbfielddatetime').on('keypress keydown keyup', function (e) {
        e.preventDefault();
        return false;
    });

    $('#authentication button[data-link-action="save-customer"]').click(function () {
        var error = false;
        $('.error_message1').remove();
        $('input[type=text]').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).hasClass('is_required')) {
                    var min = $(this).attr('minlength');
                    var max = $(this).attr('maxlength');
                    var input_mand = velovalidation.checkMandatory($(this), max, min);
                    if (input_mand != true) {
                        error = true;
                        $(this).addClass('error_field');
                        if ($(this).closest('.form-group').find('.error_message').length) {
                            $(this).closest('.form-group').find('.error_message').show();
                        } else {
                            $(this).after('<p class="error_message1">' + input_mand + '</p>');

                        }
                    } else {
                        if ($(this).attr('data-validate')) {
                            if (!kbValidateField($(this))) {
                                error = true;
                                $(this).addClass('error_field');
                                if ($(this).closest('.form-group').find('.error_message').length) {
                                    $(this).closest('.form-group').find('.error_message').show();
                                } else {
                                    $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
                                }
                            } else {
                                $(this).closest('.form-group').find('.error_message').hide();
                            }
                        } else if (!$(this).hasClass('kbfielddatetime') && $(this).hasClass('hasDatepicker')) {
                            var date_valid = velovalidation.checkDateddmmyy($(this));
                            if (date_valid != true) {
                                $(this).addClass('error_field');
                                if ($(this).closest('.form-group').find('.error_message').length) {
                                    $(this).closest('.form-group').find('.error_message').show();
                                } else {
                                    $(this).after('<p class="error_message1">' + date_valid + '</p>');
                                }
                            } else {
                                $(this).closest('.form-group').find('.error_message').hide();
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    }
                } else {
                    if ($(this).attr('data-validate')) {
                        if (!kbValidateField($(this))) {
                            error = true;
                            $(this).addClass('error_field');
                            if ($(this).closest('.form-group').find('.error_message').length) {
                                $(this).closest('.form-group').find('.error_message').show();
                            } else {
                                $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    } else {
                        $(this).closest('.form-group').find('.error_message').hide();
                    }
                }
            }
        });



        $('textarea').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).hasClass('is_required')) {
                    var min = $(this).attr('minlength');
                    var max = $(this).attr('maxlength');
                    var input_mand = velovalidation.checkMandatory($(this), max, min);
                    if (input_mand != true) {
                        error = true;
                        $(this).addClass('error_field');
                        if ($(this).closest('.form-group').find('.error_message').length) {
                            $(this).closest('.form-group').find('.error_message').show();
                        } else {
                            $(this).after('<p class="error_message1">' + input_mand + '</p>');

                        }
                    } else {
                        if ($(this).attr('data-validate')) {
                            if (!kbValidateField($(this))) {
                                error = true;
                                $(this).addClass('error_field');
                                if ($(this).closest('.form-group').find('.error_message').length) {
                                    $(this).closest('.form-group').find('.error_message').show();
                                } else {
                                    $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
                                }
                            } else {
                                $(this).closest('.form-group').find('.error_message').hide();
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    }
                } else {
                    if ($(this).attr('data-validate')) {
                        if (!kbValidateField($(this))) {
                            error = true;
                            $(this).addClass('error_field');
                            if ($(this).closest('.form-group').find('.error_message').length) {
                                $(this).closest('.form-group').find('.error_message').show();
                            } else {
//                                if (is_error2 < 1) {
                                $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
//                                    is_error2++;
//                                }
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    } else {
                        $(this).closest('.form-group').find('.error_message').hide();
                    }
                }
            }
        });

        $('select').closest('.col-md-6').each(function () {
            $(this).find('select').removeClass('error_field');
            if ($(this).find('select').hasClass('kbfield')) {
                if ($(this).find('select').hasClass('is_required')) {
                    if ($(this).find('select').val() == null) {
                        error = true;
                        $(this).find('select').addClass('error_field');
                        $(this).find('select').after('<span class="error_message1">' + field_not_empty + '</span>');
                    }
                }
            }
        });

        $('input[type="radio"]').closest('.col-md-6').each(function () {
            $(this).removeClass('error_field');
            $(this).find('.radio_kb_validate').removeAttr('style');
            if ($(this).find('input:radio').hasClass('kbfield')) {
                if ($(this).find('input:radio').hasClass('is_required')) {
                    if ($(this).find('input:radio:checked').length == 0) {
                        error = true;
                        $(this).find('.radio_kb_validate').attr('style', 'border: 1px solid red;margin-bottom: 10px;padding: 5px;');
                        $(this).append('<span class="error_message1">' + field_not_empty + '</span>');
                    }
                }
            }
        });
        $('input[type="checkbox"]').closest('.col-md-6').each(function () {
            $(this).removeClass('error_field');
            $(this).find('.checkbox_kb_validate').removeAttr('style');
            if ($(this).find('input:checkbox').hasClass('kbfield')) {
                if ($(this).find('input:checkbox').hasClass('is_required')) {
                    if ($(this).find('input:checkbox:checked').length == 0) {
                        error = true;
                        $(this).find('.checkbox_kb_validate').attr('style', 'border: 1px solid red;margin-bottom: 10px;padding: 5px;');
                        $(this).append('<span class="error_message1">' + field_not_empty + '</span>');
                    }
                }
            }
        });

        $('input[type="file"]').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).hasClass('is_required')) {
                    if ($(this).prop('files').length == 0) {
                        error = true;
                        $(this).addClass('error_field');
                        if ($(this).closest('.form-group').find('.error_message').length) {
                            $(this).closest('.form-group').find('.error_message').show();
                        } else {
                            $(this).after('<p class="error_message1">' + file_not_empty + '</p>');
                        }
                    } else {
                        var extension_string = $(this).closest('.form-group').find('.file_extension').html();
                        var extension_arr = extension_string.replace(/[ ]/g, '').split(',');
                        var file_ext = $(this).val().trim().substring($(this).val().trim().lastIndexOf('.') + 1).toLowerCase();
                        if ($.inArray(file_ext, extension_arr) == -1) {
                            error = true;
                            $(this).addClass('error_field');
                            if ($(this).closest('.form-group').find('.error_message').length) {
                                $(this).closest('.form-group').find('.error_message').show();
                            } else {
                                if ($(this).closest('.form-group').find('.uploader').length) {
                                    $(this).closest('.uploader').after('<p class="error_message1">' + file_format_error + '</p>');
                                } else {
                                    $(this).after('<p class="error_message1">' + file_format_error + '</p>');
                                }

                            }
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
                            $(this).addClass('error_field');
                            if ($(this).closest('.form-group').find('.error_message').length) {
                                $(this).closest('.form-group').find('.error_message').show();
                            } else {
                                if ($(this).closest('.form-group').find('.uploader').length) {
                                    $(this).closest('.uploader').after('<p class="error_message1">' + file_format_error + '</p>');
                                } else {
                                    $(this).after('<p class="error_message1">' + file_format_error + '</p>');
                                }

                            }
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
            $('#account-creation_form').append('<input type="hidden" name="submitAccount" value="1"/>');
            /*Knowband button validation start*/
            $('button[name="submitAccount"]').attr('disabled', 'disabled');
            $('#account-creation_form').submit();
            /*Knowband button validation end*/
        }

    });
//    if(typeof submit_account_btn != 'undefined') {
//        $('#authentication').bind("DOMSubtreeModified", function () {
//            $('#account-creation_form').attr('enctype', 'multipart/form-data');
//
//
//        });


//    }


    $('#customer-form').attr('enctype', 'multipart/form-data');
    $('#identity button[data-link-action="save-customer"]').on('click', function () {
        var error = false;
        $('.error_message1').remove();
        $('input[type=text]').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).hasClass('is_required')) {
                    var min = $(this).attr('minlength');
                    var max = $(this).attr('maxlength');
                    var input_mand = velovalidation.checkMandatory($(this), max, min);
                    if (input_mand != true) {
                        error = true;
                        $(this).addClass('error_field');
                        if ($(this).closest('.form-group').find('.error_message').length) {
                            $(this).closest('.form-group').find('.error_message').show();
                        } else {
                            $(this).after('<p class="error_message1">' + input_mand + '</p>');

                        }
                    } else {
                        if ($(this).attr('data-validate')) {
                            if (!kbValidateField($(this))) {
                                error = true;
                                $(this).addClass('error_field');
                                if ($(this).closest('.form-group').find('.error_message').length) {
                                    $(this).closest('.form-group').find('.error_message').show();
                                } else {
                                    $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
                                }
                            } else {
                                $(this).closest('.form-group').find('.error_message').hide();
                            }
                        } else if (!$(this).hasClass('kbfielddatetime') && $(this).hasClass('hasDatepicker')) {
                            var date_valid = velovalidation.checkDateddmmyy($(this));
                            if (date_valid != true) {
                                $(this).addClass('error_field');
                                if ($(this).closest('.form-group').find('.error_message').length) {
                                    $(this).closest('.form-group').find('.error_message').show();
                                } else {
                                    $(this).after('<p class="error_message1">' + date_valid + '</p>');
                                }
                            } else {
                                $(this).closest('.form-group').find('.error_message').hide();
                            }
                        }
                    }
                } else {
                    if ($(this).attr('data-validate')) {
                        if (!kbValidateField($(this))) {
                            error = true;
                            $(this).addClass('error_field');
                            if ($(this).closest('.form-group').find('.error_message').length) {
                                $(this).closest('.form-group').find('.error_message').show();
                            } else {
//                                if (is_error2 < 1) {
                                $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
//                                    is_error2++;
//                                }
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    } else {
                        $(this).closest('.form-group').find('.error_message').hide();
                    }
                }
            }
        });

        $('textarea').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).hasClass('is_required')) {
                    var min = $(this).attr('minlength');
                    var max = $(this).attr('maxlength');
                    var input_mand = velovalidation.checkMandatory($(this), max, min);
                    if (input_mand != true) {
                        error = true;
                        $(this).addClass('error_field');
                        if ($(this).closest('.form-group').find('.error_message').length) {
                            $(this).closest('.form-group').find('.error_message').show();
                        } else {
                            $(this).after('<p class="error_message1">' + input_mand + '</p>');

                        }
                    } else {
                        if ($(this).attr('data-validate')) {
                            if (!kbValidateField($(this))) {
                                error = true;
                                $(this).addClass('error_field');
                                if ($(this).closest('.form-group').find('.error_message').length) {
                                    $(this).closest('.form-group').find('.error_message').show();
                                } else {
                                    $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
                                }
                            } else {
                                $(this).closest('.form-group').find('.error_message').hide();
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    }
                } else {
                    if ($(this).attr('data-validate')) {
                        if (!kbValidateField($(this))) {
                            error = true;
                            $(this).addClass('error_field');
                            if ($(this).closest('.form-group').find('.error_message').length) {
                                $(this).closest('.form-group').find('.error_message').show();
                            } else {
//                                if (is_error2 < 1) {
                                $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
//                                    is_error2++;
//                                }
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    } else {
                        $(this).closest('.form-group').find('.error_message').hide();
                    }
                }
            }
        });

        $('select').closest('.col-md-6').each(function () {
            $(this).find('select').removeClass('error_field');
            if ($(this).find('select').hasClass('kbfield')) {
                if ($(this).find('select').hasClass('is_required')) {
                    if ($(this).find('select').val() == null) {
                        error = true;
                        $(this).find('select').addClass('error_field');
                        $(this).find('select').after('<span class="error_message1">' + field_not_empty + '</span>');
                    }
                }
            }
        });

        $('input[type="radio"]').closest('.col-md-6').each(function () {
            $(this).removeClass('error_field');
            if ($(this).find('input:radio').hasClass('kbfield')) {
                if ($(this).find('input:radio').hasClass('required')) {
                    if ($(this).find('input:radio:checked').length == 0) {
                        error = true;
//                        $(this).addClass('error_field');
                        $(this).append('<span class="error_message1">' + field_not_empty + '</span>');
                    }
                }
            }
        });

        $('input[type="checkbox"]').closest('.col-md-6').each(function () {
            $(this).removeClass('error_field');
            $(this).find('.checkbox_kb_validate').removeAttr('style');
            if ($(this).find('input:checkbox').hasClass('kbfield')) {
                if ($(this).find('input:checkbox').hasClass('is_required')) {
                    if ($(this).find('input:checkbox:checked').length == 0) {
                        error = true;
                        $(this).find('.checkbox_kb_validate').attr('style', 'border: 1px solid red;margin-bottom: 10px;padding: 5px;');
                        $(this).append('<span class="error_message1">' + field_not_empty + '</span>');
                    }
                }
            }
        });


        $('input[type="file"]').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).hasClass('is_required')) {
                    if ($(this).prop('files').length == 0) {
                        error = true;
                        $(this).addClass('error_field');
                        if ($(this).closest('.form-group').find('.error_message').length) {
                            $(this).closest('.form-group').find('.error_message').show();
                        } else {
                            if ($(this).closest('.form-group').find('.uploader').length) {
                                $(this).closest('.uploader').after('<p class="error_message1">' + file_not_empty + '</p>');
                            } else {
                                $(this).after('<p class="error_message1">' + file_not_empty + '</p>');
                            }

                        }
                    } else {
                        var extension_string = $(this).closest('.form-group').find('.file_extension').html();
                        var extension_arr = extension_string.replace(/[ ]/g, '').split(',');
                        var file_ext = $(this).val().trim().substring($(this).val().trim().lastIndexOf('.') + 1).toLowerCase();
                        if ($.inArray(file_ext, extension_arr) == -1) {
                            error = true;
                            $(this).addClass('error_field');
                            if ($(this).closest('.form-group').find('.error_message').length) {
                                $(this).closest('.form-group').find('.error_message').show();
                            } else {
                                if ($(this).closest('.form-group').find('.uploader').length) {
                                    $(this).closest('.uploader').after('<p class="error_message1">' + file_format_error + '</p>');
                                } else {
                                    $(this).after('<p class="error_message1">' + file_format_error + '</p>');
                                }

                            }
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
                            $(this).addClass('error_field');
                            if ($(this).closest('.form-group').find('.error_message').length) {
                                $(this).closest('.form-group').find('.error_message').show();
                            } else {
                                if ($(this).closest('.form-group').find('.uploader').length) {
                                    $(this).closest('.uploader').after('<p class="error_message1">' + file_format_error + '</p>');
                                } else {
                                    $(this).after('<p class="error_message1">' + file_format_error + '</p>');
                                }

                            }
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

            $('input[type="file"]').each(function () {
                if ($(this).hasClass('kbfiletype')) {
                    if ($(this).prop('files').length != 0) {
                        fd.append($(this).attr('name'), $(this)[0].files[0]);
                        upload($(this));
                    }
                }
            });

            $.ajax({
                type: "POST",
                data: 'customer_identity_submit=true&ajax=true&' + $(this).parents('form').serialize(),
                url: kb_front_controller,
                success: function (res) {

                },
                complete: function () {

                }
            });
        }

    });

    $('button[name="submitKbAdditional"]').on('click', function () {
        var error = false;
        $('.error_message1').remove();
        $('input[type=text]').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).hasClass('is_required')) {
                    var min = $(this).attr('minlength');
                    var max = $(this).attr('maxlength');
                    var input_mand = velovalidation.checkMandatory($(this), max, min);
                    if (input_mand != true) {
                        error = true;
                        $(this).addClass('error_field');
                        if ($(this).closest('.form-group').find('.error_message').length) {
                            $(this).closest('.form-group').find('.error_message').show();
                        } else {
                            $(this).after('<p class="error_message1">' + input_mand + '</p>');

                        }
                    } else {
                        if ($(this).attr('data-validate')) {
                            if (!kbValidateField($(this))) {
                                error = true;
                                $(this).addClass('error_field');
                                if ($(this).closest('.form-group').find('.error_message').length) {
                                    $(this).closest('.form-group').find('.error_message').show();
                                } else {
                                    $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
                                }
                            } else {
                                $(this).closest('.form-group').find('.error_message').hide();
                            }
                        } else if (!$(this).hasClass('kbfielddatetime') && $(this).hasClass('hasDatepicker')) {
                            var date_valid = velovalidation.checkDateddmmyy($(this));
                            if (date_valid != true) {
                                $(this).addClass('error_field');
                                if ($(this).closest('.form-group').find('.error_message').length) {
                                    $(this).closest('.form-group').find('.error_message').show();
                                } else {
                                    $(this).after('<p class="error_message1">' + date_valid + '</p>');
                                }
                            } else {
                                $(this).closest('.form-group').find('.error_message').hide();
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    }
                } else {
                    if ($(this).attr('data-validate')) {
                        if (!kbValidateField($(this))) {
                            error = true;
                            $(this).addClass('error_field');
                            if ($(this).closest('.form-group').find('.error_message').length) {
                                $(this).closest('.form-group').find('.error_message').show();
                            } else {
//                                if (is_error2 < 1) {
                                $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
//                                    is_error2++;
//                                }
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    } else {
                        $(this).closest('.form-group').find('.error_message').hide();
                    }
                }
            }
        });

        $('textarea').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).hasClass('is_required')) {
                    var min = $(this).attr('minlength');
                    var max = $(this).attr('maxlength');
                    var input_mand = velovalidation.checkMandatory($(this), max, min);
                    if (input_mand != true) {
                        error = true;
                        $(this).addClass('error_field');
                        if ($(this).closest('.form-group').find('.error_message').length) {
                            $(this).closest('.form-group').find('.error_message').show();
                        } else {
                            $(this).after('<p class="error_message1">' + input_mand + '</p>');

                        }
                    } else {
                        if ($(this).attr('data-validate')) {
                            if (!kbValidateField($(this))) {
                                error = true;
                                $(this).addClass('error_field');
                                if ($(this).closest('.form-group').find('.error_message').length) {
                                    $(this).closest('.form-group').find('.error_message').show();
                                } else {
                                    $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
                                }
                            } else {
                                $(this).closest('.form-group').find('.error_message').hide();
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    }
                } else {
                    if ($(this).attr('data-validate')) {
                        if (!kbValidateField($(this))) {
                            error = true;
                            $(this).addClass('error_field');
                            if ($(this).closest('.form-group').find('.error_message').length) {
                                $(this).closest('.form-group').find('.error_message').show();
                            } else {
//                                if (is_error2 < 1) {
                                $(this).after('<p class="error_message1">' + kb_not_valid + '</p>');
//                                    is_error2++;
//                                }
                            }
                        } else {
                            $(this).closest('.form-group').find('.error_message').hide();
                        }
                    } else {
                        $(this).closest('.form-group').find('.error_message').hide();
                    }
                }
            }
        });

        $('input[type="radio"]').closest('.col-md-6').each(function () {
            $(this).removeClass('error_field');
            $(this).find('.radio_kb_validate').removeAttr('style');
            if ($(this).find('input:radio').hasClass('kbfield')) {
                if ($(this).find('input:radio').hasClass('is_required')) {
                    if ($(this).find('input:radio:checked').length == 0) {
                        error = true;
                        $(this).find('.radio_kb_validate').attr('style', 'border: 1px solid red;margin-bottom: 10px;padding: 5px;');
                        $(this).append('<span class="error_message1">' + field_not_empty + '</span>');
                    }
                }
            }
        });

        $('select').closest('.col-md-6').each(function () {
            $(this).find('select').removeClass('error_field');
            if ($(this).find('select').hasClass('kbfield')) {
                if ($(this).find('select').hasClass('is_required')) {
                    if ($(this).find('select').val() == null) {
                        error = true;
                        $(this).find('select').addClass('error_field');
                        $(this).find('select').after('<span class="error_message1">' + field_not_empty + '</span>');
                    }
                }
            }
        });

        $('input[type="checkbox"]').closest('.col-md-6').each(function () {
            $(this).removeClass('error_field');
            $(this).find('.checkbox_kb_validate').removeAttr('style');
            if ($(this).find('input:checkbox').hasClass('kbfield')) {
                if ($(this).find('input:checkbox').hasClass('is_required')) {
                    if ($(this).find('input:checkbox:checked').length == 0) {
                        error = true;
                        $(this).find('.checkbox_kb_validate').attr('style', 'border: 1px solid red;margin-bottom: 10px;padding: 5px;');
                        $(this).append('<span class="error_message1">' + field_not_empty + '</span>');
                    }
                }
            }
        });

        $('input[type="file"]').each(function () {
            $(this).removeClass('error_field');
            if ($(this).hasClass('kbfield')) {
                if ($(this).hasClass('is_required')) {
                    if ($(this).prop('files').length == 0) {
                        error = true;
                        $(this).addClass('error_field');
                        if ($(this).closest('.form-group').find('.error_message').length) {
                            $(this).closest('.form-group').find('.error_message').show();
                        } else {
                            if ($(this).closest('.form-group').find('.uploader').length) {
                                $(this).closest('.uploader').after('<p class="error_message1">' + file_not_empty + '</p>');
                            } else {
                                $(this).after('<p class="error_message1">' + file_not_empty + '</p>');
                            }

                        }
                    } else {
                        $(this).closest('.form-group').find('.error_message').hide();
                    }
                }
            }
        });
        if (error) {
            return false;
        } else {

        }

    });

//    $("select.form-control,input[type='radio'],input[type='checkbox']").not(".not_uniform").uniform();
});

function upload(element) {
//		alert(fd);
    $.ajax({
        url: kb_front_controller + '?uploadKbFile=true&ajax=true&email=' + $('input[name="email"]').val().trim(),
        type: 'post',
        data: fd,
        processData: false,
        contentType: false,
        success: function (msg) {
//
        }
    });
}

$(window).load(function () {
    $('input[type="checkbox"]').closest('.checkbox').find('.disabled').removeClass('disabled');
    $('input[type="radio"]').closest('.radio-inline').find('.disabled').removeClass('disabled');
});