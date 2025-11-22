<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Automotive Testing Site') }}</title>

    <!-- Google Font Premium -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts Laravel -->
    @vite(['resources/js/app.js'])

    <style>
        :root {
            --primary: #121212;
            --secondary: #6f6f6f;
            --bg: #f5f5f5;
            --border: #e6e6e6;

            --accent: #ff6a00;
            --accent-hover: #ff7e2b;

            --blue: #008CFF;
            --blue-hover: #0b7fe6;

            --red: #e63946;
            --red-hover: #c42e3a;

            --gray: #555;
            --gray-hover: #444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--bg);
            color: var(--primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        header {
            width: 100%;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        header img {
            height: 44px;
            transition: .2s;
        }

        header img:hover {
            transform: scale(1.05);
        }

        nav a, nav button {
            margin-left: 22px;
            text-decoration: none;
            color: var(--secondary);
            font-weight: 500;
            transition: .2s;
            background: none;
            border: none;
            cursor: pointer;
        }

        nav a:hover, nav button:hover {
            color: var(--primary);
        }

        /* MAIN CARD */
        main {
            flex: 1;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .card {
            width: min(1100px, 95vw);
            background: #fff;
            padding: 32px;
            border-radius: 18px;
            border: 1px solid var(--border);
            box-shadow: 0 8px 22px rgba(0,0,0,0.06);
        }

        /* FOOTER */
        footer {
            padding: 16px;
            text-align: center;
            font-size: 13px;
            color: #777;
        }

        /* BOTÃO WHATSAPP */
        .whatsapp-float {
            position: fixed;
            bottom: 38px;
            right: 108px;
            width: 64px;
            height: 64px;
            background: #25D366;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 30px;
            transition: .2s;
            z-index: 999;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
        }

        /* CHAT FLOAT */
        #chatButton {
            position: fixed;
            bottom: 38px;
            right: 28px;
            width: 64px;
            height: 64px;
            background: var(--red);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 26px;
            cursor: pointer;
            transition: .2s;
            z-index: 999;
        }

        #chatButton:hover {
            background: var(--red-hover);
            transform: scale(1.1);
        }

        /* CHAT WINDOW */
        #chatWindow {
            position: fixed;
            bottom: 120px;
            right: 28px;
            width: 330px;
            height: 440px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.25);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 999;
        }

        /* HEADER DO CHAT */
        #chatHeader {
            background: linear-gradient(90deg, #e63946, #f09819);
            color: #fff;
            padding: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
        }

        #chatHeader button {
            background: none;
            border: none;
            color: #fff;
            font-size: 22px;
            cursor: pointer;
        }

        /* CONTEÚDO DO CHAT */
        #chatBody {
            flex: 1;
            padding: 12px;
            overflow-y: auto;
            background: #fafafa;
        }

        .user {
            background: #e63946;
            color: #fff;
            padding: 8px 12px;
            border-radius: 12px 12px 0 12px;
            margin: 6px 0 6px 60px;
            font-size: 14px;
        }

        .bot {
            background: #e7e7e7;
            color: #000;
            padding: 8px 12px;
            border-radius: 12px 12px 12px 0;
            margin: 6px 60px 6px 0;
            font-size: 14px;
        }

        #chatInputArea {
            display: flex;
            border-top: 1px solid #ddd;
        }

        #chatInput {
            flex: 1;
            border: none;
            padding: 10px;
            outline: none;
        }

        #chatInputArea button {
            border: none;
            background: #e63946;
            color: #fff;
            padding: 10px 16px;
            cursor: pointer;
        }

        /* RESPONSIVIDADE */
        @media (max-width: 650px) {
            header {
                padding: 14px 20px;
            }

            nav a {
                font-size: 14px;
                margin-left: 14px;
            }

            .whatsapp-float {
                right: 82px;
                width: 56px;
                height: 56px;
            }

            #chatButton {
                right: 16px;
                width: 56px;
                height: 56px;
            }

            #chatWindow {
                width: 92%;
                right: 4%;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header>
        <a href="/ATS">
            <img src="/img/ATS.png" alt="Logo ATS">
        </a>

        <nav>
            <a href="/ATS">Início</a>
            <a href="/clientes">Clientes</a>
            <a href="/funcionarios">Funcionários</a>
            <a href="/marcas">Marcas</a>
            <a href="/veiculos">Veículos</a>
            <a href="/agendamentos">Agendamentos</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Sair</button>
            </form>
        </nav>
    </header>

    <!-- CONTEÚDO -->
    <main>
        <div class="card">
            {{ $slot }}
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        © {{ date('Y') }} Automotive Testing Site — Todos os direitos reservados.
    </footer>

    <!-- WHATSAPP -->
    <a class="whatsapp-float" href="https://wa.me/5554999050399" target="_blank">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- CHAT BUTTON -->
    <div id="chatButton">💬</div>

    <!-- CHAT WINDOW -->
    <div id="chatWindow">
        <div id="chatHeader">
            Assistente Virtual
            <button id="closeChat">×</button>
        </div>

        <div id="chatBody"></div>

        <div id="chatInputArea">
            <input id="chatInput" type="text" placeholder="Digite sua mensagem...">
            <button onclick="sendMessage()">Enviar</button>
        </div>
    </div>

    <!-- SCRIPT DO CHAT -->
    <script>
        const chatButton = document.getElementById("chatButton");
        const chatWindow = document.getElementById("chatWindow");
        const closeChat = document.getElementById("closeChat");
        const chatBody = document.getElementById("chatBody");
        const chatInput = document.getElementById("chatInput");

        chatButton.addEventListener("click", () => {
            chatWindow.style.display = "flex";
        });

        closeChat.addEventListener("click", () => {
            chatWindow.style.display = "none";
        });

        async function sendMessage() {
            const text = chatInput.value.trim();
            if (!text) return;

            addMsg("user", text);
            chatInput.value = "";

            try {
                const res = await fetch("/chat", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ message: text })
                });

                const data = await res.json();
                addMsg("bot", data.reply);
            } catch {
                addMsg("bot", "Erro ao enviar mensagem.");
            }
        }

        function addMsg(type, text) {
            const div = document.createElement("div");
            div.classList.add(type);
            div.textContent = text;
            chatBody.appendChild(div);
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    </script>

</body>
</html>
