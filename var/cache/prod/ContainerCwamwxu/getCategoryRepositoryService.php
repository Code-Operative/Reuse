<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'PrestaShop\Module\PsAccounts\Repository\CategoryRepository' shared service.

return $this->services['PrestaShop\\Module\\PsAccounts\\Repository\\CategoryRepository'] = new \PrestaShop\Module\PsAccounts\Repository\CategoryRepository(${($_ = isset($this->services['ps_accounts.db']) ? $this->services['ps_accounts.db'] : $this->load('getPsAccounts_DbService.php')) && false ?: '_'}, ${($_ = isset($this->services['ps_accounts.context']) ? $this->services['ps_accounts.context'] : $this->load('getPsAccounts_ContextService.php')) && false ?: '_'});
