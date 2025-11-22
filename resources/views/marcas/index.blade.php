<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            Lista de Marcas
        </h2>
    </x-slot>

    <!-- Container -->
    <div style="
        max-width: 1100px;
        margin: 40px auto;
        background: #ffffff;
        padding: 28px;
        border-radius: 16px;
        border: 1px solid #e6e6e6;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    ">

        <!-- Barra de busca -->
        <form action="{{ route('marcas.index') }}" method="GET"
              style="display:flex; gap:12px; margin-bottom:25px; flex-wrap:wrap;">

            <input type="text" name="query" placeholder="Buscar marcas..."
                value="{{ $query ?? '' }}"
                style="
                    flex:1;
                    padding:12px 16px;
                    border-radius:10px;
                    border:1px solid #d0d0d0;
                    font-size:15px;
                ">

            <button type="submit"
                style="
                    padding:12px 18px;
                    border:none;
                    border-radius:10px;
                    background:#ff7a00;
                    color:white;
                    font-weight:600;
                    cursor:pointer;
                    transition:.2s;
                "
                onmouseover="this.style.background='#ff8f2b'"
                onmouseout="this.style.background='#ff7a00'">
                Buscar
            </button>

            <a href="{{ route('marcas.create') }}"
                style="
                    padding:12px 18px;
                    border-radius:10px;
                    background:#ff7a00;
                    color:white;
                    font-weight:600;
                    text-decoration:none;
                    transition:.2s;
                "
                onmouseover="this.style.background='#ff8f2b'"
                onmouseout="this.style.background='#ff7a00'">
                Nova Marca
            </a>
        </form>

        <!-- Tabela -->
        <div style="overflow-x:auto;">
            <table style="
                width:100%;
                border-collapse:collapse;
                font-size:15px;
                color:#333;
            ">
                <thead>
                    <tr style="background:#f2f2f2; border-bottom:2px solid #ddd;">
                        <th style="padding:14px; text-align:left;">ID</th>
                        <th style="padding:14px; text-align:left;">Nome</th>
                        <th style="padding:14px; text-align:left;">Observação</th>
                        <th style="padding:14px; text-align:left;">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($marcas as $marca)
                        <tr style="border-bottom:1px solid #eee; transition:0.2s;"
                            onmouseover="this.style.background='#fafafa'"
                            onmouseout="this.style.background='white'">

                            <td style="padding:12px;">{{ $marca->id }}</td>
                            <td style="padding:12px;">{{ $marca->descricao }}</td>
                            <td style="padding:12px;">{{ $marca->observacao ?? '-' }}</td>

                            <td style="padding:12px; white-space:nowrap; display:flex; gap:6px;">

                                <a href="{{ route('marcas.show', $marca->id) }}"
                                    style="
                                        padding:6px 10px;
                                        background:#008cff;
                                        color:white;
                                        border-radius:6px;
                                        font-size:13px;
                                        text-decoration:none;
                                        transition:.2s;
                                    "
                                    onmouseover="this.style.background='#0b7fe6'"
                                    onmouseout="this.style.background='#008cff'">
                                    Detalhes
                                </a>

                                <a href="{{ route('marcas.edit', $marca->id) }}"
                                    style="
                                        padding:6px 10px;
                                        background:#ff7a00;
                                        color:white;
                                        border-radius:6px;
                                        font-size:13px;
                                        text-decoration:none;
                                    "
                                    onmouseover="this.style.background='#ff8f2b'"
                                    onmouseout="this.style.background='#ff7a00'">
                                    Editar
                                </a>

                                <form id="form-{{ $marca->id }}"
                                      action="{{ route('marcas.destroy', $marca->id) }}"
                                      method="POST">
                                    @csrf @method('DELETE')

                                    <button type="button"
                                        onclick="confirmarExclusao({{ $marca->id }})"
                                        style="
                                            padding:6px 10px;
                                            background:#e63946;
                                            color:white;
                                            border:none;
                                            border-radius:6px;
                                            font-size:13px;
                                            cursor:pointer;
                                            transition:.2s;
                                        "
                                        onmouseover="this.style.background='#c42e3a'"
                                        onmouseout="this.style.background='#e63946'">
                                        Excluir
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding:20px; text-align:center; color:#777;">
                                Nenhuma marca encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmarExclusao(id) {
            Swal.fire({
                title: 'Excluir marca?',
                text: 'Esta ação não pode ser desfeita.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff7a00',
                cancelButtonColor: '#555',
                confirmButtonText: 'Sim, excluir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-${id}`).submit();
                }
            });
        }
    </script>

</x-app-layout>
