FROM php:7.4.0-fpm-alpine

RUN apk add --no-cache zip libzip-dev libpng-dev
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip gd
RUN docker-php-ext-install mysqli pdo pdo_mysql bcmath \
    && apk --no-cache add git