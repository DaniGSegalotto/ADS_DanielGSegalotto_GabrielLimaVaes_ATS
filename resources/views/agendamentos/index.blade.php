<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            Lista de Agendamentos
        </h2>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        <!-- 🔎 Barra de Busca (padrão Premium ATS) -->
        <form action="{{ route('agendamentos.index') }}" method="GET"
              style="display:flex; gap:12px; margin-bottom:25px; flex-wrap:wrap;"
              onsubmit="setTimeout(()=>document.getElementById('query').value='', 10)">
            
            <input id="query" type="text" name="query"
                   placeholder="Buscar agendamentos..."
                   autocomplete="off"
                   style="
                        flex:1;
                        padding:12px 16px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        font-size:15px;
                        text-transform:none;
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

            <a href="{{ route('agendamentos.create') }}"
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
                Novo Agendamento
            </a>
        </form>

        <!-- Tabela -->
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; font-size:15px; color:#333;">
                <thead>
                    <tr style="background:#f2f2f2; border-bottom:2px solid #ddd;">
                        <th style="padding:14px;">ID</th>
                        <th style="padding:14px;">Data</th>
                        <th style="padding:14px;">Horário</th>
                        <th style="padding:14px;">Funcionário</th>
                        <th style="padding:14px;">Veículo</th>
                        <th style="padding:14px;">Cliente</th>
                        <th style="padding:14px; text-align:center;">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($agendamentos as $agendamento)
                        <tr style="border-bottom:1px solid #eee; transition:.2s;"
                            onmouseover="this.style.background='#fafafa'"
                            onmouseout="this.style.background='white'">

                            <td style="padding:12px;">{{ $agendamento->id }}</td>

                            <td style="padding:12px;">
                                {{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}
                            </td>

                            <td style="padding:12px;">{{ $agendamento->horario }}</td>
                            <td style="padding:12px;">{{ $agendamento->funcionario->nome }}</td>
                            <td style="padding:12px;">{{ $agendamento->veiculo->modelo }}</td>
                            <td style="padding:12px;">{{ $agendamento->cliente->nome }}</td>

                            <td style="padding:12px; display:flex; gap:6px; justify-content:center;">

                                <a href="{{ route('agendamentos.show', $agendamento->id) }}"
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

                                <a href="{{ route('agendamentos.edit', $agendamento->id) }}"
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

                                <button onclick="confirmarExclusao({{ $agendamento->id }})"
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

                                <form id="form-{{ $agendamento->id }}" method="POST"
                                      action="{{ route('agendamentos.destroy', $agendamento->id) }}"
                                      style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" style="padding:20px; text-align:center; color:#777;">
                                Nenhum agendamento encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

    <!-- SweetAlert -->
    <script>
        function confirmarExclusao(id) {
            Swal.fire({
                title: 'Excluir agendamento?',
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
