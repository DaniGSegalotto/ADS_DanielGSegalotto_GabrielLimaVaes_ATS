<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Veiculo;
use App\Models\Agendamento;

class ClientePainelController extends Controller
{
    /**
     * Página inicial (painel principal)
     */
    public function index()
    {
        $cliente = Auth::guard('cliente')->user();
        return view('cliente.ATS', compact('cliente'));
    }

    /**
     * Página de perfil do cliente
     */
    public function perfil()
    {
        $cliente = Auth::guard('cliente')->user();
        return view('cliente.perfil', compact('cliente'));
    }

    /**
     * Atualiza dados do cliente (nome, telefone, senha)
     */
    public function update(Request $request)
    {
        $cliente = Auth::guard('cliente')->user();

        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $cliente->nome = $request->nome;
        $cliente->telefone = $request->telefone;

        if ($request->filled('password')) {
            $cliente->password = Hash::make($request->password);
        }

        $cliente->save();

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }

    /**
     * Exibe lista de veículos disponíveis
     */
    public function veiculos()
    {
        $veiculos = Veiculo::all();
        return view('cliente.veiculos', compact('veiculos'));
    }

    /**
     * Formulário de agendamento
     */
    public function agendamento()
    {
        $veiculos = Veiculo::all();
        return view('cliente.agendamento', compact('veiculos'));
    }

    /**
     * Salva novo agendamento
     */
    public function storeAgendamento(Request $request)
    {
        $request->validate([
            'veiculo_id' => 'required|exists:veiculos,id',
            'data_inicio' => 'required|date|after_or_equal:today',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);

        Agendamento::create([
            'cliente_id' => Auth::guard('cliente')->id(),
            'veiculo_id' => $request->veiculo_id,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
        ]);

        return redirect()->route('cliente.home')->with('success', 'Agendamento realizado com sucesso!');
    }
}
