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
        // ✅ Validação dos campos obrigatórios
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'CPF' => 'required|string|max:14|unique:clientes,CPF',
            'CHN' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:clientes,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // ✅ Limpa o CPF (remove pontos e traços)
        $cpfLimpo = preg_replace('/\D/', '', $request->input('CPF'));

        // ✅ Criação segura do cliente
        $cliente = Cliente::create([
            'nome' => $request->input('nome'),
            'telefone' => $request->input('telefone'),
            'CPF' => $cpfLimpo,
            'CHN' => $request->input('CHN'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // ✅ Login automático após o cadastro
        Auth::guard('cliente')->login($cliente);

        // ✅ Redirecionamento para a página principal
        return redirect()->route('ATS')->with('success', 'Conta criada com sucesso!');
    }
}
