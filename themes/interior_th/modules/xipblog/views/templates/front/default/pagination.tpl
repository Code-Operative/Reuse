
<nav class="bottom-pagination-content row clearfix">
  {*<div class="col-md-3">
    {l s='Showing %from%-%to% of %total% item(s)' d='Shop.Theme.Catalog' sprintf=['%from%' => $pagination.items_shown_from ,'%to%' => $pagination.items_shown_to, '%total%' => $pagination.total_items]}
  </div>*}
  <div class="col-md-9">
    <div class="pagination">
      <ul class="page-list clearfix">
        {foreach from=$pagination.pages item="page"}
          <li {if $page.current} class="active current" {/if}>
            {if $page.type === 'spacer'}
              <span class="spacer">&hellip;</span>
            {else}
              <a
                rel="{if $page.type === 'previous'}prev{elseif $page.type === 'next'}next{else}nofollow{/if}"
                href="{$page.url}"
                class="{if $page.type === 'previous'}previous {elseif $page.type === 'next'}next {/if}{['disabled' => !$page.clickable, 'js-blog-link' => true]|classnames}"
              >
                {if $page.type === 'previous'}
                  <i class="material-icons">&#xE314;</i>
                {elseif $page.type === 'next'}
                  <i class="material-icons">&#xE315;</i>
                {else}
                  {$page.page}
                {/if}
              </a>
            {/if}
          </li>
        {/foreach}
      </ul>
    </div>
  </div>
</nav>
