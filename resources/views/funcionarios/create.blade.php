<x-app-layout>
    <head>
        <!-- Importa um arquivo CSS específico para estilização de funcionários -->
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <!-- Define o título da página -->
        <title>Novo Funcionário</title>
    </head>
    <!-- Define o cabeçalho da página -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            <!-- Exibe o título da página traduzido usando o helper de tradução '__' -->
            {{ __('Criar Funcionário') }}
        </h2>
    </x-slot>
    <!-- Verifica se há uma mensagem de sucesso na sessão e a exibe -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="container">
        <!-- Formulário para adicionar um novo funcionário -->
        <form action="{{ route('funcionarios.store') }}" method="POST">
            <!-- Token CSRF para proteção contra ataques CSRF -->
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" name="email">
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <!-- Menu suspenso para selecionar o sexo do funcionário -->
                <select name="sexo">
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                </select>
            </div>
            <!-- Botão para submeter o formulário e salvar o novo funcionário -->
            <button type="submit" class="btn btn-success">Salvar</button>
            <!-- Link para cancelar a operação e voltar à página de índice de funcionários -->
            <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</x-app-layout>
