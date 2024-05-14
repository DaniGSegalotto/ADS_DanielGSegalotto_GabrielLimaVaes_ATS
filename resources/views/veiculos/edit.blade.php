<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/edit.css') }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Veículo</title>
    </head>
    <body>
        <div class="container">
            <h1>Editar Veiculo</h1>
            <form action="{{ route('veiculos.update', $veiculo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" name="modelo" value="{{ $veiculo->modelo }}">
                </div>
                
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <input type="text" name="categoria" value="{{ $veiculo->categoria }}">
                </div>

                <div class="form-group">
                    <label for="placa">Placa:</label>
                    <input type="text" name="placa" value="{{ $veiculo->placa }}">
                </div>
                <div class="form-group">
                    <label for="ano">Ano:</label>
                    <input type="number" name="ano" value="{{ $veiculo->ano }}">
                </div>
                <div class="form-group">
                    <label for="marca_id">Marca:</label>
                    <select name="marca_id" id="marca_id" required>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ $veiculo->marca_id == $marca->id ? 'selected' : '' }}>{{ $marca->nome }}</option>
                    @endforeach
        </select>
                </div>

                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>