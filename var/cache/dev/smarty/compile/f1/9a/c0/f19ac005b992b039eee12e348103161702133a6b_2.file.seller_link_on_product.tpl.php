<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-13 17:41:08
  from '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/hook/seller_link_on_product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604cf93469bbe5_24711875',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f19ac005b992b039eee12e348103161702133a6b' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/hook/seller_link_on_product.tpl',
      1 => 1613588115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604cf93469bbe5_24711875 (Smarty_Internal_Template $_smarty_tpl) {
?>    <div id="kbmp-seller-info" class="tabs kbmp-_block box-info-product">
    <div class="kbmp-_row">
        <div class="kbmp-_inner_block"><span class="title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sold By','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
:</span></div>
        <div class="kbmp-_inner_block"><a href="<?php echo KbGlobal::getSellerLink($_smarty_tpl->tpl_vars['id_seller']->value);?>
"><span class=""><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller_title']->value, ENT_QUOTES, 'UTF-8');?>
</span></a></div>

    </div>
    <div class="kbmp-_row">
        <div class="kbmp-_inner_block" style="position:relative;">
            <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('kbmarketplace','sellerfront',array('render_type'=>'sellerreviews','id_seller'=>$_smarty_tpl->tpl_vars['id_seller']->value),(bool)Configuration::get('PS_SSL_ENABLED'));?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>sprintf('Total %s review(s)',$_smarty_tpl->tpl_vars['seller_review_count']->value),'mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
">
            <div class="vss_seller_ratings">
                <!-- Do not customise it -->
                <div class="vss_rating_unfilled">★★★★★</div>
                
                <!-- Set only width in percentage according to rating -->
                <div class="vss_rating_filled" style="width:<?php echo htmlspecialchars(sprintf('%.2f',$_smarty_tpl->tpl_vars['seller_rating']->value), ENT_QUOTES, 'UTF-8');?>
%">★★★★★</div>
            </div>
            </a> 
        </div>
        <div class="kbmp-_inner_block"><a title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>sprintf('Total %s review(s)',$_smarty_tpl->tpl_vars['seller_review_count']->value),'mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('kbmarketplace','sellerfront',array('render_type'=>'sellerreviews','id_seller'=>$_smarty_tpl->tpl_vars['id_seller']->value),(bool)Configuration::get('PS_SSL_ENABLED'));?>
" class="vss_active_link vss_read_review_bck"><span class=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View Reviews','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span></a></div> 
<?php if ($_smarty_tpl->tpl_vars['display_new_review']->value) {?>
        <div class="kbmp-_inner_block"><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('kbmarketplace','sellerfront',array('render_type'=>'sellerreviews','id_seller'=>$_smarty_tpl->tpl_vars['id_seller']->value),(bool)Configuration::get('PS_SSL_ENABLED'));?>
" class="vss_active_link vss_write_review_bck"><span class=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Write Review','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span></a></div>
<?php }?>
    </div>
    <div class="kbmp-_row" style="padding-top:10px;">
        <i class="kb-material-icons">view_list</i><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('kbmarketplace','sellerfront',array('render_type'=>'sellerproducts','id_seller'=>$_smarty_tpl->tpl_vars['id_seller']->value),(bool)Configuration::get('PS_SSL_ENABLED'));?>
" style="padding-left:7px;font-size:13px;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View more products of this seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a> 
        
    </div>
    <?php if (isset($_smarty_tpl->tpl_vars['is_enabled_seller_shortlisting']->value) && $_smarty_tpl->tpl_vars['is_enabled_seller_shortlisting']->value == 1) {?>
    <div class="kbmp-_row" style="padding-top:10px;">
                    
        <i class="kb-material-icons shortlist_link" style="<?php if (isset($_smarty_tpl->tpl_vars['is_already_added']->value) && $_smarty_tpl->tpl_vars['is_already_added']->value == 1) {?>color: #ef4545;<?php } else { ?>color: grey;<?php }?>">&#xe87d;</i><a href="javascript:addShortListSeller(this, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_seller']->value, ENT_QUOTES, 'UTF-8');?>
);" class="sfl_product_link_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id_seller']->value, ENT_QUOTES, 'UTF-8');?>
" style="padding-left:7px;font-size:13px;"><?php if (isset($_smarty_tpl->tpl_vars['is_already_added']->value) && $_smarty_tpl->tpl_vars['is_already_added']->value == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Favourite Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mark Seller as Favourite','mod'=>'kbmarketplace'),$_smarty_tpl ) );
}?></a>
           </div>
   <?php }?>
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbSellerOnProductView",'id_seller'=>$_smarty_tpl->tpl_vars['id_seller']->value),$_smarty_tpl ) );?>

</div>
    <?php echo '<script'; ?>
>
        var ajaxurl = "<?php echo $_smarty_tpl->tpl_vars['ajaxurl']->value;?>
";
        var sfl_shortlist_text= "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mark Seller as Favourite','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var sfl_already_added_text= "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Favourite Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    <?php echo '</script'; ?>
>
<?php }
}
