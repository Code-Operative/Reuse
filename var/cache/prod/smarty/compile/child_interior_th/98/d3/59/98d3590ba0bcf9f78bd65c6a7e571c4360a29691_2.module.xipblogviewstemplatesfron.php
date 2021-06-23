<?php
/* Smarty version 3.1.34-dev-7, created on 2021-06-22 20:50:20
  from 'module:xipblogviewstemplatesfron' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60d23efcbd7ee0_81964434',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '98d3590ba0bcf9f78bd65c6a7e571c4360a29691' => 
    array (
      0 => 'module:xipblogviewstemplatesfron',
      1 => 1624304957,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:xipblog/views/templates/front/post-video.tpl' => 2,
    'module:xipblog/views/templates/front/post-audio.tpl' => 2,
    'module:xipblog/views/templates/front/post-gallery.tpl' => 2,
  ),
),false)) {
function content_60d23efcbd7ee0_81964434 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/codeoperativeco/prestaoperative/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<div class="home_blog_post_area nav-active <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipbdp_designlayout']->value, ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['hookName']->value, ENT_QUOTES, 'UTF-8');?>
 wow fadeInUp  products" data-wow-offset="300">

	<div class="home_blog_post">

		<div class="page_title_area">

			<?php if (isset($_smarty_tpl->tpl_vars['xipbdp_title']->value)) {?>

				<h3 class="headline-section">

					<strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipbdp_title']->value, ENT_QUOTES, 'UTF-8');?>
</strong>

				</h3>

			<?php }?>

			<?php if (isset($_smarty_tpl->tpl_vars['xipbdp_subtext']->value)) {?>

				
			<?php }?>

			<div class="heading-line d_none"><span></span></div>

		</div>

		<div class="row home_blog_post_inner carousel" data-items="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipbdp_numcolumn']->value, ENT_QUOTES, 'UTF-8');?>
">

		<?php if ((isset($_smarty_tpl->tpl_vars['xipblogposts']->value) && !empty($_smarty_tpl->tpl_vars['xipblogposts']->value))) {?>

			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['xipblogposts']->value, 'xipblgpst');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['xipblgpst']->value) {
?>

				<article class="blog_post col-xs-12 col-sm-4">

					<div class="blog_post_content">

						<div class="blog_post_content_top">

							<?php if ($_smarty_tpl->tpl_vars['xipblgpst']->value['post_format'] != 'video' && $_smarty_tpl->tpl_vars['xipblgpst']->value['post_format'] != 'audio' && $_smarty_tpl->tpl_vars['xipblgpst']->value['post_format'] != 'gallery') {?>

							<a class="post_thumbnail" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblgpst']->value['link'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Read more','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
">

							<?php } else { ?>

							<div class="post_thumbnail">

							<?php }?>

								<?php if ($_smarty_tpl->tpl_vars['xipblgpst']->value['post_format'] == 'video') {?>

									<?php $_smarty_tpl->_assignInScope('postvideos', explode(',',$_smarty_tpl->tpl_vars['xipblgpst']->value['video']));?>

									<?php if (count($_smarty_tpl->tpl_vars['postvideos']->value) > 1) {?>

										<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/post-video.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('videos'=>$_smarty_tpl->tpl_vars['postvideos']->value,'width'=>'570','height'=>"316",'class'=>"carousel"), 0, true);
?>

									<?php } else { ?>

										<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/post-video.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('videos'=>$_smarty_tpl->tpl_vars['postvideos']->value,'width'=>'570','height'=>"316",'class'=>''), 0, true);
?>

									<?php }?>

								<?php } elseif ($_smarty_tpl->tpl_vars['xipblgpst']->value['post_format'] == 'audio') {?>

									<?php $_smarty_tpl->_assignInScope('postaudio', explode(',',$_smarty_tpl->tpl_vars['xipblgpst']->value['audio']));?>

									<?php if (count($_smarty_tpl->tpl_vars['postaudio']->value) > 1) {?>

										<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/post-audio.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('audios'=>$_smarty_tpl->tpl_vars['postaudio']->value,'width'=>'570','height'=>"316",'class'=>"carousel"), 0, true);
?>

									<?php } else { ?>

										<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/post-audio.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('audios'=>$_smarty_tpl->tpl_vars['postaudio']->value,'width'=>'570','height'=>"316",'class'=>''), 0, true);
?>

									<?php }?>

								<?php } elseif ($_smarty_tpl->tpl_vars['xipblgpst']->value['post_format'] == 'gallery') {?>

									<?php if (count($_smarty_tpl->tpl_vars['xipblgpst']->value['gallery_lists']) > 1) {?>

										<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/post-gallery.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('gallery'=>$_smarty_tpl->tpl_vars['xipblgpst']->value['gallery_lists'],'imagesize'=>"home_default",'class'=>"carousel"), 0, true);
?>

									<?php } else { ?>

										<?php $_smarty_tpl->_subTemplateRender("module:xipblog/views/templates/front/post-gallery.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('gallery'=>$_smarty_tpl->tpl_vars['xipblgpst']->value['gallery_lists'],'imagesize'=>"home_default",'class'=>''), 0, true);
?>

									<?php }?>

								<?php } else { ?>

									<img class="xipblog_img img-responsive" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblgpst']->value['post_img_home_default'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblgpst']->value['post_title'], ENT_QUOTES, 'UTF-8');?>
">

								<?php }?>

							<?php if ($_smarty_tpl->tpl_vars['xipblgpst']->value['post_format'] != 'video' && $_smarty_tpl->tpl_vars['xipblgpst']->value['post_format'] != 'audio' && $_smarty_tpl->tpl_vars['xipblgpst']->value['post_format'] != 'gallery') {?>

							</a>

							<?php } else { ?>

							</div>

							<?php }?>

						</div>

						<div class="blog_post_content_bottom">

							<h3 class="post_title"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblgpst']->value['link'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Read more','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblgpst']->value['post_title'], ENT_QUOTES, 'UTF-8');?>
</a></h3>

							<div class="post_content">

								<?php if (isset($_smarty_tpl->tpl_vars['xipblgpst']->value['post_excerpt']) && !empty($_smarty_tpl->tpl_vars['xipblgpst']->value['post_excerpt'])) {?>

									<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['xipblgpst']->value['post_excerpt'],100,' ...' )),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>


								<?php } else { ?>

									<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['xipblgpst']->value['post_content'],100,' ...' )),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>


								<?php }?>

								<a class="read_more" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblgpst']->value['link'], ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Read more','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
</a>

							</div>

						</div>

						<div class="post_meta clearfix">

								<div class="meta_author">

									<i class="material-icons">&#xE7FD;</i>

									<span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblgpst']->value['post_author_arr']['firstname'], ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblgpst']->value['post_author_arr']['lastname'], ENT_QUOTES, 'UTF-8');?>
</span>

								</div>

								<div class="meta_date">

									<i class="material-icons">&#xE916;</i>

									<?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['xipblgpst']->value['post_date'],"%b %d, %Y"), ENT_QUOTES, 'UTF-8');?>


								</div>

								<div class="meta_category">

									<i class="material-icons">&#xE3C9;</i>

									<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblgpst']->value['category_default_arr']['link'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['xipblgpst']->value['category_default_arr']['name'], ENT_QUOTES, 'UTF-8');?>
</a>

								</div>

							</div>

						</div>

				</article>

			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

		<?php } else { ?>

			<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No Blog Post Found','d'=>'Modules.Xipblog.Shop'),$_smarty_tpl ) );?>
</p>

		<?php }?>

		</div>

	</div>
<button class="btn btn-primary">See all Blog posts</button>
</div>

<section style="position: relative;top: 7px;right: -328px;margin: 59px;/* width: 100%; *//* background: grey; *//* color: #003C50; */">
        <h3 class="headline-section">Join our Mailing List</h3>

<!-- Begin Mailchimp Signup Form -->
<div id="mc_embed_signup">
  <form action="https://reuse-home.us1.list-manage.com/subscribe/post?u=44631ffed727469132ad1ea78&amp;id=2cd2a372ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
      <label for="mce-EMAIL">Enter your email</label>
      <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
      <div class="content__gdpr">
        <fieldset class="mc_fieldset gdprRequired mc-field-group" name="interestgroup_field">
          <label class="checkbox subfield" for="gdpr_48338"><input type="checkbox" id="gdpr_48338" name="gdpr[48338]" value="Y" class="av-checkbox "><span>Please tick to confirm you'd like to hear from REUSE Home</span>
          </label>
        </fieldset>
      </div>

      <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
      <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_44631ffed727469132ad1ea78_2cd2a372ef" tabindex="-1" value=""></div>
        <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">Subscribe</button>

    </div>
  </form>

  <div class="content__gdprLegal">
    <p>You can unsubscribe at any time by clicking the link in the footer of our emails. For information about our privacy practices, please see our <a href="https://reuse-home.org.uk/content/9-privacy-policy">privacy policy</a>. We use Mailchimp as our marketing platform. By clicking to subscribe, you acknowledge that your information will be transferred to Mailchimp for processing. <a href="https://mailchimp.com/legal/" target="_blank">Learn more about Mailchimp's privacy practices here.</a></p>
  </div>
</div>
<!--End mc_embed_signup-->

        </section><?php }
}
