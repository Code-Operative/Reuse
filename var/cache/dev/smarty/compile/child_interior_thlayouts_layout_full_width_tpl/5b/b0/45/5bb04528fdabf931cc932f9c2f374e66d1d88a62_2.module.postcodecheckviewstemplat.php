<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-20 10:05:29
  from 'module:postcodecheckviewstemplat' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6055c8e9cec860_56445085',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5bb04528fdabf931cc932f9c2f374e66d1d88a62' => 
    array (
      0 => 'module:postcodecheckviewstemplat',
      1 => 1615627320,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6055c8e9cec860_56445085 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin /home/codeoperativeco/prestaoperative/modules/postcodecheck/views/templates/front/postcodecheck.tpl --><div id="postcodecheck" data-postcodecheck-controller-url="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['postcodecheck_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
	<form method="get" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['postcodecheck_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
		<input type="hidden" name="controller" value="search">
		<input type="text" name="s" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['postcode_string']->value, ENT_QUOTES, 'UTF-8');?>
">
		<button type="submit">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search','d'=>'Modules.Searchbar.Shop'),$_smarty_tpl ) );?>

		</button>
	</form>
</div>
<!-- end /home/codeoperativeco/prestaoperative/modules/postcodecheck/views/templates/front/postcodecheck.tpl --><?php }
}
