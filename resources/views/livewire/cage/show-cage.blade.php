@section('title', 'Show Cage')
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
                        @if($selectRabbit)
                        <div class="p-4 flex-1 flex shadow-sm border w-full my-4 border-gray-200">
                            <div class=" flex flex-col">
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
                        <a href="{{route('farms.index')}}" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                          Cancel
                        </a>
                      </span>
                      <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-teal-600 hover:bg-teal-500 focus:outline-none focus:border-teal-700 focus:shadow-outline-teal active:bg-teal-700 transition duration-150 ease-in-out">
                          Transfer to {{$cage->cage_no}}
                        </button>
                      </span>
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
</div>
