<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-08 07:49:19
  from '/home/codeoperativeco/public_html/themes/interior_th/templates/catalog/listing/product-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6096346f1158a9_12776345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b6f908889648aab9f32b34a025236f94cf1440d' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/interior_th/templates/catalog/listing/product-list.tpl',
      1 => 1619255004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/miniatures/category.tpl' => 1,
    'file:catalog/_partials/products-top.tpl' => 1,
    'file:catalog/_partials/products.tpl' => 1,
    'file:catalog/_partials/products-bottom.tpl' => 1,
    'file:errors/not-found.tpl' => 1,
  ),
),false)) {
function content_6096346f1158a9_12776345 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20339846966096346f0fb5f9_44798363', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'product_list_brand_description'} */
class Block_3738811886096346f104e03_96998978 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'manufacturer' && $_smarty_tpl->tpl_vars['manufacturer']->value['description']) {?>
        <div id="manufacturer-short_description" class="rte"><?php echo $_smarty_tpl->tpl_vars['manufacturer']->value['short_description'];?>
</div>
        <div id="manufacturer-description" class="rte"><?php echo $_smarty_tpl->tpl_vars['manufacturer']->value['description'];?>
</div>
      <?php } elseif ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'supplier' && $_smarty_tpl->tpl_vars['supplier']->value['description']) {?>
        <div id="supplier-description" class="rte"><?php echo $_smarty_tpl->tpl_vars['supplier']->value['description'];?>
</div>
      <?php }?>
      <?php
}
}
/* {/block 'product_list_brand_description'} */
/* {block 'category_miniature'} */
class Block_17802754516096346f10c125_23954368 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                      <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/miniatures/category.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('category'=>$_smarty_tpl->tpl_vars['subcategory']->value), 0, true);
?>
                    <?php
}
}
/* {/block 'category_miniature'} */
/* {block 'category_subcategories'} */
class Block_5900715056096346f1085c7_36683923 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <aside class="clearfix">
          <?php if (count($_smarty_tpl->tpl_vars['subcategories']->value)) {?>
          <p class="subcategory-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Subcategories','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</p>
            <nav class="subcategories">
              <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subcategories']->value, 'subcategory');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['subcategory']->value) {
?>
                  <li>
                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17802754516096346f10c125_23954368', 'category_miniature', $this->tplIndex);
?>

                  </li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </ul>
            </nav>
          <?php }?>
        </aside>
      <?php
}
}
/* {/block 'category_subcategories'} */
/* {block 'product_list_top'} */
class Block_4749524386096346f10ed99_20315388 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/products-top.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('listing'=>$_smarty_tpl->tpl_vars['listing']->value), 0, false);
?>
          <?php
}
}
/* {/block 'product_list_top'} */
/* {block 'product_list_active_filters'} */
class Block_3228990866096346f10fc47_53942273 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <div id="" class="hidden-sm-down">
            <?php echo $_smarty_tpl->tpl_vars['listing']->value['rendered_active_filters'];?>

          </div>
        <?php
}
}
/* {/block 'product_list_active_filters'} */
/* {block 'product_list'} */
class Block_7496863426096346f111083_02724773 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/products.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('listing'=>$_smarty_tpl->tpl_vars['listing']->value), 0, false);
?>
          <?php
}
}
/* {/block 'product_list'} */
/* {block 'product_list_bottom'} */
class Block_15734017176096346f111e16_59323212 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/products-bottom.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('listing'=>$_smarty_tpl->tpl_vars['listing']->value), 0, false);
?>
          <?php
}
}
/* {/block 'product_list_bottom'} */
/* {block 'content'} */
class Block_20339846966096346f0fb5f9_44798363 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_20339846966096346f0fb5f9_44798363',
  ),
  'product_list_brand_description' => 
  array (
    0 => 'Block_3738811886096346f104e03_96998978',
  ),
  'category_subcategories' => 
  array (
    0 => 'Block_5900715056096346f1085c7_36683923',
  ),
  'category_miniature' => 
  array (
    0 => 'Block_17802754516096346f10c125_23954368',
  ),
  'product_list_top' => 
  array (
    0 => 'Block_4749524386096346f10ed99_20315388',
  ),
  'product_list_active_filters' => 
  array (
    0 => 'Block_3228990866096346f10fc47_53942273',
  ),
  'product_list' => 
  array (
    0 => 'Block_7496863426096346f111083_02724773',
  ),
  'product_list_bottom' => 
  array (
    0 => 'Block_15734017176096346f111e16_59323212',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <section id="main">

         <h2 class="page-heading product-listing">
      <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'category') {?>
        <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span>
      <?php } elseif ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'prices-drop') {?>
         <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Prices drop','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span>
      <?php } elseif ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'new-products') {?>
         <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'New products','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span>
      <?php } elseif ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'best-sales') {?>
         <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Best sellers','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span>
      <?php } elseif ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'manufacturer') {?>
         <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span>
      <?php } elseif ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'supplier') {?>
         <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['supplier']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span>
      <?php } elseif ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'search') {?>
         <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span>
      <?php }?>
      <span class="heading-counter">
        <?php if ($_smarty_tpl->tpl_vars['listing']->value['pagination']['total_items'] > 1) {?>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are %product_count% products.','d'=>'Shop.Theme.Catalog','sprintf'=>array('%product_count%'=>$_smarty_tpl->tpl_vars['listing']->value['pagination']['total_items'])),$_smarty_tpl ) );?>

        <?php } elseif ($_smarty_tpl->tpl_vars['listing']->value['pagination']['total_items'] > 0) {?>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There is 1 product.','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>

        <?php }?>
      </span>
    </h2>
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3738811886096346f104e03_96998978', 'product_list_brand_description', $this->tplIndex);
?>

      <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'category') {?>
     <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5900715056096346f1085c7_36683923', 'category_subcategories', $this->tplIndex);
?>

      <?php }?>
    <section id="products" class="grid">
      <?php if (count($_smarty_tpl->tpl_vars['listing']->value['products'])) {?>
        <div>
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4749524386096346f10ed99_20315388', 'product_list_top', $this->tplIndex);
?>

        </div>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3228990866096346f10fc47_53942273', 'product_list_active_filters', $this->tplIndex);
?>


        <div>
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7496863426096346f111083_02724773', 'product_list', $this->tplIndex);
?>

        </div>
                 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15734017176096346f111e16_59323212', 'product_list_bottom', $this->tplIndex);
?>

              <?php } else { ?>

        <?php $_smarty_tpl->_subTemplateRender('file:errors/not-found.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

      <?php }?>
    </section>
    <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'category') {?>
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayHtmlContent4','category'=>$_smarty_tpl->tpl_vars['category']->value),$_smarty_tpl ) );?>

    <?php }?>
  </section>
<?php
}
}
/* {/block 'content'} */
}
