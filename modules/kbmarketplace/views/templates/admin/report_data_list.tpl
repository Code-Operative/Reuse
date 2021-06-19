{if isset($orders)}
    <table align="center" border="0" bgcolor="#FFFFFF" class="velsofContentTable" cellspacing="0" cellpadding="0" style="background: #FFFFFF; width: 750px;" width="750">
        <tbody>
            <tr>
                <td>
                    <table width="750" class="velsofContentTable" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0" align="center" style="background: #FFFFFF; width: 750px;">
                        <tbody>
                            <tr>
                                <td align="left" class="velsofContentContainer" style="padding: 15px 50px 5px 50px; font-family: Helvetica; font-size: 14px; color: #7f8c8d; line-height: 23px;">
                                    <div class="text">
                                        <table style="width: 100%; border-collapse: collapse; border-spacing: 0; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #34495e; text-align: left; border: 0; border-bottom: 1px solid #dddddd;" cellspacing="0" cellpadding="5">
                                            <tbody>
                                                <tr>
                                                    <td align="left" bgcolor="#1394f0" colspan="5"><span style="background-color: #1394f0; color: #ffffff; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px; text-transform: uppercase;">
                                                            {l s='Orders Contents' mod='kbmarketplace'}
                                                        </span>
                                                    </td>
                                                </tr>
                                            {if !empty($orders)}
                                                <tr>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Order Reference' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Date' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Payment' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Status' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Total Price' mod='kbmarketplace'}
                                                        </span></td>
                                                </tr>
                                                    {foreach $orders as $order}
                                                        <tr>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                   {$order['reference']|escape:'htmlall':'UTF-8'}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                     {dateFormat date=$order.date_add full=0}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                    {$order['payment']|escape:'htmlall':'UTF-8'}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                    {if isset($order.order_state)}
                                                                            {$order.order_state|escape:'html':'UTF-8'}
                                                                    {/if}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                     {$order.total_paid|string_format:"%.2f"|escape:'htmlall':'UTF-8'} {$currency_symbol|escape:'htmlall':'UTF-8'}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    {/foreach}
                                                {else}
                                                    <tr>
                                                        <td align="center">
                                                            {l s='No Orders' mod='kbmarketplace'}
                                                        </td>
                                                    </tr>
                                                {/if}
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
{/if}

{if isset($customer_review)}
    <table align="center" border="0" bgcolor="#FFFFFF" class="velsofContentTable" cellspacing="0" cellpadding="0" style="background: #FFFFFF; width: 750px;" width="750">
        <tbody>
            <tr>
                <td>
                    <table width="750" class="velsofContentTable" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0" align="center" style="background: #FFFFFF; width: 750px;">
                        <tbody>
                            <tr>
                                <td align="left" class="velsofContentContainer" style="padding: 15px 50px 5px 50px; font-family: Helvetica; font-size: 14px; color: #7f8c8d; line-height: 23px;">
                                    <div class="text">
                                        <table style="width: 100%; border-collapse: collapse; border-spacing: 0; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #34495e; text-align: left; border: 0; border-bottom: 1px solid #dddddd;" cellspacing="0" cellpadding="5">
                                            <tbody>
                                                <tr>
                                                    <td align="left" bgcolor="#1394f0" colspan="5"><span style="background-color: #1394f0; color: #ffffff; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px; text-transform: uppercase;">
                                                            {l s='Customer Reviews' mod='kbmarketplace'}
                                                        </span>
                                                    </td>
                                                </tr>
                                            {if !empty($customer_review)}
                                                <tr>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Title' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Comment' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Rating' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Status' mod='kbmarketplace'}
                                                        </span></td>
                                                </tr>
                                                    {foreach $customer_review as $review}
                                                        <tr>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                   {$review['title']|escape:'htmlall':'UTF-8'}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                     {$review['comment']|escape:'htmlall':'UTF-8'}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                    {$review['rating']|escape:'htmlall':'UTF-8'}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                    {if $review['approved']} 
                                                                        {l s='Approved' mod='kbmarketplace'}
                                                                    {else}
                                                                        {l s='Not approved' mod='kbmarketplace'}
                                                                    {/if}
                                                                </p>
                                                            </td>

                                                        </tr>
                                                    {/foreach}
                                                {else}
                                                    <tr>
                                                        <td align="center">
                                                            {l s='No Review' mod='kbmarketplace'}
                                                        </td>
                                                    </tr>
                                                {/if}
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
{/if}

{if isset($customer_product_review)}
    <table align="center" border="0" bgcolor="#FFFFFF" class="velsofContentTable" cellspacing="0" cellpadding="0" style="background: #FFFFFF; width: 750px;" width="750">
        <tbody>
            <tr>
                <td>
                    <table width="750" class="velsofContentTable" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0" align="center" style="background: #FFFFFF; width: 750px;">
                        <tbody>
                            <tr>
                                <td align="left" class="velsofContentContainer" style="padding: 15px 50px 5px 50px; font-family: Helvetica; font-size: 14px; color: #7f8c8d; line-height: 23px;">
                                    <div class="text">
                                        <table style="width: 100%; border-collapse: collapse; border-spacing: 0; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #34495e; text-align: left; border: 0; border-bottom: 1px solid #dddddd;" cellspacing="0" cellpadding="5">
                                            <tbody>
                                                <tr>
                                                    <td align="left" bgcolor="#1394f0" colspan="5"><span style="background-color: #1394f0; color: #ffffff; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px; text-transform: uppercase;">
                                                            {l s='Product Reviews' mod='kbmarketplace'}
                                                        </span>
                                                    </td>
                                                </tr>
                                            {if !empty($customer_product_review)}
                                                <tr>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Product' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Title' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Comment' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Rating' mod='kbmarketplace'}
                                                        </span></td>
                                                    <td align="left" bgcolor="#ebf5fd"><span style="background-color: #ebf5fd; color: #000000; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                            {l s='Date Added' mod='kbmarketplace'}
                                                        </span></td>
                                                </tr>
                                                    {foreach $customer_product_review as $product_review}
                                                        <tr>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                   {$product_review['name']|escape:'htmlall':'UTF-8'}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                  {$product_review['title']|escape:'htmlall':'UTF-8'}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                   {$product_review['content']|escape:'htmlall':'UTF-8'}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                    {$product_review['grade']|escape:'htmlall':'UTF-8'}
                                                                </p>
                                                            </td>
                                                            <td align="left" style="vertical-align: top;">
                                                                <p style="background-color: #ffffff; color: #6f6b6b; font-family: Helvetica; font-size: 14px; line-height: 27px; text-align: left; text-decoration: none; margin: 0px 0px; padding: 0px 10px;">
                                                                    {dateFormat date=$product_review['date_add'] full=0}
                                                                </p>
                                                            </td>

                                                        </tr>
                                                    {/foreach}
                                                {else}
                                                    <tr>
                                                        <td align="center">
                                                            {l s='No Review' mod='kbmarketplace'}
                                                        </td>
                                                    </tr>
                                                {/if}
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
{/if}


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
* @copyright 2017 Knowband
* @license   see file: LICENSE.txt
*}
