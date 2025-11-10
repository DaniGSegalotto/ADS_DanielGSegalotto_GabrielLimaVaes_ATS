<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATS - Área do Cliente</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 30% 30%, #3b0d0d, #1a0b0b);
            color: #fff;
            margin: 0;
            padding: 0;
        }

        header {
            background: rgba(255,255,255,0.08);
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(6px);
        }

        h1 { color: #ff7043; font-size: 20px; margin: 0; }

        nav a, nav form button {
            color: #fff;
            margin-left: 20px;
            text-decoration: none;
            font-weight: 600;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        nav a:hover, nav form button:hover {
            color: #ffb98b;
        }

        main { padding: 40px; text-align: center; }

        .card {
            background: rgba(255,255,255,0.1);
            padding: 25px;
            border-radius: 15px;
            max-width: 700px;
            margin: 40px auto;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 10px;
            border: none;
            background: rgba(255,255,255,0.15);
            color: #fff;
            font-size: 15px;
        }

        button {
            background: linear-gradient(90deg, #ff512f, #f09819);
            font-weight: 600;
            cursor: pointer;
        }

        footer {
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #ccc;
        }

        .flash {
            background: rgba(119,255,168,.16);
            border: 1px solid rgba(119,255,168,.45);
            color: #c9ffd9;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
<header>
    <h1>ATS - Cliente</h1>
    <nav>
        <a href="{{ route('cliente.home') }}">Início</a>
        <a href="{{ route('cliente.veiculos') }}">Veículos</a>
        <a href="{{ route('cliente.agendamento') }}">Agendar</a>
        <a href="{{ route('cliente.perfil') }}">Perfil</a>
        <form method="POST" action="{{ route('cliente.logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Sair</button>
        </form>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>Automotive Testing Site © {{ date('Y') }}</p>
</footer>
</body>
</html>
