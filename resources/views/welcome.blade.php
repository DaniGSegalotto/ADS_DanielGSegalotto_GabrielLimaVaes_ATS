<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acesso ao Sistema - ATS</title>

    <style>
        :root {
            --card-bg: rgba(255, 255, 255, 0.15);
            --card-border: rgba(255, 255, 255, 0.22);
            --text-light: rgba(255, 255, 255, 0.90);
            --blur: blur(18px) saturate(150%);
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
            background: #140a0a;
        }

        /* LAYOUT PRINCIPAL */
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
            background: linear-gradient(to right,
                    rgba(0, 0, 0, 0.55),
                    rgba(0, 0, 0, 0.22));
        }

        /* LADO DIREITO PREMIUM */
        .right-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 3vw;

            background:
                radial-gradient(55vmax 55vmax at 25% 28%, #ff512f55 0%, transparent 60%),
                radial-gradient(55vmax 55vmax at 75% 72%, #f0981955 0%, transparent 55%),
                linear-gradient(120deg, #1a0b0b, #2a0f0f);
        }

        /* CARD CENTRAL */
        .card {
            width: 400px;
            padding: 40px 34px;
            border-radius: 22px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: var(--blur);
            text-align: center;
            animation: fadeIn .9s ease;
            box-shadow: 0 18px 45px rgba(0, 0, 0, .45);
        }

        .logo {
            width: 150px;
            height: 150px;
            margin: 0 auto 22px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.12);
            padding: 18px;
            object-fit: contain;
            transition: .25s ease;
        }

        .logo:hover {
            transform: scale(1.06);
        }

        h1 {
            font-size: 22px;
            margin-bottom: 12px;
            letter-spacing: 0.6px;
        }

        p {
            opacity: .85;
            font-size: 14px;
            margin-bottom: 28px;
        }

        /* BOTÕES PREMIUM */
        .btn {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            margin-top: 13px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            transition: .22s ease;
            display: block;
        }

        .btn:hover {
            transform: translateY(-3px);
            filter: brightness(1.15);
        }

        .btn-func {
            background: linear-gradient(90deg, #ff512f, #f09819);
            box-shadow: 0 8px 24px rgba(255, 125, 40, .35);
        }

        .btn-cliente {
            background: linear-gradient(90deg, #00c98a, #198754);
            box-shadow: 0 8px 24px rgba(0, 200, 130, .35);
        }

        .btn-cadastrar {
            background: linear-gradient(90deg, #2196F3, #21CBF3);
            box-shadow: 0 8px 24px rgba(33, 150, 243, .35);
        }

        /* MODAL */
        .hidden {
            display: none;
            pointer-events: none;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0);
            backdrop-filter: blur(0px);
            transition: .3s ease;
            z-index: 98;
        }

        .modal-backdrop.show {
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(6px);
        }

        .modal {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(.85);
            transition: .3s ease;
            z-index: 99;
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
            background: rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(18px) saturate(160%);
            border: 1px solid rgba(255, 255, 255, 0.18);
            text-align: center;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .37);
        }

        .modal-btn {
            margin-top: 22px;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            display: block;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(90deg, #ff7b39, #f09819);
        }

        .modal-close {
            margin-top: 18px;
            background: none;
            border: none;
            color: #fff;
            opacity: .8;
            font-size: 14px;
            cursor: pointer;
        }

        footer {
            position: absolute;
            bottom: 12px;
            right: 0;
            width: 50%;
            text-align: center;
            opacity: .6;
            font-size: 12px;
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
    </style>
</head>

<body>

    <div class="container">

        <div class="left-side"></div>

        <div class="right-side">
            <main class="card">

                <img src="/img/ATS.png" class="logo" alt="Logo ATS">

                <h1>Automotive Testing Site</h1>
                <p>Escolha como deseja acessar o sistema:</p>

                <a onclick="openModal('func')" class="btn btn-func">Entrar como Funcionário</a>
                <a onclick="openModal('cliente')" class="btn btn-cliente">Entrar como Cliente</a>
                <a onclick="openModal('cadastrar')" class="btn btn-cadastrar">Criar Conta de Cliente</a>

            </main>
        </div>

    </div>

    <!-- BACKDROP -->
    <div id="modalBackdrop" class="modal-backdrop hidden"></div>

    <!-- MODAL -->
    <div id="loginModal" class="modal hidden">
        <div class="modal-content">

            <h2 id="modalTitle">Acessar Conta</h2>
            <p id="modalSubtitle">Você será redirecionado.</p>

            <a id="modalButton" href="#" class="modal-btn">Continuar</a>

            <button onclick="closeModal()" class="modal-close">Fechar</button>
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

            if (type === 'cliente') {
                title.textContent = "Entrar como Cliente";
                subtitle.textContent = "Você será redirecionado para o login de cliente.";
                button.href = "{{ route('cliente.login.form') }}";
            }

            if (type === 'cadastrar') {
                title.textContent = "Criar Conta de Cliente";
                subtitle.textContent = "Você será redirecionado para o formulário de cadastro.";
                button.href = "{{ route('cliente.register.form') }}";
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
        © {{ date('Y') }} Automotive Testing Site. Todos os direitos reservados.
    </footer>

</body>

</html>
