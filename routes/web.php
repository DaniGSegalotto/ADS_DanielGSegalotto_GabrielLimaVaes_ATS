<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Controllers principais
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\GeminiChatController;

// Auth
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ClienteLoginController;
use App\Http\Controllers\Auth\ClienteRegisterController;
use App\Http\Controllers\ClientePainelController;
use App\Http\Controllers\Auth\ClienteForgotPasswordController;
use App\Http\Controllers\Auth\ClienteResetPasswordController;


/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


/*
|--------------------------------------------------------------------------
| ATS INTELIGENTE
|--------------------------------------------------------------------------
*/

Route::get('/ATS', function () {

    if (auth('cliente')->check()) {
        return redirect()->route('cliente.home');
    }

    if (auth('funcionario')->check()) {
        return view('ATS');
    }

    return redirect()->route('welcome');

})->name('ATS');


/*
|--------------------------------------------------------------------------
| LOGIN FUNCIONÁRIO
|--------------------------------------------------------------------------
*/

// Tela login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

// Enviar login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store');

// Logout funcionário
Route::post('/logout', function (Request $request) {

    Auth::guard('funcionario')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('ATS');

})->name('logout');


/*
|--------------------------------------------------------------------------
| ÁREA DO FUNCIONÁRIO (Painel ADM)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:funcionario'])->group(function () {

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


/*
|--------------------------------------------------------------------------
| LOGIN CLIENTE
|--------------------------------------------------------------------------
*/

Route::get('/cliente/login', [ClienteLoginController::class, 'showLoginForm'])
    ->name('cliente.login.form');

Route::post('/cliente/login', [ClienteLoginController::class, 'login'])
    ->name('cliente.login');

Route::post('/cliente/logout', [ClienteLoginController::class, 'logout'])
    ->name('cliente.logout');


/*
|--------------------------------------------------------------------------
| REGISTRO CLIENTE
|--------------------------------------------------------------------------
*/

Route::get('/cliente/register', [ClienteRegisterController::class, 'showRegistrationForm'])
    ->name('cliente.register.form');

Route::post('/cliente/register', [ClienteRegisterController::class, 'register'])
    ->name('cliente.register');


/*
|--------------------------------------------------------------------------
| RECUPERAÇÃO DE SENHA CLIENTE
|--------------------------------------------------------------------------
*/

Route::get('/cliente/forgot-password', [ClienteForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('cliente.password.request');

Route::post('/cliente/forgot-password', [ClienteForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('cliente.password.email');

Route::get('/cliente/reset-password/{token}', [ClienteResetPasswordController::class, 'showResetForm'])
    ->name('cliente.password.reset');

Route::post('/cliente/reset-password', [ClienteResetPasswordController::class, 'reset'])
    ->name('cliente.password.update');



/*
|--------------------------------------------------------------------------
| ÁREA DO CLIENTE (Painel do Usuário)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:cliente', 'cliente.permissao'])->group(function () {

    // Home
    Route::get('/cliente/home', [ClientePainelController::class, 'index'])
        ->name('cliente.home');

    // Perfil
    Route::get('/cliente/perfil', [ClientePainelController::class, 'perfil'])
        ->name('cliente.perfil');

    Route::post('/cliente/perfil/update', [ClientePainelController::class, 'update'])
        ->name('cliente.perfil.update');

    // Veículos disponíveis
    Route::get('/cliente/veiculos', [ClientePainelController::class, 'veiculos'])
        ->name('cliente.veiculos');

    // Criar agendamento
    Route::get('/cliente/agendamento', [ClientePainelController::class, 'agendamento'])
        ->name('cliente.agendamento');

    Route::post('/cliente/agendamento', [ClientePainelController::class, 'storeAgendamento'])
        ->name('cliente.agendamento.store');

    // Listar agendamentos do cliente
    Route::get('/cliente/meus-agendamentos', [ClientePainelController::class, 'meusAgendamentos'])
        ->name('cliente.agendamentos');

    /*
    |--------------------------------------------------------------------------
    | UPDATE / DELETE (Modal SweetAlert)
    |--------------------------------------------------------------------------
    */

    Route::put('/cliente/agendamento/{id}', [ClientePainelController::class, 'update'])
        ->name('cliente.agendamento.update');

    Route::delete('/cliente/agendamento/{id}', [ClientePainelController::class, 'excluir'])
        ->name('cliente.agendamento.delete');
});



/*
|--------------------------------------------------------------------------
| CHATBOT
|--------------------------------------------------------------------------
*/

Route::post('/chat', [GeminiChatController::class, 'sendMessage']);
Route::get('/chat/reset', [GeminiChatController::class, 'resetConversation']);
