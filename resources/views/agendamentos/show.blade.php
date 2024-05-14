<x-app-layout>
    <!-- Cabeçalho da página -->
    <x-slot name="header">
        <!-- Importa um arquivo CSS específico para estilização de detalhes do agendamento -->
        <link rel="stylesheet" href="{{ asset('css/clientes/showAgendamentos.css') }}">
        <!-- Título da página -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes do Agendamento') }}
        </h2>
    </x-slot>
    <!-- Seção de detalhes do agendamento -->
    <section class="agendamento-details">
        <div class="agendamento-content">
            <!-- Meta informações do agendamento -->
            <div class="agendamento-meta">
                <!-- Rótulo "ID" -->
                <span class="agendamento-label">ID:</span>
                <!-- Informação do ID do agendamento -->
                <span class="agendamento-info">{{ $agendamento->id }}</span>
            </div>
            <!-- Meta informações do agendamento -->
            <div class="agendamento-meta">
                <!-- Rótulo "Data" -->
                <span class="agendamento-label">Data:</span>
                <!-- Informação da data do agendamento -->
                <span class="agendamento-info">{{ $agendamento->data }}</span>
            </div>
            <!-- Meta informações do agendamento -->
            <div class="agendamento-meta">
                <!-- Rótulo "Horário" -->
                <span class="agendamento-label">Horário:</span>
                <!-- Informação do horário do agendamento -->
                <span class="agendamento-info">{{ $agendamento->horario }}</span>
            </div>
            <!-- Meta informações do agendamento -->
            <div class="agendamento-meta">
                <!-- Rótulo "Funcionário" -->
                <span class="agendamento-label">Funcionário:</span>
                <!-- Informação do funcionário associado ao agendamento -->
                <span class="agendamento-info">{{ $agendamento->funcionario->nome }}</span>
            </div>
            <!-- Meta informações do agendamento -->
            <div class="agendamento-meta">
                <!-- Rótulo "Veículo" -->
                <span class="agendamento-label">Veículo:</span>
                <!-- Informação do veículo associado ao agendamento -->
                <span class="agendamento-info">{{ $agendamento->veiculo->modelo }}</span>
            </div>
            <!-- Meta informações do agendamento -->
            <div class="agendamento-meta">
                <!-- Rótulo "Cliente" -->
                <span class="agendamento-label">Cliente:</span>
                <!-- Informação do cliente associado ao agendamento -->
                <span class="agendamento-info">{{ $agendamento->cliente->nome }}</span>
            </div>
        </div>
        <!-- Botão de retorno para a página de índice de agendamentos -->
        <a href="{{ route('agendamentos.index') }}" class="btn-return">Voltar</a>
    </section>
</x-app-layout>