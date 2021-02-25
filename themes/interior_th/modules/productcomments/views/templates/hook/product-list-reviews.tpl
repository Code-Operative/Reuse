{**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}


{if $nb_comments != 0}
<div class="product-list-reviews" data-id="{$product.id}" data-url="{$product_comment_grade_url nofilter}">
  <div class="grade-stars small-stars">
      <div class="star-content">
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
      </div>
  </div>
  {*<div class="comments-nb"></div>*}
</div>
{else}
    <div class="star-wrapper">
      <div class="star-content">
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star"></div>
      </div>
    </div>
{/if}
{*{if $nb_comments != 0}*}
{* Rich snippet rating is displayed via php/smarty meaning it will be cached (for example on homepage) *}
<div itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating" itemscope>
  <meta itemprop="reviewCount" content="{if $nb_comments > 0}{$nb_comments}{else}1{/if}" />
  <meta itemprop="ratingValue" content="{if $nb_comments != 0}{$average_grade}{else}5{/if}" />
  <meta itemprop="worstRating" content = "0" />
  <meta itemprop="bestRating" content = "5" />
</div>
{*{/if}*}

