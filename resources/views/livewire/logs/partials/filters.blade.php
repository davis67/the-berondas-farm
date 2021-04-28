<div class="w-full flex-1 flex">
    <div class="py-2">
        <x-input.text wire:model.lazy="filters.search"
                      id="search"
                      placeholder="Search here..." />
    </div>
    <div x-data="{ isOpen: false }"
         class="relative flex items-center">
        <x-button.link @click="isOpen = !isOpen"
                       class="  pl-3">
            More Filters
        </x-button.link>
        <div x-cloak
             x-show.transition.origin.top.left="isOpen"
             @click.away="isOpen = false"
             @keydown.escape.window="isOpen = false"
             class="absolute w-104 text-left font-semibold bg-white shadow-card rounded-xl py-3 md:ml-8 top-10 md:top-10 right-0 md:left-0">
            <div class="bg-white p-4 rounded  flex flex-col ">
                <div class="w-full flex flex-col pl-2 space-y-4">
                    <select id="cage_id"
                            wire:model="filters.cage_id"
                            class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="">Select Rabbit by Cage ...</option>
                        @foreach ($cages as $cage)
                            <option value="{{ $cage->id }}">{{ $cage->cage_no }}.</option>
                        @endforeach
                    </select>
                    <select id="gender"
                            wire:model.lazy="filters.gender"
                            class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="">Select the gender...</option>
                        @foreach (App\Models\Rabbit::GENDER as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <select id="status"
                            wire:model.lazy="filters.status"
                            class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="">Select the status...</option>
                        @foreach (App\Models\Rabbit::STATUS as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <x-input.group inline
                                   for="filter-date-min"
                                   label="Minimum Date of Birth">
                        <x-input.date type="date"
                                      wire:model.lazy="filters.date_min"
                                      id="date_min"
                                      placeholder="MM/DD/YYYY" />
                    </x-input.group>
                    <x-input.group inline
                                   for="filter-date-max"
                                   label="Maximum Date of Birth">
                        <x-input.date type="date"
                                      wire:model.lazy="filters.date_max"
                                      id="date_max"
                                      placeholder="MM/DD/YYYY" />
                    </x-input.group>

                </div>
                <x-button.link wire:click="resetFilters"
                               class="p-4">Reset Filters</x-button.link>
            </div>
        </div>
    </div>
</div>
