<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Criar Cliente') }}
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
        ">
            <strong>Sucesso!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- 🔹 Formulário -->
    <div class="card" style="max-width: 800px; margin: auto;">
        <form id="formNovoCliente" action="{{ route('clientes.store') }}" method="POST"
              style="display:flex; flex-direction:column; gap:16px;">
            @csrf

            <div>
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome completo" required>
                <div id="error-nome" class="error-message" style="color:#ffbaba; font-size:13px;"></div>
            </div>

            <div>
                <label for="telefone">Telefone:</label><br>
                <input type="tel" name="telefone" id="telefone" placeholder="Apenas números" required>
                <div id="error-telefone" class="error-message" style="color:#ffbaba; font-size:13px;"></div>
            </div>

            <div>
                <label for="CPF">CPF:</label><br>
                <input type="text" name="CPF" id="CPF" placeholder="Somente números" required>
                <div id="error-CPF" class="error-message" style="color:#ffbaba; font-size:13px;"></div>
            </div>

            <div>
                <label for="CHN">CNH:</label><br>
                <input type="text" name="CHN" id="CHN" placeholder="Número da CNH" required>
                <div id="error-CHN" class="error-message" style="color:#ffbaba; font-size:13px;"></div>
            </div>

            <div>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" placeholder="email@exemplo.com" required>
                <div id="error-email" class="error-message" style="color:#ffbaba; font-size:13px;"></div>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit">Salvar</button>
                <a href="{{ route('clientes.index') }}" class="btn" style="background:#666;">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- 🔹 Script de validação -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('formNovoCliente');

            form.addEventListener('submit', function (event) {
                clearErrors();
                let valid = true;

                const nome = document.getElementById('nome').value.trim();
                if (nome === '') {
                    showError('nome', 'Por favor, insira o nome.');
                    valid = false;
                }

                const telefone = document.getElementById('telefone').value.trim();
                if (!validatePhone(telefone)) {
                    showError('telefone', 'Telefone inválido. Use 10 ou 11 dígitos.');
                    valid = false;
                }

                const CPF = document.getElementById('CPF').value.trim();
                if (!validateCPF(CPF)) {
                    showError('CPF', 'CPF inválido. Use 11 dígitos numéricos.');
                    valid = false;
                }

                const email = document.getElementById('email').value.trim();
                if (email === '') {
                    showError('email', 'Por favor, insira o email.');
                    valid = false;
                }

                if (!valid) event.preventDefault();
            });

            function showError(field, message) {
                document.getElementById(`error-${field}`).textContent = message;
            }

            function clearErrors() {
                document.querySelectorAll('.error-message').forEach(e => e.textContent = '');
            }

            function validatePhone(phone) {
                return /^\d{10,11}$/.test(phone);
            }

            function validateCPF(cpf) {
                return /^\d{11}$/.test(cpf);
            }
        });
    </script>
</x-app-layout>
