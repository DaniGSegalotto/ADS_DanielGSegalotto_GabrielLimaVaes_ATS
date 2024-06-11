<x-app-layout>
    <!-- Cabeçalho da página -->
    <head>
        <!-- Importa um arquivo CSS específico para estilização de veículos -->
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <!-- Define o título da página -->
        <title>Novo Agendamento</title>
    </head>
    <!-- Define o conteúdo do cabeçalho -->
    <x-slot name="header">
        <!-- Título da página -->
        <h2 class="font-semibold text-xl text-white leading-tight">
            <!-- Exibe o título da página traduzido usando o helper de tradução '__' -->
            {{ __('Criar Agendamentos') }}
        </h2>
    </x-slot>
    <!-- Se houver uma mensagem de sucesso na sessão, ela é exibida -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <body>
        <div class="container">
            <!-- Formulário para criar um novo agendamento -->
            <form id="form-agendamento" action="{{ route('agendamentos.store') }}" method="POST">
                <!-- Token CSRF para proteção contra ataques CSRF -->
                @csrf
                <div class="form-group">
                    <label for="data">Data:</label>
                    <!-- Campo para inserir a data do agendamento -->
                    <input type="date" name="data" id="data">
                </div>
                <div class="form-group">
                    <label for="horario">Horário:</label>
                    <!-- Campo para inserir o horário do agendamento -->
                    <input type="time" name="horario" id="horario">
                </div>
                <div class="form-group">
                    <label for="funcionario_id">Funcionário:</label>
                    <!-- Campo de seleção para escolher o funcionário do agendamento -->
                    <select class="form-control" name="funcionario_id" id="funcionario_id" required>
                        <option value="">Selecione um funcionário</option>
                        @foreach($funcionarios as $funcionario)
                            <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="veiculo_id">Veículo:</label>
                    <!-- Campo de seleção para escolher o veículo do agendamento -->
                    <select class="form-control" name="veiculo_id" id="veiculo_id" required>
                        <option value="">Selecione um veículo</option>
                        @foreach($veiculos as $veiculo)
                            <option value="{{ $veiculo->id }}">{{ $veiculo->modelo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cliente_id">Cliente:</label>
                    <!-- Campo de seleção para escolher o cliente do agendamento -->
                    <select class="form-control" name="cliente_id" id="cliente_id" required>
                        <option value="">Selecione um cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Botão para submeter o formulário e salvar o novo agendamento -->
                <button type="submit" class="btn btn-success">Salvar</button>
                <!-- Link para cancelar a operação e voltar à página de índice de veículos -->
                <a href="{{ route('agendamentos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>

        <!-- Script JavaScript para validação de agendamento duplicado -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('form-agendamento');

                form.addEventListener('submit', function (event) {
                    event.preventDefault(); // Evita a submissão padrão do formulário

                    // Obtém os valores dos campos
                    const data = document.getElementById('data').value;
                    const horario = document.getElementById('horario').value;
                    const funcionarioId = document.getElementById('funcionario_id').value;
                    const veiculoId = document.getElementById('veiculo_id').value;
                    const clienteId = document.getElementById('cliente_id').value;

                    // Verifica se já existe um agendamento para os mesmos dados
                    const existeAgendamento = verificarAgendamento(data, horario, funcionarioId, veiculoId, clienteId);

                    // Se existir, exibe uma mensagem de erro
                    if (existeAgendamento) {
                        alert('Não é possível agendar. Cliente, funcionário ou veículo já estão agendados para o mesmo horário e data.');
                    } else {
                        // Se não existir, submete o formulário
                        form.submit();
                    }
                });

                // Função para verificar se já existe um agendamento com os mesmos dados
                function verificarAgendamento(data, horario, funcionarioId, veiculoId, clienteId) {
                    // Implemente aqui a lógica para verificar no lado do cliente (pode ser uma validação via AJAX)
                    // Retorne true se já existir um agendamento, false caso contrário
                    return false; // Exemplo simples, implemente a lógica adequada
                }
            });
        </script>
    </body>
</x-app-layout>
