/*
 * 2007-2020 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
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
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2020 PrestaShop SA
 *  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

jQuery(document).ready(function() {
    var owlHtmlbanners = $(".htmlbanners5-carousel");
    if (owlHtmlbanners.data('carousel')){
        owlHtmlbanners.owlCarousel({
            items: owlHtmlbanners.data('items'),
            nav: (owlHtmlbanners.children().length > 1) ? owlHtmlbanners.data('navigation') : false,
            dots: (owlHtmlbanners.children().length > owlHtmlbanners.data('items')) ? owlHtmlbanners.data('pagination') : false,
            autoplay: owlHtmlbanners.data('autoplay'),
            autoplayTimeout: owlHtmlbanners.data('timeout'),
            autoplayHoverPause: owlHtmlbanners.data('pause'),
            loop: (owlHtmlbanners.children().length > 1) ? owlHtmlbanners.data('loop') : false,
            responsiveClass: true,
            responsive:{
                0:{
                    items: owlHtmlbanners.data('items_480')
                },
                480:{
                    items: owlHtmlbanners.data('items_768')
                },
                768:{
                    items: owlHtmlbanners.data('items_991')
                },
                991:{
                    items: owlHtmlbanners.data('items_1199')
                },
                1199:{
                    items: owlHtmlbanners.data('items')
                }
            },
            navText: ['<i class="font-left">','<i class="font-right">']
        });
    }
});