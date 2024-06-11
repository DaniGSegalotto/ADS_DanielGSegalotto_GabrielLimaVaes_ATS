<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Agendamento;

class VeiculoController extends Controller
{
    /* Exibe uma lista de todos os veículos. */
    public function index()
    {
        // Obtém todos os veículos do banco de dados
        $veiculos = Veiculo::all();

        // Retorna a view 'veiculos.index' com a lista de veículos
        return view('veiculos.index', compact('veiculos'));
    }

    /* Exibe o formulário para criar um novo veículo. */
    public function create()
    {
        // Retorna a view 'veiculos.create' com as marcas disponíveis
        $marcas = \App\Models\Marca::all();
        return view('veiculos.create', compact('marcas'));
    }

    /* Armazena um novo veículo no banco de dados. */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'modelo' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'placa' => 'required|string|max:10|unique:veiculos,placa',
            'ano' => 'required|integer|min:1900',
            'marca_id' => 'required|exists:marcas,id',
        ]);

        // Cria uma nova instância de Veiculo com dados do formulário
        $veiculo = new Veiculo([
            'modelo' => $request->input('modelo'),
            'categoria' => $request->input('categoria'),
            'placa' => $request->input('placa'),
            'ano' => $request->input('ano'),
            'marca_id' => $request->input('marca_id'),
        ]);

        // Salva o veículo no banco de dados
        $veiculo->save();

        // Redireciona para a página 'veiculos.index' após salvar
        return redirect()->route('veiculos.index')->with('success', 'Veículo criado com sucesso!');
    }

    /* Exibe o formulário para editar um veículo existente. */
    public function edit(string $id)
    {
        // Encontra o veículo pelo ID fornecido ou retorna 404 se não encontrado
        $veiculo = Veiculo::findOrFail($id);

        // Obtém todas as marcas para o dropdown de marcas
        $marcas = \App\Models\Marca::all();

        // Retorna a view 'veiculos.edit' com o veículo e as marcas para edição
        return view('veiculos.edit', compact('veiculo', 'marcas'));
    }

    /* Atualiza um veículo existente no banco de dados. */
    public function update(Request $request, string $id)
    {
        // Encontra o veículo pelo ID para atualização
        $veiculo = Veiculo::findOrFail($id);

        // Validação dos dados do formulário
        $request->validate([
            'modelo' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'placa' => 'required|string|max:10|unique:veiculos,placa,' . $veiculo->id,
            'ano' => 'required|integer|min:1900',
            'marca_id' => 'required|exists:marcas,id',
        ]);

        // Atualiza os campos do veículo com os dados do formulário
        $veiculo->modelo = $request->input('modelo');
        $veiculo->categoria = $request->input('categoria');
        $veiculo->placa = $request->input('placa');
        $veiculo->ano = $request->input('ano');
        $veiculo->marca_id = $request->input('marca_id');

        // Salva as alterações no banco de dados
        $veiculo->save();

        // Redireciona para a página 'veiculos.index' após a atualização
        return redirect()->route('veiculos.index')->with('success', 'Veículo alterado com sucesso!');
    }

    /* Remove um veículo do banco de dados. */
    public function destroy(string $id)
    {
        // Encontra o veículo pelo ID para exclusão
        $veiculo = Veiculo::findOrFail($id);

        // Verifica se existem agendamentos associados ao veículo
        $agendamentos = Agendamento::where('veiculo_id', $veiculo->id)->exists();

        // Se existirem agendamentos associados, redireciona de volta com mensagem de erro
        if ($agendamentos) {
            return redirect()->route('veiculos.index')->with('error', 'Não é possível excluir o veículo, pois está vinculado a um agendamento.');
        }

        // Caso não haja agendamentos associados, exclui o veículo
        $veiculo->delete();

        // Redireciona para a página 'veiculos.index' após exclusão
        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso!');
    }

    /* Mostra detalhes de um veículo específico. */
    public function show(string $id)
    {
        // Busca o veículo pelo ID ou retorna 404 se não encontrado
        $veiculo = Veiculo::findOrFail($id);

        // Retorna a view 'veiculos.show' para exibir detalhes do veículo
        return view('veiculos.show', compact('veiculo'));
    }
}
