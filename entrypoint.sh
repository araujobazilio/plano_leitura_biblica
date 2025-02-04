#!/bin/bash

# Substituir porta no Apache
sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Verificar variáveis de ambiente
echo "Verificando variáveis de ambiente..."
echo "DB_HOST: ${DB_HOST:-NÃO CONFIGURADO}"
echo "DB_USER: ${DB_USER:-NÃO CONFIGURADO}"
echo "DB_DATABASE: ${DB_DATABASE:-NÃO CONFIGURADO}"

# Iniciar Apache
echo "Iniciando servidor Apache..."
apache2-foreground
