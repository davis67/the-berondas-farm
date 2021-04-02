@section('title', 'View Rabbits')
@section('header', 'View Rabbits')
<div class="mt-2">
    <!-- Add Batch Form -->
    <div class="block">
        <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
            <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full  shadow overflow-hidden sm:rounded-lg">
                    <div class="bg-white border border-cool-gray-200  sm:px-6 lg:px-8">
                        <div class="w-full">
                            <div class="my-4">
                                @if (session()->has('success'))
                                <div class="font-medium text-green-700">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                            <div class="w-full flex">
                                <div class="py-2 w-3/4">
                                    <x-input.text id="search" wire:model.lazy="search"  id="search" placeholder="Indentification no eg RBT-001" />
                                </div>
                                <x-button.link wire:click="$toggle('showFilters')" class="pl-3">@if($showFilters) Hide @endif More Filters</x-button.link>
                            </div>
                            <div>
                                @if($showFilters)
                                <div class="bg-white p-4 rounded shadow flex relative">
                                    <div class="w-1/2 pl-2 space-y-4">
                                        <select id="cage_id" wire:model="cage_id" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <option value="" >Select Rabbit by Cage ...</option>
                                            @foreach($cages as $cage)
                                            <option value="{{ $cage->id }}" >{{ $cage->cage_no }}.</option>
                                            @endforeach
                                        </select>
                                        <select id="gender" wire:model.lazy="gender" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <option value="" >Select the gender...</option>
                                            <option value="buck" >Buck</option>
                                            <option value="doe">Doe</option>
                                            <option value="unknown">Unknown</option>
                                        </select>
                                        <select id="status" wire:model.lazy="status" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <option value="" >Select the status...</option>
                                            <option value="active" >alive</option>
                                            <option value="dead">dead</option>
                                            <option value="sold">sold</option>
                                        </select>
                                        <x-input.group inline for="filter-date-min" label="Minimum Date of Birth">
                                        <x-input.date type="date" wire:model.lazy="date_min" id="date_min" placeholder="MM/DD/YYYY" />
                                        </x-input.group>
                                        <x-input.group inline for="filter-date-max" label="Maximum Date of Birth">
                                        <x-input.date type="date" wire:model.lazy="date_max" id="date_max" placeholder="MM/DD/YYYY" />
                                        </x-input.group>
                                        <x-button.link wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</x-button.link>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="bg-white flex flex-col mt-2">
                            <x-table>
                            <x-slot name="head">
                            <x-table.header sortable wire:click="sortBy('rabbit_type_id')"
                            :direction="$sortField === 'rabbit_no' ? $sortDirection : null">indentification no </x-table.header>
                            <x-table.header sortable wire:click="sortBy('gender')"
                            :direction="$sortField === 'gender' ? $sortDirection : null">Gender</x-table.header>
                            <x-table.header sortable wire:click="sortBy('cage')"
                            :direction="$sortField === 'cage' ? $sortDirection : null">Cage</x-table.header>
                            <x-table.header sortable>Breed</x-table.header>
                            <x-table.header sortable>status</x-table.header>
                            </x-slot>
                            <x-slot name="body">
                            @forelse($rabbits as $rabbit)
                            <x-table.row wire:loading.class="opacity-50">
                                <x-table.cell>
                                    {{ $rabbit->rabbit_no }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $rabbit->gender }}
                                </x-table.cell>
                                <x-table.cell>
                                    @if($rabbit->current_cage)
                                    {{ $rabbit->current_cage->cage_no }}
                                    @else
                                    None
                                    @endif
                                </x-table.cell>
                                <x-table.cell>
                                    Not Specified
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $rabbit->status }}
                                </x-table.cell>
                                <x-table.cell>
                                    <a href="{{ route('rabbits.edit', $rabbit->id) }}" class="underline font-bold leading-6 text-md uppercase">Edit rabbit</a>
                                    <a    wire:click="validateDeletion({{$rabbit->id}})" wire:loading.attr="disabled" class="underline font-bold leading-6 text-md uppercase cursor-pointer">Delete rabbit</a>
                                </x-table.cell>
                                </x-table.row>
                                @empty
                                <x-table.row>
                                    <x-table.cell colspan="6">
                                        <div class="flex justify-center items-center space-x-2">
                                            <x-icon.inbox class="h-8 w-8 text-gray-400" />
                                            <span class="font-medium py-8 text-gray-400 text-xl">No rabbits found...</span>
                                        </div>
                                    </x-table.cell>
                                </x-table.row>
                            @endforelse
                            </x-slot>
                            </x-table>
                            <div class="bg-white px-4 py-3 border-t border-cool-gray-200 sm:px-6">
                                {{$rabbits->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Rabbit Confirmation Modal -->
    @if($confirmingRabbitDeletion === true)
    <x-confirmation-modal>
        <x-slot name="title">
            Confirm Deletion of the rabbit
        </x-slot>

        <x-slot name="content">
            Are you sure you want to completely delete this rabbit? Once a rabbit is deleted, all of its resources and data will be not be recovered.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingRabbitDeletion')" wire:loading.attr="disabled">
                Close
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="handleDeletion" wire:loading.attr="disabled">
                Delete
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
    @endif
</div>
