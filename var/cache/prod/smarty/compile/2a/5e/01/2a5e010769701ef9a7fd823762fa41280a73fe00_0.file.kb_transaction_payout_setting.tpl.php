<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:50:17
  from '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/admin/kb_transaction_payout_setting.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_603691d95efd55_72068568',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a5e010769701ef9a7fd823762fa41280a73fe00' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/admin/kb_transaction_payout_setting.tpl',
      1 => 1613588115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603691d95efd55_72068568 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="alert alert-info">
    <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To complete the process of Paypal payout payment, Click on the \'Process Payout Status\' button to update the status of transaction.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</p>
</div>
    <div class="alert alert-warning">
        <p class="">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cron Instructions','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

        </p>
        <br/>
        <p>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add the cron to your store via control panel/putty to update the status of Paypal Payout transaction. Please find the instructions to setup crons below -','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

        </p>
        <br/>
        <p>
            <b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'URLs to Add to Cron via Control Panel','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</b>
        </p>
        <p> <b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Process Paypal Payout Status','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</b> - <?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['kb_cron_url']->value);?>
</p>
                <p> <b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Automation Paypal Request','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</b> - <?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['kb_auto_cron_paypal_url']->value);?>
</p>
                <p>
            <b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cron setup via SSH','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</b>
        </p>
        <p><b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Process Paypal Payout Status','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</b> - 40 * * * * curl -O /dev/null '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['kb_cron_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
'</p>
                <p> <b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Automation Paypal Request','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</b> - 0 12 * * * curl -O /dev/null '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['kb_auto_cron_paypal_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
'</p>
            </div>


<div class='kb-extra-content'>
    <a class="btn btn-warning pull-right open_new_transaction_form" href="javascript:void(0)" onclick="openkbPayoutSettingForm(this)">
        <i class="icon-collapse" id="icon_add_colapse_new_transaction"></i> <span id="kb-new-trabsaction-btn-label"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['kb_form_heading']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>
    </a>
    <div class='clearfix'></div>    
</div>
<div id="kb_payout_setting_form" style="display:none;">
    <div class="alert alert-info">
        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Currently PayPal is supported for the PayOut. Enter the PayPal API details to Payout. Click here for ','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
<a href="https://www.paypal.com/"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Paypal API details.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a></p>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['kb_payout_setting_form']->value;?>
</div>
<?php echo '<script'; ?>
 type='text/javascript'>
    var kb_admin_trans_new_txt = "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['kb_form_heading']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
";
    var kb_admin_trans_close_txt = "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['kb_admin_trans_close_txt']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
";
    var field_empty = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field cannot be empty','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    var kb_html_tags = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field should not contain HTML tags.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    
<?php echo '</script'; ?>
>
<?php }
}
