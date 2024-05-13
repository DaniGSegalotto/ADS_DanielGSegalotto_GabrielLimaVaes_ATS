<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/clientes/index.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Lista de Marcas') }}
        </h2>
    </x-slot>

    <div class="container">
        <!-- Formulário de busca -->
        <form action="{{ route('marcas.index') }}" method="GET" class="search-form">
            <div class="search-container">  
            </div>
        </form>

        <!-- Botão para adicionar uma nova marca -->
        <a href="{{ route('marcas.create') }}" class="btn btn-primary">Nova Marca</a>

        <!-- Tabela de marcas -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DESCRIÇÃO</th>
                    <th>OBSERVAÇÃO</th>
                    <th>OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marcas as $marca)
                    <tr>
                        <td>{{ $marca->id }}</td>
                        <td>{{ $marca->descricao }}</td>
                        <td>{{ $marca->observacao }}</td>
                        <td>
                            <!-- Botões de ações -->
                            <a href="{{ route('marcas.show', $marca->id) }}" class="btn btn-info">Detalhes</a>
                            <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('marcas.destroy', $marca->id) }}" method="POST" style="display: inline;">
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
