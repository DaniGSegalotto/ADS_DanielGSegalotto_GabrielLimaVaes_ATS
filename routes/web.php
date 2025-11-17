<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GeminiChatController;

// 🔹 Controllers principais
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\AgendamentoController;

// 🔹 Controllers de autenticação personalizados
use App\Http\Controllers\Auth\ClienteLoginController;
use App\Http\Controllers\Auth\ClienteRegisterController;
use App\Http\Controllers\ClientePainelController;

/*
|--------------------------------------------------------------------------
| Rotas Web do Sistema
|--------------------------------------------------------------------------
| Estrutura organizada: público, funcionário (guard:web) e cliente (guard:cliente)
*/

// ----------------------------------------------------------
// 🔸 PÚBLICO / PÁGINA INICIAL
// ----------------------------------------------------------
Route::get('/', function () {
    return view('welcome'); // Tela inicial
})->name('welcome');

// ----------------------------------------------------------
// 🔸 ROTA INTELIGENTE /ATS
// ----------------------------------------------------------
// Redireciona para o painel correto com base no tipo de login
Route::get('/ATS', function () {
    if (auth('cliente')->check()) {
        return redirect()->route('cliente.home'); // Painel do cliente
    } elseif (auth('web')->check()) {
        return view('ATS'); // Painel do funcionário
    }
    return redirect()->route('welcome');
})->name('ATS');

// ----------------------------------------------------------
// 🔸 LOGIN PERSONALIZADO PARA FUNCIONÁRIOS
// ----------------------------------------------------------
// Exibe o login estilizado
Route::get('/login', function () {
    return view('auth.login_funcionario'); // Nova tela estilizada
})->name('login');

// Faz login (controlado pelo Fortify padrão)
require __DIR__ . '/auth.php';

// Corrige logout de funcionário (POST)
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('ATS'); 
})->name('logout');


// ----------------------------------------------------------
// 🔸 FUNCIONÁRIOS (GUARD: web)
// ----------------------------------------------------------
Route::middleware(['auth:web'])->group(function () {

    // Perfil do funcionário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUDs administrativos
    Route::resource('clientes', ClienteController::class);
    Route::resource('funcionarios', FuncionarioController::class);
    Route::resource('marcas', MarcaController::class);
    Route::resource('veiculos', VeiculoController::class);
    Route::resource('agendamentos', AgendamentoController::class);
});

// ----------------------------------------------------------
// 🔸 CLIENTES (AUTENTICAÇÃO PERSONALIZADA)
// ----------------------------------------------------------

// Login / Logout
Route::get('/cliente/login', [ClienteLoginController::class, 'showLoginForm'])->name('cliente.login.form');
Route::post('/cliente/login', [ClienteLoginController::class, 'login'])->name('cliente.login');
Route::post('/cliente/logout', [ClienteLoginController::class, 'logout'])->name('cliente.logout');

// Registro
Route::get('/cliente/register', [ClienteRegisterController::class, 'showRegistrationForm'])->name('cliente.register.form');
Route::post('/cliente/register', [ClienteRegisterController::class, 'register'])->name('cliente.register');

// ----------------------------------------------------------
// 🔐 ÁREA AUTENTICADA DO CLIENTE (GUARD: cliente)
// ----------------------------------------------------------
Route::middleware(['auth:cliente', 'cliente.permissao'])->group(function () {

    Route::get('/cliente/home', [ClientePainelController::class, 'index'])->name('cliente.home');
    Route::get('/cliente/perfil', [ClientePainelController::class, 'perfil'])->name('cliente.perfil');
    Route::post('/cliente/perfil/update', [ClientePainelController::class, 'update'])->name('cliente.perfil.update');
    Route::get('/cliente/veiculos', [ClientePainelController::class, 'veiculos'])->name('cliente.veiculos');
    Route::get('/cliente/agendamento', [ClientePainelController::class, 'agendamento'])->name('cliente.agendamento');
    Route::post('/cliente/agendamento', [ClientePainelController::class, 'storeAgendamento'])->name('cliente.agendamento.store');
});

    // 🔹 Rota do Chatbot com IA (OpenAI)
    Route::post('/chat', [GeminiChatController::class, 'sendMessage']);
    Route::get('/chat/reset', [GeminiChatController::class, 'resetConversation']);
