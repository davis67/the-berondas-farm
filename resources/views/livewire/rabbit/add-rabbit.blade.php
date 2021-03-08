@section('title', 'Add a new Rabbit')
@section('header', 'Add a new Rabbit')
<div class="mt-2">
  <!-- Add Batch Form -->
  <div class="block">
    <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
      <div class="flex flex-col mt-2">
        <div class="align-middle min-w-full  shadow overflow-hidden sm:rounded-lg">
          <form class="bg-white py-3 px-6" wire:submit.prevent="addRabbit">
            <div>
              <div class="mt-3 pt-2">
                <div>
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                  Add Rabbit Info
                  </h3>
                  <p class="mt-1 text-sm leading-5 text-gray-500">
                    This information will be displayed publicly on the platform lists.
                    The system will generate random batch number
                  </p>
                </div>
                <div class="sm:col-span-4">
                  <label for="gender" class="block text-sm font-medium leading-5 text-gray-700">
                    Gender
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <select id="gender" wire:model.lazy="gender" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('gender') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror">
                      <option value="" >Select the gender...</option>
                      <option value="male" >Buck</option>
                      <option value="female">Doe</option>
                      <option value="female">Unknown</option>
                    </select>
                    @error('gender')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                  <div class="sm:col-span-3">
                    <label for="date_of_birth" class="block text-sm font-medium leading-5 text-gray-700">
                      Date of Birth
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                      <input id="date_of_birth" type="date" wire:model.lazy="date_of_birth" class="form-input block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('date_of_birth') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                      @error('date_of_birth')
                      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="sm:col-span-4">
                <label for="breed_id" class="block text-sm font-medium leading-5 text-gray-700">
                  Breed
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <select id="breed_id" wire:model.lazy="breed_id" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('breed_id') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror">
                    <option value="" >Select the breed type</option>
                    @foreach($breeds as $breed)
                    <option value="{{$breed->id}}">{{$breed->name}}</option>
                    @endforeach
                  </select>
                  @error('breed_id')
                  <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="mt-8 border-t border-gray-200 pt-5">
              <div class="flex justify-end">
                <span class="inline-flex rounded-md shadow-sm">
                  <x-primary-button >
                  Cancel
                  </x-primary-button>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                  <x-secondary-button type="submit">
                  Save
                  </x-secondary-button>
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
