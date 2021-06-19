<style>
    .hidden {
        display : none;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
    var id_dynamic_rule = "{$id_dynamic_rule}";
    var user_input = "{l s='User Input' mod='kbmarketplace'}";
    var slider = "{l s='Slider' mod='kbmarketplace'}";
    var dropdown = "{l s='Dropdown' mod='kbmarketplace'}";
    {* chnages by rishabh jain 31st JUly 2019 for multiple select option *}
    var multiple_dropdown = "{l s='Multiple Selectbox' mod='kbmarketplace'}";
    {* changes over *}
    var radio_btns = "{l s='Radio buttons' mod='kbmarketplace'}";
    var img_lst = "{l s='Color List' mod='kbmarketplace'}";
    var chck_box = "{l s='Checkbox' mod='kbmarketplace'}";
    var txt = "{l s='Text' mod='kbmarketplace'}";
    var txt_area = "{l s='Text Area' mod='kbmarketplace'}";
    var date = "{l s='Date' mod='kbmarketplace'}";
    var img = "{l s='Image' mod='kbmarketplace'}";
    var file = "{l s='File' mod='kbmarketplace'}";
var fxd_val = "{l s='Fixed Value' mod='kbmarketplace'}";
    var unt_price = "{l s='Unit Price' mod='kbmarketplace'}";
    var php_variable = "{l s='PHP Variable' mod='kbmarketplace'}";
    var feature = "{l s='Feature' mod='kbmarketplace'}";
    var divider = "{l s='Divider' mod='kbmarketplace'}";
    var clr_pckr = "{l s='Color Picker' mod='kbmarketplace'}";
    var select_optn = "{l s='Select' mod='kbmarketplace'}";
    var cntmtr = "{l s='Centimeter' mod='kbmarketplace'}";
    var mtr = "{l s='Meter' mod='kbmarketplace'}";
    var kg = "{l s='Kilogram' mod='kbmarketplace'}";
    var gr = "{l s='Gram' mod='kbmarketplace'}";
    var settings_err_msg = "{l s='Please save dynamic price rule general settings first to add fields' mod='kbmarketplace'}";
    var languages = {$languages|json_encode nofilter}; {* Variable contains HTML/CSS/JSON, escape not required *}
    var cnfrm_txt = "{l s='Are you sure that you want to delete this field?' mod='kbmarketplace'}";
    var success_msg = "{l s='Data saved successfully' mod='kbmarketplace'}";
    var formula_err_msg = "{l s='Formula is not correct' mod='kbmarketplace'}";
    var err_mandatory = "{l s='This field can not be left blank' mod='kbmarketplace'}";
    var err_numeric = "{l s='This field has to be numeric' mod='kbmarketplace'}";
    var err_max_min = "{l s='Minimum value can not be greater than maximum value' mod='kbmarketplace'}";
    var err_init_min = "{l s='Minimum value can not be greater than initial value' mod='kbmarketplace'}";
    var err_init_max = "{l s='Initial value can not be greater than maximum value' mod='kbmarketplace'}";
    var err_same_priority = "{l s='There is already a rule created with same priority, all rules should have different levels of priority' mod='kbmarketplace'}";
    var err_prioirty_zero = "{l s='Priority value can not be saved as 0 for any rule' mod='kbmarketplace'}";
    var step_diff_err = "{l s='Steps value can not be more than the difference of minimum and maximum value' mod='kbmarketplace'}";
    var desc_err = "{l s='Description fields can not be left blank' mod='kbmarketplace'}";
    var text_err = "{l s='Text fields can not be left blank' mod='kbmarketplace'}";
    var value_err = "{l s='Value fields can not be left blank' mod='kbmarketplace'}";
    var value_numeric_err = "{l s='Value fields has to be numeric' mod='kbmarketplace'}";
    var initial_mandatory = "{l s='Initial field can not be left blank' mod='kbmarketplace'}";
    var initial_numeric = "{l s='Initial field has to be numeric' mod='kbmarketplace'}";
    var min_mandatory = "{l s='Minimum field can not be left blank' mod='kbmarketplace'}";
    var min_numeric = "{l s='Minimum field has to be numeric' mod='kbmarketplace'}";
    var max_mandatory = "{l s='Maximum field can not be left blank' mod='kbmarketplace'}";
    var max_numeric = "{l s='Maximum field has to be numeric' mod='kbmarketplace'}";
    var max_size_mandatory = "{l s='Maximum size field can not be left blank' mod='kbmarketplace'}";
    var max_size_numeric = "{l s='Maximum size field has to be numeric' mod='kbmarketplace'}";
    var step_mandatory = "{l s='Step field can not be left blank' mod='kbmarketplace'}";
    var step_numeric = "{l s='Step field has to be numeric' mod='kbmarketplace'}";
    var step_div_err = "{l s='Step field has to be factor of initial value and can not be greater than initial value' mod='kbmarketplace'}";
</script>
<div class="kb-content">
    <div class="kb-content-header">
        <h1>{l s='Dynamic Price Rule' mod='kbmarketplace'}</h1>
        <div class="kb-content-header-btn">
            <a href="{$cancel_button nofilter}" class="btn-sm btn-success" title="{l s='click to go back to zone list' mod='kbmarketplace'}"><i class="kb-material-icons">cancel</i>{l s='Cancel' mod='kbmarketplace'}</a> {* Variable contains HTML/CSS/JSON, escape not required *}
        </div>
        <div class="clearfix"></div>
    </div>
    
    <form id="kb-dynamic-rule-form" action="{$dynamic_price_rule_submit_url nofilter}" method="post" enctype="multipart/form-data"> {* Variable contains HTML/CSS/JSON, escape not required *}

            <div id="kb-dynamic-rule-form-global-msg" class="kbalert kbalert-danger" style="display:none;"></div>
            <div class="kbalert kbalert-info">
                <i class="kb-material-icons">help_outline</i>{l s='Fields marked with (*) are mandatory fields.' mod='kbmarketplace'}
            </div>
            
            <div class="kb-panel outer-border">
                <div class='kb-panel-body'>
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <input type="hidden" name="id_dynamic_rule" id="id_dynamic_rule" value="{$id_dynamic_rule}"/>
                            <input type="hidden" name="enable_global_rules" value="{if isset($dynamic_rule_obj) && $dynamic_rule_obj->enable_global_rules == 1}1{else}0{/if}"/>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                <span class="kblabel " title="{l s='Select status' mod='kbmarketplace'}">{l s='Select Status' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select class="kb-inpselect" id="enable" name="enable" >
                                        <option value='1' {if isset($dynamic_rule_obj) && $dynamic_rule_obj->status == 1}selected="selected"{/if}>{l s='Enabled' mod='kbmarketplace'}</option>
                                        <option value='0' {if isset($dynamic_rule_obj) && $dynamic_rule_obj->status == 0}selected="selected" {/if}>{l s='Disabled' mod='kbmarketplace'}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Rule Name' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield" id="rule_name" validate="isGenericName" name="rule_name" value="{if isset($dynamic_rule_obj) && isset($dynamic_rule_obj->rule_name)}{$dynamic_rule_obj->rule_name}{else}{/if}" />
                                    
                                </div>
                            </li>
                            
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Minimum Customization Price Value' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" id="min_prod_price" validate="isPrice" name="min_prod_price" value="{if isset($dynamic_rule_obj) && isset($dynamic_rule_obj->min_product_price_val)}{$dynamic_rule_obj->min_product_price_val}{else}0{/if}" />
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Maximum Customization Price Value' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" id="max_prod_price" validate="isPrice" name="max_prod_price" value="{if isset($dynamic_rule_obj) && isset($dynamic_rule_obj->max_product_price_val)}{$dynamic_rule_obj->max_product_price_val}{else}0{/if}" />
                                </div>
                            </li>
                            
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Display Weight On Product Page' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="enable_weight_display" id='enable_weight_display' class="kb-inpselect">
                                        <option value="1" {if isset($dynamic_rule_obj) && $dynamic_rule_obj->display_weight == 1}selected="selected"{/if}>{l s='Yes' mod='kbmarketplace'}</option>
                                        <option value="0" {if isset($dynamic_rule_obj) && $dynamic_rule_obj->display_weight == 0}selected="selected"{/if}>{l s='No' mod='kbmarketplace'}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Hide Quantity Input' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="hide_quantiy_display" id='hide_quantiy_display' class="kb-inpselect">
                                        <option value="1" {if isset($dynamic_rule_obj) && $dynamic_rule_obj->hide_qty_input == 1}selected="selected"{/if}>{l s='Yes' mod='kbmarketplace'}</option>
                                        <option value="0" {if isset($dynamic_rule_obj) && $dynamic_rule_obj->hide_qty_input == 0}selected="selected"{/if}>{l s='No' mod='kbmarketplace'}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s='Multiply Price and Weight By Quantity' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="multiply_price_weight" id='multiply_price_weight' class="kb-inpselect">
                                        <option value="1" {if isset($dynamic_rule_obj) && $dynamic_rule_obj->multiply_qty == 1}selected="selected"{/if}>{l s='Yes' mod='kbmarketplace'}</option>
                                        <option value="0" {if isset($dynamic_rule_obj) && $dynamic_rule_obj->multiply_qty == 0}selected="selected"{/if}>{l s='No' mod='kbmarketplace'}</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">{l s=' Rule Priority' mod='kbmarketplace'}</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield" id="rule_priority" validate="isGenericName" name="rule_priority" value="{if isset($dynamic_rule_obj) && isset($dynamic_rule_obj->priority)}{$dynamic_rule_obj->priority}{else}{/if}" />
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class='kb-vspacer5'></div>
            <button id='savezone-mappingBtn' type="button" class='btn-sm btn-success' onclick="validateDynamicPriceRuleForm()">{l s='Save' mod='kbmarketplace'}</button>
        </form>
<div class="kb-content-header">
    <div class="clearfix"></div>
</div>
<div class="kb-content-header">
    <h1>{l s='Fields' mod='kbmarketplace'}</h1>
    <div class="kb-content-header-btn">
        <button style="float: right;" class="btn-sm btn-success kb_add_field">
            <i class="kb-material-icons">add_circle</i>
            <span>{l s='Add a new field' mod='kbmarketplace'}</span>
        </button>
    </div>
    <div class="clearfix"></div>
</div>
<div class="kbloading" style='display:none'>Loading&#8230;</div>
<div class="alert alert-warning">
    {l s='To reflect any changes done in fields and priority of the rule map the rule again with the products. ' mod='kbmarketplace'}<a target="_blank" href="{$dynamic_price_mapping_url}">{l s='Click Here' mod='kbmarketplace'}</a>{l s=' to go to the mapping tab' mod='kbmarketplace'}
</div>
<div id="kb_fields_container" class="panel product-tab">
    
    <table id="kb_fields_table" class="table table-condensed table-striped" data-class="field">
            <thead>
                <tr class="nodrag nodrop">
                    <th class="fixed-width-xs"><span class="title_box">{l s='Field ID' mod='kbmarketplace'}</span></th>
                    <th class="fixed-width-md"><span class="title_box">{l s='Name' mod='kbmarketplace'}</span></th>
                    <th class="fixed-width-lg"><span class="title_box">{l s='Label' mod='kbmarketplace'}</span></th>
                    <th class="fixed-width-md center"><span class="title_box">{l s='Type' mod='kbmarketplace'}</span></th>
                    <th class="fixed-width-sm center"><span class="title_box">{l s='Value' mod='kbmarketplace'}</span></th>
                    <th class="fixed-width-sm center"><span class="title_box">{l s='Unit' mod='kbmarketplace'}</span></th>
                    <th class="fixed-width-xs center"><span class="title_box">{l s='Values' mod='kbmarketplace'}</span></th>
                    <th class="fixed-width-sm center"><span class="title_box">{l s='Actions' mod='kbmarketplace'}</span></th>
                </tr>
            </thead>
    <tbody>
        {if !empty($fields_data)}
            {foreach $fields_data as $field_data}
                <tr data-id-field="{$field_data['id_dynamic_field']}">
                    <td class="id_field">
                        {$field_data['id_dynamic_field']}
                    </td>
                    <td>
                        <input value="{$field_data['name']}" type="text" class="form-control field_label" onblur="saveFieldName(this);">
                    </td>
                    <td>
                        <div data-class="field">
                            {foreach $languages as $lang}
                                <div style='margin:2%'>
                                    {if !empty($field_data['labels'])}
                                        {$data = Tools::jsonDecode($field_data['labels'])}
                                        <input type="text" value="{if isset($data->$lang["id_lang"])}{$data->$lang["id_lang"]}{/if}" data-id-lang="{$lang["id_lang"]}" class="form-control" placeholder='{$lang["name"]}' onblur="saveFieldLabel(this, {$field_data['id_dynamic_field']});">
                                    {else}
                                            <input type="text" value="" data-id-lang="{$lang["id_lang"]}" class="form-control" placeholder='{$lang["name"]}' onblur="saveFieldLabel(this, {$field_data['id_dynamic_field']});">
                                    {/if}
                                </div>
                            {/foreach}
                        </div>
                    </td>
                    <td>
                        <select class="form-control" onchange="saveFieldType(this, {$field_data['id_dynamic_field']})">
                                <option value="1" {if $field_data['type'] == 1}selected = 'selected'{/if}>{l s='User Input' mod='kbmarketplace'}</option>
                                <option value="2" {if $field_data['type'] == 2}selected = 'selected'{/if}>{l s='Slider' mod='kbmarketplace'}</option>
                                <option value="3" {if $field_data['type'] == 3}selected = 'selected'{/if}>{l s='Dropdown' mod='kbmarketplace'}</option>
                                {* chnages by rishabh jain 31st JUly 2019 for multiple select option *}
                                <option value="18" {if $field_data['type'] == 18}selected = 'selected'{/if}>{l s='Multiple Selectbox' mod='kbmarketplace'}</option>
                                {* changes over *}
                                <option value="4" {if $field_data['type'] == 4}selected = 'selected'{/if}>{l s='Radio buttons' mod='kbmarketplace'}</option>
                                <option value="5" {if $field_data['type'] == 5}selected = 'selected'{/if}>{l s='Color list' mod='kbmarketplace'}</option>
                                <option value="6" {if $field_data['type'] == 6}selected = 'selected'{/if}>{l s='Checkbox' mod='kbmarketplace'}</option>
                                <option value="7" {if $field_data['type'] == 7}selected = 'selected'{/if}>{l s='Text' mod='kbmarketplace'}</option>
                                <option value="8" {if $field_data['type'] == 8}selected = 'selected'{/if}>{l s='Text Area' mod='kbmarketplace'}</option>
                                <option value="9" {if $field_data['type'] == 9}selected = 'selected'{/if}>{l s='Date' mod='kbmarketplace'}</option>
                                <option value="10" {if $field_data['type'] == 10}selected = 'selected'{/if}>{l s='Image' mod='kbmarketplace'}</option>
                                <option value="12" {if $field_data['type'] == 12}selected = 'selected'{/if}>{l s='Fixed Value' mod='kbmarketplace'}</option>
                                <option value="13" {if $field_data['type'] == 13}selected = 'selected'{/if}>{l s='Unit Price' mod='kbmarketplace'}</option>
                                <option value="16" {if $field_data['type'] == 16}selected = 'selected'{/if}>{l s='Divider' mod='kbmarketplace'}</option>
                                <option value="17" {if $field_data['type'] == 17}selected = 'selected'{/if}>{l s='Color Picker' mod='kbmarketplace'}</option>
                        </select>
                    </td>
                    <td class="center">   
                        <div>
                            <input value="{$field_data['values']}" type="text" class="form-control field_value_{$field_data['id_dynamic_field']}" onblur="saveFieldValue(this, {$field_data['id_dynamic_field']})" {if $field_data['type'] == 1 || $field_data['type'] == 2 || $field_data['type'] == 12 || $field_data['type'] == 13}{else}style="display:none"{/if}>
                        </div>
                    </td>
                    <td>
                        <select class="form-control field_unit_{$field_data['id_dynamic_field']}" onchange="saveFieldUnit(this, {$field_data['id_dynamic_field']})" {if $field_data['type'] == 1 || $field_data['type'] == 2 } {else}style="display:none"{/if}>
                            <option value="0">{l s='Select' mod='kbmarketplace'}</option>
                            <option value="1" {if $field_data['unit'] == 1}selected="selected"{/if}>{l s='Centimeter' mod='kbmarketplace'}</option>
                            <option value="2" {if $field_data['unit'] == 2}selected="selected"{/if}>{l s='Meter' mod='kbmarketplace'}</option>
                            <option value="3" {if $field_data['unit'] == 3}selected="selected"{/if}>{l s='Kilogram' mod='kbmarketplace'}</option>
                            <option value="4" {if $field_data['unit'] == 4}selected="selected"{/if}>{l s='Gram' mod='kbmarketplace'}</option>
                        </select>
                    </td>
                    <td class="center">
                            <a class="field_values_{$field_data['id_dynamic_field']}" onclick="openFieldTypeForm({$field_data['id_dynamic_field']})" {if $field_data['type'] == 12 || $field_data['type'] == 13 || $field_data['type'] == 14 || $field_data['type'] == 16}style="display:none;cursor:pointer"{else}style="cursor:pointer"{/if}><i class="kb-material-icons">list</i></a>
                    </td>
                    <td class="center">
                        <div style='padding:5%;display:inline-block'>
                            <a data-name="active">
                                <i class="kb-material-icons icon-remove status_{$field_data['id_dynamic_field']} {if $field_data['status'] == 1} hidden {/if}" style="color:rgba(255, 0, 0, 0.48) !important;" onclick="changeStatus({$field_data['id_dynamic_field']}, 1);">close</i>
                                <i class="kb-material-icons icon-check status_{$field_data['id_dynamic_field']} {if $field_data['status'] == 0} hidden {/if}" style="color:rgba(0, 128, 0, 0.57) !important;" onclick="changeStatus({$field_data['id_dynamic_field']}, 0);">check</i>
                            </a>
                        </div>
                        <div style='padding:5%;display:inline-block'>
                            <a data-class="field" href="javascript.void(0)" {*class="btn btn-default"*} onclick="deleteField({$field_data['id_dynamic_field']}, this)"><i class="kb-material-icons icon-trash">delete</i></a>
                        </div>
                    </td>
                </tr>
            {/foreach}
        {/if}
    </tbody>
    </table>
    
</div>

<div class="alert alert-warning">
    {l s='1. Type of fields which will not work in the formulas in front are Color Picker, Divider, Date, Text, Text Area' mod='kbmarketplace'}
    <br>
    {l s='2. In case any field is deleted and was included in the formula then you will have to clear the formulas and create the formulas again.' mod='kbmarketplace'}
</div>

<div id="kb_fields_container_price" class="panel product-tab">
    <div class="panel-heading" title="Click here to expand/collapse">{l s='Price Formula' mod='kbmarketplace'}
        <span class="badge"></span>
    </div>
	<div class="panel-body">
		<div class="alert alert-info custom-alert">
			{l s='This interface allows you to compose a formula that will be used to dynamically calculate the product price.' mod='kbmarketplace'} {l s='Click on the available fields to add them to the formula.' mod='kbmarketplace'}
		</div>
		<h4 class="formula-title">{l s='Create Your Formula:' mod='kbmarketplace'}</h4>
		<div class="formulaSection">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="formula_tools">
						<ul class="formula_equation_tools">
							<li><a class="kb_equation_tool add price">+</a></li>
							<li><a class="kb_equation_tool sub price">-</a></li>
							<li><a class="kb_equation_tool mult price">*</a></li>
							<li><a class="kb_equation_tool divide price">/</a></li>
							<li><a class="kb_equation_tool opn_bracket price">(</a></li>
							<li><a class="kb_equation_tool cls_bracket price">)</a></li>
						</ul>
						<ul class="formula_equation_fields" id='formula_price_label'>
                                                    {foreach $fields_data as $field}
                                                        {if $field['type'] != 17 && $field['type'] != 16 && $field['type'] != 9 && $field['type'] != 7 && $field['type'] != 8}
                                                            {if $field['status'] == 1}
                                                                {if $field['type'] != 10}
                                                                    <li><a class="kb_equation_field price" data-attr-val="{$field['id_dynamic_field']}" data-attr-type="{$field['type']}">{if $field['name'] == ''}Field_{$field['id_dynamic_field']}{else}{$field['name']}{/if}</a></li>
                                                                {else}
                                                                    <li><a class="kb_equation_field price" data-attr-val="{$field['id_dynamic_field']}" data-attr-type="{$field['type']}">{if $field['name'] == ''}Field_{$field['id_dynamic_field']}_W{else}{$field['name']}_W{/if}</a></li>
                                                                    <li><a class="kb_equation_field price" data-attr-val="{$field['id_dynamic_field']}" data-attr-type="{$field['type']}">{if $field['name'] == ''}Field_{$field['id_dynamic_field']}_H{else}{$field['name']}_H{/if}</a></li>
                                                                {/if}
                                                            {/if}
                                                        {/if}
                                                    {/foreach}
						</ul>
						<ul class="formula_clear_buttons">
							<li class="label-tooltip" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Undo"><a class="kb_clear_button price undo"><i class="icon-rotate-left"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="formula_result price_block">
                                        {$fomula_elements = explode(',',$price_formula)}
                                        {foreach $fomula_elements as $fomula_element}
                                            {$ele = explode('_', $fomula_element)}
                                            {if count($ele) > 1}
                                                {foreach $fieldsCreated as $field}
                                                    {if isset($ele[2])}
                                                        {if $field['id_dynamic_field'] == $ele[1]}
                                                            <span class="kb_field">[{$field['name']}_{$ele[2]}]</span>
                                                        {/if}
                                                        {else}
                                                        {if $field['id_dynamic_field'] == $ele[1]}
                                                            <span class="kb_field">[{if $field['name'] == ''}Field_{$ele[1]}{else}{$field['name']}{/if}]</span>
                                                        {/if}
                                                    {/if}
                                                {/foreach}
                                            {else}
                                                <span class="kb_tool">{$fomula_element}</span>
                                            {/if}
                                        {/foreach}
                                    </div>
				</div>
			</div>
		</div>
	</div>	
	<div class="panel-footer" style="text-align: center;">
        <button class="btn btn-default kb_save_formula_btn" onclick="saveFormula('price', {Tools::getValue('id_dynamic_rule')})">
            <i class="icon-save"></i>
            <span>{l s='Save this formula' mod='kbmarketplace'}</span>
        </button>
        <button class="btn btn-default kb_clear_formula_btn price">
            <i class="icon-eraser"></i>
            <span>{l s='Clear' mod='kbmarketplace'}</span>
        </button>
    </div>
</div>

<div id="kb_fields_container_weight" class="panel product-tab">
    <div class="panel-heading" title="Click here to expand/collapse">{l s='Weight Formula' mod='kbmarketplace'}
        <span class="badge"></span>
    </div>
	<div class="panel-body">
		<div class="alert alert-info custom-alert">
			{l s='In order to get customized shipping cost calculations, you can define a dynamic weight formula below.' mod='kbmarketplace'} {l s='Click on the available fields to add them to the formula.' mod='kbmarketplace'}
		</div>
		<h4 class="formula-title">{l s='Create Your Formula:' mod='kbmarketplace'}</h4>
		<div class="formulaSection">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="formula_tools">
						<ul class="formula_equation_tools">
							<li><a class="kb_equation_tool add weight">+</a></li>
							<li><a class="kb_equation_tool sub weight">-</a></li>
							<li><a class="kb_equation_tool mult weight">*</a></li>
							<li><a class="kb_equation_tool divide weight">/</a></li>
							<li><a class="kb_equation_tool opn_bracket weight">(</a></li>
							<li><a class="kb_equation_tool cls_bracket weight">)</a></li>
						</ul>
						<ul class="formula_equation_fields">
                                                    <ul class="formula_equation_fields" id='formula_weight_label'>
                                                        {foreach $fields_data as $field}
                                                            {if $field['type'] != 17 && $field['type'] != 16 && $field['type'] != 9 && $field['type'] != 7 && $field['type'] != 8}
                                                                {if $field['status'] == 1}
                                                                    {if $field['type'] != 10}
                                                                        <li><a class="kb_equation_field weight" data-attr-val="{$field['id_dynamic_field']}" data-attr-type="{$field['type']}">{if $field['name'] == ''}Field_{$field['id_dynamic_field']}{else}{$field['name']}{/if}</a></li>
                                                                        {else}
                                                                        <li><a class="kb_equation_field weight" data-attr-val="{$field['id_dynamic_field']}" data-attr-type="{$field['type']}">{if $field['name'] == ''}Field_{$field['id_dynamic_field']}_W{else}{$field['name']}_W{/if}</a></li>
                                                                        <li><a class="kb_equation_field weight" data-attr-val="{$field['id_dynamic_field']}" data-attr-type="{$field['type']}">{if $field['name'] == ''}Field_{$field['id_dynamic_field']}_H{else}{$field['name']}_H{/if}</a></li>
                                                                    {/if}
                                                                {/if}
                                                            {/if}
                                                        {/foreach}
                                                    </ul>
						</ul>
						<ul class="formula_clear_buttons">
							<li class="label-tooltip" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Undo"><a class="kb_clear_button undo weight"><i class="icon-rotate-left"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="formula_result weight_block">
                                        {$fomula_elements = explode(',',$weight_formula)}
                                        {foreach $fomula_elements as $fomula_element}
                                            {$ele = explode('_', $fomula_element)}
                                            {if count($ele) > 1}
                                                {foreach $fieldsCreated as $field}
                                                    {if isset($ele[2])}
                                                        {if $field['id_dynamic_field'] == $ele[1]}
                                                            <span class="kb_field">[{$field['name']}_{$ele[2]}]</span>
                                                        {/if}
                                                        {else}
                                                        {if $field['id_dynamic_field'] == $ele[1]}
                                                            <span class="kb_field">[{if $field['name'] == ''}Field_{$ele[1]}{else}{$field['name']}{/if}]</span>
                                                        {/if}
                                                    {/if}
                                                {/foreach}
                                            {else}
                                                <span class="kb_tool">{$fomula_element}</span>
                                            {/if}
                                        {/foreach}
                                    </div>
				</div>
			</div>
		</div>
	</div>	
	<div class="panel-footer" style="text-align: center;">
        <button class="btn btn-default kb_save_formula_btn" onclick="saveFormula('weight', {Tools::getValue('id_dynamic_rule')})">
            <i class="icon-save"></i>
            <span>{l s='Save this formula' mod='kbmarketplace'}</span>
        </button>
        <button class="btn btn-default kb_clear_formula_btn weight">
            <i class="icon-eraser"></i>
            <span>{l s='Clear' mod='kbmarketplace'}</span>
        </button>
    </div>
</div>

<div id="kb_fields_container_weight" class="panel product-tab">
    <div class="panel-heading" title="Click here to expand/collapse">{l s='Quantity Formula' mod='kbmarketplace'}
        <span class="badge"></span>
    </div>
	<div class="panel-body">
		<div class="alert alert-info custom-alert">
			{l s='In order to get dynamic stock management, you can define a dynamic quantity formula below.' mod='kbmarketplace'} {l s='Click on the available fields to add them to the formula.' mod='kbmarketplace'}
		</div>
		<h4 class="formula-title">{l s='Create Your Formula:' mod='kbmarketplace'}</h4>
		<div class="formulaSection">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="formula_tools">
                                        <ul class="formula_equation_tools">
                                                <li><a class="kb_equation_tool add qty">+</a></li>
                                                <li><a class="kb_equation_tool sub qty">-</a></li>
                                                <li><a class="kb_equation_tool mult qty">*</a></li>
                                                <li><a class="kb_equation_tool divide qty">/</a></li>
                                                <li><a class="kb_equation_tool opn_bracket qty">(</a></li>
                                                <li><a class="kb_equation_tool cls_bracket qty">)</a></li>
                                        </ul>
                                        <ul class="formula_equation_fields" id='formula_quantity_label'>
                                            {foreach $fields_data as $field}
                                                {if $field['type'] != 17 && $field['type'] != 16 && $field['type'] != 9 && $field['type'] != 7 && $field['type'] != 8}
                                                    {if $field['status'] == 1}
                                                        {if $field['type'] != 10}
                                                            <li><a class="kb_equation_field qty" data-attr-val="{$field['id_dynamic_field']}" data-attr-type="{$field['type']}">{if $field['name'] == ''}Field_{$field['id_dynamic_field']}{else}{$field['name']}{/if}</a></li>
                                                            {else}
                                                            <li><a class="kb_equation_field qty" data-attr-val="{$field['id_dynamic_field']}" data-attr-type="{$field['type']}">{if $field['name'] == ''}Field_{$field['id_dynamic_field']}_W{else}{$field['name']}_W{/if}</a></li>
                                                            <li><a class="kb_equation_field qty" data-attr-val="{$field['id_dynamic_field']}" data-attr-type="{$field['type']}">{if $field['name'] == ''}Field_{$field['id_dynamic_field']}_H{else}{$field['name']}_H{/if}</a></li>
                                                        {/if}
                                                    {/if}
                                                {/if}
                                            {/foreach}
                                        </ul>
                                        <ul class="formula_clear_buttons">
                                                <li class="label-tooltip" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Undo"><a class="kb_clear_button qty undo"><i class="icon-rotate-left"></i></a></li>
                                        </ul>
                                    </div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="formula_result quantity_block">
                                        {$fomula_elements = explode(',',$qty_formula)}
                                        {foreach $fomula_elements as $fomula_element}
                                            {$ele = explode('_', $fomula_element)}
                                            {if count($ele) > 1}
                                                {foreach $fieldsCreated as $field}
                                                    {if isset($ele[2])}
                                                        {if $field['id_dynamic_field'] == $ele[1]}
                                                            <span class="kb_field">[{$field['name']}_{$ele[2]}]</span>
                                                        {/if}
                                                        {else}
                                                        {if $field['id_dynamic_field'] == $ele[1]}
                                                            <span class="kb_field">[{if $field['name'] == ''}Field_{$ele[1]}{else}{$field['name']}{/if}]</span>
                                                        {/if}
                                                    {/if}
                                                {/foreach}
                                            {else}
                                                <span class="kb_tool">{$fomula_element}</span>
                                            {/if}
                                        {/foreach}
                                    </div>
				</div>
			</div>
		</div>
	</div>	
	<div class="panel-footer" style="text-align: center;">
        <button class="btn btn-default kb_save_formula_btn" onclick="saveFormula('qty', {Tools::getValue('id_dynamic_rule')})">
            <i class="icon-save"></i>
            <span>{l s='Save this formula' mod='kbmarketplace'}</span>
        </button>
        <button class="btn btn-default kb_clear_formula_btn qty">
            <i class="icon-eraser"></i>
            <span>{l s='Clear' mod='kbmarketplace'}</span>
        </button>
    </div>
</div>
</div>
<script>
{if !empty($price_formula)}
    var price_formula = "{$price_formula}";
{else}
    var price_formula = '';
{/if}
{if !empty($weight_formula)}
    var weight_formula = "{$weight_formula}";
{else}
    var weight_formula = '';
{/if}
{if !empty($qty_formula)}
    var quantity_formula = "{$qty_formula}";
{else}
    var quantity_formula = '';
{/if}

$(document).ready(function(){
	var formula_box_height = $('.formula_tools').height();
	$('.formula_result').height(formula_box_height);

	$('.formula_equation_tools li a').click(function(){
            var selected_tool = $(this).text();
            if ($(this).hasClass('price')) {
                if (price_formula != '') {
                    price_formula = price_formula + ',' + selected_tool;
                } else {
                    price_formula = selected_tool;
                }
            }

            if ($(this).hasClass('weight')) {
                if (weight_formula != '') {
                    weight_formula = weight_formula + ',' + selected_tool;
                } else {
                    weight_formula = selected_tool;
                }
            }

            if ($(this).hasClass('qty')) {
                if (quantity_formula != '') {
                    quantity_formula = quantity_formula + ',' + selected_tool;
                } else {
                    quantity_formula = quantity_formula;
                }
            }

            $(this).parents('.formulaSection').find('.formula_result').append('<span class="kb_tool">'+selected_tool+'</span>')
	});

        mapFieldsEvent();

	$('.kb_clear_formula_btn').click(function(){
            if ($(this).hasClass('price')) {
                price_formula = '';
            } else if ($(this).hasClass('weight')) {
                weight_formula = '';
            } else if ($(this).hasClass('qty')) {
                quantity_formula = '';
            }
            $(this).parents('.product-tab').find('.formula_result').text('');
	})
        $('.kb_clear_button').click(function(){
            if ($(this).hasClass('price')) {
                price_formula = price_formula.substr(0, price_formula.lastIndexOf(","));
                price_array = price_formula.split(',');
                var html = '';
                for (var i = 0; i < price_array.length; i++) {
                    if(price_array[i].indexOf('field') != -1){
                        field_array = price_array[i].split('_');
                        $('.kb_equation_field').each(function(){
                            if($(this).hasClass('price') && $(this).attr('data-attr-val') == field_array[1]) {
                                txt = $(this).html();
                            }
                        })
                        html = html + '<span class="kb_field">[ '+txt+' ]</span>';
                    } else {
                        html = html + '<span class="kb_tool">'+price_array[i]+'</span>';
                    }
                }
                $(this).parents('.formulaSection').find('.formula_result').html(html);
            } else if ($(this).hasClass('weight')) {
                weight_formula = weight_formula.substr(0, weight_formula.lastIndexOf(","));
                weight_array = weight_formula.split(',');
                var html = '';
                for (var i = 0; i < weight_array.length; i++) {
                    if(weight_array[i].indexOf('field') != -1){
                        field_array = weight_array[i].split('_');
                        $('.kb_equation_field').each(function(){
                            if($(this).hasClass('weight') && $(this).attr('data-attr-val') == field_array[1]) {
                                txt = $(this).html();
                            }
                        })
                        html = html + '<span class="kb_field">[ '+txt+' ]</span>';
                    } else {
                        html = html + '<span class="kb_tool">'+weight_array[i]+'</span>';
                    }
                }
                $(this).parents('.formulaSection').find('.formula_result').html(html);
            } else if ($(this).hasClass('qty')) {
                quantity_formula = quantity_formula.substr(0, quantity_formula.lastIndexOf(","));
                quantity_array = quantity_formula.split(',');
                var html = '';
                for (var i = 0; i < quantity_array.length; i++) {
                    if(quantity_array[i].indexOf('field') != -1){
                        field_array = quantity_array[i].split('_');
                        $('.kb_equation_field').each(function(){
                            if($(this).hasClass('qty') && $(this).attr('data-attr-val') == field_array[1]) {
                                txt = $(this).html();
                            }
                        })
                        html = html + '<span class="kb_field">[ '+txt+' ]</span>';
                    } else {
                        html = html + '<span class="kb_tool">'+quantity_array[i]+'</span>';
                    }
                }
                $(this).parents('.formulaSection').find('.formula_result').html(html);
            }
        })
});
function mapFieldsEvent()
{
    $('.formula_equation_fields li a').unbind('click').click(function(){
        var selected_field = $(this).text();
        var id_val = $(this).attr('data-attr-val');
        var id_type = $(this).attr('data-attr-type');

        if ($(this).hasClass('price')) {
            if (price_formula != '') {
                if(id_type == 10) {
                    field_dim = selected_field.split('_');
                    price_formula = price_formula + ',' + 'field_'+id_val+'_'+field_dim[field_dim.length - 1];
                } else {
                    price_formula = price_formula + ',' + 'field_'+id_val;
                }
            } else {
                if(id_type == 10) {
                    field_dim = selected_field.split('_');
                    price_formula = 'field_'+id_val+'_'+field_dim[field_dim.length - 1];
                } else {
                    price_formula = 'field_'+ id_val;
                }
            }
        }

        if ($(this).hasClass('weight')) {
            if (weight_formula != '') {
                if(id_type == 10) {
                    field_dim = selected_field.split('_');
                    weight_formula = weight_formula + ',' + 'field_'+id_val+'_'+field_dim[field_dim.length - 1];
                } else {
                    weight_formula = weight_formula + ',' + 'field_'+id_val;
                }
            } else {
                if(id_type == 10) {
                    field_dim = selected_field.split('_');
                    weight_formula = 'field_'+id_val+'_'+field_dim[field_dim.length - 1];
                } else {
                    weight_formula = 'field_'+ id_val;
                }
            }
        }

        if ($(this).hasClass('qty')) {
            if (quantity_formula != '') {
                if(id_type == 10) {
                    field_dim = selected_field.split('_');
                    quantity_formula = quantity_formula + ',' + 'field_'+id_val+'_'+field_dim[field_dim.length - 1];
                } else {
                    quantity_formula = quantity_formula + ',' + 'field_'+id_val;
                }
            } else {
                if(id_type == 10) {
                    field_dim = selected_field.split('_');
                    quantity_formula = 'field_'+id_val+'_'+field_dim[field_dim.length - 1];
                } else {
                    quantity_formula = 'field_'+ id_val;
                }
            }
        }

        $(this).parents('.formulaSection').find('.formula_result').append('<span class="kb_field">[ '+selected_field+' ]</span>')
    });
}
</script>
<style>
    /* Absolute Center Spinner */
.kbloading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.kbloading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.kbloading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.kbloading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
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
* @copyright 2018 Knowband
* @license   see file: LICENSE.txt
*
* Description
*
* Admin tpl file
*}

