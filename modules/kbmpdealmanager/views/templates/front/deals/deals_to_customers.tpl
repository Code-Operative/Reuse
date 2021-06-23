{if isset($deals) && count($deals) > 0}
    <script>
        var time_alert_array = [];
    </script>
<h1 class="page-heading bottom-indent">{l s='Seller Discount and Offers' mod='kbmpdealmanager'}</h1>
<div class="clearfix"></div>
<div class="kb-vspacer5"></div>
<div class="kb-content kb-row">
    <p><strong class="dark">{l s='Terms and Conditions' mod='kbmpdealmanager'}</strong></p>
    <ul class="kbmpdeal-toc">
        <li><p>{l s='This page only shows the discount and offers given by sellers.' mod='kbmpdealmanager'}</p></li>
        <li><p>{l s='Discount and offers will only be applicable to only corresponding seller products.' mod='kbmpdealmanager'}</p></li>
        <li><p>{l s='Discount and offers will only be applicable to only corresponding seller products.' mod='kbmpdealmanager'}</p></li>
        <li><p>{l s='At a time only one discount can be applied to one product.' mod='kbmpdealmanager'}</p></li>
    </ul>
</div>
<div class="kb-panel">
    <ul class="kbmpdeal-list">
        {foreach $deals as $key => $deal}
            <li class="kb-content kb-row">
                <h3>
                    {l s='Seller' mod='kbmpdealmanager'} - {if !empty($deal['shop_name'])}{$deal['shop_name']|escape:'htmlall':'UTF-8'}{else}{l s='Unknown' mod='kbmpdealmanager'}{/if}
                    {if empty($deal['banner_path'])}
                        <a href="{$link->getModuleLink('kbmpdealmanager', 'dealproducts', ['id_deal' => $deal['id_seller_deal']], (bool)Configuration::get('PS_SSL_ENABLED'))|escape:'htmlall':'UTF-8'}" title="{l s='Shop Now' mod='kbmpdealmanager'}">{l s='Shop Now >> ' mod='kbmpdealmanager'}</a>
                    {/if}
                </h3>
                {if !empty($deal['banner_path'])}
                    <div class="kbmp-shop-now-block" style="background-image: url('{$deal['banner_path']|escape:'htmlall':'UTF-8'}')">
                        <a href="{$link->getModuleLink('kbmpdealmanager', 'dealproducts', ['id_deal' => $deal['id_seller_deal']], (bool)Configuration::get('PS_SSL_ENABLED'))|escape:'htmlall':'UTF-8'}" title="{l s='Shop Now' mod='kbmpdealmanager'}">{l s='Shop Now >> ' mod='kbmpdealmanager'}</a>
                    </div>
                    <!--<img src="{$deal['banner_path']|escape:'htmlall':'UTF-8'}" alt="{$deal['title']|escape:'htmlall':'UTF-8'}" />-->
                {/if}
                <div class="kbmpdeal-info">
                    <div class="kbmpdeal-info-title">
                        <div class="desc-row">
                            <span class="deal-title">{$deal['title']|escape:'htmlall':'UTF-8'}</span>
                            {if $deal['deal_type'] == DealTool::DEAL_TYPE_CART || $deal['deal_type'] == DealTool::DEAL_TYPE_PER_PRODUCT}
                                <span class="deal-code">{l s='Coupon Code' mod='kbmpdealmanager'} - {$deal['code']|escape:'htmlall':'UTF-8'}</span>
                            {/if}
                        </div>
                    </div>
                    <div id="kbmp-deal-{$deal['id_seller_deal']|intval}" class="kbmpdeal-info-expire">
                    </div>
                </div>
                <script type="text/javascript">
                    time_alert_array[{$key}] = [];
                    time_alert_array[{$key}].id_seller_deal = "kbmp-deal-{$deal['id_seller_deal']|intval}";
                    time_alert_array[{$key}].deal_days = {$deal['days']|intval};
                    time_alert_array[{$key}].deal_hours = {$deal['hours']|intval};
                    time_alert_array[{$key}].deal_mins = {$deal['mins']|intval};
                    time_alert_array[{$key}].deal_secs = {$deal['secs']|intval};
                </script>
            </li>
        {/foreach}
    </ul>
</div>
{else}
    <h1 class="page-heading" style='border:0;'>{$empty_list|escape:'htmlall':'UTF-8'}</h1>
{/if}
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