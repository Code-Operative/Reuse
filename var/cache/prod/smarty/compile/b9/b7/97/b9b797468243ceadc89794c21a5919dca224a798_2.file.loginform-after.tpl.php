<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-18 02:31:35
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/hook/loginform-after.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cbf7772e0a59_88800858',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b9b797468243ceadc89794c21a5919dca224a798' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/hook/loginform-after.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60cbf7772e0a59_88800858 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="no-account">
    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link_to_register']->value, ENT_QUOTES, 'UTF-8');?>
" >
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click here to Register as a Seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

    </a>
    </br>
    <a href="#"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Or','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</a>
</div>



<?php }
}
