<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClienteRegisterController extends Controller
{
    /**
     * Exibe o formulário de registro do cliente
     */
    public function showRegistrationForm()
    {
        return view('auth.register_cliente');
    }

    /**
     * Processa o registro do cliente e faz login automático
     */
    public function register(Request $request)
    {
        // Validação completa
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'CPF' => 'required|string|max:14|unique:clientes,CPF',
            'CHN' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:clientes,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Limpa o CPF
        $cpfLimpo = preg_replace('/\D/', '', $request->CPF);

        // Cria o cliente
        $cliente = Cliente::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'CPF' => $cpfLimpo,
            'CHN' => $request->CHN,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login automático
        Auth::guard('cliente')->login($cliente);

        // Redireciona ao painel do cliente
return redirect()
    ->route('cliente.login.form')
    ->with('success', 'Conta criada com sucesso! Faça login para continuar.');
    }
}
