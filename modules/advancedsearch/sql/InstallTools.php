<?php

class InstallTools
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getIdField(): string
    {
        $query = "SELECT id_field FROM "
            . _DB_PREFIX_ . "kb_mp_custom_fields WHERE field_name like 'delivery_postcode_prefix'";

        return $this->db->getValue($query);
    }

    public function getPostCodes():array
    {
        $idField = $this->getIdField();

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
}