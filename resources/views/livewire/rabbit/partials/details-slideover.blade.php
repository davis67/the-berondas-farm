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
                                                    @if ($selectedRabbit->cage){{ $selectedRabbit->cage->cage_no }}@else None @endif
                                                </dd>
                                            </div>
                                            <div class="py-3 flex justify-between text-sm font-medium">
                                                <dt class="text-gray-500">Gender</dt>
                                                <dd class="text-gray-900 capitalize">
                                                    {{ $selectedRabbit->gender }}
                                                </dd>
                                            </div>
                                            <div class="py-3 flex justify-between text-sm font-medium">
                                                <dt class="text-gray-500">Date of Birth</dt>
                                                <dd class="text-gray-900">
                                                    @if ($selectedRabbit->date_of_birth){{ $selectedRabbit->date_of_birth }}@else None @endif
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
                                                <dd class="text-teal-900 capitalize font-bold">{{ $selectedRabbit->status }}</dd>
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
                                        @include('livewire.rabbit.partials.breeding-log')
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
