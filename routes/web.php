<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


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
    return view('welcome'); // Tela inicial de acesso
})->name('welcome');

// ----------------------------------------------------------
// 🔸 ROTA INTELIGENTE /ATS
// ----------------------------------------------------------
// Redireciona automaticamente para o painel correto
Route::get('/ATS', function () {
    if (auth('cliente')->check()) {
        // ✅ Cliente autenticado → painel simplificado
        return redirect()->route('cliente.home');
    } elseif (auth('web')->check()) {
        // ✅ Funcionário autenticado → painel completo
        return view('ATS');
    }

    // ❌ Não autenticado → volta à tela inicial
    return redirect()->route('welcome');
})->name('ATS');

// ----------------------------------------------------------
// 🔸 FUNCIONÁRIOS (GUARD: web)
// ----------------------------------------------------------
Route::middleware(['auth:web'])->group(function () {

    // 🔹 Perfil do funcionário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🔹 CRUDs administrativos
    Route::resource('clientes', ClienteController::class);
    Route::resource('funcionarios', FuncionarioController::class);
    Route::resource('marcas', MarcaController::class);
    Route::resource('veiculos', VeiculoController::class);
    Route::resource('agendamentos', AgendamentoController::class);
});

// ----------------------------------------------------------
// 🔸 CHATBOT INTERNO (opcional)
// ----------------------------------------------------------
Route::post('/chat', function (Request $request) {
    $message = $request->input('message');

    try {
        $response = Http::post('http://host.docker.internal:5678/webhook/laravel', [
            'message' => $message,
        ]);

        return response()->json([
            'reply' => $response->json()['reply'] ?? 'Desculpe, não entendi.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'reply' => 'Ops! O servidor do assistente está indisponível no momento.'
        ]);
    }
});

// ----------------------------------------------------------
// 🔸 AUTENTICAÇÃO PADRÃO (FUNCIONÁRIOS)
// ----------------------------------------------------------
require __DIR__ . '/auth.php';

// 🔹 Corrige logout de funcionário (POST)
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ----------------------------------------------------------
// 🔸 CLIENTES (AUTENTICAÇÃO PERSONALIZADA)
// ----------------------------------------------------------

// 🔹 Login / Logout
Route::get('/cliente/login', [ClienteLoginController::class, 'showLoginForm'])->name('cliente.login.form');
Route::post('/cliente/login', [ClienteLoginController::class, 'login'])->name('cliente.login');
Route::post('/cliente/logout', [ClienteLoginController::class, 'logout'])->name('cliente.logout');

// 🔹 Registro de novos clientes
Route::get('/cliente/register', [ClienteRegisterController::class, 'showRegistrationForm'])->name('cliente.register.form');
Route::post('/cliente/register', [ClienteRegisterController::class, 'register'])->name('cliente.register');

// ----------------------------------------------------------
// 🔐 ÁREA AUTENTICADA DO CLIENTE (GUARD: cliente)
// ----------------------------------------------------------
Route::middleware(['auth:cliente', 'cliente.permissao'])->group(function () {

    // 🔹 Página inicial do cliente (painel simplificado)
    Route::get('/cliente/home', [ClientePainelController::class, 'index'])->name('cliente.home');

    // 🔹 Perfil e atualização
    Route::get('/cliente/perfil', [ClientePainelController::class, 'perfil'])->name('cliente.perfil');
    Route::post('/cliente/perfil/update', [ClientePainelController::class, 'update'])->name('cliente.perfil.update');

    // 🔹 Visualização de veículos e agendamento
    Route::get('/cliente/veiculos', [ClientePainelController::class, 'veiculos'])->name('cliente.veiculos');
    Route::get('/cliente/agendamento', [ClientePainelController::class, 'agendamento'])->name('cliente.agendamento');
    Route::post('/cliente/agendamento', [ClientePainelController::class, 'storeAgendamento'])->name('cliente.agendamento.store');
});


