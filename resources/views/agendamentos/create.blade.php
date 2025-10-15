<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Criar Agendamento') }}
        </h2>
    </x-slot>

    <!-- 🔹 Mensagem de sucesso -->
    @if(session('success'))
        <div style="
            background: rgba(119, 255, 168, .16);
            border: 1px solid rgba(119, 255, 168, .45);
            color: #c9ffd9;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 15px;
        ">
            <strong>Sucesso!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- 🔹 Conteúdo -->
    <div class="card">
        <form id="form-agendamento" action="{{ route('agendamentos.store') }}" method="POST" style="display:flex; flex-direction:column; gap:16px;">
            @csrf

            <div>
                <label for="data">Data:</label><br>
                <input type="date" name="data" id="data" required>
            </div>

            <div>
                <label for="horario">Horário:</label><br>
                <input type="time" name="horario" id="horario" required>
            </div>

            <div>
                <label for="funcionario_id">Funcionário:</label><br>
                <select name="funcionario_id" id="funcionario_id" required>
                    <option value="">Selecione um funcionário</option>
                    @foreach($funcionarios as $funcionario)
                        <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="veiculo_id">Veículo:</label><br>
                <select name="veiculo_id" id="veiculo_id" required>
                    <option value="">Selecione um veículo</option>
                    @foreach($veiculos as $veiculo)
                        <option value="{{ $veiculo->id }}">{{ $veiculo->modelo }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="cliente_id">Cliente:</label><br>
                <select name="cliente_id" id="cliente_id" required>
                    <option value="">Selecione um cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit">Salvar</button>
                <a href="{{ route('agendamentos.index') }}" class="btn" style="background:#666;">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- 🔹 Script de validação -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-agendamento');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const data = document.getElementById('data').value;
                const horario = document.getElementById('horario').value;
                const funcionarioId = document.getElementById('funcionario_id').value;
                const veiculoId = document.getElementById('veiculo_id').value;
                const clienteId = document.getElementById('cliente_id').value;

                // ⚙️ Aqui poderia entrar uma chamada AJAX para validar no backend
                const existeAgendamento = false;
                if (existeAgendamento) {
                    alert('Não é possível agendar. Cliente, funcionário ou veículo já estão agendados para o mesmo horário e data.');
                } else {
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>
