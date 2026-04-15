FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl


#esto lo necesito para mongo db
# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libssl-dev \
    pkg-config \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb
############################################
# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario igual al host (CLAVE 🔥)
ARG UID=1000
RUN usermod -u ${UID} www-data

# Definir directorio de trabajo
WORKDIR /var/www

# Crear script de entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh



# Copiar archivos del proyecto
#COPY . .

# Instalar dependencias de Laravel
#RUN composer install

# Permisos (importante para storage y cache)
#RUN chown -R www-data:www-data /var/www \
#    && chmod -R 775 /var/www/storage

EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]