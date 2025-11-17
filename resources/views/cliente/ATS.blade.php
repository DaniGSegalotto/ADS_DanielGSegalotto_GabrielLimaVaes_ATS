@extends('layouts.app_cliente')

@section('content')

    <!-- Cabeçalho da página -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 24px;
        }

        .image-container img {
            max-width: 320px;
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
    </style>

    <div class="image-container">
        <img src="/img/ATS.png" alt="ATS">
    </div>

    <!-- Boas-vindas -->
    <p class="welcome-message">Seja bem-vindo</p>

    <!-- Mensagem específica para cliente -->
    <div class="alert">
        Você está logado como <strong>Cliente</strong>. Acesso exclusivo a veículos, agendamentos e perfil.
    </div>

    <!-- Menu do cliente (somente cliente) -->
    <div class="menu-container">
        <a href="{{ route('cliente.veiculos') }}">Ver Veículos</a>
        <a href="{{ route('cliente.agendamento') }}">Agendar</a>
        <a href="{{ route('cliente.perfil') }}">Perfil</a>

        <form method="POST" action="{{ route('cliente.logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-button">Sair</button>
        </form>
    </div>

    <!-- Texto institucional exclusivo para clientes -->
    <div class="intro-container">
        <p class="intro-paragraph">
            Bem-vindo à <strong>Automotive Testing Site</strong>!  
            Aqui você pode acessar nossa frota de veículos, realizar novos agendamentos, 
            consultar seu histórico e manter seus dados atualizados.
            <br><br>
            Nosso compromisso é te oferecer a melhor experiência possível.
        </p>
    </div>

@endsection
