<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-13 17:41:08
  from '/home/codeoperativeco/prestaoperative/themes/child_interior_th/modules/blockwishlist/blockwishlist_button.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604cf9348c02b1_53373522',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9fcf6bdb3ca5ca2baf6d8e7a3ccdf545ced80cb' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/child_interior_th/modules/blockwishlist/blockwishlist_button.tpl',
      1 => 1615369681,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604cf9348c02b1_53373522 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['wishlists']->value) && (null != $_smarty_tpl->tpl_vars['wishlists']->value && count($_smarty_tpl->tpl_vars['wishlists']->value) > 1)) {?>
    <div class="wishlist product-item-wishlist js-dropdown dropup">
        <a href="#" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to wishlist','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
" class="addToWishlist" data-toggle="dropdown" onclick="return false;">
            <i class="font-heart"></i>
            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to wishlist','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
        </a>
        <ul class="dropdown-menu">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['wishlists']->value, 'wishlist', false, NULL, 'wl', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['wishlist']->value) {
?>
                <li class="dropdown-item" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wishlist']->value['name'], ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wishlist']->value['id_wishlist'], ENT_QUOTES, 'UTF-8');?>
" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8');?>
', false, 1, '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wishlist']->value['id_wishlist'], ENT_QUOTES, 'UTF-8');?>
');">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to %s','sprintf'=>array($_smarty_tpl->tpl_vars['wishlist']->value['name']),'d'=>'Modules.Blockwishlist.Shop'),$_smarty_tpl ) );?>

                </li>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
<?php } else { ?>
<div class="wishlist product-item-wishlist">
	<a class="addToWishlist wishlistProd_<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8');?>
" href="#" rel="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8');?>
" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8');?>
', false, 1); return false;" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to wishlist','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
">
        <i class="font-heart"></i>
        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to wishlist','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
	</a>
</div>
<?php }
}
}
