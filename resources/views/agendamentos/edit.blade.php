<x-app-layout>
    <!-- Cabeçalho da página -->
    <head>
        <!-- Importa um arquivo CSS específico para estilização de edição de veículos -->
        <link rel="stylesheet" href="{{ asset('css/clientes/edit.css') }}">
        <!-- Define a codificação de caracteres e a escala inicial da página -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Define o título da página -->
        <title>Editar Agendamento</title>
    </head>
    <body>
        <div class="container">
            <!-- Título da seção de edição de agendamentos -->
            <h1>Editar Agendamento</h1>
            <!-- Formulário para editar informações do agendamento -->
            <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST">
                @csrf <!-- Token CSRF para proteção contra ataques CSRF -->
                @method('PUT') <!-- Método HTTP para indicar que é uma atualização -->
                <div class="form-group">
                    <label for="data">Data:</label>
                    <!-- Campo para inserir a data do agendamento, com o valor pré-carregado -->
                    <input type="date" name="data" value="{{ $agendamento->data }}">
                </div>

                <div class="form-group">
                    <label for="horario">Horário:</label>
                    <!-- Campo para inserir o horário do agendamento, com o valor pré-carregado -->
                    <input type="time" name="horario" value="{{ $agendamento->horario }}">
                </div>

                <div class="form-group">
                    <label for="funcionario_id">Funcionário:</label>
                    <!-- Campo de seleção para escolher o funcionário associado ao agendamento -->
                    <select name="funcionario_id" id="funcionario_id" required>
                        <!-- Loop para exibir as opções de funcionários -->
                        @foreach ($funcionarios as $funcionario)
                            <option value="{{ $funcionario->id }}" {{ $agendamento->funcionario_id == $funcionario->id ? 'selected' : '' }}>
                                {{ $funcionario->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="veiculo_id">Veículo:</label>
                    <!-- Campo de seleção para escolher o veículo associado ao agendamento -->
                    <select name="veiculo_id" id="veiculo_id" required>
                        <!-- Loop para exibir as opções de veículos -->
                        @foreach ($veiculos as $veiculo)
                            <option value="{{ $veiculo->id }}" {{ $agendamento->veiculo_id == $veiculo->id ? 'selected' : '' }}>
                                {{ $veiculo->modelo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="cliente_id">Cliente:</label>
                    <!-- Campo de seleção para escolher o cliente associado ao agendamento -->
                    <select name="cliente_id" id="cliente_id" required>
                        <!-- Loop para exibir as opções de clientes -->
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $agendamento->cliente_id == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Botão para submeter o formulário e salvar as alterações -->
                <button type="submit" class="btn btn-success">Salvar Alterações</button>
                <!-- Link para cancelar a operação e voltar à página de índice de agendamentos -->
                <a href="{{ route('agendamentos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </body>
</x-app-layout>
