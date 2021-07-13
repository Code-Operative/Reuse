#!/bin/bash
include .makerc

DOCKER_WEB = ${PROJECT_NAME}-server-web
DOCKER_DB = ${PROJECT_NAME}-server-db
DOCKER_BE = ${PROJECT_NAME}-server-be
DOCKER_NETWORK = ${PROJECT_NAME}-server-network
OS := $(shell uname)

ifeq ($(OS),Linux)
	UID = $(shell id -u)
else
	UID = 1000
endif

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

run: ## Start the containers
	docker network create ${DOCKER_NETWORK} || true
	U_ID=${UID} docker-compose up -d

stop: ## Stop the containers
	U_ID=${UID} docker-compose stop

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) run

build: ## Rebuilds all the containers
	U_ID=${UID} docker-compose stop && U_ID=${UID} docker-compose build && $(MAKE) run && $(MAKE) prepare

prepare: ## Runs backend commands
	$(MAKE) config-db-user && $(MAKE) create-presta-db && $(MAKE) run-assets

# Backend commands
composer-install: ## Installs composer dependencies
	U_ID=${UID} docker exec --user ${UID} -it ${DOCKER_BE} composer install --no-scripts --no-interaction --optimize-autoloader

migrations: ## Runs the migrations
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bin/console doctrine:migrations:migrate -n

be-logs: ## Tails the Symfony dev log
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} tail -f var/log/dev.log
# End backend commands

ssh-be-root: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user 0 ${DOCKER_BE} bash

ssh-be: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bash

ssh-db-root: ## ssh's into the db container
	U_ID=${UID} docker exec -it --user 0 ${DOCKER_DB} bash

code-style: ## Runs php-cs to fix code styling following Symfony rules
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} php-cs-fixer fix src --rules=@Symfony
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} php-cs-fixer fix tests --rules=@Symfony

generate-ssh-keys: ## Generates SSH keys for the JWT library
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} mkdir -p config/jwt
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} openssl genrsa -passout pass:b4a42db9c2995ae84a9e1fe8aae5b95f -out config/jwt/private.pem -aes256 4096
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} openssl rsa -pubout -passin pass:b4a42db9c2995ae84a9e1fe8aae5b95f -in config/jwt/private.pem -out config/jwt/public.pem

create-presta-db:
     U_ID=${UID} docker exec ${DOCKER_DB} sh -c 'exec mysqldump --all-databases -uroot -p root' < /docker/database/configPrestaDb.sql

config-db-user:
     U_ID=${UID} docker exec ${DOCKER_DB} sh -c 'exec mysqldump --all-databases -uroot -p root' < /docker/database/configUser.sql

install-yarn:
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} yarn install
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} composer install

run-fixtures:
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bin/console doctrine:fixtures:load --group=mapaPolitico
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bin/console doctrine:fixtures:load --group=usuarios
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bin/console doctrine:fixtures:load --group=configuracion
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bin/console doctrine:fixtures:load --group=actividades

run-all-fixtures:
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} bin/console doctrine:fixtures:load

run-assets:
  U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_BE} ./tools/assets/build.sh
# End backend commands

# Server front commands
ssh-web-root: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user 0 ${DOCKER_WEB} bash

ssh-web: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_WEB} bash
# End front commands

# Server db commands
ssh-db-root: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user 0 ${DOCKER_DB} bash
# End db commands