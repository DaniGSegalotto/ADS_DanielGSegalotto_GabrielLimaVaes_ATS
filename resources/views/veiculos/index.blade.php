<x-app-layout>
    <!-- Importa um arquivo CSS/JS específico para estilização/interação do índice de clientes -->

    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/index.css') }}">
        <script src="{{ asset('js/veiculos.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

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
                <!-- Adicione campos de busca aqui, por exemplo: -->
                <input type="text" name="query" placeholder="Buscar Veículos">
                <button type="submit" class="btn btn-primary">Buscar</button>
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
                            <form id="delete-form-{{ $veiculo->id }}" action="{{ route('veiculos.destroy', $veiculo->id) }}"
                                method="POST" style="display: inline;">
                                @csrf <!-- Token CSRF para proteção contra ataques CSRF -->
                                @method('DELETE') <!-- Método HTTP DELETE para exclusão -->
                                <button type="button" onclick="confirmDelete({{ $veiculo->id }})"
                                    class="btn btn-danger">Excluir</button>
                                <button type="button" class="btn btn-info2"
                                    onclick="infoVeiculo({{ $veiculo->id }})">Informação</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>