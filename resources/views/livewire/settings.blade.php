@extends('layouts.app')

@section('content')
    <div>
        @include('common.tabs')
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
            <div class="flex flex-col justify-center">

                <div class="">
                    <div class="block">
                        <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
                            <div class="flex flex-col mt-2">
                                <div class="align-middle min-w-full   overflow-hidden sm:rounded-lg">
                                    <div class="bg-white pt-6  sm:px-6 lg:px-8">
                                        <div class="w-full">
                                            <div class="w-full flex">
                                                <div class="w-full flex-1 flex">
                                                    <div class="py-2 flex items-center justify-between font-bold px-2">
                                                        <span class="px-2 text-primary">Users</span>
                                                        <x-input.text wire:model.lazy="filters.search" id="search" placeholder="Search Users" />
                                                    </div>
                                                </div>
                                                <div class="px-12 space-x-2 items-center flex">
                                                    <x-input.group borderless paddingless for="perPage" label="Per Page">
                                                        <x-input.select wire:model="perPage" id="perPage">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                            <option value="all">All</option>
                                                        </x-input.select>
                                                    </x-input.group>
                                                    <x-dropdown label="Bulk Action">
                                                        <x-dropdown.item type="button" wire:click="" class="flex items-center space-x-2">
                                                            <x-icon.download class="text-cool-gray-400" />
                                                            <span>Export</span>
                                                    </x-dropdown>
                                                    <x-dropdown.item type="button" wire:click="" class="flex items-center space-x-2">
                                                        <x-icon.trash class="text-cool-gray-400" />
                                                        <span>Delete</span>
                                                        </x-dropdown>
                                                        </x-dropdown>
                                                        <x-button.primary class="border border-teal-600 px-2 py-2 rounded-md" href="">Add New User</x-button.primary>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="bg-white flex flex-col mt-2">
                                            <x-table>
                                                <x-slot name="head">
                                                    <x-table.header class="pr-0 w-8">
                                                        <x-input.checkbox wire:model="" />
                                                    </x-table.header>
                                                    <x-table.header sortable wire:click="sortBy('')" :direction="$sorts[''] ?? null">Name </x-table.header>
                                                    <x-table.header sortable wire:click="sortBy('')" :direction="$sorts[''] ?? null">Email </x-table.header>
                                                    <x-table.header sortable wire:click="sortBy('gender')" :direction="$sorts['gender'] ?? null">Gender</x-table.header>
                                                    <x-table.header sortable wire:click="sortBy('')" :direction="$sorts[''] ?? null">Roles</x-table.header>
                                                    <x-table.header sortable wire:click="sortBy('')" :direction="$sorts[''] ?? null">Latest Activity</x-table.header>
                                                </x-slot>
                                                <x-slot name="body">

                                                    <tr x-data @click="                                                       const target = $event.target.tagName.toLowerCase();                                                              const ignores = ['button', 'svg', 'path', 'a', 'input'];                                                               if(! ignores.includes(target))
                                                                                                                                                                                                                                                                                                                        {                                                               $event.target.closest('.rabbit-row').querySelector('.view-rabbit').click()
                                                                                                                                                                                                                                                                                                                        }" class="rabbit-row bg-white hover:bg-gray-100 cursor-pointer" wire:loading.class=" opacity-50">
                                                        <x-table.cell class="pr-0 hover:bg-gray-100">
                                                            <x-input.checkbox wire:model="selected" value="1" />
                                                        </x-table.cell>

                                                        <x-table.cell>
                                                            Admin Example
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            admin@example.com
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Male
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Admin
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            8 seconds ago
                                                        </x-table.cell>
                                                    </tr>
                                                    <tr x-data class="rabbit-row bg-white hover:bg-gray-100 cursor-pointer" wire:loading.class=" opacity-50">
                                                        <x-table.cell class="pr-0 hover:bg-gray-100">
                                                            <x-input.checkbox wire:model="selected" value="1" />
                                                        </x-table.cell>

                                                        <x-table.cell>
                                                            Admin Example
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            admin@example.com
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Male
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Admin
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            8 seconds ago
                                                        </x-table.cell>
                                                    </tr>
                                                    <tr x-data class="rabbit-row bg-white hover:bg-gray-100 cursor-pointer" wire:loading.class=" opacity-50">
                                                        <x-table.cell class="pr-0 hover:bg-gray-100">
                                                            <x-input.checkbox wire:model="selected" value="1" />
                                                        </x-table.cell>

                                                        <x-table.cell>
                                                            Admin Example
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            admin@example.com
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Male
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Admin
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            8 seconds ago
                                                        </x-table.cell>
                                                    </tr>

                                                    <tr x-data class="rabbit-row bg-white hover:bg-gray-100 cursor-pointer" wire:loading.class=" opacity-50">
                                                        <x-table.cell class="pr-0 hover:bg-gray-100">
                                                            <x-input.checkbox wire:model="selected" value="1" />
                                                        </x-table.cell>

                                                        <x-table.cell>
                                                            Admin Example
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            admin@example.com
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Male
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Admin
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            8 seconds ago
                                                        </x-table.cell>
                                                    </tr>

                                                    <tr x-data class="rabbit-row bg-white hover:bg-gray-100 cursor-pointer" wire:loading.class=" opacity-50">
                                                        <x-table.cell class="pr-0 hover:bg-gray-100">
                                                            <x-input.checkbox wire:model="selected" value="1" />
                                                        </x-table.cell>

                                                        <x-table.cell>
                                                            Admin Example
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            admin@example.com
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Male
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Admin
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            8 weeks ago
                                                        </x-table.cell>
                                                    </tr>

                                                    <tr x-data class="rabbit-row bg-white hover:bg-gray-100 cursor-pointer" wire:loading.class=" opacity-50">
                                                        <x-table.cell class="pr-0 hover:bg-gray-100">
                                                            <x-input.checkbox wire:model="selected" value="1" />
                                                        </x-table.cell>

                                                        <x-table.cell>
                                                            Admin Example
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            admin@example.com
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Male
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Admin
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            8 year ago
                                                        </x-table.cell>
                                                    </tr>

                                                    <tr x-data class="rabbit-row bg-white hover:bg-gray-100 cursor-pointer" wire:loading.class=" opacity-50">
                                                        <x-table.cell class="pr-0 hover:bg-gray-100">
                                                            <x-input.checkbox wire:model="selected" value="1" />
                                                        </x-table.cell>

                                                        <x-table.cell>
                                                            Admin Example
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            admin@example.com
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Male
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            Admin
                                                        </x-table.cell>
                                                        <x-table.cell>
                                                            8 days ago
                                                        </x-table.cell>
                                                    </tr>


                                                    {{-- <x-table.row>
                                                            <x-table.cell colspan="6">
                                                                <div class="flex justify-center items-center space-x-2">
                                                                    <x-icon.inbox class="h-8 w-8 text-gray-400" />
                                                                    <span class="font-medium py-8 text-gray-400 text-xl">No users found...</span>
                                                                </div>
                                                            </x-table.cell>
                                                        </x-table.row> --}}

                                                </x-slot>
                                            </x-table>
                                            <div class="bg-white px-4 py-3 border-t border-cool-gray-200 sm:px-6">
                                                Pagination here
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
