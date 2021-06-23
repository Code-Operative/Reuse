<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-28 10:59:45
  from '/home/codeoperativeco/public_html/themes/interior_th/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60b0bf11620744_30280258',
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
function content_60b0bf11620744_30280258 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_125436481660b0bf1161a9f4_35375974', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_75024281060b0bf1161bb57_91957778 extends Smarty_Internal_Block
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
class Block_45552021760b0bf1161b273_51679631 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_75024281060b0bf1161bb57_91957778', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_6215827160b0bf1161ea95_66087503 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_22878349360b0bf1161f073_72979323 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_69806494460b0bf1161e645_70032696 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6215827160b0bf1161ea95_66087503', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_22878349360b0bf1161f073_72979323', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_113149588260b0bf1161fcc8_43606076 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_125912851660b0bf1161f908_21691193 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_113149588260b0bf1161fcc8_43606076', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_125436481660b0bf1161a9f4_35375974 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_125436481660b0bf1161a9f4_35375974',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_45552021760b0bf1161b273_51679631',
  ),
  'page_title' => 
  array (
    0 => 'Block_75024281060b0bf1161bb57_91957778',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_69806494460b0bf1161e645_70032696',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_6215827160b0bf1161ea95_66087503',
  ),
  'page_content' => 
  array (
    0 => 'Block_22878349360b0bf1161f073_72979323',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_125912851660b0bf1161f908_21691193',
  ),
  'page_footer' => 
  array (
    0 => 'Block_113149588260b0bf1161fcc8_43606076',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_45552021760b0bf1161b273_51679631', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_69806494460b0bf1161e645_70032696', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_125912851660b0bf1161f908_21691193', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
