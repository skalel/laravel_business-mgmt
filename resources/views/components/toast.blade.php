<div x-data="{ show: true }" x-init="timer = setTimeout(() => show = false, 5000)" x-show="show"
  x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-300"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @mouseover="clearTimeout(timer)"
  @mouseout="timer = setTimeout(() => show = false, 5000)"
  :class="{
      'bg-green-500': '{{ $type }}'
      === 'success',
      'bg-yellow-500': '{{ $type }}'
      === 'attention',
      'bg-red-500': '{{ $type }}'
      === 'error',
  }"
  class="fixed bottom-4 right-4 z-50 w-full max-w-sm rounded-md p-4 text-white shadow-md">
  <div class="flex items-center justify-between">
    <div>
      {{ $message }}
      @if ($valerrors)
        @foreach ($valerrors as $valerror)
          <p class="text-sm">{{ $valerror }}</p>
        @endforeach
      @endif
    </div>
    <button @click="show = false"
      class="rounded-md p-2 text-white transition-all duration-300 ease-in-out focus:outline-none"
      :class="{
          'hover:bg-green-700': '{{ $type }}'
          === 'success',
          'hover:bg-yellow-700': '{{ $type }}'
          === 'attention',
          'hover:bg-red-700': '{{ $type }}'
          === 'error',
      }">&times;</button>
  </div>
</div>
