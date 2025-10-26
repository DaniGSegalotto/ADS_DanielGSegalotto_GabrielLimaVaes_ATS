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

    <!-- === CSS global === -->
    <style>
        :root {
            --card-bg: rgba(255, 255, 255, .1);
            --card-border: rgba(255, 255, 255, .25);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

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
            background: rgba(255, 255, 255, 0.06);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
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

        header a:hover {
            color: #ffb366;
        }

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

        h1,
        h2,
        h3,
        h4 {
            margin-top: 0;
            color: #fff;
        }

        /* Botões */
        button,
        .btn {
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

        button:hover,
        .btn:hover {
            box-shadow: 0 10px 28px rgba(255, 81, 47, .45);
        }

        /* Inputs */
        input,
        select {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #fff;
            border-radius: 10px;
            padding: 8px 10px;
        }

        input::placeholder {
            color: #ddd;
            opacity: .8;
        }

        /* Tabelas */
        table {
            width: 100%;
            border-collapse: collapse;
            color: #fff;
            margin-top: 10px;
        }

        th,
        td {
            padding: 10px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th {
            font-weight: 600;
            opacity: .9;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 12px;
            font-size: 13px;
            opacity: .8;
            background: rgba(255, 255, 255, 0.04);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* --- Chatbot --- */

        /* Botão flutuante */
        #chatButton {
            position: fixed;
            bottom: 50px;
            right: 25px;
            background-color: #e63946;
            color: white;
            font-size: 26px;
            border-radius: 50%;
            padding: 14px 18px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.15);
            z-index: 999;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
            animation: pulse 2s infinite;
        }

        #chatButton:hover {
            background-color: #c71d32;
            transform: scale(1.05);
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(230, 57, 70, 0.6);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(230, 57, 70, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(230, 57, 70, 0);
            }
        }

        /* Janela do Chat */
        #chatWindow {
            position: fixed;
            bottom: 120px;
            right: 25px;
            width: 320px;
            height: 420px;
            background: #ffffff;
            color: #000000;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 998;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Cabeçalho */
        #chatHeader {
            background: linear-gradient(90deg, #e63946, #f09819);
            color: #fff;
            padding: 12px;
            font-weight: bold;
            text-align: left;
            font-size: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Corpo do chat */
        #chatBody {
            flex: 1;
            padding: 12px;
            overflow-y: auto;
            font-size: 14px;
            background-color: #ffffff;
            color: #000000;
        }

        /* Área de entrada */
        #chatInputArea {
            display: flex;
            border-top: 1px solid #ddd;
        }

        #chatInput {
            flex: 1;
            border: none;
            padding: 10px;
            outline: none;
            font-size: 14px;
            color: #000000;
            background: #fff;
        }

        #chatInput::placeholder {
            color: #666;
        }

        #chatInputArea button {
            background: #e63946;
            border: none;
            color: white;
            padding: 10px 16px;
            cursor: pointer;
            font-weight: 500;
            border-radius: 0 0 12px 0;
        }

        #chatInputArea button:hover {
            background: #c71d32;
        }

        /* Mensagens */
        #chatBody div.user {
            text-align: right;
            background: #f8d7da;
            color: #000;
            padding: 6px 10px;
            border-radius: 10px;
            margin: 4px 0 4px 40px;
            display: inline-block;
        }

        #chatBody div.bot {
            text-align: left;
            background: #f1f1f1;
            color: #000;
            padding: 6px 10px;
            border-radius: 10px;
            margin: 4px 40px 4px 0;
            display: inline-block;
        }
    </style>
</head>

<body>
    {{-- 🔹 Cabeçalho principal --}}
    <header>
        <div><strong>Automotive Testing Site</strong></div>
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

    {{-- 🔹 Conteúdo dinâmico --}}
    <main>
        <div class="card">
            {{ $slot }}
        </div>
    </main>

    {{-- 🔹 Rodapé --}}
    <footer>
        © {{ date('Y') }} Automotive Testing Site — Todos os direitos reservados.
    </footer>

    <!-- Botão flutuante -->
    <div id="chatButton" onclick="toggleChat()" title="Abrir Chat">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 0 0-6.32 12.906L.17 15.823a.5.5 0 0 0 .607.607l2.917-1.51A8 8 0 1 0 8 0z"/>
        </svg>
    </div>

    <!-- Janela de Chat -->
    <div id="chatWindow">
        <div id="chatHeader">Assistente Virtual</div>
        <div id="chatBody"></div>
        <div id="chatInputArea">
            <input type="text" id="chatInput" placeholder="Digite sua mensagem..." />
            <button onclick="sendMessage()">Enviar</button>
        </div>
    </div>

    <!-- Script do chat -->
    <script>
        function toggleChat() {
            const chat = document.getElementById('chatWindow');
            chat.style.display = chat.style.display === 'flex' ? 'none' : 'flex';
        }

        function appendMessage(sender, message) {
            const body = document.getElementById('chatBody');
            const div = document.createElement('div');
            div.classList.add(sender === 'Você' ? 'user' : 'bot');
            div.textContent = message;
            body.appendChild(div);
            body.scrollTop = body.scrollHeight;
        }

        function sendMessage() {
            const input = document.getElementById('chatInput');
            const text = input.value.trim();
            if (!text) return;

            appendMessage('Você', text);
            input.value = '';

            fetch('/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message: text })
            })
            .then(res => res.json())
            .then(data => {
                appendMessage('Assistente', data.reply || '...');
            })
            .catch(() => appendMessage('Assistente', 'Erro ao enviar mensagem 😔'));
        }
    </script>
</body>
</html>
