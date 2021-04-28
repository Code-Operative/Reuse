<div class="Ma_Membership">
        <div class="memberrow">
            {foreach from=$membership_plans item=plan name=membership_plans}
                <div class="memberCol">
                        <div class="memberDetails">
                                <h4 class="planHeading">{$plan.name}</h4>
                                <img class="planIcon" src="{$plan.logo nofilter}"  {* Variable contains HTML/CSS/JSON, escape not required *} alt = "{$plan.name}">
                                <div class="planDescription">
                                        <div class="planPrice">
                                            {if $plan.is_free != 1}
                                                {$plan.price_formatted}
                                            {else}
                                                {l s='Free' mod='kbmarketplace'}
                                            {/if}
                                        </div>
                                        {if $plan.is_enabled_product_limit}
                                            <div class="planaddedproducts">
                                                {l s='Add' mod='kbmarketplace'} {$plan.product_limit} {l s='Products' mod='kbmarketplace'}
                                            </div>
                                        {/if}
                                        <div class="planDelivery">
                                            {$plan.plan_duration}
                                            {if $plan.plan_duration_type == 1}
                                                {l s='Days' mod='kbmarketplace'}
                                            {else if $plan.plan_duration_type == 2}
                                                {l s='Months' mod='kbmarketplace'}
                                            {else}
                                                {l s='Years' mod='kbmarketplace'}
                                            {/if}
                                        </div>
                                        <a href="#" class="buybutton" onclick="return addMembershipPlanToCart({$plan.id_product},{$plan.id_kbmp_membership_plan})"><i class="fa fa-cart"></i>{l s='Buy Now' mod='kbmarketplace'}</a>
                                </div>
                        </div>
                </div>
            {/foreach}   
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