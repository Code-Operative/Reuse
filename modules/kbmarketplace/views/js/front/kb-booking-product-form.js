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

var img_file = {};
var mainTaxArray = [];
$(window).load(function () {

});
$(document).ready(function () {
    /* changes by rishabh jain
     * to show price tax inclusive
     */

    /* changes over */
    if ($(".datepicker").length > 0)
        $(".datepicker").datepicker({
            prevText: '',
            nextText: '',
            minDate: 'dateToday',
            dateFormat: 'yy-mm-dd'
        });

    $('#product-img-uploader').on('click', function () {
        $('#upload-error').hide();
        $('#upload-error').html('');
        $('#product-img-uploader-btn').trigger('click');
    });

    $('#product-img-uploader-btn').change(function (e) {
        if ($(this)[0].files !== undefined && $(this)[0].files.length > 0)
        {
            var has_invalid_file = false;
            for (var i = 0; i < $(this)[0].files.length; i++) {
                var image = $(this)[0].files[i];
                if (checkImgMediaUpload(image.type)) {
                    img_file["index-" + i] = image;
                    var name = '';
                    name += image.name;

                    var image_info_html = '<div id="uploaded-img-info-' + i + '" class="uploaded-img-info">';
                    image_info_html += '<i class="kb-material-icons">&#xE88F;</i>';
                    image_info_html += '<span class="new-img-name">' + name.slice(0, -2) + ' (' + humanizeSize(image.size) + ')' + '</span>';
                    image_info_html += '<a href="javascript:void(0)" onclick="removeTempImage(' + i + ')" class="kbbtn btn-danger" ><i class="kb-material-icons">&#xE872;</i><span>' + remove + '</span></a>';
                    image_info_html += '</div>';

                    $('#img-upload-info-block-container').append(image_info_html);
                } else {
                    has_invalid_file = true;
                }
            }
            if (has_invalid_file) {
                $('#upload-error').html(kb_img_format_error);
                $('#upload-error').show();
            }
        } else // Internet Explorer 9 Compatibility
        {
            var name = $(this).val().split(/[\\/]/);
            $('#new-img-name').html(name[name.length - 1]);
        }

        $('#pro-img-upload-section #star-upload-btn').bind('click');
        $('#pro-img-upload-section #remove-upload-btn').bind('click');
        $('#img-upload-info-block').show();
    });

    $('#pro-img-upload-section #remove-upload-btn').on('click', function () {
        $('#img-upload-info-block').hide();
        $('input[name="legend"]').val('')
        $('#product-img-uploader-btn').val('');
        $('#new-img-name').html('');
        $('#pro-img-upload-section #remove-upload-btn').unbind('click');
        $('#pro-img-upload-section #star-upload-btn').unbind('click');
    });

    $('#pro-img-upload-section #star-upload-btn').on('click', function () {
        uploadNewImage();
    });

    $("#addShipping").on('click', function () {
        $('#availableShipping option:selected').each(function () {
            $('#selectedShipping').append("<option value='" + $(this).val() + "'>" + $(this).text() + "</option>");
            $(this).remove();
        });
        $('#selectedShipping option').prop('selected', true);
        if ($('#selectedShipping').find("option").length == 0)
            $('#shipping-selection-msg').show();
        else
            $('#shipping-selection-msg').hide();
    });
    $("#removeShipping").on('click', function () {
        $('#selectedShipping option:selected').each(function () {
            $('#availableShipping').append("<option value='" + $(this).val() + "'>" + $(this).text() + "</option>");
            $(this).remove();
        });
        $('#selectedShipping option').prop('selected', true);
        if ($('#selectedShipping').find("option").length == 0)
            $('#shipping-selection-msg').show();
        else
            $('#shipping-selection-msg').hide();
    });

    if ($('#selectedShipping').find('option').length > 0) {
        $('#selectedShipping').find('option').attr('selected', 'selected');
    }

    $('#kb_category_tree_container').on('click', 'input[type="checkbox"]', function () {
        var tree_id_category = $(this).val();
        if ($(this).is(':checked') && $('#pro_category_default option[value="' + tree_id_category + '"]').length == 0) {

            for (var i in product_categories_for_default) {
                if (product_categories_for_default[i].id_category == tree_id_category) {
                    if ($('#pro_category_default option[value=""]').length == 1) {
                        $('#pro_category_default').html('');
                    }
                    $('#pro_category_default').append('<option value="' + product_categories_for_default[i].id_category + '">' + product_categories_for_default[i].name + '</option>');
                    break;
                }
            }
        } else {
            $('#pro_category_default option[value="' + tree_id_category + '"]').remove();
            if ($('#pro_category_default option').length == 0) {
                var no_option_title = 'Select';
                $('#pro_category_default').append('<option value="">' + no_option_title + '</option>');
            }
        }
    });

    $('#kb-product-form #kb_product_duplicate_btn').on('click', function () {
        $('#kb-product-form #kb_product_duplicate_btn').css('pointer-events', 'none');
    });

    $('select[name="period_type"]').on('change', function () {
        if ($(this).val() == 'date') {
            $('.kb_booking_time_range').find('th.kb_time_from_th').hide();
            $('.kb_booking_time_range').find('th.kb_time_to_th').hide();
            $('.kb_booking_time_range').find('td.kb_time_from_td').hide();
            $('.kb_booking_time_range').find('td.kb_time_to_td').hide();
            $('.kb_booking_time_range').removeClass('col-lg-7').addClass('col-lg-3');
            $('button[name="addkbTimeField"]').hide();
            $('.kb-date-time-block').show();
            $('.kb_booking_time_range tbody').each(function () {
                $(this).find('tr').not('tr:first').remove();
            });
            if ($('input[name="kb_product_type"]').val() == 'daily_rental') {
                $('input[name="min_days"]').parent().parent().show();
                $('input[name="max_days"]').parent().parent().show();
                $('input[name="min_days"]').addClass('required');
                $('input[name="max_days"]').addClass('required');
            }

        } else if ($(this).val() == 'date_time') {
            $('.kb_booking_time_range').find('th.kb_time_from_th').show();
            $('.kb_booking_time_range').find('th.kb_time_to_th').show();
            $('.kb_booking_time_range').find('td.kb_time_from_td').show();
            $('.kb_booking_time_range').find('td.kb_time_to_td').show();
            $('.kb_booking_time_range').removeClass('col-lg-3').addClass('col-lg-7');
            $('.kb-date-time-block').show();
//            $('.kb_booking_time_range').find('td .kb-time-slot-row-remove').hide();
            $('button[name="addkbTimeField"]').show();
            $('.kb_booking_time_range').show();
            if ($('input[name="kb_product_type"]').val() == 'daily_rental') {
                $('input[name="min_days"]').parent().parent().hide();
                $('input[name="max_days"]').parent().parent().hide();
                $('input[name="min_days"]').removeClass('required');
                $('input[name="max_days"]').removeClass('required');
            }
            if ($('.kb-time-slot-row-remove').length == 1) {
                $('.kb-time-slot-row-remove').hide();
            } else {
                $('.kb-time-slot-row-remove').show();
            }
        }
        if ($('.kb-time-slot-row-remove').length == 1) {
            $('.kb-time-slot-row-remove').hide();
        } else {
            $('.kb-time-slot-row-remove').show();
        }
    }).change();

    $('button[name="addkbDateTimeField"]').click(function () {
        if ($('.kb-date-time-block .kb-datetime-row').length) {
            block_number = $('.kb-date-time-block .kb-datetime-row').length + 1;
        }
        $.ajax({
            type: 'POST',
            headers: {"cache-control": "no-cache"},
            url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
            async: true,
            cache: false,
            dataType: "json",
            data: 'ajax=true&method=addDateTimeRow&counter=' + block_number + '&id_booking_product=' + $('input[name="id_booking_product"]').val(),
            beforeSend: function () {

            },
            success: function (json) {
                $('.kb-date-time-block').find('button[name="addkbDateTimeField"]').closest('div').before(json);
                if ($('select[name="period_type"]').val() == 'date') {
                    $('.kb_booking_time_range').find('th.kb_time_from_th').hide();
                    $('.kb_booking_time_range').find('th.kb_time_to_th').hide();
                    $('.kb_booking_time_range').find('td.kb_time_from_td').hide();
                    $('.kb_booking_time_range').find('td.kb_time_to_td').hide();
                    $('.kb_booking_time_range').removeClass('col-lg-7').addClass('col-lg-3');
                    $('button[name="addkbTimeField"]').hide();
                }
                if ($(".kb_date_from").length > 0) {
                    $(".kb_date_from").datepicker({
                        prevText: '',
                        nextText: '',
                        minDate: 'dateToday',
                        dateFormat: 'yy-mm-dd'
                    });
                }
                if ($(".kb_end_date").length > 0) {
                    $(".kb_end_date").datepicker({
                        prevText: '',
                        nextText: '',
                        minDate: 'dateToday',
                        dateFormat: 'yy-mm-dd'
                    });
                }
                if ($('.kb-time-slot-row-remove').length == 1) {
                    $('.kb-time-slot-row-remove').hide();
                } else {
                    $('.kb-time-slot-row-remove').show();
                }
            }
        });


        event.preventDefault();
        return false;
    });

    if ($("#enable_product_map").val() == '1') {
        $('#latitude').addClass('required');
        $('#longitude').addClass('required');
        $('#address').addClass('required');
    } else {
        $('#latitude').removeClass('required');
        $('#longitude').removeClass('required');
        $('#address').removeClass('required');
    }

    $("#enable_product_map").change(function () {
        if ($("#enable_product_map").val() == '1') {
            $('#latitude').addClass('required');
            $('#longitude').addClass('required');
            $('#address').addClass('required');
        } else {
            $('#latitude').removeClass('required');
            $('#longitude').removeClass('required');
            $('#address').removeClass('required');
        }
    });

    if ($('.kb-time-slot-row-remove').length == 1) {
        $('.kb-time-slot-row-remove').hide();
    } else {
        $('.kb-time-slot-row-remove').show();
    }

});

function displayFacilityRow(id_facility, name) {
    if (typeof kb_id_product != 'undefined') {
        if ($('#kb_product_combination_list .kb-empty-table').length) {
            $('#kb_product_combination_list .kb-empty-table').remove();
        }
        $("#kb_product_combination_list tr#" + id_facility).remove();
        var line = $("#new_facility_template").html();
        line = line.replace(/FacilityId/g, id_facility);
        line = line.replace(/FacilityName/g, name);
        $("#kb_product_combination_list").append(line);

        $('#combination-section-msg').show();
    }
}
function editFacility(id_facility)
{
    $('#new-combination-form').find('.kb-validation-error').remove();
    /* changes by rishabh jain */
    if (id_facility == 0) {
        var kbmapfacilities = $('input[name="kb-added-facilities-data"]');
        if (kbmapfacilities.val() != '') {
            var mapped_facilities = kbmapfacilities.val().split('-');
            $.each(mapped_facilities, function (idx, item) {
                if (item != '') {
                    $('.kb-productfacilities-dialogue-form tbody').find('tr#kb-added-product-facilites_' + item).hide();

                }
            });
        }
        if ($('.kb-productfacilities-dialogue-form tbody').find('tr').length == 1) {
            $('#kb-no-available-facilities').show();
        }

        $('#kb_facility_form_title').html(kb_new_facility_title);
        $('#kb-facility-modal-form #combination-loader').hide();
        $('#kb-facility-modal-form #facility-form-content').show();
        $('#kb-facility-modal-form').show();
        $("html, body").animate({scrollTop: 0}, '500');
    }
    }

function mapFacilities() {

if (typeof kb_available_facilities_data != 'undefined') {
        var available_facilites = $.parseJSON(kb_available_facilities_data);
    var selected_array = [];
        var kbmapfacilities = $('input[name="kb-added-facilities-data"]');
        $('input[name="selected_add_facilities[]"]:checked').each(function (i) {
            selected_array.push($(this).val());
        });
        if (selected_array.length) {
            $.ajax({
                type: 'POST',
                headers: {"cache-control": "no-cache"},
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
                async: true,
                cache: false,
                dataType: "json",
                data: 'ajax=true'
                    + '&method=addProductFacilities&token=' + prestashop.static_token
                    + '&id_booking_product=' + $('input[name="id_booking_product"]').val()
                    + '&selected_facilities=' + selected_array,
                beforeSend: function () {
                    $('#new-combination-form').attr('disable', true);
                    $('#combination-updating-progress').css('display', 'inline-block');
                },
                success: function (json)
                {
//                    console.log(json['data']);

                    if (json['status'] == true) {

                        if (json['data'].length) {
                            for (i = 0; i < json['data'].length; i++) {
//                                json['data'].i.name
                                displayFacilityRow(json['data'][i][id_facility], json['data'][i][name]);

                            }
                        }
//                        if (json['data'].id_facility > 0) {
//                            $('.kb-productfacilities-dialogue-form tbody').find('tr#kb-added-product-facilites_' + json['data'].id_facility).remove();
//                        }
                        $('#kb-facility-modal-form').hide();
                        $('#kb-facility-modal-form #combination-loader').show();
                        $('#kb-facility-modal-form #combination-form-content').hide();
                        jAlert(json['msg'] ,alert_heading);
                        location.reload();
                    } else {
                        var error_html = '';
                        for (var i = 0; i < json['errors'].length; i++)
                            error_html += json['errors'][i] + '<br>';
                        jAlert(error_html ,alert_heading);
                    }
                    $('#combination-updating-progress').css('display', 'none');
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    jAlert(kb_ajax_request_fail_err ,alert_heading);
                    $('#combination-updating-progress').css('display', 'none');
                }
            });
        } else {
            jAlert(kb_select_facility ,alert_heading);
        }
    }
    return false;
}

function addTimeSlotRow(elm)
{
//    if ($(elm).closest('.kb_booking_time_range').find('table tbody tr').length == 1) {
//        $(elm).closest('.kb_booking_time_range').find('.kb-time-slot-row-remove').show();
//    }
    var block_number = 1;
    var current_step = $(elm);
    if (current_step.closest('.kb_booking_time_range').find('input[name^=kb_time_from]').length) {
        block_number = $(elm).closest('.kb_booking_time_range').find('input[name^=kb_time_from]').length + 1;
    }

    var block_date_row_id = $(elm).closest('.kb-datetime-row').attr('id');
    var block_date_row = block_date_row_id.split('_');
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true&method=addTimeRow&counter=' + block_number + '&datetime_block=' + block_date_row[1] + '&id_booking_product=' + $('input[name="id_booking_product"]').val(),
        beforeSend: function () {

        },
        success: function (json) {
            current_step.closest('.kb_booking_time_range').find('table tbody').append(json);
            if ($('.kb-time-slot-row-remove').length == 1) {
                $('.kb-time-slot-row-remove').hide();
            } else {
                $('.kb-time-slot-row-remove').show();
            }
//            $('.kb_time_from,.kb_time_to').timepicker({
//                showDate: false,
//                timeFormat: 'hh:mm tt',
//                currentText: currentText,
//                closeText: closeText,
//                timeOnlyTitle: timeonlytext,
//            });
        }
    });

    event.preventDefault();
    return false;
}

function deleteFacility(id_facilities) {
    var kb_booking_id = $('input[name="id_booking_product"]').val();
    if (kb_booking_id != '') {
        if ($('input[name="kb-added-facilities-data"]').val() != '') {
            $.ajax({
                type: 'POST',
                headers: {"cache-control": "no-cache"},
                url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
                async: true,
                cache: false,
                dataType: "json",
                data: 'ajax=true'
                    + '&method=removeProductFacilities&token=' + prestashop.static_token
                    + '&id_booking_product=' + kb_booking_id
                    + '&id_facilities=' + id_facilities,
                beforeSend: function () {
                },
                success: function (json)
                {
                    if (json['status'] == true) {
                        jAlert(json['msg'] ,alert_heading);
                        location.reload();

                        if ($('#facility_row_' + id_facilities).length) {
                            $('#facility_row_' + id_facilities).remove();
                        }
//                        $('#table-product-facilities-list tbody#kb-append-facilities-data').find('tr#kb-already-product-facilites_' + id_facilities).remove();
//                        if (json['data'].id_facility > 0) {
//                            displayFacilityRow(json['data'].id_facility, json['data'].name);
//                            $('.kb-productfacilities-dialogue-form tbody').find('tr#kb-added-product-facilites_' + json['data'].id_facility).remove();
//                        }
                        if (!$('#kb_product_combination_list tr').length) {
                            $('#kb_product_combination_list').html('<tr><td colspan="3" class="kb-tcenter kb-empty-table">' + kb_no_facility_msg + '</td></tr>');
                        }
                    } else {
                        var error_html = '';
                        for (var i = 0; i < json['errors'].length; i++)
                            error_html += json['errors'][i] + '<br>';
                        jAlert(error_html ,alert_heading);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                }
            });

        } else {
            if (!$('#kb_product_combination_list tr').length) {
                $('#kb_product_combination_list').html('<tr><td colspan="3" class="kb-tcenter kb-empty-table">' + kb_no_facility_msg + '</td></tr>');
            }
        }
    }
}

function addProductKbFacilities()
{
    var kb_booking_id = $('input[name="kb_booking_id"]').val();
    if (kb_booking_id != '') {
        $('.kb-productfacilities-dialogue-form tbody').find('tr').show();
        $('input[name="selected_add_facilities[]"]').prop('checked', false);
        var $kbmapfacilities = $('input[name="kb-added-facilities-data"]');
        if ($kbmapfacilities.val() != '') {
            var mapped_facilities = $kbmapfacilities.val().split('-');
            $.each(mapped_facilities, function (idx, item) {
                if (item != '') {
                    $('.kb-productfacilities-dialogue-form tbody').find('tr#kb-added-product-facilites_' + item).hide();

                }
            });
        }

        $('.kb-productfacilities-dialogue-form tr#kb-no-available-facilities').hide();
        $('#kbaddFacilitiesBlockModel').modal({
            show: 'true',
        });
        $('#kbaddFacilitiesBlockModel').on('shown.bs.modal', function () {
            if ($('.kb-productfacilities-dialogue-form tbody').find('tr:visible').length <= 0) {
                $('.kb-productfacilities-dialogue-form tr#kb-no-available-facilities').show();
            }
        });
        return false;

    } else {

    }
}

function validateRoomForm() {
    var error = false;
    $('#kb-product-room-form').find('.kb-validation-error').remove();
    $('#kb-product-room-form input[type="text"]').each(function () {
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
        } else if (value != '' && $(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate'))) {
            error = true;
            $(this).parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
        }
    });

    if ($('#room_type').val() === '') {
        error = true;
        $('#room_type').parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
    }

    if ($('#room_category').val() === '') {
        error = true;
        $('#room_category').parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
    }




//    if ($("#end_time").length && $("#start_time").length) {
//        var start_time = Date.parse('2019-01-01 ' + $('#start_time').val());
//        var end_time = Date.parse('2019-01-01 ' + $('#end_time').val());
//        if (parseInt(end_time) <= parseInt(start_time)) {
//            error = true;
//            if ($('#end_time').parent().parent().find('.kb-validation-error').length == 0) {
//                $('#end_time').parent().parent().append('<div class="kb-validation-error">' + min_max_hrs_valid + '</div>');
//            }
//        }
//        var start_time = Date.parse($('#start_time').val());
//        var end_time = Date.parse($('#end_time').val());
//        if (parseInt(end_time) <= parseInt(start_time)) {
//            error = true;
//            if ($('#end_date').parent().parent().find('.kb-validation-error').length == 0) {
//                $('#end_date').parent().parent().append('<div class="kb-validation-error">' + min_max_hrs_valid + '</div>');
//            }
//        }
//    }
//    if (!kbValidateField($(this).find('.kb_time_from').val(), 'isTime')) {
//        error = true;
//        date_error = true;
//        $(this).find('.kb_time_from').addClass('error_field');
//        $(this).find('.kb_time_from').closest('.input-group').after('<span class="error_message" style="text-align: left;">' + invalid_time + '</span>');
//    }
    // changes
//    if ($('#product_room_images').length) {
//        if ($('#product_room_images').get(0).files.length) {
//            for (var i = 0; i < $('#product_room_images').get(0).files.length; ++i) {
//                var file1 = $("#product_room_images").get(0).files[i].name;
//                if (file1) {
//                    var file_size = $("#product_room_images").get(0).files[i].size;
//                    if (file_size < 2097152) {
//                        var ext = file1.split('.').pop().toLowerCase();
//                        if ($.inArray(ext, ['jpg', 'jpeg', 'gif', 'png']) === -1) {
//                            error = true;
//                            $("#product_room_images").closest('.form-group').find('.input-group').addClass('error_field');
//                            $('#product_room_images').closest('.form-group').after('<p class="error_message">' + file1 + ': ' + kb_image_valid + '</p>');
//                        }
//                    } else {
//                        error = true;
//                        $("#product_room_images").closest('.form-group').find('.input-group').addClass('error_field');
//                        $('#product_room_images').closest('.form-group').after('<p class="error_message">' + file1 + ': ' + kb_image_size_valid + '</p>');
//                    }
//                }
//            }
//        }
//    }
//    $('#product_room_images').on('change', function () {
//    $("#product_room_images").closest('.form-group').find('.input-group').removeClass('error_field');
//    $('.error_message').remove();
//    if ($('#product_room_images').get(0).files.length) {
//        for (var i = 0; i < $('#product_room_images').get(0).files.length; ++i) {
//            var file1 = $("#product_room_images").get(0).files[i].name;
//            if (file1) {
//                var file_size = $("#product_room_images").get(0).files[i].size;
//                if (file_size < 2097152) {
//                    var ext = file1.split('.').pop().toLowerCase();
//                    if ($.inArray(ext, ['jpg', 'jpeg', 'gif', 'png']) === -1) {
//                        showErrorMessage(file1 + ': ' + kb_image_valid);
//                        $("#product_room_images").closest('.form-group').find('.input-group').addClass('error_field');
//                        $('#product_room_images').closest('.form-group').after('<p class="error_message">' + file1 + ': ' + kb_image_valid + '</p>');
//                    }
//                } else {
//                    showErrorMessage(file1 + ': ' + kb_image_size_valid);
//                    $("#product_room_images").closest('.form-group').find('.input-group').addClass('error_field');
//                    $('#product_room_images').closest('.form-group').after('<p class="error_message">' + file1 + ': ' + kb_image_size_valid + '</p>');
//                }
//            }
//        }
//    }
//    });
    // change sover
    if (error) {
        return false;
    } else {
        $('#kb-product-room-form').submit();
    }
}
/* changes over */
function removeTempImage(index)
{
    $('#uploaded-img-info-' + index).remove();
    img_file["index-" + index] = undefined;
    if ($('#img-upload-info-block-container .uploaded-img-info').length == 0) {
        img_file = {};
        $('#img-upload-info-block').hide();
        $('input[name="legend"]').val('')
        $('#product-img-uploader-btn').val('');
        //$('#new-img-name').html('');
        //$('#pro-img-upload-section #remove-upload-btn').unbind('click');
        $('#pro-img-upload-section #star-upload-btn').unbind('click');
    }
}


function humanizeSize(bytes)
{
    if (typeof bytes !== 'number') {
        return '';
    }

    if (bytes >= 1000000000) {
        return (bytes / 1000000000).toFixed(2) + ' GB';
    }

    if (bytes >= 1000000) {
        return (bytes / 1000000).toFixed(2) + ' MB';
    }

    return (bytes / 1000).toFixed(2) + ' KB';
}

function updateLinkRewrite(e)
{
    var value = $(e).val();
    $('input[name="link_rewrite_' + $(e).attr('lang-id') + '"]').val(str2url(value));
    $('input[name="link_rewrite_' + $(e).attr('lang-id') + '"]').trigger('keyup');
}

function uploadNewImage()
{
    if (kb_id_product > 0) {
        var img_data = new FormData();
        var img_index = 0;
        $.each(img_file, function (key, value) {
            if (img_file[key] != undefined) {
                img_data.append('file[' + img_index + ']', value);
                img_index++;
            }
        });

        img_data.append('ajax', true);
        img_data.append('id_product', kb_id_product);
        img_data.append('method', 'addProductImage');
        img_data.append('token', prestashop.static_token);
        img_data.append('legend', $('input[name="legend"]').val());

        $.ajax({
            type: 'POST',
            headers: {"cache-control": "no-cache"},
            processData: false,
            contentType: false,
            url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
            async: true,
            cache: false,
            dataType: "json",
            data: img_data,
            beforeSend: function () {
                $('#img-upload-error').hide();
                $('#img-upload-error').removeClass('kbalert-danger');
                $('#img-upload-error').removeClass('kbalert-success');
                $('#pro-img-upload-section #star-upload-btn').attr('disabled', 'disabled');
                $('#pro-img-upload-section #remove-upload-btn').attr('disabled', 'disabled');
                $('#uploading-progress').show();
            },
            complete: function () {
                $('#pro-img-upload-section #star-upload-btn').removeAttr('disabled');
                $('#pro-img-upload-section #remove-upload-btn').removeAttr('disabled');
            },
            success: function (json)
            {
                var mesg = '';
                var has_error = false;
                if (json.file != undefined && json.file.length > 0) {
                    for (var i in json.file) {
                        if (json.file[i].error != '') {
                            mesg += json.file[i].error + '<br>';
                            has_error = true;
                        } else {
                            img_file["index-" + i] = undefined;
                            $('#img-upload-info-block-container #uploaded-img-info-' + i).remove();
                            mesg = json.file[i].status;
                            var legend = '';
                            if (json.file[i].legend != null || json.file[i].legend != '') {
                                legend = json.file[i].legend;
                            }
                            displayNewLineImage(json.file[i].id, json.file[i].path, json.file[i].position, json.file[i].cover, legend);

                            //Update combination form
                            if (typeof ('updateCombinationFormImage') === typeof (Function))
                                updateCombinationFormImage(json.file[i].id, json.file[i].path, legend);
                        }
                    }
                }

                if (has_error) {
                    $('#img-upload-error').html('<i class="kb-material-icons">&#xE872;</i> ' + mesg);
                    $('#img-upload-error').addClass('kbalert-danger');
                } else {
                    $('#img-upload-error').html('<i class="kb-material-icons">&#xE065;</i> ' + mesg);
                    $('#img-upload-error').addClass('kbalert-success');
                    $('#img-upload-info-block').hide();
                    $('input[name="legend"]').val('');
                }
                $('#img-upload-error').show();
                setTimeout(function () {
                    $('#img-upload-error').hide();
                }, message_delay);
                $('#uploading-progress').hide();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                jAlert(kb_ajax_request_fail_err ,alert_heading);
                $('#uploading-progress').hide();
            }
        });
    } else {
        return jAlert(kb_img_save_error ,alert_heading);
    }
}

function deleteImage(e)
{
    var cfm = confirm(kb_delete_confirmation);
    if (cfm) {
        $.ajax({
            type: 'POST',
            headers: {"cache-control": "no-cache"},
            url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
            async: true,
            cache: false,
            dataType: "json",
            data: 'ajax=true'
                + '&method=deleteImage&token=' + prestashop.static_token
                + '&id_image=' + $(e).attr('data-id')
                + '&id_product=' + kb_id_product
                + '&id_category=' + kb_product_default_category,
            beforeSend: function () {
                $('#img-upload-error').hide();
                $('#img-upload-error').removeClass('kbalert-danger');
                $('#img-upload-error').removeClass('kbalert-success');
            },
            complete: function () {
            },
            success: function (json)
            {
                var mesg = '';
                if (json['status'] == true) {
                    $('#img-upload-error').html('<i class="kb-material-icons">&#xE065;</i> ' + json['msg']);
                    $('#img-upload-error').addClass('kbalert-success');
                    $('#product-images tr#' + $(e).attr('data-id')).remove();

                    if (!$('#product-images tr').length) {
                        $('#product-images').html('<tr><td colspan="5" class="kb-tcenter kb-empty-table">' + kb_no_image_msg + '</td></tr>');
                    }
                    if (json['images'] != undefined && json['images'].length > 0) {
                        for (var i in json['images']) {
                            if ($("#product-images tr").length) {
                                $('#product-images tr').each(function () {
                                    if ($(this).attr('id') == json['images'][i].id) {
                                        $(this).find('.img-position').val(json['images'][i].position);
                                    }
                                });
                            }

                        }
                    }
                    //Delete image from combination form
//                    $('#combination-imgs-list #combination-form-image_' + $(e).attr('data-id')).remove();

                    updateCover();

                } else {
                    $('#img-upload-error').html('<i class="kb-material-icons">&#xE88F;</i> ' + json['msg']);
                    $('#img-upload-error').addClass('kbalert-danger');
                }
                $('#img-upload-error').show();
                setTimeout(function () {
                    $('#img-upload-error').hide();
                }, message_delay);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                jAlert(kb_ajax_request_fail_err ,alert_heading);
            }
        });
    }

}

function updateCover()
{
    if ($("#product-images tr").length) {
        if (!$('#product-images input[type="radio"]:checked').length) {
            $('#product-images input[type="radio"]').each(function () {
                $(this).attr('checked', true);
                $(this).parent().addClass('checked');
                return;
            });
        }
    }
}

function addNewPolicy() {
    $('#new-policy-form').find('.kb-validation-error').remove();
    $('#kb-policy-modal-form').show();
    $('#policy-form-content').show();
    $("html, body").animate({scrollTop: 0}, '500');
}
function toggleStatus(e) {
    if ($(e).is(':checked')) {
        $(e).parent().find('input[type="text"]').attr('disabled', false);
        $(e).parent().parent().find('.rm_policy_options_text').show();
    } else {
        $(e).parent().find('input[type="text"]').attr('disabled', true);
        $(e).parent().parent().find('.rm_policy_options_text').hide();
    }

}

function savePolicy() {
    // changes by rishabh jain
    $('#new-policy-form').find('.kb-validation-error').remove();
    $('#new-policy-form-msg').html('');
    $('#new-policy-form-msg').removeClass('kbalert-danger');
    $('#new-policy-form-msg').removeClass('kbalert-success');
    var error = false;

    // validation
    $('#new-policy-form input.add_policy_new').each(function () {
        if ($(this).val() == '') {
            error = true;
            $(this).parent().append('<div class="kb-validation-error">' + policy_title_error + '</div>');
        } else {

        }
    });
    $('#new-policy-form textarea.add_policy_new_term').each(function () {
        if ($(this).val() == '') {
            error = true;
            $(this).parent().append('<div class="kb-validation-error">' + policy_terms_error + '</div>');
        }
    });
    var numPattern = /^\d+$/;
    if ($('#credit_check').is(':checked')) {
        if ($('#credit').val() == '') {
            error = true;
            $('#credit').parent().append('<div class="kb-validation-error">' + credit_error + '</div>');
        } else if (!numPattern.test($('#credit').val())) {
            error = true;
            $('#credit').parent().append('<div class="kb-validation-error">' + requiredNumber + '</div>');
        } else if ($('#credit').val() >= 1000 || $('#credit').val() <= 0) {
            error = true;
            $('#credit').parent().append('<div class="kb-validation-error">' + number_days_error + '</div>');
        }
    }

    if ($('#refund_check').is(':checked')) {
        if ($('#Refund').val() == '') {
            error = true;
            $('#Refund').parent().append('<div class="kb-validation-error">' + refund_error + '</div>');
        } else if (!numPattern.test($('#Refund').val())) {
            error = true;
            $('#Refund').parent().append('<div class="kb-validation-error">' + requiredNumber + '</div>');
        } else if ($('#Refund').val() >= 1000 || $('#Refund').val() <= 0) {
            error = true;
            $('#Refund').parent().append('<div class="kb-validation-error">' + number_days_error + '</div>');
        }
    }

    if ($('#replacement_check').is(':checked')) {
        if ($('#Replacement').val() == '') {
            error = true;
            $('#Replacement').parent().append('<div class="kb-validation-error">' + replacement_error + '</div>');
        } else if (!numPattern.test($('#Replacement').val())) {
            error = true;
            $('#Replacement').parent().append('<div class="kb-validation-error">' + requiredNumber + '</div>');
        } else if ($('#Replacement').val() >= 1000 || $('#Replacement').val() <= 0) {
            error = true;
            $('#Replacement').parent().append('<div class="kb-validation-error">' + number_days_error + '</div>');
        }
    }
    // validation over for supplier name


    // changes over

    if (!error)
    {
        $.ajax({
            type: 'POST',
            headers: {"cache-control": "no-cache"},
            url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
            async: true,
            cache: false,
            dataType: "json",
            data: 'ajax=true&method=saveReturnPolicy&token=' + prestashop.static_token + '&'
                + $('#new-policy-form input, #new-policy-form textarea').serialize()
                + '&id_product=' + kb_id_product
                + '&type=policy&policy_action_type=0',
            beforeSend: function () {
                $('#new-policy-form').attr('disable', true);
                $('#policy-updating-progress').css('display', 'inline-block');
            },
            success: function (json)
            {
                if (json['status'] == true) {
                    $('#kb-policy-modal-form-modal-form').hide();
                    $('#kb-policy-modal-form #policy-loader').show();
                    $('#kb-policy-modal-form #policy-form-content').hide();
                    //jAlert(json['msg'] ,alert_heading);
                    window.location = json['redirect_link'];
                } else {
                    var error_html = '';
                    for (var i = 0; i < json['errors'].length; i++)
                        error_html += json['errors'][i] + '<br>';
                    jAlert(error_html ,alert_heading);
                }
                $('#policy-updating-progress').css('display', 'none');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                jAlert(kb_ajax_request_fail_err ,alert_heading);
                $('#policy-updating-progress').css('display', 'none');
            }
        });
    }
}



/* fucntion added by rishabh jain*/

function displayNewLineImage(id, path, position, cover, legend)
{
    if ($('#product-images .kb-empty-table').length) {
        $('#product-images .kb-empty-table').remove();
    }
    var src_path = $('#kb_product_image_new_line_path').val();
    $("#lineType img").attr('src', src_path);
    var line = $("#lineType").html();

    line = line.replace(/image_id/g, id);
    line = line.replace(/image_path/g, path);
    line = line.replace(/image_position/g, position);
    if (legend == 'null') {
        line = line.replace(/image_legend/g, '');
    } else {
        line = line.replace(/image_legend/g, legend);
    }
    $("#product-images").append(line);
    var radio = $("#product-images tr").last().find('input[type="radio"]');
    if ($(radio).length) {
        if (cover == 1) {
            $(radio).attr('checked', true);
            $(radio).parent().addClass('checked');
        }
    }
}



function displayReturnPolicyRow(id_return_policy, policy_name, credit_days, refund_days, replacement_days) {
    if ($('#kb_return_policy_list .kb-empty-table').length) {
        $('#kb_return_policy_list .kb-empty-table').remove();
    }
    $("#kb_return_policy_list tr#" + id_return_policy).remove();
    var line = $("#new_policy_template").html();
    line = line.replace(/id_return_policy/g, id_return_policy);
    line = line.replace(/credit/g, credit_days);
    line = line.replace(/policy/g, policy_name);
    line = line.replace(/refund/g, refund_days);
    line = line.replace(/replacement/g, replacement_days);
    $("#kb_return_policy_list").append(line);
//    $('#combination-section-msg').show();

}
/* changes by rishabh jain
 *
 * @returns {undefined}on 11th Oct 2018
 * to add product tax field
 */
/* changes by rishabh jain */
/* function added by rishabh jain to add the functionality to select the discount type as percentage or fixed */

/* changes over */



var storeUsedGroups = {};


/* changes by rishabh jain */

/* changes over */
/**
 * Delete one or several attributes from the declination multilist
 */
var ints;
var id_product;
var selectedProduct;


function productFormatResult(item) {
    var itemTemplate = "<div class='media'>";
    itemTemplate += "<div class='pull-left'>";
    itemTemplate += "<img class='media-object' width='40' src='" + item.image + "' alt='" + item.name + "'>";
    itemTemplate += "</div>";
    itemTemplate += "<div class='media-body'>";
    itemTemplate += "<h4 class='media-heading'>" + item.name + "</h4>";
    itemTemplate += "<span>REF: " + item.ref + "</span>";
    itemTemplate += "</div>";
    itemTemplate += "</div>";
    return itemTemplate;
}

function productFormatSelection(item) {
    return item.name;
}



function submitProductForm(submission_type)
{
    if ($('#kb_lang_slector_booking_product').length) {
        $('#kb_lang_slector_booking_product').val(kb_default_lang);
        $('#kb_lang_slector_booking_product').trigger("change");
    }
    $('#kb-product-form').find('.error_tab').removeClass('error_tab');
    $('#kb-product-form').find('.kb-validation-error').remove();
    $('#kb-product-form-global-msg').hide();
    $('#kb-product-form-global-msg').html('');
    var error = false;



    $('#kb-product-form input[type="text"]').each(function () {
        value = $(this).val();
        value = value.trim();
        if ($(this).hasClass('required'))
        {
            if (value == '')
            {
                error = true;
                $(this).parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
                highlightProductErrorTab(this);
            } else {
                if ($(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate')))
                {
                    error = true;
                    $(this).parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
                    highlightProductErrorTab(this);
                }
            }
        } else if (value != '' && $(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate'))) {
            error = true;
            $(this).parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
            highlightProductErrorTab(this);
        }
    });

    //added to validate category of product
    if ($('#pro_category_default').val() == '') {
        error = true;
        $('#pro_category_default').parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
        highlightProductErrorTab('#pro_category_default');
    }
    if ($('#star_rating').length && $('#star_rating').val() == 0) {
        error = true;
        $('#star_rating').parent().parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
        highlightProductErrorTab('#star_rating');
    }
    //Product Special Price Validation

    var product_type = $('#kb_product_type').val();
    var glob_msg = '';

//    if (!$.inArray(product_type, kb_product_types)) {
//        error = true;
//        glob_msg = 'Product type is missing';
//    }
    var click = 1;

    if ($('input[name="id_booking_product"]').val()) {
        if (validateDateTimeData() == true) {
            error = true;
        }
//        error = validateDateTimeData();
    }
    if ($('input[name="min_days"]').length && $('input[name="min_days"]').is(':visible') && $('input[name="max_days"]').length && $('input[name="max_days"]').is(':visible')) {
        var min_days = parseInt($('input[name="min_days"]').val().trim());
        var max_days = parseInt($('input[name="max_days"]').val().trim());
        if (max_days <= min_days) {
            error = true;
            if ($('input[name="max_days"]').parent().parent().find('.kb-validation-error').length == 0) {
                $('input[name="max_days"]').parent().parent().append('<div class="kb-validation-error">' + min_max_days_valid + '</div>');
            }
            highlightProductErrorTab($('input[name="max_days"]'));
            error = true;
        }
    }
    if ($('input[name="min_hours"]').length && $('input[name="max_hours"]').length) {
        var min_hours = parseInt($('input[name="min_hours"]').val().trim());
        var max_hours = parseInt($('input[name="max_hours"]').val().trim());
        if (min_hours >= max_hours) {
            error = true;
            if ($('input[name="max_hours"]').parent().parent().find('.kb-validation-error').length == 0) {
                $('input[name="max_hours"]').parent().parent().append('<div class="kb-validation-error">' + min_max_hrs_valid + '</div>');
            }
            highlightProductErrorTab($('input[name="max_hours"]'));
        }
    }


    if (!error) {
        if (submission_type == 'savenstay') {
            $('#kb_submission_type').val('savenstay');
        } else {
            $('#kb_submission_type').val('save');
        }
        if (click == '1') {
            $('#kb-product-form').submit();
            $('#kb-product-form #submit_product_form_butn').css('pointer-events', 'none');
            click++;
        } else {
            $('#kb-product-form #submit_product_form_butn').css('pointer-events', 'none');
        }
    } else {
        if (glob_msg != '') {
            $('#kb-product-form-global-msg').html('<i class="icon-exclamation-sign"></i>' + kb_form_validation_error + '<br>' + glob_msg);
        } else {
            $('#kb-product-form-global-msg').html('<i class="icon-exclamation-sign"></i>' + kb_form_validation_error);
        }
        $('#kb-product-form-global-msg').show();
        $("html, body").animate({scrollTop: 0}, '500');
        return false;
    }
    return false;
}
function validateDateTimeData() {
    var error = false;
    $('#kb-product-form-DateTime').find('.error_message').remove();
    $('.kb-datetime-row').find('.error_message').remove();
    $('.kb-datetime-row').find('input[type="text"]').removeClass('error_field');
    var date_error = false;
    $('.kb-datetime-row').each(function () {
        var date_from_mand = velovalidation.checkMandatory($(this).find('.kb_date_from'));
        if (date_from_mand != true) {
            error = true;
            date_error = true;
            $(this).find('.kb_date_from').addClass('error_field');
            $(this).find('.kb_date_from').closest('.input-group').after('<span class="error_message" style="text-align: left;">' + empty_field + '</span>');
        }
        var date_to_mand = velovalidation.checkMandatory($(this).find('.kb_end_date'));
        if (date_to_mand != true) {
            error = true;
            date_error = true;
            $(this).find('.kb_end_date').addClass('error_field');
            $(this).find('.kb_end_date').closest('.input-group').after('<span class="error_message" style="text-align: left;">' + empty_field + '</span>');
        } else {
            var start_date = Date.parse($(this).find('.kb_date_from').val());
            var end_date = Date.parse($(this).find('.kb_end_date').val());
            if (parseInt(end_date) <= parseInt(start_date)) {
                error = true;
                date_error = true;
                $(this).find('.kb_date_from').addClass('error_field');
                $(this).find('.kb_end_date').addClass('error_field');
                $(this).find('.kb_booking_dates_range').append('<span class="error_message" style="text-align: left;">' + end_date_error + '</span>');
            }
        }


        $(this).find('.kb-time-tr').each(function () {
            if ($('select[name="period_type"]').val() == 'date_time') {
                var time_from_mand = velovalidation.checkMandatory($(this).find('.kb_time_from'));
                if (time_from_mand != true) {
                    error = true;
                    date_error = true;
                    $(this).find('.kb_time_from').addClass('error_field');
                    $(this).find('.kb_time_from').closest('.input-group').after('<span class="error_message" style="text-align: left;">' + empty_field + '</span>');
                } else if (!kbValidateField($(this).find('.kb_time_from').val(), 'isTime')) {
                    error = true;
                    date_error = true;
                    $(this).find('.kb_time_from').addClass('error_field');
                    $(this).find('.kb_time_from').closest('.input-group').after('<span class="error_message" style="text-align: left;">' + invalid_time + '</span>');
                }
                var time_to_mand = velovalidation.checkMandatory($(this).find('.kb_time_to'));
                if (time_to_mand != true) {
                    error = true;
                    date_error = true;
                    $(this).find('.kb_time_to').addClass('error_field');
                    $(this).find('.kb_time_to').closest('.input-group').after('<span class="error_message" style="text-align: left;">' + empty_field + '</span>');
                } else if (!kbValidateField($(this).find('.kb_time_to').val(), 'isTime')) {
                    error = true;
                    date_error = true;
                    $(this).find('.kb_time_to').addClass('error_field');
                    $(this).find('.kb_time_to').closest('.input-group').after('<span class="error_message" style="text-align: left;">' + invalid_time + '</span>');
                } else {
                    var start_time = Date.parse('2019-01-01 ' + $(this).find('.kb_time_from').val());
                    var end_time = Date.parse('2019-01-01 ' + $(this).find('.kb_time_to').val());
                    if (parseInt(end_time) <= parseInt(start_time)) {
                        error = true;
                        date_error = true;
                        $(this).find('.kb_time_from').addClass('error_field');
                        $(this).find('.kb_time_to').addClass('error_field');
                        $(this).after('<span class="error_message" style="text-align: left;">' + end_time_error + '</span>');
                    }
                }
            }
            var time_price_mand = velovalidation.checkMandatory($(this).find('.kb_time_price'));
            if (time_price_mand != true) {
                error = true;
                date_error = true;
                $(this).find('.kb_time_price').addClass('error_field');
                $(this).find('.kb_time_price').closest('.input-group').after('<span class="error_message" style="text-align: left;">' + empty_field + '</span>');
            } else {
                var time_price_valid = velovalidation.checkAmount($(this).find('.kb_time_price'));
                if (time_price_valid != true) {
                    error = true;
                    date_error = true;
                    $(this).find('.kb_time_price').addClass('error_field');
                    $(this).find('.kb_time_price').closest('.input-group').after('<span class="error_message" style="text-align: left;">' + empty_field + '</span>');
                }
            }
        });

    });
    if (!date_error) {
        var abc = [];
        $('.kb-datetime-row').each(function () {
            abc.push($(this).find('.kb_date_from').val().trim());
            abc.push($(this).find('.kb_end_date').val().trim());
        });

        var i, j;
        if (abc.length % 2 !== 0)
            throw new TypeError('Date range length must be a multiple of 2');
        for (i = 0; i < abc.length - 2; i += 2) {
            for (j = i + 2; j < abc.length; j += 2) {
                if (
                    dateRangeOverlaps(
                        abc[i], abc[i + 1],
                        abc[j], abc[j + 1]
                        )
                    )
                {
                    error = true;
                    date_error = true;
                    $('.kb-date-time-block').find('p.help-block').before('<p class="error_message">' + kb_date_override_string + ' ' + abc[i] + ' ' + kb_and_string + ' ' + abc[i + 1] + ' ' + kb_to_string + ' ' + abc[j] + ' ' + kb_and_string + ' ' + abc[j + 1] + '</p>');
                }

            }
        }

    }
    if (error) {
        highlightProductErrorTab($('.kb-datetime-row'));
        return true;
    } else {
        return false;
    }
}

function removeTimeRow(elm) {
//    if ($('.kb-datetime-row').length > 1) {
//    if ($(elm).closest('.kb_booking_time_range').find('table tbody tr').length == 2) {
//        $(elm).closest('.kb_booking_time_range').find('.kb-time-slot-row-remove').hide();
//    }
    if ($(elm).closest('.kb_booking_time_range').find('table tbody tr').length > 1) {
        $(elm).closest('tr').remove();
    } else {
        if ($('.kb-datetime-row').length > 1) {
            $(elm).closest('.kb-datetime-row').remove();
        }
    }

    var counter = 1;
    var slot_counter = 1;
    $('[class^="kb-datetime-row"]').each(function () {

        $(this).find('input.kb_date_from').attr('name', 'kb_date_from[' + counter + ']');
        $(this).find('input.kb_end_date').attr('name', 'kb_date_to[' + counter + ']');
        var slot_counter = 1;
        $(this).find('input.kb_time_from').each(function () {
            var time_from_name = $(this).attr('name').match(/\d+/g);
            $(this).attr('name', 'kb_time_from[' + counter + '][' + slot_counter + ']');
            slot_counter = slot_counter + 1;
        });
        var slot_counter = 1;
        $(this).find('input.kb_time_to').each(function () {
            var time_to_name = $(this).attr('name').match(/\d+/g);
            $(this).attr('name', 'kb_time_to[' + counter + '][' + slot_counter + ']');
            slot_counter = slot_counter + 1;
        });
        var slot_counter = 1;
        $(this).find('input.kb_time_price').each(function () {
            var time_price_name = $(this).attr('name').match(/\d+/g);
            $(this).attr('name', 'kb_time_price[' + counter + '][' + slot_counter + ']');
            slot_counter = slot_counter + 1;
        });
        $(this).attr('id', 'kb-datetime-block-row_' + counter);
        counter = counter + 1;
    });
    if ($('.kb-time-slot-row-remove').length == 1) {
        $('.kb-time-slot-row-remove').hide();
    } else {
        $('.kb-time-slot-row-remove').show();
    }

//    }
}

function dateRangeOverlaps(a_start, a_end, b_start, b_end) {
    if (a_start <= b_start && b_start <= a_end)
        return true; // b starts in a
    if (a_start <= b_end && b_end <= a_end)
        return true; // b ends in a
    if (b_start < a_start && a_end < b_end)
        return true; // a in b
    return false;
}
function multipleDateRangeOverlaps(abc) {

    return false;
}

function highlightProductErrorTab(element)
{
    $(element).closest('.kb_product_section').find('.kb-panel-header-tab').addClass('error_tab');
}

function str2url(str, encoding, ucfirst)
{
    str = str.toUpperCase();
    str = str.toLowerCase();
    /* Lowercase */
    str = str.replace(/[\u00E0\u00E1\u00E2\u00E3\u00E4\u00E5\u0101\u0103\u0105\u0430]/g, 'a');
    str = str.replace(/[\u0431]/g, 'b');
    str = str.replace(/[\u00E7\u0107\u0109\u010D\u0446]/g, 'c');
    str = str.replace(/[\u010F\u0111\u0434]/g, 'd');
    str = str.replace(/[\u00E8\u00E9\u00EA\u00EB\u0113\u0115\u0117\u0119\u011B\u0435\u044D]/g, 'e');
    str = str.replace(/[\u0444]/g, 'f');
    str = str.replace(/[\u011F\u0121\u0123\u0433\u0491]/g, 'g');
    str = str.replace(/[\u0125\u0127]/g, 'h');
    str = str.replace(/[\u00EC\u00ED\u00EE\u00EF\u0129\u012B\u012D\u012F\u0131\u0438\u0456]/g, 'i');
    str = str.replace(/[\u0135\u0439]/g, 'j');
    str = str.replace(/[\u0137\u0138\u043A]/g, 'k');
    str = str.replace(/[\u013A\u013C\u013E\u0140\u0142\u043B]/g, 'l');
    str = str.replace(/[\u043C]/g, 'm');
    str = str.replace(/[\u00F1\u0144\u0146\u0148\u0149\u014B\u043D]/g, 'n');
    str = str.replace(/[\u00F2\u00F3\u00F4\u00F5\u00F6\u00F8\u014D\u014F\u0151\u043E]/g, 'o');
    str = str.replace(/[\u043F]/g, 'p');
    str = str.replace(/[\u0155\u0157\u0159\u0440]/g, 'r');
    str = str.replace(/[\u015B\u015D\u015F\u0161\u0441]/g, 's');
    str = str.replace(/[\u00DF]/g, 'ss');
    str = str.replace(/[\u0163\u0165\u0167\u0442]/g, 't');
    str = str.replace(/[\u00F9\u00FA\u00FB\u00FC\u0169\u016B\u016D\u016F\u0171\u0173\u0443]/g, 'u');
    str = str.replace(/[\u0432]/g, 'v');
    str = str.replace(/[\u0175]/g, 'w');
    str = str.replace(/[\u00FF\u0177\u00FD\u044B]/g, 'y');
    str = str.replace(/[\u017A\u017C\u017E\u0437]/g, 'z');
    str = str.replace(/[\u00E6]/g, 'ae');
    str = str.replace(/[\u0447]/g, 'ch');
    str = str.replace(/[\u0445]/g, 'kh');
    str = str.replace(/[\u0153]/g, 'oe');
    str = str.replace(/[\u0448]/g, 'sh');
    str = str.replace(/[\u0449]/g, 'ssh');
    str = str.replace(/[\u044F]/g, 'ya');
    str = str.replace(/[\u0454]/g, 'ye');
    str = str.replace(/[\u0457]/g, 'yi');
    str = str.replace(/[\u0451]/g, 'yo');
    str = str.replace(/[\u044E]/g, 'yu');
    str = str.replace(/[\u0436]/g, 'zh');

    /* Uppercase */
    str = str.replace(/[\u0100\u0102\u0104\u00C0\u00C1\u00C2\u00C3\u00C4\u00C5\u0410]/g, 'A');
    str = str.replace(/[\u0411]/g, 'B');
    str = str.replace(/[\u00C7\u0106\u0108\u010A\u010C\u0426]/g, 'C');
    str = str.replace(/[\u010E\u0110\u0414]/g, 'D');
    str = str.replace(/[\u00C8\u00C9\u00CA\u00CB\u0112\u0114\u0116\u0118\u011A\u0415\u042D]/g, 'E');
    str = str.replace(/[\u0424]/g, 'F');
    str = str.replace(/[\u011C\u011E\u0120\u0122\u0413\u0490]/g, 'G');
    str = str.replace(/[\u0124\u0126]/g, 'H');
    str = str.replace(/[\u0128\u012A\u012C\u012E\u0130\u0418\u0406]/g, 'I');
    str = str.replace(/[\u0134\u0419]/g, 'J');
    str = str.replace(/[\u0136\u041A]/g, 'K');
    str = str.replace(/[\u0139\u013B\u013D\u0139\u0141\u041B]/g, 'L');
    str = str.replace(/[\u041C]/g, 'M');
    str = str.replace(/[\u00D1\u0143\u0145\u0147\u014A\u041D]/g, 'N');
    str = str.replace(/[\u00D3\u014C\u014E\u0150\u041E]/g, 'O');
    str = str.replace(/[\u041F]/g, 'P');
    str = str.replace(/[\u0154\u0156\u0158\u0420]/g, 'R');
    str = str.replace(/[\u015A\u015C\u015E\u0160\u0421]/g, 'S');
    str = str.replace(/[\u0162\u0164\u0166\u0422]/g, 'T');
    str = str.replace(/[\u00D9\u00DA\u00DB\u00DC\u0168\u016A\u016C\u016E\u0170\u0172\u0423]/g, 'U');
    str = str.replace(/[\u0412]/g, 'V');
    str = str.replace(/[\u0174]/g, 'W');
    str = str.replace(/[\u0176\u042B]/g, 'Y');
    str = str.replace(/[\u0179\u017B\u017D\u0417]/g, 'Z');
    str = str.replace(/[\u00C6]/g, 'AE');
    str = str.replace(/[\u0427]/g, 'CH');
    str = str.replace(/[\u0425]/g, 'KH');
    str = str.replace(/[\u0152]/g, 'OE');
    str = str.replace(/[\u0428]/g, 'SH');
    str = str.replace(/[\u0429]/g, 'SHH');
    str = str.replace(/[\u042F]/g, 'YA');
    str = str.replace(/[\u0404]/g, 'YE');
    str = str.replace(/[\u0407]/g, 'YI');
    str = str.replace(/[\u0401]/g, 'YO');
    str = str.replace(/[\u042E]/g, 'YU');
    str = str.replace(/[\u0416]/g, 'ZH');

    str = str.toLowerCase();

    str = str.replace(/[^a-z0-9\s\'\:\/\[\]-]/g, '');
    str = str.replace(/[\u0028\u0029\u0021\u003F\u002E\u0026\u005E\u007E\u002B\u002A\u002F\u003A\u003B\u003C\u003D\u003E]/g, '');
    str = str.replace(/[\s\'\:\/\[\]-]+/g, ' ');

    // Add special char not used for url rewrite
    str = str.replace(/[ ]/g, '-');
    str = str.replace(/[\/\\"'|,;%]*/g, '');

    if (ucfirst == 1) {
        var first_char = str.charAt(0);
        str = first_char.toUpperCase() + str.slice(1);
    }

    return str;
}