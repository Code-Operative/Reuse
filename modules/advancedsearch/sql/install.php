<?php

$sql = array();

$sql[] = 'SET FOREIGN_KEY_CHECKS=0';
$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'advanced_search_seller_shipping_coverage`';
$sql[] = 'CREATE TABLE `' . _DB_PREFIX_ . 'advanced_search_seller_shipping_coverage` (
          `id_coverage` INT(10) NOT NULL AUTO_INCREMENT,
          `id_seller` INT(10) DEFAULT NULL,
          `id_carrier` INT(10) DEFAULT NULL,
          `postcode_coverage` VARCHAR(8) DEFAULT NULL,
          PRIMARY KEY (`id_coverage`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';
$sql[] = 'SET FOREIGN_KEY_CHECKS=1';

$sql[] = "INSERT INTO ". _DB_PREFIX_ ."kb_mp_custom_fields (id_section, field_name, type, validation, html_id,
            html_class, file_extension, allow_multifile, max_length, min_length,
            required, editable, multiselect, show_registration_form,
            show_text_editor, show_seller_profile, active, position, date_add,
            date_upd) VALUES (2, 'field_lat', 'text', '', 'field_1627502742', 'field_1627502742', '', 0, 25, 0, 0, 0, 0, 0, 0, 0, 1, 0,
            current_timestamp(), null)";
$sql[] = "INSERT INTO " ._DB_PREFIX_. "kb_mp_custom_fields (id_section, field_name, type, validation, html_id,
            html_class, file_extension, allow_multifile, max_length, min_length,
            required, editable, multiselect, show_registration_form,
            show_text_editor, show_seller_profile, active, position, date_add,
            date_upd)
          VALUES ( 2, 'field_lon', 'text', '', 'field_1627502885', 'field_1627502885', '', 0, 25, 0, 0, 0, 0, 0, 0, 0, 1, 0,
            current_timestamp(), null)";

$sql[] = 'ALTER TABLE '._DB_PREFIX_.'customer ADD COLUMN postcode VARCHAR(8)';
$sql[] = 'ALTER TABLE '._DB_PREFIX_.'customer ADD COLUMN lat VARCHAR(25)';
$sql[] = 'ALTER TABLE '._DB_PREFIX_.'customer ADD COLUMN lon VARCHAR(25)';
$sql[] = 'CREATE TABLE ' . _DB_PREFIX_ . 'advanced_search_seller_status
            (
                id MEDIUMINT NOT NULL AUTO_INCREMENT,
                id_seller INT(10) UNSIGNED NOT NULL,
                postcode_status BOOLEAN,
                postcode_soverage_status BOOLEAN,
                PRIMARY KEY (id)
            )';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) === false) {
        return false;
    }
}
