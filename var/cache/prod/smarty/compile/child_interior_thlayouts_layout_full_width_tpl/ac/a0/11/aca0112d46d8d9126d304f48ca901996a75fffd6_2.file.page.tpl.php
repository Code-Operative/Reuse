<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-18 11:34:52
  from '/home/codeoperativeco/public_html/themes/interior_th/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cc76cc645433_46490231',
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
function content_60cc76cc645433_46490231 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_89517773460cc76cc63bd68_29070320', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_100638940460cc76cc63cd87_97688325 extends Smarty_Internal_Block
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
class Block_188379961960cc76cc63c4b2_56224158 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_100638940460cc76cc63cd87_97688325', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_10461987060cc76cc643578_96161088 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_213529530760cc76cc643b45_25959722 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_166223671460cc76cc6430e6_99172125 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10461987060cc76cc643578_96161088', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_213529530760cc76cc643b45_25959722', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_140482363460cc76cc6449e6_59328588 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_10428277860cc76cc644608_99921847 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_140482363460cc76cc6449e6_59328588', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_89517773460cc76cc63bd68_29070320 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_89517773460cc76cc63bd68_29070320',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_188379961960cc76cc63c4b2_56224158',
  ),
  'page_title' => 
  array (
    0 => 'Block_100638940460cc76cc63cd87_97688325',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_166223671460cc76cc6430e6_99172125',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_10461987060cc76cc643578_96161088',
  ),
  'page_content' => 
  array (
    0 => 'Block_213529530760cc76cc643b45_25959722',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_10428277860cc76cc644608_99921847',
  ),
  'page_footer' => 
  array (
    0 => 'Block_140482363460cc76cc6449e6_59328588',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_188379961960cc76cc63c4b2_56224158', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_166223671460cc76cc6430e6_99172125', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10428277860cc76cc644608_99921847', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
