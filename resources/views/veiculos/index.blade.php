<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            Lista de Veículos
        </h2>
    </x-slot>

    <!-- Feedback -->
    @if(session('success'))
        <div style="
            max-width:1100px; margin:20px auto;
            background:rgba(76,175,80,0.15);
            border:1px solid rgba(76,175,80,0.35);
            color:#1b5e20;
            padding:12px 16px;
            border-radius:12px;
            font-size:15px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="
            max-width:1100px; margin:20px auto;
            background:rgba(244,67,54,0.15);
            border:1px solid rgba(244,67,54,0.35);
            color:#b71c1c;
            padding:12px 16px;
            border-radius:12px;
            font-size:15px;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Container -->
    <div style="
        max-width:1100px;
        margin:40px auto;
        background:#ffffff;
        padding:28px;
        border-radius:16px;
        border:1px solid #e6e6e6;
        box-shadow:0 6px 18px rgba(0,0,0,0.06);
    ">

        <!-- Barra de busca -->
        <form action="{{ route('veiculos.index') }}" method="GET"
              style="display:flex; gap:12px; margin-bottom:25px; flex-wrap:wrap;">

            <input type="text" name="query" placeholder="Buscar veículos..."
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
                "
                onmouseover="this.style.background='#ff8f2b'"
                onmouseout="this.style.background='#ff7a00'">
                Buscar
            </button>

            <a href="{{ route('veiculos.create') }}"
                style="
                    padding:12px 18px;
                    border-radius:10px;
                    background:#ff7a00;
                    color:white;
                    font-weight:600;
                    text-decoration:none;
                "
                onmouseover="this.style.background='#ff8f2b'"
                onmouseout="this.style.background='#ff7a00'">
                Novo Veículo
            </a>
        </form>

        <!-- Tabela -->
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; font-size:15px; color:#333;">

                <thead>
                    <tr style="background:#f2f2f2; border-bottom:2px solid #ddd;">
                        <th style="padding:14px;">ID</th>
                        <th style="padding:14px;">Modelo</th>
                        <th style="padding:14px;">Categoria</th>
                        <th style="padding:14px;">Placa</th>
                        <th style="padding:14px;">Ano</th>
                        <th style="padding:14px;">Marca</th>
                        <th style="padding:14px;">Status</th>
                        <th style="padding:14px;">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($veiculos as $veiculo)

                        @php
                            $status = $veiculo->status?->descricao ?? 'Indefinido';

                            $cor = match ($status) {
                                'Disponível'   => '#00c853', // verde
                                'Indisponível' => '#e53935', // vermelho
                                'Em manutenção'=> '#0288d1', // azul
                                'Vendido'      => '#ffa000', // amarelo
                                default        => '#9e9e9e', // cinza
                            };
                        @endphp

                        <tr style="border-bottom:1px solid #eee; transition:.2s;"
                            onmouseover="this.style.background='#fafafa'"
                            onmouseout="this.style.background='white'">

                            <td style="padding:12px;">{{ $veiculo->id }}</td>
                            <td style="padding:12px;">{{ $veiculo->modelo }}</td>
                            <td style="padding:12px;">{{ $veiculo->categoria }}</td>
                            <td style="padding:12px;">{{ $veiculo->placa }}</td>
                            <td style="padding:12px;">{{ $veiculo->ano }}</td>
                            <td style="padding:12px;">{{ $veiculo->marca->descricao ?? '-' }}</td>

                            <td style="padding:12px;">
                                <span style="
                                    background:{{ $cor }}22;
                                    border:1px solid {{ $cor }}99;
                                    color:{{ $cor }};
                                    padding:4px 10px;
                                    border-radius:8px;
                                    font-weight:600;
                                ">
                                    {{ $status }}
                                </span>
                            </td>

                            <td style="padding:12px; display:flex; gap:6px;">

                                <a href="{{ route('veiculos.show', $veiculo->id) }}"
                                    style="
                                        padding:6px 10px;
                                        background:#008cff;
                                        color:white;
                                        border-radius:6px;
                                        font-size:13px;
                                        text-decoration:none;
                                    ">
                                    Detalhes
                                </a>

                                <a href="{{ route('veiculos.edit', $veiculo->id) }}"
                                    style="
                                        padding:6px 10px;
                                        background:#ff7a00;
                                        color:white;
                                        border-radius:6px;
                                        font-size:13px;
                                        text-decoration:none;
                                    ">
                                    Editar
                                </a>

                                <form id="form-{{ $veiculo->id }}"
                                      method="POST"
                                      action="{{ route('veiculos.destroy', $veiculo->id) }}">
                                    @csrf @method('DELETE')

                                    <button type="button"
                                        onclick="confirmarExclusao({{ $veiculo->id }})"
                                        style="
                                            padding:6px 10px;
                                            background:#e63946;
                                            color:white;
                                            border:none;
                                            border-radius:6px;
                                            font-size:13px;
                                            cursor:pointer;
                                        ">
                                        Excluir
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" style="padding:20px; text-align:center; color:#777;">
                                Nenhum veículo encontrado.
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
                title: 'Excluir veículo?',
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
