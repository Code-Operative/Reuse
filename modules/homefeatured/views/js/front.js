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
    var owlFeaturedItems = $(".js-carousel-featured");
    if (owlFeaturedItems.data('carousel')){
        owlFeaturedItems.owlCarousel({
            items: owlFeaturedItems.data('col'),
            nav: (owlFeaturedItems.children().length > owlFeaturedItems.data('col')) ? owlFeaturedItems.data('arrows') : false,
            dots: (owlFeaturedItems.children().length > owlFeaturedItems.data('col')) ? owlFeaturedItems.data('pag') : false,
            autoplay: owlFeaturedItems.data('autoplay'),
            autoplayTimeout: owlFeaturedItems.data('speed'),
            loop: (owlFeaturedItems.children().length > 1) ? owlFeaturedItems.data('loop') : false,
            responsiveClass: true,
            responsive:{
                0:{
                    items: owlFeaturedItems.data('col_576')
                },
                576:{
                    items: owlFeaturedItems.data('col_769')
                },
                769:{
                    items: owlFeaturedItems.data('col_992')
                },
                992:{
                    items: owlFeaturedItems.data('col_1200')
                },
                1200:{
                    items: owlFeaturedItems.data('col')
                }
            },
            navText: ['<i class="font-left-open-big">','<i class="font-right-open-big">']
        });
    }
});