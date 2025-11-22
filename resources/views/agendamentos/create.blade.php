<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            Criar Agendamento
        </h2>
    </x-slot>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div style="
            max-width:700px;
            margin:20px auto;
            background:rgba(76,175,80,0.15);
            border:1px solid rgba(76,175,80,0.35);
            color:#1b5e20;
            padding:12px 16px;
            border-radius:12px;
            font-size:15px;
        ">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card principal -->
    <div style="
        max-width:700px;
        margin:40px auto;
        background:#ffffff;
        padding:28px;
        border-radius:16px;
        border:1px solid #e6e6e6;
        box-shadow:0 6px 18px rgba(0,0,0,0.06);
    ">

        <form id="form-agendamento"
              action="{{ route('agendamentos.store') }}"
              method="POST"
              style="display:flex; flex-direction:column; gap:20px;">

            @csrf

            <!-- Data -->
            <div>
                <label style="font-weight:600;">Data:</label>
                <input type="date" name="data" id="data" required
                    style="
                        width:100%;
                        padding:12px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        margin-top:4px;
                    ">
            </div>

            <!-- Horário -->
            <div>
                <label style="font-weight:600;">Horário:</label>
                <input type="time" name="horario" id="horario" required
                    style="
                        width:100%;
                        padding:12px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        margin-top:4px;
                    ">
            </div>

            <!-- Funcionário -->
            <div>
                <label style="font-weight:600;">Funcionário:</label>
                <select name="funcionario_id" id="funcionario_id" required
                    style="
                        width:100%;
                        padding:12px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        margin-top:4px;
                    ">
                    <option value="">Selecione um funcionário</option>
                    @foreach($funcionarios as $funcionario)
                        <option value="{{ $funcionario->id }}">
                            {{ $funcionario->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Veículo -->
            <div>
                <label style="font-weight:600;">Veículo:</label>
                <select name="veiculo_id" id="veiculo_id" required
                    style="
                        width:100%;
                        padding:12px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        margin-top:4px;
                    ">
                    <option value="">Selecione um veículo</option>
                    @foreach($veiculos as $veiculo)
                        <option value="{{ $veiculo->id }}">
                            {{ $veiculo->modelo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Cliente -->
            <div>
                <label style="font-weight:600;">Cliente:</label>
                <select name="cliente_id" id="cliente_id" required
                    style="
                        width:100%;
                        padding:12px;
                        border-radius:10px;
                        border:1px solid #d0d0d0;
                        margin-top:4px;
                    ">
                    <option value="">Selecione um cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botões -->
            <div style="display:flex; gap:12px; margin-top:10px;">

                <!-- Salvar -->
                <button type="submit"
                    style="
                        padding:12px 20px;
                        background:#ff7a00;
                        border:none;
                        color:white;
                        font-weight:600;
                        border-radius:10px;
                        cursor:pointer;
                    "
                    onmouseover="this.style.background='#ff8f2b'"
                    onmouseout="this.style.background='#ff7a00'">
                    Salvar
                </button>

                <!-- Cancelar -->
                <a href="{{ route('agendamentos.index') }}"
                    style="
                        padding:12px 20px;
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

    <!-- Script (pode ser usado depois para validações avançadas) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-agendamento');
            form.addEventListener('submit', function () {
                // espaço para validação AJAX futura
            });
        });
    </script>

</x-app-layout>
