<div class="kb-vspacer5"></div>
<div class="kb-panel outer-border kb_product_section">
    <div data-toggle="kb-product-form-facility" class='kb-panel-header kb-panel-header-tab'>
        <h1>{$form_title|escape:'htmlall':'UTF-8'}</h1>
        <div class='kb-accordian-symbol kbexpand'><i class="kb-material-icons">&#xe145;</i></div>
        <div class='clearfix'></div>
    </div>
    <div id="kb-product-form-facility" class='kb-panel-body'>
        {if $id_product eq 0}
            <div class="kbalert kbalert-warning pack-empty-warning">
                <i class="kb-material-icons" style="margin-right:0;">&#xE88F;</i> {l s='Please save this product, before adding Facilities.' mod='kbmarketplace'}
            </div>
        {else}
            <div class="kb-block kb-form">
                <ul class="kb-form-list">
                    <li class="kb-form-fwidth last-row" style='min-height:inherit;'>
                        <div class="kb-form-field-inblock" style="float:right;">
                            <a href="javascript:void(0)" class="btn-sm btn-info" onclick="editFacility(0);"><i class="kb-material-icons">add</i><span>{l s='Map New Facility' mod='kbmarketplace'}</span></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li class="kb-form-fwidth last-row" style='overflow-y: auto'>
                        <table class="kb-table-list">
                            <thead>
                                <tr class="heading-row">
                                    {* changes by rishabh jain *}
                                    <th>{l s='Id' mod='kbmarketplace'}</th>
                                    {* changes over *}
                                    <th>{l s='Facility' mod='kbmarketplace'}</th>
                                    <th>{l s='Action' mod='kbmarketplace'}</th>
                                </tr>
                            </thead>
                            <tbody id="kb_product_combination_list">
                                {if count($mapped_facilities_product) == 0}
                                    <tr><td colspan="3" class="kb-empty-table kb-tcenter">{l s='No Facility is mapped for this product.' mod='kbmarketplace'}</td></tr>
                                {/if}
                            </tbody>
                        </table>
                        <table class="kb-table-list" style="display:none;">
                            <tbody id="new_facility_template">
                                <tr id="facility_row_FacilityId">                        
                                    <td>FacilityId</td>
                                    <td>FacilityName</td>
                                    <td class="kb-tcenter">
                                        <a href="javascript:void(0)" class="btn-sm" onclick="deleteFacility(FacilityId);" title="{l s='Click to delete' mod='kbmarketplace'}"><i class="kb-material-icons">delete</i></a>
                                    </td>
                                </tr>    
                            </tbody>
                        </table>
                    </li>
                </ul>
            </div>
        {/if}
        {hook h="displayKbMarketPlacePForm" product_id=$id_product type=$product_type form="image"}
    </div>
</div>
    {if $id_product neq 0}
<div id="kb-facility-modal-form" style="display:none;">
    <div class="kb-overlay"></div>
    <div id="combination-loader" class="kb-modal loading-block"><div class="loader128"></div></div>
    <div id="facility-form-content" class="kb-modal" style="display:none">
        <div class="kb-modal-header">
            <h1 id='kb_facility_form_title'>{l s='Add Facilities' mod='kbmarketplace'}</h1>
            <span class="kb-modal-close" data-modal="kb-facility-modal-form">X</span>
        </div>
        <div class="kb-modal-content">
            <div id="new-facility-form-msg" class="kbalert"></div>
            <div id="new-facility-form" class="new_facility_form kb-form" style="padding:0;">
                <ul class="kb-form-list">
                    <li class="kb-form-fwidth">
                        <input type="hidden" name="kb-added-facilities-data" value="{if isset($mapped_facilities_product) && !empty($mapped_facilities_product)}{foreach $mapped_facilities_product as $product}{$product['id_facilities']|escape:'htmlall':'UTF-8'}-{/foreach}{/if}">
                        <table class="table kb-productfacilities-dialogue-form">
                                        <thead>
                                            <tr>
                                                <th class="fixed-width-xs"><span class="title_box">{l s='Selected' mod='kbmarketplace'}</span></th>
                                                <th><span class="title_box">{l s='ID' mod='kbmarketplace'}</span></th>
                                                <th class="fixed-width-xs"><span class="title_box">{l s='Facilities' mod='kbmarketplace'}</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {if !empty($availibleFacilities)}
                                                {foreach $availibleFacilities as $facilities}
                                                    <tr id="kb-added-product-facilites_{$facilities['id_facilities']}">
                                                        <td class="fixed-width-xs">
                                                            <input type="checkbox" class="kbaddFacilitiesCheckBox" name="selected_add_facilities[]" value="{$facilities['id_facilities']}"> 
                                                        </td>
                                                        <td class="fixed-width-xs">
                                                            {$facilities['id_facilities']}
                                                        </td>
                                                        <td class="fixed-width-xs">{$facilities['name']}</td>
                                                    </tr>
                                                {/foreach}
                                            {else}
                                                <tr id="kb-no-available-facilities_default">
                                                    <td class="list-empty" colspan="7">
                                                        <div class="alert alert-warning">
                                                            {l s='No Facilities available' mod='kbmarketplace'}
                                                        </div>
                                                    </td>
                                                </tr>
                                            {/if}
                                                <tr id="kb-no-available-facilities" style="display: none;">
                                                    <td class="list-empty" colspan="7">
                                                        <div class="alert alert-warning">
                                                            {l s='No Facilities available' mod='kbmarketplace'}
                                                        </div>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                    </li>
                   
                </ul>
            </div>
        </div>
        <div class="kb-modal-footer">
            {if !empty($availibleFacilities)}
                <button id="combination-submit" type="button" class="btn-sm btn-success" data-id="0" onclick="mapFacilities()">{l s='Submit' mod='kbmarketplace'}</button>
            {/if}
            <div id="combination-updating-progress" class="input-loader" style="display: none; vertical-align: middle;"></div>
        </div>
    </div>
</div>
{/if}

<script type="text/javascript">
    var kb_available_facilities_data = '{$availibleFacilities|@json_encode nofilter}'; {* Variable contains HTML/CSS/JSON, escape not required *}
    var kb_max_img_upload_size = {$max_image_size|intval};
    var kb_img_format_error = "{l s='Image format is not supported' mod='kbmarketplace'}";
    var kb_img_save_error = "{l s='Before adding images, you must have to save this product.' mod='kbmarketplace'}";
    var kb_no_image_msg = "{l s='Images not found for this product.' mod='kbmarketplace'}";
    var kb_new_facility_title = "{l s='Map new Facilities' mod='kbmarketplace'}";
    var kb_no_facility_msg = "{l s='No Facility is mapped for this product' mod='kbmarketplace'}";
    var kb_select_facility = "{l s='Kindly select atleast one facility to map with this product' mod='kbmarketplace'}";
    var remove = "{l s='Remove' mod='kbmarketplace'}";
    $(document).ready(function(){ 
        {if count($mapped_facilities_product) > 0}
            {foreach $mapped_facilities_product as $facilities}
                displayFacilityRow({$facilities['id_facilities']|intval},
                    "{$facilities['name']|escape:'htmlall':'UTF-8'}");
            {/foreach}
        {/if}
    });
</script>
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