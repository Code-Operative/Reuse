<a 
    href="{$href|escape:'htmlall':'UTF-8'}"
    title="{$action|escape:'htmlall':'UTF-8'}" 
    onclick="disapproveWithConfirmation(this)"
            
    >
	<i class="{$icon|escape:'htmlall':'UTF-8'}"></i> {$action|escape:'htmlall':'UTF-8'}
</a>
        <script>
                var disapprove_conf = "{$disapprove_conf}";
            
            
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
* @copyright 2016 knowband
* @license   see file: LICENSE.txt
*}