FROM php:apache
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt-get update -y && apt-get upgrade -y && apt-get install git libssl-dev -y
RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini
RUN sed -ri -e 's!/var/www/html!/var/www/html/src/Infrastructure/Api/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/src/Infrastructure/Api/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite
RUN a2enmod actions