<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 19:52:47
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/seller_view_to_customer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608b007f30cb77_21440277',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '36ec17c04c2b48e43291c2255c41318c305878d9' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/seller_view_to_customer.tpl',
      1 => 1619552658,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/miniatures/product.tpl' => 1,
  ),
),false)) {
function content_608b007f30cb77_21440277 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div>
    <div class="kb-block seller_profile_view">
        <div class="s-vp-banner">
            <img src="<?php echo $_smarty_tpl->tpl_vars['seller']->value['banner'];?>
" /> 
        </div>
        <div class="info-view">
            <div class="seller-profile-photo">
                <a href="<?php echo KbGlobal::getSellerLink($_smarty_tpl->tpl_vars['seller']->value['id_seller']);?>
" > 
                    <img src="<?php echo $_smarty_tpl->tpl_vars['seller']->value['logo'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['title'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['title'], ENT_QUOTES, 'UTF-8');?>
"> 
                </a>
            </div>
            <div class="seller-info">
                <div class="seller-basic">
                    <div class="seller-name">
                        <span class="name">
                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['title'], ENT_QUOTES, 'UTF-8');?>

                        </span>
                                                                                <?php if (isset($_smarty_tpl->tpl_vars['is_enabled_seller_shortlisting']->value) && $_smarty_tpl->tpl_vars['is_enabled_seller_shortlisting']->value == 1) {?>
                            <div class="seller-rating-block">
                                <div class="kbmp-_inner_block"><i class="kb-material-icons shortlist_link" style="<?php if (isset($_smarty_tpl->tpl_vars['is_already_added']->value) && $_smarty_tpl->tpl_vars['is_already_added']->value == 1) {?>color: #ef4545;<?php } else { ?>color:grey;<?php }?>">&#xe87d;</i></div>
                                <div class="kbmp-_inner_block" style="position:relative;">
                                    <div class="vss_seller_ratings">
                                        <!-- Do not customise it -->
                                        <a href="javascript:addShortListSeller(this, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['id_seller'], ENT_QUOTES, 'UTF-8');?>
);" class="sfl_product_link_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['id_seller'], ENT_QUOTES, 'UTF-8');?>
" style="padding-left:7px;font-size:13px;color: #2fb5d2;"><?php if (isset($_smarty_tpl->tpl_vars['is_already_added']->value) && $_smarty_tpl->tpl_vars['is_already_added']->value == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Favourite Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mark Seller as Favourite','mod'=>'kbmarketplace'),$_smarty_tpl ) );
}?></a>
                                        <!-- Set only width in percentage according to rating -->
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                                                
                                            <div class="seller-rating-block">
                            <?php if (!isset($_smarty_tpl->tpl_vars['seller']->value['is_review_page'])) {?>
                                <div class="kbmp-_inner_block" style="position:relative;">
                                    <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink($_smarty_tpl->tpl_vars['kb_module_name']->value,'sellerfront',array('render_type'=>'sellerreviews','id_seller'=>$_smarty_tpl->tpl_vars['seller']->value['id_seller']),(bool)Configuration::get('PS_SSL_ENABLED')),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['seller_review_count'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                        <div class="vss_seller_ratings">
                                            <!-- Do not customise it -->
                                            <div class="vss_rating_unfilled">★★★★★</div>

                                            <!-- Set only width in percentage according to rating -->
                                            <div class="vss_rating_filled" style="width:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['seller_rating'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%">★★★★★</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="kbmp-_inner_block"><a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink($_smarty_tpl->tpl_vars['kb_module_name']->value,'sellerfront',array('render_type'=>'sellerreviews','id_seller'=>$_smarty_tpl->tpl_vars['seller']->value['id_seller']),(bool)Configuration::get('PS_SSL_ENABLED')),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="vss_active_link vss_read_review_bck"><span class=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View Reviews','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span></a></div>
                                <?php if ($_smarty_tpl->tpl_vars['display_new_review']->value) {?>
                                    <div class="kbmp-_inner_block">
                                        <?php if (!$_smarty_tpl->tpl_vars['kb_is_customer_logged']->value) {?>
                                            <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',(bool)Configuration::get('PS_SSL_ENABLED')),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="vss_active_link"><span class=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Write Review','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span></a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)" class="vss_active_link vss_write_review_bck" data-toggle="kb-seller-new-review-popup" onclick="openSellerReviewPopup('kb-seller-new-review-popup', false);"><span class=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Write Review','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span></a>
                                        <?php }?>
                                    </div>
                                <?php }?>
                            <?php } else { ?>
                                <div class="kbmp-_inner_block"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Overall Rating','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
: </strong></div>
                                <div class="kbmp-_inner_block" style="position:relative;">
                                    <div class="vss_seller_ratings">
                                        <!-- Do not customise it -->
                                        <div class="vss_rating_unfilled">★★★★★</div>

                                        <!-- Set only width in percentage according to rating -->
                                        <div class="vss_rating_filled" style="width:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['seller']->value['seller_rating'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
%">★★★★★</div>
                                    </div>
                                </div>
                            <?php }?>        
                        </div>
                    </div>
                    
                    <div class="seller-social">
                        <?php if (!empty($_smarty_tpl->tpl_vars['seller']->value['twit_link'])) {?>
                            <a title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Twitter','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" href="<?php echo $_smarty_tpl->tpl_vars['seller']->value['twit_link'];?>
" class="btn-sm btn-primary social-btn twitter" ></a> 
                        <?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['seller']->value['fb_link'])) {?>
                            <a title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Facebook','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" href="<?php echo $_smarty_tpl->tpl_vars['seller']->value['fb_link'];?>
" class="btn-sm btn-primary social-btn facebook"></a> 
                        <?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['seller']->value['gplus_link'])) {?>
                            <a title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Google+','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" href="<?php echo $_smarty_tpl->tpl_vars['seller']->value['gplus_link'];?>
" class="btn-sm btn-primary social-btn googleplus"></a> 
                        <?php }?>       
                    </div>
                    
                </div>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['gdpr_enabled']->value) {?>
                <div class="seller-customer-info-block">
                    <div class="seller-basic">
                        <button data-toggle="modal" data-target="#kb-seller-access-data-popup"  class="btn btn-success kb-open-mp-access-popup"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Request to Access Personal Data','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</button>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['gdpr_enabled']->value) {?>
        <div id="kb-seller-access-data-popup">
            <div class="kb-popup-content">
                <h4 class="page-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Request to Access Personal Data','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h4>
                <p class="kb-page-subheading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can request to the seller to provide the report of your personal data they have store by entering the email Id.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</p>
                <form class="kb_mp_personal_access_form" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_form_action']->value, ENT_QUOTES, 'UTF-8');?>
" method="post">
                    <div class="form-group">
                        <label for="email"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email Address','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</label>
                        <input type="hidden" name="id_seller" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['seller']->value['id_seller'], ENT_QUOTES, 'UTF-8');?>
">
                        <input type="text" class="form-control" id="kb_access_email" name="kb_access_email" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter email address','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
" value="">
                    </div>
                    <div class="kb-popup-btn-block">
                        <button type="submit" class="btn btn-danger submit-mp-personal-access" name="submitMPPersonalAccess" onclick="return submitKbMPAccessInfo()" value="1"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Submit','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</button>
                    </div>
                </form>
            </div>
        </div>
    <?php }?>
        <?php echo '<script'; ?>
 type="text/javascript">
                var kb_empty_field = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Field cannot be empty.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
                var kb_email_valid = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email is not valid.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
                var seller_front_url = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_form_action']->value, ENT_QUOTES, 'UTF-8');?>
";
                var kb_email_not_exit= "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email Address is not associated with any account.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
            <?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
>
            var ajaxurl = "<?php echo $_smarty_tpl->tpl_vars['ajaxurl']->value;?>
";             var sfl_shortlist_text= "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mark Seller as Favourite','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
            var sfl_already_added_text= "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Favourite Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        <?php echo '</script'; ?>
>
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbSellerView",'id_seller'=>$_smarty_tpl->tpl_vars['seller']->value['id_seller'],'area'=>"beforeProduct"),$_smarty_tpl ) );?>

    <div class="slr-f-box">
        <h3 class="s-p-filter">
            <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_form_action']->value, ENT_QUOTES, 'UTF-8');?>
" method="post" id="seller_products_form">
            <ul>
                <li class="heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Filter your search','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
: </li>
                <?php if (isset($_smarty_tpl->tpl_vars['category_list']->value) && count($_smarty_tpl->tpl_vars['category_list']->value) > 0) {?>
                <li>
                    <select name="s_filter_category" onchange="$('#seller_product_pagination_var').val(0);$('#seller_products_form').submit();">
                        <option value=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Category','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category_list']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                            <option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['cat']->value['id_category']), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['selected_category']->value == $_smarty_tpl->tpl_vars['cat']->value['id_category']) {?>selected="selected"<?php }?> ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cat']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </li>
                <?php }?>
                <li>
                    <select name="s_filter_sortby" onchange="$('#seller_product_pagination_var').val(0);$('#seller_products_form').submit();">
                        <option value=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sort By','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="pl.name:ASC" <?php if ($_smarty_tpl->tpl_vars['selected_sort']->value == 'pl.name:ASC') {?>selected="selected"<?php }?> ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name (A - Z)','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="pl.name:DESC" <?php if ($_smarty_tpl->tpl_vars['selected_sort']->value == 'pl.name:DESC') {?>selected="selected"<?php }?> ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name (Z - A)','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="p.price:ASC" <?php if ($_smarty_tpl->tpl_vars['selected_sort']->value == 'p.price:ASC') {?>selected="selected"<?php }?> ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price(low to high)','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="p.price:DESC" <?php if ($_smarty_tpl->tpl_vars['selected_sort']->value == 'p.price:DESC') {?>selected="selected"<?php }?> ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price(high to low)','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                    </select>
                </li>
            </ul>
            <input type="hidden" name="page_number" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['seller_product_current_page']->value), ENT_QUOTES, 'UTF-8');?>
" id="seller_product_pagination_var"/>
            </form>
            <?php if (isset($_smarty_tpl->tpl_vars['pagination_string']->value)) {?><div id="svp-p-count" class="svp-p-count"><?php echo $_smarty_tpl->tpl_vars['pagination_string']->value;?>
</div><?php }?> 
            <div class="clearfix"></div>
        </h3>
        <?php if (isset($_smarty_tpl->tpl_vars['pagination']->value) && $_smarty_tpl->tpl_vars['pagination']->value != '') {?>
        <div class="sv-p-paging">
            <?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>
 
            <div class='clearfix'></div>
        </div>
        <?php }?>
        <div id="seller_products_to_customer" class="slr-content">
            <?php if (count($_smarty_tpl->tpl_vars['products']->value) > 0) {?>
                <section id="main">
                    <section id="products">
                        <div class="products row">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1317625919608b007f2d24b1_08008578', 'product_miniature');
?>

                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>            
                        </div>
                    </section>
                </section>
            <?php } else { ?>
                <div class="alert alert-warning">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No product is available for sale from this seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                </div>
            <?php }?>
        </div>
        <?php if (isset($_smarty_tpl->tpl_vars['kb_pagination']->value['pagination']) && $_smarty_tpl->tpl_vars['kb_pagination']->value['pagination'] != '') {?>
        <div class="sv-p-paging" style='padding-bottom:0;'>
            <?php echo $_smarty_tpl->tpl_vars['kb_pagination']->value['pagination'];?>
  
            <div class='clearfix'></div>
        </div>
        <?php }?>
    </div>
        <?php if (isset($_smarty_tpl->tpl_vars['display_review_popup']->value) && $_smarty_tpl->tpl_vars['display_review_popup']->value) {?>
        <div id="kb-seller-new-review-popup" class="modal fade quickview kbpopup-modal" tabindex="-1" role="dialog" style="display:none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Write a review','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="slr-review-form" action="<?php echo KbGlobal::getSellerLink($_smarty_tpl->tpl_vars['seller']->value['id_seller']);?>
" method="post"> 
                            <input type="hidden" name="new_review_submit" value="1" />
                            <ul>
                                <li>
                                    <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rate this Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
:</label>
                                    <div id="seller_new_review_rating_block"></div>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>
                            <label for="review_title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Title','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
: <sup class="required">*</sup></label>
                            <div class="kb-form-label-block">
                                <input id="review_title" name="review_title" type="text" value="" class="required">
                            </div>
                            <label for="review_content"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Comment','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
: <sup class="required">*</sup></label>
                            <div class="kb-form-label-block">
                                <textarea id="review_content" name="review_content" class="required"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <p class="fl required"><sup>*</sup> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Required fields','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</p>
                        <p class="fr">
                            <button id="submitSellerReview" type="button" class="btn button button-small" <?php if ($_smarty_tpl->tpl_vars['kb_is_customer_logged']->value) {?>onclick="submitSellerNewReview()"<?php } else { ?>onclick="location.href='<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
'"<?php }?>>
                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Submit','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
                            </button>
                        </p>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
    <?php if (!isset($_smarty_tpl->tpl_vars['seller']->value['is_review_page'])) {?>
        <?php if (!empty($_smarty_tpl->tpl_vars['seller']->value['description'])) {?>
            <section class="slr-f-box">
                <h3 class="page-product-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'About Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h3>
                <div  class="rte slr-content">
                    <?php echo $_smarty_tpl->tpl_vars['seller']->value['description'];?>
  
                </div>
            </section>
            <?php }?>
            <section class="slr-f-box">
                <h3 class="page-product-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy Policy','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h3>
                <div  class="rte slr-content">
                    <?php if (!empty($_smarty_tpl->tpl_vars['seller']->value['privacy_policy'])) {?>
                        <?php echo $_smarty_tpl->tpl_vars['seller']->value['privacy_policy'];?>
                    <?php } else { ?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No Privacy Policy Provided by Seller Yet.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                    <?php }?>

                </div>
            </section>
            <section class="slr-f-box">
                <h3 class="page-product-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Return Policy','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h3>
                <div  class="rte slr-content">
                    <?php if (!empty($_smarty_tpl->tpl_vars['seller']->value['return_policy'])) {?>
                        <?php echo $_smarty_tpl->tpl_vars['seller']->value['return_policy'];?>
  
                    <?php } else { ?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No Return Policy Provided by Seller Yet.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                    <?php }?>

                </div>
            </section>
            <section class="slr-f-box">
                <h3 class="page-product-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shipping Policy','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h3>
                <div  class="rte slr-content">
                    <?php if (!empty($_smarty_tpl->tpl_vars['seller']->value['shipping_policy'])) {?>
                        <?php echo $_smarty_tpl->tpl_vars['seller']->value['shipping_policy'];?>
 
                    <?php } else { ?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No Shipping Policy Provided by Seller Yet.','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                    <?php }?>

                </div>
            </section>
                        <?php if (is_array($_smarty_tpl->tpl_vars['kb_available_field']->value) && !empty($_smarty_tpl->tpl_vars['kb_available_field']->value)) {?>
                <section class="slr-f-box">
                <h3 class="page-product-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Additional Information','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</h3>
                <div  class="rte slr-content">
                    <ul class="kb-form-list">
                        <?php $_smarty_tpl->_assignInScope('indexRow', 0);?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kb_available_field']->value, 'kbfield', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['kbfield']->value) {
?>
                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['show_seller_profile']) && $_smarty_tpl->tpl_vars['kbfield']->value['show_seller_profile'] == 1) {?>
                                <li class="<?php if ($_smarty_tpl->tpl_vars['indexRow']->value%2 == 0) {?>kb-form-l<?php } else { ?>kb-form-r<?php }?>">
                                    <div class="kb-form-label-block">
                                        <strong class="kblabel"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 : </strong>
                                        <?php if (($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'select') || ($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'radio') || ($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'checkbox')) {?>
                                            <?php if ($_smarty_tpl->tpl_vars['kbfield']->value['value'] != '') {?>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['value'],1 )), 'field_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field_value']->value) {
?>
                                                    <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                        <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                            <?php if (in_array($_smarty_tpl->tpl_vars['field_value']->value['option_value'],call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 )))) {?>
                                                                <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field_value']->value['option_label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</br>
                                                            <?php }?>
                                                            <?php } else { ?>
                                                                <?php if ($_smarty_tpl->tpl_vars['field_value']->value['option_value'] == call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) {?>
                                                                    <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field_value']->value['option_label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</br>
                                                                <?php }?>
                                                        <?php }?>
                                                    <?php }?>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            <?php }?>
                                            <?php } elseif ($_smarty_tpl->tpl_vars['kbfield']->value['type'] == 'file') {?>
                                                <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                    <?php if (is_array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_decode' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],1 ))) && $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'] != '') {?> 
                                                        <a href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module_path']->value,'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&id_field=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['id_field'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&id_seller=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['id_seller']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download File','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
                                                    <?php }?>
                                                <?php } else { ?>
                                                    -
                                            <?php }?>
                                            <?php } else { ?>
                                            <?php if (isset($_smarty_tpl->tpl_vars['kbfield']->value['customer_value'])) {?>
                                                <?php echo htmlspecialchars(nl2br(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['kbfield']->value['customer_value'],'htmlall','UTF-8' ))), ENT_QUOTES, 'UTF-8');?>

                                            <?php } else { ?>
                                                -
                                            <?php }?>
                                            <?php }?>
                                    </div>
                                </li>
                                <?php $_smarty_tpl->_assignInScope('indexRow', $_smarty_tpl->tpl_vars['indexRow']->value+1);?>
                            <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ul>
                    </div>
            </section>
            <?php }?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbSellerView",'id_seller'=>$_smarty_tpl->tpl_vars['seller']->value['id_seller'],'area'=>"profile"),$_smarty_tpl ) );?>

        <?php } else { ?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbSellerView",'id_seller'=>$_smarty_tpl->tpl_vars['seller']->value['id_seller'],'area'=>"review"),$_smarty_tpl ) );?>

    <?php }?>
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayKbSellerView",'id_seller'=>$_smarty_tpl->tpl_vars['seller']->value['id_seller'],'area'=>"afterProduct"),$_smarty_tpl ) );?>

</div>
<?php }
/* {block 'product_miniature'} */
class Block_1317625919608b007f2d24b1_08008578 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_miniature' => 
  array (
    0 => 'Block_1317625919608b007f2d24b1_08008578',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                  <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/miniatures/product.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>
                                <?php
}
}
/* {/block 'product_miniature'} */
}
