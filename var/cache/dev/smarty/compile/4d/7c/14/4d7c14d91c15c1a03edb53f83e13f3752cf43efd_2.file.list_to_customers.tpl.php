<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 19:52:18
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/list_to_customers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608b00627d97b5_13500851',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d7c14d91c15c1a03edb53f83e13f3752cf43efd' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/list_to_customers.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./seller_list.tpl' => 1,
  ),
),false)) {
function content_608b00627d97b5_13500851 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    <?php if (isset($_smarty_tpl->tpl_vars['is_favourite_seller_page']->value) && $_smarty_tpl->tpl_vars['is_favourite_seller_page']->value == 1) {?>
        var is_favourite_seller_page = "1";
        <?php } else { ?>
            var is_favourite_seller_page = "0";
    <?php }
echo '</script'; ?>
>
<?php if (isset($_smarty_tpl->tpl_vars['sellers']->value) && count($_smarty_tpl->tpl_vars['sellers']->value) > 0) {?>
    <h1 class="page-heading">
        <span clas="cat-name"><?php if (isset($_smarty_tpl->tpl_vars['is_favourite_seller_page']->value) && $_smarty_tpl->tpl_vars['is_favourite_seller_page']->value == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My Favourite Sellers','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
 <?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sellers','mod'=>'kbmarketplace'),$_smarty_tpl ) );
}?></span>
        <div class="clearfix"></div>
    </h1>

    <div class="row products-selection">
        <div class="col-lg-3 hidden-md-down total-products">
            <p><?php echo $_smarty_tpl->tpl_vars['pagination_string']->value;?>
</p>  
        </div>
        <div class="col-lg-5 col-md-6">
            <div class="row">
                <span class="col-sm-3 col-md-3 hidden-sm-down sort-by"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sort by','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
:</span>
                <div class="col-sm-7 col-xs-6 col-md-7">
                    <select id="selectProductSort" class="selectSellerSort form-control">
                        <option value="" selected="selected">--</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sorting_types']->value, 'sort');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sort']->value) {
?>
                            <option value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['sort']->value['value'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['sort']->value['value'] == $_smarty_tpl->tpl_vars['selected_sort']->value) {?> selected="selected"<?php }?> ><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['sort']->value['label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
            </div>
        </div>
        <?php if (isset($_smarty_tpl->tpl_vars['kb_pagination']->value['pagination']) && $_smarty_tpl->tpl_vars['kb_pagination']->value['pagination'] != '') {?>
            <div id="front-end-customer-pagination" class="top-pagination-content clearfix">
                <div class="sv-p-paging">
                    <?php echo $_smarty_tpl->tpl_vars['kb_pagination']->value['pagination'];?>
  
                    <div class='clearfix'></div>
                </div>
            </div>
        <?php }?>        
    </div>
    <div class="clearfix"></div>
        <img id="kb-list-loader" src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['kb_image_path']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
loader128.gif" />

    <div class='kbmp-_block'>

    </div>
    <div id="seller_list_to_customers">
        <?php $_smarty_tpl->_subTemplateRender("file:./seller_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
    <?php echo '<script'; ?>
 type="text/javascript">
        var kb_page_start = <?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['kb_pagination']->value['page_position']), ENT_QUOTES, 'UTF-8');?>
;
    <?php echo '</script'; ?>
>
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
                    <form id="slr-review-form" action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink($_smarty_tpl->tpl_vars['kb_module_name']->value,'sellerfront',array(),(bool)Configuration::get('PS_SSL_ENABLED'));?>
" method="post">  
                        <input type="hidden" name="id_seller" value="0" />
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
<?php } else { ?>
    <h1 class="page-heading" style='border:0;'>
        <span clas="cat-name"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['empty_list']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
        <div class="clearfix"></div>
    </h1>
<?php }
echo '<script'; ?>
>
        var ajaxurl = "<?php echo $_smarty_tpl->tpl_vars['ajaxurl']->value;?>
";         var sfl_shortlist_text= "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mark Seller as Favourite','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
        var sfl_already_added_text= "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Favourite Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
    <?php echo '</script'; ?>
>
<?php }
}
