<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-29 10:48:06
  from '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/products_to_customer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_608a80d60edb99_79704171',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '057dd896cad3f9440ee566422c625da5a8820fb7' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/kbmarketplace/views/templates/front/seller/products_to_customer.tpl',
      1 => 1619254986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/miniatures/product.tpl' => 1,
  ),
),false)) {
function content_608a80d60edb99_79704171 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<div >
    <h1 class="page-heading">
        <span clas=""><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['kb_page_title']->value, ENT_QUOTES, 'UTF-8');?>
</span>
        <div class="clearfix"></div>
    </h1>
    <section class="tabs page-product-box slr-f-box">
        <h3 class="page-product-heading s-p-filter">
            <form action="<?php echo $_smarty_tpl->tpl_vars['filter_form_action']->value;?>
" method="post" id="seller_products_form"> 
            <ul>
                <li class="heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Filter your search','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
: </li>
                <?php if (isset($_smarty_tpl->tpl_vars['category_list']->value) && count($_smarty_tpl->tpl_vars['category_list']->value) > 0) {?>
                <li>
                    <select name="s_filter_category" onchange="$('#seller_product_pagination_var').val(0);$('#seller_products_form').submit();">
                        <option value=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Category','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category_list']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                            <option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['cat']->value['id_category']), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['selected_category']->value == $_smarty_tpl->tpl_vars['cat']->value['id_category']) {?>selected="selected"<?php }?> ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cat']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </li>
                <?php }?>
                <li>
                    <select name="s_filter_sortby" onchange="$('#seller_product_pagination_var').val(0);$('#seller_products_form').submit();">
                        <option value=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sort By','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="pl.name:ASC" <?php if ($_smarty_tpl->tpl_vars['selected_sort']->value == 'pl.name:ASC') {?>selected="selected"<?php }?> ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name (A - Z)','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="pl.name:DESC" <?php if ($_smarty_tpl->tpl_vars['selected_sort']->value == 'pl.name:DESC') {?>selected="selected"<?php }?> ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name (Z - A)','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="p.price:ASC" <?php if ($_smarty_tpl->tpl_vars['selected_sort']->value == 'p.price:ASC') {?>selected="selected"<?php }?> ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price(low to high)','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                        <option value="p.price:DESC" <?php if ($_smarty_tpl->tpl_vars['selected_sort']->value == 'p.price:DESC') {?>selected="selected"<?php }?> ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price(high to low)','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>
</option>
                    </select>
                </li>
            </ul>
            <input type="hidden" name="page_number" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['seller_product_current_page']->value), ENT_QUOTES, 'UTF-8');?>
" id="seller_product_pagination_var"/>
            </form>
            <?php if (isset($_smarty_tpl->tpl_vars['pagination_string']->value)) {?><div id="svp-p-count" class="svp-p-count"><?php echo $_smarty_tpl->tpl_vars['pagination_string']->value;?>
</div><?php }?> 
            <div class="clearfix"></div>
        </h3>
        <?php if (isset($_smarty_tpl->tpl_vars['pagination']->value) && $_smarty_tpl->tpl_vars['pagination']->value != '') {?>
        <div class="sv-p-paging">
            <?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>
 
            <div class='clearfix'></div>
        </div>
        <?php }?>
        <div id="seller_products_to_customer" class="slr-content">
            <?php if (count($_smarty_tpl->tpl_vars['products']->value) > 0) {?>
                <section id="main">
                    <section id="products">
                        <div class="products row">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_921042967608a80d60dc381_29655169', 'product_miniature');
?>

                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>            
                        </div>
                    </section>
                </section>
            <?php } else { ?>
                <div class="alert alert-warning">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No product is available for sale from this seller','mod'=>'kbmarketplace'),$_smarty_tpl ) );?>

                </div>
            <?php }?>
        </div>
        <?php if (isset($_smarty_tpl->tpl_vars['kb_pagination']->value['pagination']) && $_smarty_tpl->tpl_vars['kb_pagination']->value['pagination'] != '') {?>
        <div class="sv-p-paging" style='padding-bottom:0;'>
            <?php echo $_smarty_tpl->tpl_vars['kb_pagination']->value['pagination'];?>
  
            <div class='clearfix'></div>
        </div>
        <?php }?>
    </section>
</div>
<?php }
/* {block 'product_miniature'} */
class Block_921042967608a80d60dc381_29655169 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_miniature' => 
  array (
    0 => 'Block_921042967608a80d60dc381_29655169',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                  <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/miniatures/product.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>
                                <?php
}
}
/* {/block 'product_miniature'} */
}
