@extends('layouts.app_cliente')

@section('content')

<style>
/* ======================================================
      PREMIUM ATS – PÁGINA DE PERFIL DO CLIENTE
======================================================== */

/* Container */
.profile-wrapper {
    max-width: 680px;
    margin: 0 auto;
}

/* Título */
.profile-title {
    font-size: 28px;
    font-weight: 900;
    color: #222;
    margin-bottom: 20px;
}

/* Mensagem de sucesso */
.flash {
    background: rgba(119,255,168,.16);
    border: 1px solid rgba(119,255,168,.45);
    color: #1b5e20;
    padding: 12px 15px;
    border-radius: 12px;
    font-size: 15px;
    margin-bottom: 20px;
}

/* Labels */
label {
    display: block;
    font-size: 15px;
    font-weight: 600;
    color: #333;
    margin-bottom: 6px;
}

/* Inputs */
.input-field {
    width: 100%;
    padding: 12px 14px;
    border-radius: 14px;
    background: rgba(255,255,255,0.65);
    border: 1px solid rgba(0,0,0,0.12);
    backdrop-filter: blur(8px);
    font-size: 15px;
    margin-bottom: 18px;
    transition: .25s;
}

.input-field:focus {
    border-color: #ff8c2b;
    box-shadow: 0 0 0 2px rgba(255,140,43,0.25);
    outline: none;
}

/* Botão salvar */
.btn-save {
    width: 100%;
    padding: 14px 18px;
    border-radius: 14px;
    background: linear-gradient(90deg, #ff6a00, #ff8c2b);
    color: #fff;
    border: none;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: .25s;
    box-shadow: 0 6px 22px rgba(255,120,40,0.3);
}

.btn-save:hover {
    transform: translateY(-3px);
    filter: brightness(1.08);
}

/* Separador */
.profile-divider {
    width: 100%;
    height: 1px;
    background: rgba(0,0,0,0.12);
    margin: 25px 0 15px;
}
</style>



<div class="profile-wrapper">

    <h2 class="profile-title">Meu Perfil</h2>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
    @endif

    {{-- Formulário --}}
    <form method="POST" action="{{ route('cliente.perfil.update') }}">
        @csrf

        <label>Nome</label>
        <input type="text"
               class="input-field"
               name="nome"
               value="{{ $cliente->nome }}"
               required>

        <label>Telefone</label>
        <input type="text"
               class="input-field"
               name="telefone"
               value="{{ $cliente->telefone }}"
               required>

        <div class="profile-divider"></div>

        <label>Nova Senha (opcional)</label>
        <input type="password"
               class="input-field"
               name="password"
               placeholder="Digite uma nova senha">

        <label>Confirmar Nova Senha</label>
        <input type="password"
               class="input-field"
               name="password_confirmation"
               placeholder="Confirme sua nova senha">

        <button type="submit" class="btn-save">
            Salvar Alterações
        </button>
    </form>

</div>

@endsection
