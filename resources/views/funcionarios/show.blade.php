<x-app-layout>
    <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('css/clientes/showFuncionario.css') }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes do Funcionário
        </h2>
    </x-slot>
    <div class="container">
        <div class="funcionario-details">
            <div class="funcionario-content">
                <div class="funcionario-meta">
                    <span class="funcionario-label">ID:</span>
                    <span class="funcionario-info">{{ $funcionario->id }}</span>
                </div>
                <div class="funcionario-meta">
                    <span class="funcionario-label">Nome:</span>
                    <span class="funcionario-info">{{ $funcionario->nome }}</span>
                </div>
                <div class="funcionario-meta">
                    <span class="funcionario-label">Email:</span>
                    <span class="funcionario-info">{{ $funcionario->email }}</span>
                </div>
                <div class="funcionario-meta">
                    <span class="funcionario-label">Sexo:</span>
                    <span class="funcionario-info">{{ $funcionario->sexo }}</span>
                </div>
                <!-- Adicione outros campos conforme necessário -->
            </div>
            <a href="{{ route('funcionarios.index') }}" class="btn-return">Voltar</a>
        </div>
    </div>
</x-app-layout>
