<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Autenticação
Route::get('/login', [AppController::class, 'login'])->name('login');
Route::post('/auth', [AppController::class, 'auth'])->name('login.auth');
Route::get('/logout', [AppController::class, 'logout'])->name('logout');

Route::redirect('/', '/dashboard');

Route::prefix('/dashboard')->middleware('auth')->group(function(){
    Route::get('/', [AppController::class, 'dashboard'])->name('dashboard.index');
    Route::get('/cadastrar', [AppController::class, 'cadastrar'])->name('dashboard.cadastrar'); // Novo cadastro
    Route::post('/cadastrar', [AppController::class, 'cadastrar'])->name('dashboard.cadastrar'); // Novo cadastro

    Route::get('/cadastro/{id?}', [AppController::class, 'cadastro'])->where(['id' => '[0-9]+'])->name('dashboard.cadastro'); // Cadastro existente
    Route::post('/cadastro/{id?}', [AppController::class, 'cadastro'])->where(['id' => '[0-9]+'])->name('dashboard.cadastro'); // Cadastro existente

    Route::post('/cadastro/atualizar/{id?}', [AppController::class, 'cadastroAtualizar'])->where(['id' => '[0-9]+'])->name('dashboard.cadastro_atualizar'); // Atualizar cadastro
    Route::get('/cadastro/atualizar/{id?}', [AppController::class, 'cadastroAtualizar'])->where(['id' => '[0-9]+'])->name('dashboard.cadastro_atualizar'); // Atualizar cadastro

    Route::get('/cadastro/excluir/{id?}', [AppController::class, 'cadastroExcluir'])->where(['id' => '[0-9]+'])->name('dashboard.cadastro_excluir'); // Excluir cadastro 
    
    
    Route::post('/cadastrar/teste', [AppController::class, 'cadastrarTeste'])->name('dashboard.cadastrar_teste'); // Novo cadastro
    
    
    
    
    
    Route::get('/teste', [AppController::class, 'teste'])->name('dashboard.testes'); // Rota para testes

});

Route::prefix('/api/v1')->group(function(){
    Route::get('/{id}', [ApiController::class, 'index'])->name('api.index');
});
