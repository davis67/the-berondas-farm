<x-table>
    <x-slot name="head">
        <x-table.header class="pr-0 w-8">
            <x-input.checkbox wire:model="selectPage" />
        </x-table.header>
        <x-table.header sortable
                        wire:click="sortBy('rabbit_no')"
                        :direction="$sorts['rabbit_no'] ?? null">Sire </x-table.header>
        <x-table.header sortable
                        wire:click="sortBy('rabbit_no')"
                        :direction="$sorts['rabbit_no'] ?? null">Dam </x-table.header>
        <x-table.header sortable
                        wire:click="sortBy('gender')"
                        :direction="$sorts['gender'] ?? null">Date of Mating</x-table.header>
        <x-table.header sortable
                        wire:click="sortBy('cage_id')"
                        :direction="$sorts['cage_id'] ?? null">Cage</x-table.header>
        <x-table.header sortable>Exp kiddle date</x-table.header>
        <x-table.header sortable> kiddle date</x-table.header>
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
                        <div>
                            <span>You are currently selecting all <strong>{{ $rabbits->total() }}</strong> rabbits.</span>
                        </div>
            @endif

            </x-table.cell>
            </x-table.row>
            @endif
            @forelse($logs as $log)
                <tr x-data
                    @click="                                                       const target = $event.target.tagName.toLowerCase();                                                              const ignores = ['button', 'svg', 'path', 'a', 'input'];                                                               if(! ignores.includes(target))
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            {                                                               $event.target.closest('.rabbit-row').querySelector('.view-rabbit').click()
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }"
                    class="rabbit-row @if ($selectedLog
                    !=null
                    &&
                    $log->id == $selectedLog->id) bg-teal-50 @endif bg-white hover:bg-gray-100 cursor-pointer"
                    wire:loading.class=" opacity-50">
                    <x-table.cell class="pr-0 hover:bg-gray-100">
                        <x-input.checkbox wire:model="selected"
                                          value="{{ $log->id }}" />
                    </x-table.cell>

                    <x-table.cell>
                        @if($log->sire)
                            {{ $log->sire->rabbit_no }}
                        @else
                            Not Specified
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        @if($log->dam)
                            {{ $log->dam->rabbit_no }}
                        @else
                            Not Specified
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                       {{ $log->date_of_mating_for_humans }}
                    </x-table.cell>
                    <x-table.cell>
                        Not Specified
                    </x-table.cell>
                    <x-table.cell>
                        {{ $log->expected_kiddle_date_for_humans }}
                     </x-table.cell>
                     <x-table.cell>
                        {{ $log->kiddle_date_for_humans }}
                     </x-table.cell>
                    <x-table.cell>
                        @if($log->is_successful_mating)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-cool-gray-100 text-cool-gray-800">{{$log->age}}</span>
                        @else
                            @if($log->expected_kiddle_days >= 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-teal-100 text-teal-800">
                                    ExpectedBirthday
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-orange-100 text-orange-800">
                                    {{$log->expected_kiddle_days}} days
                                </span>
                            @endif
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        <div class="flex">
                            <x-button.link class="view-rabbit text-sm"
                                           wire:click="selectLog({{ $log->id }})">
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
                                               wire:click="handleSave({{ $log->id }})">
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
                                    <x-button.link wire:click="validateDeletion({{ $log->id }})">
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
                            <span class="font-medium py-8 text-gray-400 text-xl">No Logs found...</span>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforelse
        </x-slot>
    </x-table>
