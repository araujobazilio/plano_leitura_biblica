FROM php:8.2-apache

# Instalar dependências e extensões
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

# Configurar PHP
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Configurar Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

# Copiar arquivos do projeto
COPY . /var/www/html/

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configurar porta
ENV PORT=80
EXPOSE 80

# Configurar healthcheck
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:${PORT}/health.php || exit 1

# Iniciar Apache
CMD sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && apache2-foreground
