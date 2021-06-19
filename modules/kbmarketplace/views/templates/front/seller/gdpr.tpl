<div class="kb-content">
    <div class="kb-content-header">
        <h1>{l s='GDPR' mod='kbmarketplace'}</h1>
        <div class="clearfix"></div>
    </div>
    <div class="kb-vspacer5"></div>
    <div class="kb-panel outer-border">
        <div class="col-xs-12 col-sm-6">
            <div data-toggle="kb-data-protability-panel-body" class="kb-panel-header kb-panel-header-tab">
                <h1>{l s='Right to Data Portability' mod='kbmarketplace'}</h1>
                <div data-toggle="kb-data-protability-panel-body" class="kb-accordian-symbol kbexpand" style="display: none;"></div>
                <div class="clearfix"></div>
            </div>
            <div class="kb_gdpr_fc_rules kb-panel-box" id="kb-data-protability-panel-body">
                <ul>
                    <li>
                        <p>{l s='You can request to download your account data in a CSV format using the links below:' mod='kbmarketplace'}</p>
                    </li>
                    <li>
                        <a href="{$product_download_link}">{l s='Seller Product Listing' mod='kbmarketplace'}</a>
                    </li>
                    <li>
                        <a href="{$seller_orders_download_link}">{l s='Sellers Orders' mod='kbmarketplace'}</a>
                    </li>
                    <li>
                        <a href="{$seller_info_download_link}">{l s='Seller Information' mod='kbmarketplace'}</a>
                    </li>
                    <li>
                        <a href="{$personal_info_download_link}">{l s='Your Personal Information' mod='kbmarketplace'}</a>
                    </li>
                    <li>
                        <a href="{$address_download_link}">{l s='Addresses' mod='kbmarketplace'}</a>
                    </li>
                    <li>
                        <a href="{$orders_download_link}">{l s='Your Orders' mod='kbmarketplace'}</a>
                    </li>
                </ul>
            </div>
        </div>
        {if $gdpr_setting['enable_close_shop']}
            <div class="col-xs-12 col-sm-6">
                <div data-toggle="kb-close-shop-panel-body" class="kb-panel-header kb-panel-header-tab">
                    <h1>{l s='Close Shop' mod='kbmarketplace'}</h1>
                    <div data-toggle="kb-close-shop-panel-body" class="kb-accordian-symbol kbexpand" style="display: none;"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="kb_gdpr_fc_rules kb-panel-box" id="kb-close-shop-panel-body">
                    <ul>
                        <li>
                            <p>{l s='You can request to Admin to permanently close the shop & you would not be able to access any data (Products/Reviews/Orders ect). If Admin approves, your shop and listings won\'t appear anywhere in the store. People who try to view your shop will be redirected to your home. People who try to view one of your shop\'s listings will see a page not found the error.' mod='kbmarketplace'}</p>
                        </li>
                        <li class="kb-vspacer5"></li>
                            <form action="{$controller_link}" method="post">
                                {if empty($existing_request)}
                                <li>
                                    <div class="checkbox">
                                        <label for="kb_delete_customer">
                                            <input type="checkbox" name="kb_delete_customer" id="kb_delete_customer" value="1"> {l s='Do you want to delete the account as well?' mod='kbmarketplace'}
                                        </label>
                                    </div>
                                </li>
                                {/if}
                                <li style="text-align: center;">
{*                                    <input type="hidden" name="id_seller" value="{$id_seller}">*}
                                    {if empty($existing_request)}
                                        <button type="submit" name="kb_mp_close_btn" onclick="return validatekbShopClose();" class="btn btn-danger">{l s='Request to Close?' mod='kbmarketplace'}</button>
                                        
                                    {else}
                                        <button type="submit" name="kb_mp_cancel_close_btn" class="btn btn-warning">{l s='Cancel Request' mod='kbmarketplace'}</button>
                                        {/if}

                                </li>
                            </form>
                    </ul>
                </div>
            </div>
        {/if}
        <div class="clearfix"></div>
    </div>
    <div class="kb-vspacer5"></div>

    <script>
        var kb_shop_close_confirm_text = "{l s='Are you sure to close the Shop.' mod='kbmarketplace'}";
    </script>

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