<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/edit.css') }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Marca</title>
    </head>
    <body>
        <div class="container">
            <h1>Editar Marca</h1>
            <form action="{{ route('marcas.update', $marca->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" name="descricao" value="{{ $marca->descricao }}">
                </div>
                <div class="form-group">
                    <label for="observacao">Observação:</label>
                    <input type="text" name="observacao" value="{{ $marca->observacao }}">
                </div>
                
                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <a href="{{ route('marcas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>