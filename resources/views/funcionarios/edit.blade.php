<x-app-layout>
    <!-- Define o cabeçalho da página -->
    <x-slot name="header">
        <!-- Importa um arquivo CSS específico para estilização de edição de funcionários -->
        <link rel="stylesheet" href="{{ asset('css/clientes/edit.css') }}">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Editar Funcionário
        </h2>
    </x-slot>
    <div class="container">
        <!-- Formulário para editar informações do funcionário -->
        <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST">
            @csrf <!-- Token CSRF para proteção contra ataques CSRF -->
            @method('PUT') <!-- Método HTTP para indicar que é uma atualização -->
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="{{ $funcionario->nome }}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ $funcionario->email }}">
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <!-- Menu suspenso para selecionar o sexo do funcionário -->
                <select name="sexo">
                    <!-- Define opções de seleção para sexo, com uma verificação para selecionar a opção correta com base no sexo atual do funcionário -->
                    <option value="M" {{ $funcionario->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ $funcionario->sexo == 'F' ? 'selected' : '' }}>Feminino</option>
                </select>
            </div>
            <!-- Adicione outros campos conforme necessário -->
            <!-- Botão para submeter o formulário e salvar as alterações -->
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <!-- Link para cancelar a operação e voltar à página de índice de funcionários -->
            <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</x-app-layout>
