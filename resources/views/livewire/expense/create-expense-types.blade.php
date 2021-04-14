@section('title', 'Add a new Expense Type')
@section('header', 'Add a new Expense Type')
    <div class="mt-2">
        <!-- Add Batch Form -->
        <div class="block">
            <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
                <div class="flex flex-col mt-2">
                    <div class="align-middle min-w-full  shadow overflow-hidden sm:rounded-lg">

                        <form class="bg-white py-3 px-6"
                              wire:submit.prevent="addExpenseTypes">
                            <div>
                                <div class="mt-3 pt-2">
                                    <div>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Add Expense Type Info
                                        </h3>
                                        <p class="mt-1 text-sm leading-5 text-gray-500">
                                            This information will be displayed publicly on the platform lists.
                                            The system will generate random batch number
                                        </p>
                                    </div>
                                    <div class="sm:col-span-4">
                                        <label for="name"
                                               class="block text-sm font-medium leading-5 text-gray-700">
                                            Name
                                        </label>
                                        <div class="mt-1 rounded-md shadow-sm">
                                            <input id="name"
                                                   type="text"
                                                   wire:model.lazy="name"
                                                   class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                            @error('name')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="sm:col-span-4 my-4">
                                        <label for="description"
                                               class="block text-sm font-medium leading-5 text-gray-700">
                                            Description
                                        </label>
                                        <div class="mt-1 rounded-md shadow-sm">
                                            <input id="description"
                                                   type="text"
                                                   wire:model.lazy="description"
                                                   class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('description') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                            @error('description')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
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
