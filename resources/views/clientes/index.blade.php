<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/clientes/index.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Lista de Clientes') }}
        </h2>
    </x-slot>

    <div class="container">
        <!-- Formulário de busca -->
        <form action="{{ route('clientes.index') }}" method="GET" class="search-form">
            <div class="search-container">  
            </div>
        </form>

        <!-- Botão para adicionar um novo cliente -->
        <a href="{{ route('clientes.create') }}" class="btn btn-primary">Novo Cliente</a>

        <!-- Tabela de clientes -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>TELEFONE</th>
                    <th>CPF</th>
                    <th>CNH</th>
                    <th>E-MAIL</th>
                    <th>OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->telefone }}</td>
                        <td>{{ $cliente->CPF }}</td>
                        <td>{{ $cliente->CHN}}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>
                            <!-- Botões de ações -->
                            <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info">Detalhes</a>
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
