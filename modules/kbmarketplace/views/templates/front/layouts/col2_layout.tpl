{if $HOOK_KBLEFT_COLUMN}
<div id="kblayout-leftcol" class="column col-xs-12 col-sm-3 pad0" style="float:left;">
    {$HOOK_KBLEFT_COLUMN nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

</div> 
{/if}
{if $TEMPLATE}
<div id="kblayout-centercol" class="center_column col-xs-12 col-sm-9 pad0" style="float:left;">
    <div class="kb-block kb-panel centerlftoffest">
        {if isset($waiting_for_approval)}
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i>{l s='Your seller account has been created and waiting for Admin approval.' mod='kbmarketplace'}
                </div>
                {/if}
        {if isset($approval_link)}
            <div class="kbalert kbalert-warning">
                <i class="kb-material-icons">&#xE645;</i>{l s='Your seller account has been disapproved by Admin.' mod='kbmarketplace'} <a href="{$approval_link|escape:'htmlall':'UTF-8'}">{l s='Click' mod='kbmarketplace'}</a> {l s='to again send request for account approval.' mod='kbmarketplace'}
            </div>
        {/if}
        
        {if isset($account_dissaproved)}
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i>{l s='Your seller account has been disapproved by Admin.' mod='kbmarketplace'}
                </div>
        {/if}
        
        {if isset($account_disabled)}
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i>{l s='Your seller account is inactive.' mod='kbmarketplace'}
                </div>
        {/if}
        
        {if isset($no_membership_plan)}
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i>{l s="Your don't have any active membership plan.Kindly purchase the membership plan to continue selling on store." mod="kbmarketplace"}
                </div>
        {/if}
        
        {if isset($membership_plan_expiry_warning)}
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i>{l s="Your active membership plan will expire on " mod="kbmarketplace"}{$pending_days}{l s=" .Kindly extend or upgrade the membership plan to continue selling on store." mod="kbmarketplace"}
                </div>
        {/if}
        
        {if isset($membership_plan_rebate)}
                <div class="kbalert kbalert-warning">
                    <i class="kb-material-icons">&#xE645;</i>{$membership_plan_rebate_msg}{*{l s="You have only " mod="kbmarketplace"}{$pending_rebate_days}{l s=" days left to purchase the membership plan else all your products will be deactivated on the store." mod="kbmarketplace"}*}
                </div>
        {/if}
        
        {if isset($kb_confirmation) && is_array($kb_confirmation) && count($kb_confirmation) > 0}
            <div class="kbalert kbalert-success">
                <ul>
                    {foreach $kb_confirmation as $con}
                        <li>{$con}</li>
                    {/foreach}
                </ul>
            </div>
        {/if}
        {if isset($kb_warning) && is_array($kb_warning) && count($kb_warning) > 0}
            <div class="kbalert kbalert-warning">
                <ul>
                    {foreach $kb_warning as $war}
                        <li>{$war}</li>
                    {/foreach}
                </ul>
            </div>
        {/if}
        {if isset($kb_errors) && is_array($kb_errors) && count($kb_errors) > 0}
            <div class='pad5'>
                <div class="kbalert kbalert-danger">
                    <ul>
                        {foreach $kb_errors as $err}
                            <li>{$err}</li>
                        {/foreach}
                    </ul>
                </div>    
            </div>
        {/if}
        {$TEMPLATE nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

    </div>
</div>
{/if}
{if $HOOK_KBRIGHT_COLUMN}
<div id="kblayout-rightcol" class="column col-xs-12 col-sm-3 pad0">
    {$HOOK_KBRIGHT_COLUMN nofilter} {* Variable contains HTML/CSS/JSON, escape not required *}

</div>
{/if}
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