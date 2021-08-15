<?php


class AdvancedsearchaSearchModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:advancedsearch/views/templates/front/display.tpl');
    }

    /**
     * Return seller address
     * @param $idSeller
     * @return string
     * @throws PrestaShopDatabaseException
     */
    public function getAddressSeller($idSeller): string
    {
        $db = \Db::getInstance();

        $request = 'SELECT address
                    FROM ' . _DB_PREFIX_ . '_kb_mp_seller
                    WHERE id_seller = ' . $idSeller;

        return $db->executeS($request);
    }

    /**
     * Return customer address
     * @param $idCustomer
     * @return string
     * @throws PrestaShopDatabaseException
     */
    public function getAddressCustomer($idCustomer): string
    {
        $db = \Db::getInstance();

        $request = 'SELECT address1
                    FROM' . _DB_PREFIX_ . '_address AS address
                    WHERE address.id_customer = ' . $idCustomer . ';';

        return $db->executeS($request);
    }

    /**
     * Return poscode customer
     * @return string
     * @throws PrestaShopDatabaseException
     */
    public function getPostCodeCustomer(): string
    {
        if ($this->context->customer->isLogged()) {
            $idCustomer = $this->context->customer->id;
            $db = \Db::getInstance();

            $request = 'SELECT postcode FROM' . _DB_PREFIX_ . 'WHERE id_customer = ' . $idCustomer . ';';

            $result = $db->executeS($request);
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * Get latitude, longitude and postcode
     * @return array postcode, latitude, longitude
     * @throws PrestaShopDatabaseException
     */
    public function getDirectionCustomer(): array
    {
        if ($this->context->customer->isLogged()) {
            $idCustomer = $this->context->customer->id;
            $db = \Db::getInstance();

            $request = 'SELECT postcode, lat as latitude, lon as longitude FROM '. _DB_PREFIX_ . '_customer 
                        WHERE id_customer = '.$idCustomer;

            $result = $db->executeS($request);
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * Build url for google geocoding
     * @param $postcode
     * @param $address
     * @param $key
     * @return string
     */
    public function getURLMaps($postcode, $address, $key): string
    {
        $urlApiBase = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
        $urlKeyComponent = '&key=' . urlencode($key);
        $urlCountyComponent = '&components=country:UK';
        if ($address) {
            $url = $urlApiBase . urlencode($address) . $urlCountyComponent . '|postal_code' . $postcode . $urlKeyComponent;
        } else {
            // no entra al eslse
            $url = $urlApiBase. $postcode . $urlCountyComponent . $urlKeyComponent;
        }

        return htmlspecialchars($url);
    }

    /**
     * Call to google api geocoding
     * @param $url
     * @return array
     */
    public function getApiGeocoding($url): array
    {
        $arr = [];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $curl_response = curl_exec($curl);

        if ($curl_response['status'] !== 'OK') {
            //TODO handle exception
        } else {
            $decodedresponse = json_decode($curl_response, true);
            $arr['latitude'] = $decodedresponse['response']['lat'];
            $arr['longitude'] = $decodedresponse['response']['long'];
        }

        curl_close($curl);

        return $arr;
    }

    /**
     * Get lat and long in array from api geocoding
     * @param $postcode
     * @param $idSeller
     * @param $idCustomer
     * @param $key
     * @return array
     * @throws PrestaShopDatabaseException
     */
    public function getLatAndLog($postcode, $idSeller, $idCustomer, $key): array
    {
        if ($idSeller) {
            $address = $this->getAddressSeller($idSeller);
        } elseif ($idCustomer) {
            $address = $this->getAddressCustomer($idCustomer);
        }

        $url = $this->getURLMaps($postcode, $address, $key);

        return $this->getApiGeocoding($url);
    }

    /**
     * @param $latitude
     * @param $longitude
     * @return array devuelve un arreglo con el idSeler y las distancias
     * @throws PrestaShopDatabaseException
     */
    public function getSellerByDistance($latitude, $longitude): array
    {
        if (!$latitude || !$longitude) {
            return [];
        }

        $db = \Db::getInstance();

        $request = 'SELECT geo.id_seller,
       (((acos(sin((' . $latitude . ' * pi() / 180)) * -- Latitud
               sin((geo.lat * pi() / 180)) + cos((' . $latitude . ' * pi() / 180)) * -- Latitud
                                             cos((geo.lat * pi() / 180)) * cos(((' . $longitude . ' - geo.lon) * -- Longitud
                                                                                pi() / 180)))) * 180 / pi()) * 60 *
        1.1515
           ) as distance
        FROM (SELECT id_seller, SUM(lat) AS lat, SUM(lon) AS lon
              FROM (SELECT id_seller,
                           CASE
                               WHEN id_field = (SELECT id_field FROM' . _DB_PREFIX_ . '_kb_mp_custom_fields WHERE field_name = "field_lat")
                                   THEN sm.value
                               ELSE 0 END AS lat,
                           CASE
                               WHEN id_field = (SELECT id_field FROM ' . _DB_PREFIX_ . '_kb_mp_custom_fields WHERE field_name = "field_lon")
                                   THEN sm.value
                               ELSE 0 END AS lon
                    FROM ' . _DB_PREFIX_ . '_kb_mp_custom_field_seller_mapping sm
                    WHERE id_field = (SELECT id_field FROM ' . _DB_PREFIX_ . '_kb_mp_custom_fields WHERE field_name = "field_lat")
                       OR id_field = (SELECT id_field FROM ' . _DB_PREFIX_ . '_kb_mp_custom_fields WHERE field_name = "field_lon")) AS sm
              GROUP BY sm.id_seller) AS geo
        HAVING distance < 10';

        return $db->executeS($request);
    }

    /**
     * @param $idSeller
     * @return array
     * @throws PrestaShopDatabaseException
     */
    public function getProductBySeller($idSeller): array
    {
        $db = \Db::getInstance();

        $request = 'SELECT id_product FROM ' . _DB_PREFIX_. '_kb_mp_seller_product WHERE id_seller ='. $idSeller;
        return $db->executeS($request);
    }

    /**
     * @throws PrestaShopDatabaseException
     */
    public function getProductBySellers($distanceform, $sellers): array
    {
        $product = [];
        foreach ($sellers as $seller) {
            if ($distanceform <= $seller['distance']) {
                $product[] = $this->getProductBySeller($seller['id_seller']);
            }
        }

        return $product;
    }

    /**
     * @throws PrestaShopDatabaseException
     */
    public function collectionSearch($parameters): void
    {
        $postcode = $parameters['postcode'];
        $distanceform = $parameters['distance'];
        //hago comparación postcode parameter con poscode array si son iguales ya tengo lat y long. Sino tengo que calcular
        if (!$this->context->customer->isLogged()) {
            $postcode = $parameters['postcode'];
            $arr = $this->getLatAndLog($postcode, null, null, 'AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4');
            $latitude = $arr['latitude'];
            $longitude = $arr['longitude'];
        } else {
            $customerDirection = $this->getDirectionCustomer();
            if ($customerDirection['postcode'] === $postcode) {
                $latitude = $customerDirection['latitude'];
                $longitude = $customerDirection['longitude'];
            } else {
                $idCustomer = $this->context->customer->id;
                $arr = $this->getLatAndLog($postcode, null, $idCustomer, 'AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4');
                $latitude = $arr['latitude'];
                $longitude = $arr['longitude'];
            }
        }

        $sellers = $this->getSellerByDistance($latitude, $longitude);
        $products = $this->getProductBySellers( $distanceform, $sellers);

//        showresult($products);
    }

    public function postProcess()
    {
        //var_dump($_POST);
        //AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4
        if (isset($_POST["retrieve"]) && $_POST["retrieve"] == "collection") {
            $this->collectionSearch($_POST);
        }
    }
}
