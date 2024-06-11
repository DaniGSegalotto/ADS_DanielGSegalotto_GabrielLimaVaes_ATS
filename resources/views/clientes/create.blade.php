<x-app-layout>
    <head>
        <!-- Importa um arquivo CSS específico para estilização de clientes -->
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <!-- Define o título da página -->
        <title>Novo Cliente</title>
    </head>
    <!-- Define o cabeçalho da página -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            <!-- Exibe o título da página traduzido usando o helper de tradução '__' -->
            {{ __('Criar Clientes') }}
        </h2>
    </x-slot>
    <!-- Verifica se há uma mensagem de sucesso na sessão e a exibe -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <body>
        <div class="container">
            <!-- Formulário para adicionar novos clientes -->
            <form id="formNovoCliente" action="{{ route('clientes.store') }}" method="POST">
                <!-- Token CSRF para proteção contra ataques CSRF -->
                @csrf
                <div class="form-group">
                    <!-- Campo para inserir o nome do cliente -->
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome">
                    <div id="error-nome" class="error-message"></div>
                </div>
                <div class="form-group">
                    <!-- Campo para inserir o telefone do cliente -->
                    <label for="telefone">Telefone:</label>
                    <input type="tel" name="telefone" id="telefone">
                    <div id="error-telefone" class="error-message"></div>
                </div>
                <div class="form-group">
                    <!-- Campo para inserir o CPF do cliente -->
                    <label for="CPF">CPF:</label>
                    <input type="text" name="CPF" id="CPF">
                    <div id="error-CPF" class="error-message"></div>
                </div>
                <div class="form-group">
                    <!-- Campo para inserir a CNH do cliente -->
                    <label for="CHN">CNH:</label>
                    <input type="text" name="CHN" id="CHN">
                    <div id="error-CHN" class="error-message"></div>
                </div>
                <div class="form-group">
                    <!-- Campo para inserir o email do cliente -->
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">
                    <div id="error-email" class="error-message"></div>
                </div>
                <!-- Botão para submeter o formulário -->
                <button type="submit" class="btn btn-success">Salvar</button>
                <!-- Link para cancelar a operação e voltar à página de índice de clientes -->
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>

        <!-- Script para validação do formulário -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('formNovoCliente');

                form.addEventListener('submit', function (event) {
                    // Resetar mensagens de erro
                    clearErrors();

                    // Validar campos
                    let valid = true;

                    const nome = document.getElementById('nome').value.trim();
                    if (nome === '') {
                        showError('nome', 'Por favor, insira o nome.');
                        valid = false;
                    }

                    const telefone = document.getElementById('telefone').value.trim();
                    if (!validatePhone(telefone)) {
                        showError('telefone', 'Por favor, insira um telefone válido.');
                        valid = false;
                    }

                    const CPF = document.getElementById('CPF').value.trim();
                    if (!validateCPF(CPF)) {
                        showError('CPF', 'Por favor, insira um CPF válido.');
                        valid = false;
                    }

                    const email = document.getElementById('email').value.trim();
                    if (email === '') {
                        showError('email', 'Por favor, insira o email.');
                        valid = false;
                    }

                    if (!valid) {
                        event.preventDefault(); // Impede o envio do formulário se houver erros
                    }
                });

                function showError(field, message) {
                    const errorDiv = document.getElementById(`error-${field}`);
                    errorDiv.textContent = message;
                }

                function clearErrors() {
                    const errorMessages = document.querySelectorAll('.error-message');
                    errorMessages.forEach(function (element) {
                        element.textContent = '';
                    });
                }

                function validatePhone(phone) {
                    // Aceita apenas números, pode ser adaptado conforme o formato desejado
                    return /^\d{10}$/.test(phone) || /^\d{11}$/.test(phone); // Aceita 10 ou 11 dígitos
                }

                function validateCPF(cpf) {
                    // Aceita apenas números e exatamente 11 dígitos
                    return /^\d{11}$/.test(cpf);
                }
            });
        </script>
    </body>
</x-app-layout>
