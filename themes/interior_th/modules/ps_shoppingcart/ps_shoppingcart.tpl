<div id="_desktop_cart" class="col-md-1 hidden-md-down">
  <input type="checkbox" id="toggle-cart" class="no-style">
  <div class="blockcart cart-preview {if $cart.products_count > 0}active{else}inactive{/if}" data-refresh-url="{$refresh_url}">
    <label class="cart-header" for="toggle-cart">
        <div class="inner-wrapper">
            <i class="font-shopping-cart"></i>
            <span class="cart-products-count">{$cart.products_count}</span>
        </div>
    </label>
    <div class="body cart-hover-content">
         <ul class="cart-list">
         {foreach from=$cart.products item=product}
             <li class="cart-wishlist-item">
             {include 'module:ps_shoppingcart/ps_shoppingcart-product-line.tpl' product=$product}
             </li>
         {/foreach}
         </ul>
         <div class="cart-subtotals">
             {foreach from=$cart.subtotals item="subtotal"}
             <div class="{$subtotal.type}">
                 <span class="value">{$subtotal.value}</span>
                 <span class="label">{$subtotal.label}</span>
             </div>
             {/foreach}
            <div class="cart-total">
                 <span class="value">{$cart.totals.total.value}</span>
                 <span class="label">{$cart.totals.total.label}</span>
            </div>
         </div>
         <div class="cart-wishlist-action">
             {*<a class="cart-wishlist-viewcart" href="{$cart_url}">view cart</a>*}
             <a class="btn cart-wishlist-checkout" href="{$cart_url}"{*href="{$urls.pages.order}"*}>{l s='Checkout' d='Shop.Theme.Actions'}</a>
         </div>
     </div>
  </div>
</div>

