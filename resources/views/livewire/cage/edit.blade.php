@section('title', 'Edit Cage')
@section('header', 'Edit Cage')
    <div class="mt-2">
        <!-- Edit Cage Form -->
        <div class="block">
            <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full  shadow overflow-hidden sm:rounded-lg">

                        <form class="bg-white py-3 px-6"
                              wire:submit.prevent="updateCage">
                            <div>
                                <div class="mt-3 pt-2">
                                    <div>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Edit Cage Type Info
                                        </h3>
                                        <p class="mt-1 text-sm leading-5 text-gray-500">
                                            This information will be displayed publicly on the platform lists.
                                            The system will generate random batch number
                                        </p>
                                    </div>
                                    <div class="sm:col-span-4">
                                        <label for="cage_no"
                                               class="block text-sm font-medium leading-5 text-gray-700">
                                            Cage No
                                        </label>
                                        <div class="mt-1 rounded-md shadow-sm">
                                            <input id="cage_no"
                                                   type="text"
                                                   wire:model.lazy="cage_no"
                                                   class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('cage_no') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                            @error('cage_no')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="mt-8 border-t border-gray-200 pt-5">
                                <div class="flex justify-end">
                                    <div class="mx-4 inline-flex rounded-md shadow-sm">
                                        <x-danger-button type="button"
                                                         wire:click="confirmingDeletion"
                                                         wire:loading.attr="disabled">
                                            Delete Cage Type
                                        </x-danger-button>
                                    </div>
                                    <span class="inline-flex rounded-md shadow-sm">
                                        <x-secondary-button>
                                            Cancel
                                        </x-secondary-button>
                                    </span>
                                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                                        <x-primary-button type="submit">
                                            Update
                                        </x-primary-button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!-- Add Confirmation Modal -->
                        @if ($confirmingCageDeletion === true)
                            <x-confirmation-modal>
                                <x-slot name="title">
                                    Confirm the Deletion of the Cage
                                </x-slot>

                                <x-slot name="content">
                                    Are you sure you want to perform this action? Once a cage is deleted, all of its resources and data will be permanently updated and altered.
                                </x-slot>

                                <x-slot name="footer">
                                    <x-secondary-button wire:click="closeConfirmingDeletion"
                                                        wire:loading.attr="disabled">
                                        Close
                                    </x-secondary-button>

                                    <x-danger-button class="ml-2"
                                                     wire:click="deleteCage"
                                                     wire:loading.attr="disabled">
                                        Delete the Cage
                                    </x-danger-button>
                                </x-slot>
                            </x-confirmation-modal>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
