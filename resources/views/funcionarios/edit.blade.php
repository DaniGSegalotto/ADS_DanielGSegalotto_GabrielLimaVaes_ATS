<x-app-layout>

    {{-- Cabeçalho --}}
    <x-slot name="header">
        <h2 style="font-size: 26px; font-weight: 600; color: #333;">
            Editar Funcionário
        </h2>
    </x-slot>

    {{-- Container principal --}}
    <div style="
        max-width: 700px;
        margin: 40px auto;
        background: #ffffff;
        border: 1px solid #e4e4e4;
        padding: 32px;
        border-radius: 18px;
        box-shadow: 0 8px 22px rgba(0,0,0,0.06);
    ">

        <h3 style="
            font-size: 20px;
            font-weight: 600;
            color: #222;
            margin-bottom: 25px;
        ">
            Atualizar Informações do Funcionário
        </h3>

        {{-- Formulário --}}
        <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST"
              style="display:flex; flex-direction:column; gap:20px;">
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <div style="display:flex; flex-direction:column; gap:6px;">
                <label for="nome" style="font-weight:600; color:#ff7a00;">Nome:</label>
                <input type="text" name="nome" id="nome" value="{{ $funcionario->nome }}" required
                       style="
                           padding:12px 14px;
                           border-radius:10px;
                           border:1px solid #d6d6d6;
                           background:#fff;
                           outline:none;
                       ">
            </div>

            {{-- Email --}}
            <div style="display:flex; flex-direction:column; gap:6px;">
                <label for="email" style="font-weight:600; color:#ff7a00;">E-mail:</label>
                <input type="email" name="email" id="email" value="{{ $funcionario->email }}" required
                       style="
                           padding:12px 14px;
                           border-radius:10px;
                           border:1px solid #d6d6d6;
                           background:#fff;
                           outline:none;
                       ">
            </div>

            {{-- Sexo --}}
            <div style="display:flex; flex-direction:column; gap:6px;">
                <label for="sexo" style="font-weight:600; color:#ff7a00;">Sexo:</label>
                <select name="sexo" id="sexo" required
                        style="
                            padding:12px 14px;
                            border-radius:10px;
                            border:1px solid #d6d6d6;
                            background:#fff;
                            outline:none;
                        ">
                    <option value="M" {{ $funcionario->sexo == 'M' ? 'selected' : '' }}>
                        Masculino
                    </option>
                    <option value="F" {{ $funcionario->sexo == 'F' ? 'selected' : '' }}>
                        Feminino
                    </option>
                </select>
            </div>

            {{-- Botões --}}
            <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:10px;">

                <a href="{{ route('funcionarios.index') }}"
                   style="
                       padding:12px 20px;
                       background:#666;
                       color:white;
                       border-radius:10px;
                       font-weight:600;
                       text-decoration:none;
                       transition:.2s;
                   "
                   onmouseover="this.style.opacity='.85'"
                   onmouseout="this.style.opacity='1'">
                    Cancelar
                </a>

                <button type="submit"
                        style="
                            padding:12px 20px;
                            background:linear-gradient(90deg,#ff6a00,#ff9500);
                            color:white;
                            border:none;
                            border-radius:10px;
                            font-weight:600;
                            cursor:pointer;
                            transition:.2s;
                        "
                        onmouseover="this.style.opacity='.85'"
                        onmouseout="this.style.opacity='1'">
                    Salvar Alterações
                </button>

            </div>

        </form>
    </div>

</x-app-layout>
