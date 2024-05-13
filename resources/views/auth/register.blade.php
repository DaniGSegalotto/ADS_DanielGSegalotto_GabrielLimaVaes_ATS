<x-guest-layout>
    <!-- Formulário de Registro -->
    <form method="POST" action="{{ route('register') }}">
        @csrf <!-- Cross-Site Request Forgery (CSRF) token -->

        <!-- Nome -->
        <div>
            <x-input-label for="name" :value="__('Nome')" /> <!-- Rótulo para o campo de nome -->
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" /> <!-- Campo de entrada para o nome do usuário -->
            <x-input-error :messages="$errors->get('name')" class="mt-2" /> <!-- Exibição de erros relacionados ao campo de nome -->
        </div>

        <!-- Endereço de Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" /> <!-- Rótulo para o campo de email -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" /> <!-- Campo de entrada para o endereço de email do usuário -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" /> <!-- Exibição de erros relacionados ao campo de email -->
        </div>

        <!-- Senha -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" /> <!-- Rótulo para o campo de senha -->
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" /> <!-- Campo de entrada para a senha do usuário -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" /> <!-- Exibição de erros relacionados ao campo de senha -->
        </div>

        <!-- Confirmar Senha -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirme a Senha')" /> <!-- Rótulo para o campo de confirmação de senha -->
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" /> <!-- Campo de entrada para a confirmação de senha -->
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> <!-- Exibição de erros relacionados ao campo de confirmação de senha -->
        </div>

        <!-- Link para a página de login -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Já Registrado?') }} <!-- Link para a página de login -->
            </a>

            <!-- Botão de Registro -->
            <x-primary-button class="ms-4">
                {{ __('Registrar') }} <!-- Botão para registrar -->
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
