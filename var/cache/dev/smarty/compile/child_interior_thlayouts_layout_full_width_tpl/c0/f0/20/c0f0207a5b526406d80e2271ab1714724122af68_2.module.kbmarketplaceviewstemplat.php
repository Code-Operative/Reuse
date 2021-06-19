<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-10 13:58:58
  from 'module:kbmarketplaceviewstemplat' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60992e12062b50_70870722',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0f0207a5b526406d80e2271ab1714724122af68' => 
    array (
      0 => 'module:kbmarketplaceviewstemplat',
      1 => 1619254986,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:kbmarketplace/views/templates/front/layouts/col3_layout.tpl' => 1,
    'module:kbmarketplace/views/templates/front/layouts/col2_layout.tpl' => 1,
  ),
),false)) {
function content_60992e12062b50_70870722 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>
<!-- begin /home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/layout.tpl -->
<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_89739360660992e1204c054_17107098', 'content');
?>

<!-- end /home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/layout.tpl --><?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'content'} */
class Block_89739360660992e1204c054_17107098 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_89739360660992e1204c054_17107098',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div id="kb-marketplace-layout" class="outer-border pad5">
        <?php if ($_smarty_tpl->tpl_vars['HOOK_KBLEFT_COLUMN']->value && $_smarty_tpl->tpl_vars['HOOK_KBRIGHT_COLUMN']->value) {?>
            <?php $_smarty_tpl->_subTemplateRender('module:kbmarketplace/views/templates/front/layouts/col3_layout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php } elseif ($_smarty_tpl->tpl_vars['HOOK_KBLEFT_COLUMN']->value || $_smarty_tpl->tpl_vars['HOOK_KBRIGHT_COLUMN']->value) {?>
            <?php $_smarty_tpl->_subTemplateRender('module:kbmarketplace/views/templates/front/layouts/col2_layout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php } elseif ($_smarty_tpl->tpl_vars['TEMPLATE']->value) {?>
        <div id="kblayout-centercol" class="center_column col-xs-12 col-sm-12 pad0">
            <div class="kb-block kb-panel centerlftoffest">
                <?php if (isset($_smarty_tpl->tpl_vars['waiting_for_approval']->value)) {?>
                    <div class="kbalert kbalert-warning">
                        <i class="kb-material-icons">&#xE645;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your seller account has been created and waiting for Admin approval.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                    </div>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['approval_link']->value)) {?>
                    <div class="kbalert kbalert-warning">
                        <i class="kb-material-icons">&#xE645;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your seller account has been disapproved by Admin.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
 <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['approval_link']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'to again send request for account approval.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                    </div>
                <?php }?>

                <?php if (isset($_smarty_tpl->tpl_vars['account_dissaproved']->value)) {?>
                    <div class="kbalert kbalert-warning">
                        <i class="kb-material-icons">&#xE645;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your seller account has been disapproved by Admin.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                    </div>
                <?php }?>

                <?php if (isset($_smarty_tpl->tpl_vars['account_disabled']->value)) {?>
                    <div class="kbalert kbalert-warning">
                        <i class="kb-material-icons">&#xE645;</i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your seller account is inactive.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                    </div>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['kb_confirmation']->value) && is_array($_smarty_tpl->tpl_vars['kb_confirmation']->value) && count($_smarty_tpl->tpl_vars['kb_confirmation']->value) > 0) {?>
                    <div class="kbalert kbalert-success">
                        <ul>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_confirmation']->value, 'con');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['con']->value) {
?>
                                <li><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['con']->value, ENT_QUOTES, 'UTF-8');?>
</li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['kb_errors']->value) && is_array($_smarty_tpl->tpl_vars['kb_errors']->value) && count($_smarty_tpl->tpl_vars['kb_errors']->value) > 0) {?>
                    <div class="kbalert kbalert-danger">
                        <ul>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_errors']->value, 'err');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['err']->value) {
?>
                                <li><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['err']->value, ENT_QUOTES, 'UTF-8');?>
</li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>
                <?php }?>
                <?php echo $_smarty_tpl->tpl_vars['TEMPLATE']->value;?>
 
            </div>
        </div>
        <?php }?>
        <div class="clearfix"></div>
        <?php echo '<script'; ?>
 type="text/javascript">
            <?php if (isset($_smarty_tpl->tpl_vars['mobile_device']->value)) {?>
                var is_mobile_device = <?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['mobile_device']->value), ENT_QUOTES, 'UTF-8');?>
;
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['kb_image_path']->value)) {?>
                var kb_img_seller_path = "<?php echo $_smarty_tpl->tpl_vars['kb_image_path']->value;?>
"; 
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['kb_current_request']->value)) {?>
                var kb_current_request = "<?php echo $_smarty_tpl->tpl_vars['kb_current_request']->value;?>
"; 
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['ajax_error']->value)) {?>
                var kb_ajax_request_fail_err = "<?php echo $_smarty_tpl->tpl_vars['ajax_error']->value;?>
"; 
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['required_field_error']->value)) {?>
                var kb_required_field = "<?php echo $_smarty_tpl->tpl_vars['required_field_error']->value;?>
"; 
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['invalid_field_error']->value)) {?>
                var kb_invalid_field = "<?php echo $_smarty_tpl->tpl_vars['invalid_field_error']->value;?>
"; 
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['kb_image_size_limit']->value)) {?>
                var kb_image_size_limit = "<?php echo $_smarty_tpl->tpl_vars['kb_image_size_limit']->value;?>
"; 
            <?php }?>
            var kb_delete_confirmation = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Are you sure?','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        <?php echo '</script'; ?>
>
    </div>
<?php
}
}
/* {/block 'content'} */
}
