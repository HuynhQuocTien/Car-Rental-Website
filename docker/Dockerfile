FROM php:8.2-apache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Install necessary PHP extensions
RUN apt-get update && apt-get -y install libzip-dev libicu-dev
RUN docker-php-ext-install mysqli zip intl

# Install Xdebug
RUN pecl install xdebug-3.2.0
RUN docker-php-ext-enable xdebug

RUN apt-get update && apt-get install -y \
    unzip \
    && docker-php-ext-install pdo pdo_mysql


# Copy project files
COPY . /var/www/html

# Copy the composer.json file from the docker folder
COPY composer.json /var/www/html/composer.json

# Cài đặt các dependencies của Composer
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist


# Install PHP dependencies
RUN composer install --working-dir=/var/www/html \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Copy custom PHP configuration
COPY php.ini /usr/local/etc/php/php.ini

# Enable Apache's rewrite module
RUN a2enmod rewrite

EXPOSE 80