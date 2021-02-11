@section('title', 'Add a new Expense')
@section('header', 'Add a new Expense')
<div class="mt-2">
    <!-- Add Expense Form -->
    <div class="block">
        <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
            <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full  shadow overflow-hidden sm:rounded-lg">
                    <form class="bg-white py-3 px-6" wire:submit.prevent="registerExpenses">
                        <div>
                            <div class="mt-3 pt-2">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                      Add Expense Info
                                    </h3>
                                    <p class="mt-1 text-sm leading-5 text-gray-500">
                                      This information will be displayed publicly on the platform lists.
                                      The system will generate random batch number
                                    </p>
                                </div>
                                <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="expense_type_id" class="block text-sm font-medium leading-5 text-gray-700">
                                            Expense Type
                                        </label>
                                        <div class="mt-1 rounded-md shadow-sm">
                                            <select id="expense_type_id" wire:model.lazy="expense_type_id" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('expense_type_id') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror">
                                                <option value="" >Select ...</option>
                                                @foreach($expense_types as $expense_type)
                                                    <option value="{{$expense_type->id}}">{{$expense_type->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('expense_type_id')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="expense_date" class="block text-sm font-medium leading-5 text-gray-700">
                                            Expense Date
                                        </label>
                                        <div class="mt-1 rounded-md shadow-sm">
                                            <input id="expense_date" type="date" wire:model.lazy="expense_date" class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('expense_date') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                            @error('expense_date')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-1">
                              <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                  <label for="amount" class="block text-sm font-medium leading-5 text-gray-700">
                                    Amount
                                  </label>
                                  <div class="mt-1 rounded-md shadow-sm">
                                    <input id="amount" wire:model.lazy="amount" class="form-input block w-full transition duration-150 rounded-none border ease-in-out sm:text-sm sm:leading-5 @error('amount') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                                    @error('amount')
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
                                  Add Expense
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
