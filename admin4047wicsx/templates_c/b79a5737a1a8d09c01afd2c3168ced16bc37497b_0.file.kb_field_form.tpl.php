<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-18 16:41:26
  from '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/admin/kb_field_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_602e98b60ebb82_73096653',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b79a5737a1a8d09c01afd2c3168ced16bc37497b' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/admin/kb_field_form.tpl',
      1 => 1613588115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_602e98b60ebb82_73096653 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
    <div class="col-sm-12">
            
        <div class="panel">
            <div class="panel form-horizontal kb_custom_field_type">
        </div>
            <div class="kb_custom_field_form">
                <?php echo $_smarty_tpl->tpl_vars['kb_form_contents']->value;?>

            </div>
            
        </div>
    </div>
</div>    
<?php echo '<script'; ?>
>
    
    edit_field_form = <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['edit_field_form']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
;
            var kb_numeric = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field should be numeric.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
            var kb_positive = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field should be positive.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
            var check_for_all = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Kindly check for all languages.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
            var no_select = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please select placement','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        
    var kb_numeric = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field should be numeric.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    var kb_positive = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field should be positive.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    var maximum_length_excced = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum length should be greater than minimum length.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    velovalidation.setErrorLanguage({
        alphanumeric: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field should be alphanumeric.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
        digit_pass: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password should contain atleast 1 digit.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
        empty_field: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field cannot be empty.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
        number_field: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can enter only numbers.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",            
        positive_number: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Number should be greater than 0.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
        maxchar_field: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field cannot be greater than # characters.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
        minchar_field: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field cannot be less than # character(s).','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
        invalid_date: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invalid date format.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
        valid_amount: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field should be numeric.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
        valid_decimal: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field can have only upto two decimal values.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
        maxchar_size: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Size cannot be greater than # characters.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            specialchar_size: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Size should not have special characters.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            maxchar_bar: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Barcode cannot be greater than # characters.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            positive_amount: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field should be positive.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            maxchar_color: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Color could not be greater than # characters.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            invalid_color: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Color is not valid.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            specialchar: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Special characters are not allowed.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            script: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Script tags are not allowed.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            style: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Style tags are not allowed.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            iframe: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Iframe tags are not allowed.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            image_size: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Uploaded file size must be less than #.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            html_tags: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field should not contain HTML tags.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
            number_pos: "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can enter only positive numbers.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
",
        });
<?php echo '</script'; ?>
>
<?php }
}
