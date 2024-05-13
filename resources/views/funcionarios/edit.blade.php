<x-app-layout>
    <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('css/clientes/edit.css') }}">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Editar Funcionário
        </h2>
    </x-slot>
    <div class="container">
        <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST">
            @csrf
            @method('PUT')
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
                <select name="sexo">
                    <option value="M" {{ $funcionario->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ $funcionario->sexo == 'F' ? 'selected' : '' }}>Feminino</option>
                </select>
            </div>
            <!-- Adicione outros campos conforme necessário -->
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</x-app-layout>
