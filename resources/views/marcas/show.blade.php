<x-app-layout>
    <!-- Define o cabeçalho da página -->
    <head>
        <!-- Importa um arquivo CSS específico para estilização de detalhes de marcas -->
        <link rel="stylesheet" href="{{ asset('css/clientes/showMarcas.css') }}">
    </head>
    <!-- Define o conteúdo do cabeçalho -->
    <x-slot name="header">
        <!-- Título da página -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <!-- Exibe o título da página traduzido usando o helper de tradução '__' -->
            {{ __('Detalhes da Marca') }}
        </h2>
    </x-slot>
    <!-- Seção para exibir os detalhes da marca -->
    <section class="marca-details">
      <div class="marca-content">
        <!-- Meta informações da marca -->
        <div class="marca-meta">
          <span class="marca-label">ID:</span>
          <!-- Exibe o ID da marca -->
          <span class="marca-info">{{ $marca->id }}</span>
        </div>
        <div class="marca-meta">
          <span class="marca-label">Descrição:</span>
          <!-- Exibe a descrição da marca -->
          <span class="marca-info">{{ $marca->descricao }}</span>
        </div>
        <div class="marca-meta">
          <span class="marca-label">Observação:</span>
          <!-- Exibe a observação da marca -->
          <span class="marca-info">{{ $marca->observacao }}</span>
        </div>
      </div>
      <!-- Link para voltar à página de índice de marcas -->
      <a href="{{ route('marcas.index') }}" class="btn-return">Voltar</a>
    </section>
</x-app-layout>
