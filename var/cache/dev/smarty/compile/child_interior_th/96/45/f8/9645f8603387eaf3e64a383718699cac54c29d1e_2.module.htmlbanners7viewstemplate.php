<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-28 10:59:45
  from 'module:htmlbanners7viewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60b0bf11af9f01_11028852',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9645f8603387eaf3e64a383718699cac54c29d1e' => 
    array (
      0 => 'module:htmlbanners7viewstemplate',
      1 => 1619255004,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b0bf11af9f01_11028852 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin /home/codeoperativeco/public_html/themes/interior_th/modules/htmlbanners7/views/templates/hook/hook.tpl -->
<?php if ($_smarty_tpl->tpl_vars['htmlbanners7']->value['slides']) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['htmlbanners7']->value['slides'], 'slide', false, NULL, 'htmlbanners7', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
?>
      <div class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['customclass'], ENT_QUOTES, 'UTF-8');?>
">
            <?php if ($_smarty_tpl->tpl_vars['slide']->value['description']) {?>
                <?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>

            <?php }?>
      </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>

<!-- end /home/codeoperativeco/public_html/themes/interior_th/modules/htmlbanners7/views/templates/hook/hook.tpl --><?php }
}