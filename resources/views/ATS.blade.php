<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automotive Testing Site</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #111;
            --secondary: #555;
            --border: #e4e4e4;
            --bg: #f7f7f7;
            --accent: #ff6a00;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--bg);
            color: var(--primary);
        }

        /* HEADER */
        header {
            width: 100%;
            padding: 22px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        header img {
            height: 42px;
        }

        nav a {
            margin-left: 22px;
            text-decoration: none;
            color: var(--secondary);
            font-weight: 500;
            transition: .2s;
        }

        nav a:hover {
            color: var(--primary);
        }

        /* HERO */
        .hero {
            width: 100%;
            min-height: 260px;
            background: url('/img/banner-ats.jpg') center/cover no-repeat;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 60px 20px;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.40);
        }

        .hero h1 {
            position: relative;
            font-size: 48px;
            font-weight: 700;
            color: #fff;
            text-shadow: 0px 3px 8px rgba(0,0,0,0.55);
        }

        .hero span.highlight {
            background: linear-gradient(90deg, #ff6a00, #ffbb00);
            -webkit-background-clip: text;
            color: transparent;
        }

        .hero h2 {
            position: relative;
            margin-top: 10px;
            color: #eaeaea;
            font-size: 20px;
            font-weight: 400;
        }

        /* ALERTA TEMPORÁRIO */
        .temp-alert {
            background: #e9fbe9;
            color: #0a7f2f;
            padding: 10px;
            max-width: 700px;
            margin: 25px auto;
            border: 1px solid #bbf1c2;
            border-radius: 10px;
            text-align: center;
            font-size: 15px;
            animation: fadeOut 4s forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            70% { opacity: 1; }
            100% { opacity: 0; visibility: hidden; }
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* CARDS */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 22px;
        }

        .card {
            background: #fff;
            border: 1px solid var(--border);
            padding: 26px;
            border-radius: 18px;
            transition: .25s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 22px rgba(0,0,0,0.06);
        }

        .card h3 {
            font-size: 20px;
            font-weight: 600;
        }

        .card p {
            margin: 14px 0;
            color: #666;
            font-size: 15px;
            line-height: 1.4;
        }

        .card a {
            display: inline-block;
            padding: 10px 16px;
            background: #111;
            color: #fff;
            border-radius: 10px;
            font-size: 14px;
            text-decoration: none;
        }

        /* INFO BOX */
        .info-box {
            margin-top: 50px;
            background: #fff;
            padding: 35px;
            border-radius: 18px;
            border: 1px solid var(--border);
            line-height: 1.6;
        }

        /* BOTÕES FLUTUANTES */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 100px;
            width: 62px;
            height: 62px;
            background: #25D366;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 30px;
            z-index: 900;
            transition: .2s;
        }
        .whatsapp-float:hover {
            transform: scale(1.08);
        }

        .chat-float {
            position: fixed;
            bottom: 30px;
            right: 25px;
            width: 62px;
            height: 62px;
            background: #e63946;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 28px;
            cursor: pointer;
            transition: .2s;
            z-index: 900;
        }
        .chat-float:hover {
            transform: scale(1.08);
        }

        /* FOOTER */
        footer {
            margin-top: 55px;
            padding: 14px;
            text-align: center;
            font-size: 13px;
            opacity: 0.55;
            color: #444;
        }

        @media (max-width: 768px) {
            .hero h1 { font-size: 34px; }
            .hero h2 { font-size: 16px; }

            .whatsapp-float { right: 80px; }
            .chat-float { right: 20px; }
        }
    </style>
</head>

<body>

<header>
    <img src="/img/ATS.png" alt="Logo ATS">

    <nav>
        <a href="/ATS">Início</a>
        <a href="/clientes">Clientes</a>
        <a href="/funcionarios">Funcionários</a>
        <a href="/marcas">Marcas</a>
        <a href="/veiculos">Veículos</a>
        <a href="/agendamentos">Agendamentos</a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
</header>

<div class="hero">
    <h1>Bem-vindo ao <span class="highlight">Automotive Testing Site</span></h1>
    <h2>Ambiente profissional para gerenciar test-drive, veículos e clientes</h2>
</div>

<div class="temp-alert">
    Logado como Funcionário. Acesso completo ao sistema.
</div>

<div class="container">

    <div class="cards">
        <div class="card">
            <h3>Clientes</h3>
            <p>Cadastre e gerencie seus clientes de forma prática e eficiente.</p>
            <a href="/clientes">Acessar</a>
        </div>

        <div class="card">
            <h3>Funcionários</h3>
            <p>Controle de permissões e gerenciamento da equipe interna.</p>
            <a href="/funcionarios">Acessar</a>
        </div>

        <div class="card">
            <h3>Veículos</h3>
            <p>Gerencie modelos, disponibilidade, histórico e detalhes técnicos.</p>
            <a href="/veiculos">Acessar</a>
        </div>

        <div class="card">
            <h3>Agendamentos</h3>
            <p>Organize test-drives e reservas com clareza e precisão.</p>
            <a href="/agendamentos">Acessar</a>
        </div>
    </div>

    <div class="info-box">
        <p>
            O <strong>Automotive Testing Site</strong> é uma plataforma moderna desenvolvida para otimizar processos
            de test-drive e gestão de veículos.
        </p>
        <p style="margin-top: 14px;">
            Construído seguindo padrões de design minimalista de marcas premium como Tesla e BMW i-Series.
        </p>
    </div>

</div>

<!-- Botões flutuantes -->
<a class="whatsapp-float" href="https://wa.me/5554999050399" target="_blank">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<div class="chat-float" onclick="window.location.href='/chat/reset'">
    💬
</div>

<footer>
    © {{ date('Y') }} Automotive Testing Site — Todos os direitos reservados.
</footer>

</body>
</html>
