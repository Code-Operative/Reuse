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
 * @copyright 2017 Knowband
 * @license   see file: LICENSE.txt
 */
var method = (typeof method != 'undefined') ? method : '';
var persist = (typeof persist != 'undefined') ? persist : '';
$(document).ready(function () {
    $('.kb_membership_reminder_profile_btn').click(function () {
        if (veloValidateReminderForms(this) == false) {
            return false;
        }
        $('.kb_membership_reminder_profile_btn').attr('disabled', 'disabled');
        $('#kb_membership_reminder_profile_form').submit();

    });
 });

function veloValidateReminderForms(button_ele)
{
    var is_error = false;
    $('.kb_error_message').remove();
    var fix_amount_mand = velovalidation.isNumeric($('input[name="no_of_days"]'));
    var fix_amount_mand_only = velovalidation.checkMandatory($('input[name="no_of_days"]'));
    if (fix_amount_mand_only !== true) {
        is_error = true;
        $('input[name="no_of_days"]').addClass('kb_error_field');
        $('input[name="no_of_days"]').parent().after('<span class="kb_error_message">' + fix_amount_mand_only + '</span>');
    } else if (fix_amount_mand !== true)
    {
        is_error = true;
        $('input[name="no_of_days"]').addClass('kb_error_field');
        $('input[name="no_of_days"]').parent().after('<span class="kb_error_message">' + fix_amount_mand + '</span>');
    }
    /*Knowband validation start*/
    var first_err_flag_bottom = 0;
    $("input[name^=REMINDER_EMAIL_SUBJECT]").each(function () {
        var banner1 = $.trim($(this).val()).length;
        if (banner1 < 1) {
            if (first_err_flag_bottom == 0) {
                is_error = true;
                $('input[name="REMINDER_EMAIL_SUBJECT_' + lang_id + '"]').addClass('kb_error_field');
                $('input[name="REMINDER_EMAIL_SUBJECT_' + lang_id + '"]').parent().parent().parent().after('<span class="kb_error_message">' + all_lang_req + '</span>');
            }
            first_err_flag_bottom = 1;
        }
    });
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
