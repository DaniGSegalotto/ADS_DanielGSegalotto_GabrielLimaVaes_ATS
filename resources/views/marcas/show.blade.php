<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/showMarcas.css') }}">
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Marcas') }}
        </h2>
    </x-slot>
    <section class="marca-details">
      <div class="marca-content">
        <div class="marca-meta">
          <span class="marca-label">ID:</span>
          <span class="marca-info">{{ $marca->id }}</span>
        </div>
        <div class="marca-meta">
          <span class="marca-label">Descrição:</span>
          <span class="marca-info">{{ $marca->descricao }}</span>
        </div>
        <div class="marca-meta">
          <span class="marca-label">Observação:</span>
          <span class="marca-info">{{ $marca->observacao }}</span>
        </div>

      </div>

      <a href="{{ route('marcas.index') }}" class="btn-return">Voltar</a>
    </section>
  </x-app-layout>
