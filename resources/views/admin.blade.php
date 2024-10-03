<x-app-layout>
  <x-slot name="header">
    <h2 class="px-2 text-xl font-semibold italic leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Sistema incompleto') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-gray-200 shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-center text-2xl text-gray-900 dark:text-gray-100">
          {{ __('Esse sistema estava em desenvolvimento.') }}
          <br>
          {{ __('Atualmente se encontra incompleto, pois a negociação sobre ele foi encerrada.') }}
        </div>
        <div class="px-6 py-2 text-xl text-center text-gray-900 dark:text-gray-100">
          {{ __('Um novo projeto será desenvolvido com o intuito de servir como um controle de financas.') }}
          <br>
          {{ __('Quem sabe ele não está disponível quando estiver dando uma olhada por aqui.') }}
          <br>
          {{ __('😁') }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
