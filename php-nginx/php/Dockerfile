FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
    sudo \
    zip \
    unzip \
    vim \
    git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && /usr/local/bin/docker-php-ext-install gd mysqli \
    && /usr/local/bin/docker-php-ext-install pdo pdo_mysql \
    && /usr/local/bin/docker-php-ext-install -j5 gd mbstring mysqli pdo pdo_mysql shmop