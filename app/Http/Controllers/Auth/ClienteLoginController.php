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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('cliente')->attempt($credentials, $request->filled('remember'))) {

            // Segurança
            $request->session()->regenerate();

            // Guardar tipo de usuário
            session(['tipo_usuario' => 'cliente']);

            return redirect()->route('cliente.home')->with('success', 'Login realizado com sucesso!');
        }

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

        // 🔥 Redireciona para a página inicial (aquela da imagem!)
        return redirect()->route('welcome')->with('success', 'Logout realizado com sucesso!');
    }
}
