<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-13 17:41:08
  from '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/customtabs/views/templates/hook/hook.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604cf9346f0050_31877985',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3584046975480952bdf9807531976a61f1aeff1f' => 
    array (
      0 => '/home/codeoperativeco/prestaoperative/themes/interior_th/modules/customtabs/views/templates/hook/hook.tpl',
      1 => 1613650431,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604cf9346f0050_31877985 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['customtabs']->value['slides']) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customtabs']->value['slides'], 'slide', false, NULL, 'customtabs', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_customtabs']->value['iteration']++;
?>
      <?php $_smarty_tpl->_assignInScope('productsId', explode(",",$_smarty_tpl->tpl_vars['slide']->value['category']));?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productsId']->value, 'selectedId');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['selectedId']->value) {
?>
        <?php if ($_smarty_tpl->tpl_vars['selectedId']->value == $_smarty_tpl->tpl_vars['customtabs']->value['product_id'] || $_smarty_tpl->tpl_vars['slide']->value['category'] == '') {?>
          <div class="tab-pane fade in <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['customclass'], ENT_QUOTES, 'UTF-8');?>
" id="custom_tab_<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_foreach_customtabs']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_customtabs']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
" data-current="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customtabs']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
" data-selected="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['category'], ENT_QUOTES, 'UTF-8');?>
">
            <div class="tab-pane-inner rte">
              <?php if (($_smarty_tpl->tpl_vars['slide']->value['image_url'] != $_smarty_tpl->tpl_vars['slide']->value['image_base_url']) && $_smarty_tpl->tpl_vars['slide']->value['url'] != $_smarty_tpl->tpl_vars['slide']->value['url_base']) {?>
              <a class="banner-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['url'], ENT_QUOTES, 'UTF-8');?>
" >
              <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['slide']->value['image_url'] != $_smarty_tpl->tpl_vars['slide']->value['image_base_url']) {?>
              <img class="img-banner" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['image_url'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['legend'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
              <?php }?>
              <?php if (($_smarty_tpl->tpl_vars['slide']->value['image_url'] != $_smarty_tpl->tpl_vars['slide']->value['image_base_url']) && $_smarty_tpl->tpl_vars['slide']->value['url'] != $_smarty_tpl->tpl_vars['slide']->value['url_base']) {?>
              </a>
              <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['slide']->value['description']) {?>
                  <?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>

              <?php }?>
            </div>
          </div>
        <?php }?>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
