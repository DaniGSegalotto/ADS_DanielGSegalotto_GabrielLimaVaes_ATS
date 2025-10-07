<x-app-layout>
    <!-- Cabeçalho da página -->
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/clientes/showVeiculos.css') }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes do Veículo') }}
        </h2>
    </x-slot>

    <!-- Seção de detalhes do veículo -->
    <section class="veiculo-details">
        <div class="veiculo-content">
            <!-- ID -->
            <div class="veiculo-meta">
                <span class="veiculo-label">ID:</span>
                <span class="veiculo-info">{{ $veiculo->id }}</span>
            </div>

            <!-- Modelo -->
            <div class="veiculo-meta">
                <span class="veiculo-label">Modelo:</span>
                <span class="veiculo-info">{{ $veiculo->modelo }}</span>
            </div>

            <!-- Marca -->
            <div class="veiculo-meta">
                <span class="veiculo-label">Marca:</span>
                <span class="veiculo-info">{{ $veiculo->marca->descricao ?? '—' }}</span>
            </div>

            <!-- Ano -->
            <div class="veiculo-meta">
                <span class="veiculo-label">Ano:</span>
                <span class="veiculo-info">{{ $veiculo->ano }}</span>
            </div>

            <!-- Placa -->
            <div class="veiculo-meta">
                <span class="veiculo-label">Placa:</span>
                <span class="veiculo-info">{{ $veiculo->placa }}</span>
            </div>

            <!-- Status -->
            <div class="veiculo-meta">
                <span class="veiculo-label">Status:</span>
                <span class="veiculo-info">
                    @php
                        $statusDesc = $veiculo->status?->descricao ?? 'Não definido';
                        $badgeClass = match($statusDesc) {
                            'Ativo'          => 'bg-green-500 text-white',
                            'Vendido'        => 'bg-gray-500 text-white',
                            'Indisponível'   => 'bg-yellow-600 text-white',
                            'Em manutenção'  => 'bg-red-500 text-white',
                            default          => 'bg-gray-300 text-black',
                        };
                    @endphp
                    <span class="px-2 py-1 rounded {{ $badgeClass }}">{{ $statusDesc }}</span>
                </span>
            </div>
        </div>

        <!-- Botão de retorno -->
        <a href="{{ route('veiculos.index') }}" class="btn-return">Voltar</a>
    </section>
</x-app-layout>
