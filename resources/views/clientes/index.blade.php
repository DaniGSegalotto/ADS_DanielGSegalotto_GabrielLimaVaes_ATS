<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h2 class="text-2xl font-semibold text-white leading-tight">
                {{ __('Lista de Clientes') }}
            </h2>

            <!-- 🔸 Botão de logout do cliente -->
            @auth('cliente')
                <form method="POST" action="{{ route('cliente.logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit"
                        style="padding:8px 14px;
                               background:#c0392b;
                               border:none;
                               border-radius:8px;
                               color:#fff;
                               font-weight:600;
                               cursor:pointer;
                               transition:background .2s ease;">
                        Sair
                    </button>
                </form>
            @endauth
        </div>
    </x-slot>

    <!-- 🔹 Conteúdo principal -->
    <div class="card" style="max-width: 1100px; margin: auto;">

        <!-- 🔸 Barra de busca -->
        <form action="{{ route('clientes.index') }}" method="GET"
            style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <input type="text" name="query" placeholder="Buscar clientes..."
                style="flex:1; padding:10px 14px; border-radius:12px; border:none;
                       background:rgba(255,255,255,0.1); color:#fff; outline:none;">
            <button type="submit"
                style="margin-left:8px; padding:10px 16px; border:none; border-radius:12px;
                       background:linear-gradient(90deg,#ff512f,#f09819); color:#fff;
                       font-weight:600; cursor:pointer;">
                Buscar
            </button>
        </form>

        <!-- 🔸 Botão para novo cliente -->
        <a href="{{ route('clientes.create') }}"
            style="display:inline-block; margin-bottom:16px; padding:10px 16px;
                   background:linear-gradient(90deg,#ff512f,#f09819);
                   border:none; border-radius:12px; color:#fff; font-weight:600;
                   text-decoration:none;">
            Novo Cliente
        </a>

        <!-- 🔸 Tabela de clientes -->
        <table style="width:100%; border-collapse:collapse; background:rgba(255,255,255,0.08);
                      border:1px solid rgba(255,255,255,0.15); border-radius:12px; overflow:hidden;">
            <thead>
                <tr style="background:rgba(255,255,255,0.15); color:#fff;">
                    <th style="padding:12px;">ID</th>
                    <th style="padding:12px;">NOME</th>
                    <th style="padding:12px;">TELEFONE</th>
                    <th style="padding:12px;">CPF</th>
                    <th style="padding:12px;">CNH</th>
                    <th style="padding:12px;">E-MAIL</th>
                    <th style="padding:12px;">OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                    <tr style="border-top:1px solid rgba(255,255,255,0.1); color:#fff;">
                        <td style="padding:10px 12px;">{{ $cliente->id }}</td>
                        <td style="padding:10px 12px;">{{ $cliente->nome }}</td>
                        <td style="padding:10px 12px;">{{ $cliente->telefone }}</td>
                        <td style="padding:10px 12px;">{{ $cliente->CPF }}</td>
                        <td style="padding:10px 12px;">{{ $cliente->CHN }}</td>
                        <td style="padding:10px 12px;">{{ $cliente->email }}</td>
                        <td style="padding:10px 12px;">
                            <!-- 🔹 Botões -->
                            <a href="{{ route('clientes.show', $cliente->id) }}"
                               style="padding:6px 10px; border-radius:8px; background:rgba(255,255,255,0.15);
                                      color:#fff; text-decoration:none; font-size:13px;">
                                Detalhes
                            </a>

                            <a href="{{ route('clientes.edit', $cliente->id) }}"
                               style="padding:6px 10px; border-radius:8px;
                                      background:linear-gradient(90deg,#ff512f,#f09819);
                                      color:#fff; text-decoration:none; font-size:13px;">
                                Editar
                            </a>

                            <form id="form-{{ $cliente->id }}" action="{{ route('clientes.destroy', $cliente->id) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletarCliente({{ $cliente->id }})"
                                        style="padding:6px 10px; border-radius:8px; border:none;
                                               background:#c0392b; color:#fff; cursor:pointer; font-size:13px;">
                                    Excluir
                                </button>
                                <button type="button" onclick="infoCliente({{ $cliente->id }})"
                                        style="padding:6px 10px; border-radius:8px; border:none;
                                               background:#444; color:#fff; cursor:pointer; font-size:13px;">
                                    Info
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:14px; color:#ccc;">
                            Nenhum cliente encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- 🔹 SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deletarCliente(id) {
            Swal.fire({
                title: 'Excluir cliente?',
                text: "Esta ação não pode ser desfeita.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff512f',
                cancelButtonColor: '#555',
                confirmButtonText: 'Sim, excluir!',
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
                confirmButtonColor: '#ff512f'
            });
        }
    </script>
</x-app-layout>
