<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            Detalhes do Agendamento
        </h2>
    </x-slot>

    <!-- Container principal -->
    <div style="
        max-width:700px;
        margin:40px auto;
        background:#ffffff;
        padding:28px;
        border-radius:16px;
        border:1px solid #e6e6e6;
        box-shadow:0 6px 18px rgba(0,0,0,0.06);
        color:#333;
    ">

        <h3 style="font-size:20px; margin-bottom:18px; font-weight:600;">
            Informações do Agendamento
        </h3>

        <div style="display:flex; flex-direction:column; gap:14px; font-size:15px;">

            <!-- Linha -->
            <div style="display:flex; justify-content:space-between; border-bottom:1px solid #eee; padding-bottom:6px;">
                <strong>ID:</strong>
                <span>{{ $agendamento->id }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid #eee; padding-bottom:6px;">
                <strong>Data:</strong>
                <span>{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid #eee; padding-bottom:6px;">
                <strong>Horário:</strong>
                <span>{{ $agendamento->horario }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid #eee; padding-bottom:6px;">
                <strong>Funcionário:</strong>
                <span>{{ $agendamento->funcionario->nome }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid #eee; padding-bottom:6px;">
                <strong>Veículo:</strong>
                <span>{{ $agendamento->veiculo->modelo }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid #eee; padding-bottom:6px;">
                <strong>Cliente:</strong>
                <span>{{ $agendamento->cliente->nome }}</span>
            </div>
        </div>

        <!-- Botão Voltar -->
        <div style="text-align:center; margin-top:26px;">
            <a href="{{ route('agendamentos.index') }}"
                style="
                    padding:10px 20px;
                    background:#ff7a00;
                    color:white;
                    border-radius:8px;
                    font-size:14px;
                    font-weight:600;
                    text-decoration:none;
                "
                onmouseover="this.style.background='#ff8f2b'"
                onmouseout="this.style.background='#ff7a00'">
                Voltar
            </a>
        </div>

    </div>

</x-app-layout>
