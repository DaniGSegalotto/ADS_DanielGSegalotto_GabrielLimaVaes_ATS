<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/edit.css') }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Veículo</title>
    </head>

    <body>
        <div class="container">
            <h1>Editar Veículo</h1>

            {{-- Mensagens de sucesso ou erro --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <strong class="font-bold">Sucesso!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <strong class="font-bold">Erro!</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('veiculos.update', $veiculo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" name="modelo" id="modelo" value="{{ old('modelo', $veiculo->modelo) }}">
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $veiculo->categoria) }}">
                </div>

                <div class="form-group">
                    <label for="placa">Placa:</label>
                    <input type="text" name="placa" id="placa" value="{{ old('placa', $veiculo->placa) }}">
                </div>

                <div class="form-group">
                    <label for="ano">Ano:</label>
                    <input type="number" name="ano" id="ano" value="{{ old('ano', $veiculo->ano) }}">
                </div>

                <div class="form-group">
                    <label for="marca_id">Marca:</label>
                    <select name="marca_id" id="marca_id" required>
                        <option value="">Selecione uma marca</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}" {{ old('marca_id', $veiculo->marca_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->descricao }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status_id">Status:</label>
                    <select name="status_id" id="status_id" required>
                        <option value="">Selecione um status</option>
                        @foreach ($statuses as $statu)
                            <option value="{{ $statu->id }}" {{ old('status_id', $veiculo->status_id) == $statu->id ? 'selected' : '' }}>
                                {{ $statu->descricao }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>
