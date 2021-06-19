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


{extends file=$layout}
{if $generated_url != ""}
    {block name='head' append}

        <meta property="og:title" content="{l s='My Wishlist' mod='saveforlater'}">
        <meta property="og:description" content="">
        <meta property="og:image" content="{$base_dir}saveforlater/views/img/front/Wishlist.png">
        <meta property="og:url" content="{$generated_url nofilter}">{*Variable contains a URL, escape not required*}

    {/block}
{/if}
{capture name=path}
    {l s='My Wishlist' mod='saveforlater'}
{/capture}
{block name='content'}

    <script type="text/javascript">
        var sry_txt = "{l s='Sorry' mod='saveforlater'}";
        var no_sfl_data = "{l s='No data found. Add products to shortlist first.' mod='saveforlater'}";
        var ajaxwishlist = "{$ajaxwishlist}";

    </script>

    <div>

        {if $generated_url != ""}

            {if !empty($kb_sfl_config['social_sharing']['enable']) && $kb_sfl_config['social_sharing']['enable'] eq 1 }


                <div id="share_wishlist" style="font-size: 25px; padding-bottom: 10px; "> {l s='Sharing your wishlist with your friends.' mod='saveforlater'}</div></br>

                <div class="velsof_container share_container" style="display: inline-flex;"> 

                    {if !empty($kb_sfl_config['social_sharing']['whatsapp']) && $kb_sfl_config['social_sharing']['whatsapp'] eq 1 && $is_mobile eq 1}
                        <div id='block_right' class='block_right_class'>

                            <div class="whatsapp-share-button" style="display: inline;"><a target="_blank" href="whatsapp://send?text={$generated_url}" data-action="share/whatsapp/share" >{*Variable contains a URL, escape not required*}
                                    <img  src='{$base_dir}saveforlater/views/img/front/whatsap.png' width="150" height="32"></a></div>

                            <div id='close_in' class='close_div'> </div>           
                        </div>
                    {/if}

                    {if !empty($kb_sfl_config['social_sharing']['facebook']) && $kb_sfl_config['social_sharing']['facebook'] eq 1}
                        <div id='block_right' class='block_right_class'>


                            <div class="fb-share-button" style="display: inline;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={$generated_url nofilter}" >{*Variable contains a URL, escape not required*}
                                    <img  src='{$base_dir}saveforlater/views/img/front/fb_large.png'></a></div>

                            <div id='close_in' class='close_div'> </div>           
                        </div>
                    {/if}  

                    {if !empty($kb_sfl_config['social_sharing']['twitter']) && $kb_sfl_config['social_sharing']['twitter'] eq 1}
                        {*changes by tarun*}
                        <div id='block_right' class='block_right_class'>
                            <div class="twitter-share-button" style="padding-left: 20px;"><a target="_blank" href="http://twitter.com/intent/tweet?text={l s='My Wishlist' mod='saveforlater'}+{$generated_url}" >{*Variable contains a URL, escape not required*}
                                    <img  src='{$base_dir}saveforlater/views/img/front/twitter_large.png'></a></div>

                            <div id='close_in' class='close_div'> </div>           
                        </div>
                    {/if}  

                </div>

            {/if}


        {/if}
    </div>

    <div class="products_sfl" style=" padding-top: 20px;">
        <div class="ajax_loader wishlist_ajax_loader">
            <div id="loading_img" align="center">
                <img src="{$base_dir}saveforlater/views/img/loading.gif" style="opacity: 1; position: absolute; top: 20%; left:40%;"> 
            </div>
        </div>

        <div class="container">
            <input type="hidden" id="sfl_total_shortlisted" name="sfl_total_shortlisted" value="{count($shortlisted_products)}" />
            {if count($shortlisted_products) == 0}
                <div class="no_data">
                    <span>{l s='Sorry!' mod='saveforlater'}</span><br>
                    {l s='No data found. Add products to shortlist first.' mod='saveforlater'}
                </div>
            {else}
                {foreach $shortlisted_products as $short}
                    <div id="sfl_shortlisted_row_{$short['product_id']}" class="product_item shortlist_products">
                        <div class="product_image">
                            <a href="{$short['url']}"><img width="60" src="{$short['image_path']}"></a>
                        </div>
                        <div class='product_detail'>
                            <div class="sfl_product_left">
                                <div class='product_title'>   <a href="{$short['url']}">{$short['name']}</a>
                                </div>

                                <ul class="actionOptions">
                                    <li class="sfl_buy">
                                        {if $kb_sfl_config['recently_view']['enable_buy_btn'] eq 1}
                                            {if $short['quantity'] > 0 || $short['buy_out_of_stock'] == 1 }
                                                <div class="sfl_buy_btn">                            
                                                    <a class='velsof_buy' href='javascript:void(0)' onclick="buyProduct({$short['product_id']});" style="background-color: {$kb_sfl_config['general']['buy_color']};">{l s='BUY' mod='saveforlater'}</a>
                                                </div>
                                            {/if}
                                        {/if}
                                    </li>
                                    <li class="sfl_remove">
                                        {if $customer == 1}
                                            <div class='remove_button remove_product' onclick="removeProductFromList(this, {$short['product_id']}, 'sfl')">
                                                <span class="fa fa-trash"></span>
                                                {l s='Remove' mod='saveforlater'}
                                            </div>
                                        {/if}
                                    </li>
                                </ul>
                            </div>
                            <div class="sfl_product_right">

                                <div class="sflPriceSection">
                                    <div class="sfl_product_price">
                                        <div class="product_price">
                                            <div class="sfl_calculated_price">{$short['price_formatted']}</div>
                                            {if $short['show_slashed_price']}
                                                <div class="slashed_price">{$short['price_before_formatted']}</div>
                                            {/if}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                {/foreach}
            {/if}
        </div>


        <div class="svl_pagination">
            <div class="product-count" style="width:40%;text-align:left;">{l s='Showing' mod='saveforlater'} {$start} - {$end } {l s='of' mod='saveforlater'} {$total_shortlisted} {l s='Items' mod='saveforlater'}</div>

            {if $total_pages > 1}
                <div class="bottom-pagination-content clearfix" style="margin-left: 40%;">

                    <!-- Pagination -->
                    <ul class="pagination" >
                        {* for left most page *}
                        {if $total_pages > 1}

                            {if $kbpage neq 1}
                                <li>
                                    <a href='javascript:void(0)' onclick="setPageWishlist({1})">
                                        <span><<</span>
                                    </a>
                                </li>
                            {else}
                                <li class="active current">
                                    <span><span><<</span></span>
                                </li>
                            {/if}    
                        {/if}    
                        {* for 1 page previous to current page *}
                        {if $total_pages > 1}
                            {if $kbpage-1 > 0}

                                <li>
                                    <a href='javascript:void(0)' onclick="setPageWishlist({$kbpage-1})">
                                        <span><</span>
                                    </a>
                                <li>
                                {else}

                                    {if $kbpage neq 1}
                                    <li>
                                        <a href='javascript:void(0)' onclick="setPageWishlist({$kbpage})">
                                            <span><</span>
                                        </a>
                                    </li>
                                {else}
                                    <li class="active current">
                                        <span><span><</span></span>
                                    </li>
                                {/if}
                            {/if}    
                        {/if}    
                        {* if at last page then also show last-2 page *} 
                        {if $total_pages > 1}
                            {if $kbpage-2 >= 1 && $kbpage eq $total_pages}

                                <li>
                                    <a href='javascript:void(0)' onclick="setPageWishlist({$kbpage-2})">
                                        <span>{$kbpage-2}</span>
                                    </a>
                                </li>    
                            {/if}   
                        {/if}
                        {* for middle of pages *}
                        {for $count=1 to $total_pages}

                            {assign var=params value=[
                           
                            'page' => $count
                            ]}
                            {if $count eq $kbpage+1 || $count eq $kbpage-1 || $kbpage eq $count }
                                {if $kbpage ne $count}
                                    <li>
                                        <a href='javascript:void(0)' onclick="setPageWishlist({$count})">
                                            <span>{$count}</span>
                                        </a>
                                    </li>
                                {else}
                                    <li class="active current">
                                        <span><span>{$count}</span></span>
                                    </li>
                                {/if}
                            {/if}
                        {/for}
                        {* if  current page is 1 then also show 3rd page if exist *}
                        {if $total_pages > 1}
                            {if $kbpage+2 le $total_pages && $kbpage eq 1}

                                <li>
                                    <a href='javascript:void(0)' onclick="setPageWishlist({$kbpage+2})">
                                        <span>{$kbpage+2}</span>
                                    </a>
                                </li>    
                            {/if}   
                        {/if}
                        {* for next page *}
                        {if $total_pages > 1}
                            {if $kbpage+1 < $total_pages}

                                <li>
                                    <a href='javascript:void(0)' onclick="setPageWishlist({$kbpage+1})">
                                        <span>></span>
                                    </a>
                                </li>
                            {else}

                                {if $kbpage neq $total_pages}
                                    <li>
                                        <a href='javascript:void(0)' onclick="setPageWishlist({$total_pages})">
                                            <span>></span>
                                        </a>
                                    </li>
                                {else}
                                    <li class="active current">
                                        <span><span>></span></span>
                                    </li>
                                {/if}
                            {/if}

                            {* for last page i.e >> *}
                        {/if}    
                        {if $total_pages > 1}

                            {if $kbpage neq $total_pages}
                                <li>
                                    <a href='javascript:void(0)' onclick="setPageWishlist({$total_pages})">
                                        <span>>></span>
                                    </a>
                                </li>
                            {else}
                                <li class="active current">
                                    <span><span>>></span></span>
                                </li>
                            {/if}
                        {/if}
                    </ul>

                    <!-- /Pagination -->
                </div>
            {/if}

        </div>
    </div>
{/block}
{*  /* End changes done by Shubham */*}