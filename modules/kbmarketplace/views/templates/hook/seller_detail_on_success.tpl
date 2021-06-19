<div id="order-detail-content" class="table_block table-responsive" {if $render_detail ==1}style="display:block;"{else} style ="display:none;" {/if}>
    <h1 class="page-heading">{l s='My Order' mod='kbmarketplace'}</h1>
                <table id="cart_summary" class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="cart_product first_item">{l s='Product' mod='kbmarketplace'}</th>
                        <th class="cart_description item">{l s='Description' mod='kbmarketplace'}</th>
                        <th class="">{l s='Seller Details' mod='kbmarketplace'}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $product_details as $product}

                        {* Display the product line *}
                                <tr>
                                    <td class="cart_product">
                                        <a href="{$link->getProductLink($product['id_product'], $product['link_rewrite'], $product['category'], null, null, $product['id_shop'], $product['id_product_attribute'], false, false, true)|escape:'html':'UTF-8'}"><img src="{$link->getImageLink($product['link_rewrite'], $product['id_image'], 'small_default')|escape:'html':'UTF-8'}" alt="{$product['name']|escape:'html':'UTF-8'}" {if isset($smallSize)}width="{$smallSize.width}" height="{$smallSize.height}" {/if} /></a>
                                    </td>
                                    <td class="cart_description">
                                        {capture name=sep} : {/capture}
                                    {capture}{l s=' : ' mod='kbmarketplace'}{/capture}
                                    <p class="product-name"><a href="{$link->getProductLink($product['id_product'], $product['link_rewrite'], $product['category'], null, null, $product['id_shop'], $product['id_product_attribute'], false, false, true)|escape:'html':'UTF-8'}">{$product['name']|escape:'html':'UTF-8'}</a></p>
                                    {if $product['reference']}<small class="cart_ref">{l s='SKU' mod='kbmarketplace'}{$smarty.capture.default}{$product['reference']|escape:'html':'UTF-8'}</small>{/if}
{*                                    {if isset($product.attributes) && $product.attributes}<small><a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category, null, null, $product.id_shop, $product.id_product_attribute, false, false, true)|escape:'html':'UTF-8'}">{$product.attributes|@replace: $smarty.capture.sep:$smarty.capture.default|escape:'html':'UTF-8'}</a></small>{/if}*}
                                </td>
                                
                                <td>
                                    <ul>
                                        {if $product['seller_info'] == 'Admin'}
                                            <li>--</li>
                                            {else}
                                            <table class="details_table">
                                                <tr><td class='details_label'>{l s='Shop Name' mod='kbmarketplace'}:</td><td>{$product['seller_info']['title']|escape:'html':'UTF-8'}</td></tr>
                                            <tr><td class='details_label'>{l s='Name' mod='kbmarketplace'}:</td><td>{$product['seller_info']['seller_name']|escape:'html':'UTF-8'}</td></tr>
                                            <tr><td class='details_label'>{l s='Address' mod='kbmarketplace'}:</td><td>{$product['seller_info']['address']}</td></tr>
                                            <tr><td class='details_label'>{l s='State' mod='kbmarketplace'}:</td><td>{$product['seller_info']['state']|escape:'html':'UTF-8'}</td></tr>
                                            <tr><td class='details_label'>{l s='Country' mod='kbmarketplace'}:</td><td>{$product['seller_info']['id_country']|escape:'html':'UTF-8'}</td></tr>
                                            <tr><td class='details_label'>{l s='Phone' mod='kbmarketplace'}:</td><td>{$product['seller_info']['phone_number']|escape:'html':'UTF-8'}</td></tr>
                                             <tr><td class='details_label'>{l s='Email' mod='kbmarketplace'}:</td><td>{$product['seller_info']['email']|escape:'html':'UTF-8'}{if $product['seller_info']['business_email'] != '' && $product['seller_info']['business_email'] != $product['seller_info']['email']},{$product['seller_info']['business_email']|escape:'html':'UTF-8'}{/if}</td></tr>
                                            </table>
                                            {/if}
                                    </ul>
                                </td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div> <!-- end order-detail-content -->
            {foreach $order_details_marketplace as $order}                            
                <section id="content_knowband" class="page-content page-order-confirmation card">
                    <div class="card-block">
                        <div class="row">

                            {block name='order_confirmation_table'}
                                {include
            file='checkout/_partials/order-confirmation-table.tpl'
            products=$order.products
            subtotals=$order.subtotals
            totals=$order.totals
            labels=$order.labels
            add_product_link=false
                                }
                            {/block}

                            {block name='order_details'}
                                <div id="order-details" class="col-md-4">
                                    <h3 class="h3 card-title">{l s='Order details' d='Shop.Theme.Checkout'}:</h3>
                                    <ul>
                                        <li>{l s='Order reference: %reference%' d='Shop.Theme.Checkout' sprintf=['%reference%' => $order.details.reference]}</li>
                                        <li>{l s='Payment method: %method%' d='Shop.Theme.Checkout' sprintf=['%method%' => $order.details.payment]}</li>
                                            {if !$order.details.is_virtual}
                                            <li>
                                                {l s='Shipping method: %method%' d='Shop.Theme.Checkout' sprintf=['%method%' => $order.carrier.name]}<br>
                                                <em>{$order.carrier.delay}</em>
                                            </li>
                                        {/if}
                                    </ul>
                                </div>
                            {/block}

                        </div>
                    </div>
                </section>            
            {/foreach}
            <style>
                .details_label {
                    color: black;
                    font-weight: 400;
                    text-align: right;
                }
                .details_table {
                     border-collapse:collapse !important;
                }
                .details_table>tr>td, .details_table>tr, .details_table>tbody>tr>td, .details_table>tbody>tr  {
                    border-collapse:collapse !important;
                    border: none !important;
                    margin: 0px;
                    padding: 0px;
                }
                .details_table>tbody>tr>td {
                        padding-right: 13px;
                }
                #content{
                    display: none;
                }
            </style>
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