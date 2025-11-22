<x-app-layout>

    <!-- TÍTULO + LOGO -->
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0;">

            <a href="/ATS" style="display:flex; align-items:center;">
                <img src="/img/ATS.png" alt="Logo ATS" style="height:42px;">
            </a>

            <h2 style="font-size:24px; font-weight:600; color:#222;">
                Lista de Clientes
            </h2>

            @auth('cliente')
                <form method="POST" action="{{ route('cliente.logout') }}">
                    @csrf
                    <button type="submit"
                        style="background:#e63946; color:white; padding:8px 14px;
                               border:none; border-radius:8px; font-weight:600; cursor:pointer;">
                        Sair
                    </button>
                </form>
            @endauth
        </div>
    </x-slot>


    <!-- CONTAINER -->
    <div style="
        max-width:1150px;
        margin:40px auto;
        background:white;
        padding:28px;
        border-radius:16px;
        border:1px solid #e6e6e6;
        box-shadow:0 6px 18px rgba(0,0,0,0.06);
    ">

        <!-- BUSCA -->
        <form action="{{ route('clientes.index') }}" method="GET"
              style="display:flex; gap:12px; margin-bottom:25px; flex-wrap:wrap;">

            <input type="text" name="query" placeholder="Buscar clientes..."
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

            <a href="{{ route('clientes.create') }}"
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
                Novo Cliente
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
                        <th style="padding:14px; text-align:left;">Telefone</th>
                        <th style="padding:14px; text-align:left;">CPF</th>
                        <th style="padding:14px; text-align:left;">CNH</th>
                        <th style="padding:14px; text-align:left;">E-mail</th>
                        <th style="padding:14px; text-align:left;">Opções</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr style="border-bottom:1px solid #eee; transition:0.2s;"
                            onmouseover="this.style.background='#fafafa'"
                            onmouseout="this.style.background='white'">

                            <td style="padding:12px;">{{ $cliente->id }}</td>
                            <td style="padding:12px;">{{ $cliente->nome }}</td>
                            <td style="padding:12px;">{{ $cliente->telefone }}</td>
                            <td style="padding:12px;">{{ $cliente->CPF }}</td>
                            <td style="padding:12px;">{{ $cliente->CHN }}</td>
                            <td style="padding:12px;">{{ $cliente->email }}</td>

                            <!-- BOTÕES -->
                            <td style="padding:12px; white-space:nowrap; display:flex; gap:6px;">

                                <!-- Detalhes -->
                                <a href="{{ route('clientes.show', $cliente->id) }}"
                                    style="
                                        padding:6px 10px;
                                        background:#008cff;
                                        color:white;
                                        border-radius:6px;
                                        font-size:13px;
                                        text-decoration:none;
                                        transition:0.2s;
                                    "
                                    onmouseover="this.style.background='#0b7fe6'"
                                    onmouseout="this.style.background='#008cff'">
                                    Detalhes
                                </a>

                                <!-- Editar -->
                                <a href="{{ route('clientes.edit', $cliente->id) }}"
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
                                <form id="form-{{ $cliente->id }}"
                                      action="{{ route('clientes.destroy', $cliente->id) }}"
                                      method="POST">
                                    @csrf @method('DELETE')

                                    <button type="button"
                                        onclick="deletarCliente({{ $cliente->id }})"
                                        style="
                                            padding:6px 10px;
                                            background:#e63946;
                                            color:white;
                                            border:none;
                                            border-radius:6px;
                                            font-size:13px;
                                            cursor:pointer;
                                            transition:0.2s;
                                        "
                                        onmouseover="this.style.background='#c42e3a'"
                                        onmouseout="this.style.background='#e63946'">
                                        Excluir
                                    </button>
                                </form>

                                <!-- Info -->
                                <button type="button"
                                    onclick="infoCliente({{ $cliente->id }})"
                                    style="
                                        padding:6px 10px;
                                        background:#555;
                                        color:white;
                                        border:none;
                                        border-radius:6px;
                                        font-size:13px;
                                        cursor:pointer;
                                        transition:0.2s;
                                    "
                                    onmouseover="this.style.background='#444'"
                                    onmouseout="this.style.background='#555'">
                                    Info
                                </button>

                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" style="padding:20px; text-align:center; color:#777;">
                                Nenhum cliente encontrado.
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
        function deletarCliente(id) {
            Swal.fire({
                title: 'Excluir cliente?',
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

        function infoCliente(id) {
            Swal.fire({
                title: 'Informação',
                text: `Cliente ID: ${id}`,
                icon: 'info',
                confirmButtonColor: '#ff7a00'
            });
        }
    </script>

</x-app-layout>
