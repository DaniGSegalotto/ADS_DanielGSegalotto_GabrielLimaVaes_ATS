<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Detalhes do Cliente') }}
        </h2>
    </x-slot>

    <!-- 🔹 Container -->
    <div class="card" style="max-width: 600px; margin: auto;">

        <h3 style="font-size:20px; margin-bottom:20px;">Informações do Cliente</h3>

        <div style="display:flex; flex-direction:column; gap:12px;">
            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.15); padding-bottom:6px;">
                <span style="color:#ffb84d;">ID:</span>
                <span style="color:#fff;">{{ $cliente->id }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.15); padding-bottom:6px;">
                <span style="color:#ffb84d;">Nome:</span>
                <span style="color:#fff;">{{ $cliente->nome }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.15); padding-bottom:6px;">
                <span style="color:#ffb84d;">Telefone:</span>
                <span style="color:#fff;">{{ $cliente->telefone }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.15); padding-bottom:6px;">
                <span style="color:#ffb84d;">CPF:</span>
                <span style="color:#fff;">{{ $cliente->CPF }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.15); padding-bottom:6px;">
                <span style="color:#ffb84d;">CNH:</span>
                <span style="color:#fff;">{{ $cliente->CHN }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.15); padding-bottom:6px;">
                <span style="color:#ffb84d;">E-mail:</span>
                <span style="color:#fff;">{{ $cliente->email }}</span>
            </div>
        </div>

        <!-- 🔸 Botão Voltar -->
        <div style="margin-top:24px; text-align:right;">
            <a href="{{ route('clientes.index') }}"
               style="padding:10px 16px; border-radius:12px;
                      background:linear-gradient(90deg, #ff512f, #f09819);
                      color:#fff; font-weight:600; text-decoration:none;">
                Voltar
            </a>
        </div>
    </div>
</x-app-layout>
