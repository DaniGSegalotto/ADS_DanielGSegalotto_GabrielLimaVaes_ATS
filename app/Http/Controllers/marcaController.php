<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Veiculo;

class MarcaController extends Controller
{
    /* Exibe uma lista de todas as marcas. */
    public function index()
    {
        // Obtém todas as marcas do banco de dados
        $marcas = Marca::all();

        // Retorna a view 'marcas.index' com a lista de marcas
        return view('marcas.index', compact('marcas'));
    }

    /* Exibe o formulário para criar uma nova marca. */
    public function create()
    {
        // Retorna a view 'marcas.create'
        return view('marcas.create');
    }

    /* Armazena uma nova marca no banco de dados. */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'descricao' => 'required|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        // Cria uma nova instância de Marca com dados do formulário
        $marca = new Marca([
            'descricao' => $request->input('descricao'),
            'observacao' => $request->input('observacao'),
        ]);

        // Salva a Marca no banco de dados
        $marca->save();

        // Redireciona para a página 'marcas.index' após salvar
        return redirect()->route('marcas.index')->with('success', 'Marca criada com sucesso!');
    }

    /* Exibe o formulário para editar uma marca existente. */
    public function edit(string $id)
    {
        // Encontra a marca pelo ID fornecido ou retorna 404 se não encontrado
        $marca = Marca::findOrFail($id);

        // Retorna a view 'marcas.edit' com a marca para edição
        return view('marcas.edit', compact('marca'));
    }

    /* Atualiza uma marca existente no banco de dados. */
    public function update(Request $request, string $id)
    {
        // Encontra a marca pelo ID para atualização
        $marca = Marca::findOrFail($id);

        // Validação dos dados do formulário
        $request->validate([
            'descricao' => 'required|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        // Atualiza os campos da marca com os dados do formulário
        $marca->descricao = $request->input('descricao');
        $marca->observacao = $request->input('observacao');

        // Salva as alterações no banco de dados
        $marca->save();

        // Redireciona para a página 'marcas.index' após a atualização
        return redirect()->route('marcas.index')->with('success', 'Marca alterada com sucesso!');
    }

    /* Remove uma marca do banco de dados. */
    public function destroy(string $id)
    {
        // Encontra a marca pelo ID para exclusão
        $marca = Marca::findOrFail($id);

        // Verifica se existem veículos associados à marca
        $veiculos = Veiculo::where('marca_id', $marca->id)->exists();

        // Se existirem veículos associados, redireciona de volta com mensagem de erro
        if ($veiculos) {
            return redirect()->route('marcas.index')->with('error', 'Não é possível excluir a marca, pois está vinculada a um veículo.');
        }

        // Caso não haja veículos associados, exclui a marca
        $marca->delete();

        // Redireciona para a página 'marcas.index' após exclusão
        return redirect()->route('marcas.index')->with('success', 'Marca excluída com sucesso!');
    }

    /* Mostra detalhes de uma marca específica. */
    public function show(string $id)
    {
        // Busca a marca pelo ID ou retorna 404 se não encontrado
        $marca = Marca::findOrFail($id);

        // Retorna a view 'marcas.show' para exibir detalhes da marca
        return view('marcas.show', compact('marca'));
    }
}
