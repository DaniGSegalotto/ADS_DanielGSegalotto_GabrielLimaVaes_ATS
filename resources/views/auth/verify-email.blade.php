<x-guest-layout>
    <!-- Layout para usuários não autenticados -->

    <div class="mb-4 text-sm text-gray-600">
        <!-- Mensagem de agradecimento por se inscrever -->
        {{ __('Obrigado por se inscrever! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos prazer em enviar outro.') }}
    </div>

    <!-- Verificar se o status é 'verification-link-sent' -->
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            <!-- Mensagem informando que um novo link de verificação foi enviado -->
            {{ __('Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o registro.') }}
        </div>
    @endif

    <!-- Formulário para reenviar o e-mail de verificação -->
    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <!-- Botão para reenviar o e-mail de verificação -->
                <x-primary-button>
                    {{ __('Reenviar E-mail de Verificação') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Formulário para fazer logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <!-- Botão para fazer logout -->
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Sair') }}
            </button>
        </form>
    </div>
</x-guest-layout>
