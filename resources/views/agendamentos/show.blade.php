<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Detalhes do Agendamento') }}
        </h2>
    </x-slot>

    <!-- 🔹 Conteúdo -->
    <div class="card" style="max-width:700px; margin:auto; text-align:left;">
        <h3 style="font-size:20px; margin-bottom:16px;">Informações do Agendamento</h3>

        <div style="display:flex; flex-direction:column; gap:10px;">
            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.1); padding-bottom:4px;">
                <span><strong>ID:</strong></span>
                <span>{{ $agendamento->id }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.1); padding-bottom:4px;">
                <span><strong>Data:</strong></span>
                <span>{{ $agendamento->data }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.1); padding-bottom:4px;">
                <span><strong>Horário:</strong></span>
                <span>{{ $agendamento->horario }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.1); padding-bottom:4px;">
                <span><strong>Funcionário:</strong></span>
                <span>{{ $agendamento->funcionario->nome }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.1); padding-bottom:4px;">
                <span><strong>Veículo:</strong></span>
                <span>{{ $agendamento->veiculo->modelo }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.1); padding-bottom:4px;">
                <span><strong>Cliente:</strong></span>
                <span>{{ $agendamento->cliente->nome }}</span>
            </div>
        </div>

        <div style="text-align:center; margin-top:24px;">
            <a href="{{ route('agendamentos.index') }}" class="btn" style="background:#666;">Voltar</a>
        </div>
    </div>
</x-app-layout>
