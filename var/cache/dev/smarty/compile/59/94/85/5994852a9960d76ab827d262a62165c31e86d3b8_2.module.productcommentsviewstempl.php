<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-28 21:17:47
  from 'module:productcommentsviewstempl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6089c2eb3d95d1_20470185',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5994852a9960d76ab827d262a62165c31e86d3b8' => 
    array (
      0 => 'module:productcommentsviewstempl',
      1 => 1619255004,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:productcomments/views/templates/hook/product-comment-item-prototype.tpl' => 1,
    'module:productcomments/views/templates/hook/empty-product-comment.tpl' => 1,
    'module:productcomments/views/templates/hook/alert-modal.tpl' => 3,
    'module:productcomments/views/templates/hook/confirm-modal.tpl' => 1,
  ),
),false)) {
function content_6089c2eb3d95d1_20470185 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- begin /home/codeoperativeco/public_html/themes/interior_th/modules/productcomments/views/templates/hook/product-comments-list.tpl -->
<?php echo '<script'; ?>
 type="text/javascript">
  var productCommentUpdatePostErrorMessage = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sorry, your review appreciation cannot be sent.','d'=>'Modules.Productcomments.Shop','js'=>1),$_smarty_tpl ) );?>
";
  var productCommentAbuseReportErrorMessage = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sorry, your abuse report cannot be sent.','d'=>'Modules.Productcomments.Shop','js'=>1),$_smarty_tpl ) );?>
";
<?php echo '</script'; ?>
>

<div id="productcomments" class="tab-pane fade in">
  <div class="tab-pane-inner">
<?php ob_start();
$_smarty_tpl->_subTemplateRender('module:productcomments/views/templates/hook/product-comment-item-prototype.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->assign('comment_prototype', ob_get_clean());
$_smarty_tpl->_subTemplateRender('module:productcomments/views/templates/hook/empty-product-comment.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  <div class="row"
       id="product-comments-list"
       data-list-comments-url="<?php echo $_smarty_tpl->tpl_vars['list_comments_url']->value;?>
"
       data-update-comment-usefulness-url="<?php echo $_smarty_tpl->tpl_vars['update_comment_usefulness_url']->value;?>
"
       data-report-comment-url="<?php echo $_smarty_tpl->tpl_vars['report_comment_url']->value;?>
"
       data-comment-item-prototype="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['comment_prototype']->value,'html_attr' )), ENT_QUOTES, 'UTF-8');?>
">
  </div>
<div class="row">
  <div class="col-md-12 col-sm-12" id="product-comments-list-footer">
    <div id="product-comments-list-pagination"></div>
    <?php if ($_smarty_tpl->tpl_vars['post_allowed']->value && $_smarty_tpl->tpl_vars['nb_comments']->value != 0) {?>
      <button class="btn btn-comment btn-comment-big post-product-comment">
        <i class="material-icons shopping-cart">edit</i>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Write your review','d'=>'Modules.Productcomments.Shop'),$_smarty_tpl ) );?>

      </button>
    <?php }?>
  </div>
</div>
  </div>
</div>
<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your review appreciation cannot be sent','d'=>'Modules.Productcomments.Shop'),$_smarty_tpl ) );
$_prefixVariable4 = ob_get_clean();
$_smarty_tpl->_subTemplateRender('module:productcomments/views/templates/hook/alert-modal.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('modal_id'=>'update-comment-usefulness-post-error','modal_title'=>$_prefixVariable4,'icon'=>'error'), 0, false);
?>

<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Report comment','d'=>'Modules.Productcomments.Shop'),$_smarty_tpl ) );
$_prefixVariable5 = ob_get_clean();
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Are you sure that you want to report this comment?','d'=>'Modules.Productcomments.Shop'),$_smarty_tpl ) );
$_prefixVariable6 = ob_get_clean();
$_smarty_tpl->_subTemplateRender('module:productcomments/views/templates/hook/confirm-modal.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('modal_id'=>'report-comment-confirmation','modal_title'=>$_prefixVariable5,'modal_message'=>$_prefixVariable6,'icon'=>'feedback'), 0, false);
?>

<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Report sent','d'=>'Modules.Productcomments.Shop'),$_smarty_tpl ) );
$_prefixVariable7 = ob_get_clean();
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your report has been submitted and will be considered by a moderator.','d'=>'Modules.Productcomments.Shop'),$_smarty_tpl ) );
$_prefixVariable8 = ob_get_clean();
$_smarty_tpl->_subTemplateRender('module:productcomments/views/templates/hook/alert-modal.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('modal_id'=>'report-comment-posted','modal_title'=>$_prefixVariable7,'modal_message'=>$_prefixVariable8), 0, true);
?>

<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your report cannot be sent','d'=>'Modules.Productcomments.Shop'),$_smarty_tpl ) );
$_prefixVariable9 = ob_get_clean();
$_smarty_tpl->_subTemplateRender('module:productcomments/views/templates/hook/alert-modal.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('modal_id'=>'report-comment-post-error','modal_title'=>$_prefixVariable9,'icon'=>'error'), 0, true);
?><!-- end /home/codeoperativeco/public_html/themes/interior_th/modules/productcomments/views/templates/hook/product-comments-list.tpl --><?php }
}
