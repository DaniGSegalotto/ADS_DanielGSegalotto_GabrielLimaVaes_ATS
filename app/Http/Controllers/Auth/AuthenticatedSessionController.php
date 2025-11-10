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
     * Exibe o formulário de login (único para funcionário e cliente)
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Processa o login (funcionário ou cliente)
     */
    public function store(Request $request): RedirectResponse
    {
        // ✅ Validação básica dos campos
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'tipo' => 'required|in:funcionario,cliente',
        ]);

        $credentials = $request->only('email', 'password');
        $tipo = $request->input('tipo');

        // ✅ Define o guard conforme a escolha do usuário
        $guard = $tipo === 'cliente' ? 'cliente' : 'web';

        if (Auth::guard($guard)->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redireciona para o painel principal (ATS)
            return redirect()->intended(RouteServiceProvider::HOME ?? '/ATS');
        }

        // ❌ Caso as credenciais estejam incorretas
        throw ValidationException::withMessages([
            'email' => __('As credenciais informadas são inválidas.'),
        ]);
    }

    /**
     * Faz logout do usuário (cliente ou funcionário)
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Faz logout em ambos os guards
        Auth::guard('web')->logout();
        Auth::guard('cliente')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
