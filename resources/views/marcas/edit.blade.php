<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Editar Marca') }}
        </h2>
    </x-slot>

    <!-- 🔹 Container do Formulário -->
    <div class="card" style="max-width:700px; margin:auto;">
        <h3 style="font-size:20px; margin-bottom:16px;">Alterar Informações da Marca</h3>

        <form action="{{ route('marcas.update', $marca->id) }}" method="POST" 
              style="display:flex; flex-direction:column; gap:16px;">
            @csrf
            @method('PUT')

            <div>
                <label for="descricao">Nome da Marca:</label><br>
                <input type="text" name="descricao" id="descricao" 
                       value="{{ $marca->descricao }}" required 
                       placeholder="Digite o nome da marca">
            </div>

            <div>
                <label for="observacao">Observação:</label><br>
                <input type="text" name="observacao" id="observacao" 
                       value="{{ $marca->observacao }}" 
                       placeholder="Adicione uma observação (opcional)">
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit">Salvar Alterações</button>
                <a href="{{ route('marcas.index') }}" class="btn" style="background:#666;">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
