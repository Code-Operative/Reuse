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
    var manCarousel = $(".js-man-carousel");
    if (manCarousel.data('carousel')){
        manCarousel.owlCarousel({
            items: 6,
            nav: (manCarousel.children().length > 1) ? true : false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            loop: (manCarousel.children().length > 1) ? true : false,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1
                },
                480:{
                    items: 2
                },
                768:{
                    items: 3
                },
                991:{
                    items: 4
                },
                1199:{
                    items: 6
                }
            },
            navText: ['<i class="font-left-open-big">','<i class="font-right-open-big">']
        });
    }
});