<x-app-layout>
  <x-slot name="header">
    <h2 class="px-2 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Histórico de Vendas') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-gray-200 shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-9xl text-gray-900 dark:text-gray-100">
          {{ __('Esse sistema está em desenvolvimento! Portanto a interface poderá passar por mudanças.') }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
