# PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache modules
RUN a2enmod rewrite ssl headers

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Create SSL directory
RUN mkdir -p /etc/apache2/ssl

# Apache HTTP configuration (redirect to HTTPS)
RUN echo '<VirtualHost *:80>\n\
    ServerName golosa-edinstva.ru\n\
    ServerAlias www.golosa-edinstva.ru\n\
    RewriteEngine On\n\
    RewriteCond %{HTTPS} off\n\
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Apache HTTPS configuration
RUN echo '<VirtualHost *:443>\n\
    ServerName golosa-edinstva.ru\n\
    ServerAlias www.golosa-edinstva.ru\n\
    DocumentRoot /var/www/html/public\n\
    \n\
    SSLEngine on\n\
    SSLCertificateFile /etc/apache2/ssl/golosa-edinstva.ru.crt\n\
    SSLCertificateKeyFile /etc/apache2/ssl/golosa-edinstva.ru.key\n\
    \n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    \n\
    # Security headers\n\
    Header always set X-Content-Type-Options "nosniff"\n\
    Header always set X-Frame-Options "SAMEORIGIN"\n\
    Header always set X-XSS-Protection "1; mode=block"\n\
</VirtualHost>' > /etc/apache2/sites-available/default-ssl.conf

# Enable SSL site
RUN a2ensite default-ssl

# Expose ports
EXPOSE 80 443

# Start Apache
CMD ["apache2-foreground"]
