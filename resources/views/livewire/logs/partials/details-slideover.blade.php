<div class="bg-gray-100 h-screen" style="min-height: 768px;">
    <section wire:keydown.window.escape="deselectRabbit" class="fixed inset-0 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 overflow-hidden">
            <div x-description="Background overlay, show/hide based on slide-over state." class="absolute inset-0" wire:click="deselectLog()" aria-hidden="true"></div>
            <div class="absolute inset-y-0 right-0 pl-10 max-w-full flex sm:pl-16">

                <transition enter-active-class="transform transition ease-in-out duration-500 sm:duration-700" enter-class="translate-x-full" enter-to-class="translate-x-0" leave-active-class="transform transition ease-in-out duration-500 sm:duration-700" leave-class="translate-x-0" leave-to-class="translate-x-full">
                    <div class="w-screen max-w-md">
                        <div class="h-full flex flex-col bg-white shadow overflow-y-scroll">
                            <div class="p-6">
                                <div class="flex items-start justify-between">

                                    <div id="slide-over-title">
                                        <h2 class="text-lg font-medium text-gray-900">
                                            <span class="sr-only">Details for </span>{{ $selectedLog->sire->rabbit_no }}
                                        </h2>
                                        <p class="text-sm font-medium text-gray-500">Breed not Specified</p>
                                    </div>
                                    <div class="ml-3 h-7 flex items-center">
                                        <button class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-teal-500" wire:click="deselectRabbit()">
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="h-full bg-white p-8 overflow-y-auto" x-description="Slide-over panel, show/hide based on slide-over state.">
                                <div class="pb-16 space-y-6">
                                    <div>
                                        <h3 class="font-medium text-gray-900">Information</h3>
                                        <dl class="mt-2 border-t border-b border-gray-200 divide-y divide-gray-200">
                                            <div class="py-3 flex justify-between text-sm font-medium">
                                                <dt class="text-gray-500">Current Cage</dt>
                                                <dd class="text-gray-900">
                                                    @if ($selectedLog->cage){{ $selectedLog->cage->cage_no }}@else None @endif
                                                </dd>
                                            </div>
                                            <div class="py-3 flex justify-between text-sm font-medium">
                                                <dt class="text-gray-500">Gender</dt>
                                                <dd class="text-gray-900 capitalize">
                                                    {{ $selectedLog->sire->gender }}
                                                </dd>
                                            </div>
                                            @if ($selectedLog->sire->date_of_birth)
                                                <div class="py-3 flex justify-between text-sm font-medium">
                                                    <dt class="text-gray-500">Date of Birth</dt>
                                                    <dd class="text-gray-900">
                                                        @if ($selectedLog->sire->date_of_birth){{ $selectedLog->sire->date_of_birth_for_humans }}@else None @endif
                                                    </dd>
                                                </div>
                                            @endif
                                            <div class="py-3 flex justify-between text-sm font-medium">
                                                <dt class="text-gray-500">Weight</dt>
                                                <dd class="text-gray-900">3kgs</dd>
                                            </div>
                                        </dl>
                                    </div>
                                    <div>
                                        @include('livewire.logs.partials.breeding-log')
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
