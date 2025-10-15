<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Cadastrar Marca') }}
        </h2>
    </x-slot>

    <!-- 🔹 Mensagem de sucesso -->
    @if(session('success'))
        <div style="
            background: rgba(119, 255, 168, .16);
            border: 1px solid rgba(119, 255, 168, .45);
            color: #c9ffd9;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        ">
            <strong>Sucesso!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- 🔹 Formulário -->
    <div class="card" style="max-width: 700px; margin: auto;">
        <h3 style="font-size:20px; margin-bottom:16px;">Nova Marca</h3>

        <form action="{{ route('marcas.store') }}" method="POST" 
              style="display:flex; flex-direction:column; gap:16px;">
            @csrf

            <div>
                <label for="descricao">Nome da Marca:</label><br>
                <input type="text" name="descricao" id="descricao" placeholder="Ex: Chevrolet, Ford..." required>
            </div>

            <div>
                <label for="observacao">Observação:</label><br>
                <input type="text" name="observacao" id="observacao" placeholder="Ex: Modelos mais populares, origem, etc.">
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit">Salvar</button>
                <a href="{{ route('marcas.index') }}" class="btn" style="background:#666;">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
