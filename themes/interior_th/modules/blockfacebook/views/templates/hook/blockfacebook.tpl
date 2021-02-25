{*
* 2007-2016 PrestaShop
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
*  @copyright  2007-2016 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $facebookurl != ''}
<div id="fb-root"></div>
<div id="facebook_block" class="col-lg-3 links wrapper">
	<h3 class="text-uppercase block-contact-title hidden-md-down">{l s='Follow us on Facebook' d='Modules.Blockfacebook.Shop'}</h3>
	<div class="title clearfix hidden-lg-up" data-target="#facebook-fanbox" data-toggle="collapse">
	  <span class="h3">{l s='Follow us on Facebook' d='Modules.Blockfacebook.Shop'}</span>
	  <span class="pull-xs-right">
	    <span class="navbar-toggler collapse-icons">
	      <i class="material-icons add">&#xE313;</i>
	      <i class="material-icons remove">&#xE316;</i>
	    </span>
	  </span>
	</div>
	<div id="facebook-fanbox" class="facebook-fanbox collapse">
		<div class="fb-like-box" data-href="{$facebookurl|escape:'html':'UTF-8'}" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false">
		</div>
	</div>
</div>
{/if}
