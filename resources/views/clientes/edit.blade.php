<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <!-- 🔹 Mensagem de sucesso (caso venha do controller) -->
    @if(session('success'))
        <div style="
            background: rgba(119, 255, 168, .16);
            border: 1px solid rgba(119, 255, 168, .45);
            color: #c9ffd9;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 15px;
        ">
            <strong>Sucesso!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- 🔹 Formulário de edição -->
    <div class="card" style="max-width: 800px; margin: auto;">
        <h3 style="font-size:20px; margin-bottom:16px;">Editar informações do cliente</h3>

        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" 
              style="display:flex; flex-direction:column; gap:16px;">
            @csrf
            @method('PUT')

            <div>
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" id="nome" value="{{ $cliente->nome }}" required>
            </div>

            <div>
                <label for="telefone">Telefone:</label><br>
                <input type="text" name="telefone" id="telefone" value="{{ $cliente->telefone }}" required>
            </div>

            <div>
                <label for="CPF">CPF:</label><br>
                <input type="text" name="CPF" id="CPF" value="{{ $cliente->CPF }}" required>
            </div>

            <div>
                <label for="CHN">CNH:</label><br>
                <input type="text" name="CHN" id="CHN" value="{{ $cliente->CHN }}" required>
            </div>

            <div>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" value="{{ $cliente->email }}" required>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit">Salvar Alterações</button>
                <a href="{{ route('clientes.index') }}" class="btn" style="background:#666;">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- 🔹 Script opcional: Validação leve -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            form.addEventListener('submit', e => {
                const cpf = document.getElementById('CPF').value.trim();
                if (!/^\d{11}$/.test(cpf)) {
                    alert('CPF inválido. Use apenas números (11 dígitos).');
                    e.preventDefault();
                }
            });
        });
    </script>
</x-app-layout>
