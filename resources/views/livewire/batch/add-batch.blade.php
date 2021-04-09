@section('title', 'Add a new Btch')
    <div class="mt-2">
        <!-- Add Batch Form -->
        <div class="block">
            <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full  shadow overflow-hidden sm:rounded-lg">

                        <form class="bg-white py-3 px-6"
                              wire:submit.prevent="addBatch">
                            <div>
                                <div class="mt-3 pt-2">
                                    <div>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Add Batch Info
                                        </h3>
                                        <p class="mt-1 text-sm leading-5 text-gray-500">
                                            This information will be displayed publicly on the platform lists.
                                            The system will generate random batch number
                                        </p>
                                    </div>
                                    <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                                        <div class="sm:col-span-3">
                                            <label for="date_of_construction"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Date of Construction
                                            </label>
                                            <div class="mt-1 rounded-md shadow-sm">
                                                <input id="date_of_construction"
                                                       type="date"
                                                       wire:model.lazy="date_of_construction"
                                                       class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('date_of_construction') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                                @error('date_of_construction')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-1">
                                    <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                                        <div class="sm:col-span-3">
                                            <label for="cost_of_construction"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Cost of Construction
                                            </label>
                                            <div class="mt-1 rounded-md shadow-sm">
                                                <input id="cost_of_construction"
                                                       wire:model.lazy="cost_of_construction"
                                                       class="form-input block w-full transition duration-150 rounded-none border ease-in-out sm:text-sm sm:leading-5 @error('cost_of_construction') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                                @error('cost_of_construction')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="pt-1">
                                    <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                                        <div class="sm:col-span-3">
                                            <label for="number_of_cages"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Number of Cages
                                            </label>
                                            <div class="mt-1 rounded-md shadow-sm">
                                                <input id="number_of_cages"
                                                       wire:model.lazy="number_of_cages"
                                                       class="form-input block w-full transition duration-150 rounded-none border ease-in-out sm:text-sm sm:leading-5 @error('number_of_cages') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                                @error('number_of_cages')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-8 border-t border-gray-200 pt-5">
                                <div class="flex justify-end">
                                    <span class="inline-flex rounded-md shadow-sm">
                                        <x-secondary-button>
                                            Cancel
                                        </x-secondary-button>
                                    </span>
                                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                                        <x-primary-button type="submit">
                                            Save
                                        </x-primary-button>
                                    </span>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
