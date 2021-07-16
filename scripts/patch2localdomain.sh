#!/bin/bash

export SHOP_DOMAIN=localhost
export SHOP_DOMAINPORT=localhost:250
envsubst < patch-domain.sql.template > patch-domain.sql
mysql -u root -p prestashop -h demo-server-db < patch-domain.sql
