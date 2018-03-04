FROM php:7.1-apache

COPY ./ /var/www/bogans
WORKDIR /var/www/bogans

RUN a2enmod rewrite

ADD ./apache.conf /etc/apache2/sites-enabled/000-default.conf

RUN docker-php-ext-install pdo pdo_mysql
