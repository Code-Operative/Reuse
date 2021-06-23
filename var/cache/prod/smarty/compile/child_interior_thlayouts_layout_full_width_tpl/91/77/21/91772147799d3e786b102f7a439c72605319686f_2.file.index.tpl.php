<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-22 20:50:20
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60d23efccab787_13815518',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '91772147799d3e786b102f7a439c72605319686f' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/templates/index.tpl',
      1 => 1624304956,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60d23efccab787_13815518 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_164647751660d23efcca3df9_94875717', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_24651603260d23efcca5427_52941474 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_60647572260d23efcca5e89_86685098 extends Smarty_Internal_Block
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
class Block_164647751660d23efcca3df9_94875717 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_164647751660d23efcca3df9_94875717',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_24651603260d23efcca5427_52941474',
  ),
  'page_content' => 
  array (
    0 => 'Block_60647572260d23efcca5e89_86685098',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div class="topcolumn-section">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayTopColumn'),$_smarty_tpl ) );?>

      </div>
      <section id="content" class="page-home container">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_24651603260d23efcca5427_52941474', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_60647572260d23efcca5e89_86685098', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
