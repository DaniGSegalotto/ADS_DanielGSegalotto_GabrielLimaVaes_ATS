<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteLoginController extends Controller
{
    /**
     * Exibe o formulário de login do cliente.
     */
    public function showLoginForm()
    {
        return view('auth.login_cliente');
    }

    /**
     * Processa o login do cliente.
     */
    public function login(Request $request)
    {
        // ✅ Validação dos campos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // ✅ Tentativa de autenticação no guard "cliente"
        if (Auth::guard('cliente')->attempt($credentials, $request->filled('remember'))) {
            // Regenera a sessão por segurança
            $request->session()->regenerate();

            // Armazena tipo de usuário para middlewares
            session(['tipo_usuario' => 'cliente']);

            // ✅ Redireciona direto para o painel do cliente
            return redirect()->route('cliente.home')->with('success', 'Login realizado com sucesso!');
        }

        // ❌ Se falhar, retorna mensagem de erro
        return back()
            ->withErrors(['email' => 'Credenciais inválidas.'])
            ->withInput($request->only('email'));
    }

    /**
     * Faz logout do cliente.
     */
    public function logout(Request $request)
    {
        Auth::guard('cliente')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout realizado com sucesso!');
    }
}
