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
{extends file='page.tpl'}

    {block name='page_content_container'}
      <div class="topcolumn-section">
          {hook h='displayTopColumn'}
      </div>
      <section id="content" class="page-home container">
        {block name='page_content_top'}{/block}
        {block name='page_content'}
        {assign var='HOOK_HOME_TAB_CONTENT' value=Hook::exec('displayHomeTabContent')}
        {assign var='HOOK_HOME_TAB' value=Hook::exec('displayHomeTab')}
        {if isset($HOOK_HOME_TAB_CONTENT) && $HOOK_HOME_TAB_CONTENT|trim}
          <div class="js-wrap-products-tabs productstabs-section clearfix">
            <div class="productstabs-section__inner">
              {if isset($HOOK_HOME_TAB) && $HOOK_HOME_TAB|trim}
              <ul class="js-products-tabs nav nav-tabs">
                {hook h='displayHomeTab'}
              </ul>
              {/if}
              {if isset($HOOK_HOME_TAB_CONTENT) && $HOOK_HOME_TAB_CONTENT|trim}
              <div class="tab-content">
                {hook h='displayHomeTabContent'}
              </div>
              {/if}
            </div>
          </div>
        {/if}
        <div class="home-section">
          {$HOOK_HOME nofilter}
        </div>
        {/block}
      </section>
    {/block}
