FROM php:7.4-cli

LABEL MAINTAINER="Rami Sfari <rami2sfari@gmail.com>"

COPY ./php/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN apt-get update && apt-get install -y  zlib1g-dev libzip-dev libfreetype6-dev libpng-dev libjpeg-dev \
  libicu-dev libonig-dev libxslt1-dev acl

RUN docker-php-ext-configure gd --with-jpeg --with-freetype 

RUN docker-php-ext-install pdo_mysql zip gd intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -LsS https://get.symfony.com/cli/installer -o /usr/local/bin/symfony && chmod a+x /usr/local/bin/symfony

WORKDIR /var/www/project

# install dependency
COPY . .
RUN composer install

EXPOSE 8000

CMD php bin/console server:run 0.0.0.0:8000
