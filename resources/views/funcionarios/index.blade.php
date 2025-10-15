<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Lista de Funcionários') }}
        </h2>
    </x-slot>

    <!-- 🔹 Container principal -->
    <div class="card" style="max-width: 1000px; margin: auto;">
        
        <!-- 🔸 Barra de busca -->
        <form action="{{ route('funcionarios.index') }}" method="GET" 
              style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <input type="text" name="query" placeholder="Buscar Funcionários..." 
                   style="flex:1; padding:10px 14px; border-radius:12px; border:none;
                          background:rgba(255,255,255,0.1); color:#fff; outline:none;">
            <button type="submit" 
                    style="margin-left:8px; padding:10px 16px; border:none; border-radius:12px;
                           background:linear-gradient(90deg,#ff512f,#f09819); color:#fff;
                           font-weight:600; cursor:pointer;">
                Buscar
            </button>
        </form>

        <!-- 🔸 Botão Novo Funcionário -->
        <a href="{{ route('funcionarios.create') }}" 
           style="display:inline-block; margin-bottom:16px; padding:10px 16px;
                  background:linear-gradient(90deg,#ff512f,#f09819);
                  border:none; border-radius:12px; color:#fff; font-weight:600;
                  text-decoration:none;">
            Novo Funcionário
        </a>

        <!-- 🔸 Tabela de Funcionários -->
        <table style="width:100%; border-collapse:collapse; background:rgba(255,255,255,0.08);
                      border:1px solid rgba(255,255,255,0.15); border-radius:12px; overflow:hidden;">
            <thead>
                <tr style="background:rgba(255,255,255,0.15); color:#fff;">
                    <th style="padding:12px;">ID</th>
                    <th style="padding:12px;">NOME</th>
                    <th style="padding:12px;">E-MAIL</th>
                    <th style="padding:12px;">SEXO</th>
                    <th style="padding:12px;">OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($funcionarios as $funcionario)
                    <tr style="border-top:1px solid rgba(255,255,255,0.1); color:#fff;">
                        <td style="padding:10px 12px;">{{ $funcionario->id }}</td>
                        <td style="padding:10px 12px;">{{ $funcionario->nome }}</td>
                        <td style="padding:10px 12px;">{{ $funcionario->email }}</td>
                        <td style="padding:10px 12px;">
                            {{ $funcionario->sexo == 'M' ? 'Masculino' : 'Feminino' }}
                        </td>
                        <td style="padding:10px 12px;">
                            <!-- 🔹 Botões de ação -->
                            <a href="{{ route('funcionarios.show', $funcionario->id) }}" 
                               style="padding:6px 10px; border-radius:8px; background:rgba(255,255,255,0.15);
                                      color:#fff; text-decoration:none; font-size:13px;">
                                Detalhes
                            </a>

                            <a href="{{ route('funcionarios.edit', $funcionario->id) }}" 
                               style="padding:6px 10px; border-radius:8px;
                                      background:linear-gradient(90deg,#ff512f,#f09819);
                                      color:#fff; text-decoration:none; font-size:13px;">
                                Editar
                            </a>

                            <form id="form-{{ $funcionario->id }}" action="{{ route('funcionarios.destroy', $funcionario->id) }}" 
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletarFuncionario({{ $funcionario->id }})"
                                        style="padding:6px 10px; border-radius:8px; border:none;
                                               background:#c0392b; color:#fff; cursor:pointer; font-size:13px;">
                                    Excluir
                                </button>
                                <button type="button" onclick="infoFuncionario({{ $funcionario->id }})"
                                        style="padding:6px 10px; border-radius:8px; border:none;
                                               background:#444; color:#fff; cursor:pointer; font-size:13px;">
                                    Info
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:14px; color:#ccc;">
                            Nenhum funcionário encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- 🔹 SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deletarFuncionario(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "O funcionário será removido permanentemente!",
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

        function infoFuncionario(id) {
            Swal.fire({
                title: 'Informação do Funcionário',
                text: `ID: ${id}`,
                icon: 'info',
                confirmButtonColor: '#ff512f'
            });
        }
    </script>
</x-app-layout>
