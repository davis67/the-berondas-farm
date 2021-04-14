<a {{ $attributes->merge([
        'class' => 'text-cool-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-cool-gray-800 focus:no-underline transition duration-150 ease-in-out' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
    ]) }}>
    {{ $slot }}
</a>
