FROM php4all/php4dev:latest

RUN apk add php-zip \
    zlib \
    zlib-dev \
    libzip \
    libzip-dev \
    php-bcmath \
    php-sockets

RUN docker-php-ext-install \
    zip \
    pdo \
    pdo_mysql \
    sockets \
    bcmath
