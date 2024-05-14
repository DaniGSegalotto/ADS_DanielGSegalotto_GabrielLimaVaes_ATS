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
            <form action="{{ route('agendamentos.store') }}" method="POST">
                <!-- Token CSRF para proteção contra ataques CSRF -->
                @csrf
                <div class="form-group">
                    <label for="data">data:</label>
                    <!-- Campo para inserir o data do agendamento -->
                    <input type="date" name="data">
                </div>
                <div class="form-group">
                    <label for="horario">horario:</label>
                    <!-- Campo para inserir a horario do agendamento -->
                    <input type="time" name="horario">
                </div>
                <div class="form-group">
                    <label for="funcionario_id">Funcionario:</label>
                    <!-- Campo de seleção para escolher o cliente do agendamento -->
                    <select class="form-control" name="funcionario_id" required>
                        <option value="">Selecione um funcionario</option>
                        <!-- Loop para exibir as opções de marcas -->
                        @foreach($funcionarios as $funcionario)
                            <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="veiculo">Veiculo:</label>
                    <!-- Campo de seleção para escolher o cliente do agendamento -->
                    <select class="form-control" name="veiculo_id" required>
                        <option value="">Selecione um veiculo</option>
                        <!-- Loop para exibir as opções de marcas -->
                        @foreach($veiculos as $veiculo)
                            <option value="{{ $veiculo->id }}">{{ $veiculo->modelo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cliente_id">Cliente:</label>
                    <!-- Campo de seleção para escolher o cliente do agendamento -->
                    <select class="form-control" name="cliente_id" required>
                        <option value="">Selecione um cliente</option>
                        <!-- Loop para exibir as opções de marcas -->
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
    </body>
</x-app-layout>
