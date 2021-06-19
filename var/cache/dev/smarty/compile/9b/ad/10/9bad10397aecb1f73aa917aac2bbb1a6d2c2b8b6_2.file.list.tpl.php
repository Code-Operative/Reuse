<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 20:57:48
  from '/home/codeoperativeco/public_html/modules/kbmpdealmanager/views/templates/front/deals/account/list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608b0fbccea652_48007499',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9bad10397aecb1f73aa917aac2bbb1a6d2c2b8b6' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmpdealmanager/views/templates/front/deals/account/list.tpl',
      1 => 1619254987,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608b0fbccea652_48007499 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="kb-content">
    <div class="kb-content-header">
        <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Catalog And Coupon Deals','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</h1>
        <div class="kb-content-header-btn">
            <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['new_deal_link']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="kbbtn kbbtn-success" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'click to add new deal','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
"><i class="icon-save"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add New Deal','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span></i></a>
            <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cleanup_link']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="kbbtn btn-danger" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'click to remove your all expired deals and offers','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
"><i class="icon-trash"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cleanup','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span></i></a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class='kb-vspacer5'></div>
    <?php if (isset($_smarty_tpl->tpl_vars['kbfilter']->value)) {?>
        <?php echo $_smarty_tpl->tpl_vars['kbfilter']->value;?>
    <?php }?>
    
    <?php if (isset($_smarty_tpl->tpl_vars['kblist']->value)) {?>
        <div class="kb-vspacer5"></div>
        <?php echo $_smarty_tpl->tpl_vars['kblist']->value;?>
    <?php }?>
    
</div>
<?php }
}
