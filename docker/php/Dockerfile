FROM php:7.4-fpm

ARG UID
EXPOSE $UID

RUN adduser -u ${UID} --disabled-password --gecos "" appuser

#para almacenar claves privadas, para repos privados
RUN mkdir /home/appuser/.ssh
RUN chown -R appuser:appuser /home/appuser/

#no pregunta si queremos añadir conf para repos privados
RUN echo "StrictHostKeyChecking no" >> /home/appuser/.ssh/config
#conf de la console
RUN echo "export COLUMNS=300" >> /home/appuser/.bashrc
#sf ejecuta bin/console.
RUN echo "alias sf=/appdata/www/bin/console" >> /home/appuser/.bashrc

COPY ./php.ini /usr/local/etc/php/php.ini

RUN apt-get update\
    && apt-get install -y git acl openssl openssh-client wget zip vim librabbitmq-dev libssh-dev\
    && apt-get install -y libpng-dev zlib1g-dev libzip-dev libxml2-dev libicu-dev\
    && docker-php-ext-install intl pdo pdo_mysql zip gd soap bcmath sockets\
    && docker-php-ext-enable --ini-name 05-opcache.ini opcache

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer
RUN composer self-update

#linters
RUN wget https://cs.symfony.com/download/php-cs-fixer-v2.phar -O php-cs-fixer
RUN chmod a+x php-cs-fixer
RUN mv php-cs-fixer /usr/local/bin/php-cs-fixer

RUN apt-get update && apt-get install -y gnupg2


RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && apt-get install -y yarn

RUN pecl install xdebug-2.9.6 amqp
RUN docker-php-ext-enable --ini-name 05-opcache.ini opcache amqp xdebug

RUN curl -L https://www.npmjs.com/install.sh | bash -
RUN node --version
RUN npm --version
RUN npm install n -g
RUN n stable


RUN echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_autostart=true" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_mode=req" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port=9005" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_port=9005" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_log=/var/log/xdebug_remote.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_connect_back=Off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# docker nginx ip adress
RUN echo "xdebug.remote_host=172.17.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Prevent error in nginx error.log
RUN touch /var/log/xdebug_remote.log
RUN chmod 777 /var/log/xdebug_remote.log

RUN mkdir -p /appdata/www

#optmiza dependecias de composer
USER appuser

WORKDIR /appdata/www
