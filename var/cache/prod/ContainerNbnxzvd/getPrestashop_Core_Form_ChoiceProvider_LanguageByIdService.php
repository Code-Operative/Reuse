<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'prestashop.core.form.choice_provider.language_by_id' shared service.

return $this->services['prestashop.core.form.choice_provider.language_by_id'] = new \PrestaShop\PrestaShop\Core\Form\ChoiceProvider\LanguageByIdChoiceProvider(${($_ = isset($this->services['prestashop.adapter.data_provider.language']) ? $this->services['prestashop.adapter.data_provider.language'] : ($this->services['prestashop.adapter.data_provider.language'] = new \PrestaShop\PrestaShop\Adapter\Language\LanguageDataProvider())) && false ?: '_'});
