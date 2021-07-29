<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class AdvancedSearch extends Module
{
    const AVAILABLE_HOOKS = [
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


}
