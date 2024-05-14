<x-app-layout>
    <!-- Definição do cabeçalho da página -->
    <x-slot name="header">
        <!-- Título do cabeçalho -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Principal') }} <!-- Título do cabeçalho traduzido -->
        </h2>
    </x-slot>

    <!-- Conteúdo da página -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Div para controlar o layout -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Conteúdo principal -->
                <div class="p-6 text-gray-900">
                    <!-- Mensagem de boas-vindas -->
                    {{ __("Você está logado!") }} <!-- Mensagem de boas-vindas traduzida -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
