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
RUN docker-php-ext-install pdo_pgsql pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# COPY source code (very important: BEFORE npm install)
COPY . .

# Install JS dependencies
RUN npm ci

# Build assets
RUN npm run build

# Install dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Composer
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


# Configure Apache DocumentRoot to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Run migrations and start Apache
CMD php artisan migrate --force && apache2-foreground