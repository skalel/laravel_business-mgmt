<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Gestão de Estoque') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-gray-200 shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="rounded-lg py-8 shadow-md">
          <div class="card-body p-4 text-gray-800 dark:text-gray-200">
            <h2 class="mb-4 text-2xl font-bold">Editando o produto #{{ $stock->id }} - {{ $stock->prod_name }}</h2>
            <form method="POST" action="{{ route('stock.edit', ['id' => $stock->id]) }}"
              class="text-gray-900 dark:text-gray-200">
              @csrf
              @method('PUT')
              <div class="flex flex-wrap">
                <div class="flex-grow flex-col pr-2">
                  <label for="id_finances" class="block w-full">Código Produto:</label>
                  <input type="text" name="id_finances" id="id_finances" value="{{ $stock->id }}"
                    class="mb-4 w-full cursor-not-allowed rounded-md border p-2 text-gray-900 disabled:border-gray-100 disabled:bg-gray-100 disabled:text-gray-300"
                    disabled>
                </div>

                <div class="flex-grow flex-col pr-2">
                  <label for="prod_name" class="block w-full">Nome do Produto:</label>
                  <input type="text" id="prod_name" name="prod_name" value="{{ $stock->prod_name }}"
                    class="mb-4 w-full rounded-md border p-2 text-gray-900">
                </div>

                <div class="flex-grow flex-col pr-2">
                  <label for="prod_reference" class="block w-full">Referência do Fornecedor:</label>
                  <input type="text" id="prod_reference" name="prod_reference" value="{{ $stock->prod_reference }}"
                    class="mb-4 w-full rounded-md border p-2 text-gray-900">
                </div>

                <div class="flex-grow flex-col pr-2">
                  <label for="prod_description" class="block w-full">Descrição do Produto:</label>
                  <input type="text" id="prod_description" name="prod_description"
                    value="{{ $stock->prod_description }}" class="mb-4 w-full rounded-md border p-2 text-gray-900">
                </div>

                <div class="flex-grow flex-col pr-2">
                  <label for="prod_batch" class="block w-full">Lote do Produto:</label>
                  <input type="text" id="prod_batch" name="prod_batch" value="{{ $stock->prod_batch }}"
                    class="mb-4 w-full rounded-md border p-2 text-gray-900">
                </div>

                <div class="flex-grow flex-col">
                  <label for="prod_quantity" class="block w-full">Quantidade do Produto:</label>
                  <input type="text" id="prod_quantity" name="prod_quantity" value="{{ $stock->prod_quantity }}"
                    class="mb-4 w-full rounded-md border p-2 text-gray-900">
                </div>
              </div>

              <div class="flex flex-wrap">
                <label for="prod_purchase_value" class="block w-full">Custo do Produto:</label>
                <input type="text" id="prod_purchase_value" x-mask:dynamic="$money($input, ',')"
                  value="{{ $stock->prod_purchase_value }}" name="prod_purchase_value"
                  class="mb-4 w-full rounded-md border p-2 text-gray-900">

                <label for="prod_selling_value" class="block w-full">Valor do Produto:</label>
                <input type="text" id="prod_selling_value" x-mask:dynamic="$money($input, ',')"
                  value="{{ $stock->prod_selling_value }}" name="prod_selling_value"
                  class="mb-4 w-full rounded-md border p-2 text-gray-900">
              </div>

              <hr class="w-full border-blue-600 opacity-50">

              <h3 class="py-4">Medições do produto</h3>

              <div class="flex flex-wrap">
                <div class="flex-grow flex-col pr-2">
                  <label for="prod_width" class="block w-full">Largura do Produto (cm):</label>
                  <input type="number" id="prod_width" name="prod_width" value="{{ $stock->prod_width }}"
                    class="no-spinner mb-4 w-full rounded-md border p-2 text-gray-900">
                </div>

                <div class="flex-grow flex-col pr-2">
                  <label for="prod_length" class="block w-full">Comprimento do Produto (cm):</label>
                  <input type="number" id="prod_length" name="prod_length" value="{{ $stock->prod_length }}"
                    class="no-spinner mb-4 w-full rounded-md border p-2 text-gray-900">
                </div>

                <div class="flex-grow flex-col">
                  <label for="prod_height" class="block w-full">Altura do Produto (cm):</label>
                  <input type="number" id="prod_height" name="prod_height" value="{{ $stock->prod_height }}"
                    class="no-spinner mb-4 w-full rounded-md border p-2 text-gray-900">
                </div>
              </div>

              <div class="flex justify-end gap-2">
                <button type="submit" class="rounded-md bg-blue-500 p-2 text-white hover:bg-blue-700">Salvar</button>
                <a href="{{ route('stock.show', ['id' => $stock->id]) }}"
                  class="cursor-pointer rounded-md bg-red-500 p-2 text-white hover:bg-red-700">Cancelar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
