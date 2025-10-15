<!-- resources/views/auth/reset-password.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Redefinir senha</title>
<style>
  :root{ --card-bg: rgba(255,255,255,.12); --card-border: rgba(255,255,255,.25); --ok:#77ffa8; --bad:#ffd0d6; }
  *{box-sizing:border-box} html,body{height:100%}
  body{
    margin:0;font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;color:#fff;
    background:
      radial-gradient(60vmax 60vmax at 20% 30%, #ff512f66 0%, transparent 60%),
      radial-gradient(60vmax 60vmax at 80% 70%, #f0981966 0%, transparent 55%),
      radial-gradient(50vmax 50vmax at 70% 20%, #ff3d7166 0%, transparent 60%),
      linear-gradient(120deg, #1a0b0b 0%, #2a0f0f 100%); display:grid;place-items:center;padding:24px;
  }
  .card{width:min(94vw, 420px);padding:24px 22px 20px;border-radius:22px;background:var(--card-bg);
    border:1px solid var(--card-border);backdrop-filter: blur(16px) saturate(120%);-webkit-backdrop-filter: blur(16px) saturate(120%);
    box-shadow:0 20px 60px rgba(0,0,0,.45);}
  .avatar{width:72px;height:72px;border-radius:50%;background:linear-gradient(180deg,#ffffff33,#ffffff11);
    border:1px solid var(--card-border);display:grid;place-items:center;margin:0 auto 10px}
  .avatar svg{width:26px;height:26px;opacity:.9}
  h1{margin:6px 0 4px;text-align:center;font-size:20px;font-weight:700}
  p.sub{margin:0 0 12px;text-align:center;opacity:.9;font-size:13px}

  label{font-size:13px;opacity:.95;display:block;margin:10px 2px 6px}
  .field{display:flex;align-items:center;gap:8px;background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.18);padding:10px 12px;border-radius:12px}
  .field input{flex:1;background:transparent;border:0;outline:0;color:#fff;font-size:15px}
  ::placeholder{color:#ddd;opacity:.7}

  .errors{background:#ff4d6d22;border:1px solid #ff4d6d55;color:#ffdbe3;
    padding:8px 10px;border-radius:10px;font-size:13px;margin-bottom:10px}
  .flash{background:rgba(119,255,168,.16);border:1px solid rgba(119,255,168,.45);color:#c9ffd9;
    padding:10px 12px;border-radius:10px;font-size:13px;margin-bottom:10px;animation:fadeIn .25s ease}
  @keyframes fadeIn{from{opacity:0;transform:translateY(-4px)}to{opacity:1;transform:translateY(0)}}
  .flash.hide{opacity:0;transform:translateY(-4px);transition:opacity .6s ease, transform .6s ease}

  .pwd-hint{margin-top:8px;background:rgba(0,0,0,.18);border:1px solid rgba(255,255,255,.18);border-radius:12px;padding:8px 10px;font-size:12px}
  .rules{display:grid;gap:4px;margin:0}
  .rule{display:flex;align-items:center;gap:8px;opacity:.9}
  .rule .dot{width:7px;height:7px;border-radius:999px;background:var(--bad)}
  .rule.ok .dot{background:var(--ok)} .rule.ok{opacity:1}

  .row{display:flex;justify-content:space-between;align-items:center;gap:8px;margin-top:12px}
  .back a{color:#fff;opacity:.95;text-decoration:none} .back a:hover{color:#ffce9f;text-decoration:underline}
  button{
    border:0;cursor:pointer;padding:12px 16px;border-radius:12px;font-weight:700;letter-spacing:.3px;font-size:15px;color:#fff;
    background:linear-gradient(90deg,#ff512f,#f09819); box-shadow:0 8px 24px rgba(255,81,47,.35);
    transition:transform .06s ease, box-shadow .15s ease;
  }
  button:hover{box-shadow:0 10px 28px rgba(255,81,47,.45)} button:active{transform:translateY(1px)}
  .icon{width:18px;height:18px;opacity:.9}
</style>
</head>
<body>
  <main class="card">
    <div class="avatar" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-4.59 0-8 2.13-8 4.75V21h16v-2.25C20 16.13 16.59 14 12 14Z"/></svg>
    </div>
    <h1>Redefinir senha</h1>
    <p class="sub">Crie uma nova senha para sua conta.</p>

    @if ($errors->any())
      <div class="errors">@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
    @endif

    @if (session('status'))
      <div id="flash" class="flash">{{ session('status') }}</div>
    @endif

    {{-- ✅ Form aponta para password.store (POST /reset-password) --}}
    <form method="POST" action="{{ route('password.store') }}" id="resetForm" novalidate>
      @csrf

      {{-- token e email vindos da URL --}}
      <input type="hidden" name="token" value="{{ request()->route('token') }}">
      <input type="hidden" name="email" value="{{ request()->query('email') }}">

      <label for="password">Nova senha</label>
      <div class="field">
        <svg class="icon" viewBox="0 0 24 24" fill="currentColor"><path d="M17 9h-1V7a4 4 0 0 0-8 0v2H7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2ZM12 16a1.5 1.5 0 1 0-1.5-1.5A1.5 1.5 0 0 0 12 16Z"/></svg>
        <input id="password" name="password" type="password" placeholder="Crie uma senha" required>
      </div>

      <div class="pwd-hint" id="pwdRules">
        <div class="rules">
          <div class="rule" data-rule="len"><span class="dot"></span>8 ou mais caracteres</div>
          <div class="rule" data-rule="upper"><span class="dot"></span>Pelo menos 1 letra maiúscula</div>
          <div class="rule" data-rule="lower"><span class="dot"></span>Pelo menos 1 letra minúscula</div>
          <div class="rule" data-rule="num"><span class="dot"></span>Pelo menos 1 número</div>
          <div class="rule" data-rule="sym"><span class="dot"></span>Pelo menos 1 caractere especial</div>
        </div>
      </div>

      <label for="password_confirmation">Confirmar nova senha</label>
      <div class="field">
        <svg class="icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a5 5 0 0 0-5 5v2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7a5 5 0 0 0-5-5Zm-3 7V7a3 3 0 0 1 6 0v2Zm3 9a1.5 1.5 0 1 1 1.5-1.5A1.5 1.5 0 0 1 12 18Z"/></svg>
        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repita a senha" required>
      </div>

      <div class="row">
        <div class="back"><a href="{{ url('/') }}">Voltar ao login</a></div>
        <button type="submit">SALVAR NOVA SENHA</button>
      </div>
    </form>
  </main>

<script>
(function(){
  const flash = document.getElementById('flash'); if(flash){ setTimeout(()=>flash.classList.add('hide'),3500); setTimeout(()=>flash.remove(),4500); }

  const pwd = document.getElementById('password');
  const confirm = document.getElementById('password_confirmation');
  const hint = document.getElementById('pwdRules');
  const rules = { len:v=>v.length>=8, upper:v=>/[A-Z]/.test(v), lower:v=>/[a-z]/.test(v), num:v=>/\d/.test(v), sym:v=>/[^A-Za-z0-9]/.test(v) };
  const els={}; document.querySelectorAll('.rule').forEach(el=>els[el.dataset.rule]=el);

  function update(){ const v=pwd.value||''; for(const k in rules){ els[k].classList.toggle('ok', rules[k](v)); } }
  pwd.addEventListener('focus',()=>{ hint.style.display='block'; update(); });
  pwd.addEventListener('input',update);
  pwd.addEventListener('blur',()=>{ if(!pwd.value) hint.style.display='none'; });
})();
</script>
</body>
</html>
