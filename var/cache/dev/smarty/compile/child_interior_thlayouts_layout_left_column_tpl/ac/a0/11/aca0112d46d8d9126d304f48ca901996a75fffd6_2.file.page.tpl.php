<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 10:55:45
  from '/home/codeoperativeco/public_html/themes/interior_th/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608a82a18d2535_11271801',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aca0112d46d8d9126d304f48ca901996a75fffd6' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/interior_th/templates/page.tpl',
      1 => 1619255004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608a82a18d2535_11271801 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1288317137608a82a18ca342_64076045', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_1564125089608a82a18cb2c2_79471483 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_695269042608a82a18ca857_06622309 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1564125089608a82a18cb2c2_79471483', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_1568346668608a82a18d0883_36579789 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_162123713608a82a18d0e60_81918951 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_473830856608a82a18d0413_55317013 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1568346668608a82a18d0883_36579789', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_162123713608a82a18d0e60_81918951', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_1220334197608a82a18d1ac1_76610627 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_858717176608a82a18d16f4_16459529 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1220334197608a82a18d1ac1_76610627', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_1288317137608a82a18ca342_64076045 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1288317137608a82a18ca342_64076045',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_695269042608a82a18ca857_06622309',
  ),
  'page_title' => 
  array (
    0 => 'Block_1564125089608a82a18cb2c2_79471483',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_473830856608a82a18d0413_55317013',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_1568346668608a82a18d0883_36579789',
  ),
  'page_content' => 
  array (
    0 => 'Block_162123713608a82a18d0e60_81918951',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_858717176608a82a18d16f4_16459529',
  ),
  'page_footer' => 
  array (
    0 => 'Block_1220334197608a82a18d1ac1_76610627',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_695269042608a82a18ca857_06622309', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_473830856608a82a18d0413_55317013', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_858717176608a82a18d16f4_16459529', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
