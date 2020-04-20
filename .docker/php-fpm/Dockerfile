FROM php:7.4.3-fpm

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY .docker/php-fpm/xdebug-dev.ini /usr/local/etc/php/conf.d/xdebug-dev.ini

COPY . /src/

WORKDIR /src/

RUN chown -R www-data:www-data /src

RUN usermod -u 1000 www-data && \
    groupmod -g 1000 www-data