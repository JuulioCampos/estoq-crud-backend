FROM php:8.0-fpm

COPY ./.docker/php/custom-php.ini /usr/local/etc/php/conf.d/custom-php.ini

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

ENV POSTGRES_HOST=db
ENV POSTGRES_PORT=5432
ENV POSTGRES_DB=teste
ENV POSTGRES_USER=postgres
ENV POSTGRES_PASSWORD=root

RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.log=/var/www/html/xdebug/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini
    
CMD ["php-fpm"]
