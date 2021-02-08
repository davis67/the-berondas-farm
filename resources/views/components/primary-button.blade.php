<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-teal-600 border border-transparent rounded-none font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-500 focus:outline-none focus:border-teal-700 focus:shadow-outline-teal active:bg-teal-600 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
