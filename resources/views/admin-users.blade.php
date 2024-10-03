<x-app-layout>
  <x-slot name="header">
    <h2 class="px-2 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Gerenciamento de Usuários') }}
    </h2>
  </x-slot>
  <div class="container mx-auto">
    <div class="flex justify-center">
      <div class="w-full">
        <h2 class="px-2 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Aprovação de Usuários</h2>
        <div class="rounded-lg py-8 shadow-md">
          <div class="card-body text-gray-800 dark:text-gray-200">
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
                    class="flex items-center gap-2 rounded-md bg-green-400 px-5 py-2.5 text-white shadow transition-colors duration-300 hover:bg-green-600 dark:bg-green-500 dark:hover:bg-green-800">
                    <svg class="h-5 w-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                    </svg>
                    Cadastrar usuário
                  </button>
                </div>
              </div>
              <div class="inline-block w-full overflow-x-auto rounded-lg border shadow-2xl">
                <table class="w-full text-center">
                  <thead class="rounded-lg bg-blue-300 dark:bg-blue-800">
                    <tr class="font-semibold">
                      <th class="border-b px-4 py-2">Nome</th>
                      <th class="border-b px-4 py-2">Email</th>
                      <th class="border-b px-4 py-2">Data de Registro</th>
                      <th class="border-b px-4 py-2">Opções</th>
                    </tr>
                  </thead>
                  @forelse ($users as $user)
                    <tr>
                      <td class="border-b px-4 py-2">{{ $user->name }}</td>
                      <td class="border-b px-4 py-2">{{ $user->email }}</td>
                      <td class="border-b px-4 py-2">
                        @if ($user->created_at)
                          {{ $user->created_at }}
                        @else
                          Não possui
                        @endif
                      </td>
                      <td class="border-b px-4 py-2">
                        @if ($user->approved_at)
                          <a href="#"
                            class="cursor-not-allowed rounded bg-green-500 px-4 py-2 font-bold text-white opacity-50">Aprovado</a>
                        @else
                          <a href="{{ route('admin.users.approve', $user->id) }}"
                            class="rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700">Aprovar</a>
                          <a href="#"
                            class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700">Reprovar</a>
                        @endif
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4">Não existem usuários.</td>
                    </tr>
                  @endforelse
                </table>
              </div>
              <div x-show="openModal" x-cloak>
                <div class="fixed inset-0 bg-black opacity-50" @click="openModal = false"></div>
                <div class="fixed inset-0 flex items-center justify-center">
                  <div class="mx-auto w-1/4 rounded-lg bg-gray-200 p-8 dark:bg-gray-700">
                    <h2 class="mb-4 text-2xl font-bold">Cadastrar novo usuário</h2>

                    <form method="POST" action="{{ route('admin.users.add') }}"
                      class="text-gray-900 dark:text-gray-200">
                      @csrf
                      <div>
                        <label for="name" class="block w-full">Nome do usuário:</label>
                        <input type="text" id="name" name="name"
                          class="mb-4 w-full rounded-md border p-2 text-gray-900">
                      </div>

                      <div>
                        <label for="email" class="block w-full">Email:</label>
                        <input type="email" id="email" name="email"
                          class="mb-4 w-full rounded-md border p-2 text-gray-900">
                      </div>

                      <div>
                        <label for="role" class="block w-full">Tipo</label>
                        <select id="role" name="role" class="mb-4 w-full rounded-md border p-2 text-gray-900">
                          <option value="USER" selected>Usuário</option>
                          <option value="ADMIN">Administrador</option>
                          <option value="GUEST">Convidado</option>
                        </select>
                      </div>

                      <div>
                        <label for="password" class="block w-full">Senha:</label>
                        <input type="password" id="password" name="password"
                          class="mb-4 w-full rounded-md border p-2 text-gray-900">
                      </div>

                      <div class="flex justify-end gap-2">
                        <button type="submit"
                          class="rounded-md bg-green-500 p-2 text-white hover:bg-green-700">Criar</button>
                        <a @click="openModal = false"
                          class="cursor-pointer rounded-md bg-red-500 p-2 text-white hover:bg-red-700">Cancelar</a>
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
  </div>
</x-app-layout>
