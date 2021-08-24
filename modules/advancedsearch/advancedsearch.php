<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

include_once _PS_MODULE_DIR_ . 'advancedsearch/classes/CustomSearchEngine.php';
include_once _PS_MODULE_DIR_ . 'advancedsearch/classes/ApiSearch.php';
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class AdvancedSearch extends Module implements WidgetInterface
{
    const AVAILABLE_HOOKS = [
        'displayTopColumn',
        'actionCustomerAccountAdd',
        'actionCustomerAccountUpdate',
        'actionFrontControllerSetMedia',
        'productSearchProvider',
        'displayProductAdditionalInfo',
    ];

    private $apiSearch;

    public function __construct(ApiSearch $apiSearch)
    {
        $this->name = 'advancedsearch';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Coprinf';
        $this->author_uri = 'https://coprinf.com.ar/';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => '1.7.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Advanced Search Module');
        $this->description = $this->l('Collection and delivery search');
        $this->description_full = $this->l('This module improve the searching add collection and delivery search for UK');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('ADVANCED_SEARCH')) {
            $this->warning = $this->l('No name provided');
        }

        $this->apiSearch = new ApiSearch();
    }

    public function install(): bool
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        include_once _PS_MODULE_DIR_ . 'advancedsearch/sql/install.php';

        return (parent::install() && $this->registerHook(self::AVAILABLE_HOOKS));
    }

    public function uninstall(): bool
    {
        include_once _PS_MODULE_DIR_ . 'advancedsearch/sql/uninstall.php';

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

    public function hookDisplayTopColumn($params)
    {
        $this->context->smarty->assign([
            'regExPostCode' => '[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}',
            'search_controller_url' => $this
                ->context
                ->link
                ->getPageLink('search', null, null, null, false, null, true),
        ]);

        return $this->display(__FILE__, 'advancedsearch.tpl');
    }

    public function hookActionFrontControllerSetMedia():void
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
     * @param $parameters
     */
    public function hookActionCustomerAccountAdd($parameters): void
    {
        $this->hookActionCustomerAccountUpdate($parameters);
    }

    public function hookActionCustomerAccountUpdate($parameters): void
    {
        $postcode = $parameters["customer"]->{'postcode'};

        $url = $this->apiSearch->getURLApiPostcodes($postcode);

        $respApi = $this->apiSearch->getApiGeocoding($url);

        $db = Db::getInstance();
        $idcustomer = $parameters['customer']->{'id'};
        $request = "UPDATE `psrn_customer` SET lat = "
            . $respApi["latitude"] . ", lon = " . $respApi["longitude"] . " WHERE `id_customer` =  $idcustomer ";

        $result = $db->execute($request);
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
            $db = Db::getInstance();

            $request = 'SELECT postcode, lat as latitude, lon as longitude FROM ' . _DB_PREFIX_ . 'customer 
                        WHERE id_customer = ' . $idCustomer;

            $result = $db->executeS($request);
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * @throws PrestaShopDatabaseException
     */
    public function collectionSearch($parameters): array
    {
        $postcode = Tools::getValue('postcode');
        $distanceform = Tools::getValue('distance');
        if (!$this->context->customer->isLogged()) {
            $arr = $this->apiSearch->getLatAndLog($postcode);
            $latitude = $arr['latitude'];
            $longitude = $arr['longitude'];
        } else {
            $customerDirection = $this->getDirectionCustomer();
            if ($customerDirection['postcode'] === $postcode) {
                $latitude = $customerDirection['latitude'];
                $longitude = $customerDirection['longitude'];
            } else {
                $arr = $this->apiSearch->getLatAndLog($postcode);
                $latitude = $arr['latitude'];
                $longitude = $arr['longitude'];
            }
        }

        $sellers = $this->apiSearch->getSellersByDistance($latitude, $longitude, $distanceform);
        return $this->apiSearch->getProductBySellers($sellers);
    }

    /**
     * @throws PrestaShopDatabaseException
     */
    public function deliverySearch($parameters): array
    {
        $postcode = Tools::getValue('postcode');
        $sellers = $this->apiSearch->getSellersCovered($postcode);

        return $this->apiSearch->getProductBySellers($sellers);
    }

    /**
     * @throws PrestaShopDatabaseException
     */
    public function hookProductSearchProvider(array $params): CustomSearchEngine
    {
        $products = [];

        $this->apiSearch->checkSellersPostcodes();

        if (Tools::getValue('retrieve') && Tools::getValue('retrieve') == "collection") {
            $products = $this->collectionSearch($params);
        } elseif (Tools::getValue('retrieve') && Tools::getValue('retrieve') == "delivery") {
            $products = $this->deliverySearch($params);
        }

        $this->apiSearch->setSellersProductsByDistance($products);
        return new CustomSearchEngine($products, Tools::getValue('search'));
    }

    public function renderWidget($hookName, array $configuration)
    {
        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));

        return $this->fetch('module:' . $this->name . '/views/templates/widget/advancedsearch.tpl');
    }

    public function getWidgetVariables($hookName, array $configuration)
    {
        $postcode = Tools::getValue('postcode');

        return [
            'postcode' => $postcode,
            'regExPostCode' => '[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}',
            'search_controller_url' => $this->context->link->getPageLink('search', null, null, null, false, null, true),
        ];
    }

    public function hookDisplayProductAdditionalInfo($params){

        if (Tools::getValue('retrieve') && Tools::getValue('retrieve') == "collection") {
            $products = $this->apiSearch->getSellersProductsByDistance();
            $distance = "";
            foreach ($products as $product){
                foreach ($product as $prod){
                    if($params['product']['id_product'] == $prod['id_product']){
                        $distance = number_format((float)$prod['distance'], 2, '.', '');
                    }
                }
            }
            $this->context->smarty->assign('retrieve' ,"collection only");
            $this->context->smarty->assign('distance' ,$distance);
        } elseif (Tools::getValue('retrieve') && Tools::getValue('retrieve') == "delivery") {
            $this->context->smarty->assign('retrieve' ,"delivery");
        }
        
        return $this->display(__FILE__, 'product-retrieve.tpl');
    }
}
