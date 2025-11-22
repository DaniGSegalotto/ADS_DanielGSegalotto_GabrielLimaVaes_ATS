<x-app-layout>

    {{-- Cabeçalho da página --}}
    <x-slot name="header">
        <h2 style="font-size: 26px; font-weight: 600; color: #111;">
            Editar Cliente
        </h2>
    </x-slot>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div style="
            background: #e8fff0;
            border: 1px solid #8de6b5;
            color: #2d8a4e;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 15px;
            max-width: 780px;
            margin: 0 auto 20px auto;
        ">
            ✔ {{ session('success') }}
        </div>
    @endif

    {{-- Container principal --}}
    <div style="
        max-width: 780px;
        margin: 40px auto;
        background: #ffffff;
        border: 1px solid #e4e4e4;
        padding: 34px;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    ">

        <h3 style="font-size: 22px; font-weight: 600; color:#222; margin-bottom: 22px;">
            Editar Informações do Cliente
        </h3>

        {{-- Formulário --}}
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST"
              style="display:flex; flex-direction:column; gap:22px;">
            @csrf
            @method('PUT')

            @php
                $inputBase = '
                    width:100%;
                    padding:14px 16px;
                    border-radius:12px;
                    border:1px solid #d9d9d9;
                    outline:none;
                    background:#f7f7f7;
                    color:#222;
                    font-size:15px;
                    transition:.2s;
                ';
            @endphp

            {{-- Campo Nome --}}
            <div>
                <label for="nome" style="color:#444; font-weight:600;">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ $cliente->nome }}" required
                       style="{{ $inputBase }}"
                       onfocus="this.style.borderColor='#ff6a00'; this.style.background='#fff'"
                       onblur="this.style.borderColor='#d9d9d9'; this.style.background='#f7f7f7'">
            </div>

            {{-- Campo Telefone --}}
            <div>
                <label for="telefone" style="color:#444; font-weight:600;">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="{{ $cliente->telefone }}" required
                       style="{{ $inputBase }}"
                       onfocus="this.style.borderColor='#ff6a00'; this.style.background='#fff'"
                       onblur="this.style.borderColor='#d9d9d9'; this.style.background='#f7f7f7'">
            </div>

            {{-- Campo CPF --}}
            <div>
                <label for="CPF" style="color:#444; font-weight:600;">CPF</label>
                <input type="text" name="CPF" id="CPF" value="{{ $cliente->CPF }}" required
                       style="{{ $inputBase }}"
                       onfocus="this.style.borderColor='#ff6a00'; this.style.background='#fff'"
                       onblur="this.style.borderColor='#d9d9d9'; this.style.background='#f7f7f7'">
            </div>

            {{-- Campo CNH --}}
            <div>
                <label for="CHN" style="color:#444; font-weight:600;">CNH</label>
                <input type="text" name="CHN" id="CHN" value="{{ $cliente->CHN }}" required
                       style="{{ $inputBase }}"
                       onfocus="this.style.borderColor='#ff6a00'; this.style.background='#fff'"
                       onblur="this.style.borderColor='#d9d9d9'; this.style.background='#f7f7f7'">
            </div>

            {{-- Campo Email --}}
            <div>
                <label for="email" style="color:#444; font-weight:600;">E-mail</label>
                <input type="email" name="email" id="email" value="{{ $cliente->email }}" required
                       style="{{ $inputBase }}"
                       onfocus="this.style.borderColor='#ff6a00'; this.style.background='#fff'"
                       onblur="this.style.borderColor='#d9d9d9'; this.style.background='#f7f7f7'">
            </div>

            {{-- Botões --}}
            <div style="display:flex; gap:14px; margin-top:10px;">

                <button type="submit"
                        style="
                            padding:14px 22px;
                            background:linear-gradient(90deg,#ff512f,#f09819);
                            border:none;
                            border-radius:12px;
                            color:white;
                            font-weight:600;
                            cursor:pointer;
                            font-size:15px;
                            transition:.2s;
                        "
                        onmouseover="this.style.opacity='.85'"
                        onmouseout="this.style.opacity='1'">
                    Salvar Alterações
                </button>

                <a href="{{ route('clientes.index') }}"
                   style="
                       padding:14px 22px;
                       background:#666;
                       border-radius:12px;
                       color:white;
                       font-weight:600;
                       text-decoration:none;
                       font-size:15px;
                       transition:.2s;
                   "
                   onmouseover="this.style.background='#555'"
                   onmouseout="this.style.background='#666'">
                    Cancelar
                </a>

            </div>

        </form>
    </div>

    {{-- Validação simples de CPF --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');

            form.addEventListener('submit', e => {
                const cpf = document.getElementById('CPF').value.trim();
                if (!/^\d{11}$/.test(cpf)) {
                    alert('CPF inválido. Digite apenas números (11 dígitos).');
                    e.preventDefault();
                }
            });
        });
    </script>

</x-app-layout>
