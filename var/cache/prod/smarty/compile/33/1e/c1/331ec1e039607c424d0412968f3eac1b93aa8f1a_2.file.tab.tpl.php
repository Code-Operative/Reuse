<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:12:50
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/homeonsaletab/views/templates/hook/tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60368912486260_06926122',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '331ec1e039607c424d0412968f3eac1b93aa8f1a' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/homeonsaletab/views/templates/hook/tab.tpl',
      1 => 1613650431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60368912486260_06926122 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['carousel_tabs']->value == 'true') {?>
<li class="nav-item">
	<a data-toggle="tab" href="#homeonsaletab" class="homeonsaletab nav-link">
		<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['homeonsaletab_category_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

	</a>
</li>
<?php }
}
}
