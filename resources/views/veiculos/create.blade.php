<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <title>Novo Veículo</title>
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Criar Veiculos') }}
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
            <form action="{{ route('veiculos.store') }}" method="POST">
                <!-- Token CSRF para proteção contra ataques CSRF -->
                @csrf
                <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" name="modelo">
            </div>

            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <input type="text" name="categoria">
            </div>

            <div class="form-group">
                <label for="placa">Placa:</label>
                <input type="text" name="placa">
            </div>

            <div class="form-group">
                <label for="ano">Ano:</label>
                <input type="number" name="ano">
            </div>

            <div class="form-group">
                <label for="marca_id">Marca:</label>
                <select class="form-control" name="marca_id" required>
                    <option value="">Selecione uma marca</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->descricao }}</option>
                    @endforeach
                </select>
            </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>


