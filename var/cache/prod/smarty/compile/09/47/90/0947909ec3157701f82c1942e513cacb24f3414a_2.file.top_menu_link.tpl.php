<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:12:49
  from '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/hook/top_menu_link.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60368911f1f460_50851129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0947909ec3157701f82c1942e513cacb24f3414a' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/modules/kbmarketplace/views/templates/hook/top_menu_link.tpl',
      1 => 1613588115,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60368911f1f460_50851129 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    var PS_ALLOW_ACCENTED_CHARS_URL = <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['PS_ALLOW_ACCENTED_CHARS_URL']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
    var alert_heading = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Alert','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
";
<?php echo '</script'; ?>
>
<?php if (isset($_smarty_tpl->tpl_vars['seller_account_menus']->value) && count($_smarty_tpl->tpl_vars['seller_account_menus']->value) > 0) {?>
<div id="seller-account-menus">
	<div class="language-selector-wrapper">
        <span class="hidden-md-up"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Seller Account','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
        <div class="language-selector seller_menu_selector dropdown js-dropdown">
          <span class="expand-more hidden-sm-down" data-toggle="dropdown"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Seller Account','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</span>
          <a data-target="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="hidden-sm-down">
            <i class="kb-material-icons expand-more">&#xE5C5;</i>
          </a>
          <ul class="dropdown-menu hidden-sm-down">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['seller_account_menus']->value, 'menu');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->value) {
?>
                <li>
                    <a title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['href'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"  class="dropdown-item">
                        <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                    </a>
                </li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </ul>
          <select class="link hidden-md-up">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['seller_account_menus']->value, 'menu');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->value) {
?>
              <option value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['href'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" ><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu']->value['label'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </select>
        </div>
    </div>
</div>
<?php }
if (isset($_smarty_tpl->tpl_vars['kb_mp_custom_js']->value) && $_smarty_tpl->tpl_vars['kb_mp_custom_js']->value != '') {?>
        <?php echo '<script'; ?>
 type='text/javascript'><?php echo $_smarty_tpl->tpl_vars['kb_mp_custom_js']->value;
echo '</script'; ?>
> 
<?php }
if (isset($_smarty_tpl->tpl_vars['kb_mp_custom_css']->value) && $_smarty_tpl->tpl_vars['kb_mp_custom_css']->value != '') {?>
    <style><?php echo $_smarty_tpl->tpl_vars['kb_mp_custom_css']->value;?>
</style> 
<?php }
}
}
