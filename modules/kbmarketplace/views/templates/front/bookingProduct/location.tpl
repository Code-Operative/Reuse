<div class="kb-vspacer5"></div>
<div class="kb-panel outer-border kb_product_section">
    <div data-toggle="kb-product-form-location" class='kb-panel-header kb-panel-header-tab'>
        <h1>{$form_title|escape:'htmlall':'UTF-8'}</h1>
        <div class='kb-accordian-symbol kbexpand'><i class="kb-material-icons">&#xe145;</i></div>
        <div class='clearfix'></div>
    </div>
    <div id="kb-product-form-location" class='kb-panel-body'>
        <div class="kb-block kb-form">
            <ul class="kb-form-list">
                <li class="kb-form-l">
                    <div class="kb-form-label-block">
                        <span class="kblabel ">{l s='Show Map' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <select name="enable_product_map" id="enable_product_map" class="kb-inpselect">
                                <option value="1" {if $enable_product_map eq 1}selected="selected"{/if}>{l s='Yes' mod='kbmarketplace'}</option>
                                <option value="0" {if $enable_product_map eq 0}selected="selected"{/if}> {l s='No' mod='kbmarketplace'}</option>
                        </select>
                    </div>
                </li>
                <li class="kb-form-r">
                    <div class="kb-form-label-block">
                        <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='Enter the address' mod='kbmarketplace'}">info_outline</i>{l s='Address' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <input type="text" class="kb-inpfield" validate="isGenericName" name="address" id="address" value="{$address}"/>
                    </div>
                </li>
                <li class="kb-form-l">
                    <div class="kb-form-label-block">
                        <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='Enter the longitude' mod='kbmarketplace'}">info_outline</i>{l s='Longitude' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <input type="text" class="kb-inpfield" name="longitude" validate="isLongitude" id="longitude" value="{$longitude}" />
                    </div>
                </li>
                <li class="kb-form-r">
                    <div class="kb-form-label-block">
                        <span class="kblabel "><i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="{l s='Enter the latitude' mod='kbmarketplace'}">info_outline</i>{l s='Latitude' mod='kbmarketplace'}</span><em>*</em>
                    </div>
                    <div class="kb-form-field-block">
                        <input type="text" class="kb-inpfield"  id="latitude" validate="isLatitude" name="latitude" value="{$latitude}" />
                    </div>
                </li>
                
                {hook h="displayKbMarketPlaceBPLForm" product_id=$id_product type=$product_type form="information"}
            </ul>
        </div>
                {* changes by rishabh jain to show manufacturer form *}
    </div>
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