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


$(document).ready(function(){

    $('#products_mapping').parent().append($('.products_mapping'));
    $('#products_mapping').hide();

});

function validateMappingRule() {
    event.preventDefault();
    var product_item = '';
        var product_item = $.map($("#lstBox2 option"), function (a)
        {
            return a.value + ':' + a.text;
        }).join(',');
        document.getElementById('products_mapping').value = product_item;
    $('#kb-dynamic-rule-mapping-form').submit();
}