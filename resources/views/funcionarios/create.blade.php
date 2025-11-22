<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            Cadastrar Funcionário
        </h2>
    </x-slot>

    <!-- Card principal -->
    <div style="
        max-width: 700px;
        margin: 40px auto;
        background: #ffffff;
        border: 1px solid #e4e4e4;
        padding: 32px;
        border-radius: 18px;
        box-shadow: 0 8px 22px rgba(0,0,0,0.06);
    ">

        <h3 style="
            font-size: 20px;
            font-weight: 600;
            color: #222;
            margin-bottom: 25px;
        ">
            Novo Funcionário
        </h3>

        <form id="formNovoFuncionario" action="{{ route('funcionarios.store') }}" method="POST"
              style="display:flex; flex-direction:column; gap:20px;">
            @csrf

            <!-- Nome -->
            <div>
                <label style="font-weight:600; color:#ff7a00;">Nome:</label><br>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome completo" required
                       style="
                            width:100%;
                            padding:12px 14px;
                            border:1px solid #d0d0d0;
                            border-radius:10px;
                            font-size:15px;
                       ">
                <div id="error-nome" style="color:#d9534f; font-size:13px; margin-top:4px;"></div>
            </div>

            <!-- Email -->
            <div>
                <label style="font-weight:600; color:#ff7a00;">E-mail:</label><br>
                <input type="email" name="email" id="email" placeholder="exemplo@email.com" required
                       style="
                            width:100%;
                            padding:12px 14px;
                            border:1px solid #d0d0d0;
                            border-radius:10px;
                            font-size:15px;
                       ">
                <div id="error-email" style="color:#d9534f; font-size:13px; margin-top:4px;"></div>
            </div>

            <!-- Sexo -->
            <div>
                <label style="font-weight:600; color:#ff7a00;">Sexo:</label><br>
                <select name="sexo" id="sexo" required
                        style="
                            width:100%;
                            padding:12px 14px;
                            border:1px solid #d0d0d0;
                            border-radius:10px;
                            font-size:15px;
                        ">
                    <option value="" disabled selected>Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>

            <!-- Senha -->
            <div>
                <label style="font-weight:600; color:#ff7a00;">Senha:</label><br>
                <input type="password" name="password" placeholder="Crie uma senha" required
                       style="
                            width:100%;
                            padding:12px 14px;
                            border:1px solid #d0d0d0;
                            border-radius:10px;
                            font-size:15px;
                       ">
            </div>

            <!-- Botões -->
            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:10px;">
                <a href="{{ route('funcionarios.index') }}"
                   style="
                        padding:12px 20px;
                        background:#666;
                        color:white;
                        border-radius:10px;
                        text-decoration:none;
                        font-weight:600;
                   ">
                    Cancelar
                </a>

                <button type="submit"
                        style="
                            padding:12px 20px;
                            background:linear-gradient(90deg, #ff6a00, #ff9500);
                            color:white;
                            border:none;
                            border-radius:10px;
                            font-weight:600;
                            cursor:pointer;
                        "
                        onmouseover="this.style.opacity='0.85'"
                        onmouseout="this.style.opacity='1'">
                    Salvar
                </button>
            </div>

        </form>

    </div>

    <!-- Script de validação -->
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
                    showError('email', 'E-mail inválido.');
                    valid = false;
                }

                if (!valid) event.preventDefault();
            });

            function showError(field, message) {
                const div = document.getElementById(`error-${field}`);
                if (div) div.textContent = message;
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
