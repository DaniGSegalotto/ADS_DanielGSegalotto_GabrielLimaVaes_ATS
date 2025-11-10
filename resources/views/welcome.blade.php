<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acesso ao Sistema</title>
    <style>
        :root {
            --card-bg: rgba(255, 255, 255, .12);
            --card-border: rgba(255, 255, 255, .25);
        }
        * { box-sizing: border-box }
        html, body { height: 100% }
        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
            color: #fff;
            background:
                radial-gradient(60vmax 60vmax at 20% 30%, #ff512f66 0%, transparent 60%),
                radial-gradient(60vmax 60vmax at 80% 70%, #f0981966 0%, transparent 55%),
                radial-gradient(50vmax 50vmax at 70% 20%, #ff3d7166 0%, transparent 60%),
                linear-gradient(120deg, #1a0b0b 0%, #2a0f0f 100%);
            display: grid;
            place-items: center;
            padding: 24px;
        }
        .card {
            width: min(94vw, 380px);
            padding: 28px 26px 24px;
            border-radius: 24px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: blur(16px) saturate(120%);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .45);
            text-align: center;
        }
        .avatar {
            width: 84px; height: 84px;
            border-radius: 50%;
            background: linear-gradient(180deg, #ffffff33, #ffffff11);
            border: 1px solid var(--card-border);
            display: grid; place-items: center;
            margin: 0 auto 18px;
        }
        .avatar svg { opacity: .85 }
        h1 {
            margin: 0 0 20px;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: .2px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 12px 16px;
            margin-top: 10px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            color: #fff;
            cursor: pointer;
            text-decoration: none;
            transition: transform .1s ease, box-shadow .2s ease;
        }
        .btn-func {
            background: linear-gradient(90deg, #ff512f, #f09819);
            box-shadow: 0 8px 24px rgba(255, 81, 47, .35);
        }
        .btn-cliente {
            background: linear-gradient(90deg, #20c997, #198754);
            box-shadow: 0 8px 24px rgba(32, 201, 151, .35);
        }
        .btn:hover { transform: translateY(-1px) }
    </style>
</head>
<body>
    <main class="card">
        <div class="avatar">
            <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-4.59 0-8 2.13-8 4.75V21h16v-2.25C20 16.13 16.59 14 12 14Z"/>
            </svg>
        </div>

        <h1>Automotive Testing Site</h1>
        <p style="font-size:14px; opacity:.85; margin-bottom:20px;">
            Escolha como deseja acessar o sistema:
        </p>

        <a href="{{ route('login') }}" class="btn btn-func">Entrar como Funcionário</a>
        <a href="{{ route('cliente.login.form') }}" class="btn btn-cliente">Entrar como Cliente</a>
    </main>
</body>
</html>
