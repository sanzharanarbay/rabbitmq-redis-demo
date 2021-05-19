FROM php:7.4-fpm

COPY ./composer.lock ./composer.json /var/www/html/testApp/

# Set working directory
WORKDIR /var/www/html/testApp

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpq-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Install Redis extension
RUN pecl install -o -f redis && rm -rf /tmp/pear && docker-php-ext-enable redis

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

# Change current user to www
USER www

#RUN chown -R www-data:www-data /var/www/docker-app

#RUN chmod -R 755 /var/www/docker-app

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
