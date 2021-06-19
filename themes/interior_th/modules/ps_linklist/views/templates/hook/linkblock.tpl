<div class="col-lg-4 links">
  <div class="row">
  {foreach $linkBlocks as $linkBlock}
    {if $linkBlock.hook == 'displayNav1'}
    <div id="_desktop_link_block">
    {/if}
    <div class="col-lg-6 wrapper">
      <p class="h3 hidden-md-down">{$linkBlock.title}</p>
      {assign var=_expand_id value=10|mt_rand:100000}
      <div class="title clearfix hidden-lg-up" data-target="#footer_sub_menu_{$_expand_id}" data-toggle="collapse">
        <span class="h3">{$linkBlock.title}</span>
        <span class="pull-xs-right">
          <span class="navbar-toggler collapse-icons">
            <i class="material-icons add">&#xE313;</i>
            <i class="material-icons remove">&#xE316;</i>
          </span>
        </span>
      </div>
      <ul id="footer_sub_menu_{$_expand_id}" class="collapse">
        {foreach $linkBlock.links as $link}
          <li>
            <a
                id="{$link.id}-{$linkBlock.id}"
                class="{$link.class}"
                href="{$link.url}"
                title="{$link.description}"
                {if !empty($link.target)} target="{$link.target}" {/if}
                >
              {$link.title}
            </a>
          </li>
        {/foreach}
      </ul>
    </div>
  {if $linkBlock.hook == 'displayNav1'}
  </div>
  {/if}
  {/foreach}
  </div>
</div>
