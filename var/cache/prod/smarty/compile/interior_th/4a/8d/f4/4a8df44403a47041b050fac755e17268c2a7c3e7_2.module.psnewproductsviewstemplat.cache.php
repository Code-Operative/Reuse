<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:51:23
  from 'module:psnewproductsviewstemplat' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6036921b12e918_58210483',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a8df44403a47041b050fac755e17268c2a7c3e7' => 
    array (
      0 => 'module:psnewproductsviewstemplat',
      1 => 1613650431,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/miniatures/product.tpl' => 1,
  ),
),false)) {
function content_6036921b12e918_58210483 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '7218493756036921b12b680_87919337';
?>

<section class="featured-products column-block clearfix">
  <p class="h6 text-uppercase">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'New products','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>

  </p>
  <div class="toggle-block">
    <div class="products-list">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
        <?php $_smarty_tpl->_subTemplateRender("file:catalog/_partials/miniatures/product.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
    <a class="all-product-link btn btn-primary" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['allNewProductsLink']->value, ENT_QUOTES, 'UTF-8');?>
">
      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All new products','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>

    </a>
  </div>
</section>

<?php }
}
