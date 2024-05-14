<x-app-layout>
    <!-- Define o cabeçalho da página -->
    <x-slot name="header">
        <!-- Importa um arquivo CSS específico para estilização de marcas -->
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <!-- Define o título da página -->
        <title>Nova Marca</title>
        <h2 class="font-semibold text-xl text-white leading-tight">
            <!-- Exibe o título da página traduzido usando o helper de tradução '__' -->
            {{ __('Criar Marcas') }}
        </h2>
    </x-slot>
    <!-- Verifica se há uma mensagem de sucesso na sessão e a exibe -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <body>
        <div class="container">
            <!-- Formulário para criar uma nova marca -->
            <form action="{{ route('marcas.store') }}" method="POST">
                <!-- Token CSRF para proteção contra ataques CSRF -->
                @csrf
                <div class="form-group">
                    <label for="descricao">Nome:</label>
                    <!-- Campo para inserir o nome da marca -->
                    <input type="text" name="descricao">
                </div>
                <div class="form-group">
                    <label for="observacao">Observação:</label>
                    <!-- Campo para inserir uma observação sobre a marca -->
                    <input type="text" name="observacao">
                </div>
                <!-- Botão para submeter o formulário e salvar a nova marca -->
                <button type="submit" class="btn btn-success">Salvar</button>
                <!-- Link para cancelar a operação e voltar à página de índice de marcas -->
                <a href="{{ route('marcas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>
