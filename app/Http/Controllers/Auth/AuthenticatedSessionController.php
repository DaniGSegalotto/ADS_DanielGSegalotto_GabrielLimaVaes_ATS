<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Exibe o formulário de login do funcionário.
     */
    public function create(): View
    {
        return view('auth.login_funcionario');
    }

    /**
     * Processa login de funcionário ou cliente.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'tipo' => 'nullable|in:funcionario,cliente',
        ]);

        // define o tipo correto
        $tipo = $request->input('tipo', 'funcionario');

        // escolhe o guard
        $guard = $tipo === 'cliente' ? 'cliente' : 'funcionario';

        $credentials = $request->only('email', 'password');

        // tenta autenticar
        if (Auth::guard($guard)->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            session(['tipo_usuario' => $tipo]);

            // redireciona corretamente
            return $guard === 'cliente'
                ? redirect()->intended('/cliente/home')
                : redirect()->intended('/ATS');
        }

        throw ValidationException::withMessages([
            'email' => __('As credenciais informadas são inválidas.'),
        ]);
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('funcionario')->logout();
        Auth::guard('cliente')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
