<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-white leading-tight">
            Editar Marca
        </h2>
    </x-slot>

    <!-- Card principal -->
    <div style="
        max-width: 750px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e6e6e6;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        padding: 32px;
        color: #333;
    ">

        <h3 style="font-size: 22px; font-weight: 600; margin-bottom: 22px;">
            Alterar informações da Marca
        </h3>

        <form action="{{ route('marcas.update', $marca->id) }}" method="POST"
              style="display:flex; flex-direction:column; gap:18px;">
            @csrf
            @method('PUT')

            <!-- Nome da marca -->
            <div>
                <label for="descricao" style="font-weight:600; color:#ff7a00;">
                    Nome da Marca:
                </label>
                <input type="text" name="descricao" id="descricao"
                       value="{{ $marca->descricao }}"
                       required
                       placeholder="Ex: Chevrolet, Ford..."
                       style="
                           width:100%;
                           padding:12px 14px;
                           border-radius:10px;
                           border:1px solid #d4d4d4;
                           font-size:15px;
                           margin-top:6px;
                       ">
            </div>

            <!-- Observação -->
            <div>
                <label for="observacao" style="font-weight:600; color:#ff7a00;">
                    Observação:
                </label>
                <input type="text" name="observacao" id="observacao"
                       value="{{ $marca->observacao }}"
                       placeholder="Informações adicionais (opcional)"
                       style="
                           width:100%;
                           padding:12px 14px;
                           border-radius:10px;
                           border:1px solid #d4d4d4;
                           font-size:15px;
                           margin-top:6px;
                       ">
            </div>

            <!-- Botões -->
            <div style="display:flex; gap:10px; margin-top:12px;">

                <button type="submit"
                    style="
                        padding:12px 20px;
                        background:linear-gradient(90deg,#ff6a00,#ff9500);
                        border:none;
                        border-radius:10px;
                        color:white;
                        font-weight:600;
                        cursor:pointer;
                        transition:.2s;
                    "
                    onmouseover="this.style.opacity='0.85'"
                    onmouseout="this.style.opacity='1'">
                    Salvar Alterações
                </button>

                <a href="{{ route('marcas.index') }}"
                   style="
                       padding:12px 20px;
                       background:#666;
                       color:white;
                       border-radius:10px;
                       font-weight:600;
                       text-decoration:none;
                       transition:.2s;
                   "
                   onmouseover="this.style.background='#555'"
                   onmouseout="this.style.background='#666'">
                    Cancelar
                </a>
            </div>

        </form>

    </div>

</x-app-layout>
