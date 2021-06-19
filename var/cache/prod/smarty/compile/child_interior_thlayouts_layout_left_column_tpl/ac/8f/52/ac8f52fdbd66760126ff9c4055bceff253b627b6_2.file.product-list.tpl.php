<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-18 11:39:55
  from '/home/codeoperativeco/public_html/themes/child_interior_th/templates/catalog/listing/product-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cc77fb45c617_50339001',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac8f52fdbd66760126ff9c4055bceff253b627b6' => 
    array (
      0 => '/home/codeoperativeco/public_html/themes/child_interior_th/templates/catalog/listing/product-list.tpl',
      1 => 1621405231,
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
function content_60cc77fb45c617_50339001 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_85333462860cc77fb439f39_70141649', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'product_list_brand_description'} */
class Block_102601613960cc77fb442ae0_22967425 extends Smarty_Internal_Block
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
class Block_69429474560cc77fb44b122_69660568 extends Smarty_Internal_Block
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
class Block_37010742460cc77fb4489f5_15923096 extends Smarty_Internal_Block
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_69429474560cc77fb44b122_69660568', 'category_miniature', $this->tplIndex);
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
class Block_126519429460cc77fb456297_78913036 extends Smarty_Internal_Block
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
class Block_21420923260cc77fb457883_90403231 extends Smarty_Internal_Block
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
class Block_13907796260cc77fb458815_41686263 extends Smarty_Internal_Block
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
class Block_79321480860cc77fb4594f0_94017056 extends Smarty_Internal_Block
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
class Block_85333462860cc77fb439f39_70141649 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_85333462860cc77fb439f39_70141649',
  ),
  'product_list_brand_description' => 
  array (
    0 => 'Block_102601613960cc77fb442ae0_22967425',
  ),
  'category_subcategories' => 
  array (
    0 => 'Block_37010742460cc77fb4489f5_15923096',
  ),
  'category_miniature' => 
  array (
    0 => 'Block_69429474560cc77fb44b122_69660568',
  ),
  'product_list_top' => 
  array (
    0 => 'Block_126519429460cc77fb456297_78913036',
  ),
  'product_list_active_filters' => 
  array (
    0 => 'Block_21420923260cc77fb457883_90403231',
  ),
  'product_list' => 
  array (
    0 => 'Block_13907796260cc77fb458815_41686263',
  ),
  'product_list_bottom' => 
  array (
    0 => 'Block_79321480860cc77fb4594f0_94017056',
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_102601613960cc77fb442ae0_22967425', 'product_list_brand_description', $this->tplIndex);
?>

      <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'category') {?>
     <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_37010742460cc77fb4489f5_15923096', 'category_subcategories', $this->tplIndex);
?>

      <?php }?>
    <section id="products" class="list">
      <?php if (count($_smarty_tpl->tpl_vars['listing']->value['products'])) {?>
        <div>
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_126519429460cc77fb456297_78913036', 'product_list_top', $this->tplIndex);
?>

        </div>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21420923260cc77fb457883_90403231', 'product_list_active_filters', $this->tplIndex);
?>


        <div>
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13907796260cc77fb458815_41686263', 'product_list', $this->tplIndex);
?>

        </div>
                 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_79321480860cc77fb4594f0_94017056', 'product_list_bottom', $this->tplIndex);
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
