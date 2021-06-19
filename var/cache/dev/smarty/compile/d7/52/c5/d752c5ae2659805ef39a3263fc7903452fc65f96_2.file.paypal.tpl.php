<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-10 13:58:58
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/payment/paypal.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60992e12dcdea2_36633220',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd752c5ae2659805ef39a3263fc7903452fc65f96' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/payment/paypal.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60992e12dcdea2_36633220 (Smarty_Internal_Template $_smarty_tpl) {
?><ul class="kb-form-list">
    <li class="kb-form-fwidth">
        <div class="kb-form-label-block">
            <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Paypal Id','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
        </div>
        <div class="kb-form-field-block">
            <input type="hidden" name="payment_info[kbpaypal][paypal_id][label]" value="Paypal Id">
            <input data-tab="paymentinfo" type="text" class="kb-inpfield required"  validate="isEmail" name="payment_info[kbpaypal][paypal_id][value]" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['paypal_id']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
        </div>
    </li>
    <li class="kb-form-fwidth">
        <div class="kb-form-label-block">
            <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Additional Information','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
        </div>
        <div class="kb-form-field-block">
            <input type="hidden" name="payment_info[kbpaypal][add_info][label]" value="Additional Information">
            <textarea data-tab="paymentinfo" rows="5" class="kb-inptexarea"  name="payment_info[kbpaypal][add_info][value]" ><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['add_info']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</textarea>
        </div>
    </li>
</ul>
<?php }
}
