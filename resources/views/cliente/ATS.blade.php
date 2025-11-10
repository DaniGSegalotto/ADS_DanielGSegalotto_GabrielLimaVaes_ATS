<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel do Cliente - ATS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a0b0b, #3b0d0d);
            color: #fff;
            margin: 0;
            padding: 0;
        }

        header {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
        }

        h1 {
            color: #ff7043;
            font-size: 20px;
            margin: 0;
        }

        nav a {
            color: #fff;
            margin-left: 20px;
            text-decoration: none;
            font-weight: 600;
        }

        nav a:hover {
            color: #ffb98b;
        }

        main {
            padding: 40px;
            text-align: center;
        }

        .card {
            background: rgba(255,255,255,0.1);
            padding: 25px;
            border-radius: 15px;
            max-width: 700px;
            margin: 40px auto;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        .btn {
            display: inline-block;
            margin: 12px;
            padding: 12px 20px;
            background: linear-gradient(90deg, #ff512f, #f09819);
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: transform .2s ease, box-shadow .3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 81, 47, 0.4);
        }

        footer {
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #ccc;
        }
    </style>
</head>
<body>

<header>
    <h1>Bem-vindo ao ATS - Área do Cliente</h1>
    <nav>
        <a href="{{ route('cliente.home') }}">Início</a>
        <a href="{{ route('cliente.veiculos') }}">Veículos</a>
        <a href="{{ route('cliente.agendamento') }}">Agendamentos</a>
        <a href="{{ route('cliente.perfil') }}">Perfil</a>
        <form method="POST" action="{{ route('cliente.logout') }}" style="display:inline;">
            @csrf
            <button type="submit" style="background:none;border:none;color:#ff8c6b;cursor:pointer;">Sair</button>
        </form>
    </nav>
</header>

<main>
    <div class="card">
        <h2>Olá, {{ Auth::guard('cliente')->user()->nome }} 👋</h2>
        <p>Bem-vindo à sua área exclusiva! Aqui você pode:</p>
        <ul style="text-align:left;display:inline-block;margin-top:15px;">
            <li>🔎 Consultar veículos disponíveis para aluguel</li>
            <li>📅 Realizar novos agendamentos</li>
            <li>🧾 Visualizar seu histórico de reservas</li>
            <li>👤 Atualizar informações do seu perfil</li>
        </ul>

        <div style="margin-top:20px;">
            <a href="{{ route('cliente.veiculos') }}" class="btn">Ver Veículos</a>
            <a href="{{ route('cliente.agendamento') }}" class="btn">Fazer Agendamento</a>
            <a href="{{ route('cliente.perfil') }}" class="btn">Editar Perfil</a>
        </div>
    </div>
</main>

<footer>
    <p>Automotive Testing Site © {{ date('Y') }} — Área exclusiva para clientes</p>
</footer>

</body>
</html>
