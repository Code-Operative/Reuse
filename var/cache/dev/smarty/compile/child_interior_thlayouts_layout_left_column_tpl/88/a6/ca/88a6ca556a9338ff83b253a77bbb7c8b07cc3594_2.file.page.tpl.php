<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-15 00:44:00
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604eadd0c7aed9_80626187',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '88a6ca556a9338ff83b253a77bbb7c8b07cc3594' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/templates/page.tpl',
      1 => 1613650431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604eadd0c7aed9_80626187 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2111145442604eadd0c71c95_21211899', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_1813236720604eadd0c73252_07150473 extends Smarty_Internal_Block
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
class Block_287927467604eadd0c72664_03673116 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1813236720604eadd0c73252_07150473', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_1302141879604eadd0c78f22_56304150 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_1846820609604eadd0c794f9_33624112 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_173847637604eadd0c78aa0_48200572 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1302141879604eadd0c78f22_56304150', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1846820609604eadd0c794f9_33624112', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_515315467604eadd0c7a279_18713126 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_863809035604eadd0c79e97_03877280 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_515315467604eadd0c7a279_18713126', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_2111145442604eadd0c71c95_21211899 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_2111145442604eadd0c71c95_21211899',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_287927467604eadd0c72664_03673116',
  ),
  'page_title' => 
  array (
    0 => 'Block_1813236720604eadd0c73252_07150473',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_173847637604eadd0c78aa0_48200572',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_1302141879604eadd0c78f22_56304150',
  ),
  'page_content' => 
  array (
    0 => 'Block_1846820609604eadd0c794f9_33624112',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_863809035604eadd0c79e97_03877280',
  ),
  'page_footer' => 
  array (
    0 => 'Block_515315467604eadd0c7a279_18713126',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_287927467604eadd0c72664_03673116', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_173847637604eadd0c78aa0_48200572', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_863809035604eadd0c79e97_03877280', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
