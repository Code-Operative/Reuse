<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:12:50
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/homeonsaletab/views/templates/hook/homeonsaletab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_603689123ee474_80167267',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54bc8a5b7b23920f8b1929bf56be3a9de10b085a' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/homeonsaletab/views/templates/hook/homeonsaletab.tpl',
      1 => 1613650431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/miniatures/product.tpl' => 1,
  ),
),false)) {
function content_603689123ee474_80167267 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="<?php if ($_smarty_tpl->tpl_vars['carousel_tabs']->value == 'true') {?>tab-pane fade<?php } else { ?>none-in-tabs<?php }
if ($_smarty_tpl->tpl_vars['carousel_active']->value == 'true' && $_smarty_tpl->tpl_vars['carousel_arrows']->value == 'true') {?> nav-active<?php }?>"<?php if ($_smarty_tpl->tpl_vars['carousel_tabs']->value == 'true') {?> id="homeonsaletab"<?php }?>>
    <div class="container">
        <?php if ($_smarty_tpl->tpl_vars['carousel_tabs']->value != 'true') {?>
            <p class="headline-section products-title"><strong><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['homeonsaletab_category_name']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</strong></p>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
            <div class="products grid row<?php if ($_smarty_tpl->tpl_vars['carousel_active']->value == 'true') {?> view-carousel js-carousel-sale<?php } else { ?> view-grid xlarge-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_col']->value, ENT_QUOTES, 'UTF-8');?>
 large-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_col_1200']->value, ENT_QUOTES, 'UTF-8');?>
 medium-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_col_992']->value, ENT_QUOTES, 'UTF-8');?>
 small-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_col_769']->value, ENT_QUOTES, 'UTF-8');?>
 xsmall-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_col_576']->value, ENT_QUOTES, 'UTF-8');
}?>"<?php if ($_smarty_tpl->tpl_vars['carousel_active']->value == 'true') {?> data-carousel=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_active']->value, ENT_QUOTES, 'UTF-8');?>
 data-autoplay="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_autoplay']->value, ENT_QUOTES, 'UTF-8');?>
" data-speed="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_speed']->value, ENT_QUOTES, 'UTF-8');?>
" data-pag="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_pag']->value, ENT_QUOTES, 'UTF-8');?>
" data-arrows="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_arrows']->value, ENT_QUOTES, 'UTF-8');?>
" data-loop="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_loop']->value, ENT_QUOTES, 'UTF-8');?>
" data-rows="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_rows']->value, ENT_QUOTES, 'UTF-8');?>
" data-col="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_col']->value, ENT_QUOTES, 'UTF-8');?>
" data-col_1200="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_col_1200']->value, ENT_QUOTES, 'UTF-8');?>
" data-col_992="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_col_992']->value, ENT_QUOTES, 'UTF-8');?>
" data-col_769="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_col_769']->value, ENT_QUOTES, 'UTF-8');?>
" data-col_576="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carousel_col_576']->value, ENT_QUOTES, 'UTF-8');?>
"<?php }?>>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product', false, NULL, 'products', array (
  'first' => true,
  'iteration' => true,
  'last' => true,
  'index' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['index'];
$_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['total'];
?>
                 <?php if ($_smarty_tpl->tpl_vars['carousel_active']->value == 'true' && $_smarty_tpl->tpl_vars['carousel_rows']->value > 1 && (isset($_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['first'] : null)) {?>                     <div class="wrapper-item fist">
                 <?php }?>
                <?php $_smarty_tpl->_subTemplateRender("file:catalog/_partials/miniatures/product.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>
                 <?php if ($_smarty_tpl->tpl_vars['carousel_active']->value == 'true' && $_smarty_tpl->tpl_vars['carousel_rows']->value > 1 && !((isset($_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration'] : null) % $_smarty_tpl->tpl_vars['carousel_rows']->value)) {?>                    <?php if ($_smarty_tpl->tpl_vars['carousel_active']->value == 'true' && $_smarty_tpl->tpl_vars['carousel_rows']->value > 1 && !(isset($_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['last'] : null)) {?>                         </div><div class="wrapper-item">
                    <?php }?>
                <?php }?>
                 <?php if ($_smarty_tpl->tpl_vars['carousel_active']->value == 'true' && $_smarty_tpl->tpl_vars['carousel_rows']->value > 1 && (isset($_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['last'] : null)) {?>                    </div>
                 <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        <?php } else { ?>
             <div class="col-md-12">
                 <div class="alert alert-warning">
                     <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No products with dropped prices','d'=>'Modules.Homeonsaletab.Shop'),$_smarty_tpl ) );?>

                 </div>
             </div>
        <?php }?>
        <div class="text-center">
            <a class="more-btn btn big" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['allonsaleProductsLink']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All promotions','d'=>'Modules.Homeonsaletab.Shop'),$_smarty_tpl ) );?>
</a>
        </div>
    </div>
</div>
<?php }
}
