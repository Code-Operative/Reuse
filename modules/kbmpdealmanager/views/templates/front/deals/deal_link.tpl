<div class="kb-top-menu-link seller-offer-link">
	<a href="{$link->getModuleLink('kbmpdealmanager', 'frontdeals', [], (bool)Configuration::get('PS_SSL_ENABLED'))|escape:'htmlall':'UTF-8'}" title="{l s='Click to view seller discount and offers' mod='kbmpdealmanager'}">{l s='Offers' mod='kbmpdealmanager'}</a>
</div>
    <style>
        .seller-offer-link.kb-top-menu-link {
            background-color: #C71C1C;
            padding: 6px 10px 7px 10px;
        }
        
        .seller-offer-link.kb-top-menu-link a {
            font-size: 14px;
            border-top: 1px dotted #fff;
            border-bottom: 1px dotted #fff;
            padding: 2px 0;
        }
        
        .seller-offer-link.kb-top-menu-link a:hover, .seller-offer-link.kb-top-menu-link a.active{
            background-color: #C71C1C;
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