<x-guest-layout>
  <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('Obrigado por se cadastrar. Os administradores foram notificados da sua inscrição. Caso seu usuário seja aprovado, você receberá um e-mail notificando.') }}
  </div>

  <div class="mt-4 flex items-center justify-between">

    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <button type="submit"
        class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 active:bg-red-700 dark:focus:ring-offset-gray-800">
        {{ __('Desconectar') }}
      </button>
    </form>
  </div>
</x-guest-layout>
