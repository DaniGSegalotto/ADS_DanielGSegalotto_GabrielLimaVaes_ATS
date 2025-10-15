<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Detalhes do Funcionário') }}
        </h2>
    </x-slot>

    <!-- 🔹 Conteúdo principal -->
    <div class="card" style="max-width: 600px; margin: auto;">

        <h3 style="font-size:20px; margin-bottom:20px;">Informações do Funcionário</h3>

        <div style="display:flex; flex-direction:column; gap:12px;">
            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.15); padding-bottom:6px;">
                <span style="color:#ffb84d;">ID:</span>
                <span style="color:#fff;">{{ $funcionario->id }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.15); padding-bottom:6px;">
                <span style="color:#ffb84d;">Nome:</span>
                <span style="color:#fff;">{{ $funcionario->nome }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.15); padding-bottom:6px;">
                <span style="color:#ffb84d;">Email:</span>
                <span style="color:#fff;">{{ $funcionario->email }}</span>
            </div>

            <div style="display:flex; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.15); padding-bottom:6px;">
                <span style="color:#ffb84d;">Sexo:</span>
                <span style="color:#fff;">
                    {{ $funcionario->sexo == 'M' ? 'Masculino' : 'Feminino' }}
                </span>
            </div>
        </div>

        <!-- 🔸 Botão Voltar -->
        <div style="margin-top:24px; text-align:right;">
            <a href="{{ route('funcionarios.index') }}"
               style="padding:10px 16px; border-radius:12px;
                      background:linear-gradient(90deg, #ff512f, #f09819);
                      color:#fff; font-weight:600; text-decoration:none;">
                Voltar
            </a>
        </div>
    </div>
</x-app-layout>
