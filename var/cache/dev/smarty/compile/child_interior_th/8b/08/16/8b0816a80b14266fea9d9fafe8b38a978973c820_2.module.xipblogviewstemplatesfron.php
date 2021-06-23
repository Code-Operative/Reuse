<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 00:14:02
  from 'module:xipblogviewstemplatesfron' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6089ec3a345ed7_87766310',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b0816a80b14266fea9d9fafe8b38a978973c820' => 
    array (
      0 => 'module:xipblogviewstemplatesfron',
      1 => 1619254988,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6089ec3a345ed7_87766310 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin /home/codeoperativeco/public_html/modules/xipblog/views/templates/front/post-video.tpl --><div class="post_format_items <?php if (isset($_smarty_tpl->tpl_vars['class']->value) && $_smarty_tpl->tpl_vars['class']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['class']->value, ENT_QUOTES, 'UTF-8');
}?>">
	<?php if ((isset($_smarty_tpl->tpl_vars['videos']->value) && !empty($_smarty_tpl->tpl_vars['videos']->value))) {?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['videos']->value, 'videourl');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['videourl']->value) {
?>
			<div class="item post_video">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="<?php if (isset($_smarty_tpl->tpl_vars['videourl']->value) && $_smarty_tpl->tpl_vars['videourl']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['videourl']->value, ENT_QUOTES, 'UTF-8');
}?>" width="<?php if (isset($_smarty_tpl->tpl_vars['width']->value) && $_smarty_tpl->tpl_vars['width']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['width']->value, ENT_QUOTES, 'UTF-8');
}?>" height="<?php if (isset($_smarty_tpl->tpl_vars['height']->value) && $_smarty_tpl->tpl_vars['height']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['height']->value, ENT_QUOTES, 'UTF-8');
}?>" allowfullscreen></iframe>
				</div>
			</div>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }?>
</div><!-- end /home/codeoperativeco/public_html/modules/xipblog/views/templates/front/post-video.tpl --><?php }
}
