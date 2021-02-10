@section('title', 'Edit a {{$form->name}}')
@section('header', 'Edit a {{$farm->name}}')
<div class="mt-2">
    <div class="block">
      <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
        <div class="flex flex-col mt-2">
            <div>
                <div class="my-4">
                @if (session()->has('success'))
                    <div class="font-medium text-green-700">
                        {{ session('success') }}
                    </div>
                @endif
                </div>
                <form class="bg-white py-3 px-6 w-full" wire:submit.prevent="handleRabbitServing">
                  <div>
                    <div class="mt-3 pt-2">
                      <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                          Serving a Rabbit
                        </h3>
                      </div>
                      <div class="mt-4 flex space-x-4 justify-between">
                        <div class="flex-1">
                          <label for="male_rabbit" class="block text-sm font-medium leading-5 text-gray-700">
                            Select the Male Rabbit
                          </label>
                          <div class="mt-1 rounded-md shadow-sm">
                            <select id="male_rabbit" wire:model.lazy="male_rabbit" class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('male_rabbit') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror">
                                <option value="">Select Rabbit ... </option>
                                @foreach($male_rabbits as $rabbit)
                                    <option value="{{$rabbit->id}}">{{$rabbit->rabbit_no}}</option>
                                @endforeach
                            </select>
                            @error('male_rabbit')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="mt-4 flex space-x-4 justify-between">
                        <div class="flex-1">
                          <label for="female_rabbit" class="block text-sm font-medium leading-5 text-gray-700">
                            Select the Female Rabbit
                          </label>
                          <div class="mt-1 rounded-md shadow-sm">
                            <select id="female_rabbit" wire:model.lazy="female_rabbit" class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('female_rabbit') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror">
                                <option value="">Select Rabbit ... </option>
                                @foreach($female_rabbits as $rabbit)
                                    <option value="{{$rabbit->id}}">{{$rabbit->rabbit_no}}</option>
                                @endforeach
                            </select>
                            @error('female_rabbit')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="mt-4 flex space-x-4 justify-between">
                        <div class="flex-1">
                          <label for="date_of_serving" class="block text-sm font-medium leading-5 text-gray-700">
                            Date of Serving
                          </label>
                          <div class="mt-1 rounded-md shadow-sm">
                            <input id="date_of_serving" type="date" wire:model.lazy="date_of_serving" class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('date_of_serving') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror"/>
                            @error('date_of_serving')
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
                        <x-primary-button type="submit"  wire:loading.attr="disabled">
                          Serve
                        </x-primary-button>
                      </span>
                    </div>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </div>

    <!-- Add Confirmation Modal -->

    <x-confirmation-modal>
        <x-slot name="title">
            Confirm Transfer of the rabbit
        </x-slot>

        <x-slot name="content">
            Are you sure you want to transfet this rabbit? Once a rabbit is transfered, all of its resources and data will be permanently updated and altered.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="" wire:loading.attr="disabled">
                Nevermind
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="" wire:loading.attr="disabled">
                Confirm Transfer
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
