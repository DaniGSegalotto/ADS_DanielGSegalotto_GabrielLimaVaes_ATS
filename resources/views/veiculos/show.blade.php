<x-app-layout>
    <!-- Cabeçalho da página -->
    <x-slot name="header">
        <!-- Importa um arquivo CSS específico para estilização de detalhes do agendamento -->
        <link rel="stylesheet" href="{{ asset('css/clientes/showVeiculos.css') }}">
        <!-- Título da página -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes do Veiculo') }}
        </h2>
    </x-slot>
    <!-- Seção de detalhes do veículo -->
    <section class="veiculo-details">
        <div class="veiculo-content">
            <!-- Meta informações do veículo -->
            <div class="veiculo-meta">
                <!-- Rótulo "ID" -->
                <span class="veiculo-label">ID:</span>
                <!-- Informação do ID do veículo -->
                <span class="veiculo-info">{{ $veiculo->id }}</span>
            </div>
            <!-- Meta informações do veículo -->
            <div class="veiculo-meta">
                <!-- Rótulo "Modelo" -->
                <span class="veiculo-label">Modelo:</span>
                <!-- Informação do modelo do veículo -->
                <span class="veiculo-info">{{ $veiculo->modelo }}</span>
            </div>
            <!-- Meta informações do veículo -->
            <div class="veiculo-meta">
                <!-- Rótulo "Marca" -->
                <span class="veiculo-label">Marca:</span>
                <!-- Informação da marca do veículo -->
                <span class="veiculo-info">{{ $veiculo->marca->descricao }}</span>
            </div>
            <!-- Meta informações do veículo -->
            <div class="veiculo-meta">
                <!-- Rótulo "Ano" -->
                <span class="veiculo-label">Ano:</span>
                <!-- Informação do ano do veículo -->
                <span class="veiculo-info">{{ $veiculo->ano }}</span>
            </div>
            <!-- Meta informações do veículo -->
            <div class="veiculo-meta">
                <!-- Rótulo "Placa" -->
                <span class="veiculo-label">Placa:</span>
                <!-- Informação da placa do veículo -->
                <span class="veiculo-info">{{ $veiculo->placa }}</span>
            </div>
            <!-- Meta informações do veículo -->
        </div>
        <!-- Botão de retorno para a página de índice de veículos -->
        <a href="{{ route('veiculos.index') }}" class="btn-return">Voltar</a>
    </section>
</x-app-layout>