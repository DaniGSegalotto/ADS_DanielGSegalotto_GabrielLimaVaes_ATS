<x-app-layout>

    <!-- CABEÇALHO -->
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h2 style="font-size:24px; font-weight:600; color:#222;">
                Lista de Funcionários
            </h2>
        </div>
    </x-slot>

    <!-- CONTAINER PRINCIPAL -->
    <div style="
        max-width:1150px;
        margin:40px auto;
        background:white;
        padding:28px;
        border-radius:16px;
        border:1px solid #e6e6e6;
        box-shadow:0 6px 18px rgba(0,0,0,0.06);
    ">

<!-- BARRA DE BUSCA -->
<form action="{{ route('funcionarios.index') }}" method="GET"
      style="display:flex; gap:12px; margin-bottom:25px; flex-wrap:wrap;">

    <input type="text" name="query" placeholder="Buscar funcionários..."
        style="
            flex:1;
            padding:12px 16px;
            border-radius:10px;
            border:1px solid #d0d0d0;
            font-size:15px;
        "
        value="{{ $query ?? '' }}"
        autocomplete="off"
    >

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

    <a href="{{ route('funcionarios.create') }}"
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
        Novo Funcionário
    </a>
</form>


        <!-- TABELA -->
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
                        <th style="padding:14px; text-align:left;">E-mail</th>
                        <th style="padding:14px; text-align:left;">Sexo</th>
                        <th style="padding:14px; text-align:left;">Opções</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($funcionarios as $funcionario)
                        <tr style="border-bottom:1px solid #eee; transition:0.2s;"
                            onmouseover="this.style.background='#fafafa'"
                            onmouseout="this.style.background='white'">

                            <td style="padding:12px;">{{ $funcionario->id }}</td>
                            <td style="padding:12px;">{{ $funcionario->nome }}</td>
                            <td style="padding:12px;">{{ $funcionario->email }}</td>
                            <td style="padding:12px;">
                                {{ $funcionario->sexo === 'M' ? 'Masculino' : 'Feminino' }}
                            </td>

                            <!-- BUTÕES -->
                            <td style="padding:12px; white-space:nowrap; display:flex; gap:6px;">

                                <!-- Detalhes -->
                                <a href="{{ route('funcionarios.show', $funcionario->id) }}"
                                    style="
                                        padding:6px 10px;
                                        background:#008cff;
                                        color:white;
                                        border-radius:6px;
                                        font-size:13px;
                                        text-decoration:none;
                                    "
                                    onmouseover="this.style.background='#0b7fe6'"
                                    onmouseout="this.style.background='#008cff'">
                                    Detalhes
                                </a>

                                <!-- Editar -->
                                <a href="{{ route('funcionarios.edit', $funcionario->id) }}"
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

                                <!-- Excluir -->
                                <form id="form-{{ $funcionario->id }}"
                                      action="{{ route('funcionarios.destroy', $funcionario->id) }}"
                                      method="POST">
                                    @csrf @method('DELETE')

                                    <button type="button"
                                        onclick="deletarFuncionario({{ $funcionario->id }})"
                                        style="
                                            padding:6px 10px;
                                            background:#e63946;
                                            color:white;
                                            border:none;
                                            border-radius:6px;
                                            font-size:13px;
                                            cursor:pointer;
                                        "
                                        onmouseover="this.style.background='#c42e3a'"
                                        onmouseout="this.style.background='#e63946'">
                                        Excluir
                                    </button>
                                </form>

                                <!-- Info -->
                                <button type="button"
                                    onclick="infoFuncionario({{ $funcionario->id }})"
                                    style="
                                        padding:6px 10px;
                                        background:#555;
                                        color:white;
                                        border:none;
                                        border-radius:6px;
                                        font-size:13px;
                                        cursor:pointer;
                                    "
                                    onmouseover="this.style.background='#444'"
                                    onmouseout="this.style.background='#555'">
                                    Info
                                </button>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" style="padding:20px; text-align:center; color:#777;">
                                Nenhum funcionário encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deletarFuncionario(id) {
            Swal.fire({
                title: 'Excluir funcionário?',
                text: 'Esta ação não poderá ser desfeita.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff7a00',
                cancelButtonColor: '#555',
                confirmButtonText: 'Excluir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-${id}`).submit();
                }
            });
        }

        function infoFuncionario(id) {
            Swal.fire({
                title: 'Info',
                text: 'Funcionário ID: ' + id,
                icon: 'info',
                confirmButtonColor: '#ff7a00'
            });
        }
    </script>

</x-app-layout>
