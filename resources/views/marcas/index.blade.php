<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Lista de Marcas') }}
        </h2>
    </x-slot>

    <!-- 🔹 Conteúdo -->
    <div class="card" style="max-width: 900px; margin: auto;">

        <!-- 🔸 Barra de busca -->
        <form action="{{ route('marcas.index') }}" method="GET" 
              style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <input type="text" name="query" placeholder="Buscar marcas..." 
                   value="{{ request('query') }}"
                   style="flex: 1; padding: 10px; border-radius: 12px; border: none; background: rgba(255,255,255,0.12); color: #fff;">
            <button type="submit"
                    style="margin-left: 10px; background: linear-gradient(90deg, #ff512f, #f09819);
                           border: none; color: white; padding: 10px 18px; border-radius: 12px; font-weight: 600;">
                Buscar
            </button>
        </form>

        <!-- 🔸 Botão Nova Marca -->
        <div style="margin-bottom: 20px; text-align: right;">
            <a href="{{ route('marcas.create') }}" 
               style="background: linear-gradient(90deg, #ff512f, #f09819); 
                      color: white; padding: 10px 16px; border-radius: 12px; text-decoration: none; font-weight: 600;">
                + Nova Marca
            </a>
        </div>

        <!-- 🔸 Tabela de Marcas -->
        <table style="width:100%; border-collapse: collapse; text-align:left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.08); color: #ffb84d;">
                    <th style="padding:10px;">ID</th>
                    <th style="padding:10px;">Nome</th>
                    <th style="padding:10px;">Observação</th>
                    <th style="padding:10px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marcas as $marca)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #fff;">
                        <td style="padding:10px;">{{ $marca->id }}</td>
                        <td style="padding:10px;">{{ $marca->descricao }}</td>
                        <td style="padding:10px;">{{ $marca->observacao ?? '-' }}</td>
                        <td style="padding:10px;">
                            <div style="display:flex; gap:8px;">
                                <a href="{{ route('marcas.show', $marca->id) }}" 
                                   style="background:#2196F3; padding:6px 10px; border-radius:8px; color:#fff; text-decoration:none; font-weight:500;">
                                   Detalhes
                                </a>
                                <a href="{{ route('marcas.edit', $marca->id) }}" 
                                   style="background:#ffb84d; padding:6px 10px; border-radius:8px; color:#000; text-decoration:none; font-weight:500;">
                                   Editar
                                </a>
                                <form id="form-{{ $marca->id }}" action="{{ route('marcas.destroy', $marca->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmarExclusao({{ $marca->id }})"
                                            style="background:#e53935; color:white; padding:6px 10px; border-radius:8px; border:none; font-weight:500;">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                @if($marcas->isEmpty())
                    <tr>
                        <td colspan="4" style="text-align:center; padding:15px; color:#ccc;">Nenhuma marca encontrada.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- 🔹 SweetAlert2 exclusão -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmarExclusao(id) {
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
                    document.getElementById(`form-${id}`).submit();
                }
            });
        }
    </script>
</x-app-layout>
