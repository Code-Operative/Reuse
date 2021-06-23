{if $product.images}
    <div class="shoppingcart_img">
        <img src="{$product.images.0.bySize.small_default.url}" title="{$product.name}"/>
    </div>
{/if}
<div class="cart-info">
    <span class="product-name">
        <span class="quantity">{$product.quantity}</span> {$product.name}
    </span>
</div>
<span class="product-price">{$product.price}</span>
{if $product.customizations|count}
    <ul class="cart-customizations">
        {foreach from=$product.customizations item='customization'}
            <li class="customizations-items">
                <div class="quantity">{$customization.quantity}
                    <a href="{$customization.remove_from_cart_url}" title="{l s='remove from cart' d='Shop.Theme.Actions'}" class="remove-from-cart" rel="nofollow">
                    {*{l s='Remove' d='Shop.Theme.Actions'}*}
                    <i class="material-icons">&#xE872;</i>
                    </a>
                </div>
                <ul class="custom-fields">
                    {foreach from=$customization.fields item='field'}
                        <li class="custom-item">
                            <span class="custom-title">{$field.label}</span>
                            {if $field.type == 'text'}
                                <span>{$field.text nofilter}</span>
                            {elseif $field.type == 'image'}
                                <img src="{$field.image.small.url}">
                            {/if}
                        </li>
                    {/foreach}
                </ul>
            </li>
        {/foreach}
    </ul>
{/if}
<a  class="remove-from-cart"
    rel="nofollow"
    href="{$product.remove_from_cart_url}"
    data-link-action="remove-from-cart"
    title="{l s='remove from cart' d='Shop.Theme.Actions'}"
>
    <i class="material-icons">&#xE872;</i>
    {*{l s='Remove' d='Shop.Theme.Actions'}*}
</a>
