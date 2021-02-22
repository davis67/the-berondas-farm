 @section('title', 'Expenses')
@section('header', 'Expenses')
<div class="mt-1 space-y-4">
    <div class="bg-white rounded-none border border-cool-gray-200">
        <!-- <h2 class="text-lg leading-6 font-medium py-4 px-4 text-cool-gray-900">Overview</h2> -->
        <div class="mt-2 grid grid-cols-1 gap-5 py-3 px-2 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white border border-cool-gray-200 overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-cool-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm leading-5 font-medium text-cool-gray-500 truncate">
                                    expenses
                                </dt>
                                <dd>
                                    <div class="text-lg leading-7 font-medium text-cool-gray-900">
                                       shs {{$expenses_count}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-cool-gray-50 px-5 py-3">
                    <div class="text-sm leading-5">
                        <a href="{{route('expenses.create')}}"
                            class="font-medium text-teal-600 hover:text-teal-900 transition ease-in-out duration-150">
                            Add New
                        </a>
                    </div>
                </div>
            </div>

            <!-- More cards... -->
        </div>
    </div>

    <div class="my-4">
        <a href="{{route('expense-types.index')}}" class="underline font-bold leading-6 text-md uppercase">View all Expense Types</a>
    </div>

    <div class="bg-white border border-cool-gray-200  sm:px-6 lg:px-8">
        <div class="w-full">
            <div class="py-2 w-3/4 w-full flex space-x-4">
                <select id="search" wire:model="search" class="form-select px-3 py-3 block w-full rounded-none border transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    <option value="" >Select Expense by type ...</option>
                    @foreach($expense_types as $expense_type)
                        <option value="{{$expense_type->id}}">{{$expense_type->name}}</option>
                    @endforeach
                </select>
                <x-button.link wire:click="$toggle('showFilters')">@if($showFilters) Hide @endif Advanced Search ...</x-button.link>
            </div>
        </div>

        <div>

        @if($showFilters)
            <div class="bg-white p-4 rounded shadow flex relative">

               <div class="w-1/2 pl-2 space-y-4">
                   <x-input.group inline for="filter-date-min" label="Minimum Date">
                       <x-input.date type="date" wire:model.lazy="date_min" id="date_min" placeholder="MM/DD/YYYY" />
                   </x-input.group>

                   <x-input.group inline for="filter-date-max" label="Maximum Date">
                       <x-input.date type="date" wire:model.lazy="date_max" id="date_max" placeholder="MM/DD/YYYY" />
                   </x-input.group>

                   <x-button.link wire:click="resetFilters" class="absolute right-0 bottom-0 p-4">Reset Filters</x-button.link>
               </div>
            </div>
        @endif
        </div>
        <div class="bg-white flex flex-col mt-2">
            <x-table>
                <x-slot name="head">
                    <x-table.header sortable wire:click="sortBy('expense_type_id')"
                        :direction="$sortField === 'expense_type_id' ? $sortDirection : null">Expense Type </x-table.header>
                    <x-table.header sortable wire:click="sortBy('amount')"
                        :direction="$sortField === 'amount' ? $sortDirection : null">Amount</x-table.header>
                    <x-table.header sortable wire:click="sortBy('created_at')"
                        :direction="$sortField === 'created_at' ? $sortDirection : null">Expense Date</x-table.header>
                </x-slot>
                <x-slot name="body">
                    @forelse($expenses as $expense)
                    <x-table.row wire:loading.class="opacity-50">
                        <x-table.cell>
                            {{ $expense->category->name }}
                        </x-table.cell>
                        <x-table.cell>
                            shs {{ $expense->amount }}
                        </x-table.cell>
                        <x-table.cell>
                            {{ $expense->expense_date_for_humans }}
                        </x-table.cell>
                        <x-table.cell>
                            <a href="{{route('expenses.edit', $expense->id)}}" class="underline font-bold leading-6 text-md uppercase">Edit Expense</a>
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="6">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-gray-400" />
                                <span class="font-medium py-8 text-gray-400 text-xl">No expenses found...</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
            <div class="bg-white px-4 py-3 border-t border-cool-gray-200 sm:px-6">
                {{$expenses->links()}}
            </div>
        </div>
    </div>

</div>
