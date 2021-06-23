<div id="sfl_shorlist_large_link_product" class="sfl_shorlist_large_link" >
{*    <span onclick="addShortList(this, {$sfl_id_product})" class="sfl_product_link_{$sfl_id_product}" id="save-for-later-shortlist">{$sfl_label}</span>*}
 <span onclick="addShortList(this, {$sfl_id_product})" class="sfl_product_link_{$sfl_id_product} wishlistHeart" id="save-for-later-shortlist"><i class="fa fa-heart" style="color:{$icon_color};" ></i>&nbsp;&nbsp;{$sfl_label}</span>

</div>
 
 <style>												
    .wishlistHeart i{
         cursor:pointer;    
         font-size: 17px;
    }																								
 </style>
{*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer tohttp://www.prestashop.com for more information.display_shortlist_link.tpl
* We offer the best and most useful modules PrestaShop and modifications for your online store.
*
* @category  PrestaShop Module
* @author    knowband.com <support@knowband.com>
* @copyright 2015 knowband
* @license   see file: LICENSE.txt
*
* Description
*
* Preserve the shorlisted products value
*}
