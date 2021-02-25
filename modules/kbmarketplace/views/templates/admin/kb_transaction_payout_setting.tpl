<div class="alert alert-info">
    <p>{l s='To complete the process of Paypal payout payment, Click on the \'Process Payout Status\' button to update the status of transaction.' mod='kbmarketplace'}</p>
</div>
    <div class="alert alert-warning">
        <p class="">
            {l s='Cron Instructions' mod='kbmarketplace'}
        </p>
        <br/>
        <p>
            {l s='Add the cron to your store via control panel/putty to update the status of Paypal Payout transaction. Please find the instructions to setup crons below -' mod='kbmarketplace'}
        </p>
        <br/>
        <p>
            <b>{l s='URLs to Add to Cron via Control Panel' mod='kbmarketplace'}</b>
        </p>
        <p> <b>{l s='Process Paypal Payout Status' mod='kbmarketplace'}</b> - {$kb_cron_url|escape:'quotes':'UTF-8'}</p>
        {*Start changes by Priyanshu on 25-January-2019 to implement the Custom Change for Payout Automation Request *}
        <p> <b>{l s='Automation Paypal Request' mod='kbmarketplace'}</b> - {$kb_auto_cron_paypal_url|escape:'quotes':'UTF-8'}</p>
        {*End changes by Priyanshu on 25-January-2019 to implement the Custom Change for Payout Automation Request *}
        <p>
            <b>{l s='Cron setup via SSH' mod='kbmarketplace'}</b>
        </p>
        <p><b>{l s='Process Paypal Payout Status' mod='kbmarketplace'}</b> - 40 * * * * curl -O /dev/null '{$kb_cron_url|escape:'htmlall':'UTF-8'}'</p>
        {*Start changes by Priyanshu on 25-January-2019 to implement the Custom Change for Payout Automation Request *}
        <p> <b>{l s='Automation Paypal Request' mod='kbmarketplace'}</b> - 0 12 * * * curl -O /dev/null '{$kb_auto_cron_paypal_url|escape:'htmlall':'UTF-8'}'</p>
        {*End changes by Priyanshu on 25-January-2019 to implement the Custom Change for Payout Automation Request *}
    </div>


<div class='kb-extra-content'>
    <a class="btn btn-warning pull-right open_new_transaction_form" href="javascript:void(0)" onclick="openkbPayoutSettingForm(this)">
        <i class="icon-collapse" id="icon_add_colapse_new_transaction"></i> <span id="kb-new-trabsaction-btn-label">{$kb_form_heading|escape:'htmlall':'UTF-8'}</span>
    </a>
    <div class='clearfix'></div>    
</div>
<div id="kb_payout_setting_form" style="display:none;">
    <div class="alert alert-info">
        <p>{l s='Currently PayPal is supported for the PayOut. Enter the PayPal API details to Payout. Click here for ' mod='kbmarketplace'}<a href="https://www.paypal.com/">{l s='Paypal API details.' mod='kbmarketplace'}</a></p>
    </div>
    {$kb_payout_setting_form}{*Variable contains css and html content, escape not required*}
</div>
<script type='text/javascript'>
{*    var kb_admin_trans_error = "{$kb_admin_trans_error|escape:'htmlall':'UTF-8'}";*}
    var kb_admin_trans_new_txt = "{$kb_form_heading|escape:'htmlall':'UTF-8'}";
    var kb_admin_trans_close_txt = "{$kb_admin_trans_close_txt|escape:'htmlall':'UTF-8'}";
    var field_empty = "{l s='Field cannot be empty' mod='kbmarketplace'}";
    var kb_html_tags = "{l s='Field should not contain HTML tags.' mod='kbmarketplace'}";
    
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
* @copyright 2017 knowband
* @license   see file: LICENSE.txt
*}