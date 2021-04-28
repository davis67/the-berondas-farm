<div>
    <h3 class="font-medium text-gray-900">Previous Breeding Log</h3>
    <ul class="mt-2 border-t border-b border-gray-200 divide-y divide-gray-200">
        @if($selectedLog->logs != null)
        {{-- @json($selectedLog->logs) --}}
        @foreach($selectedLog->logs as $log)
        <li class="py-3 flex justify-between items-center">
            <div class="flex items-center">

                    @if($log->is_successful_mating == null)
                    <div class="rounded-full bg-red-200 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 010-31.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    @else
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
                    @endif
                <div class="ml-4 text-sm font-medium text-gray-900">
                    @if($log->is_successful_mating == null)
                        <p>{{ $log->expected_kiddle_date }}</p>
                    @else
                        <p>{{ $log->kiddle_date }}</p>
                    @endif
                </div>
            </div>
            <button type="button"
                    class="ml-6 bg-white rounded-md text-sm font-medium text-teal-600 hover:text-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">10<span class="sr-only"> Aimee Douglas</span></button>
        </li>
        @endforeach
        @else
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
        @endif
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
            <button type="button" wire:click="toggleMatingSlideover"
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
            @if($showMatingSlideover)
                <div class="flex items-center space-x-2 mt-4 md:mt-0"  wire:click.away="{{ $showMatingSlideover = false }}"
                            wire:keydown.escape.window="{{ $showMatingSlideover = false }}">
                        <div class="absolute w-80  text-left font-semibold bg-white shadow-dialog rounded-xl py-3 md:ml-8 bottom-0 md:bottom-10 right-8">
                            <form wire:submit.prevent="saveMatingRecord({{ $selectedLog->id }})" class="flex flex-col m-6 space-y-2">
                                <span class="text-gray-500">Record a new Mating at the farm</span>
                                <x-input.group for="date_of_mating"
                                           :error="$errors->first('date_of_mating')"
                                           label="Date">
                                <x-input.date type="date" id="date_of_mating" wire:model="date_of_mating"  placeholder="date of mating"  class="rounded-md w-full" />
                            </x-input.group>
                                <x-input.group for="dam_id"
                                           :error="$errors->first('dam_id')"
                                           label="Dam">
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
</div>
