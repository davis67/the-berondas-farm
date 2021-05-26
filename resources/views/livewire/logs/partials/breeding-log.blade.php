<div>
    <h3 class="font-medium text-gray-900">Previous Breeding Log</h3>
    <ul class="mt-2 border-t border-b border-gray-200 divide-y divide-gray-200">
        @forelse ($selectedLog->sire->logs as $log)
            <li class="py-3 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="rounded-full bg-teal-200">
                        @if ($log->is_successful_mating)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                            </svg>
                        @endif
                    </div>

                    <p class="ml-4 text-sm font-medium text-gray-900">{{ $log->kiddle_date_for_humans }}</p>
                </div>
                <button type="button" class="ml-6 bg-white rounded-md text-sm font-medium text-teal-600 hover:text-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                    @if ($log->is_successful_mating){{ $log->litters }}@else <span class="text-red-500">None</span> @endif
                </button>
                <div class="flex">
                    <x-button.link class="text-sm" wire:click="handleEditLog({{ $log->id }})">
                        <svg class="h-6 w-6 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </x-button.link>
                    <x-button.link wire:click="">
                        <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </x-button.link>
                </div>
            </li>
        @empty
            <li class="py-3 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="rounded-full bg-teal-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="ml-4 text-sm font-medium text-gray-900">June 8, 2020</p>
                </div>
                <button type="button" class="ml-6 bg-white rounded-md text-sm font-medium text-teal-600 hover:text-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">23<span class="sr-only"> Andrea McMillan</span></button>
            </li>
        @endforelse
        <li class="py-2 flex justify-between items-center">
            <button type="button" wire:click="toggleMatingSlideover" class="group -ml-1 bg-white p-1 rounded-md flex items-center focus:outline-none focus:ring-2 focus:ring-teal-500">
                <span class="w-8 h-8 rounded-full border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400">
                    <svg class="h-5 w-5" x-description="Heroicon name: solid/plus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                </span>
                <span class="ml-4 text-sm font-medium text-teal-600 group-hover:text-teal-500">Add a Mating Record</span>
            </button>
            @if ($showMatingSlideover)
                <div class="flex items-center space-x-2 mt-4 md:mt-0" wire:click.away="{{ $showMatingSlideover = false }}" wire:keydown.escape.window="{{ $showMatingSlideover = false }}">
                    <div class="absolute w-80  text-left font-semibold bg-white shadow-dialog rounded-xl py-3 md:ml-8 bottom-0 md:bottom-10 right-8">
                        <form wire:submit.prevent="saveMatingRecord({{ $selectedLog->id }})" class="flex flex-col m-6 space-y-2">
                            <span class="text-gray-500">Record a new Mating at the farm</span>
                            <x-input.group for="date_of_mating" :error="$errors->first('date_of_mating')" label="Date">
                                <x-input.date type="date" id="date_of_mating" wire:model="date_of_mating" placeholder="date of mating" class="rounded-md w-full" />
                            </x-input.group>
                            <x-input.group for="dam_id" :error="$errors->first('dam_id')" label="Dam">
                                <x-input.select wire:model="dam_id" id="dam_id" class="text-gray-500">
                                    <option value="">Select Male ...</option>
                                    @foreach (App\Models\Rabbit::where('gender', 'dam')->get() as $rabbit)
                                        <option value="{{ $rabbit->id }}">{{ $rabbit->rabbit_no }}</option>
                                    @endforeach
                                </x-input.select>
                            </x-input.group>
                            <div>
                                <x-button.primary type="submit">Save</x-button.primary>
                            </div>
                        </form>
                    </div>

                </div>
            @endif
        </li>
    </ul>
    <form wire:submit.prevent="updateLog">
        @include('livewire.logs.partials.edit-breeding-log-modal')
    </form>
</div>
