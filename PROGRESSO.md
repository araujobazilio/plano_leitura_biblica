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

## Próximos Passos
- Testar a inserção dos dados no banco de dados
- Verificar a funcionalidade de marcação de leitura
- Implementar interface de usuário para acompanhamento do progresso

## Observações
- O plano de leitura abrange todos os 365 dias do ano
- Cobre livros do Antigo e Novo Testamento
- Organizado de forma a proporcionar uma leitura abrangente e equilibrada da Bíblia
