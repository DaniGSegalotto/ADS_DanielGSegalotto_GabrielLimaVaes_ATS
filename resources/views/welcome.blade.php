<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Acesso ao Sistema - ATS</title>
  <style>
    :root {
      --card-bg: rgba(255, 255, 255, .12);
      --card-border: rgba(255, 255, 255, .25);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      height: 100%;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
      color: #fff;
      overflow: hidden;
    }

    /* 🔹 Container principal */
    .container {
      display: flex;
      height: 100vh;
      width: 100vw;
    }

    /* 🔹 Lado esquerdo (imagem) */
    .left-side {
      flex: 1;
      position: relative;
      background: url('/img/frota.jpg') center center / cover no-repeat;
    }

    .left-side::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(to right, rgba(0,0,0,0.6), rgba(0,0,0,0.2));
      z-index: 0;
    }

    /* 🔹 Lado direito (login) */
    .right-side {
      flex: 1;
      display: flex;
      align-items: center;      /* Centraliza verticalmente */
      justify-content: center;  /* Centraliza horizontalmente */
      background:
        radial-gradient(60vmax 60vmax at 20% 30%, #ff512f66 0%, transparent 60%),
        radial-gradient(60vmax 60vmax at 80% 70%, #f0981966 0%, transparent 55%),
        linear-gradient(120deg, #1a0b0b 0%, #2a0f0f 100%);
      position: relative;
      padding: 0 3vw;
    }

    .card {
      width: 400px;
      padding: 40px 32px;
      border-radius: 24px;
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      backdrop-filter: blur(16px) saturate(120%);
      -webkit-backdrop-filter: blur(16px) saturate(120%);
      box-shadow: 0 20px 60px rgba(0, 0, 0, .45);
      text-align: center;
      animation: fadeIn 1s ease;
    }

    /* 🔹 Logo com destaque elegante */
    .logo {
      width: 160px;
      height: 160px;
      object-fit: contain;
      margin: 0 auto 22px;
      border-radius: 22px;
      background: rgba(255, 255, 255, 0.12);
      padding: 15px;
      box-shadow:
        0 4px 20px rgba(255, 130, 50, 0.3),
        0 0 25px rgba(255, 255, 255, 0.12) inset;
      transition: transform .4s ease, box-shadow .3s ease;
    }

    .logo:hover {
      transform: scale(1.08);
      box-shadow:
        0 6px 28px rgba(255, 150, 50, 0.45),
        0 0 32px rgba(255, 255, 255, 0.18) inset;
    }

    h1 {
      margin: 0 0 10px;
      font-size: 22px;
      font-weight: 600;
      letter-spacing: .2px;
    }

    p {
      font-size: 14px;
      opacity: .85;
      margin-bottom: 22px;
    }

    .btn {
      display: block;
      width: 100%;
      padding: 12px 16px;
      margin-top: 12px;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      font-size: 15px;
      color: #fff;
      cursor: pointer;
      text-decoration: none;
      transition: transform .1s ease, box-shadow .2s ease;
    }

    .btn-func {
      background: linear-gradient(90deg, #ff512f, #f09819);
      box-shadow: 0 8px 24px rgba(255, 81, 47, .35);
    }

    .btn-cliente {
      background: linear-gradient(90deg, #20c997, #198754);
      box-shadow: 0 8px 24px rgba(32, 201, 151, .35);
    }

    .btn:hover { transform: translateY(-1px); }

    footer {
      position: absolute;
      bottom: 12px;
      right: 0;
      width: 50%;
      text-align: center;
      font-size: 12px;
      opacity: 0.7;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 900px) {
      .container { flex-direction: column; }
      .left-side { height: 40vh; }
      .right-side {
        height: 60vh;
        justify-content: center;
        padding: 0;
      }
      .card { width: 90%; }
      footer {
        width: 100%;
        position: relative;
        margin-top: 20px;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="left-side"></div>

    <div class="right-side">
      <main class="card">
        <img src="/img/ATS.png" alt="Logo ATS" class="logo">

        <h1>Automotive Testing Site</h1>
        <p>Escolha como deseja acessar o sistema:</p>

        <a href="{{ route('login') }}" class="btn btn-func">Entrar como Funcionário</a>
        <a href="{{ route('cliente.login.form') }}" class="btn btn-cliente">Entrar como Cliente</a>
      </main>
    </div>
  </div>

  <footer>
    &copy; {{ date('Y') }} Automotive Testing Site. Todos os direitos reservados.
  </footer>
</body>
</html>
