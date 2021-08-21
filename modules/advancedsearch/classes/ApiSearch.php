<?php

class ApiSearch
{
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
    public function getApiGeocoding($url,$postcode): array
    {
        $arr = [];
        $curl = curl_init();
        $postcode = curl_escape($curl, $postcode);
        $url = $url.$postcode;

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

        return $this->getApiGeocoding($url,$postcode);
    }


    /**
     * Find all seller, check is the sellers have lat and lon.
     *
     * @return void
     * @throws PrestaShopDatabaseException
     */
    public function checkSellersLatLon(): void
    {
        $db = Db::getInstance();

        $sellers = [];
        $request = 'DELETE FROM ' . _DB_PREFIX_ . 'kb_mp_custom_field_seller_mapping WHERE id_field=(SELECT id_field FROM '
            . _DB_PREFIX_ . 'kb_mp_custom_fields WHERE field_name="field_lat") AND value is null';
        $db->execute($request);
        $request = 'DELETE FROM ' . _DB_PREFIX_ . 'kb_mp_custom_field_seller_mapping WHERE id_field=(SELECT id_field FROM '
            . _DB_PREFIX_ . 'kb_mp_custom_fields WHERE field_name="field_lon") AND value is null';
        $db->execute($request);
        $request = 'SELECT id_customer, id_employee, id_seller, id_field, value FROM '
            . _DB_PREFIX_
            . 'kb_mp_custom_field_seller_mapping WHERE id_field=(SELECT id_field FROM '
            . _DB_PREFIX_ . 'kb_mp_custom_fields WHERE field_name="collection_postcode") AND value is not null';
        $sellers = $db->executeS($request);
        foreach ($sellers as $seller) {
            $request = 'SELECT count(*) as num FROM '
                . _DB_PREFIX_
                . 'kb_mp_custom_field_seller_mapping WHERE id_seller = '
                . $seller["id_seller"]
                . ' AND ((id_field=(SELECT id_field FROM '
                . _DB_PREFIX_
                . 'kb_mp_custom_fields WHERE field_name="field_lat") AND value is not null) OR (id_field=(SELECT id_field FROM '
                . _DB_PREFIX_ . 'kb_mp_custom_fields WHERE field_name="field_lon") AND value is not null))';
            $sellerc = $db->executeS($request);
            $latlon = [];
            if ($sellerc[0]["num"] == 0) {
                $latlon = $this->getLatAndLog($seller["value"]);
                if (isset($latlon["latitude"])) {
                    $request = 'INSERT INTO '
                        . _DB_PREFIX_
                        . 'kb_mp_custom_field_seller_mapping VALUES (default,'
                        . $seller["id_customer"]
                        . ','
                        . $seller["id_seller"]
                        . ', '
                        . $seller["id_employee"]
                        . ',(SELECT id_field FROM '. _DB_PREFIX_ .'kb_mp_custom_fields WHERE field_name="field_lat"),"'
                        . $latlon["latitude"] . '", now(), now() )';
                    $db->execute($request);
                }
                if (isset($latlon["longitude"])) {
                    $request = 'INSERT INTO '
                        . _DB_PREFIX_
                        . 'kb_mp_custom_field_seller_mapping VALUES (default,'
                        . $seller["id_customer"]
                        . ','
                        . $seller["id_seller"]
                        . ', '
                        . $seller["id_employee"]
                        . ',(SELECT id_field FROM '._DB_PREFIX_ .'kb_mp_custom_fields WHERE field_name="field_lon"),"'
                        . $latlon["longitude"] . '", now(), now() )';
                    $db->execute($request);
                }
            }
        }
    }

    /**
     * @param $latitude
     * @param $longitude
     * @param $distance
     * @return array devuelve un arreglo con el idSeler y las distancias
     * @throws PrestaShopDatabaseException
     */
    public function getSellerByDistance($latitude, $longitude, $distance): array
    {
        if (!$latitude || !$longitude) {
            return [];
        }

        //temporary patch to set lat&lon sellers's
        $this->checkSellersLatLon();

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
        foreach ($sellers as $seller) {
            $product[] = $this->getProductBySeller($seller['id_seller']);
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
                          FROM '._DB_PREFIX_.'kb_mp_custom_field_seller_mapping sm
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

    public function getSellersCovered(): array
    {
        $db = Db::getInstance();

        $request = 'SELECT DISTINCT id_seller FROM' . _DB_PREFIX_ . 'advanced_search_seller_shipping_coverage cv
                    WHERE COALESCE(cv.cp_district,0)=0 AND cv.cp_area="HA"
                    OR  COALESCE(cv.cp_district,0)<>0 AND cv.cp_area="HA" AND cv.cp_district="1"';

        return $db->executeS($request);
    }

}