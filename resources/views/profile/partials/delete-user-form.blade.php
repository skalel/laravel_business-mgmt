<section class="space-y-6">
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      {{ __('Excluir conta') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      {{ __('Caso sua conta seja deletada, todos os recursos e informações serão apagados definitivamente. Antes de exclir sua conta, por favor solicite uma cópia dos seus dados que deseja guardar.') }}
    </p>
  </header>

  <x-danger-button x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Deletar conta') }}</x-danger-button>

  <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
      @csrf
      @method('delete')

      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Tem certeza que deseja deletar sua conta?') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Quando sua conta seja deletada, todos os recursos e informações serão apagados definitivamente. Por favor insira sua senha para confirmar que deseja excluir sua conta.') }}
      </p>

      <div class="mt-6">
        <x-input-label for="password" value="{{ __('Senha') }}" class="sr-only" />

        <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
          placeholder="{{ __('Senha') }}" />

        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
      </div>

      <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
          {{ __('Cancelar') }}
        </x-secondary-button>

        <x-danger-button class="ms-3">
          {{ __('Excluir conta') }}
        </x-danger-button>
      </div>
    </form>
  </x-modal>
</section>
