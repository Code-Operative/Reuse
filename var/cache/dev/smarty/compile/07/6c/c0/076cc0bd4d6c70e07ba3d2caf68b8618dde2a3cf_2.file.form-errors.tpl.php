<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-02 14:07:26
  from '/home/codeoperativeco/public_html/themes/interior_th/templates/_partials/form-errors.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608ea40ebbec87_90412372',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '076cc0bd4d6c70e07ba3d2caf68b8618dde2a3cf' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/interior_th/templates/_partials/form-errors.tpl',
      1 => 1619255004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608ea40ebbec87_90412372 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
if (count($_smarty_tpl->tpl_vars['errors']->value)) {?>
  <div class="help-block">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_205496485608ea40ebbd0c7_57398041', 'form_errors');
?>

  </div>
<?php }
}
/* {block 'form_errors'} */
class Block_205496485608ea40ebbd0c7_57398041 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'form_errors' => 
  array (
    0 => 'Block_205496485608ea40ebbd0c7_57398041',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
?>
          <li class="alert alert-danger"><?php echo nl2br($_smarty_tpl->tpl_vars['error']->value);?>
</li>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>
    <?php
}
}
/* {/block 'form_errors'} */
}
