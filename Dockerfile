FROM php:8.2-apache

# Instalar extensão mysqli
RUN docker-php-ext-install mysqli

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar arquivos
COPY . /var/www/html/

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html

# Script para ajustar a porta do Apache
RUN echo '#!/bin/bash\n\
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf\n\
apache2-foreground' > /usr/local/bin/docker-php-entrypoint \
    && chmod +x /usr/local/bin/docker-php-entrypoint

# Porta padrão (será sobrescrita pelo Railway)
ENV PORT=80
EXPOSE 80
