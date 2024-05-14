<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/clientes/index.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Lista de Veículos') }}
        </h2>
    </x-slot>

    <div class="container">
        <!-- Formulário de busca -->
        <form action="{{ route('veiculos.index') }}" method="GET" class="search-form">
            <div class="search-container">  
            </div>
        </form>

        <!-- Botão para adicionar um novo veiculo -->
        <a href="{{ route('veiculos.create') }}" class="btn btn-primary">Novo Veículo</a>

        <!-- Tabela de veiculos -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>MODELO</th>
                    <th>CAREGORIA</th>
                    <th>PLACA</th>
                    <th>ANO</th>
                    <th>MARCA</th>
                    <th>OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($veiculos as $veiculo)
                    <tr>
                        <td>{{ $veiculo->id }}</td>
                        <td>{{ $veiculo->modelo }}</td>
                        <td>{{ $veiculo->categoria }}</td>
                        <td>{{ $veiculo->placa }}</td>
                        <td>{{ $veiculo->ano}}</td>
                        <td>{{ $veiculo->marca_id }}</td>
                        <td>
                            <!-- Botões de ações -->
                            <a href="{{ route('veiculos.show', $veiculo->id) }}" class="btn btn-info">Detalhes</a>
                            <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" style="display: inline;">
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
