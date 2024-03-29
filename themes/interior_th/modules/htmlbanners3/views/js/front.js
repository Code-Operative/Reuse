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
    //fancybox popoup
     if (!!$.prototype.fancybox)
     $('.js-open-video').fancybox({
         'width':    1100,
         'height':  'auto',
         'padding': 0,
         'hideOnContentClick': false,
         wrapCSS : 'video-frame',
         afterLoad: function() {
            setTimeout(function(){
                playVideo();
                pauseVideo();
            }, 1000);
         }
     });
     function playVideo() {
        if ($('.fancybox-skin .js-video').length != 0) {
            $('.fancybox-skin .js-video').get(0).play();
        }
    }
    function pauseVideo() {
        if ($('.fancybox-skin .js-video').length != 0) {
            $('.fancybox-close, .fancybox-overlay').one('click', function(){
                $('.js-video').get(0).pause();
            });
        }
    }
});