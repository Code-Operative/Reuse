<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 16:30:39
  from '/home/codeoperativeco/prestaoperative/modules/paypal/views/templates/admin/_partials/accountSettingsBlock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60367f2feeef23_68359687',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87431464a8434bc4a37745e6e10e6911bb279e88' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/modules/paypal/views/templates/admin/_partials/accountSettingsBlock.tpl',
      1 => 1614184226,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./mbCredentialsForm.tpl' => 2,
    'file:./ecCredentialFields.tpl' => 2,
  ),
),false)) {
function content_60367f2feeef23_68359687 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div>

    <?php if (isset($_smarty_tpl->tpl_vars['method']->value) && $_smarty_tpl->tpl_vars['method']->value == 'PPP' || ($_smarty_tpl->tpl_vars['method']->value == 'EC' && (isset($_smarty_tpl->tpl_vars['country_iso']->value) && in_array($_smarty_tpl->tpl_vars['country_iso']->value,array('IN','JP')) == false))) {?>
        <p class="h3">
            <?php if (isset($_smarty_tpl->tpl_vars['accountConfigured']->value) && $_smarty_tpl->tpl_vars['accountConfigured']->value) {?><i class="icon-check text-success"></i><?php }?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'PayPal Account','mod'=>'paypal'),$_smarty_tpl ) );?>

            <?php if (isset($_smarty_tpl->tpl_vars['accountConfigured']->value) && $_smarty_tpl->tpl_vars['accountConfigured']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'connected','mod'=>'paypal'),$_smarty_tpl ) );
}?>
        </p>
        <?php if (isset($_smarty_tpl->tpl_vars['accountConfigured']->value) == false || $_smarty_tpl->tpl_vars['accountConfigured']->value == false) {?>
          <p>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'In order to activate the module, you must connect your existing PayPal account or create a new one.','mod'=>'paypal'),$_smarty_tpl ) );?>

          </p>
        <?php }?>

    <?php }?>

    <?php if (isset($_smarty_tpl->tpl_vars['accountConfigured']->value) && $_smarty_tpl->tpl_vars['accountConfigured']->value) {?>

        <?php if (isset($_smarty_tpl->tpl_vars['method']->value) && $_smarty_tpl->tpl_vars['method']->value == 'MB') {?>
            <?php $_smarty_tpl->_subTemplateRender('file:./mbCredentialsForm.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['country_iso']->value) && in_array($_smarty_tpl->tpl_vars['country_iso']->value,array('IN','JP'))) {?>
          <div class="modal-body">
            <h4><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'API Credentials','mod'=>'paypal'),$_smarty_tpl ) );?>
</h4>
            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'In order to accept PayPal payments, please fill in your API REST credentials.','mod'=>'paypal'),$_smarty_tpl ) );?>
</p>
            <ul>
              <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Access','mod'=>'paypal'),$_smarty_tpl ) );?>
 <a target="_blank" href="https://developer.paypal.com/developer/applications/"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'https://developer.paypal.com/developer/applications/','mod'=>'paypal'),$_smarty_tpl ) );?>
</a></li>
              <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in or Create a business account','mod'=>'paypal'),$_smarty_tpl ) );?>
</li>
              <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Create a « REST API apps »','mod'=>'paypal'),$_smarty_tpl ) );?>
</li>
              <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click « Show » below « Secret: »','mod'=>'paypal'),$_smarty_tpl ) );?>
</li>
              <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Copy/paste your « Client ID » and « Secret » below for each environment','mod'=>'paypal'),$_smarty_tpl ) );?>
</li>
            </ul>
            <hr/>

            <input type="hidden" name="id_shop" value="<?php if (isset($_smarty_tpl->tpl_vars['idShop']->value)) {
echo $_smarty_tpl->tpl_vars['idShop']->value;
}?>"/>
            <h4><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'API Credentials for','mod'=>'paypal'),$_smarty_tpl ) );?>
 <?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
</h4>
              <?php $_smarty_tpl->_subTemplateRender('file:./ecCredentialFields.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

          </div>
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['method']->value) && $_smarty_tpl->tpl_vars['method']->value == 'PPP' || ($_smarty_tpl->tpl_vars['method']->value == 'EC' && (isset($_smarty_tpl->tpl_vars['country_iso']->value) && in_array($_smarty_tpl->tpl_vars['country_iso']->value,array('IN','JP')) == false))) {?>
            <span class="btn btn-default pp__mt-5" id="logoutAccount">
              <i class="icon-signout"></i>
				      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Logout','mod'=>'paypal'),$_smarty_tpl ) );?>

            </span>
        <?php }?>
    <?php } else { ?>
        <?php if (isset($_smarty_tpl->tpl_vars['method']->value) && $_smarty_tpl->tpl_vars['method']->value == 'MB') {?>
            <?php $_smarty_tpl->_subTemplateRender('file:./mbCredentialsForm.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        <?php } elseif (isset($_smarty_tpl->tpl_vars['country_iso']->value) && in_array($_smarty_tpl->tpl_vars['country_iso']->value,array('IN','JP'))) {?>
          <div class="modal-body">
            <h4><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'API Credentials','mod'=>'paypal'),$_smarty_tpl ) );?>
</h4>
            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'In order to accept PayPal payments, please fill in your API REST credentials.','mod'=>'paypal'),$_smarty_tpl ) );?>
</p>
            <ul>
              <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Access','mod'=>'paypal'),$_smarty_tpl ) );?>
 <a target="_blank" href="https://developer.paypal.com/developer/applications/"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'https://developer.paypal.com/developer/applications/','mod'=>'paypal'),$_smarty_tpl ) );?>
</a></li>
              <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in or Create a business account','mod'=>'paypal'),$_smarty_tpl ) );?>
</li>
              <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Create a « REST API apps »','mod'=>'paypal'),$_smarty_tpl ) );?>
</li>
              <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click « Show » below « Secret: »','mod'=>'paypal'),$_smarty_tpl ) );?>
</li>
              <li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Copy/paste your « Client ID » and « Secret » below for each environment','mod'=>'paypal'),$_smarty_tpl ) );?>
</li>
            </ul>
            <hr/>

            <input type="hidden" name="id_shop" value="<?php if (isset($_smarty_tpl->tpl_vars['idShop']->value)) {
echo $_smarty_tpl->tpl_vars['idShop']->value;
}?>"/>
            <h4><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'API Credentials for','mod'=>'paypal'),$_smarty_tpl ) );?>
 <?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
</h4>
              <?php $_smarty_tpl->_subTemplateRender('file:./ecCredentialFields.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

          </div>
        <?php } elseif (isset($_smarty_tpl->tpl_vars['method']->value) && in_array($_smarty_tpl->tpl_vars['method']->value,array('EC','PPP'))) {?>
          <a href="<?php echo addslashes($_smarty_tpl->tpl_vars['urlOnboarding']->value);?>
"
            target="_blank"
            data-paypal-button
            data-paypal-onboard-complete="onboardCallback"
            class="btn btn-default spinner-button"
          >
            <i class="icon-signin"></i>
            <div class="spinner pp__mr-1"></div>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Connect or create PayPal account','mod'=>'paypal'),$_smarty_tpl ) );?>

          </a>

          <?php echo '<script'; ?>
 src="<?php echo addslashes($_smarty_tpl->tpl_vars['paypalOnboardingLib']->value);?>
"><?php echo '</script'; ?>
>
        <?php }?>

    <?php }?>
</div>

<?php }
}
