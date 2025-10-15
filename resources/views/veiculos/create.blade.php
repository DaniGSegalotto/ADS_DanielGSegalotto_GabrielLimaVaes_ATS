<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Cadastrar Novo Veículo') }}
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
        <h3 style="font-size:20px; margin-bottom:16px;">Informações do Veículo</h3>

        <form id="formNovoVeiculo" action="{{ route('veiculos.store') }}" method="POST"
              style="display:flex; flex-direction:column; gap:16px;">
            @csrf

            <div>
                <label for="modelo">Modelo:</label><br>
                <input type="text" name="modelo" id="modelo" value="{{ old('modelo') }}" placeholder="Ex: Strada 1.4">
            </div>

            <div>
                <label for="categoria">Categoria:</label><br>
                <input type="text" name="categoria" id="categoria" value="{{ old('categoria') }}" placeholder="Ex: Utilitário">
            </div>

            <div>
                <label for="placa">Placa:</label><br>
                <input type="text" name="placa" id="placa" value="{{ old('placa') }}" placeholder="Ex: ABC-1234">
            </div>

            <div>
                <label for="ano">Ano:</label><br>
                <input type="number" name="ano" id="ano" value="{{ old('ano') }}" placeholder="Ex: 2020">
            </div>

            <div>
                <label for="marca_id">Marca:</label><br>
                <select name="marca_id" id="marca_id" required>
                    <option value="">Selecione uma marca</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>
                            {{ $marca->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status_id">Status:</label><br>
                <select name="status_id" id="status_id" required>
                    <option value="">Selecione um status</option>
                    @foreach($statuses as $statusItem)
                        <option value="{{ $statusItem->id }}" {{ old('status_id') == $statusItem->id ? 'selected' : '' }}>
                            {{ $statusItem->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit">Salvar</button>
                <a href="{{ route('veiculos.index') }}" class="btn" style="background:#666;">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- 🔹 Script de Validação -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('formNovoVeiculo');

            form.addEventListener('submit', (event) => {
                let valid = true;
                clearErrors();

                const modelo = document.getElementById('modelo').value.trim();
                if (!modelo) { showError('modelo', 'Informe o modelo.'); valid = false; }

                const categoria = document.getElementById('categoria').value.trim();
                if (!categoria) { showError('categoria', 'Informe a categoria.'); valid = false; }

                const placa = document.getElementById('placa').value.trim();
                if (!placa) { showError('placa', 'Informe a placa.'); valid = false; }

                const ano = document.getElementById('ano').value.trim();
                if (!/^\d{4}$/.test(ano)) { showError('ano', 'Ano inválido (formato AAAA).'); valid = false; }

                const marca = document.getElementById('marca_id').value.trim();
                if (!marca) { showError('marca_id', 'Selecione uma marca.'); valid = false; }

                const status = document.getElementById('status_id').value.trim();
                if (!status) { showError('status_id', 'Selecione um status.'); valid = false; }

                if (!valid) event.preventDefault();
            });

            function showError(field, message) {
                const el = document.getElementById(field);
                if (el) el.style.border = "1px solid #f44336";
                alert(message);
            }

            function clearErrors() {
                document.querySelectorAll('input, select').forEach(el => el.style.border = '');
            }
        });
    </script>
</x-app-layout>
