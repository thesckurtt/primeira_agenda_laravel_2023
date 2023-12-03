<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ApiController;

// Autenticação
Route::get('/login', [AppController::class, 'login'])->name('login');
Route::post('/auth', [AppController::class, 'auth'])->name('login.auth');
Route::get('/logout', [AppController::class, 'logout'])->name('logout');

Route::redirect('/', '/dashboard');

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    // Index dashboard --------------------------------------------------------
    Route::get('/', [AppController::class, 'dashboard'])->name('dashboard.index');

    // Rotas para cadastrar novo usuário --------------------------------------------------------
    Route::get('/cadastrar', [AppController::class, 'cadastrar'])->name('dashboard.cadastrar'); // Novo cadastro
    Route::post('/cadastrar', [AppController::class, 'cadastrar'])->name('dashboard.cadastrar'); // Novo cadastro

    // Rotas para recuperar cadastro de usuário --------------------------------------------------------
    Route::get('/cadastro/{id?}', [AppController::class, 'cadastro'])->where(['id' => '[0-9]+'])->name('dashboard.cadastro'); // Cadastro existente
    Route::post('/cadastro/{id?}', [AppController::class, 'cadastro'])->where(['id' => '[0-9]+'])->name('dashboard.cadastro'); // Cadastro existente

    // Rotas para atualizar cadastro --------------------------------------------------------
    Route::post('/cadastro/atualizar/{id?}', [AppController::class, 'cadastroAtualizar'])->where(['id' => '[0-9]+'])->name('dashboard.cadastro_atualizar'); // Atualizar cadastro
    Route::get('/cadastro/atualizar/{id?}', [AppController::class, 'cadastroAtualizar'])->where(['id' => '[0-9]+'])->name('dashboard.cadastro_atualizar'); // Atualizar cadastro

    // Rotas para excluir cadastro --------------------------------------------------------
    Route::get('/cadastro/excluir/{id?}', [AppController::class, 'cadastroExcluir'])->where(['id' => '[0-9]+'])->name('dashboard.cadastro_excluir'); // Excluir cadastro
});

// API de busca de cadastro via telefone
Route::prefix('/api/v1')->group(function () {
    Route::get('/{telefone}', [ApiController::class, 'index'])->name('api.index');
});
