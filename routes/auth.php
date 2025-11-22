<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROTAS DE AUTENTICAÇÃO PERSONALIZADAS
|--------------------------------------------------------------------------
| Para evitar conflitos com as rotas padrão do Breeze, deixamos aqui somente
| as rotas necessárias para login e registro que você realmente usa.
|
| ATENÇÃO:
| Removemos rotas que estavam sobrescrevendo seu POST /login.
| Isso eliminou o erro "POST not supported".
|--------------------------------------------------------------------------
*/

// 🔹 ROTAS PARA USUÁRIOS NÃO LOGADOS
Route::middleware('guest')->group(function () {

    // 🔹 Registro (se você quiser manter)
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // 🔹 LOGIN DO FUNCIONÁRIO (TELA)
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // 🔹 LOGIN DO FUNCIONÁRIO (PROCESSAMENTO)
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});


// 🔹 ROTAS PARA USUÁRIOS LOGADOS
Route::middleware('auth')->group(function () {

    // 🔹 LOGOUT
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // 🔹 Removido tudo que envolve:
    // verify-email
    // forgot-password
    // reset-password
    // confirm-password
    // pois você usa telas personalizadas e não precisa disso.
});
