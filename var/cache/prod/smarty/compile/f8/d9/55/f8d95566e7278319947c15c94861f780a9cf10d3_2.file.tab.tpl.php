<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-18 10:04:04
  from '/home/codeoperativeco/public_html/themes/interior_th/modules/homeonsaletab/views/templates/hook/tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cc618442e437_78163374',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8d95566e7278319947c15c94861f780a9cf10d3' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/interior_th/modules/homeonsaletab/views/templates/hook/tab.tpl',
      1 => 1619255004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60cc618442e437_78163374 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['carousel_tabs']->value == 'true') {?>
<li class="nav-item">
	<a data-toggle="tab" href="#homeonsaletab" class="homeonsaletab nav-link">
		<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['homeonsaletab_category_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

	</a>
</li>
<?php }
}
}
