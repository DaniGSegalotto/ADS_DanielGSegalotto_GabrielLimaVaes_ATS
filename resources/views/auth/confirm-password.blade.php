<!-- resources/views/auth/confirm-password.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Confirmar senha</title>
<style>
  :root{ --card-bg: rgba(255,255,255,.12); --card-border: rgba(255,255,255,.25); }
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

  .row{display:flex;justify-content:flex-end;margin-top:12px}
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
    <h1>Confirmar senha</h1>
    <p class="sub">Área segura: confirme sua senha para continuar.</p>

    @if ($errors->any())
      <div class="errors">@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}">
      @csrf
      <label for="password">Senha</label>
      <div class="field">
        <svg class="icon" viewBox="0 0 24 24" fill="currentColor"><path d="M17 9h-1V7a4 4 0 0 0-8 0v2H7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2ZM12 16a1.5 1.5 0 1 0-1.5-1.5A1.5 1.5 0 0 0 12 16Z"/></svg>
        <input id="password" name="password" type="password" required placeholder="Sua senha atual">
      </div>

      <div class="row">
        <button type="submit">CONFIRMAR</button>
      </div>
    </form>
  </main>
</body>
</html>
