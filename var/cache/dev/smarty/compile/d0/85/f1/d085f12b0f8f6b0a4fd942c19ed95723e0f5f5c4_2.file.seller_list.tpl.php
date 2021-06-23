<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 19:52:18
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/seller_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608b0062801490_52731306',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd085f12b0f8f6b0a4fd942c19ed95723e0f5f5c4' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/seller_list.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_608b0062801490_52731306 (Smarty_Internal_Template $_smarty_tpl) {
?><section id="main">
    <section id="products">
        <div class="products row">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sellers']->value, 'seller', false, NULL, 'sellers', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['seller']->value) {
?>
                <article class="product-miniature js-product-miniature">
                    <div class="thumbnail-container">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['seller']->value['href'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['title'], ENT_QUOTES, 'UTF-8');?>
" class="thumbnail product-thumbnail"> 
                            <img
                              src = "<?php echo $_smarty_tpl->tpl_vars['seller']->value['logo'];?>
"  
                              alt = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['title'], ENT_QUOTES, 'UTF-8');?>
"
                            >
                        </a>
                        <div class="product-description">
                            <h1 class="h3 product-title"><a href="<?php echo $_smarty_tpl->tpl_vars['seller']->value['href'];?>
" target='_blank' title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['title'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['title'],30,'...' )), ENT_QUOTES, 'UTF-8');?>
</a></h1>  
                            <div class="product-price-and-shipping">
                                <div class="vss_seller_ratings">
                                    <div class="vss_rating_unfilled">★★★★★</div>
                                    <div class="vss_rating_filled" style="width:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['rating_percent'], ENT_QUOTES, 'UTF-8');?>
%">★★★★★</div>
                                </div>
                            </div>
                            <?php if (isset($_smarty_tpl->tpl_vars['is_favourite_seller_page']->value) && $_smarty_tpl->tpl_vars['is_favourite_seller_page']->value == 1) {?>
                                <div class="product-price-and-shipping">
                                <div class="kbmp-_row kb-tcenter">
                                <div class="kbmp-_inner_block">
                                    <i class="kb-material-icons shortlist_link" style="color: #ef4545;">&#xe87d;</i><a href="javascript:addShortListSeller(this, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['id_seller'], ENT_QUOTES, 'UTF-8');?>
);" class="sfl_product_link_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['id_seller'], ENT_QUOTES, 'UTF-8');?>
" style="padding-left:7px;font-size:13px;color: #2fb5d2;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Favourite Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
                                </div>
                                </div>
                            <?php } else { ?>
                            <div class="product-price-and-shipping">
                                <div class="kbmp-_row kb-tcenter">
                                <div class="kbmp-_inner_block"><a href="<?php echo $_smarty_tpl->tpl_vars['seller']->value['view_review_href'];?>
" class="vss_active_link vss_read_review_bck" title='<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>sprintf('%s Review(s)',$_smarty_tpl->tpl_vars['seller']->value['total_review']),'mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
'><span class=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View Reviews','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span></a></div> 
                                    <?php if ($_smarty_tpl->tpl_vars['seller']->value['display_write_review']) {?>
                                        <div class="kbmp-_inner_block">
                                            <?php if (!$_smarty_tpl->tpl_vars['kb_is_customer_logged']->value) {?>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',(bool)Configuration::get('PS_SSL_ENABLED'));?>
"  class="vss_active_link "><span class=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Write Review','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span></a>  
                                            <?php } else { ?>
                                                <a href="javascript:void(0)" class="vss_active_link vss_write_review_bck" data-toggle="kb-seller-new-review-popup" onclick="openSellerReviewPopup('kb-seller-new-review-popup', <?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['seller']->value['id_seller']), ENT_QUOTES, 'UTF-8');?>
);"><span class=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Write Review','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span></a>
                                            <?php }?>
                                        </div>
                                    <?php }?>
                                </div>
                            </div>
                                <?php }?>
                        </div>
                    </div>
                </article>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>           
        </div>
    </section>
</section>
<?php }
}
