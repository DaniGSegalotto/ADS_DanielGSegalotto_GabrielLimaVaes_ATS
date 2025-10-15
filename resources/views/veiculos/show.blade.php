<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Detalhes do Veículo') }}
        </h2>
    </x-slot>

    <!-- 🔹 Conteúdo -->
    <div class="card" style="max-width:750px; margin:auto; text-align:left;">
        <h3 style="font-size:20px; margin-bottom:16px;">Informações do Veículo</h3>

        <div style="display:flex; flex-direction:column; gap:12px;">
            <div>
                <span style="color:#ffb84d; font-weight:600;">ID:</span><br>
                <span style="color:#fff;">{{ $veiculo->id }}</span>
            </div>

            <div>
                <span style="color:#ffb84d; font-weight:600;">Modelo:</span><br>
                <span style="color:#fff;">{{ $veiculo->modelo }}</span>
            </div>

            <div>
                <span style="color:#ffb84d; font-weight:600;">Categoria:</span><br>
                <span style="color:#fff;">{{ $veiculo->categoria }}</span>
            </div>

            <div>
                <span style="color:#ffb84d; font-weight:600;">Marca:</span><br>
                <span style="color:#fff;">{{ $veiculo->marca->descricao ?? '—' }}</span>
            </div>

            <div>
                <span style="color:#ffb84d; font-weight:600;">Ano:</span><br>
                <span style="color:#fff;">{{ $veiculo->ano }}</span>
            </div>

            <div>
                <span style="color:#ffb84d; font-weight:600;">Placa:</span><br>
                <span style="color:#fff;">{{ $veiculo->placa }}</span>
            </div>

            <div>
                <span style="color:#ffb84d; font-weight:600;">Status:</span><br>
                @php
                    $statusDesc = $veiculo->status?->descricao ?? 'Não definido';
                    $badgeColor = match($statusDesc) {
                        'Ativo'          => '#00e676',
                        'Vendido'        => '#ffa000',
                        'Indisponível'   => '#e53935',
                        'Em manutenção'  => '#29b6f6',
                        default          => '#bdbdbd',
                    };
                @endphp
                <span style="background:{{ $badgeColor }}33; border:1px solid {{ $badgeColor }}99;
                             color:{{ $badgeColor }}; padding:4px 10px; border-radius:8px; font-weight:600;">
                    {{ $statusDesc }}
                </span>
            </div>
        </div>

        <!-- 🔸 Botão de retorno -->
        <div style="margin-top:24px; text-align:right;">
            <a href="{{ route('veiculos.index') }}" 
               style="background:linear-gradient(90deg,#ff512f,#f09819);
                      padding:10px 18px; border-radius:12px; color:#fff; text-decoration:none; font-weight:600;">
                Voltar
            </a>
        </div>
    </div>
</x-app-layout>
