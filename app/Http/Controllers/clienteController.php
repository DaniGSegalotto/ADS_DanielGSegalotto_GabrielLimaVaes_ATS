<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /* ================================
       LISTAGEM DE CLIENTES + BUSCA
    ================================= */
    public function index(Request $request)
    {
        // Se for cliente logado → redireciona para sua própria página
        if (auth('cliente')->check()) {
            $cliente = auth('cliente')->user();
            return view('clientes.show', compact('cliente'));
        }

        // Busca
        $query = trim($request->input('query'));

        if (!empty($query)) {
            $q = strtolower($query);

            $clientes = Cliente::whereRaw('LOWER(nome) LIKE ?', ["%{$q}%"])
                ->orWhereRaw('LOWER(email) LIKE ?', ["%{$q}%"])
                ->orWhereRaw('LOWER(telefone) LIKE ?', ["%{$q}%"])
                ->orWhereRaw('LOWER("CPF") LIKE ?', ["%{$q}%"])
                ->orWhereRaw('LOWER("CHN") LIKE ?', ["%{$q}%"])
                ->orderBy('nome')
                ->get();
        } else {
            $clientes = Cliente::orderBy('nome')->get();
        }

        return view('clientes.index', compact('clientes'));
    }

    /* ================================
       FORMULÁRIO DE CRIAÇÃO (FUNCIONÁRIO)
    ================================= */
    public function create()
    {
        if (auth('cliente')->check()) {
            return redirect()->route('cliente.home')
                ->with('error', 'Clientes não podem criar outros clientes.');
        }

        return view('clientes.create');
    }

    /* ================================
       ARMAZENAR NOVO CLIENTE
    ================================= */
    public function store(Request $request)
    {
        if (auth('cliente')->check()) {
            return redirect()->route('cliente.home')
                ->with('error', 'Ação não permitida.');
        }

        $request->validate([
            'nome'     => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'CPF'      => 'required|string|size:11|unique:clientes',
            'CHN'      => 'nullable|string|max:20',
            'email'    => 'nullable|email|max:255|unique:clientes',
        ]);

        Cliente::create([
            'nome'     => $request->nome,
            'telefone' => $request->telefone,
            'CPF'      => $request->CPF,
            'CHN'      => $request->CHN,
            'email'    => $request->email,
            'password' => bcrypt('cliente123'), // senha padrão
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente criado com sucesso!');
    }

    /* ================================
       FORMULÁRIO DE EDIÇÃO
    ================================= */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        // Cliente só edita ele mesmo
        if (auth('cliente')->check() &&
            auth('cliente')->id() !== $cliente->id) {

            return redirect()->route('cliente.home')
                ->with('error', 'Você só pode editar seu próprio perfil.');
        }

        return view('clientes.edit', compact('cliente'));
    }

    /* ================================
       ATUALIZAR CLIENTE
    ================================= */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        if (auth('cliente')->check() &&
            auth('cliente')->id() !== $cliente->id) {

            return redirect()->route('cliente.home')
                ->with('error', 'Ação não permitida.');
        }

        $request->validate([
            'nome'     => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'CPF'      => 'required|string|size:11|unique:clientes,CPF,' . $cliente->id,
            'CHN'      => 'nullable|string|max:20',
            'email'    => 'nullable|email|max:255|unique:clientes,email,' . $cliente->id,
        ]);

        $cliente->update([
            'nome'     => $request->nome,
            'telefone' => $request->telefone,
            'CPF'      => $request->CPF,
            'CHN'      => $request->CHN,
            'email'    => $request->email,
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    /* ================================
       EXCLUIR CLIENTE
    ================================= */
    public function destroy(string $id)
    {
        if (auth('cliente')->check()) {
            return redirect()->route('cliente.home')
                ->with('error', 'Ação não permitida.');
        }

        $cliente = Cliente::findOrFail($id);

        if (Agendamento::where('cliente_id', $cliente->id)->exists()) {
            return redirect()->route('clientes.index')
                ->with('error', 'Não é possível excluir: cliente possui agendamentos.');
        }

        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente excluído com sucesso!');
    }

    /* ================================
       DETALHES DO CLIENTE
    ================================= */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        if (auth('cliente')->check() &&
            auth('cliente')->id() !== $cliente->id) {

            return redirect()->route('cliente.home')
                ->with('error', 'Acesso negado.');
        }

        return view('clientes.show', compact('cliente'));
    }
}
