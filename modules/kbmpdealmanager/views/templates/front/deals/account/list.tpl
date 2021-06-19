<div class="kb-content">
    <div class="kb-content-header">
        <h1>{l s='Catalog And Coupon Deals' mod='kbmpdealmanager'}</h1>
        <div class="kb-content-header-btn">
            <a href="{$new_deal_link|escape:'htmlall':'UTF-8'}" class="kbbtn kbbtn-success" title="{l s='click to add new deal' mod='kbmpdealmanager'}"><i class="icon-save"><span>{l s='Add New Deal' mod='kbmpdealmanager'}</span></i></a>
            <a href="{$cleanup_link|escape:'htmlall':'UTF-8'}" class="kbbtn btn-danger" title="{l s='click to remove your all expired deals and offers' mod='kbmpdealmanager'}"><i class="icon-trash"><span>{l s='Cleanup' mod='kbmpdealmanager'}</span></i></a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class='kb-vspacer5'></div>
    {if isset($kbfilter)}
        {$kbfilter nofilter}{*Variable contains css and html content, escape not required*}
    {/if}
    
    {if isset($kblist)}
        <div class="kb-vspacer5"></div>
        {$kblist nofilter}{*Variable contains css and html content, escape not required*}
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
* @copyright 2016 knowband
* @license   see file: LICENSE.txt
*}
