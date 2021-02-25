<div class="kb-vspacer5"></div>


<div class="kb-panel outer-border kb_product_section">
    <div data-toggle="kb-product-form-suppliers" class='kb-panel-header kb-panel-header-tab'>
        <h1>{$form_title|escape:'htmlall':'UTF-8'}</h1>
        <div class='kb-accordian-symbol kbexpand'><i class="kb-material-icons">&#xe145;</i></div>
        <div class='clearfix'></div>
    </div>
    <div id="kb-product-form-suppliers" class='kb-panel-body'>
        {if $id_product eq 0}
            <div class="kbalert kbalert-warning pack-empty-warning">
                <i class="icon-exclamation-sign" style="font-size:12px; margin-right:5px;"></i> {l s='You must save this product before managing suppliers.' mod='kbmarketplace'}
            </div>
        {else}
        <div class="kb-block kb-form">
            {* changes by rishabh jain to add option to add supplier*}
            {if $is_enable_custom_supplier}
                <div class="kb-form-field-inblock" style="float:right;">
                        <a href="javascript:void(0)" class="kbbtn btn-info" onclick="addNewSupplier();"><i class="kb-material-icons">add</i><span>{l s='Add New Supplier' mod='kbmarketplace'}</span></a>
                </div>
            {/if}
            {* changes over*}
            <ul class="kb-form-list">
                <li class="kb-form-fwidth last-row">
                    <div class="kb-form-label-block">
                    <span class="kblabel " title="{l s='List of the suppliers' mod='kbmarketplace'}">{l s='Suppliers' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <select id="selectbox_product_suppliers" name="id_suppliers[]" class="kb-inpselect selectbox_suppliers" multiple="multiple" data-id='kb_mp_product_default_supplier'>
                            {if $suppliers > 0}
                            {foreach $suppliers as $supplier}
                            <option class="customize_options" value="{$supplier['id_supplier']|intval}" {if $supplier['is_selected'] == true}selected="selected"{/if}>{$supplier['name']|escape:'html':'UTF-8'}</option>
                            {/foreach}
                            {else}
                            <option class="customize_options" value='0'>{l s='Select' mod='kbmarketplace'}</option>
                            {/if}
                        </select>
                    </div>
                </li>
                <li class="kb-form-fwidth last-row">
                    <div class="kb-form-label-block">
                        <span class="kblabel " title="{l s='Select default supplier' mod='kbmarketplace'}">{l s='Default Supplier' mod='kbmarketplace'}</span>
                    </div>
                    <div class="kb-form-field-block">
                        <select id="kb_mp_product_default_supplier" name="default_supplier" class="kb-inpselect">
                            {if $suppliers > 0}
                            {foreach $suppliers as $supplier}
                            {if $supplier['is_selected'] == true}
                            <option class="customize_options" value="{$supplier['id_supplier']|intval}" {if $supplier['id_supplier'] == $default_supplier}selected="selected"{/if}>{$supplier['name']|escape:'htmlall':'UTF-8'}</option>
                            {/if}
                            {/foreach}
                            {else}
                            <option class="customize_options" value='0'>{l s='Select' mod='kbmarketplace'}</option>
                            {/if}
                        </select>
                    </div>
                </li>
            </ul>
    </div>
    {/if}
    {* changes by rishabh jain to show supplier form *}
    
    <div id="kb-supplier-modal-form" style="display:none;">
    <div class="kb-overlay"></div>
    <div id="supplier-loader" class="kb-modal loading-block"><div class="loader128"></div></div>
    <div id="supplier-form-content" class="kb-modal" style="display:none">
        <div class="kb-modal-header">
            <h1 id='kb_supplier_form_title'>{l s='Add New Supplier' mod='kbmarketplace'}</h1>
            <span class="kb-modal-close" data-modal="kb-supplier-modal-form">X</span>
</div>
        <div class="kb-modal-content">
            <div id="new-supplier-form-msg" class="kbalert"></div>
            <div id="new-supplier-form" class="new_supplier_form kb-form" style="padding:0;">
                <ul class="kb-form-list">
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='Name' mod='kbmarketplace'}<em>*</em>:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                <input type="text" class="kb-inpfield" id="supplier_name" name="supplier_name" value=""/>
                            </div>    
                        </div>
                    </li>
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='Address' mod='kbmarketplace'}<em>*</em>:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                <input type="text" class="kb-inpfield" id="supplier_address_1" name="supplier_address_1" value=""/>
                            </div>    
                        </div>
                    </li>
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='Address(2)' mod='kbmarketplace'}:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                <input type="text" class="kb-inpfield" id="supplier_address_2" name="supplier_address_2" value=""/>
                            </div>    
                        </div>
                    </li>
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='Zip/Postal code' mod='kbmarketplace'}:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                <input type="text" class="kb-inpfield" id="supplier_postcode" name="supplier_postcode" value=""/>
                            </div>    
                        </div>
                    </li>
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='City' mod='kbmarketplace'}<em>*</em>:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                <input type="text" class="kb-inpfield" id="supplier_city" name="supplier_city" value=""/>
                            </div>    
                        </div>
                    </li>
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='Country' mod='kbmarketplace'}<em>*</em>:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                 <select id="supplier_id_country" name="supplier_id_country" class="kb-inpselect">
                                    {foreach from=$countries_array item='country'}
                                        <option value="{$country['id_country']|intval}" {if $country['id_country'] == $default_country} selected="selected"{/if}>{$country['name']|escape:'html':'UTF-8'}</option>                                        
                                    {/foreach}
                                `</select>
                            </div>    
                        </div>
                    </li>
                    <li class="kb-form-fwidth">
                        <div class="kb-form-field-block kb-mbtm10">
                            <div class="form-lbl-indis kb-tright">
                                <span class="kblabel">{l s='State' mod='kbmarketplace'}:</span>
                            </div>
                            <div class="form-field-indis cobmination-field">
                                <select id="supplier_id_state" name="supplier_id_state" class="kb-inpselect">
                                    <option value="0">{l s='Select State' mod='kbmarketplace'}</option>
                                </select>
                            </div>    
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kb-modal-footer">
            <button id="supplier-submit" type="button" class="kbbtn-big kbbtn-success" data-id="0" onclick="saveSupplier()">{l s='Submit' mod='kbmarketplace'}</button>
            <div id="supplier-updating-progress" class="input-loader" style="display: none; vertical-align: middle;"></div>
        </div>
    </div>
</div>
    {* changes over *}
</div>
    <script>
        var select_supplier = "{l s='Select Suppliers' mod='kbmarketplace'}";
        var all_selected = "{l s='All Selected' mod='kbmarketplace'}";
        
        var countries = {$countries nofilter};{* variable contains json content, escape not required*}
        var default_country = {$default_country|escape:'htmlall':'UTF-8'};
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