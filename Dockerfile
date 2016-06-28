FROM php:7-apache

RUN a2enmod rewrite

COPY ./apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf