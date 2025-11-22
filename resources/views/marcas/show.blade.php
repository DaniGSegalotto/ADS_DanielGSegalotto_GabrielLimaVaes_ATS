<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            Detalhes da Marca
        </h2>
    </x-slot>

    <!-- Card principal -->
    <div style="
        max-width: 750px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e6e6e6;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        padding: 32px;
        color: #333;
    ">

        <!-- Título interno -->
        <h3 style="font-size: 22px; font-weight: 600; margin-bottom: 22px;">
            Informações da Marca
        </h3>

        <!-- Grid de informações -->
        <div style="
            display: grid;
            grid-template-columns: 180px auto;
            row-gap: 14px;
            column-gap: 10px;
            font-size: 15px;
        ">

            <span style="font-weight:600; color:#ff7a00;">ID:</span>
            <span>{{ $marca->id }}</span>

            <span style="font-weight:600; color:#ff7a00;">Descrição:</span>
            <span>{{ $marca->descricao }}</span>

            <span style="font-weight:600; color:#ff7a00;">Observação:</span>
            <span>{{ $marca->observacao ?? '—' }}</span>

        </div>

        <!-- Botão Voltar -->
        <div style="margin-top: 35px; text-align: right;">
            <a href="{{ route('marcas.index') }}"
               style="
                    padding: 12px 20px;
                    background: linear-gradient(90deg, #ff6a00, #ff9500);
                    color: #fff;
                    border-radius: 10px;
                    font-weight: 600;
                    text-decoration: none;
                    transition: .2s;
               "
               onmouseover="this.style.opacity='0.85'"
               onmouseout="this.style.opacity='1'">
                Voltar
            </a>
        </div>

    </div>

</x-app-layout>
