<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Cliente</title>

    <style>
        :root {
            --card-bg: rgba(255, 255, 255, .10);
            --card-border: rgba(255, 255, 255, .22);
            --text-light: rgba(255, 255, 255, .90);
        }

        * { box-sizing: border-box; }

        html, body {
            height: 100%;
            margin: 0;
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            color: var(--text-light);
            overflow: hidden;
        }

        body {
            background:
                radial-gradient(60vmax 60vmax at 25% 28%, #ff512f55 0%, transparent 60%),
                radial-gradient(60vmax 60vmax at 75% 72%, #f0981955 0%, transparent 55%),
                radial-gradient(50vmax 50vmax at 70% 20%, #ff3d7166 0%, transparent 60%),
                linear-gradient(120deg, #1a0b0b 0%, #2a0f0f 100%);
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .card {
            width: min(94vw, 380px);
            padding: 32px 28px;
            border-radius: 22px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: blur(18px) saturate(150%);
            -webkit-backdrop-filter: blur(18px) saturate(150%);
            box-shadow: 0 20px 50px rgba(0, 0, 0, .45);
            animation: fadeIn .6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: rgba(255,255,255,.10);
            border: 1px solid var(--card-border);
            display: grid;
            place-items: center;
            margin: 0 auto 18px;
            box-shadow: 0 6px 14px rgba(0,0,0,.25);
        }

        h1 {
            margin: 0 0 18px;
            font-size: 22px;
            text-align: center;
            font-weight: 600;
            letter-spacing: .3px;
        }

        label {
            font-size: 13px;
            opacity: .9;
            display: block;
            margin: 12px 2px 6px;
        }

        .field {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.18);
            padding: 10px 12px;
            border-radius: 12px;
            transition: border-color .25s ease, background .25s ease;
        }

        .field:focus-within {
            border-color: #ffb27a;
            background: rgba(255,255,255,.14);
        }

        .field input {
            flex: 1;
            background: transparent;
            border: 0;
            outline: 0;
            color: #fff;
            font-size: 15px;
        }

        ::placeholder { color: #ddd; opacity: .65; }

        button {
            width: 100%;
            border: 0;
            cursor: pointer;
            padding: 12px 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: .3px;
            color: #fff;
            background: linear-gradient(90deg, #ff512f, #f09819);
            box-shadow: 0 8px 24px rgba(255,81,47,.35);
            transition: transform .08s ease, box-shadow .2s ease;
            margin-top: 18px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(255,81,47,.45);
        }

        .errors {
            background: #ff4d6d22;
            border: 1px solid #ff4d6d55;
            color: #ffdbe3;
            padding: 10px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .flash {
            background: rgba(119,255,168,.16);
            border: 1px solid rgba(119,255,168,.45);
            color: #c9ffd9;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 12px;
            animation: fadeIn .25s ease;
        }

        .helper {
            font-size: 13px;
            text-align: center;
            margin-top: 14px;
            opacity: .9;
        }

        .helper a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: opacity .2s ease, transform .15s ease;
        }

        .helper a:hover { opacity: .65; }
    </style>
</head>

<body>

    <main class="card">

        <div class="avatar">
            <svg viewBox="0 0 24 24" width="42" fill="currentColor">
                <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5zm0 2c-4.59 0-8 2.13-8 4.75V21h16v-2.25C20 16.13 16.59 14 12 14z"/>
            </svg>
        </div>

        <h1>Login do Cliente</h1>

        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('status'))
            <div id="flash" class="flash">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('cliente.login') }}">
            @csrf

            <label for="email">E-mail</label>
            <div class="field">
                <input type="email" id="email" name="email"
                       placeholder="seu@email.com"
                       value="{{ old('email') }}"
                       required>
            </div>

            <label for="password">Senha</label>
            <div class="field" style="position: relative;">
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    autocomplete="current-password"
                    style="padding-right:36px;"
                >

                <!-- Ícone do olho -->
                <svg 
                    id="togglePwd" 
                    style="
                        width:20px;
                        height:20px;
                        cursor:pointer;
                        position:absolute;
                        right:12px;
                        top:50%;
                        transform:translateY(-50%);
                        opacity:0;
                        pointer-events:none;
                        transition:opacity .25s ease;
                    "
                    viewBox="0 0 24 24" 
                    fill="currentColor"
                >
                    <path id="eyeOpen" d="M12 5c-7.633 0-10 7-10 7s2.367 7 10 7 10-7 10-7-2.367-7-10-7Zm0 11a4 4 0 1 1 4-4 4 4 0 0 1-4 4Z"/>
                    <path id="eyeClosed" style="display:none;" 
                        d="M2 3.27 3.28 2 22 20.72 20.72 22l-3.2-3.2A10.82 10.82 0 0 1 12 19c-7.63 0-10-7-10-7a17.39 17.39 0 0 1 4.11-5.63L2 3.27ZM12 7a4 4 0 0 1 4 4 3.89 3.89 0 0 1-.42 1.74L8.26 5.42A3.89 3.89 0 0 1 12 7Z"/>
                </svg>
            </div>

            <button type="submit">ENTRAR</button>
        </form>

        <div class="helper">
            <a href="{{ route('cliente.password.request') }}">Esqueci minha senha</a><br><br>
            <a href="{{ route('cliente.register.form') }}">Não tem conta? Criar agora</a><br>
            <a href="{{ url('/') }}" class="back-home">← Voltar à página inicial</a>
        </div>

    </main>

    <!-- Scripts -->
    <script>
        // Flash desaparecendo suave
        (function(){
            const el = document.getElementById('flash');
            if (!el) return;
            setTimeout(() => el.style.opacity = 0, 3500);
            setTimeout(() => el.remove(), 4300);
        })();

        // Mostrar / ocultar senha
        const pwd = document.getElementById("password");
        const toggle = document.getElementById("togglePwd");
        const eyeOpen = document.getElementById("eyeOpen");
        const eyeClosed = document.getElementById("eyeClosed");

        pwd.addEventListener("focus", () => {
            toggle.style.opacity = "0.75";
            toggle.style.pointerEvents = "auto";
        });

        pwd.addEventListener("blur", () => {
            if (!pwd.value) {
                toggle.style.opacity = "0";
                toggle.style.pointerEvents = "none";
            }
        });

        toggle.addEventListener("click", () => {
            const showing = pwd.type === "text";
            pwd.type = showing ? "password" : "text";

            eyeOpen.style.display = showing ? "block" : "none";
            eyeClosed.style.display = showing ? "none" : "block";
        });
    </script>

</body>
</html>
