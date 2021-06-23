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
<script type="text/javascript">
    var sry_txt = "{l s='Sorry' mod='saveforlater'}";
    var no_sfl_data = "{l s='No data found. Add products to shortlist first.' mod='saveforlater'}";
    var no_rviewed_data = "{l s='No recently viewed products found.' mod='saveforlater'}";
    var try_again_msg = "{l s='Sorry! Please try again after some time.' mod='saveforlater'}";
    var request_failed_msg = "{l s='Request Failed' mod='saveforlater'}";
    var product_remove_msg = "{l s='Error occurred while removing product.' mod='saveforlater'}";
    var ajaxurl = "{$ajaxurl nofilter}"; {*Variable contains JS, escape not required*}
    {*Variable contains a URL, escape not required*}
    var buy_button_background = '{$kb_sfl_config['general']['buy_color']}';
    var saveforlater_enable = {$saveforlater_enable};
    var loader_image = "{$img_location nofilter}loading.gif"; {*Variable contains a URL, escape not required*}
   
    var sfl_already_added_products = [];  //to be add
    {foreach $sfl_aleady_added_products as $added}
    sfl_already_added_products.push({$added});
    {/foreach}
    var sfl_shortlist_text = "{$sfl_shorlist_text}";
    var sfl_already_added_text = "{$sfl_already_added_text}";
</script>
<div id='sfl_add_product'> 
    <input type="hidden" name="sfl_shortproduct_id" id='sfl_shortproduct_id' value="0">
</div>


<style>
    .bar_item .stored-settings
    {
        -moz-box-shadow: 0 0 0 4px {$kb_sfl_config['general']['border_color']};
        -webkit-box-shadow: 0 0 0 4px {$kb_sfl_config['general']['border_color']};
        box-shadow: 0 0 0 4px {$kb_sfl_config['general']['border_color']};
    }
    .bar_item #recommend_popup
    {
        -moz-box-shadow: 0 0 0 4px {$kb_sfl_config['general']['border_color']};
        -webkit-box-shadow: 0 0 0 4px {$kb_sfl_config['general']['border_color']};
        box-shadow: 0 0 0 4px {$kb_sfl_config['general']['border_color']};
    }
</style>

<div id='sfl_add_product'> 
    <input type="hidden" name="sfl_shortproduct_id" id='sfl_shortproduct_id' value="0">
</div>


<style>
    .stored-settings
    {
        -moz-box-shadow: 0 0 0 4px {$kb_sfl_config['general']['border_color']};
        -webkit-box-shadow: 0 0 0 4px {$kb_sfl_config['general']['border_color']};
        box-shadow: 0 0 0 4px {$kb_sfl_config['general']['border_color']};
    }
</style>

{if $kb_sfl_config['general']['enable']}
    <div class="bottom_bar" style="background: {$kb_sfl_config['general']['bar_color']} {if $kb_sfl_config['saveforlater']['enable'] eq 0 && $kb_sfl_config['recently_view']['enable'] eq 0 && $kb_sfl_config['recommendation']['enable'] eq 0}visibility: hidden; border-top: none;{/if}">
        {if $kb_sfl_config['saveforlater']['enable'] == 1}
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


            <span class='bar_item'>
                <span class='velsof_item' id="border_short">
                    <span class="wishbar_icon fa fa-heart" id='shortlist_icon'></span> 
                    <span class="bar_text">{$kb_sfl_config['saveforlater'][$id_lang]|escape:'htmlall':'UTF-8'}</span>
                    <span class="circleCount" id="shortlist_count" style="visibility: visible;">{count($shortlisted_products)}</span>
                </span>
                <span class="velsof_popup stored-settings" id="short_popup">
                    <div class="headers">
                        <div class="main_header">
                            <label style='color: {$kb_sfl_config['saveforlater']['color']}; {if $kb_sfl_config['saveforlater']['italic'] eq 1}font-style: italic;{/if} {if $kb_sfl_config['saveforlater']['bold'] eq 1}font-weight: bold;{/if}'><span class="wishhead_icon fa fa-heart" ></span>{$kb_sfl_config['saveforlater'][{$id_lang|escape:'htmlall':'UTF-8'}]}</label>
                            <span class="list_count" id="short_count">(<label>{count($shortlisted_products)}</label>)</span>
                            <a title="{l s='Close' mod='saveforlater'}" id="hide_short" class="close_popup fa fa-times"></a>
                        </div>
                    </div>
                    <div class="velsof_product_list" id="velsof_list">
                        <div class="backImage">
                            <span class="fa fa-heart"></span>
                        </div>
                        <div class="velsof_container">
                            <div class="ajax_loader">
                                <div id="loading_img" align="center">
                                    <img src="{$img_location}loading.gif" style="opacity: 1;"> 
                                </div>
                            </div>
                            {if count($shortlisted_products) <= 0}
                                <div class="no_data">
                                    <span>{l s='Sorry!' mod='saveforlater'}</span><br>
                                    {l s='No data found. Add products to shortlist first.' mod='saveforlater'}
                                </div>
                            {else}
                                {foreach $shortlisted_products as $short}
                                    <div id="sfl_shortlisted_row_{$short['product_id']}" class="product_item shortlist_products">
                                        <div class="product_image">
                                            <a href="{$short['url']}"><img width="60" src="{$link->getImageLink($short['link_rewrite'], $short['id_image'] , 'home_default')}"></a>
                                        </div>
                                        <div class='product_detail'>
                                            <div class="sfl_product_left">
                                                <div class='product_title'>   <a href="{$short['url']}">{$short['name']|escape:'htmlall':'UTF-8'}</a>
                                                </div>

                                                <ul class="actionOptions">
                                                    <li class="sfl_buy">
                                                        {if $kb_sfl_config['saveforlater']['enable_buy_btn'] eq 1}
                                                            {if $short['quantity'] > 0 || $short['buy_out_of_stock'] eq 1 }
                                                                <div class="sfl_buy_btn">                            
                                                                    <a class='velsof_buy' href='javascript:void(0)' onclick="buyProduct({$short['product_id']});" style="background-color: {$kb_sfl_config['general']['buy_color']};">{l s='BUY' mod='saveforlater'}</a>
                                                                </div>
                                                            {/if}
                                                        {/if}
                                                    </li>
                                                    <li class="sfl_remove">
                                                        <div class='remove_button remove_product' onclick="removeProductFromList(this, {$short['product_id']}, 'sfl')">
                                                            <span class="fa fa-trash"></span>
                                                            {l s='Remove' mod='saveforlater'}
                                                        </div>
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
                    </div>
                </span>
            </span>
        {/if}

        {if $kb_sfl_config['recently_view']['enable'] == 1}
            <span class='bar_item'>
                <span class='velsof_item' id="border_recent">
                    <span class="wishbar_icon fa fa-eye" id='recent_icon'></span> 
                    <span class="bar_text">{$kb_sfl_config['recently_view'][$id_lang]|escape:'htmlall':'UTF-8'}</span>
                    <span class="circleCount" id="recentlist_count" style="visibility: visible;">{count($recent_viewed)}</span>
                </span>
                <span class="velsof_popup stored-settings" id="recent_popup">
                    <div class="headers">
                        <div class="main_header">
                            <label style='color: {$kb_sfl_config['recently_view']['color']}; {if $kb_sfl_config['recently_view']['italic'] eq 1}font-style: italic;{/if} {if $kb_sfl_config['recently_view']['bold'] eq 1}font-weight: bold;{/if}'><span class="fa fa-eye"></span>{$kb_sfl_config['recently_view'][{$id_lang|escape:'htmlall':'UTF-8'}]}</label>
                            <span class="list_count" id="recent_count">(<label>{count($recent_viewed)}</label>)</span>
                            <a title="{l s='Close' mod='saveforlater'}" id="hide_recent" class="close_popup fa fa-times"></a>
                        </div>
                    </div>
                    <div class="velsof_product_list"><div class="backImage">
                            <span class="fa fa-eye"></span>
                        </div>

                        <div class="velsof_container">
                            <div class="ajax_loader">
                                <div id="loading_img" align="center">
                                    <img src="{$img_location}loading.gif" style="opacity: 1;"> 
                                </div>
                            </div>
                            {if count($recent_viewed) <= 0}
                                <div class="no_data">
                                    <span>{l s='Sorry!' mod='saveforlater'}</span><br>
                                    {l s='No recently viewed products found.' mod='saveforlater'}
                                </div>
                            {else}
                                {foreach $recent_viewed as $pro}
                                    <div id="sfl_recent_viewed_row_{$pro['product_id']}" class="product_item">
                                        <div class="product_image">
                                            <a href="{$pro['url']}"><img width="60" src="{$link->getImageLink($pro['link_rewrite'], $pro['id_image'] , 'home_default')}"></a>
                                        </div>
                                        <div class='product_detail'>
                                            <div class="sfl_product_left">
                                                <div class='product_title'>   <a href="{$pro['url']}">{$pro['name']|escape:'htmlall':'UTF-8'}</a>
                                                </div>

                                                <ul class="actionOptions">
                                                    <li class="sfl_buy">
                                                        {if $kb_sfl_config['recently_view']['enable_buy_btn'] eq 1}
                                                            {if $pro['quantity'] > 0 || $pro['buy_out_of_stock'] eq 1 }
                                                                <div class="sfl_buy_btn">                            
                                                                    <a class='velsof_buy' href='javascript:void(0)' onclick="buyProduct({$pro['product_id']});" style="background-color: {$kb_sfl_config['general']['buy_color']};">{l s='BUY' mod='saveforlater'}</a>
                                                                </div>
                                                            {/if}
                                                        {/if}
                                                    </li>
                                                    <li class="sfl_remove">
                                                        <div class='remove_button remove_product' onclick="removeProductFromList(this, {$pro['product_id']}, 'rv')">
                                                            <span class="fa fa-trash"></span>
                                                            {l s='Remove' mod='saveforlater'}
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="sfl_product_right">

                                                <div class="sflPriceSection">
                                                    <div class="sfl_product_price">
                                                        <div class="product_price">
                                                            <div class="sfl_calculated_price">{$pro['price_formatted']}</div>
                                                            {if $pro['show_slashed_price']}
                                                                <div class="slashed_price">{$pro['price_before_formatted']}</div>
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
                    </div>
                </span>
            </span>
        {/if}

        {if $kb_sfl_config['recommendation']['enable'] eq 1}
            <span class='bar_item' {if (count($content) == 0 && $recommend eq 1) || (count($content) == 0 && $recommend eq 3)}style="display:none;"{/if}>
                <span class='velsof_item' id="border_recommend">
                    <span class="wishbar_icon fa fa-thumbs-up" id='recommend_icon'></span>
                    <span class="bar_text">{$kb_sfl_config['recommendation'][$id_lang]}&nbsp;</span>
                    {if $recommend neq 1}<span class="circleCount" id="recommendations_count" style="visibility: visible;">{count($content)}</span>{/if}
                </span>
                <span class="stored-settings" id="recommend_popup">
                    <div class="headers">
                        <div class="main_header">
                            <label style="color: {$kb_sfl_config['recommendation']['color']}; {if $kb_sfl_config['recommendation']['italic'] eq 1}font-style: italic;{/if} {if $kb_sfl_config['recommendation']['bold'] eq 1}font-weight: bold;{/if}"><span class="wishhead_icon fa fa-thumbs-up"></span>{$kb_sfl_config['recommendation'][{$id_lang|escape:'htmlall':'UTF-8'}]}</label>
                                {if $recommend neq 1}
                                <span class="list_count">({count($content)})</span>
                            {/if}
                            <a title="{l s='Close' mod='saveforlater'}" id="hide_recommend" class="close_popup fa fa-times"></a>
                        </div>        
                    </div>

                    <div class="velsof_recommend_list">
                        <div class="backImage" {if $recommend eq 1}style="display:none;"{/if}>
                            <span class="fa fa-thumbs-up"></span>
                        </div>
                        <div class="velsof_container">
                            {if $recommend neq 1}
                                {if count($content) == 0}
                                    <div class="no_data" style="margin: 32% 0px;">
                                        <span>{l s='Sorry!' mod='saveforlater'}</span><br>
                                        {l s='No recommendations found.' mod='saveforlater'}
                                    </div>
                                {else}
                                    {foreach $content as $pro}
                                        <div class="product_item">
                                            <div class="product_image">
                                                <a href="{$pro['url']}"><img width="60" src="{$link->getImageLink($pro['link_rewrite'], $pro['id_image'] , 'home_default')}"></a>
                                            </div>
                                            <div class="product_detail">
                                                <div class="sfl_product_left">
                                                    <div class="product_title">  <a href="{$pro['url']}">{$pro['name']|escape:'htmlall':'UTF-8'}</a>
                                                    </div>

                                                    <ul class="actionOptions">
                                                        <li class="sfl_buy">
                                                            {if $kb_sfl_config['recommendation']['enable_buy_btn'] eq 1}
                                                                {if $pro['quantity'] > 0 || $pro['buy_out_of_stock'] == 1 }
                                                                    <div class='sfl_buy_btn'>                            
                                                                        <a class='velsof_buy' href='javascript:void(0)' onclick="buyProduct({$pro['product_id']});" style="background-color: {$kb_sfl_config['general']['buy_color']};">{l s='BUY' mod='saveforlater'}</a>
                                                                    </div>
                                                                {/if}
                                                            {/if}
                                                        </li>
                                                        <li class="sfl_remove">
                                                            <div class="wish_button_{$pro['product_id']} wish_button " onclick="addShortList(this,{$pro['product_id']})">
                                                                <span class="fa fa-heart"></span>

                                                                {if in_array($pro['product_id'], $sfl_aleady_added_products) }
                                                                    {l s='Added' mod='saveforlater'}
                                                                {else}
                                                                    {l s='Shortlist' mod='saveforlater'}
                                                                {/if}
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="sfl_product_right">						
                                                    <div class="sflPriceSection">
                                                        <div class="sfl_product_price">
                                                            <div class="product_price">
                                                                <div class="sfl_calculated_price">{$pro['price_formatted']}</div>
                                                                {if $pro['show_slashed_price']}
                                                                    <div class="slashed_price">{$pro['price_before_formatted']}</div>
                                                                {/if}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    {/foreach}
                                {/if}
                            {else if $recommend eq 1}
                                {foreach $content as $cont}
                                    <a href="{if $cont['link'] != ''}{$cont['link']}{else}javascript:void(0){/if}" {if $cont['link'] == ''}style="cursor: default;"{/if} target="_blank" title='{$cont['title']}'><img src="{$cont['src']}" class='recommended_banner_img' /></a>
                                    {/foreach}               
                                {/if}
                        </div>        
                    </div>
                </span>
            </span>
        {/if}
    </div>
{/if}

