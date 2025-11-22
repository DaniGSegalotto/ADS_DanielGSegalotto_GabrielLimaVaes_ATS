<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 style="font-size:24px; font-weight:600; color:#222;">
            Detalhes do Veículo
        </h2>
    </x-slot>

    <!-- Container principal -->
    <div style="
        max-width:750px;
        margin:40px auto;
        background:#ffffff;
        padding:32px;
        border-radius:18px;
        border:1px solid #e4e4e4;
        box-shadow:0 8px 22px rgba(0,0,0,0.06);
    ">

        <h3 style="font-size:20px; font-weight:600; color:#222; margin-bottom:22px;">
            Informações do Veículo
        </h3>

        <!-- GRID -->
        <div style="
            display:grid;
            grid-template-columns:160px auto;
            row-gap:14px;
            column-gap:8px;
            font-size:15px;
            color:#333;
        ">

            <span style="font-weight:600; color:#ff7a00;">ID:</span>
            <span>{{ $veiculo->id }}</span>

            <span style="font-weight:600; color:#ff7a00;">Modelo:</span>
            <span>{{ $veiculo->modelo }}</span>

            <span style="font-weight:600; color:#ff7a00;">Categoria:</span>
            <span>{{ $veiculo->categoria }}</span>

            <span style="font-weight:600; color:#ff7a00;">Marca:</span>
            <span>{{ $veiculo->marca->descricao ?? '—' }}</span>

            <span style="font-weight:600; color:#ff7a00;">Ano:</span>
            <span>{{ $veiculo->ano }}</span>

            <span style="font-weight:600; color:#ff7a00;">Placa:</span>
            <span>{{ $veiculo->placa }}</span>

            <!-- STATUS -->
            <span style="font-weight:600; color:#ff7a00;">Status:</span>

            @php
                /** 
                 * STATUS BOOLEANO:
                 * 1 = Disponível
                 * 0 = Indisponível
                 */
                $disponivel = (int) $veiculo->status === 1;

                $cor   = $disponivel ? '#00c853' : '#e53935';
                $texto = $disponivel ? 'Disponível' : 'Indisponível';
            @endphp

            <span style="
                background:{{ $cor }}22;
                border:1px solid {{ $cor }}99;
                color:{{ $cor }};
                padding:6px 14px;
                border-radius:8px;
                font-weight:600;
                display:inline-block;
                width:max-content;
            ">
                {{ $texto }}
            </span>

        </div>

        <!-- Botão voltar -->
        <div style="margin-top:32px; text-align:right;">
            <a href="{{ route('veiculos.index') }}"
               style="
                    padding:12px 20px;
                    background:linear-gradient(90deg,#ff6a00,#ff9500);
                    color:#fff;
                    border-radius:10px;
                    font-weight:600;
                    text-decoration:none;
               "
               onmouseover="this.style.opacity='0.85'"
               onmouseout="this.style.opacity='1'">
                Voltar
            </a>
        </div>

    </div>

</x-app-layout>
