<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-18 10:04:03
  from 'module:htmlbanners5viewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cc6183685271_78707116',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '896cad53808298a8e38915b695cf2ce7b17aa498' => 
    array (
      0 => 'module:htmlbanners5viewstemplate',
      1 => 1619255004,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60cc6183685271_78707116 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['htmlbanners5']->value['slides']) {?>
  <div id="htmlbanners5" class="home-tabs wow fadeInUp" data-wow-offset="100">
        <h3 class="headline-section">
          <strong>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Our benefits','d'=>'Modules.Hometabs.Shop'),$_smarty_tpl ) );?>

          </strong>
        </h3>
        <div class="home-tabs-inner">
          <ul class="htmlcontent-tabs col-md-3 col-sm-12">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['htmlbanners5']->value['slides'], 'slide', false, NULL, 'htmlbanners5', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration']++;
?>
              <li class="nav-item row tab_<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
 <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration'] : null) == 1) {?>active<?php }?>">
                <a class="nav-link" href="#tab_item_<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
" data-toggle="tab">
                  <?php if ($_smarty_tpl->tpl_vars['slide']->value['image_url'] != $_smarty_tpl->tpl_vars['slide']->value['image_base_url']) {?>
                      <span class="icon-wrap">
                          <img class="img-icon" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['image_url'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['legend'] )), ENT_QUOTES, 'UTF-8');?>
">
                     </span>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['slide']->value['title']) {?>
                    <span><?php echo $_smarty_tpl->tpl_vars['slide']->value['title'];?>
</span>
                  <?php } else { ?>
                    <span><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration'] : null);?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tab','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</span>
                  <?php }?>
                </a>
              </li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </ul>
          <div class="tab-content clearfix col-md-9 col-sm-12">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['htmlbanners5']->value['slides'], 'slide', false, NULL, 'htmlbanners5', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration']++;
?>
              <div role="tabpanel" id="tab_item_<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['customclass'], ENT_QUOTES, 'UTF-8');?>
 tab-pane<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_htmlbanners5']->value['iteration'] : null) == 1) {?> active<?php }?>">
                    <?php if ($_smarty_tpl->tpl_vars['slide']->value['description']) {?>
                        <?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>

                    <?php }?>
              </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </div>
    </div>
  </div>
<?php }?>

<?php }
}
