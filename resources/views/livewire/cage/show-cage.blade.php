@section('title', 'Show Cage')
@section('header', 'Show Cage')
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
                <form class="bg-white py-3 px-6 w-full" wire:submit.prevent="handleTransfer">
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
                      <div class="mt-4 flex space-x-4 justify-between">
                        <div class="flex-1">
                          <label for="rabbit" class="block text-sm font-medium leading-5 text-gray-700">
                            Select the Rabbit
                          </label>
                          <div class="mt-1 rounded-md shadow-sm">
                            <select id="rabbit" type="date" wire:model.lazy="rabbit" class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('rabbit') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror">
                                <option value="">Select Rabbit ... </option>
                                @foreach($rabbits as $rabbit)
                                    <option value="{{$rabbit->id}}">{{$rabbit->rabbit_no}}</option>
                                @endforeach
                            </select>
                            @error('rabbit')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                              {{$cage->rabbits->pluck('age_number')->contains(function($key, $value){
                                return $value >= 120;
                            })}}
                        @if($selectRabbit)

                        <div class="p-4 flex-1 flex shadow-sm border w-full my-4 border-gray-200">
                            <div class=" flex flex-col">

                              <span>Date of Birth: {{$selectRabbit->date_of_birth}}</span>
                              <span>Age: {{$selectRabbit->age()}}</span>
                              <span>Age: {{$selectRabbit->age_number}}</span>
                              <span>Rabbit No: {{$selectRabbit->rabbit_no}}</span>
                              <span>Breed: {{$selectRabbit->breed}}</span>
                              <span>Gender: {{$selectRabbit->gender}}</span>
                              <span>Status: {{$selectRabbit->status}}</span>
                            </div>
                        </div>
                        @endif
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
                        <x-primary-button  wire:click="validateTransfer" wire:loading.attr="disabled">
                          Transfer to {{$cage->cage_no}}
                        </x-primary-button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <div class="flex flex-col mt-2">
            <div class="bg-white py-3 px-6 w-full">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  Current Rabbits in <span>{{$cage->cage_no}}</span>
                </h3>
                @forelse($cage->rabbits as $rabbit)
                <div class="flex space-x-4">
                    <div>{{$rabbit->rabbit_no}}</div>
                    <div>{{($rabbit->pivot->is_occupant)? "True" : "False"}}</div>
                </div>
                @empty
                <div class="my-4 w-full">
                    <span class="text-teal-700 py-2 px-1">No Rabbits in this cage</span>
                </div>
                @endforelse

            </div>
        </div>
      </div>
    </div>

    <!-- Add Rabbit Confirmation Modal -->
    @if($confirmingRabbitTransfer === true)
    <x-confirmation-modal>
        <x-slot name="title">
            Confirm Transfer of the rabbit {{$selectRabbit->rabbit_no}} to {{$cage->cage_no}}
        </x-slot>

        <x-slot name="content">
            Are you sure you want to transfet this rabbit? Once a rabbit is transfered, all of its resources and data will be permanently updated and altered.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingRabbitTransfer')" wire:loading.attr="disabled">
                Nevermind
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="handleTransfer" wire:loading.attr="disabled">
                Confirm Transfer
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
    @endif
</div>

