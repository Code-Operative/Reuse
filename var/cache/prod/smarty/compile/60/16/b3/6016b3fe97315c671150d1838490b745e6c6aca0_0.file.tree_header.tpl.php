<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:41:16
  from '/home/codeoperativeco/prestaoperative/admin4047wicsx/themes/default/template/helpers/tree/tree_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60368fbca0aa92_86878791',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6016b3fe97315c671150d1838490b745e6c6aca0' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/admin4047wicsx/themes/default/template/helpers/tree/tree_header.tpl',
      1 => 1613587126,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60368fbca0aa92_86878791 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="tree-panel-heading-controls clearfix">
	<?php if (isset($_smarty_tpl->tpl_vars['title']->value)) {?><i class="icon-tag"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>$_smarty_tpl->tpl_vars['title']->value),$_smarty_tpl ) );
}?>
	<?php if (isset($_smarty_tpl->tpl_vars['toolbar']->value)) {
echo $_smarty_tpl->tpl_vars['toolbar']->value;
}?>
</div>
<?php }
}
