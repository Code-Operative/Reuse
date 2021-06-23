<div class="kb-content">
    {if !isset($permission_error)}
        <div class="kb-content-header">
            <h1>{$form_heading}</h1>
            <div class="kbbtn-group kb-tright">
            <a href="{$cancel_button nofilter}" class="btn-sm btn-success" title="{l s='click to go back to zone list' mod='kbmarketplace'}"><i class="kb-material-icons">cancel</i>{l s='Cancel' mod='kbmarketplace'}</a> {* Variable contains HTML/CSS/JSON, escape not required *}
        </div> {* Variable contains HTML/CSS/JSON, escape not required *}
            <div class="clearfix"></div>
        </div>
        <form id="kb-zone-mapping-form" action="{$product_mapping_submit_url nofilter}" method="post" enctype="multipart/form-data"> {* Variable contains HTML/CSS/JSON, escape not required *}

            <input type="hidden" name="zone-mapping_form" value="1" />
            <div id="kb-zone-mapping-form-global-msg" class="kbalert kbalert-danger" style="display:none;"></div>
            <div class="kbalert kbalert-info">
                <i class="kb-material-icons">help_outline</i>{l s='Fields marked with (*) are mandatory fields.' mod='kbmarketplace'}
            </div>
            
            <div class="kb-panel outer-border">
                <div class='kb-panel-body'>
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <li class="kb-form-fwidth last-row">
                                <div class="kb-form-label-block">
                                <span class="kblabel " title="{l s='Select Products' mod='kbmarketplace'}">{l s='Select Products' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select id="selectbox_product_products" name="id_products[]" class="kb-inpselect selectbox_products" multiple="multiple" data-id='kb_mp_product_default_product'>
                                        {if count($product_array) > 0}
                                        {foreach $product_array as $product}
                                        <option class="customize_options" value="{$product['id_product']|intval}">{$product['name']|escape:'html':'UTF-8'}</option>
                                        {/foreach}
                                        {else}
                                        <option class="customize_options" value='0'>{l s='Select' mod='kbmarketplace'}</option>
                                        {/if}
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-fwidth last-row">
                                <div class="kb-form-label-block">
                                <span class="kblabel " title="{l s='Select Zones ' mod='kbmarketplace'}">{l s='Select Zones' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select id="selectbox_product_zones" name="id_zones[]" class="kb-inpselect selectbox_zones" multiple="multiple" data-id='kb_mp_product_default_zone'>
                                        {if $zone_array > 0}
                                        {foreach $zone_array as $zone}
                                        <option class="customize_options" value="{$zone['id_option']|intval}">{$zone['name']|escape:'html':'UTF-8'}</option>
                                        {/foreach}
                                        {else}
                                        <option class="customize_options" value='0'>{l s='Select' mod='kbmarketplace'}</option>
                                        {/if}
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class='kb-vspacer5'></div>
            <button id='savezone-mappingBtn' type="button" class='btn-sm btn-success' onclick="validateProductZoneMappingForm()">{l s='Save' mod='kbmarketplace'}</button>
        </form>
        <script>
        </script>
    {/if}
</div>
    <script>
        var select_zones = "{l s='Select Zones' mod='kbmarketplace'}";
        var select_products = "{l s='Select Products' mod='kbmarketplace'}";
        var all_selected = "{l s='All Selected' mod='kbmarketplace'}";
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
