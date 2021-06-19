<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 11:14:35
  from '/home/codeoperativeco/public_html/admin4047wicsx/themes/default/template/helpers/tree/tree_toolbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608a870b1e7b12_89881679',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e54571cb74d69e3402b65f1a44cfa0b1ed53a26' => 
    array (
      0 => '/home/codeoperativeco/public_html/admin4047wicsx/themes/default/template/helpers/tree/tree_toolbar.tpl',
      1 => 1619254976,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608a870b1e7b12_89881679 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="tree-actions pull-right">
	<?php if (isset($_smarty_tpl->tpl_vars['actions']->value)) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['actions']->value, 'action');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['action']->value) {
?>
		<?php echo $_smarty_tpl->tpl_vars['action']->value->render();?>

	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }?>
</div>
<?php }
}
