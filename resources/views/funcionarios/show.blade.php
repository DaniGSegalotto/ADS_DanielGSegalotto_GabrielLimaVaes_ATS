<x-app-layout>
    <!-- Define o cabeçalho da página -->
    <x-slot name="header">
        <!-- Importa um arquivo CSS específico para estilização de detalhes do funcionário -->
        <link rel="stylesheet" href="{{ asset('css/clientes/showFuncionario.css') }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <!-- Exibe o título da página -->
            Detalhes do Funcionário
        </h2>
    </x-slot>
    <div class="container">
        <div class="funcionario-details">
            <!-- Conteúdo dos detalhes do funcionário -->
            <div class="funcionario-content">
                <!-- Meta informações do funcionário -->
                <div class="funcionario-meta">
                    <span class="funcionario-label">ID:</span>
                    <!-- Exibe o ID do funcionário -->
                    <span class="funcionario-info">{{ $funcionario->id }}</span>
                </div>
                <div class="funcionario-meta">
                    <span class="funcionario-label">Nome:</span>
                    <!-- Exibe o nome do funcionário -->
                    <span class="funcionario-info">{{ $funcionario->nome }}</span>
                </div>
                <div class="funcionario-meta">
                    <span class="funcionario-label">Email:</span>
                    <!-- Exibe o email do funcionário -->
                    <span class="funcionario-info">{{ $funcionario->email }}</span>
                </div>
                <div class="funcionario-meta">
                    <span class="funcionario-label">Sexo:</span>
                    <!-- Exibe o sexo do funcionário -->
                    <span class="funcionario-info">{{ $funcionario->sexo }}</span>
                </div>
                <!-- Adicione outros campos conforme necessário -->
            </div>
            <!-- Link para voltar à página de índice de funcionários -->
            <a href="{{ route('funcionarios.index') }}" class="btn-return">Voltar</a>
        </div>
    </div>
</x-app-layout>
