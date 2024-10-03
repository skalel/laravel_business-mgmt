<!-- Sidebar Menu -->
<div :class="{ '!translate-x-0': open }"
  class="fixed left-0 top-0 z-20 h-screen w-9/12 -translate-x-full transform overflow-y-auto bg-gray-100 shadow-2xl transition duration-300 ease-in-out dark:bg-gray-800 sm:w-64 md:translate-x-0">
  <!-- Sidebar Header -->
  <div class="flex h-20 items-center md:block">
    <div class="inline-flex w-full items-center justify-center md:justify-center">
      <!-- Hamburger -->
      <a href="#" @click="open = !open"
        class="absolute right-0 top-0 mr-1.5 mt-1.5 inline-flex items-center justify-center rounded-md bg-gray-800 p-1 hover:bg-blue-100 dark:bg-gray-200 md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-blue-600" fill="none" viewBox="0 0 24 24"
          stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </a>
      <!-- Logo -->
      <a href="#">
        <h2 class="p-2 text-center text-xl font-extrabold text-gray-800 dark:text-gray-200">
          {{ config('app.name', 'Laravel') }}</h2>
      </a>
    </div>
  </div>
  <!-- Profile Section -->
  <div class="divide-y divide-solid divide-gray-200">
    <div class="p-5 text-center">
      <!-- Profile Picture -->
      <a href="/admin" class="mb-4 inline-block w-auto rounded-full bg-blue-400 p-2">
        <img src="https://eu.ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="Imagem do Usuário"
          class="h-32 w-32 rounded-full object-cover object-top align-top">
      </a>
      <!-- Profile Info -->
      <div>
        <h3
          class="mb-2 overflow-hidden overflow-ellipsis whitespace-nowrap text-2xl font-bold text-gray-800 dark:text-gray-200">
          {{ auth()->user()->name }}</h3>
      </div>
    </div>
  </div>
  <!-- Navigation Links -->
  <div class="mb-0 ml-0 flex flex-col">
    <x-sidebar-nav-link :href="route('admin')" :active="request()->routeIs('admin')" class="z-[2] text-gray-800 dark:text-gray-200">
      <x-slot name="icon">
        <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10 6a7.5 7.5 0 1 0 8 8h-8V6Z" />
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13.5 3H13v8h8v-.5A7.5 7.5 0 0 0 13.5 3Z" />
        </svg>
      </x-slot>
      {{ __('Início') }}
    </x-sidebar-nav-link>

    <x-sidebar-nav-link href="/finances/cashflow" class="text-gray-800 dark:text-gray-200">
      <x-slot name="icon">
        <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5.5 21h13M12 21V7m0 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm2-1.8c3 .7 2.5 2.8 5 2.8M5 8c3.4 0 2.2-2.1 5-2.8M7 9.6V7.8m0 1.8-2 4.3a.8.8 0 0 0 .4 1l.4.1h2.4a.8.8 0 0 0 .8-.7V14L7 9.6Zm10 0V7.3m0 2.3-2 4.3a.8.8 0 0 0 .4 1l.4.1h2.4a.8.8 0 0 0 .8-.7V14l-2-4.3Z" />
        </svg>
      </x-slot>
      {{ __('Fluxo de Caixa') }}
    </x-sidebar-nav-link>

    <div x-data="{ finOpen: false }">
      <button @click="finOpen = !finOpen"
        class="hover:transparent focus:transparent flex w-full items-center text-lg text-white transition duration-300 ease-in-out hover:bg-blue-300 focus:outline-none dark:hover:bg-blue-600 md:text-sm">
        <x-sidebar-nav-link href="#" class="text-gray-800 dark:text-gray-200">
          <x-slot name="icon">
            <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 20V7m0 13-4-4m4 4 4-4m4-12v13m0-13 4 4m-4-4-4 4" />
            </svg>
          </x-slot>
          {{ __('Negociações') }}
        </x-sidebar-nav-link>
        <div class="me-1 text-gray-800 dark:text-gray-200">
          <svg class="mr-4 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none"
            stroke="currentColor" stroke-width="1">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
          </svg>
        </div>
      </button>

      <div x-show="finOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" class="px-2">
        <x-sidebar-nav-link href="#" class="text-gray-800 dark:text-gray-200 cursor-not-allowed">
          <x-slot name="icon">
            <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 12c.3 0 .5 0 .8-.2.2 0 .4-.3.6-.5l.4-.7.2-.9c0 .6.2 1.2.6 1.6.4.4.9.7 1.4.7.5 0 1-.3 1.4-.7.4-.4.6-1 .6-1.6 0 .6.2 1.2.6 1.6.4.4.9.7 1.4.7.5 0 1-.3 1.4-.7.4-.4.6-1 .6-1.6a2.5 2.5 0 0 0 .6 1.6l.6.5a1.8 1.8 0 0 0 1.6 0l.6-.5.4-.7.2-.9c0-1-1.1-3.8-1.6-5a1 1 0 0 0-1-.7h-11a1 1 0 0 0-.9.6A29 29 0 0 0 4 9.7c0 .6.2 1.2.6 1.6.4.4.9.7 1.4.7Zm0 0c.3 0 .7 0 1-.3l.7-.7h.6c.2.3.5.6.8.7a1.8 1.8 0 0 0 1.8 0c.3-.1.6-.4.8-.7h.6c.2.3.5.6.8.7a1.8 1.8 0 0 0 1.8 0c.3-.1.6-.4.8-.7h.6c.2.3.5.6.8.7.2.2.6.3.9.3.4 0 .7-.1 1-.4M6 12a2 2 0 0 1-1.2-.5m.2.5v7c0 .6.4 1 1 1h2v-5h3v5h7c.6 0 1-.4 1-1v-7m-5 3v2h2v-2h-2Z" />
            </svg>
          </x-slot>
          {{ __('Vendas') }}
        </x-sidebar-nav-link>
        <x-sidebar-nav-link href="#" class="text-gray-800 dark:text-gray-200 cursor-not-allowed">
          <x-slot name="icon">
            <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.3L19 7H7.3" />
            </svg>
          </x-slot>
          {{ __('Orçamentos') }}
        </x-sidebar-nav-link>
      </div>
    </div>

    <div x-data="{ stockOpen: false }">
      <button @click="stockOpen = !stockOpen"
        class="hover:transparent focus:transparent flex w-full items-center text-lg text-white transition duration-300 ease-in-out hover:bg-blue-300 focus:outline-none dark:hover:bg-blue-600 md:text-sm">
        <x-sidebar-nav-link href="#" class="text-gray-800 dark:text-gray-200">
          <x-slot name="icon">
            <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
            </svg>
          </x-slot>
          {{ __('Gestão') }}
        </x-sidebar-nav-link>
        <div class="me-1 text-gray-800 dark:text-gray-200">
          <svg class="mr-4 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none"
            stroke="currentColor" stroke-width="1">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
          </svg>
        </div>
      </button>

      <div x-show="stockOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" class="px-2">
        <x-sidebar-nav-link href="#" class="text-gray-800 dark:text-gray-200 cursor-not-allowed">
          <x-slot name="icon">
            <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
            </svg>
          </x-slot>
          {{ __('Compras') }}
        </x-sidebar-nav-link>
        <x-sidebar-nav-link href="/stocks" class="text-gray-800 dark:text-gray-200">
          <x-slot name="icon">
            <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m4 12 8-8 8 8M6 10.5V19c0 .6.4 1 1 1h3v-3c0-.6.4-1 1-1h2c.6 0 1 .4 1 1v3h3c.6 0 1-.4 1-1v-8.5" />
            </svg>
          </x-slot>
          {{ __('Estoque') }}
        </x-sidebar-nav-link>
      </div>
    </div>

    <x-sidebar-nav-link href="/partners" class="text-gray-800 dark:text-gray-200">
      <x-slot name="icon">
        <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-width="2"
            d="M7 17v1c0 .6.4 1 1 1h8c.6 0 1-.4 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
      </x-slot>
      {{ __('Parceiros') }}
    </x-sidebar-nav-link>

    <x-sidebar-nav-link href="/profile" class="text-gray-800 dark:text-gray-200">
      <x-slot name="icon">
        <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 9h3m-3 3h3m-3 3h3m-6 1c-.3-.6-1-1-1.6-1H7.6c-.7 0-1.3.4-1.6 1M4 5h16c.6 0 1 .4 1 1v12c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1V6c0-.6.4-1 1-1Zm7 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
        </svg>
      </x-slot>
      {{ __('Perfil') }}
    </x-sidebar-nav-link>

    @if (auth()->user()->role === 'ADMIN')
      <x-sidebar-nav-link href="/users" class="text-gray-800 dark:text-gray-200">
        <x-slot name="icon">
          <svg class="mr-4 h-4 w-4 text-gray-800 dark:text-white" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H7a1 1 0 0 1-1-1v-7c0-.6.4-1 1-1Z" />
          </svg>
        </x-slot>
        {{ __('Gerenciar Usuários') }}
      </x-sidebar-nav-link>
    @endif

    <form method="POST" action="{{ route('logout') }}" class="cursor-pointer">
      @csrf
      <x-sidebar-nav-link onclick="event.preventDefault();this.closest('form').submit();"
        class="text-gray-800 dark:text-gray-200">
        <x-slot name="icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-4 w-4" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
        </x-slot>
        {{ __('Desconectar') }}
      </x-sidebar-nav-link>
    </form>
  </div>
</div>
<div :class="{ '!inline': open }"
  class="fixed left-0 top-0 z-10 hidden h-screen w-screen bg-gray-900 bg-opacity-30 transition duration-300 ease-in-out md:!hidden">
</div>
