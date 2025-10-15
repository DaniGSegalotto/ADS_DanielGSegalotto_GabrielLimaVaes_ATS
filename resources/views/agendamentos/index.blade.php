<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Lista de Agendamentos') }}
        </h2>
    </x-slot>

    <!-- 🔹 Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/agendamentos.js') }}"></script>

    <!-- 🔹 Conteúdo principal -->
    <div class="card" style="width:100%; max-width:1000px; margin:auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <a href="{{ route('agendamentos.create') }}" class="btn">+ Novo Agendamento</a>
        </div>

        <table style="width:100%; border-collapse:collapse; color:white; text-align:left;">
            <thead>
                <tr style="border-bottom:1px solid rgba(255,255,255,0.2);">
                    <th>ID</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Funcionário</th>
                    <th>Veículo</th>
                    <th>Cliente</th>
                    <th style="text-align:center;">Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agendamentos as $agendamento)
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.1);">
                        <td>{{ $agendamento->id }}</td>
                        <td>{{ $agendamento->data }}</td>
                        <td>{{ $agendamento->horario }}</td>
                        <td>{{ $agendamento->funcionario->nome }}</td>
                        <td>{{ $agendamento->veiculo->modelo }}</td>
                        <td>{{ $agendamento->cliente->nome }}</td>
                        <td style="text-align:center;">
                            <a href="{{ route('agendamentos.show', $agendamento->id) }}" class="btn" style="background:#0099ff;">Detalhes</a>
                            <a href="{{ route('agendamentos.edit', $agendamento->id) }}" class="btn" style="background:#f39c12;">Editar</a>
                            <button onclick="deletarAgendamento({{ $agendamento->id }})" class="btn" style="background:#e74c3c;">Excluir</button>
                            <button class="btn" style="background:#666;" onclick="infoAgendamento({{ $agendamento->id }})">Info</button>

                            <form id="form-{{ $agendamento->id }}" action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 🔹 Script para exclusão com alerta -->
    <script>
        function deletarAgendamento(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Esta ação não poderá ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#555',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-' + id).submit();
                }
            });
        }

        function infoAgendamento(id) {
            Swal.fire({
                title: 'Informação',
                text: 'Detalhes adicionais sobre o agendamento ID: ' + id,
                icon: 'info',
                confirmButtonColor: '#ff512f'
            });
        }
    </script>
</x-app-layout>
