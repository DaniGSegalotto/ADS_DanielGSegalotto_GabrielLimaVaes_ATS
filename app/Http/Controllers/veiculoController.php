<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Marca;



class VeiculoController extends Controller
{
    /**
     * Exibe uma lista de todos os veiculos.
     */
    public function index()
    {
        // Obtem todos os veiculos do banco de dados
        $veiculos = Veiculo::all();

        // Retorna a view 'veiculos.index' com a lista de veiculos
        return view('veiculos.index', compact('veiculos'));
    }   

    /**
     * Exibe o formulário para criar um novo veiculo.
     */
    public function create()
    {
        // Retorna a view 'veiculos.create'
        $marcas = Marca::all();
        return view('veiculos.create', compact('marcas'));
    }

    /**
     * Armazena um novo veiculo no banco de dados.
     */
    public function store(Request $request)
    {
        // Cria uma nova instância de Veiculo com dados do formulário
        $veiculo = new Veiculo([
            'modelo' => $request->input('modelo'),
            'categoria' => $request->input('categoria'),
            'placa' => $request->input('placa'),
            'ano' => $request->input('ano'),
            'marca_id' => $request->input('marca_id'),
        ]);

        // Salva o veiculo no banco de dados
        $veiculo->save();

        // Redireciona para a página 'veiculos.index' após salvar
        return redirect()->route('veiculos.index')->with('success', 'Veiculo criado com sucesso!');
    }

    /**
     * Exibe o formulário para editar um veiculo existente.
     */
    public function edit(string $id)
    {
        // Encontra o veiculo pelo ID fornecido ou retorna 404 se não encontrado
        $veiculo = Veiculo::findOrFail($id);

        // Retorna a view 'veiculos.edit' com o cliente para edição

        $marcas = Marca::all();

        return view('veiculos.edit', compact('marcas','veiculo'));
    }

    /**
     * Atualiza um veiculo existente no banco de dados.
     */
    public function update(Request $request, string $id)
    {
        // Encontra o veiculo pelo ID para atualização
        $veiculo = Veiculo::findOrFail($id);

        // Atualiza os campos do veiculo com os dados do formulário

        $veiculo->modelo = $request->input('modelo');
        $veiculo->categoria = $request->input('categoria');
        $veiculo->placa = $request->input('placa');
        $veiculo->ano = $request->input('ano');
        $veiculo->marca_id = $request->input('marca_id');

        // Salva as alterações no banco de dados
        $veiculo->save();

        // Redireciona para a página 'veiculos.index' após a atualização
        return redirect()->route('veiculos.index')->with('success', 'Veiculo alterado com sucesso!');
    }

    /**
     * Remove um veiculo do banco de dados.
     */
    public function destroy(string $id)
    {
        // Encontra o veiculo pelo ID para exclusão
        $veiculo = Veiculo::findOrFail($id);

        // Exclui o veiculo do banco de dados
        $veiculo->delete();

        // Redireciona para a página 'veiculos.index' após exclusão
        return redirect()->route('veiculos.index')->with('success', 'Veiculo excluído com sucesso!');
    }

    /**
     * Mostra detalhes de um veiculo específico.
     */
    public function show(string $id)
    {
        // Busca o veiculo pelo ID ou retorna 404 se não encontrado
        $veiculo = Veiculo::findOrFail($id);

        // Retorna a view 'veiculos.show' para exibir detalhes do veiculo
        return view('veiculos.show', compact('veiculo'));
    }
}
    