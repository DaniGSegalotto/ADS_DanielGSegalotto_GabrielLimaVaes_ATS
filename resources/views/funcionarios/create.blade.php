<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Cadastrar Funcionário') }}
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
        <h3 style="font-size:20px; margin-bottom:16px;">Novo Funcionário</h3>

        <form id="formNovoFuncionario" action="{{ route('funcionarios.store') }}" method="POST" 
              style="display:flex; flex-direction:column; gap:16px;">
            @csrf

            <div>
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome completo" required>
                <div id="error-nome" style="color:#ffb3b3; font-size:13px; margin-top:4px;"></div>
            </div>

            <div>
                <label for="email">E-mail:</label><br>
                <input type="email" name="email" id="email" placeholder="exemplo@email.com" required>
                <div id="error-email" style="color:#ffb3b3; font-size:13px; margin-top:4px;"></div>
            </div>

            <div>
                <label for="sexo">Sexo:</label><br>
                <select name="sexo" id="sexo" required>
                    <option value="" disabled selected>Selecione o sexo</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                </select>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit">Salvar</button>
                <a href="{{ route('funcionarios.index') }}" class="btn" style="background:#666;">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- 🔹 Script de validação -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('formNovoFuncionario');

            form.addEventListener('submit', (event) => {
                clearErrors();
                let valid = true;

                const nome = document.getElementById('nome').value.trim();
                if (nome === '') {
                    showError('nome', 'Por favor, insira o nome.');
                    valid = false;
                }

                const email = document.getElementById('email').value.trim();
                if (!validateEmail(email)) {
                    showError('email', 'Por favor, insira um e-mail válido.');
                    valid = false;
                }

                if (!valid) event.preventDefault();
            });

            function showError(field, message) {
                const errorDiv = document.getElementById(`error-${field}`);
                if (errorDiv) errorDiv.textContent = message;
            }

            function clearErrors() {
                document.querySelectorAll('[id^="error-"]').forEach(el => el.textContent = '');
            }

            function validateEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }
        });
    </script>
</x-app-layout>
