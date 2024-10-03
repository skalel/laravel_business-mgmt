<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Gestão de Estoque') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="rounded-lg py-8 shadow-md">
          <div class="text-gray-800 dark:text-gray-200">
            <div x-data="{ openModal: false }">
              <div class="py-4">
                <div x-data="{
                    open: false,
                    toggle() {
                        if (this.open) {
                            return this.close()
                        }

                        this.$refs.button.focus()

                        this.open = true
                    },
                    close(focusAfter) {
                        if (!this.open) return

                        this.open = false

                        focusAfter && focusAfter.focus()
                    }
                }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                  x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
                  class="relative">
                  <!-- Button -->
                  <button @click="openModal = true" x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                    :aria-controls="$id('dropdown-button')" type="button"
                    class="flex items-center gap-2 rounded-md bg-blue-400 px-5 py-2.5 text-white shadow transition-colors duration-300 hover:bg-blue-600 dark:bg-blue-500 dark:hover:bg-blue-800">
                    <svg class="h-5 w-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                    </svg>
                    Cadastrar produto
                  </button>
                </div>
              </div>
              <div class="inline-block w-full overflow-x-auto rounded-lg border shadow-2xl">
                <table class="w-full bg-gray-200 text-center dark:bg-gray-800">
                  <thead class="rounded-lg bg-blue-300 dark:bg-blue-800">
                    <tr class="font-semibold">
                      <th class="border-b px-4 py-2">@sortablelink('id', '#')</th>
                      <th class="border-b px-4 py-2">@sortablelink('prod_name', 'Nome do Produto')</th>
                      <th class="border-b px-4 py-2">Referência do Produto</th>
                      <th class="border-b px-4 py-2">@sortablelink('prod_quantity', 'Quantidade')</th>
                      <th class="border-b px-4 py-2">Valor do produto</th>
                      <th class="border-b px-4 py-2">Data de Cadastro</th>
                      <th class="border-b px-4 py-2">Opções</th>
                    </tr>
                  </thead>
                  @forelse ($stocks as $stock)
                    <tr>
                      <td class="border-b px-4 py-2">#{{ $stock->id }}</td>
                      <td class="border-b px-4 py-2 underline transition-colors duration-300 ease-in-out hover:text-gray-400"><a
                          href="{{ route('stock.show', ['id' => $stock->id]) }}">{{ $stock->prod_name }}</a></td>
                      <td class="border-b px-4 py-2">{{ $stock->prod_reference }}</td>
                      <td class="border-b px-4 py-2">{{ $stock->prod_quantity }}</td>
                      <td class="border-b px-4 py-2">{{ $stock->prod_selling_value }}</td>
                      <td class="border-b px-4 py-2">{{ $stock->created_at }}</td>
                      <td class="flex justify-evenly border-b px-4 py-2">
                        <a href="{{ route('stock.edit', ['id' => $stock->id]) }}"
                          class="rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700">&#128393;</a>
                        <div x-data="{ deleleModal: false }">
                          <button x-on:click="deleleModal = true"
                            class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">&times;</button>
                          <div x-show="deleleModal" x-on:click.away="deleleModal = false"
                            class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
                            <div class="rounded-lg bg-gray-200 p-8 shadow-lg dark:bg-gray-800">
                              <p class="text-gray-800 dark:text-gray-200">Tem certeza que deseja apagar o registro?</p>
                              <div class="mt-4 flex justify-end">
                                <form action="{{ route('stock.delete', ['id' => $stock->id]) }}" method="post">
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
                      <td colspan="7" class="py-2">Não há dados para serem exibidos.</td>
                    </tr>
                  @endforelse
                </table>
              </div>
              <div x-show="openModal" x-cloak>
                <div class="fixed inset-0 bg-black opacity-50" @click="openModal = false"></div>
                <div class="fixed inset-0 flex items-center justify-center">
                  <div class="mx-auto w-1/2 rounded-lg bg-gray-200 p-8 dark:bg-gray-700">
                    <h2 class="mb-4 text-2xl font-bold">Cadastrar Produto</h2>

                    <form method="POST" action="{{ route('stock.add') }}" class="text-gray-900 dark:text-gray-200">
                      @csrf
                      <div class="flex flex-wrap">
                        <div class="flex-grow flex-col pr-2">
                          <label for="id_finances" class="block w-full">Código Produto:</label>
                          <input type="text" name="id_finances" id="id_finances"
                            class="mb-4 w-full cursor-not-allowed rounded-md border p-2 text-gray-900 disabled:border-gray-100 disabled:bg-gray-100 disabled:text-gray-300"
                            disabled>
                        </div>

                        <div class="flex-grow flex-col pr-2">
                          <label for="prod_name" class="block w-full">Nome do Produto:</label>
                          <input type="text" id="prod_name" name="prod_name"
                            class="mb-4 w-full rounded-md border p-2 text-gray-900">
                        </div>

                        <div class="flex-grow flex-col pr-2">
                          <label for="prod_reference" class="block w-full">Referência do Fornecedor:</label>
                          <input type="text" id="prod_reference" name="prod_reference"
                            class="mb-4 w-full rounded-md border p-2 text-gray-900">
                        </div>

                        <div class="flex-grow flex-col pr-2">
                          <label for="prod_description" class="block w-full">Descrição do Produto:</label>
                          <input type="text" id="prod_description" name="prod_description"
                            class="mb-4 w-full rounded-md border p-2 text-gray-900">
                        </div>

                        <div class="flex-grow flex-col pr-2">
                          <label for="prod_batch" class="block w-full">Lote do Produto:</label>
                          <input type="text" id="prod_batch" name="prod_batch"
                            class="mb-4 w-full rounded-md border p-2 text-gray-900">
                        </div>

                        <div class="flex-grow flex-col">
                          <label for="prod_quantity" class="block w-full">Quantidade do Produto:</label>
                          <input type="text" id="prod_quantity" name="prod_quantity"
                            class="mb-4 w-full rounded-md border p-2 text-gray-900">
                        </div>
                      </div>

                      <div class="flex flex-wrap">
                        <label for="prod_purchase_value" class="block w-full">Custo do Produto (R$):</label>
                        <input type="text" id="prod_purchase_value" x-mask:dynamic="$money($input, ',')"
                          name="prod_purchase_value" class="mb-4 w-full rounded-md border p-2 text-gray-900">

                        <label for="prod_selling_value" class="block w-full">Valor do Produto (Venda):</label>
                        <input type="text" id="prod_selling_value" x-mask:dynamic="$money($input, ',')"
                          name="prod_selling_value" class="mb-4 w-full rounded-md border p-2 text-gray-900">
                      </div>

                      <hr class="w-full border-blue-600 opacity-50">

                      <h3 class="py-4">Medições do produto</h3>

                      <div class="flex flex-wrap">
                        <div class="flex-grow flex-col pr-2">
                          <label for="prod_width" class="block w-full">Largura do Produto (cm):</label>
                          <input type="number" id="prod_width" name="prod_width"
                            class="no-spinner mb-4 w-full rounded-md border p-2 text-gray-900">
                        </div>

                        <div class="flex-grow flex-col pr-2">
                          <label for="prod_length" class="block w-full">Comprimento do Produto (cm):</label>
                          <input type="number" id="prod_length" name="prod_length"
                            class="no-spinner mb-4 w-full rounded-md border p-2 text-gray-900">
                        </div>

                        <div class="flex-grow flex-col">
                          <label for="prod_height" class="block w-full">Altura do Produto (cm):</label>
                          <input type="number" id="prod_height" name="prod_height"
                            class="no-spinner mb-4 w-full rounded-md border p-2 text-gray-900">
                        </div>
                      </div>

                      <div class="flex justify-end gap-2">
                        <button type="submit"
                          class="rounded-md bg-green-500 p-2 text-white hover:bg-green-700">Salvar</button>
                        <a @click="openModal = false"
                          class="cursor-pointer rounded-md bg-red-500 p-2 text-white hover:bg-red-700">Fechar</a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
