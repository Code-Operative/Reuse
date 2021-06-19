<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-28 10:50:51
  from '/home/codeoperativeco/public_html/admin4047wicsx/themes/default/template/content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60b0bcfbe0a691_53451141',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52b35d8d4c64b83d4aa2e8a6a93d866d68d1581d' => 
    array (
      0 => '/home/codeoperativeco/public_html/admin4047wicsx/themes/default/template/content.tpl',
      1 => 1619254976,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b0bcfbe0a691_53451141 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="ajax_confirmation" class="alert alert-success hide"></div>
<div id="ajaxBox" style="display:none"></div>

<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div>
<?php }
}
