<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:12:49
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/blockmanufactureri/views/templates/front/blockmanufactureri.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60368911da43f9_47273413',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15ccf8df8ac3b33162c7726efb3fa750fba2e916' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/blockmanufactureri/views/templates/front/blockmanufactureri.tpl',
      1 => 1613650431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60368911da43f9_47273413 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Block manufacturers module -->
<div id="manufacturers-home" class="manufacturers-home nav-active container wow fadeInUp" data-wow-offset="100">
	<h3 class="headline-section"><?php if ($_smarty_tpl->tpl_vars['display_link_manufacturer']->value) {?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('manufacturer'), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Manufacturers','d'=>'Modules.Blockmanufactureri.Shop'),$_smarty_tpl ) );?>
"><?php }?><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Manufacturers','d'=>'Modules.Blockmanufactureri.Shop'),$_smarty_tpl ) );
if ($_smarty_tpl->tpl_vars['display_link_manufacturer']->value) {?></strong></a><?php }?></h3>
<?php if ($_smarty_tpl->tpl_vars['manufacturers']->value) {?>
	<div class="manufacturers-list js-man-carousel<?php if ($_smarty_tpl->tpl_vars['text_list']->value) {?>  carousel-view<?php } else { ?>grid-view<?php }?>" <?php if ($_smarty_tpl->tpl_vars['text_list']->value) {?>data-carousel="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['text_list']->value, ENT_QUOTES, 'UTF-8');?>
"<?php }?>>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['manufacturers']->value, 'manufacturer', false, NULL, 'manufacturer_list', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['manufacturer']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_manufacturer_list']->value['iteration']++;
?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_manufacturer_list']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_manufacturer_list']->value['iteration'] : null) <= $_smarty_tpl->tpl_vars['text_list_nb']->value) {?>
		<div class="manufacturer-items">
	        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['manufacturer']->value['link_rewrite']), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'More about','d'=>'Modules.Blockmanufactureri.Shop'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
	        	<img src="<?php if ($_smarty_tpl->tpl_vars['psversion']->value < '1.7.0.0') {
echo htmlspecialchars($_smarty_tpl->tpl_vars['img_manu_dir']->value, ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['img_manu_url'], ENT_QUOTES, 'UTF-8');
}
echo htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'], ENT_QUOTES, 'UTF-8');?>
-manufacturer_default.jpg" alt=" <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['manufacturer']->value['name'], ENT_QUOTES, 'UTF-8');?>
" />
	        </a>
	                </div>
		<?php }?>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</div>
<?php } else { ?>
	<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No manufacturer','d'=>'Modules.Blockmanufactureri.Shop'),$_smarty_tpl ) );?>
</p>
<?php }?>
</div><?php }
}
