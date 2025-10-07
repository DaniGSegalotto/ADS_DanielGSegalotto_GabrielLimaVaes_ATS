<x-app-layout>

    <head>
        <link rel="stylesheet" href="{{ asset('css/clientes/index.css') }}">
        <script src="{{ asset('js/veiculos.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Lista de Veículos</title>
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Lista de Veículos') }}
        </h2>
    </x-slot>

    <div class="container">

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <strong class="font-bold">Sucesso!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong class="font-bold">Atenção!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Formulário de busca -->
        <form action="{{ route('veiculos.index') }}" method="GET" class="search-form">
            <div class="search-container">
                <input type="text" name="query" placeholder="Buscar Veículos" value="{{ request('query') }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <!-- Botão para adicionar um novo veículo -->
        <a href="{{ route('veiculos.create') }}" class="btn btn-primary">Novo Veículo</a>

        <!-- Tabela de veículos -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>MODELO</th>
                    <th>CATEGORIA</th>
                    <th>PLACA</th>
                    <th>ANO</th>
                    <th>MARCA</th>
                    <th>OPÇÕES</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($veiculos as $veiculo)
                    <tr>
                        <td>{{ $veiculo->id }}</td>
                        <td>{{ $veiculo->modelo }}</td>
                        <td>{{ $veiculo->categoria }}</td>
                        <td>{{ $veiculo->placa }}</td>
                        <td>{{ $veiculo->ano }}</td>

                        <!-- Marca por descrição -->
                        <td>{{ $veiculo->marca->descricao ?? '—' }}</td>

                        <td>
                            <a href="{{ route('veiculos.show', $veiculo->id) }}" class="btn btn-info">Detalhes</a>
                            <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="btn btn-warning">Editar</a>

                            <form id="delete-form-{{ $veiculo->id }}"
                                  action="{{ route('veiculos.destroy', $veiculo->id) }}"
                                  method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $veiculo->id }})" class="btn btn-danger">Excluir</button>
                                <button type="button" class="btn btn-info2" onclick="infoVeiculo({{ $veiculo->id }})">Informação</button>
                            </form>
                        </td>

                        <!-- Status com badge (usa relacionamento 'status') -->
                        <td>
                            @php
                                $statusDesc = $veiculo->status?->descricao ?? 'Não definido';
                                $badgeClass = match ($statusDesc) {
                                    'Ativo'          => 'badge badge-ativo',
                                    'Vendido'        => 'badge badge-vendido',
                                    'Indisponível'   => 'badge badge-indisponivel',
                                    'Em manutenção'  => 'badge badge-em-manutencao',
                                    default          => 'badge badge-default',
                                };
                            @endphp
                            <span class="{{ $badgeClass }}">{{ $statusDesc }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Nenhum veículo encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
