<script>
    var active_languages = {$languages_customization|json_encode nofilter};{*Variables contain JSON, can not escape this.*}
</script>
<div class="kb-vspacer5"></div>
<div class="kb-panel outer-border kb_product_section">
    <div data-toggle="kb-product-form-customization" class='kb-panel-header kb-panel-header-tab'>
        <h1>{$form_title|escape:'htmlall':'UTF-8'}</h1>
        <div class='kb-accordian-symbol kbexpand'><i class="kb-material-icons">&#xe145;</i></div>
        <div class='clearfix'></div>
    </div>
    <div id="kb-product-form-customization" class='kb-panel-body'>
        {if $id_product eq 0}
            <div class="kbalert kbalert-warning pack-empty-warning">
                <i class="icon-exclamation-sign" style="font-size:12px; margin-right:5px;"></i> {l s='Before Adding Customization, you must have to save this product.' mod='kbmarketplace'}
            </div>
        {else}
            <input type="hidden" name="custom_field_last_assigned_id" id="custom_field_last_assigned_id" value="{$count_custom_field}"/>
            <input type="hidden" name="default_lang_id" id="default_lang_id" value="{$default_lang}"/>
            <div class="kb-form-field-inblock" style="float:right;margin:10px;">
                    <a href="javascript:void(0)" class="kbbtn btn-info" onclick="addCustomizationBlock();"><i class="kb-material-icons">add</i><span>{l s='Add New Customization field.' mod='kbmarketplace'}</span></a>
            </div>
            <div class="panel" style="min-height:50px;margin-top:15px;">
                <ul class="custom_fields">
                    {if $custom_field_data|count}
                        {foreach from=$custom_field_data key=k item=data}
                            <li class="custom_field" id="component_position" style="margin: 10px;">
                                <div class="" style="vertical-align: top;width: 23%;display:inline-block;">
                                    <div class="kb-form-label-block">
                                        <span class="kblabel " title="{l s='Label' mod='kbmarketplace'}">{l s='Label' mod='kbmarketplace'}</span><em>*</em>
                                    </div>
                                    <div class="kb-form-field-block">
                                        {foreach $languages_customization as $lang}
                                            {if $lang['id_lang'] == $default_lang}
                                                <input type="text" class="kb-inpfield required" validate="isGenericName" name="custom_field_name_lang_{$lang['id_lang']}_{$k}" id="custom_field_name_lang_{$lang['id_lang']}_{$k}" value="{$data.name[$lang['id_lang']]}"/>
                                            {else}
                                                <input type="text" class="kb-inpfield" validate="isGenericName" name="custom_field_name_lang_{$lang['id_lang']}_{$k}" id="custom_field_name_lang_{$lang['id_lang']}_{$k}" style="display: none; "value="{$data.name[$lang['id_lang']]}"/>
                                            {/if}
                                        {/foreach}
                                    </div>
                                </div>
                                <div class="" style="width: 15%;display:inline-block;margin-left: 2%;">
                                    <div class="kb-form-label-block">
                                        <span class="kblabel " title="{l s='Type' mod='kbmarketplace'}">{l s='Type' mod='kbmarketplace'}</span><em>*</em>
                                    </div>
                                    <div class="kb-form-field-block">
                                        <select id="custom_field_type_{$k}" name="custom_field_type_{$k}" class="kb-inpselect">
                                            <option value="0">{l s='File' mod='kbmarketplace'}</option>
                                            <option value="1" {if $data.type}selected {/if} >{l s='Text' mod='kbmarketplace'}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="" style="width: 11%;display:inline-block;margin-left: 2%;">
                                    <a href="javascript:void(0)" class="kbbtn btn-info" onclick="trashCustomfield(this);"><i class="kb-material-icons kb-multiaction-icon" style='padding-right:5px'>&#xe872;</i><span>{l s='Delete' mod='kbmarketplace'}</span></a>
                                </div>
                                <div class="" style="width: 8%;display:inline-block;margin-left: 2%">
                                    <div class="kb-form-label-block">
                                        <span class="kblabel " title="{l s='Required' mod='kbmarketplace'}">{l s='Required' mod='kbmarketplace'}</span><em>*</em>
                                    </div>
                                    <div class="kb-form-field-block">
                                        <select id="custom_fields_require_{$k}" name="custom_fields_require_{$k}" class="kb-inpselect">
                                            <option value="0" >{l s='No' mod='kbmarketplace'}</option>
                                            <option value="1" {if $data.required}selected {/if} >{l s='Yes' mod='kbmarketplace'}</option>
                                        </select>
                                        {*<input type="checkbox"   id="custom_fields_require_{$k}" name="custom_fields_require_{$k}" {if $data.required} checked="checked" {/if}>*}
                                    </div>

                                </div>

                            </li>
                        {/foreach}
                    {/if}
                </ul>
            </div>			
            
            <div class="custom_block" style="display:none;">
                <li class="custom_field kb_custom_box" id="component_position" style="margin: 10px;">
                    <div class="" style="vertical-align: top;width: 23%;display:inline-block;">
                        <div class="kb-form-label-block">
                            <span class="kblabel " title="{l s='Label' mod='kbmarketplace'}">{l s='Label' mod='kbmarketplace'}</span><em>*</em>
                        </div>
                        <div class="kb-form-field-block">
                            {foreach $languages_customization as $lang}
                                {if $lang['id_lang'] == $default_lang}
                                    <input type="text" class="kb-inpfield" validate="isGenericName" name="custom_field_name_lang_{$lang['id_lang']}_id" id="custom_field_name_lang_{$lang['id_lang']}_id" value=""/>
                                {else}
                                    <input type="text" class="kb-inpfield" validate="isGenericName" name="custom_field_name_lang_{$lang['id_lang']}_id" id="custom_field_name_lang_{$lang['id_lang']}_id" style="display: none; "value=""/>
                                {/if}
                            {/foreach}
                        </div>
                    </div>
                    <div class="" style="width: 15%;margin-left: 2%;display:inline-block;">
                        <div class="kb-form-label-block">
                            <span class="kblabel " title="{l s='Type' mod='kbmarketplace'}">{l s='Type' mod='kbmarketplace'}</span><em>*</em>
                        </div>
                        <div class="kb-form-field-block">
                            <select id="custom_field_type_id" name="custom_field_type_id" class="kb-inpselect">
                                <option value="0">{l s='File' mod='kbmarketplace'}</option>
                                <option value="1" selected="selected">{l s='Text' mod='kbmarketplace'}</option>
                            </select>
                        </div>
                    </div>
                    <div class="" style="width: 11%;margin-left: 2%;display:inline-block;">
                        <a href="javascript:void(0)" class="kbbtn btn-info" onclick="trashCustomfield(this);"><i class="kb-material-icons kb-multiaction-icon" style='padding-right:5px'>&#xe872;</i><span>{l s='Delete' mod='kbmarketplace'}</span></a>
                    </div>
                    <div class="" style="width: 8%;margin-left: 2%;display:inline-block;">
                        <div class="kb-form-label-block">
                            <span class="kblabel " title="{l s='Required' mod='kbmarketplace'}">{l s='Required' mod='kbmarketplace'}</span><em>*</em>
                        </div>
                        <div class="kb-form-field-block">
                            <select id="custom_fields_require_id" name="custom_fields_require_id" class="kb-inpselect">
                                <option value="0" >{l s='No' mod='kbmarketplace'}</option>
                                <option value="1" selected>{l s='Yes' mod='kbmarketplace'}</option>
                            </select>
                            {*<input type="checkbox" id="custom_fields_require_id" name="custom_fields_require_id" value="1" checked="checked">*}
                        </div>

                    </div>

                </li>
            </div>
        {/if}
    </div>
</div>
<script type="text/javascript">
    var default_lang_id = {$default_lang};
    
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