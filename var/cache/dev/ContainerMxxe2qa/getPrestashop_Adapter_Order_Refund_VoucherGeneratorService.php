<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'prestashop.adapter.order.refund.voucher_generator' shared service.

return $this->services['prestashop.adapter.order.refund.voucher_generator'] = new \PrestaShop\PrestaShop\Adapter\Order\Refund\VoucherGenerator(${($_ = isset($this->services['prestashop.core.localization.locale.context_locale']) ? $this->services['prestashop.core.localization.locale.context_locale'] : $this->load('getPrestashop_Core_Localization_Locale_ContextLocaleService.php')) && false ?: '_'}, ${($_ = isset($this->services['translator']) ? $this->services['translator'] : $this->getTranslatorService()) && false ?: '_'});
