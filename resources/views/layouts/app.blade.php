<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Automotive Testing Site') }}</title>

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <!-- === CSS global === -->
    <style>
        /* --- Botão flutuante do WhatsApp --- */
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            animation: pulse 2.5s infinite;
        }

        .whatsapp-float:hover {
            background-color: #20ba5a;
            transform: scale(1.05);
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* --- Botão de chat --- */
        #chatButton {
            position: fixed;
            bottom: 50px;
            right: 30px;
            width: 66px;
            height: 66px;
            background-color: #e63946;
            color: white;
            font-size: 28px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.15);
            z-index: 999;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
            animation: pulseChat 2s infinite;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #chatButton:hover {
            background-color: #c71d32;
            transform: scale(1.05);
        }

        @keyframes pulseChat {
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

        @media (max-width: 480px) {
            .whatsapp-float {
                right: 90px;
                bottom: 20px;
                width: 58px;
                height: 58px;
            }

            #chatButton {
                right: 20px;
                bottom: 20px;
                width: 58px;
                height: 58px;
            }
        }

        /* ======== Estilo global ======== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Figtree", sans-serif;
            color: #fff;
            background: linear-gradient(120deg, #1a0b0b 0%, #2a0f0f 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

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
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(18px);
        }

        footer {
            text-align: center;
            padding: 12px;
            font-size: 13px;
            opacity: .8;
            background: rgba(255, 255, 255, 0.04);
        }

        /* --- Janela do Chat --- */
        #chatWindow {
            position: fixed;
            bottom: 120px;
            right: 30px;
            width: 340px;
            height: 450px;
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

        #chatHeader {
            background: linear-gradient(90deg, #e63946, #f09819);
            color: #fff;
            padding: 12px;
            font-weight: bold;
            text-align: left;
            font-size: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        #chatBody {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            background-color: #ffffff;
        }

        /* Mensagem do usuário (direita) */
        #chatBody div.user {
            align-self: flex-end;
            background: #e63946;
            color: #fff;
            padding: 8px 12px;
            border-radius: 14px 14px 0 14px;
            max-width: 80%;
            white-space: pre-line;
            line-height: 1.4;
            word-wrap: break-word;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Mensagem da IA (esquerda) */
        #chatBody div.bot {
            align-self: flex-start;
            background: #f1f1f1;
            color: #000;
            padding: 8px 12px;
            border-radius: 14px 14px 14px 0;
            max-width: 80%;
            white-space: pre-line;
            line-height: 1.4;
            word-wrap: break-word;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            border: none;
            color: white;
            padding: 10px 16px;
            cursor: pointer;
            font-weight: 500;
        }

        #chatInputArea button:hover {
            background: #c71d32;
        }

        #chatHeader {
            position: relative;
            background: linear-gradient(90deg, #e63946, #f09819);
            color: #fff;
            padding: 12px;
            font-weight: bold;
            font-size: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #chatControls {
            display: flex;
            gap: 6px;
        }

        #chatControls button {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        #chatControls button:hover {
            transform: scale(1.2);
        }

        #chatControls {
            display: flex;
            gap: 6px;
        }

        #chatControls button {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        #chatControls button:hover {
            transform: scale(1.2);
        }

        /* --- Pop-up de confirmação --- */
        #confirmEndChat {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .confirm-box {
            background: #fff;
            color: #000;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 280px;
        }

        .confirm-buttons {
            margin-top: 14px;
            display: flex;
            justify-content: space-around;
        }

        .confirm-buttons button {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }

        #confirmYes {
            background-color: #e63946;
            color: #fff;
        }

        #confirmYes:hover {
            background-color: #c71d32;
        }

        #confirmNo {
            background-color: #ccc;
        }

        #confirmNo:hover {
            background-color: #b5b5b5;
        }

        /* ===== Transições e aparência moderna ===== */
        #chatWindow {
            position: fixed;
            bottom: 120px;
            right: 30px;
            width: 320px;
            height: 420px;
            background: #fff;
            color: #000;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 998;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.35s ease;
        }

        #chatWindow.show {
            display: flex;
            opacity: 1;
            transform: translateY(0);
        }

        #chatHeader {
            background: linear-gradient(90deg, #e63946, #f09819);
            color: #fff;
            padding: 12px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #chatControls button {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        #chatControls button:hover {
            transform: scale(1.2);
        }

        #chatBody {
            flex: 1;
            padding: 12px;
            overflow-y: auto;
            background: #fff;
            transition: all 0.3s ease;
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
            color: #000;
            background: #fff;
        }

        #chatInputArea button {
            background: #e63946;
            border: none;
            color: white;
            padding: 10px 16px;
            cursor: pointer;
            font-weight: 500;
            border-radius: 0 0 12px 0;
            transition: background 0.2s ease;
        }

        #chatInputArea button:hover {
            background: #c71d32;
        }

        #chatBody div.user {
            text-align: right;
            background: #f8d7da;
            color: #000;
            padding: 6px 10px;
            border-radius: 10px;
            margin: 6px 0 6px 40px;
            display: inline-block;
            animation: fadeIn 0.3s ease;
        }

        #chatBody div.bot {
            text-align: left;
            background: #f1f1f1;
            color: #000;
            padding: 6px 10px;
            border-radius: 10px;
            margin: 6px 40px 6px 0;
            display: inline-block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== Popup dentro do chat ===== */
        #confirmPopup {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        #confirmPopup.show {
            opacity: 1;
            pointer-events: auto;
        }

        .popup-box {
            background: #fff;
            color: #000;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            width: 250px;
            animation: popIn 0.3s ease;
        }

        @keyframes popIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .popup-buttons {
            margin-top: 15px;
            display: flex;
            justify-content: space-around;
        }

        .popup-buttons button {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, background 0.2s;
        }

        .popup-buttons button:hover {
            transform: scale(1.05);
        }

        #confirmYes {
            background: #e63946;
            color: #fff;
        }

        #confirmYes:hover {
            background: #c71d32;
        }

        #confirmNo {
            background: #ccc;
            color: #000;
        }

        #confirmNo:hover {
            background: #b5b5b5;
        }
    </style>
</head>

<body>
    <header>
        <div><strong>Automotive Testing Site</strong></div>
        <nav>
            <a href="{{ url('/ATS') }}">Início</a>
            <a href="{{ url('/clientes') }}">Clientes</a>
            <a href="{{ url('/funcionarios') }}">Funcionários</a>
            <a href="{{ url('/marcas') }}">Marcas</a>
            <a href="{{ url('/veiculos') }}">Veículos</a>
            <a href="{{ url('/agendamentos') }}">Agendamentos</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit"
                    style="background: none; border: none; color: #fff; cursor: pointer; font-size: 16px; font-weight: 500; padding: 0; margin-left: 12px;">
                    Sair
                </button>
            </form>

        </nav>
    </header>

    <main>
        <div class="card">
            {{ $slot }}
        </div>
    </main>

    <footer>
        © {{ date('Y') }} Automotive Testing Site — Todos os direitos reservados.
    </footer>

    <!-- Botão flutuante do Chat -->
    <div id="chatButton" title="Abrir Chat">
        💬
    </div>

    <!-- Janela do Chat -->
    <div id="chatWindow">
        <div id="chatHeader">
            Assistente Virtual
            <div id="chatControls">
                <button id="minimizeChat" title="Minimizar">🔽</button>
                <button id="endChat" title="Encerrar conversa">❌</button>
            </div>
        </div>

        <div id="chatBody"></div>

        <div id="chatInputArea">
            <input type="text" id="chatInput" placeholder="Digite sua mensagem..." />
            <button onclick="sendMessage()">Enviar</button>
        </div>

        <!-- Popup de Confirmação -->
        <div id="confirmPopup" class="popup-hidden">
            <div class="popup-box">
                <p>Você tem certeza que deseja encerrar esta conversa?</p>
                <div class="popup-buttons">
                    <button id="confirmYes">Sim</button>
                    <button id="confirmNo">Não</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Botão flutuante do WhatsApp -->
    <a href="#" target="_blank" rel="noopener" class="whatsapp-float" id="whatsappButton" aria-label="WhatsApp">
        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
    </a>

    <!-- Script do Chat -->
    <script>
        const chatWindow = document.getElementById("chatWindow");
        const chatButton = document.getElementById("chatButton");
        const chatInput = document.getElementById("chatInput");
        const chatBody = document.getElementById("chatBody");
        const popup = document.getElementById("confirmPopup");

        // Abre / Fecha chat com animação
        chatButton.addEventListener("click", () => {
            if (chatWindow.classList.contains("show")) {
                chatWindow.classList.remove("show");
                setTimeout(() => chatWindow.style.display = "none", 300);
            } else {
                chatWindow.style.display = "flex";
                setTimeout(() => chatWindow.classList.add("show"), 10);
            }
        });

        // Minimizar chat
        document.getElementById("minimizeChat").addEventListener("click", () => {
            chatWindow.classList.remove("show");
            setTimeout(() => chatWindow.style.display = "none", 300);
        });

        // Encerrar conversa (abre popup)
        document.getElementById("endChat").addEventListener("click", () => {
            popup.classList.add("show");
        });

        // Confirma sim / não
        document.getElementById("confirmYes").addEventListener("click", async () => {
            popup.classList.remove("show");
            chatBody.innerHTML = "";
            localStorage.removeItem("chatHistory");
            await fetch('/chat/reset');
            chatWindow.classList.remove("show");
            setTimeout(() => chatWindow.style.display = "none", 300);
        });

        document.getElementById("confirmNo").addEventListener("click", () => {
            popup.classList.remove("show");
        });

        // Enviar com Enter
        chatInput.addEventListener("keypress", e => {
            if (e.key === "Enter") sendMessage();
        });

        // Adiciona mensagem
        function appendMessage(sender, message) {
            const div = document.createElement("div");
            div.classList.add(sender === "user" ? "user" : "bot");
            div.textContent = message;
            chatBody.appendChild(div);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        // Enviar mensagem ao backend
        async function sendMessage() {
            const text = chatInput.value.trim();
            if (!text) return;

            appendMessage("user", text);
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
                appendMessage("bot", data.reply || "...");
            } catch {
                appendMessage("bot", "Erro ao enviar mensagem 😔");
            }
        }
    </script>


</body>

</html>