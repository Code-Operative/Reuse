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


    public function collectionSearch($parameters)
    {

    }

    public function deliverySearch($parameters)
    {

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


}
