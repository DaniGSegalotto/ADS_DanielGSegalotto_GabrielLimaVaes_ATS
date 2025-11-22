<x-app-layout>

    {{-- Cabeçalho da página --}}
    <x-slot name="header">
        <h2 style="font-size: 26px; font-weight: 600; color: #333;">
            Detalhes do Cliente
        </h2>
    </x-slot>

    {{-- Container principal --}}
    <div style="
        max-width: 700px;
        margin: 40px auto;
        background: #ffffff;
        border: 1px solid #e4e4e4;
        padding: 32px;
        border-radius: 18px;
        box-shadow: 0 8px 22px rgba(0,0,0,0.06);
    ">

        {{-- Título interno --}}
        <h3 style="
            font-size: 20px;
            font-weight: 600;
            color: #222;
            margin-bottom: 25px;
        ">
            Informações do Cliente
        </h3>

        {{-- GRID DE INFORMAÇÕES — IGUAL AO DO FUNCIONÁRIO --}}
        <div style="
            display: grid;
            grid-template-columns: 150px auto;
            row-gap: 16px;
            column-gap: 10px;
            font-size: 15px;
            color: #333;
        ">

            <span style="font-weight:600; color:#ff7a00;">ID:</span>
            <span>{{ $cliente->id }}</span>

            <span style="font-weight:600; color:#ff7a00;">Nome:</span>
            <span>{{ $cliente->nome }}</span>

            <span style="font-weight:600; color:#ff7a00;">Telefone:</span>
            <span>{{ $cliente->telefone }}</span>

            <span style="font-weight:600; color:#ff7a00;">CPF:</span>
            <span>{{ $cliente->CPF }}</span>

            <span style="font-weight:600; color:#ff7a00;">CNH:</span>
            <span>{{ $cliente->CHN }}</span>

            <span style="font-weight:600; color:#ff7a00;">E-mail:</span>
            <span>{{ $cliente->email }}</span>

        </div>

        {{-- Botão voltar --}}
        <div style="margin-top: 35px; text-align: right;">
            <a href="{{ route('clientes.index') }}"
               style="
                    padding: 12px 20px;
                    background: linear-gradient(90deg, #ff6a00, #ff9500);
                    color: #fff;
                    border-radius: 10px;
                    font-weight: 600;
                    text-decoration: none;
                    font-size: 15px;
                    transition: 0.2s ease;
               "
               onmouseover="this.style.opacity='0.85'"
               onmouseout="this.style.opacity='1'">
                Voltar
            </a>
        </div>

    </div>

</x-app-layout>
