<?php
/**
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
* @author    PrestaShop SA    <contact@prestashop.com>
* @copyright 2007-2020 PrestaShop SA
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
* International Registered Trademark & Property of PrestaShop SA
*/

class FancyboxThumb extends Module
{
    public function __construct()
    {
        $this->name = 'fancyboxthumb';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Prestahero';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Fancybox Thumbnails');
        $this->description = $this->l('Fancybox thumbnails on product page');
    }

    public function install()
    {
        return (parent::install() && $this->registerHook('header') && $this->registerHook('displayBackOfficeHeader'));
    }

    public function uninstall()
    {
        parent::uninstall();
        return true;
    }

    public function hookHeader()
    {
        if ($this->context->controller instanceof ProductControllerCore) {
            $this->context->controller->addjqueryPlugin('fancybox');
            $this->context->controller->addJS($this->_path.'views/js/front.js');
        }
    }
    public function hookDisplayBackOfficeHeader()
    {
        $this->context->controller->addCSS($this->_path.'views/css/admin.css', 'all');
    }
}
