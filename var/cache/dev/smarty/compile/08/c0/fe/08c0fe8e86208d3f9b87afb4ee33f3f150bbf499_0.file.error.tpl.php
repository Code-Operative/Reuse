<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-15 16:51:27
  from '/home/codeoperativeco/prestaoperative/admin4047wicsx/themes/new-theme/template/error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604f908f892ea9_91394910',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08c0fe8e86208d3f9b87afb4ee33f3f150bbf499' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/admin4047wicsx/themes/new-theme/template/error.tpl',
      1 => 1613587126,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604f908f892ea9_91394910 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['php_errors']->value) && count($_smarty_tpl->tpl_vars['php_errors']->value)) {?>
<div class="bootstrap">
	<div id="error-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="alert alert-danger clearfix">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['php_errors']->value, 'php_error');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['php_error']->value) {
?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%1$s on line %2$s in file %3$s','sprintf'=>array(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['php_error']->value['type'] )),call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['php_error']->value['errline'] )),call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['php_error']->value['errfile'] ))),'d'=>'Admin.Notifications.Error'),$_smarty_tpl ) );?>
<br />
					[<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['php_error']->value['errno'] ));?>
] <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['php_error']->value['errstr'] ));?>
<br /><br />
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<button type="button" class="btn btn-default float-right" data-dismiss="modal"><i class="icon-remove"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close','d'=>'Admin.Actions'),$_smarty_tpl ) );?>
</button>
			</div>
		</div>
	</div>
</div>
<?php }
}
}
