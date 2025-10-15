<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Automotive Testing Site') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <!-- === CSS global inspirado no login === -->
    <style>
        :root {
            --card-bg: rgba(255, 255, 255, .1);
            --card-border: rgba(255, 255, 255, .25);
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }

        body {
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
            color: #fff;
            background:
                radial-gradient(60vmax 60vmax at 20% 30%, #ff512f66 0%, transparent 60%),
                radial-gradient(60vmax 60vmax at 80% 70%, #f0981966 0%, transparent 55%),
                radial-gradient(50vmax 50vmax at 70% 20%, #ff3d7166 0%, transparent 60%),
                linear-gradient(120deg, #1a0b0b 0%, #2a0f0f 100%);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255,255,255,0.06);
            border-bottom: 1px solid rgba(255,255,255,0.15);
            padding: 12px 28px;
            backdrop-filter: blur(10px);
        }

        header a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            margin: 0 12px;
            transition: color .2s ease;
        }

        header a:hover { color: #ffb366; }

        /* Conteúdo */
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .card {
            width: min(95vw, 1000px);
            padding: 28px 26px;
            border-radius: 24px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: blur(18px) saturate(120%);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .45);
        }

        h1, h2, h3, h4 {
            margin-top: 0;
            color: #fff;
        }

        /* Botões */
        button, .btn {
            border: 0;
            cursor: pointer;
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(90deg, #ff512f, #f09819);
            box-shadow: 0 8px 24px rgba(255, 81, 47, .35);
            transition: all .2s ease;
        }

        button:hover, .btn:hover {
            box-shadow: 0 10px 28px rgba(255, 81, 47, .45);
        }

        /* Inputs */
        input, select {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            border-radius: 10px;
            padding: 8px 10px;
        }

        input::placeholder { color: #ddd; opacity: .8; }

        /* Tabelas */
        table {
            width: 100%;
            border-collapse: collapse;
            color: #fff;
            margin-top: 10px;
        }

        th, td {
            padding: 10px 12px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        th { font-weight: 600; opacity: .9; }

        /* Footer */
        footer {
            text-align: center;
            padding: 12px;
            font-size: 13px;
            opacity: .8;
            background: rgba(255,255,255,0.04);
            border-top: 1px solid rgba(255,255,255,0.1);
        }
    </style>
</head>

<body>

    {{-- 🔹 Cabeçalho principal --}}
    <header>
        <div>
            <strong>Automotive Testing Site</strong>
        </div>
        <nav>
            <a href="{{ url('/ATS') }}">Início</a>
            <a href="{{ url('/clientes') }}">Clientes</a>
            <a href="{{ url('/funcionarios') }}">Funcionários</a>
            <a href="{{ url('/marcas') }}">Marcas</a>
            <a href="{{ url('/veiculos') }}">Veículos</a>
            <a href="{{ url('/agendamentos') }}">Agendamentos</a>
            <a href="{{ route('logout') }}">Sair</a>
        </nav>
    </header>

    {{-- 🔹 Conteúdo dinâmico das páginas --}}
    <main>
        <div class="card">
            {{ $slot }}
        </div>
    </main>

    {{-- 🔹 Rodapé --}}
    <footer>
        © {{ date('Y') }} Automotive Testing Site — Todos os direitos reservados.
    </footer>

</body>
</html>
