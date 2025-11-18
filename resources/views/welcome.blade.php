<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Acesso ao Sistema - ATS</title>

  <style>
    :root {
      --card-bg: rgba(255, 255, 255, 0.12);
      --card-border: rgba(255, 255, 255, 0.25);
      --text-light: rgba(255, 255, 255, 0.85);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
      font-family: "Segoe UI", Roboto, Arial, sans-serif;
      color: var(--text-light);
      overflow: hidden;
    }

    .container {
      display: flex;
      height: 100vh;
      width: 100vw;
    }

    .left-side {
      flex: 1;
      background: url('/img/frota.jpg') center/cover no-repeat;
      position: relative;
    }

    .left-side::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(to right, rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.25));
      pointer-events: none;
    }

    .right-side {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 3vw;
      background:
        radial-gradient(60vmax 60vmax at 25% 28%, #ff512f55 0%, transparent 60%),
        radial-gradient(60vmax 60vmax at 75% 72%, #f0981955 0%, transparent 55%),
        linear-gradient(120deg, #1a0b0b, #2a0f0f);
      position: relative;
    }

    .card {
      width: 400px;
      padding: 40px 32px;
      border-radius: 24px;
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      backdrop-filter: blur(16px) saturate(130%);
      text-align: center;
      animation: fadeIn 0.9s ease;
      box-shadow: 0 20px 60px rgba(0, 0, 0, .45);
    }

    .logo {
      width: 150px;
      height: 150px;
      margin: 0 auto 22px;
      border-radius: 22px;
      background: rgba(255, 255, 255, 0.12);
      padding: 16px;
      object-fit: contain;
      transition: 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.06);
    }

    h1 {
      font-size: 22px;
      margin-bottom: 10px;
    }

    p {
      opacity: .85;
      font-size: 14px;
      margin-bottom: 24px;
    }

    .btn {
      width: 100%;
      padding: 12px;
      margin-top: 12px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 15px;
      color: #fff;
      border: none;
      cursor: pointer;
      text-align: center;
      display: block;
      transition: transform .15s ease, box-shadow .25s ease;
    }

    .btn:hover {
      transform: translateY(-2px);
    }

    .btn-func {
      background: linear-gradient(90deg, #ff512f, #f09819);
      box-shadow: 0 8px 24px rgba(255, 100, 50, .35);
    }

    .btn-cliente {
      background: linear-gradient(90deg, #00c98a, #198754);
      box-shadow: 0 8px 24px rgba(30, 200, 140, .35);
    }

    /* ADICIONADO — Botão de cadastro */
    .btn-cadastrar {
      background: linear-gradient(90deg, #2196F3, #21CBF3);
      box-shadow: 0 8px 24px rgba(33, 150, 243, .35);
    }

    footer {
      position: absolute;
      bottom: 12px;
      right: 0;
      width: 50%;
      font-size: 12px;
      opacity: .7;
      text-align: center;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* ==========================================================
       🔥 MODAL + ANIMAÇÕES
    ========================================================== */

    .hidden {
      display: none;
      pointer-events: none;
    }

    .modal-backdrop {
      position: fixed;
      inset: 0;
      backdrop-filter: blur(0px);
      background: rgba(0, 0, 0, 0);
      transition: backdrop-filter .3s ease, background .3s ease;
      z-index: 90;
    }

    .modal-backdrop.show {
      backdrop-filter: blur(6px);
      background: rgba(0, 0, 0, 0.45);
    }

    .modal {
      position: fixed;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transform: scale(.85);
      transition: opacity .25s ease, transform .25s ease;
      z-index: 100;
      pointer-events: none;
    }

    .modal.show {
      opacity: 1;
      transform: scale(1);
      pointer-events: auto;
    }

    .modal-content {
      width: 380px;
      padding: 34px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(18px) saturate(160%);
      border: 1px solid rgba(255, 255, 255, 0.18);
      text-align: center;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
    }

    .modal-btn {
      margin-top: 20px;
      display: block;
      background: linear-gradient(90deg, #ff7b39, #f09819);
      padding: 12px;
      color: #fff;
      font-weight: 600;
      border-radius: 12px;
      text-decoration: none;
    }

    .modal-close {
      margin-top: 18px;
      background: none;
      border: none;
      color: #fff;
      opacity: .8;
      cursor: pointer;
      font-size: 14px;
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

        <a onclick="openModal('func')" class="btn btn-func">Entrar como Funcionário</a>
        <a onclick="openModal('cliente')" class="btn btn-cliente">Entrar como Cliente</a>

        <!-- ADICIONADO — Botão de cadastrar -->
        <a onclick="openModal('cadastrar')" class="btn btn-cadastrar">Criar Conta de Cliente</a>

      </main>
    </div>
  </div>

  <div id="modalBackdrop" class="modal-backdrop hidden"></div>

  <div id="loginModal" class="modal hidden">
    <div class="modal-content">

      <h2 id="modalTitle">Acessar Conta</h2>
      <p id="modalSubtitle">Você será redirecionado.</p>

      <a id="modalButton" href="#" class="modal-btn">Continuar</a>

      <button class="modal-close" onclick="closeModal()">Fechar</button>

    </div>
  </div>

  <script>
    function openModal(type) {
      const modal = document.getElementById('loginModal');
      const backdrop = document.getElementById('modalBackdrop');

      const title = document.getElementById('modalTitle');
      const subtitle = document.getElementById('modalSubtitle');
      const button = document.getElementById('modalButton');

      if (type === 'func') {
        title.textContent = "Entrar como Funcionário";
        subtitle.textContent = "Você será redirecionado para o login de funcionário.";
        button.href = "{{ route('login') }}";
      }

      else if (type === 'cliente') {
        title.textContent = "Entrar como Cliente";
        subtitle.textContent = "Você será redirecionado para o login de cliente.";
        button.href = "{{ route('cliente.login.form') }}";
      }

      else if (type === 'cadastrar') {
        title.textContent = "Criar Conta de Cliente";
        subtitle.textContent = "Você será redirecionado para o formulário de cadastro.";
        button.href = "{{ route('cliente.register.form') }}";  // ✔ rota correta
      }

      modal.classList.remove('hidden');
      backdrop.classList.remove('hidden');

      setTimeout(() => {
        modal.classList.add('show');
        backdrop.classList.add('show');
      }, 10);
    }

    function closeModal() {
      const modal = document.getElementById('loginModal');
      const backdrop = document.getElementById('modalBackdrop');

      modal.classList.remove('show');
      backdrop.classList.remove('show');

      setTimeout(() => {
        modal.classList.add('hidden');
        backdrop.classList.add('hidden');
      }, 250);
    }
  </script>

  <footer>
    &copy; {{ date('Y') }} Automotive Testing Site. Todos os direitos reservados.
  </footer>

</body>

</html>
