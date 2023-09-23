FROM php:8.0-apache

WORKDIR /var/www/html

COPY src/ .

RUN a2enmod rewrite

EXPOSE 80