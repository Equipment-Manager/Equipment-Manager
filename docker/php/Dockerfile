FROM php:7.4.9-fpm-alpine

ARG COMPOSER_VERSION
ENV COMPOSER_HOME=/application/.composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=${COMPOSER_VERSION} --install-dir=/usr/local/bin --filename=composer 

RUN apk add --no-cache zip libzip-dev libpng-dev git

RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath zip gd 
RUN docker-php-ext-configure zip
