<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ATS - Área do Cliente</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.55);
            --glass-border: rgba(0, 0, 0, 0.12);
            --text-dark: #222;
            --text-light: #555;

            --ats-blue: #009ffd;
            --ats-orange: #ff7a00;
        }

        body {
            margin: 0;
            font-family: "Inter", sans-serif;
            background: #f3f4f6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text-dark);
        }

        /* ---------------- HEADER PREMIUM ---------------- */
        header {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        header img {
            height: 44px;
        }

        nav a, nav button {
            margin-left: 28px;
            font-weight: 600;
            font-size: 16px;
            color: var(--text-dark);
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            transition: .25s;
        }

        nav a:hover, nav button:hover {
            color: var(--ats-orange);
            transform: translateY(-2px);
        }

        /* ---------------- CENTRAL CARD ---------------- */
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 40px 20px;
        }

        .card {
            width: 100%;
            max-width: 900px; /* 🔥 CENTRALIZAÇÃO REAL */
            background: var(--glass-bg);
            border-radius: 18px;
            padding: 36px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            backdrop-filter: blur(14px);
            animation: fade .4s ease;
            margin: 0 auto;
        }

        @keyframes fade {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ---------------- FOOTER ---------------- */
        footer {
            background: rgba(255,255,255,0.55);
            text-align: center;
            padding: 12px;
            border-top: 1px solid var(--glass-border);
            font-size: 14px;
            color: var(--text-light);
        }

        /* ---------------- FLOAT BUTTONS ---------------- */
        .whatsapp-float {
            position: fixed;
            bottom: 40px;
            right: 120px;
            width: 70px;
            height: 70px;
            background: #25d366;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 38px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            cursor: pointer;
            z-index: 1000;
        }

        #chatButton {
            position: fixed;
            bottom: 40px;
            right: 30px;
            width: 70px;
            height: 70px;
            background: #e63946;
            border-radius: 50%;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 34px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            cursor: pointer;
            z-index: 1000;
        }
    </style>
</head>

<body>

<header>
    <a href="{{ route('cliente.home') }}">
        <img src="/img/ATS.png" alt="ATS Logo">
    </a>

    <nav>
        <a href="{{ route('cliente.home') }}">Início</a>
        <a href="{{ route('cliente.veiculos') }}">Veículos</a>
        <a href="{{ route('cliente.agendamento') }}">Agendamentos</a>
        <a href="{{ route('cliente.perfil') }}">Perfil</a>

        <form method="POST" action="{{ route('cliente.logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Sair</button>
        </form>
    </nav>
</header>

<main>
    <div class="card">
        @yield('content')
    </div>
</main>

<footer>
    © {{ date('Y') }} Automotive Testing Site — Todos os direitos reservados.
</footer>

<a href="https://wa.me/5554999050399" class="whatsapp-float">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<div id="chatButton">💬</div>

</body>
</html>
