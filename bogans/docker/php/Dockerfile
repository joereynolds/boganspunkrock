FROM php:7.1-apache

COPY ./ /var/www/bogans
WORKDIR /var/www/bogans

ENV APACHE_DOCUMENT_ROOT /var/www/bogans/web

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

RUN curl --silent --show-error https://getcomposer.org/installer | php
