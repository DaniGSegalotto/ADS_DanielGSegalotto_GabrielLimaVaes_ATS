<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <title>Novo Cliente</title>
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Criar Clientes') }}
        </h2>
    </x-slot>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Sucesso!</strong>
        <span class="block sm:inline">{{ session('success') }}</div>
        </div>
    @endif
    <body>
        <div class="container">
            <form action="{{ route('clientes.store') }}" method="POST">
                <!-- Token CSRF para proteção contra ataques CSRF -->
                @csrf
                <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="number" name="telefone">
            </div>
            <div class="form-group">
                <label for="CPF">CPF:</label>
                <input type="number" name="CPF">
            </div>
            <div class="form-group">
                <label for="CHN">CNH:</label>
                <input type="text" name="CHN">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email">
            </div>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>


