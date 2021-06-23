<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-22 19:30:20
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/homefeatured/views/templates/hook/tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6058f04c1e5244_39120371',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '009cc341e44be312db87c2c3b3d68254025f3573' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/homefeatured/views/templates/hook/tab.tpl',
      1 => 1616441374,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6058f04c1e5244_39120371 (Smarty_Internal_Template $_smarty_tpl) {
?><h2>Products </h2><br><br>      

<?php if ($_smarty_tpl->tpl_vars['carousel_tabs']->value == 'true') {?>

<li class="nav-item">
	<a data-toggle="tab" href="#homefeatured" class="homefeatured nav-link">
		<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['homefeatured_category_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

	</a>
</li>
<?php }?>

<?php }
}
