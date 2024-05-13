<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Inclui os scripts CSS e JavaScript compilados -->
    </head>
    <body class="font-sans antialiased"> <!-- Define a fonte padrão e melhora a renderização de texto -->
        <div class="min-h-screen bg-gray-100"> <!-- Define uma altura mínima para a tela e uma cor de fundo cinza -->
            @include('layouts.navigation') <!-- Inclui o arquivo de navegação -->

            <!-- Cabeçalho da Página -->
            @if (isset($header))
                <header class="bg-white shadow"> <!-- Define um cabeçalho branco com sombra -->
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"> <!-- Define largura máxima e espaçamento interno -->
                        {{ $header }} <!-- Exibe o conteúdo do cabeçalho -->
                    </div>
                </header>
            @endif

            <!-- Conteúdo da Página -->
            <main>
                {{ $slot }} <!-- Exibe o conteúdo dinâmico da página -->
            </main>
        </div>
    </body>
</html>
