<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Redefinir Senha</title>

    <style>
        :root {
            --card-bg: rgba(255, 255, 255, .12);
            --card-border: rgba(255, 255, 255, .25);
            --text-light: rgba(255, 255, 255, .90);
            --weak: #ff6b6b;
            --medium: #ffd86b;
            --strong: #7bff9f;
        }

        * { box-sizing: border-box; }

        html, body {
            height: 100%;
            margin: 0;
            font-family: "Inter", "Segoe UI", Roboto, Arial, sans-serif;
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
            width: min(94vw, 390px);
            padding: 36px 32px;
            border-radius: 22px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: blur(18px) saturate(160%);
            box-shadow: 0 22px 60px rgba(0,0,0,.45);
            animation: fadeIn .6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(22px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            text-align: center;
            margin-bottom: 18px;
            font-size: 23px;
            letter-spacing: .3px;
        }

        label {
            display: block;
            margin-top: 14px;
            font-size: 13px;
            opacity: .9;
        }

        .field {
            position: relative;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.18);
            padding: 11px 13px;
            border-radius: 12px;
            margin-top: 5px;
            transition: .25s ease;
        }

        .field:focus-within {
            border-color: #ffb27a;
            background: rgba(255,255,255,.14);
            transform: scale(1.015);
        }

        input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #fff;
            font-size: 15px;
            padding-right: 36px;
        }

        /* 👁 Ícone do olho */
        .togglePwd {
            width: 20px;
            height: 20px;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            cursor: pointer;
            pointer-events: none;
            transition: opacity .25s ease;
        }

        button {
            width: 100%;
            padding: 13px;
            border-radius: 14px;
            background: linear-gradient(90deg,#ff512f,#f09819);
            border: none;
            margin-top: 22px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(255,81,47,.35);
            transition: .2s ease;
        }

        button:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(255,81,47,.45);
        }

        button:disabled {
            opacity: .4;
            cursor: not-allowed;
        }

        .errors {
            padding: 10px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 14px;
            background:#ff4d6d22;
            border:1px solid #ff4d6d55;
            color:#ffd6df;
        }

        #password-info, #password-checklist, #strength-bar {
            opacity: 0;
            display: none;
            transform: translateY(-6px);
            transition: opacity .25s ease, transform .25s ease;
        }

        #strength-bar {
            width: 100%;
            height: 6px;
            border-radius: 6px;
            margin-top: 6px;
            background: rgba(255,255,255,.15);
            overflow: hidden;
        }

        #strength-fill {
            height: 100%;
            width: 0%;
            background: var(--weak);
            transition: width .35s ease, background .35s ease;
        }

        .bounce { animation: bounce .35s ease; }

        @keyframes bounce {
            50% { transform: scale(1.24); }
        }

        .back a { color:#fff; font-size:13px; text-decoration:none; opacity:.85; }
        .back a:hover { opacity:1; }
    </style>
</head>

<body>

<form method="POST" action="{{ route('cliente.password.update') }}" class="card">
@csrf

<h1>Redefinir Senha</h1>

@if ($errors->any())
<div class="errors">
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<input type="hidden" name="token" value="{{ request()->route('token') }}">
<input type="hidden" name="email" value="{{ request()->query('email') }}">

<label>Nova Senha</label>
<div class="field">
    <input type="password" id="password" name="password" required>

    <!-- OLHO -->
    <svg class="togglePwd" viewBox="0 0 24 24" fill="currentColor">
        <path class="eyeOpen" d="M12 5c-7.633 0-10 7-10 7s2.367 7 10 7 10-7 10-7-2.367-7-10-7Zm0 11a4 4 0 1 1 4-4 4 4 0 0 1-4 4Z"/>
        <path class="eyeClosed" style="display:none;" d="M2 3.27 3.28 2 22 20.72l-1.28 1.28-3.2-3.2A10.82 10.82 0 0 1 12 19c-7.63 0-10-7-10-7a17.39 17.39 0 0 1 4.11-5.63L2 3.27Z"/>
    </svg>
</div>

<div id="password-info">A senha deve conter:</div>

<ul id="password-checklist">
    <li id="req-length">❌ Mínimo 8 caracteres</li>
    <li id="req-upper">❌ 1 letra maiúscula</li>
    <li id="req-lower">❌ 1 letra minúscula</li>
    <li id="req-number">❌ 1 número</li>
    <li id="req-symbol">❌ 1 símbolo (!@#$%)</li>
</ul>

<div id="strength-bar"><div id="strength-fill"></div></div>

<label>Confirmar Nova Senha</label>
<div class="field">
    <input type="password" id="password_confirmation" name="password_confirmation" required>

    <!-- OLHO -->
    <svg class="togglePwd" viewBox="0 0 24 24" fill="currentColor">
        <path class="eyeOpen" d="M12 5c-7.633 0-10 7-10 7s2.367 7 10 7 10-7 10-7-2.367-7-10-7Zm0 11a4 4 0 1 1 4-4 4 4 0 0 1-4 4Z"/>
        <path class="eyeClosed" style="display:none;" d="M2 3.27 3.28 2 22 20.72l-1.28 1.28-3.2-3.2A10.82 10.82 0 0 1 12 19c-7.63 0-10-7-10-7a17.39 17.39 0 0 1 4.11-5.63L2 3.27Z"/>
    </svg>
</div>

<div id="match-warning" style="font-size:12px;color:#ffbaba;display:none;">
    ❌ As senhas não coincidem
</div>

<button id="submit-btn" disabled>Salvar Nova Senha</button>

<div class="back" style="margin-top:14px;">
    <a href="{{ route('cliente.login.form') }}">← Voltar ao login</a>
</div>

</form>

<script>
/* --------- CHECKLIST --------- */
const pass = document.getElementById("password");
const conf = document.getElementById("password_confirmation");
const btn = document.getElementById("submit-btn");

const info = document.getElementById("password-info");
const list = document.getElementById("password-checklist");

const bar = document.getElementById("strength-bar");
const fill = document.getElementById("strength-fill");

const warning = document.getElementById("match-warning");

const rules = {
    length: document.getElementById("req-length"),
    upper: document.getElementById("req-upper"),
    lower: document.getElementById("req-lower"),
    number: document.getElementById("req-number"),
    symbol: document.getElementById("req-symbol")
};

function showChecklist() {
    info.style.display = "block";
    list.style.display = "block";
    bar.style.display = "block";

    setTimeout(() => {
        info.style.opacity = 1;
        list.style.opacity = 1;
        bar.style.opacity = 1;
    }, 10);
}

function hideChecklist() {
    info.style.opacity = 0;
    list.style.opacity = 0;
    bar.style.opacity = 0;

    setTimeout(() => {
        info.style.display = "none";
        list.style.display = "none";
        bar.style.display = "none";
    }, 250);
}

pass.addEventListener("focus", showChecklist);
pass.addEventListener("blur", hideChecklist);

function validate() {
    const v = pass.value;

    const okLen = v.length >= 8;
    const okUp = /[A-Z]/.test(v);
    const okLo = /[a-z]/.test(v);
    const okNum = /[0-9]/.test(v);
    const okSym = /[!@#$%^&*(),.?":{}|<>]/.test(v);

    update(rules.length, okLen);
    update(rules.upper, okUp);
    update(rules.lower, okLo);
    update(rules.number, okNum);
    update(rules.symbol, okSym);

    let strength = okLen + okUp + okLo + okNum + okSym;

    fill.style.width = (strength * 20) + "%";
    fill.style.background =
        strength <= 2 ? "var(--weak)" :
        strength === 3 ? "var(--medium)" :
        "var(--strong)";

    const match = pass.value === conf.value;
    warning.style.display = match ? "none" : "block";

    btn.disabled = !(okLen && okUp && okLo && okNum && okSym && match);
}

function update(el, ok) {
    el.textContent = (ok ? "✔️ " : "❌ ") + el.textContent.substring(2);
    el.style.color = ok ? "#baffc9" : "#ffd6d6";
    el.classList.add("bounce");
    setTimeout(() => el.classList.remove("bounce"), 250);
}

pass.addEventListener("input", validate);
conf.addEventListener("input", validate);


/* --------- OLHO PARA MOSTRAR/OCULTAR SENHA --------- */

document.querySelectorAll(".field").forEach(field => {
    const input = field.querySelector("input[type='password']");
    const toggle = field.querySelector(".togglePwd");
    if (!input || !toggle) return;

    const open = toggle.querySelector(".eyeOpen");
    const closed = toggle.querySelector(".eyeClosed");

    input.addEventListener("focus", () => {
        toggle.style.opacity = 0.75;
        toggle.style.pointerEvents = "auto";
    });

    input.addEventListener("blur", () => {
        if (!input.value) {
            toggle.style.opacity = 0;
            toggle.style.pointerEvents = "none";
        }
    });

    toggle.addEventListener("click", () => {
        const showing = input.type === "text";

        input.type = showing ? "password" : "text";
        open.style.display = showing ? "block" : "none";
        closed.style.display = showing ? "none" : "block";
    });
});
</script>

</body>
</html>
