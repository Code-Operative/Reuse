<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:59:48
  from '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/hook/account_form_registration.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_603694144a64c6_90086408',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5697cb85a4ea07c25cef6f3eae0d0db422cf2833' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/hook/account_form_registration.tpl',
      1 => 1613588115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603694144a64c6_90086408 (Smarty_Internal_Template $_smarty_tpl) {
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
