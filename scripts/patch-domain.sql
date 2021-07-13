UPDATE psrn_configuration SET value='localhost' WHERE name='PS_SHOP_DOMAIN';
UPDATE psrn_configuration SET value='localhost' WHERE name='PS_SHOP_DOMAIN_SSL';
UPDATE psrn_configuration SET value=0 WHERE name='PS_SSL_ENABLED';
UPDATE psrn_configuration SET value=0 WHERE name='PS_SSL_ENABLED_EVERYWHERE';
UPDATE psrn_configuration SET value='localhost' WHERE name='REVERSO_ADDRESS';
UPDATE psrn_shop_url SET domain='localhost:250', domain_ssl='localhost';
