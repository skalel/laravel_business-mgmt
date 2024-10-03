<div x-data="{ openModal: false, type: '' }">
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
      x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']" class="relative">
      <!-- Button -->
      <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
        type="button"
        class="flex items-center gap-2 rounded-md bg-blue-400 px-5 py-2.5 text-gray-200 shadow dark:bg-blue-500">
        Adicione um Lançamento
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd" />
        </svg>
      </button>

      <!-- Panel -->
      <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
        style="display: none;" class="absolute left-0 mt-2 w-40 flex-1 rounded-md bg-white shadow-md">

        <button @click="openModal = true; type = 'in'; open = false"
          class="flex w-full items-center gap-2 bg-green-500 px-4 py-2.5 text-left text-sm font-semibold text-gray-200 first-of-type:rounded-t-md last-of-type:rounded-b-md hover:bg-green-700 disabled:text-red-900">
          Adicionar Entrada
        </button>

        <button @click="openModal = true; type = 'out'; open = false"
          class="flex w-full items-center gap-2 bg-red-500 px-4 py-2.5 text-left text-sm font-semibold first-of-type:rounded-t-md last-of-type:rounded-b-md hover:bg-red-700 disabled:text-red-900">
          <span class="text-gray-300">Adicionar Saída</span>
        </button>
      </div>
    </div>
  </div>
  <div x-show="openModal" x-cloak>
    <div class="fixed inset-0 bg-black opacity-50" @click="openModal = false"></div>
    <div class="fixed inset-0 flex items-center justify-center">
      <div class="mx-auto max-w-md rounded-lg bg-gray-200 p-8 dark:bg-gray-700">
        <h2 class="mb-4 text-2xl font-bold">Cadastrar Lançamento</h2>

        <form method="POST" action="{{ route('cashflow.add') }}" class="text-gray-900 dark:text-gray-200">
          @csrf
          <label for="id_finances" class="block w-full">Nrº Lançamento:</label>
          <input type="text" name="id_finances" id="id_finances"
            class="mb-4 w-full cursor-not-allowed rounded-md border p-2 text-gray-900 disabled:border-gray-100 disabled:bg-gray-100 disabled:text-gray-300"
            disabled>

          <label for="entry_value" class="block w-full">Valor:</label>
          <input type="text" x-mask:dynamic="$money($input, ',')" id="entry_value" name="entry_value"
            class="mb-4 w-full rounded-md border p-2 text-gray-900">

          <label for="type" class="block w-full">Tipo</label>
          <select id="type" name="type" x-model="type" class="mb-4 w-full rounded-md border p-2 text-gray-900">
            <option value="in">Entrada</option>
            <option value="out">Saída</option>
          </select>

          <label for="info" class="block w-full">Observações:</label>
          <textarea id="info" name="info" placeholder="Adicione detalhes sobre o lançamento..."
            class="mb-4 w-full rounded-md border p-2 text-gray-900 placeholder:text-gray-100"></textarea>

          <button type="submit" class="rounded-md bg-green-500 p-2 text-white hover:bg-green-700">Salvar</button>
          <a @click="openModal = false"
            class="cursor-pointer rounded-md bg-red-500 p-2 text-white hover:bg-red-700">Fechar</a>
        </form>
      </div>
    </div>
  </div>
</div>
