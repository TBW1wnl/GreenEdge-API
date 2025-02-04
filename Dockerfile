# Utiliser l'image PHP 8.2 avec PHP-FPM
FROM php:8.2-fpm

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Installer les paquets nécessaires
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libzip-dev zip libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Installer les outils nécessaires
RUN apt-get update && apt-get install -y curl

# Télécharger Symfony CLI de manière générique, et rendre exécutable
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony \
    && chmod +x /usr/local/bin/symfony


# Assure-toi que le dossier var/ existe avant de modifier ses permissions
RUN mkdir -p /var/www/html/var \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/var

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html

# Mettre les bonnes permissions pour Symfony
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/var

# Exposer le port PHP-FPM
EXPOSE 9000

# Démarrer PHP-FPM
CMD ["php-fpm"]
