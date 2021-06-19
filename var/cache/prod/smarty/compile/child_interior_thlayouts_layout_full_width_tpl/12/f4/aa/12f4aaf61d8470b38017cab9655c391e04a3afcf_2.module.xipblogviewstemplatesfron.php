<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-17 23:05:18
  from 'module:xipblogviewstemplatesfron' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cbc71e258ac9_67827495',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12f4aaf61d8470b38017cab9655c391e04a3afcf' => 
    array (
      0 => 'module:xipblogviewstemplatesfron',
      1 => 1619254988,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60cbc71e258ac9_67827495 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="bottom-custom-nav-content clearfix">
  
  <div class="col-md-4">
    <?php if (isset($_smarty_tpl->tpl_vars['link_post_previeus']->value) && !empty($_smarty_tpl->tpl_vars['link_post_previeus']->value)) {?><a class="button_previeus" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link_post_previeus']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Previeus"),$_smarty_tpl ) );?>
</a><?php }?>
  </div>
  <div class="col-md-4 content_back">
    <a class="button_previeus" href="javascript:history.back(1);"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Back"),$_smarty_tpl ) );?>
</a>
  </div>
  <div class="col-md-4">
    <?php if (isset($_smarty_tpl->tpl_vars['link_post_next']->value) && !empty($_smarty_tpl->tpl_vars['link_post_next']->value)) {?><a class="button_next" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link_post_next']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Next"),$_smarty_tpl ) );?>
</a><?php }?>
  </div>
</div><?php }
}
