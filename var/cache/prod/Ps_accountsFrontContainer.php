<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class Ps_accountsFrontContainer extends Container
{
    private $parameters = [];
    private $targetDirs = [];

    public function __construct()
    {
        $this->services = [];
        $this->normalizedIds = [
            'prestashop\\module\\psaccounts\\api\\accountsclient' => 'PrestaShop\\Module\\PsAccounts\\Api\\AccountsClient',
            'prestashop\\module\\psaccounts\\api\\eventbusproxyclient' => 'PrestaShop\\Module\\PsAccounts\\Api\\EventBusProxyClient',
            'prestashop\\module\\psaccounts\\api\\eventbussyncclient' => 'PrestaShop\\Module\\PsAccounts\\Api\\EventBusSyncClient',
            'prestashop\\module\\psaccounts\\decorator\\categorydecorator' => 'PrestaShop\\Module\\PsAccounts\\Decorator\\CategoryDecorator',
            'prestashop\\module\\psaccounts\\decorator\\productdecorator' => 'PrestaShop\\Module\\PsAccounts\\Decorator\\ProductDecorator',
            'prestashop\\module\\psaccounts\\formatter\\arrayformatter' => 'PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter',
            'prestashop\\module\\psaccounts\\formatter\\jsonformatter' => 'PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter',
            'prestashop\\module\\psaccounts\\provider\\cartdataprovider' => 'PrestaShop\\Module\\PsAccounts\\Provider\\CartDataProvider',
            'prestashop\\module\\psaccounts\\provider\\categorydataprovider' => 'PrestaShop\\Module\\PsAccounts\\Provider\\CategoryDataProvider',
            'prestashop\\module\\psaccounts\\provider\\googletaxonomydataprovider' => 'PrestaShop\\Module\\PsAccounts\\Provider\\GoogleTaxonomyDataProvider',
            'prestashop\\module\\psaccounts\\provider\\moduledataprovider' => 'PrestaShop\\Module\\PsAccounts\\Provider\\ModuleDataProvider',
            'prestashop\\module\\psaccounts\\provider\\orderdataprovider' => 'PrestaShop\\Module\\PsAccounts\\Provider\\OrderDataProvider',
            'prestashop\\module\\psaccounts\\provider\\productdataprovider' => 'PrestaShop\\Module\\PsAccounts\\Provider\\ProductDataProvider',
            'prestashop\\module\\psaccounts\\repository\\accountssyncrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\AccountsSyncRepository',
            'prestashop\\module\\psaccounts\\repository\\cartproductrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\CartProductRepository',
            'prestashop\\module\\psaccounts\\repository\\cartrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\CartRepository',
            'prestashop\\module\\psaccounts\\repository\\categoryrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\CategoryRepository',
            'prestashop\\module\\psaccounts\\repository\\configurationrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\ConfigurationRepository',
            'prestashop\\module\\psaccounts\\repository\\currencyrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\CurrencyRepository',
            'prestashop\\module\\psaccounts\\repository\\deletedobjectsrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\DeletedObjectsRepository',
            'prestashop\\module\\psaccounts\\repository\\googletaxonomyrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\GoogleTaxonomyRepository',
            'prestashop\\module\\psaccounts\\repository\\imagerepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\ImageRepository',
            'prestashop\\module\\psaccounts\\repository\\incrementalsyncrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\IncrementalSyncRepository',
            'prestashop\\module\\psaccounts\\repository\\languagerepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository',
            'prestashop\\module\\psaccounts\\repository\\modulerepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\ModuleRepository',
            'prestashop\\module\\psaccounts\\repository\\orderdetailsrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\OrderDetailsRepository',
            'prestashop\\module\\psaccounts\\repository\\orderrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\OrderRepository',
            'prestashop\\module\\psaccounts\\repository\\productrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\ProductRepository',
            'prestashop\\module\\psaccounts\\repository\\serverinformationrepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\ServerInformationRepository',
            'prestashop\\module\\psaccounts\\repository\\shoprepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\ShopRepository',
            'prestashop\\module\\psaccounts\\repository\\themerepository' => 'PrestaShop\\Module\\PsAccounts\\Repository\\ThemeRepository',
            'prestashop\\module\\psaccounts\\service\\apiauthorizationservice' => 'PrestaShop\\Module\\PsAccounts\\Service\\ApiAuthorizationService',
            'prestashop\\module\\psaccounts\\service\\compressionservice' => 'PrestaShop\\Module\\PsAccounts\\Service\\CompressionService',
            'prestashop\\module\\psaccounts\\service\\deletedobjectsservice' => 'PrestaShop\\Module\\PsAccounts\\Service\\DeletedObjectsService',
            'prestashop\\module\\psaccounts\\service\\proxyservice' => 'PrestaShop\\Module\\PsAccounts\\Service\\ProxyService',
            'prestashop\\module\\psaccounts\\service\\synchronizationservice' => 'PrestaShop\\Module\\PsAccounts\\Service\\SynchronizationService',
        ];
        $this->methodMap = [
            'PrestaShop\\Module\\PsAccounts\\Api\\AccountsClient' => 'getAccountsClientService',
            'PrestaShop\\Module\\PsAccounts\\Api\\EventBusProxyClient' => 'getEventBusProxyClientService',
            'PrestaShop\\Module\\PsAccounts\\Api\\EventBusSyncClient' => 'getEventBusSyncClientService',
            'PrestaShop\\Module\\PsAccounts\\Decorator\\CategoryDecorator' => 'getCategoryDecoratorService',
            'PrestaShop\\Module\\PsAccounts\\Decorator\\ProductDecorator' => 'getProductDecoratorService',
            'PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter' => 'getArrayFormatterService',
            'PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter' => 'getJsonFormatterService',
            'PrestaShop\\Module\\PsAccounts\\Provider\\CartDataProvider' => 'getCartDataProviderService',
            'PrestaShop\\Module\\PsAccounts\\Provider\\CategoryDataProvider' => 'getCategoryDataProviderService',
            'PrestaShop\\Module\\PsAccounts\\Provider\\GoogleTaxonomyDataProvider' => 'getGoogleTaxonomyDataProviderService',
            'PrestaShop\\Module\\PsAccounts\\Provider\\ModuleDataProvider' => 'getModuleDataProviderService',
            'PrestaShop\\Module\\PsAccounts\\Provider\\OrderDataProvider' => 'getOrderDataProviderService',
            'PrestaShop\\Module\\PsAccounts\\Provider\\ProductDataProvider' => 'getProductDataProviderService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\AccountsSyncRepository' => 'getAccountsSyncRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\CartProductRepository' => 'getCartProductRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\CartRepository' => 'getCartRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\CategoryRepository' => 'getCategoryRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\ConfigurationRepository' => 'getConfigurationRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\CurrencyRepository' => 'getCurrencyRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\DeletedObjectsRepository' => 'getDeletedObjectsRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\GoogleTaxonomyRepository' => 'getGoogleTaxonomyRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\ImageRepository' => 'getImageRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\IncrementalSyncRepository' => 'getIncrementalSyncRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository' => 'getLanguageRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\ModuleRepository' => 'getModuleRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\OrderDetailsRepository' => 'getOrderDetailsRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\OrderRepository' => 'getOrderRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\ProductRepository' => 'getProductRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\ServerInformationRepository' => 'getServerInformationRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\ShopRepository' => 'getShopRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Repository\\ThemeRepository' => 'getThemeRepositoryService',
            'PrestaShop\\Module\\PsAccounts\\Service\\ApiAuthorizationService' => 'getApiAuthorizationServiceService',
            'PrestaShop\\Module\\PsAccounts\\Service\\CompressionService' => 'getCompressionServiceService',
            'PrestaShop\\Module\\PsAccounts\\Service\\DeletedObjectsService' => 'getDeletedObjectsServiceService',
            'PrestaShop\\Module\\PsAccounts\\Service\\ProxyService' => 'getProxyServiceService',
            'PrestaShop\\Module\\PsAccounts\\Service\\SynchronizationService' => 'getSynchronizationServiceService',
            'ps_accounts.context' => 'getPsAccounts_ContextService',
            'ps_accounts.db' => 'getPsAccounts_DbService',
            'ps_accounts.link' => 'getPsAccounts_LinkService',
        ];
        $this->privates = [
            'PrestaShop\\Module\\PsAccounts\\Api\\AccountsClient' => true,
            'PrestaShop\\Module\\PsAccounts\\Api\\EventBusProxyClient' => true,
            'PrestaShop\\Module\\PsAccounts\\Api\\EventBusSyncClient' => true,
            'PrestaShop\\Module\\PsAccounts\\Decorator\\CategoryDecorator' => true,
            'PrestaShop\\Module\\PsAccounts\\Decorator\\ProductDecorator' => true,
            'PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter' => true,
            'PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\CartDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\CategoryDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\GoogleTaxonomyDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\ModuleDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\OrderDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\ProductDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\AccountsSyncRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\CartProductRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\CartRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\CategoryRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ConfigurationRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\CurrencyRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\DeletedObjectsRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\GoogleTaxonomyRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ImageRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\IncrementalSyncRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ModuleRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\OrderDetailsRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\OrderRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ProductRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ServerInformationRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ShopRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ThemeRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Service\\ApiAuthorizationService' => true,
            'PrestaShop\\Module\\PsAccounts\\Service\\CompressionService' => true,
            'PrestaShop\\Module\\PsAccounts\\Service\\DeletedObjectsService' => true,
            'PrestaShop\\Module\\PsAccounts\\Service\\ProxyService' => true,
            'PrestaShop\\Module\\PsAccounts\\Service\\SynchronizationService' => true,
            'ps_accounts.context' => true,
            'ps_accounts.db' => true,
            'ps_accounts.link' => true,
        ];

        $this->aliases = [];
    }

    public function getRemovedIds()
    {
        return [
            'PrestaShop\\Module\\PsAccounts\\Api\\AccountsClient' => true,
            'PrestaShop\\Module\\PsAccounts\\Api\\EventBusProxyClient' => true,
            'PrestaShop\\Module\\PsAccounts\\Api\\EventBusSyncClient' => true,
            'PrestaShop\\Module\\PsAccounts\\Decorator\\CategoryDecorator' => true,
            'PrestaShop\\Module\\PsAccounts\\Decorator\\ProductDecorator' => true,
            'PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter' => true,
            'PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\CartDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\CategoryDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\GoogleTaxonomyDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\ModuleDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\OrderDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Provider\\ProductDataProvider' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\AccountsSyncRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\CartProductRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\CartRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\CategoryRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ConfigurationRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\CurrencyRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\DeletedObjectsRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\GoogleTaxonomyRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ImageRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\IncrementalSyncRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ModuleRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\OrderDetailsRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\OrderRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ProductRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ServerInformationRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ShopRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Repository\\ThemeRepository' => true,
            'PrestaShop\\Module\\PsAccounts\\Service\\ApiAuthorizationService' => true,
            'PrestaShop\\Module\\PsAccounts\\Service\\CompressionService' => true,
            'PrestaShop\\Module\\PsAccounts\\Service\\DeletedObjectsService' => true,
            'PrestaShop\\Module\\PsAccounts\\Service\\ProxyService' => true,
            'PrestaShop\\Module\\PsAccounts\\Service\\SynchronizationService' => true,
            'Psr\\Container\\ContainerInterface' => true,
            'Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
            'ps_accounts.context' => true,
            'ps_accounts.db' => true,
            'ps_accounts.link' => true,
        ];
    }

    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled()
    {
        return true;
    }

    public function isFrozen()
    {
        @trigger_error(sprintf('The %s() method is deprecated since Symfony 3.3 and will be removed in 4.0. Use the isCompiled() method instead.', __METHOD__), E_USER_DEPRECATED);

        return true;
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Api\AccountsClient' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Api\AccountsClient
     */
    protected function getAccountsClientService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Api\\AccountsClient'] = new \PrestaShop\Module\PsAccounts\Api\AccountsClient(${($_ = isset($this->services['ps_accounts.link']) ? $this->services['ps_accounts.link'] : $this->getPsAccounts_LinkService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Api\EventBusProxyClient' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Api\EventBusProxyClient
     */
    protected function getEventBusProxyClientService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Api\\EventBusProxyClient'] = new \PrestaShop\Module\PsAccounts\Api\EventBusProxyClient(${($_ = isset($this->services['ps_accounts.link']) ? $this->services['ps_accounts.link'] : $this->getPsAccounts_LinkService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Api\EventBusSyncClient' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Api\EventBusSyncClient
     */
    protected function getEventBusSyncClientService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Api\\EventBusSyncClient'] = new \PrestaShop\Module\PsAccounts\Api\EventBusSyncClient(${($_ = isset($this->services['ps_accounts.link']) ? $this->services['ps_accounts.link'] : $this->getPsAccounts_LinkService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Decorator\CategoryDecorator' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Decorator\CategoryDecorator
     */
    protected function getCategoryDecoratorService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Decorator\\CategoryDecorator'] = new \PrestaShop\Module\PsAccounts\Decorator\CategoryDecorator();
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Decorator\ProductDecorator' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Decorator\ProductDecorator
     */
    protected function getProductDecoratorService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Decorator\\ProductDecorator'] = new \PrestaShop\Module\PsAccounts\Decorator\ProductDecorator(${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository'] = new \PrestaShop\Module\PsAccounts\Repository\LanguageRepository())) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ProductRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ProductRepository'] : $this->getProductRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CategoryRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CategoryRepository'] : $this->getCategoryRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\ArrayFormatter())) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Formatter\ArrayFormatter' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Formatter\ArrayFormatter
     */
    protected function getArrayFormatterService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\ArrayFormatter();
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Formatter\JsonFormatter' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Formatter\JsonFormatter
     */
    protected function getJsonFormatterService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\JsonFormatter();
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Provider\CartDataProvider' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Provider\CartDataProvider
     */
    protected function getCartDataProviderService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Provider\\CartDataProvider'] = new \PrestaShop\Module\PsAccounts\Provider\CartDataProvider(${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CartRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CartRepository'] : $this->getCartRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CartProductRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CartProductRepository'] : $this->getCartProductRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\ArrayFormatter())) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Provider\CategoryDataProvider' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Provider\CategoryDataProvider
     */
    protected function getCategoryDataProviderService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Provider\\CategoryDataProvider'] = new \PrestaShop\Module\PsAccounts\Provider\CategoryDataProvider(${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CategoryRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CategoryRepository'] : $this->getCategoryRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Decorator\\CategoryDecorator']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Decorator\\CategoryDecorator'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Decorator\\CategoryDecorator'] = new \PrestaShop\Module\PsAccounts\Decorator\CategoryDecorator())) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\ArrayFormatter())) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Provider\GoogleTaxonomyDataProvider' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Provider\GoogleTaxonomyDataProvider
     */
    protected function getGoogleTaxonomyDataProviderService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Provider\\GoogleTaxonomyDataProvider'] = new \PrestaShop\Module\PsAccounts\Provider\GoogleTaxonomyDataProvider(${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\GoogleTaxonomyRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\GoogleTaxonomyRepository'] : $this->getGoogleTaxonomyRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Provider\ModuleDataProvider' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Provider\ModuleDataProvider
     */
    protected function getModuleDataProviderService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Provider\\ModuleDataProvider'] = new \PrestaShop\Module\PsAccounts\Provider\ModuleDataProvider(${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ModuleRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ModuleRepository'] : $this->getModuleRepositoryService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Provider\OrderDataProvider' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Provider\OrderDataProvider
     */
    protected function getOrderDataProviderService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Provider\\OrderDataProvider'] = new \PrestaShop\Module\PsAccounts\Provider\OrderDataProvider(${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\OrderRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\OrderRepository'] : $this->getOrderRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\OrderDetailsRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\OrderDetailsRepository'] : $this->getOrderDetailsRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\ArrayFormatter())) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Provider\ProductDataProvider' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Provider\ProductDataProvider
     */
    protected function getProductDataProviderService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Provider\\ProductDataProvider'] = new \PrestaShop\Module\PsAccounts\Provider\ProductDataProvider(${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ProductRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ProductRepository'] : $this->getProductRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Decorator\\ProductDecorator']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Decorator\\ProductDecorator'] : $this->getProductDecoratorService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository'] = new \PrestaShop\Module\PsAccounts\Repository\LanguageRepository())) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\ArrayFormatter())) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\AccountsSyncRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\AccountsSyncRepository
     */
    protected function getAccountsSyncRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\AccountsSyncRepository'] = new \PrestaShop\Module\PsAccounts\Repository\AccountsSyncRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\CartProductRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\CartProductRepository
     */
    protected function getCartProductRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CartProductRepository'] = new \PrestaShop\Module\PsAccounts\Repository\CartProductRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\CartRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\CartRepository
     */
    protected function getCartRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CartRepository'] = new \PrestaShop\Module\PsAccounts\Repository\CartRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\CategoryRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\CategoryRepository
     */
    protected function getCategoryRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CategoryRepository'] = new \PrestaShop\Module\PsAccounts\Repository\CategoryRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\ConfigurationRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\ConfigurationRepository
     */
    protected function getConfigurationRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ConfigurationRepository'] = new \PrestaShop\Module\PsAccounts\Repository\ConfigurationRepository();
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\CurrencyRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\CurrencyRepository
     */
    protected function getCurrencyRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CurrencyRepository'] = new \PrestaShop\Module\PsAccounts\Repository\CurrencyRepository();
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\DeletedObjectsRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\DeletedObjectsRepository
     */
    protected function getDeletedObjectsRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\DeletedObjectsRepository'] = new \PrestaShop\Module\PsAccounts\Repository\DeletedObjectsRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\GoogleTaxonomyRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\GoogleTaxonomyRepository
     */
    protected function getGoogleTaxonomyRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\GoogleTaxonomyRepository'] = new \PrestaShop\Module\PsAccounts\Repository\GoogleTaxonomyRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\ImageRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\ImageRepository
     */
    protected function getImageRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ImageRepository'] = new \PrestaShop\Module\PsAccounts\Repository\ImageRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\IncrementalSyncRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\IncrementalSyncRepository
     */
    protected function getIncrementalSyncRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\IncrementalSyncRepository'] = new \PrestaShop\Module\PsAccounts\Repository\IncrementalSyncRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\LanguageRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\LanguageRepository
     */
    protected function getLanguageRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository'] = new \PrestaShop\Module\PsAccounts\Repository\LanguageRepository();
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\ModuleRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\ModuleRepository
     */
    protected function getModuleRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ModuleRepository'] = new \PrestaShop\Module\PsAccounts\Repository\ModuleRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\OrderDetailsRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\OrderDetailsRepository
     */
    protected function getOrderDetailsRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\OrderDetailsRepository'] = new \PrestaShop\Module\PsAccounts\Repository\OrderDetailsRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\OrderRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\OrderRepository
     */
    protected function getOrderRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\OrderRepository'] = new \PrestaShop\Module\PsAccounts\Repository\OrderRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\ProductRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\ProductRepository
     */
    protected function getProductRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ProductRepository'] = new \PrestaShop\Module\PsAccounts\Repository\ProductRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\ArrayFormatter())) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\ServerInformationRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\ServerInformationRepository
     */
    protected function getServerInformationRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ServerInformationRepository'] = new \PrestaShop\Module\PsAccounts\Repository\ServerInformationRepository(${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CurrencyRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CurrencyRepository'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CurrencyRepository'] = new \PrestaShop\Module\PsAccounts\Repository\CurrencyRepository())) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\LanguageRepository'] = new \PrestaShop\Module\PsAccounts\Repository\LanguageRepository())) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ConfigurationRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ConfigurationRepository'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ConfigurationRepository'] = new \PrestaShop\Module\PsAccounts\Repository\ConfigurationRepository())) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ShopRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ShopRepository'] : $this->getShopRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\ArrayFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\ArrayFormatter())) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\ShopRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\ShopRepository
     */
    protected function getShopRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ShopRepository'] = new \PrestaShop\Module\PsAccounts\Repository\ShopRepository(${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Repository\ThemeRepository' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Repository\ThemeRepository
     */
    protected function getThemeRepositoryService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ThemeRepository'] = new \PrestaShop\Module\PsAccounts\Repository\ThemeRepository(${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->getPsAccounts_DbService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Service\ApiAuthorizationService' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Service\ApiAuthorizationService
     */
    protected function getApiAuthorizationServiceService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Service\\ApiAuthorizationService'] = new \PrestaShop\Module\PsAccounts\Service\ApiAuthorizationService(${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\AccountsSyncRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\AccountsSyncRepository'] : $this->getAccountsSyncRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Api\\EventBusSyncClient']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Api\\EventBusSyncClient'] : $this->getEventBusSyncClientService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Service\CompressionService' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Service\CompressionService
     */
    protected function getCompressionServiceService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Service\\CompressionService'] = new \PrestaShop\Module\PsAccounts\Service\CompressionService(${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\JsonFormatter())) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Service\DeletedObjectsService' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Service\DeletedObjectsService
     */
    protected function getDeletedObjectsServiceService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Service\\DeletedObjectsService'] = new \PrestaShop\Module\PsAccounts\Service\DeletedObjectsService(${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->getPsAccounts_ContextService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\DeletedObjectsRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\DeletedObjectsRepository'] : $this->getDeletedObjectsRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Service\\ProxyService']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Service\\ProxyService'] : $this->getProxyServiceService()) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Service\ProxyService' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Service\ProxyService
     */
    protected function getProxyServiceService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Service\\ProxyService'] = new \PrestaShop\Module\PsAccounts\Service\ProxyService(${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Api\\EventBusProxyClient']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Api\\EventBusProxyClient'] : $this->getEventBusProxyClientService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter'] : ($this->services['PrestaShop\\Module\\PsAccounts\\Formatter\\JsonFormatter'] = new \PrestaShop\Module\PsAccounts\Formatter\JsonFormatter())) && false ?: '_'});
    }

    /**
     * Gets the private 'PrestaShop\Module\PsAccounts\Service\SynchronizationService' shared service.
     *
     * @return \PrestaShop\Module\PsAccounts\Service\SynchronizationService
     */
    protected function getSynchronizationServiceService()
    {
        return $this->services['PrestaShop\\Module\\PsAccounts\\Service\\SynchronizationService'] = new \PrestaShop\Module\PsAccounts\Service\SynchronizationService(${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\AccountsSyncRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\AccountsSyncRepository'] : $this->getAccountsSyncRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Repository\\IncrementalSyncRepository']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\IncrementalSyncRepository'] : $this->getIncrementalSyncRepositoryService()) && false ?: '_'}, ${($_ = isset($this->services['PrestaShop\\Module\\PsAccounts\\Service\\ProxyService']) ? $this->services['PrestaShop\\Module\\PsAccounts\\Service\\ProxyService'] : $this->getProxyServiceService()) && false ?: '_'});
    }

    /**
     * Gets the private 'ps_accounts.context' shared service.
     *
     * @return \Context
     */
    protected function getPsAccounts_ContextService()
    {
        return $this->services['ps_accounts.context'] = \Context::getContext();
    }

    /**
     * Gets the private 'ps_accounts.db' shared service.
     *
     * @return \Db
     */
    protected function getPsAccounts_DbService()
    {
        return $this->services['ps_accounts.db'] = \Db::getInstance();
    }

    /**
     * Gets the private 'ps_accounts.link' shared service.
     *
     * @return \Link
     */
    protected function getPsAccounts_LinkService()
    {
        return $this->services['ps_accounts.link'] = \PrestaShop\Module\PsAccounts\Factory\Link::get();
    }
}
