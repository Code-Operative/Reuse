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

function addMembershipPlanToCart(id_product, id_membership_plan) {
    request_params = '&id_product=' + id_product + '&id_membership_plan=' + id_membership_plan;
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true&method=addMembershipPlanToCart' + request_params,
        beforeSend: function () {
            $('.kbloading').show();
        },
        success: function (json)
        {
            $('.kbloading').hide();
            if (json['is_error'] == 0) {
                $.gritter.add({
                    title: '',
                    text: json['success_msg'],
                    class_name: 'gritter-success',
                    sticky: false,
                    time: '3000'
                });
                updateShoppingCart();
            } else {
                $.gritter.add({
                    title: '',
                    text: json['error_msg'],
                    class_name: 'gritter-warning',
                    sticky: false,
                    time: '3000'
                });
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(kb_ajax_request_fail_err);
            $('.kbloading').hide();
        }
    });
    return false;
}

function updateShoppingCart()
{
    var refreshURL = $('.blockcart').data('refresh-url');
    var requestData = {};

    if (event && event.reason) {
        requestData = {
            id_product_attribute: event.reason.idProductAttribute,
            id_product: event.reason.idProduct,
            action: event.reason.linkAction
        };
    }

    $.post(refreshURL, requestData).then(function (resp) {
        $('.blockcart').replaceWith($(resp.preview).find('.blockcart'));
        if (resp.modal) {
            showModal(resp.modal);
        }
    }).fail(function (resp) {
        prestashop.emit('handleError', {eventType: 'updateShoppingCart', resp: resp});
    });
}