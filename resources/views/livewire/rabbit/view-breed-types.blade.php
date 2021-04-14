@section('title', 'Breed Types')
@section('header', 'Breed Types')
    <div class="mt-2">
        <div class="block">
            <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
                <div class="my-4">
                    <a href="{{ route('breed-types.create') }}"
                       class="underline font-bold leading-6 text-md uppercase">Add new Breed Types</a>
                </div>
                <div class="flex flex-col mt-2">
                    @forelse($breed_types as $breed_type)
                        <div class="bg-white shadow my-2 overflow-hidden sm:rounded-md">
                            <ul>
                                <li>
                                    <a href="{{ route('breed-types.edit', $breed_type->id) }}"
                                       class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                        <div class="flex items-center px-4 py-4 sm:px-6">
                                            <div class="min-w-0 flex-1 flex items-center">
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div>
                                                        <div class="text-sm leading-5 font-medium text-teal-600 truncate uppercase">{{ $breed_type->name }}</div>

                                                        <div class="hidden md:block">
                                                            <div>
                                                                <div class="text-sm leading-5 text-gray-900">
                                                                    Added on
                                                                    <time datetime="2020-01-07">{{ $breed_type->date_for_humans }}</time>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                </div>
                                            </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @empty

                        <div class="flex justify-center items-center space-x-2">
                            <svg class="-ml-1 mr-2 h-8 w-8 text-cool-gray-400"
                                 fill="currentColor"
                                 viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884zM18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"
                                      clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium py-8 text-cool-gray-400 text-xl">No breed_types found...</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
