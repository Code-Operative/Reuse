<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-18 10:04:04
  from '/home/codeoperativeco/public_html/themes/interior_th/modules/homebestsellerstab/views/templates/hook/tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cc61844833d5_08687033',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83cef444a9f59ebe240d797dd6cde262f66453aa' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/interior_th/modules/homebestsellerstab/views/templates/hook/tab.tpl',
      1 => 1619255004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60cc61844833d5_08687033 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['carousel_tabs']->value == 'true') {?>
<li class="nav-item">
	<a data-toggle="tab" href="#homebestsellerstab" class="homebestsellerstab nav-link">
		<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['homebestsellerstab_category_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

	</a>
</li>
<?php }
}
}
