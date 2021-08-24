<?php

class InstallTools
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function getPostCodes():array
    {
        $idField = $this->getIdDeliveryPostcodePrefix();

        $query = "SELECT * FROM ". _DB_PREFIX_ ."kb_mp_custom_field_seller_mapping WHERE id_field = ". $idField;

        return $this->db->executeS($query);
    }

    public function updateSellerShippingCoverage():bool
    {
        $postcodes = $this->getPostCodes();

        foreach ($postcodes as $postcode)
        {
            $idSeller = $postcode['id_seller'];
            $postcodeCoverages = $this->cleanDeliveryPostcodePrefix($postcode['value']);
            foreach ($postcodeCoverages as $coverage)
            {
                $result = $this->insertSellerCoverage($idSeller, $coverage);
                if($result === false) {
                    return false;
                }
            }
        }

        return true;
    }

    public function insertSellerCoverage($idSeller, $coverage):bool
    {
        $query = "INSERT INTO "
            . _DB_PREFIX_
            ."advanced_search_seller_shipping_coverage(id_seller, postcode_coverage) values ("
            .$idSeller .", '". $coverage. "')";

        return $this->db->execute($query);

    }

    public function cleanDeliveryPostcodePrefix($value):array
    {
        $cleanValues = [];
        $value = strip_tags($value);
        $values = explode(";", $value);

        foreach ($values as $valueToClean)
        {
            $cleanValues[] = strtoupper(str_replace(" ", "", $valueToClean));
        }

        return $cleanValues;
    }

    public function deleteLanguageLon():bool
    {
        $idLon = $this->getIdLon();
        $query = "DELETE FROM "
            . _DB_PREFIX_
            ."kb_mp_custom_fields_lang WHERE id_field = "
            . $idLon ;

        return $this->db->execute($query);
    }

    public function deleteLanguageLat():bool
    {
        $idLat = $this->getIdLat();
        $query = "DELETE FROM "
            . _DB_PREFIX_
            ."kb_mp_custom_fields_lang WHERE id_field = "
            . $idLat ;

        return $this->db->execute($query);
    }

    public function addLanguageLat():bool
    {
        $idLat = $this->getIdLat();
        $query = "INSERT INTO "
            . _DB_PREFIX_
            ."kb_mp_custom_fields_lang(id_field, id_lang, id_shop, label, description, placeholder) values ('"
            . $idLat
            ."', 2, 1, 'field_lat', 'Lat from api.', 'Latitude')";

        return $this->db->execute($query);
    }

    public function addLanguageLon():bool
    {
        $idLat = $this->getIdLon();
        $query = "INSERT INTO "
            . _DB_PREFIX_
            ."kb_mp_custom_fields_lang(id_field, id_lang, id_shop, label, description, placeholder) values ('"
            . $idLat
            ."', 2, 1, 'field_lon', 'Lon from api.', 'Longitude')";

        return $this->db->execute($query);
    }

    public function getIdLat():string
    {
        $query = "SELECT id_field FROM "
            . _DB_PREFIX_
            ."kb_mp_custom_fields WHERE field_name= 'field_lat'";
        return $this->db->getValue($query);
    }

    public function getIdLon():string
    {
        $query = "SELECT id_field FROM "
            . _DB_PREFIX_
            ."kb_mp_custom_fields WHERE field_name= 'field_lon'";
        return $this->db->getValue($query);
    }

    public function getIdDeliveryPostcodePrefix():string
    {
        $query = "SELECT id_field FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_fields WHERE field_name= 'delivery_postcode_prefix'";

        return $this->db->getValue($query);
    }
}