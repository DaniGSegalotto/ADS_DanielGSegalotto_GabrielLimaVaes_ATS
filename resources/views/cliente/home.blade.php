@extends('layouts.app_cliente')

@section('content')

<style>

/* ============================================
      HERO SECTION
============================================ */
.hero {
    background: url('/img/frota.jpg') center/cover no-repeat;
    border-radius: 18px;
    padding: 65px 55px;
    margin-bottom: 45px;
    position: relative;
    overflow: hidden;
}

.hero::after {
    content: "";
    position: absolute;
    inset: 0;
    backdrop-filter: blur(3px);
    background: linear-gradient(90deg, rgba(0,0,0,0.60), rgba(0,0,0,0.10));
}

.hero-content {
    position: relative;
    z-index: 10;
    color: #fff;
}

.hero-title {
    font-size: 40px;
    font-weight: 900;
    margin-bottom: 16px;
}

.hero-sub {
    font-size: 17px;
    opacity: .92;
    margin-bottom: 24px;
}

.hero-btn {
    display: inline-block;
    padding: 13px 26px;
    background: linear-gradient(90deg, #ff6a00, #ff8c2b);
    color: white;
    font-weight: 700;
    border-radius: 12px;
    text-decoration: none;
    transition: .25s;
    box-shadow: 0 6px 20px rgba(255, 120, 40, .55);
}

.hero-btn:hover {
    transform: translateY(-3px);
    filter: brightness(1.07);
}

/* ============================================
      CARDS PRINCIPAIS (MENU)
============================================ */
.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 28px;
    margin-bottom: 55px;
}

.menu-card {
    background: rgba(255, 255, 255, 0.55);
    padding: 26px;
    border-radius: 18px;
    backdrop-filter: blur(14px);
    border: 1px solid rgba(0,0,0,0.12);
    text-align: center;
    transition: .25s;
    box-shadow: 0 8px 24px rgba(0,0,0,.15);
}

.menu-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,.22);
}

.menu-title {
    font-size: 20px;
    font-weight: 800;
    color: #222;
    margin-bottom: 6px;
}

.menu-desc {
    font-size: 14px;
    color: #555;
    line-height: 1.4;
    margin-bottom: 16px;
}

.menu-btn {
    display: inline-block;
    padding: 10px 18px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    color: white;
    text-decoration: none;
    background: linear-gradient(90deg, #ff6a00, #ff8c2b);
    box-shadow: 0 5px 18px rgba(255,120,40,.45);
    transition: .25s;
}

.menu-btn:hover {
    transform: translateY(-2px);
    filter: brightness(1.12);
}

/* ============================================
      CARDS EXTRA – Meus Agendamentos
============================================ */
.menu-card.agendamentos {
    background: rgba(0,0,0,0.75);
    color: white;
}

.menu-card.agendamentos .menu-title {
    color: #fff;
}

.menu-card.agendamentos .menu-desc {
    color: #ddd;
}

/* ============================================
      CARROSSEL DE VEÍCULOS
============================================ */
.cars-section-title {
    font-size: 24px;
    font-weight: 900;
    margin-bottom: 18px;
}

.carrossel {
    display: flex;
    gap: 22px;
    overflow-x: auto;
    padding-bottom: 12px;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
}

.carrossel::-webkit-scrollbar {
    height: 8px;
}
.carrossel::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 8px;
}

.car-item {
    min-width: 260px;
    border-radius: 18px;
    overflow: hidden;
    background: white;
    scroll-snap-align: start;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    transition: .25s;
}

.car-item:hover {
    transform: translateY(-5px);
}

.car-img {
    width: 100%;
    height: 160px;
    object-fit: cover;
}

.car-info {
    padding: 14px;
}

.car-name {
    font-weight: 800;
    font-size: 18px;
    margin-bottom: 5px;
}

.car-brand {
    opacity: .7;
    font-size: 14px;
    margin-bottom: 12px;
}

.car-btn {
    display: inline-block;
    padding: 10px 18px;
    border-radius: 12px;
    background: linear-gradient(90deg, #ff6a00, #ff8c2b);
    color: white;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    transition: .2s;
}

.car-btn:hover {
    filter: brightness(1.12);
}

/* ============================================
      SOBRE / INFORMAÇÕES
============================================ */
.about-box {
    background: rgba(255,255,255,0.65);
    padding: 30px;
    border-radius: 18px;
    border: 1px solid rgba(0,0,0,0.10);
    box-shadow: 0 8px 22px rgba(0,0,0,.12);
    margin-top: 35px;
}

.about-title {
    font-size: 20px;
    font-weight: 800;
    color: #222;
    margin-bottom: 12px;
}

.about-text {
    color: #444;
    font-size: 15px;
    line-height: 1.55;
}

</style>


{{-- HERO --}}
<div class="hero">
    <div class="hero-content">
        <div class="hero-title">
            Olá, {{ Auth::guard('cliente')->user()->nome }}
        </div>
        <div class="hero-sub">
            Bem-vindo à sua área exclusiva no Automotive Testing Site.
        </div>
        <a href="{{ route('cliente.veiculos') }}" class="hero-btn">
            Ver veículos disponíveis →
        </a>
    </div>
</div>


{{-- CARDS PRINCIPAIS --}}
<h2 style="margin-bottom:20px;font-weight:900;">O que você deseja fazer?</h2>

<div class="menu-grid">

    <div class="menu-card">
        <div class="menu-title">Consultar Veículos</div>
        <div class="menu-desc">Veja os modelos disponíveis e escolha o ideal para você.</div>
        <a href="{{ route('cliente.veiculos') }}" class="menu-btn">Ver veículos</a>
    </div>

    <div class="menu-card">
        <div class="menu-title">Agendar Veículo</div>
        <div class="menu-desc">Selecione data e horário para realizar seu agendamento.</div>
        <a href="{{ route('cliente.agendamento') }}" class="menu-btn">Agendar agora</a>
    </div>

    <div class="menu-card">
        <div class="menu-title">Editar Perfil</div>
        <div class="menu-desc">Atualize suas informações pessoais quando precisar.</div>
        <a href="{{ route('cliente.perfil') }}" class="menu-btn">Meu perfil</a>
    </div>

    <div class="menu-card agendamentos">
        <div class="menu-title">Meus Agendamentos</div>
        <div class="menu-desc">Veja todos os seus agendamentos realizados e detalhes.</div>
        <a href="{{ route('cliente.agendamentos') }}" class="menu-btn">Visualizar</a>
    </div>

</div>


{{-- CARROSSEL --}}
@if(isset($veiculos) && count($veiculos) > 0)

<h2 class="cars-section-title">Veículos em destaque</h2>

<div class="carrossel">
    @foreach($veiculos as $veiculo)
        <div class="car-item">
            <img src="/img/cars/default.jpg" class="car-img">

            <div class="car-info">
                <div class="car-name">{{ $veiculo->modelo }}</div>
                <div class="car-brand">{{ $veiculo->marca->nome ?? 'Marca' }}</div>

                <a href="{{ route('cliente.veiculos') }}" class="car-btn">
                    Ver detalhes
                </a>
            </div>
        </div>
    @endforeach
</div>

@endif


{{-- SOBRE --}}
<div class="about-box">
    <div class="about-title">Por que usar a ATS?</div>
    <p class="about-text">
        • Acesso direto aos veículos disponíveis para test-drive.<br>
        • Agendamentos rápidos e simples.<br>
        • Histórico sempre disponível.<br>
        • Ambiente moderno, intuitivo e seguro.<br>
        • Suporte disponível via WhatsApp e Chat.
    </p>
</div>

@endsection
