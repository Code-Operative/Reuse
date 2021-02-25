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

var count = 0;
var count1 = 1;
var indicator = 0;
var indicator1 = 0;

$(document).ready(function () {



    $(".kb_add_field").on('click', function () {
        addField();
        event.preventDefault();
    })
})

function validateDynamicPriceRuleForm() {

    $('.kb-validation-error').remove();
        event.preventDefault();
        var error = 0;
        var rule_name = velovalidation.checkMandatory($('input[name="rule_name"]'));
        if (rule_name == true) {
    //nothing has to be done here
    } else {
        $('input[name="rule_name"]').parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
        error = 1;
    }

    var min_prod_price = velovalidation.checkMandatory($('input[name="min_prod_price"]'));
        if (min_prod_price == true) {
    } else {
        $('input[name="min_prod_price"]').parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
        error = 1;
    }

    var min_prod_price = velovalidation.isNumeric($('input[name="min_prod_price"]'));
        if (min_prod_price == true) {
    //nothing has to be done here
    } else {
        $('input[name="min_prod_price"]').parent().append('<div class="kb-validation-error">' + err_numeric + '</div>');
        error = 1;
    }

    var max_prod_price = velovalidation.checkMandatory($('input[name="max_prod_price"]'));
        if (max_prod_price == true) {
    } else {
        $('input[name="max_prod_price"]').parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
        error = 1;
    }

    var max_prod_price = velovalidation.isNumeric($('input[name="max_prod_price"]'));
        if (max_prod_price == true) {
    } else {
        $('input[name="max_prod_price"]').parent().append('<div class="kb-validation-error">' + err_numeric + '</div>');
        error = 1;
    }

    if (error == 0) {
    var max_prod_price_val = $('input[name="max_prod_price"]').val();
        var min_prod_price_val = $('input[name="min_prod_price"]').val();
        if (parseInt(min_prod_price_val) > parseInt(max_prod_price_val)) {
    error = 1;
        alert(err_max_min);
    }
    }
//        }

    var rule_priority = velovalidation.checkMandatory($('input[name="rule_priority"]'));
        if (rule_priority == true) {
    } else {
    $('input[name="rule_priority"]').parent().append('<div class="kb-validation-error">' + err_mandatory + '</div>');
        error = 1;
    }

    var rule_priority = velovalidation.isNumeric($('input[name="rule_priority"]'));
        if (rule_priority == true) {
    //nothing has to be done here
    } else {
    $('input[name="rule_priority"]').parent().append('<div class="kb-validation-error">' + err_numeric + '</div>');
        error = 1;
    }

    if ($('input[name="rule_priority"]').val() == 0) {
    $('input[name="rule_priority"]').parent().append('<div class="kb-validation-error">' + err_prioirty_zero + '</div>');
        error = 1;
    }
    if (error == 0) {
    $.ajax({
            url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=checkPriority',
        data: 'checkPriority=1&priority_value=' + $('input[name="rule_priority"]').val() + '&id_dynamic_rule=' + $('#id_dynamic_rule').val(),
        async: true,
        success: function (data) {
        $('.kb_error').remove();
            if (data == 1) {
                    $('input[name="rule_priority"]').parent().append('<div class="kb-validation-error">' + err_same_priority + '</div>');
                    error = 1;
        }
        if (error == 0) {
                    $("#kb-dynamic-rule-form").submit();
        }
        }
    });
    }

    }
function addField() {

    if (id_dynamic_rule == 0) {
        alert(settings_err_msg);
        return;
    }

    $.ajax({
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=kb_add_field',
        data: 'kb_add_field=1&id_dynamic_rule=' + id_dynamic_rule,
        beforeSend: function () {
            $('.kbloading').show();
        },
        success: function (data) {
            $('.kbloading').hide();
            if (data != 0) {
                var html = '<tr data-id-field="' + data + '"><td class="id_field">' + data + '</td><td>';
                html = html + '<input data-name="name" data-type="plain" value="" type="text" class="form-control field_label" onblur="saveFieldName(this);"></td>';
                html = html + '<td><div data-class="field">';
                for (var id_lang in languages) {
                    html = html + '<div style="margin:2%"><input type="text" value="" placeholder="' + languages[id_lang]['name'] + '" data-id-lang="' + languages[id_lang]['id_lang'] + '" data-name="label" onblur="saveFieldLabel(this,' + data + ')" ></div>';
                }
                html = html + '</div></td>';
                html = html + '<td><select data-name="type" onchange="saveFieldType(this, ' + data + ')">';
                html = html + '<option value="1">' + user_input + '</option>';
                html = html + '<option value="2">' + slider + '</option>';
                html = html + '<option value="3">' + dropdown + '</option>';
                // changes by rishabh jain on 31st July 2019 for multiple select options
                html = html + '<option value="18">' + multiple_dropdown + '</option>';
                // changes over
                html = html + '<option value="4">' + radio_btns + '</option>';
                html = html + '<option value="5">' + img_lst + '</option>';
                html = html + '<option value="6">' + chck_box + '</option>';
                html = html + '<option value="7">' + txt + '</option>';
                html = html + '<option value="8">' + txt_area + '</option>';
                html = html + '<option value="9">' + date + '</option>';
                html = html + '<option value="10">' + img + '</option>';
                html = html + '<option value="12">' + fxd_val + '</option>';
                html = html + '<option value="13">' + unt_price + '</option>';
                html = html + '<option value="16">' + divider + '</option>';
                html = html + '<option value="17">' + clr_pckr + '</option></select></td>';
                html = html + '<td class="center"><div><input data-name="init" data-type="float" value="0" type="text" class="form-control field_value_' + data + '" onchange="saveFieldValue(this, ' + data + ');"></div></td><td>';
                html = html + '<select data-name="id_unit" class="form-control field_unit_' + data + '" onchange="saveFieldUnit(this, ' + data + ')"><option value="0">' + select_optn + '</option><option value="1">' + cntmtr + '</option><option value="2">' + mtr + '</option><option value="3">' + kg + '</option><option value="4">' + gr + '</option></select></td>';
                html = html + '<td class="center"><a style="cursor:pointer" class="field_values_' + data + '" onclick="openFieldTypeForm(' + data + ')"><i class="kb-material-icons">list</i></a></td>';
                html = html + '<td class="center"><div style="padding:5%;display:inline-block"><a data-name="active" data-value="1"><i class="kb-material-icons icon-remove status_' + data + '" style="color:rgba(255, 0, 0, 0.48) !important;" onclick="changeStatus(' + data + ', 1);">close</i><i class="kb-material-icons icon-check status_' + data + ' hidden" style="color:rgba(0, 128, 0, 0.57) !important;" onclick="changeStatus(' + data + ', 0);">check</i></a></div><div style="padding:5%;display:inline-block"><a data-class="field" href="#"  onclick="deleteField(' + data + ', this)"><i class="kb-material-icons icon-trash">delete</i></a></div></td></tr>';
                $('#kb_fields_table tbody').append(html);
                showSuccessMessage(success_msg);
            }
        }
    });
}

function saveFieldName(a)
{
    $.ajax({
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        data: 'ajax=true&method=savename&savename=1&id_dynamic_field=' + $(a).parent().parent().attr('data-id-field') + '&name=' + $(a).val(),
        success: function (data) {
            if ($(a).parent().parent().find('.icon-remove').hasClass('hidden') && $(a).parent().parent().find('select').val() != 17 && $(a).parent().parent().find('select').val() != 16 && $(a).parent().parent().find('select').val() != 9 && $(a).parent().parent().find('select').val() != 7 && $(a).parent().parent().find('select').val() != 8) {
                if ($(a).val() != '') {
                    flag = 0;
                    apnd_counter = 0;

                    $('#formula_price_label li').each(function () {
                        if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                            flag = 1;
                            if (apnd_counter == 0) {
                                if ($(a).parent().parent().find('select').val() == 10) {
                                    $(this).parent().append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_W' + '</a></li>');
                                    $(this).parent().append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_H' + '</a></li>');
                                } else {
                                    $(this).parent().append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '</a></li>');
                                }
                            }
                            apnd_counter++;
                            $(this).remove();
                        }
                    })

                    if (flag == 0) {
                        if ($(a).parent().parent().find('select').val() == 10) {
                            $('#formula_price_label').append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_W' + '</a></li>')
                            $('#formula_price_label').append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_H' + '</a></li>')
                        } else {
                            $('#formula_price_label').append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '</a></li>')
                        }
                    }

                    flag = 0;
                    apnd_counter = 0;

                    $('#formula_weight_label li').each(function () {
                        if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                            flag = 1;
                            if (apnd_counter == 0) {
                                if ($(a).parent().parent().find('select').val() == 10) {
                                    $(this).parent().append($('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_W' + '</a></li>'));
                                    $(this).parent().append($('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_H' + '</a></li>'));
                                } else {
                                    $(this).parent().append($('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '</a></li>'));
                                }
                            }
                            apnd_counter++;
                            $(this).remove();
                        }
                    })

                    if (flag == 0) {
                        if ($(a).parent().parent().find('select').val() == 10) {
                            $('#formula_weight_label').append($('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_W' + '</a></li>'));
                            $('#formula_weight_label').append($('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_H' + '</a></li>'));
                        } else {
                            $('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '</a></li>')
                        }
                    }

                    flag = 0;
                    apnd_counter = 0;

                    $('#formula_quantity_label li').each(function () {
                        if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                            flag = 1;
                            if (apnd_counter == 0) {
                                if ($(a).parent().parent().find('select').val() == 10) {
                                    $(this).parent().append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_W' + '</a></li>');
                                    $(this).parent().append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_H' + '</a></li>');
                                } else {
                                    $(this).parent().append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '</a></li>');
                                }
                            }
                            apnd_counter++;
                            $(this).remove();
                        }
                    })

                    if (flag == 0) {
                        if ($(a).parent().parent().find('select').val() == 10) {
                            $('#formula_quantity_label').append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_W' + '</a></li>');
                            $('#formula_quantity_label').append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '_H' + '</a></li>');
                        } else {
                            $('#formula_quantity_label').append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).parent().parent().find('select').val() + '">' + $(a).val() + '</a></li>')
                        }
                    }
                }
            } else {
                $('#formula_price_label li').each(function () {
                    if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                        $(this).remove();
                    }
                })

                $('#formula_weight_label li').each(function () {
                    if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                        $(this).remove();
                    }
                })

                $('#formula_quantity_label li').each(function () {
                    if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                        $(this).remove();
                    }
                })
            }
            mapFieldsEvent();
            showSuccessMessage(success_msg);
        }
    })
}

function saveFieldLabel(a, b)
{
    $.ajax({
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        data: 'ajax=true&method=savelabel&savelabel=1&id_dynamic_field=' + b + '&label=' + $(a).val() + '&id_lang=' + $(a).attr('data-id-lang'),
        success: function (data) {
            showSuccessMessage(success_msg);
        }
    })
}

function changeStatus(a, b)
{
    var selector = '.status_' + a;
    $(selector).each(function () {
        if ($(this).hasClass('hidden')) {
            $(this).removeClass('hidden');
        } else {
            $(this).addClass('hidden');
            selector1 = this;
        }
    })
    selector = $(selector1);
    if (selector.hasClass('hidden') && selector.hasClass('icon-remove') && selector.parent().parent().parent().parent().find('select').val() != 17 && selector.parent().parent().parent().parent().find('select').val() != 16 && selector.parent().parent().parent().parent().find('select').val() != 9 && selector.parent().parent().parent().parent().find('select').val() != 7 && selector.parent().parent().parent().parent().find('select').val() != 8) {
        var flag = 0;
        $('#formula_price_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == selector.parent().parent().parent().parent().attr('data-id-field')) {
                flag = 1;
                if (selector.parent().parent().parent().parent().find('select').val() == 10) {
                    $(this).parent().append('<li><a class="kb_equation_field price" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                    $(this).parent().append('<li><a class="kb_equation_field price" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
                } else {
                    $(this).parent().append('<li><a class="kb_equation_field price" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '</a></li>');
                }
                $(this).remove();
            }
        })

        if (flag == 0) {
            if (selector.parent().parent().parent().parent().find('select').val() == 10) {
                $('#formula_price_label').append('<li><a class="kb_equation_field price" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                $('#formula_price_label').append('<li><a class="kb_equation_field price" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
            } else {
                $('#formula_price_label').append('<li><a class="kb_equation_field price" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '</a></li>');
            }
        }

        var flag = 0;
        $('#formula_weight_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == selector.parent().parent().parent().parent().attr('data-id-field')) {
                flag = 1;
                if (selector.parent().parent().parent().parent().find('select').val() == 10) {
                    $(this).parent().append($('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_W' + '</a></li>'));
                    $(this).parent().append($('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_H' + '</a></li>'));
                } else {
                    $(this).parent().append($('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '</a></li>'));
                }
                $(this).remove();
            }
        })

        if (flag == 0) {
            if (selector.parent().parent().parent().parent().find('select').val() == 10) {
                $('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                $('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
            } else {
                $('#formula_weight_label').append('<li><a class="kb_equation_field weight" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '</a></li>');
            }
        }

        var flag = 0;

        $('#formula_quantity_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == selector.parent().parent().parent().parent().attr('data-id-field')) {
                flag = 1;
                if (selector.parent().parent().parent().parent().find('select').val() == 10) {
                    $(this).parent().append('<li><a class="kb_equation_field qty" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                    $(this).parent().append('<li><a class="kb_equation_field qty" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
                } else {
                    $(this).parent().append('<li><a class="kb_equation_field qty" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '</a></li>');
                }
                $(this).remove();
            }
        })

        if (flag == 0) {
            if (selector.parent().parent().parent().parent().find('select').val() == 10) {
                $('#formula_quantity_label').append('<li><a class="kb_equation_field qty" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                $('#formula_quantity_label').append('<li><a class="kb_equation_field qty" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
            } else {
                $('#formula_quantity_label').append('<li><a class="kb_equation_field qty" data-attr-val="' + selector.parent().parent().parent().parent().attr('data-id-field') + '" data-attr-type="' + selector.parent().parent().parent().parent().find('select').val() + '">' + selector.parent().parent().parent().parent().find($('.field_label')).val() + '</a></li>');
            }
        }
    } else {
        $('#formula_price_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == selector.parent().parent().parent().parent().attr('data-id-field')) {
                $(this).remove();
            }
        })

        $('#formula_weight_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == selector.parent().parent().parent().parent().attr('data-id-field')) {
                $(this).remove();
            }
        })
        $('#formula_quantity_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == selector.parent().parent().parent().parent().attr('data-id-field')) {
                $(this).remove();
            }
        })
    }

    mapFieldsEvent();

    $.ajax({
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        data: 'ajax=true&method=changeStatus&changeStatus=1&id_dynamic_field=' + a + '&status=' + b,
        success: function (data) {
            showSuccessMessage(success_msg);
        }
    })
}

function deleteField(a, b)
{
    if (confirm(cnfrm_txt)) {
        $.ajax({
            url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
            data: 'ajax=true&method=deleteField&deleteField=1&id_dynamic_field=' + a,
            success: function (data) {
                if (data == 1) {
                    $(b).parent().parent().parent().remove();
                }
                showSuccessMessage(success_msg);
                location.reload();
            }
        })
    }
}

function saveFieldType(a, b)
{
    var val_selector = '.field_value_' + b;
    var unit_selector = '.field_unit_' + b;
    var vals_selector = '.field_values_' + b;

    if ($(a).val() == 3 || $(a).val() == 4 || $(a).val() == 5 || $(a).val() == 6 || $(a).val() == 7 || $(a).val() == 8 || $(a).val() == 9 || $(a).val() == 10 || $(a).val() == 17 || $(a).val() == 18) {
        $(val_selector).hide();
        $(unit_selector).hide();
        $(vals_selector).show();
    } else {
        $(val_selector).show();
        $(unit_selector).show();
        $(vals_selector).show();
    }

    if ($(a).val() == 12 || $(a).val() == 13) {
        $(val_selector).show();
        $(unit_selector).hide();
        $(vals_selector).hide();
    }

    if ($(a).val() == 16) {
        $(val_selector).hide();
        $(unit_selector).hide();
        $(vals_selector).hide();
    }

    if ($(a).parent().parent().find('.icon-remove').hasClass('hidden') && $(a).val() != 17 && $(a).val() != 16 && $(a).val() != 9 && $(a).val() != 7 && $(a).val() != 8) {
        var flag = 0;
        var apnd_counter = 0;

        $('#formula_price_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                flag = 1;
                if (apnd_counter == 0) {
                    if ($(a).val() == 10) {
                        $(this).parent().append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                        $(this).parent().append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
                    } else {
                        $(this).parent().append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '</a></li>');
                    }
                }
                apnd_counter++;
                $(this).remove();
            }
        })

        if (flag == 0) {
            if ($(a).val() == 10) {
                $("#formula_price_label").append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                $("#formula_price_label").append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
            } else {
                $("#formula_price_label").append('<li><a class="kb_equation_field price" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '</a></li>');
            }
        }

        var flag = 0;
        var apnd_counter = 0;

        $('#formula_weight_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                flag = 1;
                if (apnd_counter == 0) {
                    if ($(a).val() == 10) {
                        $(this).parent().append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                        $(this).parent().append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
                    } else {
                        $(this).parent().append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '</a></li>');
                    }
                }
                apnd_counter++;
                $(this).remove();
            }
        })

        if (flag == 0) {
            if ($(a).val() == 10) {
                $("#formula_weight_label").append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                $("#formula_weight_label").append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
            } else {
                $("#formula_weight_label").append('<li><a class="kb_equation_field weight" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '</a></li>');
            }
        }

        var flag = 0;
        var apnd_counter = 0;

        $('#formula_quantity_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                flag = 1;
                if (apnd_counter == 0) {
                    if ($(a).val() == 10) {
                        $(this).parent().append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                        $(this).parent().append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
                    } else {
                        $(this).parent().append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '</a></li>');
                    }
                }
                apnd_counter++;
                $(this).remove();
            }
        })

        if (flag == 0) {
            if ($(a).val() == 10) {
                $("#formula_quantity_label").append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_W' + '</a></li>');
                $("#formula_quantity_label").append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '_H' + '</a></li>');
            } else {
                $("#formula_quantity_label").append('<li><a class="kb_equation_field qty" data-attr-val="' + $(a).parent().parent().attr('data-id-field') + '" data-attr-type="' + $(a).val() + '">' + $(a).parent().parent().find($('.field_label')).val() + '</a></li>');
            }
        }
    } else {
        $('#formula_price_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                $(this).remove();
            }
        })

        $('#formula_weight_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                $(this).remove();
            }
        })
        $('#formula_quantity_label li').each(function () {
            if ($(this).find('a').attr('data-attr-val') == $(a).parent().parent().attr('data-id-field')) {
                $(this).remove();
            }
        })
    }

    mapFieldsEvent();

    $.ajax({
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        data: 'ajax=true&method=changeType&changeType=1&id_dynamic_field=' + b + '&type=' + $(a).val(),
        success: function (data) {
            showSuccessMessage(success_msg);
        }
    })
}

function saveFieldUnit(a, b)
{
    $.ajax({
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        data: 'ajax=true&method=changeUnit&changeUnit=1&id_dynamic_field=' + b + '&unit=' + $(a).val(),
        success: function (data) {
            showSuccessMessage(success_msg);
        }
    })
}
function showErrorMessage(msg) {
    $.gritter.add({
        title: '',
        text: msg,
        class_name: 'gritter-warning',
        sticky: false,
        time: '3000'
    });
}

function showSuccessMessage(msg) {
    $.gritter.add({
        title: '',
        text: msg,
        class_name: 'gritter-success',
        sticky: false,
        time: '3000'
    });
}

function saveFieldValue(a, b)
{
    error1 = 0;

    var val = velovalidation.checkMandatory($(a));
    if (val == true) {
        //nothing has to be done here
    } else {
        showErrorMessage(err_mandatory)
        error1 = 1;
    }

    var voucher_quan_val = velovalidation.isNumeric($(a));
    if (voucher_quan_val == true) {
        //nothing has to be done here
    } else {
        showErrorMessage(err_numeric)
        error1 = 1;
    }

    if (error1 == 0) {
        $.ajax({
            url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
            data: 'ajax=true&method=saveValue&saveValue=1&id_dynamic_field=' + b + '&value=' + $(a).val(),
            success: function (data) {
                showSuccessMessage(success_msg);
            }
        })
    }
}

function openFieldTypeForm(a)
{
    var html = '';

    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true&method=getFieldTypeHTML&getFieldTypeHTML=1&id_dynamic_field=' + a,
        beforeSend: function () {
            $('.kbloading').show();
        },
        success: function (json) {
            $('.kbloading').hide();
            if (json['status'] == true) {
                $.fancybox({
                    'closeClick': false,
                    'titlePosition': 'inside',
                    'transitionIn': 'none',
                    'transitionOut': 'none',
                    'overlayShow': false,
                    'width': '100%',
                    'height': '100%',
                    'minWidth': '400px',
                    'minHeight': '200px',
//                    'autoSize'  : true,
                    'content': json['html'],
                    helpers: {
                        overlay: {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
                    }
                });
            }
            $('.thumbnail').each(function () {
                var input = document.createElement('INPUT');
                var picker = new jscolor(input)
                $(input).attr('class', 'form-control thumbnail jscolor')
                $(input).attr('name', $(this).attr('name'))
                $(input).attr('type', "text")
                $(input).css('background-color', '#' + $(this).val());
                $(input).val($(this).val());
                $(this).replaceWith(input);
            })
        }
    })
}

function saveFieldsValues(a, b, c)
{
    error2 = 0;
    if (c == 1 || c == 2) {
        var initial_selector = '.initial_' + a;
        var min_selector = '.min_' + a;
        var max_selector = '.max_' + a;
        var step_selector = '.step_' + a;

        descObj = [];
        $("input[class*='desc_']").each(function () {
            var id = $(this).attr('data-attr-lang');
            var val = $(this).val();

            var desc_val = velovalidation.checkMandatory($(this));
            if (desc_val == true) {
                //nothing has to be done here
            } else {
                showErrorMessage(desc_err)
                error2 = 1;
            }

            arr = {};
            arr ["lang_id"] = id;
            arr ["val"] = val;

            descObj.push(arr);
            var value_selector = '.field_value_' + a;
            $(value_selector).val($(initial_selector).val());
        })

        var initial_val = velovalidation.checkMandatory($(initial_selector));
        if (initial_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(initial_mandatory)
            error2 = 1;
        }

        var initial_val = velovalidation.isNumeric($(initial_selector));
        if (initial_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(initial_numeric)
            error2 = 1;
        }

        var min_val = velovalidation.checkMandatory($(min_selector));
        if (min_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(min_mandatory)
            error2 = 1;
        }

        var min_val = velovalidation.isNumeric($(min_selector));
        if (min_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(min_numeric)
            error2 = 1;
        }

        var max_val = velovalidation.checkMandatory($(max_selector));
        if (max_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(max_mandatory)
            error2 = 1;
        }

        var max_val = velovalidation.isNumeric($(max_selector));
        if (max_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(max_numeric)
            error2 = 1;
        }

        var step_val = velovalidation.checkMandatory($(step_selector));
        if (step_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(step_mandatory)
            error2 = 1;
        }

        var step_val = velovalidation.isNumeric($(step_selector));
        if (step_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(step_numeric)
            error2 = 1;
        }

        if (error2 == 0) {
            if (parseInt($(min_selector).val()) >= parseInt($(max_selector).val())) {
                showErrorMessage(err_max_min)
                error2 = 1;
            }
        }

        if (error2 == 0) {
            if (parseInt($(initial_selector).val()) < parseInt($(min_selector).val())) {
                showErrorMessage(err_init_min)
                error2 = 1;
            }
        }

        if (error2 == 0) {
            if (parseInt($(initial_selector).val()) > parseInt($(max_selector).val())) {
                showErrorMessage(err_init_max)
                error2 = 1;
            }
        }

        if (error2 == 0) {
            var diff = parseInt($(max_selector).val()) - parseInt($(min_selector).val());
            if (parseInt($(step_selector).val()) > parseInt(diff)) {
                showErrorMessage(step_diff_err);
                error2 = 1;
            }
        }

        if (error2 == 0 && c == 2) {
            var div = parseInt($(initial_selector).val()) % parseInt($(step_selector).val());
            if (parseInt(div) != 0 || parseInt($(step_selector).val()) > parseInt($(initial_selector).val())) {
                showErrorMessage(step_div_err);
                error2 = 1;
            }
        }
        if (error2 == 0) {
            $.ajax({
                type: 'POST',
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=saveFieldsValues',
                data: {"saveFieldsValues": 1, "id_dynamic_field": a, "id_dynamic_field_value": b, "initialValue": $(initial_selector).val(), "minValue": $(min_selector).val(), "maxValue": $(max_selector).val(), "stepValue": $(step_selector).val(), "descData": descObj, "fieldtype": c},
                success: function (data) {
                    showSuccessMessage(success_msg);
                    $('.fancybox-close').trigger('click');
                }
            })
        }
    } else if (c == 3 || c == 4 || c == 18) {
        inputObj = [];
        arr = {};
        $(".kb_dp_val input").each(function () {
            arr [$(this).attr('name')] = $(this).val();
            if ($(this).attr('name').indexOf('desc') != -1 && velovalidation.checkMandatory($(this)) != true) {
                showErrorMessage(desc_err)
                error2 = 1;
            }
            if ($(this).attr('name').indexOf('text') != -1 && velovalidation.checkMandatory($(this)) != true) {
                showErrorMessage(text_err)
                error2 = 1;
            }
            if ($(this).attr('name').indexOf('value') != -1 && velovalidation.checkMandatory($(this)) != true) {
                showErrorMessage(value_err)
                error2 = 1;
            }
            if ($(this).attr('name').indexOf('value') != -1 && velovalidation.isNumeric($(this)) != true) {
                showErrorMessage(value_numeric_err)
                error2 = 1;
            }
            inputObj.push(arr);
        })

        if (error2 == 0) {
            $.ajax({
                type: 'POST',
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=saveFieldsValues',
                data: {"saveFieldsValues": 1, "id_dynamic_field": a, "id_dynamic_field_value": b, "inputValues": inputObj[0], "fieldtype": c},
                success: function (data) {
                    showSuccessMessage(success_msg);
                    $('.fancybox-close').trigger('click');
                }
            })
        }
    } else if (c == 5) {
        inputObj = [];
        arr = {};
        $(".kb_dp_val input").each(function () {
            arr [$(this).attr('name')] = $(this).val();
            if ($(this).attr('name').indexOf('desc') != -1 && velovalidation.checkMandatory($(this)) != true) {
                showErrorMessage(desc_err)
                error2 = 1;
            }
            if ($(this).attr('name').indexOf('text') != -1 && velovalidation.checkMandatory($(this)) != true) {
                showErrorMessage(text_err)
                error2 = 1;
            }
            if ($(this).attr('name').indexOf('value') != -1 && velovalidation.checkMandatory($(this)) != true) {
                showErrorMessage(value_err)
                error2 = 1;
            }
            if ($(this).attr('name').indexOf('value') != -1 && velovalidation.isNumeric($(this)) != true) {
                showErrorMessage(value_numeric_err)
                error2 = 1;
            }
            inputObj.push(arr);
        })
        if (error2 == 0) {
            $.ajax({
                type: 'POST',
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=saveFieldsValues',
                data: {"saveFieldsValues": 1, "id_dynamic_field": a, "id_dynamic_field_value": b, "inputValues": inputObj[0], "fieldtype": c},
                success: function (data) {
                    showSuccessMessage(success_msg);
                    $('.fancybox-close').trigger('click');
                }
            })
        }
    } else if (c == 6) {
        inputObj = [];
        arr = {};
        $(".kb_dp_val input").each(function () {
            arr [$(this).attr('name')] = $(this).val();
            if ($(this).attr('name').indexOf('desc') != -1 && velovalidation.checkMandatory($(this)) != true) {
                showErrorMessage(desc_err)
                error2 = 1;
            }
            inputObj.push(arr);
        })
        if (error2 == 0) {
            $.ajax({
                type: 'POST',
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=saveFieldsValues',
                data: {"saveFieldsValues": 1, "id_dynamic_field": a, "id_dynamic_field_value": b, "inputValues": inputObj[0], "fieldtype": c},
                success: function (data) {
                    showSuccessMessage(success_msg);
                    $('.fancybox-close').trigger('click');
                }
            })
        }
    } else if (c == 7 || c == 8) {
        var init_val = $("input[name='initial_txt']").val();
        var min_val = $("input[name='min_txt']").val();
        var max_val = $("input[name='max_txt']").val();
        var req_val = $("input[name='req_txt']:checked").val();
        descObj = [];
        $("input[name*='desc_']").each(function () {
            var id = $(this).attr('data-attr-lang');
            var val = $(this).val();

            var desc_val = velovalidation.checkMandatory($(this));
            if (desc_val == true) {
                //nothing has to be done here
            } else {
                showErrorMessage(desc_err)
                error2 = 1;
            }

            arr = {};
            arr ["lang_id"] = id;
            arr ["val"] = val;

            descObj.push(arr);
        })

        var initial_val = velovalidation.checkMandatory($("input[name='initial_txt']"));
        if (initial_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(initial_mandatory)
            error2 = 1;
        }

        var min_charcter_val = velovalidation.checkMandatory($("input[name='min_txt']"));
        if (min_charcter_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(min_mandatory)
            error2 = 1;
        }

        var min_charcter_val = velovalidation.isNumeric($("input[name='min_txt']"));
        if (min_charcter_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(min_numeric)
            error2 = 1;
        }

        var max_charcter_val = velovalidation.checkMandatory($("input[name='max_txt']"));
        if (max_charcter_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(max_mandatory)
            error2 = 1;
        }

        var max_charcter_val = velovalidation.isNumeric($("input[name='max_txt']"));
        if (max_charcter_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(max_numeric)
            error2 = 1;
        }

        if (error2 == 0) {
            if (parseInt($("input[name='min_txt']").val()) > parseInt($("input[name='max_txt']").val())) {
                showErrorMessage(err_max_min)
                error2 = 1;
            }
        }

        if (error2 == 0) {
            $.ajax({
                type: 'POST',
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=saveFieldsValues',
                data: {"saveFieldsValues": 1, "id_dynamic_field": a, "id_dynamic_field_value": b, "descData": descObj, "initialValue": init_val, "minValue": min_val, "maxValue": max_val, "reqValue": req_val, "fieldtype": c},
                success: function (data) {
                    showSuccessMessage(success_msg);
                    $('.fancybox-close').trigger('click');
                }
            })
        }
    } else if (c == 9) {
        var req_val = $("input[name='req_txt']:checked").val();
        descObj = [];
        $("input[name*='desc_']").each(function () {
            var id = $(this).attr('data-attr-lang');
            var val = $(this).val();

            var desc_val = velovalidation.checkMandatory($(this));
            if (desc_val == true) {
                //nothing has to be done here
            } else {
                showErrorMessage(desc_err)
                error2 = 1;
            }

            arr = {};
            arr ["lang_id"] = id;
            arr ["val"] = val;

            descObj.push(arr);
        })

        if (error2 == 0) {
            $.ajax({
                type: 'POST',
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=saveFieldsValues',
                data: {"saveFieldsValues": 1, "id_dynamic_field": a, "id_dynamic_field_value": b, "descData": descObj, "reqValue": req_val, "fieldtype": c},
                success: function (data) {
                    showSuccessMessage(success_msg);
                    $('.fancybox-close').trigger('click');
                }
            })
        }
    } else if (c == 10) {
        var req_val = $("input[name='req_txt']:checked").val();
        var min_val = $("input[name='min_txt']").val();
        var max_val = $("input[name='max_txt']").val();
        var max_size = $("input[name='max_size']").val();

        var min_valid = velovalidation.checkMandatory($("input[name='min_txt']"));
        if (min_valid == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(min_mandatory)
            error2 = 1;
        }

        var min_valid = velovalidation.isNumeric($("input[name='min_txt']"));
        if (min_valid == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(min_numeric)
            error2 = 1;
        }

        var max_valid = velovalidation.checkMandatory($("input[name='max_txt']"));
        if (max_valid == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(max_mandatory)
            error2 = 1;
        }

        var max_valid = velovalidation.isNumeric($("input[name='max_txt']"));
        if (max_valid == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(max_numeric)
            error2 = 1;
        }

        var max_size_valid = velovalidation.checkMandatory($("input[name='max_size']"));
        if (max_size_valid == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(max_size_mandatory)
            error2 = 1;
        }

        var max_size_valid = velovalidation.checkAmount($("input[name='max_size']"));
        if (max_size_valid == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(max_size_numeric)
            error2 = 1;
        }

        if (error2 == 0) {
            $.ajax({
                type: 'POST',
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=saveFieldsValues',
                data: {"saveFieldsValues": 1, "id_dynamic_field": a, "id_dynamic_field_value": b, "minValue": min_val, "maxValue": max_val, "maxSize": max_size, "reqValue": req_val, "fieldtype": c},
                success: function (data) {
                    showSuccessMessage(success_msg);
                    $('.fancybox-close').trigger('click');
                }
            })
        }
    } else if (c == 17) {
        var init_val = $("input[name='initial_txt']").val();

        var initial_val = velovalidation.checkMandatory($("input[name='initial_txt']"));
        if (initial_val == true) {
            //nothing has to be done here
        } else {
            showErrorMessage(initial_mandatory)
            error2 = 1;
        }

        descObj = [];
        $("input[name*='desc_']").each(function () {
            var id = $(this).attr('data-attr-lang');
            var val = $(this).val();

            var desc_val = velovalidation.checkMandatory($(this));
            if (desc_val == true) {
                //nothing has to be done here
            } else {
                showErrorMessage(desc_err)
                error2 = 1;
            }

            arr = {};
            arr ["lang_id"] = id;
            arr ["val"] = val;

            descObj.push(arr);
        })

        if (error2 == 0) {
            $.ajax({
                type: 'POST',
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=saveFieldsValues',
                data: {"saveFieldsValues": 1, "id_dynamic_field": a, "id_dynamic_field_value": b, "descData": descObj, "initialValue": init_val, "fieldtype": c},
                success: function (data) {
                    showSuccessMessage(success_msg);
                    $('.fancybox-close').trigger('click');
                }
            })
        }
    }
}

function addnewField(a)
{
    var tbody_selector = '.field_tbody_' + a;
    count = 0;
    $('tr[class^="kb_dp_tr"]').each(function () {
        if (indicator == 0) {
            count = count + 1;
        }
    })
    indicator = 0;
    var tr_selector = "kb_dp_tr_" + count;
    var html = '<tr class="kb_dp_tr_' + count + '"><td class="center">';
    for (var id_lang in languages) {
        html = html + '<div style="margin:2%">';
        html = html + '<input class="form-control text" name="text_' + count + '_' + languages[id_lang]['id_lang'] + '" data-id-lang="' + languages[id_lang]['id_lang'] + '" value="" type="text" placeholder="' + languages[id_lang]['name'] + '"></div>';
    }
    html = html + '</td>';
    html = html + '<td class="center"><input class="form-control value" name="value_' + count + '" data-type="float" value="0" type="text"></td>';
    html = html + '<td class="center"><div style="text-align:center"><a data-name="active"><i class="kb-material-icons icon-remove" onclick="makeDefault(this, ' + count + ',' + a + ')">close</i></a></div></td>';
    html = html + '<td class="center"><div style="text-align:center"><a data-class="field" href="#" class="btn btn-default" onclick="deleteOption(' + "'" + tr_selector + "'" + ')"><i class="kb-material-icons icon-trash">delete</i></a></div></td></tr>';
    count = count + 1;
    $(tbody_selector).prepend(html);
}

function deleteOption(a)
{
    var tr_selector = '.' + a;
    $(tr_selector).remove();
    count = count - 1;
}

function makeDefault(a, b, c)
{
    var rmv = 0;
    var default_selector = '.default_' + b;
    var tr_selector = '.kb_dp_tr_' + b;
    $('input[name^="default_"]').remove();

    if ($(a).hasClass('icon-remove')) {
        $('.kb_dp_val .icon-check').each(function () {
            $(this).attr('class', 'icon-remove');
            $(this).addClass('fa fa-remove');
        })
        $(a).attr('class', 'icon-check');
//        $(a).addClass('kb-material-icons');
        $(a).addClass('fa fa-check');
        $(tr_selector).append('<input class="form-control default_' + b + '" value="" type="hidden" name="default_' + b + '">');
        rmv = 0;
    } else {
        $(a).attr('class', 'icon-remove')
//        $(a).addClass('kb-material-icons');
        $(a).addClass('fa fa-remove');
        rmv = 1;
    }

    $.ajax({
        type: 'POST',
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=changeOptionDefault',
        data: {"changeOptionDefault": 1, "id_dynamic_field": c, "key": b, "remove": rmv},
        success: function (data) {
            showSuccessMessage(success_msg);
        }
    })
}

function saveFormula(type, dynamic_rule) {
    var formula = '';
    if (type == 'price') {
        formula = price_formula;
        var text = $('.price_block').text().replace(/\s/g, '');
        var placeholder = "";
        $("#formula_price_label").find("li").each(function () {
            placeholder = $(this).find("a").text(); // Find Placeholder Text
            placeholder = placeholder.replace(/\s+/g, '');  //Remove Space from the placeholder.

            var replace = '\\[' + placeholder + '\\]';
            var regularexpression = new RegExp(replace, "g");
            text = text.replace(regularexpression, "(2)");  //Replace Placeholder with Any number.
        });
    } else if (type == 'weight') {
        formula = weight_formula;
        var text = $('.weight_block').text().replace(/\s/g, '');
        var placeholder = "";
        $("#formula_weight_label").find("li").each(function () {
            placeholder = $(this).find("a").text(); // Find Placeholder Text
            placeholder = placeholder.replace(/\s+/g, '');  //Remove Space from the placeholder.

            var replace = '\\[' + placeholder + '\\]';
            var regularexpression = new RegExp(replace, "g");
            text = text.replace(regularexpression, "(2)");  //Replace Placeholder with Any number.
        });
    } else {
        formula = quantity_formula;
        var text = $('.quantity_block').text().replace(/\s/g, '');
        var placeholder = "";
        $("#formula_quantity_label").find("li").each(function () {
            placeholder = $(this).find("a").text(); // Find Placeholder Text
            placeholder = placeholder.replace(/\s+/g, '');  //Remove Space from the placeholder.

            var replace = '\\[' + placeholder + '\\]';
            var regularexpression = new RegExp(replace, "g");
            text = text.replace(regularexpression, "(2)");  //Replace Placeholder with Any number.
        });
    }
    try {
        eval(text);
        $.ajax({
            type: 'POST',
            url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=saveFormula',
            data: {"saveFormula": 1, "id_dynamic_rule": dynamic_rule, "formula_for": type, "formula": formula},
            success: function (data) {
                showSuccessMessage(success_msg);
            }
        })
    } catch (e) {
        showErrorMessage(formula_err_msg)
    }
}

function addnewImageField(a)
{
    var input = document.createElement('INPUT');
    var picker = new jscolor(input)
    picker.fromHSV(360 / 100 * 1, 100, 100);
    var tbody_selector = '.field_tbody_' + a;
    count1 = 1;
    $('tr[class^="kb_dp_tr"]').each(function () {
        if (indicator1 == 0) {
            count1 = count1 + 1;
        }
    })
    indicator1 = 0;
    var tr_selector = "kb_dp_tr_" + count1;
    var html = '<tr class="kb_dp_tr_' + count1 + '"><td class="center">';
    for (var id_lang in languages) {
        html = html + '<div style="margin:2%">';
        html = html + '<input class="form-control text" name="text_' + count1 + '_' + languages[id_lang]['id_lang'] + '" data-id-lang="' + languages[id_lang]['id_lang'] + '" value="" type="text" placeholder="' + languages[id_lang]['name'] + '"></div>';
    }
    html = html + '</td>';
    html = html + '<td class="center"><input class="form-control value" name="value_' + count1 + '" value="0" type="text"></td>';
    html = html + '<td class="center"><input class="form-control thumbnail jscolor" name="thumbnail_' + count1 + '" value="#fffff" type="text"></td>';
    html = html + '<td class="center"><div style="text-align:center"><a data-name="active"><i class="kb-material-icons icon-remove" onclick="makeDefaultForColorList(this, ' + count1 + ',' + a + ' )">close</i></a></div></td>';
    html = html + '<td class="center"><div style="text-align:center"><a data-class="field" href="#" class="btn btn-default" onclick="deleteImageOption(' + "'" + tr_selector + "'" + ')"><i class="kb-material-icons icon-trash">delete</i></a></div></td></tr>';
    $(input).attr('class', 'form-control thumbnail jscolor')
    $(input).attr('name', 'thumbnail_' + count1)
    $(input).attr('type', "text")
    var name_selector = 'thumbnail_' + count1;
    count1 = count1 + 1;
    $(tbody_selector).prepend(html);
    $('input[name=' + name_selector + ']').replaceWith(input);
}

function deleteImageOption(a)
{
    var tr_selector = '.' + a;
    $(tr_selector).remove();
    count1 = count1 - 1;
}

function makeDefaultForColorList(a, b, c)
{
    var rmv = 0;
    var default_selector = '.default_' + b;
    var tr_selector = '.kb_dp_tr_' + b;
    $('input[name^="default_"]').remove();

    if ($(a).attr('class') == 'icon-remove') {
        $('.kb_dp_val .icon-check').each(function () {
            $(this).attr('class', 'icon-remove');
//            $(this).addClass('kb-material-icons');
            $(this).addClass('fa fa-remove');
        })
        $(a).attr('class', 'icon-check')
//        $(a).addClass('kb-material-icons');
        $(a).addClass('fa fa-check');
        $(tr_selector).append('<input class="form-control default_' + b + '" value="" type="hidden" name="default_' + b + '">');
        rmv = 0;
    } else {
        $(a).attr('class', 'icon-remove')
//        $(a).addClass('kb-material-icons');
        $(a).addClass('fa fa-remove');
        $(default_selector).val(0);
        rmv = 1;
    }

    $.ajax({
        type: 'POST',
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime() + '&ajax=true&method=changeOptionDefaultForColorlist',
        data: {"changeOptionDefaultForColorlist": 1, "id_dynamic_field": c, "key": b, "remove": rmv},
        success: function (data) {
            showSuccessMessage(success_msg);
        }
    })
}