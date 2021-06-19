<div class='kb-extra-content'>
<a class="btn btn-warning pull-right open_new_transaction_form" href="javascript:void(0)" onclick="openNewTransactionForm(this, {$new_transaction_id_seller|intval})">
    <i id="update_transaction_form_btn" class="icon-plus-sign"></i> <span id="kb-new-trabsaction-btn-label">{$kb_form_heading|escape:'htmlall':'UTF-8'}</span>
</a>
<div class='clearfix'></div>    
</div>
<div id="kb-new-transaction-form" style="display:none;">
    {$new_transaction_form nofilter} {* Variable contains HTML, escape not required *}

</div>
<div class="">
    {$transaction_view_type nofilter} {* Variable contains HTML, escape not required *}

</div>
    <script>
         var add_trasaction = "{$add_trasaction}";
         var close_trasaction = "{$close_trasaction}";
         var transaction_amt_error = "{$transaction_amt_error}";
         var transaction_id_error = "{$transaction_id_error}";
         var select_seller = "{$select_seller}";
         var error = "{$error}";
    </script>
{*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer tohttp://www.prestashop.com for more information.
* We offer the best and most useful modules PrestaShop and modifications for your online store.
*
* @category  PrestaShop Module
* @author    knowband.com <support@knowband.com>
* @copyright 2016 knowband
* @license   see file: LICENSE.txt
*}
