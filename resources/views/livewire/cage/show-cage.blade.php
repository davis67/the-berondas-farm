@section('title', 'Show Cage')
<div class="mt-2">
    <div class="block">
      <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
        <div class="flex flex-col mt-2">
            <div>
                <form class="bg-white py-3 px-6 w-full" wire:submit.prevent="addBatch">
                  <div>
                    <div class="mt-3 pt-2">
                      <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                          Transfer Rabbit to <span>{{$cage->cage_no}}</span>
                        </h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                          The rabbit transferred to the cage must not be a male more than 4 months old
                        </p>
                      </div>
                      <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                          <label for="rabbit" class="block text-sm font-medium leading-5 text-gray-700">
                            Select the Rabbit
                          </label>
                          <div class="mt-1 rounded-md shadow-sm">
                            <select id="rabbit" type="date" wire:model.lazy="rabbit" class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('rabbit') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror">
                                <option>rabbit 1</option>
                                <option>rabbit 2</option>
                            </select>
                            @error('rabbit')
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
                        <a href="{{route('farms.index')}}" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                          Cancel
                        </a>
                      </span>
                      <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-teal-600 hover:bg-teal-500 focus:outline-none focus:border-teal-700 focus:shadow-outline-teal active:bg-teal-700 transition duration-150 ease-in-out">
                          Transfer
                        </button>
                      </span>
                    </div>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
