FROM php:8.2-apache

# Instalar extensão mysqli
RUN docker-php-ext-install mysqli

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar arquivos
COPY . /var/www/html/

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html

# Configurar porta
ENV PORT=3000
EXPOSE 3000

# Comando para iniciar
CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && apache2-foreground
