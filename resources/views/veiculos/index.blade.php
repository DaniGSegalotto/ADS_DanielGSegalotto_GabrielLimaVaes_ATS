<x-app-layout>
    <!-- Inclui um arquivo CSS específico para estilização da página de índice de veículos -->
    <link rel="stylesheet" href="{{ asset('css/clientes/index.css') }}">
    <!-- Cabeçalho da página -->
    <x-slot name="header">
        <!-- Título da página -->
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

        <!-- Botão para adicionar um novo veículo -->
        <a href="{{ route('veiculos.create') }}" class="btn btn-primary">Novo Veículo</a>

        <!-- Tabela de veículos -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>MODELO</th>
                    <th>CATEGORIA</th>
                    <th>PLACA</th>
                    <th>ANO</th>
                    <th>MARCA</th>
                    <th>OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop através dos veículos para exibir informações na tabela -->
                @foreach ($veiculos as $veiculo)
                    <tr>
                        <!-- Exibe o ID do veículo -->
                        <td>{{ $veiculo->id }}</td>
                        <!-- Exibe o modelo do veículo -->
                        <td>{{ $veiculo->modelo }}</td>
                        <!-- Exibe a categoria do veículo -->
                        <td>{{ $veiculo->categoria }}</td>
                        <!-- Exibe a placa do veículo -->
                        <td>{{ $veiculo->placa }}</td>
                        <!-- Exibe o ano do veículo -->
                        <td>{{ $veiculo->ano }}</td>
                        <!-- Exibe o ID da marca do veículo (é recomendável exibir o nome da marca) -->
                        <td>{{ $veiculo->marca_id }}</td>
                        <td>
                            <!-- Botões de ações para cada veículo -->
                            <!-- Botão para ver detalhes do veículo -->
                            <a href="{{ route('veiculos.show', $veiculo->id) }}" class="btn btn-info">Detalhes</a>
                            <!-- Botão para editar o veículo -->
                            <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="btn btn-warning">Editar</a>
                            <!-- Formulário para excluir o veículo -->
                            <form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" style="display: inline;">
                                @csrf <!-- Token CSRF para proteção contra ataques CSRF -->
                                @method('DELETE') <!-- Método HTTP DELETE para exclusão -->
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
