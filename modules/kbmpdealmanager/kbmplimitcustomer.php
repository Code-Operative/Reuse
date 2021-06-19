<?php
include(dirname(__FILE__) . '/../../config/config.inc.php');
include(_PS_ROOT_DIR_ . '/init.php');

if (Tools::getValue('customerFilter')) {
    $search_query = trim(Tools::getValue('q'));
    $customers = Db::getInstance()->executeS('
                SELECT `id_customer`, `email`, CONCAT(`firstname`, \' \', `lastname`) as cname
                FROM `'._DB_PREFIX_.'customer`
                WHERE `deleted` = 0 AND is_guest = 0 AND active = 1
                AND (
                        `id_customer` = '.(int)$search_query.'
                        OR `email` LIKE "%'.pSQL($search_query).'%"
                        OR `firstname` LIKE "%'.pSQL($search_query).'%"
                        OR `lastname` LIKE "%'.pSQL($search_query).'%"
                )
                ORDER BY `firstname`, `lastname` ASC
                LIMIT 20');
    if ($customers) {
        foreach ($customers as $cust) {
            echo $cust['id_customer'].'-'.$cust['cname'].'('.$cust['email'].')'. "\n";
        }
    }
}
