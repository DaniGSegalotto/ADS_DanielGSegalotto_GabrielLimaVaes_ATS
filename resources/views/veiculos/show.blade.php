<x-app-layout>
    <!-- Cabeçalho da página -->
    <x-slot name="header">
        <!-- Título da página -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>
    <!-- Seção de detalhes do cliente -->
    <section class="cliente-details">
        <div class="cliente-content">
            <!-- Meta informações do cliente -->
            <div class="cliente-meta">
                <!-- Rótulo "ID" -->
                <span class="cliente-label">ID:</span>
                <!-- Informação do ID do cliente -->
                <span class="cliente-info">{{ $cliente->id }}</span>
            </div>
            <!-- Meta informações do cliente -->
            <div class="cliente-meta">
                <!-- Rótulo "Nome" -->
                <span class="cliente-label">Nome:</span>
                <!-- Informação do nome do cliente -->
                <span class="cliente-info">{{ $cliente->nome }}</span>
            </div>
            <!-- Meta informações do cliente -->
            <div class="cliente-meta">
                <!-- Rótulo "Telefone" -->
                <span class="cliente-label">Telefone:</span>
                <!-- Informação do telefone do cliente -->
                <span class="cliente-info">{{ $cliente->telefone }}</span>
            </div>
            <!-- Meta informações do cliente -->
            <div class="cliente-meta">
                <!-- Rótulo "CPF" -->
                <span class="cliente-label">CPF:</span>
                <!-- Informação do CPF do cliente -->
                <span class="cliente-info">{{ $cliente->CPF }}</span>
            </div>
            <!-- Meta informações do cliente -->
            <div class="cliente-meta">
                <!-- Rótulo "CNH" -->
                <span class="cliente-label">CNH:</span>
                <!-- Informação da CNH do cliente -->
                <span class="cliente-info">{{ $cliente->CHN }}</span>
            </div>
            <!-- Meta informações do cliente -->
            <div class="cliente-meta">
                <!-- Rótulo "E-MAIL" -->
                <span class="cliente-label">E-MAIL:</span>
                <!-- Informação do e-mail do cliente -->
                <span class="cliente-info">{{ $cliente->email }}</span>
            </div>
        </div>
        <!-- Botão de retorno para a página de índice de clientes -->
        <a href="{{ route('clientes.index') }}" class="btn-return">Voltar</a>
    </section>
</x-app-layout>
