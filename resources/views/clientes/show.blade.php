<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/show.css') }}">
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>
    <section class="cliente-details">
      <div class="cliente-content">
        <div class="cliente-meta">
          <span class="cliente-label">ID:</span>
          <span class="cliente-info">{{ $cliente->id }}</span>
        </div>
        <div class="cliente-meta">
          <span class="cliente-label">Nome:</span>
          <span class="cliente-info">{{ $cliente->nome }}</span>
        </div>
        <div class="cliente-meta">
          <span class="cliente-label">Telefone:</span>
          <span class="cliente-info">{{ $cliente->telefone }}</span>
        </div>
        <div class="cliente-meta">
          <span class="cliente-label">CPF:</span>
          <span class="cliente-info">{{ $cliente->CPF }}</span>
        </div>
        <div class="cliente-meta">
          <span class="cliente-label">CNH:</span>
          <span class="cliente-info">{{ $cliente->CHN }}</span>
        </div>
        <div class="cliente-meta">
          <span class="cliente-label">E-MAIL:</span>
          <span class="cliente-info">{{ $cliente->email }}</span>
        </div>
      </div>
      <a href="{{ route('clientes.index') }}" class="btn-return">Voltar</a>
    </section>
  </x-app-layout>
