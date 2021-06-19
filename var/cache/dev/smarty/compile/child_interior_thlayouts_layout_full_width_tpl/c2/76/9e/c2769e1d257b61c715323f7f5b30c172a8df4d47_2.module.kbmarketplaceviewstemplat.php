<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-10 13:58:58
  from 'module:kbmarketplaceviewstemplat' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60992e1218da05_60455108',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2769e1d257b61c715323f7f5b30c172a8df4d47' => 
    array (
      0 => 'module:kbmarketplaceviewstemplat',
      1 => 1619254986,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60992e1218da05_60455108 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin /home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/layouts/col2_layout.tpl --><?php if ($_smarty_tpl->tpl_vars['HOOK_KBLEFT_COLUMN']->value) {?>
<div id="kblayout-leftcol" class="column col-xs-12 col-sm-3 pad0" style="float:left;">
    <?php echo $_smarty_tpl->tpl_vars['HOOK_KBLEFT_COLUMN']->value;?>
 
</div> 
<?php }
if ($_smarty_tpl->tpl_vars['TEMPLATE']->value) {?>
<div id="kblayout-centercol" class="center_column col-xs-12 col-sm-9 pad0" style="float:left;">
    <div class="kb-block kb-panel centerlftoffest">
        <?php if (isset($_smarty_tpl->tpl_vars['waiting_for_approval']->value)) {?>
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your seller account has been created and waiting for Admin approval.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                </div>
                <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['approval_link']->value)) {?>
            <div class="kbalert kbalert-warning">
                <i class="kb-material-icons">&#xE645;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your seller account has been disapproved by Admin.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
 <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['approval_link']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'to again send request for account approval.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

            </div>
        <?php }?>
        
        <?php if (isset($_smarty_tpl->tpl_vars['account_dissaproved']->value)) {?>
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your seller account has been disapproved by Admin.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                </div>
        <?php }?>
        
        <?php if (isset($_smarty_tpl->tpl_vars['account_disabled']->value)) {?>
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your seller account is inactive.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                </div>
        <?php }?>
        
        <?php if (isset($_smarty_tpl->tpl_vars['no_membership_plan']->value)) {?>
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Your don't have any active membership plan.Kindly purchase the membership plan to continue selling on store.",'mod'=>"kbmarketplace"),$_smarty_tpl ) );?>

                </div>
        <?php }?>
        
        <?php if (isset($_smarty_tpl->tpl_vars['membership_plan_expiry_warning']->value)) {?>
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Your active membership plan will expire on ",'mod'=>"kbmarketplace"),$_smarty_tpl ) );
echo htmlspecialchars($_smarty_tpl->tpl_vars['pending_days']->value, ENT_QUOTES, 'UTF-8');
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>" .Kindly extend or upgrade the membership plan to continue selling on store.",'mod'=>"kbmarketplace"),$_smarty_tpl ) );?>

                </div>
        <?php }?>
        
        <?php if (isset($_smarty_tpl->tpl_vars['membership_plan_rebate']->value)) {?>
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['membership_plan_rebate_msg']->value, ENT_QUOTES, 'UTF-8');?>
                </div>
        <?php }?>
        
        <?php if (isset($_smarty_tpl->tpl_vars['kb_confirmation']->value) && is_array($_smarty_tpl->tpl_vars['kb_confirmation']->value) && count($_smarty_tpl->tpl_vars['kb_confirmation']->value) > 0) {?>
            <div class="kbalert kbalert-success">
                <ul>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_confirmation']->value, 'con');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['con']->value) {
?>
                        <li><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['con']->value, ENT_QUOTES, 'UTF-8');?>
</li>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            </div>
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['kb_warning']->value) && is_array($_smarty_tpl->tpl_vars['kb_warning']->value) && count($_smarty_tpl->tpl_vars['kb_warning']->value) > 0) {?>
            <div class="kbalert kbalert-warning">
                <ul>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_warning']->value, 'war');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['war']->value) {
?>
                        <li><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['war']->value, ENT_QUOTES, 'UTF-8');?>
</li>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            </div>
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['kb_errors']->value) && is_array($_smarty_tpl->tpl_vars['kb_errors']->value) && count($_smarty_tpl->tpl_vars['kb_errors']->value) > 0) {?>
            <div class='pad5'>
                <div class="kbalert kbalert-danger">
                    <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_errors']->value, 'err');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['err']->value) {
?>
                            <li><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['err']->value, ENT_QUOTES, 'UTF-8');?>
</li>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                </div>    
            </div>
        <?php }?>
        <?php echo $_smarty_tpl->tpl_vars['TEMPLATE']->value;?>
 
    </div>
</div>
<?php }
if ($_smarty_tpl->tpl_vars['HOOK_KBRIGHT_COLUMN']->value) {?>
<div id="kblayout-rightcol" class="column col-xs-12 col-sm-3 pad0">
    <?php echo $_smarty_tpl->tpl_vars['HOOK_KBRIGHT_COLUMN']->value;?>
 
</div>
<?php }?>
<!-- end /home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/layouts/col2_layout.tpl --><?php }
}
