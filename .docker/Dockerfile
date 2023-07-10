FROM php:8.0-fpm

# Instala as dependências do PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Copia os arquivos do seu projeto para a pasta /var/www/html no contêiner
COPY . /var/www/html

# Define a propriedade correta dos arquivos e diretórios do projeto
RUN chown -R www-data:www-data /var/www/html

# Variáveis de ambiente para a conexão com o PostgreSQL
ENV POSTGRES_HOST=db
ENV POSTGRES_PORT=5432
ENV POSTGRES_DB=teste
ENV POSTGRES_USER=root
ENV POSTGRES_PASSWORD=root
