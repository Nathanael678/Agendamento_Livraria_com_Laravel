<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Página inicial → redireciona para agendamentos ou login
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('agendamentos.index')
        : redirect()->route('login');
});

// ─── Autenticação ──────────────────────────────────────────────
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// ─── Rotas para usuários autenticados ─────────────────────────
Route::middleware(['auth'])->group(function () {

    // Agendamentos do usuário
    Route::resource('agendamentos', AgendamentoController::class)
         ->only(['index', 'create', 'store', 'destroy']);

    // ─── Área Administrativa (apenas admins) ──────────────────
    Route::middleware(['admin'])
         ->prefix('admin')
         ->name('admin.')
         ->group(function () {

        // Painel
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Confirmar / Cancelar agendamentos
        Route::patch('/agendamentos/{agendamento}/confirmar',
            [AdminController::class, 'confirmar'])->name('confirmar');
        Route::patch('/agendamentos/{agendamento}/cancelar',
            [AdminController::class, 'cancelar'])->name('cancelar');

        // CRUD de recursos
        Route::resource('recursos', RecursoController::class)
             ->names('recursos');
    });
});
