<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-28 11:01:55
  from 'module:pssearchbarpssearchbar.tp' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60b0bf938e8c95_14399989',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '110ec72aa9921d2c382ad628bdb2f0bc5105a617' => 
    array (
      0 => 'module:pssearchbarpssearchbar.tp',
      1 => 1619255004,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b0bf938e8c95_14399989 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin /home/codeoperativeco/public_html/themes/interior_th/modules/ps_searchbar/ps_searchbar.tpl --><!-- Block search module TOP -->
<div id="_desktop_search_bar">
    <div id="search_widget" class="search-bar search-widget dropdown js-dropdown" data-search-controller-url="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
        <span class="expand-more hidden-lg-up" data-toggle="dropdown" aria-expanded="false">
            <i class="material-icons search">&#xE8B6;</i>
        </span>
        <div class="dropdown-menu">
            <form class="search-bar__wrap" method="get" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_controller_url']->value, ENT_QUOTES, 'UTF-8');?>
">
                <input type="hidden" name="controller" value="search">
                <input class="search-bar__text" type="text" name="s" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search_string']->value, ENT_QUOTES, 'UTF-8');?>
" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search our catalog...','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
" aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
">
                <button class="search-bar__btn" type="submit">
                    <i class="material-icons search">&#xE8B6;</i>
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /Block search module TOP -->
<!-- end /home/codeoperativeco/public_html/themes/interior_th/modules/ps_searchbar/ps_searchbar.tpl --><?php }
}
