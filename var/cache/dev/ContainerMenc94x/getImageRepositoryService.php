<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'PrestaShop\Module\PsAccounts\Repository\ImageRepository' shared service.

return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\ImageRepository'] = new \PrestaShop\Module\PsAccounts\Repository\ImageRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->load('getPsAccounts_DbService.php')) && false ?: '_'});
