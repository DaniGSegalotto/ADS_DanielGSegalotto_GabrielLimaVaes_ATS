<x-app-layout>
    <!-- 🔹 Cabeçalho -->
    <x-slot name="header">
        <div class="image-container">
            <img src="/img/ATS.png" alt="ats">
        </div>
    </x-slot>

    <!-- 🔹 Estilos -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 24px;
        }

        .image-container img {
            max-width: 500px;
            height: auto;
            display: block;
            margin: auto;
            border-radius: 8px;
            box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .welcome-message {
            text-align: center;
            font-size: 3rem;
            font-family: 'Pacifico', cursive;
            color: red;
            margin: 2rem;
        }

        .intro-container {
            height: auto;
            display: block;
            margin: auto;
            background: linear-gradient(135deg, #f8f9fa 0%, #e2e8f0 100%);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            max-width: 10000px;
            text-align: left;
        }

        .intro-paragraph {
            font-family: 'Open Sans', sans-serif;
            font-size: 15px;
            color: #333;
            line-height: 1.6;
        }

        .alert {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            padding: 12px;
            border-radius: 8px;
            margin: 10px auto;
            max-width: 900px;
            text-align: center;
            font-weight: 500;
        }

        .menu-container {
            text-align: center;
            margin: 2rem 0;
        }

        .menu-container a,
        .menu-container button {
            display: inline-block;
            margin: 6px;
            padding: 10px 18px;
            background: linear-gradient(90deg, #ff512f, #f09819);
            color: white;
            font-weight: 600;
            text-decoration: none;
            border-radius: 10px;
            transition: 0.2s;
            border: none;
            cursor: pointer;
        }

        .menu-container a:hover,
        .menu-container button:hover {
            opacity: 0.85;
            transform: translateY(-1px);
        }

        .logout-button {
            background: #c0392b !important;
        }
    </style>

    <!-- 🔹 Mensagem de boas-vindas -->
    <p class="welcome-message">Seja bem-vindo</p>

    <!-- 🔹 Mensagem de acesso -->
    @if (session('tipo_usuario') === 'cliente')
        <div class="alert">
            Você está logado como <strong>Cliente</strong>. Acesso limitado a veículos e agendamentos.
        </div>
    @else
        <div class="alert" style="background:#d4edda; border-color:#c3e6cb; color:#155724;">
            Logado como <strong>Funcionário</strong>. Acesso completo ao sistema.
        </div>
    @endif

    <!-- 🔹 Menu dinâmico -->
    <div class="menu-container">
        <!-- Itens comuns -->
        <a href="{{ route('veiculos.index') }}">Ver Veículos</a>
        <a href="{{ route('agendamentos.index') }}">Agendamentos</a>

        <!-- Itens de funcionário -->
        @if (session('tipo_usuario') !== 'cliente')
            <a href="{{ route('clientes.index') }}">Clientes</a>
            <a href="{{ route('funcionarios.index') }}">Funcionários</a>
            <a href="{{ route('marcas.index') }}">Marcas</a>
        @endif

        <!-- 🔹 Botão de logout -->
        @if (session('tipo_usuario') === 'cliente')
            <form method="POST" action="{{ route('cliente.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-button">Sair (Cliente)</button>
            </form>
        @else
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-button">Sair (Funcionário)</button>
            </form>
        @endif
    </div>

    <!-- 🔹 Texto descritivo -->
    <div class="intro-container">
        <p class="intro-paragraph">
            Bem-vindo à <strong>Automotive Testing Site</strong>, onde a eficiência encontra a mobilidade.
            Nosso sistema foi desenvolvido para otimizar o processo de aluguel de veículos — do cadastro à entrega —
            garantindo rapidez e precisão em cada etapa.<br><br>

            O sistema oferece funcionalidades como:<br>
            - <strong>Cadastro de Clientes</strong>: Inserção e gestão ágil das informações.<br>
            - <strong>Cadastro de Funcionários</strong>: Controle de acessos conforme função.<br>
            - <strong>Cadastro de Veículos</strong>: Registro completo da frota, histórico e disponibilidade.<br>
            - <strong>Cadastro de Marcas</strong>: Organização das categorias de veículos disponíveis.<br><br>

            Nosso objetivo é tornar o aluguel de veículos mais ágil e confiável. Seja para negócios ou lazer,
            conte conosco para oferecer a melhor experiência de locação e atendimento.
        </p>
    </div>
</x-app-layout>
