FROM php:8.2-apache

# Habilitar los módulos de Apache necesarios
RUN a2enmod rewrite

# Copiar el archivo de configuración de Apache
COPY ./docker/php/apache/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf

# Instalar las extensiones necesarias de PHP y otras dependencias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libcurl4-openssl-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install curl

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer permisos correctos para el proyecto
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 para Apache
EXPOSE 80
