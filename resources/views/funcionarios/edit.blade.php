<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            {{ __('Editar Funcionário') }}
        </h2>
    </x-slot>

    <!-- 🔹 Container principal -->
    <div class="card" style="max-width: 700px; margin: auto;">
        <h3 style="font-size:20px; margin-bottom:16px;">Atualizar informações do funcionário</h3>

        <!-- 🔸 Formulário -->
        <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST" 
              style="display:flex; flex-direction:column; gap:16px;">
            @csrf
            @method('PUT')

            <div>
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" id="nome" value="{{ $funcionario->nome }}" required>
            </div>

            <div>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" value="{{ $funcionario->email }}" required>
            </div>

            <div>
                <label for="sexo">Sexo:</label><br>
                <select name="sexo" id="sexo" required>
                    <option value="M" {{ $funcionario->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ $funcionario->sexo == 'F' ? 'selected' : '' }}>Feminino</option>
                </select>
            </div>

            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit">Salvar Alterações</button>
                <a href="{{ route('funcionarios.index') }}" class="btn" style="background:#666;">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- 🔹 Script opcional: validação leve -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', (e) => {
                const nome = document.getElementById('nome').value.trim();
                const email = document.getElementById('email').value.trim();
                if (nome === '' || email === '') {
                    e.preventDefault();
                    alert('Por favor, preencha todos os campos obrigatórios.');
                }
            });
        });
    </script>
</x-app-layout>
