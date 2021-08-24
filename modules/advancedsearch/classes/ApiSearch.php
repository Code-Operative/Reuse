<?php

include_once _PS_MODULE_DIR_ . 'advancedsearch/sql/InstallTools.php';

class ApiSearch
{

    private $installTools;
    private $sellersDistance;


    public function __construct()
    {
        $db = DB::getInstance();
        $this->installTools = new InstallTools($db);
    }

     /**
     * Build url for google geocoding
     * @return string
     */
    public function getURLApiPostcodes(): string
    {
        return 'https://api.postcodes.io/postcodes/';
    }

    /**
     * Call to postcode.io api geocoding
     * @param $url
     * @param $postcode
     * @return array
     */
    public function getApiGeocoding($url, $postcode): array
    {
        $arr = [];
        $curl = curl_init();
        $postcode = curl_escape($curl, $postcode);
        $url = $url . $postcode;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        if ($response->status !== 200) {
            //TODO handle ex
        } else {
            $decodedresponse = $response->result;
            $arr['latitude'] = $decodedresponse->latitude;
            $arr['longitude'] = $decodedresponse->longitude;
        }

        curl_close($curl);

        return $arr;
    }

    /**
     * Get lat and long in array from api geocoding
     *
     * @param $postcode
     * @return array
     */
    public function getLatAndLog($postcode): array
    {
        $url = $this->getURLApiPostcodes();

        return $this->getApiGeocoding($url, $postcode);
    }


    /**
     * Update sellers postcode status
     * @return array
     */
    public function updateSellersPostcodesStatus(): void
    {
        $db = Db::getInstance();

        $request = "UPDATE " . _DB_PREFIX_ . "advanced_search_seller_status SET postcode_status = false, postcode_coverage_status= false";

        $db->execute($request);
    }

    /**
     * Get sellers postcode status
     * @return array
     */
    public function getSellersPostcodesStatus(): array
    {
        $db = Db::getInstance();

        $request = "SELECT id, id_seller, postcode_status, postcode_coverage_status FROM "
            . _DB_PREFIX_
            . "advanced_search_seller_status";

        return $db->executeS($request);
    }

    /**
     * Update sellers postcodes
     * @param $status
     * @return void
     */
    public function updateSellersPostcodes($status):void 
    {
        foreach ($status as $seller){
            if($seller['postcode_status']){
                $this->cleanSellerLatLon($seller['id_seller']);
                $this->setSellerLatLon($seller['id_seller']);
            }
        }
    }

    /**
     * Delete seller latitud & longitude
     * @param $seller
     * @return void
     */
    public function cleanSellerLatLon($seller): void 
    {
        $db = Db::getInstance();

        $request = "DELETE FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_field_seller_mapping WHERE id_field=(SELECT id_field FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_fields WHERE field_name='field_lat') AND id_seller =" . $seller;
        $db->execute($request);

        $request = "DELETE FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_field_seller_mapping WHERE id_field=(SELECT id_field FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_fields WHERE field_name='field_lon') AND id_seller =" . $seller;
        $db->execute($request);
    }

    /**
     * Update seller delivery postcodes
     * @param $status
     * @return void
     */
    public function updateSellersDeliveryPostcodes($status):void 
    {
        foreach ($status as $seller){
            if($seller['postcode_coverage_status']){
                $this->cleanSellerCoverage($seller['id_seller']);
                $this->setSellerCoverage($seller['id_seller']);
            }
        }
    }

    /**
     * Delete all seller postcode coverage 
     * @param $seller
     * @return void
     */
    public function cleanSellerCoverage($seller): void 
    {
        $db = Db::getInstance();

        $request = "DELETE FROM "
            . _DB_PREFIX_
            . "advanced_search_seller_shipping_coverage WHERE id_seller =" . $seller;
        $db->execute($request);
    }

    /**
     * Delete rows with null latitude & longitude
     * @return void
     */
    public function cleanNullLatLon(): void 
    {
        $db = Db::getInstance();

        $request = "DELETE FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_field_seller_mapping WHERE id_field=(SELECT id_field FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_fields WHERE field_name='field_lat') AND value is null";
        $db->execute($request);

        $request = "DELETE FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_field_seller_mapping WHERE id_field=(SELECT id_field FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_fields WHERE field_name='field_lon') AND value is null";
        $db->execute($request);
    }

    /**
     * Get seller postcode
     * @param $seller
     * @return array
     */
    public function getSellerCollectionPostcode($seller): array
    {
        $db = Db::getInstance();

        $request = "SELECT id_customer, id_employee, value FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_field_seller_mapping WHERE id_field=(SELECT id_field FROM "
            . _DB_PREFIX_
            . "kb_mp_custom_fields WHERE field_name='collection_postcode') AND id_seller =" . $seller;

        return $db->executeS($request);
    }

    /**
     * Update seller lat & lon
     *
     * @return void
     * @throws PrestaShopDatabaseException
     */
    public function setSellerLatLon($seller): void
    {
        $db = Db::getInstance();

        $sellerpostcode = $this->getSellerCollectionPostcode($seller);

        if(!empty($sellerpostcode)){
            foreach ($sellerpostcode as $postcode){
                $latlon = $this->getLatAndLog($postcode['value']);
                if (isset($latlon["latitude"])) {
                    $request = 'INSERT INTO '
                    . _DB_PREFIX_
                    . 'kb_mp_custom_field_seller_mapping VALUES (default,'
                    . $postcode["id_customer"]
                    . ','
                    . $seller
                    . ', '
                    . $postcode["id_employee"]
                    . ',(SELECT id_field FROM ' . _DB_PREFIX_ . 'kb_mp_custom_fields WHERE field_name="field_lat"),"'
                    . $latlon["latitude"] . '", now(), now() )';
                    $db->execute($request);
                }
                if (isset($latlon["longitude"])) {
                    $request = 'INSERT INTO '
                    . _DB_PREFIX_
                    . 'kb_mp_custom_field_seller_mapping VALUES (default,'
                    . $postcode["id_customer"]
                    . ','
                    . $seller
                    . ', '
                    . $postcode["id_employee"]
                    . ',(SELECT id_field FROM ' . _DB_PREFIX_ . 'kb_mp_custom_fields WHERE field_name="field_lon"),"'
                    . $latlon["longitude"] . '", now(), now() )';
                    $db->execute($request);
                }
            }
        }
    }

    /**
     * Get seller delivery postcodes
     * @param $seller
     * @return array
     */
    public function getSellerDeliveryPostCodes($seller): array 
    {
        $db = Db::getInstance();

        $idField = $this->installTools->getIdDeliveryPostcodePrefix();

        $query = "SELECT value FROM ". _DB_PREFIX_ ."kb_mp_custom_field_seller_mapping WHERE id_field = ". $idField . " AND id_seller = " . $seller;

        return $db->executeS($query);
    }

    /**
     * Set Seller coverage
     * @param $seller
     * @return void
     */
    public function setSellerCoverage($seller): void
    {
        $postcodes = $this->getSellerDeliveryPostCodes($seller);
        foreach ($postcodes as $postcodelist){
            $postcodeCoverages = $this->installTools->cleanDeliveryPostcodePrefix($postcodelist['value']);
            foreach ($postcodeCoverages as $coverage)
            {
                $this->installTools->insertSellerCoverage($seller, $coverage);
            }
        }
    }

    /**
     * Check all sellers postcodes and delivery postcodes
     * @param $url
     * @param $postcode
     * @return array
     */
    public function checkSellersPostcodes(): void
    {
        $this->cleanNullLatLon();
        $status = $this->getSellersPostcodesStatus();
        $this->updateSellersPostcodes($status);
        $this->updateSellersDeliveryPostcodes($status);
        $this->updateSellersPostcodesStatus();
    }

    /**
     * @param $latitude
     * @param $longitude
     * @param $distance
     * @return array return array with idSeler and distances
     * @throws PrestaShopDatabaseException
     */
    public function getSellersByDistance($latitude, $longitude, $distance): array
    {
        if (!$latitude || !$longitude) {
            return [];
        }

        $db = Db::getInstance();

        $request = 'SELECT geo.id_seller, (((acos(sin((' . $latitude . '*pi()/180)) *        
            sin((geo.lat*pi()/180))+cos((' . $latitude . '*pi()/180)) *  
            cos((geo.lat*pi()/180)) * cos(((' . $longitude . ' - geo.lon)* 
            pi()/180))))*180/pi())*60*1.1515
        ) as distance 
        FROM (SELECT id_seller, SUM(lat) AS lat, SUM(lon) AS lon FROM
								(SELECT id_seller, 
												CASE WHEN id_field=(SELECT id_field FROM psrn_kb_mp_custom_fields WHERE field_name="field_lat") THEN sm.value ELSE 0 END AS lat, 
												CASE WHEN id_field=(SELECT id_field FROM psrn_kb_mp_custom_fields WHERE field_name="field_lon") THEN sm.value ELSE 0 END AS lon 
									FROM psrn_kb_mp_custom_field_seller_mapping sm 
									WHERE id_field=(SELECT id_field FROM psrn_kb_mp_custom_fields WHERE field_name="field_lat") 
                     OR id_field=(SELECT id_field FROM psrn_kb_mp_custom_fields WHERE field_name="field_lon")) AS sm
									GROUP BY sm.id_seller) AS geo
        HAVING distance < ' . $distance;

        return $db->executeS($request);
    }

    /**
     * @param $idSeller
     * @return array
     * @throws PrestaShopDatabaseException
     */
    public function getProductBySeller($idSeller): array
    {
        $db = Db::getInstance();

        $request = 'SELECT id_product FROM ' . _DB_PREFIX_ . 'kb_mp_seller_product WHERE id_seller =' . $idSeller;
        return $db->executeS($request);
    }

    /**
     * @throws PrestaShopDatabaseException
     */
    public function getProductBySellers($sellers): array
    {
        $product = [];
        foreach ($sellers as $index=>$seller) {
            $prods = $this->getProductBySeller($seller['id_seller']);
            $prod = [];
            foreach ($prods as $idx=>$prod) {
                $prod['id_seller'] = $seller['id_seller'];
                $prod['distance'] = $seller['distance'];
                $product[] = $prod;
            }
        }
        return $product;
    }

    public function getSellersCoveredDistance($latitude, $longitude): array
    {
        if (!$latitude || !$longitude) {
            return [];
        }

        $db = Db::getInstance();

        $request = 'SELECT a.id_seller, a.distance
        FROM (SELECT geo.id_seller,
                     (((acos(sin((' . $latitude . ' * pi() / 180)) * -- Latitud
                             sin((geo.lat * pi() / 180)) + cos((' . $latitude . ' * pi() / 180)) * -- Latitud
                                                           cos((geo.lat * pi() / 180)) *
                                                           cos((( ' . $longitude . '- geo.lon) * -- Longitud
                                                                pi() / 180)))) * 180 / pi()) * 60 * 1.1515
                         ) as distance
              FROM (SELECT id_seller, SUM(lat) AS lat, SUM(lon) AS lon
                    FROM (SELECT id_seller,
                                 CASE
                                     WHEN id_field =
                                          (SELECT id_field FROM ' . _DB_PREFIX_ . '_kb_mp_custom_fields WHERE field_name = "field_lat")
                                         THEN sm.value
                                     ELSE 0 END AS lat,
                                 CASE
                                     WHEN id_field =
                                          (SELECT id_field FROM ' . _DB_PREFIX_ . '_kb_mp_custom_fields WHERE field_name = "field_lon")
                                         THEN sm.value
                                     ELSE 0 END AS lon
                          FROM ' . _DB_PREFIX_ . 'kb_mp_custom_field_seller_mapping sm
                          WHERE id_field = (SELECT id_field FROM ' . _DB_PREFIX_ . 'kb_mp_custom_fields WHERE field_name = "field_lat")
                             OR id_field = (SELECT id_field FROM ' . _DB_PREFIX_ . 'kb_mp_custom_fields WHERE field_name = "field_lon")) AS sm
                    GROUP BY sm.id_seller) AS geo
              HAVING distance < 10
              UNION
              SELECT DISTINCT id_seller, 0 AS distance
              FROM ' . _DB_PREFIX_ . 'advanced_search_seller_shipping_coverage cv
              WHERE COALESCE(cv.cp_district, 0) = 0 AND cv.cp_area = "HA"
                 OR COALESCE(cv.cp_district, 0) <> 0 AND cv.cp_area = "HA" AND cv.cp_district = "1") AS a
              GROUP BY a.id_seller';
        return $db->executeS($request);
    }

    /**
     * @param $postcode
     * @return array
     * @throws PrestaShopDatabaseException
     */
    public function getSellersCovered($postcode): array
    {
        $db = Db::getInstance();

        $request = "SELECT DISTINCT id_seller FROM "
            . _DB_PREFIX_
            . "advanced_search_seller_shipping_coverage WHERE '"
            . $this->cleanPostcode($postcode)
            . "' like concat('%', postcode_coverage , '%')";

        return $db->executeS($request);
    }

    public function setSellersProductsByDistance($sellers): void
    {
        $this->sellersDistance[] = $sellers;
    }

    public function getSellersProductsByDistance(): array
    {
        return $this->sellersDistance;
    }

    public function cleanPostcode($postcode): string
    {
        $postcode = strip_tags($postcode);
        return strtoupper(str_replace(" ", "", $postcode));
    }
}
