<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store. 
 *
 * @category  PrestaShop Module
 * @author    knowband.com <support@knowband.com>
 * @copyright 2016 knowband
 * @license   see file: LICENSE.txt
 */

class DealTool
{
    const REDUCTION_TYPE_PERCENTAGE = 1;
    const REDUCTION_TYPE_AMOUNT = 2;
    const RUNNING_TYPE_UPCOMING = 1;
    const RUNNING_TYPE_RUNNING = 2;
    const RUNNING_TYPE_EXPIRED = 3;
    const DEAL_TYPE_CATALOG = 1;
    const DEAL_TYPE_CART = 2;
    const DEAL_TYPE_PER_PRODUCT = 3;
    const DEAL_RULE_CATEGORY = 1;
    const DEAL_RULE_MANUFACTURER = 2;
    const DEAL_RULE_PER_PRODUCT = 3;

    public static function getDealTypes()
    {
        $types = array(
            self::DEAL_TYPE_CATALOG => Translate::getModuleTranslation(
                null,
                'Based on Catalog',
                'kbmpdealmanager'
            ),
            self::DEAL_TYPE_CART => Translate::getModuleTranslation(
                null,
                'Based on Coupon Code',
                'kbmpdealmanager'
            ),
            self::DEAL_TYPE_PER_PRODUCT => Translate::getModuleTranslation(
                null,
                'Per Product',
                'kbmpdealmanager'
            )
        );
        return $types;
    }

    public static function getDealType($key)
    {
        $types = self::getDealTypes();
        if (!empty($key) && isset($types[$key])) {
            return array($key => $types[$key]);
        } else {
            return array(
                self::getDefaultDealType() => Translate::getModuleTranslation(
                    null,
                    'Based on Catalog',
                    'kbmpdealmanager'
                )
            );
        }
    }

    public static function getDefaultDealType()
    {
        return self::DEAL_TYPE_CATALOG;
    }

    public static function getRunningTypes()
    {
        $types = array(
            self::RUNNING_TYPE_UPCOMING => Translate::getModuleTranslation(
                null,
                'Coming Soon',
                'kbmpdealmanager'
            ),
            self::RUNNING_TYPE_RUNNING => Translate::getModuleTranslation(null, 'Running', 'kbmpdealmanager'),
            self::RUNNING_TYPE_EXPIRED => Translate::getModuleTranslation(null, 'Expired', 'kbmpdealmanager')
        );
        return $types;
    }

    public static function getRunningType($key)
    {
        $types = self::getRunningTypes();
        if (!empty($key) && isset($types[$key])) {
            return array($key => $types[$key]);
        } else {
            return array(
                self::getDefaultReductionType() => Translate::getModuleTranslation(
                    null,
                    'Percentage',
                    'kbmpdealmanager'
                )
            );
        }
    }

    public static function getRunningStatus($start, $end)
    {
        $start = date('Y-m-d H:i:s', strtotime($start));
        $end = date('Y-m-d H:i:s', strtotime($end));
        $current = date('Y-m-d H:i:s', time());
        if ($current < $start) {
            return Translate::getModuleTranslation(null, 'Coming Soon', 'kbmpdealmanager');
        } elseif ($current >= $start && $current <= $end) {
            return Translate::getModuleTranslation(null, 'Running', 'kbmpdealmanager');
        } elseif ($current > $end) {
            return Translate::getModuleTranslation(null, 'Expired', 'kbmpdealmanager');
        }
    }

    public static function getReductionTypes()
    {
        $types = array(
            self::REDUCTION_TYPE_PERCENTAGE => Translate::getModuleTranslation(
                    null, 'Percentage', 'kbmpdealmanager'
            ),
            self::REDUCTION_TYPE_AMOUNT => Translate::getModuleTranslation(null, 'Fixed Amount', 'kbmpdealmanager')
        );
        return $types;
    }

    public static function getReductionType($key)
    {
        $types = self::getReductionTypes();
        if (!empty($key) && isset($types[$key])) {
            return array($key => $types[$key]);
        } else {
            return array(
                self::getDefaultReductionType() => Translate::getModuleTranslation(
                    null,
                    'Percentage',
                    'kbmpdealmanager'
                )
            );
        }
    }

    public static function getDefaultReductionType()
    {
        return self::REDUCTION_TYPE_PERCENTAGE;
    }

    public static function renderDiscount($data)
    {
        return Tools::ps_round($data['reduction'], _PS_PRICE_COMPUTE_PRECISION_);
    }

    public static function renderReductionType($data)
    {
        $type = self::getReductionType($data['reduction_type']);
        return $type[$data['reduction_type']];
    }

    public static function getCatalogRuleDefaultValues()
    {
        return array(
            'id_shop' => Context::getContext()->shop->id,
            'id_currency' => 0,
            'id_country' => 0,
            'id_group' => 0,
            'from_quantity' => 1,
            'price' => '-1',
            'reduction_tax' => 0,
        );
    }

    public static function getCartRuleDefaultValues()
    {
        $context = Context::getContext();
        return array(
            'id_customer' => 0,
            'quantity' => 10000, //Available Usage
            'quantity_per_user' => 5, //No of times used by same customer
            'priority' => 1,
            'partial_use' => 0,
            'minimum_amount' => 0,
            'minimum_amount_tax' => 0,
            'minimum_amount_currency' => $context->currency->id,
            'minimum_amount_shipping' => 0,
            'country_restriction' => 0,
            'carrier_restriction' => 0,
            'group_restriction' => 0,
            'cart_rule_restriction' => 0,
            'product_restriction' => 1,
            'shop_restriction' => $context->shop->id,
            'free_shipping' => 0,
            'reduction_tax' => 0,
            'reduction_currency' => $context->currency->id,
            'reduction_product' => 0,
            'gift_product' => 0,
            'gift_product_attribute' => 0,
            'highlight' => 0,
        );
    }
}
