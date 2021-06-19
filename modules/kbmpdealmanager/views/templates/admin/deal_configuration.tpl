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

<div class="form-group">
    <label class="control-label col-lg-3">
        <span class="label-tooltip" data-toggle="tooltip" data-html="true" title="{l s='If disable, then seller as well as you will not be able to add new deal for the seller and if you want to disable all the deals which the seller has created previously then please disable the deals manually from the backend' mod='kbmpdealmanager'}">
            {l s='Enable Deal Manager' mod='kbmpdealmanager'}
        </span>
    </label>
    <div class="col-lg-9">
        <span class="switch prestashop-switch fixed-width-lg">
            {foreach $kbmpdealmanager as $value}
                <input type="radio" name="kbmpdealmanager_enable"{if $value.value == 1} id="kbmpdealmanager_enable_on"{else} id="kbmpdealmanager_enable_off"{/if} value="{$value.value|intval}" {if $kbmpdealmanager_enable == $value.value} checked="checked"{/if}/>
                {strip}
                <label {if $value.value == 1} for="kbmpdealmanager_enable_on"{else} for="kbmpdealmanager_enable_off"{/if}>
                    {if $value.value == 1}
                        {l s='Yes' mod='kbmpdealmanager'}
                    {else}
                        {l s='No' mod='kbmpdealmanager'}
                    {/if}
                </label>
                {/strip}
            {/foreach}
            <a class="slide-button btn"></a>
        </span>
    </div>
</div>