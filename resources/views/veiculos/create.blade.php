<x-app-layout>
    <!-- Cabeçalho da página -->
    <head>
        <!-- Importa um arquivo CSS específico para estilização de veículos -->
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <!-- Define o título da página -->
        <title>Novo Veículo</title>
    </head>
    <!-- Define o conteúdo do cabeçalho -->
    <x-slot name="header">
        <!-- Título da página -->
        <h2 class="font-semibold text-xl text-white leading-tight">
            <!-- Exibe o título da página traduzido usando o helper de tradução '__' -->
            {{ __('Criar Veiculos') }}
        </h2>
    </x-slot>
    <!-- Se houver uma mensagem de sucesso na sessão, ela é exibida -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <body>
        <div class="container">
            <!-- Formulário para criar um novo veículo -->
            <form action="{{ route('veiculos.store') }}" method="POST">
                <!-- Token CSRF para proteção contra ataques CSRF -->
                @csrf
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <!-- Campo para inserir o modelo do veículo -->
                    <input type="text" name="modelo">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <!-- Campo para inserir a categoria do veículo -->
                    <input type="text" name="categoria">
                </div>
                <div class="form-group">
                    <label for="placa">Placa:</label>
                    <!-- Campo para inserir a placa do veículo -->
                    <input type="text" name="placa">
                </div>
                <div class="form-group">
                    <label for="ano">Ano:</label>
                    <!-- Campo para inserir o ano do veículo -->
                    <input type="number" name="ano">
                </div>
                <div class="form-group">
                    <label for="marca_id">Marca:</label>
                    <!-- Campo de seleção para escolher a marca do veículo -->
                    <select class="form-control" name="marca_id" required>
                        <option value="">Selecione uma marca</option>
                        <!-- Loop para exibir as opções de marcas -->
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->descricao }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Botão para submeter o formulário e salvar o novo veículo -->
                <button type="submit" class="btn btn-success">Salvar</button>
                <!-- Link para cancelar a operação e voltar à página de índice de veículos -->
                <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>
