<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 20:57:14
  from '/home/codeoperativeco/public_html/modules/kbmpdealmanager/views/templates/front/deals/account/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608b0f9a7f97a3_82751283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54ce483039a3ca95e5e1116c4ab568b2c42b5158' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmpdealmanager/views/templates/front/deals/account/form.tpl',
      1 => 1619726232,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608b0f9a7f97a3_82751283 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    var path_fold = null;
<?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['Enable']->value == 1) {?>
<div class="kb-content">
    <?php if (!isset($_smarty_tpl->tpl_vars['permission_error']->value)) {?>
        <div class="kb-content-header">
            <h1><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['form_heading']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</h1>
            <?php if ($_smarty_tpl->tpl_vars['deal']->value->id > 0) {?>
            <div class="kb-content-header-btn">
                <a href="javascript:void(0)" onclick="actionDeleteConfirmation(this)" data-href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('kbmpdealmanager','mydeals',array('render'=>'delete','id_seller_deal'=>$_smarty_tpl->tpl_vars['deal']->value->id),(bool)Configuration::get('PS_SSL_ENABLED')),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="kbbtn btn-danger" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'click to delete deal','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
"><i class="icon-trash"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span></i></a>
            </div>
            <?php }?>
            <div class="clearfix"></div>
        </div>
        <form id="kb-seller-deal-form" action="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['deal_submit_url']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" method="post" enctype="multipart/form-data">
            <input type="hidden" name="submitSellerDeal" value="1" />
            <input type="hidden" id="id_seller_deal" name="id_seller_deal" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['deal']->value->id), ENT_QUOTES, 'UTF-8');?>
" />
            <div id="kb-shipping-form-global-msg" class="kbalert kbalert-danger" style="display:none;"></div>
            <div class="kbalert kbalert-info">
                <i class="icon-question-sign"></i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Fields marked with (*) are mandatory fields.','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>

            </div>
            <div class="kb-panel outer-border">
                <div class='kb-panel-body'>
                    <div class="kb-block kb-form">
                        <ul class="kb-form-list">
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deal Title','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" validate="isGenericName" name="title" value="<?php if (!empty($_smarty_tpl->tpl_vars['deal']->value->title)) {
if (isset($_smarty_tpl->tpl_vars['deal']->value->title[$_smarty_tpl->tpl_vars['lang_id']->value])) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['deal']->value->title[$_smarty_tpl->tpl_vars['lang_id']->value],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}
}?>"/>
                                </div>
                            </li>
                            <li class="kb-form-fwidth">
                                <div class="kb-form-label-block">
                                    <span class="kblabel"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deal Banner','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="form-img-display">
                                        <img id="seller_deal_banner_placeholder" style="max-height:300px;" class="form-banner-display" src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['banner_path']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Banner of your deal/offer','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
">
                                    </div>
                                    <input id="seller_deal_banner" class="kb_upload_field" type="file" name="banner_path" style="display:none;" />
                                    <div class="kb-block file-uploader">
                                        <a href="javascript:void(0)" onclick="uploadImage('seller_deal_banner')" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Browse','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</a>
                                        <a href="javascript:void(0)" onclick="removeSellerImage('seller_deal_banner', '<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller_default_dealbanner']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
')" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</a>
                                        <input id="seller_deal_banner_update" type="hidden" name="seller_deal_banner_update" value="0" />
                                    </div>
                                    <p class="form-inp-help"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Provide your banner in landscape size to visible properly on website.','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</p>
                                    <div id="seller_deal_banner_error" class="kb-validation-error"></div>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Start Date','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="kb-labeled-inpfield">
                                        <span class="inplbl"><i class="icon-calendar-empty"></i></span>
                                        <input id="seller_deal_from_date" type="text" class="kb-inpfield datetimepicker required" name="from_date" validate="isDateTime" value="<?php if (!empty($_smarty_tpl->tpl_vars['deal']->value->from_date)) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( date('Y-m-d H:i:s',strtotime($_smarty_tpl->tpl_vars['deal']->value->from_date)),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" />
                                    </div>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'End Date','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="kb-labeled-inpfield">
                                        <span class="inplbl"><i class="icon-calendar-empty"></i></span>
                                        <input id="seller_deal_end_date" type="text" class="kb-inpfield datetimepicker required" name="end_date" validate="isDateTime" value="<?php if (!empty($_smarty_tpl->tpl_vars['deal']->value->end_date)) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( date('Y-m-d H:i:s',strtotime($_smarty_tpl->tpl_vars['deal']->value->end_date)),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" />
                                    </div>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deal Type','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span>
                                </div>
                                <div class="kb-form-field-block">
                                    <select id="kbmp_deal_type" name="deal_type" class="kb-inpselect required" onchange="switchDealType(this)">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, DealTool::getDealTypes(), 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
                                            <?php if ($_smarty_tpl->tpl_vars['key']->value != 3) {?>
                                                <option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['key']->value), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['key']->value == $_smarty_tpl->tpl_vars['deal']->value->deal_type) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['deal_types']->value[$_smarty_tpl->tpl_vars['key']->value], ENT_QUOTES, 'UTF-8');?>
</option>
                                            <?php }?>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Active','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select name="active" class="kb-inpselect required">
                                        <option value="0" <?php if ($_smarty_tpl->tpl_vars['deal']->value->active == 0) {?>selected="selected"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</option>
                                        <option value="1" <?php if ($_smarty_tpl->tpl_vars['deal']->value->active == 1) {?>selected="selected"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</option>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-l deal_cart_rule">
                                <div class="kb-form-label-block">
                                    <span class="kblabel ">
                                        <i class="icon-question" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Allowed characters [0-9a-zA-Z], Coupon code length should be 5 to 8 characters.','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
"></i>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Coupon Code','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>

                                    </span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <div class="kb-labeled-inpfield">
                                        <span class="inplbl" style="cursor:pointer;" onclick="generateCouponCode(8, 'mydeals')"><i class="icon-random"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Generate','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</i></span>
                                        <input id="coupon_code" type="text" class="kb-inpfield required" name="code" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['deal']->value->code,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
                                    </div>
                                </div>
                            </li>
                            <li class="kb-form-l">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Discount Type','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <select id="reduction_type" name="reduction_type" class="kb-inpselect required">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, DealTool::getReductionTypes(), 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
                                            <option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['key']->value), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['key']->value == $_smarty_tpl->tpl_vars['deal']->value->reduction_type) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['reduction_types']->value[$_smarty_tpl->tpl_vars['key']->value], ENT_QUOTES, 'UTF-8');?>
</option>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </select>
                                </div>
                            </li>
                            <li class="kb-form-r">
                                <div class="kb-form-label-block">
                                    <span class="kblabel "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Discount','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span><em>*</em>
                                </div>
                                <div class="kb-form-field-block">
                                    <input type="text" class="kb-inpfield required" validate="isPrice" name="reduction" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['deal']->value->reduction,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="14" />
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kb-panel outer-border">
                    <div class="kb-panel-header">
                        <h1>Rules</h1>
                        <div class="clearfix"></div>
                    </div>
                    <div class="kb-panel-body" style="overflow-x:auto;">
                        <table class="kb-table-list">
                            <thead>
                                <tr class="heading-row">
                                    <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Type','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</th>
                                    <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Value','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</th>
                                    <th width="80"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Action','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</th>
                                </tr>
                            </thead>
                            <tbody id="seller_deal_rules">
                                <?php if (count($_smarty_tpl->tpl_vars['deal_rule_categories']->value) > 0) {?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                                        <?php if (in_array($_smarty_tpl->tpl_vars['cat']->value['id_category'],$_smarty_tpl->tpl_vars['deal_rule_categories']->value)) {?>
                                            <tr>
                                                <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Category','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</td>
                                                <td><input type="hidden" name="deal_rule_categories[]" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['cat']->value['id_category']), ENT_QUOTES, 'UTF-8');?>
" /><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cat']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                                                <td><a href="javascript:void(0)" onclick="deleteSellerDealRule(this)" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click to delete rule','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</a></td>
                                            </tr>
                                        <?php }?>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <?php }?>
                                <?php if (count($_smarty_tpl->tpl_vars['deal_rule_manufacturers']->value) > 0) {?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['manufacturers']->value, 'manu');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['manu']->value) {
?>
                                        <?php if (in_array($_smarty_tpl->tpl_vars['manu']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['deal_rule_manufacturers']->value)) {?>
                                            <tr>
                                                <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Manufacturer','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</td>
                                                <td><input type="hidden" name="deal_rule_manufacturers[]" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['manu']->value['id_manufacturer']), ENT_QUOTES, 'UTF-8');?>
" /><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['manu']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                                                <td><a href="javascript:void(0)" onclick="deleteSellerDealRule(this)" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click to delete rule','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</a></td>
                                            </tr>
                                        <?php }?>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="kb-panel-body">
                            <ul class="kb-form-list">
                                <li class="kb-form-l">
                                    <div class="kb-form-label-block">
                                        <span class="kblabel "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select Category','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span>
                                    </div>
                                    <div class="kb-form-field-block">
                                        <select id="deal_rule_category" name="deal_rule_category" class="kb-inpselect">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                                                <option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['cat']->value['id_category']), ENT_QUOTES, 'UTF-8');?>
" <?php if (($_smarty_tpl->tpl_vars['assigned_cat_exist']->value && !in_array($_smarty_tpl->tpl_vars['cat']->value['id_category'],$_smarty_tpl->tpl_vars['assigned_categories']->value))) {?>disabled="disabled"<?php }?>><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cat']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </select>
                                    </div>
                                    <div class="kb-form-field-block" style="margin-top:5px;">
                                        <a href="javascript:void(0)" onclick="addCategoryRule()" class="kbbtn btn-info" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'click to add new rule','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
"><i class="icon-plus"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Rule','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</span></i></a>
                                    </div>
                                    </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class='kb-vspacer5'></div>
            <input id="kbmp_submission_type" type="hidden" name="submitType" value="save" />
            <button type="button" class='kbbtn-big kbbtn-default' onclick="validateDealForm('savenstay')"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save and Stay','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</button>
            <button type="button" class='kbbtn-big kbbtn-success' onclick="validateDealForm('save')"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</button>
        </form>
        <?php echo '<script'; ?>
>
        var kbmp_reductiontype_percent = "<?php echo htmlspecialchars(intval(DealTool::REDUCTION_TYPE_PERCENTAGE), ENT_QUOTES, 'UTF-8');?>
";
        var kbmp_dealtype_cart = "<?php echo htmlspecialchars(intval(DealTool::DEAL_TYPE_CART), ENT_QUOTES, 'UTF-8');?>
";
        var kb_dealrule_label_delete = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( 'Delete','htmlall','UTF-8' )),'mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
";
        var kb_dealrule_label_category = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( 'Category','htmlall','UTF-8' )),'mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
";
        var kb_dealrule_label_manufacturer = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( 'Manufacturer','htmlall','UTF-8' )),'mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
";
        var kb_invalid_deal_date_msg = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( 'End date should be greater the start date','htmlall','UTF-8' )),'mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
";
        var kb_invalid_discount_range = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( 'Discount should be between 1-100','htmlall','UTF-8' )),'mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
";
        var kb_dealrule_required_rule = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( 'Atleast one rule is required.','htmlall','UTF-8' )),'mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
";
        var kb_dealrule_unassign_cat_rule_err = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( 'This category is not assigned to you.','htmlall','UTF-8' )),'mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
";
            var kb_img_format = [];

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_img_frmats']->value, 'for');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['for']->value) {
?>
                kb_img_format.push('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['for']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            
            $(document).ready(function(){
            
                            
            });
                
        <?php echo '</script'; ?>
>
    <?php }?>
</div>
<?php } else { ?>
    <div class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can not add new deals as your store owner has disabled this option from the backend.','mod'=>'kbmpdealmanager'),$_smarty_tpl ) );?>
</div>
<?php }
}
}
