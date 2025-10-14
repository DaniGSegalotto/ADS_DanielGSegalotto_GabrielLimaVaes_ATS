<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Exibe a página de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Trata o cadastro.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => [
                'required',
                'confirmed',
                // Senha forte: 8+ / maiúscula / minúscula / número / símbolo
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // NÃO faz login automático
        // Auth::login($user);

        // Vai para a tela de login (welcome) com flash message
        return redirect()
            ->to('/')
            ->with('status', 'Conta criada com sucesso! Faça login para continuar.');
    }
}
