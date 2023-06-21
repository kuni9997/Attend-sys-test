FROM php:8.1.1-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

RUN apt-get update \
  && apt-get install -y wget git unzip libpq-dev \
  && docker-php-ext-install pdo_mysql\
  && : 'Install Node.js' \
  &&  curl -sL https://deb.nodesource.com/setup_18.x | bash - \
  && apt-get install -y nodejs \
  && : 'Install PHP Extensions' \
  && docker-php-ext-install -j$(nproc) pdo_pgsql 

ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www