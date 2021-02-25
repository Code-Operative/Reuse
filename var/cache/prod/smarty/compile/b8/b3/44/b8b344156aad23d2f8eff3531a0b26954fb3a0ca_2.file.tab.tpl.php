<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:12:50
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/homebestsellerstab/views/templates/hook/tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_603689124947b5_64400280',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8b344156aad23d2f8eff3531a0b26954fb3a0ca' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/homebestsellerstab/views/templates/hook/tab.tpl',
      1 => 1613650431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603689124947b5_64400280 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['carousel_tabs']->value == 'true') {?>
<li class="nav-item">
	<a data-toggle="tab" href="#homebestsellerstab" class="homebestsellerstab nav-link">
		<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['homebestsellerstab_category_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

	</a>
</li>
<?php }
}
}
