<x-app-layout>

    <!-- Cabeçalho -->
    <x-slot name="header">
        <h2 style="font-size:24px; font-weight:600; color:#222;">
            Editar Veículo
        </h2>
    </x-slot>

    <!-- Erros -->
    @if ($errors->any())
        <div style="
            max-width:700px; margin:20px auto;
            background:rgba(255,82,82,0.12);
            color:#b71c1c;
            border:1px solid rgba(255,82,82,0.4);
            padding:12px 16px;
            border-radius:10px;
        ">
            <strong>Erros encontrados:</strong>
            <ul style="margin-left:18px; margin-top:6px;">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card -->
    <div style="
        max-width:700px;
        margin:40px auto;
        background:#ffffff;
        padding:32px;
        border-radius:18px;
        border:1px solid #e4e4e4;
        box-shadow:0 8px 22px rgba(0,0,0,0.06);
    ">

        <h3 style="font-size:20px; font-weight:600; color:#222; margin-bottom:22px;">
            Atualizar Informações do Veículo
        </h3>

        <form action="{{ route('veiculos.update', $veiculo->id) }}"
              method="POST" 
              enctype="multipart/form-data"
              style="display:flex; flex-direction:column; gap:18px;">
              
            @csrf
            @method('PUT')

            <!-- Modelo -->
            <div>
                <label for="modelo" style="color:#ff7a00; font-weight:600;">Modelo</label>
                <input type="text" id="modelo" name="modelo"
                       value="{{ old('modelo', $veiculo->modelo) }}"
                       placeholder="Ex: Strada 1.4"
                       style="width:100%; padding:12px 14px;
                              border-radius:12px; border:1px solid #d0d0d0;">
            </div>

            <!-- Categoria -->
            <div>
                <label for="categoria" style="color:#ff7a00; font-weight:600;">Categoria</label>
                <input type="text" id="categoria" name="categoria"
                       value="{{ old('categoria', $veiculo->categoria) }}"
                       placeholder="Ex: Utilitário"
                       style="width:100%; padding:12px 14px;
                              border-radius:12px; border:1px solid #d0d0d0;">
            </div>

            <!-- Placa -->
            <div>
                <label for="placa" style="color:#ff7a00; font-weight:600;">Placa</label>
                <input type="text" id="placa" name="placa"
                       value="{{ old('placa', $veiculo->placa) }}"
                       placeholder="Ex: ABC-1234"
                       style="width:100%; padding:12px 14px;
                              border-radius:12px; border:1px solid #d0d0d0;">
            </div>

            <!-- Ano -->
            <div>
                <label for="ano" style="color:#ff7a00; font-weight:600;">Ano</label>
                <input type="number" id="ano" name="ano"
                       value="{{ old('ano', $veiculo->ano) }}"
                       placeholder="Ex: 2020"
                       style="width:100%; padding:12px 14px;
                              border-radius:12px; border:1px solid #d0d0d0;">
            </div>

            <!-- Marca -->
            <div>
                <label for="marca_id" style="color:#ff7a00; font-weight:600;">Marca</label>
                <select id="marca_id" name="marca_id"
                        style="width:100%; padding:12px 14px;
                               border-radius:12px; border:1px solid #d0d0d0;">
                    <option value="">Selecione</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}"
                            {{ old('marca_id', $veiculo->marca_id) == $marca->id ? 'selected' : '' }}>
                            {{ $marca->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div>
                <label for="status_id" style="color:#ff7a00; font-weight:600;">Status</label>
                <select id="status_id" name="status_id" required
                        style="width:100%; padding:12px 14px;
                            border-radius:12px; border:1px solid #d0d0d0;">
                    <option value="" disabled hidden>Selecione</option>

                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}"
                            {{ old('status_id', $veiculo->status_id) == $status->id ? 'selected' : '' }}>
                            {{ $status->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Imagem atual -->
            @if($veiculo->imagem)
                <div>
                    <label style="color:#ff7a00; font-weight:600;">Imagem Atual</label><br>
                    <img src="{{ asset('storage/'.$veiculo->imagem) }}"
                         style="width:180px; border-radius:12px; margin-top:8px;">
                </div>
            @endif

            <!-- Upload nova imagem -->
            <div>
                <label for="imagem" style="color:#ff7a00; font-weight:600;">Alterar Imagem</label>
                <input type="file" id="imagem" name="imagem" accept="image/*"
                       style="width:100%; padding:12px 14px;
                              border-radius:12px; border:1px solid #d0d0d0;">
            </div>

            <!-- Botões -->
            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit"
                        style="padding:12px 20px;
                               background:linear-gradient(90deg,#ff6a00,#ff9500);
                               color:white; border:none; border-radius:12px;
                               font-weight:600; cursor:pointer;">
                    Salvar Alterações
                </button>

                <a href="{{ route('veiculos.index') }}"
                   style="padding:12px 20px;
                          background:#666; color:white;
                          border-radius:12px; text-decoration:none;
                          font-weight:600;">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</x-app-layout>
