<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-28 21:17:47
  from '/home/codeoperativeco/public_html/themes/child_interior_th/modules/blockwishlist/blockwishlist-extra.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6089c2eb180cb3_43562434',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'de33f19abfa9e26661599b0857491dafa1a4da45' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/child_interior_th/modules/blockwishlist/blockwishlist-extra.tpl',
      1 => 1619255005,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6089c2eb180cb3_43562434 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['wishlists']->value) && (null != $_smarty_tpl->tpl_vars['wishlists']->value && count($_smarty_tpl->tpl_vars['wishlists']->value) > 1)) {?>
    <div class="panel-product-actions">
    	<div id="wishlist_button">
    		<button class="wishlist_button_extra wishlist-btn" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['id_product']->value), ENT_QUOTES, 'UTF-8');?>
', $('#idCombination').val(), document.getElementById('quantity_wanted').value, $('#idWishlist').val()); return false;"  title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to wishlist','d'=>'Modules.Blockwishlist.Shop'),$_smarty_tpl ) );?>
">
    			<i class="font-heart"></i>
                    		</button>
            <select id="idWishlist">
    			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['wishlists']->value, 'wishlist');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['wishlist']->value) {
?>
    				<option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wishlist']->value['id_wishlist'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wishlist']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
    			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    		</select>
    	</div>
    </div>
<?php } else { ?>
    <div class="panel-product-actions">
    	<a id="wishlist_button" class="wishlist-btn" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['id_product']->value), ENT_QUOTES, 'UTF-8');?>
', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" rel="nofollow"  title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to my wishlist','d'=>'Modules.Blockwishlist.Shop'),$_smarty_tpl ) );?>
">
    		<i class="font-heart"></i>
                	</a>
    </div>
<?php }
}
}
