<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Editar Agendamento') }}
        </h2>
    </x-slot>

    <!-- 🔹 Conteúdo -->
    <div class="card">
        <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST" style="display:flex; flex-direction:column; gap:16px;">
            @csrf
            @method('PUT')

            <div>
                <label for="data">Data:</label><br>
                <input type="date" name="data" value="{{ $agendamento->data }}" required>
            </div>

            <div>
                <label for="horario">Horário:</label><br>
                <input type="time" name="horario" value="{{ $agendamento->horario }}" required>
            </div>

            <div>
                <label for="funcionario_id">Funcionário:</label><br>
                <select name="funcionario_id" id="funcionario_id" required>
                    <option value="">Selecione um funcionário</option>
                    @foreach ($funcionarios as $funcionario)
                        <option value="{{ $funcionario->id }}" {{ $agendamento->funcionario_id == $funcionario->id ? 'selected' : '' }}>
                            {{ $funcionario->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="veiculo_id">Veículo:</label><br>
                <select name="veiculo_id" id="veiculo_id" required>
                    <option value="">Selecione um veículo</option>
                    @foreach ($veiculos as $veiculo)
                        <option value="{{ $veiculo->id }}" {{ $agendamento->veiculo_id == $veiculo->id ? 'selected' : '' }}>
                            {{ $veiculo->modelo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="cliente_id">Cliente:</label><br>
                <select name="cliente_id" id="cliente_id" required>
                    <option value="">Selecione um cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $agendamento->cliente_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit">Salvar Alterações</button>
                <a href="{{ route('agendamentos.index') }}" class="btn" style="background:#666;">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
