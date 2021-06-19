<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-28 21:17:47
  from '/home/codeoperativeco/public_html/themes/interior_th/modules/customtabs/views/templates/hook/tab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6089c2eb230e88_16582283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f6382860b2e9080a9c7d125c61577fa260af5ef5' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/interior_th/modules/customtabs/views/templates/hook/tab.tpl',
      1 => 1619255004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6089c2eb230e88_16582283 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['customtabs']->value['slides']) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customtabs']->value['slides'], 'slide', false, NULL, 'customtabs', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_customtabs']->value['iteration']++;
?>
        <?php $_smarty_tpl->_assignInScope('productsId', explode(",",$_smarty_tpl->tpl_vars['slide']->value['category']));?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productsId']->value, 'selectedId');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['selectedId']->value) {
?>
            <?php if ($_smarty_tpl->tpl_vars['selectedId']->value == $_smarty_tpl->tpl_vars['customtabs']->value['product_id'] || $_smarty_tpl->tpl_vars['slide']->value['category'] == '') {?>
                 <?php if ($_smarty_tpl->tpl_vars['slide']->value['title']) {?>
                   <li class="nav-item" data-current="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customtabs']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
" data-selected="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['category'], ENT_QUOTES, 'UTF-8');?>
">
                       <a class="nav-link" data-toggle="tab" href="#custom_tab_<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_foreach_customtabs']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_customtabs']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
">
                           <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['title'], ENT_QUOTES, 'UTF-8');?>

                       </a>
                   </li>
                 <?php }?>
            <?php }?>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>

<?php }
}
