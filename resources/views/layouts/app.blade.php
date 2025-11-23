<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Automotive Testing Site') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/js/app.js'])

    <style>
        :root {
            --primary:#111;
            --secondary:#6f6f6f;
            --bg:#f5f5f5;
            --border:#e6e6e6;

            --black:#111;
            --black-hover:#000;

            --bubble-user:#111;
            --bubble-bot:#e5e5e5;
        }

        * {
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter',sans-serif;
        }

        body {
            background:var(--bg);
            color:var(--primary);
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        /* HEADER NOVO */
        header {
            width: 100%;
            height: 72px;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border-bottom: 1px solid #dcdcdc;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        header img {
            height: 46px;
            transition: 0.2s;
        }
        header img:hover { transform: scale(1.04); }

        header nav {
            display: flex;
            align-items: center;
            gap: 26px;
        }

        header nav a,
        header nav button {
            background: none;
            border: none;
            font-size: 15px;
            font-weight: 500;
            color: #555;
            cursor: pointer;
            text-decoration: none;
            transition: 0.25s;
        }

        header nav a:hover,
        header nav button:hover {
            color: #000;
        }

        main {
            flex:1;
            padding:40px 20px;
            display:flex;
            justify-content:center;
        }

        .card {
            width:min(1100px,95vw);
            background:white;
            padding:32px;
            border-radius:18px;
            border:1px solid var(--border);
            box-shadow:0 8px 22px rgba(0,0,0,.06);
        }

        footer {
            padding:16px;
            text-align:center;
            color:#777;
            font-size:13px;
        }

        /* WHATSAPP PULSANTE */
        .whatsapp-float {
            position:fixed;
            bottom:38px;
            right:108px;
            width:64px;
            height:64px;
            background:#25D366;
            color:white;
            border-radius:50%;
            font-size:30px;
            display:flex;
            justify-content:center;
            align-items:center;
            transition:.2s;
            z-index:999;
            cursor:pointer;
            animation:whatsPulse 1.8s infinite ease-in-out;
        }
        .whatsapp-float:hover { transform:scale(1.12); }

        @keyframes whatsPulse {
            0%{ transform:scale(1); box-shadow:0 0 0 rgba(37,211,102,.35); }
            50%{ transform:scale(1.12); box-shadow:0 0 18px rgba(37,211,102,.55); }
            100%{ transform:scale(1); box-shadow:0 0 0 rgba(37,211,102,.35); }
        }

        /* CHAT BUTTON (PRETO PULSANTE) */
        #chatButton {
            position:fixed;
            bottom:38px;
            right:28px;
            width:64px;
            height:64px;
            background:var(--black);
            color:white;
            border-radius:50%;
            display:flex;
            font-size:26px;
            justify-content:center;
            align-items:center;
            cursor:pointer;
            transition:.2s;
            z-index:999;
            animation:chatPulse 1.8s infinite ease-in-out;
        }
        #chatButton:hover { background:var(--black-hover); transform:scale(1.12); }

        @keyframes chatPulse {
            0%{ transform:scale(1); box-shadow:0 0 0 rgba(0,0,0,.35); }
            50%{ transform:scale(1.10); box-shadow:0 0 18px rgba(0,0,0,.55); }
            100%{ transform:scale(1); box-shadow:0 0 0 rgba(0,0,0,.35); }
        }

        /* CHAT WINDOW */
        #chatWindow {
            position:fixed;
            bottom:120px;
            right:28px;
            width:360px;
            height:500px;
            background:white;
            border-radius:14px;
            box-shadow:0 12px 40px rgba(0,0,0,.25);
            opacity:0;
            pointer-events:none;
            transform:translateY(40px) scale(.95);
            transition:opacity .35s ease, transform .35s cubic-bezier(.16,.84,.44,1);
            display:flex;
            flex-direction:column;
            overflow:hidden;
            z-index:999;
        }
        #chatWindow.show {
            opacity:1;
            pointer-events:auto;
            transform:translateY(0) scale(1);
        }

        #chatHeader {
            background:var(--black);
            color:white;
            padding:14px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-weight:600;
        }
        .header-btn {
            background:none;
            border:none;
            color:white;
            font-size:20px;
            cursor:pointer;
        }
        .header-btn:hover { opacity:.7; }

        #chatBody {
            flex:1;
            padding:14px;
            overflow-y:auto;
            background:#fafafa;
            display:flex;
            flex-direction:column;
        }

        .msg {
            padding:10px 14px;
            margin:6px 0;
            max-width:80%;
            border-radius:14px;
            line-height:1.4;
        }
        .msg.user {
            margin-left:auto;
            background:var(--bubble-user);
            color:white;
            border-radius:14px 14px 0 14px;
        }
        .msg.bot {
            margin-right:auto;
            background:var(--bubble-bot);
            color:#222;
            border-radius:14px 14px 14px 0;
        }

        #typingIndicator {
            opacity:.6;
            font-style:italic;
            margin-right:auto;
            padding:8px 12px;
        }

        #chatInputArea {
            display:flex;
            border-top:1px solid #ddd;
        }
        #chatInput {
            flex:1;
            border:none;
            padding:14px;
            outline:none;
        }
        #chatSendButton {
            background:var(--black);
            color:white;
            border:none;
            padding:12px 18px;
            cursor:pointer;
            font-size:16px;
        }

        /* POPUP */
        #confirmPopup {
            position:absolute;
            inset:0;
            background:rgba(0,0,0,.55);
            display:flex;
            justify-content:center;
            align-items:center;
            opacity:0;
            pointer-events:none;
            transition:opacity .35s ease;
        }
        #confirmPopup.show {
            opacity:1;
            pointer-events:auto;
        }

        .popup-box {
            background:white;
            padding:22px;
            border-radius:12px;
            width:240px;
            text-align:center;
            animation:scaleUp .3s ease;
        }
        @keyframes scaleUp {
            0%{ transform:scale(.85); opacity:.3; }
            100%{ transform:scale(1); opacity:1; }
        }

        .popup-confirm, .popup-cancel {
            cursor:pointer;
            border:none;
            padding:8px 12px;
            border-radius:6px;
            margin-top:10px;
        }
        .popup-confirm {
            background:var(--black);
            color:white;
        }
        .popup-cancel {
            background:#bbb;
            margin-left:6px;
        }

    </style>
</head>

<body>

<header>
    <a href="/ATS"><img src="/img/ATS.png" alt="Logo ATS"></a>

    <nav>
        <a href="/ATS">Início</a>
        <a href="/clientes">Clientes</a>
        <a href="/funcionarios">Funcionários</a>
        <a href="/marcas">Marcas</a>
        <a href="/veiculos">Veículos</a>
        <a href="/agendamentos">Agendamentos</a>

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Sair</button>
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

<!-- WHATSAPP -->
<a class="whatsapp-float" href="https://wa.me/5554999050399" target="_blank">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<!-- CHAT BUTTON -->
<div id="chatButton"><i class="fa-solid fa-comment"></i></div>

<!-- CHAT WINDOW -->
<div id="chatWindow">

    <div id="chatHeader">
        Assistente Virtual ATS
        <div>
            <button id="minimizeChat" class="header-btn">—</button>
            <button id="endChat" class="header-btn">×</button>
        </div>
    </div>

    <div id="chatBody"></div>

    <!-- POPUP -->
    <div id="confirmPopup">
        <div class="popup-box">
            <p>Deseja encerrar a conversa?</p>
            <button id="confirmYes" class="popup-confirm">Encerrar</button>
            <button id="confirmNo" class="popup-cancel">Cancelar</button>
        </div>
    </div>

    <div id="chatInputArea">
        <input id="chatInput" type="text" placeholder="Digite sua mensagem...">
        <button id="chatSendButton"><i class="fa-solid fa-paper-plane"></i></button>
    </div>

</div>

<script>
// ELEMENTOS
const chatButton = document.getElementById("chatButton");
const chatWindow = document.getElementById("chatWindow");
const minimizeChat = document.getElementById("minimizeChat");
const endChat = document.getElementById("endChat");
const popup = document.getElementById("confirmPopup");
const confirmYes = document.getElementById("confirmYes");
const confirmNo = document.getElementById("confirmNo");

const chatBody = document.getElementById("chatBody");
const chatInput = document.getElementById("chatInput");
const chatSend = document.getElementById("chatSendButton");

// ABRIR SUAVE
chatButton.onclick = () => {
    chatWindow.classList.toggle("show");
    chatWindow.style.pointerEvents = "auto";
};

// MINIMIZAR SUAVE
minimizeChat.onclick = () => {
    chatWindow.classList.remove("show");
    setTimeout(()=> chatWindow.style.pointerEvents="none", 350);
};

// FECHAR → POPUP
endChat.onclick = () => popup.classList.add("show");

// CANCELAR FECHAR
confirmNo.onclick = () => popup.classList.remove("show");

// CONFIRMAR FECHAR
confirmYes.onclick = async () => {
    popup.classList.remove("show");
    chatBody.innerHTML = "";

    try { await fetch("/chat/reset"); } catch(e) {}

    chatWindow.classList.remove("show");
    setTimeout(()=> chatWindow.style.pointerEvents="none", 350);
};

// ADICIONAR MENSAGEM
function appendMsg(type, text){
    removeTypingIndicator();

    const div = document.createElement("div");
    div.className = "msg " + type;
    div.textContent = text;

    chatBody.appendChild(div);
    chatBody.scrollTop = chatBody.scrollHeight;
}

// INDICADOR "Assistente digitando..."
function showTypingIndicator(){
    removeTypingIndicator();

    const t = document.createElement("div");
    t.id = "typingIndicator";
    t.className = "msg bot";
    t.style.opacity = ".6";
    t.style.fontStyle = "italic";
    t.textContent = "Assistente digitando…";

    chatBody.appendChild(t);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function removeTypingIndicator(){
    const t = document.getElementById("typingIndicator");
    if(t) t.remove();
}

// ENVIAR MENSAGEM
async function sendMessage(){
    const text = chatInput.value.trim();
    if(!text) return;

    appendMsg("user", text);
    chatInput.value = "";

    // Delay antes de mostrar "digitando"
    const typingTimeout = setTimeout(() => {
        showTypingIndicator();
    }, 2000);

    try {
        const res = await fetch("/chat", {
            method:"POST",
            headers:{
                "Content-Type":"application/json",
                "X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content
            },
            body:JSON.stringify({message:text})
        });

        clearTimeout(typingTimeout);
        removeTypingIndicator();

        const data = await res.json();
        appendMsg("bot", data.reply ?? "⚠ Erro ao responder.");
    }
    catch {
        clearTimeout(typingTimeout);
        removeTypingIndicator();
        appendMsg("bot", "⚠ O assistente está indisponível no momento.");
    }
}

// ENTER PARA ENVIAR
chatInput.addEventListener("keypress", e => {
    if(e.key === "Enter") sendMessage();
});

// BOTÃO ENVIAR
chatSend.onclick = () => sendMessage();

// CURSOR “hand”
document.querySelectorAll("button, #chatButton, .whatsapp-float")
    .forEach(el=> el.style.cursor="pointer");
</script>

</body>
</html>
