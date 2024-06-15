<x-app-layout>
    <!-- Definição do cabeçalho da página -->
    <x-slot name="header">
        <!-- Título do cabeçalho -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
        <!-- Seção de imagem -->
            <div class="image-container">
                <img src="/img/ATS.png" alt="ats">
            </div>

        </h2>
    </x-slot>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

    /* Estilo da imagem */
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 24px;
        }

        .image-container img {
            max-width: 500px; /* Ajuste aqui o tamanho máximo da imagem */
            height: auto;
            display: block;
            margin: auto; /* Centraliza a imagem horizontalmente */
            border-radius: 8px;
            box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Estilo do parágrafo de boas-vindas */
        .welcome-message {
            text-align: center;       
            font-size: 3rem;          
            font-family: 'Pacifico', cursive; 
            color: red;           
            margin: 2rem;             
        }

        /* Estilo do parágrafo */
        .intro-paragraph {
            font-family: 'Open Sans', sans-serif; /* Fonte padrão para o parágrafo */
            font-size: 15px; /* Tamanho do texto */
            color: #333; /* Cor do parágrafo */
            line-height: 1.6;
        }

        /* Estilo do contêiner de introdução */
        .intro-container {
            height: auto;
            display: block;
            margin: auto;
            background: linear-gradient(135deg, #f8f9fa 0%, #e2e8f0 100%); /* Fundo com gradiente */
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Sombra para destaque */
            max-width: 10000px;
            text-align: left;
        }
    </style>

    <p class="welcome-message">Seja bem-vindo</p>

    <div class="intro-container">    
    <p class="intro-paragraph">
        Bem-vindo à Automotive Testing Site, onde a eficiência encontra a mobilidade. Estamos empenhados em fornecer uma experiência de aluguel de veículos sem complicações, apoiada por um sistema robusto de gerenciamento de agendamentos. Compreendemos que o tempo é precioso, e é por isso que desenvolvemos um sistema intuitivo para otimizar o processo de aluguel, desde o cadastro até a entrega.<br><br>
        Nosso sistema oferece funcionalidades abrangentes que incluem:<br>
        - <strong>Cadastro de Clientes</strong>: Permite a rápida inserção e gestão das informações dos nossos clientes, facilitando o processo de locação e garantindo um atendimento personalizado e eficiente.<br>
        - <strong>Cadastro de Funcionários</strong>: Gerencia os detalhes de nossa equipe, assegurando que todos os colaboradores estejam devidamente registrados e possam acessar o sistema conforme suas funções, promovendo um ambiente de trabalho organizado e produtivo.<br>
        - <strong>Cadastro de Veículos</strong>: Mantém um registro detalhado de nossa frota de veículos, incluindo especificações técnicas, histórico de manutenção e disponibilidade, garantindo que nossos clientes sempre tenham acesso aos melhores veículos disponíveis.<br>
        - <strong>Cadastro de Marcas</strong>: Administra as marcas dos veículos em nossa frota, permitindo uma categorização clara e facilitando a gestão e a seleção dos veículos para os nossos clientes.<br><br>
        Nosso objetivo é proporcionar a você uma experiência de aluguel de veículos que seja tão suave quanto possível, suportada por um sistema que automatiza tarefas repetitivas, minimiza erros e melhora a satisfação do cliente. Seja para viagens de negócios, lazer ou necessidades especiais, estamos aqui para atendê-lo com uma frota diversificada e um serviço de primeira classe.<br><br>
        Explore nosso sistema e descubra como podemos tornar seu processo de aluguel de veículos mais ágil e eficiente. Estamos ansiosos para servi-lo!        
    </p>
    </div>
 
</x-app-layout> 
