<x-guest-layout>
    <!-- Layout para usuários não autenticados -->

    <div class="mb-4 text-sm text-gray-600">
        <!-- Mensagem informando que esta é uma área segura da aplicação -->
        {{ __('Esta é uma área segura da aplicação. Por favor, confirme sua senha antes de continuar.') }}
    </div>

    <!-- Formulário para confirmar a senha -->
    <form method="POST" action="{{ route('password.confirm') }}">
        <!-- Formulário enviando dados via método POST para a rota 'password.confirm' -->

        @csrf
        <!-- Token de verificação CSRF -->

        <!-- Senha -->
        <div>
            <!-- Rótulo para o campo de senha -->
            <x-input-label for="password" :value="__('Senha')" />

            <!-- Campo de entrada de texto para a senha -->
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <!-- Exibição de erros, se houver -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Botão de confirmação -->
        <div class="flex justify-end mt-4">
            <!-- Botão primário para confirmar a senha -->
            <x-primary-button>
                {{ __('Confirmar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
