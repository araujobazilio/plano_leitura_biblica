# Plano de Leitura Bíblica

## Descrição
Aplicativo web para acompanhamento de plano de leitura bíblica em PHP e MySQL.

## Requisitos
- PHP 7.4 ou superior
- MySQL
- Servidor web (Apache/Nginx)

## Configuração
1. Clone o repositório
2. Importe o arquivo `database.sql` no MySQL
3. Configure as credenciais no arquivo `config.php`
4. Inicie seu servidor web

## Deploy no Railway

### Passos para Deploy

1. Crie um novo projeto no Railway
2. Conecte seu repositório GitHub
3. Configure as seguintes variáveis de ambiente:
   - `MYSQL_HOST`: Host do banco de dados MySQL
   - `MYSQL_USER`: Usuário do banco de dados
   - `MYSQL_PASSWORD`: Senha do banco de dados
   - `MYSQL_DATABASE`: Nome do banco de dados

### Configurações Importantes

- Utilize PHP 8.1 ou superior
- O Railway usa o arquivo `nixpacks.toml` para configuração
- O `Procfile` define o comando de inicialização do servidor

### Problemas Comuns

- Certifique-se de criar o `config.php` baseado no `config.example.php`
- Verifique as configurações de variáveis de ambiente
- Confirme que o banco de dados está corretamente configurado

### Importação do Banco de Dados

Após o deploy, importe o arquivo `database.sql` no banco de dados MySQL do Railway para configurar as tabelas iniciais.

## Funcionalidades
- Acompanhamento diário de leitura
- Marcação de leituras concluídas
- Visualização de progresso

## Tecnologias
- PHP
- MySQL
- Bootstrap 5
- JavaScript (AJAX)

## Autor
[Seu Nome]
