@extends('layouts.app')

@section('content')
    <div>
        @include('common.tabs')
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
            <div class="flex flex-col justify-center">

                <div class="bg-white mt-4">
                    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between my-6">
                            <h1 class="list-heading">{{ trans('settings.role_user_roles') }}</h1>

                            <div class="text-right mr-12">
                                <x-button.href href="{{ route('roles.create') }}" class="border border-teal-600 px-2 py-2 rounded-md">{{ trans('settings.role_create') }}</x-button.href>
                            </div>
                        </div>

                        <table class="w-full min-w-full divide-y divide-gray-200">
                            <tr class="text-left">
                                <th scope="col" class="px-6 py-3 text-left text-md font-medium tracking-wider">{{ trans('settings.role_name') }}</th>
                                <th></th>
                                <th class="px-6 py-3 text-left text-md font-medium tracking-wider">{{ trans('settings.users') }}</th>
                            </tr>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($roles as $role)
                                    <tr class="">
                                        <td class="text-left px-6 py-4 whitespace-nowrap"><a href="{{ route('roles.edit', $role) }}">{{ $role->display_name }}</a></td>
                                        <td class="text-left px-6 py-4 whitespace-nowrap">{{ $role->description }}</td>
                                        <td class="text-left px-6 py-4 whitespace-nowrap">{{ $role->users->count() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            @stop
