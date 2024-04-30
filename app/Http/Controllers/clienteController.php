<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //obtem todos clientes do banco usando o modelo "cliente"
        $clientes = cliente::all();

        //retorna a view dos cleintes.index
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //retorna a view "clientes.create"
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //cria um novo cliente ao modelo com os dados fornecidos no request

        $cliente = new cliente([
            'nome' => $request->input('nome'),
            'telefone' => $request->input('telefone'),
            'CPF' => $request->input('CPF'),
            'CHN' => $request->input('CHN'),
            'email' => $request->input('email'),
        ]);

        //salva o cliente no banco de dados
        $cliente->save();

        //redireciona para a rota 'clientes.index' apos salvar
        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Encontra um clienee no banco de dados com o ID fornecido
        $cliente = Cliente::findOrFail($id);
        // Atualiza os campos do cliente com os dados fornecidos no request
        $cliente->nome = $request->input('cliente');
        $cliente->telefone = $request->input('telefone');
        $cliente->CPF = $request->input('CPF');
        $cliente->CHN = $request->input('CHN');
        $cliente->email = $request->input('email');
        // Salva as alterações no cliente
        $cliente->save();
        // Redireciona para a rota 'clientes.index' após salvar
        return redirect()->route('clientes.index')->with('success', 'Cliente alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontra um autor no banco de dados com o ID fornecido
        $cliente = Cliente::findOrFail($id);
        // Exclui o autor do banco de dados
        $cliente->delete();
        // Redireciona para a rota 'clientes.index' após excluir
        return redirect()->route('clientes.index')->with('success', 'Cliente Excluido com sucesso!');
    }
}
