<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-02 14:07:33
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/hook/account_form_registration.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608ea4159aec35_12985298',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a04985a053b66668e53ec58147c1d0f75050c19c' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/hook/account_form_registration.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608ea4159aec35_12985298 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['kb_seller_agreement']->value != '') {?>
<div id="kb_seller_agreement_modal" class="modal fade" tabindex="-1" role="dialog" style="display:none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="min-height:auto;">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h1 style="    text-align: left;" class="modal-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Terms & Conditions','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h1>
            </div>
            <div class="modal-body" style="min-height:auto;">
                <?php echo $_smarty_tpl->tpl_vars['kb_seller_agreement']->value;?>
 
            </div>
        </div>
    </div>
</div>
<?php }
}
}
