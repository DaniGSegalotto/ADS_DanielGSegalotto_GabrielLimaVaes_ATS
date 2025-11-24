<x-app-layout>

    <x-slot name="header">
        <h2 style="font-size:24px; font-weight:600; color:#222;">
            Cadastrar Novo Veículo
        </h2>
    </x-slot>

    <!-- Mensagens -->
    @if(session('success'))
        <div style="
            max-width:700px; margin:20px auto;
            background:rgba(76,175,80,0.12);
            color:#2e7d32;
            border:1px solid rgba(76,175,80,0.4);
            padding:12px 16px;
            border-radius:10px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="
            max-width:700px; margin:20px auto;
            background:rgba(255,82,82,0.12);
            color:#b71c1c;
            border:1px solid rgba(255,82,82,0.4);
            padding:12px 16px;
            border-radius:10px;">
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
            Informações do Veículo
        </h3>

        <form action="{{ route('veiculos.store') }}" method="POST" enctype="multipart/form-data"
              style="display:flex; flex-direction:column; gap:18px;">
            @csrf

            <!-- Modelo -->
            <div>
                <label style="color:#ff7a00; font-weight:600;">Modelo</label>
                <input type="text" name="modelo" value="{{ old('modelo') }}"
                       placeholder="Ex: Strada 1.4"
                       style="width:100%; padding:12px 14px; border-radius:12px; border:1px solid #d0d0d0;">
            </div>

            <!-- Categoria -->
            <div>
                <label style="color:#ff7a00; font-weight:600;">Categoria</label>
                <input type="text" name="categoria" value="{{ old('categoria') }}"
                       placeholder="Ex: Utilitário"
                       style="width:100%; padding:12px 14px; border-radius:12px; border:1px solid #d0d0d0;">
            </div>

            <!-- Placa -->
            <div>
                <label style="color:#ff7a00; font-weight:600;">Placa</label>
                <input type="text" name="placa" value="{{ old('placa') }}"
                       placeholder="Ex: ABC-1234"
                       style="width:100%; padding:12px 14px; border-radius:12px; border:1px solid #d0d0d0;">
            </div>

            <!-- Ano -->
            <div>
                <label style="color:#ff7a00; font-weight:600;">Ano</label>
                <input type="number" name="ano" value="{{ old('ano') }}"
                       placeholder="Ex: 2020"
                       style="width:100%; padding:12px 14px; border-radius:12px; border:1px solid #d0d0d0;">
            </div>

            <!-- Marca -->
            <div>
                <label style="color:#ff7a00; font-weight:600;">Marca</label>
                <select name="marca_id"
                        style="width:100%; padding:12px 14px; border-radius:12px; border:1px solid #d0d0d0;">
                    <option value="">Selecione</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}"
                            {{ old('marca_id') == $marca->id ? 'selected' : '' }}>
                            {{ $marca->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div>
                <label style="color:#ff7a00; font-weight:600;">Status</label>
                <select name="status_id" required
                        style="width:100%; padding:12px 14px; border-radius:12px; border:1px solid #d0d0d0;">
                    <option value="" disabled selected hidden>Selecione</option>

                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}"
                            {{ old('status_id') == $status->id ? 'selected' : '' }}>
                            {{ $status->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- IMAGEM -->
            <div>
                <label style="color:#ff7a00; font-weight:600;">Imagem do Veículo</label>
                <input type="file" name="imagem" accept="image/*"
                       style="width:100%; padding:12px 14px; border-radius:12px; border:1px solid #d0d0d0;">
            </div>

            <!-- Botões -->
            <div style="display:flex; gap:10px; margin-top:10px;">
                <button type="submit"
                        style="padding:12px 20px; background:linear-gradient(90deg,#ff6a00,#ff9500);
                               color:white; border:none; border-radius:12px; font-weight:600; cursor:pointer;">
                    Salvar
                </button>

                <a href="{{ route('veiculos.index') }}"
                   style="padding:12px 20px; background:#666; color:white; border-radius:12px;
                          text-decoration:none; font-weight:600;">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

</x-app-layout>
