<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /* Exibe uma lista de todos os clientes.*/
    public function index()
    {
        // Obtem todos os clientes do banco de dados
        $clientes = Cliente::all();

        // Retorna a view 'clientes.index' com a lista de clientes
        return view('clientes.index', compact('clientes'));
    }

    /* Exibe o formulário para criar um novo cliente.*/

    public function create()
    {
        // Retorna a view 'clientes.create'
        return view('clientes.create');
    }

    /* Armazena um novo cliente no banco de dados. */
    public function store(Request $request)
    {
        // Cria uma nova instância de Cliente com dados do formulário
        $cliente = new Cliente([
            'nome' => $request->input('nome'),
            'telefone' => $request->input('telefone'),
            'CPF' => $request->input('CPF'),
            'CHN' => $request->input('CHN'),
            'email' => $request->input('email'),
        ]);

        // Salva o cliente no banco de dados
        $cliente->save();

        // Redireciona para a página 'clientes.index' após salvar
        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
    }

    /* Exibe o formulário para editar um cliente existente. */
    public function edit(string $id)
    {
        // Encontra o cliente pelo ID fornecido ou retorna 404 se não encontrado
        $cliente = Cliente::findOrFail($id);

        // Retorna a view 'clientes.edit' com o cliente para edição
        return view('clientes.edit', compact('cliente'));
    }

    /* Atualiza um cliente existente no banco de dados.*/
    public function update(Request $request, string $id)
    {
        // Encontra o cliente pelo ID para atualização
        $cliente = Cliente::findOrFail($id);

        // Atualiza os campos do cliente com os dados do formulário
        $cliente->nome = $request->input('nome');
        $cliente->telefone = $request->input('telefone');
        $cliente->CPF = $request->input('CPF');
        $cliente->CHN = $request->input('CHN');
        $cliente->email = $request->input('email');

        // Salva as alterações no banco de dados
        $cliente->save();

        // Redireciona para a página 'clientes.index' após a atualização
        return redirect()->route('clientes.index')->with('success', 'Cliente alterado com sucesso!');
    }

    /* Remove um cliente do banco de dados. */
    public function destroy(string $id)
    {
        // Encontra o cliente pelo ID para exclusão
        $cliente = Cliente::findOrFail($id);

        // Exclui o cliente do banco de dados
        $cliente->delete();

        // Redireciona para a página 'clientes.index' após exclusão
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }

    /* Mostra detalhes de um cliente específico. */
    public function show(string $id)
    {
        // Busca o cliente pelo ID ou retorna 404 se não encontrado
        $cliente = Cliente::findOrFail($id);

        // Retorna a view 'clientes.show' para exibir detalhes do cliente
        return view('clientes.show', compact('cliente'));
    }
}
