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

//date format //yyyy-mm-dd
var validation_fields = [{
        'isGenericName': /^[^<>={}]*$/,
        'isAddress': /^[^!<>?=+@{}_$%]*$/,
        'isPhoneNumber': /^[+0-9. ()-]*$/,
        'isInt': /^[0-9]*$/,
        'isPrice': /^[0-9]*(?:\.\d{1,6})?$/,
        'isImpactedPrice': /^[-+]?[0-9]*(?:\.\d{1,6})?$/,
        'isDate': /^(([0-9]{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])|(0000-00-00))$/,
        'isUrl': /(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})/gi,
        'isEmail': /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
        'isTagList': /^[^!<>;?=+#"Â°{}_$%]*$/,
        // changes by rishabh jain
        'isPercenatge': /^100$|^\d{0,2}(\.\d{1,2})? *%?$/,
        'isTime': /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/,
        'isLatitude': /^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/,
        'isLongitude': /^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/,
        // changes over //
        'isLinkRewrite': /^[_a-zA-Z0-9\pL\pS-]+$/
    }];

var kb_img_placeholder = '';
var message_delay = 10000; //10 seconds
$(document).ready(function () {
    if ($('#kb_lang_slector').length) {
        $('#kb_lang_slector').on('change', function () {
        var selected_lang = $(this).children("option:selected").val();
            $('input[name^="name_"]').hide();
            $('input[name="name_' + selected_lang + '"]').show();
            $('iframe[id^="description_"]').parent().parent().parent().hide();
            $('iframe[id="description_' + selected_lang + '_ifr"]').parent().parent().parent().show();
            $('iframe[id^="description_short_"]').parent().parent().parent().hide();
            $('iframe[id="description_short_' + selected_lang + '_ifr"]').parent().parent().parent().show();
            $('input[name^="meta_title_"]').hide();
            $('input[name="meta_title_' + selected_lang + '"]').show();
            $('input[name^="meta_description_"]').hide();
            $('input[name="meta_description_' + selected_lang + '"]').show();
            $('input[name^="link_rewrite_"]').hide();
            $('input[name="link_rewrite_' + selected_lang + '"]').show();
            if($(".custom_fields li").length){
                $('input[name^="custom_field_name_lang_"]').hide();
                $('input[name*="custom_field_name_lang_'+selected_lang+'"]').show();
            }
            $('.feature_field').hide();
            $('.feature_field_' + selected_lang).show();
        });
    }
    if ($('#kb_lang_slector_booking_product').length) {
        $('#kb_lang_slector_booking_product').on('change', function () {
            var selected_lang = $(this).children("option:selected").val();
            $('input[name^="name_"]').hide();
            $('input[name="name_' + selected_lang + '"]').show();
            $('iframe[id^="description_"]').parent().parent().parent().hide();
            $('iframe[id="description_' + selected_lang + '_ifr"]').parent().parent().parent().show();
            $('iframe[id^="description_short_"]').parent().parent().parent().hide();
            $('iframe[id="description_short_' + selected_lang + '_ifr"]').parent().parent().parent().show();
        });
    }
    if ($('#kb_lang_slector_profile').length) {
        $('#kb_lang_slector_profile').on('change', function () {
            var selected_lang = $(this).children("option:selected").val();
            //changes by vishal on 10 oct 2019
            $('input[name^="seller_title_"]').hide();
            $('input[name="seller_title_' + selected_lang + '"]').show();
            $('iframe[id^="seller_description_"]').parent().parent().parent().hide();
            $('iframe[id="seller_description_' + selected_lang + '_ifr"]').parent().parent().parent().show();
            $('input[name^="seller_meta_keywords_"]').hide();
            $('input[name="seller_meta_keywords_' + selected_lang + '"]').show();
            $('textarea[name^="seller_meta_description_"]').hide();
            $('textarea[name="seller_meta_description_' + selected_lang + '"]').show();
            $('iframe[id^="seller_meta_description_"]').parent().parent().parent().hide();
            $('iframe[id="seller_meta_description_' + selected_lang + '_ifr"]').parent().parent().parent().show();
            $('iframe[id^="seller_privacy_policy_"]').parent().parent().parent().hide();
            $('iframe[id="seller_privacy_policy_' + selected_lang + '_ifr"]').parent().parent().parent().show();
            $('iframe[id^="seller_return_policy_"]').parent().parent().parent().hide();
            $('iframe[id="seller_return_policy_' + selected_lang + '_ifr"]').parent().parent().parent().show();
            $('iframe[id^="seller_shipping_policy_"]').parent().parent().parent().hide();
            $('iframe[id="seller_shipping_policy_' + selected_lang + '_ifr"]').parent().parent().parent().show();
            $('input[name^="seller_profile_url_"]').hide();
            $('input[name="seller_profile_url_' + selected_lang + '"]').show();
            $('div[id^="kb_url_"]').hide();
            $('div[id="kb_url_' + selected_lang + '"]').show();
            //changes end
        });
    }
    
    if ($('#kb_lang_slector_shipping').length) {
        $('#kb_lang_slector_shipping').on('change', function () {
            var selected_lang = $(this).children("option:selected").val();
            $('input[name^="delay_"]').hide();
            $('input[name="delay_' + selected_lang + '"]').show();
        });
    }

    $('#kb-seller-new-review-popup #review_title').keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    // changes by rishabh jain for closing return manager popup
    if ($('.kb-modal .cancel-button').length)
    {
        $('.kb-modal .cancel-button').on('click', function () {
            $('#' + $(this).attr('data-modal')).fadeOut();
        });
    }
    // chnages over


    $('#seller_remove_image').on('click', function () {
        $('.kb_seller_logo_file').val('');
    });
    $('#kb_banner_remove').on('click', function () {
        $('.kb_seller_banner_file').val('');
    });

    if ($('#seller_order_handling').val() == '0') {
//            return false;
        var click = 1;
        var link = 1;
        var delivery = 1;
        var invoice = 1;
        $('#update_status_btn').attr('onClick', 'return false');
        $('.kb-content #view_invoice').attr('onClick', 'return false');
        $('.kb-content #view_delivery_slip').attr('onClick', 'return false');

        $('#update_status_btn').on('click', function () {
            if (click == 1) {
                $('#order_status_form .kb-form-field-block').before('<div class="kbalert kbalert-danger">' + user_permission + '</div>');
            }
            click++;
        });

        $('.edit_shipping_number_link').on('click', function () {
            $('.shipping_number_edit').hide();
            $('.cancel_shipping_number_link').hide();
            $('.edit_shipping_number_link').show();
            if (link == 1) {
                $('.shipping_detail_list').before('<div class="kbalert kbalert-danger">' + user_permission + '</div>');
            }
            link++;
        });
        $('.kb-content #view_invoice').on('click', function () {
            if (invoice == 1) {
                $('.kb-content .kbalert-danger').hide();
                $('.kb-content #view_invoice').before('<div class="kbalert kbalert-danger">' + user_permission + '</div>');
            }
            invoice++;
        });
        $('.kb-content #view_delivery_slip').on('click', function () {
            if (delivery == 1) {
                $('.kb-content .kbalert-danger').hide();
                $('.kb-content #view_invoice').before('<div class="kbalert kbalert-danger">' + user_permission + '</div>');
            }
            delivery++;
        });
    }

//        $('#order_status_form #update_status_btn').on('click',function(){
//            $('#order_status_form').submit();
//            if (click == 1) {
//                $('#order_status_form #update_status_btn').attr('disabled',true);
//            }
//            click++;
//        });

    try
    {
        $('#selectbox_product_suppliers').multipleSelect({
            selectAll: false,
            allSelected: all_selected,
            filter: false,
            updateListId: 'kb_mp_product_default_supplier',
            placeholder: select_supplier
        });
    } catch (e) {
    }

    // changes by rishabh jain for product mappig plugin integration
    try
    {
        $('#selectbox_product_products').multipleSelect({
            selectAll: true,
            allSelected: all_selected,
            filter: false,
            updateListId: 'kb_mp_product_default_product',
            placeholder: select_products
        });
    } catch (e) {
    }
    // changes by rishabh jain for booking product
    try
    {
        $('#selectbox_product_disable_days').multipleSelect({
            selectAll: true,
            allSelected: all_selected,
            filter: false,
            updateListId: 'kb_mp_product_default_disable_days',
            placeholder: disable_days
        });
    } catch (e) {
    }
    try
    {
        $('#selectbox_room_available_facility').multipleSelect({
            selectAll: true,
            allSelected: all_selected,
            filter: false,
            updateListId: 'kb_mp_room_default_avail_facility',
            placeholder: select_facility
        });
    } catch (e) {
    }
    // chnages over
    try
    {
        $('#selectbox_product_zones').multipleSelect({
            selectAll: true,
            allSelected: all_selected,
            filter: false,
            updateListId: 'kb_mp_product_default_zone',
            placeholder: select_zones
        });
    } catch (e) {
    }
    // changes over

    //$.totalStorage('display', 'grid');
    if (is_mobile_device == 1) {
        if ($('#kb-account-accordian').length) {

            $('#kb-account-accordian').on('click', function () {
                if ($('#kb-s-account-mlist').is(':visible')) {
                    $('#kb-s-account-mlist').slideUp();
                    $('#kb-account-accordian i').removeClass('icon-minus');
                    $('#kb-account-accordian i').addClass('icon-plus');
                } else {
                    $('#kb-s-account-mlist').slideDown();
                    $('#kb-account-accordian i').removeClass('icon-plus');
                    $('#kb-account-accordian i').addClass('icon-minus');
                }
            });
        }
    }

    if ($('#kb_otherfeature_menu').length) {
        if (!$('#kb_otherfeature_menu ul li').length) {
            $('#kb_otherfeature_menu').remove();
        } else {
            if ($('#kb_otherfeature_menu ul li a.smenu-other-feature-menu-active').length) {
                $('#kb_otherfeature_menu').addClass('kb-active-menuitem');
            }
        }
    }

    if ($('#paymentinfo').length) {
        getSelectedPaymentData();
        $('#kb-payment-select').on('change', function () {
            getSelectedPaymentData();
        });
    }

    $(".collapsible-otherfeature-menu .kb-smenu-accordian-symbol").click(function () {
        $(this).removeClass('kbexpand');
        $(this).removeClass('kbcollapse');
        if ($(this).parent().find('ul').is(':visible')) {
            $(this).parent().find('ul').slideUp();
            $(this).addClass('kbexpand');
            $(this).find('.kb-material-icons').html('&#xe145;');
        } else {
            $(this).parent().find('ul').slideDown();
            $(this).addClass('kbcollapse');
            $(this).find('.kb-material-icons').html('&#xe15b;');
        }
    });

    if ($('.kb-tabs').length) {
        $(".kb_tab_content").hide();
        $(".kb_tab_content:first").show();

        $(".kb-tabs li").click(function () {
            $(".kb-tabs li").removeClass("active");
            $(this).addClass("active");
            $(".kb_tab_content").hide();
            var activeTab = $(this).attr("rel");
            $("#" + activeTab).fadeIn();
        });
    }


    if ($('.kb-analysis-popper').length) {
        $(".kb-analysis-popper").hover(function () {
            // hover in
            jQuery(this).find('.kb-popper-info').show();
        },
            function () {
                //hover out
                jQuery(this).find('.kb-popper-info').hide();
            }
        );
    }

    if ($('#kb-product-form').length) {
        if ($('.kb-panel-header-tab').length) {
            $(".kb-panel-header-tab").click(function () {
                if ($(this).attr('data-toggle') !== typeof undefined && $(this).attr('data-toggle') != '') {
                    var panel_class = '';
                    $('#kb-product-form').find('.kb-panel-header-tab').each(function () {

                        $(this).find('.kb-accordian-symbol').removeClass('kbcollapse');
                        $(this).find('.kb-accordian-symbol').addClass('kbexpand');
                        $(this).find('.kb-material-icons').html('&#xe145;');
                        panel_class = '#' + $(this).attr('data-toggle');
                        $(panel_class).slideUp();
                    });
                    $(this).find('.kb-accordian-symbol').removeClass('kbexpand');
                    $(this).find('.kb-accordian-symbol').removeClass('kbcollapse');
                    panel_class = '#' + $(this).attr('data-toggle');
                    if ($(panel_class).is(':visible')) {
                        $(panel_class).slideUp();
                        $(this).find('.kb-accordian-symbol').addClass('kbexpand');
                        $(this).find('.kb-material-icons').html('&#xe145;');
                    } else {
                        $(panel_class).slideDown();
                        $(this).find('.kb-accordian-symbol').addClass('kbcollapse');
                        $(this).find('.kb-material-icons').html('&#xe15b;');
                    }
                }
            });
        }
    } else {
        if ($('.kb-panel-header-tab').length) {
            $(".kb-panel-header-tab").click(function () {
                if ($(this).attr('data-toggle') !== typeof undefined && $(this).attr('data-toggle') != '') {
                    $(this).find('.kb-accordian-symbol').removeClass('kbexpand');
                    $(this).find('.kb-accordian-symbol').removeClass('kbcollapse');
                    var panel_class = '#' + $(this).attr('data-toggle');
                    if ($(panel_class).is(':visible')) {
                        $(panel_class).slideUp();
                        $(this).find('.kb-accordian-symbol').addClass('kbexpand');
                        $(this).find('.kb-material-icons').html('&#xe145;');
                    } else {
                        $(panel_class).slideDown();
                        $(this).find('.kb-accordian-symbol').addClass('kbcollapse');
                        $(this).find('.kb-material-icons').html('&#xe15b;');
                    }
                }
            });
        }
    }

//    $(window).resize(function(){
//        var window_width = $(window).width();
//
//        if(window_width > 992){
//            openAllCollapsiblePanel();
//        }else{
//            closeAllCollapsiblePanel();
//        }
//    });


    $('[data-toggle="tooltip"]').tooltip();

    if ($('.kb-modal .kb-modal-close').length)
    {
        $('.kb-modal .kb-modal-close').on('click', function () {
            $('#' + $(this).attr('data-modal')).fadeOut();
        });
    }

    $('.open-slr-review-form').fancybox({
        'hideOnContentClick': false
    });



    $('.kb-open-mp-access-popup').click(function (event) {
        event.preventDefault();
    });
    if ($('.kb-open-mp-access-popup').length) {
        $('.kb-open-mp-access-popup').fancybox({
            titlePosition: 'inside',
            transitionIn: 'none',
            transitionOut: 'none',
            overlayShow: false,
            fitToView: false,
            width: '100%',
            height: '100%',
            maxWidth: '450',
            maxHeight: '280',
            autoSize: false,
            hideOnContentClick: false,
            content: $("#kb-seller-access-data-popup").html(),
            beforeLoad: function () {
                $('#kb-seller-access-data-popup').show();
            },
            beforeClose: function () {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
//                parent.$.fancybox.close();
                $('#kb-seller-access-data-popup').hide();
            }

        });
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
            minDate: 'dateToday',
            nextText: '',
            dateFormat: 'yy-mm-dd'
        });
    }
    if ($(".datepicker").length > 0) {
        if ($("#start_date").length > 0) {
            $("#start_date").datepicker({
                prevText: '',
                nextText: '',
                minDate: 'dateToday',
                dateFormat: 'yy-mm-dd'
            });
        }
        if ($("#end_date").length > 0) {
            $("#end_date").datepicker({
                prevText: '',
                nextText: '',
                minDate: 'dateToday',
                dateFormat: 'yy-mm-dd'
            });
        }
        if ($("#particular_date").length > 0) {
            $("#particular_date").datepicker({
                prevText: '',
                nextText: '',
                minDate: 'dateToday',
                dateFormat: 'yy-mm-dd'
            });
        }

        $(".datepicker").datepicker({
            prevText: '',
            nextText: '',
            dateFormat: 'yy-mm-dd'
        });
    }
    $(document).on('change', '.selectSellerSort', function (e) {
        if (typeof kb_current_request != 'undefined' && kb_current_request)
            var requestSortSellers = kb_current_request;
        var params = 'kb_page_start=' + kb_page_start;
        if ($(this).val() != '')
        {
            var splitData = $(this).val().split(':');
            params += '&orderby=' + splitData[0] + '&orderway=' + splitData[1];
        }
        if (typeof requestSortSellers != 'undefined' && requestSortSellers)
            document.location.href = requestSortSellers + ((requestSortSellers.indexOf('?') < 0) ? '?' : '&') + params;
    });

    if ($('.autoload_rte').length) {
        tinymce.init({
            mode: "specific_textareas",
            editor_selector: "autoload_rte",
            menubar: false,
            language: kb_editor_lang,
            setup: function (ed) {
                ed.on('keydown', function (ed, e) {
                    tinyMCE.triggerSave();
                    textarea = $('#' + tinymce.activeEditor.id);
                    if (textarea.parent('div').find('span.counter').length)
                    {
                        var max = textarea.parent('div').find('span.counter').data('max');
                        if (max != 'none')
                        {
                            count = tinyMCE.activeEditor.getBody().textContent.length;
                            rest = max - count;
                            if (rest < 0)
                                textarea.parent('div').find('span.counter').html('<span style="color:red;">' + maximum + ' ' + max + characters + ': ' + rest + '</span>');
                            else
                                textarea.parent('div').find('span.counter').html(' ');
                        }
                    }
                });
            },
            plugins: [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste code"
            ],
            toolbar: "code insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"

        });
    }


    jQuery('body').on('change', '.kb_upload_field', function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = kbImageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

});

$.fn.serializeObject = function () {
    var o = Object.create(null),
        elementMapper = function (element) {
            element.name = $.camelCase(element.name);
            return element;
        },
        appendToResult = function (i, element) {
            var node = o[element.name];

            if ('undefined' != typeof node && node !== null) {
                o[element.name] = node.push ? node.push(element.value) : [node, element.value];
            } else {
                o[element.name] = element.value;
            }
        };

    $.each($.map(this.serializeArray(), elementMapper), appendToResult);
    return o;
};

function serializeObjectToSerialize(serialize_object)
{
    var serialize_str = '';

    for (var key in serialize_object) {
        serialize_str += '&' + key + '=' + serialize_object[key];
    }

    return serialize_str;
}

function openAllCollapsiblePanel() {
    if ($('.kb-accordian-symbol').length) {
        $(".kb-accordian-symbol").each(function () {
            if ($(this).attr('data-toggle') !== typeof undefined && $(this).attr('data-toggle') != '') {
                $(this).removeClass('kbexpand');
                $(this).removeClass('kbcollapse');
                $('#' + $(this).attr('data-toggle')).show();
                $(this).addClass('kbexpand');
                $(this).hide();
            }
        });
    }
}

function closeAllCollapsiblePanel() {
    if ($('.kb-accordian-symbol').length) {
        $(".kb-accordian-symbol").each(function () {
            if ($(this).attr('data-toggle') !== typeof undefined && $(this).attr('data-toggle') != '') {
                $(this).removeClass('kbexpand');
                $(this).removeClass('kbcollapse');
                $('#' + $(this).attr('data-toggle')).hide();
                $(this).addClass('kbexpand');
                $(this).show();
            }
        });
    }
}

function convertBytesIntoMb(value)
{
    return parseFloat(value / 1000000);
}

function kbValidateField(value, validation_type)
{
    if (validation_fields[0][validation_type] == undefined)
        return false;

    var reg = new RegExp(validation_fields[0][validation_type]);
    if (reg.test(value))
        return true;
    else
        return false;

}

function checkImgMediaUpload(val)
{
    for (var i = 0; i < kb_img_format.length; i++)
    {
        var str = kb_img_format[i];
        if (val.indexOf(str.toLowerCase()) > -1) {
            return true;
        }
    }
    return false;
}

function kbImageIsLoaded(e)
{
    var total_size = convertBytesIntoMb(e.total);
    if (checkImgMediaUpload(e.target.result) && (total_size < kb_image_size_limit)) {
        jQuery('#' + kb_img_placeholder + '_error').html("");
        jQuery('#' + kb_img_placeholder + '_update').val(1);
        jQuery('#' + kb_img_placeholder + '_placeholder').attr('src', e.target.result);
    }
    else
    {
        if (total_size > kb_image_size_limit)
            jQuery('#' + kb_img_placeholder + '_error').html(kb_img_size_error);
        else
            jQuery('#' + kb_img_placeholder + '_error').html(kb_img_type_error);
        jQuery('#' + kb_img_placeholder + '_update').val(0);
    }
}
;

function uploadImage(id_element)
{
    kb_img_placeholder = id_element;
    $('#' + id_element).trigger('click');
}

function removeSellerImage(id_element, default_img)
{
//    console.log(';sds');
    jQuery('#' + id_element + '_update').val(1);
    jQuery('#' + id_element + '_placeholder').attr("src", kb_img_seller_path + default_img);

//    $('#seller_logo_update').val(0);
//    $('.kb_upload_field').reset();
}

function validateSellerForm()
{
    if ($('#kb_lang_slector_profile').length) {
        $('#kb_lang_slector_profile').val(kb_default_lang);
        $('#kb_lang_slector_profile').trigger("change");
    }
    if ($('.kbcustomfield.error_message').length) {
        $('.kbcustomfield.error_message').hide();
    }
    $('#sellerProfileForm').find('.kb-validation-error').remove();
    $('#kb-seller-form-msg').html('');
    $('#sellerprofile-update-btn').attr('disabled', 'disabled');
    $('#sellerprofile-updating-progress').css('display', 'inline-block');
    $('#sellerprofile-panel ul.kb-tabs li').removeClass('error-tab');
    tinyMCE.triggerSave();
    var error = false;
    var error_tab = [];
    var value = '';
    if ($('#sellerProfileForm input[type="text"]').length || $('#sellerProfileForm select').length)
    {
        $('#sellerProfileForm input[type="text"], #sellerProfileForm select').each(function () {
            value = $(this).val();
            if (value == null || value == '') {
            } else {
                if (typeof (value) == 'object') {
                } else {
            value = value.trim();
                }
            }
            if ($(this).hasClass('required'))
            {
                if (value == '')
                {
                    error = true;
                    error_tab.push($(this).attr('data-tab'));
                    if ($(this).hasClass('datepicker')) {
                        $(this).parent().parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
                    } else {
                        $(this).parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
                    }
                }
                else {
                    if ($(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate')))
                    {
                        error = true;
                        error_tab.push($(this).attr('data-tab'));
                        $(this).parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
                    }
                    else if ($(this).attr('data-validate')) {
                        if (!kbCustomFieldValidateField($(this))) {
                            error = true;
                            error_tab.push($(this).attr('data-tab'));
                            if ($(this).closest('.kb-form-field-block').find('.error_message').length) {
                                $(this).closest('.kb-form-field-block').find('.error_message').show();
                            } else {
                                $(this).parent().append('<div  class="kb-validation-error">' + kb_invalid_field + '</div>');
                            }
                        } else {
                            if ($(this).closest('.kb-form-field-block').find('.error_message').length) {
                                $(this).closest('.kb-form-field-block').find('.error_message').hide();
                            }
                        }
                    }
                }
            } else if (value != '' && $(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate'))) {
                error = true;
                error_tab.push($(this).attr('data-tab'));
                $(this).parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
            } else if (value != '' && $(this).attr('data-validate')) {
                if (!kbCustomFieldValidateField($(this))) {
                    error = true;
                    error_tab.push($(this).attr('data-tab'));
                    if ($(this).closest('.kb-form-field-block').find('.error_message').length) {
                        $(this).closest('.kb-form-field-block').find('.error_message').show();
                    } else {
                        $(this).parent().append('<div  class="kb-validation-error">' + kb_invalid_field + '</div>');
                    }
                } else {
                    if ($(this).closest('.kb-form-field-block').find('.error_message').length) {
                        $(this).closest('.kb-form-field-block').find('.error_message').hide();
                    }
                }
            } else {
                if ($(this).closest('.kb-form-field-block').find('.error_message').length) {
                    $(this).closest('.kb-form-field-block').find('.error_message').hide();
                }
            }
        });
    }
    if ($('.error_message1').length) {
        $('.error_message1').remove();
    }
    // validation for sellerprofile custom fields
    if ($('#sellerProfileForm input[type="radio"]').length) {
        $('#sellerProfileForm input[type="radio"]').closest('.kb-form-field-block').each(function () {
            if ($(this).find('input:radio').hasClass('required')) {
                if ($(this).find('input:radio:checked').length == 0) {
                    error = true;
                    error_tab.push($(this).find('input:radio').eq(0).attr('data-tab'));
                    $(this).append('<div class="kb-validation-error">' + kb_required_field + '</div>');
                }
            }
        });
    }
    if ($('#sellerProfileForm input[type="checkbox"]').length) {
        $('#sellerProfileForm input[type="checkbox"]').closest('.kb-form-field-block').each(function () {
            if ($(this).find('input:checkbox').hasClass('required')) {
                if ($(this).find('input:checkbox:checked').length == 0) {
                    error = true;
                    error_tab.push($(this).find('input:checkbox').eq(0).attr('data-tab'));
                    $(this).append('<div class="kb-validation-error">' + kb_required_field + '</div>');
                }
            }
        });
    }
    // changes over
    if ($('#sellerProfileForm textarea').length) {
        $('#sellerProfileForm textarea').each(function () {
            value = $(this).val();
            value = value.trim();
            if ($(this).hasClass('required'))
            {
                if (value == '')
                {
                    error = true;
                    error_tab.push($(this).attr('data-tab'));
                    $(this).parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
                }
                else {
                    if ($(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate')))
                    {
                        error = true;
                        error_tab.push($(this).attr('data-tab'));
                        $(this).parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
                    } else if ($(this).attr('data-validate')) {
                        if (!kbCustomFieldValidateField($(this))) {
                            error = true;
                            error_tab.push($(this).attr('data-tab'));
                            if ($(this).closest('.kb-form-field-block').find('.error_message').length) {
                                $(this).closest('.kb-form-field-block').find('.error_message').show();
                            } else {
                                $(this).parent().append('<div  class="kb-validation-error">' + kb_invalid_field + '</div>');
                            }
                        } else {
                            if ($(this).attr('minlength') || $(this).attr('maxlength')) {
                                var min = $(this).attr('minlength');
                                var max = $(this).attr('maxlength');
                                if (value.length > max) {
                                    error = true;
                                    error_tab.push($(this).attr('data-tab'));
                                    $(this).parent().append('<div  class="kb-validation-error">' + maximum_textarea_limit + max + '</div>');

                                } else if (value.length < min) {
                                    error = true;
                                    error_tab.push($(this).attr('data-tab'));
                                    $(this).parent().append('<div  class="kb-validation-error">' + minimum_textarea_limit + min + '</div>');
                                }
                            }
                        }
                    } else {
                        if ($(this).attr('minlength') || $(this).attr('maxlength')) {
                            var min = $(this).attr('minlength');
                            var max = $(this).attr('maxlength');
                            if (value.length > max) {
                                error = true;
                                error_tab.push($(this).attr('data-tab'));
                                $(this).parent().append('<div  class="kb-validation-error">' + maximum_textarea_limit + max + '</div>');

                            } else if (value.length < min) {
                                error = true;
                                error_tab.push($(this).attr('data-tab'));
                                $(this).parent().append('<div  class="kb-validation-error">' + minimum_textarea_limit + min + '</div>');
                            }
                        }
                    }
                }
            } else if (value != '' && $(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate'))) {
                error = true;
                error_tab.push($(this).attr('data-tab'));
                $(this).parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
            } else if (value != '' && $(this).attr('data-validate')) {
                if (!kbCustomFieldValidateField($(this))) {
                    error = true;
                    error_tab.push($(this).attr('data-tab'));
                    if ($(this).closest('.kb-form-field-block').find('.error_message').length) {
                        $(this).closest('.kb-form-field-block').find('.error_message').show();
                    } else {
                        $(this).parent().append('<div  class="kb-validation-error">' + kb_invalid_field + '</div>');
                    }
                } else {
                    if ($(this).attr('minlength') || $(this).attr('maxlength')) {
                        var min = $(this).attr('minlength');
                        var max = $(this).attr('maxlength');
                        if (value.length > max) {
                            error = true;
                            error_tab.push($(this).attr('data-tab'));
                            $(this).parent().append('<div  class="kb-validation-error">' + maximum_textarea_limit + max + '</div>');

                        } else if (value.length < min) {
                            error = true;
                            error_tab.push($(this).attr('data-tab'));
                            $(this).parent().append('<div  class="kb-validation-error">' + minimum_textarea_limit + min + '</div>');
                        }
                    }
                }
            } else {
                if ($(this).attr('minlength') || $(this).attr('maxlength')) {
                    var min = $(this).attr('minlength');
                    var max = $(this).attr('maxlength');
                    if (value.length > max) {
                        error = true;
                        error_tab.push($(this).attr('data-tab'));
                        $(this).parent().append('<div  class="kb-validation-error">' + maximum_textarea_limit + max + '</div>');

                    } else if (value.length < min) {
                        error = true;
                        error_tab.push($(this).attr('data-tab'));
                        $(this).parent().append('<div  class="kb-validation-error">' + minimum_textarea_limit + min + '</div>');
                    }
                }
            }
        });
    }

    $('#sellerProfileForm input[type="file"]').each(function () {
//        $(this).removeClass('error_field');
        if ($(this).hasClass('kbfield')) {
            if ($(this).hasClass('is_required')) {
                if ($(this).prop('files').length == 0) {
                    error = true;
                    error_tab.push($(this).attr('data-tab'));
                    if ($(this).closest('.kb-form-field-block').find('.error_message').length) {
                        $(this).closest('.kb-form-field-block').find('.error_message').show();
                    } else {
                        $(this).after('<div  class="kb-validation-error">' + file_not_empty + '</div>');
                    }
                } else {
                    var extension_string = $(this).closest('.kb-form-field-block').find('.file_extension').html();
                    var extension_arr = extension_string.replace(/[ ]/g, '').split(',');
                    var file_ext = $(this).val().trim().substring($(this).val().trim().lastIndexOf('.') + 1).toLowerCase();
                    if ($.inArray(file_ext, extension_arr) == -1) {
                        error = true;
                        error_tab.push($(this).attr('data-tab'));
                        if ($(this).closest('.kb-form-field-block').find('.error_message').length) {
                            $(this).closest('.kb-form-field-block').find('.error_message').show();
                        } else {
                            if ($(this).closest('.kb-form-field-block').find('.uploader').length) {
                                $(this).closest('.uploader').after('<div  class="kb-validation-error">' + file_format_error + '</div>');
                            } else {
                                $(this).after('<div  class="kb-validation-error">' + file_format_error + '</div>');
                            }

                        }
                    } else {
                        $(this).closest('.kb-form-field-block').find('.error_message').hide();
                    }
                }
            } else {
                if ($(this).prop('files').length != 0) {
                    var extension_string = $(this).closest('.kb-form-field-block').find('.file_extension').html();
                    var extension_arr = extension_string.replace(/[ ]/g, '').split(',');
                    var file_ext = $(this).val().trim().substring($(this).val().trim().lastIndexOf('.') + 1).toLowerCase();
                    if ($.inArray(file_ext, extension_arr) == -1) {
                        error = true;
                        error_tab.push($(this).attr('data-tab'));
                        $(this).addClass('error_field');
                        if ($(this).closest('.kb-form-field-block').find('.error_message').length) {
                            $(this).closest('.kb-form-field-block').find('.error_message').show();
                        } else {
                            if ($(this).closest('.kb-form-field-block').find('.uploader').length) {
                                $(this).closest('.uploader').after('<div  class="kb-validation-error">' + file_format_error + '</div>');
                            } else {
                                $(this).after('<div  class="kb-validation-error">' + file_format_error + '</div>');
                            }

                        }
                    } else {
                        $(this).closest('.kb-form-field-block').find('.error_message').hide();
                    }
                }
            }
        }
    });
    if ($("#kb-payment-select").val() == "")
    {
        $("#kb-sprofile-paymentinfo").addClass("error-tab");
    }
    if ($("#kb_seller_notification_type").val() == "0" || $("#kb_seller_notification_type").val() == "2")
    {
        var email = $("#kb_business_email");
        if (email.val() == "" || email.val() == null)
        {
            error = true;
            email.parent().append('<div class="kb-validation-error">' + business_email_error + '</div>');
            $("#kb-sprofile-general").addClass('error-tab');
        }
    }

    var elemSellerFbLink = $("#seller_fb_link");
    var elemSellerGplusLink = $("#seller_gplus_link");
    var elemSellerTwitLink = $("#seller_twit_link");
    var linkFbOkay = validateFullURL(elemSellerFbLink.val());
    var linkGplusOkay = validateFullURL(elemSellerGplusLink.val());
    var linkTwitOkay = validateFullURL(elemSellerTwitLink.val());

    if (linkFbOkay == false && elemSellerFbLink.val() != "")
    {
        error = true;
        elemSellerFbLink.parent().append('<div class="kb-validation-error">' + url_error + '</div>');
        $("#kb-sprofile-general").addClass('error-tab');
    }
    if (linkGplusOkay == false && elemSellerGplusLink.val() != "")
    {
        error = true;
        elemSellerGplusLink.parent().append('<div class="kb-validation-error">' + url_error + '</div>');
        $("#kb-sprofile-general").addClass('error-tab');
    }
    if (linkTwitOkay == false && elemSellerTwitLink.val() != "")
    {
        error = true;
        elemSellerTwitLink.parent().append('<div class="kb-validation-error">' + url_error + '</div>');
        $("#kb-sprofile-general").addClass('error-tab');
    }

    if (!error) {
        checkBusinessEmailExist();
        //$('#sellerProfileForm').submit();
    } else {
        error_tab = $.unique(error_tab);
        $('#sellerprofile-panel ul.kb-tabs li').each(function () {
            if ($.inArray($(this).attr('rel'), error_tab) != -1) {
                $(this).addClass('error-tab');
            }
        });
        $('#sellerprofile-update-btn').removeAttr('disabled');
        $('#sellerprofile-updating-progress').css('display', 'none');
        $('#kb-seller-form-msg').html('<div class="kbalert kbalert-danger"><i class="kb-material-icons">&#xE002;</i>' + kb_seller_form_error + '</div>');
    }
}

// changes by rishabh jain for seller profile custom field
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
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(s).toLowerCase());
//    var reg = unicode_hack(/^[a-z\p{L}0-9!#$%&'*+\/=?^`{}|~_-]+[.a-z\p{L}0-9!#$%&'*+\/=?^`{}|~_-]*@[a-z\p{L}0-9]+[._a-z\p{L}0-9-]*\.[a-z\p{L}0-9]+$/i, false);
//    return reg.test(s);
}

function validate_isPasswd(s)
{
    return (s.length >= 5 && s.length < 255);
}

function kbCustomFieldValidateField(element)
{
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
function validateFullURL(str)
{
    if (str.indexOf("http://") == 0 || str.indexOf("https://") == 0) {
        return true;
    }
    return false;
}

function validateEmail(email)
{
    if (/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email))
    {
        return (true);
    }
    return (false);
}

function checkBusinessEmailExist()
{
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true'
            + '&id_seller=' + $('input[name="kb_id_seller"]').val()
            + '&bemail=' + $('input[name="seller_business_email"]').val()
            + '&method=checkBusniessEmail',
        success: function (json)
        {
            if (json['msg'] != '') {
                var error_tab = $('input[name="seller_business_email"]').attr('data-tab');
                $('#sellerprofile-panel ul.kb-tabs li[rel="' + error_tab + '"]').addClass('error-tab');
                $('input[name="seller_business_email"]').parent().append('<div class="kb-validation-error">' + json['msg'] + '</div>');
                $('#kb-seller-form-msg').html('<div class="kbalert kbalert-danger"><i class="kb-material-icons">&#xE002;</i>' + kb_seller_form_error + '</div>');
                $('#sellerprofile-update-btn').removeAttr('disabled');
                $('#sellerprofile-updating-progress').css('display', 'none');
            } else {
                $('#sellerProfileForm').submit();
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $('#sellerprofile-update-btn').removeAttr('disabled');
            $('#sellerprofile-updating-progress').css('display', 'none');
            jAlert(kb_ajax_request_fail_err ,alert_heading);
        }
    });
}

function openKbModal(id_modal) {
    $('#' + id_modal).show();
    $("html, body").animate({scrollTop: 0}, '500');
}

function getProductReviewDetail(id_product_review)
{
    $('#kb-product-review-view-popup').show();
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true'
            + '&id_seller_product_review=' + id_product_review
            + '&method=getProductReviewDetail',
        beforeSend: function () {
            $('#kb-product-review-view-popup .kb-model-content').hide();
            $('#kb-product-review-view-popup #kb-individual-review-rating').html('');
            $('#kb-product-review-view-popup .kb-model-content-loader').show();
            $('#kb-product-review-view-popup').show();
        },
        success: function (json)
        {
            if (json['status'])
            {
                $('#kb-product-review-view-popup #review_on_product_name').html(json['data']['name']);
                $('#kb-product-review-view-popup #review-posted-by').html(json['data']['customer_name']);
                $('#kb-product-review-view-popup #review-time').html(json['data']['date_add']);
                $('#kb-product-review-view-popup #rating_percent_display').css('width', json['data']['overall_grade_percent'] + '%');
                $('#kb-product-review-view-popup #review-title').html(json['data']['title']);
                $('#kb-product-review-view-popup #review-comment').html(json['data']['content']);
                if (json['individual_grades'].length) {
                    var individual_html = '';
                    for (var i in json['individual_grades'])
                    {
                        individual_html += '<div class="kb-row">'
                            + '<div class="in-display right-offset15 btxt vssmp-font12">' + json['individual_grades'][i].name + ':</div>'
                            + '<div class="in-display">'
                            + '<div class="vss_seller_ratings"><div class="vss_rating_unfilled">★★★★★</div><div class="vss_rating_filled" style="width:' + json['individual_grades'][i].grade_percent + '%">★★★★★</div></div>'
                            + '</div></div>';
                    }
                    $('#kb-product-review-view-popup #kb-individual-review-rating').html(individual_html);
                }
                $('#kb-product-review-view-popup .kb-model-content-loader').hide();
                $('#kb-product-review-view-popup .kb-model-content').show();
                $("html, body").animate({scrollTop: 0}, '500');
            } else {
                $('#kb-product-review-view-popup').hide();
                jAlert(json['msg'] ,alert_heading);
            }
            //console.log(json);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $('#kb-product-review-view-popup').hide();
            jAlert(kb_ajax_request_fail_err ,alert_heading);
        }
    });
}

function getSellerReviewDetail(id_seller_review)
{
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true'
            + '&id_seller_review=' + id_seller_review
            + '&method=getReviewDetail',
        beforeSend: function () {
            $('#kb-seller-review-view-popup .kb-model-content').hide();
            $('#kb-seller-review-view-popup .kb-model-content-loader').show();
            $('#kb-seller-review-view-popup').show();
        },
        success: function (json)
        {
            if (json['status'])
            {
                $('#kb-seller-review-view-popup #review_by_customer').html(json['data']['customer_name']);
                $('#kb-seller-review-view-popup #review-time').html(json['data']['posted_on']);
                $('#kb-seller-review-view-popup #rating_percent_display').css('width', json['data']['rating_percent'] + '%');
                $('#kb-seller-review-view-popup #review-title').html(json['data']['title']);
                $('#kb-seller-review-view-popup #review-comment').html(json['data']['comment']);
                $('#kb-seller-review-view-popup .kb-model-content-loader').hide();
                $('#kb-seller-review-view-popup .kb-model-content').show();
                $("html, body").animate({scrollTop: 0}, '500');
            } else {
                $('#kb-seller-review-view-popup').hide();
                jAlert(json['msg'] ,alert_heading);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $('#kb-seller-review-view-popup').hide();
            jAlert(kb_ajax_request_fail_err ,alert_heading);
        }
    });
}

function getSellerTransactionDetail(id_seller_transaction)
{
    $('#kb-seller-transaction-view-popup').show();
}

function displayNewReviewForm(id_modal)
{
    $('#' + id_modal).show();
}

function getSProduct2User(page_number)
{
    $('#seller_product_pagination_var').val(parseInt(page_number));
    $('#seller_products_form').submit();
}

function displayRatingStartInput(id, input_name)
{
    //input_name = 'mpReview[review_rating]';
    var html = '<div id="starRating">';
    html += '<div style="display: none;">';
    html += '<input id="rating12" type="radio" name="' + input_name + '" value="0" checked="">';
    html += '</div>';
    html += '<div>'
    html += '<div>';
    html += '<div>';
    html += '<div>';
    html += '<input id="rating1" type="radio" name="' + input_name + '" value="1">';
    html += '<label for="rating1"><span>1</span></label>';
    html += '</div>';
    html += '<input id="rating2" type="radio" name="' + input_name + '" value="2">';
    html += '<label for="rating2"><span>2</span></label>';
    html += '</div>';
    html += '<input id="rating3" type="radio" name="' + input_name + '" value="3">';
    html += '<label for="rating3"><span>3</span></label>';
    html += '</div>';
    html += '<input id="rating4" type="radio" name="' + input_name + '" value="4">';
    html += '<label for="rating4"><span>4</span></label>';
    html += '</div>';
    html += '<input id="rating5" type="radio" name="' + input_name + '" value="5">';
    html += '<label for="rating5"><span>5</span></label>';
    html += '</div>';

    $('#' + id).html(html);
}

function submitSellerNewReview()
{
    var validation = true;
    var value = '';
    $('#slr-review-form .kb-validation-error').remove();
    $('#slr-review-form input[type="text"]').each(function () {
        value = $(this).val();
        value = value.trim();
        if ($(this).hasClass('required'))
        {
            if (value == '')
            {
                validation = false;
                $(this).parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
            }
            else {
                if ($(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate')))
                {
                    validation = false;
                    $(this).parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
                }
            }
        } else if (value != '' && $(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate'))) {
            validation = false;
            $(this).parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
        }
    });

    $('#slr-review-form textarea').each(function () {
        value = $(this).val();
        value = value.trim();
        if ($(this).hasClass('required'))
        {
            if (value == '')
            {
                validation = false;
                $(this).parent().append('<div class="kb-validation-error">' + kb_required_field + '</div>');
            }
            else {
                if ($(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate')))
                {
                    validation = false;
                    $(this).parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
                }
            }
        } else if (value != '' && $(this).attr('validate') != undefined && !kbValidateField(value, $(this).attr('validate'))) {
            validation = false;
            $(this).parent().append('<div class="kb-validation-error">' + kb_invalid_field + '</div>');
        }
    });
    var click = 1;
    if (validation) {
        if (click == '1') {
            $('#slr-review-form').submit();
            $('#submitSellerReview').attr('disabled', 'true');
            click++;
        } else {
            $('#submitSellerReview').attr('disabled', 'true');
        }
    }
}

function getTransactionDetail(id_seller_transaction)
{
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true'
            + '&id_seller_transaction=' + id_seller_transaction
            + '&method=getTransactionDetail',
        beforeSend: function () {
            $('#kb-seller-transaction-view-popup .kb-model-content').hide();
            $('#kb-seller-transaction-view-popup .kb-model-content-loader').show();
            $('#kb-seller-transaction-view-popup').show();
        },
        success: function (json)
        {
            if (json['status'])
            {
                $('#kb-seller-transaction-view-popup #transaction-amount_' + json['data']['type']).html(json['data']['amount']);
                $('#kb-seller-transaction-view-popup #transaction-time_' + json['data']['type']).html(json['data']['posted_on']);
                $('#kb-seller-transaction-view-popup #transaction_number').html(json['data']['transaction_number']);
                $('#kb-seller-transaction-view-popup #transaction-comment').html(json['data']['comment']);
                $('#kb-seller-transaction-view-popup .kb-model-content-loader').hide();
                $('#kb-seller-transaction-view-popup .review-popup-time').hide();
                $('#kb-seller-transaction-view-popup #transaction-post_' + json['data']['type']).show();
                $('#kb-seller-transaction-view-popup .kb-model-content').show();
                $("html, body").animate({scrollTop: 0}, '500');
            } else {
                $('#kb-seller-transaction-view-popup').hide();
                jAlert(json['msg'] ,alert_heading);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $('#kb-seller-transaction-view-popup').hide();
            jAlert(kb_ajax_request_fail_err ,alert_heading);
        }
    });
}

function submitCategoryRequest()
{
    var reason_txt = $('#kb_category_request_form textarea[name="category_request_reason"]').val();
    var click = 1;
    if (reason_txt == '') {
        jAlert(cat_request_reason_required ,alert_heading);
    } else if (reason_txt.length < cat_request_reason_min_length) {
        jAlert(cat_request_reason_min_length_error ,alert_heading);
    } else if (reason_txt.length > cat_request_reason_max_length) {
        jAlert(cat_request_reason_max_length_error ,alert_heading);
    } else {
        if (click == '1') {
            $('form#kb_category_request_form').submit();
            $('#kb_category_request_form #kb_category_request_submit').attr('disabled', 'true');
            click++;
        } else {
            $('#kb_category_request_form #kb_category_request_submit').attr('disabled', 'true');
        }
    }
}


function submitPayoutRequest()
{
    var error = false;
    var amount = $('#kb_payout_request_form input[name="payout_request_amount"]').val().trim();
    var reason_txt = $('#kb_payout_request_form textarea[name="payout_request_reason"]').val().trim();
    if (reason_txt == '') {
        error = true;
        jAlert(pay_request_reason_required ,alert_heading);
    } else if (reason_txt.length < pay_request_reason_min_length) {
        error = true;
        jAlert(pay_request_reason_min_length_error ,alert_heading);
    } else if (reason_txt.length > pay_request_reason_max_length) {
        error = true;
        jAlert(pay_request_reason_max_length_error ,alert_heading);
    }

    if (amount != '') {
        if (!amount.match(/^-?\d*(\.\d+)?$/)) {
            error = true;
            jAlert(pay_amount_valid_error ,alert_heading);
        } else if (!amount.match(/^-?\d*(\.\d{1,2})?$/)) {
            jAlert(pay_amount_decimal_error ,alert_heading);
        } else if (amount < 0) {
            error = true;
            jAlert(pay_amount_positive_error ,alert_heading);
        }
    } else if (amount == '') {
        error = true;
        jAlert(pay_amount_required ,alert_heading);
    }
    if (error) {
        return false;
    } else {
        $('form#kb_payout_request_form').submit();
    }
}

$(document).on('change', '.kb_number_field', function () {
    this.value = this.value.replace(/,/g, '.');
});




function getSellerRequestedPayoutDetail(id_payout_request)
{
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true'
            + '&id_request=' + id_payout_request
            + '&method=getRequestDetail',
        beforeSend: function () {
            $('#kb-seller-payout-view-popup .kb-model-content').hide();
            $('#kb-seller-payout-view-popup .kb-model-content-loader').show();
            $('#kb-seller-payout-view-popup').show();
        },
        success: function (json)
        {
            if (json['status'])
            {
                $('#kb-seller-payout-view-popup #seller_requested_amount_name').html(json['data']['amount_name']);
                $('#kb-seller-payout-view-popup #request-time').html(json['data']['posted_on']);
                $('#kb-seller-payout-view-popup #category_request_status').html(json['data']['status']);
                $('#kb-seller-payout-view-popup #seller_request_comment').html(json['data']['seller_comment']);
                if (json['data']['admin_comment'] != undefined) {
                    $('#kb-seller-payout-view-popup #admin_comment').html(json['data']['admin_comment']);
                    $('#kb-seller-payout-view-popup #admin-comment-block').show();
                } else {
                    $('#kb-seller-payout-view-popup #admin-comment-block').hide();
                }
                $('#kb-seller-payout-view-popup .kb-model-content-loader').hide();
                $('#kb-seller-payout-view-popup .kb-model-content').show();
                $("html, body").animate({scrollTop: 0}, '500');
            } else {
                $('#kb-seller-payout-view-popup').hide();
                jAlert(json['msg'] ,alert_heading);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $('#kb-seller-payout-view-popup').hide();
            jAlert(kb_ajax_request_fail_err ,alert_heading);
        }
    });
}

function getSellerRequestedCategoryDetail(id_category_request)
{
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true'
            + '&id_request=' + id_category_request
            + '&method=getRequestDetail',
        beforeSend: function () {
            $('#kb-seller-category-view-popup .kb-model-content').hide();
            $('#kb-seller-category-view-popup .kb-model-content-loader').show();
            $('#kb-seller-category-view-popup').show();
        },
        success: function (json)
        {
            if (json['status'])
            {
                $('#kb-seller-category-view-popup #seller_requested_category_name').html(json['data']['category_name']);
                $('#kb-seller-category-view-popup #request-time').html(json['data']['posted_on']);
                $('#kb-seller-category-view-popup #category_request_status').html(json['data']['status']);
                $('#kb-seller-category-view-popup #seller_request_comment').html(json['data']['seller_comment']);
                if (json['data']['admin_comment'] != undefined) {
                    $('#kb-seller-category-view-popup #admin_comment').html(json['data']['admin_comment']);
                    $('#kb-seller-category-view-popup #admin-comment-block').show();
                } else {
                    $('#kb-seller-category-view-popup #admin-comment-block').hide();
                }
                $('#kb-seller-category-view-popup .kb-model-content-loader').hide();
                $('#kb-seller-category-view-popup .kb-model-content').show();
                $("html, body").animate({scrollTop: 0}, '500');
            } else {
                $('#kb-seller-category-view-popup').hide();
                jAlert(json['msg'] ,alert_heading);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $('#kb-seller-category-view-popup').hide();
            jAlert(kb_ajax_request_fail_err ,alert_heading);
        }
    });
}

function getSelectedPaymentContent()
{
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true'
            + '&id_seller=' + $('input[name="kb_id_seller"]').val()
            + '&payment_name=' + $('#kb-payment-select').val()
            + '&method=getSelectedPaymentContent',
        success: function (json)
        {
            if (json['content'] == '') {
                var error_tab = $('input[name="seller_payment_option"]').attr('data-tab');
                $('#sellerprofile-panel ul.kb-tabs li[rel="' + error_tab + '"]').addClass('error-tab');
//                $('input[name="seller_business_email"]').parent().append('<div class="kb-validation-error">'+json['msg']+'</div>');
                $('#kb-seller-form-msg').html('<div class="kbalert kbalert-danger"><i class="kb-material-icons">&#xE002;</i>' + kb_seller_form_error + '</div>');
                $('#sellerprofile-update-btn').removeAttr('disabled');
                $('#sellerprofile-updating-progress').css('display', 'none');
            } else {
                $('#payment-data').html(json['content']);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $('#sellerprofile-update-btn').removeAttr('disabled');
            $('#sellerprofile-updating-progress').css('display', 'none');
            jAlert(kb_ajax_request_fail_err ,alert_heading);
        }
    });
}

function getSelectedPaymentData()
{
    var selected_payment = $('#kb-payment-select').val();
    if (selected_payment != "") {
        getSelectedPaymentContent(selected_payment);
    } else {
        $('#payment-data').html('');
    }
}

function str2url(str, encoding, ucfirst)
{
    str = str.toUpperCase();
    str = str.toLowerCase();
    if (PS_ALLOW_ACCENTED_CHARS_URL)
        str = str.replace(/[^a-z0-9\s\'\:\/\[\]-]\\u00A1-\\uFFFF/g, '');
    else
    {
        /* Lowercase */
        str = str.replace(/[\u00E0\u00E1\u00E2\u00E3\u00E5\u0101\u0103\u0105\u0430]/g, 'a');
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
        str = str.replace(/[\u00F2\u00F3\u00F4\u00F5\u00F8\u014D\u014F\u0151\u043E]/g, 'o');
        str = str.replace(/[\u043F]/g, 'p');
        str = str.replace(/[\u0155\u0157\u0159\u0440]/g, 'r');
        str = str.replace(/[\u015B\u015D\u015F\u0161\u0441]/g, 's');
        str = str.replace(/[\u00DF]/g, 'ss');
        str = str.replace(/[\u0163\u0165\u0167\u0442]/g, 't');
        str = str.replace(/[\u00F9\u00FA\u00FB\u0169\u016B\u016D\u016F\u0171\u0173\u0443]/g, 'u');
        str = str.replace(/[\u0432]/g, 'v');
        str = str.replace(/[\u0175]/g, 'w');
        str = str.replace(/[\u00FF\u0177\u00FD\u044B]/g, 'y');
        str = str.replace(/[\u017A\u017C\u017E\u0437]/g, 'z');
        str = str.replace(/[\u00E4\u00E6]/g, 'ae');
        str = str.replace(/[\u0447]/g, 'ch');
        str = str.replace(/[\u0445]/g, 'kh');
        str = str.replace(/[\u0153\u00F6]/g, 'oe');
        str = str.replace(/[\u00FC]/g, 'ue');
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
        str = str.replace(/[\u00D9\u00DA\u00DB\u0168\u016A\u016C\u016E\u0170\u0172\u0423]/g, 'U');
        str = str.replace(/[\u0412]/g, 'V');
        str = str.replace(/[\u0174]/g, 'W');
        str = str.replace(/[\u0176\u042B]/g, 'Y');
        str = str.replace(/[\u0179\u017B\u017D\u0417]/g, 'Z');
        str = str.replace(/[\u00C4\u00C6]/g, 'AE');
        str = str.replace(/[\u0427]/g, 'CH');
        str = str.replace(/[\u0425]/g, 'KH');
        str = str.replace(/[\u0152\u00D6]/g, 'OE');
        str = str.replace(/[\u00DC]/g, 'UE');
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
    }
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


function submitKbMPAccessInfo()
{
    var error = false;
    $(".error_message").remove();
    $('.fancybox-inner input[name="kb_access_email"]').removeClass('error_field');

    var kb_access_email = $('.fancybox-inner input[name="kb_access_email"]').val().trim();
    if (kb_access_email == '' || kb_access_email == null) {
        error = true;
        $('.fancybox-inner input[name="kb_access_email"]').after('<span class="error_message">' + kb_empty_field + '</span>');
        $('.fancybox-inner input[name="kb_access_email"]').addClass('error_field');
    } else {
        if (!validateEmail(kb_access_email)) {
            error = true;
            $('.fancybox-inner input[name="kb_access_email"]').after('<span class="error_message">' + kb_email_valid + '</span>');
            $('.fancybox-inner input[name="kb_access_email"]').addClass('error_field');
        }
    }

    if (error) {
        return false;
    } else {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: seller_front_url,
            data: 'email=' + encodeURIComponent(kb_access_email) + '&validateCustomerEmail=1',
            success: function (data) {
                if (data == 0) {
                    error = true;
                    $('.fancybox-inner input[name="kb_access_email"]').after('<span class="error_message">' + kb_email_not_exit + '</span>');
                    $('.fancybox-inner input[name="kb_access_email"]').addClass('error_field');
                } else {
                    $('.kb_mp_personal_access_form').append('<input type="hidden" name="submitMPPersonalAccess">');
                    $('.fancybox-inner .kb_mp_personal_access_form').submit();
                }
            },
        });
        return false;
    }
}

function validatekbShopClose(e)
{
    if (confirm(kb_shop_close_confirm_text)) {
        return true;
    } else {
        event.stopPropagation();
        event.preventDefault();
    }

    return false;
}