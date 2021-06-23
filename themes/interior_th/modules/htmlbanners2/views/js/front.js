/*
 * 2007-2018 PrestaShop
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
 *  @copyright  2007-2018 PrestaShop SA
 *  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

jQuery(document).ready(function() {
    var owlCategorybanners = $(".js-htmlbanners2-carousel");
    if (owlCategorybanners.data('carousel')){
        owlCategorybanners.owlCarousel({
            items: owlCategorybanners.data('items'),
            nav: (owlCategorybanners.children().length > 1) ? owlCategorybanners.data('navigation') : false,
            dots: (owlCategorybanners.children().length > owlCategorybanners.data('items')) ? owlCategorybanners.data('pagination') : false,
            autoplay: owlCategorybanners.data('autoplay'),
            autoplayTimeout: owlCategorybanners.data('timeout'),
            autoplayHoverPause: owlCategorybanners.data('pause'),
            loop: (owlCategorybanners.children().length > 1) ? owlCategorybanners.data('loop') : false,
            responsiveClass: true,
            responsive:{
                0:{
                    items: owlCategorybanners.data('items_480')
                },
                480:{
                    items: owlCategorybanners.data('items_768')
                },
                768:{
                    items: owlCategorybanners.data('items_991')
                },
                991:{
                    items: owlCategorybanners.data('items_1199')
                },
                1199:{
                    items: owlCategorybanners.data('items')
                }
            },
            navText: ['<i class="font-left-open-big">','<i class="font-right-open-big">']
        });
    }
});