<x-app-layout>
    <!-- Cabeçalho da página -->
    <head>
        <!-- Importa um arquivo CSS específico para estilização de veículos -->
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <!-- Define o título da página -->
        <title>Novo Veículo</title>
    </head>
    <!-- Define o conteúdo do cabeçalho -->
    <x-slot name="header">
        <!-- Título da página -->
        <h2 class="font-semibold text-xl text-white leading-tight">
            <!-- Exibe o título da página traduzido usando o helper de tradução '__' -->
            {{ __('Criar Veículos') }}
        </h2>
    </x-slot>
    <!-- Se houver uma mensagem de sucesso na sessão, ela é exibida -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <body>
        <div class="container">
            <!-- Formulário para criar um novo veículo -->
            <form id="formNovoVeiculo" action="{{ route('veiculos.store') }}" method="POST">
                <!-- Token CSRF para proteção contra ataques CSRF -->
                @csrf
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <!-- Campo para inserir o modelo do veículo -->
                    <input type="text" name="modelo" id="modelo">
                    <div id="error-modelo" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <!-- Campo para inserir a categoria do veículo -->
                    <input type="text" name="categoria" id="categoria">
                    <div id="error-categoria" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="placa">Placa:</label>
                    <!-- Campo para inserir a placa do veículo -->
                    <input type="text" name="placa" id="placa">
                    <div id="error-placa" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="ano">Ano:</label>
                    <!-- Campo para inserir o ano do veículo -->
                    <input type="number" name="ano" id="ano">
                    <div id="error-ano" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="marca_id">Marca:</label>
                    <!-- Campo de seleção para escolher a marca do veículo -->
                    <select class="form-control" name="marca_id" id="marca_id" required>
                        <option value="">Selecione uma marca</option>
                        <!-- Loop para exibir as opções de marcas -->
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->descricao }}</option>
                        @endforeach
                    </select>
                    <div id="error-marca_id" class="error-message"></div>
                </div>
                <!-- Botão para submeter o formulário e salvar o novo veículo -->
                <button type="submit" class="btn btn-success">Salvar</button>
                <!-- Link para cancelar a operação e voltar à página de índice de veículos -->
                <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>

        <!-- Script para validação do formulário -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('formNovoVeiculo');

                form.addEventListener('submit', function (event) {
                    // Resetar mensagens de erro
                    clearErrors();

                    // Validar campos
                    let valid = true;

                    const modelo = document.getElementById('modelo').value.trim();
                    if (modelo === '') {
                        showError('modelo', 'Por favor, insira o modelo.');
                        valid = false;
                    }

                    const categoria = document.getElementById('categoria').value.trim();
                    if (categoria === '') {
                        showError('categoria', 'Por favor, insira a categoria.');
                        valid = false;
                    }

                    const placa = document.getElementById('placa').value.trim();
                    if (!validatePlaca(placa)) {
                        showError('placa', 'Por favor, insira uma placa válida.');
                        valid = false;
                    }

                    const ano = document.getElementById('ano').value.trim();
                    if (!validateAno(ano)) {
                        showError('ano', 'Por favor, insira um ano válido.');
                        valid = false;
                    }

                    const marca_id = document.getElementById('marca_id').value.trim();
                    if (marca_id === '') {
                        showError('marca_id', 'Por favor, selecione uma marca.');
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

                function validateAno(ano) {
                    // Verifica se o ano é um número válido
                    return /^\d{4}$/.test(ano);
                }
            });
        </script>
    </body>
</x-app-layout>
