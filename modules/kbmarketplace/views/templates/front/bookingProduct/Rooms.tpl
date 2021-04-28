<div class="kb-vspacer5"></div>
<div class="kb-panel outer-border kb_product_section">
    <div data-toggle="kb-product-form-rooms" class='kb-panel-header kb-panel-header-tab'>
        <h1>{$form_title|escape:'htmlall':'UTF-8'}</h1>
        <div class='kb-accordian-symbol kbexpand'><i class="kb-material-icons">&#xe145;</i></div>
        <div class='clearfix'></div>
    </div>
    <div id="kb-product-form-rooms" class='kb-panel-body'>
        {if $id_product eq 0}
            <div class="kbalert kbalert-warning pack-empty-warning">
                <i class="kb-material-icons" style="margin-right:0;">&#xE88F;</i> {l s='Please save this product, before adding Facilities.' mod='kbmarketplace'}
            </div>
        {else}
            <div class="kb-block kb-form">
                <ul class="kb-form-list">
                    <li class="kb-form-fwidth last-row" style='min-height:inherit;'>
                        <div class="kb-form-field-inblock" style="float:right;">
                            <a href="{$room_new_link}" class="btn-sm btn-info" ><i class="kb-material-icons">add</i><span>{l s='Add new Rooms' mod='kbmarketplace'}</span></a>
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
                                    <th>{l s='Room' mod='kbmarketplace'}</th>
                                    <th>{l s='Room Category' mod='kbmarketplace'}</th>
                                    <th>{l s='Additional Price' mod='kbmarketplace'}</th>
                                    <th>{l s='Status' mod='kbmarketplace'}</th>
                                    <th>{l s='Action' mod='kbmarketplace'}</th>
                                </tr>
                            </thead>
                            <tbody id="kb_product_room_list">
                                {if count($product_rooms) == 0}
                                    <tr><td colspan="6" class="kb-empty-table kb-tcenter">{l s='No rooms are mapped for this product.' mod='kbmarketplace'}</td></tr>
                                {else}
                                {foreach $product_rooms as $room}
                                
                                <tr id="rooms_row_{$room['id_booking_room_facilities_map']}">                        
                                    <td>{$room['id_booking_room_facilities_map']}</td>
                                    <td>{$room['room_name']}</td>
                                    <td>{$room['category_name']}</td>
                                    <td>{$room['price']}</td>
                                    {if $room['active'] eq 1}
                                        <td>{l s='Yes' mod='kbmarketplace'}</td>
                                    {else}
                                        <td>{l s='No' mod='kbmarketplace'}</td>
                                    {/if}
                                    <td class="kb-tcenter">
                                        <a href="{$room['edit_link']}" class="btn-sm"  title="{l s='Click to edit' mod='kbmarketplace'}"><i class="kb-material-icons">edit</i></a>
                                        <a href="{$room['delete_link']}" class="btn-sm"  title="{l s='Click to delete' mod='kbmarketplace'}"><i class="kb-material-icons">delete</i></a>
                                    </td>
                                </tr>    
                                {/foreach}    
                                {/if}
                            </tbody>
                        </table>
                    </li>
                </ul>
            </div>
        {/if}
        {hook h="displayKbMarketPlacePForm" product_id=$id_product type=$product_type form="image"}
    </div>
</div>
    

<script type="text/javascript">
    var remove = "{l s='Remove' mod='kbmarketplace'}";
    
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