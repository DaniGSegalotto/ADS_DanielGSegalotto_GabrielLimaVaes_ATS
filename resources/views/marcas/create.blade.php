<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <title>Nova Marca</title>
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Criar Marcas') }}
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
            <form action="{{ route('marcas.store') }}" method="POST">
                <!-- Token CSRF para proteção contra ataques CSRF -->
                @csrf
                <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input type="text" name="descricao">
            </div>
            <div class="form-group">
                <label for="observacao">Observação:</label>
                <input type="text" name="observacao">
            </div>
            
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('marcas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>


