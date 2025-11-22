<x-app-layout>

    <!-- CABEÇALHO -->
    <x-slot name="header">
        <h2 style="font-size:24px; font-weight:600; color:#222;">
            Detalhes do Funcionário
        </h2>
    </x-slot>

    <!-- CARD CENTRAL -->
    <div style="
        max-width:600px;
        margin:40px auto;
        background:white;
        padding:28px;
        border-radius:16px;
        border:1px solid #e6e6e6;
        box-shadow:0 6px 18px rgba(0,0,0,0.06);
    ">

        <h3 style="font-size:20px; font-weight:600; color:#222; margin-bottom:22px;">
            Informações do Funcionário
        </h3>

        <!-- LISTA DE DADOS -->
        <div style="display:flex; flex-direction:column; gap:14px;">

            <!-- ID -->
            <div style="
                display:flex; 
                justify-content:space-between;
                border-bottom:1px solid #e6e6e6;
                padding-bottom:8px;
            ">
                <span style="color:#555; font-weight:600;">ID:</span>
                <span style="color:#222;">{{ $funcionario->id }}</span>
            </div>

            <!-- Nome -->
            <div style="
                display:flex; 
                justify-content:space-between;
                border-bottom:1px solid #e6e6e6;
                padding-bottom:8px;
            ">
                <span style="color:#555; font-weight:600;">Nome:</span>
                <span style="color:#222;">{{ $funcionario->nome }}</span>
            </div>

            <!-- Email -->
            <div style="
                display:flex; 
                justify-content:space-between;
                border-bottom:1px solid #e6e6e6;
                padding-bottom:8px;
            ">
                <span style="color:#555; font-weight:600;">E-mail:</span>
                <span style="color:#222;">{{ $funcionario->email }}</span>
            </div>

            <!-- Sexo -->
            <div style="
                display:flex; 
                justify-content:space-between;
                border-bottom:1px solid #e6e6e6;
                padding-bottom:8px;
            ">
                <span style="color:#555; font-weight:600;">Sexo:</span>
                <span style="color:#222;">
                    {{ $funcionario->sexo === 'M' ? 'Masculino' : 'Feminino' }}
                </span>
            </div>

        </div>

        <!-- BOTÃO VOLTAR -->
        <div style="margin-top:26px; text-align:right;">
            <a href="{{ route('funcionarios.index') }}"
               style="
                   padding:12px 20px;
                   border-radius:12px;
                   background:linear-gradient(90deg,#ff512f,#f09819);
                   color:white;
                   font-weight:600;
                   text-decoration:none;
               ">
                Voltar
            </a>
        </div>

    </div>

</x-app-layout>
