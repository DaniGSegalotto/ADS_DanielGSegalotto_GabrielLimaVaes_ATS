<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;

class AgendamentoController extends Controller
{
    /* Exibe uma lista de todos os agendamentos. */
    public function index()
    {   
        // Obtem todos os agendamentos do banco de dados
        $agendamentos = Agendamento::all();

        // Retorna a view 'agendamentos.index' com a lista de agendamentos
        return view('agendamentos.index', compact('agendamentos'));
    }

    /* Exibe o formulário para criar um novo agendamento. */
    public function create()
    {
        // Retorna a view 'agendamentos.create' para criar um novo agendamento
        return view('agendamentos.create');
    }

    /* Armazena um novo agendamento no banco de dados. */
    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'data' => 'required|date',
            'horario' => 'required',
            'funcionario_id' => 'required|exists:funcionarios,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        // Cria um novo agendamento com os dados do formulário
        Agendamento::create($request->all());

        // Redireciona para a página 'agendamentos.index' após salvar
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento criado com sucesso!');
    }

    /* Exibe o formulário para editar um agendamento existente. */
    public function edit($id)
    {
        // Encontra o agendamento pelo ID fornecido ou retorna 404 se não encontrado
        $agendamento = Agendamento::findOrFail($id);

        // Retorna a view 'agendamentos.edit' com o agendamento para edição
        return view('agendamentos.edit', compact('agendamento'));
    }

    /* Atualiza um agendamento existente no banco de dados. */
    public function update(Request $request, $id)
    {
        // Valida os dados do formulário
        $request->validate([
            'data' => 'required|date',
            'horario' => 'required',
            'funcionario_id' => 'required|exists:funcionarios,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        // Encontra o agendamento pelo ID para atualização
        $agendamento = Agendamento::findOrFail($id);

        // Atualiza os campos do agendamento com os dados do formulário
        $agendamento->update($request->all());

        // Redireciona para a página 'agendamentos.index' após a atualização
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento atualizado com sucesso!');
    }

    /* Remove um agendamento do banco de dados. */
    public function destroy($id)
    {
        // Encontra o agendamento pelo ID para exclusão
        $agendamento = Agendamento::findOrFail($id);

        // Exclui o agendamento do banco de dados
        $agendamento->delete();

        // Redireciona para a página 'agendamentos.index' após exclusão
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento excluído com sucesso!');
    }

    /* Mostra detalhes de um agendamento específico. */
    public function show($id)
    {
        // Busca o agendamento pelo ID ou retorna 404 se não encontrado
        $agendamento = Agendamento::findOrFail($id);

        // Retorna a view 'agendamentos.show' para exibir detalhes do agendamento
        return view('agendamentos.show', compact('agendamento'));
    }
}
