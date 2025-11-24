@extends('layouts.app_cliente')

@section('content')

<style>

/* ===============================
   FORMULÁRIO – ESTILO ATS
================================ */
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

.form-title {
    font-size: 30px;
    font-weight: 800;
    text-align: center;
    margin-bottom: 28px;
    color: #222;
}

.form-label {
    font-weight: 600;
    color: #222;
    margin-bottom: 6px;
    display: block;
    font-size: 15px;
}

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
.form-input:focus, .form-select:focus {
    border-color: #ff7a00;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(255,122,0,0.2);
}

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
    transition: .25s;
}
.cancel-btn:hover {
    opacity: .85;
    transform: translateY(-2px);
}

.info-box {
    background: rgba(255,149,43,0.15);
    border-left: 4px solid #ff7a00;
    padding: 15px 18px;
    border-radius: 12px;
    margin-bottom: 26px;
    font-size: 15px;
    color: #5a3d00;
    line-height: 1.5;
}

/* ===============================
   SWEETALERT – ESTILO ATS PREMIUM
================================ */
.swal2-popup {
    border-radius: 22px !important;
    padding: 38px 40px !important;
    background: #fff !important;
    box-shadow: 0 15px 45px rgba(0,0,0,0.18) !important;
}

.swal2-title {
    font-size: 26px !important;
    font-weight: 800 !important;
    color: #222 !important;
    margin-top: 12px !important;
}

.swal2-html-container {
    font-size: 16px !important;
    color: #555 !important;
    margin-top: 6px !important;
}

.swal2-confirm {
    background: #ff7a00 !important;
    border-radius: 10px !important;
    padding: 10px 26px !important;
    font-weight: 700 !important;
    color: white !important;
    box-shadow: 0 6px 16px rgba(255,122,0,0.35) !important;
}

.swal2-confirm:hover {
    filter: brightness(1.12) !important;
    transform: translateY(-2px) !important;
}

.swal2-cancel {
    background: #777 !important;
    border-radius: 10px !important;
    padding: 10px 26px !important;
    font-weight: 700 !important;
    color: white !important;
}

.swal2-cancel:hover {
    filter: brightness(1.12) !important;
    transform: translateY(-2px) !important;
}

</style>

<div class="form-card">

    <h2 class="form-title">Agendar Veículo</h2>

    @if(isset($funcionarioPadrao))
    <div class="info-box">
        O sistema sugere atendimento com <strong>{{ $funcionarioPadrao->nome }}</strong>,
        mas você pode escolher outro atendente abaixo.
    </div>
    @endif

    <form id="formAgendar">
        @csrf

        <label class="form-label">Selecione o Veículo</label>
        <select name="veiculo_id" class="form-select" required>
            <option value="">Escolha um veículo...</option>
            @foreach($veiculos as $v)
                <option value="{{ $v->id }}">{{ $v->modelo }} — Placa: {{ $v->placa }}</option>
            @endforeach
        </select>

        <label class="form-label">Selecione o Funcionário</label>
        <select name="funcionario_id" class="form-select" required>
            <option value="">Escolha um atendente...</option>
            @foreach($funcionarios as $f)
                <option value="{{ $f->id }}">{{ $f->nome }}</option>
            @endforeach
        </select>

        <label class="form-label">Data</label>
        <input type="date" name="data" class="form-input" required>

        <label class="form-label">Horário</label>
        <input type="time" name="horario" class="form-input" required>

        <button type="submit" class="form-btn">Confirmar Agendamento</button>

        <a href="{{ route('cliente.home') }}" class="cancel-btn">Cancelar</a>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById("formAgendar").addEventListener("submit", async function(e){
    e.preventDefault();

    let form = e.target;
    let formData = new FormData(form);

    Swal.fire({
        icon: 'info',
        title: 'Aguarde…',
        text: 'Registrando agendamento…',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    });

    const response = await fetch("{{ route('cliente.agendamento.store') }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        body: formData
    });

    // ❌ NÃO USE Swal.close() – isso causava o bug
    // Ele vai ser automaticamente substituído pelo próximo Swal.fire

    if (response.status === 422) {
        let error = await response.json();

        Swal.fire({
            icon: 'error',
            title: 'Conflito de horário',
            text: error.error,
        });

        return;
    }

    if (!response.ok) {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Não foi possível salvar o agendamento.',
        });
        return;
    }

    Swal.fire({
        icon: 'success',
        title: 'Agendamento Realizado!',
        text: 'Deseja ir para Meus Agendamentos?',
        showCancelButton: true,
        confirmButtonText: 'Sim, ir agora',
        cancelButtonText: 'Não, ficar aqui'
    }).then((r) => {
        if (r.isConfirmed) {
            window.location.href = "{{ route('cliente.agendamentos') }}";
        } else {
            form.reset();
        }
    });
});
</script>

@endsection
