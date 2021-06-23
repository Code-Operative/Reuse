<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-22 20:50:20
  from 'module:htmlbanners1viewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60d23efce6e763_79541155',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae7b2ca8f6ebf67ed50f35aa6255ab5c8e72790a' => 
    array (
      0 => 'module:htmlbanners1viewstemplate',
      1 => 1624304956,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60d23efce6e763_79541155 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['htmlbanners1']->value['slides']) {?>
  <div id="htmlbanners1" class="topcolumn-banners container wow fadeInDown" data-wow-delay="0.4s">
    <div class="htmlbanners1-inner js-htmlbanners1-carousel <?php if ($_smarty_tpl->tpl_vars['htmlbanners1']->value['carousel_active'] == 'true') {?> htmlbanners1-carousel <?php }?>row clearfix" <?php if ($_smarty_tpl->tpl_vars['htmlbanners1']->value['carousel_active'] == 'true') {?> data-carousel=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['carousel_active'], ENT_QUOTES, 'UTF-8');?>
 data-autoplay=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['autoplay'], ENT_QUOTES, 'UTF-8');?>
 data-timeout="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['speed'], ENT_QUOTES, 'UTF-8');?>
" data-pause="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['pause'], ENT_QUOTES, 'UTF-8');?>
" data-pagination="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['pagination'], ENT_QUOTES, 'UTF-8');?>
" data-navigation="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['navigation'], ENT_QUOTES, 'UTF-8');?>
" data-loop="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['wrap'], ENT_QUOTES, 'UTF-8');?>
" data-items="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['items'], ENT_QUOTES, 'UTF-8');?>
" data-items_1199="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['items_1199'], ENT_QUOTES, 'UTF-8');?>
" data-items_991="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['items_991'], ENT_QUOTES, 'UTF-8');?>
" data-items_768="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['items_768'], ENT_QUOTES, 'UTF-8');?>
" data-items_480="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners1']->value['items_480'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['htmlbanners1']->value['slides'], 'slide', false, NULL, 'htmlbanners1', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
?>
        <div class="top-banner <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['customclass'], ENT_QUOTES, 'UTF-8');?>
">
          <?php if ($_smarty_tpl->tpl_vars['slide']->value['url'] != $_smarty_tpl->tpl_vars['slide']->value['url_base']) {?>
          <a class="banner-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['url'], ENT_QUOTES, 'UTF-8');?>
" >
          <?php } else { ?>
          <div class="banner-link">
          <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['slide']->value['image_url'] != $_smarty_tpl->tpl_vars['slide']->value['image_base_url']) {?>
          <figure>
          <img class="img-banner" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['image_url'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['legend'] )), ENT_QUOTES, 'UTF-8');?>
">
          <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['slide']->value['description']) {?>
                <figcaption class="banner-description">
                    <?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>

                </figcaption>
              <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['slide']->value['image_url'] != $_smarty_tpl->tpl_vars['slide']->value['image_base_url']) {?>
          </figure>
          <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['slide']->value['url'] != $_smarty_tpl->tpl_vars['slide']->value['url_base']) {?>
          </a>
          <?php } else { ?>
          </div>
          <?php }?>
        </div>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
  </div>
<?php }?>

<?php }
}
