<style>
    .kb_custom_tabs.kb_custom_panel a {
    width: 33%;
}
    
</style>

<div class="kb_custom_tabs kb_custom_panel">
    <span>
        <a class="kb_custom_tab {if $selected_nav == 'config'}kb_active{/if}" title="{l s='General Settings' mod='kbmarketplace'}" id="kbcf_general_settings" href="{$general_setting nofilter}">{*Variable contains URL content, escape not required*}
            <i class="icon-gear"></i>
            {l s='General Settings' mod='kbmarketplace'}
        </a>
    </span>

    <span>
        <a class="kb_custom_tab {if $selected_nav == 'reminder'}kb_active{/if}" title="{l s='Warning Plan Reminder Settings' mod='kbmarketplace'}" id="kbcf_profile" href="{$reminder_profile_link nofilter}">{*Variable contains URL content, escape not required*}
            <i class="icon-envelope"></i>
            {l s='Warning Plan Reminder Settings' mod='kbmarketplace'}
        </a>
    </span>
        
        <span>
        <a class="kb_custom_tab {if $selected_nav == 'expiry'}kb_active{/if}" title="{l s='Expired Plan Reminder Settings' mod='kbmarketplace'}" id="kbcf_profile" href="{$expiry_profile_link nofilter}">{*Variable contains URL content, escape not required*}
            <i class="icon-envelope"></i>
            {l s='Expired Plan Reminder Settings' mod='kbmarketplace'}
        </a>
    </span>
</div>

        <script>
            var check_for_all = "{l s='Kindly check for all available langauges.' mod='kbmarketplace'}";
        </script>
            
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
*
* Description
*
* Admin tpl file
*}