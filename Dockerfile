FROM php:8.2-apache

# Instalar extensão mysqli
RUN docker-php-ext-install mysqli

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar arquivos
COPY . /var/www/html/

# Criar config.php a partir do example
RUN cp /var/www/html/config.example.php /var/www/html/config.php

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod 755 /var/www/html/config.php

# Configurar porta
ENV PORT=3000
EXPOSE 3000

# Comando para iniciar
CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && apache2-foreground
