<x-app-layout>
    <!-- Importa um arquivo CSS específico para estilização do índice de funcionários -->
    <link rel="stylesheet" href="{{ asset('css/clientes/index.css') }}">
    <script src="{{ asset('js/funcionarios.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Define o cabeçalho da página -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            <!-- Exibe o título da página traduzido usando o helper de tradução '__' -->
            {{ __('Lista de Funcionários') }}
        </h2>
    </x-slot>

    <div class="container">
        <!-- Formulário de busca (ainda não implementado) -->
        <form action="{{ route('funcionarios.index') }}" method="GET" class="search-form">
            <div class="search-container">  
            </div>
        </form>

        <!-- Botão para adicionar um novo funcionário -->
        <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">Novo Funcionário</a>

        <!-- Tabela de funcionários -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>E-MAIL</th>
                    <th>SEXO</th>
                    <th>OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop para exibir cada funcionário na tabela -->
                @foreach ($funcionarios as $funcionario)
                    <tr>
                        <td>{{ $funcionario->id }}</td>
                        <td>{{ $funcionario->nome }}</td>
                        <td>{{ $funcionario->email }}</td>
                        <td>{{ $funcionario->sexo }}</td>
                        <td>
                            <!-- Botões de ações para detalhes, edição e exclusão do funcionário -->
                            <a href="{{ route('funcionarios.show', $funcionario->id) }}" class="btn btn-info">Detalhes</a>
                            <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="btn btn-warning">Editar</a>
                            <!-- Formulário para excluir o funcionário -->
                            <form id="form-{{ $funcionario->id }}" action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST" style="display: inline;">
                                @csrf <!-- Token CSRF para proteção contra ataques CSRF -->
                                @method('DELETE') <!-- Método HTTP para indicar que é uma exclusão -->
                                <button type="button" onclick="deletarFuncionarios({{ $funcionario->id }})" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
