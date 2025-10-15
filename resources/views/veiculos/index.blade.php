<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Lista de Veículos') }}
        </h2>
    </x-slot>

    <!-- 🔹 Mensagens de feedback -->
    @if(session('success'))
        <div class="card" style="background:rgba(76,175,80,0.2); border:1px solid rgba(76,175,80,0.4); color:#caffca; margin:auto; margin-bottom:20px; max-width:900px; padding:10px; border-radius:12px;">
            <strong>✔ Sucesso:</strong> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="card" style="background:rgba(255,82,82,0.15); border:1px solid rgba(255,82,82,0.4); color:#ffbaba; margin:auto; margin-bottom:20px; max-width:900px; padding:10px; border-radius:12px;">
            <strong>⚠ Atenção:</strong> {{ session('error') }}
        </div>
    @endif

    <!-- 🔹 Conteúdo -->
    <div class="card" style="max-width:900px; margin:auto;">

        <!-- 🔸 Barra de busca -->
        <form action="{{ route('veiculos.index') }}" method="GET" 
              style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <input type="text" name="query" placeholder="Buscar veículos..." value="{{ request('query') }}"
                   style="flex:1; padding:10px; border-radius:12px; border:none; background:rgba(255,255,255,0.12); color:#fff;">
            <button type="submit"
                    style="margin-left:10px; background:linear-gradient(90deg,#ff512f,#f09819);
                           border:none; color:white; padding:10px 18px; border-radius:12px; font-weight:600;">
                Buscar
            </button>
        </form>

        <!-- 🔸 Botão Novo -->
        <div style="margin-bottom:20px; text-align:right;">
            <a href="{{ route('veiculos.create') }}" 
               style="background:linear-gradient(90deg,#ff512f,#f09819); 
                      color:white; padding:10px 16px; border-radius:12px; text-decoration:none; font-weight:600;">
                + Novo Veículo
            </a>
        </div>

        <!-- 🔸 Tabela -->
        <table style="width:100%; border-collapse:collapse; text-align:left;">
            <thead>
                <tr style="background:rgba(255,255,255,0.08); color:#ffb84d;">
                    <th style="padding:10px;">ID</th>
                    <th style="padding:10px;">Modelo</th>
                    <th style="padding:10px;">Categoria</th>
                    <th style="padding:10px;">Placa</th>
                    <th style="padding:10px;">Ano</th>
                    <th style="padding:10px;">Marca</th>
                    <th style="padding:10px;">Status</th>
                    <th style="padding:10px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($veiculos as $veiculo)
                    @php
                        $statusDesc = $veiculo->status?->descricao ?? 'Não definido';
                        $badgeColor = match ($statusDesc) {
                            'Ativo'          => '#00e676',
                            'Vendido'        => '#ffa000',
                            'Indisponível'   => '#e53935',
                            'Em manutenção'  => '#29b6f6',
                            default          => '#bdbdbd',
                        };
                    @endphp

                    <tr style="border-bottom:1px solid rgba(255,255,255,0.1); color:#fff;">
                        <td style="padding:10px;">{{ $veiculo->id }}</td>
                        <td style="padding:10px;">{{ $veiculo->modelo }}</td>
                        <td style="padding:10px;">{{ $veiculo->categoria }}</td>
                        <td style="padding:10px;">{{ $veiculo->placa }}</td>
                        <td style="padding:10px;">{{ $veiculo->ano }}</td>
                        <td style="padding:10px;">{{ $veiculo->marca->descricao ?? '—' }}</td>
                        <td style="padding:10px;">
                            <span style="background:{{ $badgeColor }}33; border:1px solid {{ $badgeColor }}88;
                                         color:{{ $badgeColor }}; padding:4px 10px; border-radius:8px; font-weight:600;">
                                {{ $statusDesc }}
                            </span>
                        </td>

                        <td style="padding:10px;">
                            <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                <a href="{{ route('veiculos.show', $veiculo->id) }}" 
                                   style="background:#2196F3; padding:6px 10px; border-radius:8px; color:#fff; text-decoration:none; font-weight:500;">
                                   Detalhes
                                </a>
                                <a href="{{ route('veiculos.edit', $veiculo->id) }}" 
                                   style="background:#ffb84d; padding:6px 10px; border-radius:8px; color:#000; text-decoration:none; font-weight:500;">
                                   Editar
                                </a>
                                <form id="delete-{{ $veiculo->id }}" action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $veiculo->id }})"
                                            style="background:#e53935; color:white; padding:6px 10px; border-radius:8px; border:none; font-weight:500; cursor:pointer;">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center; padding:15px; color:#ccc;">Nenhum veículo encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- 🔹 Script SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Essa ação não pode ser desfeita.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e53935',
                cancelButtonColor: '#555',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-${id}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
