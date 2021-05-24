@extends('layouts.app')
@section('content')
    <div class="mt-6">
        <div class="bg-white p-4">
            <h1 class="font-bold"> {{ trans('settings.role_delete') }}</h1>

            <p>{{ trans('settings.role_delete_confirm', ['roleName' => $role->display_name]) }}</p>

            <form action="{{ route('roles.destroy', $role) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="">
                    <div>
                        <p class="text-neg">
                            <strong>{{ trans('settings.role_delete_sure') }}</strong>
                        </p>
                    </div>
                    <div>
                        <div class="form-group text-right">
                            <x-button.href href="{{ route('roles.edit', $role) }}" class="">{{ trans('common.cancel') }}</x-button.href>
                            <x-button type="submit" class="button">{{ trans('common.confirm') }}</x-button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
@stop
