<x-app-layout>
    <!-- Cabeçalho da página -->
    <head>
        <!-- Importa um arquivo CSS específico para estilização de edição de veículos -->
        <link rel="stylesheet" href="{{ asset('css/clientes/edit.css') }}">
        <!-- Define a codificação de caracteres e a escala inicial da página -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Define o título da página -->
        <title>Editar Veículo</title>
    </head>
    <body>
        <div class="container">
            <!-- Título da seção de edição de veículo -->
            <h1>Editar Veículo</h1>
            <!-- Formulário para editar informações do veículo -->
            <form action="{{ route('veiculos.update', $veiculo->id) }}" method="POST">
                @csrf <!-- Token CSRF para proteção contra ataques CSRF -->
                @method('PUT') <!-- Método HTTP para indicar que é uma atualização -->
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <!-- Campo para inserir o modelo do veículo, com o valor pré-carregado -->
                    <input type="text" name="modelo" value="{{ $veiculo->modelo }}">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <!-- Campo para inserir a categoria do veículo, com o valor pré-carregado -->
                    <input type="text" name="categoria" value="{{ $veiculo->categoria }}">
                </div>
                <div class="form-group">
                    <label for="placa">Placa:</label>
                    <!-- Campo para inserir a placa do veículo, com o valor pré-carregado -->
                    <input type="text" name="placa" value="{{ $veiculo->placa }}">
                </div>
                <div class="form-group">
                    <label for="ano">Ano:</label>
                    <!-- Campo para inserir o ano do veículo, com o valor pré-carregado -->
                    <input type="number" name="ano" value="{{ $veiculo->ano }}">
                </div>
                <div class="form-group">
                    <label for="marca_id">Marca:</label>
                    <!-- Campo de seleção para escolher a marca do veículo -->
                    <select name="marca_id" id="marca_id" required>
                        <!-- Loop para exibir as opções de marcas -->
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}" {{ $veiculo->marca_id == $marca->id ? 'selected' : '' }}>
                                {{ $marca->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Botão para submeter o formulário e salvar as alterações -->
                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <!-- Link para cancelar a operação e voltar à página de índice de veículos -->
                <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>
