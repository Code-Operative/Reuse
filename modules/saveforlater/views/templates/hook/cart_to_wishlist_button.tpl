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


{if !in_array($product_id, $already_added) }
    <div class="" id="add_to_wishlist_button">                            
        <a  data-toggle="add_to_wishlist_tooltip"  title="{l s='Add To Wishlist' mod='saveforlater'}" class='' href='javascript:void(0)' onclick="moveProductCartToWishlist({$product_id}, {$product_id_attribute}, {$product_id_customization});"  >
            <span class="link-item"><i class="material-icons">
                    favorite
                </i></span></a>

    </div>


{/if}

