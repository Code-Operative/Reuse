<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-28 10:59:45
  from '/home/codeoperativeco/public_html/themes/child_interior_th/modules/blockwishlist/my-account.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60b0bf11a17c63_96992770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f214e64f119617eb2a80c6a842cb3183cdd09751' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/child_interior_th/modules/blockwishlist/my-account.tpl',
      1 => 1619255005,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b0bf11a17c63_96992770 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- MODULE WishList -->
	<a class="lnk_wishlist col-lg-4 col-md-6 col-sm-6 col-xs-12" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('blockwishlist','mywishlist',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My wishlists','d'=>'Modules.Blockwishlist.Shop'),$_smarty_tpl ) );?>
">
		<span class="link-item">
            <i class="material-icons">&#xE87D;</i>
    		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My wishlists','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>

        </span>
	</a>
<!-- END : MODULE WishList --><?php }
}
