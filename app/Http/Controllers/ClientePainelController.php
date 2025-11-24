<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $veiculos = Veiculo::disponiveis()
            ->limit(6)
            ->get();

        return view('cliente.ATS', compact('cliente', 'veiculos'));
    }

    /**
     * Página de perfil
     */
    public function perfil()
    {
        $cliente = Auth::guard('cliente')->user();
        return view('cliente.perfil', compact('cliente'));
    }

    /**
     * Lista de veículos disponíveis
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
        return view('cliente.agendamento', [
            'cliente'      => Auth::guard('cliente')->user(),
            'funcionarios' => Funcionario::orderBy('nome')->get(),
            'veiculos'     => Veiculo::disponiveis()->get(),
        ]);
    }

    /**
     * Salvar agendamento
     */
    public function storeAgendamento(Request $request)
{
    $request->validate([
        'veiculo_id'     => 'required|exists:veiculos,id',
        'data'           => 'required|date|after_or_equal:today',
        'horario'        => 'required',
        'funcionario_id' => 'required|exists:funcionarios,id',
    ]);

    // Verifica conflito veículo + funcionário + data + horário
    $conflito = Agendamento::where('veiculo_id', $request->veiculo_id)
        ->where('funcionario_id', $request->funcionario_id)
        ->where('data', $request->data)
        ->where('horario', $request->horario)
        ->exists();

    if ($conflito) {
        return response()->json([
            'error' => 'Este horário já está reservado para este veículo e funcionário.'
        ], 422);
    }

    // Criar agendamento
    Agendamento::create([
        'cliente_id'     => Auth::guard('cliente')->id(),
        'funcionario_id' => $request->funcionario_id,
        'veiculo_id'     => $request->veiculo_id,
        'data'           => $request->data,
        'horario'        => $request->horario,
    ]);

    return response()->json(['success' => true]);
}


    /**
     * Listar agendamentos do cliente logado
     */
    public function meusAgendamentos()
    {
        $agendamentos = Agendamento::where('cliente_id', Auth::guard('cliente')->id())
            ->with(['veiculo', 'funcionario'])
            ->orderBy('data')
            ->orderBy('horario')
            ->get();

        return view('cliente.meus-agendamentos', compact('agendamentos'));
    }

    /**
     * Atualizar agendamento (via SweetAlert) — DATA, HORÁRIO e FUNCIONÁRIO
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'data'           => 'required|date|after_or_equal:today',
            'horario'        => 'required',
            'funcionario_id' => 'required|exists:funcionarios,id',
        ]);

        $ag = Agendamento::where('id', $id)
            ->where('cliente_id', Auth::guard('cliente')->id())
            ->firstOrFail();

        // Verifica conflito para o mesmo veículo com outro agendamento
        $conflito = Agendamento::where('veiculo_id', $ag->veiculo_id)
            ->where('funcionario_id', $request->funcionario_id)
            ->where('data', $request->data)
            ->where('horario', $request->horario)
            ->where('id', '!=', $id)
            ->exists();

        if ($conflito) {
            return response()->json([
                'error' => 'Já existe outro agendamento para este funcionário neste horário.'
            ], 422);
        }

        // Atualizar
        $ag->update([
            'data'           => $request->data,
            'horario'        => $request->horario,
            'funcionario_id' => $request->funcionario_id,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Excluir agendamento (via SweetAlert)
     */
    public function excluir($id)
    {
        $ag = Agendamento::where('id', $id)
            ->where('cliente_id', Auth::guard('cliente')->id())
            ->firstOrFail();

        $ag->delete();

        return response()->json(['success' => true]);
    }
}
