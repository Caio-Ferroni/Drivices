# 🚀 Drivices - Marketplace de Serviços Profissionais


# Integrantes: Caio Ferroni Vilela; Lucas de França Luz; Arthur Vinicius de Souza Barbosa; João Paulo Santos Nascimento.


## 📋 Descrição do Projeto

**Drivices** é uma plataforma de marketplace moderna desenvolvida com **Laravel 13**, que conecta clientes que precisam de serviços com profissionais qualificados. O sistema oferece um fluxo completo de negócios: desde a solicitação de serviços até o pagamento, avaliações e comunicação em tempo real.

### Objetivo Principal
Criar um ecossistema onde usuários podem:
- **Solicitar serviços** em diversas categorias
- **Oferecer serviços** como profissional
- **Negociar** preços e prazos através de ofertas
- **Pagar** de forma segura
- **Avaliar** profissionais e serviços
- **Comunicar-se** via chat integrado

---

## ⚙️ Requisitos do Sistema

### Dependências Obrigatórias
- **PHP** ^8.3 (PHP 8.3 ou superior)
- **Composer** (gerenciador de pacotes PHP)
- **Node.js** ^18.0 (para compilar frontend)
- **npm** ou **yarn** (para dependências JavaScript)
- **MySQL** 8.0+ OU **SQLite** (banco de dados)

### Ferramentas Recomendadas
- **Git** para versionamento
- **Visual Studio Code** com extensões PHP/Laravel
- **Postman** ou **Insomnia** para testar endpoints

---

## 📦 Tecnologias Utilizadas

### Backend
- **Laravel 13** - Framework PHP moderno
- **Laravel Fortify** - Autenticação e segurança (2FA, verificação de email)
- **Eloquent ORM** - Manipulação de dados
- **Pest** - Framework de testes (PHPUnit)
- **Laravel Pint** - Linter de código

### Frontend
- **Vite** - Bundler moderno
- **Bootstrap** - Framework CSS utilitário
- **Concurrently** - Executar múltiplos processos

### Banco de Dados
- **MySQL** (produção/recomendado)
- **SQLite** (desenvolvimento)

---

## 🚀 Instalação e Configuração

### Passo 1: Clonar/Extrair o Projeto

```bash
# Se for um repositório Git
git clone <seu-repositorio-url>
cd Drivices

# Se for um arquivo compactado
unzip Drivices.zip
cd Drivices
```

### Passo 2: Instalar Dependências do PHP

```bash
composer install
```

Este comando instala todas as dependências PHP listadas no `composer.json`.

### Passo 3: Configurar Variáveis de Ambiente

```bash
# Copiar arquivo de exemplo
cp .env.example .env
```

**Editar o arquivo `.env` com suas configurações:**

```env
APP_NAME=Drivices
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Banco de Dados (MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=drivices
DB_USERNAME=root
DB_PASSWORD=sua_senha_aqui

# Ou para SQLite (desenvolvimento)
# DB_CONNECTION=sqlite
# DB_DATABASE=/caminho/absoluto/para/database.sqlite

# Autenticação
FORTIFY_GUARD=web

# Sessão
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail (opcional para testes)
MAIL_DRIVER=log
```

### Passo 4: Gerar Chave da Aplicação

```bash
php artisan key:generate
```

Isso gera uma chave criptográfica essencial para a aplicação.

### Passo 5: Preparar Banco de Dados

#### Opção A: MySQL (Recomendado para Produção)

1. **Criar o banco de dados:**
```sql
CREATE DATABASE drivices CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. **Executar migrações:**
```bash
php artisan migrate
```

3. **Semear dados iniciais (opcional):**
```bash
php artisan db:seed
```

#### Opção B: SQLite (Desenvolvimento Rápido)

```bash
# O arquivo database.sqlite será criado automaticamente
php artisan migrate
```

### Passo 6: Instalar Dependências do Frontend

```bash
npm install
```

### Passo 7: Compilar Assets

```bash
# Para desenvolvimento (com hot reload)
npm run dev

# Para produção (otimizado)
npm run build
```

### Passo 8: Criar Pastas de Storage

```bash
php artisan storage:link
```

---

## ▶️ Como Iniciar o Projeto

### Opção 1: Script de Setup Automático (Recomendado)

```bash
composer run setup
```

Este script executa automaticamente:
- Instala dependências do Composer
- Copia `.env.example` para `.env`
- Gera chave da aplicação
- Executa migrações do banco
- Instala dependências do npm
- Compila assets frontend

### Opção 2: Iniciar Servidor de Desenvolvimento

**Terminal 1 - Servidor Laravel:**
```bash
php artisan serve
```
Acessa em: `http://localhost:8000`

**Terminal 2 - Compilação Frontend (Vite):**
```bash
npm run dev
```

**Terminal 3 - Fila de Trabalhos (opcional):**
```bash
php artisan queue:listen --tries=1
```

### Opção 3: Usar Concurrently (Todos os Serviços)

```bash
composer run dev
```

Executa simultaneamente:
- Servidor Laravel (`php artisan serve`)
- Fila de trabalhos (`php artisan queue:listen`)
- Vite dev server (`npm run dev`)

---

## 🗄️ Estrutura do Banco de Dados

### Tabelas Principais

| Tabela | Descrição | Campos Principais |
|--------|-----------|-------------------|
| **users** | Usuários da plataforma | id, email, cpf, telefone, tipo_usuario, status, two_factor_secret |
| **professionals** | Perfil profissional | id, user_id, bio, taxa_sucesso, rating_geral |
| **professions** | Profissões disponíveis | id, nome, descricao |
| **professional_profession** | Relacionamento profissional-profissões | professional_id, profession_id |
| **categorias** | Categorias de serviços | id, nome, descricao |
| **pedidos** | Solicitações de serviços | id, user_id, categoria_id, descricao, orcamento, fotos, emergencia, status |
| **ofertas** | Ofertas de profissionais | id, pedido_id, professional_id, custo, prazo, status |
| **servicos** | Serviços em execução | id, pedido_id, professional_id, oferta_id, status_servico, data_inicio |
| **pagamentos** | Pagamentos | id, servico_id, valor, status, metodo |
| **reviews** | Avaliações | id, servico_id, user_id, professional_id, rating, comentario |
| **chats** | Comunicação | id, user_id, professional_id, mensagens_json |
| **portfolios** | Portfólio profissional | id, professional_id, projeto, descricao, imagens |
| **enderecos** | Endereços | id, user_id, cep, rua, numero, complemento, bairro, cidade |
| **verifications** | Verificações profissionais | id, professional_id, documento, status |
| **cupons** | Cupons de desconto | id, codigo, desconto, uso_maximo |
| **denuncias** | Reports de problemas | id, denunciante_id, denunciado_id, motivo, status |
| **relatorios** | Relatórios de serviços | id, servico_id, descricao, fotos |
| **configurations** | Configurações do sistema | id, chave, valor |
| **notifications** | Notificações | id, user_id, titulo, mensagem, lido |

---

## 🔐 Funcionalidades Implementadas

### 1. **Autenticação e Segurança**
- ✅ Registro e login de usuários
- ✅ Verificação de email obrigatória
- ✅ Autenticação de dois fatores (2FA)
- ✅ Recuperação de senha
- ✅ Tipos de usuário: Cliente e Profissional

### 2. **Gerenciamento de Perfil**
- ✅ CRUD completo de usuários
- ✅ Perfil profissional com bio e rating
- ✅ Gerenciamento de profissões (múltiplas profissões por profissional)
- ✅ Portfólio com projetos e imagens
- ✅ Endereços cadastrados
- ✅ Verificação de documentos profissionais

### 3. **Solicitação de Serviços**
- ✅ Criar pedidos com descrição, fotos e orçamento
- ✅ Marcar como emergência
- ✅ Selecionar categoria do serviço
- ✅ Listar e filtrar pedidos
- ✅ Editar e excluir pedidos próprios
- ✅ Status: Aberto, Aguardando, Aceito, Cancelado

### 4. **Sistema de Ofertas**
- ✅ Profissionais podem fazer ofertas em pedidos
- ✅ Especificar custo e prazo
- ✅ Aceitar/Rejeitar ofertas
- ✅ Status: Pendente, Aceita, Rejeitada, Cancelada
- ✅ Histórico de ofertas

### 5. **Execução de Serviços**
- ✅ Iniciar serviço após aceitar oferta
- ✅ Acompanhamento de status
- ✅ Finalizar serviço
- ✅ Status: Em Execução, Concluído, Cancelado

### 6. **Relatórios**
- ✅ Profissionais podem enviar relatórios de serviços
- ✅ Fotos e descrição do trabalho realizado
- ✅ Anexar evidências do serviço

---

## 🛣️ Rotas Principais

### Rotas de Autenticação (Laravel Fortify)
```
POST   /register               - Registrar novo usuário
POST   /login                  - Fazer login
POST   /logout                 - Fazer logout
POST   /forgot-password        - Recuperar senha
POST   /reset-password         - Resetar senha
```

### Rotas de Usuários
```
GET    /users                  - Listar todos os usuários
POST   /users                  - Criar novo usuário
GET    /users/{id}             - Ver detalhes do usuário
PUT    /users/{id}             - Atualizar usuário
DELETE /users/{id}             - Excluir usuário
```

### Rotas de Profissionais
```
GET    /professionals          - Listar profissionais
POST   /professionals          - Criar profissional
GET    /professionals/{id}     - Ver perfil profissional
PUT    /professionals/{id}     - Atualizar perfil
DELETE /professionals/{id}     - Excluir conta profissional
```

### Rotas de Pedidos
```
GET    /pedidos                - Listar pedidos
POST   /pedidos                - Criar novo pedido
GET    /pedidos/{id}           - Ver detalhes do pedido
PUT    /pedidos/{id}           - Atualizar pedido
DELETE /pedidos/{id}           - Excluir pedido
```

### Rotas de Ofertas
```
GET    /pedidos/{pedido}/ofertas         - Listar ofertas de um pedido
POST   /pedidos/{pedido}/ofertas         - Criar oferta
GET    /ofertas/{id}                     - Ver oferta
PUT    /ofertas/{id}                     - Atualizar oferta
DELETE /ofertas/{id}                     - Excluir oferta
POST   /ofertas/{id}/aceitar             - Aceitar oferta
```

### Rotas de Serviços
```
GET    /servicos               - Listar serviços
POST   /servicos               - Criar serviço
GET    /servicos/{id}          - Ver serviço
PUT    /servicos/{id}          - Atualizar serviço
DELETE /servicos/{id}          - Excluir serviço
GET    /servicos/{id}/concluir - Finalizar serviço
```

### Rotas de Relatórios
```
GET    /relatorios             - Listar todos os relatórios
GET    /servicos/{servico}/relatorios    - Relatórios de um serviço
POST   /servicos/{servico}/relatorios    - Criar relatório
GET    /relatorios/{id}        - Ver relatório
PUT    /relatorios/{id}        - Atualizar relatório
DELETE /relatorios/{id}        - Excluir relatório
```

### Rotas de Endereços
```
GET    /enderecos              - Listar endereços
POST   /enderecos              - Criar endereço
GET    /enderecos/{id}         - Ver endereço
PUT    /enderecos/{id}         - Atualizar endereço
DELETE /enderecos/{id}         - Excluir endereço
```

### Rotas de Visualização
```
GET    /                       - Home page
GET    /home                   - Dashboard
GET    /area-segura            - Área segura (requer autenticação)
GET    /verificacao-email      - Página de verificação
GET    /codigo                 - Challenge de 2FA
```

---

## 📁 Estrutura do Projeto

```
drivices/
├── app/
│   ├── Actions/               # Ações do Fortify
│   ├── Http/
│   │   ├── Controllers/       # Controllers principais
│   │   └── Requests/          # Form requests de validação
│   ├── Models/                # Modelos Eloquent
│   │   ├── User.php
│   │   ├── Professional.php
│   │   ├── Pedido.php
│   │   ├── Oferta.php
│   │   ├── Servico.php
│   │   ├── Review.php
│   │   ├── Chat.php
│   │   ├── Pagamento.php
│   │   └── ... (18 modelos total)
│   ├── Policies/              # Políticas de autorização
│   └── Providers/             # Service providers
├── bootstrap/                 # Bootstrap da aplicação
├── config/                    # Arquivos de configuração
│   ├── app.php
│   ├── database.php
│   ├── fortify.php
│   └── ... (mais configs)
├── database/
│   ├── factories/             # Factories para testes
│   ├── migrations/            # 20 migrations do banco
│   └── seeders/               # Seeders de dados
├── public/                    # Arquivos públicos
│   ├── index.php
│   ├── css/
│   └── js/
├── resources/
│   ├── views/                 # Blade templates
│   ├── css/                   # Estilos Tailwind
│   └── js/                    # JavaScript da aplicação
├── routes/
│   ├── web.php                # Rotas web principais
│   └── console.php            # Comandos de console
├── storage/                   # Armazenamento (logs, cache)
├── tests/                     # Testes automatizados (Pest)
├── vendor/                    # Dependências Composer
├── .env.example               # Exemplo de variáveis
├── artisan                    # CLI do Laravel
├── composer.json              # Dependências PHP
├── package.json               # Dependências Node.js
├── vite.config.js             # Config do Vite
└── phpunit.xml                # Config dos testes
```

---

## 🧪 Testes

### Executar Testes
```bash
composer test
```

### Executar Teste Específico
```bash
php artisan test tests/Feature/UserTest.php
```

### Executar com Coverage
```bash
php artisan test --coverage
```

---

## 🐛 Troubleshooting

### Erro: "Class 'PDO' not found"
```bash
# Instalar driver MySQL (PHP)
# Windows: procure pela extensão php_mysql.dll em php.ini
# Linux: sudo apt-get install php-mysql
```

### Erro: "No application encryption key"
```bash
php artisan key:generate
```

### Erro: "SQLSTATE[HY000] [1045] Access denied for user 'root'"
Verificar credenciais do banco em `.env`:
```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=drivices
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

### Erro: "Migrations failed"
```bash
# Verificar status das migrações
php artisan migrate:status

# Rollback e re-executar
php artisan migrate:rollback
php artisan migrate
```

### Permissões de Pasta
```bash
# Linux/Mac
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage bootstrap/cache

# Windows (executar como admin)
icacls "storage" /grant Everyone:F /T
icacls "bootstrap/cache" /grant Everyone:F /T
```

---

## 📚 Modelos de Dados e Relacionamentos

### User (Usuário)
```php
- has many Pedidos
- has many Reviews
- has one Professional
- has many Enderecos
- has many Chats
```

### Professional (Profissional)
```php
- belongs to User
- belongs to many Professions
- has many Ofertas
- has many Servicos
- has one Portfolio
- has many Verifications
- has many Reviews (recebidas)
```

### Pedido (Solicitação)
```php
- belongs to User
- has many Ofertas
- has one Servico
- belongs to Categoria
- has many Relatorios
```

### Oferta
```php
- belongs to Pedido
- belongs to Professional
- has one Servico
```

### Servico (Serviço em Execução)
```php
- belongs to Pedido
- belongs to Professional
- belongs to Oferta
- has one Pagamento
- has one Review
- has many Relatorios
```

---

## 🔧 Comandos Úteis do Artisan

```bash
# Criar um novo migration
php artisan make:migration create_tabela

# Criar um novo model
php artisan make:model Produto

# Criar um novo controller
php artisan make:controller ProdutoController --resource

# Limpar cache
php artisan cache:clear
php artisan config:clear

# Otimizar aplicação
php artisan optimize

# Listar todas as rotas
php artisan route:list

# Modo manutenção
php artisan down
php artisan up

# Gerar model com migration, factory, seeder e controller
php artisan make:model Produto -mfsc
```

---

## 📝 Variáveis de Ambiente Importantes

```env
# Aplicação
APP_NAME=Drivices
APP_ENV=local (ou production)
APP_DEBUG=true (false em produção)
APP_URL=http://localhost:8000

# Banco de Dados
DB_CONNECTION=mysql
DB_DATABASE=drivices
DB_USERNAME=root
DB_PASSWORD=sua_senha

# Autenticação Fortify
FORTIFY_GUARD=web
FORTIFY_PASSWORD_CONFIRMATION_TIMEOUT=1440

# Sessão
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache e Fila
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail (para notificações)
MAIL_MAILER=smtp
MAIL_HOST=seu_smtp
MAIL_PORT=587
MAIL_USERNAME=seu_email
MAIL_PASSWORD=sua_senha
MAIL_ENCRYPTION=tls
```

---

## 🚀 Deploy em Produção

### Checklist
- [ ] Configurar `.env` com dados reais
- [ ] `APP_DEBUG=false` em produção
- [ ] `APP_ENV=production`
- [ ] Usar banco de dados MySQL em produção
- [ ] Configurar SSL/HTTPS
- [ ] Executar migrações: `php artisan migrate --force`
- [ ] Limpar cache: `php artisan optimize`
- [ ] Compilar assets: `npm run build`
- [ ] Configurar cron job para scheduler
- [ ] Configurar fila (queue worker)
- [ ] Backups automáticos

### Deploy Rápido
```bash
git pull origin main
composer install --optimize-autoloader --no-dev
php artisan migrate --force
npm install && npm run build
php artisan optimize
php artisan cache:clear
```

---

## 📞 Ajuda e Documentação

- **Laravel Docs**: https://laravel.com/docs
- **Laravel Fortify**: https://laravel.com/docs/fortify
- **Eloquent ORM**: https://laravel.com/docs/eloquent
- **Migrations**: https://laravel.com/docs/migrations

---

## 📄 Licença

Este projeto é licenciado sob a licença MIT - veja o arquivo LICENSE para detalhes.

---

## ✅ Próximos Passos (Sugestões)

- [ ] Implementar APIs RESTful completas com autenticação JWT
- [ ] Adicionar sistema de reputação com badges
- [ ] Integração com payment gateway (Stripe, PayPal)
- [ ] Notificações em tempo real com WebSockets
- [ ] Mobile app com React Native ou Flutter
- [ ] Dashboard administrativo avançado
- [ ] Sistema de recomendações com IA
- [ ] Integração com Google Maps para geolocalização
- [ ] Sistema de contrato eletrônico
- [ ] Relatórios analíticos avançados

---

**Versão**: 1.0.0  
**Última Atualização**: 11 de Maio de 2026  
**Status**: ✅ Semi-funcional

