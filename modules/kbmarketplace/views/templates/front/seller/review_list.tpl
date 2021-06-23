<div class="kb-content">
    <div class="kb-content-header">
        <h1>{l s='My Reviews' mod='kbmarketplace'}</h1>
        <div class="clearfix"></div>
    </div>
    <div class='kb-vspacer5'></div>
    {if isset($kbfilter)}
        {$kbfilter nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

    {/if}
    
    {if isset($kbmutiaction)}
        {$kbmutiaction nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

    {/if}
    
    {if isset($kblist)}
        <div class="kb-vspacer5"></div>
        {$kblist nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

    {/if}
    <script type="text/javascript">
        var review_view_url = "{$get_review_detail_url|escape:'htmlall':'UTF-8'}";
    </script>
    
    <div id="kb-seller-review-view-popup" style="display:none;">
        <div class="kb-overlay"></div>
        <div class="kb-modal">
            <div class='kb-model-content-loader'><div class="kb-modal-loading-img"></div></div>
            <div class='kb-model-content'>
                <div class="kb-modal-header">
                    <h1 id='review_by_customer'>--</h1>
                    <span class="kb-modal-close" data-modal="kb-seller-review-view-popup">X</span>
                </div>
                <div class="kb-modal-content">
                    <div class="kb-big-loader"></div>
                    <div class="kb-row">
                        <div class="review-popup-time">
                            {l s='POSTED ON' mod='kbmarketplace'}: <span id="review-time" class="btxt">--</span>
                        </div>
                    </div>
                    <div class="kb-vspacer5"></div>
                    <div class="kb-row">
                        <div class="in-display right-offset15 btxt">{l s='Rating' mod='kbmarketplace'}:</div>
                        <div class="in-display">
                            <div class="vss_seller_ratings"><div class="vss_rating_unfilled">★★★★★</div><div id='rating_percent_display' class="vss_rating_filled" style="width:0%">★★★★★</div></div>
                        </div>
                    </div>
                    <div class="kb-vspacer5"></div>
                    <div class="kb-row btxt b-border">
                        {l s='Title' mod='kbmarketplace'}:
                    </div>
                    <div class="kb-row">
                        <pre><p id="review-title">--</p></pre>
                    </div>
                    <div class="kb-vspacer5"></div>
                    <div class="kb-row btxt b-border">
                        {l s='Comment' mod='kbmarketplace'}:
                    </div>
                    <div class="kb-row">
                        <pre><p id="review-comment">--</p></pre>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    
</div>
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
