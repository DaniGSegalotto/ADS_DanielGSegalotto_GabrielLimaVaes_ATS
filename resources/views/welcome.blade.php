<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        :root {
            --card-bg: rgba(255, 255, 255, .12);
            --card-border: rgba(255, 255, 255, .25);
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            height: 100%
        }

        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
            color: #fff;
            /* 🔥 Fundo em tons de vermelho e laranja */
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
            -webkit-backdrop-filter: blur(16px) saturate(120%);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .45);
        }

        .avatar {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            background: linear-gradient(180deg, #ffffff33, #ffffff11);
            border: 1px solid var(--card-border);
            display: grid;
            place-items: center;
            margin: 0 auto 18px;
        }

        .avatar svg {
            opacity: .85
        }

        h1 {
            margin: 0 0 18px;
            font-size: 22px;
            font-weight: 600;
            text-align: center;
            letter-spacing: .2px;
        }

        label {
            font-size: 13px;
            opacity: .9;
            display: block;
            margin: 10px 2px 6px
        }

        .field {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .18);
            padding: 10px 12px;
            border-radius: 12px;
        }

        .field input {
            flex: 1;
            background: transparent;
            border: 0;
            outline: 0;
            color: #fff;
            font-size: 15px;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:focus {
            transition: background-color 600000s 0s, color 600000s 0s;
        }

        ::placeholder {
            color: #ddd;
            opacity: .7;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin: 12px 2px 16px;
            font-size: 13px;
        }

        .row a {
            color: #ffe6e6;
            text-decoration: none;
            opacity: .9
        }

        .row a:hover {
            opacity: 1;
            text-decoration: underline
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            opacity: .9
        }

        .remember input {
            accent-color: #ff7b00
        }

        button {
            width: 100%;
            border: 0;
            cursor: pointer;
            padding: 12px 16px;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: .3px;
            font-size: 15px;
            color: #fff;
            background: linear-gradient(90deg, #ff512f, #f09819);
            box-shadow: 0 8px 24px rgba(255, 81, 47, .35);
            transition: transform .06s ease, box-shadow .15s ease, opacity .2s;
        }

        button:hover {
            box-shadow: 0 10px 28px rgba(255, 81, 47, .45)
        }

        button:active {
            transform: translateY(1px)
        }

        .helper {
            font-size: 13px;
            text-align: center;
            margin-top: 12px;
            opacity: .9;
        }

        .helper a {
            color: #fff;
            font-weight: 500;
            text-decoration: none;
        }

        .helper a:hover {
            text-decoration: underline;
            color: #ffce9f;
        }

        .errors {
            background: #ff4d6d22;
            border: 1px solid #ff4d6d55;
            color: #ffdbe3;
            padding: 8px 10px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .icon {
            width: 18px;
            height: 18px;
            opacity: .85
        }

        /* 🔔 Estilo do alerta de sucesso */
        .flash {
            background: rgba(119, 255, 168, .16);
            border: 1px solid rgba(119, 255, 168, .45);
            color: #c9ffd9;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 10px;
            animation: fadeIn .25s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-4px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .flash.hide {
            opacity: 0;
            transform: translateY(-4px);
            transition: opacity .6s ease, transform .6s ease;
        }
    </style>
</head>

<body>
    <main class="card">
        <div class="avatar" aria-hidden="true">
            <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-4.59 0-8 2.13-8 4.75V21h16v-2.25C20 16.13 16.59 14 12 14Z" />
            </svg>
        </div>

        <h1>Automotive Testing Site</h1>

        {{-- Mensagens de erro --}}
        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- Mensagem de sucesso pós-cadastro --}}
        @if (session('status'))
            <div id="flash" class="flash">
                {{ session('status') }}
            </div>
        @endif

        {{-- Formulário de login --}}
        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <label for="email">E-mail</label>
            <div class="field">
                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 13 2 6.76V18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6.76L12 13ZM12 11 22 4H2l10 7Z" />
                </svg>
                <input id="email" type="email" name="email" placeholder="seu@email.com" required autofocus>
            </div>

            <label for="password">Senha</label>
            <div class="field">
                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M17 9h-1V7a4 4 0 0 0-8 0v2H7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2ZM10 7a2 2 0 0 1 4 0v2h-4Zm2 9a1.5 1.5 0 1 1 1.5-1.5A1.5 1.5 0 0 1 12 16Z" />
                </svg>
                <input id="password" type="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="row">
                <label class="remember"><input type="checkbox" name="remember"> Lembrar-me</label>
                <a href="{{ url('/forgot-password') }}">Esqueceu a senha?</a>
            </div>

            <button type="submit">ENTRAR</button>
        </form>

        <div class="helper">Não tem conta? <a href="{{ url('/register') }}">Criar conta</a></div>
    </main>

    <!-- Script do alerta de sucesso -->
    <script>
        (function(){
            const el = document.getElementById('flash');
            if(!el) return;
            setTimeout(()=>{ el.classList.add('hide'); }, 3500);
            setTimeout(()=>{ el.remove(); }, 4500);
        })();
    </script>
</body>

</html>
