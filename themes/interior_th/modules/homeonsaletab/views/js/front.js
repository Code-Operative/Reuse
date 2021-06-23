/*
 * 2007-2019 PrestaShop
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
 *  @copyright  2007-2019 PrestaShop SA
 *  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

jQuery(document).ready(function() {
    var owlSaleItems = $(".js-carousel-sale");
    if (owlSaleItems.data('carousel')){
        owlSaleItems.owlCarousel({
            items: owlSaleItems.data('col'),
            nav: (owlSaleItems.children().length > owlSaleItems.data('col')) ? owlSaleItems.data('arrows') : false,
            dots: (owlSaleItems.children().length > owlSaleItems.data('col')) ? owlSaleItems.data('pag') : false,
            autoplay: owlSaleItems.data('autoplay'),
            autoplayTimeout: owlSaleItems.data('speed'),
            loop: (owlSaleItems.children().length > 1) ? owlSaleItems.data('loop') : false,
            responsiveClass: true,
            responsive:{
                0:{
                    items: owlSaleItems.data('col_576')
                },
                576:{
                    items: owlSaleItems.data('col_769')
                },
                769:{
                    items: owlSaleItems.data('col_992')
                },
                992:{
                    items: owlSaleItems.data('col_1200')
                },
                1200:{
                    items: owlSaleItems.data('col')
                }
            },
            navText: ['<i class="font-left-open-big">','<i class="font-right-open-big">']
        });
    }
});