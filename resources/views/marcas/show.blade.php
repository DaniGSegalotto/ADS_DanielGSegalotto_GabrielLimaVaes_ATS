<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Detalhes da Marca') }}
        </h2>
    </x-slot>

    <!-- 🔹 Conteúdo -->
    <div class="card" style="max-width:700px; margin:auto; text-align:left;">
        <h3 style="font-size:20px; margin-bottom:16px;">Informações da Marca</h3>

        <div style="display:flex; flex-direction:column; gap:12px;">
            <div>
                <span style="color:#ffb84d; font-weight:600;">ID:</span><br>
                <span style="color:#fff;">{{ $marca->id }}</span>
            </div>

            <div>
                <span style="color:#ffb84d; font-weight:600;">Descrição:</span><br>
                <span style="color:#fff;">{{ $marca->descricao }}</span>
            </div>

            <div>
                <span style="color:#ffb84d; font-weight:600;">Observação:</span><br>
                <span style="color:#fff;">{{ $marca->observacao ?? '—' }}</span>
            </div>
        </div>

        <!-- 🔸 Botão Voltar -->
        <div style="margin-top:24px; text-align:right;">
            <a href="{{ route('marcas.index') }}" 
               style="background:linear-gradient(90deg,#ff512f,#f09819);
                      padding:10px 18px; border-radius:12px; color:#fff; text-decoration:none; font-weight:600;">
                Voltar
            </a>
        </div>
    </div>
</x-app-layout>
