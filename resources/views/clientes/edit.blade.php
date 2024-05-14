<x-app-layout>

    <head>
        <!-- Importa um arquivo CSS específico para estilização de edição de clientes -->
        <link rel="stylesheet" href="{{ asset('css/clientes/edit.css') }}">
        <!-- Define a codificação de caracteres da página -->
        <meta charset="UTF-8">
        <!-- Define a escala inicial e largura do viewport para dispositivos móveis -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Define o título da página -->
        <title>Editar Cliente</title>
    </head>

    <body>
        <div class="container">
            <!-- Título da página -->
            <h1>Editar Cliente</h1>
            <!-- Formulário para editar informações do cliente -->
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf <!-- Token CSRF para proteção contra ataques CSRF -->
                @method('PUT') <!-- Método HTTP para indicar que é uma atualização -->
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <!-- Campo para inserir/editar o nome do cliente -->
                    <input type="text" name="nome" value="{{ $cliente->nome }}">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <!-- Campo para inserir/editar o telefone do cliente -->
                    <input type="number" name="telefone" value="{{ $cliente->telefone }}">
                </div>
                <div class="form-group">
                    <label for="CPF">CPF:</label>
                    <!-- Campo para inserir/editar o CPF do cliente -->
                    <input type="number" name="CPF" value="{{ $cliente->CPF }}">
                </div>
                <div class="form-group">
                    <label for="CHN">CNH:</label>
                    <!-- Campo para inserir/editar a CNH do cliente -->
                    <input type="number" name="CHN" value="{{ $cliente->CHN }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <!-- Campo para inserir/editar o email do cliente -->
                    <input type="text" name="email" value="{{ $cliente->email }}">
                </div>
                <!-- Botão para submeter o formulário e salvar as alterações -->
                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <!-- Link para cancelar a operação e voltar à página de índice de clientes -->
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>