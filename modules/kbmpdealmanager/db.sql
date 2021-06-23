CREATE TABLE IF NOT EXISTS `_PREFIX_kbmp_seller_deal` (
  `id_seller_deal` int(10) unsigned NOT NULL auto_increment,
  `id_seller` int(10) unsigned NOT NULL,
  `deal_type` tinyint(1) unsigned NOT NULL,
  `id_cart_rule` int(10) unsigned DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `id_shop` int(10) unsigned NOT NULL,
  `id_currency` int(10) unsigned NOT NULL,
  `id_country` int(10) unsigned NOT NULL,
  `id_group` int(10) unsigned NOT NULL,
  `from_quantity` mediumint(8) NOT NULL,
  `price` decimal(20,6) DEFAULT NULL,
  `reduction` decimal(20,6) NOT NULL,
  `reduction_tax` tinyint(1) NOT NULL,
  `reduction_type` tinyint(1) NOT NULL,
  `buy_x_qty` int(10) DEFAULT NULL,
  `get_y_qty` int(10) DEFAULT NULL,
  `banner_path` text,
  `active` tinyint(1) NOT NULL,
  `from_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
   PRIMARY KEY (`id_seller_deal`),
   FOREIGN KEY (id_seller) references _PREFIX_kb_mp_seller (id_seller) ON DELETE CASCADE
) ENGINE=ENGINE_TYPE  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `_PREFIX_kbmp_seller_deal_lang` (
  `id_seller_deal` int(10) unsigned NOT NULL,
  `id_lang` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `_PREFIX_kbmp_deal_rule` (
  `id_kbmp_deal_rule` int(10) unsigned NOT NULL auto_increment,
  `id_seller_deal` int(10) unsigned NOT NULL,
  `rule_type` tinyint(1) NOT NULL,
  `value` tinyint(5) NOT NULL,
  PRIMARY KEY (`id_kbmp_deal_rule`),
  FOREIGN KEY (id_seller_deal) references _PREFIX_kbmp_seller_deal (id_seller_deal) ON DELETE CASCADE
) ENGINE=ENGINE_TYPE  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `_PREFIX_kbmp_deal_products` (
  `id_seller_deal` int(10) unsigned NOT NULL,
  `id_specific_price` int(10) unsigned NOT NULL,
  FOREIGN KEY (id_seller_deal) references _PREFIX_kbmp_seller_deal (id_seller_deal) ON DELETE CASCADE,
  FOREIGN KEY (id_specific_price) references _PREFIX_specific_price (id_specific_price) ON DELETE CASCADE
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8;
