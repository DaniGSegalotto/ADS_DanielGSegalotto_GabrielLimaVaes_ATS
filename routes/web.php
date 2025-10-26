<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\AgendamentoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

// 🔹 Página inicial
Route::get('/', function () {
    return view('welcome');
});

// 🔹 Página principal do sistema (ATS)
Route::get('/ATS', function () {
    return view('ATS');
})->middleware(['auth', 'verified'])->name('ATS');

// 🔹 Rotas de perfil do usuário (protegidas por login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔹 CRUDs principais do sistema
Route::resource('clientes', ClienteController::class);
Route::resource('funcionarios', FuncionarioController::class);
Route::resource('marcas', MarcaController::class);
Route::resource('veiculos', VeiculoController::class);
Route::resource('agendamentos', AgendamentoController::class);

// 🔹 Rota do Chatbot
Route::post('/chat', function (Request $request) {
    $message = $request->input('message');

    try {
        // Envia a mensagem do usuário ao n8n (que roda no Docker)
        $response = Http::post('http://host.docker.internal:5678/webhook/laravel', [
            'message' => $message,
        ]);



        // Retorna a resposta do n8n ao front-end
        return response()->json([
            'reply' => $response->json()['reply'] ?? 'Desculpe, não entendi.'
        ]);
    } catch (\Exception $e) {
        // Caso o servidor n8n não esteja ativo
        return response()->json([
            'reply' => 'Ops! O servidor do assistente está indisponível no momento.'
        ]);
    }
});

// 🔹 Rotas de autenticação padrão (login, registro etc)
require __DIR__ . '/auth.php';
