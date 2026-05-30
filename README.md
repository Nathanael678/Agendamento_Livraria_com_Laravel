# 📚 Sistema de Agendamento para Biblioteca

Sistema web para gerenciar reservas de recursos da biblioteca (salas de estudo, computadores, atendimento), desenvolvido com **Laravel 11** e padrão **MVC**.

---

## 🚀 Como instalar e rodar (com XAMPP)

### 1. Criar o banco de dados
- Abra o XAMPP e inicie **Apache** e **MySQL**
- Acesse `http://localhost/phpmyadmin`
- Crie um banco chamado **`biblioteca_db`**

### 2. Instalar as dependências
```bash
composer install
```

### 3. Configurar o ambiente
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Rodar as migrations
```bash
php artisan migrate
```

### 5. Iniciar o servidor
```bash
php artisan serve
```

Acesse em: **http://localhost:8000**

---

## 👤 Criar um usuário Admin

Após se cadastrar normalmente, execute no terminal:

```bash
php artisan tinker
\App\Models\User::where('email', 'seu@email.com')->update(['admin' => true]);
```

---

## 📁 Estrutura MVC

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AgendamentoController.php   ← Lógica de agendamentos
│   │   ├── RecursoController.php       ← CRUD de recursos (admin)
│   │   ├── AdminController.php         ← Painel administrativo
│   │   └── AuthController.php          ← Login/Cadastro/Logout
│   └── Middleware/
│       └── AdminMiddleware.php         ← Proteção das rotas admin
└── Models/
    ├── User.php          ← Usuários
    ├── Recurso.php       ← Recursos da biblioteca
    └── Agendamento.php   ← Agendamentos

database/migrations/
    ├── ..._create_recursos_table.php
    ├── ..._create_agendamentos_table.php
    └── ..._add_admin_to_users_table.php

resources/views/
    ├── layouts/app.blade.php          ← Layout base (navbar, alertas)
    ├── auth/
    │   ├── login.blade.php
    │   └── register.blade.php
    ├── agendamentos/
    │   ├── index.blade.php
    │   └── create.blade.php
    └── admin/
        ├── dashboard.blade.php
        └── recursos/
            ├── index.blade.php
            ├── create.blade.php
            └── edit.blade.php

routes/web.php                         ← Todas as rotas
```

---

## ✅ Funcionalidades

### Usuário comum
- Cadastro e login
- Visualizar recursos disponíveis
- Realizar agendamento com verificação de conflito de horário
- Cancelar seus próprios agendamentos

### Administrador
- Ver todos os agendamentos
- Confirmar ou cancelar qualquer agendamento
- Cadastrar, editar e remover recursos

---

## 🔧 Tecnologias

- PHP 8.2+
- Laravel 11
- MySQL (via XAMPP)
- Bootstrap 5
- Blade Templates
