<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/6a684229a3.js" crossorigin="anonymous"></script>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-300 dark:bg-gray-800 md:pl-64">
    <header class="flex h-20 items-center md:h-auto" x-data="{ open: false }">
      <nav class="relative flex w-full items-center px-4">
        <!-- Mobile Header -->
        <div class="inline-flex w-full items-center justify-center md:hidden">
          <a href="#" @click="open = true" @click.away="open = false" class="absolute left-0 pl-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 stroke-blue-600" fill="currentColor"
              viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
            </svg>
          </a>
          <a href="#">
            <h2 class="text-2xl font-extrabold text-gray-800 dark:text-gray-200">{{ config('app.name', 'Laravel') }}
            </h2>
          </a>
        </div>

        @include('layouts.sidebar')

      </nav>
    </header>

    <!-- Page Heading -->
    @if (isset($header))
      <div class="h-auto bg-blue-300 py-3.5 dark:bg-blue-800">
        <div class="mx-auto w-full px-3.5">
          <div class="-mx-3.5 flex flex-wrap items-center">
            <div class="relative w-full max-w-full flex-[0_0_100%] px-3.5">
              <!-- Title -->
              {{ $header }}
            </div>
          </div>
        </div>
      </div>
    @endif

    <!-- Page Content -->
    <main class="container mx-auto min-h-[200px] w-full px-4 pt-8">
      @if (session()->has('message'))
        <x-toast :valerrors="session('valerrors')" :message="session('message')" :type="session('type')" />
      @endif
      {{ $slot }}
    </main>

  </div>
</body>

</html>
