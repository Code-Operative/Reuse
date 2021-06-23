<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-22 20:50:21
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/templates/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60d23efd05ce57_24580357',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0ca2cbeab4f2a61f0129e66c8c5eb5384f775a30' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/templates/_partials/footer.tpl',
      1 => 1624304956,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60d23efd05ce57_24580357 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div class="container">
  <div class="row">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_152182445460d23efd05a959_27675231', 'hook_footer_before');
?>

  </div>
</div>
<div class="footer-container">
    <div class="footer-one">
      <div class="container">
        <div class="row">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_32700804460d23efd05b6a7_89813649', 'hook_footer');
?>

        </div>
      </div>
    </div>
    <div class="footer-two">
      <div class="container">
        <div class="row inner-wrapper">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_86749053760d23efd05c3c8_76239151', 'hook_footer_after');
?>

        </div>
      </div>
    </div>
    </div>
<div class="btn-to-top js-btn-to-top"></div><?php }
/* {block 'hook_footer_before'} */
class Block_152182445460d23efd05a959_27675231 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_before' => 
  array (
    0 => 'Block_152182445460d23efd05a959_27675231',
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
class Block_32700804460d23efd05b6a7_89813649 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer' => 
  array (
    0 => 'Block_32700804460d23efd05b6a7_89813649',
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
class Block_86749053760d23efd05c3c8_76239151 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_after' => 
  array (
    0 => 'Block_86749053760d23efd05c3c8_76239151',
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
