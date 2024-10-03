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
            <div x-data="{ selectedOption: '{{ $partner->selectedOption }}' }" class="inline-block w-full overflow-x-auto rounded-lg p-4 shadow-2xl">
              <h2 class="mb-4 text-2xl font-bold">Visualizando Parceiro #{{ $partner->id }}</h2>
              <form method="GET" action="{{ route('partner.edit', ['id' => $partner->id]) }}" class="text-gray-900 dark:text-gray-200">
                <div class="flex flex-wrap">
                  <div class="flex-grow flex-col pr-2">
                    <label for="name" class="block w-full">Nome:</label>
                    <input type="text" id="name" name="name"
                      class="mb-4 w-full rounded-md border p-2 text-gray-900 cursor-not-allowed" value="{{ $partner->name }}" disabled>
                  </div>

                  <div class="flex-grow flex-col pr-2">
                    <label for="email" class="block w-full">E-mail:</label>
                    <input type="email" id="email" name="email"
                      class="mb-4 w-full rounded-md border p-2 text-gray-900 cursor-not-allowed" value="{{ $partner->email }}" disabled>
                  </div>

                  <div class="flex-grow flex-col pr-2">
                    <label for="telephone" class="block w-full">Telefone:</label>
                    <input type="text" id="telephone" name="telephone"
                      x-mask:dynamic="$input.length < 11 ? '(99) 9999-9999' : '(99) 99999-9999'"
                      placeholder="(99) 9 9999-9999" class="mb-4 w-full rounded-md border p-2 text-gray-900 cursor-not-allowed" value="{{ $partner->telephone }}" disabled>
                  </div>

                  <div class="flex-grow flex-col pr-2">
                    <label for="client_supplier" class="block w-full">Cliente ou Fornecedor:</label>

                    <div class="mb-4 flex items-center justify-center rounded p-2 cursor-not-allowed">
                      <input type="radio" id="client" name="client_supplier" value="client"
                        x-model="selectedOption" class="hidden" disabled>
                      <label for="client" class="mr-2 cursor-not-allowed">Cliente</label>
                      <div class="relative h-6 w-12 rounded-full border border-gray-300 bg-blue-500 cursor-not-allowed">
                        <div
                          :class="{ 'transform translate-x-0': selectedOption === 'client', 'transform translate-x-full': selectedOption === 'supplier', 'absolute inset-y-0 left-0 w-6 h-6 rounded-full bg-white shadow-md': true }"
                          class="transition-transform duration-300 cursor-not-allowed">
                        </div>
                      </div>

                      <label for="supplier" class="ml-2 cursor-not-allowed">Fornecedor</label>
                      <input type="radio" id="supplier" name="client_supplier" value="supplier"
                        x-model="selectedOption" class="hidden" disabled>
                    </div>
                  </div>

                  <div class="flex-grow flex-col pr-2" x-show="selectedOption === 'client'">
                    <label for="cgccpf" class="block w-full">CPF:</label>
                    <input type="text" id="cgccpf" name="cgccpf" x-mask="999.999.999-99"
                      class="mb-4 w-full rounded-md border p-2 text-gray-900 cursor-not-allowed" value="{{ $partner->cgccpf }}" disabled>
                  </div>

                  <div class="flex-grow flex-col" x-show="selectedOption === 'client'">
                    <label for="birthdate" class="block w-full">Data de Nascimento:</label>
                    <input type="date" id="birthdate" name="birthdate"
                      class="mb-4 w-full rounded-md border p-2 text-gray-900 cursor-not-allowed" value="{{ $partner->birthdate }}" disabled>
                  </div>

                  <div class="flex-grow flex-col pr-2" x-show="selectedOption === 'supplier'">
                    <label for="cnpj" class="block w-full">CNPJ:</label>
                    <input type="text" id="cnpj" name="cnpj" x-mask="99.999.999/9999-99"
                      class="mb-4 w-full rounded-md border p-2 text-gray-900 cursor-not-allowed" value="{{ $partner->cgccpf }}" disabled>
                  </div>

                  <div class="flex-grow flex-col" x-show="selectedOption === 'supplier'">
                    <label for="opening_date" class="block w-full">Data de abertura:</label>
                    <input type="date" id="opening_date" name="opening_date"
                      class="mb-4 w-full rounded-md border p-2 text-gray-900 cursor-not-allowed" value="{{ $partner->opening_date }}" disabled>
                  </div>

                  <label for="address" class="block w-full">Endereço:</label>
                  <input type="text" id="address" name="address"
                    class="mb-4 w-full rounded-md border p-2 text-gray-900 cursor-not-allowed" value="{{ $partner->address }}" disabled>
                </div>
                <div class="flex justify-end gap-2">
                  <button type="submit"
                    class="rounded-md bg-green-500 p-2 text-white hover:bg-green-700">Editar</button>
                  <a href="{{ route('partner.index') }}"
                    class="cursor-pointer rounded-md bg-red-500 p-2 text-white hover:bg-red-700">Voltar</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
