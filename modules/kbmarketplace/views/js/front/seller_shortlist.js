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
 * @copyright 2015 knowband
 * @license   see file: LICENSE.txt
 */
$(document).ready(function () {

    var valsfl = 1;

});

function addShortListSeller(ele, id_seller)
{
    var seller_id = id_seller;
    $("#sfl_shortseller_id").val(id_seller);
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        dataType: 'json',
        data: 'id_seller=' + id_seller + '&method=process',
        success: function (json) {
            if (json['status'] == true) {
                var label = sfl_already_added_text;
                if (json['action'] == 0) {
                    label = sfl_shortlist_text;
                    if (typeof (is_favourite_seller_page) != 'undefined' && is_favourite_seller_page == "1") {
                        $(ele).parent().find('.shortlist_link').css('color', 'grey');
                    } else {
                        $('.shortlist_link').css('color', 'grey');
                    }
                } else {
                    if (typeof (is_favourite_seller_page) != 'undefined' && is_favourite_seller_page == "1") {
                        $(ele).parent().find('.shortlist_link').css('color', '#ef4545');
                    } else {
                        $('.shortlist_link').css('color', '#ef4545');
                    }
                }
                if ($('.sfl_product_link_' + seller_id).length) {
                    $('.sfl_product_link_' + seller_id).each(function () {
                        $(this).html(label);
                    });
                }

                if (typeof is_favourite_seller_page === 'undefined') {
                } else if (is_favourite_seller_page == "1") {
                    window.location = json['redirect_link'];
                }

            } else {
                alert(try_again_msg);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(request_failed_msg);
        }
    });

}


