<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'ps_checkout.persistent.configuration' shared service.

return $this->services['ps_checkout.persistent.configuration'] = new \PrestaShop\Module\PrestashopCheckout\PersistentConfiguration(${($_ = isset($this->services['ps_checkout.configuration']) ? $this->services['ps_checkout.configuration'] : $this->load('getPsCheckout_ConfigurationService.php')) && false ?: '_'});
