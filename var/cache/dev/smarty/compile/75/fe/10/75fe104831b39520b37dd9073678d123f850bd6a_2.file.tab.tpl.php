<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-02 12:01:43
  from '/home/codeoperativeco/public_html/themes/interior_th/modules/homenewtab/views/templates/hook/tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608e8697aaf824_98555858',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '75fe104831b39520b37dd9073678d123f850bd6a' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/interior_th/modules/homenewtab/views/templates/hook/tab.tpl',
      1 => 1619255004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608e8697aaf824_98555858 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['carousel_tabs']->value == 'true') {?>
<li class="nav-item">
	<a data-toggle="tab" href="#homenewtab" class="homenewtab nav-link">
		<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['homenewtab_category_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

	</a>
</li>
<?php }
}
}
