<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-15 00:33:35
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/templates/catalog/_partials/custom/add-to-cart-product-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604eab5f734e57_08985753',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bfbd2a4cfcdfec3a184b72006d1c477dfa608a72' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/templates/catalog/_partials/custom/add-to-cart-product-list.tpl',
      1 => 1613650431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604eab5f734e57_08985753 (Smarty_Internal_Template $_smarty_tpl) {
?>

	<form action="" method="post" class="add-to-cart-or-refresh">
		<div class="product-quantity" style="display:none;">
			<input type="hidden" name="token" class="token-product-list" value="">
	        <input type="hidden" name="id_product" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
" class="product_page_product_id">
	        <input type="hidden" name="id_customization" value="0" class="product_customization_id">
	        <input type="hidden" name="qty" value="1" class="input-group"  min="1"  />
		</div>
	     <a href="javascript:void(0);" name-module="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name_module']->value, ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name_module']->value, ENT_QUOTES, 'UTF-8');?>
-cart-id-product-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
" id_product_atrr="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
" class="btn btn-primary add-cart<?php if (!$_smarty_tpl->tpl_vars['product']->value['add_to_cart_url']) {?> disabled<?php }?>" data-button-action="add-to-cart">
			<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to cart','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
		 </a>
	</form>

<?php }
}
