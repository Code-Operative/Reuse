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
</div>