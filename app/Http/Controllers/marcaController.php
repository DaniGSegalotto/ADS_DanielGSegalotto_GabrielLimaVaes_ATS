<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    /**
     * Exibe uma lista de todos as marcas.
     */
    public function index()
    {
        // Obtem todos as marcas do banco de dados
        $marcas = Marca::all();

        // Retorna a view 'marca.index' com a lista de marcas
        return view('marcas.index', compact('marcas'));
    }   

    /**
     * Exibe o formulário para criar uma nova marca.
     */
    public function create()
    {
        // Retorna a view 'marcas.create'
        return view('marcas.create');
    }

    /**
     * Armazena uma nova marca no banco de dados.
     */
    public function store(Request $request)
    {
        // Cria uma nova instância de Marcas com dados do formulário
        $marca = new Marca([
            'descricao' => $request->input('descricao'),
            'observacao' => $request->input('observacao'),
        ]);

        // Salva a Marca no banco de dados
        $marca->save();

        // Redireciona para a página 'marcas.index' após salvar
        return redirect()->route('marcas.index')->with('success', 'Marca criada com sucesso!');
    }

    /**
     * Exibe o formulário para editar uma marca existente.
     */
    public function edit(string $id)
    {
        // Encontra a marca pelo ID fornecido ou retorna 404 se não encontrado
        $marca = Marca::findOrFail($id);

        // Retorna a view 'marcas.edit' com a marca para edição
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Atualiza uma marca existente no banco de dados.
     */
    public function update(Request $request, string $id)
    {
        // Encontra a marca pelo ID para atualização
        $marca = Marca::findOrFail($id);

        // Atualiza os campos da marca com os dados do formulário

        $marca->descricao = $request->input('descricao');
        $marca->observacao = $request->input('observacao');

        // Salva as alterações no banco de dados
        $marca->save();

        // Redireciona para a página 'marcas.index' após a atualização
        return redirect()->route('marcas.index')->with('success', 'Marca alterada com sucesso!');
    }

    /**
     * Remove uma marca do banco de dados.
     */
    public function destroy(string $id)
    {
        // Encontra a marca pelo ID para exclusão
        $marca = Marca::findOrFail($id);

        // Exclui a marca do banco de dados
        $marca->delete();

        // Redireciona para a página 'marcas.index' após exclusão
        return redirect()->route('marcas.index')->with('success', 'Marca excluída com sucesso!');
    }

    /**
     * Mostra detalhes de uma marca específica.
     */
    public function show(string $id)
    {
        // Busca a marca pelo ID ou retorna 404 se não encontrado
        $marca = Marca::findOrFail($id);

        // Retorna a view 'marcas.show' para exibir detalhes da marca
        return view('marcas.show', compact('marca'));
    }
}
    