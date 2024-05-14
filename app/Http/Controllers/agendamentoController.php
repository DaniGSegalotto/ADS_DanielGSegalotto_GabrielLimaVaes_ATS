<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Funcionario;
use App\Models\Veiculo;
use App\Models\Cliente;

class AgendamentoController extends Controller
{
    /* Exibe uma lista de todos os agendamentos. */
    public function index()
    {
        // Obtém todos os agendamentos do banco de dados
        $agendamentos = Agendamento::all();

        // Retorna a view 'agendamentos.index' com a lista de agendamentos
        return view('agendamentos.index', compact('agendamentos'));
    }

    /* Exibe o formulário para criar um novo agendamento. */
    public function create()
    {
        // Retorna a view 'agendamentos.create' com dados necessários para o formulário
        $funcionarios = Funcionario::all();
        $veiculos = Veiculo::all();
        $clientes = Cliente::all();
        return view('agendamentos.create', compact('funcionarios', 'veiculos', 'clientes'));
    }

    /* Armazena um novo agendamento no banco de dados. */
    public function store(Request $request)
    {
        // Cria uma nova instância de Agendamento com dados do formulário
        $agendamento = new Agendamento([
            'data' => $request->input('data'),
            'horario' => $request->input('horario'),
            'funcionario_id' => $request->input('funcionario_id'),
            'veiculo_id' => $request->input('veiculo_id'),
            'cliente_id' => $request->input('cliente_id'),
        ]);

        // Salva o agendamento no banco de dados
        $agendamento->save();

        // Redireciona para a página 'agendamentos.index' após salvar
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento criado com sucesso!');
    }

    /* Exibe o formulário para editar um agendamento existente. */
    public function edit(string $id)
    {
        // Encontra o agendamento pelo ID fornecido ou retorna 404 se não encontrado
        $agendamento = Agendamento::findOrFail($id);

        // Retorna a view 'agendamentos.edit' com o agendamento para edição
        $funcionarios = Funcionario::all();
        $veiculos = Veiculo::all();
        $clientes = Cliente::all();
        return view('agendamentos.edit', compact('agendamento', 'funcionarios', 'veiculos', 'clientes'));
    }


    /* Atualiza um agendamento existente no banco de dados. */
    public function update(Request $request, string $id)
    {
        // Encontra o agendamento pelo ID para atualização
        $agendamento = Agendamento::findOrFail($id);

        // Atualiza os campos do agendamento com os dados do formulário
        $agendamento->data = $request->input('data');
        $agendamento->horario = $request->input('horario');
        $agendamento->funcionario_id = $request->input('funcionario_id');
        $agendamento->veiculo_id = $request->input('veiculo_id');
        $agendamento->cliente_id = $request->input('cliente_id');

        // Salva as alterações no banco de dados
        $agendamento->save();

        // Redireciona para a página 'agendamentos.index' após a atualização
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento alterado com sucesso!');
    }

    /* Remove um agendamento do banco de dados. */
    public function destroy(string $id)
    {
        // Encontra o agendamento pelo ID para exclusão
        $agendamento = Agendamento::findOrFail($id);

        // Exclui o agendamento do banco de dados
        $agendamento->delete();

        // Redireciona para a página 'agendamentos.index' após exclusão
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento excluído com sucesso!');
    }

    /* Mostra detalhes de um agendamento específico. */
    public function show(string $id)
    {
        // Busca o agendamento pelo ID ou retorna 404 se não encontrado
        $agendamento = Agendamento::findOrFail($id);

        // Retorna a view 'agendamentos.show' para exibir detalhes do agendamento
        return view('agendamentos.show', compact('agendamento'));
    }
}
