<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Agendamento;

class FuncionarioController extends Controller
{
    /* ================================
       LISTAGEM DE FUNCIONÁRIOS + BUSCA
    ================================= */

public function index(Request $request)
{
    $query = trim($request->input('query'));

    if (!empty($query)) {

        $funcionarios = Funcionario::whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($query) . '%']);

        // Só busca por ID se a query for numérica
        if (is_numeric($query)) {
            $funcionarios->orWhere('id', intval($query));
        }

        $funcionarios = $funcionarios->get();

        return view('funcionarios.index', compact('funcionarios'))
            ->with('query', '');
    }

    $funcionarios = Funcionario::all();
    return view('funcionarios.index', compact('funcionarios'));
}

    /* ================================
       FORMULÁRIO DE CRIAÇÃO
    ================================= */
    public function create()
    {
        return view('funcionarios.create');
    }

    /* ================================
       SALVAR NOVO FUNCIONÁRIO
    ================================= */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:funcionarios',
            'sexo' => 'required|string|in:M,F',
            'password' => 'required|string|min:6',
        ]);

        $funcionario = new Funcionario([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'sexo' => $request->input('sexo'),
            'password' => bcrypt($request->input('password')),
        ]);

        $funcionario->save();

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário criado com sucesso!');
    }

    /* ================================
       FORMULÁRIO DE EDIÇÃO
    ================================= */
    public function edit(string $id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionarios.edit', compact('funcionario'));
    }

    /* ================================
       ATUALIZAR FUNCIONÁRIO
    ================================= */
    public function update(Request $request, string $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:funcionarios,email,' . $funcionario->id,
            'sexo' => 'required|string|in:M,F',
        ]);

        $funcionario->update([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'sexo' => $request->input('sexo'),
        ]);

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário alterado com sucesso!');
    }

    /* ================================
       EXCLUIR FUNCIONÁRIO
    ================================= */
    public function destroy(string $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        if (Agendamento::where('funcionario_id', $funcionario->id)->exists()) {
            return redirect()->route('funcionarios.index')
                ->with('error', 'Não é possível excluir o funcionário, pois está vinculado a um agendamento.');
        }

        $funcionario->delete();

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário excluído com sucesso!');
    }

    /* ================================
       DETALHES DO FUNCIONÁRIO
    ================================= */
    public function show(string $id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionarios.show', compact('funcionario'));
    }
}
