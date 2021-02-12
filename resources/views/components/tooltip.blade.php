<div class="flex min-h-screen items-center justify-center">
  <div x-data="{ tooltip: false }" class="relative z-30 inline-flex">
    <div x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="rounded-md px-3 py-2 bg-teal-500 text-white cursor-pointer shadow">
      Hover over me
    </div>
    <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
      <div class="absolute top-0 z-10 w-64 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-gray-50 rounded-lg shadow-lg">
        <div class="w-16 text-gray-500">Hi, I am Tooltip</div>
        <div class="w-16 text-gray-500">Hi, I am Tooltip</div>
        <div class="w-16 text-gray-500">Hi, I am Tooltip</div>
        <div class="w-16 text-gray-500">Hi, I am Tooltip</div>
        <div class="w-16 text-gray-500">Hi, I am Tooltip</div>
      </div>
      <svg class="absolute z-10 w-6 h-6 text-gray-50 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
        <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
      </svg>
    </div>
  </div>
</div>
