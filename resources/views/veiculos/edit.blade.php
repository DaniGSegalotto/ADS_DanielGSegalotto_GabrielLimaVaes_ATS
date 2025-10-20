<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Editar Veículo') }}
        </h2>
    </x-slot>

    <!-- 🔹 Mensagens de feedback -->
    @if(session('success'))
        <div class="card" style="background:rgba(76,175,80,0.2); border:1px solid rgba(76,175,80,0.4); color:#caffca; margin:auto; margin-bottom:20px; max-width:700px; padding:10px; border-radius:12px;">
            <strong>✔ Sucesso:</strong> {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="card" style="background:rgba(255,82,82,0.15); border:1px solid rgba(255,82,82,0.4); color:#ffbaba; margin:auto; margin-bottom:20px; max-width:700px; padding:10px; border-radius:12px;">
            <strong>⚠ Erros encontrados:</strong>
            <ul style="margin-left:15px;">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 🔹 Formulário -->
    <div class="card" style="max-width:700px; margin:auto;">
        <h3 style="font-size:20px; margin-bottom:16px;">Atualizar Informações do Veículo</h3>

        <form action="{{ route('veiculos.update', $veiculo->id) }}" method="POST"
              style="display:flex; flex-direction:column; gap:16px;">
            @csrf
            @method('PUT')

            <div>
                <label for="modelo">Modelo:</label><br>
                <input type="text" name="modelo" id="modelo" 
                       value="{{ old('modelo', $veiculo->modelo) }}" placeholder="Ex: Strada 1.4">
            </div>

            <div>
                <label for="categoria">Categoria:</label><br>
                <input type="text" name="categoria" id="categoria" 
                       value="{{ old('categoria', $veiculo->categoria) }}" placeholder="Ex: Utilitário">
            </div>

            <div>
                <label for="placa">Placa:</label><br>
                <input type="text" name="placa" id="placa" 
                       value="{{ old('placa', $veiculo->placa) }}" placeholder="Ex: ABC-1234">
            </div>

            <div>
                <label for="ano">Ano:</label><br>
                <input type="number" name="ano" id="ano" 
                       value="{{ old('ano', $veiculo->ano) }}" placeholder="Ex: 2020">
            </div>

            <div>
                <label for="marca_id">Marca:</label><br>
                <select name="marca_id" id="marca_id" required>
                    <option value="">Selecione uma marca</option>
                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ old('marca_id', $veiculo->marca_id) == $marca->id ? 'selected' : '' }}>
                            {{ $marca->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status_id">Status:</label><br>
                <select name="status_id" id="status_id" required>
                    <option value="">Selecione um status</option>
                    @foreach ($statuses as $statu)
                        <option value="{{ $statu->id }}" {{ old('status_id', $veiculo->status_id) == $statu->id ? 'selected' : '' }}>
                            {{ $statu->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit" style="background:linear-gradient(90deg,#ff512f,#f09819);
                                             color:#fff; padding:10px 16px; border:none; border-radius:10px;
                                             font-weight:600; cursor:pointer;">
                    Salvar Alterações
                </button>

                <a href="{{ route('veiculos.index') }}" 
                   style="background:#555; padding:10px 16px; border-radius:10px;
                          color:#fff; text-decoration:none; font-weight:600;">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <!-- 🔹 Validação simples no cliente -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');

            form.addEventListener('submit', (event) => {
                const ano = document.getElementById('ano').value.trim();
                if (!/^\d{4}$/.test(ano)) {
                    alert('Ano inválido. Use o formato AAAA.');
                    event.preventDefault();
                }
            });
        });
    </script>
</x-app-layout>
