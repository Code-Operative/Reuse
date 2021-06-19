<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-17 23:05:18
  from '/home/codeoperativeco/public_html/modules/xipblog/views/templates/front/default/single.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60cbc71e081535_81886140',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3840220c5e9848215849ce3d1926554c758556d4' => 
    array (
      0 => '/home/codeoperativeco/public_html/modules/xipblog/views/templates/front/default/single.tpl',
      1 => 1619254988,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'module:xipblog/views/templates/front/default/post-video.tpl' => 1,
    'module:xipblog/views/templates/front/default/post-audio.tpl' => 1,
    'module:xipblog/views/templates/front/default/post-gallery.tpl' => 1,
    'module:xipblog/views/templates/front/default/custom-nav.tpl' => 1,
    'module:xipblog/views/templates/front/default/comment-list.tpl' => 1,
    'module:xipblog/views/templates/front/default/comment.tpl' => 1,
  ),
),false)) {
function content_60cbc71e081535_81886140 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_47756945460cbc71e042c43_56665016', 'page_header_container');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_103013692860cbc71e04c943_05887687', "page_content_container");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_27092378260cbc71e075e20_77547841', "left_column");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_94923187860cbc71e07d997_48133365', "right_column");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_header_container'} */
class Block_47756945460cbc71e042c43_56665016 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_header_container' => 
  array (
    0 => 'Block_47756945460cbc71e042c43_56665016',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_header_container'} */
/* {block "page_content_container"} */
class Block_103013692860cbc71e04c943_05887687 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_103013692860cbc71e04c943_05887687',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/codeoperativeco/public_html/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

	<section id="content" class="page-content">
		<div class="kr_blog_post_area single">
			<div class="kr_blog_post_inner">
				<article id="blog_post" class="blog_post blog_post_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblogpost']->value['post_format'], ENT_QUOTES, 'UTF-8');?>
">
					<div class="blog_post_content">
						<div class="blog_post_content_top">
							<div class="post_thumbnail">
								<?php if ($_smarty_tpl->tpl_vars['xipblogpost']->value['post_format'] == 'video') {?>
									<?php $_smarty_tpl->_assignInScope('postvideos', explode(',',$_smarty_tpl->tpl_vars['xipblogpost']->value['video']));?>
									<?php if (count($_smarty_tpl->tpl_vars['postvideos']->value) > 1) {?>
										<?php $_smarty_tpl->_assignInScope('class', 'carousel');?>
									<?php } else { ?>
										<?php $_smarty_tpl->_assignInScope('class', '');?>
									<?php }?>
									<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/default/post-video.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('postvideos'=>$_smarty_tpl->tpl_vars['postvideos']->value,'width'=>'870','height'=>"482",'class'=>$_smarty_tpl->tpl_vars['class']->value), 0, false);
?>
								<?php } elseif ($_smarty_tpl->tpl_vars['xipblogpost']->value['post_format'] == 'audio') {?>
									<?php $_smarty_tpl->_assignInScope('postaudio', explode(',',$_smarty_tpl->tpl_vars['xipblogpost']->value['audio']));?>
									<?php if (count($_smarty_tpl->tpl_vars['postaudio']->value) > 1) {?>
										<?php $_smarty_tpl->_assignInScope('class', 'carousel');?>
									<?php } else { ?>
										<?php $_smarty_tpl->_assignInScope('class', '');?>
									<?php }?>
									<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/default/post-audio.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('postaudio'=>$_smarty_tpl->tpl_vars['postaudio']->value,'width'=>'870','height'=>"482",'class'=>$_smarty_tpl->tpl_vars['class']->value), 0, false);
?>
								<?php } elseif ($_smarty_tpl->tpl_vars['xipblogpost']->value['post_format'] == 'gallery') {?>
									<?php if (count($_smarty_tpl->tpl_vars['xipblogpost']->value['gallery_lists']) > 1) {?>
										<?php $_smarty_tpl->_assignInScope('class', 'carousel');?>
									<?php } else { ?>
										<?php $_smarty_tpl->_assignInScope('class', '');?>
									<?php }?>
									<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/default/post-gallery.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('gallery_lists'=>$_smarty_tpl->tpl_vars['xipblogpost']->value['gallery_lists'],'imagesize'=>"medium",'class'=>$_smarty_tpl->tpl_vars['class']->value), 0, false);
?>
								<?php } else { ?>
									<img class="xipblog_img img-responsive" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblogpost']->value['post_img_large'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblogpost']->value['post_title'], ENT_QUOTES, 'UTF-8');?>
">
								<?php }?>
							</div>
						</div>

						<div class="blog_post_content_bottom">
							<h3 class="post_title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblogpost']->value['post_title'], ENT_QUOTES, 'UTF-8');?>
</h3>
							<div class="post_meta clearfix">
								<div class="meta_author">
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'By','mod'=>'xipblog'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblogpost']->value['post_author_arr']['firstname'], ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblogpost']->value['post_author_arr']['lastname'], ENT_QUOTES, 'UTF-8');?>
</span>
								</div>
								<div class="post_meta_date">
																		<?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['xipblogpost']->value['post_date'],"%b %dTH, %Y"), ENT_QUOTES, 'UTF-8');?>

								</div>
								<div class="meta_category">
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'In','mod'=>'xipblog'),$_smarty_tpl ) );?>
</span>
									<span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblogpost']->value['category_default_arr']['name'], ENT_QUOTES, 'UTF-8');?>
</span>
								</div>
								<div class="meta_comment">
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Views','mod'=>'xipblog'),$_smarty_tpl ) );?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblogpost']->value['comment_count'], ENT_QUOTES, 'UTF-8');?>
)</span>
								</div>
							</div>
							<div class="post_content">
								<?php echo $_smarty_tpl->tpl_vars['xipblogpost']->value['post_content'];?>

							</div>
						</div>

					</div>
				</article>
			</div>
		</div>
		<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/default/custom-nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</section>
<?php if (($_smarty_tpl->tpl_vars['xipblogpost']->value['comment_status'] == 'open') || ($_smarty_tpl->tpl_vars['xipblogpost']->value['comment_status'] == 'close')) {?>
	<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/default/comment-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
if ((isset($_smarty_tpl->tpl_vars['disable_blog_com']->value) && $_smarty_tpl->tpl_vars['disable_blog_com']->value == 1) && ($_smarty_tpl->tpl_vars['xipblogpost']->value['comment_status'] == 'open')) {?>
	<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/default/comment.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
}
/* {/block "page_content_container"} */
/* {block "left_column"} */
class Block_27092378260cbc71e075e20_77547841 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'left_column' => 
  array (
    0 => 'Block_27092378260cbc71e075e20_77547841',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/codeoperativeco/public_html/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

	<?php $_smarty_tpl->_assignInScope('layout_column', strval(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['layout']->value,'layouts/',''),'.tpl','')));?>
	<?php if (($_smarty_tpl->tpl_vars['layout_column']->value == 'layout-left-column')) {?>
		<div id="left-column" class="sidebar col-xs-12 col-sm-12 col-md-3 pull-md-9">
			<?php if (($_smarty_tpl->tpl_vars['xipblog_column_use']->value == 'own_ps')) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayxipblogleft"),$_smarty_tpl ) );?>

			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayLeftColumn"),$_smarty_tpl ) );?>

			<?php }?>
		</div>
	<?php }
}
}
/* {/block "left_column"} */
/* {block "right_column"} */
class Block_94923187860cbc71e07d997_48133365 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'right_column' => 
  array (
    0 => 'Block_94923187860cbc71e07d997_48133365',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/codeoperativeco/public_html/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

	<?php $_smarty_tpl->_assignInScope('layout_column', strval(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['layout']->value,'layouts/',''),'.tpl','')));?>
	<?php if (($_smarty_tpl->tpl_vars['layout_column']->value == 'layout-right-column')) {?>
		<div id="right-column" class="sidebar col-xs-12 col-sm-4 col-md-3">
			<?php if (($_smarty_tpl->tpl_vars['xipblog_column_use']->value == 'own_ps')) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayxipblogright"),$_smarty_tpl ) );?>

			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayRightColumn"),$_smarty_tpl ) );?>

			<?php }?>
		</div>
	<?php }
}
}
/* {/block "right_column"} */
}
