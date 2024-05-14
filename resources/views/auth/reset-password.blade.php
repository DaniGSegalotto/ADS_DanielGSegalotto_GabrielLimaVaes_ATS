<x-guest-layout>
    <!-- Layout para visitantes -->

    <form method="POST" action="{{ route('password.store') }}">
        <!-- Formulário para enviar os dados -->

        @csrf
        <!-- Token de verificação de segurança CSRF -->

        <!-- Token de Redefinição de Senha -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Endereço de E-mail -->
        <div>
            <!-- Campo para inserir o e-mail -->
            <x-input-label for="email" :value="__('Email')" />
            <!-- Componente de entrada de texto para o e-mail -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <!-- Mensagem de erro, se houver -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Senha -->
        <div class="mt-4">
            <!-- Campo para inserir a senha -->
            <x-input-label for="password" :value="__('Password')" />
            <!-- Componente de entrada de texto para a senha -->
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <!-- Mensagem de erro, se houver -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Senha -->
        <div class="mt-4">
            <!-- Campo para confirmar a senha -->
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <!-- Componente de entrada de texto para confirmar a senha -->
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <!-- Mensagem de erro, se houver -->
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botão de envio -->
        <div class="flex items-center justify-end mt-4">
            <!-- Botão primário -->
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
