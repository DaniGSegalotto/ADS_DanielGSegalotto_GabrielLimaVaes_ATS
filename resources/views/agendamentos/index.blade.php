<x-app-layout>
    <!-- Inclui um arquivo CSS específico para estilização da página de índice de veículos -->
    <link rel="stylesheet" href="{{ asset('css/clientes/index.css') }}">
    <!-- Cabeçalho da página -->
    <x-slot name="header">
        <!-- Título da página -->
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Lista de Agendamentos') }}
        </h2>
    </x-slot>

    <div class="container">
        <!-- Formulário de busca -->
        <form action="{{ route('agendamentos.index') }}" method="GET" class="search-form">
            <div class="search-container">  
            </div>
        </form>

        <!-- Botão para adicionar um novo agendamento -->
        <a href="{{ route('agendamentos.create') }}" class="btn btn-primary">Novo Agendamento</a>

        <!-- Tabela de agendamentos -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DATA</th>
                    <th>HORARIO</th>
                    <th>FUNCIONARIO</th>
                    <th>VEICULO</th>
                    <th>CLIENTE</th>
                    <th>OPÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop através dos agendamentos para exibir informações na tabela -->
                @foreach ($agendamentos as $agendamento)
                    <tr>
                        <!-- Exibe o ID do agendamento -->
                        <td>{{ $agendamento->id }}</td>
                        <!-- Exibe a data do agendamento -->
                        <td>{{ $agendamento->data }}</td>
                        <!-- Exibe o horário do agendamento -->
                        <td>{{ $agendamento->horario }}</td>
                        <!-- Exibe o nome do funcionário associado ao agendamento -->
                        <td>{{ $agendamento->funcionario->nome }}</td>
                        <!-- Exibe o modelo do veículo associado ao agendamento -->
                        <td>{{ $agendamento->veiculo->modelo }}</td>
                        <!-- Exibe o nome do cliente associado ao agendamento -->
                        <td>{{ $agendamento->cliente->nome }}</td>
                        <td>
                            <!-- Botões de ações para cada agendamento -->
                            <!-- Botão para ver detalhes do agendamento -->
                            <a href="{{ route('agendamentos.show', $agendamento->id) }}" class="btn btn-info">Detalhes</a>
                            <!-- Botão para editar o agendamento -->
                            <a href="{{ route('agendamentos.edit', $agendamento->id) }}" class="btn btn-warning">Editar</a>
                            <!-- Formulário para excluir o agendamento -->
                            <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST" style="display: inline;">
                                @csrf <!-- Token CSRF para proteção contra ataques CSRF -->
                                @method('DELETE') <!-- Método HTTP DELETE para exclusão -->
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
