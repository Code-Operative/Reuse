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
* @copyright 2016 Knowband
* @license   see file: LICENSE.txt
*/

function countdown(element, days, hours, minutes, seconds) {

    var el = $('#'+element);

    // Set the timer
    var interval = setInterval(function() {
        if(seconds == 0) {
            if(days == 0 && hours == 0 && minutes == 0) {
                el.html('<span class="kbmp-expire-text">Expired</span>');
                clearInterval(interval);
                return;
            } else {
                minutes--;
                seconds = 60;
                if (minutes == 0) {
                    hours--;
                    minutes = 59;
                }
                if (hours == 0) {
                    days--;
                    hours = 23;
                }
            }
        }

        var days_html = '';
        var hours_html = '';
        var mins_html = '';
        var secs_html = '';

        if (days > 1) {
            days_html = '<div class="kbmp-timer-text"><span>'+days+'</span>Days</div>';
        } else {
            days_html = '<div class="kbmp-timer-text"><span>'+days+'</span>Day</div>';
        }

        if (hours > 1) {
            hours_html = '<div class="kbmp-timer-text"><span>'+hours+'</span>Hrs</div>';
        } else {
            hours_html = '<div class="kbmp-timer-text"><span>'+hours+'</span>Hr</div>';
        }

        if (minutes > 1) {
            mins_html = '<div class="kbmp-timer-text"><span>'+minutes+'</span>Mins</div>';
        } else {
            mins_html = '<div class="kbmp-timer-text"><span>'+minutes+'</span>Min</div>';
        }

        if (seconds > 1) {
            secs_html = '<div class="kbmp-timer-text"><span>'+seconds+'</span>Secs</div>';
        } else {
            secs_html = '<div class="kbmp-timer-text"><span>'+seconds+'</span>Sec</div>';
        }

        var html = '<span class="kbmp-expire-text">Expires in</span>' + days_html + hours_html + mins_html + secs_html;
        el.html(html);
        seconds--;
    }, 1000);
}
$(window).load(function () {
    if (typeof (time_alert_array) != 'undefined') {
        var arrayLength = time_alert_array.length;
        for (var i = 0; i < arrayLength; i++) {
            addDealTimeToList(time_alert_array[i]['id_seller_deal'], time_alert_array[i]['deal_days'], time_alert_array[i]['deal_hours'], time_alert_array[i]['deal_mins'], time_alert_array[i]['deal_secs']);
        }
    }
    if (deal_timer_list.length) {
        for (var i = 0; i < deal_timer_list.length; i++) {
            countdown(deal_timer_list[i].id, deal_timer_list[i].days, deal_timer_list[i].hours, deal_timer_list[i].mins, deal_timer_list[i].secs);
        }
    }
});
var deal_timer_list = [];

function addDealTimeToList(id, days, hours, mins, secs)
{
    deal_timer_list.push({id:id, days: days, hours: hours, mins: mins, secs:secs});
}

$(document).ready(function(){
    if (deal_timer_list.length) {
        for(var i=0;i<deal_timer_list.length;i++){
            countdown(deal_timer_list[i].id, deal_timer_list[i].days, deal_timer_list[i].hours, deal_timer_list[i].mins, deal_timer_list[i].secs);
        }
    }
});