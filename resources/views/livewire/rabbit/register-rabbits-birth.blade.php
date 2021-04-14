@section('title', 'Add a new Rabbit')
@section('header', 'Register a new birth')
    <div class="mt-2">
        <!-- Add Batch Form -->
        <div class="block">
            <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full  shadow overflow-hidden sm:rounded-lg">
                        <div class="my-4">
                            @if (session()->has('success'))
                                <div class="font-medium text-green-700">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <form class="bg-white py-3 px-6"
                              wire:submit.prevent="registerBirth">
                            <div>
                                <div class="mt-3 pt-2">
                                    <div>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Additional Birth Info
                                        </h3>
                                        <p class="mt-1 text-sm leading-5 text-gray-500">
                                            This information will be displayed publicly on the platform lists.
                                            The system will generate random batch number
                                        </p>
                                    </div>
                                    <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                                        <div class="sm:col-span-3">
                                            <label for="actual_date_of_birth"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Actual Date of Birth
                                            </label>
                                            <div class="mt-1 rounded-md shadow-sm">
                                                <input id="actual_date_of_birth"
                                                       type="date"
                                                       wire:model.lazy="actual_date_of_birth"
                                                       class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('actual_date_of_birth') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                                @error('actual_date_of_birth')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-1">
                                    <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                                        <div class="sm:col-span-3">
                                            <label for="number_of_kits"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Number of kits
                                            </label>
                                            <div class="mt-1 rounded-md shadow-sm">
                                                <input id="number_of_kits"
                                                       wire:model.lazy="number_of_kits"
                                                       class="form-input block w-full transition duration-150 rounded-none border ease-in-out sm:text-sm sm:leading-5 @error('number_of_kits') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                                @error('number_of_kits')
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
                                            Register a Birth
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
