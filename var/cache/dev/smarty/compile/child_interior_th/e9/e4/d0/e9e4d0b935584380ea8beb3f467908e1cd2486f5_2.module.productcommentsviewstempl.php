<?php
/* Smarty version 3.1.34-dev-7, created on 2021-05-28 11:01:55
  from 'module:productcommentsviewstempl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60b0bf93b85935_11116740',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9e4d0b935584380ea8beb3f467908e1cd2486f5' => 
    array (
      0 => 'module:productcommentsviewstempl',
      1 => 1619255004,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b0bf93b85935_11116740 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin /home/codeoperativeco/public_html/themes/interior_th/modules/productcomments/views/templates/hook/product-list-reviews.tpl -->

<?php if ($_smarty_tpl->tpl_vars['nb_comments']->value != 0) {?>
<div class="product-list-reviews" data-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id'], ENT_QUOTES, 'UTF-8');?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['product_comment_grade_url']->value;?>
">
  <div class="grade-stars small-stars">
      <div class="star-content">
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
      </div>
  </div>
  </div>
<?php } else { ?>
    <div class="star-wrapper">
      <div class="star-content">
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
      </div>
    </div>
<?php }?>
<div itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating" itemscope>
  <meta itemprop="reviewCount" content="<?php if ($_smarty_tpl->tpl_vars['nb_comments']->value > 0) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['nb_comments']->value, ENT_QUOTES, 'UTF-8');
} else { ?>1<?php }?>" />
  <meta itemprop="ratingValue" content="<?php if ($_smarty_tpl->tpl_vars['nb_comments']->value != 0) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['average_grade']->value, ENT_QUOTES, 'UTF-8');
} else { ?>5<?php }?>" />
  <meta itemprop="worstRating" content = "0" />
  <meta itemprop="bestRating" content = "5" />
</div>

<!-- end /home/codeoperativeco/public_html/themes/interior_th/modules/productcomments/views/templates/hook/product-list-reviews.tpl --><?php }
}
