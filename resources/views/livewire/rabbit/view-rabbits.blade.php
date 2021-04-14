@section('title', 'View Rabbits')
    <div class="">

        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Summary Report
            </h3>
            <div class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow md:grid-cols-6">
                <div>
                    <div class="px-4 py-5 sm:p-6">
                        <dl>
                            <dt class="text-base leading-6 font-normal text-gray-900">
                                Total Rabbits
                            </dt>
                            <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                                <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
                                    {{ $rabbits_count }}
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
                                <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
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
                                Dam
                            </dt>
                            <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                                <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
                                    {{ $dam }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="border-t border-gray-200 md:border-0 md:border-l">
                    <div class="px-4 py-5 sm:p-6">
                        <dl>
                            <dt class="text-base leading-6 font-normal text-gray-900">
                                Sire
                            </dt>
                            <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                                <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
                                    {{ $sire }}
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
                                <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
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
                                <div class="flex items-baseline text-2xl leading-8 font-semibold text-teal-600">
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
                                <div class="w-full flex">
                                    <div class="w-full flex-1 flex">
                                        <div class="py-2">
                                            <x-input.text wire:model.lazy="filters.search"
                                                          id="search"
                                                          placeholder="Search here..." />
                                        </div>
                                        <div x-data="{ isOpen: false }"
                                             class="relative flex items-center">
                                            <x-button.link @click="isOpen = !isOpen"
                                                           class="  pl-3">
                                                More Filters
                                            </x-button.link>
                                            <div x-cloak
                                                 x-show.transition.origin.top.left="isOpen"
                                                 @click.away="isOpen = false"
                                                 @keydown.escape.window="isOpen = false"
                                                 class="absolute w-104 text-left font-semibold bg-white shadow-card rounded-xl py-3 md:ml-8 top-10 md:top-10 right-0 md:left-0">
                                                <div class="bg-white p-4 rounded  flex flex-col ">
                                                    <div class="w-full flex flex-col pl-2 space-y-4">
                                                        <select id="cage_id"
                                                                wire:model="filters.cage_id"
                                                                class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                            <option value="">Select Rabbit by Cage ...</option>
                                                            @foreach ($cages as $cage)
                                                                <option value="{{ $cage->id }}">{{ $cage->cage_no }}.</option>
                                                            @endforeach
                                                        </select>
                                                        <select id="gender"
                                                                wire:model.lazy="filters.gender"
                                                                class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                            <option value="">Select the gender...</option>
                                                            @foreach (App\Models\Rabbit::GENDER as $value => $label)
                                                                <option value="{{ $value }}">{{ $label }}</option>
                                                            @endforeach
                                                        </select>
                                                        <select id="status"
                                                                wire:model.lazy="filters.status"
                                                                class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                            <option value="">Select the status...</option>
                                                            @foreach (App\Models\Rabbit::STATUS as $value => $label)
                                                                <option value="{{ $value }}">{{ $label }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input.group inline
                                                                       for="filter-date-min"
                                                                       label="Minimum Date of Birth">
                                                            <x-input.date type="date"
                                                                          wire:model.lazy="filters.date_min"
                                                                          id="date_min"
                                                                          placeholder="MM/DD/YYYY" />
                                                        </x-input.group>
                                                        <x-input.group inline
                                                                       for="filter-date-max"
                                                                       label="Maximum Date of Birth">
                                                            <x-input.date type="date"
                                                                          wire:model.lazy="filters.date_max"
                                                                          id="date_max"
                                                                          placeholder="MM/DD/YYYY" />
                                                        </x-input.group>

                                                    </div>
                                                    <x-button.link wire:click="resetFilters"
                                                                   class="p-4">Reset Filters</x-button.link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-12 space-x-2 items-center flex">
                                        <x-input.group borderless
                                                       paddingless
                                                       for="perPage"
                                                       label="Per Page">
                                            <x-input.select wire:model="perPage"
                                                            id="perPage">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="{{ $all_rabbits_count }}">All</option>
                                            </x-input.select>
                                        </x-input.group>
                                        <x-dropdown label="Bulk Action">
                                            <x-dropdown.item type="button"
                                                             wire:click="exportSelected"
                                                             class="flex items-center space-x-2">
                                                <x-icon.download class="text-cool-gray-400" />
                                                <span>Export</span>
                                        </x-dropdown>
                                        <x-dropdown.item type="button"
                                                         wire:click="$toggle('showDeleteModal')"
                                                         class="flex items-center space-x-2">
                                            <x-icon.trash class="text-cool-gray-400" />
                                            <span>Delete</span>
                                            </x-dropdown>
                                            </x-dropdown>
                                            <x-button.primary wire:click="create">New</x-button.primary>
                                            <x-button.href class="border border-teal-600 px-2 py-2 rounded-md"
                                                           href="{{ route('breed-types.index') }}">Breeds</x-button.primary>
                                    </div>

                                </div>
                            </div>
                            <div class="bg-white flex flex-col mt-2">
                                <x-table>
                                    <x-slot name="head">
                                        <x-table.header class="pr-0 w-8">
                                            <x-input.checkbox wire:model="selectPage" />
                                        </x-table.header>
                                        <x-table.header sortable
                                                        wire:click="sortBy('rabbit_no')"
                                                        :direction="$sorts['rabbit_no'] ?? null">indentification no </x-table.header>
                                        <x-table.header sortable
                                                        wire:click="sortBy('gender')"
                                                        :direction="$sorts['gender'] ?? null">Gender</x-table.header>
                                        <x-table.header sortable
                                                        wire:click="sortBy('cage_id')"
                                                        :direction="$sorts['cage_id'] ?? null">Cage</x-table.header>
                                        <x-table.header sortable>Breed</x-table.header>
                                        <x-table.header sortable
                                                        wire:click="sortBy('status')"
                                                        :direction="$sorts['status'] ?? null">Status</x-table.header>
                                    </x-slot>
                                    <x-slot name="body">
                                        @if ($selectPage)
                                            <x-table.row class="bg-cool-gray-100 "
                                                         wire:key="row-message">
                                                <x-table.cell colspan="7">
                                                    @unless($selectAll)
                                                        <div>
                                                            <span>You selected <strong>{{ $rabbits->count() }}</strong> rabbits, do you want to select <strong>{{ $rabbits->total() }}</strong> rabbits.<x-button.link class="ml-1 text-blue-600"
                                                                               wire:click="selectAll">Select All</x-button.link></span>
                                                        </div>
                                                    @else
                                                        <div><span>You are currently selecting all <strong>{{ $rabbits->total() }}</strong> rabbits.</span></div>
                                            @endif

                                            </x-table.cell>
                                            </x-table.row>
                                            @endif
                                            @forelse($rabbits as $rabbit)
                                                <tr x-data
                                                    @click="                                                       const target = $event.target.tagName.toLowerCase();                                                              const ignores = ['button', 'svg', 'path', 'a', 'input'];                                                               if(! ignores.includes(target))
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    {                                                               $event.target.closest('.rabbit-row').querySelector('.view-rabbit').click()
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }"
                                                    class="rabbit-row @if ($selectedRabbit
                                                    !=null
                                                    &&
                                                    $rabbit->id == $selectedRabbit->id) bg-teal-50 @endif bg-white hover:bg-gray-100 cursor-pointer"
                                                    wire:loading.class=" opacity-50">
                                                    <x-table.cell class="pr-0 hover:bg-gray-100">
                                                        <x-input.checkbox wire:model="selected"
                                                                          value="{{ $rabbit->id }}" />
                                                    </x-table.cell>

                                                    <x-table.cell>
                                                        {{ $rabbit->rabbit_no }}
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        {{ $rabbit->gender }}
                                                    </x-table.cell>
                                                    <x-table.cell>
                                                        @if ($rabbit->cage)
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
                                                            <x-button.link class="view-rabbit text-sm"
                                                                           wire:click="selectRabbit({{ $rabbit->id }})">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="h-6 w-6 text-teal-600"
                                                                     fill="none"
                                                                     viewBox="0 0 24 24"
                                                                     stroke="currentColor">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg>
                                                                </x-button.primary>
                                                                <x-button.link class="text-sm"
                                                                               wire:click="handleSave({{ $rabbit->id }})">
                                                                    <svg class="h-6 w-6 text-teal-600"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         fill="none"
                                                                         viewBox="0 0 24 24"
                                                                         stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              stroke-width="2"
                                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                    </svg>
                                                                    </x-button.primary>
                                                                    <x-button.link wire:click="validateDeletion({{ $rabbit->id }})">
                                                                        <svg class="h-6 w-6 text-red-400"
                                                                             xmlns="http://www.w3.org/2000/svg"
                                                                             fill="none"
                                                                             viewBox="0 0 24 24"
                                                                             stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  stroke-width="2"
                                                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                    </x-button.link>
                                                        </div>
                                                    </x-table.cell>
                                                </tr>
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
                                        {{ $rabbits->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($showDetailsScreen)
                    <div class="bg-gray-100 h-screen"
                         style="min-height: 768px;">
                        <section wire:keydown.window.escape="deselectRabbit"
                                 class="fixed inset-0 overflow-hidden"
                                 aria-labelledby="slide-over-title"
                                 role="dialog"
                                 aria-modal="true">
                            <div class="absolute inset-0 overflow-hidden">
                                <div x-description="Background overlay, show/hide based on slide-over state."
                                     class="absolute inset-0"
                                     wire:click="deselectRabbit()"
                                     aria-hidden="true"></div>
                                <div class="absolute inset-y-0 right-0 pl-10 max-w-full flex sm:pl-16">

                                    <transition enter-active-class="transform transition ease-in-out duration-500 sm:duration-700"
                                                enter-class="translate-x-full"
                                                enter-to-class="translate-x-0"
                                                leave-active-class="transform transition ease-in-out duration-500 sm:duration-700"
                                                leave-class="translate-x-0"
                                                leave-to-class="translate-x-full">
                                        <div class="w-screen max-w-md">
                                            <div class="h-full flex flex-col bg-white shadow overflow-y-scroll">
                                                <div class="p-6">
                                                    <div class="flex items-start justify-between">

                                                        <div id="slide-over-title">
                                                            <h2 class="text-lg font-medium text-gray-900">
                                                                <span class="sr-only">Details for </span>{{ $selectedRabbit->rabbit_no }}
                                                            </h2>
                                                            <p class="text-sm font-medium text-gray-500">Breed not Specified</p>
                                                        </div>
                                                        <div class="ml-3 h-7 flex items-center">
                                                            <button class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-teal-500"
                                                                    wire:click="deselectRabbit()">
                                                                <span class="sr-only">Close panel</span>
                                                                <svg class="h-6 w-6"
                                                                     x-description="Heroicon name: outline/x"
                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                     fill="none"
                                                                     viewBox="0 0 24 24"
                                                                     stroke="currentColor"
                                                                     aria-hidden="true">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="h-full bg-white p-8 overflow-y-auto"
                                                     x-description="Slide-over panel, show/hide based on slide-over state.">
                                                    <div class="pb-16 space-y-6">
                                                        <div>
                                                            <h3 class="font-medium text-gray-900">Information</h3>
                                                            <dl class="mt-2 border-t border-b border-gray-200 divide-y divide-gray-200">
                                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                                    <dt class="text-gray-500">Current Cage</dt>
                                                                    <dd class="text-gray-900">
                                                                        @if ($rabbit->cage){{ $rabbit->cage->cage_no }}@else None @endif
                                                                    </dd>
                                                                </div>
                                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                                    <dt class="text-gray-500">Gender</dt>
                                                                    <dd class="text-gray-900 capitalize">
                                                                        {{ $rabbit->gender }}
                                                                    </dd>
                                                                </div>
                                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                                    <dt class="text-gray-500">Date of Birth</dt>
                                                                    <dd class="text-gray-900">
                                                                        @if ($rabbit->date_of_birth){{ $rabbit->date_of_birth }}@else None @endif
                                                                    </dd>
                                                                </div>
                                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                                    <dt class="text-gray-500">Weight</dt>
                                                                    <dd class="text-gray-900">3kgs</dd>
                                                                </div>
                                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                                    <dt class="text-gray-500">Last modified</dt>
                                                                    <dd class="text-gray-900">June 8, 2020</dd>
                                                                </div>
                                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                                    <dt class="text-gray-500">Beed Type</dt>
                                                                    <dd class="text-gray-900">Not Specified</dd>
                                                                </div>
                                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                                    <dt class="text-gray-500">Status</dt>
                                                                    <dd class="text-teal-900 capitalize font-bold">{{ $rabbit->status }}</dd>
                                                                </div>
                                                            </dl>
                                                        </div>
                                                        <div>
                                                            <h3 class="font-medium text-gray-900">Description</h3>
                                                            <div class="mt-2 flex items-center justify-between">
                                                                <p class="text-sm text-gray-500 italic">Add a description to this Rabbit.</p>
                                                                <button type="button"
                                                                        class="-mr-2 h-8 w-8 bg-white rounded-full flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                                                    <svg class="h-5 w-5"
                                                                         x-description="Heroicon name: solid/pencil"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         viewBox="0 0 20 20"
                                                                         fill="currentColor"
                                                                         aria-hidden="true">
                                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                                    </svg>
                                                                    <span class="sr-only">Add description</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h3 class="font-medium text-gray-900">Previous Breeding Log</h3>
                                                            <ul class="mt-2 border-t border-b border-gray-200 divide-y divide-gray-200">
                                                                <li class="py-3 flex justify-between items-center">
                                                                    <div class="flex items-center">
                                                                        <div class="rounded-full bg-teal-200">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                 class="w-6 h-6"
                                                                                 fill="none"
                                                                                 viewBox="0 0 24 24"
                                                                                 stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                      stroke-linejoin="round"
                                                                                      stroke-width="2"
                                                                                      d="M5 13l4 4L19 7" />
                                                                            </svg>
                                                                        </div>
                                                                        <p class="ml-4 text-sm font-medium text-gray-900">June 8, 2020</p>
                                                                    </div>
                                                                    <button type="button"
                                                                            class="ml-6 bg-white rounded-md text-sm font-medium text-teal-600 hover:text-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">10<span class="sr-only"> Aimee Douglas</span></button>
                                                                </li>
                                                                <li class="py-3 flex justify-between items-center">
                                                                    <div class="flex items-center">
                                                                        <div class="rounded-full bg-teal-200">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                 class="w-6 h-6"
                                                                                 fill="none"
                                                                                 viewBox="0 0 24 24"
                                                                                 stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                      stroke-linejoin="round"
                                                                                      stroke-width="2"
                                                                                      d="M5 13l4 4L19 7" />
                                                                            </svg>
                                                                        </div>
                                                                        <p class="ml-4 text-sm font-medium text-gray-900">June 8, 2020</p>
                                                                    </div>
                                                                    <button type="button"
                                                                            class="ml-6 bg-white rounded-md text-sm font-medium text-teal-600 hover:text-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">23<span class="sr-only"> Andrea McMillan</span></button>
                                                                </li>
                                                                <li class="py-2 flex justify-between items-center">
                                                                    <button type="button"
                                                                            class="group -ml-1 bg-white p-1 rounded-md flex items-center focus:outline-none focus:ring-2 focus:ring-teal-500">
                                                                        <span class="w-8 h-8 rounded-full border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400">
                                                                            <svg class="h-5 w-5"
                                                                                 x-description="Heroicon name: solid/plus"
                                                                                 xmlns="http://www.w3.org/2000/svg"
                                                                                 viewBox="0 0 20 20"
                                                                                 fill="currentColor"
                                                                                 aria-hidden="true">
                                                                                <path fill-rule="evenodd"
                                                                                      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                                      clip-rule="evenodd"></path>
                                                                            </svg>
                                                                        </span>
                                                                        <span class="ml-4 text-sm font-medium text-teal-600 group-hover:text-teal-500">Add a Mating Record</span>
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="flex">
                                                            <button type="button"
                                                                    class="flex-1 bg-teal-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                                                Download
                                                            </button>
                                                            <button type="button"
                                                                    class="flex-1 ml-3 bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </transition>

                                </div>
                            </div>
                        </section>


                    </div>
                @endif

                <form wire:submit.prevent="save">
                    <x-modal.dialog wire:model.defer="showSaveModal">
                        <x-slot name="title">Save a Rabbit</x-slot>
                        <x-slot name="content">
                            <x-input.group for="rabbit_no"
                                           :error="$errors->first('rabbit.rabbit_no')"
                                           label="Rabbit No">
                                <x-input.text wire:model="rabbit.rabbit_no"
                                              id="rabbit_no" />
                            </x-input.group>
                            <x-input.group for="gender"
                                           :error="$errors->first('rabbit.gender')"
                                           label="Gender">
                                <x-input.select wire:model="rabbit.gender"
                                                id="gender">
                                    <option value="">Select Gender ...</option>
                                    @foreach (App\Models\Rabbit::GENDER as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>
                            <x-input.group for="cage_id"
                                           :error="$errors->first('rabbit.cage_id')"
                                           label="Cage">
                                <x-input.select wire:model="rabbit.cage_id"
                                                id="cage_id">
                                    <option value="">Select Cage ...</option>
                                    @foreach ($cages as $cage)
                                        <option value="{{ $cage->id }}">{{ $cage->cage_no }}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>

                            <x-input.group for="breed_id"
                                           :error="$errors->first('rabbit.breed_id')"
                                           label="Breed Types">
                                <x-input.select wire:model="rabbit.breed_id"
                                                id="breed_id">
                                    <option value="">Select Breed Types ...</option>
                                    @foreach ($rabbitTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>
                            <x-input.group for="date_of_birth"
                                           :error="$errors->first('rabbit.date_of_birth')"
                                           label="Date Of Birth">
                                <input type="date"
                                       wire:model="rabbit.date_of_birth"
                                       id="date_of_birth" />
                            </x-input.group>
                        </x-slot>
                        <x-slot name="footer">
                            <x-button.secondary type="button"
                                                class="bg-red-600"
                                                wire:click="$set('showSaveModal', false)">Cancel</x-button.secondary>
                            <x-button.primary type="submit">Save</x-button.primary>
                        </x-slot>
                    </x-modal.dialog>
                </form>

                <!-- Add Rabbit Confirmation Modal -->
                @if ($confirmingRabbitDeletion === true)
                    <x-confirmation-modal>
                        <x-slot name="title">
                            Confirm Deletion of the rabbit
                        </x-slot>
                        <x-slot name="content">
                            Are you sure you want to completely delete this rabbit? Once a rabbit is deleted, all of its resources and data will be not be recovered.
                        </x-slot>
                        <x-slot name="footer">
                            <x-secondary-button wire:click="$toggle('confirmingRabbitDeletion')"
                                                wire:loading.attr="disabled">
                                Close
                            </x-secondary-button>
                            <x-danger-button class="ml-2"
                                             wire:click="handleDeletion"
                                             wire:loading.attr="disabled">
                                Delete
                            </x-danger-button>
                        </x-slot>
                    </x-confirmation-modal>
                @endif
            </div>

            <form wire:submit.prevent="deleteSelected">
                <x-modal.confirmation wire:model.defer="showDeleteModal">
                    <x-slot name="title">Delete Rabbit(s)</x-slot>
                    <x-slot name="content">
                        Are you sure you want to delete these rabbits? This action is irreversible
                    </x-slot>
                    <x-slot name="footer">
                        <x-button.secondary class="bg-red-600"
                                            wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>
                        <x-button.primary type="submit">Delete</x-button.primary>
                    </x-slot>
                    </x-modal.dialog>
            </form>

        </div>
