<?php

include_once _PS_MODULE_DIR_ . 'advancedsearch/sql/InstallTools.php';

$db = DB::getInstance();
$installTools = new InstallTools($db);

if ($installTools->deleteLanguageLat() === false) {
    return false;
}

if ($installTools->deleteLanguageLon() === false) {
    return false;
}

$sql = array();

$sql[] = 'SET FOREIGN_KEY_CHECKS=0';
$sql[] = "DROP TRIGGER IF EXISTS tg_geoloc";
$sql[] = "DROP TABLE IF EXISTS " . _DB_PREFIX_ . "advanced_search_seller_shipping_coverage";
$sql[] = 'SET FOREIGN_KEY_CHECKS=1';
$sql[] = "DELETE FROM " . _DB_PREFIX_ . "kb_mp_custom_fields WHERE field_name LIKE 'field_lat'";
$sql[] = "DELETE FROM " . _DB_PREFIX_ . "kb_mp_custom_fields WHERE field_name LIKE 'field_lon'";
$sql[] = 'ALTER TABLE ' . _DB_PREFIX_ . 'customer DROP COLUMN postcode';
$sql[] = 'ALTER TABLE ' . _DB_PREFIX_ . 'customer DROP COLUMN lat';
$sql[] = 'ALTER TABLE ' . _DB_PREFIX_ . 'customer DROP COLUMN lon';
$sql[] = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'advanced_search_seller_status';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) === false) {
        return false;
    }
}


