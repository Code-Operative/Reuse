<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-02 14:08:21
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/hook/field_display_front.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608ea445987285_85636245',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '470103ad761e866b5b1b4aa9a8825e3462762aa5' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/hook/field_display_front.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608ea445987285_85636245 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="kb_custom_field_block">
    <div >  
          <?php $_smarty_tpl->_assignInScope('field_counter', 0);?>
          
          <?php if (isset($_smarty_tpl->tpl_vars['registration_form_extra_fields']->value)) {?>
              <?php if (isset($_smarty_tpl->tpl_vars['registration_form_extra_fields']->value['shop_title']) && $_smarty_tpl->tpl_vars['registration_form_extra_fields']->value['shop_title'] == 1) {?>
                  <div class="form-group row">
                        <label class="col-md-3 form-control-label required" for="shop_title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shop Title','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</label>
                        <div class="col-md-6">
                        <input type="text" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter Shop Title','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
"
                               name='shop_title' id="shop_title" class="kbfield is_required validate form-control"
                               data-validate="isGenericName" 
                               value=""
                               />
                        <span class="error_message" style="display:none;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please enter valid Shop Title','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                        </div>
                         <div class="col-md-3 form-control-comment">
                        </div>
                    </div>
                <?php }?>
              <?php if (isset($_smarty_tpl->tpl_vars['registration_form_extra_fields']->value['seller_contact_number']) && $_smarty_tpl->tpl_vars['registration_form_extra_fields']->value['seller_contact_number'] == 1) {?>
                  <div class="form-group row">
                        <label class="col-md-3 form-control-label required" for="seller_contact_number"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter Contact No','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</label>
                        <div class="col-md-6">
                        <input type="text" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter contact no','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
"
                               name='seller_contact_number' id="shop_title" class="kbfield is_required validate form-control"
                               data-validate="isPhoneNumber"
                               value=""
                               />
                        <span class="error_message" style="display:none;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please enter valid contact number','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                        </div>
                         <div class="col-md-3 form-control-comment">
                        </div>
                    </div>
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['registration_form_extra_fields']->value['seller_city']) && $_smarty_tpl->tpl_vars['registration_form_extra_fields']->value['seller_city'] == 1) {?>
                <div class="form-group row">
                      <label class="col-md-3 form-control-label required" for="seller_city"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'City','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</label>
                      <div class="col-md-6">
                      <input type="text" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter city','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
"
                             name='seller_city' id="shop_title" class="kbfield is_required validate form-control"
                             data-validate="isGenericName" 
                             value=""
                             />
                      <span class="error_message" style="display:none;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please enter valid city name','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                      </div>
                       <div class="col-md-3 form-control-comment">
                      </div>
                  </div>
              <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['registration_form_extra_fields']->value['seller_country']) && $_smarty_tpl->tpl_vars['registration_form_extra_fields']->value['seller_country'] == 1) {?>
                      <div class="form-group row">
                         <label class="col-md-3 form-control-label required" for="seller_country"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Country','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</label>
                         <div class="col-md-6">
                         <select name='seller_country' id='seller_country' class="kbfield seller_country is_required form-control">
                            <?php if (!empty($_smarty_tpl->tpl_vars['total_active_country']->value)) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['total_active_country']->value, 'country_details', false, 'id_country');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id_country']->value => $_smarty_tpl->tpl_vars['country_details']->value) {
?>
                                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_country']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['default_country_id']->value == $_smarty_tpl->tpl_vars['id_country']->value) {?>selected <?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['country_details']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php }?>                       
                        </select>
                         </div>
                         <div class="col-md-3 form-control-comment">
                            </div>
                            <span class="error_message" style="display:none;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please choose a valid country.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                    </div>
              <?php }?>
              <?php if (isset($_smarty_tpl->tpl_vars['registration_form_extra_fields']->value['membership_plan']) && $_smarty_tpl->tpl_vars['registration_form_extra_fields']->value['membership_plan'] == 1) {?>
                      <div class="form-group row">
                         <label class="col-md-3 form-control-label required" for="seller_membership_plan"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select Membership Plan','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</label>
                         <div class="col-md-6">
                         <select name='seller_membership_plan' id='seller_membership_plan' class="kbfield seller_membership_plan is_required form-control">
                            <?php if (!empty($_smarty_tpl->tpl_vars['total_active_plan']->value)) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['total_active_plan']->value, 'plan_details', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['plan_details']->value) {
?>
                                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['plan_details']->value['id_kbmp_membership_plan'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['plan_details']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php }?>                       
                        </select>
                         </div>
                         <div class="col-md-3 form-control-comment">
                            </div>
                            <span class="error_message" style="display:none;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please choose a membership plan.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                    </div>
              <?php }?>
        <?php }?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_available_field']->value, 'kbfield');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['kbfield']->value) {
?>
            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'text') && ($_smarty_tpl->tpl_vars['kbfield']->value['show_registration_form'] == 1)) {?>
                <div class="form-group row">
                        <label class="col-md-3 form-control-label <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>
</label>
                        <div class="col-md-6">
                        <input type="<?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] == 'isEmail') {?>email<?php } else { ?>text<?php }?>" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                               name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?>validate<?php }?>  form-control"
                               <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] != '') && ($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] > 0)) {?> maxlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['max_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['min_length'] != '') {?>minlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['min_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                               value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>"
                               />
                        <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><span class="error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                        </div>
                         <div class="col-md-3 form-control-comment">
                         <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?><span class="form-info">(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
)</span><?php }?>
                     </div>
                    </div>
            <?php }?>
            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'select') && ($_smarty_tpl->tpl_vars['kbfield']->value['show_registration_form'] == 1)) {?>
                 <div class="form-group row">
                         <label class="col-md-3 form-control-label <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>
</label>
                         <div class="col-md-6">
                         <select name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?>[]<?php }?>' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' class="kbfield <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?> form-control"
                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['multiselect']) {?> multiple<?php }?> >
                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
"
                                        <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
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
                         </div>
                         <div class="col-md-3 form-control-comment">
                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?><span class="form-info">(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
)</span><?php }?>
                            </div>
                         <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><span class="error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                    </div>
            <?php }?>
            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'radio') && ($_smarty_tpl->tpl_vars['kbfield']->value['show_registration_form'] == 1)) {?>
                <div class="clearfix row">
                         <label class="col-md-3 form-control-label <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>
</label></br>
                         <div class="col-md-6">    
                             <div class="radio_kb_validate">
                        <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                    <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" class="radio-inline">
                                        <span class="custom-radio">
                                        <input type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
" 
                                             <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                   <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                       <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                           <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                               checked
                                                           <?php }?>
                                                       <?php }?>
                                                   <?php }?>
                                               <?php }?>  /><span></span>
                                    </span>
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>

                                    </label>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                                     <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><span class="error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                         </div>
                         </div>
                       <div class="col-md-3 form-control-comment">
                         <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?><span class="form-info">(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
)</span><?php }?>
                     </div>
                    </div>
            <?php }?>
            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'checkbox') && ($_smarty_tpl->tpl_vars['kbfield']->value['show_registration_form'] == 1)) {?>
                 <div class="form-group row">
                        <label class="col-md-3 form-control-label <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>
</label></br>
                        <div class="col-md-6">
                            <div class="checkbox_kb_validate">
                        <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                <span class="custom-checkbox">
                                        <input type="checkbox" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
[]"id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_value'], ENT_QUOTES, 'UTF-8');?>
"
                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'])) {?>
                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'] != '') {?>
                                                    <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]) && isset($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'])) {?>
                                                        <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['default_value'][0]['option_value'] == $_smarty_tpl->tpl_vars['field_value']->value['option_value']) {?>
                                                            checked
                                                        <?php }?>
                                                    <?php }?>
                                                <?php }?>
                                            <?php }?>  
                                               />
                                         <span><i class="material-icons checkbox-checked"></i></span>
                                    <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field_value']->value['option_label'], ENT_QUOTES, 'UTF-8');?>
</label>
                                </span>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                        
                        <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><span class="error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                        </div>
                 </div>
                        <div class="col-md-3 form-control-comment">
                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?><span class="form-info">(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
)</span><?php }?>
                        </div>
                    </div>

            <?php }?>
            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'textarea') && ($_smarty_tpl->tpl_vars['kbfield']->value['show_registration_form'] == 1)) {?>
                <div class="form-group row">
                    <label class="col-md-3 form-control-label <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>
</label>
                    <div class="col-md-6">
                    <textarea <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                                                                name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' class="kbfield <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 
                                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?>validate<?php }?>  form-control"
                                                                <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                                                <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] != '') && ($_smarty_tpl->tpl_vars['kbfield']->value['max_length'] > 0)) {?> maxlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['max_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['min_length'] != '') {?>minlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['min_length'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                                                ><?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?></textarea>
                   <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><span class="error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                </div>
                    <div class="col-md-3 form-control-comment">
                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?><span class="form-info">(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
)</span><?php }?>
                </div>

                </div>
            <?php }?>
            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'date') && ($_smarty_tpl->tpl_vars['kbfield']->value['show_registration_form'] == 1)) {?>
                <div class="form-group row">
                     <label class="col-md-3 form-control-label <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>
</label>
                     <div class="col-md-6">
                    <input type="text" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                           name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' class="kbfield kbfielddate <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?>validate<?php }?> form-control"
                           <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>"/>
                </div>
                    <div class="col-md-3 form-control-comment">
                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?><span class="form-info">(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
)</span><?php }?>
                </div>
                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><span class="error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                </div>
            <?php }?>
            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'datetime') && ($_smarty_tpl->tpl_vars['kbfield']->value['show_registration_form'] == 1)) {?>
                
                <div class="form-group row">
                    <label class="col-md-3 form-control-label <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>
</label>
                    <div class="col-md-6">
                    <input type="text" <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['placeholder'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> 
                           name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
' id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
' class="kbfielddatetime kbfield <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_class'], ENT_QUOTES, 'UTF-8');?>
 
                           <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?> <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?>validate<?php }?>  form-control hasDatetimepicker"
                           <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['validation'] != '') {?> data-validate="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['validation'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> value="<?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'], ENT_QUOTES, 'UTF-8');
}?>"/>
                </div>
                    <div class="col-md-3 form-control-comment">
                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?><span class="form-info">(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
)</span><?php }?>
                </div>
                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><span class="error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</span><?php }?>
                </div>
            <?php }?>
            <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'file') && ($_smarty_tpl->tpl_vars['kbfield']->value['show_registration_form'] == 1)) {?>
                <div class="form-group row">
                    <label class="col-md-3 form-control-label <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>required<?php }?>" for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['label'], ENT_QUOTES, 'UTF-8');?>
</label>
                    <div class="col-md-6">
                        <input type="file" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['field_name'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" data-buttonText="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Choose file','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['html_id'], ENT_QUOTES, 'UTF-8');?>
" class="kbfield kbfiletype form-control  <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['required']) {?>is_required<?php }?>" />
                    </div>
                    <div class="col-md-3 form-control-comment">
                        <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['description'] != '') {?><span class="form-info">(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['description'], ENT_QUOTES, 'UTF-8');?>
)</span><?php }
if ($_smarty_tpl->tpl_vars['kbfield']->value['file_extension'] != '') {?> <span class="form-info "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'File must be ','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
<span class="file_extension"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['file_extension'], ENT_QUOTES, 'UTF-8');?>
</span></span></br><?php }?>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'] != '') {?><span class="error_message" style="display:none;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kbfield']->value['error_msg'], ENT_QUOTES, 'UTF-8');?>
</span><?php }?>

                </div>
            <?php }?>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
</div>
    <?php echo '<script'; ?>
>
        var submit_account_btn = 1;
        var kb_not_valid = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field is not valid','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var file_not_empty = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'File cannot be empty','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var field_not_empty = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field cannot be empty','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_empty_field = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field cannot be empty.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_number_field = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can enter only numbers.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_positive_number = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Number should be greater than 0.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_maxchar_field = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field cannot be greater than # characters.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_minchar_field =  "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field cannot be less than # character(s).','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_empty_email =  "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please enter Email.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_validate_email =  "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please enter a valid Email.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_max_email =  "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email cannot be greater than # characters.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_script = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Script tags are not allowed.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_style="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Style tags are not allowed.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_iframe =  "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Iframe tags are not allowed.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_html_tags =  "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field should not contain HTML tags.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var kb_invalid_date = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invalid date format.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var file_format_error = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'File is not in supported format','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    <?php echo '</script'; ?>
>

<?php }
}
