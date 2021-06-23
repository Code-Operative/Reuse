<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-28 10:59:45
  from '/home/codeoperativeco/public_html/themes/interior_th/templates/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60b0bf1193d9c4_44146547',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6adc6f77d084d44459f93ee860ce94dc32385d57' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/interior_th/templates/_partials/footer.tpl',
      1 => 1619255004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b0bf1193d9c4_44146547 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div class="container">
  <div class="row">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_169344332260b0bf1193af88_20421152', 'hook_footer_before');
?>

  </div>
</div>
<div class="footer-container">
    <div class="footer-one">
      <div class="container">
        <div class="row">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_160807956160b0bf1193bf37_35100880', 'hook_footer');
?>

        </div>
      </div>
    </div>
    <div class="footer-two">
      <div class="container">
        <div class="row inner-wrapper">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_62562616660b0bf1193cbe6_08884094', 'hook_footer_after');
?>

        </div>
      </div>
    </div>
    </div>
<div class="btn-to-top js-btn-to-top"></div><?php }
/* {block 'hook_footer_before'} */
class Block_169344332260b0bf1193af88_20421152 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_before' => 
  array (
    0 => 'Block_169344332260b0bf1193af88_20421152',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterBefore'),$_smarty_tpl ) );?>

    <?php
}
}
/* {/block 'hook_footer_before'} */
/* {block 'hook_footer'} */
class Block_160807956160b0bf1193bf37_35100880 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer' => 
  array (
    0 => 'Block_160807956160b0bf1193bf37_35100880',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooter'),$_smarty_tpl ) );?>

          <?php
}
}
/* {/block 'hook_footer'} */
/* {block 'hook_footer_after'} */
class Block_62562616660b0bf1193cbe6_08884094 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_after' => 
  array (
    0 => 'Block_62562616660b0bf1193cbe6_08884094',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterAfter'),$_smarty_tpl ) );?>

          <?php
}
}
/* {/block 'hook_footer_after'} */
}
