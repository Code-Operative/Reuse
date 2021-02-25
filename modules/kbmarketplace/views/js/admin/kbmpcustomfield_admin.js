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
    }
}
$(document).ready(function() {

    $('select[name="validation"]').change(function(){
        if (($('select[name="validation"]').val() == 'isEmail') && ($('select[name="type"]').val() == 'text')) {
             $('input[name="min_length"]').closest('.form-group').hide();
             $('input[name="max_length"]').closest('.form-group').hide();
        } else if (($('select[name="validation"]').val() != 'isEmail') && ($('select[name="type"]').val() == 'text')) {
             $('input[name="min_length"]').closest('.form-group').show();
             $('input[name="max_length"]').closest('.form-group').show();
        }
    });

    $('.kb_custom_field_type').append($('select[name="type"]').parents('.form-group'));

    $('select[name="type"]').change(function() {
        var selected_type = $('select[name="type"]').val();
        $('.kb_custom_field_form input[name="type"]').val(selected_type);
        if (selected_type == '') {
            $('.kb_custom_field_form').hide();
        } else if (selected_type == "text") {
            $('.kb_custom_field_form').show();
            $('input[name^="label_"]').parents('.form-group').show();
            $('input[name="show_on_invoice"]').closest('.form-group').show();
            $('input[name^="description_"]').parents('.form-group').show();
            $('input[name^="placeholder_"]').parents('.form-group').show();
            $('input[name^="error_msg_"]').parents('.form-group').show();
            $('input[name="validation"]').closest('.form-group').show();
            $('input[name="min_length"]').closest('.form-group').show();
            $('input[name="max_length"]').closest('.form-group').show();
            $('input[name="multiselect"]').closest('.form-group').hide();
            if ($('textarea[name^="value_"]').closest('.form-group').hasClass('translatable-field')) {
                $('textarea[name^="value_"]').parents('.form-group').parents('.form-group').hide();
            } else {
                $('textarea[name^="value_"]').parents('.form-group').hide();
            }
            $('input[name^="default_value_"]').parents('.form-group').hide();
            if (($('select[name="validation"]').val() != 'isEmail')) {
                $('input[name="min_length"]').closest('.form-group').show();
                $('input[name="max_length"]').closest('.form-group').show();
            } else {
                $('input[name="min_length"]').closest('.form-group').hide();
                $('input[name="max_length"]').closest('.form-group').hide();
            }
            $('input[name="file_extension"]').closest('.form-group').hide();
            $('input[name="allow_multifile"]').closest('.form-group').hide();
            $('input[name="show_text_editor"]').closest('.form-group').hide();
            $('input[name="editable"]').closest('.form-group').hide();
        } else if (selected_type == "select") {
            $('.kb_custom_field_form').show();
            $('input[name="multiselect"]').closest('.form-group').show();
            $('input[name="show_on_invoice"]').closest('.form-group').show();
            if ($('textarea[name^="value_"]').closest('.form-group').hasClass('translatable-field')) {
                $('textarea[name^="value_"]').parents('.form-group').parents('.form-group').show();
            } else {
                $('textarea[name^="value_"]').parents('.form-group').show();
            }

            $('input[name^="default_value_"]').parents('.form-group').show();
            $('input[name^="placeholder_"]').parents('.form-group').hide();
            $('select[name="validation"]').closest('.form-group').hide();
            $('input[name^="error_msg_"]').parents('.form-group').hide();
            $('input[name="min_length"]').closest('.form-group').hide();
            $('input[name="max_length"]').closest('.form-group').hide();
            $('input[name="file_extension"]').closest('.form-group').hide();
            $('input[name="allow_multifile"]').closest('.form-group').hide();
            $('input[name="show_text_editor"]').closest('.form-group').hide();
            $('input[name="editable"]').closest('.form-group').hide();
        } else if (selected_type == "radio") {
            $('.kb_custom_field_form').show();
            if ($('textarea[name^="value_"]').closest('.form-group').hasClass('translatable-field')) {
                $('textarea[name^="value_"]').parents('.form-group').parents('.form-group').show();
            } else {
                $('textarea[name^="value_"]').parents('.form-group').show();
            }
            $('input[name^="default_value_"]').parents('.form-group').show();
            $('input[name="show_on_invoice"]').closest('.form-group').show();
            $('input[name^="placeholder_"]').parents('.form-group').hide();
            $('select[name="validation"]').closest('.form-group').hide();
            $('input[name^="error_msg_"]').parents('.form-group').hide();
            $('input[name="multiselect"]').closest('.form-group').hide();
            $('input[name="min_length"]').closest('.form-group').hide();
            $('input[name="max_length"]').closest('.form-group').hide();
            $('input[name="file_extension"]').closest('.form-group').hide();
            $('input[name="allow_multifile"]').closest('.form-group').hide();
            $('input[name="show_text_editor"]').closest('.form-group').hide();
            $('input[name="editable"]').closest('.form-group').hide();
        } else if (selected_type == "checkbox") {
            $('.kb_custom_field_form').show();
            if ($('textarea[name^="value_"]').closest('.form-group').hasClass('translatable-field')) {
                $('textarea[name^="value_"]').parents('.form-group').parents('.form-group').show();
            } else {
                $('textarea[name^="value_"]').parents('.form-group').show();
            }
            $('input[name^="default_value_"]').parents('.form-group').show();
            $('input[name="show_on_invoice"]').closest('.form-group').show();
            $('input[name^="placeholder_"]').parents('.form-group').hide();
            $('select[name="validation"]').closest('.form-group').hide();
            $('input[name^="error_msg_"]').parents('.form-group').hide();
            $('input[name="multiselect"]').closest('.form-group').hide();
            $('input[name="min_length"]').closest('.form-group').hide();
            $('input[name="max_length"]').closest('.form-group').hide();
            $('input[name="file_extension"]').closest('.form-group').hide();
            $('input[name="allow_multifile"]').closest('.form-group').hide();
            $('input[name="show_text_editor"]').closest('.form-group').hide();
            $('input[name="editable"]').closest('.form-group').hide();
        } else if (selected_type == "textarea") {
            $('.kb_custom_field_form').show();
            $('input[name^="placeholder_"]').parents('.form-group').show();
            $('select[name="validation"]').closest('.form-group').show();
            $('input[name^="error_msg_"]').parents('.form-group').show();
            $('input[name="min_length"]').closest('.form-group').show();
            $('input[name="max_length"]').closest('.form-group').show();
            $('input[name="show_on_invoice"]').closest('.form-group').show();
            $('textarea[name^="value_"]').parents('.form-group').hide();
            $('input[name^="default_value_"]').parents('.form-group').hide();
            $('input[name="multiselect"]').closest('.form-group').hide();
            $('input[name="file_extension"]').closest('.form-group').hide();
            $('input[name="allow_multifile"]').closest('.form-group').hide();
            $('input[name="show_text_editor"]').closest('.form-group').show();
            $('input[name="editable"]').closest('.form-group').hide();
        } else if (selected_type == "file") {
            $('.kb_custom_field_form').show();
            $('input[name^="error_msg_"]').parents('.form-group').hide();
            $('input[name="allow_multifile"]').closest('.form-group').show();
            $('input[name="file_extension"]').closest('.form-group').show();
            $('input[name="show_on_invoice"]').closest('.form-group').hide();
            $('input[name^="placeholder_"]').parents('.form-group').hide();
            $('select[name="validation"]').closest('.form-group').hide();
            $('input[name="min_length"]').closest('.form-group').hide();
            $('input[name="max_length"]').closest('.form-group').hide();
            if ($('textarea[name^="value_"]').closest('.form-group').hasClass('translatable-field')) {
                $('textarea[name^="value_"]').parents('.form-group').parents('.form-group').hide();
            } else {
                $('textarea[name^="value_"]').parents('.form-group').hide();
            }
            $('input[name^="default_value_"]').parents('.form-group').hide();
            $('input[name="multiselect"]').closest('.form-group').hide();
            $('input[name="show_text_editor"]').closest('.form-group').hide();
            $('input[name="editable"]').closest('.form-group').show();
        } else if (selected_type == "date") {
            $('.kb_custom_field_form').show();
            $('input[name^="placeholder_"]').parents('.form-group').show();
            $('input[name="show_on_invoice"]').closest('.form-group').show();
            $('input[name^="error_msg_"]').parents('.form-group').hide();
            $('select[name="validation"]').closest('.form-group').hide();
            $('input[name="allow_multifile"]').closest('.form-group').hide();
            $('input[name="file_extension"]').closest('.form-group').hide();
            $('input[name="min_length"]').closest('.form-group').hide();
            $('input[name="max_length"]').closest('.form-group').hide();
            if ($('textarea[name^="value_"]').closest('.form-group').hasClass('translatable-field')) {
                $('textarea[name^="value_"]').parents('.form-group').parents('.form-group').hide();
            } else {
                $('textarea[name^="value_"]').parents('.form-group').hide();
            }
            $('input[name^="default_value_"]').parents('.form-group').hide();
            $('input[name="multiselect"]').closest('.form-group').hide();
            $('input[name="show_text_editor"]').closest('.form-group').hide();
            $('input[name="editable"]').closest('.form-group').hide();
        } else if (selected_type == "datetime") {
            $('.kb_custom_field_form').show();
            $('input[name^="placeholder_"]').parents('.form-group').show();
            $('input[name="show_on_invoice"]').closest('.form-group').show();
            $('input[name^="error_msg_"]').parents('.form-group').hide();
            $('select[name="validation"]').closest('.form-group').hide();
            $('input[name="allow_multifile"]').closest('.form-group').hide();
            $('input[name="file_extension"]').closest('.form-group').hide();
            $('input[name="min_length"]').closest('.form-group').hide();
            $('input[name="max_length"]').closest('.form-group').hide();
            if ($('textarea[name^="value_"]').closest('.form-group').hasClass('translatable-field')) {
                $('textarea[name^="value_"]').parents('.form-group').parents('.form-group').hide();
            } else {
                $('textarea[name^="value_"]').parents('.form-group').hide();
            }
            $('input[name^="default_value_"]').parents('.form-group').hide();
            $('input[name="multiselect"]').closest('.form-group').hide();
            $('input[name="editable"]').closest('.form-group').hide();
        }
    }).change();

    if (typeof edit_field_form != 'undefined') {
        if (edit_field_form) {
            $('select[name="type"]').attr('disabled', 'disabled');
        }
    }

});

function upload(fd) {
//		alert(fd);
        $.ajax({
            url: kb_front_controller,
            type: 'post',
            data: fd+'ajaxFile=true',
            processData: false,
            contentType: false,
            success: function (msg) {
//
            }
        });
    }