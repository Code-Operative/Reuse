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
            $url = $urlApiBase . $urlCountyComponent . $urlKeyComponent;
        }

        return htmlspecialchars($url);
    }

    /**
     * Call to google api geocoding
     * @param $url
     * @return array
     */
    public function getApiGeocoding($url):array
    {
        $arr = [];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $curl_response = curl_exec($curl);

        if($curl_response['status'] !== 'OK'){
            //TODO handle exception
        }else{
            $decodedresponse = json_decode($curl_response, true);
            $arr['latitude'] =  $decodedresponse['response']['lat'];
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

        return  $this->getApiGeocoding($url);
    }

    public function getPostCodeCustomer(): void
    {
//        obtener idCustomer
//
//        $db = \Db::getInstance();

//        $request = '' . $idCustomer . ';';
//        $postcode = $db->executeS($request);

//        return $postcode;
    }
//
//    public function getDirectionCustomer(): array
//    {
//
//    }

    public function collectionSearch($parameters)
    {
//        $postcode = $parameters['postcode'];
//
//        if (!esta logeado){
//        $postcode = $parameters['postcode'];
//    }else{
//        $customerpostcode = getPostCodeCustomer();
//        hago comparación postcode parameter con poscode array si son iguales ya tengo lat y long. Sino tengo que calcular
//    }
//
//        $sellers = getSellerByDistance($latitude, $longitude);
//
//        ... productForm= el producto que escribio en el imput
//         distancia que escribiio en el formulario
//         sellers arreglo de sellers con todas las distancias
//         que hace esta funcion  ?
//        $products = getProductBySellers($productform, $distanceform, $sellers);
//
//        showresult($products);

    }

    public function getProductBySellers($productform, $distanceform, $sellers):array
    {
        $product = [];
//        foreach ($sellers as $seller) {
//            if ($distanceform <= $seller['distance']) {
//                $product[] = getProductBySeller($seller['id_seller'], $productform);
//            }
//        }
//
        return $product;
    }

    public function getProductBySeller($id_seller, $productform):array
    {
        //estudiar un poco mas
        $db = \Db::getInstance();

        $request = '' . _DB_PREFIX_  ;

        return $db->executeS($request);
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

    public function postProcess()
    {
        //var_dump($_POST);
        //AIzaSyAFw8eGYOlrJ8WF7iBvD20syHjdUFCm2B4
        if (isset($_POST["retrieve"]) && $_POST["retrieve"] == "collection") {
            $this->collectionSearch($_POST);
        }
    }
}
