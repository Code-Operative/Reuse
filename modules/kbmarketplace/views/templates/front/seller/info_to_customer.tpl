<div class="kb-block seller_profile_view">
    <div class="s-vp-banner">
        <img src="{$seller['banner'] nofilter}" /> {* Variable contains HTML/CSS/JSON, escape not required *}

    </div>
    <div class="info-view">
        <div class="seller-profile-photo">
            <a href="{KbGlobal::getSellerLink($seller['id_seller']) nofilter}" > {* Variable contains HTML/CSS/JSON, escape not required *}

                <img src="{$seller['logo'] nofilter}" title="{$seller['title']}" alt="{$seller['title']}"> {* Variable contains HTML/CSS/JSON, escape not required *}

            </a>
        </div>
        <div class="seller-info">
            <div class="seller-basic">
                <div class="seller-name">
                    <span class="name">
                        {$seller['title']}
                    </span>
                    {* changes by rishabh jain for seller shortlisting link *}
                        {* chnages by rishabh jain for seller shortlisting *}
                        {if isset($is_enabled_seller_shortlisting) && $is_enabled_seller_shortlisting == 1}
                        <div class="seller-rating-block">
                            <div class="kbmp-_inner_block"><i class="kb-material-icons shortlist_link" style="{if isset($is_already_added) && $is_already_added == 1}color: #ef4545;{else}color:grey;{/if}">&#xe87d;</i></div>
                            <div class="kbmp-_inner_block" style="position:relative;">
                                <div class="vss_seller_ratings">
                                    <!-- Do not customise it -->
                                    <a href="javascript:addShortListSeller(this, {$seller['id_seller']});" class="sfl_product_link_{$seller['id_seller']}" style="padding-left:7px;font-size:13px;color: #2fb5d2;">{if isset($is_already_added) && $is_already_added == 1}{l s='Favourite Seller' mod='kbmarketplace'}{else}{l s='Mark Seller as Favourite' mod='kbmarketplace'}{/if}</a>
                                    <!-- Set only width in percentage according to rating -->
                                </div>
                            </div>
                        </div>
                        {/if}
                         {* changes over *}
                   
                {* changes over *}
                    <div class="seller-rating-block">
                        {if !isset($seller['is_review_page'])}
                            <div class="kbmp-_inner_block" style="position:relative;">
                                <a href="{$link->getModuleLink($kb_module_name, 'sellerfront', ['render_type' => 'sellerreviews', 'id_seller' => $seller['id_seller']], (bool)Configuration::get('PS_SSL_ENABLED'))|escape:'htmlall':'UTF-8'}" title="{$seller['seller_review_count']|escape:'htmlall':'UTF-8'}">
                                    <div class="vss_seller_ratings">
                                        <!-- Do not customise it -->
                                        <div class="vss_rating_unfilled">★★★★★</div>

                                        <!-- Set only width in percentage according to rating -->
                                        <div class="vss_rating_filled" style="width:{$seller['seller_rating']|escape:'htmlall':'UTF-8'}%">★★★★★</div>
                                    </div>
                                </a>
                            </div>
                            <div class="kbmp-_inner_block"><a href="{$link->getModuleLink($kb_module_name, 'sellerfront', ['render_type' => 'sellerreviews', 'id_seller' => $seller['id_seller']], (bool)Configuration::get('PS_SSL_ENABLED'))|escape:'htmlall':'UTF-8'}" class="vss_active_link vss_read_review_bck"><span class="">{l s='View Reviews' mod='kbmarketplace'}</span></a></div>
                            {if $display_new_review}
                                <div class="kbmp-_inner_block">
                                    {if !$kb_is_customer_logged}
                                        <a href="{$link->getPageLink('my-account', (bool)Configuration::get('PS_SSL_ENABLED'))|escape:'htmlall':'UTF-8'}" class="vss_active_link"><span class="">{l s='Write Review' mod='kbmarketplace'}</span></a>
                                    {else}
                                        <a href="javascript:void(0)" class="vss_active_link vss_write_review_bck" data-toggle="kb-seller-new-review-popup" onclick="openSellerReviewPopup('kb-seller-new-review-popup', false);"><span class="">{l s='Write Review' mod='kbmarketplace'}</span></a>
                                    {/if}
                                </div>
                            {/if}
                        {else}
                            <div class="kbmp-_inner_block"><strong>{l s='Overall Rating' mod='kbmarketplace'}: </strong></div>
                            <div class="kbmp-_inner_block" style="position:relative;">
                                <div class="vss_seller_ratings">
                                    <!-- Do not customise it -->
                                    <div class="vss_rating_unfilled">★★★★★</div>

                                    <!-- Set only width in percentage according to rating -->
                                    <div class="vss_rating_filled" style="width:{$seller['seller_rating']|escape:'htmlall':'UTF-8'}%">★★★★★</div>
                                </div>
                            </div>
                        {/if}        
                    </div>
                </div>
                
                <div class="seller-social">
                    {if !empty($seller['twit_link'])}
                        <a title="{l s='Twitter' mod='kbmarketplace'}" href="{$seller['twit_link'] nofilter}" class="btn-sm btn-primary social-btn twitter" ></a> {* Variable contains HTML/CSS/JSON, escape not required *}

                    {/if}
                    {if !empty($seller['fb_link'])}
                        <a title="{l s='Facebook' mod='kbmarketplace'}" href="{$seller['fb_link'] nofilter}" class="btn-sm btn-primary social-btn facebook"></a> {* Variable contains HTML/CSS/JSON, escape not required *}

                    {/if}
                    {if !empty($seller['gplus_link'])}
                        <a title="{l s='Google+' mod='kbmarketplace'}" href="{$seller['gplus_link'] nofilter}" class="btn-sm btn-primary social-btn googleplus"></a> {* Variable contains HTML/CSS/JSON, escape not required *}

                    {/if}       
                </div>
                
            </div>
        </div>
        {if $gdpr_enabled}
            <div class="seller-customer-info-block">
                <div class="seller-basic">
                    <button data-toggle="modal" data-target="#kb-seller-access-data-popup"  class="btn btn-success kb-open-mp-access-popup">{l s='Request to Access Personal Data' mod='kbmarketplace'}</button>
                </div>
            </div>
        {/if}
    </div>
    {if !isset($seller['is_review_page'])}
        {if !empty($seller['description'])}
            <section class="slr-f-box">
                <h3 class="page-product-heading">{l s='About Seller' mod='kbmarketplace'}</h3>
                <div  class="rte slr-content">
                    {$seller['description'] nofilter}  {* Variable contains HTML/CSS/JSON, escape not required *}

                </div>
            </section>
        {/if}
        <section class="slr-f-box">
            <h3 class="page-product-heading">{l s='Privacy Policy' mod='kbmarketplace'}</h3>
            <div  class="rte slr-content">
                {if !empty($seller['privacy_policy'])}
                    {$seller['privacy_policy'] nofilter}{*Variable contains HTML content,escape not required*}
                {else}
                    {l s='No Privacy Policy Provided by Seller Yet.' mod='kbmarketplace'}
                {/if}

            </div>
        </section>
        <section class="slr-f-box">
            <h3 class="page-product-heading">{l s='Return Policy' mod='kbmarketplace'}</h3>
            <div  class="rte slr-content">
                {if !empty($seller['return_policy'])}
                    {$seller['return_policy'] nofilter}  {* Variable contains HTML/CSS/JSON, escape not required *}

                {else}
                    {l s='No Return Policy Provided by Seller Yet.' mod='kbmarketplace'}
                {/if}

            </div>
        </section>
        <section class="slr-f-box">
            <h3 class="page-product-heading">{l s='Shipping Policy' mod='kbmarketplace'}</h3>
            <div  class="rte slr-content">
                {if !empty($seller['shipping_policy'])}
                    {$seller['shipping_policy'] nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

                {else}
                    {l s='No Shipping Policy Provided by Seller Yet.' mod='kbmarketplace'}
                {/if}

            </div>
        </section>
        {* changes by rishabh jain for showing additional fields on seller view page *}
        {if is_array($kb_available_field) && !empty($kb_available_field)}
            <section class="slr-f-box">
            <h3 class="page-product-heading">{l s='Additional Information' mod='kbmarketplace'}</h3>
            <div  class="rte slr-content">
                <ul class="kb-form-list">
                    {assign var=indexRow value=0}
                    {foreach $kb_available_field as $key => $kbfield}
                        {if isset($kbfield['show_seller_profile']) && $kbfield['show_seller_profile'] == 1}
                            <li class="{if $indexRow % 2 == 0}kb-form-l{else}kb-form-r{/if}">
                                <div class="kb-form-label-block">
                                    <strong class="kblabel">{$kbfield['label']|escape:'htmlall':'UTF-8'} : </strong>
                                    {if ($kbfield['type'] == 'select') || ($kbfield['type'] == 'radio') || ($kbfield['type'] == 'checkbox')}
                                        {if $kbfield['value'] != ''}
                                            {foreach $kbfield['value']|json_decode:1 as $field_value}
                                                {if isset($kbfield['customer_value'])}
                                                    {if is_array($kbfield['customer_value']|json_decode:1)}
                                                        {if in_array($field_value['option_value'],$kbfield['customer_value']|json_decode:1)}
                                                            {$field_value['option_label']|escape:'htmlall':'UTF-8'}</br>
                                                        {/if}
                                                        {else}
                                                            {if $field_value['option_value']  == $kbfield['customer_value']|json_decode:1}
                                                                {$field_value['option_label']|escape:'htmlall':'UTF-8'}</br>
                                                             {/if}
                                                    {/if}
                                                {/if}
                                            {/foreach}
                                        {/if}
                                        {else if $kbfield['type'] == 'file'}
                                            {if isset($kbfield['customer_value'])}
                                                {if is_array($kbfield['customer_value']|json_decode:1) && $kbfield['customer_value'] != ''} 
                                                    <a href="{$module_path|escape:'quotes':'UTF-8'}&id_field={$kbfield['id_field']|escape:'htmlall':'UTF-8'}&id_seller={$id_seller|escape:'htmlall':'UTF-8'}" >{l s='Download File' mod='kbmarketplace'}</a>
                                                {/if}
                                            {else}
                                                -
                                        {/if}
                                        {else}
                                        {if isset($kbfield['customer_value'])}
                                            {$kbfield['customer_value']|escape:'htmlall':'UTF-8'|nl2br}
                                        {else}
                                            -
                                        {/if}
                                        {/if}
                                </div>
                            </li>
                            {assign var=indexRow value=$indexRow+1}
                        {/if}
                    {/foreach}
                        </ul>
                </div>
        </section>
        {/if}
        {* changes over*}
        {hook h="displayKbSellerView" id_seller=$seller['id_seller'] area="profile"}
    {else}
        {hook h="displayKbSellerView" id_seller=$seller['id_seller'] area="review"}
    {/if}
</div>
{if isset($display_review_popup) && $display_review_popup}
    <div id="kb-seller-new-review-popup" class="modal fade quickview kbpopup-modal" tabindex="-1" role="dialog" style="display:none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>{l s='Write a review' mod='kbmarketplace'}</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="slr-review-form" action="{KbGlobal::getSellerLink($seller['id_seller']) nofilter}" method="post"> {* Variable contains HTML/CSS/JSON, escape not required *}

                        <input type="hidden" name="new_review_submit" value="1" />
                        <ul>
                            <li>
                                <label>{l s='Rate this Seller' mod='kbmarketplace'}:</label>
                                <div id="seller_new_review_rating_block"></div>
                                <div class="clearfix"></div>
                            </li>
                        </ul>
                        <label for="review_title">{l s='Title' mod='kbmarketplace'}: <sup class="required">*</sup></label>
                        <div class="kb-form-label-block">
                            <input id="review_title" name="review_title" type="text" value="" class="required">
                        </div>
                        <label for="review_content">{l s='Comment' mod='kbmarketplace'}: <sup class="required">*</sup></label>
                        <div class="kb-form-label-block">
                            <textarea id="review_content" name="review_content" class="required"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <p class="fl required"><sup>*</sup> {l s='Required fields' mod='kbmarketplace'}</p>
                    <p class="fr">
                        <button id="submitSellerReview" type="button" class="btn button button-small" {if $kb_is_customer_logged}onclick="submitSellerNewReview()"{else}onclick="location.href='{$link->getPageLink('my-account', true)|escape:'htmlall':'UTF-8'}'"{/if}>
                            <span>{l s='Submit' mod='kbmarketplace'}</span>
                        </button>
                    </p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
{/if}
{if $gdpr_enabled}
    <div id="kb-seller-access-data-popup">
        <div class="kb-popup-content">
            <h4 class="page-heading">{l s='Request to Access Personal Data' mod='kbmarketplace'}</h4>
            <p class="kb-page-subheading">{l s='You can request to the seller to provide the report of your personal data they have store by entering the email Id.' mod='kbmarketplace'}</p>
            <form class="kb_mp_personal_access_form" action="{$filter_form_action}" method="post">
                <div class="form-group">
                    <label for="email">{l s='Email Address' mod='kbmarketplace'}</label>
                    <input type="hidden" name="id_seller" value="{$seller['id_seller']}">
                    <input type="text" class="form-control" id="kb_access_email" name="kb_access_email" placeholder="{l s='Enter email address' mod='kbmarketplace'}" value="">
                </div>
                <div class="kb-popup-btn-block">
                    <button type="submit" class="btn btn-danger submit-mp-personal-access" name="submitMPPersonalAccess" onclick="return submitKbMPAccessInfo()" value="1">{l s='Submit' mod='kbmarketplace'}</button>
                </div>
            </form>
        </div>
    </div>
{/if}
    <script type="text/javascript">
            var kb_empty_field = "{l s='Field cannot be empty.' mod='kbmarketplace'}";
            var kb_email_valid = "{l s='Email is not valid.' mod='kbmarketplace'}";
            var seller_front_url = "{$filter_form_action}";
            var kb_email_not_exit= "{l s='Email Address is not associated with any account.' mod='kbmarketplace'}";
        </script>
        <script>
        var ajaxurl = "{$ajaxurl nofilter}"; {* Variable contains HTML/CSS/JSON, escape not required *}
        var sfl_shortlist_text= "{l s='Mark Seller as Favourite' mod='kbmarketplace'}";
        var sfl_already_added_text= "{l s='Favourite Seller' mod='kbmarketplace'}";
    </script>