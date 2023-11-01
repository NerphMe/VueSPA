FROM php:8.1.0-fpm-alpine as php-fpm-alpine

WORKDIR /var/www/html

RUN apk update && apk upgrade && \
    apk add --no-cache bash git openssh

RUN apk update && apk add --no-cache \
    build-base shadow vim curl \
    php8-pear \
    php8-dev \
    php8-pdo_mysql \
    php8-mysqli \
    php8-mbstring \
    php8-xml \
    php8-openssl \
    php8-json \
    php8-phar \
    php8-zip \
    php8-gd \
    php8-dom \
    php8-session \
    php8-redis \
    php8-bcmath \
    php8-pcntl \
    php8-zlib

RUN docker-php-ext-install pdo_mysql bcmath pcntl

RUN mkdir -p /usr/src/php/ext/redis; \
	curl -fsSL https://pecl.php.net/get/redis --ipv4 | tar xvz -C "/usr/src/php/ext/redis" --strip 1; \
	docker-php-ext-install redis;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN rm -rf /var/cache/apk/*

RUN usermod -u 1000 www-data

USER root

FROM php-fpm-alpine as php-dev

COPY --chown=www-data:www-data . /var/www/html

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
