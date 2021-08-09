<?php
/**
 * 2007-2021 PrestaShop
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2021 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
$sql = array();

$sql[] = 'SET FOREIGN_KEY_CHECKS=0';
$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . '_kb_mp_seller_shipping_coverage`';
$sql[] = 'CREATE TABLE `' . _DB_PREFIX_ . '_kb_mp_seller_shipping_coverage` (
        `id_coverage` int(10) NOT NULL AUTO_INCREMENT,
          `id_seller` int(10) DEFAULT NULL,
          `id_carrier` int(10) DEFAULT NULL,
          `cp_area` varchar(3) DEFAULT NULL,
          `cp_district` varchar(3) DEFAULT NULL,
          PRIMARY KEY (`id_coverage`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' AUTO_INCREMENT=9 DEFAULT CHARSET=utf8';
$sql[] = 'SET FOREIGN_KEY_CHECKS=1';

$sql[] = 'ALTER TABLE ' . _DB_PREFIX_ . '_customer MODIFY lat varchar(25)';
$sql[] = 'ALTER TABLE ' . _DB_PREFIX_ . '_customer MODIFY lon varchar(25)';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
