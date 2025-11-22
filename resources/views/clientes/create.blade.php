<x-app-layout>

    {{-- Cabeçalho da página --}}
    <x-slot name="header">
        <h2 style="font-size: 26px; font-weight: 600; color: #333;">
            Criar Cliente
        </h2>
    </x-slot>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div style="
            background: #e8ffe8;
            border: 1px solid #a4e6a4;
            color: #2b7a2b;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
        ">
            <strong>Sucesso!</strong> {{ session('success') }}
        </div>
    @endif

    {{-- Container principal --}}
    <div style="
        max-width: 750px;
        margin: 40px auto;
        background: #ffffff;
        border: 1px solid #e4e4e4;
        padding: 32px;
        border-radius: 18px;
        box-shadow: 0 8px 22px rgba(0,0,0,0.06);
    ">

        <form id="formNovoCliente" action="{{ route('clientes.store') }}" method="POST"
              style="display:flex; flex-direction:column; gap:18px;">
            @csrf

            {{-- Nome --}}
            <div>
                <label for="nome" style="color:#ff7a00; font-weight:600;">Nome</label><br>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome completo" required
                       style="
                            width:100%; padding:12px;
                            border:1px solid #ccc; border-radius:10px;
                            font-size:15px; margin-top:6px;
                       ">
                <div id="error-nome" class="error-message" style="color:#d33; font-size:13px;"></div>
            </div>

            {{-- Telefone --}}
            <div>
                <label for="telefone" style="color:#ff7a00; font-weight:600;">Telefone</label><br>
                <input type="tel" name="telefone" id="telefone" placeholder="Apenas números" required
                       style="
                            width:100%; padding:12px;
                            border:1px solid #ccc; border-radius:10px;
                            font-size:15px; margin-top:6px;
                       ">
                <div id="error-telefone" class="error-message" style="color:#d33; font-size:13px;"></div>
            </div>

            {{-- CPF --}}
            <div>
                <label for="CPF" style="color:#ff7a00; font-weight:600;">CPF</label><br>
                <input type="text" name="CPF" id="CPF" placeholder="Somente números" required
                       style="
                            width:100%; padding:12px;
                            border:1px solid #ccc; border-radius:10px;
                            font-size:15px; margin-top:6px;
                       ">
                <div id="error-CPF" class="error-message" style="color:#d33; font-size:13px;"></div>
            </div>

            {{-- CNH --}}
            <div>
                <label for="CHN" style="color:#ff7a00; font-weight:600;">CNH</label><br>
                <input type="text" name="CHN" id="CHN" placeholder="Número da CNH" required
                       style="
                            width:100%; padding:12px;
                            border:1px solid #ccc; border-radius:10px;
                            font-size:15px; margin-top:6px;
                       ">
                <div id="error-CHN" class="error-message" style="color:#d33; font-size:13px;"></div>
            </div>

            {{-- E-mail --}}
            <div>
                <label for="email" style="color:#ff7a00; font-weight:600;">E-mail</label><br>
                <input type="email" name="email" id="email" placeholder="email@exemplo.com" required
                       style="
                            width:100%; padding:12px;
                            border:1px solid #ccc; border-radius:10px;
                            font-size:15px; margin-top:6px;
                       ">
                <div id="error-email" class="error-message" style="color:#d33; font-size:13px;"></div>
            </div>

            {{-- Botões --}}
            <div style="display:flex; gap:12px; margin-top:20px;">
                <button type="submit"
                        style="
                            padding:12px 22px;
                            background: linear-gradient(90deg,#ff6a00,#ff9500);
                            border:none; color:#fff;
                            border-radius:10px;
                            font-size:15px; font-weight:600;
                            cursor:pointer; transition:.2s;
                        ">
                    Salvar
                </button>

                <a href="{{ route('clientes.index') }}"
                   style="
                        padding:12px 22px;
                        background:#777;
                        color:#fff;
                        border-radius:10px;
                        font-size:15px;
                        font-weight:600;
                        text-decoration:none;
                   ">
                    Cancelar
                </a>
            </div>
        </form>

    </div>

    {{-- Script de validação --}}
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
                if (!/^\d{10,11}$/.test(telefone)) {
                    showError('telefone', 'Telefone inválido. Use 10 ou 11 dígitos.');
                    valid = false;
                }

                const cpf = document.getElementById('CPF').value.trim();
                if (!/^\d{11}$/.test(cpf)) {
                    showError('CPF', 'CPF inválido. Use 11 dígitos.');
                    valid = false;
                }

                const email = document.getElementById('email').value.trim();
                if (email === '') {
                    showError('email', 'Por favor, insira o e-mail.');
                    valid = false;
                }

                if (!valid) event.preventDefault();
            });

            function showError(field, message) {
                document.getElementById(`error-${field}`).textContent = message;
            }

            function clearErrors() {
                document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            }
        });
    </script>

</x-app-layout>
