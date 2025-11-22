@extends('layouts.app_cliente')

@section('content')

<style>
/* ======================================================
      PREMIUM ATS – HOME DO CLIENTE 
      (Visual integrado ao layout app_cliente.blade.php)
======================================================== */

/* HERO */
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
    background: rgba(0,0,0,0.45);
}

.hero-content {
    position: relative;
    z-index: 10;
    color: #fff;
    max-width: 600px;
}

.hero-title {
    font-size: 40px;
    font-weight: 900;
    margin-bottom: 12px;
    text-shadow: 0 3px 6px rgba(0,0,0,0.3);
}

.hero-sub {
    font-size: 18px;
    margin-bottom: 26px;
    opacity: .92;
}

.hero-btn {
    display: inline-block;
    padding: 14px 28px;
    background: linear-gradient(90deg, #ff6a00, #ff8c2b);
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    border-radius: 14px;
    transition: .25s;
    box-shadow: 0 6px 20px rgba(255,120,40,.35);
}

.hero-btn:hover {
    transform: translateY(-3px);
    filter: brightness(1.07);
}

/* CARDS */
.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 26px;
    margin-bottom: 45px;
}

.menu-card {
    background: rgba(255,255,255,0.55);
    padding: 26px;
    border-radius: 18px;
    border: 1px solid rgba(0,0,0,0.10);
    backdrop-filter: blur(14px);
    text-align: center;
    box-shadow: 0 8px 22px rgba(0,0,0,.12);
    transition: .25s;
}

.menu-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0,0,0,.22);
}

.menu-title {
    font-size: 20px;
    font-weight: 800;
    margin-bottom: 8px;
    color: #222;
}

.menu-desc {
    font-size: 14px;
    color: #555;
    margin-bottom: 16px;
    line-height: 1.45;
}

.menu-btn {
    background: linear-gradient(90deg, #ff6a00, #ff8c2b);
    padding: 10px 18px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(255,120,40,.35);
    transition: .25s;
}

.menu-btn:hover {
    transform: translateY(-3px);
    filter: brightness(1.1);
}

/* BLOCO FINAL */
.intro-container {
    background: rgba(255,255,255,0.55);
    padding: 30px;
    border-radius: 18px;
    border: 1px solid rgba(0,0,0,0.10);
    box-shadow: 0 8px 22px rgba(0,0,0,.12);
    backdrop-filter: blur(12px);
    margin-top: 35px;
}

.intro-paragraph {
    color: #222;
    font-size: 16px;
    line-height: 1.6;
    font-weight: 500;
}
</style>



{{-- ======================================================
      HERO PRINCIPAL
======================================================== --}}
<div class="hero">
    <div class="hero-content">

        <div class="hero-title">
            Olá, {{ Auth::guard('cliente')->user()->nome }}
        </div>

        <div class="hero-sub">
            Bem-vindo à sua área exclusiva do Automotive Testing Site.
        </div>

        <a href="{{ route('cliente.veiculos') }}" class="hero-btn">
            Explorar veículos →
        </a>
    </div>
</div>



{{-- ======================================================
      CARDS PRINCIPAIS
======================================================== --}}
<h2 style="color:#222; font-size:26px; font-weight:900; margin-bottom:18px;">
    O que você deseja fazer?
</h2>

<div class="menu-grid">

    <div class="menu-card">
        <div class="menu-title">Consultar Veículos</div>
        <div class="menu-desc">
            Veja todos os modelos disponíveis e escolha o ideal.
        </div>
        <a href="{{ route('cliente.veiculos') }}" class="menu-btn">Ver veículos</a>
    </div>

    <div class="menu-card">
        <div class="menu-title">Agendar Veículo</div>
        <div class="menu-desc">
            Escolha a data e confirme sua reserva com rapidez.
        </div>
        <a href="{{ route('cliente.agendamento') }}" class="menu-btn">Agendar agora</a>
    </div>

    <div class="menu-card">
        <div class="menu-title">Editar Perfil</div>
        <div class="menu-desc">
            Atualize suas informações a qualquer momento.
        </div>
        <a href="{{ route('cliente.perfil') }}" class="menu-btn">Meu perfil</a>
    </div>

</div>



{{-- ======================================================
      BLOCO FINAL
======================================================== --}}
<div class="intro-container">
    <p class="intro-paragraph">
        A <strong>Automotive Testing Site</strong> trabalha diariamente para garantir o melhor atendimento e a experiência mais prática possível.<br><br>
        Aqui você pode acessar nossa frota, realizar agendamentos, acompanhar seu histórico, revisar seu perfil e muito mais — tudo de forma rápida, moderna e intuitiva.
    </p>
</div>

@endsection
