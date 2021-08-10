<script type="text/javascript" src='{$tiny_mce_js_file}' ></script>{*Variable contains css and html content, escape not required*}
<div class="kb-content">
    {if !isset($permission_error)}
    <div class="kb-content-header">
        <h1>{$product_form_heading}</h1>
        <div class="clearfix"></div>
    </div>
    {/if}
    {if $step eq 1}
        {include file=$product_template_dir|cat:"product_type.tpl"}
    {elseif $step eq 2}
        {if !isset($permission_error)}
        <form id="kb-product-form" action="{$form_submit_url nofilter}" method="post" enctype="multipart/form-data"> {* Variable contains HTML/CSS/JSON, escape not required *}

            <input type="hidden" name="productformkey" value="{$formkey}" />
            <input type="hidden" name="id_product" value="{$id_product|intval}" />
            <input type="hidden" name="id_seller" value="{$id_seller}" />
            <div id="kb-product-form-global-msg" class="kbalert kbalert-danger" style="display:none;"><i class="icon-exclamation-sign"></i></div>
            {if $id_product > 0}
            <div class="kbbtn-group kb-tright">
                <div class="kbbtn-group kb-tleft" style="float:left;">
                    <select id='kb_lang_slector' class="btn-sm btn-info" style='margin-top: -5%;'>
                        {foreach $languages as $language}                    
                            <option {if $default_lang == $language['id_lang']} selected {/if} value='{$language['id_lang']}'>{$language['name']}</option>
                        {/foreach}
                    </select>
                </div>
                <a href="{$duplicate_link nofilter}" id="kb_product_duplicate_btn" class="btn-sm btn-info" title="{l s='click to clone this product' mod='kbmarketplace'}"><i class="kb-material-icons">content_copy</i>{l s='Duplicate' mod='kbmarketplace'}</a> {* Variable contains HTML/CSS/JSON, escape not required *}

                <a href="javascript:void(0)" onclick='{$delete_link_js nofilter}' class="btn-sm btn-danger" title="{l s='click to delete this product' mod='kbmarketplace'}"><i class="kb-material-icons">delete</i>{l s='Delete' mod='kbmarketplace'}</a> {* Variable contains HTML/CSS/JSON, escape not required *}

            </div>
            {else}
                <div class="kbbtn-group kb-tright">
                    <select id='kb_lang_slector' class="btn-sm btn-info" style='margin-top: -5%;'>
                        {foreach $languages as $language}                   
                            <option {if $default_lang == $language['id_lang']} selected {/if} value='{$language['id_lang']}'>{$language['name']}</option>
                        {/foreach}
                    </select>
                </div>
            {/if} 
            
            <div class="kbalert kbalert-info" {if $id_product > 0} style='margin-top: 3%;'{/if}>
                <i class="kb-material-icons">info_outline</i>{l s='Fields marked with (*) are mandatory fields.' mod='kbmarketplace'}
            </div>
            {if count($tabs_display) > 0}
                {foreach $tabs_display as $tab_form}
                    {$tab_form nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

                {/foreach}
            {/if}
            {hook h="displayKbMarketPlacePForm" product_id=$id_product type=$product_type form="parentform"}
            <div class='kb-vspacer5'></div>
            <br>
            <input id="kb_submission_type" type="hidden" name="submitType" value="save" />
            <input type="hidden" id="kb_product_type" name="type_product" value="{$product_type|intval}" />
            <a href="javascript:void(0)" class='btn-sm btn-info' id="submit_product_form_butn" onclick="submitProductForm('savenstay')">{l s='Save and Stay' mod='kbmarketplace'}</a>
            <a href="javascript:void(0)" class='btn-sm btn-success' id="submit_product_form_butn" onclick="submitProductForm('save')">{l s='Save' mod='kbmarketplace'}</a>
        </form>
        <script>
            var json_languages = {$json_languages nofilter};{*Variables contain JSON, can not escape this.*}
            var short_desc_limit = {$short_desc_limit|intval};
            var kb_id_product = {$id_product|intval};
            var kb_editor_lang = "{$editor_lang}";
            var kb_default_lang = {$default_lang|intval};
            var kb_form_validation_error = "{l s='Please fill the detail with valid values.' mod='kbmarketplace'}";
            var kb_chars_limit = "{l s='The name can not be greater than 128 characters.Kindly check the same for all languages.' mod='kbmarketplace'}";
            var kb_desc_limit_initial = "{l s='Short description can not be greater than ' mod='kbmarketplace'}";
            var kb_desc_limit_after = "{l s=' characters .Kindly check the same for all languages.' mod='kbmarketplace'}";
            var kb_img_format = [];

            {foreach $kb_img_frmats as $for}
                kb_img_format.push("{$for|escape:'htmlall':'UTF-8'}");
            {/foreach}
                
            var kb_product_types = [];
            var kb_product_type_simple = {$type_simple|intval};
            var kb_product_type_pack = {$type_pack|intval};
            var kb_product_type_virtual = {$type_virtual|intval};
            kb_product_types.push(kb_product_type_simple, kb_product_type_pack, kb_product_type_virtual);
            var json_languages = {$json_languages nofilter};{*Variables contain JSON, can not escape this.*}
            var alert_heading = "{l s='Alert' mod='kbmarketplace'}";
        </script>
        {/if}
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