<x-app-layout>
    <!-- Cabeçalho da página -->
    <head>
        <!-- Importa um arquivo CSS específico para estilização de edição -->
        <link rel="stylesheet" href="{{ asset('css/clientes/edit.css') }}">
        <!-- Define a codificação de caracteres e a escala inicial da página -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Define o título da página -->
        <title>Editar Marca</title>
    </head>
    <body>
        <div class="container">
            <!-- Título da seção de edição de marca -->
            <h1>Editar Marca</h1>
            <!-- Formulário para editar informações da marca -->
            <form action="{{ route('marcas.update', $marca->id) }}" method="POST">
                @csrf <!-- Token CSRF para proteção contra ataques CSRF -->
                @method('PUT') <!-- Método HTTP para indicar que é uma atualização -->
                <div class="form-group">
                    <label for="descricao">Nome:</label>
                    <!-- Campo para inserir o nome da marca, com o valor pré-carregado -->
                    <input type="text" name="descricao" value="{{ $marca->descricao }}">
                </div>
                <div class="form-group">
                    <label for="observacao">Observação:</label>
                    <!-- Campo para inserir uma observação sobre a marca, com o valor pré-carregado -->
                    <input type="text" name="observacao" value="{{ $marca->observacao }}">
                </div>
                <!-- Botão para submeter o formulário e salvar as alterações -->
                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <!-- Link para cancelar a operação e voltar à página de índice de marcas -->
                <a href="{{ route('marcas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>
