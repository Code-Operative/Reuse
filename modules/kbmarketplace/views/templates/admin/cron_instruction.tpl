<div class="alert alert-warning">
        <p class="">
            {l s='Cron Instructions' mod='kbmarketplace'}
        </p>
        <br/>
        <p>
            {l s='Add the cron to your store via control panel/putty to update the status of membership plans and for sending membership plan reminders. Please find the instructions to setup crons below -' mod='kbmarketplace'}
        </p>
        <br/>
        <p>
            <b>{l s='URLs to Add to Cron via Control Panel' mod='kbmarketplace'}</b>
        </p>
        <br/>
        <p> <b>{l s='Activate/deactivate Membership Plan' mod='kbmarketplace'}</b> - <a target="_blank" href="{$link_plan_activate_deactivate nofilter}">{$link_plan_activate_deactivate|escape:'quotes':'UTF-8'}</a></p> {* variable contains url content excape not required *}
        <br/>
        <p> <b>{l s='To Send automatic reminders' mod='kbmarketplace'}</b> - <a target="_blank" href="{$link_reminders nofilter}">{$link_reminders|escape:'quotes':'UTF-8'}</a></p> {* variable contains url content excape not required *}
        <br/>
        
        <p>
            <b>{l s='Cron setup via SSH' mod='kbmarketplace'}</b>
        </p>
        <br/>
        <p><b>{l s='Activate/deactivate Membership Plan (At 00:05 on every day-of-month)' mod='kbmarketplace'}</b> - 5 0 */1 * * curl -O /dev/null '{$link_plan_activate_deactivate|escape:'htmlall':'UTF-8'}'</p>
        <br/>
        <p> <b>{l s='To Send automatic reminders (At 12:00 on every day-of-month)' mod='kbmarketplace'}</b> - 0 12 */1 * * curl -O /dev/null '{$link_reminders|escape:'htmlall':'UTF-8'}'</p>
        <br/>
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