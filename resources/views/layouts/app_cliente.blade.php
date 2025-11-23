<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ATS - Área do Cliente</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        :root{
            --dark:#1b1b1b;
            --light:#ffffff;
            --accent:#ff7a00;
            --glass:rgba(255,255,255,0.55);
        }

        body{
            margin:0;
            font-family:Inter, sans-serif;
            background:#f3f4f6;
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        header{
            background:rgba(255,255,255,0.7);
            backdrop-filter:blur(12px);
            border-bottom:1px solid #ddd;
            padding:18px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            position:sticky;
            top:0;
            z-index:10;
        }

        header img{ height:44px; }

        nav a, nav button{
            margin-left:22px;
            font-weight:600;
            font-size:16px;
            color:#333;
            text-decoration:none;
            background:none;
            border:none;
            cursor:pointer;
            transition:.25s;
        }

        nav a:hover, nav button:hover{
            color:var(--accent);
            transform:translateY(-2px);
        }

        main{
            flex:1;
            display:flex;
            justify-content:center;
            padding:40px 20px;
        }

        .card{
            width:100%;
            max-width:900px;
            background:var(--glass);
            border-radius:18px;
            padding:36px;
            border:1px solid rgba(0,0,0,0.1);
            box-shadow:0 10px 25px rgba(0,0,0,0.1);
            backdrop-filter:blur(14px);
        }

        footer{
            background:var(--glass);
            text-align:center;
            padding:12px;
            border-top:1px solid #ddd;
        }

        /* BOTÕES FLOTANTES */
        .pulse{
            animation:pulseGlow 1.8s infinite ease-in-out;
        }

        @keyframes pulseGlow {
            0% { transform:scale(1); box-shadow:0 0 0px rgba(255,122,0,.35); }
            50% { transform:scale(1.12); box-shadow:0 0 20px rgba(255,122,0,.7); }
            100% { transform:scale(1); box-shadow:0 0 0px rgba(255,122,0,.35); }
        }

        .whatsapp-float{
            position:fixed;
            bottom:40px;
            right:120px;
            width:70px;
            height:70px;
            background:#25d366;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            font-size:38px;
            cursor:pointer;
            z-index:999;
        }

        /* CHAT BUTTON */
        #chatButton{
            position:fixed;
            bottom:40px;
            right:30px;
            width:70px;
            height:70px;
            background:#1c1c1c;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:30px;
            color:white;
            cursor:pointer;
            z-index:999;
        }

        /* CHAT WINDOW REAL */
        #chatWindow{
            position:fixed;
            bottom:130px;
            right:30px;
            width:360px;
            height:500px;
            background:#fff;
            border-radius:14px;
            box-shadow:0 12px 40px rgba(0,0,0,0.20);
            opacity:0;
            pointer-events:none;
            display:flex;
            flex-direction:column;
            transform:translateY(40px) scale(.96);
            transition:opacity .35s ease, transform .35s cubic-bezier(.16,.84,.44,1);
            overflow:hidden;
            z-index:998;
        }

        #chatWindow.show{
            opacity:1;
            pointer-events:auto;
            transform:translateY(0) scale(1);
        }

        #chatHeader{
            background:#1b1b1b;
            color:white;
            padding:14px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            font-weight:600;
            cursor:default;
        }

        .header-btn{
            background:none;
            border:none;
            color:white;
            cursor:pointer;
            font-size:18px;
            margin-left:8px;
        }

        #chatBody{
            flex:1;
            overflow-y:auto;
            padding:16px;
            background:#fafafa;
            display:flex;
            flex-direction:column;
        }

        .msg{
            max-width:80%;
            padding:10px 14px;
            margin:6px 0;
            border-radius:14px;
            font-size:15px;
            line-height:1.4;
        }

.msg.user {
    background:#1b1b1b;
    color:white;
    margin-left:auto;
    border-radius:14px 14px 0 14px;
}

.msg.bot {
    background:#e5e5e5;
    color:#333;
    margin-right:auto;
    border-radius:14px 14px 14px 0;
}


        #chatInputArea{
            display:flex;
            border-top:1px solid #ddd;
        }

        #chatInput{
            flex:1;
            border:none;
            outline:none;
            padding:14px;
        }

        #chatSendButton{
            background:#1b1b1b;
            border:none;
            color:white;
            padding:12px 18px;
            font-size:16px;
            cursor:pointer;
        }

        #chatSendButton:hover{
            background:black;
        }

        /* POPUP */
        #confirmPopup{
            position:absolute;
            inset:0;
            background:rgba(0,0,0,.55);
            opacity:0;
            pointer-events:none;
            display:flex;
            justify-content:center;
            align-items:center;
            transition:opacity .35s ease;
        }

        #confirmPopup.show{
            opacity:1;
            pointer-events:auto;
        }

        .popup-box{
            background:#fff;
            padding:24px;
            border-radius:12px;
            text-align:center;
            width:250px;
            animation:scaleUp .3s ease;
        }

        @keyframes scaleUp{
            from{transform:scale(.85); opacity:.3;}
            to{transform:scale(1); opacity:1;}
        }

        .popup-confirm,.popup-cancel{
            padding:8px 14px;
            border:none;
            border-radius:6px;
            cursor:pointer;
        }

        .popup-confirm{
            background:#1b1b1b;
            color:white;
        }

        .popup-cancel{
            background:#bbb;
            margin-left:8px;
        }

        #typingIndicator{
            opacity:.6;
            font-style:italic;
            padding:6px 10px;
        }
    </style>
</head>

<body>

<header>
    <a href="{{ route('cliente.home') }}"><img src="/img/ATS.png"></a>

    <nav>
        <a href="{{ route('cliente.home') }}">Início</a>
        <a href="{{ route('cliente.veiculos') }}">Veículos</a>
        <a href="{{ route('cliente.agendamento') }}">Agendamentos</a>
        <a href="{{ route('cliente.perfil') }}">Perfil</a>

        <form method="POST" action="{{ route('cliente.logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Sair</button>
        </form>
    </nav>
</header>

<main>
    <div class="card">@yield('content')</div>
</main>

<footer>© {{ date('Y') }} Automotive Testing Site — Todos os direitos reservados.</footer>

<!-- BOTÕES -->
<a href="https://wa.me/5554999050399" class="whatsapp-float pulse">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<div id="chatButton" class="pulse">
    <i class="fa-solid fa-comment"></i>
</div>

<!-- CHAT -->
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
        <input type="text" id="chatInput" placeholder="Digite sua mensagem...">
        <button id="chatSendButton"><i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>

<script>
const chatWindow = document.getElementById("chatWindow");
const chatButton = document.getElementById("chatButton");
const chatInput = document.getElementById("chatInput");
const chatBody = document.getElementById("chatBody");
const popup = document.getElementById("confirmPopup");

/* ABRIR SUAVE */
chatButton.onclick = () => {
    chatWindow.style.pointerEvents = "auto";
    chatWindow.classList.toggle("show");
};

/* MINIMIZAR */
document.getElementById("minimizeChat").onclick = () => {
    chatWindow.classList.remove("show");
    setTimeout(() => chatWindow.style.pointerEvents = "none", 350);
};

/* FECHAR COM POPUP */
document.getElementById("endChat").onclick = () => popup.classList.add("show");
document.getElementById("confirmNo").onclick = () => popup.classList.remove("show");

/* CONFIRMAR RESET */
document.getElementById("confirmYes").onclick = async () => {
    popup.classList.remove("show");
    chatBody.innerHTML = "";

    await fetch("{{ url('/chat/reset') }}");

    chatWindow.classList.remove("show");

    setTimeout(() => {
        chatWindow.style.pointerEvents = "none";
    }, 350);
};

/* ----------- MENSAGENS ----------- */

function appendMessage(type, text) {
    removeTypingIndicator(); // evita duplicações

    const msg = document.createElement("div");
    msg.className = "msg " + type;
    msg.textContent = text;
    chatBody.appendChild(msg);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function showTypingIndicator() {
    // remove caso exista
    removeTypingIndicator();

    const t = document.createElement("div");
    t.id = "typingIndicator";
    t.className = "msg bot typing";
    t.textContent = "Assistente digitando…";
    chatBody.appendChild(t);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function removeTypingIndicator() {
    const t = document.getElementById("typingIndicator");
    if (t) t.remove();
}

chatInput.addEventListener("keypress", e => {
    if (e.key === "Enter") sendMessage();
});

document.getElementById("chatSendButton").onclick = () => sendMessage();

/* ----------- ENVIO COM DELAY E DIGITAÇÃO ----------- */

async function sendMessage() {
    const text = chatInput.value.trim();
    if (!text) return;

    appendMessage("user", text);
    chatInput.value = "";

    let typingDelayPassed = false;

    // delay de 2s ANTES de mostrar o typing
    const typingTimeout = setTimeout(() => {
        typingDelayPassed = true;
        showTypingIndicator();
    }, 2000);

    try {
        const controller = new AbortController();
        const timeout = setTimeout(() => controller.abort(), 6000);

        const response = await fetch("{{ url('/chat') }}", {
            method: "POST",
            signal: controller.signal,
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ message: text })
        });

        clearTimeout(timeout);
        clearTimeout(typingTimeout);

        removeTypingIndicator(); // sempre remove

        const data = await response.json();

        appendMessage("bot", data.reply ?? "⚠ Erro ao responder. Tente novamente.");

    } catch (e) {
        clearTimeout(typingTimeout);
        removeTypingIndicator();
        appendMessage("bot", "⚠ O assistente está indisponível no momento.");
    }
}
</script>
    

</body>
</html>
