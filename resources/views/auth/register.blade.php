<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Criar conta</title>
<style>
  :root{
    --card-bg: rgba(255,255,255,.12);
    --card-border: rgba(255,255,255,.25);
    --ok:#77ffa8; --bad:#ffd0d6;
  }
  *{box-sizing:border-box}
  html,body{height:100%}
  body{
    margin:0;
    font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
    color:#fff;
    background:
      radial-gradient(60vmax 60vmax at 20% 30%, #ff512f66 0%, transparent 60%),
      radial-gradient(60vmax 60vmax at 80% 70%, #f0981966 0%, transparent 55%),
      radial-gradient(50vmax 50vmax at 70% 20%, #ff3d7166 0%, transparent 60%),
      linear-gradient(120deg, #1a0b0b 0%, #2a0f0f 100%);
    display:grid; place-items:center; padding:18px;
  }
  .card{
    width:min(92vw, 400px);
    padding:20px 18px 16px;
    border-radius:20px;
    background:var(--card-bg);
    border:1px solid var(--card-border);
    backdrop-filter: blur(14px) saturate(120%);
    -webkit-backdrop-filter: blur(14px) saturate(120%);
    box-shadow:0 16px 44px rgba(0,0,0,.45);
  }
  .avatar{
    width:56px; height:56px; border-radius:50%;
    background:linear-gradient(180deg,#ffffff33,#ffffff11);
    border:1px solid var(--card-border);
    display:grid; place-items:center; margin:0 auto 8px;
  }
  .avatar svg{width:22px;height:22px;opacity:.9}
  h1{margin:6px 0 2px; font-size:20px; font-weight:700; text-align:center}
  p.subtitle{margin:0 0 8px; opacity:.85; text-align:center; font-size:12px}

  label{font-size:12px; opacity:.95; display:block; margin:8px 2px 4px}
  .field{
    display:flex; align-items:center; gap:8px;
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.18);
    padding:8px 10px; border-radius:12px;
  }
  .field input{flex:1; background:transparent; border:0; outline:0; color:#fff; font-size:14px}
  ::placeholder{color:#eee; opacity:.7}
  input:-webkit-autofill, input:-webkit-autofill:focus{transition: background-color 600000s 0s, color 600000s 0s;}

  .errors{background:#ff4d6d22; border:1px solid #ff4d6d55; color:#ffdbe3;
    padding:8px 10px; border-radius:10px; font-size:12px; margin:8px 0 6px}
  .errors div{margin:2px 0}

  /* dicas de senha: escondidas por padrão */
  .pwd-hint{display:none; margin-top:8px; background:rgba(0,0,0,.18); border:1px solid rgba(255,255,255,.18);
    border-radius:12px; padding:8px 10px; font-size:12px}
  .pwd-hint.show{display:block}
  .rules{display:grid; gap:4px; margin:0}
  .rule{display:flex; align-items:center; gap:8px; opacity:.9}
  .rule .dot{width:7px; height:7px; border-radius:999px; background:var(--bad)}
  .rule.ok .dot{background:var(--ok)} .rule.ok{opacity:1}

  .actions{display:flex; justify-content:space-between; align-items:center; gap:10px; margin-top:12px}
  .login-link{font-size:12px}
  .login-link a{color:#fff; opacity:.95; text-decoration:none}
  .login-link a:hover{color:#ffce9f; text-decoration:underline}

  button{
    border:0; cursor:pointer; padding:10px 14px; border-radius:12px; font-weight:700;
    letter-spacing:.3px; font-size:14px; color:#fff;
    background:linear-gradient(90deg,#ff512f, #f09819);
    box-shadow:0 8px 20px rgba(255,81,47,.35);
    transition:transform .06s ease, box-shadow .15s ease;
  }
  button:hover{box-shadow:0 10px 24px rgba(255,81,47,.45)}
  button:active{transform:translateY(1px)}

  .icon{width:16px; height:16px; opacity:.9}
  #confirmError{color:#ffd0d6; font-size:12px; margin-top:6px; display:none}
</style>
</head>
<body>
  <main class="card">
    <div class="avatar" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-4.59 0-8 2.13-8 4.75V21h16v-2.25C20 16.13 16.59 14 12 14Z"/></svg>
    </div>
    <h1>Criar conta</h1>
    <p class="subtitle">Preencha seus dados para começar.</p>

    @if ($errors->any())
      <div class="errors" role="alert">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form id="registerForm" method="POST" action="{{ route('register') }}" novalidate>
      @csrf

      <label for="name">Nome</label>
      <div class="field">
        <svg class="icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-4.59 0-8 2.13-8 4.75V21h16v-2.25C20 16.13 16.59 14 12 14Z"/></svg>
        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Seu nome" required autofocus>
      </div>

      <label for="email">E-mail</label>
      <div class="field">
        <svg class="icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 13 2 6.76V18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6.76L12 13ZM12 11 22 4H2l10 7Z"/></svg>
        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="seu@email.com" required>
      </div>

      <label for="password">Senha</label>
      <div class="field">
        <svg class="icon" viewBox="0 0 24 24" fill="currentColor"><path d="M17 9h-1V7a4 4 0 0 0-8 0v2H7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2ZM12 16a1.5 1.5 0 1 0-1.5-1.5A1.5 1.5 0 0 0 12 16Z"/></svg>
        <input id="password" name="password" type="password" placeholder="Crie uma senha" required aria-describedby="pwdRules">
      </div>

      <!-- Dicas: só exibimos quando .show (JS) -->
      <div class="pwd-hint" id="pwdRules" aria-live="polite">
        <div class="rules">
          <div class="rule" data-rule="len"><span class="dot"></span>8 ou mais caracteres</div>
          <div class="rule" data-rule="upper"><span class="dot"></span>Pelo menos 1 letra maiúscula</div>
          <div class="rule" data-rule="lower"><span class="dot"></span>Pelo menos 1 letra minúscula</div>
          <div class="rule" data-rule="num"><span class="dot"></span>Pelo menos 1 número</div>
          <div class="rule" data-rule="sym"><span class="dot"></span>Pelo menos 1 caractere especial</div>
        </div>
      </div>

      <label for="password_confirmation">Confirmar senha</label>
      <div class="field">
        <svg class="icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a5 5 0 0 0-5 5v2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7a5 5 0 0 0-5-5Zm-3 7V7a3 3 0 0 1 6 0v2Zm3 9a1.5 1.5 0 1 1 1.5-1.5A1.5 1.5 0 0 1 12 18Z"/></svg>
        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repita a senha" required>
      </div>
      <div id="confirmError">As senhas não coincidem.</div>

      <div class="actions">
        <div class="login-link">Já tem conta? <a href="{{ url('/') }}">Entrar</a></div>
        <button type="submit">REGISTRAR</button>
      </div>
    </form>
  </main>

<script>
(function(){
  const pwd = document.getElementById('password');
  const confirm = document.getElementById('password_confirmation');
  const form = document.getElementById('registerForm');
  const hint = document.getElementById('pwdRules');
  const confirmError = document.getElementById('confirmError');

  const rules = {
    len: v => v.length >= 8,
    upper: v => /[A-Z]/.test(v),
    lower: v => /[a-z]/.test(v),
    num: v => /\d/.test(v),
    sym: v => /[^A-Za-z0-9]/.test(v),
  };
  const els = {};
  document.querySelectorAll('.rule').forEach(el => els[el.dataset.rule] = el);

  function updateRules(){
    const v = pwd.value || '';
    let okAll = true;
    for (const k in rules){
      const ok = rules[k](v);
      els[k].classList.toggle('ok', ok);
      if(!ok) okAll = false;
    }
    return okAll;
  }
  function checkConfirm(){
    const ok = pwd.value === confirm.value;
    confirmError.style.display = ok ? 'none' : 'block';
    return ok;
  }

  // Mostrar regras só quando interagir com o campo de senha
  pwd.addEventListener('focus', ()=>{ hint.classList.add('show'); updateRules(); });
  pwd.addEventListener('input', updateRules);
  pwd.addEventListener('blur', ()=>{
    // se campo vazio, esconde; se tem valor e está inválido, mantém visível
    if(!pwd.value) hint.classList.remove('show');
    else if(updateRules()) hint.classList.remove('show'); // válido: pode esconder
    else hint.classList.add('show');
  });

  confirm.addEventListener('input', checkConfirm);

  form.addEventListener('submit', function(e){
    const ok = updateRules();
    const match = checkConfirm();
    if(!ok || !match){
      // garante que o usuário veja a dica se tentou enviar errado
      hint.classList.add('show');
      e.preventDefault();
    }
  });
})();
</script>
</body>
</html>
