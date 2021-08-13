<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

include_once _PS_MODULE_DIR_ . 'advancedsearch/classes/CustomSearchEngine.php';

class AdvancedSearch extends Module
{
    const AVAILABLE_HOOKS = [
        'displayTopColumn',
        'actionCustomerAccountAdd',
        'actionCustomerAccountUpdate',
        'actionFrontControllerSetMedia',
        'productSearchProvider',
    ];


    public function __construct()
    {
        $this->name = 'advancedsearch';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Coprinf';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => '1.7.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Advanced Search Module');
        $this->description = $this->l('Collection and delivery search');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('ADVANCED_SEARCH')) {
            $this->warning = $this->l('No name provided');
        }
    }

    public function install(): bool
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        return (parent::install() && $this->registerHook(self::AVAILABLE_HOOKS));
    }

    public function uninstall(): bool
    {
        return (
            parent::uninstall()
            && Configuration::deleteByName('ADVANCED_SEARCH')
        );
    }

    /**
     * This method handles the module's configuration page
     * @return string The page's HTML content
     */
    public function getContent()
    {
        $output = '';

        if (Tools::isSubmit('submit' . $this->name)) {
            $configValue = (string)Tools::getValue('MYMODULE_CONFIG');

            if (empty($configValue) || !Validate::isGenericName($configValue)) {
                $output = $this->displayError($this->l('Invalid Configuration value'));
            } else {
                Configuration::updateValue('MYMODULE_CONFIG', $configValue);
                $output = $this->displayConfirmation($this->l('Settings updated'));
            }

        }

        return $output . $this->displayForm();
    }

    /**
     * Builds the configuration form
     * @return string HTML code
     */
    public function displayForm()
    {
        // Init Fields form array
        $form = [
            'form' => [
                'legend' => [
                    'title' => $this->l('Settings'),
                ],
                'input' => [
                    [
                        'type' => 'text',
                        'label' => $this->l('Configuration value'),
                        'name' => 'MYMODULE_CONFIG',
                        'size' => 20,
                        'required' => true,
                    ],
                ],
                'submit' => [
                    'title' => $this->l('Save'),
                    'class' => 'btn btn-default pull-right',
                ],
            ],
        ];

        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->table = $this->table;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&' . http_build_query(['configure' => $this->name]);
        $helper->submit_action = 'submit' . $this->name;

        // Default language
        $helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');

        // Load current value into the form
        $helper->fields_value['MYMODULE_CONFIG'] = Tools::getValue('MYMODULE_CONFIG', Configuration::get('MYMODULE_CONFIG'));

        return $helper->generateForm([$form]);
    }


    //queries
    public function getSellersCovered(): array
    {
        $db = \Db::getInstance();

        $request = 'SELECT DISTINCT id_seller FROM' . _DB_PREFIX_ . '_kb_mp_seller_shipping_coverage cv
                    WHERE COALESCE(cv.cp_district,0)=0 AND cv.cp_area="HA"
                    OR  COALESCE(cv.cp_district,0)<>0 AND cv.cp_area="HA" AND cv.cp_district="1"';

        return $db->executeS($request);
    }

    public function hookDisplayTopColumn($params)
    {
        $this->context->smarty->assign([
            'regExPostCode' => '[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}',
            'search_controller_url' => $this->context->link->getPageLink('search', null, null, null, false, null, true),
        ]);

        return $this->display(__FILE__, 'advancedsearch.tpl');
    }


    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerStylesheet(
            'advancedsearch-style',
            $this->_path . 'views/css/advancedsearch.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );

        $this->context->controller->registerJavascript(
            'advancedsearch-javascript',
            $this->_path . 'views/js/advancedsearch.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );
    }

    /**
     * Cuando se modifica
     * @param $parameters
     */
    public function hookActionCustomerAccountAdd($parameters)
    {
        $this->hookActionCustomerAccountUpdate($parameters);
    }

    public function hookActionCustomerAccountUpdate($parameters)
    {
        /** @var \Db $db */
        $db = \Db::getInstance();
        $idcustomer = $parameters['customer']->{'id'};
        //acá modifica el ale
        $request = "UPDATE `psrn_customer` SET lat = NULL , lon = NULL WHERE `id_customer` =  $idcustomer ";

        /** @var bool $result */
        $result = $db->execute($request);
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

        $db = \Db::getInstance();

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
        $db = \Db::getInstance();

        $request = 'SELECT id_product FROM ' . _DB_PREFIX_ . '_kb_mp_seller_product WHERE id_seller =' . $idSeller;
        return $db->executeS($request);
    }

    /**
     * @throws PrestaShopDatabaseException
     */
    public function getProductBySellers($distanceform, $sellers): array
    {
        $product = [];
        foreach ($sellers as $seller) {
//            if ($distanceform <= $seller['distance']) {
            $product[] = $this->getProductBySeller($seller['id_seller']);
//            }
        }

        return $product;
    }

    public function getSellersCoveredDistance($latitude, $longitude): array
    {
        if (!$latitude || !$longitude) {
            return [];
        }

        $db = \Db::getInstance();

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
                          FROM psrn_kb_mp_custom_field_seller_mapping sm
                          WHERE id_field = (SELECT id_field FROM ' . _DB_PREFIX_ . '_kb_mp_custom_fields WHERE field_name = "field_lat")
                             OR id_field = (SELECT id_field FROM ' . _DB_PREFIX_ . '_kb_mp_custom_fields WHERE field_name = "field_lon")) AS sm
                    GROUP BY sm.id_seller) AS geo
              HAVING distance < 10
              UNION
              SELECT DISTINCT id_seller, 0 AS distance
              FROM ' . _DB_PREFIX_ . '_kb_mp_seller_shipping_coverage cv
              WHERE COALESCE(cv.cp_district, 0) = 0 AND cv.cp_area = "HA"
                 OR COALESCE(cv.cp_district, 0) <> 0 AND cv.cp_area = "HA" AND cv.cp_district = "1") AS a
              GROUP BY a.id_seller';
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
     * Return customer address
     * @param $idCustomer
     * @return string
     * @throws PrestaShopDatabaseException
     */
    public function getAddressCustomer($idCustomer): array
    {
        $db = \Db::getInstance();

        $request = 'SELECT address1
                    FROM ' . _DB_PREFIX_ . 'address AS address
                    WHERE address.id_customer = ' . $idCustomer . ';';

        return $db->executeS($request);
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
        $response = json_decode($curl_response);
        if ($response->status !== 200) {
            //TODO handle exception
        } else {
            $decodedresponse = $response->result;
            var_dump($decodedresponse->latitude);
            $arr['latitude'] = $decodedresponse->latitude;
            $arr['longitude'] = $decodedresponse->longitude;
        }

        curl_close($curl);

        return $arr;
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
        //$urlApiBase = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
        $url = 'https://api.postcodes.io/postcodes/' . $postcode;
        //$urlKeyComponent = '&key=' . urlencode($key);
        //$urlCountyComponent = '&components=country:UK';
        //if ($address) {
        //    $url = $urlApiBase . urlencode($address) . $urlCountyComponent . '|postal_code' . $postcode . $urlKeyComponent;
        //} else {
        //    $url = $urlApiBase . urlencode($postcode) . $urlCountyComponent . $urlKeyComponent;
        //}

        return $url;
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
     * Get latitude, longitude and postcode
     * @return array postcode, latitude, longitude
     * @throws PrestaShopDatabaseException
     */
    public function getDirectionCustomer(): array
    {
        if ($this->context->customer->isLogged()) {
            $idCustomer = $this->context->customer->id;
            $db = \Db::getInstance();

            $request = 'SELECT postcode, lat as latitude, lon as longitude FROM ' . _DB_PREFIX_ . 'customer 
                        WHERE id_customer = ' . $idCustomer;

            $result = $db->executeS($request);
        } else {
            $result = '';
        }

        return $result;
    }

    public function collectionSearch($parameters): array
    {

        var_dump(Tools::getValue('search'));
        var_dump(Tools::getValue('distance'));
        var_dump(Tools::getValue('postcode'));
        //die();

        $postcode = Tools::getValue('postcode');
        $distanceform = Tools::getValue('distance');
        //hago comparación postcode parameter con poscode array si son iguales ya tengo lat y long. Sino tengo que calcular
        if (!$this->context->customer->isLogged()) {
            $postcode = $parameters['postcode'];
            $arr = $this->getLatAndLog($postcode, null, null, 'AIzaSyCMJ0V-J2dfE6WYUahTiOf8JP5_zR-ScaI');
            $latitude = $arr['latitude'];
            $longitude = $arr['longitude'];
        } else {
            $customerDirection = $this->getDirectionCustomer();
            if ($customerDirection['postcode'] === $postcode) {
                $latitude = $customerDirection['latitude'];
                $longitude = $customerDirection['longitude'];
            } else {
                $idCustomer = $this->context->customer->id;
                $arr = $this->getLatAndLog($postcode, null, $idCustomer, 'AIzaSyCMJ0V-J2dfE6WYUahTiOf8JP5_zR-ScaI');
                $latitude = $arr['latitude'];
                $longitude = $arr['longitude'];
            }
        }

        $sellers = $this->getSellerByDistance($latitude, $longitude, $distanceform);
        var_dump($sellers);
        $products = $this->getProductBySellers($distanceform, $sellers);
        var_dump($products);

        return $products;
    }

    public function hookProductSearchProvider(array $params)
    {
        if (null != Tools::getValue('retrieve') && Tools::getValue('retrieve') == "collection") {
            $products = $this->collectionSearch($params);
        }

        return new CustomSearchEngine($products);
    }
}
