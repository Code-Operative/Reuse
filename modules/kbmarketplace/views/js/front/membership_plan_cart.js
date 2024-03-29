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
    hideQuantiyButton();

});

function hideQuantiyButton() {
    if (typeof kb_membership_plan_products !== 'undefined') {
        var cart_qty_input = $('.js-cart-line-product-quantity');
        $.each(cart_qty_input, function (index, value) {
            for (var i = 0; i < kb_membership_plan_products.length; i++) {
                if (kb_membership_plan_products[i] === $(value).attr('data-product-id'))
                {
                    $(value).prop('readonly', true).attr('disabled', 'disabled');
                    $.each($(value).siblings(), function (index1, value1) {
                        $(value1).remove();
                    });
                }
            }
        });
    }
}

$(document).ajaxComplete(function (event, xhr, options) {
    if (options.url.indexOf('action=refresh') != -1) {
        hideQuantiyButton();
    }
});