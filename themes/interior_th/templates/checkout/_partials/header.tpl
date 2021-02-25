{**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{block name='header_banner'}
  <div class="header-banner">
    {hook h='displayBanner'}
  </div>
{/block}

{block name='header_nav'}
  <nav class="header-nav">
    <div class="container">
        <div class="row inner-wrapper">
          {hook h='displayNav1'}
          {hook h='displayNav2'}
          <div class="hidden-lg-up mobile">
            <div id="menu-icon">
              <i class="material-icons d-inline">&#xE5D2;</i>
            </div>
            <div class="top-logo" id="_mobile_logo"></div>
            {if Module::isInstalled(ps_shoppingcart) && Module::isEnabled(ps_shoppingcart)}
            <div id="_mobile_cart"></div>
            {/if}
          </div>
        </div>
    </div>
  </nav>
{/block}
{if (Module::isInstalled(ps_currencyselector) && Module::isEnabled(ps_currencyselector)) ||
    (Module::isInstalled(ps_languageselector) && Module::isEnabled(ps_languageselector)) ||
    (Module::isInstalled(ps_contactinfo) && Module::isEnabled(ps_contactinfo)) ||
    (Module::isInstalled(ps_searchbar) && Module::isEnabled(ps_searchbar)) ||
    (Module::isInstalled(ps_customersignin) && Module::isEnabled(ps_customersignin))
}
<div class="mobile-nav hidden-lg-up">
    {if Module::isInstalled(ps_currencyselector) && Module::isEnabled(ps_currencyselector)}
      <div id="_mobile_currency_selector" class="toggle-link"></div>
    {/if}
    {if Module::isInstalled(ps_languageselector) && Module::isEnabled(ps_languageselector)}
      <div id="_mobile_language_selector" class="toggle-link"></div>
    {/if}
    {if Module::isInstalled(ps_contactinfo) && Module::isEnabled(ps_contactinfo)}
    <div id="_mobile_contact_link" class="toggle-link"></div>
    {/if}
    {if Module::isInstalled(ps_searchbar) && Module::isEnabled(ps_searchbar)}
    <div id="_mobile_search_bar" class="toggle-link"></div>
    {/if}
    {if Module::isInstalled(ps_customersignin) && Module::isEnabled(ps_customersignin)}
    <div id="_mobile_user_info" class="toggle-link"></div>
    {/if}
</div>
{/if}
{block name='header_top'}
  <div class="header-top">
    <div class="container">
       <div class="row inner-wrapper hidden-md-down">
        <div class="col-md-2" id="_desktop_logo">
          <a href="{$urls.base_url}">
            <img class="logo img-responsive" src="{$shop.logo}" alt="{$shop.name}">
          </a>
        </div>
        {hook h='displayTop'}
      </div>
      <div id="mobile_top_menu_wrapper" class="row hidden-lg-up">
        <div id="_mobile_link_block"></div>
        <div class="js-top-menu mobile" id="_mobile_top_menu"></div>
      </div>
    </div>
  </div>
  {hook h='displayNavFullWidth'}
{/block}
