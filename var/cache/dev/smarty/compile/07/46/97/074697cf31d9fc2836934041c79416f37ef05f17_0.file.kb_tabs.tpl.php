<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 11:14:35
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/admin/kb_tabs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608a870b4db618_98614410',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '074697cf31d9fc2836934041c79416f37ef05f17' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/admin/kb_tabs.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608a870b4db618_98614410 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="kb_custom_tabs kb_custom_panel">
    <span>
        <a class="kb_custom_tab <?php if ($_smarty_tpl->tpl_vars['selected_nav']->value == 'config') {?>kb_active<?php }?>" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Marketplace General Settings','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" id="kbsl_config_link" href="<?php echo $_smarty_tpl->tpl_vars['mp_setting']->value;?>
">            <i class="icon-gear"></i>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'General Settings','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

        </a>
    </span>

    <span>
        <a class="kb_custom_tab <?php if ($_smarty_tpl->tpl_vars['selected_nav']->value == 'gdpr_config') {?>kb_active<?php }?>" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'GDPR Settings','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" id="kbsl_gdpr_config" href="<?php echo $_smarty_tpl->tpl_vars['gdpr_setting']->value;?>
">            <i class="icon-lock"></i>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'GDPR Settings','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

        </a>
    </span>
</div>
        
<?php }
}
