<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ATS - Área do Cliente</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

<style>
    .btn-salvar {
    background: #ff7a00 !important;
    color: #fff !important;
}
.swal2-confirm {
    background: #ff7a00 !important;
    color: #fff !important;
}


    :root {
        --accent:#ff7a00;
        --bg:#f3f4f6;
        --glass:rgba(255,255,255,0.55);
        --shadow:0 10px 25px rgba(0,0,0,0.12);
        --radius:18px;
    }

    * { margin:0; padding:0; box-sizing:border-box; font-family:Inter, sans-serif; }
    body {
        background:var(--bg);
        min-height:100vh;
        display:flex;
        flex-direction:column;
        color:#222;
    }

    header{
        height:72px;
        background:rgba(255,255,255,0.7);
        backdrop-filter:blur(14px);
        border-bottom:1px solid #dcdcdc;
        padding:0 40px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        position:sticky;
        top:0;
        z-index:1000;
    }
    header img { height:46px; }

    header nav{
        display:flex;
        align-items:center;
        gap:28px;
    }
    header nav a,
    header nav button{
        background:none;
        border:none;
        color:#444;
        font-weight:600;
        font-size:15px;
        cursor:pointer;
        text-decoration:none;
        transition:.25s ease;
    }
    header nav a:hover,
    header nav button:hover{
        color:var(--accent);
        transform:translateY(-2px);
    }

    main{
        flex:1;
        padding:40px 20px;
        display:flex;
        justify-content:center;
    }
    .card{
        width:100%;
        max-width:1200px;
        background:var(--glass);
        padding:40px;
        border-radius:var(--radius);
        border:1px solid rgba(255,255,255,0.45);
        box-shadow:var(--shadow);
        backdrop-filter:blur(14px);
    }

    footer{
        background:var(--glass);
        padding:14px;
        border-top:1px solid #dcdcdc;
        text-align:center;
        font-size:14px;
    }

    /* BOTÕES FLUTUANTES */
    .whatsapp-float,
    #chatButton {
        position:fixed;
        bottom:40px;
        width:70px;
        height:70px;
        border-radius:50%;
        display:flex;
        justify-content:center;
        align-items:center;
        cursor:pointer;
        z-index:5000;
    }
    .whatsapp-float{
        right:120px;
        background:#25d366;
        color:white;
        font-size:38px;
    }
    #chatButton{
        right:30px;
        background:#1c1c1c;
        color:white;
        font-size:30px;
    }

    /* ===============================
       CHAT WINDOW — VERSÃO ESTÁVEL
    ================================== */
    #chatWindow{
        position:fixed;
        bottom:130px;
        right:30px;
        width:360px;
        height:500px;
        background:white;
        border-radius:14px;
        box-shadow:0 12px 40px rgba(0,0,0,0.20);
        opacity:0;
        pointer-events:none;
        display:flex;
        flex-direction:column;
        transform:translateY(40px);
        transition:.3s ease;
        overflow:hidden;
        z-index:6000;
    }
    #chatWindow.show{
        opacity:1;
        pointer-events:auto;
        transform:translateY(0);
    }

    #chatHeader{
        background:#1b1b1b;
        color:white;
        padding:14px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    #chatBody{
        flex:1;
        overflow-y:auto;
        padding:16px;
        background:#fafafa;
    }

    .msg{
        max-width:80%;
        padding:10px 14px;
        margin:6px 0;
        border-radius:14px;
        font-size:15px;
    }
    .msg.user{
        margin-left:auto;
        background:#1b1b1b;
        color:white;
    }
    .msg.bot{
        background:#e5e5e5;
        margin-right:auto;
    }

    #chatInputArea{
        display:flex;
        gap:10px;
        padding:12px;
        border-top:1px solid #ddd;
        background:white;
    }
    #chatInputArea input{
        flex:1;
        padding:10px;
        border-radius:10px;
        border:1px solid #ccc;
    }

    #chatInputArea button{
        background:var(--accent);
        color:white;
        border:none;
        padding:10px 16px;
        border-radius:10px;
        cursor:pointer;
    }

    /* POPUP ENCERRAR DO CHAT */
    #confirmPopup{
        position:absolute;
        inset:0;
        background:rgba(0,0,0,.55);
        display:none;
        justify-content:center;
        align-items:center;
        z-index:9999;
    }
    #confirmPopup.show{
        display:flex !important;
    }

    .popup-box{
        background:white;
        padding:24px;
        width:250px;
        border-radius:12px;
        text-align:center;
    }
    .popup-confirm{
        background:#1b1b1b;
        color:white;
        border:none;
        padding:8px 14px;
        border-radius:6px;
        cursor:pointer;
    }
    .popup-cancel{
        background:#bbb;
        border:none;
        padding:8px 14px;
        border-radius:6px;
        margin-left:8px;
        cursor:pointer;
    }
</style>
</head>

<body>

<header>
    <a href="{{ route('cliente.home') }}">
        <img src="/img/ATS.png" alt="Logo ATS">
    </a>

    <nav>
        <a href="{{ route('cliente.home') }}">Início</a>
        <a href="{{ route('cliente.veiculos') }}">Veículos</a>
        <a href="{{ route('cliente.agendamento') }}">Agendar</a>
        <a href="{{ route('cliente.agendamentos') }}">Meus Agendamentos</a>
        <a href="{{ route('cliente.perfil') }}">Perfil</a>

        <form method="POST" action="{{ route('cliente.logout') }}" style="display:inline;">
            @csrf
            <button>Sair</button>
        </form>
    </nav>
</header>

<main>
    <div class="card">@yield('content')</div>
</main>

<footer>© {{ date('Y') }} Automotive Testing Site — Todos os direitos reservados.</footer>

<!-- BOTÃO WHATSAPP -->
<a href="https://wa.me/5554999050399" class="whatsapp-float">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<!-- BOTÃO CHAT -->
<div id="chatButton"><i class="fa-solid fa-comment"></i></div>

<!-- JANELA DO CHAT -->
<div id="chatWindow">

    <div id="chatHeader">
        Assistente Virtual ATS
        <div>
            <button id="minimizeChat" class="header-btn">—</button>
            <button id="endChat" class="header-btn">×</button>
        </div>
    </div>

    <div id="chatBody"></div>

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const chatWindow = document.getElementById("chatWindow");
const chatButton = document.getElementById("chatButton");
const chatInput = document.getElementById("chatInput");
const chatBody = document.getElementById("chatBody");
const popup = document.getElementById("confirmPopup");

/* ABRIR CHAT */
chatButton.onclick = () => chatWindow.classList.toggle("show");

/* MINIMIZAR */
document.getElementById("minimizeChat").onclick = () =>
    chatWindow.classList.remove("show");

/* ABRIR POPUP ENCERRAR */
document.getElementById("endChat").onclick = () =>
    popup.classList.add("show");

/* FECHAR POPUP */
document.getElementById("confirmNo").onclick = () =>
    popup.classList.remove("show");

/* ENCERRAR CHAT */
document.getElementById("confirmYes").onclick = async () => {
    popup.classList.remove("show");
    await fetch("{{ url('/chat/reset') }}");
    chatBody.innerHTML = "";
    chatWindow.classList.remove("show");
};

/* ADICIONAR MENSAGEM */
function appendMessage(type, text){
    const msg = document.createElement("div");
    msg.className = "msg " + type;
    msg.textContent = text;
    chatBody.appendChild(msg);
    chatBody.scrollTop = chatBody.scrollHeight;
}

/* ENVIAR AO PRESSIONAR ENTER */
chatInput.addEventListener("keypress", e => {
    if(e.key === "Enter") sendMessage();
});

/* ENVIAR AO CLICAR NO BOTÃO */
document.getElementById("chatSendButton").onclick = () => sendMessage();

/* ENVIAR MENSAGEM */
async function sendMessage(){
    const text = chatInput.value.trim();
    if(!text) return;

    appendMessage("user", text);
    chatInput.value = "";

    const typing = document.createElement("div");
    typing.className = "msg bot";
    typing.textContent = "Digitando...";
    chatBody.appendChild(typing);

    const response = await fetch("{{ url('/chat') }}", {
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            "X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content
        },
        body:JSON.stringify({ message:text })
    });

    typing.remove();

    const data = await response.json();
    appendMessage("bot", data.reply ?? "⚠ Erro ao responder.");
}
</script>

</body>
</html>
