@props([
'leadingAddOn' => false,
])

<div class="w-full rounded-md shadow-sm">
    @if ($leadingAddOn)
    <span
        class="inline-flex items-center px-3 rounded-l-md border border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
        {{ $leadingAddOn }}
    </span>
    @endif

    <input
        {{ $attributes->merge(['class' => 'flex-1 form-input border py-4 border-cool-gray-300 rounded-none block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5' . ($leadingAddOn ? ' rounded-none rounded-r-md' : '')]) }} />
</div>
