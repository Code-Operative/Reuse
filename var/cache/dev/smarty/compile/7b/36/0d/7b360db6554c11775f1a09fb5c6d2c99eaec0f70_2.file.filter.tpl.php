<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 20:57:48
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/helper/filter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608b0fbcb7dd91_61838982',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b360db6554c11775f1a09fb5c6d2c99eaec0f70' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/helper/filter.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608b0fbcb7dd91_61838982 (Smarty_Internal_Template $_smarty_tpl) {
if (is_array($_smarty_tpl->tpl_vars['filter_params']->value) && count($_smarty_tpl->tpl_vars['filter_params']->value) > 0) {?>
<div id="filter-block-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter_id']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="kb-filter-container">
    <div data-toggle="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter_id']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_filter" class="kb-filter-header kb-panel-header-tab">
        <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter_header']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

        <div class="kb-accordian-symbol kbexpand"></div>
    </div>
    <div id="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter_id']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
_filter" class="kb-form kb-filter-block">
        <ul>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filter_params']->value, 'filter');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['filter']->value) {
?>
                <?php if ($_smarty_tpl->tpl_vars['filter']->value['type'] == 'select') {?>
                    <?php if (is_array($_smarty_tpl->tpl_vars['filter']->value['values']) && count($_smarty_tpl->tpl_vars['filter']->value['values']) > 0) {?>
                        <li>
                            <div class="kb-form-label-block">
                                <span class="kblabel"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
:<?php if (isset($_smarty_tpl->tpl_vars['filter']->value['is_required']) && $_smarty_tpl->tpl_vars['filter']->value['is_required'] == true) {?><em>*</em><?php }?></span>
                            </div>
                            <div class="kb-form-field-block">
                                <select name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="kb-inpselect <?php if (isset($_smarty_tpl->tpl_vars['filter']->value['class'])) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['class'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?> <?php if (isset($_smarty_tpl->tpl_vars['filter']->value['is_required']) && $_smarty_tpl->tpl_vars['filter']->value['is_required'] == true) {?>required<?php }?>" <?php if (isset($_smarty_tpl->tpl_vars['filter']->value['validate']) && $_smarty_tpl->tpl_vars['filter']->value['validate'] != null) {?>validate="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['validate'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php }?>>
                                    <?php if (isset($_smarty_tpl->tpl_vars['filter']->value['placeholder']) && $_smarty_tpl->tpl_vars['filter']->value['placeholder'] != '') {?>
                                        <option value=''><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['placeholder'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                                    <?php }?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filter']->value['values'], 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
                                        <option <?php if (isset($_smarty_tpl->tpl_vars['filter']->value['default']) && $_smarty_tpl->tpl_vars['filter']->value['default'] == $_smarty_tpl->tpl_vars['val']->value['value']) {?>selected="selected"<?php }?> value='<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['val']->value['value'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
'><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['val']->value['label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                            </div>
                        </li>     
                    <?php }?>
                <?php } elseif ($_smarty_tpl->tpl_vars['filter']->value['type'] == 'text') {?>
                    <li>
                        <div class="kb-form-label-block">
                            <span class="kblabel"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
:<?php if (isset($_smarty_tpl->tpl_vars['filter']->value['is_required']) && $_smarty_tpl->tpl_vars['filter']->value['is_required'] == true) {?><em>*</em><?php }?></span>
                        </div>
                        <div class="kb-form-field-block">
                            <input 
                                <?php if (isset($_smarty_tpl->tpl_vars['filter']->value['placeholder']) && $_smarty_tpl->tpl_vars['filter']->value['placeholder'] != '') {?>placeholder="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['placeholder'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php }?>
                                value="<?php if (isset($_smarty_tpl->tpl_vars['filter']->value['default']) && $_smarty_tpl->tpl_vars['filter']->value['default'] != '') {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['default'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" 
                                type="text" 
                                name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="kb-inpfield <?php if (isset($_smarty_tpl->tpl_vars['filter']->value['class'])) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['class'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?> <?php if (isset($_smarty_tpl->tpl_vars['filter']->value['is_required']) && $_smarty_tpl->tpl_vars['filter']->value['is_required'] == true) {?>required<?php }?>" <?php if (isset($_smarty_tpl->tpl_vars['filter']->value['validate']) && $_smarty_tpl->tpl_vars['filter']->value['validate'] != null) {?>validate="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['validate'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"<?php }?> />
                        </div>
                    </li>
                <?php } elseif ($_smarty_tpl->tpl_vars['filter']->value['type'] == 'hidden') {?>
                    <input type="hidden"   name="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['filter']->value['default']) && $_smarty_tpl->tpl_vars['filter']->value['default'] != '') {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter']->value['default'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>"
                <?php }?>
                
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <div class="kb-filter-action-btn">
            <input id='kb_filter_action_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter_id']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
' type='hidden' name='kb_filter_action_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter_id']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
' value='<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter_action_name']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
' />
            <button type="button" class="kbbtn kbbtn-success" onclick="KbFilterList('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter_id']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
')"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</button>
            <?php if (isset($_smarty_tpl->tpl_vars['hide_reset_button']->value) && $_smarty_tpl->tpl_vars['hide_reset_button']->value == 1) {?>
            <?php } else { ?>
            <button type="button" class="kbbtn btn-warning" onclick="resetKbFilters('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['filter_id']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
')"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reset','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</button>
            <?php }?>
            <div id="uploading-progress" class="input-loader" style="vertical-align: middle; display:none;"></div>
        </div>
    </div>
</div>
<?php }
}
}
