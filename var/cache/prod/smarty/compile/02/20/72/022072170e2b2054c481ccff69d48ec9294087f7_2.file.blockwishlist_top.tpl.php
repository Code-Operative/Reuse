<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-22 20:50:20
  from '/home/codeoperativeco/prestaoperative/themes/child_interior_th/modules/blockwishlist/blockwishlist_top.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60d23efcd8e386_61105413',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '022072170e2b2054c481ccff69d48ec9294087f7' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/child_interior_th/modules/blockwishlist/blockwishlist_top.tpl',
      1 => 1624304957,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60d23efcd8e386_61105413 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
var wishlistProductsIds='';
var baseDir ='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['content_dir']->value, ENT_QUOTES, 'UTF-8');?>
';
var static_token='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['static_token']->value, ENT_QUOTES, 'UTF-8');?>
';
var isLogged ='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['isLogged']->value, ENT_QUOTES, 'UTF-8');?>
';
var loggin_required='<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You must be logged in to manage your wishlist.','d'=>'Modules.Blockwishlist.Shop','js'=>1),$_smarty_tpl ) );
$_prefixVariable1 = ob_get_clean();
echo htmlspecialchars(trim($_prefixVariable1), ENT_QUOTES, 'UTF-8');?>
';
var added_to_wishlist ='<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The product was successfully added to your wishlist.','d'=>'Modules.Blockwishlist.Shop','js'=>1),$_smarty_tpl ) );
$_prefixVariable2 = ob_get_clean();
echo htmlspecialchars(trim($_prefixVariable2), ENT_QUOTES, 'UTF-8');?>
';
var mywishlist_url='<?php ob_start();
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('blockwishlist','mywishlist',array(),true),'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');
$_prefixVariable3 = ob_get_clean();
echo htmlspecialchars(trim($_prefixVariable3), ENT_QUOTES, 'UTF-8');?>
';
<?php if (isset($_smarty_tpl->tpl_vars['isLogged']->value) && $_smarty_tpl->tpl_vars['isLogged']->value) {?>
	var isLoggedWishlist=true;
<?php } else { ?>
	var isLoggedWishlist=false;
<?php }
echo '</script'; ?>
>
<?php }
}
