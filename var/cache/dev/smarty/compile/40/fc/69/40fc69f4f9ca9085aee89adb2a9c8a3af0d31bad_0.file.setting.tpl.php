<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 11:14:35
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/admin/setting.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608a870b4ec410_75672331',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40fc69f4f9ca9085aee89adb2a9c8a3af0d31bad' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/admin/setting.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608a870b4ec410_75672331 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['kb_tabs']->value;
echo $_smarty_tpl->tpl_vars['form_fields']->value;
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayMarketplaceSetting"),$_smarty_tpl ) );?>

<?php echo '<script'; ?>
>
    $('.marketplace-setting').each(function(){
        $('#kb_mp_seller_config_form .form-wrapper').append($(this).find('.form-wrapper').html());
        $(this).html('');
    });
    var add = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add tag','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
<?php echo '</script'; ?>
>
<?php }
}
