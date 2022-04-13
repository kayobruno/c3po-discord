FROM php:8.1.4-fpm-alpine3.15@sha256:3222513e425e8a4cddb2fbcbdf629df157145cb6c24dcf7c99d33b9f5998a7ea

RUN apk add $PHPIZE_DEPS --no-cache openssl mysql-dev bash \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD . /var/www

RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]
