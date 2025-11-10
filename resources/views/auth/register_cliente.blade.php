<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Cliente</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background:
                radial-gradient(60vmax 60vmax at 20% 30%, #ff512f66 0%, transparent 60%),
                radial-gradient(60vmax 60vmax at 80% 70%, #f0981966 0%, transparent 55%),
                linear-gradient(120deg, #1a0b0b 0%, #2a0f0f 100%);
            color: #fff;
            margin: 0;
            padding: 20px;
        }

        .card {
            width: min(94vw, 380px);
            padding: 28px;
            border-radius: 20px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            backdrop-filter: blur(16px) saturate(120%);
            box-shadow: 0 15px 45px rgba(0,0,0,0.3);
            animation: fadeIn .5s ease-in-out;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-size: 13px;
            opacity: .9;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: none;
            margin-top: 4px;
            background: rgba(255,255,255,0.15);
            color: #fff;
            font-size: 15px;
            outline: none;
        }

        ::placeholder { color: #ddd; opacity: .7; }

        button {
            width: 100%;
            margin-top: 18px;
            padding: 12px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            color: #fff;
            font-size: 15px;
            background: linear-gradient(90deg,#ff512f,#f09819);
            cursor: pointer;
            transition: transform .1s ease, box-shadow .2s ease;
            box-shadow: 0 8px 24px rgba(255, 81, 47, .35);
        }

        button:hover {
            box-shadow: 0 10px 28px rgba(255, 81, 47, .45);
        }

        button:active {
            transform: translateY(1px);
        }

        .helper {
            text-align: center;
            margin-top: 12px;
            font-size: 13px;
        }

        .helper a {
            color: #fff;
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
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <form method="POST" action="{{ route('cliente.register') }}" class="card">
        @csrf
        <h1>Criar Conta de Cliente</h1>

        {{-- Mensagem de sucesso --}}
        @if (session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        {{-- Exibe mensagens de erro --}}
        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required placeholder="Seu nome" value="{{ old('nome') }}">

        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" required placeholder="(XX) XXXXX-XXXX" value="{{ old('telefone') }}">

        <label for="CPF">CPF</label>
        <input type="text" id="CPF" name="CPF" required placeholder="000.000.000-00" value="{{ old('CPF') }}">

        <label for="CHN">CNH</label>
        <input type="text" id="CHN" name="CHN" required placeholder="Número da CNH" value="{{ old('CHN') }}">

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required placeholder="seu@email.com" value="{{ old('email') }}">

        <label for="password">Senha</label>
        <input type="password" id="password" name="password" required placeholder="••••••••">

        <label for="password_confirmation">Confirmar senha</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••">

        <button type="submit">Registrar</button>

        <div class="helper">
            <a href="{{ route('cliente.login.form') }}">Já tem conta? Entrar</a>
        </div>
    </form>

    {{-- Máscaras de telefone e CPF --}}
    <script>
        const tel = document.getElementById('telefone');
        tel.addEventListener('input', e => {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });

        const cpf = document.getElementById('CPF');
        cpf.addEventListener('input', e => {
            let v = e.target.value.replace(/\D/g, '').slice(0, 11);
            v = v.replace(/(\d{3})(\d)/, '$1.$2');
            v = v.replace(/(\d{3})(\d)/, '$1.$2');
            v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = v;
        });
    </script>
</body>
</html>
