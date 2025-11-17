<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Automotive Testing Site') }}</title>

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    @vite(['resources/js/app.js'])

    <style>
        body {
            font-family: "Figtree", sans-serif;
            color: #fff;
            background: linear-gradient(120deg, #1a0b0b, #2a0f0f);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            padding: 14px 32px;
            backdrop-filter: blur(10px);
        }

        header a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            margin: 0 15px;
        }

        header a:hover {
            color: #ffb366;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .card {
            width: min(95vw, 1100px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 26px;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        footer {
            text-align: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.04);
            font-size: 13px;
        }
    </style>
</head>

<body>

    <!-- ===== MENU SOMENTE PARA CLIENTES ===== -->
    <header>
        <div><strong>Automotive Testing Site</strong></div>

        <nav>
            <a href="{{ route('cliente.home') }}">Início</a>
            <a href="{{ route('cliente.veiculos') }}">Veículos</a>
            <a href="{{ route('cliente.agendamento') }}">Agendamento</a>
            <a href="{{ route('cliente.perfil') }}">Perfil</a>

            <form method="POST" action="{{ route('cliente.logout') }}" style="display:inline;">
                @csrf
                <button type="submit"
                        style="background:none;border:none;color:#ff8c6b;cursor:pointer;font-size:15px;">
                    Sair
                </button>
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

</body>
</html>
