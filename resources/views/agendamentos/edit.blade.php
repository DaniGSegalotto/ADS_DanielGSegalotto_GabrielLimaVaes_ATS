<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            Editar Agendamento
        </h2>
    </x-slot>

    <!-- Container principal -->
    <div style="
        max-width:700px;
        margin:40px auto;
        background:#ffffff;
        padding:28px;
        border-radius:16px;
        border:1px solid #e6e6e6;
        box-shadow:0 6px 18px rgba(0,0,0,0.06);
    ">

        <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST" style="display:flex; flex-direction:column; gap:20px;">
            @csrf
            @method('PUT')

            <!-- Campo Data -->
            <div>
                <label style="font-weight:600;">Data:</label>
                <input type="date" name="data" value="{{ $agendamento->data }}" required
                    style="
                        width:100%;
                        padding:10px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        margin-top:4px;
                    ">
            </div>

            <!-- Campo Horário -->
            <div>
                <label style="font-weight:600;">Horário:</label>
                <input type="time" name="horario" value="{{ $agendamento->horario }}" required
                    style="
                        width:100%;
                        padding:10px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        margin-top:4px;
                    ">
            </div>

            <!-- Campo Funcionário -->
            <div>
                <label style="font-weight:600;">Funcionário:</label>
                <select name="funcionario_id" required
                    style="
                        width:100%;
                        padding:10px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        margin-top:4px;
                    ">
                    <option value="">Selecione um funcionário</option>
                    @foreach ($funcionarios as $funcionario)
                        <option value="{{ $funcionario->id }}" {{ $agendamento->funcionario_id == $funcionario->id ? 'selected' : '' }}>
                            {{ $funcionario->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Campo Veículo -->
            <div>
                <label style="font-weight:600;">Veículo:</label>
                <select name="veiculo_id" required
                    style="
                        width:100%;
                        padding:10px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        margin-top:4px;
                    ">
                    <option value="">Selecione um veículo</option>
                    @foreach ($veiculos as $veiculo)
                        <option value="{{ $veiculo->id }}" {{ $agendamento->veiculo_id == $veiculo->id ? 'selected' : '' }}>
                            {{ $veiculo->modelo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Campo Cliente -->
            <div>
                <label style="font-weight:600;">Cliente:</label>
                <select name="cliente_id" required
                    style="
                        width:100%;
                        padding:10px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        margin-top:4px;
                    ">
                    <option value="">Selecione um cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $agendamento->cliente_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botões -->
            <div style="display:flex; gap:12px; margin-top:10px;">

                <button type="submit"
                    style="
                        padding:10px 20px;
                        background:#ff7a00;
                        border:none;
                        color:white;
                        font-weight:600;
                        border-radius:10px;
                        cursor:pointer;
                    "
                    onmouseover="this.style.background='#ff8f2b'"
                    onmouseout="this.style.background='#ff7a00'">
                    Salvar Alterações
                </button>

                <a href="{{ route('agendamentos.index') }}"
                    style="
                        padding:10px 20px;
                        background:#666;
                        color:white;
                        border-radius:10px;
                        text-decoration:none;
                        font-weight:600;
                    "
                    onmouseover="this.style.opacity='0.85'"
                    onmouseout="this.style.opacity='1'">
                    Cancelar
                </a>
            </div>

        </form>

    </div>

</x-app-layout>
