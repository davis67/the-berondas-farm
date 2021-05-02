@section('title', 'View Rabbits')
    <div class="">

        @include('livewire.rabbit.partials.summary')
        <div class="block">
            <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full  shadow overflow-hidden sm:rounded-lg">
                        <div class="bg-white border border-cool-gray-200  sm:px-6 lg:px-8">
                            <div class="w-full">
                                <div class="w-full flex">
                                    @include('livewire.rabbit.partials.filters')
                                    <div class="px-12 space-x-2 items-center flex">
                                        <x-input.group borderless
                                                       paddingless
                                                       for="perPage"
                                                       label="Per Page">
                                            <x-input.select wire:model="perPage"
                                                            id="perPage">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="{{ $all_rabbits_count }}">All</option>
                                            </x-input.select>
                                        </x-input.group>
                                        <x-dropdown label="Bulk Action">
                                            <x-dropdown.item type="button"
                                                             wire:click="exportSelected"
                                                             class="flex items-center space-x-2">
                                                <x-icon.download class="text-cool-gray-400" />
                                                <span>Export</span>
                                        </x-dropdown>
                                        <x-dropdown.item type="button"
                                                         wire:click="$toggle('showDeleteModal')"
                                                         class="flex items-center space-x-2">
                                            <x-icon.trash class="text-cool-gray-400" />
                                            <span>Delete</span>
                                            </x-dropdown>
                                            </x-dropdown>
                                            <x-button.primary wire:click="create">New</x-button.primary>
                                            <x-button.href class="border border-teal-600 px-2 py-2 rounded-md"
                                                           href="{{ route('breed-types.index') }}">Breeds</x-button.primary>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white flex flex-col mt-2">
                                @include('livewire.rabbit.partials.table', ['rabbits' => $rabbits])
                                <div class="bg-white px-4 py-3 border-t border-cool-gray-200 sm:px-6">
                                    {{ $rabbits->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($showDetailsScreen)
                @include('livewire.rabbit.partials.details-slideover')
            @endif

            <form wire:submit.prevent="save">
                @include('livewire.rabbit.partials.add-rabbit-modal')
            </form>

            <!-- Add Rabbit Confirmation Modal -->
            @if ($confirmingRabbitDeletion === true)
                <x-confirmation-modal>
                    <x-slot name="title">
                        Confirm Deletion of the rabbit
                    </x-slot>
                    <x-slot name="content">
                        Are you sure you want to completely delete this rabbit? Once a rabbit is deleted, all of its resources and data will be not be recovered.
                    </x-slot>
                    <x-slot name="footer">
                        <x-secondary-button wire:click="$toggle('confirmingRabbitDeletion')"
                                            wire:loading.attr="disabled">
                            Close
                        </x-secondary-button>
                        <x-danger-button class="ml-2"
                                         wire:click="handleDeletion"
                                         wire:loading.attr="disabled">
                            Delete
                        </x-danger-button>
                    </x-slot>
                </x-confirmation-modal>
            @endif
        </div>

        <form wire:submit.prevent="deleteSelected">
            @include('livewire.rabbit.partials.delete-rabbit-modal')
        </form>

    </div>
