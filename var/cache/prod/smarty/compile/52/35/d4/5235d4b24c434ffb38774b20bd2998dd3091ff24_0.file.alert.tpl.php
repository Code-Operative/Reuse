<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 16:30:40
  from '/home/codeoperativeco/prestaoperative/modules/paypal/views/templates/admin/_partials/alert.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60367f301f66a1_93165752',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5235d4b24c434ffb38774b20bd2998dd3091ff24' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/modules/paypal/views/templates/admin/_partials/alert.tpl',
      1 => 1614184226,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60367f301f66a1_93165752 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
 <?php if (isset($_smarty_tpl->tpl_vars['widthByContent']->value) && $_smarty_tpl->tpl_vars['widthByContent']->value) {?>d-inline-block<?php }?> <?php if (isset($_smarty_tpl->tpl_vars['class']->value) && $_smarty_tpl->tpl_vars['class']->value) {?> <?php echo $_smarty_tpl->tpl_vars['class']->value;?>
 <?php }?>">
    <?php if (isset($_smarty_tpl->tpl_vars['btnClose']->value) && $_smarty_tpl->tpl_vars['btnClose']->value) {?>
        <button type="button" class="close" data-dismiss="alert">×</button>
    <?php }?>
    <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

</div>
<?php }
}
