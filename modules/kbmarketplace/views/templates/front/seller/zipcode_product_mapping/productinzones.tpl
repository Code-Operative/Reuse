<div class="kb-content">
    <div class="kb-content-header">
        <h1>{if isset($zone_name)}{$zone_name}{/if}</h1>
        <div class="kbbtn-group kb-tright">
            <a href="{$cancel_button nofilter}" class="btn-sm btn-success" title="{l s='click to go back to zone list' mod='kbmarketplace'}"><i class="kb-material-icons">cancel</i>{l s='Back' mod='kbmarketplace'}</a> {* Variable contains HTML/CSS/JSON, escape not required *}
            <a href="{$map_products_link nofilter}" class="btn-sm btn-success" title="{l s='Click to map more Products' mod='kbmarketplace'}"><i class="kb-material-icons">add_circle</i>{l s='Map Products' mod='kbmarketplace'}</a>
        </div> {* Variable contains HTML/CSS/JSON, escape not required *}
        
        
        <div class="clearfix"></div>
    </div>
    <input type="hidden" id="id_zone" name="id_zone" value ="{if isset($id_zone)}{$id_zone}{/if}"/>
    {if isset($kbfilter)}
        {$kbfilter nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

    {/if}
    
    {if isset($kbmutiaction)}
        {$kbmutiaction nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

    {/if}
    
    {if isset($kblist)}
        <div class="kb-vspacer5"></div>
        {$kblist nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

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
