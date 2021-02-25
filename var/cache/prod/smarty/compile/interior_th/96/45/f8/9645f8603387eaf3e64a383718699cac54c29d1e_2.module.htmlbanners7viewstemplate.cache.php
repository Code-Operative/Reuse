<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:12:50
  from 'module:htmlbanners7viewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60368912638bc1_03101959',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9645f8603387eaf3e64a383718699cac54c29d1e' => 
    array (
      0 => 'module:htmlbanners7viewstemplate',
      1 => 1613650431,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60368912638bc1_03101959 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '23437162760368912631511_65570341';
?>

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

<?php }
}
