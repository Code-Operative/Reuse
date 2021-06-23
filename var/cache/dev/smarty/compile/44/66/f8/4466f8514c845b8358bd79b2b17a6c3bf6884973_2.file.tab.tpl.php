<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-14 01:48:53
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/homenewtab/views/templates/hook/tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604d6b857ced53_78458615',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4466f8514c845b8358bd79b2b17a6c3bf6884973' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/homenewtab/views/templates/hook/tab.tpl',
      1 => 1613650431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604d6b857ced53_78458615 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['carousel_tabs']->value == 'true') {?>
<li class="nav-item">
	<a data-toggle="tab" href="#homenewtab" class="homenewtab nav-link">
		<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['homenewtab_category_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

	</a>
</li>
<?php }
}
}
