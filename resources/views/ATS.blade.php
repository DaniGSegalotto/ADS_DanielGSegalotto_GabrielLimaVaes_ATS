<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Automotive Testing Site</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        :root {
            --primary:#111;
            --secondary:#555;
            --border:#e4e4e4;
            --bg:#f7f7f7;
            --accent:#ff6a00;

            --dark:#1b1b1b;
            --glass:rgba(255,255,255,0.55);
        }

        * {
            margin:0; padding:0;
            box-sizing:border-box;
            font-family:'Inter',sans-serif;
        }

        body {
            background:var(--bg);
            color:var(--primary);
        }

        /* HEADER */
        header {
            width:100%;
            padding:22px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            background:#fff;
            border-bottom:1px solid var(--border);
            position:sticky;
            top:0;
            z-index:10;
        }
        header img { height:42px; }

        nav a {
            margin-left:22px;
            text-decoration:none;
            color:var(--secondary);
            font-weight:500;
            transition:.2s;
        }
        nav a:hover { color:var(--primary); }

        /* HERO */
        .hero {
            width:100%;
            min-height:260px;
            background:url('/img/banner-ats.jpg') center/cover no-repeat;
            position:relative;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            text-align:center;
            padding:60px 20px;
        }
        .hero::before {
            content:"";
            position:absolute;
            inset:0;
            background:rgba(0,0,0,0.40);
        }
        .hero h1 {
            position:relative;
            font-size:48px;
            font-weight:700;
            color:#fff;
            text-shadow:0 3px 8px rgba(0,0,0,.55);
        }
        .hero span.highlight {
            background:linear-gradient(90deg,#ff6a00,#ffbb00);
            -webkit-background-clip:text;
            color:transparent;
        }
        .hero h2 {
            position:relative;
            margin-top:10px;
            color:#eaeaea;
            font-size:20px;
            font-weight:400;
        }

        /* ALERTA */
        .temp-alert {
            background:#e9fbe9;
            color:#0a7f2f;
            padding:10px;
            max-width:700px;
            margin:25px auto;
            border:1px solid #bbf1c2;
            border-radius:10px;
            text-align:center;
            animation:fadeOut 4s forwards;
        }
        @keyframes fadeOut {
            0%{opacity:1;} 70%{opacity:1;} 100%{opacity:0;visibility:hidden;}
        }

        .container { max-width:1200px; padding:0 20px; margin:40px auto; }

        /* CARDS */
        .cards {
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
            gap:22px;
        }
        .card {
            background:#fff;
            border:1px solid var(--border);
            padding:26px;
            border-radius:18px;
            transition:.25s;
        }
        .card:hover {
            transform:translateY(-4px);
            box-shadow:0 8px 22px rgba(0,0,0,.06);
        }
        .card h3 { font-size:20px; font-weight:600; }
        .card p { margin:14px 0; font-size:15px; color:#666; }
        .card a {
            display:inline-block;
            padding:10px 16px;
            background:#111;
            color:#fff;
            border-radius:10px;
            text-decoration:none;
        }

        /* INFO BOX */
        .info-box {
            margin-top:50px;
            background:#fff;
            padding:35px;
            border-radius:18px;
            border:1px solid var(--border);
        }

        /* FLOAT BUTTONS */
        .pulse {
            animation:pulseAnim 1.8s infinite ease-in-out;
        }
        @keyframes pulseAnim {
            0%{transform:scale(1); box-shadow:0 0 0 rgba(255,122,0,.35);}
            50%{transform:scale(1.12); box-shadow:0 0 20px rgba(255,122,0,.7);}
            100%{transform:scale(1); box-shadow:0 0 0 rgba(255,122,0,.35);}
        }

        .whatsapp-float {
            position:fixed;
            bottom:30px;
            right:100px;
            width:62px;
            height:62px;
            background:#25D366;
            border-radius:50%;
            display:flex; justify-content:center; align-items:center;
            font-size:30px; color:white;
            cursor:pointer; z-index:900;
        }

        /* CHAT BUTTON REAL */
        #chatButton {
            position:fixed;
            bottom:30px;
            right:25px;
            width:62px; height:62px;
            background:#1b1b1b;
            color:#fff;
            border-radius:50%;
            font-size:26px;
            display:flex; justify-content:center; align-items:center;
            cursor:pointer;
            z-index:999;
        }

        /* CHAT WINDOW */
        #chatWindow {
            position:fixed;
            bottom:110px;
            right:25px;
            width:360px;
            height:500px;
            background:#fff;
            border-radius:14px;
            box-shadow:0 12px 40px rgba(0,0,0,.25);
            opacity:0; pointer-events:none;
            transform:translateY(40px) scale(.95);
            transition:opacity .35s ease, transform .35s ease;
            display:flex; flex-direction:column;
            overflow:hidden; z-index:998;
        }
        #chatWindow.show {
            opacity:1;
            pointer-events:auto;
            transform:translateY(0) scale(1);
        }

        #chatHeader {
            background:#1b1b1b;
            color:#fff;
            padding:14px;
            display:flex; justify-content:space-between;
            align-items:center;
            font-weight:600;
        }

        .header-btn {
            background:none; border:none;
            color:white; cursor:pointer;
            font-size:18px;
        }

        #chatBody {
            flex:1;
            padding:14px;
            background:#fafafa;
            overflow-y:auto;
            display:flex; flex-direction:column;
        }

        .msg {
            padding:10px 14px;
            margin:6px 0;
            max-width:80%;
            border-radius:14px;
            line-height:1.4;
        }
        .msg.user { margin-left:auto; background:#1b1b1b; color:white; border-radius:14px 14px 0 14px; }
        .msg.bot  { margin-right:auto; background:#e5e5e5; color:#333; border-radius:14px 14px 14px 0; }

        #typingIndicator {
            margin-right:auto;
            opacity:.6;
            font-style:italic;
            padding:8px 12px;
        }

        #chatInputArea {
            display:flex;
            border-top:1px solid #ddd;
        }
        #chatInput {
            flex:1; border:none; padding:14px; outline:none;
        }
        #chatSendButton {
            background:#1b1b1b;
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
            padding:24px;
            border-radius:12px;
            width:260px;
            text-align:center;
            animation:scaleUp .3s ease;
        }
        @keyframes scaleUp {
            from {transform:scale(.85); opacity:.3;}
            to   {transform:scale(1); opacity:1;}
        }

        .popup-confirm, .popup-cancel {
            cursor:pointer;
            padding:8px 14px;
            border:none;
            border-radius:6px;
        }
        .popup-confirm { background:#1b1b1b; color:white; }
        .popup-cancel  { background:#bbb; margin-left:8px; }

    </style>
</head>
<body>

<header>
    <img src="/img/ATS.png" alt="Logo ATS">
    <nav>
        <a href="/ATS">Início</a>
        <a href="/clientes">Clientes</a>
        <a href="/funcionarios">Funcionários</a>
        <a href="/marcas">Marcas</a>
        <a href="/veiculos">Veículos</a>
        <a href="/agendamentos">Agendamentos</a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
</header>

<div class="hero">
    <h1>Bem-vindo ao <span class="highlight">Automotive Testing Site</span></h1>
    <h2>Ambiente profissional para gerenciar test-drive, veículos e clientes</h2>
</div>

<div class="temp-alert">
    Logado como Funcionário. Acesso completo ao sistema.
</div>

<div class="container">

    <div class="cards">

        <div class="card">
            <h3>Clientes</h3>
            <p>Cadastre e gerencie seus clientes de forma prática e eficiente.</p>
            <a href="/clientes">Acessar</a>
        </div>

        <div class="card">
            <h3>Funcionários</h3>
            <p>Controle de permissões e gerenciamento da equipe interna.</p>
            <a href="/funcionarios">Acessar</a>
        </div>

        <div class="card">
            <h3>Veículos</h3>
            <p>Gerencie modelos, disponibilidade, histórico e detalhes técnicos.</p>
            <a href="/veiculos">Acessar</a>
        </div>

        <div class="card">
            <h3>Agendamentos</h3>
            <p>Organize test-drives e reservas com clareza e precisão.</p>
            <a href="/agendamentos">Acessar</a>
        </div>

    </div>

    <div class="info-box">
        <p>O <strong>Automotive Testing Site</strong> é uma plataforma moderna...</p>
    </div>

</div>

<!-- FLOATING BUTTONS -->
<a class="whatsapp-float pulse" href="https://wa.me/5554999050399" target="_blank">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<!-- CHAT BUTTON -->
<div id="chatButton" class="pulse">
    <i class="fa-solid fa-comment"></i>
</div>

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
        <input type="text" id="chatInput" placeholder="Digite sua mensagem...">
        <button id="chatSendButton"><i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>

<script>
const chatWindow = document.getElementById("chatWindow");
const chatButton = document.getElementById("chatButton");
const chatInput  = document.getElementById("chatInput");
const chatBody   = document.getElementById("chatBody");
const popup      = document.getElementById("confirmPopup");

/* ABRIR FLUIDO */
chatButton.onclick = () => {
    chatWindow.style.pointerEvents = "auto";
    chatWindow.classList.toggle("show");
};

/* MINIMIZAR */
document.getElementById("minimizeChat").onclick = () => {
    chatWindow.classList.remove("show");
    setTimeout(()=> chatWindow.style.pointerEvents="none", 350);
};

/* FECHAR COM POPUP */
document.getElementById("endChat").onclick = () => popup.classList.add("show");
document.getElementById("confirmNo").onclick = () => popup.classList.remove("show");

/* CONFIRMAR */
document.getElementById("confirmYes").onclick = async () => {
    popup.classList.remove("show");
    chatBody.innerHTML = "";
    await fetch("/chat/reset");
    chatWindow.classList.remove("show");
    setTimeout(()=> chatWindow.style.pointerEvents="none",350);
};

/* ----------- MENSAGENS ----------- */

function appendMessage(type,text){
    removeTypingIndicator();
    const msg=document.createElement("div");
    msg.className="msg "+type;
    msg.textContent=text;
    chatBody.appendChild(msg);
    chatBody.scrollTop=chatBody.scrollHeight;
}

function showTypingIndicator(){
    removeTypingIndicator();
    const t=document.createElement("div");
    t.id="typingIndicator";
    t.className="msg bot typing";
    t.textContent="Assistente digitando…";
    chatBody.appendChild(t);
    chatBody.scrollTop=chatBody.scrollHeight;
}

function removeTypingIndicator(){
    const t=document.getElementById("typingIndicator");
    if(t) t.remove();
}

chatInput.addEventListener("keypress",e=>{
    if(e.key==="Enter") sendMessage();
});
document.getElementById("chatSendButton").onclick = ()=> sendMessage();

/* ENVIO COM DELAY */
async function sendMessage(){
    const text=chatInput.value.trim();
    if(!text) return;

    appendMessage("user",text);
    chatInput.value="";

    let typingDelay=false;
    const typingTimeout=setTimeout(()=>{
        typingDelay=true;
        showTypingIndicator();
    },2000);

    try{
        const controller=new AbortController();
        const timeout=setTimeout(()=>controller.abort(),6000);

        const r=await fetch("/chat",{
            method:"POST",
            signal:controller.signal,
            headers:{
                "Content-Type":"application/json",
                "X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content
            },
            body:JSON.stringify({message:text})
        });

        clearTimeout(timeout);
        clearTimeout(typingTimeout);
        removeTypingIndicator();

        const data=await r.json();
        appendMessage("bot", data.reply ?? "⚠ Erro ao responder.");

    }catch(e){
        clearTimeout(typingTimeout);
        removeTypingIndicator();
        appendMessage("bot","⚠ O assistente está indisponível no momento.");
    }
}
</script>

<footer style="text-align:center; width:100%; padding:14px; opacity:0.55; color:#444;">
    © 2025 Automotive Testing Site — Todos os direitos reservados.
</footer>


</body>
</html>
