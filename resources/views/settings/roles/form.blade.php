<div class="space-y-8 divide-y divide-gray-200">
    <div>
        <div>
            <h1 class="text-2xl leading-6 font-medium text-primary">
                Create A New Role
            </h1>
            <p class="mt-1 text-md text-gray-500">
                Role Details
            </p>
        </div>
    </div>

    <div class="">
        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="display_name" class="block text-sm font-medium text-gray-700">
                    Role Name
                </label>
                <div class="mt-1">
                    <input type="text" wire:model.lazy="display_name" name="display_name" id="display_name" autocomplete="given-name" class="shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="description" class="block text-sm font-medium text-gray-700">
                    Short Description of Role
                </label>
                <div class="mt-1">
                    <input type="text" wire:model.lazy="description" name="description" id="description" autocomplete="description" class="shadow-sm focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

        </div>
    </div>

    <div class="pt-2">
        <div class="mt-6">
            <fieldset>
                <legend class="text-base font-medium text-primary">
                    System Permissions
                </legend>
                <p class="mt-1 text-sm text-red-700">Be aware that access to any of the below three permissions can allow a user to alter their own privileges or the privileges of others in the system. Only assign roles with these permissions to trusted users.</p>
                <div class="mt-4 space-y-4">
                    <div>@include('settings.roles.checkbox', ['permission' => 'restrictions-manage-all', 'label' => "Manage all rabbits, expenses & logs permissions"])</div>
                    <div>@include('settings.roles.checkbox', ['permission' => 'restrictions-manage-own', 'label' => "Manage permissions on own rabbits, expenses & logs"])</div>
                    <div>@include('settings.roles.checkbox', ['permission' => 'access-api', 'label' => trans('settings.role_access_api')])</div>
                </div>
                <div class="mt-4 space-y-4">
                    <div>@include('settings.roles.checkbox', ['permission' => 'settings-manage', 'label' => trans('settings.role_manage_settings')])</div>
                    <div>@include('settings.roles.checkbox', ['permission' => 'users-manage', 'label' => trans('settings.role_manage_users')])</div>
                    <div>@include('settings.roles.checkbox', ['permission' => 'user-roles-manage', 'label' => trans('settings.role_manage_roles')])</div>

                </div>

        </div>
        </fieldset>
    </div>
</div>
<div class="pt-8">
    <div>
        <h3 class="text-lg leading-6 font-medium text-primary">
            Asset Permissions
        </h3>
        <p class="mt-1 text-sm text-red-700">
            These permissions control default access to the assets within the system. Permissions on Rabbits, Expenses and Logs will override these permissions.
        </p>
    </div>
    <div class="mt-6">
        <table class="text-gray-500 w-full">
            <tr class="text-gray-600 text-left">
                <th width="20%">
                    <a href="#" class="text-small text-primary">{{ trans('common.toggle_all') }}</a>
                </th>
                <th width="20%">{{ trans('common.create') }}</th>
                <th width="20%">{{ trans('common.view') }}</th>
                <th width="20%">{{ trans('common.edit') }}</th>
                <th width="20%">{{ trans('common.delete') }}</th>
            </tr>
            <tr class="text-left">
                <td>
                    <div>Rabbits</div>
                    <a href="#" class="text-small text-primary">{{ trans('common.toggle_all') }}</a>
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'rabbit-create-all', 'label' => trans('settings.role_all')])
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'rabbit-view-own', 'label' => trans('settings.role_own')])
                    <br>
                    @include('settings.roles.checkbox', ['permission' => 'rabbit-view-all', 'label' => trans('settings.role_all')])
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'rabbit-update-own', 'label' => trans('settings.role_own')])
                    <br>
                    @include('settings.roles.checkbox', ['permission' => 'rabbit-update-all', 'label' => trans('settings.role_all')])
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'rabbit-delete-own', 'label' => trans('settings.role_own')])
                    <br>
                    @include('settings.roles.checkbox', ['permission' => 'rabbit-delete-all', 'label' => trans('settings.role_all')])
                </td>
            </tr>
            <tr>
                <td>
                    <div>Expenses</div>
                    <a href="#" class="text-small text-primary">{{ trans('common.toggle_all') }}</a>
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'expense-create-all', 'label' => trans('settings.role_all')])
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'expense-view-own', 'label' => trans('settings.role_own')])
                    <br>
                    @include('settings.roles.checkbox', ['permission' => 'expense-view-all', 'label' => trans('settings.role_all')])
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'expense-update-own', 'label' => trans('settings.role_own')])
                    <br>
                    @include('settings.roles.checkbox', ['permission' => 'expense-update-all', 'label' => trans('settings.role_all')])
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'expense-delete-own', 'label' => trans('settings.role_own')])
                    <br>
                    @include('settings.roles.checkbox', ['permission' => 'expense-delete-all', 'label' => trans('settings.role_all')])
                </td>
            </tr>
            <tr>
                <td>
                    <div>Logs</div>
                    <a href="#" class="text-small text-primary">{{ trans('common.toggle_all') }}</a>
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'log-create-own', 'label' => trans('settings.role_own')])
                    <br>
                    @include('settings.roles.checkbox', ['permission' => 'log-create-all', 'label' => trans('settings.role_all')])
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'log-view-own', 'label' => trans('settings.role_own')])
                    <br>
                    @include('settings.roles.checkbox', ['permission' => 'log-view-all', 'label' => trans('settings.role_all')])
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'log-update-own', 'label' => trans('settings.role_own')])
                    <br>
                    @include('settings.roles.checkbox', ['permission' => 'log-update-all', 'label' => trans('settings.role_all')])
                </td>
                <td>
                    @include('settings.roles.checkbox', ['permission' => 'log-delete-own', 'label' => trans('settings.role_own')])
                    <br>
                    @include('settings.roles.checkbox', ['permission' => 'log-delete-all', 'label' => trans('settings.role_all')])
                </td>
            </tr>
        </table>
    </div>
</div>


<div class="pt-5">
    <div class="flex justify-end">
        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            Cancel
        </button>
        <x-button.primary type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white">
            Save
        </x-button.primary>
    </div>
</div>