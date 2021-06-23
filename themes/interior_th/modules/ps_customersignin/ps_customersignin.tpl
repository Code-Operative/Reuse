<div id="_desktop_user_info">
    <div class="header_user_info dropdown js-dropdown">
      <span class="expand-more header_user_info__toggle-btn font-profile" data-toggle="dropdown" aria-expanded="false">
      </span>
      <div class="dropdown-menu header_user_info__list" aria-labelledby="dLabel">
        <div>
          {if $logged}
            <a
              class="logout "
              href="{$logout_url}"
              title="{l s='Sign out' d='Shop.Theme.Actions'}"
              rel="nofollow"
            >
              {l s='Sign out' d='Shop.Theme.Actions'}
            </a>
            <a
              class="account"
              href="{$my_account_url}"
              title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}"
              rel="nofollow"
            >
              <i class="font-profile"></i>
              <span>{$customerName}</span>
            </a>
          {else}
            <a
              href="{$my_account_url}"
              title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}"
              rel="nofollow"
            >
              <i class="font-profile"></i>
              <span>{l s='Sign in' d='Shop.Theme.Actions'}</span>
            </a>
          {/if}
        </div>
      </div>
  </div>
</div>
