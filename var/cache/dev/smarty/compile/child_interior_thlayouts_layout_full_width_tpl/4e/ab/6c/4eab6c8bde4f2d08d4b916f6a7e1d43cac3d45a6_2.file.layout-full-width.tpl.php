<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-13 17:41:08
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/templates/layouts/layout-full-width.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604cf9340f5688_60964270',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4eab6c8bde4f2d08d4b916f6a7e1d43cac3d45a6' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/templates/layouts/layout-full-width.tpl',
      1 => 1613650431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604cf9340f5688_60964270 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_508194963604cf9340f0879_23677736', 'left_column');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1421691083604cf9340f17f8_71603400', 'right_column');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_622098108604cf9340f23d4_86991908', 'content_wrapper');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'layouts/layout-both-columns.tpl');
}
/* {block 'left_column'} */
class Block_508194963604cf9340f0879_23677736 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'left_column' => 
  array (
    0 => 'Block_508194963604cf9340f0879_23677736',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'left_column'} */
/* {block 'right_column'} */
class Block_1421691083604cf9340f17f8_71603400 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'right_column' => 
  array (
    0 => 'Block_1421691083604cf9340f17f8_71603400',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'right_column'} */
/* {block 'content'} */
class Block_2018156396604cf9340f3b53_58829329 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <p>Hello world! This is HTML5 Boilerplate.</p>
    <?php
}
}
/* {/block 'content'} */
/* {block 'content_wrapper'} */
class Block_622098108604cf9340f23d4_86991908 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content_wrapper' => 
  array (
    0 => 'Block_622098108604cf9340f23d4_86991908',
  ),
  'content' => 
  array (
    0 => 'Block_2018156396604cf9340f3b53_58829329',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <div id="content-wrapper" class="col-12">
  	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayContentWrapperTop"),$_smarty_tpl ) );?>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2018156396604cf9340f3b53_58829329', 'content', $this->tplIndex);
?>

    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayContentWrapperBottom"),$_smarty_tpl ) );?>

  </div>
<?php
}
}
/* {/block 'content_wrapper'} */
}