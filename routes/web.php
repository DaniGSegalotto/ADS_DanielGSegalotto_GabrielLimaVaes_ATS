<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\FuncionarioController; // Importação do controlador FuncionarioController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar as rotas da sua aplicação web. Estas
| rotas são carregadas pelo RouteServiceProvider e todas elas serão
| atribuídas ao grupo de middleware "web". Faça algo incrível!
|
*/

// Rota padrão que retorna a view 'welcome'
Route::get('/', function () {
    return view('welcome');
});

// Rota que retorna a view 'dashboard' requerendo autenticação e verificação de e-mail
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rotas protegidas pelo middleware 'auth'
Route::middleware('auth')->group(function () {
    // Rotas de perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas para o recurso 'clientes', utilizando o controlador 'ClienteController'
Route::resource('clientes', ClienteController::class);

// Rotas para o recurso 'funcionarios', utilizando o controlador 'FuncionarioController'
Route::resource('funcionarios', FuncionarioController::class);

// Rotas para o recurso 'marcas', utilizando o controlador 'MarcaController'
Route::resource('marcas', MarcaController::class);

// Rotas para o recurso 'veiculos', utilizando o controlador 'VeiculoController'
Route::resource('veiculos', VeiculoController::class);

// Inclui as rotas de autenticação do Laravel, como login, registro, recuperação de senha, etc.
require __DIR__.'/auth.php';
