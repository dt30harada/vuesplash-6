# @see: https://hub.docker.com/_/php
FROM php:7.4-apache

RUN apt-get update \
    && apt-get install -y \
        # libpq-dev \
        unzip
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite

# if you want to check available php-extensions list of this docker image,
# do this command: 'docker run --rm php:7.4-apache docker-php-ext-install'
RUN docker-php-ext-install \
        pdo_mysql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

WORKDIR /var/www/html/
