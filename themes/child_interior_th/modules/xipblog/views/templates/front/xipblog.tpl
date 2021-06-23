<div class="home_blog_post_area nav-active {$xipbdp_designlayout} {$hookName} wow fadeInUp  products" data-wow-offset="300">

	<div class="home_blog_post">

		<div class="page_title_area">

			{if isset($xipbdp_title)}

				<h3 class="headline-section">

					<strong>{$xipbdp_title}</strong>

				</h3>

			{/if}

			{if isset($xipbdp_subtext)}

				{*<p class="page_subtitle">{$xipbdp_subtext}</p>*}

			{/if}

			<div class="heading-line d_none"><span></span></div>

		</div>

		<div class="row home_blog_post_inner carousel" data-items="{$xipbdp_numcolumn}">

		{if (isset($xipblogposts) && !empty($xipblogposts))}

			{foreach from=$xipblogposts item=xipblgpst}

				<article class="blog_post col-xs-12 col-sm-4">

					<div class="blog_post_content">

						<div class="blog_post_content_top">

							{if $xipblgpst.post_format != 'video' && $xipblgpst.post_format != 'audio' && $xipblgpst.post_format != 'gallery'}

							<a class="post_thumbnail" href="{$xipblgpst.link}" title="{l s='Read more' d='Modules.Xipblog.Shop'}">

							{else}

							<div class="post_thumbnail">

							{/if}

								{if $xipblgpst.post_format == 'video'}

									{assign var="postvideos" value=','|explode:$xipblgpst.video}

									{if $postvideos|@count > 1 }

										{include file="module:xipblog/views/templates/front/post-video.tpl" videos=$postvideos width='570' height="316" class="carousel"}

									{else}

										{include file="module:xipblog/views/templates/front/post-video.tpl" videos=$postvideos width='570' height="316" class=""}

									{/if}

								{elseif $xipblgpst.post_format == 'audio'}

									{assign var="postaudio" value=','|explode:$xipblgpst.audio}

									{if $postaudio|@count > 1 }

										{include file="module:xipblog/views/templates/front/post-audio.tpl" audios=$postaudio width='570' height="316" class="carousel"}

									{else}

										{include file="module:xipblog/views/templates/front/post-audio.tpl" audios=$postaudio width='570' height="316" class=""}

									{/if}

								{elseif $xipblgpst.post_format == 'gallery'}

									{if $xipblgpst.gallery_lists|@count > 1 }

										{include file="module:xipblog/views/templates/front/post-gallery.tpl" gallery=$xipblgpst.gallery_lists imagesize="home_default" class="carousel"}

									{else}

										{include file="module:xipblog/views/templates/front/post-gallery.tpl" gallery=$xipblgpst.gallery_lists imagesize="home_default" class=""}

									{/if}

								{else}

									<img class="xipblog_img img-responsive" src="{$xipblgpst.post_img_home_default}" alt="{$xipblgpst.post_title}">

								{/if}

							{if $xipblgpst.post_format != 'video' && $xipblgpst.post_format != 'audio' && $xipblgpst.post_format != 'gallery'}

							</a>

							{else}

							</div>

							{/if}

						</div>

						<div class="blog_post_content_bottom">

							<h3 class="post_title"><a href="{$xipblgpst.link}" title="{l s='Read more' d='Modules.Xipblog.Shop'}">{$xipblgpst.post_title}</a></h3>

							<div class="post_content">

								{if isset($xipblgpst.post_excerpt) && !empty($xipblgpst.post_excerpt)}

									{$xipblgpst.post_excerpt|truncate:100:' ...'|escape:'html':'UTF-8'}

								{else}

									{$xipblgpst.post_content|truncate:100:' ...'|escape:'html':'UTF-8'}

								{/if}

								<a class="read_more" href="{$xipblgpst.link}">{l s='Read more' d='Modules.Xipblog.Shop'}</a>

							</div>

						</div>

						<div class="post_meta clearfix">

								<div class="meta_author">

									<i class="material-icons">&#xE7FD;</i>

									<span>{$xipblgpst.post_author_arr.firstname} {$xipblgpst.post_author_arr.lastname}</span>

								</div>

								<div class="meta_date">

									<i class="material-icons">&#xE916;</i>

									{$xipblgpst.post_date|date_format:"%b %d, %Y"}

								</div>

								<div class="meta_category">

									<i class="material-icons">&#xE3C9;</i>

									<a href="{$xipblgpst.category_default_arr.link}">{$xipblgpst.category_default_arr.name}</a>

								</div>

							</div>

						</div>

				</article>

			{/foreach}

		{else}

			<p>{l s='No Blog Post Found' d='Modules.Xipblog.Shop'}</p>

		{/if}

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

        </section>