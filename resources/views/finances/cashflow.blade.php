<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Fluxo de Caixa') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="rounded-lg py-8 shadow-md">
          <div class="card-body text-gray-800 dark:text-gray-200">

            <x-modal-finances />

            <div class="inline-block w-full overflow-x-auto rounded-lg border shadow-2xl">
              <table class="w-full bg-gray-200 text-center dark:bg-gray-800">
                <thead class="rounded-lg bg-blue-300 dark:bg-blue-800">
                  <tr class="font-semibold">
                    <th class="border-b px-4 py-2">@sortablelink('id', 'Nº do Lançamento')</th>
                    <th class="border-b px-4 py-2">Observações</th>
                    <th class="border-b px-4 py-2">@sortablelink('type', 'Tipo do Lançamento')</th>
                    <th class="border-b px-4 py-2">@sortablelink('entry_value', 'Valor')</th>
                    <th class="border-b px-4 py-2">@sortablelink('created_at', 'Data de Criação')</th>
                    <th class="border-b px-4 py-2">Opções</th>
                  </tr>
                </thead>
                @forelse ($finances as $finance)
                  <tr>
                    <td class="border-b px-4 py-2">#{{ $finance->id }}</td>
                    <td class="border-b px-4 py-2">{{ $finance->info }}</td>
                    <td class="border-b px-4 py-2">{{ $finance->type }}</td>
                    <td
                      class="{{ $finance->type === 'Entrada' ? 'bg-green-400 dark:bg-green-500' : 'bg-red-400 dark:bg-red-500' }} m-4 rounded-md border-b px-4 py-2 text-white">
                      {{ $finance->entry_value }}</td>
                    <td class="border-b px-4 py-2">{{ $finance->created_at }}</td>
                    <td class="flex justify-evenly border-b px-4 py-2">
                      <a href="/finances/edit/{{ $finance->id }}"
                        class="rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700">&#128393;</a>
                      <div x-data="{ deleleModal: false }">
                        <button x-on:click="deleleModal = true"
                          class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">&times;</button>
                        <div x-show="deleleModal" x-on:click.away="deleleModal = false"
                          class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
                          <div class="rounded-lg bg-gray-200 p-8 shadow-lg dark:bg-gray-800">
                            <p class="text-gray-800 dark:text-gray-200">Tem certeza que deseja apagar o registro?</p>
                            <div class="mt-4 flex justify-end">
                              <form action="{{ route('cashflow.delete', ['id' => $finance->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                  class="mr-2 rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">Apagar</button>
                              </form>
                              <button x-on:click="deleleModal = false"
                                class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">Cancelar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="py-2">Não há dados para serem exibidos.</td>
                  </tr>
                @endforelse
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
