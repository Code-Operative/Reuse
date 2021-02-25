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

function getFilteredRules(kb_table_id, page_number) {
    var request_params = serializeObjectToSerialize(filter_paramters);
    request_params += '&start=' + page_number;
    $.ajax({
        type: 'POST',
        headers: {"cache-control": "no-cache"},
        url: kb_current_request + ((kb_current_request.indexOf('?') < 0) ? '?' : '&') + 'rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: "json",
        data: 'ajax=true&method=getFilteredRules' + request_params,
        beforeSend: function () {
            $('#' + kb_table_id + '_filter').attr('disable', true);
            $('#kb-list-loader').show();
        },
        success: function (json)
        {
            $('#' + kb_table_id + '_filter').attr('disable', false);
            $('#kb-list-loader').hide();
            if (json['status'] == true) {
                $('#' + kb_table_id + '_body').html(json['html']);
                $('#' + kb_table_id + '-panel-body .kb-paginator-block').html(json['pagination']);
            } else {
                var html = '<tr><td colspan="' + $('#' + kb_table_id + '-panel-body thead tr th').length + '" class="kb-tcenter kb-empty-table">' + json['msg'] + '</td></tr>';
                $('#' + kb_table_id + '_body').html(html);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            jAlert(kb_ajax_request_fail_err ,alert_heading);
            $('#' + kb_table_id + '_filter').attr('disable', false);
            $('#kb-list-loader').hide();
        }
    });
}