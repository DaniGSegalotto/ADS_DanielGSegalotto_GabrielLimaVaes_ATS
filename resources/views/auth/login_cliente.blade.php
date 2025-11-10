<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Cliente</title>
    <style>
        :root {
            --card-bg: rgba(255, 255, 255, .12);
            --card-border: rgba(255, 255, 255, .25);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

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
            opacity: .85;
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
            margin: 10px 2px 6px;
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

        ::placeholder {
            color: #ddd;
            opacity: .7;
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
            margin-top: 14px;
        }

        button:hover {
            box-shadow: 0 10px 28px rgba(255, 81, 47, .45);
        }

        button:active {
            transform: translateY(1px);
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

        <h1>Login do Cliente</h1>

        {{-- Mensagens de erro --}}
        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- Mensagem de sucesso --}}
        @if (session('status'))
            <div id="flash" class="flash">{{ session('status') }}</div>
        @endif

        {{-- Formulário --}}
        <form method="POST" action="{{ route('cliente.login') }}">
            @csrf

            <label for="email">E-mail</label>
            <div class="field">
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" required autofocus>
            </div>

            <label for="password">Senha</label>
            <div class="field">
                <input id="password" type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit">ENTRAR</button>
        </form>

        <div class="helper">
            <a href="{{ route('cliente.register.form') }}">Não tem conta? Criar agora</a>
        </div>

        <div class="helper">
            <a href="{{ url('/') }}">← Voltar à página inicial</a>
        </div>
    </main>

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
