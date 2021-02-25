    <div id="kbmp-seller-info" class="tabs kbmp-_block box-info-product">
    <div class="kbmp-_row">
        <div class="kbmp-_inner_block"><span class="title">{l s='Sold By' mod='kbmarketplace'}:</span></div>
        <div class="kbmp-_inner_block"><a href="{KbGlobal::getSellerLink($id_seller) nofilter}{* Variable contains HTML/CSS/JSON, escape not required *}"><span class="">{$seller_title}</span></a></div>

    </div>
    <div class="kbmp-_row">
        <div class="kbmp-_inner_block" style="position:relative;">
            <a href="{$link->getModuleLink('kbmarketplace', 'sellerfront', ['render_type' => 'sellerreviews', 'id_seller' => $id_seller], (bool)Configuration::get('PS_SSL_ENABLED')) nofilter}{* Variable contains HTML/CSS/JSON, escape not required *}" title="{l s='Total %s review(s)'|sprintf:$seller_review_count mod='kbmarketplace'}">
            <div class="vss_seller_ratings">
                <!-- Do not customise it -->
                <div class="vss_rating_unfilled">★★★★★</div>
                
                <!-- Set only width in percentage according to rating -->
                <div class="vss_rating_filled" style="width:{$seller_rating|string_format:'%.2f'}%">★★★★★</div>
            </div>
            </a> {* Variable contains HTML/CSS/JSON, escape not required *}

        </div>
        <div class="kbmp-_inner_block"><a title="{l s='Total %s review(s)'|sprintf:$seller_review_count mod='kbmarketplace'}" href="{$link->getModuleLink('kbmarketplace', 'sellerfront', ['render_type' => 'sellerreviews', 'id_seller' => $id_seller], (bool)Configuration::get('PS_SSL_ENABLED')) nofilter}{* Variable contains HTML/CSS/JSON, escape not required *}" class="vss_active_link vss_read_review_bck"><span class="">{l s='View Reviews' mod='kbmarketplace'}</span></a></div> 
{if $display_new_review}
        <div class="kbmp-_inner_block"><a href="{$link->getModuleLink('kbmarketplace', 'sellerfront', ['render_type' => 'sellerreviews', 'id_seller' => $id_seller], (bool)Configuration::get('PS_SSL_ENABLED')) nofilter}{* Variable contains HTML/CSS/JSON, escape not required *}" class="vss_active_link vss_write_review_bck"><span class="">{l s='Write Review' mod='kbmarketplace'}</span></a></div>
{/if}
    </div>
    <div class="kbmp-_row" style="padding-top:10px;">
        <i class="kb-material-icons">view_list</i><a href="{$link->getModuleLink('kbmarketplace', 'sellerfront', ['render_type' => 'sellerproducts', 'id_seller' => $id_seller], (bool)Configuration::get('PS_SSL_ENABLED')) nofilter}{* Variable contains HTML/CSS/JSON, escape not required *}" style="padding-left:7px;font-size:13px;">{l s='View more products of this seller' mod='kbmarketplace'}</a> 
        
    </div>
    {if isset($is_enabled_seller_shortlisting) && $is_enabled_seller_shortlisting == 1}
    <div class="kbmp-_row" style="padding-top:10px;">
        {* chnages by rishabh jain for seller shortlisting *}
            
        <i class="kb-material-icons shortlist_link" style="{if isset($is_already_added) && $is_already_added == 1}color: #ef4545;{else}color: grey;{/if}">&#xe87d;</i><a href="javascript:addShortListSeller(this, {$id_seller});" class="sfl_product_link_{$id_seller}" style="padding-left:7px;font-size:13px;">{if isset($is_already_added) && $is_already_added == 1}{l s='Favourite Seller' mod='kbmarketplace'}{else}{l s='Mark Seller as Favourite' mod='kbmarketplace'}{/if}</a>
        {* changes over *}
   </div>
   {/if}
    {hook h="displayKbSellerOnProductView" id_seller=$id_seller}
</div>
    <script>
        var ajaxurl = "{$ajaxurl nofilter}";
        var sfl_shortlist_text= "{l s='Mark Seller as Favourite' mod='kbmarketplace'}";
        var sfl_already_added_text= "{l s='Favourite Seller' mod='kbmarketplace'}";
    </script>
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
* @copyright 2016 knowband
* @license   see file: LICENSE.txt
*}