<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /* Exibe uma lista de todos os clientes. */
    public function index()
    {
        // 🔹 Funcionário vê todos; Cliente vê apenas o próprio perfil
        if (session('tipo_usuario') === 'cliente') {
            $cliente = Auth::guard('cliente')->user();
            return view('clientes.show', compact('cliente'));
        }

        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /* Exibe o formulário para criar um novo cliente. */
    public function create()
    {
        // 🔹 Somente funcionários podem criar novos clientes
        if (session('tipo_usuario') === 'cliente') {
            return redirect()->route('ATS')->with('error', 'Acesso negado para clientes.');
        }

        return view('clientes.create');
    }

    /* Armazena um novo cliente no banco de dados. */
    public function store(Request $request)
    {
        // 🔹 Apenas funcionários podem cadastrar clientes
        if (session('tipo_usuario') === 'cliente') {
            return redirect()->route('ATS')->with('error', 'Acesso negado para clientes.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'CPF' => 'required|string|max:11|unique:clientes',
            'CHN' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255|unique:clientes',
        ]);

        $cliente = new Cliente([
            'nome' => $request->input('nome'),
            'telefone' => $request->input('telefone'),
            'CPF' => $request->input('CPF'),
            'CHN' => $request->input('CHN'),
            'email' => $request->input('email'),
        ]);

        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
    }

    /* Exibe o formulário para editar um cliente existente. */
    public function edit(string $id)
    {
        // 🔹 Cliente só pode editar o próprio perfil
        $cliente = Cliente::findOrFail($id);

        if (session('tipo_usuario') === 'cliente' && Auth::guard('cliente')->id() !== $cliente->id) {
            return redirect()->route('ATS')->with('error', 'Você só pode editar seu próprio perfil.');
        }

        return view('clientes.edit', compact('cliente'));
    }

    /* Atualiza um cliente existente no banco de dados. */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        if (session('tipo_usuario') === 'cliente' && Auth::guard('cliente')->id() !== $cliente->id) {
            return redirect()->route('ATS')->with('error', 'Você só pode atualizar seu próprio perfil.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'CPF' => 'required|string|max:11|unique:clientes,CPF,'.$cliente->id,
            'CHN' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255|unique:clientes,email,'.$cliente->id,
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente alterado com sucesso!');
    }

    /* Remove um cliente do banco de dados. */
    public function destroy(string $id)
    {
        // 🔹 Clientes não podem excluir ninguém (nem eles mesmos)
        if (session('tipo_usuario') === 'cliente') {
            return redirect()->route('ATS')->with('error', 'Ação não permitida para clientes.');
        }

        $cliente = Cliente::findOrFail($id);
        $agendamentos = Agendamento::where('cliente_id', $cliente->id)->exists();

        if ($agendamentos) {
            return redirect()->route('clientes.index')->with('error', 'Não é possível excluir o cliente, pois está vinculado a um agendamento.');
        }

        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }

    /* Mostra detalhes de um cliente específico. */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        // 🔹 Cliente só pode ver o próprio perfil
        if (session('tipo_usuario') === 'cliente' && Auth::guard('cliente')->id() !== $cliente->id) {
            return redirect()->route('ATS')->with('error', 'Acesso negado.');
        }

        return view('clientes.show', compact('cliente'));
    }
}
