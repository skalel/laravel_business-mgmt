<x-guest-layout>
  <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('Obrigado por se cadastrar. Antes de acessar, por favor verifique seu email acessando o link que nós acabamos de enviar. Não recebeu o email? Clique na opção abaixo para reenviar.') }}
  </div>

  @if (session('status') == 'verification-link-sent')
    <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
      {{ __('Um novo link de verificação foi enviado para o endereço de email inserido durante o cadastro.') }}
    </div>
  @endif

  <div class="mt-4 flex items-center justify-between">
    <form method="POST" action="{{ route('verification.send') }}">
      @csrf

      <div>
        <x-primary-button>
          {{ __('Reenviar email de verificação') }}
        </x-primary-button>
      </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <button type="submit"
        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800">
        {{ __('Desconectar') }}
      </button>
    </form>
  </div>
</x-guest-layout>
