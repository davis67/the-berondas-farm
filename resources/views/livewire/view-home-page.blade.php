@section('title', 'Home')
    <div>
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            General Report
        </h3>
        <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-teal-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                                    Total Rabbits
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl leading-8 font-semibold text-gray-900">
                                        {{ $total_rabbits }}
                                    </div>
                                    <div class="ml-2 flex items-baseline text-sm leading-5 font-semibold text-green-600">
                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-green-500"
                                             fill="currentColor"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">
                                            Increased by
                                        </span>
                                        {{ $total_kits }}(Kits)
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm leading-5">
                        <a href="{{ route('rabbits.index') }}"
                           class="font-medium text-teal-600 hover:text-teal-500 transition ease-in-out duration-150">
                            View all
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-teal-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                                    Total Expenses
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-xl leading-8 font-semibold text-gray-900">
                                        shs 34500000
                                    </div>
                                    <div class="ml-2 flex items-baseline text-sm leading-5 font-semibold text-green-600">
                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-green-500"
                                             fill="currentColor"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">
                                            Increased by
                                        </span>
                                        5.4%(hardcoded)
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm leading-5">
                        <a href="#"
                           class="font-medium text-teal-600 hover:text-teal-500 transition ease-in-out duration-150">
                            View all
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-teal-500 rounded-md p-3">
                            <svg class="w-6 h-6 text-white"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 4a1 1 0 000 2 1 1 0 011 1v1H7a1 1 0 000 2h1v3a3 3 0 106 0v-1a1 1 0 10-2 0v1a1 1 0 11-2 0v-3h3a1 1 0 100-2h-3V7a3 3 0 00-3-3z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                                    Total Sales
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl leading-8 font-semibold text-gray-900">
                                        24.57
                                    </div>
                                    <div class="ml-2 flex items-baseline text-sm leading-5 font-semibold text-red-600">
                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-red-500"
                                             fill="currentColor"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">
                                            Decreased by
                                        </span>
                                        3.2%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm leading-5">
                        <a href="#"
                           class="font-medium text-teal-600 hover:text-teal-500 transition ease-in-out duration-150">
                            View all
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <span class="font-bold leading-6 text-md uppercase">Kits: {{ $total_kits }}</span>
        </ <h3
           class="text-lg leading-6 py-4 font-medium text-gray-900">
        Served Rabbits
        </h3>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b bg-white border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID N0
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cage N0
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        GP
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date of Mating
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Expected Kiddle Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($rabbits as $rabbit)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm text-gray-500">
                                                    {{ $rabbit->mother->rabbit_no }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                @if ($rabbit->mother->cage)
                                                    <span class="font-bold text-teal-700">{{ $rabbit->mother->cage->cage_no }}</span>
                                                @else
                                                    <span>No Cage Info </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $rabbit->gestation_period }} days
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $rabbit->date_of_mating }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $rabbit->expected_kiddle_date }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('rabbits.register-birth', $rabbit->id) }}"
                                               class="text-sm bg-teal-700 text-white hover:bg-teal-900 py-2 px-2 rounded">Record Conception</a>
                                            <a href="{{ route('rabbits.register-birth', $rabbit->id) }}"
                                               class="text-red-700 hover:text-red-900 border border-red-700 py-2 px-2 rounded">Record misconception</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="w-full">
                                        <td colspan="4"
                                            class="w-full flex justify-center py-4 px-2 my-2">
                                            No Served Rabbits at the moment...
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
