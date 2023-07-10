FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

ENV POSTGRES_HOST=db
ENV POSTGRES_PORT=5432
ENV POSTGRES_DB=teste
ENV POSTGRES_USER=root
ENV POSTGRES_PASSWORD=root
