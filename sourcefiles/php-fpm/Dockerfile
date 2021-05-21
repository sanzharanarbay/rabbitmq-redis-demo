FROM php:7.4-fpm

# Set working directory
WORKDIR /var/www/html/testApp

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    zip \
    libmagickwand-dev \
    libpng-dev \
    librabbitmq-dev \
    libzip-dev \
    pkg-config \
    ssh-client \
    vim \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pgsql pdo_pgsql mbstring exif pcntl bcmath gd sockets opcache intl

# Install Redis extension
RUN pecl install -o -f redis amqp imagick  && rm -rf /tmp/pear && docker-php-ext-enable amqp imagick redis

# Get latest Composer
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create system user to run Composer and Artisan Commands
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY ./ /var/www/html/testApp

# Copy existing application directory permissions
COPY --chown=www:www ./ /var/www/html/testApp

#RUN chown -R www-data:www-data /var/www/html/testApp && chmod -R 775 /var/www/html/testApp


# Update directory permissions
RUN chown -R www-data:www-data \
    /var/www/html/testApp/storage \
    /var/www/html/testApp/bootstrap/cache \
    && chmod -R 775 /var/www/html/testApp/sourcefiles

# Install Composer Dependencies
#RUN /bin/bash -c "php /usr/local/bin/composer install"
RUN composer install --no-dev --no-interaction -o

# Generate Laravel Key
RUN php artisan key:generate

# Clean Laravel Config
RUN php artisan optimize
#RUN php artisan migrate

# Change current user to www
USER www


# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
