<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Parceiros') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="rounded-lg py-8 shadow-md">
          <div class="text-gray-800 dark:text-gray-200">
            <div class="py-4">
              <div class="relative">
                <a href="{{ route('partner.add') }}"
                  class="inline-block gap-2 rounded-md bg-blue-400 px-5 py-2.5 text-white shadow transition-colors duration-300 hover:bg-blue-600 dark:bg-blue-500 dark:hover:bg-blue-800">
                  <svg class="inline h-5 w-5 align-middle text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 12h14m-7 7V5" />
                  </svg>
                  Cadastrar parceiro
                </a>
              </div>
            </div>
            <div class="inline-block w-full overflow-x-auto rounded-lg border shadow-2xl">
              <table class="w-full bg-gray-200 text-center dark:bg-gray-800">
                <thead class="rounded-lg bg-blue-300 dark:bg-blue-800">
                  <tr class="font-semibold">
                    <th class="border-b px-4 py-2">@sortablelink('id', '#')</th>
                    <th class="border-b px-4 py-2">@sortablelink('name', 'Nome')</th>
                    <th class="border-b px-4 py-2">@sortablelink('email', 'E-mail')</th>
                    <th class="border-b px-4 py-2">@sortablelink('client_supplier', 'Tipo')</th>
                    <th class="border-b px-4 py-2">@sortablelink('created_at', 'Data de Criação')</th>
                    <th class="border-b px-4 py-2">Opções</th>
                  </tr>
                </thead>
                @forelse ($partners as $partner)
                  <tr>
                    <td class="border-b px-4 py-2">#{{ $partner->id }}</td>
                    <td
                      class="border-b px-4 py-2 underline hover:text-gray-400 transition-colors duration-300 ease-in-out">
                      <a href="{{ route('partner.show', ['id' => $partner->id]) }}">{{ $partner->name }}</a></td>
                    <td class="border-b px-4 py-2">{{ $partner->email }}</td>
                    <td class="border-b px-4 py-2">{{ $partner->client_supplier }}</td>
                    <td class="border-b px-4 py-2">{{ $partner->created_at }}</td>
                    <td class="flex justify-evenly border-b px-4 py-2">
                      <a href="{{ route('partner.edit', ['id' => $partner->id]) }}"
                        class="rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700">&#128393;</a>
                      <div x-data="{ deleleModal: false }">
                        <button x-on:click="deleleModal = true"
                          class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">&times;</button>
                        <div x-show="deleleModal" x-on:click.away="deleleModal = false"
                          class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
                          <div class="rounded-lg bg-gray-200 p-8 shadow-lg dark:bg-gray-800">
                            <p class="text-gray-800 dark:text-gray-200">Tem certeza que
                              deseja apagar o registro?</p>
                            <div class="mt-4 flex justify-end">
                              <form action="{{ route('partner.delete', ['id' => $partner->id]) }}" method="post">
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
