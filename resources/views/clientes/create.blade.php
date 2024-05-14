<x-app-layout>

    <head>
        <!-- Importa um arquivo CSS específico para estilização de clientes -->
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <!-- Define o título da página -->
        <title>Novo Cliente</title>
    </head>
    <!-- Define o cabeçalho da página -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            <!-- Exibe o título da página traduzido usando o helper de tradução '__' -->
            {{ __('Criar Clientes') }}
        </h2>
    </x-slot>
    <!-- Verifica se há uma mensagem de sucesso na sessão e a exibe -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        </div>
    @endif

    <body>
        <div class="container">
            <!-- Formulário para adicionar novos clientes -->
            <form action="{{ route('clientes.store') }}" method="POST">
                <!-- Token CSRF para proteção contra ataques CSRF -->
                @csrf
                <div class="form-group">
                    <!-- Campo para inserir o nome do cliente -->
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome">
                </div>
                <div class="form-group">
                    <!-- Campo para inserir o telefone do cliente -->
                    <label for="telefone">Telefone:</label>
                    <input type="number" name="telefone">
                </div>
                <div class="form-group">
                    <!-- Campo para inserir o CPF do cliente -->
                    <label for="CPF">CPF:</label>
                    <input type="number" name="CPF">
                </div>
                <div class="form-group">
                    <!-- Campo para inserir a CNH do cliente -->
                    <label for="CHN">CNH:</label>
                    <input type="text" name="CHN">
                </div>
                <div class="form-group">
                    <!-- Campo para inserir o email do cliente -->
                    <label for="email">Email:</label>
                    <input type="text" name="email">
                </div>
                <!-- Botão para submeter o formulário -->
                <button type="submit" class="btn btn-success">Salvar</button>
                <!-- Link para cancelar a operação e voltar à página de índice de clientes -->
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>