<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-24 17:12:50
  from 'module:htmlbanners9viewstemplate' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_603689121816f4_33445925',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '373fd739e075478d5d9dc6c4a8557642c8f55b6c' => 
    array (
      0 => 'module:htmlbanners9viewstemplate',
      1 => 1613650431,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603689121816f4_33445925 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '804192286036891216bff5_53305282';
?>

<?php if ($_smarty_tpl->tpl_vars['htmlbanners9']->value['slides']) {?>
  <div id="htmlbanners9" class="headerslider wow fadeInUp" data-fullscreen=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners9']->value['fullscreen'], ENT_QUOTES, 'UTF-8');?>
 data-wow-delay="0.5s" data-autoplay=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners9']->value['autoplay'], ENT_QUOTES, 'UTF-8');?>
 data-timeout="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners9']->value['speed'], ENT_QUOTES, 'UTF-8');?>
"  data-pause="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners9']->value['pause'], ENT_QUOTES, 'UTF-8');?>
" data-pagination="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners9']->value['pagination'], ENT_QUOTES, 'UTF-8');?>
" data-navigation="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners9']->value['navigation'], ENT_QUOTES, 'UTF-8');?>
" data-loop="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners9']->value['wrap'], ENT_QUOTES, 'UTF-8');?>
" data-anim_in="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners9']->value['anim_in'], ENT_QUOTES, 'UTF-8');?>
" data-anim_out="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['htmlbanners9']->value['anim_out'], ENT_QUOTES, 'UTF-8');?>
">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['htmlbanners9']->value['slides'], 'slide', false, NULL, 'htmlbanners9', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
?>
        <div class="header-slide <?php if ($_smarty_tpl->tpl_vars['htmlbanners9']->value['fullscreen'] == 'true') {?> fullscreen-mode<?php } else { ?> default-mode<?php }?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['customclass'], ENT_QUOTES, 'UTF-8');?>
">
          <?php if (($_smarty_tpl->tpl_vars['slide']->value['image_url'] != $_smarty_tpl->tpl_vars['slide']->value['image_base_url']) && ($_smarty_tpl->tpl_vars['slide']->value['url'] != $_smarty_tpl->tpl_vars['slide']->value['url_base'])) {?>
          <a class="slide-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['url'], ENT_QUOTES, 'UTF-8');?>
" >
          <?php } else { ?>
          <div class="slide-link">
          <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['slide']->value['image_url'] != $_smarty_tpl->tpl_vars['slide']->value['image_base_url']) {?>
          <figure class="headerslider-figure">
          <?php if ($_smarty_tpl->tpl_vars['htmlbanners9']->value['fullscreen'] != 'true') {?>
          <img class="headerslider-img" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['image_url'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['legend'] )), ENT_QUOTES, 'UTF-8');?>
">
          <?php } else { ?>
          <div class="headerslider-img" style="background-image: url(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['image_url'], ENT_QUOTES, 'UTF-8');?>
);"></div>
          <?php }?>
          <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['slide']->value['description']) {?>
                <figcaption class="caption-description">
                    <?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>

                </figcaption>
              <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['slide']->value['image_url'] != $_smarty_tpl->tpl_vars['slide']->value['image_base_url']) {?>
          </figure>
          <?php }?>
          <?php if (($_smarty_tpl->tpl_vars['slide']->value['image_url'] != $_smarty_tpl->tpl_vars['slide']->value['image_base_url']) && ($_smarty_tpl->tpl_vars['slide']->value['url'] != $_smarty_tpl->tpl_vars['slide']->value['url_base'])) {?>
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
<?php }?>

<?php }
}
