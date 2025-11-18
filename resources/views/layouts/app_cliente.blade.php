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
        /* ======== BASE DO LAYOUT ======== */
        body {
            font-family: "Figtree", sans-serif;
            color: #fff;
            background: linear-gradient(120deg, #1a0b0b, #2a0f0f);
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            padding: 15px 32px;
            backdrop-filter: blur(10px);
        }

        header a {
            color: #fff;
            margin: 0 15px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.2s;
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

        /* ======== BOTÕES FLUTUANTES ======== */
        .whatsapp-float {
            position: fixed;
            width: 66px;
            height: 66px;
            bottom: 50px;
            right: 120px;
            background-color: #25D366;
            color: white;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
            transition: 0.3s;
            animation: pulse 2.5s infinite;
        }

        .whatsapp-float:hover {
            background-color: #20ba5a;
            transform: scale(1.05);
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6); }
            70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }

        #chatButton {
            position: fixed;
            bottom: 50px;
            right: 30px;
            width: 66px;
            height: 66px;
            background-color: #e63946;
            color: white;
            border-radius: 50%;
            font-size: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 999;
            border: 2px solid rgba(255, 255, 255, 0.2);
            animation: pulseChat 2s infinite;
        }

        @keyframes pulseChat {
            0% { box-shadow: 0 0 0 0 rgba(230, 57, 70, 0.6); }
            70% { box-shadow: 0 0 0 15px rgba(230, 57, 70, 0); }
            100% { box-shadow: 0 0 0 0 rgba(230, 57, 70, 0); }
        }

        /* ======== CHAT ======== */
        #chatWindow {
            position: fixed;
            bottom: 120px;
            right: 30px;
            width: 340px;
            height: 450px;
            background: #ffffff;
            color: #000;
            border-radius: 12px;
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 998;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.35s ease;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
        }

        #chatWindow.show {
            display: flex;
            opacity: 1;
            transform: translateY(0);
        }

        #chatHeader {
            background: linear-gradient(90deg,#e63946,#f09819);
            color: #fff;
            padding: 12px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }

        #chatBody {
            flex: 1;
            padding: 12px;
            overflow-y: auto;
            background: #fff;
        }

        /* Mensagens */
        #chatBody div.user {
            align-self: flex-end;
            background: #e63946;
            color: #fff;
            padding: 8px 12px;
            border-radius: 14px 14px 0 14px;
            max-width: 80%;
            margin: 6px 0 6px 40px;
        }

        #chatBody div.bot {
            align-self: flex-start;
            background: #f1f1f1;
            padding: 8px 12px;
            border-radius: 14px 14px 14px 0;
            max-width: 80%;
            margin: 6px 40px 6px 0;
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
            font-size: 14px;
        }

        #chatInputArea button {
            background: #e63946;
            color: #fff;
            border: none;
            padding: 10px 16px;
            cursor: pointer;
            transition: 0.2s;
        }

        #chatInputArea button:hover {
            background: #c71d32;
        }

        /* ===== CONFIRMAÇÃO ===== */
        #confirmPopup {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.55);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        #confirmPopup.show {
            display: flex;
        }

        .popup-box {
            background: #fff;
            color: #000;
            padding: 24px;
            border-radius: 10px;
            text-align: center;
            width: 260px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .popup-buttons button {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        #confirmYes { background: #e63946; color:#fff; }
        #confirmNo { background: #bbb; }
    </style>
</head>

<body>

    <header>
        <div><strong>Automotive Testing Site</strong></div>

        <nav>
            <a href="{{ route('cliente.home') }}">Início</a>
            <a href="{{ route('cliente.veiculos') }}">Veículos</a>
            <a href="{{ route('cliente.agendamento') }}">Agendamento</a>
            <a href="{{ route('cliente.perfil') }}">Perfil</a>

            <form action="{{ route('cliente.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit"
                    style="background:none;border:none;color:#ff8c6b;cursor:pointer;">
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

    <!-- BOTÃO WHATSAPP -->
    <a href="https://wa.me/5554999050399" class="whatsapp-float">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- BOTÃO DO CHAT -->
    <div id="chatButton">💬</div>

    <!-- JANELA DO CHAT -->
    <div id="chatWindow">
        <div id="chatHeader">
            Assistente Virtual
            <div>
                <button id="minimizeChat" style="background:none;color:white;border:none;">🔽</button>
                <button id="endChat" style="background:none;color:white;border:none;">❌</button>
            </div>
        </div>

        <div id="chatBody"></div>

        <div id="confirmPopup">
            <div class="popup-box">
                <p>Encerrar a conversa?</p>
                <div class="popup-buttons">
                    <button id="confirmYes">Sim</button>
                    <button id="confirmNo">Não</button>
                </div>
            </div>
        </div>

        <div id="chatInputArea">
            <input type="text" id="chatInput" placeholder="Digite...">
            <button onclick="sendMessage()">Enviar</button>
        </div>
    </div>

    <script>
        const chatWindow = document.getElementById("chatWindow");
        const chatButton = document.getElementById("chatButton");
        const chatInput = document.getElementById("chatInput");
        const chatBody = document.getElementById("chatBody");
        const popup = document.getElementById("confirmPopup");

        // abrir chat
        chatButton.onclick = () => {
            chatWindow.classList.toggle("show");
        };

        // minimizar
        document.getElementById("minimizeChat").onclick = () => {
            chatWindow.classList.remove("show");
        };

        // encerrar
        document.getElementById("endChat").onclick = () => popup.classList.add("show");
        document.getElementById("confirmNo").onclick = () => popup.classList.remove("show");

        document.getElementById("confirmYes").onclick = async () => {
            popup.classList.remove("show");
            chatBody.innerHTML = "";
            await fetch("/chat/reset");
            chatWindow.classList.remove("show");
        };

        function appendMessage(type, text) {
            const msg = document.createElement("div");
            msg.className = type;
            msg.textContent = text;
            chatBody.appendChild(msg);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        // enviar ENTER
        chatInput.addEventListener('keypress', e => {
            if (e.key === 'Enter') sendMessage();
        });

        async function sendMessage() {
            const text = chatInput.value.trim();
            if (!text) return;

            appendMessage("user", text);
            chatInput.value = "";

            const response = await fetch("/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message: text })
            });

            const data = await response.json();
            appendMessage("bot", data.reply);
        }
    </script>

</body>
</html>
