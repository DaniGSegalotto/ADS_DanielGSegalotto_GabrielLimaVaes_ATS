<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Exibe o formulário de login.
     * Mostra a tela estilizada correta para funcionário.
     */
    public function create(): View
    {
        // 🔹 Exibe o login estilizado do funcionário
        return view('auth.login_funcionario');
    }

    /**
     * Processa o login tanto de funcionário quanto de cliente.
     */
    public function store(Request $request): RedirectResponse
    {
        // ✅ Validação dos campos
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'tipo' => 'nullable|in:funcionario,cliente', // tipo pode vir da view antiga
        ]);

        $credentials = $request->only('email', 'password');

        // ✅ Define o guard dinamicamente
        $tipo = $request->input('tipo');
        $guard = $tipo === 'cliente' ? 'cliente' : 'web';

        // 🔐 Tenta autenticar no guard correto
        if (Auth::guard($guard)->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // 🔹 Define o tipo de usuário na sessão
            session(['tipo_usuario' => $tipo ?? ($guard === 'cliente' ? 'cliente' : 'funcionario')]);

            // 🔹 Redireciona conforme o perfil
            if ($guard === 'cliente') {
                return redirect()->intended('/cliente/home');
            } else {
                return redirect()->intended('/ATS');
            }
        }

        // ❌ Credenciais inválidas
        throw ValidationException::withMessages([
            'email' => __('As credenciais informadas são inválidas.'),
        ]);
    }

    /**
     * Faz logout do usuário (cliente ou funcionário)
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 🔹 Desloga de ambos os guards
        Auth::guard('web')->logout();
        Auth::guard('cliente')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 🔹 Retorna à página inicial
        return redirect('/');
    }
}
