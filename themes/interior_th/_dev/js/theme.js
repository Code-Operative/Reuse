/**
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
 */
import 'expose-loader?Tether!tether';


import 'bootstrap/dist/js/bootstrap.min';
import 'flexibility';
import 'bootstrap-touchspin';
import "bootstrap/scss/bootstrap";

import "../css/override/_index";
import "../css/partials/_index";

import "../css/components/_typography";
import "../css/components/htmlbanners/_index";
import "../css/components/_manufacturers";
import "../css/components/contact/_index";
import "../css/components/mainmenu/_index";
import "../css/components/shopping-cart/_index";
import "../css/components/plugins/_index";
import "../css/components/products/_index";
import "../css/components/search/_index";
import "../css/components/blog/_index";
import "../css/components/ui/_index";
import "../css/components/catalog/_index";
import "../css/components/comments/_index";
import "../css/components/wishlist/_index";
import "../css/components/product/_index";
import "../css/components/order/_index";
import "../css/components/_man-sup";
import "../css/components/_breadcrumb";
import "../css/components/_alert";
import "../css/components/reassurance/_index";
import "../css/components/_buttons";
import "../css/components/_column";
import "../css/components/_cart";
import "../css/components/_categories";
import "../css/components/_custom-text";
import "../css/components/_customer";
import "../css/components/_password";
import "../css/components/_customization-modal";
import "../css/components/_errors";
import "../css/components/_featuredproducts";
import "../css/components/_footer";
import "../css/components/_form";
import "../css/components/_header";
import "../css/components/_imageslider";
import "../css/components/_legal-compliance";
import "../css/components/_products";
import "../css/components/_quickview";
import "../css/components/_userinfo";
import "../css/components/_localization";
import "../css/components/_social";
import "../css/components/_stores";
import "../css/components/_subscription";
import "../css/components/_modal";
import "../css/components/_fancybox";
import "../css/components/_wrapper";
import "../css/components/_cms";
import "../css/components/_sitemap";
import "../css/components/_scroll-top";
import "../css/components/_links";
import "../css/components/animation/_index";
import "../css/rtl/_index";

import '../css/theme';
import './responsive';
import './checkout';
import './customer';
import './listing';
import './product';
import './cart';

import DropDown from './components/drop-down';
import Form from './components/form';
import ProductMinitature from './components/product-miniature';
import ProductSelect from './components/product-select';
import TopMenu from './components/top-menu';
import DisplayView from './components/display-view';
//import {WOW} from 'wowjs/dist/wow.js';
import prestashop from 'prestashop';
import EventEmitter from 'events';

import './lib/bootstrap-filestyle.min';
import './lib/jquery.scrollbox.min';
import './components/block-cart'

// "inherit" EventEmitter
for (var i in EventEmitter.prototype) {
  prestashop[i] = EventEmitter.prototype[i];
}

$(document).ready(() => {
  let dropDownEl = $('.js-dropdown');
  const form = new Form();
  let topMenuEl = $('.js-top-menu ul[data-depth="0"]');
  let dropDown = new DropDown(dropDownEl);
  let topMenu = new TopMenu(topMenuEl);
  let productMinitature = new ProductMinitature();
  let productSelect  = new ProductSelect();
  let displayView  = new DisplayView();
  dropDown.init();
  form.init();
  topMenu.init();
  productMinitature.init();
  productSelect.init();
  displayView.init();
});
