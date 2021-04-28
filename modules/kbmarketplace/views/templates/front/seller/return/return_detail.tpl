<div class="widget">
    <div class="widget-body velsof-widget-body">
        <div class='rm_return_history left-flot'>
            <div class="rm_pop_heading">{l s='Order Detail' mod='kbmarketplace'}</div>
            <div class='rm_product_data'>
                <div class='rm_product_name'><b>{l s='Order' mod='kbmarketplace'}:</b> {$return_detail[1]['order_reference']}</div>
                <div class='rm_product_name'><b>{l s='Order Date' mod='kbmarketplace'}:</b> {$return_detail[1]['order_date']}</div>
                <div class='rm_product_name'><b>{l s='Order Status' mod='kbmarketplace'}:</b> <div class="rm_label_orderstatus" style="background-color:{$return_detail[1]['order_status_color']}">{$return_detail[1]['order_status']}</div></div>
                <div class='rm_product_name'><b>{l s='Order Total' mod='kbmarketplace'}:</b> {$return_detail[1]['order_total']}</div>
                <div class='rm_product_name'><b>{l s='Shipping Charges' mod='kbmarketplace'}:</b> {$return_detail[1]['order_shipping']}</div>
                <div class='rm_product_name'><b>{l s='Shipping Paid By' mod='kbmarketplace'}:</b> {if $return_detail[1]['whopayshipping'] eq 'c'}{l s='Customer' mod='kbmarketplace'}{else}{l s='Store Owner' mod='kbmarketplace'}{/if}</div>
                <div class='rm_product_name'><b>{l s='Return Reason' mod='kbmarketplace'}:</b> {$return_detail[1]['reason']}</div>
            </div>
        </div>
        <div class='rm_return_history right-flot'>
            <div class="rm_pop_heading">{l s='Customer Detail' mod='kbmarketplace'}</div>
            <div class='rm_product_data'>
                <div class='rm_product_name'><b>{l s='Name' mod='kbmarketplace'}:</b> {$return_detail[1]['cust_name']}</div>
                <div class='rm_product_name'><b>{l s='Email' mod='kbmarketplace'}:</b> {$return_detail[1]['email']}</div>
                <div class='rm_product_name'><b>{l s='Shipping Address' mod='kbmarketplace'}:</b> <br>{$return_detail[1]['shipping_address'] nofilter}</div>{*Variable contains html content, escape not required*}
            </div>
        </div>
                <br><br><div class="rm_pop_heading"><h4 class="heading" style='margin: 0px;'>{l s='Returned Item Detail' mod='kbmarketplace'}</h4></div>
        <div class='rm_product_data'>
            <span class='rm_product_img'><img src='{$return_detail[1]['pro_img']}' style="height:90px;width:90px;"/></span>
            <span class='rm_product_name'><b>{$return_detail[1]['product_name']}</b></span>
            <br>{if $return_detail[1]['product_attr'] != ''}<span class='rm_product_name'>{$return_detail[1]['product_attr']}</span>{else}<span class='rm_product_name'>&nbsp;</span>{/if}
            <br><span class='rm_product_name'><b>{l s='Quantity' mod='kbmarketplace'}:</b> {$return_detail[1]['quantity']}</span>
            <br><span class='rm_product_name'><b>{l s='Price' mod='kbmarketplace'}:</b> {$return_detail[1]['unit_price_tax_incl']}</span>
        </div>        
    </div>
</div>

<div class="widget">
    <div class="widget-head">
        <h4 class="heading" style='margin: 0px;'>{l s='Return Status History' mod='kbmarketplace'}</h4>
    </div>
    <div class="widget-body">
        <table class="return-man-tab">
            <thead>
                <tr>
                    <th>{l s='Sr. No.' mod='kbmarketplace'}</th>
                    <th>{l s='Status' mod='kbmarketplace'}</th>
                    <th>{l s='Changed On' mod='kbmarketplace'}</th>
                </tr>
            </thead>
            <tbody>
                {$sr = 1}
                {foreach $return_detail[0] as $status}
                    <tr>
                        <td>{$sr}</td>
                        <td>{$status['status']}</td>
                        <td>{$status['date']}</td>
                    </tr>
                    {$sr=$sr+1}
                {/foreach}
            </tbody>
        </table>                                                    
    </div>
</div>

{*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
* We offer the best and most useful modules PrestaShop and modifications for your online store.
*
* @category  PrestaShop Module
* @author    knowband.com <support@knowband.com>
* @copyright 2015 Knowband
* @license   see file: LICENSE.txt
*
* Description
*
* Return Manager Return Detail File
*}


