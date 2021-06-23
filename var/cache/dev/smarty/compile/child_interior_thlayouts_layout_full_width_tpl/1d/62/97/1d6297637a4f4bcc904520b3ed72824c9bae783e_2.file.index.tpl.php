<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-28 10:58:23
  from '/home/codeoperativeco/public_html/themes/interior_th/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60b0bebfb159e1_28764827',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d6297637a4f4bcc904520b3ed72824c9bae783e' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/interior_th/templates/index.tpl',
      1 => 1619255004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b0bebfb159e1_28764827 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_96668913660b0bebfb091f6_19464852', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_162174815660b0bebfb0a629_42191011 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_28585133660b0bebfb0c2e1_35340709 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php $_smarty_tpl->_assignInScope('HOOK_HOME_TAB_CONTENT', Hook::exec('displayHomeTabContent'));?>
        <?php $_smarty_tpl->_assignInScope('HOOK_HOME_TAB', Hook::exec('displayHomeTab'));?>
        <?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value) && trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) {?>
          <div class="js-wrap-products-tabs productstabs-section clearfix">
            <div class="productstabs-section__inner">
              <?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value) && trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)) {?>
              <ul class="js-products-tabs nav nav-tabs">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayHomeTab'),$_smarty_tpl ) );?>

              </ul>
              <?php }?>
              <?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value) && trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) {?>
              <div class="tab-content">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayHomeTabContent'),$_smarty_tpl ) );?>

              </div>
              <?php }?>
            </div>
          </div>
        <?php }?>
        <div class="home-section">
          <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

        </div>
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_96668913660b0bebfb091f6_19464852 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_96668913660b0bebfb091f6_19464852',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_162174815660b0bebfb0a629_42191011',
  ),
  'page_content' => 
  array (
    0 => 'Block_28585133660b0bebfb0c2e1_35340709',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div class="topcolumn-section">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayTopColumn'),$_smarty_tpl ) );?>

      </div>
      <section id="content" class="page-home container">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_162174815660b0bebfb0a629_42191011', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_28585133660b0bebfb0c2e1_35340709', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
