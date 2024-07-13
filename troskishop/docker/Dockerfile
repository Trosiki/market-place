FROM php:8.1-apache

# Habilitar los módulos de Apache necesarios
RUN a2enmod rewrite

# Copiar el archivo de configuración de Apache
COPY ./docker/php/apache/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf
