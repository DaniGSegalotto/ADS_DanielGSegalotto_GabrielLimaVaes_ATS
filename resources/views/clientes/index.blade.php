<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/edit.css') }}">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Cliente</title>
    </head>
    <body>
        <div class="container">
            <h1>Editar Cliente</h1>
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" value="{{ $cliente->nome }}">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="number" name="telefone" value="{{ $cliente->telefone }}">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="number" name="cpf" value="{{ $cliente->cpf }}">
                </div>
                <div class="form-group">
                    <label for="chn">CNH:</label>
                    <input type="number" name="chn" value="{{ $cliente->chn }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="{{ $cliente->email }}">
                </div>
                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>