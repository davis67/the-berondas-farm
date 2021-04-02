@section('title', 'View Rabbits')
{{-- @section('header', 'View Rabbits') --}}
<div class="">

    <div>
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Summary Report
      </h3>
      <div class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow md:grid-cols-4">
        <div>
          <div class="px-4 py-5 sm:p-6">
            <dl>
              <dt class="text-base leading-6 font-normal text-gray-900">
                Total Rabbits
              </dt>
              <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                <div class="flex items-baseline text-2xl leading-8 font-semibold text-indigo-600">
                  {{ count($rabbits) }}
                </div>
              </dd>
            </dl>
          </div>
        </div>
        <div class="border-t border-gray-200 md:border-0 md:border-l">
          <div class="px-4 py-5 sm:p-6">
            <dl>
              <dt class="text-base leading-6 font-normal text-gray-900">
                Bucks
              </dt>
              <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                <div class="flex items-baseline text-2xl leading-8 font-semibold text-indigo-600">
                  {{ $bucks }}
                </div>
              </dd>
            </dl>
          </div>
        </div>
        <div class="border-t border-gray-200 md:border-0 md:border-l">
          <div class="px-4 py-5 sm:p-6">
            <dl>
              <dt class="text-base leading-6 font-normal text-gray-900">
                Does
              </dt>
              <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                <div class="flex items-baseline text-2xl leading-8 font-semibold text-indigo-600">
                  {{ $does }}
                </div>
              </dd>
            </dl>
          </div>
        </div>
        <div class="border-t border-gray-200 md:border-0 md:border-l">
          <div class="px-4 py-5 sm:p-6">
            <dl>
              <dt class="text-base leading-6 font-normal text-gray-900">
                Kits
              </dt>
              <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                <div class="flex items-baseline text-2xl leading-8 font-semibold text-indigo-600">
                  {{ $kits }}
                </div>
              </dd>
            </dl>
          </div>
        </div>
      </div>
    </div>

    <div class="block">
        <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
            <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full  shadow overflow-hidden sm:rounded-lg">
                    <div class="bg-white border border-cool-gray-200  sm:px-6 lg:px-8">
                        <div class="w-full">
                            <div class="my-4">
                                @if (session()->has('success'))
                                <div class="font-medium text-green-700">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                            <div class="my-4">
                            <a href="{{route('breed-types.index')}}" class="underline font-bold leading-6 text-md uppercase">View all Breed Types</a>
                            </div>
                            <div class="w-full flex">
                                <div class="w-full flex-1 flex">
                                    <div class="py-2">
                                        <x-input.text  wire:model.lazy="search" id="search" placeholder="Search here..." wire:model.lazy="search"/>
                                    </div>
                                    <x-button.link wire:click="$toggle('showFilters')" class="pl-3">@if($showFilters) Hide @endif More Filters</x-button.link>
                                </div>
                                <div class="px-12 space-x-2 items-center flex">
                                    <x-input.group borderless paddingless for="perPage" label="Per Page">
                                        <x-input.select wire:model="perPage" id="perPage">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </x-input.select>
                                    </x-input.group>
                                    <x-dropdown label="Bulk Action">
                                        <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2"> <x-icon.download class="text-cool-gray-400"/>
                                            <span>Export</span>
                                        </x-dropdown>
                                        <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-2">
                                        <x-icon.trash class="text-cool-gray-400"/>
                                        <span>Delete</span>
                                        </x-dropdown>
                                    </x-dropdown>
                                    <x-button.primary wire:click="create">Import</x-button.primary>
                                    <x-button.primary wire:click="create">New</x-button.primary>
                                </div>

                            </div>
                            <div>
                                @if($showFilters)
                                <div class="bg-white p-4 rounded shadow flex relative">
                                    <div class="w-1/2 pl-2 space-y-4">
                                        <select id="cage_id" wire:model="cage_id" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <option value="" >Select Rabbit by Cage ...</option>
                                            @foreach($cages as $cage)
                                            <option value="{{ $cage->id }}" >{{ $cage->cage_no }}.</option>
                                            @endforeach
                                        </select>
                                        <select id="gender" wire:model.lazy="gender" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <option value="" >Select the gender...</option>
                                            @foreach(App\Models\Rabbit::GENDER as $value => $label)
                                                <option value="{{ $value}}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <select id="status" wire:model.lazy="status" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <option value="" >Select the status...</option>
                                            <option value="active" >alive</option>
                                            <option value="dead">dead</option>
                                            <option value="sold">sold</option>
                                        </select>
                                        <x-input.group inline for="filter-date-min" label="Minimum Date of Birth">
                                        <x-input.date type="date" wire:model.lazy="date_min" id="date_min" placeholder="MM/DD/YYYY" />
                                        </x-input.group>
                                        <x-input.group inline for="filter-date-max" label="Maximum Date of Birth">
                                        <x-input.date type="date" wire:model.lazy="date_max" id="date_max" placeholder="MM/DD/YYYY" />
                                        </x-input.group>
                                        <x-button.link wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</x-button.link>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="bg-white flex flex-col mt-2">
                            <x-table>
                                <x-slot name="head">
                                    <x-table.header class="pr-0 w-8">
                                        <x-input.checkbox wire:model="selectPage" />
                                    </x-table.header>
                                    <x-table.header sortable wire:click="sortBy('rabbit_type_id')"
                                    :direction="$sortField === 'rabbit_no' ? $sortDirection : null">indentification no </x-table.header>
                                    <x-table.header sortable wire:click="sortBy('gender')"
                                    :direction="$sortField === 'gender' ? $sortDirection : null">Gender</x-table.header>
                                    <x-table.header sortable wire:click="sortBy('cage')"
                                    :direction="$sortField === 'cage' ? $sortDirection : null">Cage</x-table.header>
                                    <x-table.header sortable>Breed</x-table.header>
                                    <x-table.header sortable>status</x-table.header>
                                </x-slot>
                                <x-slot name="body">
                                    @forelse($rabbits as $rabbit)
                                        <x-table.row wire:loading.class="opacity-50">
                                            <x-table.cell class="pr-0">
                                                <x-input.checkbox wire:model="selected" value="{{ $rabbit->id }}" />
                                            </x-table.cell>

                                            <x-table.cell>
                                                {{ $rabbit->rabbit_no }}
                                            </x-table.cell>
                                            <x-table.cell>
                                                {{ $rabbit->gender }}
                                            </x-table.cell>
                                            <x-table.cell>
                                                @if($rabbit->cage)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-800">{{ $rabbit->cage->cage_no }}</span>
                                                @else
                                                None
                                                @endif
                                            </x-table.cell>
                                            <x-table.cell>
                                                Not Specified
                                            </x-table.cell>
                                            <x-table.cell>
                                                {{ $rabbit->status }}
                                            </x-table.cell>
                                            <x-table.cell>
                                            <div class="flex">
                                               <x-button.link class="text-sm" wire:click="handleSave({{ $rabbit->id }})">
                                                    <svg class="h-6 w-6 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </x-button.primary>
                                                 <x-button.link wire:click="validateDeletion({{$rabbit->id}})">
                                                    <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </x-button.link>
                                            </div>
                                            </x-table.cell>
                                        </x-table.row>
                                    @empty
                                        <x-table.row>
                                            <x-table.cell colspan="6">
                                            <div class="flex justify-center items-center space-x-2">
                                                <x-icon.inbox class="h-8 w-8 text-gray-400" />
                                                <span class="font-medium py-8 text-gray-400 text-xl">No rabbits found...</span>
                                            </div>
                                            </x-table.cell>
                                        </x-table.row>
                                    @endforelse
                                </x-slot>
                            </x-table>
                            <div class="bg-white px-4 py-3 border-t border-cool-gray-200 sm:px-6">
                                {{$rabbits->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <form wire:submit.prevent="save">
       <x-modal.dialog wire:model.defer="showSaveModal">
           <x-slot name="title">Save a Rabbit</x-slot>
           <x-slot name="content">
            @if($showRabbitNo)
            <x-input.group  for="rabbit_no" :error="$errors->first('editing.rabbit_no')" label="Rabbit No">
                    <x-input.text  wire:model="rabbit.rabbit_no"  id="rabbit_no"/>
            </x-input.group>
            @endif
            <x-input.group for="gender" :error="$errors->first('rabbit.gender')" label="Gender">
                   <x-input.select wire:model="rabbit.gender"  id="gender">
                       <option value="">Select Gender ...</option>
                       @foreach(App\Models\Rabbit::GENDER as $value => $label)
                        <option value="{{ $value}}">{{ $label }}</option>
                       @endforeach
                   </x-input.select>
            </x-input.group>
           <x-input.group for="cage_id" :error="$errors->first('rabbit.cage_id')" label="Cage">
               <x-input.select wire:model="rabbit.cage_id"  id="cage_id">
                   <option value="">Select Cage ...</option>
                   @foreach($cages as $cage)
                   <option value="{{ $cage->id}}">{{ $cage->cage_no }}</option>
                   @endforeach
               </x-input.select>
           </x-input.group>

            <x-input.group for="breed_id" :error="$errors->first('rabbit.breed_id')" label="Breed Types">
               <x-input.select wire:model="rabbit.breed_id"  id="breed_id">
                   <option value="">Select Breed Types ...</option>
                   @foreach($rabbitTypes as $type)
                   <option value="{{ $type->id}}">{{ $type->name }}</option>
                   @endforeach
               </x-input.select>
           </x-input.group>
           <x-input.group for="date_of_birth" :error="$errors->first('rabbit.date_of_birth')" label="Date Of Birth">
               <input type="date"  wire:model="rabbit.date_of_birth"  id="date_of_birth"/>
           </x-input.group>
           </x-slot>
           <x-slot name="footer">
               <x-button.secondary type="button" class="bg-red-600" wire:click="$set('showSaveModal', false)">Cancel</x-button.secondary>
               <x-button.primary type="submit">Save</x-button.primary>
           </x-slot>
       </x-modal.dialog>
    </form>

    <!-- Add Rabbit Confirmation Modal -->
    @if($confirmingRabbitDeletion === true)
        <x-confirmation-modal>
            <x-slot name="title">
                Confirm Deletion of the rabbit
            </x-slot>
            <x-slot name="content">
                Are you sure you want to completely delete this rabbit? Once a rabbit is deleted, all of its resources and data will be not be recovered.
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingRabbitDeletion')" wire:loading.attr="disabled">
                Close
                </x-secondary-button>
                <x-danger-button class="ml-2" wire:click="handleDeletion" wire:loading.attr="disabled">
                Delete
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>
    @endif
    </div>

</div>
