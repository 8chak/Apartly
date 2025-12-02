FROM php:8.2-apache


# Install dependencies
RUN apt-get update && apt-get install -y \
git \
curl \
libzip-dev \
zip \
unzip \
&& docker-php-ext-install pdo pdo_mysql zip

#node modules
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

# Install PostgreSQL PHP extensions
RUN apt-get update && apt-get install -y libpq-dev pkg-config \
    && docker-php-ext-install pdo_pgsql pgsql


# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy app (IMPORTANT: before npm commands)
COPY . /var/www/html
WORKDIR /var/www/html

# Build frontend assets
RUN npm install
RUN npm run build

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache DocumentRoot to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Run migrations and start Apache
CMD php artisan migrate --force && apache2-foreground