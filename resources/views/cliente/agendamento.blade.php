@extends('layouts.app_cliente')

@section('content')

<style>
    /* CARD PRINCIPAL */
    .form-card {
        max-width: 780px;
        margin: 45px auto;
        background: #ffffff;
        padding: 36px;
        border-radius: 20px;
        border: 1px solid #e5e5e5;
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        animation: fadeIn .4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* TÍTULO */
    .form-title {
        font-size: 30px;
        font-weight: 800;
        color: #222;
        text-align: center;
        margin-bottom: 28px;
    }

    /* LABELS */
    .form-label {
        font-weight: 600;
        color: #222;
        margin-bottom: 6px;
        display: block;
        font-size: 15px;
        letter-spacing: .2px;
    }

    /* INPUTS E SELECT */
    .form-input, .form-select {
        width: 100%;
        padding: 13px;
        border-radius: 12px;
        border: 1px solid #ccc;
        background: #fafafa;
        font-size: 15px;
        margin-bottom: 20px;
        transition: .25s;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: #ff7a00;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(255,122,0,0.2);
    }

    /* BOTÃO CONFIRMAR */
    .form-btn {
        padding: 13px;
        background: linear-gradient(90deg, #ff7a00, #ff9e3d);
        border: none;
        color: white;
        font-weight: 700;
        border-radius: 12px;
        cursor: pointer;
        font-size: 17px;
        width: 100%;
        letter-spacing: .3px;
        box-shadow: 0 6px 20px rgba(255, 120, 40, 0.35);
        transition: .25s;
    }

    .form-btn:hover {
        transform: translateY(-2px);
        filter: brightness(1.08);
    }

    /* BOTÃO CANCELAR */
    .cancel-btn {
        margin-top: 14px;
        display: block;
        text-align: center;
        padding: 12px;
        background: #555;
        color: #fff;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        letter-spacing: .2px;
        transition: .25s;
    }

    .cancel-btn:hover {
        opacity: .85;
        transform: translateY(-2px);
    }

    /* INFO BOX DE FUNCIONÁRIO */
    .info-box {
        background: rgba(255, 149, 43, 0.15);
        border-left: 4px solid #ff7a00;
        padding: 15px 18px;
        border-radius: 12px;
        margin-bottom: 26px;
        font-size: 15px;
        color: #5a3d00;
        line-height: 1.5;
    }
</style>


<div class="form-card">

    <h2 class="form-title">Agendar Veículo</h2>

    <!-- FUNCIONÁRIO AUTOMÁTICO -->
    @if(isset($funcionarioPadrao))
    <div class="info-box">
        Seu atendimento será realizado por <strong>{{ $funcionarioPadrao->nome }}</strong>.
        <br>
        O sistema seleciona automaticamente o atendente disponível para agilizar seu processo.
    </div>
    @endif

    <form action="{{ route('cliente.agendamento.store') }}" method="POST">
        @csrf

        <!-- FUNCIONÁRIO (oculto) -->
        <input type="hidden" name="funcionario_id" value="{{ $funcionarioPadrao->id }}">

        <!-- SELEÇÃO DE VEÍCULO -->
        <label class="form-label">Selecione o Veículo</label>
        <select name="veiculo_id" class="form-select" required>
            <option value="">Escolha um veículo...</option>
            @foreach($veiculos as $v)
                <option value="{{ $v->id }}">
                    {{ $v->modelo }} — Placa: {{ $v->placa }}
                </option>
            @endforeach
        </select>

        <!-- DATA INÍCIO -->
        <label class="form-label">Data de Início</label>
        <input type="date" name="data_inicio" class="form-input" required>

        <!-- DATA FIM -->
        <label class="form-label">Data de Fim</label>
        <input type="date" name="data_fim" class="form-input" required>

        <!-- BOTÃO CONFIRMAR -->
        <button type="submit" class="form-btn">Confirmar Agendamento</button>

        <!-- BOTÃO CANCELAR -->
        <a href="{{ route('cliente.home') }}" class="cancel-btn">Cancelar</a>

    </form>

</div>

@endsection
