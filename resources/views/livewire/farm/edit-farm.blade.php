@section('title', 'Edit a {{$form->name}}')
@section('header', 'Edit a {{$farm->name}}')
<div class="mt-2">
    <!-- Edit Customer Form -->
    <div class="block">
      <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
        <div class="flex flex-col mt-2">
          <div class="align-middle min-w-full  shadow overflow-hidden sm:rounded-lg">

            <form class="bg-white py-3 px-6" wire:submit.prevent="updateFarm">
              <div>
                <div class="mt-3 pt-2">
                  <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                      Edit Farm Info
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-500">
                      This information will be displayed publicly on the platform lists.
                    </p>
                  </div>
                  <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                      <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                        Farm Name
                      </label>
                      <div class="mt-1 rounded-md shadow-sm">
                        <input id="name" wire:model.lazy="name" class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" value="{{$farm->name}}" />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>

                    <div class="sm:col-span-4">
                      <label for="address" class="block text-sm font-medium leading-5 text-gray-700">
                        Street Address
                      </label>
                      <div class="mt-1 rounded-md shadow-sm">
                        <input id="address" wire:model.lazy="address" class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('address') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" value="dddf"/>
                        @error('address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>

                    <div class="sm:col-span-4">
                      <label for="is_active" class="block text-sm font-medium leading-5 text-gray-700">
                        Status
                      </label>
                      <div class="mt-1 rounded-md shadow-sm">
                        <select id="is_active" wire:model.lazy="is_active" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('is_active') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror">
                            <option value="true" @if($farm->current_status == 'active') selected @endif >Active</option>
                            <option value="false" @if($farm->current_status == 'in-active') selected @endif>Not Active</option>
                        </select>
                        @error('is_active')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-3 pt-2">
                   <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                      Contact Information
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-500">
                      This is the information of the direct contact of the customer.
                    </p>
                  </div>
                  <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                      <label for="contacts" class="block text-sm font-medium leading-5 text-gray-700">
                        Contacts
                      </label>
                      <div class="mt-1 rounded-md shadow-sm">
                        <input id="contacts" wire:model.lazy="contacts" class="form-input block w-full transition duration-150 rounded-none border ease-in-out sm:text-sm sm:leading-5 @error('contacts') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                        @error('contacts')
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
                        <x-secondary-button wire:click="" wire:loading.attr="disabled">
                           cancel
                         </x-secondary-button>
                      </span>
                      <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <x-primary-button  type="submit">
                          Update
                        </x-primary-button>
                      </span>
                  </div>
              </div>
            </form>
             <div>
              <a href="{{route('farms.rabbits', $farm->id)}}">Serve Rabbits</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

