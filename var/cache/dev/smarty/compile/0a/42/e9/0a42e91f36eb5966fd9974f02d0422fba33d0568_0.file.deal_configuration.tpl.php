<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 11:14:35
  from '/home/codeoperativeco/public_html/modules/kbmpdealmanager/views/templates/admin/deal_configuration.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608a870b4cb517_64930758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a42e91f36eb5966fd9974f02d0422fba33d0568' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmpdealmanager/views/templates/admin/deal_configuration.tpl',
      1 => 1619254987,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608a870b4cb517_64930758 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="form-group">
    <label class="control-label col-lg-3">
        <span class="label-tooltip" data-toggle="tooltip" data-html="true" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If disable, then seller as well as you will not be able to add new deal for the seller and if you want to disable all the deals which the seller has created previously then please disable the deals manually from the backend','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enable Deal Manager','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>

        </span>
    </label>
    <div class="col-lg-9">
        <span class="switch prestashop-switch fixed-width-lg">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kbmpdealmanager']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
                <input type="radio" name="kbmpdealmanager_enable"<?php if ($_smarty_tpl->tpl_vars['value']->value['value'] == 1) {?> id="kbmpdealmanager_enable_on"<?php } else { ?> id="kbmpdealmanager_enable_off"<?php }?> value="<?php echo intval($_smarty_tpl->tpl_vars['value']->value['value']);?>
" <?php if ($_smarty_tpl->tpl_vars['kbmpdealmanager_enable']->value == $_smarty_tpl->tpl_vars['value']->value['value']) {?> checked="checked"<?php }?>/>
                <label <?php if ($_smarty_tpl->tpl_vars['value']->value['value'] == 1) {?> for="kbmpdealmanager_enable_on"<?php } else { ?> for="kbmpdealmanager_enable_off"<?php }?>><?php if ($_smarty_tpl->tpl_vars['value']->value['value'] == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );
}?></label>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <a class="slide-button btn"></a>
        </span>
    </div>
</div><?php }
}
