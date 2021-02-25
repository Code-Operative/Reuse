<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:41:16
  from '/home/codeoperativeco/prestaoperative/admin4047wicsx/themes/default/template/helpers/tree/tree_toolbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60368fbc9df425_29869906',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd38c96065e9760fb5e7f6189230ea0d7f8a546f' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/admin4047wicsx/themes/default/template/helpers/tree/tree_toolbar.tpl',
      1 => 1613587126,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60368fbc9df425_29869906 (Smarty_Internal_Template $_smarty_tpl) {
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
