@extends('layouts.app_cliente')

@section('content')

<style>
/* =============================
      LISTA DE VEÍCULOS – PREMIUM
   ============================= */

.page-wrapper {
    background: #fff;
    padding: 40px;
    border-radius: 22px;
    max-width: 1250px;
    margin: 0 auto;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
}

/* Título */
.section-title {
    font-size: 28px;
    font-weight: 800;
    color: #222;
    text-align: center;
    margin-bottom: 35px;
}

/* Grid fixo com centralização */
.vehicle-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    justify-items: center;
    gap: 35px;
}

/* Card */
.vehicle-card {
    background: #fff;
    padding: 22px;
    border-radius: 18px;
    border: 1px solid #e5e5e5;
    width: 320px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.10);
    transition: .25s;
}

.vehicle-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.18);
}

/* Imagem */
.vehicle-image {
    width: 100%;
    height: 160px;
    border-radius: 14px;
    object-fit: cover;
    margin-bottom: 15px;
}

/* Títulos */
.vehicle-name {
    font-size: 20px;
    font-weight: 700;
    color: #222;
    margin-bottom: 4px;
}

.vehicle-brand {
    font-size: 15px;
    opacity: .75;
    margin-bottom: 10px;
}

/* Info */
.vehicle-info {
    font-size: 14px;
    color: #555;
    margin-bottom: 18px;
}

/* Botão */
.vehicle-btn {
    display: inline-block;
    background: linear-gradient(90deg, #ff7a00, #ff9d3f);
    color: #fff;
    padding: 10px 18px;
    font-size: 15px;
    font-weight: 700;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(255,120,40,.35);
    text-decoration: none;
    transition: .25s;
}

.vehicle-btn:hover {
    transform: translateY(-2px);
    filter: brightness(1.10);
}

/* Sem veículos */
.empty-box {
    background: #fff;
    padding: 35px;
    border-radius: 18px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.10);
    font-size: 17px;
    color: #666;
    text-align: center;
    border: 1px solid #eee;
}
</style>


<div class="page-wrapper">

    <h2 class="section-title">Veículos Disponíveis</h2>

    @if($veiculos->isEmpty())

        <div class="empty-box">
            Nenhum veículo disponível no momento.  
            <br><br>
            <strong>Volte em breve! Estamos atualizando nossa frota.</strong>
        </div>

    @else

        <div class="vehicle-grid">

            @foreach($veiculos as $v)
                <div class="vehicle-card">

                    <img src="/img/cars/default.jpg" class="vehicle-image" alt="Imagem de {{ $v->modelo }}">

                    <div class="vehicle-name">{{ $v->modelo }}</div>
                    <div class="vehicle-brand">{{ $v->marca->nome ?? 'Sem marca' }}</div>

                    <div class="vehicle-info">
                        <strong>Placa:</strong> {{ $v->placa }} <br>
                        <strong>Status:</strong> Disponível ✓
                    </div>

                    <a href="{{ route('cliente.agendamento') }}" class="vehicle-btn">
                        Agendar Test-Drive →
                    </a>

                </div>
            @endforeach

        </div>

    @endif

</div>

@endsection
