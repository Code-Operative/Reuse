<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-18 10:39:37
  from '/home/codeoperativeco/public_html/admin4047wicsx/themes/new-theme/template/components/layout/shop_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cc69d950c623_71451820',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'abd60fd7575341ca8797851ed4001f03bf2de8e1' => 
    array (
      0 => '/home/codeoperativeco/public_html/admin4047wicsx/themes/new-theme/template/components/layout/shop_list.tpl',
      1 => 1619254977,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60cc69d950c623_71451820 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['is_multishop']->value) && $_smarty_tpl->tpl_vars['is_multishop']->value && $_smarty_tpl->tpl_vars['shop_list']->value && (isset($_smarty_tpl->tpl_vars['multishop_context']->value) && $_smarty_tpl->tpl_vars['multishop_context']->value&Shop::CONTEXT_GROUP || $_smarty_tpl->tpl_vars['multishop_context']->value&Shop::CONTEXT_SHOP || $_smarty_tpl->tpl_vars['multishop_context']->value&Shop::CONTEXT_ALL)) {?>
  <div id="shop-list" class="shop-list dropdown ps-dropdown stores">
    <button class="btn btn-link" type="button" data-toggle="dropdown">
      <span class="selected-item">
        <i class="material-icons visibility">visibility</i>
        <?php if (!isset($_smarty_tpl->tpl_vars['current_shop_name']->value) || $_smarty_tpl->tpl_vars['current_shop_name']->value == '') {?>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All shops','d'=>'Admin.Global'),$_smarty_tpl ) );?>

        <?php } else { ?>
          <?php echo $_smarty_tpl->tpl_vars['current_shop_name']->value;?>

        <?php }?>
        <i class="material-icons arrow-down">arrow_drop_down</i>
      </span>
    </button>
    <div class="dropdown-menu dropdown-menu-right ps-dropdown-menu">
      <?php echo $_smarty_tpl->tpl_vars['shop_list']->value;?>

    </div>
  </div>
<?php } else { ?>
  <div class="shop-list">
    <a class="link" id="header_shopname" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['base_url']->value,'html','UTF-8' ));?>
" target= "_blank">
      <i class="material-icons">visibility</i>
      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View my shop','d'=>'Admin.Navigation.Header'),$_smarty_tpl ) );?>

    </a>
  </div>
<?php }
}
}
