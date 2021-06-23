<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-15 00:36:58
  from 'module:psemailsubscriptionviewst' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604eac2a1121a1_97906152',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '932aead17052e700a2b343acdf3c268b35016a2a' => 
    array (
      0 => 'module:psemailsubscriptionviewst',
      1 => 1613587130,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604eac2a1121a1_97906152 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>
<!-- begin /home/codeoperativeco/prestaoperative/modules/ps_emailsubscription/views/templates/front/subscription_execution.tpl -->

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1672733301604eac2a109843_68479962', "page_content");
?>


<!-- end /home/codeoperativeco/prestaoperative/modules/ps_emailsubscription/views/templates/front/subscription_execution.tpl --><?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block "page_content"} */
class Block_1672733301604eac2a109843_68479962 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_1672733301604eac2a109843_68479962',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Newsletter subscription','d'=>'Modules.Emailsubscription.Shop'),$_smarty_tpl ) );?>
</h1>

  <p class="alert <?php if ($_smarty_tpl->tpl_vars['variables']->value['nw_error']) {?>alert-danger<?php } else { ?>alert-success<?php }?>">
    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variables']->value['msg'], ENT_QUOTES, 'UTF-8');?>

  </p>

  <?php if ($_smarty_tpl->tpl_vars['variables']->value['conditions']) {?>
    <p><?php echo $_smarty_tpl->tpl_vars['variables']->value['conditions'];?>
</p>
  <?php }?>

<?php
}
}
/* {/block "page_content"} */
}
