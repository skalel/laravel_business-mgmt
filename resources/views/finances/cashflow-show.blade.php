<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Fluxo de Caixa') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-gray-200 shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="rounded-lg py-8 shadow-md">
          <div class="card-body p-4 text-gray-800 dark:text-gray-200">

            <h2 class="mb-4 text-2xl font-bold">Editar Lançamento</h2>

            <form method="POST" action="{{ route('cashflow.edit', ['id' => $entry->id]) }}"
              class="text-gray-900 dark:text-gray-200">
              @csrf
              @method('PUT')

              <div class="flex flex-wrap">
                <div class="flex-grow flex-col pr-2">
                  <label for="id_finances">Nrº Lançamento:</label>
                  <input type="text" name="id_finances" id="id_finances"
                    class="mb-4 w-full cursor-not-allowed rounded-md border p-2 text-gray-900 disabled:border-gray-100 disabled:bg-gray-100 disabled:text-gray-300"
                    value="{{ $entry->id }}" disabled>
                </div>

                <div class="flex-grow flex-col pl-2">
                  <label for="type">Tipo:</label>
                  <select id="type" name="type" x-model="type"
                    class="mb-4 w-full rounded-md border p-2 text-gray-900">
                    @if ($entry->type === 'IN')
                      {
                      <option value="in" selected>Entrada</option>
                      <option value="out">Saída</option>
                      }
                    @else
                      {
                      <option value="in">Entrada</option>
                      <option value="out" selected>Saída</option>
                      }
                    @endif
                  </select>
                </div>
              </div>

              <label for="entry_value" class="block w-full">Valor:</label>
              <input type="text" x-mask:dynamic="$money($input, ',')" id="entry_value" name="entry_value"
                value="{{ $entry->entry_value }}" class="mb-4 w-full rounded-md border p-2 text-gray-900">

              <label for="info" class="block w-full">Observações:</label>
              <textarea id="info" name="info" placeholder="Adicione detalhes sobre o lançamento..."
                class="mb-4 w-full rounded-md border p-2 text-gray-900 placeholder:text-gray-100">{{ $entry->info }}</textarea>

              <button type="submit" class="rounded-md bg-green-500 p-2 text-white hover:bg-green-700">Editar</button>
              <a href={{ route('cashflow.index') }}
                class="cursor-pointer rounded-md bg-red-500 p-2 text-white hover:bg-red-700">Voltar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
