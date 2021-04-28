<script type="text/javascript">
    var select_facility = "{l s='Select Facilities' mod='kbmarketplace'}";
    var all_selected = "{l s='Select All' mod='kbmarketplace'}";
</script>
<style>
    #kb-marketplace-layout img {
        width: auto;
        height: auto;
    }
</style>
<div class="kb-content">
        <div class="kb-content-header">
            <h1>{l s='Add/Update Room' mod='kbmarketplace'}</h1>
            <div class="clearfix"></div>
        </div>
        <form id="kb-product-room-form" enctype="multipart/form-data" action="{$room_submit_url nofilter}" method="post" enctype="multipart/form-data"> {* Variable contains HTML/CSS/JSON, escape not required *}

            <input type="hidden" name="room_form" value="1" />
            <div id="kb-shipping-form-global-msg" class="kbalert kbalert-danger" style="display:none;"></div>
            <div class="kbalert kbalert-info">
                <i class="kb-material-icons">help_outline</i>{l s='Fields marked with (*) are mandatory fields.' mod='kbmarketplace'}
            </div>
            <div class="kb-panel outer-border">
                <div class='kb-panel-body'>
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <input type="hidden"  id="id_booking_product"  name="id_booking_product" value="{$id_booking_product}"/>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Enable' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="enable" class="kb-inpselect">
                                        <option value="0" {if isset($product_room_data['active']) && $product_room_data['active'] == 0}selected="selected"{/if}>{l s='No' mod='kbmarketplace'}</option>
                                        <option value="1" {if isset($product_room_data['active']) && $product_room_data['active'] == 1}selected="selected"{/if}>{l s='Yes' mod='kbmarketplace'}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                <span class="kblabel " title="{l s='Select Facilities' mod='kbmarketplace'}">{l s='Select Facilities' mod='kbmarketplace'}</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select id="selectbox_room_available_facility" name="avail_facilities[]" class="kb-inpselect selectbox_avail_facility" multiple="multiple" data-id='kb_mp_room_default_avail_facility'>
                                        {if count($available_facilities) > 0}
                                            {foreach $available_facilities as $facility}
                                                <option class="customize_options" value="{$facility['id_facilities']|intval}" {*{if $available_day['is_selected'] == true}selected="selected"{/if}*}>{$facility['name']|escape:'html':'UTF-8'}</option>
                                            {/foreach}
                                        {else}
                                            <option class="customize_options" value='0'>{l s='Select' mod='kbmarketplace'}</option>
                                        {/if}
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Room Category' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="room_category" id="room_category" class="kb-inpselect">
                                        {foreach $available_room_category as $room_category}
                                        <option value="{$room_category['id_booking_category']}" {if isset($product_room_data['id_room_category']) && $product_room_data['id_room_category'] == $room_category['id_booking_category']} selected="selected"{/if}>{$room_category['name']}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Room Type' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="room_type" id="room_type" class="kb-inpselect">
                                        {foreach $available_room_type as $room_type}
                                        <option value="{$room_type['id_room_type']}" {if isset($product_room_data['id_room_type']) && $product_room_data['id_room_type'] == $room_type['id_room_type']} selected="selected"{/if}>{$room_type['room_name']}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </li>
                            
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Additional Price' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" id="room_price" validate="isPrice" name="room_price" value="{if isset($product_room_data['price'])} {$product_room_data['price']}{/if}" />
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Quantity' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" id="room_quantity" validate="isInt" name="room_quantity" value="{if isset($product_room_data['room_quantity'])} {$product_room_data['room_quantity']}{/if}"/>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Check-In Time' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" id="start_time" validate="isTime" name="start_time" value="{if isset($product_room_data['start_time'])} {$product_room_data['start_time']}{/if}" />
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Check-Out Time' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" id="end_time" validate="isTime" name="end_time" value="{if isset($product_room_data['end_time'])} {$product_room_data['end_time']}{/if}" />
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Upload Image(s)' mod='kbmarketplace'}</span>
                                </div>
                                
                                <div class="kb-form-field-block">
                                    {if $image_en_start_url != ''}
                                    {$image_en_start_url nofilter} {* variable contains html,url content , can not escape *}
                                    {/if}
                                    <input type="file" name="product_room_images[]" id="product_room_images" multiple="multiple"/>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class='kb-vspacer5'></div>
            <button id='saveShippingBtn' type="button" class='btn-sm btn-success' onclick="validateRoomForm()">{l s='Save' mod='kbmarketplace'}</button>
        </form>
    
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
