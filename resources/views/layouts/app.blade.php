@extends('layouts.base')

@section('body')
    <div class="min-h-screen bg-gray-50">
        <nav x-data="{ open: false }"
             class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <!-- <img class="block lg:hidden h-8 w-auto" src="/img/logos/workflow-mark-on-white.svg" alt="Workflow logo" /> -->
                            <!-- <img class="hidden lg:block h-8 w-auto" src="/img/logos/workflow-logo-on-white.svg" alt="Workflow logo" /> -->
                            The Berondas Farm
                        </div>
                        <div class="hidden sm:ml-6 sm:flex">
                            <a href="{{ route('home') }}"
                               class="inline-flex items-center px-1 pt-1 {{ Nav::isRoute('home') }}  text-sm font-medium leading-5 focus:outline-none focus:border-teal-700 text-gray-500 transition duration-150 ease-in-out">
                                Home
                            </a>
                            <a href="{{ route('batches.index') }}"
                               class="ml-8 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500  {{ Nav::isRoute('batches.create') }} {{ Nav::isRoute('batches.show') }} {{ Nav::isRoute('batches.index') }} {{ Nav::isRoute('cages.show') }} {{ Nav::isRoute('cages.edit') }} hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                Batches
                            </a>
                            <a href="{{ route('farms.index') }}"
                               class="ml-8 {{ Nav::isRoute('farms.index') }} {{ Nav::isRoute('farms.edit') }} {{ Nav::isRoute('rabbits.create') }} {{ Nav::isRoute('breed-types.create') }} {{ Nav::isRoute('breed-types.index') }} {{ Nav::isRoute('breed-types.edit') }} inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                Farms
                            </a>
                            <a href="{{ route('rabbits.index') }}"
                               class="ml-8 inline-flex items-center {{ Nav::isRoute('rabbits.index') }} px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                Rabbits
                            </a>
                            <a href="{{ route('expenses.index') }}"
                               class="ml-8 inline-flex items-center {{ Nav::isRoute('expenses.create') }} {{ Nav::isRoute('expenses.index') }} px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                Expenses
                            </a>
                            <a href="#"
                               class="ml-8 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                Report
                            </a>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <button class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:text-gray-500 focus:bg-gray-100 transition duration-150 ease-in-out"
                                aria-label="Notifications">
                            <svg class="h-6 w-6"
                                 stroke="currentColor"
                                 fill="none"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <div @click.away="open = false"
                             class="ml-3 relative"
                             x-data="{ open: false }">
                            <div>
                                <button @click="open = !open"
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out"
                                        id="user-menu"
                                        aria-label="User menu"
                                        aria-haspopup="true"
                                        x-bind:aria-expanded="open">
                                    <img class="w-12 h-12 rounded-full object-cover"
                                         src="{{ auth()->user()->profile_photo_url }}"
                                         alt="{{ auth()->user()->name }}">
                                </button>
                            </div>
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                                <div class="py-1 rounded-md bg-white shadow-xs">
                                    <a href="#"
                                       class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Your Profile</a>
                                    <a href="#"
                                       class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Settings</a>
                                    <a href="#"
                                       class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Sign out</a>
                                    <div>
                                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                           href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form"
                                              action="{{ route('logout') }}"
                                              method="POST"
                                              class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = !open"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                x-bind:aria-label="open ? 'Close main menu' : 'Main menu'"
                                x-bind:aria-expanded="open">
                            <svg class="h-6 w-6"
                                 stroke="currentColor"
                                 fill="none"
                                 viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': !open }"
                                      class="inline-flex"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !open, 'inline-flex': open }"
                                      class="hidden"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div :class="{'block': open, 'hidden': !open}"
                 class="hidden sm:hidden">
                <div class="pt-2 pb-3">
                    <a href="{{ route('home') }}"
                       class="block {{ Nav::isRoute('home', $activeClass = 'border-l-4 text-teal-700 border-teal-500 bg-teal-50 ') }} pl-3 pr-4 py-2  text-base font-medium focus:outline-none focus:text-teal-800 focus:bg-teal-100 focus:border-teal-700 transition duration-150 ease-in-out">Home</a>
                    <a href="{{ route('batches.create') }}"
                       class="mt-1 block {{ Nav::isRoute('batches.create', $activeClass = 'border-l-4 text-teal-700 border-teal-500 bg-teal-50 ') }} pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Batches</a>
                    <a href="{{ route('rabbits.index') }}"
                       class="mt-1 block pl-3 pr-4 py-2 border-l-4 {{ Nav::isRoute('rabbits.index', $activeClass = 'border-l-4 text-teal-700 border-teal-500 bg-teal-50 ') }} border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Rabbits</a>
                    <a href="{{ route('farm.create') }}"
                       class="mt-1 {{ Nav::isRoute('farm.create', $activeClass = 'border-l-4 text-teal-700 border-teal-500 bg-teal-50 ') }} block pl-3 pr-4 py-2 border-l-4 {{ Nav::isRoute('farms.index', $activeClass = 'border-l-4 text-teal-700 border-teal-500 bg-teal-50 ') }} border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Farms</a>
                    <a href="#"
                       class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Expenses</a>
                    <a href="#"
                       class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">Report</a>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img class="w-12 h-12 rounded-full object-cover"
                                 src="{{ auth()->user()->profile_photo_url }}"
                                 alt="{{ auth()->user()->name }}">

                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium leading-6 text-gray-800">Agaba Davis</div>
                            <div class="text-sm font-medium leading-5 text-gray-500">admin@theberondasfarm.com</div>
                        </div>
                    </div>
                    <div class="mt-3"
                         role="menu"
                         aria-orientation="vertical"
                         aria-labelledby="user-menu">
                        <a href="#"
                           class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
                           role="menuitem">Your Profile</a>
                        <a href="#"
                           class="mt-1 block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
                           role="menuitem">Settings</a>
                        <div>
                            <a class="mt-1 block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form"
                                  action="{{ route('logout') }}"
                                  method="POST"
                                  class="d-none">
                                @csrf
                            </form>
                        </div>
                        <a href="#"
                           class="mt-1 block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
                           role="menuitem">Sign out</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="">
            <header>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-2xl font-bold leading-tight text-gray-900">
                        @yield('header')
                    </h1>
                </div>
            </header>
            <x-notification />
            <main>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Replace with your content -->
                    <div class="px-4 py-8 sm:px-0">
                        <div class="rounded-lg h-96">
                            @yield('content')

                            @isset($slot)
                                {{ $slot }}
                            @endisset
                        </div>
                    </div>
                    <!-- /End replace -->
                </div>
            </main>
        </div>
    </div>

@endsection
