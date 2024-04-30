# Use an official PHP runtime
FROM php:8.2-apache
# Enable Apache modules
RUN a2enmod rewrite 
# Install any extensions you need
RUN apt-get update \
&& apt-get install -y libicu-dev git zip unzip libzip-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev libmcrypt-dev\
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl mysqli pdo pdo_mysql gd \
&& docker-php-ext-enable mysqli pdo pdo_mysql gd 
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Set the working directory to /var/www/html
WORKDIR /var/www/html
# Copy the source code in /www into the container at /var/www/html
COPY ../www .