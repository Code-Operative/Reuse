<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-10 13:58:58
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/profile_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60992e12017e06_79760016',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f5321ad684e868df5ffddcd3d49d841dd4ee1a9' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/profile_form.tpl',
      1 => 1620651794,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60992e12017e06_79760016 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript" src='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tiny_mce_js_file']->value, ENT_QUOTES, 'UTF-8');?>
' ><?php echo '</script'; ?>
><div id="sellerprofile-panel" class="kb-content">
    <div id="kb-seller-form-msg"></div>
    <div class="kbalert kbalert-info">
        <i class="kb-material-icons">info_outline</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Fields marked with (*) are mandatory fields.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

    </div>
        <div class="kbbtn-group kb-tright">
    <select id='kb_lang_slector_profile' class="btn-sm btn-info" style='margin-top: -5%;'>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>  
                    <option <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?> selected <?php }?> value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['language']->value['id_lang'], ENT_QUOTES, 'UTF-8');?>
'><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['language']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
                </div>
        <ul class="kb-tabs">
                <li class="active" rel="general" id="kb-sprofile-general"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'General','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</li>
                <li rel="metadata" id="kb-sprofile-metadata"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Meta Information','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</li>
                <li rel="policydata" id="kb-sprofile-policydata"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Policy','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</li>
                <li rel="paymentinfo" id="kb-sprofile-paymentinfo"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payout','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</li>                
        </ul>
        <div class="clearfix"></div>
        <div class="kb_tab_container">
            <form action="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['kb_current_request']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" id="sellerProfileForm" method="post" class="" enctype="multipart/form-data">
                <input type="hidden" name="updateSellerProfile" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller_form_key']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="kb_id_seller" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['kb_id_seller']->value), ENT_QUOTES, 'UTF-8');?>
" />
                <div id="general" class="kb_tab_content">
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shop Title','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>
                                    <input data-tab="general" <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>style="display:block;"<?php } else { ?>style="display:none;"<?php }?>type="text" class="kb-inpfield <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>required<?php }?>" validate="isGenericName" name="seller_title_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller_title_'.(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']))]->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" onkeyup="updateSellerLinkRewrite(this, <?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
)"/>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                    </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Phone Number','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input data-tab="general" type="text" class="kb-inpfield required" validate="isPhoneNumber" name="seller_phone_number" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['phone_number'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="15" />
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Business Email','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input data-tab="general" type="text"  id="kb_business_email" class="kb-inpfield" validate="isEmail" name="seller_business_email" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['business_email'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Get Notification','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select data-tab="general" name="seller_notification_type" id="kb_seller_notification_type" class="kb-inpselect">
                                        <option value="0" <?php if ($_smarty_tpl->tpl_vars['seller']->value['notification_type'] == 0) {?>selected="selected"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'On Both','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                                        <option value="1" <?php if ($_smarty_tpl->tpl_vars['seller']->value['notification_type'] == 1) {?>selected="selected"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Primary Email','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                                        <option value="2" <?php if ($_smarty_tpl->tpl_vars['seller']->value['notification_type'] == 2) {?>selected="selected"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Business Email','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <textarea data-tab="general" name="seller_address" rows="5" class="kb-inptexarea required"  validate="isAddress" ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['address'], ENT_QUOTES, 'UTF-8');?>
</textarea>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Country','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select data-tab="general" name="seller_country" class="kb-inpselect required" validate="isInt">
                                        <option value=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select Country','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['countries']->value, 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
                                            <option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['key']->value), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['key']->value == $_smarty_tpl->tpl_vars['seller_country']->value) {?> selected="selected"<?php }?> ><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['val']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'State/City','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input id="seller_state" data-tab="general" type="text" class="kb-inpfield required" validate="isGenericName" name="seller_state" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['state'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                </div>
                            </li>
                            <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_available_field']->value, 'kbfield');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['kbfield']->value) {
?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'text') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 1)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <input data-tab="general" type="<?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] == 'isEmail') {?>email<?php } else { ?>text<?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                                   name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>"
                                                   class="kb-inpfield <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>/>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>  
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'select') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 1)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <select data-tab="general" name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?>[]<?php }?>' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' 
                                                    class="kb-inpselect <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?> multiselect <?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?> multiple="multiple"<?php }?> >
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
"
                                                                <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                        <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                            <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                selected
                                                            <?php }?>
                                                        <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                            selected
                                                        <?php }?>
                                                    <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                        <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                selected
                                                                            <?php }?>
                                                                        <?php }?>
                                                                    <?php }?>
                                                                <?php }?>
                                                                ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>

                                                        </option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                <?php }?>
                                            </select>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'radio') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 1)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                            <input data-tab="general" type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
" 
                                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                               <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                   <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                       checked
                                                                   <?php }?>
                                                               <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                   checked
                                                               <?php }?>
                                                           <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                       <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                           <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                   checked
                                                                               <?php }?>
                                                                           <?php }?>
                                                                       <?php }?>
                                                                   <?php }?>  />
                                                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>

                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'checkbox') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 1)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                            <input data-tab="general" type="checkbox" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
[]" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
" 
                                                                 <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                           <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                               <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                   checked
                                                               <?php }?>
                                                           <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                               checked
                                                           <?php }?>
                                                       <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                       <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                           <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                   checked="checked"
                                                                               <?php }?>
                                                                           <?php }?>
                                                                       <?php }?>
                                                                   <?php }?>  />
                                                            <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>
</label>
                                                            
                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>    
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'textarea') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 1)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                                    <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                        <textarea  data-tab="general" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                            name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' rows="5" class="kb-inptexarea <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }
if ($_smarty_tpl->tpl_vars['kbfield']->value['show_text_editor']) {?> autoload_rte<?php }?>"
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] != '') && ($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] > 0)) {?> maxlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['max_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['min_length'] != '') {?>minlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['min_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                            ><?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?></textarea>                                             <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'date') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 1)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kb-labeled-inpfield">
                                                <span class="inplbl"><i class="kb-material-icons">date_range</i></span>
                                                <input data-tab="general" type="text" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                               name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>" id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' class="kb-inpfield datepicker <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>"
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>"/>
                                                
                                            </div>
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'file') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 1)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                                    <li class="kb-form-fwidth">
                                        <div class="kb-form-label-block" style='margin-bottom:2%;'>
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?> 
                                                    <a style="font-size: 13px;    padding: 4px;float:right;" class="btn btn-warning" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kb_front_controller']->value, ENT_QUOTES, 'UTF-8');?>
?downloadFile=true&id_field=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['id_field'], ENT_QUOTES, 'UTF-8');?>
&id_seller=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_seller']->value, ENT_QUOTES, 'UTF-8');?>
" ><i class="material-icons">&#xe2c4;</i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download File','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
                                                <?php }?>
                                            <?php }?>
                                        </div>
                                        <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value']) && $_smarty_tpl->tpl_vars['kbfield']->value['editable'] == 0 && is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?>
                                        <?php } else { ?>
                                        <div class="kb-form-field-block">
                                            
                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?>
                                                    <input data-tab="general" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control"/>
                                                <?php } else { ?>
                                                    <input data-tab="general" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control  <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>"/>
                                                <?php }?>    
                                            <?php } else { ?>
                                                <input data-tab="general" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control  <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>"/>
                                            <?php }?>
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                               
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['file_extension'] != '') {?> 
                                                   <div class="kbalert kbalert-warning pack-empty-warning" style="display: block; margin-top:10px;">
                                                        <i class="kb-material-icons" style="font-size:12px;margin-right:5px;">&#xe250;</i> 
                                                        <strong>
                                                            <span class="form-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'File must be ','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
<span class="file_extension"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['file_extension'], ENT_QUOTES, 'UTF-8');?>
</span></span>
                                                        </strong> 

                                                    </div>
                                               <?php }?>
                                        </div>
                                        <?php }?>
                                    </li>
                                <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        <?php if (isset($_smarty_tpl->tpl_vars['is_return_address_enable']->value) && $_smarty_tpl->tpl_vars['is_return_address_enable']->value == 1) {?>
                                <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                        <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Return Address','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                    </div>
                                    <div class="kb-form-field-block">
                                        <textarea data-tab="general" name="return_address" rows="5" class="kb-inptexarea autoload_rte required"><?php echo $_smarty_tpl->tpl_vars['seller']->value['return_address'];?>
</textarea> 
                                    </div>
                                </li>
                            <?php }?>
                                                        <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Description','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>
                                    <textarea data-tab="general" <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>style="display:block;"<?php } else { ?>style="display:none;"<?php }?> name="seller_description_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
" rows="5" class="kb-inptexarea autoload_rte"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller_description_'.(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']))]->value, ENT_QUOTES, 'UTF-8');?>
</textarea>                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                    </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Profile Url Alias','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                                                             <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>
                                    <input data-tab="general" <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>style="display:block;"<?php } else { ?>style="display:none;"<?php }?>  type="text" class="kb-inpfield" validate="isLinkRewrite" name="seller_profile_url_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller_friedly_url_'.(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']))]->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" autocomplete="off" onkeyup="$('#kb_url_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
').find('#friendly-url-demo').html(str2url($(this).val()));"/>
                                     <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                    </div>
                                <div class="kbalert kbalert-warning pack-empty-warning" style="display: block; margin-top:10px;">
                                    <i class="kb-material-icons" style="font-size:12px;margin-right:5px;">&#xe250;</i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The profile link will look like this:','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
<br/>
                                    <strong>
                                                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>
                                        <div id="kb_url_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>style="display:block;"<?php } else { ?>style="display:none;"<?php }?>>    
                                            <?php echo $_smarty_tpl->tpl_vars['seller_profile_url_'.(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']))]->value;?>
                                        </div>    
                                         <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                        <strong> 
                                </div>
                                <?php echo '<script'; ?>
 type="text/javascript">
                                    //changes by vishal
                                    
                                    function updateSellerLinkRewrite(e,id_lang) {
                                var value = $(e).val();
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>
                                        if (id_lang == <?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
) {
                                            $('input[name="seller_profile_url_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
"]').val(str2url(value));
                                            $('input[name="seller_profile_url_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
"]').trigger('keyup');
                                        }
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    }
                                    //changes end
                                <?php echo '</script'; ?>
>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Facebook Link','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input data-tab="general" type="text" class="kb-inpfield" validate="isUrl" name="seller_fb_link"  id='seller_fb_link' value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['fb_link'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Google Plus Link','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input data-tab="general" type="text" class="kb-inpfield" validate="isUrl" name="seller_gplus_link" id='seller_gplus_link' value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['gplus_link'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Twitter Link','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <input data-tab="general" type="text" class="kb-inpfield" validate="isUrl" name="seller_twit_link" id='seller_twit_link' value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['twit_link'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                </div>
                            </li>
                            <li class="kb-form-fwidth" id="id_logo_wrapper">
                                <div class="form-lbl-indis">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Logo','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                    <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Logo size should be (%s).','mod'=>'kbmarketplace'),$_smarty_tpl ) );
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('temp_str', $_prefixVariable1);?>
                                    <p class="form-inp-help"><?php echo htmlspecialchars(sprintf($_smarty_tpl->tpl_vars['temp_str']->value,'150 X 150'), ENT_QUOTES, 'UTF-8');?>
</p>
                                </div>
                                <div class="form-field-indis">
                                    <div class="form-img-display">
                                        <img id="seller_logo_placeholder" class="form-logo-display" src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['logo'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
?<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['time']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Logo of your shop','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
">
                                    </div>
                                    <input id="seller_logo" class="kb_upload_field kb_seller_logo_file" type="file" name="seller_logo" style="display:none;" />
                                    <div class="kb-block file-uploader">
                                        <a id="seller_upload_image" href="javascript:void(0)" onclick="uploadImage('seller_logo')" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Browse','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
                                        <a id="seller_remove_image" href="javascript:void(0)" onclick="removeSellerImage('seller_logo', '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller_default_logo']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
')" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
                                        <input id="seller_logo_update" type="hidden" name="seller_logo_update" value="0" />
                                    </div>
                                    <div id="seller_logo_error" class="kb-validation-error"></div>
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shop Banner','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="form-img-display">
                                        <img id="seller_banner_placeholder" class="form-banner-display" src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['banner'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
?<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['time']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Banner of your shop','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
">
                                    </div>
                                    <input id="seller_banner" class="kb_upload_field kb_seller_banner_file" type="file" name="seller_banner" style="display:none;" />
                                    <div class="kb-block file-uploader">
                                        <a href="javascript:void(0)" onclick="uploadImage('seller_banner')" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Browse','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
                                        <a id="kb_banner_remove" href="javascript:void(0)" onclick="removeSellerImage('seller_banner', '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller_default_banner']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
')" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
                                        <input id="seller_banner_update" type="hidden" name="seller_banner_update" value="0" />
                                    </div>
                                    <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Banner size should be (%s).','mod'=>'kbmarketplace'),$_smarty_tpl ) );
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->_assignInScope('temp_str_banner', $_prefixVariable2);?>
                                    <p class="form-inp-help"><?php echo htmlspecialchars(sprintf($_smarty_tpl->tpl_vars['temp_str_banner']->value,'900 X 250'), ENT_QUOTES, 'UTF-8');?>
</p>
                                    <div id="seller_banner_error" class="kb-validation-error"></div>
                                </div>
                            </li>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbMarketPlaceSellerForm",'block'=>'general'),$_smarty_tpl ) );?>

                        </ul>
                    </div>
                    <div class="kb-block" style="padding:5px 15px 5px 5px; text-align: right;">
                        <div id="sellerprofile-updating-progress" class="input-loader" style="display:none;vertical-align: middle;"></div>
                        <button id="sellerprofile-update-btn" type="button" class="kbbtn-big kbbtn-success" onclick="SellerProfileFormNextMeta()"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Next','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</button>
                    </div>
                </div>
                <div id="metadata" class="kb_tab_content">
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Meta Keywords','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                                                             <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>
                                    <input data-tab="metadata" <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>style="display:block;"<?php } else { ?>style="display:none;"<?php }?> type="text" class="kb-inpfield <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>required<?php }?>" validate="isGenericName" name="seller_meta_keywords_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller_meta_keywords_'.(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']))]->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                     <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                    </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Meta Description','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                                                             <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>
                                    <textarea data-tab="metadata" <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>style="display:block;"<?php } else { ?>style="display:none;"<?php }?> name="seller_meta_description_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
" rows="5" class="kb-inptexarea"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller_meta_description_'.(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']))]->value, ENT_QUOTES, 'UTF-8');?>
</textarea>
                                     <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                    </div>
                            </li>
                            <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_available_field']->value, 'kbfield');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['kbfield']->value) {
?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'text') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 2)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <input data-tab="metadata" type="<?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] == 'isEmail') {?>email<?php } else { ?>text<?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                                   name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>"
                                                   class="kb-inpfield <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>/>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>  
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'select') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 2)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <select data-tab="metadata" name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?>[]<?php }?>' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' 
                                                    class="kb-inpselect <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?> multiselect <?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?> multiple="multiple"<?php }?> >
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
"
                                                                <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                        <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                            <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                selected
                                                            <?php }?>
                                                        <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                            selected
                                                        <?php }?>
                                                    <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                        <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                selected
                                                                            <?php }?>
                                                                        <?php }?>
                                                                    <?php }?>
                                                                <?php }?>
                                                                ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>

                                                        </option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                <?php }?>
                                            </select>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'radio') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 2)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                            <input data-tab="metadata" type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
" 
                                                                 <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                               <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                   <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                       checked
                                                                   <?php }?>
                                                               <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                   checked
                                                               <?php }?>
                                                           <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                       <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                           <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                   checked
                                                                               <?php }?>
                                                                           <?php }?>
                                                                       <?php }?>
                                                                   <?php }?>  />
                                                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>

                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'checkbox') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 2)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                            <input data-tab="metadata" type="checkbox" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
" 
                                                                 <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                           <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                               <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                   checked
                                                               <?php }?>
                                                           <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                               checked
                                                           <?php }?>
                                                       <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                       <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                           <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                   checked="checked"
                                                                               <?php }?>
                                                                           <?php }?>
                                                                       <?php }?>
                                                                   <?php }?>  />
                                                            <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>
</label>
                                                            
                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>    
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'textarea') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 2)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                                    <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                        <textarea  data-tab="metadata" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                            name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' rows="5" class="kb-inptexarea <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }
if ($_smarty_tpl->tpl_vars['kbfield']->value['show_text_editor']) {?> autoload_rte<?php }?>"
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] != '') && ($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] > 0)) {?> maxlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['max_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['min_length'] != '') {?>minlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['min_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                            ><?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?></textarea>                                             <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'date') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 2)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kb-labeled-inpfield">
                                                <span class="inplbl"><i class="kb-material-icons">date_range</i></span>
                                                <input data-tab="metadata" type="text" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                               name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' class="kb-inpfield datepicker <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>"
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>"/>
                                                
                                            </div>
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'file') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 2)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                                    <li class="kb-form-fwidth">
                                        <div class="kb-form-label-block" style='margin-bottom:2%;'>
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?> 
                                                    <a style="font-size: 13px;    padding: 4px;float:right;" class="btn btn-warning" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kb_front_controller']->value, ENT_QUOTES, 'UTF-8');?>
?downloadFile=true&id_field=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['id_field'], ENT_QUOTES, 'UTF-8');?>
&id_seller=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_seller']->value, ENT_QUOTES, 'UTF-8');?>
" ><i class="material-icons">&#xe2c4;</i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download File','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
                                                <?php }?>
                                            <?php }?>
                                        </div>
                                        <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value']) && $_smarty_tpl->tpl_vars['kbfield']->value['editable'] == 0 && is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?>
                                        <?php } else { ?>
                                        <div class="kb-form-field-block">
                                            
                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?>
                                                    <input data-tab="metadata" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control"/>
                                                <?php } else { ?>
                                                    <input data-tab="metadata" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control  <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>"/>
                                                <?php }?>    
                                            <?php } else { ?>
                                                <input data-tab="metadata" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control  <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>"/>
                                            <?php }?>
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                               
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['file_extension'] != '') {?> 
                                                   <div class="kbalert kbalert-warning pack-empty-warning" style="display: block; margin-top:10px;">
                                                        <i class="kb-material-icons" style="font-size:12px;margin-right:5px;">&#xe250;</i> 
                                                        <strong>
                                                            <span class="form-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'File must be ','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
<span class="file_extension"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['file_extension'], ENT_QUOTES, 'UTF-8');?>
</span></span>
                                                        </strong> 

                                                    </div>
                                               <?php }?>
                                        </div>
                                        <?php }?>
                                    </li>
                                <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbMarketPlaceSellerForm",'block'=>'meta'),$_smarty_tpl ) );?>

                        </ul>
                    </div>
                    <div class="kb-block" style="padding:5px 15px 5px 5px; text-align: right;">
                        <div id="sellerprofile-updating-progress" class="input-loader" style="display:none;vertical-align: middle;"></div>
                        <button id="sellerprofile-update-btn" type="button" class="kbbtn-big kbbtn-success" onclick="SellerProfileFormNextPolicy()"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Next','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</button>
                    </div>
                </div>
                <div id="policydata" class="kb_tab_content">
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy Policy','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                                                             <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>
                                    <textarea data-tab="policydata" <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>style="display:block;"<?php } else { ?>style="display:none;"<?php }?> name="seller_privacy_policy_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
" rows="5" class="kb-inptexarea autoload_rte <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>required<?php }?>"><?php echo $_smarty_tpl->tpl_vars['seller_privacy_policy_'.(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']))]->value;?>
</textarea>                                     <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                    </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Return Policy','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                                                             <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>
                                    <textarea data-tab="policydata" <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>style="display:block;"<?php } else { ?>style="display:none;"<?php }?> name="seller_return_policy_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
" rows="5" class="kb-inptexarea autoload_rte <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>required<?php }?>"><?php echo $_smarty_tpl->tpl_vars['seller_return_policy_'.(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']))]->value;?>
</textarea>                                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shipping Policy','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                                                             <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
?>
                                    <textarea data-tab="policydata" <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>style="display:block;"<?php } else { ?>style="display:none;"<?php }?> name="seller_shipping_policy_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8');?>
" rows="5" class="kb-inptexarea autoload_rte <?php if ($_smarty_tpl->tpl_vars['default_lang']->value == $_smarty_tpl->tpl_vars['language']->value['id_lang']) {?>required<?php }?>"><?php echo $_smarty_tpl->tpl_vars['seller_shipping_policy_'.(intval($_smarty_tpl->tpl_vars['language']->value['id_lang']))]->value;?>
</textarea>                                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    
                                </div>
                            </li>
                            <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_available_field']->value, 'kbfield');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['kbfield']->value) {
?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'text') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 3)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <input data-tab="policydata" type="<?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] == 'isEmail') {?>email<?php } else { ?>text<?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                                   name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>" 
                                                   class="kb-inpfield <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>/>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>  
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'select') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 3)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <select data-tab="policydata" name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?>[]<?php }?>' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' 
                                                    class="kb-inpselect <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?> multiselect <?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?> multiple="multiple"<?php }?> >
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
"
                                                                <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                        <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                            <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                selected
                                                            <?php }?>
                                                        <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                            selected
                                                        <?php }?>
                                                    <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                        <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                selected
                                                                            <?php }?>
                                                                        <?php }?>
                                                                    <?php }?>
                                                                <?php }?>
                                                                ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>

                                                        </option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                <?php }?>
                                            </select>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'radio') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 3)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                            <input data-tab="policydata" type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
" 
                                                                 <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                               <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                   <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                       checked
                                                                   <?php }?>
                                                               <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                   checked
                                                               <?php }?>
                                                           <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                       <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                           <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                   checked
                                                                               <?php }?>
                                                                           <?php }?>
                                                                       <?php }?>
                                                                   <?php }?>  />
                                                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>

                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'checkbox') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 3)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                            <input data-tab="policydata" type="checkbox" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
" 
                                                                 <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                           <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                               <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                   checked
                                                               <?php }?>
                                                           <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                               checked
                                                           <?php }?>
                                                       <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                       <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                           <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                   checked="checked"
                                                                               <?php }?>
                                                                           <?php }?>
                                                                       <?php }?>
                                                                   <?php }?>  />
                                                            <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>
</label>
                                                            
                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>    
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'textarea') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 3)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                                    <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                        <textarea  data-tab="policydata" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                            name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' rows="5" class="kb-inptexarea <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }
if ($_smarty_tpl->tpl_vars['kbfield']->value['show_text_editor']) {?> autoload_rte<?php }?>"
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] != '') && ($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] > 0)) {?> maxlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['max_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['min_length'] != '') {?>minlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['min_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                            ><?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?></textarea>                                             <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'date') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 3)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kb-labeled-inpfield">
                                                <span class="inplbl"><i class="kb-material-icons">date_range</i></span>
                                                <input data-tab="policydata" type="text" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                               name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' class="kb-inpfield datepicker <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>"
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>"/>
                                                
                                            </div>
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'file') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 3)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                                    <li class="kb-form-fwidth">
                                        <div class="kb-form-label-block" style='margin-bottom:2%;'>
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?> 
                                                    <a style="font-size: 13px;    padding: 4px;float:right;" class="btn btn-warning" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kb_front_controller']->value, ENT_QUOTES, 'UTF-8');?>
?downloadFile=true&id_field=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['id_field'], ENT_QUOTES, 'UTF-8');?>
&id_seller=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_seller']->value, ENT_QUOTES, 'UTF-8');?>
" ><i class="material-icons">&#xe2c4;</i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download File','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
                                                <?php }?>
                                            <?php }?>
                                        </div>
                                        <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value']) && $_smarty_tpl->tpl_vars['kbfield']->value['editable'] == 0 && is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?>
                                        <?php } else { ?>
                                        <div class="kb-form-field-block">
                                            
                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?>
                                                    <input data-tab="policydata" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control"/>
                                                <?php } else { ?>
                                                    <input data-tab="policydata" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control  <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>"/>
                                                <?php }?>    
                                            <?php } else { ?>
                                                <input data-tab="policydata" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control  <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>"/>
                                            <?php }?>
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                               
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['file_extension'] != '') {?> 
                                                   <div class="kbalert kbalert-warning pack-empty-warning" style="display: block; margin-top:10px;">
                                                        <i class="kb-material-icons" style="font-size:12px;margin-right:5px;">&#xe250;</i> 
                                                        <strong>
                                                            <span class="form-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'File must be ','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
<span class="file_extension"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['file_extension'], ENT_QUOTES, 'UTF-8');?>
</span></span>
                                                        </strong> 

                                                    </div>
                                               <?php }?>
                                        </div>
                                        <?php }?>
                                    </li>
                                <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbMarketPlaceSellerForm",'block'=>'policy'),$_smarty_tpl ) );?>

                        </ul>
                    </div>
                    <div class="kb-block" style="padding:5px 15px 5px 5px; text-align: right;">
                        <div id="sellerprofile-updating-progress" class="input-loader" style="display:none;vertical-align: middle;"></div>
                        <button id="sellerprofile-update-btn" type="button" class="kbbtn-big kbbtn-success" onclick="SellerProfileFormNextInfo()"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Next','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</button>
                    </div>
                </div>
                <div id="paymentinfo" class="kb_tab_content">
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <?php if (count($_smarty_tpl->tpl_vars['available_payment_file']->value) > 0) {?>
                                <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                        <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select Payment Method','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span><em>*</em>
                                    </div>
                                    <div class="kb-form-field-block">
                                        <select name="seller_payment_option" class="kb-inpselect required" id="kb-payment-select">
                                            <option value=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select Method','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
...</option>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['available_payment_file']->value, 'display_name', false, 'payment_name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['payment_name']->value => $_smarty_tpl->tpl_vars['display_name']->value) {
?>
                                                <option value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['payment_name']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" <?php if (isset($_smarty_tpl->tpl_vars['payment_info']->value['name']) && $_smarty_tpl->tpl_vars['payment_info']->value['name'] == $_smarty_tpl->tpl_vars['payment_name']->value) {?>selected="selected"<?php }?>><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['display_name']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </select>
                                        
                                            <p class="form-inp-help" id="paymentinfo-notice"><span id="paymentinfo-note"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Note','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
:</span>
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Admin will use the Payout information to make the payment.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Only one payment information can be saved at a time.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</p>
                                    </div>
                                </li>
                            <?php }?>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbMarketPlaceSellerForm",'block'=>'payment'),$_smarty_tpl ) );?>

                        </ul>
                        <div id="payment-data">
                            
                        </div>
                        <ul class="kb-form-list">
                            <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_available_field']->value, 'kbfield');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['kbfield']->value) {
?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'text') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 4)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <input data-tab="paymentinfo" type="<?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] == 'isEmail') {?>email<?php } else { ?>text<?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                                   name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>"
                                                   class="kb-inpfield <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>/>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>  
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'select') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 4)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <select data-tab="paymentinfo" name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?>[]<?php }?>' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' 
                                                    class="kb-inpselect <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?> multiselect <?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?> multiple="multiple"<?php }?> >
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
"
                                                                <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                        <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                            <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                selected
                                                            <?php }?>
                                                        <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                            selected
                                                        <?php }?>
                                                    <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                        <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                selected
                                                                            <?php }?>
                                                                        <?php }?>
                                                                    <?php }?>
                                                                <?php }?>
                                                                ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>

                                                        </option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                <?php }?>
                                            </select>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'radio') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 4)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                            <input data-tab="paymentinfo" type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
" 
                                                                 <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                                        <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                            <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                                checked
                                                                            <?php }?>
                                                                        <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                            checked
                                                                        <?php }?>
                                                                    <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                       <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                           <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                   checked
                                                                               <?php }?>
                                                                           <?php }?>
                                                                       <?php }?>
                                                                   <?php }?>  />
                                                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>

                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'checkbox') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 4)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kboption-inline kb-inpoption">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                            <input data-tab="paymentinfo" type="checkbox" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
" 
                                                                 <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                           <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                               <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                   checked
                                                               <?php }?>
                                                           <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )) == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                               checked
                                                           <?php }?>
                                                       <?php } elseif (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                                       <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                                           <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                                                   checked="checked"
                                                                               <?php }?>
                                                                           <?php }?>
                                                                       <?php }?>
                                                                   <?php }?>  />
                                                            <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>
</label>
                                                            
                                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    <?php }?>
                                                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>    
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'textarea') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 4)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                                    <li class="kb-form-fwidth">
                                    <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                        <textarea  data-tab="paymentinfo" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                            name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' rows="5" class="kb-inptexarea <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }
if ($_smarty_tpl->tpl_vars['kbfield']->value['show_text_editor']) {?> autoload_rte<?php }?>"
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] != '') && ($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] > 0)) {?> maxlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['max_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['min_length'] != '') {?>minlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['min_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                            ><?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?></textarea>                                             <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'date') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 4)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>class="kb-form-l"<?php } else { ?>class="kb-form-r"<?php }?>>
                                        <div class="kb-form-label-block">
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                        </div>
                                        <div class="kb-form-field-block">
                                            <div class="kb-labeled-inpfield">
                                                <span class="inplbl"><i class="kb-material-icons">date_range</i></span>
                                                <input data-tab="paymentinfo" type="text" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                               name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' class="kb-inpfield datepicker <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>"
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>"/>
                                                
                                            </div>
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                        </div>
                                    </li>
                                <?php }?>
                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'file') && ($_smarty_tpl->tpl_vars['kbfield']->value['id_section'] == 4)) {?>
                                    <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                                    <li class="kb-form-fwidth">
                                        <div class="kb-form-label-block" style='margin-bottom:2%;'>
                                            <span class="kblabel ">
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?>
                                                    <i class="kb-material-icons" data-toggle="tooltip" data-placement="top" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
">info_outline</i>
                                                <?php }?>
                                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>

                                            </span>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>
                                            <em>*</em>
                                            <?php }?>
                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?> 
                                                    <a style="font-size: 13px;    padding: 4px;float:right;" class="btn btn-warning" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kb_front_controller']->value, ENT_QUOTES, 'UTF-8');?>
?downloadFile=true&id_field=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['id_field'], ENT_QUOTES, 'UTF-8');?>
&id_seller=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_seller']->value, ENT_QUOTES, 'UTF-8');?>
" ><i class="material-icons">&#xe2c4;</i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download File','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
                                                <?php }?>
                                            <?php }?>
                                        </div>
                                        <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value']) && $_smarty_tpl->tpl_vars['kbfield']->value['editable'] == 0 && is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?>
                                        <?php } else { ?>
                                        <div class="kb-form-field-block">
                                            
                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?>
                                                    <input data-tab="paymentinfo" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control"/>
                                                <?php } else { ?>
                                                    <input data-tab="paymentinfo" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control  <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>"/>
                                                <?php }?>    
                                            <?php } else { ?>
                                                <input data-tab="paymentinfo" type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control  <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>"/>
                                            <?php }?>
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><div class="kbcustomfield error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
                                               
                                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['file_extension'] != '') {?> 
                                                   <div class="kbalert kbalert-warning pack-empty-warning" style="display: block; margin-top:10px;">
                                                        <i class="kb-material-icons" style="font-size:12px;margin-right:5px;">&#xe250;</i> 
                                                        <strong>
                                                            <span class="form-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'File must be ','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
<span class="file_extension"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['file_extension'], ENT_QUOTES, 'UTF-8');?>
</span></span>
                                                        </strong> 

                                                    </div>
                                               <?php }?>
                                        </div>
                                        <?php }?>
                                    </li>
                                <?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>
                    <div class="kb-block" style="padding:5px 15px 5px 5px; text-align: right;">
                        <div id="sellerprofile-updating-progress" class="input-loader" style="display:none;vertical-align: middle;"></div>
                        <button id="sellerprofile-update-btn" type="button" class="kbbtn-big kbbtn-success" onclick="validateSellerForm()"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</button>
                    </div>
                </div>
            </form>
        </div>    
</div>
<?php echo '<script'; ?>
>
    var kb_img_format = [];

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_img_frmats']->value, 'for');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['for']->value) {
?>
        kb_img_format.push("<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['for']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
");
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

	var kb_editor_lang = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['editor_lang']->value, ENT_QUOTES, 'UTF-8');?>
";
	var kb_default_lang = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['default_lang']->value, ENT_QUOTES, 'UTF-8');?>
";
        
    var kb_seller_form_error = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kb_validation_error']->value, ENT_QUOTES, 'UTF-8');?>
";
    var kb_img_size_error = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kb_img_size_error']->value, ENT_QUOTES, 'UTF-8');?>
";
    var kb_img_type_error = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kb_img_type_error']->value, ENT_QUOTES, 'UTF-8');?>
";
     var maximum = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
     var maximum_textarea_limit = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Kindly update the field as maximum character limit is ','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
     var minimum_textarea_limit = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Kindly update the field as minimum character limit is ','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
     var file_format_error = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'File is not in supported format','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
     var file_not_empty = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'File cannot be empty','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    var characters = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'characters','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    var business_email_error = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please enter Business Email in valid format.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    var url_error = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Link must be start from  http:// or https://','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
<?php echo '</script'; ?>
>

<?php }
}
