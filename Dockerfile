FROM php:8.2-apache

# Instalar extensão mysqli
RUN docker-php-ext-install mysqli

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar arquivos
COPY . /var/www/html/

# Permissões
RUN chown -R www-data:www-data /var/www/html

# Porta
ENV PORT=80
EXPOSE 80

# Iniciar Apache
CMD apache2-foreground
