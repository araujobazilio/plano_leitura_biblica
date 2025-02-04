# Histórico de Desenvolvimento do Plano de Leitura Bíblica

## Preparação para Deploy no Railway - 03/02/2025
- Criado arquivo `composer.json` com as dependências do projeto
- Criado `Procfile` para configuração do servidor web
- Atualizado `config.php` para usar variáveis de ambiente
- Adicionado `.gitignore` para excluir arquivos desnecessários
- Configurado charset UTF-8 para suporte a caracteres especiais

### Variáveis de Ambiente Necessárias no Railway
- `MYSQL_HOST`: Host do banco de dados
- `MYSQL_USER`: Usuário do banco de dados
- `MYSQL_PASSWORD`: Senha do banco de dados
- `MYSQL_DATABASE`: Nome do banco de dados

## Preparação para Deploy no Railway - 03/02/2025

### Configurações de Infraestrutura
- Criado `nixpacks.toml` para configuração do ambiente PHP
- Atualizado `Procfile` para inicialização do servidor web
- Configurado suporte ao PHP 8.1
- Adicionadas instruções detalhadas de deploy no README

### Variáveis de Ambiente
- Configuradas variáveis para conexão com banco de dados MySQL
- Suporte a configurações dinâmicas via `getenv()`
- Removido `config.php` do controle de versão
- Adicionado `config.example.php` como template

### Próximos Passos
- Testar deploy no Railway
- Verificar configurações de banco de dados
- Importar schema do `database.sql`
- Realizar testes de funcionalidade

## Tentativa de Deploy no Railway - Ajustes - 03/02/2025

### Mudanças na Configuração
- Removido `nixpacks.toml`
- Adicionado `railway.json` para configuração de deploy
- Atualizado `Procfile` com comando de inicialização mais específico
- Configuração simplificada para deploy no Railway

### Estratégias de Configuração
- Utilizado arquivo `railway.json` para definir ambiente
- Especificado PHP 8.1 como versão
- Configurado comando de inicialização para rodar a partir do `index.php`

### Próximos Passos
- Verificar configurações de deploy
- Testar conexão com banco de dados
- Validar inicialização do servidor
- Realizar testes de funcionalidade no ambiente de produção

## Configuração para Deploy no Railway - Variáveis de Ambiente

### Mudanças na Configuração de Conexão
- Atualizado `config.example.php` para usar variáveis de ambiente
- Alterados nomes das variáveis para padrão Railway:
  - `DB_HOST`
  - `DB_USER`
  - `DB_PASSWORD`
  - `DB_DATABASE`
- Adicionado tratamento de erros na conexão
- Implementado fallback para configurações locais

### Estratégias de Configuração
- Suporte a ambientes de desenvolvimento e produção
- Variáveis de ambiente com valores padrão
- Tratamento de exceções na conexão com banco de dados
- Log de erros para depuração

### Próximos Passos
- Testar conexão com banco de dados no Railway
- Verificar importação do schema
- Validar funcionamento das variáveis de ambiente
- Realizar testes de integração

## Atualização do Banco de Dados (database.sql)
- Adicionado plano de leitura completo para 365 dias
- Incluídas colunas para dia, passagem, mês, status de leitura e data de leitura
- Cada dia tem uma passagem bíblica específica, organizada por mês

## Atualização do Progresso (progresso.php)
- Implementada visualização detalhada do progresso por mês
- Adicionada barra de progresso para cada mês
- Criada tabela com detalhes de cada dia de leitura
- Incluída funcionalidade de marcação manual de dias lidos
- Removido Bootstrap, adicionado estilo personalizado
- Melhorada a lógica de cálculo de progresso

## Atualização do Layout (progresso.php) - 03/02/2025
- Redesenhada a interface para um visual mais moderno e intuitivo
- Adicionadas seções colapsáveis por mês
- Implementada barra de progresso geral no topo
- Melhorada a visualização do progresso por mês
- Adicionados botões de toggle para marcar/desmarcar leituras
- Implementado destaque automático do mês atual
- Melhorada a responsividade para diferentes tamanhos de tela

### Melhorias Visuais
- Nova paleta de cores usando variáveis CSS
- Barra de progresso mais elegante
- Botões e interações mais modernos
- Layout mais limpo e organizado
- Melhor hierarquia visual das informações

### Funcionalidades Adicionadas
- Toggle para expandir/recolher meses
- Botão para marcar/desmarcar leituras
- Cálculo de progresso em tempo real
- Abertura automática do mês atual
- Feedback visual para ações do usuário

### Novas Funcionalidades
- Visualização do progresso mês a mês
- Botão para marcar dias como lidos manualmente
- Detalhamento de passagens bíblicas por dia

### Próximos Passos
- Adicionar validações de segurança
- Implementar opção de desmarcar leitura
- Criar relatórios mais detalhados
- Implementar sistema de autenticação
- Adicionar estatísticas mais detalhadas
- Criar backup automático do progresso
- Adicionar opção de compartilhamento do progresso
- Implementar notificações diárias

## Atualização de Configuração Railway - 03/02/2025

### Ajustes de Versão PHP
- Atualizado PHP para versão 8.2
- Criado arquivo `railway.toml` para configuração do deploy
- Atualizado `composer.json` com requisitos de versão
- Configurado builder nixpacks para PHP 8.2

### Configurações de Deploy
- Definido comando de inicialização do servidor PHP
- Configurado healthcheck para monitoramento
- Adicionada política de restart em caso de falha
- Especificados pacotes Nix necessários

### Próximos Passos
- Testar deploy com nova configuração
- Verificar logs de erro se necessário
- Confirmar compatibilidade do código com PHP 8.2
- Validar conexão com banco de dados

## Mudança para Dockerfile - 03/02/2025

### Alterações na Configuração
- Criado `Dockerfile` personalizado
- Configurado ambiente PHP 8.2 com Apache
- Removida configuração nixpacks
- Adicionadas extensões necessárias do PHP

### Detalhes da Configuração Docker
- Imagem base: php:8.2-apache
- Instalação da extensão mysqli
- Configuração do Apache para servir a aplicação
- Ajuste de permissões e diretórios

### Próximos Passos
- Testar build do Docker
- Verificar configuração do Apache
- Validar conexão com banco de dados
- Testar deploy no Railway com Docker

## Otimização do Dockerfile - 03/02/2025

### Ajustes na Configuração Docker
- Simplificado Dockerfile para deploy mais direto
- Adicionadas extensões PDO além do mysqli
- Mantida configuração do Apache
- Criado `.dockerignore` para limpar build

### Melhorias Implementadas
- Instalação de extensões PHP adicionais
- Configuração de permissões e módulos do Apache
- Remoção de configurações redundantes
- Preparação para deploy mais limpo

### Próximos Passos
- Verificar build do Docker
- Testar conexão com banco de dados
- Validar funcionamento das URLs
- Realizar testes de deploy no Railway

## Implementação de Healthcheck - 03/02/2025

### Novas Funcionalidades
- Adicionado endpoint `/health.php` para monitoramento
- Implementado healthcheck no Dockerfile
- Configurado timeout e retries apropriados
- Adicionado teste de conexão com banco de dados

### Melhorias no Dockerfile
- Otimizada instalação de dependências
- Adicionado suporte a ZIP
- Configurado PHP.ini de produção
- Ajustada porta dinâmica para Railway
- Melhoradas permissões de arquivos

### Próximos Passos
- Testar endpoint de healthcheck
- Verificar logs do container
- Monitorar tempo de inicialização
- Validar conexão com banco

## Depuração de Deploy - 03/02/2025

### Melhorias no Healthcheck
- Adicionada verificação detalhada de variáveis de ambiente
- Implementado log de erros mais robusto
- Teste de conexão com banco de dados mais completo

### Ajustes no Dockerfile
- Habilitado modo de desenvolvimento do PHP
- Ativados logs de erros detalhados
- Adicionado script de entrypoint para verificações
- Configurada porta 8080 para compatibilidade

### Novo Script de Entrypoint
- Verifica variáveis de ambiente antes do start
- Imprime configurações para facilitar debug
- Substitui dinamicamente a porta do Apache
- Inicializa o servidor com informações de contexto

### Próximos Passos
- Verificar logs de inicialização
- Validar configurações de ambiente
- Testar conexão com banco de dados
- Monitorar processo de deploy

## Simplificação do Deploy - 03/02/2025

### Simplificações Realizadas
- Reduzido Dockerfile ao mínimo necessário
- Removidas configurações complexas
- Simplificado healthcheck
- Removido script de entrypoint

### Configuração Básica
- Apenas extensão mysqli
- Apache com mod_rewrite
- Porta 80 padrão
- Permissões básicas

### Próximos Passos
- Testar deploy com configuração mínima
- Verificar logs de erro
- Adicionar recursos gradualmente se necessário
- Monitorar estabilidade do serviço

## Ajuste de Porta Dinâmica - 03/02/2025

### Correções no Deploy
- Corrigido problema com porta dinâmica no Railway
- Adicionado script de entrypoint para ajuste automático da porta
- Criado `.env.example` para documentação das variáveis
- Mantida compatibilidade com variáveis do Railway

### Detalhes Técnicos
- Script para substituir porta 80 pela variável $PORT
- Uso do docker-php-entrypoint para configuração dinâmica
- Documentação das variáveis de ambiente necessárias
- Configuração do host MySQL interno do Railway

### Próximos Passos
- Testar deploy com nova configuração de porta
- Verificar logs do Apache
- Confirmar conexão com banco de dados
- Validar funcionamento da aplicação

## Nova Configuração de Deploy - 03/02/2025

### Alterações no Dockerfile
- Simplificado processo de inicialização
- Configurada porta 3000 como padrão
- Removido entrypoint customizado
- Comando direto para ajuste de porta

### Configuração Railway
- Atualizado railway.toml para usar Dockerfile
- Configurada política de restart
- Removida configuração nixpacks
- Ajustado número máximo de tentativas

### Próximos Passos
- Testar novo deploy
- Verificar logs de inicialização
- Monitorar política de restart
- Validar configuração de porta

## Configuração de Arquivo de Conexão - 04/02/2025

### Correção de Configuração
- Criado `config.php` a partir do `config.example.php`
- Adicionado `config.php` ao `.gitignore`
- Garantida segurança de credenciais
- Mantido exemplo de configuração no repositório

### Detalhes da Configuração
- Arquivo de configuração copiado para o ambiente de deploy
- Variáveis de ambiente mantidas no Railway
- Ignorado rastreamento de `config.php`

### Próximos Passos
- Verificar conexão com banco de dados
- Testar funcionalidades principais
- Validar configurações de ambiente
- Monitorar logs de inicialização

## Ajustes de Configuração - 04/02/2025

### Melhorias no Deploy
- Adicionada criação automática do config.php no Dockerfile
- Ajustadas permissões do arquivo de configuração
- Melhorada mensagem de erro de conexão
- Configurado log de erros mais detalhado

### Configurações do Banco
- Ajustado nome padrão do banco para 'railway'
- Adicionado fallback para variáveis de ambiente
- Melhorado tratamento de erros de conexão
- Configurado charset UTF-8 por padrão

### Próximos Passos
- Verificar logs de erro no Railway
- Testar conexão com banco de dados
- Validar criação do config.php
- Monitorar mensagens de erro

## Simplificação da Configuração - 04/02/2025

### Mudanças na Estrutura
- Removida dependência do arquivo config.php
- Integrada configuração diretamente no index.php
- Simplificado processo de deploy
- Mantidas variáveis de ambiente

### Benefícios
- Menos arquivos para gerenciar
- Configuração mais direta
- Sem problemas com .gitignore
- Mantida segurança das credenciais

### Próximos Passos
- Testar conexão com banco
- Verificar funcionamento da aplicação
- Monitorar logs de erro
- Validar variáveis de ambiente

## Ajustes de Conexão MySQL - 04/02/2025

### Correções de Conexão
- Atualizada variável DB_HOST para usar RAILWAY_TCP_PROXY_DOMAIN
- Adicionado código de debug para rastrear problemas
- Melhorado tratamento de erros de conexão
- Habilitada exibição detalhada de erros

### Variáveis de Ambiente
- DB_HOST = ${{RAILWAY_TCP_PROXY_DOMAIN}}
- DB_USER = root
- DB_PASSWORD = (senha gerada pelo Railway)
- DB_DATABASE = railway

### Próximos Passos
- Configurar variáveis no Railway
- Verificar logs de conexão
- Testar conexão com banco
- Remover código de debug após sucesso

## Próximos Passos
- Testar a inserção dos dados no banco de dados
- Verificar a funcionalidade de marcação de leitura
- Implementar interface de usuário para acompanhamento do progresso

## Observações
- O plano de leitura abrange todos os 365 dias do ano
- Cobre livros do Antigo e Novo Testamento
- Organizado de forma a proporcionar uma leitura abrangente e equilibrada da Bíblia
