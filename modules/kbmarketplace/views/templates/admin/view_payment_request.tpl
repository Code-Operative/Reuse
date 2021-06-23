<div id='kb-review-box' class="panel">
    <div class='kb-review-box-heading'>
        <i class="icon-exchange"></i> {l s='Payout Transaction Request' mod='kbmarketplace'}
    </div>
    {if !empty($data['payment_info'])}
        <div class="row">
            <div class="col-xs-12">
                <div class='kb-review-row kb-review-tym'>{l s='Requsted on ' mod='kbmarketplace'} <span id='kb-review-tym-holder'>{$data['transaction']->date_add|escape:'htmlall':'UTF-8'}</span> {l s='by' mod='kbmarketplace'} <span id='kb-review-author'>{$data['customer_name']|escape:'htmlall':'UTF-8'}</span></div>
                <div class="kb-review-row">
                    <div class="panel">
                        <div class="kb-review-label">
                            {l s='Payout Request Details' mod='kbmarketplace'}
                        </div>
                        <div class="form-horizontal">
                            <div class="row">
                                <label class="control-label col-lg-3">{l s='Amount' mod='kbmarketplace'}</label>
                                <div class="col-lg-9">
                                    <p class="form-control-static">{$data['transaction']->amount|escape:'htmlall':'UTF-8'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='kb-review-row'>
                    <div class='kb-review-label'>{l s='Payment Information' mod='kbmarketplace'}</div>
                    <div class="form-horizontal">
                        <div class="row">
                            <label class="control-label col-lg-3">{l s='Payment Method' mod='kbmarketplace'}</label>
                            <div class="col-lg-9">
                                <p class="form-control-static">{if $data['payment_info']['name']=='kbpaypal'}{l s='Paypal' mod='kbmarketplace'}{else}{$data['payment_info']['name']|escape:'htmlall':'UTF-8'}{/if}</p>
                            </div>
                        </div>
                        {if $data['payment_info']['name'] =='kbpaypal'}
                            <div class="row">
                                <label class="control-label col-lg-3">{l s='%s' sprintf=$data['payment_info']['data']['paypal_id']['label']|escape:'htmlall':'UTF-8' mod='kbmarketplace'}</label>
                                <div class="col-lg-9">
                                    <p class="form-control-static">{$data['payment_info']['data']['paypal_id']['value']|escape:'htmlall':'UTF-8'}</p>
                                </div>
                            </div>
                        {else}
                            <div class="row">
                                <label class="control-label col-lg-3">{if isset($data['payment_info']['data']['owner_name'])}{l s='%s' sprintf=$data['payment_info']['data']['owner_name']['label']|escape:'htmlall':'UTF-8' mod='kbmarketplace'}{else}{l s='%s' sprintf=$data['payment_info']['data']['name']['label']|escape:'htmlall':'UTF-8' mod='kbmarketplace'}{/if}</label>
                                <div class="col-lg-9">
                                    <p class="form-control-static">{if isset($data['payment_info']['data']['owner_name'])}{$data['payment_info']['data']['owner_name']['value']|escape:'htmlall':'UTF-8'}{else}{$data['payment_info']['data']['name']['value']|escape:'htmlall':'UTF-8'}{/if}</p>
                                </div>
                            </div>
                            {if isset($data['payment_info']['data']['details'])}
                                <div class="row">
                                    <label class="control-label col-lg-3">{l s='%s' sprintf=$data['payment_info']['data']['details']['label']|escape:'htmlall':'UTF-8' mod='kbmarketplace'}</label>
                                    <div class="col-lg-9">
                                        <p class="form-control-static">{html_entity_decode($data['payment_info']['data']['details']['value']|nl2br|escape:'htmlall':'UTF-8')}</p>
                                    </div>
                                </div>
                            {/if}
                            <div class="row">
                                <label class="control-label col-lg-3">{l s='%s' sprintf=$data['payment_info']['data']['address']['label']|escape:'htmlall':'UTF-8' mod='kbmarketplace'}</label>
                                <div class="col-lg-9">
                                    <p class="form-control-static">{html_entity_decode($data['payment_info']['data']['address']['value']|nl2br|escape:'htmlall':'UTF-8')}</p>
                                </div>
                            </div>
                        {/if}
                        <div class="row">
                            <label class="control-label col-lg-3">{l s='%s' sprintf=$data['payment_info']['data']['add_info']['label']|escape:'htmlall':'UTF-8' mod='kbmarketplace'}</label>
                            <div class="col-lg-9">
                                <p class="form-control-static">{html_entity_decode($data['payment_info']['data']['add_info']['value']|nl2br|escape:'htmlall':'UTF-8')}</p>
                            </div>
                        </div>
                    </div>

                </div>
                    <form method="post" action="" id="form-transaction-payout-payment">
                        <div class="kb-review-row">
                            <div class="panel">
                                <div class="kb-review-label">
                                    {l s='Transaction' mod='kbmarketplace'}
                                </div>
                                <div class="form-horizontal">
                                    {if $data['payment_info']['name'] == 'bankwire' || $data['payment_info']['name'] == 'check'}
                                        <div class="row" style="margin-bottom: 10px;">
                                            <label class="control-label col-lg-4 required">{l s='Transaction ID' mod='kbmarketplace'}</label>
                                            <div class="col-lg-8">
                                                <input type="text" name="kb_payout_transaction_id">
                                            </div>
                                        </div>
                                    {elseif $data['payment_info']['name'] == 'kbpaypal'}
                                        <input type="hidden" name="kb_paypal_trans" value="1">
                                    {/if}
                                    <div class="row" >
                                        <input type="hidden" name="submitPayoutTrans" value="1">
                                        <input type="hidden" name="id_seller_transaction" value="{$data['transaction']->id_seller_transaction|escape:'htmlall':'UTF-8'}">
                                        <label class="control-label col-lg-4">{l s='Comment' mod='kbmarketplace'}</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="kb_payout_transaction_comment">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <script>
                    var pay_transid_required = "{l s='Transaction ID is required.' mod='kbmarketplace'}"
                    var kb_html_tags = "{l s='Field should not contain HTML tags.' mod='kbmarketplace'}"
                    var close = "{l s='Close' mod='kbmarketplace'}";
                </script>
            </div>
        </div>
    {else}
        <div class="kb-review-row alert alert-danger">
            <p class="form-control-static"> {l s='No Payout Information found for the Seller.' mod='kbmarketplace'}</p>
        </div>
    {/if}
</div>
<div class="modal-footer">
    {if !empty($data['payment_info'])}
        <button type="button" name="submitPayoutTrans" class="btn btn-default" data-dismiss="modal" onclick="submitPayoutTransaction()"><i class="icon-check"></i> {l s='Approve' mod='kbmarketplace'}</button>
    {else}
        <a href="#marketplace-reason-modal" class="marketplace-reason-modal btn btn-default"
           data-url="{$data['transaction_seller_url']|escape:'quotes':'UTF-8'}&id_seller_transaction={$data['transaction']->id_seller_transaction|escape:'htmlall':'UTF-8'}&dissapprovekb_mp_seller_transaction_request"
           data-dismiss="modal" onclick="disapproveWithConfirmation(this)">
            <i class="icon-times"></i> {l s='Disapprove' mod='kbmarketplace'}
        </a>
    {/if}
</div>
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