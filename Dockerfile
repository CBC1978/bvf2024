# Utiliser une image de base PHP 8.2avec FPM
FROM php:8.2-fpm

# Arguments définis dans docker-compose.yml
ARG user
ARG uid

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN apt-get update && apt-get install -y libzip-dev zip \
    && docker-php-ext-install zip

# Installer Composer (gestionnaire de dépendances PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Créer un utilisateur système pour exécuter les commandes Composer et Artisan
RUN useradd -G www-data -u $uid -d /home/$user -m $user \
    && mkdir -p /home/$user/.composer \
    && chown -R $user:$user /home/$user

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www

# Définir l'utilisateur par défaut
USER $user

# Ajouter Composer au PATH (optionnel, car il est déjà dans /usr/local/bin)
ENV PATH="/usr/local/bin:${PATH}"