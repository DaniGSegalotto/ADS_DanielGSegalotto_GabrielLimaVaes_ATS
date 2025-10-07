<x-app-layout>
    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/clientes.css') }}">
        <title>Novo Veículo</title>
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Criar Veículos') }}
        </h2>
    </x-slot>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Mensagem de erro --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">Erro!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <body>
        <div class="container">
            <form id="formNovoVeiculo" action="{{ route('veiculos.store') }}" method="POST">
                @csrf

                {{-- Modelo --}}
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" name="modelo" id="modelo" value="{{ old('modelo') }}">
                    <div id="error-modelo" class="error-message"></div>
                </div>

                {{-- Categoria --}}
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <input type="text" name="categoria" id="categoria" value="{{ old('categoria') }}">
                    <div id="error-categoria" class="error-message"></div>
                </div>

                {{-- Placa --}}
                <div class="form-group">
                    <label for="placa">Placa:</label>
                    <input type="text" name="placa" id="placa" value="{{ old('placa') }}">
                    <div id="error-placa" class="error-message"></div>
                </div>

                {{-- Ano --}}
                <div class="form-group">
                    <label for="ano">Ano:</label>
                    <input type="number" name="ano" id="ano" value="{{ old('ano') }}">
                    <div id="error-ano" class="error-message"></div>
                </div>

                {{-- Marca --}}
                <div class="form-group">
                    <label for="marca_id">Marca:</label>
                    <select class="form-control" name="marca_id" id="marca_id" required>
                        <option value="">Selecione uma marca</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>
                                {{ $marca->descricao }}
                            </option>
                        @endforeach
                    </select>
                    <div id="error-marca_id" class="error-message"></div>
                </div>

                {{-- Status (corrigido para status_id) --}}
                <div class="form-group">
                    <label for="status_id">Status:</label>
                    <select class="form-control" name="status_id" id="status_id" required>
                        <option value="">Selecione um status</option>
                        @foreach($statuses as $statusItem)
                            <option value="{{ $statusItem->id }}" {{ old('status_id') == $statusItem->id ? 'selected' : '' }}>
                                {{ $statusItem->descricao }}
                            </option>
                        @endforeach
                    </select>
                    <div id="error-status_id" class="error-message"></div>
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('formNovoVeiculo');

                form.addEventListener('submit', function (event) {
                    let valid = true;
                    clearErrors();

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
                    if (placa === '') {
                        showError('placa', 'Por favor, insira a placa.');
                        valid = false;
                    }

                    const ano = document.getElementById('ano').value.trim();
                    if (!validateAno(ano)) {
                        showError('ano', 'Por favor, insira um ano válido (AAAA).');
                        valid = false;
                    }

                    const marca_id = document.getElementById('marca_id').value.trim();
                    if (marca_id === '') {
                        showError('marca_id', 'Por favor, selecione uma marca.');
                        valid = false;
                    }

                    const status_id = document.getElementById('status_id').value.trim();
                    if (status_id === '') {
                        showError('status_id', 'Por favor, selecione um status.');
                        valid = false;
                    }

                    if (!valid) event.preventDefault();
                });

                function showError(field, message) {
                    const errorDiv = document.getElementById(`error-${field}`);
                    if (errorDiv) errorDiv.textContent = message;
                }

                function clearErrors() {
                    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
                }

                function validateAno(ano) {
                    return /^\d{4}$/.test(ano);
                }
            });
        </script>
    </body>
</x-app-layout>
