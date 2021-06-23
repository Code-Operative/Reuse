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

$(document).ready(function () {
    $('#kb_mp_membership_setting_config_form_submit_btn').click(function () {
        if (veloValidateConfigForms(this) == false) {
            return false;
        }
        $('#kb_mp_membership_setting_config_form_submit_btn').attr('disabled', 'disabled');
        $('#kb_mp_membership_setting_config_form').submit();

    });
    if ($('form[id="kb_mp_membership_setting_config_form"]').length) {

        $('input:radio[name="kbmp_inform_seller_membership_plan_active"]').on('click change', function (e) {
            if ($(this).val() == 1) {
                $('textarea[id^="kbmp_membership_start_email"]').closest('.form-group').parent().parent().show();
            } else {
                $('textarea[id^="kbmp_membership_start_email"]').closest('.form-group').parent().parent().hide();
            }
        });

        if ($('input[name="kbmp_inform_seller_membership_plan_active"]:checked').val() == "1") {
            $('textarea[id^="kbmp_membership_start_email"]').closest('.form-group').parent().parent().show();
        } else {
            $('textarea[id^="kbmp_membership_start_email"]').closest('.form-group').parent().parent().hide();
        }



        $('input:radio[name="kbmp_inform_seller_membership_expiry"]').on('click change', function (e) {
            if ($(this).val() == 1) {
                $('textarea[id^="kbmp_membership_expired_email"]').closest('.form-group').parent().parent().show();
            } else {
                $('textarea[id^="kbmp_membership_expired_email"]').closest('.form-group').parent().parent().hide();
            }
        });

        if ($('input[name="kbmp_inform_seller_membership_expiry"]:checked').val() == "1") {
            $('textarea[id^="kbmp_membership_expired_email"]').closest('.form-group').parent().parent().show();
        } else {
            $('textarea[id^="kbmp_membership_expired_email"]').closest('.form-group').parent().parent().hide();
        }



//        $('input:radio[name="kbmp_inform_seller_membership_warning"]').on('click change', function (e) {
//            if ($(this).val() == 1) {
//                $('input[name="kbmp_membership_warning_email_reminder_days"]').closest( '.form-group').show();
//                $('textarea[id^="kbmp_membership_warning_email"]').closest('.form-group').parent().parent().show();
//            } else {
//                $('input[name="kbmp_membership_warning_email_reminder_days"]').closest( '.form-group').hide();
//                $('textarea[id^="kbmp_membership_warning_email"]').closest('.form-group').parent().parent().hide();
//            }
//        });
//
//        if ($('input[name="kbmp_inform_seller_membership_warning"]:checked').val() == "1") {
//            $('input[name="kbmp_membership_warning_email_reminder_days"]').closest( '.form-group').show();
//            $('textarea[id^="kbmp_membership_warning_email"]').closest('.form-group').parent().parent().show();
//        } else {
//            $('input[name="kbmp_membership_warning_email_reminder_days"]').closest( '.form-group').hide();
//            $('textarea[id^="kbmp_membership_warning_email"]').closest('.form-group').parent().parent().hide();
//        }

        $('input:radio[name="kbmp_membership_warning_msg"]').on('click change', function (e) {
            if ($(this).val() == 1) {
                $('input[name="kbmp_membership_warning_msg_reminder_days"]').closest('.form-group').show();
            } else {
                $('input[name="kbmp_membership_warning_msg_reminder_days"]').closest('.form-group').hide();
            }
        });

        if ($('input[name="kbmp_membership_warning_msg"]:checked').val() == "1") {
            $('input[name="kbmp_membership_warning_msg_reminder_days"]').closest('.form-group').show();
        } else {
            $('input[name="kbmp_membership_warning_msg_reminder_days"]').closest('.form-group').hide();
        }


        $('input:radio[name="kbmp_enable_product_limit_free_membership_plan"]').on('click change', function (e) {
            if ($(this).val() == 1) {
                $('input[name="kbmp_free_membership_product_limit"]').closest('.form-group').show();
            } else {
                $('input[name="kbmp_free_membership_product_limit"]').closest('.form-group').hide();
            }
        });

//        if ($('input[name="kbmp_free_membership_plan"]:checked').val() == "1") {
//            $('input[name="kbmp_enable_product_limit_free_membership_plan"]').closest('.form-group').show();
//            if ($('input[name="kbmp_enable_product_limit_free_membership_plan"]:checked').val() == "1") {
//                $('input[name="kbmp_free_membership_product_limit"]').closest('.form-group').show();
//            } else {
//                $('input[name="kbmp_free_membership_product_limit"]').closest('.form-group').hide();
//            }
//            $('select[name="kbmp_free_membership_plan_duration_interval"]').closest('.form-group').show();
//            $('input[name="kbmp_free_membership_plan_duration"]').closest('.form-group').show();
//        } else {
//            $('input[name="kbmp_enable_product_limit_free_membership_plan"]').closest('.form-group').hide();
//            $('input[name="kbmp_free_membership_product_limit"]').closest('.form-group').hide();
//            $('select[name="kbmp_free_membership_plan_duration_interval"]').closest('.form-group').hide();
//            $('input[name="kbmp_free_membership_plan_duration"]').closest('.form-group').hide();
//        }

        $('input:radio[name="kbmp_free_membership_plan"]').on('click change', function (e) {
            if ($(this).val() == 1) {
                $('input[name="kbmp_enable_product_limit_free_membership_plan"]').closest( '.form-group').show();
                if ($('input[name="kbmp_enable_product_limit_free_membership_plan"]:checked').val() == "1") {
                    $('input[name="kbmp_free_membership_product_limit"]').closest('.form-group').show();
                } else {
                    $('input[name="kbmp_free_membership_product_limit"]').closest('.form-group').hide();
                }
                $('select[name="kbmp_free_membership_plan_duration_interval"]').closest('.form-group').show();
                $('input[name="kbmp_free_membership_plan_duration"]').closest( '.form-group').show();
            } else {
                $('input[name="kbmp_enable_product_limit_free_membership_plan"]').closest( '.form-group').hide();
                $('input[name="kbmp_free_membership_product_limit"]').closest( '.form-group').hide();
                $('select[name="kbmp_free_membership_plan_duration_interval"]').closest('.form-group').hide();
                $('input[name="kbmp_free_membership_plan_duration"]').closest( '.form-group').hide();
            }
        });

        if ($('input[name="kbmp_free_membership_plan"]:checked').val() == "1") {
            $('input[name="kbmp_enable_product_limit_free_membership_plan"]').closest( '.form-group').show();
            if ($('input[name="kbmp_enable_product_limit_free_membership_plan"]:checked').val() == "1") {
                $('input[name="kbmp_free_membership_product_limit"]').closest('.form-group').show();
            } else {
                $('input[name="kbmp_free_membership_product_limit"]').closest('.form-group').hide();
            }
            $('select[name="kbmp_free_membership_plan_duration_interval"]').closest('.form-group').show();
            $('input[name="kbmp_free_membership_plan_duration"]').closest( '.form-group').show();
        } else {
            $('input[name="kbmp_enable_product_limit_free_membership_plan"]').closest( '.form-group').hide();
            $('input[name="kbmp_free_membership_product_limit"]').closest( '.form-group').hide();
            $('select[name="kbmp_free_membership_plan_duration_interval"]').closest('.form-group').hide();
            $('input[name="kbmp_free_membership_plan_duration"]').closest( '.form-group').hide();
        }

        if ($('input:radio[name="kbmp_mark_inactive_already_active"]').length) {
            $('input:radio[name="kbmp_mark_inactive_already_active"]').on('click change', function (e) {
                if ($(this).val() == 1) {
                    $('input[name="kbmp_product_activation_duration"]').closest('.form-group').hide();
                    $('textarea[id^="kbmp_seller_rebate_email"]').closest('.form-group').parent().parent().hide();
                    $('textarea[id^="kbmp_product_deactivation_email"]').closest('.form-group').parent().parent().show();
                } else {
                    $('input[name="kbmp_product_activation_duration"]').closest('.form-group').show();
                    $('textarea[id^="kbmp_seller_rebate_email"]').closest('.form-group').parent().parent().show();
                    $('textarea[id^="kbmp_product_deactivation_email"]').closest('.form-group').parent().parent().hide();
                }
            });
            if ($('input[name="kbmp_mark_inactive_already_active"]:checked').val() == "1") {
                $('input[name="kbmp_product_activation_duration"]').closest('.form-group').hide();
                $('textarea[id^="kbmp_seller_rebate_email"]').closest('.form-group').parent().parent().hide();
                $('textarea[id^="kbmp_product_deactivation_email"]').closest('.form-group').parent().parent().show();
            } else {
                $('input[name="kbmp_product_activation_duration"]').closest('.form-group').show();
                $('textarea[id^="kbmp_seller_rebate_email"]').closest('.form-group').parent().parent().show();
                $('textarea[id^="kbmp_product_deactivation_email"]').closest('.form-group').parent().parent().hide();
            }
        }
    }
});

function veloValidateConfigForms(button_ele)
{
    var is_error = false;
    $('.kb_error_message').remove();

    // active email error
    if ($('input[name="kbmp_inform_seller_membership_plan_active"]:checked').val() == "1") {
        var first_err_flag_top = 0;
        $("[name^=kbmp_membership_start_email]").each(function () {
            var text_err1 = tinyMCE.get($(this).attr("id")).getContent().trim();
            if (text_err1 == '') {
                if (first_err_flag_top == 0) {
                    $('textarea[name^="kbmp_membership_start_email_"]').addClass('kb_error_field');
                    if (first_err_flag_top == 0) {
                        $('<p class="kb_error_message ">' + all_lang_req + '</p>').insertAfter($('textarea[name^="kbmp_membership_start_email"]'));
                    }
                }
                first_err_flag_top = 1;
                is_error = true;
            }
        });
    }

    // expire email error
    if ($('input[name="kbmp_inform_seller_membership_expiry"]:checked').val() == "1") {

        var first_err_flag_top = 0;
        $("[name^=kbmp_membership_expired_email]").each(function () {
            var text_err1 = tinyMCE.get($(this).attr("id")).getContent().trim();
            if (text_err1 == '') {
                if (first_err_flag_top == 0) {
                    $('textarea[name^="kbmp_membership_expired_email_"]').addClass('kb_error_field');
                    if (first_err_flag_top == 0) {
                        $('<p class="kb_error_message ">' + all_lang_req + '</p>').insertAfter($('textarea[name^="kbmp_membership_expired_email"]'));
                    }
                }
                first_err_flag_top = 1;
                is_error = true;
            }
        });
    }

    // show warning msg
    if ($('input[name="kbmp_membership_warning_msg"]:checked').val() == "1") {
        var fix_amount_mand = velovalidation.isNumeric($('input[name="kbmp_membership_warning_msg_reminder_days"]'));
        var fix_amount_mand_only = velovalidation.checkMandatory($('input[name="kbmp_membership_warning_msg_reminder_days"]'));
        if (fix_amount_mand_only !== true) {
            is_error = true;
            $('input[name="kbmp_membership_warning_msg_reminder_days"]').addClass('kb_error_field');
            $('input[name="kbmp_membership_warning_msg_reminder_days"]').parent().append('<span class="kb_error_message">' + fix_amount_mand_only + '</span>');
        } else if (fix_amount_mand !== true)
        {
            is_error = true;
            $('input[name="kbmp_membership_warning_msg_reminder_days"]').addClass('kb_error_field');
            $('input[name="kbmp_membership_warning_msg_reminder_days"]').parent().append('<span class="kb_error_message">' + fix_amount_mand + '</span>');
        } else {
            $('input[name="kbmp_membership_warning_msg_reminder_days"]').removeClass('kb_error_field');
        }
    }


    // free membership plan

    if ($('input[name="kbmp_free_membership_plan"]:checked').val() == "1") {
        // product limit
        if ($('input[name="kbmp_enable_product_limit_free_membership_plan"]:checked').val() == "1") {
            var fix_amount_mand = velovalidation.isNumeric($('input[name="kbmp_free_membership_product_limit"]'));
            var fix_amount_mand_only = velovalidation.checkMandatory($('input[name="kbmp_free_membership_product_limit"]'));
            if (fix_amount_mand_only !== true) {
                is_error = true;
                $('input[name="kbmp_free_membership_product_limit"]').addClass('kb_error_field');
                $('input[name="kbmp_free_membership_product_limit"]').parent().append('<span class="kb_error_message">' + fix_amount_mand_only + '</span>');
            } else if (fix_amount_mand !== true)
            {
                is_error = true;
                $('input[name="kbmp_free_membership_product_limit"]').addClass('kb_error_field');
                $('input[name="kbmp_free_membership_product_limit"]').parent().append('<span class="kb_error_message">' + fix_amount_mand + '</span>');
            } else {
                $('input[name="kbmp_free_membership_product_limit"]').removeClass('kb_error_field');
            }
        }

        // days limit

        var fix_amount_mand = velovalidation.isNumeric($('input[name="kbmp_free_membership_plan_duration"]'));
        var fix_amount_mand_only = velovalidation.checkMandatory($('input[name="kbmp_free_membership_plan_duration"]'));
        if (fix_amount_mand_only !== true) {
            is_error = true;
            $('input[name="kbmp_free_membership_plan_duration"]').addClass('kb_error_field');
            $('input[name="kbmp_free_membership_plan_duration"]').parent().append('<span class="kb_error_message">' + fix_amount_mand_only + '</span>');
        } else if (fix_amount_mand !== true)
        {
            is_error = true;
            $('input[name="kbmp_free_membership_plan_duration"]').addClass('kb_error_field');
            $('input[name="kbmp_free_membership_plan_duration"]').parent().append('<span class="kb_error_message">' + fix_amount_mand + '</span>');
        } else {
            $('input[name="kbmp_free_membership_plan_duration"]').removeClass('kb_error_field');
        }


    }

    if ($('input[name="kbmp_mark_inactive_already_active"]').length) {
        if ($('input[name="kbmp_mark_inactive_already_active"]:checked').val() == "0") {
            var fix_amount_mand = velovalidation.isNumeric($('input[name="kbmp_product_activation_duration"]'));
            var fix_amount_mand_only = velovalidation.checkMandatory($('input[name="kbmp_product_activation_duration"]'));
            if (fix_amount_mand_only !== true) {
                is_error = true;
                $('input[name="kbmp_product_activation_duration"]').addClass('kb_error_field');
                $('input[name="kbmp_product_activation_duration"]').parent().after('<span class="kb_error_message">' + fix_amount_mand_only + '</span>');
            } else if (fix_amount_mand !== true)
            {
                is_error = true;
                $('input[name="kbmp_product_activation_duration"]').addClass('kb_error_field');
                $('input[name="kbmp_product_activation_duration"]').parent().after('<span class="kb_error_message">' + fix_amount_mand + '</span>');
            } else {
                $('input[name="kbmp_product_activation_duration"]').removeClass('kb_error_field');
            }

            var first_err_flag_top = 0;
            $("[name^=kbmp_seller_rebate_email]").each(function () {
                var text_err1 = tinyMCE.get($(this).attr("id")).getContent().trim();
                if (text_err1 == '') {

                    if (first_err_flag_top == 0) {
                        $('textarea[name^="kbmp_seller_rebate_email_"]').addClass('kb_error_field');
                        if (first_err_flag_top == 0) {


                            $('<p class="kb_error_message ">' + all_lang_req + '</p>').insertAfter($('textarea[name^="kbmp_seller_rebate_email"]'));


                        }
                    }
                    first_err_flag_top = 1;
                    is_error = true;
                }
            });
        } else {
            var first_err_flag_top = 0;
            $("[name^=kbmp_product_deactivation_email]").each(function () {
                var text_err1 = tinyMCE.get($(this).attr("id")).getContent().trim();
                if (text_err1 == '') {

                    if (first_err_flag_top == 0) {
                        $('textarea[name^="kbmp_product_deactivation_email_"]').addClass('kb_error_field');
                        if (first_err_flag_top == 0) {


                            $('<p class="kb_error_message ">' + all_lang_req + '</p>').insertAfter($('textarea[name^="kbmp_product_deactivation_email"]'));


                        }
                    }
                    first_err_flag_top = 1;
                    is_error = true;
                }
            });
        }
    }

    /*Knowband button validation start*/
    var first_err_flag_top = 0;
    $("[name^=REMINDER_EMAIL_TEMP]").each(function () {
        var text_err1 = tinyMCE.get($(this).attr("id")).getContent().trim();
        if (text_err1 == '') {

            if (first_err_flag_top == 0) {
                $('textarea[name^="REMINDER_EMAIL_TEMP_"]').addClass('kb_error_field');
                if (first_err_flag_top == 0) {


                    $('<p class="kb_error_message ">' + all_lang_req + '</p>').insertAfter($('textarea[name^="REMINDER_EMAIL_TEMP"]'));


                }
            }
            first_err_flag_top = 1;
            is_error = true;
        }
    });
    /*Knowband button validation end*/
    if (is_error) {
        jQuery('html, body').animate({
            scrollTop: jQuery(".kb_error_message").offset().top - 200
        }, 1000);
        return false;
    }
}