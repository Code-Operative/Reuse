{*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer tohttp://www.prestashop.com for more information.
* We offer the best and most useful modules PrestaShop and modifications for your online store.
*
* @category  PrestaShop Module
* @author    knowband.com <support@knowband.com>
* @copyright 2017 Knowband
* @license   see file: LICENSE.txt
*}

<script>  var product_remove_txt = "{l s='Product is successfully deleted from wishlist' mod='saveforlater'}";
    var valid_quantity = "{l s='Please Enter valid Quantity' mod='saveforlater'}";</script>

<div class="wishlistTable cart-grid row" style="display:none; ">
    {*  <div class="cart col-xs-12 col-lg-2">  &nbsp;</div>*}
    <div class=" card wish-container col-xs-12 col-lg-8 " style="max-height: 500px; overflow-y: scroll; margin-top: 0px;">
        <div class="card-block">
            <h1 class="h1">{l s='WishList Summary' mod='saveforlater'}</h1>
        </div>

        <div id="product_stock_message" style="display:none;" >{l s='There are not enough products in stock.' mod='saveforlater'}</div>
        <div class="ajax_loader">
            <div id="loading_img" align="center">
                <img src="{$img_location|escape:'quotes':'UTF-8'}loading.gif" style="opacity: 1;  top: 10%; position: absolute;"> 
            </div>
        </div>
        <hr>

        {if count($shortlisted_products) == 0}

            <input type="hidden" id="sfl_total_shortlisted" name="sfl_total_shortlisted" value="{count($shortlisted_products)}" />

            <div class="no_data" style="    margin-top: 1%; margin-bottom: 1%; text-align: center;">
                <span>{l s='Sorry!' mod='saveforlater'}</span>
                {l s='Add products into Wishlist.' mod='saveforlater'}
            </div>
        {else}
            <div class="cart-overview js-cart" data-refresh-url="">
                <ul class="cart-items">
                    {foreach $shortlisted_products as $short}

                        <li class="cart-item shortlist_products" >
                            <div class="product-line-grid">
                                <!--  product left content: image-->
                                <div class="product-line-grid-left col-md-3 col-xs-4">	<span class="product-image media-middle">
                                        <a href="{$short['url']}"><img width="60" src="{$link->getImageLink($short['link_rewrite'], $short['id_image'] , 'home_default')}"></a>
                                    </span>
                                </div>
                                <!--  product left body: description -->
                                <div class="product-line-grid-body col-md-4 col-xs-8">
                                    <div class="product-line-info"> <a href="{$short['url']}">{$short['name']}    </a>
                                    </div>

                                    <br/>
                                    <div class="product-line-info"> {foreach from=$short['attributes'] key=k item=v}<small class="cart_ref"> {$v.group} : {$v.attribute}</small>{/foreach}
                                    </div>

                                </div>
                                <!--  product left body: description -->
                                <div class="product-line-grid-right product-line-actions col-md-5 col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-4 hidden-md-up"></div>
                                        <div class="col-md-10 col-xs-6">
                                            <div class="row">
                                                <div class="col-md-6 col-xs-6 qty">
                                                    <!--05072019-->
                                                    <input type="hidden"  id="kb_minimal_quantity_{$short['product_id']}" value="{$short['minimal_quantity']}" class="minimumm_wishProductQty"/>
                                                    <input type="number"  id="kb_product_quantity_{$short['product_id']}" value="1" class="wishProductQty" onfocusout="checkQuanity(this.value,{$short['minimal_quantity']},{$short['product_id']},{$short['quantity']})"/>

                                                    <!--05072019-->
                                                </div>
                                                <div class="col-md-6 col-xs-2 price"> <span class="product-price">
                                                        <strong>
                                                            {$short['price_formatted']} 
                                                        </strong>
                                                        {if $short['show_slashed_price']}
                                                            <div class="slashed_price">{$short['price_before_formatted']}</div>
                                                        {/if}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-2 text-xs-right">
                                            <div class="cart-line-product-actions">
                                                {if $short['quantity'] > 0 || $short['buy_out_of_stock'] == 1 }
                                                    {* {if !in_array($short['product_id'], $cart_products) }*}

                                                    <a data-toggle="add_to_cart_tooltip"  title="{l s='Add To Cart' mod='saveforlater'}" class="add-to-cart" rel="nofollow" href='javascript:void(0)' onclick="addProductIntoCart({$short['product_id']})">	 <i class="material-icons pull-xs-left">add_shopping_cart</i></a>

                                                    {*   {/if}*}
                                                {/if}
                                                <a class="remove-from-cart" rel="nofollow" href="javascript:void(0)" onclick="removeProductFromWishlist(this, {$short['product_id']}, 'sfl');"><i class="material-icons pull-xs-left">delete</i></a>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    {/if}
    <!--EOC Monika 05072019-->

</div>

<style>
    .wishProductQty {
        width: 100%;
        text-align: center;
        background: transparent;
        border: 1px solid #d9d9d9;
        padding: 10px 5px;
        max-width: 60px;
        margin: 0 auto;
    }
    a.add-to-cart i {
        display: inline-block;
        font-size: 30px;
    }
    .add-to-cart {
        display: inline-block;
    }
    .card.wish-container {
        margin-top: 30px;
    }
</style>