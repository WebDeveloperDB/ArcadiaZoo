# Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache

# Activer les modules Apache nécessaires
RUN a2enmod rewrite

# Installer les extensions PHP pour PostgreSQL
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get install -y libssl-dev pkg-config \
    && apt-get install -y zip unzip libzip-dev \
    && docker-php-ext-install zip \
    && apt-get install -y libicu-dev \
    && docker-php-ext-install intl

# Installation de l'extension MongoDB
RUN pecl install mongodb && \
    docker-php-ext-enable mongodb

# Copier tout le contenu du dossier backend dans le conteneur
COPY ./ /var/www/html

WORKDIR /var/www/html

# Exposer le port 80 pour Apache
EXPOSE 80


