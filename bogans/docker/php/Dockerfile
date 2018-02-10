FROM php:7.1-apache

WORKDIR /var/www/bogans

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

RUN curl --silent --show-error https://getcomposer.org/installer | php
