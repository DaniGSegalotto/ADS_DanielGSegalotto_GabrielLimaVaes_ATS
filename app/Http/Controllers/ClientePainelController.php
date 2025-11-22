<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Veiculo;
use App\Models\Agendamento;
use App\Models\Funcionario;

class ClientePainelController extends Controller
{
    /**
     * Página inicial do cliente
     */
    public function index()
    {
        $cliente = Auth::guard('cliente')->user();

        // Vitrine com veículos disponíveis
        $veiculos = Veiculo::disponiveis()
            ->limit(6)
            ->get();

        return view('cliente.ATS', compact('cliente', 'veiculos'));
    }

    /**
     * Perfil do cliente
     */
    public function perfil()
    {
        $cliente = Auth::guard('cliente')->user();

        return view('cliente.perfil', compact('cliente'));
    }

    /**
     * Atualização de dados do cliente
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
     * Lista de veículos
     */
    public function veiculos()
    {
        $veiculos = Veiculo::disponiveis()->get();

        return view('cliente.veiculos', compact('veiculos'));
    }

    /**
     * Formulário de agendamento
     */
    public function agendamento()
    {
        $cliente = Auth::guard('cliente')->user();

        $funcionarioPadrao = Funcionario::first();

        if (!$funcionarioPadrao) {
            return redirect()
                ->route('cliente.home')
                ->with('error', 'Nenhum funcionário disponível para agendamentos.');
        }

        $veiculos = Veiculo::disponiveis()->get();

        return view('cliente.agendamento', compact(
            'cliente',
            'veiculos',
            'funcionarioPadrao'
        ));
    }

    /**
     * Salva agendamento
     */
    public function storeAgendamento(Request $request)
    {
        $request->validate([
            'veiculo_id'     => 'required|exists:veiculos,id',
            'data_inicio'    => 'required|date|after_or_equal:today',
            'data_fim'       => 'required|date|after_or_equal:data_inicio',
            'funcionario_id' => 'required|exists:funcionarios,id',
        ]);

        Agendamento::create([
            'cliente_id'     => Auth::guard('cliente')->id(),
            'funcionario_id' => $request->funcionario_id,
            'veiculo_id'     => $request->veiculo_id,
            'data_inicio'    => $request->data_inicio,
            'data_fim'       => $request->data_fim,
        ]);

        return redirect()->route('cliente.home')
            ->with('success', 'Agendamento realizado com sucesso!');
    }
}
