<div class="mt-1 relative rounded-md shadow-sm">
    <div class="absolute inset-y-0 left-0 pl-1 flex items-center pointer-events-none">
        <span class="text-gray-500 sm:text-sm sm:leading-5">
            shs
        </span>
    </div>

    <input {{ $attributes }} class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5" placeholder="0.00"
        aria-describedby="price-currency">

    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
            shs
        </span>
    </div>
</div>
