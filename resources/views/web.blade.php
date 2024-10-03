<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-200">
  <!-- Navbar -->
  <nav class="fixed top-0 z-20 w-full bg-gray-200 bg-opacity-75 p-4 text-black transition-all duration-300 ease-in-out"
    id="navbar">
    <div class="container m-auto flex items-center justify-between">
      <!-- Logo -->
      <a class="logo" href="/">
        @if (file_exists(public_path('assets/logo.png')))
          <img src="assets/logo.png" alt="Logo {{ config('app.name', 'Laravel') }}" class="h-auto max-w-[120px]" />
        @else
          {{ config('app.name', 'Laravel') }}
        @endif
      </a>

      <!-- Navbar links -->
      <div class="hidden items-center space-x-4 transition-colors duration-300 ease-in-out lg:flex">
        <a href="/" class="hover:text-gray-600">INÍCIO</a>
        <a href="#about-us" class="hover:text-gray-600">QUEM SOMOS</a>
        <a href="#services" class="hover:text-gray-600">SERVIÇOS</a>
        <a href="#contact" class="hover:text-gray-600">CONTATO</a>
        @if (!auth()->user())
          <a href="/login" class="hover:text-gray-600">LOGIN</a>
        @else
          <a href="/admin" class="hover:text-gray-600">PAINEL ADMINISTRATIVO</a>
        @endif
      </div>
    </div>
  </nav>

  <!-- Banner -->
  <section class="relative flex h-screen items-center justify-center bg-gray-700 bg-cover bg-center"
    style="background-image: url('assets/banner.jpg');">
    <div class="bg-opacity-45 flex h-screen w-full flex-col justify-center bg-black text-center text-white">
      <h1 class="mb-4 text-4xl font-bold">A conclusão dos seus sonhos começam aqui.</h1>
      <div class="flex items-center justify-center space-x-4">
        <a href="https://wa.me/5574999482591"
          class="rounded-full bg-green-500 px-4 py-2 text-white transition duration-300 ease-in-out hover:bg-green-700">Fale
          conosco pelo WhatsApp</a>
        <a href="https://www.instagram.com/bahia_marmore_vidracaria"
          class="rounded-full bg-blue-500 px-4 py-2 text-white transition duration-300 ease-in-out hover:bg-blue-700">Conheça
          nossos serviços.</a>
      </div>
    </div>
  </section>

  <!-- Sobre Nós -->
  <section class="mx-auto flex w-full items-center" id="about-us">
    <div class="ml-4 w-1/2 bg-white">
      <div class="h-full rounded border border-gray-300 p-8 shadow-md">
        <h2
          class="relative mb-4 text-3xl font-bold before:absolute before:bottom-[1px] before:h-[2px] before:w-20 before:bg-black before:content-['']"
          id="sobre-nos">Sobre Nós</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda nam dolor, non recusandae voluptates illum
          minima reiciendis tempora, quod, explicabo alias necessitatibus esse! Libero illum, eaque aliquid dolore quasi
          maiores?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda nam dolor, non recusandae voluptates illum
          minima reiciendis tempora, quod, explicabo alias necessitatibus esse! Libero illum, eaque aliquid dolore quasi
          maiores?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda nam dolor, non recusandae voluptates illum
          minima reiciendis tempora, quod, explicabo alias necessitatibus esse! Libero illum, eaque aliquid dolore quasi
          maiores?</p>
      </div>
    </div>
    <div class="m-8 w-1/2">
      <img src="assets/about-us.jpg" alt="Sobre Nós" class="rounded-lg shadow-lg">
    </div>
  </section>

  {{-- <!-- Container de Serviços -->
<section class="mx-auto my-8" id="services">
    <h2 class="text-3xl font-bold mb-4">Serviços</h2>
    <!-- Carrosséis de Serviços (Adapte conforme necessário) -->
</section>

<!-- Container com Links para Redes Sociais -->
<div class="mx-auto flex my-8" id="contact">
    <div class="w-1/4">
        <!-- Links para redes sociais -->
    </div>
    <div class="w-3/4">
        <img src="path/to/static-image.jpg" alt="Imagem Estática" class="rounded-lg shadow-lg">
    </div>
</div> --}}

  <!-- Rodapé -->
  <footer class="flex h-[200px] flex-col items-center justify-center bg-blue-900 py-4 text-center text-gray-200">
    <div class="font-bold">{{ config('app.name', 'Laravel') }}</div>
    <div class="text-sm">CNPJ: xx.xxx.xxx/xxxx-xx</div>
  </footer>
</body>

</html>
