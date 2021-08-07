<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class AdvancedSearch extends Module
{
    const AVAILABLE_HOOKS = [
        'displayTop',
        'actionCustomerAccountUpdate',
        'actionFrontControllerSetMedia',
        'collectionSearch',
        'deliverySearch',
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


    public function getSellersCovered(): array
    {
        $db = \Db::getInstance();

        $request = 'SELECT DISTINCT id_seller FROM' . _DB_PREFIX_ . '_kb_mp_seller_shipping_coverage cv
                    WHERE COALESCE(cv.cp_district,0)=0 AND cv.cp_area="HA"
                    OR  COALESCE(cv.cp_district,0)<>0 AND cv.cp_area="HA" AND cv.cp_district="1"';

        return $db->executeS($request);
    }

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

    public function hookDisplayTop($params)
    {
        $this->context->smarty->assign([
            'regExPostCode' => '[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}',
            'postcodecheck_controller_url' => $this->context->link->getModuleLink('advancedsearch','asearch', ['ajax'=>true]),
        ]);

        return $this->display(__FILE__, 'advancedsearch.tpl');
    }

    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerStylesheet(
            'advancedsearch-style',
            $this->_path.'views/css/advancedsearch.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );

        $this->context->controller->registerJavascript(
            'advancedsearch-javascript',
            $this->_path.'views/js/advancedsearch.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );
    }

    public function hookActionCustomerAccountUpdate($parameters){
        /** @var \Db $db */
        $db = \Db::getInstance();
        $idcustomer = $parameters['customer']->{'id'};
        $request = "UPDATE `psrn_customer` SET lat = NULL , lon = NULL WHERE `id_customer` =  $idcustomer ";

        /** @var bool $result */
        $result = $db->execute($request);
    }

    public function getSellersCoveredDistance($latitude, $longitude): array
    {
        if (!$latitude || !$longitude) {
            return [];
        }

        $db = \Db::getInstance();

        $request = 'SELECT a.id_seller, a.distance
        FROM (SELECT geo.id_seller,
                     (((acos(sin(('.$latitude.' * pi() / 180)) * -- Latitud
                             sin((geo.lat * pi() / 180)) + cos(('.$latitude.' * pi() / 180)) * -- Latitud
                                                           cos((geo.lat * pi() / 180)) *
                                                           cos((( '.$longitude.'- geo.lon) * -- Longitud
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
}
