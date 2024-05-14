<x-app-layout>
    <!-- Definição do cabeçalho da página -->
    <x-slot name="header">
        <!-- Título do cabeçalho -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }} <!-- Título do cabeçalho traduzido -->
        </h2>
    </x-slot>

    <!-- Conteúdo da página -->
    <div class="py-12">
        <!-- Container para alinhar o conteúdo -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Primeiro bloco: formulário de atualização de informações do perfil -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Inclui o formulário de atualização de informações do perfil -->
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Segundo bloco: formulário de alteração de senha -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Inclui o formulário de alteração de senha -->
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Terceiro bloco: formulário de exclusão de usuário -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- Inclui o formulário de exclusão de usuário -->
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
