<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-02 12:20:58
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/hook/seller_menus.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608e8b1a67f963_54635725',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f2cb4c07b1c65f1ce61973a4b4b8a09dd072cbf6' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/hook/seller_menus.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608e8b1a67f963_54635725 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['link_to_register']->value)) {?>
    <?php if ($_smarty_tpl->tpl_vars['kb_seller_agreement']->value != '') {?>
        <a id="open_kb_seller_agreement_modal" class="col-lg-4 col-md-6 col-sm-6" href="javascript:void(0)" data-modal="kb_seller_agreement_modal" 
           title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click to register as seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" >
            <span class="link-item">
                <i class="kb-material-icons">&#xe563;</i>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Register as seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

            </span>
        </a>
    <?php } else { ?>
        <a class="col-lg-4 col-md-6 col-sm-6" href="javascript:void(0)" data-href="<?php echo $_smarty_tpl->tpl_vars['link_to_register']->value;?>
" 
           title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click to register as seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" 
           onclick="takeconfirmationforregister(this)" >
            <span class="link-item">
                <i class="kb-material-icons">&#xe563;</i>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Register as seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

            </span>
        </a> 
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['is_favourite_seller_page']->value) && $_smarty_tpl->tpl_vars['is_favourite_seller_page']->value == 1) {?>
        <a class="col-lg-4 col-md-6 col-sm-6" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click to visit favourite seller page','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['favourite_seller_page_link']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
            <span class="link-item">
            <i class="kb-material-icons">&#xe87d;</i>                 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My Favourite Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

            </span>
        </a>
    <?php }?>
    <?php echo '<script'; ?>
 type="text/javascript">
        var kb_confirm_msg = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Are you sure?','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        function takeconfirmationforregister(e){
            if(confirm(kb_confirm_msg)){
                location.href=$(e).attr('data-href');
            }
        }
    <?php echo '</script'; ?>
>
    
<?php if ($_smarty_tpl->tpl_vars['kb_seller_agreement']->value != '') {?>
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
                <div class="modal-body" style="min-height:auto;"><?php echo $_smarty_tpl->tpl_vars['kb_seller_agreement']->value;?>
</div> 
                <div class="modal-footer">
                     <div class="checkbox">
                             <input type="checkbox" name="kbmp_registered_as_seller" id="kbmp_registered_as_seller" value="1" />
                             <label for="kbmp_registered_as_seller"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'I have read the agreement and register me as seller.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</label>
                         </div>
                    <button disabled="true" id="kbmp_registered_as_seller_btn" type="button" class="btn btn-success" onclick="location.href= '<?php echo $_smarty_tpl->tpl_vars['link_to_register']->value;?>
'; "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Register','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</button> 
                </div>
            </div>
        </div>
    </div>    
    
<?php }?>    
    
<?php } elseif (isset($_smarty_tpl->tpl_vars['menus']->value) && count($_smarty_tpl->tpl_vars['menus']->value) > 0) {?>
    <?php if (isset($_smarty_tpl->tpl_vars['is_favourite_seller_page']->value) && $_smarty_tpl->tpl_vars['is_favourite_seller_page']->value == 1) {?>
        <a class="col-lg-4 col-md-6 col-sm-6" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click to visit favourite seller page','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['favourite_seller_page_link']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
            <span class="link-item">
            <i class="kb-material-icons">&#xe87d;</i>                 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My Favourite Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

            </span>
        </a>
    <?php }?>
    <div class="row_info" style="display:block;clear:both;width:100%;">	
        <h1 style="margin-left: 0.9375rem;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Seller Account','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h1>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menus']->value, 'menu');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->value) {
?>
            <a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['href'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                <span class="link-item">
                    <i class="kb-material-icons"><?php echo $_smarty_tpl->tpl_vars['menu']->value['icon_class'];?>
</i> 
                    <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                </span>
            </a>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
<?php }
}
}
