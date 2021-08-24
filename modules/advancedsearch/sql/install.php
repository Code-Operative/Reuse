<?php

include_once _PS_MODULE_DIR_ . 'advancedsearch/sql/InstallTools.php';

$db = DB::getInstance();
$installTools = new InstallTools($db);

$sql = array();

$sql[] = 'SET FOREIGN_KEY_CHECKS=0';
$sql[] = "DROP TABLE IF EXISTS "
    . _DB_PREFIX_
    . "advanced_search_seller_shipping_coverage";
$sql[] = "CREATE TABLE IF NOT EXISTS "
    . _DB_PREFIX_ . "advanced_search_seller_shipping_coverage (
          id_coverage INT(10) NOT NULL AUTO_INCREMENT,
          id_seller INT(10) DEFAULT NULL,
          postcode_coverage VARCHAR(8) DEFAULT NULL,
          PRIMARY KEY (id_coverage)
        ) ENGINE="
    . _MYSQL_ENGINE_
    . " DEFAULT CHARSET=utf8";
$sql[] = 'SET FOREIGN_KEY_CHECKS=1';
$sql[] = "INSERT INTO "
    . _DB_PREFIX_
    . "kb_mp_custom_fields (id_section, field_name, type, validation, html_id,
            html_class, file_extension, allow_multifile, max_length, min_length,
            required, editable, multiselect, show_registration_form,
            show_text_editor, show_seller_profile, active, position, date_add,
            date_upd) VALUES (2, 'field_lat', 'text', '', 'field_1627502742', 'field_1627502742', '', 0, 25, 0, 0, 0, 0, 0, 0, 0, 1, 0,
            current_timestamp(), null)";
$sql[] = "INSERT INTO "
    . _DB_PREFIX_
    . "kb_mp_custom_fields (id_section, field_name, type, validation, html_id,
            html_class, file_extension, allow_multifile, max_length, min_length,
            required, editable, multiselect, show_registration_form,
            show_text_editor, show_seller_profile, active, position, date_add,
            date_upd)
          VALUES ( 2, 'field_lon', 'text', '', 'field_1627502885', 'field_1627502885', '', 0, 25, 0, 0, 0, 0, 0, 0, 0, 1, 0,
            current_timestamp(), null)";
$sql[] = 'ALTER TABLE ' . _DB_PREFIX_ . 'customer ADD COLUMN postcode VARCHAR(8)';
$sql[] = 'ALTER TABLE ' . _DB_PREFIX_ . 'customer ADD COLUMN lat VARCHAR(25)';
$sql[] = 'ALTER TABLE ' . _DB_PREFIX_ . 'customer ADD COLUMN lon VARCHAR(25)';
$sql[] = 'CREATE TABLE IF NOT EXISTS '
    . _DB_PREFIX_
    . 'advanced_search_seller_status
            (
                id MEDIUMINT NOT NULL AUTO_INCREMENT,
                id_seller INT(10) UNSIGNED NOT NULL,
                postcode_status BOOLEAN,
                postcode_coverage_status BOOLEAN,
                PRIMARY KEY (id)
            )';
$sql[] = "CREATE TRIGGER tg_geoloc AFTER UPDATE ON "
    ._DB_PREFIX_
    ."kb_mp_custom_field_seller_mapping
            FOR EACH ROW
            BEGIN
                DECLARE cant INT(1);
                SET cant=(SELECT COUNT(*) FROM advanced_search_seller_status WHERE id_seller=OLD.id_seller);
                IF OLD.id_field=(SELECT id_field FROM psrn_kb_mp_custom_fields WHERE field_name='collection_postcode')
                   AND OLD.value <> NEW.value AND cant=0 THEN
                      INSERT INTO advanced_search_seller_status (id_seller, postcode_status) VALUES(OLD.id_seller, true);
                END IF;
                IF OLD.id_field=(SELECT id_field FROM psrn_kb_mp_custom_fields WHERE field_name='collection_postcode')
                   AND OLD.value <> NEW.value AND cant>0 THEN
                      UPDATE advanced_search_seller_status SET postcode_status=true WHERE id_seller=OLD.id_seller;
                END IF;
                    IF OLD.id_field=(SELECT id_field FROM psrn_kb_mp_custom_fields WHERE field_name='delivery_postcode_prefix')
                   AND OLD.value <> NEW.value AND cant=0 THEN
                                INSERT INTO advanced_search_seller_status (id_seller, postcode_coverage_status) VALUES(OLD.id_seller, true);
                END IF;
                IF OLD.id_field=(SELECT id_field FROM "
    ._DB_PREFIX_
    ."kb_mp_custom_fields WHERE field_name='delivery_postcode_prefix')
                   AND OLD.value <> NEW.value AND cant>0 THEN
                                UPDATE advanced_search_seller_status SET postcode_coverage_status=true WHERE id_seller=OLD.id_seller;
                END IF;
            END";

foreach ($sql as $query) {
    if ($db->execute($query) === false) {
        return false;
    }
}

if ($installTools->updateSellerShippingCoverage() === false) {
    return false;
}

if ($installTools->addLanguageLat() === false) {
    return false;
}

if ($installTools->addLanguageLon() === false) {
    return false;
}
